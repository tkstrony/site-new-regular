<?php namespace ProcessWire;

/**
 * Name _searchForm
 * @var string $id
 * @var string $itemClassName
 */

$getURL = _setURL('_search-query');
$strSearch = _t('search');

$searchInput = _htmx([
  'id' => "{$id}__input",
  'elType' => 'input',
  'class' => 'input',
  'placeholder' => "{$strSearch}...",
  'type'  => 'search',
  'name'  => 'q',
  'autofocus' => 1,
  'hx-get' => $getURL,  
  'hx-trigger' => 'keyup changed delay:500ms, search',  
  'hx-target' => "#{$id}__results",
  'hx-swap' => 'innerHTML',  
  'hx-confirm' => '',  
  'hx-indicator' => '',  
  'hx-disable' => ''  
])->render();

echo <<<HTML
    <label id='{$id}' class='$itemClassName' for="{$id}__input">
      {$searchInput}
    </label>
    <div id='{$id}__results'></div>
HTML;

// CSS
$style = <<<CSS
    .{$itemClassName} {
        display: flex;
        flex-direction: column;
        align-items: center;
        .content {
            display: flex;
            flex-direction: column;
        }

    }
    #{$itemClassName}__results {
        font-size: var(--fs-xl);
        padding: var(--sp-md);
        display: flex;
        flex-direction: column;
        gap: var(--sp-2xs);
    }
CSS;

// set region
echo _globalRegion($itemClassName, Html::styleTag($style));
