<!-- Modern Cookie Consent Banner -->
<div id="cookieConsent" class="cookie-consent-banner hidden">
    <div class="cookie-content">
        <div class="cookie-text">
            <h3 class="cookie-title">🍪 Nous utilisons des cookies</h3>
            <p class="cookie-description">
                Nous utilisons des cookies pour améliorer votre expérience de navigation, analyser notre trafic et personnaliser le contenu. 
                <a href="/confidentialite" class="cookie-link">En savoir plus</a>
            </p>
        </div>
        <div class="cookie-buttons">
            <button id="cookieReject" class="cookie-btn cookie-btn-reject">
                Refuser
            </button>
            <button id="cookieSettings" class="cookie-btn cookie-btn-settings">
                Paramètres
            </button>
            <button id="cookieAccept" class="cookie-btn cookie-btn-accept">
                Accepter tout
            </button>
        </div>
    </div>
</div>

<!-- Cookie Settings Modal -->
<div id="cookieModal" class="cookie-modal hidden">
    <div class="cookie-modal-content">
        <div class="cookie-modal-header">
            <h2>Paramètres des cookies</h2>
            <button id="cookieModalClose" class="cookie-modal-close">&times;</button>
        </div>
        
        <div class="cookie-modal-body">
            <p class="cookie-modal-intro">
                Vous pouvez choisir quels cookies vous souhaitez accepter. Certains sont nécessaires au fonctionnement du site.
            </p>
            
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <label class="cookie-toggle-label">
                        <input type="checkbox" id="cookieNecessary" checked disabled class="cookie-toggle">
                        <span class="cookie-toggle-slider"></span>
                        <strong>Cookies essentiels</strong>
                    </label>
                </div>
                <p class="cookie-category-desc">Ces cookies sont nécessaires au fonctionnement du site et ne peuvent pas être désactivés.</p>
            </div>
            
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <label class="cookie-toggle-label">
                        <input type="checkbox" id="cookieAnalytics" class="cookie-toggle">
                        <span class="cookie-toggle-slider"></span>
                        <strong>Cookies d'analyse</strong>
                    </label>
                </div>
                <p class="cookie-category-desc">Ces cookies nous aident à comprendre comment vous utilisez notre site pour l'améliorer.</p>
            </div>
            
            <div class="cookie-category">
                <div class="cookie-category-header">
                    <label class="cookie-toggle-label">
                        <input type="checkbox" id="cookieMarketing" class="cookie-toggle">
                        <span class="cookie-toggle-slider"></span>
                        <strong>Cookies marketing</strong>
                    </label>
                </div>
                <p class="cookie-category-desc">Ces cookies sont utilisés pour vous proposer des publicités pertinentes.</p>
            </div>
        </div>
        
        <div class="cookie-modal-footer">
            <button id="cookieModalReject" class="cookie-btn cookie-btn-reject">
                Refuser tout
            </button>
            <button id="cookieModalSave" class="cookie-btn cookie-btn-accept">
                Enregistrer les préférences
            </button>
        </div>
    </div>
</div>

<!-- Cookie Consent Styles -->
<style>
.cookie-consent-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    color: white;
    z-index: 9999;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.3);
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
}

.cookie-consent-banner.show {
    transform: translateY(0);
}

.cookie-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 2rem;
}

@media (max-width: 768px) {
    .cookie-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
        padding: 1rem;
    }
}

.cookie-text {
    flex: 1;
}

.cookie-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    color: #FFD700;
}

.cookie-description {
    margin: 0;
    line-height: 1.5;
    color: #e5e5e5;
}

.cookie-link {
    color: #FFD700;
    text-decoration: underline;
    text-underline-offset: 2px;
}

.cookie-link:hover {
    color: #FFF;
}

.cookie-buttons {
    display: flex;
    gap: 0.75rem;
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .cookie-buttons {
        flex-wrap: wrap;
        justify-content: center;
    }
}

.cookie-btn {
    padding: 0.75rem 1.25rem;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.cookie-btn-accept {
    background: #00A86B;
    color: white;
}

.cookie-btn-accept:hover {
    background: #008a5a;
    transform: translateY(-1px);
}

.cookie-btn-reject {
    background: transparent;
    color: #ccc;
    border: 1px solid #666;
}

.cookie-btn-reject:hover {
    background: #FF6B6B;
    color: white;
    border-color: #FF6B6B;
}

.cookie-btn-settings {
    background: transparent;
    color: #FFD700;
    border: 1px solid #FFD700;
}

.cookie-btn-settings:hover {
    background: #FFD700;
    color: #000;
}

/* Modal Styles */
.cookie-modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(5px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.cookie-modal.show {
    opacity: 1;
    visibility: visible;
}

.cookie-modal-content {
    background: white;
    border-radius: 12px;
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    transform: scale(0.9);
    transition: transform 0.3s ease;
}

.cookie-modal.show .cookie-modal-content {
    transform: scale(1);
}

.cookie-modal-header {
    padding: 1.5rem 1.5rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cookie-modal-header h2 {
    margin: 0;
    color: #333;
    font-size: 1.5rem;
}

.cookie-modal-close {
    background: none;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    color: #666;
    line-height: 1;
}

.cookie-modal-close:hover {
    color: #000;
}

.cookie-modal-body {
    padding: 1.5rem;
}

.cookie-modal-intro {
    color: #666;
    margin-bottom: 1.5rem;
}

.cookie-category {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

.cookie-category:last-child {
    border-bottom: none;
}

.cookie-category-header {
    margin-bottom: 0.5rem;
}

.cookie-toggle-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    gap: 0.75rem;
}

.cookie-toggle-label input[disabled] {
    cursor: not-allowed;
}

.cookie-toggle {
    appearance: none;
    width: 48px;
    height: 24px;
    background: #ccc;
    border-radius: 12px;
    position: relative;
    cursor: pointer;
    transition: background 0.3s ease;
}

.cookie-toggle:checked {
    background: #00A86B;
}

.cookie-toggle:disabled {
    background: #00A86B;
    cursor: not-allowed;
}

.cookie-toggle::before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: white;
    top: 2px;
    left: 2px;
    transition: transform 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.cookie-toggle:checked::before {
    transform: translateX(24px);
}

.cookie-category-desc {
    color: #666;
    font-size: 0.9rem;
    margin: 0;
    line-height: 1.4;
}

.cookie-modal-footer {
    padding: 0 1.5rem 1.5rem;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

@media (max-width: 480px) {
    .cookie-modal-footer {
        flex-direction: column;
    }
}
</style>

<!-- Cookie Consent JavaScript -->
<script>
class CookieConsent {
    constructor() {
        this.cookieName = 'kreyatik_cookie_consent';
        this.consentBanner = document.getElementById('cookieConsent');
        this.modal = document.getElementById('cookieModal');
        
        this.init();
    }
    
    init() {
        // Check if user has already made a choice
        if (!this.hasConsent()) {
            this.showBanner();
        } else {
            this.loadAcceptedServices();
        }
        
        this.bindEvents();
    }
    
    bindEvents() {
        // Banner buttons
        document.getElementById('cookieAccept').addEventListener('click', () => {
            this.acceptAll();
        });
        
        document.getElementById('cookieReject').addEventListener('click', () => {
            this.rejectAll();
        });
        
        document.getElementById('cookieSettings').addEventListener('click', () => {
            this.showModal();
        });
        
        // Modal buttons
        document.getElementById('cookieModalClose').addEventListener('click', () => {
            this.hideModal();
        });
        
        document.getElementById('cookieModalSave').addEventListener('click', () => {
            this.savePreferences();
        });
        
        document.getElementById('cookieModalReject').addEventListener('click', () => {
            this.rejectAll();
            this.hideModal();
        });
        
        // Close modal on backdrop click
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.hideModal();
            }
        });
    }
    
    hasConsent() {
        return localStorage.getItem(this.cookieName) !== null;
    }
    
    getConsent() {
        const consent = localStorage.getItem(this.cookieName);
        return consent ? JSON.parse(consent) : {};
    }
    
    setConsent(preferences) {
        localStorage.setItem(this.cookieName, JSON.stringify({
            ...preferences,
            timestamp: Date.now(),
            version: '1.0'
        }));
    }
    
    showBanner() {
        this.consentBanner.classList.remove('hidden');
        setTimeout(() => {
            this.consentBanner.classList.add('show');
        }, 100);
    }
    
    hideBanner() {
        this.consentBanner.classList.remove('show');
        setTimeout(() => {
            this.consentBanner.classList.add('hidden');
        }, 300);
    }
    
    showModal() {
        // Load current preferences
        const consent = this.getConsent();
        document.getElementById('cookieAnalytics').checked = consent.analytics || false;
        document.getElementById('cookieMarketing').checked = consent.marketing || false;
        
        this.modal.classList.remove('hidden');
        setTimeout(() => {
            this.modal.classList.add('show');
        }, 10);
    }
    
    hideModal() {
        this.modal.classList.remove('show');
        setTimeout(() => {
            this.modal.classList.add('hidden');
        }, 300);
    }
    
    acceptAll() {
        this.setConsent({
            necessary: true,
            analytics: true,
            marketing: true
        });
        
        this.loadAcceptedServices();
        this.hideBanner();
    }
    
    rejectAll() {
        this.setConsent({
            necessary: true,
            analytics: false,
            marketing: false
        });
        
        this.hideBanner();
    }
    
    savePreferences() {
        const preferences = {
            necessary: true,
            analytics: document.getElementById('cookieAnalytics').checked,
            marketing: document.getElementById('cookieMarketing').checked
        };
        
        this.setConsent(preferences);
        this.loadAcceptedServices();
        this.hideModal();
        this.hideBanner();
    }
    
    loadAcceptedServices() {
        const consent = this.getConsent();
        
        // Load Google Analytics if consented
        if (consent.analytics && typeof window.loadGoogleAnalytics === 'function') {
            window.loadGoogleAnalytics();
        }
        
        // Load other services based on consent...
        if (consent.marketing) {
            // Load marketing cookies/pixels
            console.log('Marketing cookies accepted');
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    new CookieConsent();
});
</script>