<x-header :seoData="$SEOData ?? null">
<x-slot name="slot">
<main class="main-page">

  <!-- Hero Section avec le même style que welcome.blade.php -->
  <section class="hero-section" aria-labelledby="contest-hero-title">
    <div class="hero-background">
      <img src="{{ asset('images/compose.png') }}" alt="Concours Kreyatik Studio" class="hero-bg-image" loading="eager" width="1920" height="1080">
      <div class="hero-overlay"></div>
      <div class="hero-particles"></div>
    </div>

    <div class="hero-container" style="text-align: center;">
      <!-- Badge du concours -->
      <div class="contest-badge" style="display: inline-block; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 12px 24px; border-radius: 50px; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
        <span style="font-size: 1.1rem; font-weight: 700; background: linear-gradient(135deg, #0f172a 0%, #334155 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
          🎉 CONCOURS EN COURS
        </span>
      </div>

      <h1 style="font-size: 3.5rem; font-weight: 900; margin-bottom: 1.5rem; color: white; text-shadow: 0 2px 20px rgba(0,0,0,0.3), 0 0 40px rgba(15, 23, 42, 0.5); line-height: 1.2;">
        Gagne Ton Site Web<br>
        <span style="color: #60a5fa; text-shadow: 0 0 30px rgba(59, 130, 246, 0.8), 0 0 60px rgba(59, 130, 246, 0.5), 0 2px 20px rgba(0,0,0,0.3);">Pro !</span>
      </h1>

      <!-- Compte à rebours -->
      <div style="margin: 2rem 0;">
        <div style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">
          <div style="font-size: 1rem; color: #3b82f6; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; text-align: center;">⏰ Temps restant</div>

          <!-- Compteur -->
          <div id="countdown" style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px;">
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); padding: 20px; border-radius: 12px; min-width: 100px; text-align: center;">
              <div id="days" style="font-size: 2.5rem; font-weight: 900; color: white; line-height: 1;">0</div>
              <div style="font-size: 0.75rem; color: rgba(255,255,255,0.9); text-transform: uppercase; margin-top: 5px; font-weight: 600;">Jours</div>
            </div>
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); padding: 20px; border-radius: 12px; min-width: 100px; text-align: center;">
              <div id="hours" style="font-size: 2.5rem; font-weight: 900; color: white; line-height: 1;">0</div>
              <div style="font-size: 0.75rem; color: rgba(255,255,255,0.9); text-transform: uppercase; margin-top: 5px; font-weight: 600;">Heures</div>
            </div>
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); padding: 20px; border-radius: 12px; min-width: 100px; text-align: center;">
              <div id="minutes" style="font-size: 2.5rem; font-weight: 900; color: white; line-height: 1;">0</div>
              <div style="font-size: 0.75rem; color: rgba(255,255,255,0.9); text-transform: uppercase; margin-top: 5px; font-weight: 600;">Minutes</div>
            </div>
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); padding: 20px; border-radius: 12px; min-width: 100px; text-align: center;">
              <div id="seconds" style="font-size: 2.5rem; font-weight: 900; color: white; line-height: 1;">0</div>
              <div style="font-size: 0.75rem; color: rgba(255,255,255,0.9); text-transform: uppercase; margin-top: 5px; font-weight: 600;">Secondes</div>
            </div>
          </div>

          <!-- Période et résultat -->
          <div style="text-align: center; border-top: 2px solid #e2e8f0; padding-top: 20px;">
            <div style="font-size: 0.95rem; color: #64748b; margin-bottom: 8px;">
              📅 <strong>Période du concours :</strong> 13 octobre - 13 novembre 2025
            </div>
            <div style="font-size: 0.95rem; color: #64748b;">
              🏆 <strong>Résultat :</strong> 17 novembre 2025
            </div>
          </div>
        </div>
      </div>

      <p style="font-size: 1.3rem; color: white; max-width: 700px; margin: 2rem auto; text-shadow: 0 2px 10px rgba(0,0,0,0.3); line-height: 1.6;">
        Tentez votre chance pour remporter la <strong>création complète</strong> de votre site web professionnel par Kreyatik Studio !
      </p>

      <!-- Bouton Instagram -->
      <div style="margin-top: 2.5rem;">
        <a href="https://www.instagram.com/kreyatik_17/" target="_blank" rel="noopener noreferrer"
           class="instagram-btn"
           style="display: inline-flex; align-items: center; gap: 12px; background: linear-gradient(135deg, #E1306C 0%, #C13584 100%); color: white; padding: 16px 35px; border-radius: 50px; text-decoration: none; font-weight: 700; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(225, 48, 108, 0.4);">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
          </svg>
          Suivez-nous sur Instagram
        </a>
      </div>
    </div>
  </section>

  <!-- Formulaire avec le même style que welcome.blade.php -->
  <section class="contact-section" id="contest-form" style="padding: 60px 20px; background: var(--bg-light, #f8f9fa);">
    <div class="container" style="max-width: 900px; margin: 0 auto;">

      <div class="section-header" style="text-align: center; margin-bottom: 3rem;">
        <span class="section-badge" style="display: inline-block; background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white; padding: 8px 20px; border-radius: 50px; font-size: 0.9rem; font-weight: 600; margin-bottom: 1rem;">🎯 Formulaire de Participation</span>
        <h2 class="section-title" style="font-size: 2.5rem; font-weight: 800; color: var(--text-dark, #1e293b); margin-bottom: 1rem;">Participez au Concours</h2>
        <p class="section-description" style="font-size: 1.1rem; color: var(--text-muted, #64748b); max-width: 600px; margin: 0 auto;">
          Remplissez le formulaire ci-dessous pour tenter de gagner la création de votre site web professionnel !
        </p>
      </div>

      @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 20px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #28a745; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
          <strong>✅ Succès !</strong> {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 20px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #dc3545; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
          <strong>❌ Erreur !</strong> {{ session('error') }}
        </div>
      @endif

      <div class="contact-form-container" style="background: white; padding: 50px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
        <form action="{{ route('concours.store') }}" method="POST" class="contact-form" style="display: flex; flex-direction: column; gap: 25px;">
          @csrf

          <!-- Champs cachés UTM -->
          <input type="hidden" name="utm_source" value="{{ $utm_source ?? '' }}">
          <input type="hidden" name="utm_medium" value="{{ $utm_medium ?? '' }}">
          <input type="hidden" name="utm_campaign" value="{{ $utm_campaign ?? '' }}">

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Nom / Prénom -->
            <div class="form-group">
              <label for="nom_prenom" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Nom / Prénom <span style="color: #dc3545;">*</span>
              </label>
              <input type="text" id="nom_prenom" name="nom_prenom" value="{{ old('nom_prenom') }}" required
                     class="form-input" placeholder="Votre nom complet"
                     style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
              @error('nom_prenom')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="email" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Email <span style="color: #dc3545;">*</span>
              </label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required
                     class="form-input" placeholder="votre@email.com"
                     style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
              @error('email')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Téléphone -->
            <div class="form-group">
              <label for="telephone" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Téléphone
              </label>
              <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}"
                     class="form-input" placeholder="06 00 00 00 00"
                     style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
              @error('telephone')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>

            <!-- Statut -->
            <div class="form-group">
              <label for="statut" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Statut <span style="color: #dc3545;">*</span>
              </label>
              <select id="statut" name="statut" required
                      class="form-input"
                      style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
                <option value="">Sélectionnez votre statut</option>
                <option value="Indépendant" {{ old('statut') == 'Indépendant' ? 'selected' : '' }}>Indépendant</option>
                <option value="Auto-entrepreneur" {{ old('statut') == 'Auto-entrepreneur' ? 'selected' : '' }}>Auto-entrepreneur</option>
                <option value="TPE/PME" {{ old('statut') == 'TPE/PME' ? 'selected' : '' }}>TPE/PME</option>
                <option value="Association" {{ old('statut') == 'Association' ? 'selected' : '' }}>Association</option>
              </select>
              @error('statut')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Activité -->
          <div class="form-group">
            <label for="activite" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
              Activité <span style="color: #dc3545;">*</span>
            </label>
            <input type="text" id="activite" name="activite" value="{{ old('activite') }}" required
                   class="form-input" placeholder="Ex: Plomberie, Coach sportif, Restaurant..."
                   style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
            @error('activite')
              <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
          </div>

          <!-- Vos besoins -->
          <div class="form-group">
            <label class="form-label" style="display: block; font-weight: 600; margin-bottom: 12px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
              Vos besoins <span style="color: #dc3545;">*</span>
            </label>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
              @foreach(['Site vitrine', 'Refonte', 'Réservation en ligne', 'Portfolio', 'Prise de RDV', 'Blog'] as $besoin)
                <label style="display: flex; align-items: center; gap: 10px; padding: 12px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 8px; cursor: pointer; transition: all 0.3s;">
                  <input type="checkbox" name="besoins[]" value="{{ $besoin }}" {{ is_array(old('besoins')) && in_array($besoin, old('besoins')) ? 'checked' : '' }}
                         style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;">
                  <span style="font-size: 0.95rem;">{{ $besoin }}</span>
                </label>
              @endforeach
            </div>
            @error('besoins')
              <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Budget estimé -->
            <div class="form-group">
              <label for="budget" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Budget estimé <span style="color: #dc3545;">*</span>
              </label>
              <select id="budget" name="budget" required
                      class="form-input"
                      style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
                <option value="">Sélectionnez un budget</option>
                <option value="< 500€" {{ old('budget') == '< 500€' ? 'selected' : '' }}>< 500€</option>
                <option value="500–1 000€" {{ old('budget') == '500–1 000€' ? 'selected' : '' }}>500–1 000€</option>
                <option value="1 000–2 000€" {{ old('budget') == '1 000–2 000€' ? 'selected' : '' }}>1 000–2 000€</option>
                <option value="> 2 000€" {{ old('budget') == '> 2 000€' ? 'selected' : '' }}>> 2 000€</option>
              </select>
              @error('budget')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>

            <!-- Deadline souhaitée -->
            <div class="form-group">
              <label for="deadline" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
                Deadline souhaitée <span style="color: #dc3545;">*</span>
              </label>
              <select id="deadline" name="deadline" required
                      class="form-input"
                      style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;">
                <option value="">Sélectionnez une deadline</option>
                <option value="ASAP" {{ old('deadline') == 'ASAP' ? 'selected' : '' }}>Immédiatement</option>
                <option value="1–2 mois" {{ old('deadline') == '1–2 mois' ? 'selected' : '' }}>1–2 mois</option>
                <option value="3+ mois" {{ old('deadline') == '3+ mois' ? 'selected' : '' }}>3+ mois</option>
              </select>
              @error('deadline')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Message -->
          <div class="form-group">
            <label for="message" class="form-label" style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark, #1e293b); font-size: 0.95rem;">
              Message
            </label>
            <textarea id="message" name="message" rows="5"
                      class="form-textarea" placeholder="Parlez-nous de votre projet..."
                      style="width: 100%; padding: 14px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; resize: vertical; transition: all 0.3s;">{{ old('message') }}</textarea>
            @error('message')
              <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block;">{{ $message }}</span>
            @enderror
          </div>

          <!-- Consentements -->
          <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border-left: 4px solid #3b82f6;">
            <div style="margin-bottom: 15px;">
              <label style="display: flex; align-items: start; gap: 12px; cursor: pointer;">
                <input type="checkbox" name="consent_rgpd" value="1" required {{ old('consent_rgpd') ? 'checked' : '' }}
                       style="width: 20px; height: 20px; margin-top: 2px; cursor: pointer; flex-shrink: 0; accent-color: #3b82f6;">
                <span style="font-size: 0.95rem; color: var(--text-dark, #1e293b);">
                  J'accepte le traitement de mes données pour la gestion du concours. <span style="color: #dc3545;">*</span>
                </span>
              </label>
              @error('consent_rgpd')
                <span style="color: #dc3545; font-size: 0.875rem; margin-top: 4px; display: block; margin-left: 32px;">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label style="display: flex; align-items: start; gap: 12px; cursor: pointer;">
                <input type="checkbox" name="opt_in_marketing" value="1" {{ old('opt_in_marketing') ? 'checked' : '' }}
                       style="width: 20px; height: 20px; margin-top: 2px; cursor: pointer; flex-shrink: 0; accent-color: #3b82f6;">
                <span style="font-size: 0.95rem; color: var(--text-dark, #1e293b);">
                  Je souhaite recevoir des offres & conseils.
                </span>
              </label>
            </div>
          </div>

          <!-- Bouton de soumission -->
          <button type="submit" class="btn btn-primary btn-full"
                  style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white; padding: 18px 40px; border: none; border-radius: 12px; font-size: 1.15rem; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(59, 130, 246, 0.3); display: flex; align-items: center; justify-content: center; gap: 10px;">
            <span>🎯 Participer au concours</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 20px; height: 20px;">
              <line x1="22" y1="2" x2="11" y2="13" />
              <polygon points="22,2 15,22 11,13 2,9 22,2" />
            </svg>
          </button>
        </form>
      </div>
    </div>
  </section>

</main>
</x-slot>
</x-header>

<x-footer />

<style>
/* Animation du badge */
@keyframes pulse-badge {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  }
  50% {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4);
  }
}

.contest-badge {
  animation: pulse-badge 2s ease-in-out infinite;
}

/* Effet sur la date box */
.date-box {
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* Focus states pour l'accessibilité */
.form-input:focus,
.form-textarea:focus {
  outline: none;
  border-color: #3b82f6 !important;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Hover sur les checkboxes */
label:has(input[type="checkbox"]):hover {
  background: #eff6ff !important;
  border-color: #3b82f6 !important;
}

/* Hover sur le bouton Instagram */
.instagram-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 30px rgba(225, 48, 108, 0.5);
}

/* Hover sur le bouton de soumission */
button[type="submit"]:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 30px rgba(59, 130, 246, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
  .hero-section h1 {
    font-size: 2rem !important;
  }

  .date-box {
    min-width: 100% !important;
  }

  .form-row {
    grid-template-columns: 1fr !important;
  }

  .contact-form-container {
    padding: 30px 20px !important;
  }

  #countdown > div {
    min-width: 80px !important;
    padding: 15px !important;
  }

  #countdown > div > div:first-child {
    font-size: 2rem !important;
  }
}
</style>

<script>
// Compte à rebours
function updateCountdown() {
  // Date de fin du concours : 13 novembre 2025 à 23:59:59
  const endDate = new Date('2025-11-13T23:59:59').getTime();
  const now = new Date().getTime();
  const distance = endDate - now;

  if (distance < 0) {
    // Le concours est terminé
    document.getElementById('days').textContent = '0';
    document.getElementById('hours').textContent = '0';
    document.getElementById('minutes').textContent = '0';
    document.getElementById('seconds').textContent = '0';
    return;
  }

  // Calculs pour les jours, heures, minutes et secondes
  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Mise à jour de l'affichage
  document.getElementById('days').textContent = days;
  document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
  document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
  document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

// Mise à jour immédiate
updateCountdown();

// Mise à jour toutes les secondes
setInterval(updateCountdown, 1000);
</script>
