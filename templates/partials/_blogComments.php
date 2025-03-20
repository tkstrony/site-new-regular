<?php namespace ProcessWire;

/**
* Name _blogComments
* @var string $id
* @var string $type
* @var string $name
* @var string $class
* @var string $itemClassName
* @var string $content
* @var string $filePath
* @var string $hxBoost
*/

if(input()->get('pageID')) {
    $pageID = input()->get('pageID');
    session()->set('loadComments',$pageID);
}

if(!$pageID) return '';

$page = pages()->get($pageID);
if(!$page->id) return '';

// comments limit
$commentsLimitPerPage = 12;

// comments asset
$assets = _comments()->renderAssets();

// all comments
$allComments = _comments()->render($page->comments, $commentsLimitPerPage);

// Comment form
$commentForm = _comments()->form($page);

// CSS
$style = Html::styleTag(<<<CSS
    .{$itemClassName} {
        #CommentList, .wrap-form {
            max-width: var(--mw-xs);
            margin: var(--sp-3xl) auto;
            h3 {
                margin: var(--sp-2xl) 0;
            }
        }
    }
CSS);

// content
echo <<<HTML
<div id='{$id}' class='{$class}'>
    {$allComments}

    <div class='wrap-form'>
        {$commentForm}
    </div>
    {$style}
</div>
{$assets}
HTML;
