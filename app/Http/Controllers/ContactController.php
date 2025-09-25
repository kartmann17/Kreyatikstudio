<?php

namespace App\Http\Controllers;

use App\SEO\ContactPageSEO;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ContactController extends Controller
{
    protected $seo;

    public function __construct(ContactPageSEO $seo)
    {
        $this->seo = $seo;
    }

    public function index()
    {
        $settings = \App\Models\GlobalSettings::getInstance();
        
        $seo = new SEOData(
            title: 'Contact | Kréyatik Studio',
            description: 'Contactez-nous pour discuter de votre projet. Notre équipe est à votre écoute pour vous accompagner dans la réalisation de vos objectifs digitaux.',
            author: 'Kréyatik Studio',
            robots: 'index, follow',
            image: asset('images/logo.png'),
        );

        return view('contact.index', ['SEOData' => $seo]);
    }

    /**
     * Traite l'envoi d'email du formulaire de contact
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        \Log::info('Tentative d\'envoi de message de contact', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'data' => $request->all()
        ]);

        // SÉCURISATION : Validation renforcée avec protection anti-spam
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|min:2|regex:/^[a-zA-ZÀ-ÿ\s\'-]+$/',
            'email' => 'required|email:strict|max:100|min:5',
            'object_message' => 'required|string|max:100|min:5',
            'message' => 'required|string|max:2000|min:10',
        ], [
            'name.regex' => 'Le nom ne peut contenir que des lettres, espaces, apostrophes et tirets.',
            'email.email' => 'L\'adresse email doit être valide.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
        ]);

        // Protection anti-spam : vérifier la fréquence d'envoi par IP
        $recentMessages = ContactMessage::where('ip_address', $request->ip())
            ->where('created_at', '>=', now()->subHour())
            ->count();

        if ($recentMessages >= 3) {
            \Log::warning('Tentative de spam détectée', [
                'ip' => $request->ip(),
                'messages_count' => $recentMessages,
                'user_agent' => $request->userAgent()
            ]);
            
            if ($request->ajax()) {
                return response()->json(['error' => 'Trop de messages envoyés. Veuillez patienter avant de renvoyer un message.'], 429);
            }
            return redirect()->back()->with('error', 'Trop de messages envoyés. Veuillez patienter avant de renvoyer un message.');
        }

        // Détection de contenu suspect
        $suspiciousPatterns = ['http://', 'https://', 'www.', '.com', '.net', '.org', '<script', '<iframe', 'viagra', 'casino'];
        $messageContent = strtolower($validatedData['message'] . ' ' . $validatedData['object_message']);
        
        foreach ($suspiciousPatterns as $pattern) {
            if (strpos($messageContent, $pattern) !== false) {
                \Log::warning('Message suspect détecté', [
                    'ip' => $request->ip(),
                    'pattern' => $pattern,
                    'message' => substr($validatedData['message'], 0, 100),
                    'user_agent' => $request->userAgent()
                ]);
                
                if ($request->ajax()) {
                    return response()->json(['error' => 'Votre message contient du contenu non autorisé.'], 400);
                }
                return redirect()->back()->with('error', 'Votre message contient du contenu non autorisé.');
            }
        }

        // Sanitisation supplémentaire des données
        $validatedData = [
            'name' => strip_tags(trim($validatedData['name'])),
            'email' => filter_var(trim($validatedData['email']), FILTER_SANITIZE_EMAIL),
            'object_message' => strip_tags(trim($validatedData['object_message'])),
            'message' => strip_tags(trim($validatedData['message'])),
        ];

        try {
            // SÉCURISATION : Anonymisation de l'IP pour conformité RGPD
            $anonymizedIp = $this->anonymizeIP($request->ip());
            
            // Enregistrer le message dans la base de données
            $contactMessage = ContactMessage::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'subject' => $validatedData['object_message'],
                'message' => $validatedData['message'],
                'ip_address' => $anonymizedIp,
                'is_read' => false
            ]);

            \Log::info('Message de contact enregistré avec succès', [
                'message_id' => $contactMessage->id,
                'name' => $validatedData['name'],
                'email' => $validatedData['email']
            ]);

            // Envoi de l'email
            Mail::to(config('mail.from.address'))->send(new ContactFormMail($validatedData));

            // Si la requête est AJAX
            if ($request->ajax()) {
                return response()->json(['success' => 'Votre message a été envoyé avec succès.']);
            }

            // Déterminer si la requête vient de la page d'accueil ou de la page contact
            $referer = $request->header('referer');

            // Si la requête vient de la page d'accueil, rediriger vers la page d'accueil
            if (str_contains($referer, url('/'))) {
                return redirect('/')->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
            }

            // Sinon, redirection vers la page contact avec message flash
            return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
        } catch (\Exception $e) {
            // Log l'erreur
            Log::error('Erreur lors de l\'envoi du message: ' . $e->getMessage());

            // Si la requête est AJAX
            if ($request->ajax()) {
                return response()->json(['error' => 'Une erreur est survenue lors de l\'envoi du message.'], 500);
            }

            // Déterminer si la requête vient de la page d'accueil ou de la page contact
            $referer = $request->header('referer');

            // Si la requête vient de la page d'accueil, rediriger vers la page d'accueil
            if (str_contains($referer, url('/'))) {
                return redirect('/')->with('error', 'Une erreur est survenue lors de l\'envoi du message.');
            }

            // Sinon, redirection avec message d'erreur
            return redirect()->route('contact')->with('error', 'Une erreur est survenue lors de l\'envoi du message.');
        }
    }

    /**
     * Anonymise une adresse IP pour conformité RGPD
     *
     * @param string $ip
     * @return string
     */
    private function anonymizeIP($ip)
    {
        // Vérifier si c'est une IPv4 ou IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            // IPv4 : masquer le dernier octet
            $parts = explode('.', $ip);
            $parts[3] = '0';
            return implode('.', $parts);
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // IPv6 : masquer les 4 derniers groupes
            $parts = explode(':', $ip);
            for ($i = count($parts) - 4; $i < count($parts); $i++) {
                if (isset($parts[$i])) {
                    $parts[$i] = '0';
                }
            }
            return implode(':', $parts);
        }
        
        // Si format non reconnu, retourner une IP anonyme
        return '0.0.0.0';
    }
}
