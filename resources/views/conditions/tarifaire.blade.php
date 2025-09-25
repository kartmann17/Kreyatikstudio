<x-header />

<main class="min-h-screen">
  <!-- Hero Section -->
  <section class="relative pt-20 md:pt-28 pb-12 md:pb-20 overflow-hidden" style="background: linear-gradient(135deg, #0099CC, #00A86B);" aria-labelledby="conditions-title">
    <div class="absolute inset-0">
      <img src="{{ asset('images/compose.png') }}" alt="Conditions Tarifaires - Kréyatik Studio" class="w-full h-full object-cover opacity-10" loading="eager" width="1920" height="1080">
    </div>
    <div class="relative container max-w-6xl mx-auto px-4 md:px-6">
      <div class="text-center text-white">
        <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 md:px-6 py-2 md:py-3 mb-4 md:mb-6" aria-label="Badge conditions tarifaires">
          <span class="text-white font-medium text-sm md:text-base">💰 Conditions Tarifaires</span>
        </div>
        <h1 id="conditions-title" class="text-3xl md:text-4xl lg:text-6xl font-bold mb-4 md:mb-6">
          <span class="block">Modalités</span>
          <span class="block text-yellow-300">& Tarifs</span>
        </h1>
        <p class="text-lg md:text-xl lg:text-2xl text-white/90 max-w-3xl mx-auto px-4">
          Découvrez nos conditions tarifaires transparentes et nos modalités de paiement flexibles
        </p>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="py-12 md:py-20 bg-white">
    <div class="container max-w-6xl mx-auto px-4 md:px-6">

      <!-- Modalités de Paiement -->
      <div class="mb-12 md:mb-20">
        <div class="text-center mb-8 md:mb-12">
          <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 md:mb-4">Modalités de Paiement</h2>
          <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">Choisissez la formule de paiement qui vous convient le mieux</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-4xl mx-auto">
          <!-- Option Abonnement -->
          <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 md:p-8 border border-blue-100">
            <div class="flex items-center mb-4 md:mb-6">
              <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-3 md:mr-4">
                <i class="fas fa-calendar-alt text-blue-600 text-lg md:text-xl"></i>
              </div>
              <h3 class="text-xl md:text-2xl font-bold text-gray-900">Abonnement Mensuel</h3>
            </div>
            <div class="space-y-4 text-gray-700">
              <div class="flex items-start">
                <i class="fas fa-check text-blue-600 mt-1 mr-3"></i>
                <span>Engagement minimum de <strong>24 mois</strong></span>
              </div>
              <div class="flex items-start">
                <i class="fas fa-check text-blue-600 mt-1 mr-3"></i>
                <span>Prélèvement automatique mensuel</span>
              </div>
              <div class="flex items-start">
                <i class="fas fa-check text-blue-600 mt-1 mr-3"></i>
                <span>Premier mois payable à la commande</span>
              </div>
            </div>
          </div>

          <!-- Option Paiement Unique -->
          <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 md:p-8 border border-green-100">
            <div class="flex items-center mb-4 md:mb-6">
              <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center mr-3 md:mr-4">
                <i class="fas fa-credit-card text-green-600 text-lg md:text-xl"></i>
              </div>
              <h3 class="text-xl md:text-2xl font-bold text-gray-900">Paiement Unique</h3>
            </div>
            <div class="space-y-4 text-gray-700">
              <div class="flex items-start">
                <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                <span>Acompte de <strong>30%</strong> à la validation</span>
              </div>
              <div class="flex items-start">
                <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                <span>Paiement échelonné par phases</span>
              </div>
              <div class="flex items-start">
                <i class="fas fa-check text-green-600 mt-1 mr-3"></i>
                <span>Solde à la livraison finale</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Grille Tarifaire -->
      <div class="mb-12 md:mb-20">
        <div class="text-center mb-8 md:mb-12">
          <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3 md:mb-4">Grille Tarifaire</h2>
          <p class="text-lg md:text-xl text-gray-600 px-4">Nos offres détaillées avec les pages supplémentaires</p>
        </div>

        <div class="space-y-4 md:space-y-6">
          @if(isset($pricingPlans) && $pricingPlans->count() > 0)
            @foreach($pricingPlans as $index => $plan)
              @php
                $gradientColors = [
                  0 => 'from-yellow-400 to-orange-500',
                  1 => 'from-blue-500 to-purple-600',
                  2 => 'from-purple-600 to-pink-600'
                ];
                $iconColors = [
                  0 => 'text-orange-500',
                  1 => 'text-blue-500',
                  2 => 'text-purple-500'
                ];
                $icons = [
                  0 => 'fas fa-star',
                  1 => 'fas fa-chart-line',
                  2 => 'fas fa-crown'
                ];
                $gradientClass = $gradientColors[$index] ?? 'from-gray-500 to-gray-600';
                $iconColorClass = $iconColors[$index] ?? 'text-gray-500';
                $iconClass = $icons[$index] ?? 'fas fa-tags';
              @endphp
              <div class="bg-white rounded-2xl border border-gray-200 shadow-lg p-6 md:p-8 hover:shadow-xl transition-shadow duration-300 {{ $plan->is_highlighted ? 'ring-2 ring-yellow-400' : '' }}">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4 md:mb-6">
                  <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br {{ $gradientClass }} rounded-2xl flex items-center justify-center mr-4 md:mr-6">
                      <i class="{{ $iconClass }} text-white text-xl md:text-2xl"></i>
                    </div>
                    <div>
                      <h3 class="text-xl md:text-2xl font-bold text-gray-900">{{ $plan->name }}</h3>
                      @if($plan->is_highlighted)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                          <i class="fas fa-crown mr-1"></i>
                          {{ $plan->highlight_text ?: 'Recommandé' }}
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="text-left md:text-right">
                    @if($plan->has_promotion)
                    <div class="mb-2">
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $plan->promotion_text }}
                      </span>
                    </div>
                    @endif

                    <div class="flex flex-col items-end">
                      @if($plan->has_promotion && $plan->original_monthly_price)
                      <div class="text-lg text-gray-400 line-through">{{ number_format((float)$plan->original_monthly_price, 0, ',', ' ') }}€/mois</div>
                      @endif
                      <div class="text-2xl md:text-3xl font-bold text-gray-900">{{ number_format((float)$plan->monthly_price, 0, ',', ' ') }}€<span class="text-base md:text-lg text-gray-500">/mois</span></div>
                    </div>

                    <div class="text-gray-600 mt-1">
                      @if($plan->has_promotion && $plan->original_annual_price)
                      <span class="line-through text-gray-400 mr-2">{{ number_format((float)$plan->original_annual_price, 0, ',', ' ') }}€</span>
                      @endif
                      ou {{ number_format((float)$plan->annual_price, 0, ',', ' ') }}€ en une fois
                    </div>
                    @php
                      $monthlyPrice = is_numeric($plan->monthly_price) ? (float)$plan->monthly_price : 0;
                      $annualPrice = is_numeric($plan->annual_price) ? (float)$plan->annual_price : 0;
                      $annualSavings = ($monthlyPrice * 12) - $annualPrice;
                    @endphp
                    @if($annualSavings > 0)
                      <div class="text-sm text-green-600 font-medium">
                        Économie: {{ number_format($annualSavings, 0, ',', ' ') }}€
                      </div>
                    @endif
                  </div>
                </div>
                <div class="space-y-6 md:grid md:grid-cols-2 md:gap-6 md:space-y-0">
                  <div>
                    <h4 class="font-semibold text-gray-800 mb-2">Inclus :</h4>
                    @if($plan->features && count($plan->features) > 0)
                      <ul class="space-y-2 text-gray-600">
                        @foreach($plan->features as $feature)
                          <li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1 flex-shrink-0"></i><span>{{ $feature }}</span></li>
                        @endforeach
                      </ul>
                    @else
                      <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1 flex-shrink-0"></i><span>Design responsive</span></li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1 flex-shrink-0"></i><span>Hébergement 1 an</span></li>
                        <li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1 flex-shrink-0"></i><span>Support client</span></li>
                      </ul>
                    @endif
                  </div>
                  <div>
                    <h4 class="font-semibold text-gray-800 mb-2">{{ $plan->is_custom_plan ? 'Tarification :' : 'Pages supplémentaires :' }}</h4>
                    @if($plan->is_custom_plan)
                      <div class="text-xl md:text-2xl font-bold {{ $iconColorClass }}">Sur devis</div>
                      <p class="text-sm text-gray-500">{{ $plan->custom_plan_text ?: 'Selon vos besoins spécifiques' }}</p>
                    @else
                      @php
                        $additionalPagesPricing = [
                          0 => '50€ à 200€',
                          1 => '100€ à 350€',
                          2 => '150€ à 500€'
                        ];
                        $pricingText = $additionalPagesPricing[$index] ?? '100€ à 300€';
                      @endphp
                      <div class="text-xl md:text-2xl font-bold {{ $iconColorClass }}">{{ $pricingText }}</div>
                      <p class="text-sm text-gray-500">selon la complexité</p>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <!-- Fallback vers les offres codées en dur si aucun plan n'est trouvé -->
            <div class="text-center py-8">
              <p class="text-gray-600">Nos offres sont en cours de mise à jour. Contactez-nous pour plus d'informations.</p>
            </div>
          @endif
        </div>
      </div>

      <!-- Services & Maintenance -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 mb-12 md:mb-20">
        <!-- Services Inclus -->
        <div class="bg-gray-50 rounded-2xl p-6 md:p-8">
          <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
            <i class="fas fa-cogs text-blue-600 mr-2 md:mr-3"></i>
            Services Inclus
          </h3>
          <ul class="space-y-3 text-gray-700">
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Design responsive et moderne</li>
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Nom de domaine (1 an)</li>
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Hébergement sécurisé (1 an)</li>
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Optimisation SEO de base</li>
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Maintenance technique</li>
            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>Accompagnement client</li>
          </ul>
        </div>

        <!-- Maintenance & Renouvellement -->
        <div class="bg-gray-50 rounded-2xl p-6 md:p-8">
          <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
            <i class="fas fa-tools text-purple-600 mr-2 md:mr-3"></i>
            Maintenance Annuelle
          </h3>
          <div class="space-y-4">
            @if(isset($pricingPlans) && $pricingPlans->count() > 0)
              @foreach($pricingPlans as $plan)
                <div class="flex justify-between items-center py-2 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                  <span class="font-medium">{{ $plan->name }}</span>
                  @if($plan->is_custom_plan)
                    <span class="text-sm text-gray-600">Sur devis</span>
                  @else
                    @php
                      // Calcul approximatif du coût de maintenance (8% du prix mensuel)
                      $monthlyPrice = is_numeric($plan->monthly_price) ? (float)$plan->monthly_price : 0;
                      $maintenancePrice = round($monthlyPrice * 0.08, 2);
                    @endphp
                    <span class="text-lg font-bold text-gray-900">{{ number_format($maintenancePrice, 2) }}€/mois</span>
                  @endif
                </div>
              @endforeach
            @else
              <!-- Fallback vers les prix codés en dur -->
              <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="font-medium">Starter</span>
                <span class="text-lg font-bold text-gray-900">19,99€/mois</span>
              </div>
              <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="font-medium">Business</span>
                <span class="text-lg font-bold text-gray-900">39,99€/mois</span>
              </div>
              <div class="flex justify-between items-center py-2 border-b border-gray-200">
                <span class="font-medium">Premium</span>
                <span class="text-lg font-bold text-gray-900">49,99€/mois</span>
              </div>
              <div class="flex justify-between items-center py-2">
                <span class="font-medium">Sur-mesure</span>
                <span class="text-sm text-gray-600">Sur devis</span>
              </div>
            @endif
          </div>
          <p class="text-sm text-gray-600 mt-4">
            <i class="fas fa-info-circle mr-2"></i>
            Facturé après la première année
          </p>
        </div>
      </div>

      <!-- Informations Importantes -->
      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 md:p-8 mb-12 md:mb-20">
        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
          <i class="fas fa-info-circle text-blue-600 mr-2 md:mr-3"></i>
          Informations Importantes
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <ul class="space-y-3 text-gray-700">
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Phase de maquette obligatoire avant développement</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Modifications après validation = surcoût</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Logo fourni par le client (HD)</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Textes et images à fournir</li>
          </ul>
          <ul class="space-y-3 text-gray-700">
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Rédaction article SEO en supplément</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>SEA Google Ads en option</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Délai selon complexité et réactivité</li>
            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-3"></i>Sous-pages comptent comme pages supplémentaires</li>
          </ul>
        </div>
      </div>

      <!-- Conditions d'Annulation -->
      <div class="bg-red-50 border border-red-200 rounded-2xl p-6 md:p-8">
        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-6 flex items-center">
          <i class="fas fa-exclamation-triangle text-red-600 mr-2 md:mr-3"></i>
          Conditions d'Annulation
        </h3>
        <div class="space-y-4 text-gray-700">
          <div class="bg-white rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Annulation avant livraison</h4>
            <p>Les acomptes restent acquis à Kréyatik Studio au titre des travaux déjà engagés.</p>
          </div>
          <div class="bg-white rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Résiliation anticipée d'abonnement</h4>
            <p>Les mensualités restantes seront dues jusqu'à la fin de la période d'engagement contractuelle.</p>
          </div>
          <div class="bg-white rounded-lg p-4">
            <h4 class="font-semibold text-gray-800 mb-2">Non-paiement</h4>
            <p>Le site pourra être mis hors ligne sans préavis jusqu'à régularisation de la situation.</p>
          </div>
        </div>

        <div class="mt-6 p-4 bg-gray-100 rounded-lg">
          <p class="text-sm text-gray-600">
            <i class="fas fa-info-circle mr-2"></i>
            Ces conditions peuvent être modifiées. La version en vigueur est celle consultable sur le site au moment de la commande.
            Pour toute question, <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-800 font-medium">contactez-nous</a>.
          </p>
        </div>
      </div>

    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-12 md:py-20" style="background: linear-gradient(135deg, #0099CC, #00A86B);">
    <div class="container max-w-4xl mx-auto px-4 md:px-6 text-center">
      <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4 md:mb-6">
        Prêt à démarrer votre projet ?
      </h2>
      <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto">
        Contactez-nous pour un devis personnalisé et gratuit adapté à vos besoins spécifiques
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg sm:max-w-none mx-auto">
        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-white text-blue-600 font-bold rounded-xl hover:bg-gray-50 transition-colors duration-300 shadow-lg text-sm md:text-base">
          <i class="fas fa-envelope mr-2"></i>
          Demander un devis
        </a>
        <a href="{{ route('nos-offres') }}" class="inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-transparent text-white border-2 border-white font-bold rounded-xl hover:bg-white hover:text-blue-600 transition-colors duration-300 text-sm md:text-base">
          <i class="fas fa-eye mr-2"></i>
          Voir les offres
        </a>
      </div>
    </div>
  </section>
</main>

<x-footer />