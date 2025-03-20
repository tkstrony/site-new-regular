<?php namespace ProcessWire;

/**
 * @var Site $site
 * @var string $content
 * @var string $logo
 * @var string $favicon
 * @var string $siteName
 * @var string $protocol	
 */

if(page()->id != _home()) session()->redirect(_home()->url, 301);

// gest site
$site = _site();

// reset variables
$logo = '';
$favicon = '';

// site name
$siteName = $site->name;

//  Favicon
if($site?->favicon) {
	$favicon = "<link rel='icon' type='image/{$site->favicon->ext}' href='{$site->favicon->url}'>
	<link rel='apple-touch-icon' type='image/{$site->favicon->ext}' href='{$site->favicon->url}'>\n";
}
// Logo
if($site->logo && $site->logo?->url) {
	$logo = "<img class='logo _{$site->logo->ext}' title='$siteName' src='{$site->logo->url}' style='width: 70px; height: 100%; object-fit: cover;'>";
}

// Set protocol
$protocol = 'HTTP/1.0';
if ( $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' ) {
	$protocol = 'HTTP/1.1';
}
// Set status
header( $protocol . ' 503 Service Unavailable', true, 503 );
header( 'Retry-After: 3600' );
?>

<!doctype html>
<html id='html' lang="<?= _t('htmlLang'); ?>">
<head id='html-head'>
	<link rel="stylesheet" href="<?= urls()->templates ?>assets/site.min.css">
	<script src=""></script>
	<link rel="stylesheet" href="<?= urls()->templates ?>assets/external.min.js">
	<?= (new Fonts)->render(); // Load fonts from the assets/fonts directory ?>
	<title><?= _t('disabled') ?></title>
	<?= $favicon ?>
	<style>
		html, body {
			height: 100%;
			display: grid;
			justify-content: center;
			align-items: center;
			font-size: 16px;
		}
	</style>
</head>
	<body>
		<main>
			<a class='brand' href='#'>
				<?= $logo ?>
				<?= $siteName ?>
			</a>
			<h3><?= _t('maintenance') ?></h3>
			<?php if($content) echo $content; ?>
		</main>
		<br>

		<footer>
			<?= (new ColorMode('system'))->render(); ?>
		</footer>
	</body>
</html>
