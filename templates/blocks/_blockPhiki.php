<?php namespace ProcessWire;

use Phiki\Phiki;
use Phiki\Grammar\Grammar;
use Phiki\Theme\Theme;

/**
 * Name _blockPhiki
 * @var string $name
 * @var string $class
 * @var string $itemClassName
 * @var string $content
 * 
 * @link https://github.com/phikiphp/phiki
 */
 
if(!isset($content)) return '';

$phiki = new Phiki();

$title = isset($title) ? Html::h3($title) : '';
$body = isset($body) ? $body : '';
$grammar = isset($grammar) ? $grammar : 'Php';
$theme = isset($theme) ? $theme : 'GithubDark';
$codeTo = isset($codeTo) ? $codeTo : 'codeToHtml';

$lang = match ($grammar) {
    'Html' => 'HTML',
    'Css' => 'CSS',
    'Js' => 'JS',
    'Php' => 'PHP',
};

$phiki = $phiki->$codeTo(
    $content,
    Grammar::{$grammar},
    Theme::{$theme},
);

// copy to clipboard
$copyToclipboard = _alpine()->copyToClipboard($content);
$grammarLabel = Html::small($grammar, ['class' => 'btn-grammar card -xs']);


// set custom region css
$css = _globalRegion($itemClassName, Html::styleTag(
    <<<CSS
        .{$itemClassName} {
            code span[data-line]::before {
                content: attr(data-line);
                display: inline-block;
                width: 1.7rem;
                margin-right: 1rem;
                color: #666;
                text-align: right;
            }
        }
    CSS
));

return Html::section($title . $body . Html::div($grammarLabel . $copyToclipboard,['class' => 'df']) . $phiki,['class' => $class]) . $css;
