<x-header :seoData="$SEOData ?? null" />

<!-- ContactPage Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "@id": "https://kreyatikstudio.fr/Contact",
    "url": "https://kreyatikstudio.fr/Contact",
    "name": "Contact - Kréyatik Studio | Développeur Web Rochefort",
    "description": "Contactez Kréyatik Studio pour votre projet web. Réponse sous 24h, consultation gratuite. Développeur web freelance à Rochefort.",
    "inLanguage": "fr-FR",
    "isPartOf": {
        "@id": "https://kreyatikstudio.fr/#website"
    },
    "mainEntity": {
        "@type": "Organization",
        "@id": "https://kreyatikstudio.fr/#organization",
        "name": "Kréyatik Studio",
        "telephone": "+33695800663",
        "email": "kreyatik@gmail.com",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "2 rue du petit port marchand",
            "addressLocality": "Rochefort",
            "postalCode": "17300",
            "addressRegion": "Charente-Maritime",
            "addressCountry": "FR"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 45.9377,
            "longitude": -0.9609
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "telephone": "+33695800663",
            "email": "kreyatik@gmail.com",
            "areaServed": "FR",
            "availableLanguage": ["French"],
            "hoursAvailable": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens": "09:00",
                "closes": "19:00"
            }
        }
    }
}
</script>

<!-- WebPage Schema for Contact -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebPage",
    "@id": "https://kreyatikstudio.fr/Contact#webpage",
    "url": "https://kreyatikstudio.fr/Contact",
    "name": "Contact - Parlons de votre projet web",
    "description": "Contactez Kréyatik Studio pour discuter de votre projet. Réponse rapide sous 24h, consultation gratuite et devis personnalisé.",
    "inLanguage": "fr-FR",
    "isPartOf": {
        "@id": "https://kreyatikstudio.fr/#website"
    },
    "datePublished": "2024-01-01T00:00:00+01:00",
    "dateModified": "{{ now()->toIso8601String() }}",
    "publisher": {
        "@id": "https://kreyatikstudio.fr/#organization"
    },
    "potentialAction": {
        "@type": "CommunicateAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "https://kreyatikstudio.fr/Contact",
            "actionPlatform": [
                "http://schema.org/DesktopWebPlatform",
                "http://schema.org/MobileWebPlatform"
            ]
        }
    }
}
</script>

<main class="site-content" role="main">
  
    <section class="hero-section bg-gradient-to-br from-blue-50 to-indigo-100 py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Parlons de votre 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                        projet
                    </span>
                </h1>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Prêt à transformer vos idées en réalité ? Contactez-nous et découvrez comment nous pouvons vous aider à atteindre vos objectifs.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Réponse sous 24h
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Consultation gratuite
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Expertise garantie
                    </div>
                </div>
            </div>
        </div>
    </section>

  
    <section class="contact-section py-16 lg:py-24 bg-white" aria-label="Formulaire de contact">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                
        
                <div class="order-2 lg:order-1">
                    <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12 border border-gray-100">
                        <h2 class="text-3xl font-bold text-gray-900 mb-8">Envoyez-nous un message</h2>
                        
                        <form class="contact-form space-y-6"
                            action="{{ route('send.email') }}"
                            method="POST"
                            aria-label="Formulaire de contact">
                            @csrf
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nom complet <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <input type="text"
                                            class="contact-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            id="name"
                                            name="name"
                                            required
                                            aria-required="true"
                                            autocomplete="name"
                                            placeholder="Votre nom complet">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <input type="email"
                                            class="contact-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                            id="email"
                                            name="email"
                                            required
                                            aria-required="true"
                                            autocomplete="email"
                                            placeholder="votre@email.com">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Objet <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <input type="text"
                                        class="contact-input w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        id="subject"
                                        name="object_message"
                                        required
                                        aria-required="true"
                                        placeholder="Sujet de votre message">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <textarea class="contact-textarea w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                    id="message"
                                    name="message"
                                    rows="6"
                                    required
                                    aria-required="true"
                                    placeholder="Décrivez votre projet, vos besoins et vos objectifs..."
                                    aria-label="Contenu du message"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit"
                                    class="contact-button w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-4 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    aria-label="Envoyer le message">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        Envoyer le message
                                    </span>
                                </button>
                            </div>
                        </form>
                        
                    
                        <div class="mt-6 space-y-4" role="alert">
                            <div id="error-message"
                                class="hidden bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg flex items-center"
                                aria-live="polite">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="error-text"></span>
                            </div>
                            <div id="success-message"
                                class="hidden bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg flex items-center"
                                aria-live="polite">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="success-text"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
               
                <div class="order-1 lg:order-2">
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-6">Informations de contact</h2>
                            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                Développeur web freelance basé à Rochefort, je vous accompagne dans la réalisation de vos projets. N'hésitez pas à me contacter pour toute question ou demande de devis.
                            </p>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Email</h3>
                                    <p class="text-gray-600">kreyatik@gmail.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Téléphone</h3>
                                    <p class="text-gray-600">+33 6 95 80 06 63</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Adresse</h3>
                                    <p class="text-gray-600">2 Rue du petit port marchand 17300 Rochefort, France</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Horaires d'ouverture</h3>
                            <div class="space-y-2 text-gray-600">
                                <div class="flex justify-between">
                                    <span>Lundi - Vendredi</span>
                                    <span>9h00 - 19h00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Samedi</span>
                                    <span>9h00 - 19h00</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Dimanche</span>
                                    <span>9h00 - 19h00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  
    <section class="faq-section bg-gray-50 py-16 lg:py-24">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Questions fréquentes</h2>
                <p class="text-lg text-gray-600">Trouvez rapidement des réponses à vos questions les plus courantes.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Combien de temps pour recevoir une réponse ?</h3>
                    <p class="text-gray-600">Nous nous engageons à répondre à tous les messages sous 24 heures ouvrables.</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Proposez-vous des consultations gratuites ?</h3>
                    <p class="text-gray-600">Oui, nous offrons une première consultation gratuite pour évaluer vos besoins.</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Quels types de projets réalisez-vous ?</h3>
                    <p class="text-gray-600">Nous travaillons sur tous types de projets web, mobile et digitaux.</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Comment se déroule un projet ?</h3>
                    <p class="text-gray-600">Nous suivons une méthodologie agile avec des étapes claires et une communication régulière.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.contact-input:focus,
.contact-textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.contact-button:hover {
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.form-group {
    position: relative;
}

.form-group label {
    transition: all 0.2s ease;
}

.form-group input:focus + label,
.form-group textarea:focus + label {
    color: #3b82f6;
}

/* Animation pour les messages */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#error-message.show,
#success-message.show {
    animation: slideIn 0.3s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');
    const errorText = document.getElementById('error-text');
    const successText = document.getElementById('success-text');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Masquer les messages précédents
        errorMessage.classList.add('hidden');
        successMessage.classList.add('hidden');
        
        // Récupérer les données du formulaire
        const formData = new FormData(form);
        
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        submitButton.innerHTML = `
            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Envoi en cours...
        `;
        submitButton.disabled = true;
        
        // Envoi AJAX réel au serveur
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                successText.textContent = data.success;
                successMessage.classList.remove('hidden');
                successMessage.classList.add('show');
                form.reset();

                // Track GA4 event
                if (typeof window.trackEvent === 'function') {
                    window.trackEvent('contact_form_submit', {
                        'event_category': 'Contact',
                        'event_label': 'Form Submission Success',
                        'value': 1
                    });
                }

                // Masquer le message de succès après 5 secondes
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                    successMessage.classList.remove('show');
                }, 5000);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            
            let errorMessageText = 'Une erreur est survenue lors de l\'envoi du message.';
            
            // Si c'est une erreur de validation (422)
            if (error.errors) {
                const firstError = Object.values(error.errors)[0];
                errorMessageText = Array.isArray(firstError) ? firstError[0] : firstError;
            } else if (error.error) {
                errorMessageText = error.error;
            } else if (error.message) {
                errorMessageText = error.message;
            }
            
            errorText.textContent = errorMessageText;
            errorMessage.classList.remove('hidden');
            errorMessage.classList.add('show');
            
            // Masquer le message d'erreur après 8 secondes
            setTimeout(() => {
                errorMessage.classList.add('hidden');
                errorMessage.classList.remove('show');
            }, 8000);
        })
        .finally(() => {
            // Restaurer le bouton
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        });
    });
    
    // Animation des champs au focus
    const inputs = document.querySelectorAll('.contact-input, .contact-textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-500', 'ring-opacity-20');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-500', 'ring-opacity-20');
        });
    });
});
</script>

<x-footer />