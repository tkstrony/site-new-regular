<?php namespace ProcessWire;

    /**
     * Name _cookie-scripts-JS
     * @var string $analytics
     * @var string $marketing
     * @var string $toggleLeft
     * @var string $toggleRight
     * @var string $cookieIcon
     * @var string $cookieCloseIcon
     * @var string $cookieInfoIcon
     * @var string $personalData
     * @var string $personalDataLink
     * 
     */

    // get scripts
    $analytics =  _partial('_analytics-JS');
    $marketing = _partial('_marketing-JS');

    // get icons
    $toggleLeft = _icon('toggle-left');
    $toggleRight = _icon('toggle-right');
    $cookieIcon = _icon('cookie');
    $cookieCloseIcon = _icon('x');
    $cookieInfoIcon = _icon('info');

    $personalData = _site()->personalDataPage;
    // $contactPage = _site()->contactPage;
    
    // Personal data page
    $personalDataLink = _htmx([
        'modal' => true,
        'elType' => 'a',
        'href' => '#',
        'text' => $personalData->title,
        'class' => 'link',
    ])->getPage($personalData->id, 'body');

    // translations 
    $strUseCooies = _t('weUseCookies');
    $strNecessary = _t('cookieNecessary');
    $strAnalytics = _t('cookieAnalytics');
    $strMarketing = _t('cookieMarketing');
    $strAcceptAll = _t('cookieAcceptAll');
    $strRejectAll = _t('cookieRejectAll');
    $strInformationSectionDescription = sprintf(_t('cookieInformation'), $personalDataLink);
?>

<div 
    x-data="cookieConsent()" 
    x-init="setTimeout(() => { $el.classList.add('show-banner'); }, 500)"
    id="cookie-consent-scripts" 
    class="cookie-banner card" 
>

    <p class='cookie-header'><?= $strUseCooies ?></p>
   
    <div class="cookie-buttons">
        <button @click="toggleConsent('analytics')" :class="analytics ? '-primary' : '-secondary'">
            <span x-show="!analytics"><small><?= $strAnalytics ?></small> <?= $toggleLeft ?></span>
            <span x-show="analytics"><small><?= $strAnalytics ?></small> <?= $toggleRight ?></span>
        </button>
        <button @click="toggleConsent('marketing')" :class="marketing ? '-primary' : '-secondary'">
            <span x-show="!marketing"><small><?= $strMarketing ?></small> <?= $toggleLeft ?></span>
            <span x-show="marketing"><small><?= $strMarketing ?></small> <?= $toggleRight ?></span>
        </button>

        <button class='-disabled -xs small'><?= $strNecessary . ' ' . $toggleRight ?></button>
    </div>

    <div class="cookie-actions">
        <hr>
        <button class='-primary' @click="acceptAll()"><?= $strAcceptAll; ?></button>
        <button @click="rejectAll()"><?= $strRejectAll; ?></button>
        <hr>
    </div>

    <?= _alpine()->collapse(Html::small($strInformationSectionDescription), $cookieInfoIcon, ['class' => 'cookie-info']) ?>

    <br>
    <!-- Close banner -->
    <button class='close-btn -icon' @click="closeBanner()">
        <span class='' x-show="bannerClosed"><?= $cookieIcon; ?></span>
        <span x-show="!bannerClosed"><?= $cookieCloseIcon; ?></span>
    </button>

    <template x-if="analytics">
        <div id="analytics" x-intersect.once="saveConsent('analytics', true)" x-transition>
            <?= $analytics ?>
        </div>
    </template>

    <template x-if="marketing">
        <div id="marketing" x-intersect.once="saveConsent('marketing', true)" x-transition>
            <?= $marketing ?>
        </div>
    </template>
</div>
<style>
    .cookie-banner {
        margin: var(--sp-2xs);
        margin-bottom: 0;
        opacity: 0;
        position: fixed;
        bottom: 0;
        left: 0;
        background-color: var(--bg-color);
        max-height: 97vh;
        overflow-y: auto;
        z-index: <?= time(); ?>;

        &.show-banner {
            opacity: 1;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        @media (min-width: 48rem) {
            max-width: var(--mw-3xs);
            margin: var(--sp-4xl);
        }
    }

    .cookie-closed-banner .cookie-banner {
        background-color: unset;
        border: unset;
        box-shadow: unset;
        margin: 0;
        margin-left: var(--sp-xl);
        padding: 0;
        .close-btn {
            margin-left: var(--sp-xl);
        }

        .cookie-header, .cookie-actions, .cookie-buttons, .cookie-info  {
            display: none;
        }
    }

    /* .cookie-accept-all .cookie-banner {
        background-color: green; 
    } */

    /* .cookie-reject-all .cookie-banner {
        background-color: red; 
    } */
</style>

<script>
function cookieConsent() {
    return {
        analytics: JSON.parse(localStorage.getItem('analytics')) || false,
        marketing: JSON.parse(localStorage.getItem('marketing')) || false,
        bannerClosed: JSON.parse(localStorage.getItem('bannerClosed')) || false,

        init() {
            this.updateHtmlClasses();
        },

        toggleConsent(type) {
            this[type] = !this[type];
            localStorage.setItem(type, JSON.stringify(this[type]));
            this.updateHtmlClasses();
        },

        acceptAll() {
            this.analytics = true;
            this.marketing = true;
            this.saveAllConsents();
            this.updateHtmlClasses();
        },

        rejectAll() {
            this.analytics = false;
            this.marketing = false;
            this.saveAllConsents();
            this.updateHtmlClasses();
        },

        saveConsent(type, value) {
            localStorage.setItem(type, JSON.stringify(value));
        },

        saveAllConsents() {
            localStorage.setItem('analytics', JSON.stringify(this.analytics));
            localStorage.setItem('marketing', JSON.stringify(this.marketing));
        },

        closeBanner() {
            this.bannerClosed = !this.bannerClosed;
            localStorage.setItem('bannerClosed', JSON.stringify(this.bannerClosed));
            this.updateHtmlClasses();
        },

        updateHtmlClasses() {
            this.showBanner = false;
            const html = document.documentElement;
            // Dodawanie klas w zależności od stanu zgód
            if (this.bannerClosed) {
                html.classList.add('cookie-closed-banner');
            } else {
                html.classList.remove('cookie-closed-banner');
            }

            if (this.analytics && this.marketing) {
                html.classList.add('cookie-accept-all');
                html.classList.remove('cookie-reject-all');
            } else if (!this.analytics && !this.marketing) {
                html.classList.add('cookie-reject-all');
                html.classList.remove('cookie-accept-all');
            }
        }
    };
}
</script>
