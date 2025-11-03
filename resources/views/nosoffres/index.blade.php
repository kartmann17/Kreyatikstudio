<x-header :seoData="$SEOData ?? null" />
<main class="site-content" role="main">

    <section class="pricing-section" aria-label="Nos formules d'abonnement">
        <div class="container">

            <header class="hero-header">
                <h1 class="section-title">
                    <span class="highlight-text">Transformez votre vision</span><br>
                    en présence digitale
                </h1>
                <p class="section-subtitle">
                    Des solutions web sur mesure pour propulser votre business.
                    <strong>Plus de 10+ projets réalisés avec succès.</strong>
                </p>


                <div class="trust-indicators" role="complementary" aria-label="Indicateurs de confiance">
                    <div class="trust-item">
                        <span class="trust-icon">⚡</span>
                        <span>Livraison rapide</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">🛡️</span>
                        <span>Support 24/7</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">💎</span>
                        <span>Qualité premium</span>
                    </div>
                </div>
            </header>


            <div class="pricing-cards" role="list" aria-label="Liste des formules disponibles">
                @forelse($pricingPlans as $plan)
                <article class="pricing-card {{ $plan->is_highlighted ? 'highlighted' : '' }}"
                    role="listitem"
                    data-plan="{{ $plan->name }}"
                    data-price="{{ $plan->is_custom_plan ? $plan->monthly_price : $plan->monthly_price . '€/mois' }}"
                    data-full="{{ $plan->is_custom_plan ? $plan->annual_price : $plan->annual_price . '€' }}"
                    aria-label="Formule {{ $plan->name }}">


                    @if($plan->is_highlighted && $plan->highlight_text)
                    <div class="badge" role="status" aria-label="Offre recommandée">
                        <span class="badge-icon">⭐</span>
                        {{ $plan->highlight_text }}
                    </div>
                    @endif


                    <header class="pricing-card-header">
                        <h2 class="plan-title">{{ $plan->name }}</h2>
                        <p class="starting-text font-bold">{{ $plan->starting_text }}</p>
                    </header>


                    <div class="price-section" aria-label="Informations tarifaires">
                        <div class="price-display">
                            @if($plan->has_promotion)
                            <div class="promotion-badge">
                                <span class="promotion-text">{{ $plan->promotion_text }}</span>
                                @if($plan->monthly_discount_percentage > 0)
                                <span class="discount-percentage">-{{ $plan->monthly_discount_percentage }}%</span>
                                @endif
                            </div>
                            @endif
                            
                            <span class="price" aria-label="Prix mensuel">
                                @if($plan->has_promotion && $plan->original_monthly_price)
                                <span class="original-price">{{ number_format($plan->original_monthly_price, 0) }}€</span>
                                @endif
                                {{ $plan->is_custom_plan ? $plan->monthly_price : $plan->monthly_price . '€' }}
                                @if(!$plan->is_custom_plan)
                                <span class="price-period">/mois</span>
                                @endif
                            </span>
                        </div>

                        <p class="see-conditions">
                            <a href="{{ route('conditions-tarifaires') }}" target="_blank" rel="noopener noreferrer"
                               aria-label="Voir les conditions générales de vente">
                                *Voir conditions
                            </a>
                        </p>

                        <p class="alt-price" aria-label="Option de paiement annuel">
                            @if($plan->is_custom_plan)
                            <span class="custom-plan-text">{{ $plan->custom_plan_text }}</span>
                            @else
                            <span class="annual-option">
                                @if($plan->has_promotion && $plan->original_annual_price)
                                <span class="original-annual-price">{{ number_format($plan->original_annual_price, 0) }}€</span>
                                @endif
                                @php
                                    $monthlyPrice = is_numeric($plan->monthly_price) ? (float)$plan->monthly_price : 0;
                                    $annualPrice = is_numeric($plan->annual_price) ? (float)$plan->annual_price : 0;
                                    $total24Months = $monthlyPrice * 24;
                                    $annualSavings = $total24Months - $annualPrice;
                                @endphp
                                @if($annualSavings > 0)
                                <strong>Économisez {{ number_format($annualSavings, 0) }}€</strong><br>
                                @endif
                                ou {{ $plan->annual_price }}€ en une fois
                            </span>
                            @endif
                        </p>
                    </div>


                    <div class="features-section">
                        <h3 class="features-title">Ce qui est inclus :</h3>
                        <ul class="features" role="list" aria-label="Caractéristiques de la formule">
                            @foreach($plan->features as $feature)
                            <li role="listitem" class="feature-item">
                                <span class="feature-text">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>


                    <footer class="card-footer">
                        <div class="btn-wrapper">
                            <button class="btn-subscribe"
                                    onclick="openForm(this)"
                                    aria-label="Souscrire à la formule {{ $plan->name }}"
                                    data-plan="{{ $plan->name }}">
                                <span class="btn-text">{{ $plan->button_text }}</span>
                                <span class="btn-arrow">→</span>
                            </button>
                        </div>


                        <p class="micro-cta">
                            <a href="{{ route('contact') }}" class="contact-link" aria-label="Nous contacter pour plus d'informations">
                                Besoin d'aide ? Contactez-nous
                            </a>
                        </p>
                    </footer>
                </article>
                @empty
                <div class="empty-plans" role="alert">
                    <div class="empty-content">
                        <span class="empty-icon">📋</span>
                        <h3>Aucune offre disponible</h3>
                        <p>Veuillez nous contacter pour plus d'informations sur nos services.</p>
                        <a href="{{ route('contact') }}" class="contact-btn">Nous contacter</a>
                    </div>
                </div>
                @endforelse
            </div>


            <section class="faq-section" aria-label="Questions fréquentes">
                <h2 class="faq-title">Questions fréquentes</h2>
                <div class="faq-grid">
                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Combien de temps pour livrer mon site ?</span>
                            <span class="faq-icon">+</span>
                        </summary>
                        <p class="faq-answer">Nos délais varient selon la complexité : 5-10 jours pour un site vitrine, 15-25 jours pour un e-commerce.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Puis-je modifier mon site après livraison ?</span>
                            <span class="faq-icon">+</span>
                        </summary>
                        <p class="faq-answer">Toutes modifications après validation entraîneront un léger surcoût.</p>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Mon site sera-t-il responsive ?</span>
                            <span class="faq-icon">+</span>
                        </summary>
                        <p class="faq-answer">Absolument ! Tous nos sites sont optimisés mobile, tablette et desktop pour une expérience parfaite.</p>
                    </details>
                </div>
            </section>


            <section class="trust-section" aria-label="Pourquoi nous faire confiance">
                <h2 class="trust-title">Ils nous font confiance</h2>
                <div class="trust-stats">
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <span class="stat-label">Projets réalisés</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Clients satisfaits</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Support disponible</span>
                    </div>
                </div>
            </section>
        </div>
    </section>


    <div class="modal-overlay" id="modal-overlay" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-content">

            <button type="button" onclick="closeForm()"
                    class="modal-close-btn"
                    aria-label="Fermer le formulaire">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>


            <header class="modal-header">
                <h2 id="modal-title" class="modal-title">Souscrire à une offre</h2>
                <p class="modal-subtitle">Remplissez ce formulaire et nous vous recontacterons sous 24h</p>
            </header>

            <!-- Formulaire -->
            <form action="{{ route('send.email') }}" method="POST" id="offerForm" aria-label="Formulaire de souscription">
                @csrf
                <div class="form-fields">

                    <div class="form-group">
                        <label for="input-name" class="form-label">Votre nom *</label>
                        <input type="text" name="name" id="input-name"
                               placeholder="Ex: Jean Dupont" required
                               class="form-input"
                               aria-label="Votre nom">
                    </div>

                    <div class="form-group">
                        <label for="input-email" class="form-label">Votre email *</label>
                        <input type="email" name="email" id="input-email"
                               placeholder="Ex: jean@entreprise.com" required
                               class="form-input"
                               aria-label="Votre email">
                    </div>


                    <input type="hidden" id="inputPlan" name="offre">
                    <input type="hidden" id="inputPrice" name="abonnement">
                    <input type="hidden" id="inputFull" name="paiement_unique">
                    <input type="hidden" name="object_message" value="Demande d'abonnement à une offre">


                    <fieldset class="form-group">
                        <legend class="form-legend">Mode de paiement :</legend>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="paiement" value="Abonnement mensuel" required>
                                <span class="radio-text">
                                    <span class="radio-title">Abonnement mensuel</span>
                                    <span class="radio-desc">Flexibilité maximale</span>
                                </span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="paiement" value="Paiement en une fois">
                                <span class="radio-text">
                                    <span class="radio-title">Paiement en une fois</span>
                                    <span class="radio-desc">Économies selon plan</span>
                                </span>
                            </label>
                        </div>
                    </fieldset>


                    <div class="form-group">
                        <label for="input-message" class="form-label">Détails supplémentaires</label>
                        <textarea name="message" id="input-message"
                                  placeholder="Décrivez votre projet, vos besoins spécifiques..."
                                  rows="4" class="form-textarea"
                                  aria-label="Détails supplémentaires"></textarea>
                    </div>
                </div>


                <div class="modal-actions">
                    <button type="submit" class="btn-submit">
                        <span class="btn-text">Envoyer ma demande</span>
                        <span class="btn-loading hidden">Envoi...</span>
                    </button>
                    <button type="button" class="btn-cancel" onclick="closeForm()">
                        Annuler
                    </button>
                </div>
            </form>

            <div id="error-message" class="message error-message hidden" role="alert"></div>
            <div id="success-message" class="message success-message hidden" role="alert"></div>
        </div>
    </div>
</main>

<x-footer />

<script src="{{ asset('js/nosoffres.js') }}"></script>