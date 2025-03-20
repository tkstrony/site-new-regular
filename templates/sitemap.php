<?php namespace ProcessWire; 

// Template file for pages using the “sitemap” template
// -------------------------------------------------------
?>

<div id="content-body" pw-append>
	<?= _pageBlocks(page()) ?>
    <?= renderNavTree(_home(), 4); ?> 
</div>	

