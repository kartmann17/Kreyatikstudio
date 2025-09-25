<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(Request $request)
    {
        $user = \App\Models\User::findOrFail($request->route('id'));

        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            return redirect()->route('login')->with('error', 'Lien de vérification invalide.');
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->with('error', 'Lien de vérification invalide.');
        }

        if ($user->hasVerifiedEmail()) {
            // Connecter automatiquement l'utilisateur si son email est déjà vérifié
            auth()->login($user);
            return redirect()->route('dashboard')->with('success', 'Votre email est déjà vérifié.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Connecter automatiquement l'utilisateur après vérification
        auth()->login($user);
        
        return redirect()->route('dashboard')->with('success', 'Votre email a été vérifié avec succès !');
    }
}
