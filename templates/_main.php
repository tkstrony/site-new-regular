<?php namespace ProcessWire;

// Optional main output file, called after rendering page’s template file. 
// This is defined by $config->appendTemplateFile in /site/config.php, and
// is typically used to define and output markup common among most pages.
// 	
// When the Markup Regions feature is used, template files can prepend, append,
// replace or delete any element defined here that has an "id" attribute. 
// https://processwire.com/docs/front-end/output/markup-regions/
	
/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */

/** @var HomePage $home */
$home = _home(); 

/** @var HelperChat $chat */
$chat  = modules()->getModule('HelperChat');
// $chat->welcomeMessage = __('Hi ProcessWire Followers !!!');
// // get page links for chat
// $pageLinks = pages()->find("template!=admin,has_parent!=2,status!=hidden")->each(function($page) { return "$page->title  $page->httpUrl \n"; });
// // Set the system prompt for the chat session ( If you want to change this prompt, you need to start new sessions like incognito mode with new prompt)
// $chat->systemPrompt("You are the guide to ProcessWire CMS this is a starter template for ProcessWire CMS users \n
// and you can talk about this system and related technologies such as PHP, CSS, HTML, JS, 
// if the user wants to talk about other topics, return to the basic topic of ProcessWire. \n 
// You can also direct them to the website pages: \n
// {$pageLinks}");
// set chat
$chat = $chat->render();
?><!DOCTYPE html>
<html id='html' lang="<?= _t('htmlLang'); ?>">
	<head id="html-head">
		<meta charset='UTF-8'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= favicon(_site()->favicon); ?>
		<?= (new Seo())->render($page); ?>
		<?= hreflang($page); ?>
		<?= _externalAssets([],[
			'https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js',
			'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js',
			'https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-clipboard@2.x.x/dist/alpine-clipboard.js',
			'https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js',
			'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
			'https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js',
			'https://unpkg.com/htmx.org@2.0.4',
			'https://unpkg.com/headroom.js@0.12.0/dist/headroom.min.js',
			// 'https://cdn.jsdelivr.net/npm/motion@latest/dist/motion.js',
			// 'https://cdn.jsdelivr.net/gh/bigskysoftware/fixi@0.6.3/fixi.js',
			],['dfOnce' => true]) // download and save files only once if does not exist
		?>
		<?= _siteAssets([
			'__reset.css',
			'_base-var.css',
			'_color-var.css',
			'typography.css',
			'custom-style.css',
			'editor.css',
			'animations.css',
			'pages/*', // for pages
			'el/*', // for Html elements
			'utilities.css',
			'themes/*', // for themes
			],[],['dfOnce' => config()->debug ? false : true]); // if debug = true, update file when page refreshes
		?>
		<?= (new Fonts)->render(); // Load fonts from the assets/fonts directory ?>
		<?= _site()->gvCode; ?>
	</head>

	<body id="body" class='<?= bodyClasses(); ?>'
		x-data="{
			animate(el, animation) {
				el.classList.add(animation);
			}
		}"
	>

		<header id='header' class='header'>
			<p class='brand'>
				<a href='<?= _site()->url ?>' <?= _hxBoost() ?>>
					<span class='site-name'><?= _site()->name; ?></span>
					<?= Html::img(_site()->logo->url,['lozad' => false,'width' => 55,'class' => 'logo']); ?>
				</a>
				<small class='site-description'><?= _site()->description; ?></small>
			</p>
			<?= _partial('_nav',['chat' => $chat]); ?>
		</header>

		<main id='main' class='main mw-xl'>
			<?= breadCrumbs(); ?>

			<div id='hero' class='hero'>
				<?= page()->if('seo.titleTag', Html::h1("{seo.titleTag}", ['class' => 'titleTag outline mw-lg'])); ?>
				<?= page()->if('seo.metaDescription', Html::h2("{seo.metaDescription}", [
					'class' => _isHome() ? ' meta-description card' : 'metaDescription'
				])); ?>
			</div>

			<div id='content-body' class='content-body'>
				<?= _embed(page()->body,['filters' => true]); ?>
			</div>

			<?php if(page()->hasChildren && page()->if("template!=home|blog|categories") ): ?>
				<h3><?= _t('visitMore') ?></h3>
				<ul> 
					<?= page()->children->each("<li><a href='{url}'>{title}</a></li>"); // subnav ?>
				</ul>	
			<?php endif; ?>
		</main>

		<footer id='footer' class='footer'>
		<hr>
			<div id='info-links' class='info-links' <?= _hxBoost() ?>>
				<!-- Contact info -->
				<?php if(page()->id != _site()->contactPage->id) echo _site()->contactInfo(); ?>		
				<!-- Social Profiles -->
				<?= _site()->socialProfiles(); ?>
				<!-- Site Links -->
				 <?= _site()->usefulLinks() ?>
			</div>

			<hr>

			<?= _site()->copyright(); ?>

			<div class='df -ac'>
				<!-- Color Mode // 'system', basic, cool, dark, cyberpunk -->
				<?= (new ColorMode('system'))->render(); ?>
			</div>
		</footer>

		<!-- Scroll top -->
		<a
			href='#html'
			aria-label="Scroll to top"
			x-data='{ toTop: false }'
			@scroll.window="toTop = (window.pageYOffset < 50) ? false : true"
			class='btn -bg-none -xs glowing-corners to-top' :class="toTop ? '' : 'dn'"
		>
			<?= _icon('arrow-circle-up',['size' => 'sm']); ?>
		</a>

		<?= adminActions(); ?>
		<?= debugRegions(); ?>

		<style id='bottom-style'>
			.current a, .current-page-<?= page()->id ?> {
				color: var(--link-selected);
			}
		</style>

		<!-- custom scripts -->
		<?= _partial('_scripts-JS'); // partials/js/_scripts-JS.php ?>

		<!-- Cookie banner -->
		{COOKIE_SCRIPTS}
		
		<?= watchFiles(); // watch files for cahnges ?>
	</body>
</html>