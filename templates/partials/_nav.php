<?php namespace ProcessWire;

/**
 * Name _nav
 * @var string $id
 * @var HomePage $home
 * @var HelperChat $chat
 */

// get homepage
$home = _home();

// links
$links = navList($home->and($home->children),[
    'childLimit' => 12,
    'openOnMouseOver' => false,
    'hideOnMouseLeave' => false,
    // 'disableChildID' => [1047],
    'disableChildTemplate' => ['blog','basic-page']
]);

// multi language links
$languageLinks = languageLinks(page());

// load search form component
$searchForm = _htmx([
    'modal' => true,
    'text' => _icon('magnifying-glass'),
    'aria-label' => 'searchForm',
    'class' => '-icon',
])->getPartial('_searchForm');

// icons
$iconRSS = _icon('rss');

// set hx boost
$hxBoost = _hxBoost();

// content
echo <<<HTML
<nav 
    x-data="{ 
        open: false, 
        mobile: window.matchMedia('(max-width: 767px)').matches,
        checkMobile() { 
            this.mobile = window.matchMedia('(max-width: 767px)').matches;
            if (!this.mobile) this.open = false;
        }
    }" 
    x-init="window.matchMedia('(max-width: 767px)').addEventListener('change', () => checkMobile())"
    @scroll.window="open = false" 
    @click.outside="open = false" 
    id="{$id}" 
    :class="open && mobile ? 'overlay' : ''"  
    class="{$class}"
>

    <button @click="open = !open" class="mobileBtn hdrom -bg-none" aria-label="Mobile button trigger">
        <span :class="open ? 'opened' : ''" x-text="!open ? '&#x1F3AF;' : '&#10006;'"></span>
    </button>

    <ul :class="{ 'dn': !open }" class="navLinks outline -sm dn" {$hxBoost}>

        {$links}

        <li class='custom-links'>

        <!-- CHAT -->
            {$chat}

            <!-- SEARCH FORM -->
            {$searchForm}

            <!-- RSS -->
            <a class='rss' hx-boost='false' title='RSS' href='{$home->url}rss.xml'>
                {$iconRSS}
            </a>

            <!-- Multi Language Links -->
            {$languageLinks}
        </li>

    </ul>
</nav>
HTML;
