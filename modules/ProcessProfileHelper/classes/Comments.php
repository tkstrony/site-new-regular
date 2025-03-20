<?php namespace ProcessWire;

/**
 * comments stuff
 * @param array $t Comments tramslations
 */
class Comments {

    public function __construct(
        public string $formID = 'CommentForm',
        public string $commentListID = 'CommentList',
        public array $t = [], // translates
    ) {
        // translations
        $this->t = [
            // comment form
            'comment' => _t('comment'),
            'comments' => _t('comments'),
            'commentsList' => _t('commentsList'),
            'noComments' => _t('noComments'),
            'commentsClosed' => _t('commentsClosed'),
            'header' => _t('header'),
            'successMessage' => _t('successMessage'),
            'pendingMessage' => _t('pendingMessage'),
            'errorMessage' => _t('errorMessage'),
            'postComment' => _t('postComment'),
            'commentCite' => _t('commentCite'),
            'commentEmail' => _t('commentEmail'),
            'commentWebsite' => _t('commentWebsite'),
            'commentStars' => _t('commentStars'),
            'starsRequired' => _t('starsRequired'),
            'reply' => _t('reply'),
            'replyTo' => _t('replyTo'),
            'submit' => _t('submit'),
        ];
    }


    public function closed($page = null) {
        return $page->cbox_1 ? true : false;
    }

    /**
     * render comments
     * @param CommentArray $comments - The comment array to render.
     * @param int $limit - Limit comments per page.
     */
    public function render($comments, $limit = 9) {

        // get current page
        $page = $comments->getPage();

        if(!$comments->count()){
            return '';
        }

        if(_site()->disableComments == true) return '';

        // $closed = $page->cbox_1 ? true : false;

        $closed = $this->closed($page);

        if($closed == true) {
            echo Html::h3($this->t['commentsClosed']);
        }

        // Find total comments
        $totalLimit = 500;

        // find all approwed comments
        $comments = $comments->find("limit=$totalLimit,parent_id=0,sort=-date,status>=1");

        $currentPage = input()->get('comments-page') ? (int) input()->get('comments-page') : 1;
        $start = ($currentPage - 1) * $limit;
        $totalComments = count($comments);
        $totalPages = ceil($totalComments / $limit);
        $comments = $comments->slice($start, $limit);

        // comment list
        $commentList = Html::h3($this->t['comments']);
        $commentList .= $this->list($comments);

        // reset pagination
        $pagination = '';

        // Generate custom pagination
        if ($totalPages > 1) {
            $pagination .= "<div class='pagination'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $currentPage) {
                    $pagination .= "<span class='btn -primary current-page'>{$i}</span> ";
                } else {
                    $pagination .= "<a class='btn' href='?comments-page={$i}#CommentList'>{$i}</a> ";
                }
            }
            $pagination .= "</div>";
        }

        return Html::div($commentList . $pagination, ['id'=> $this->commentListID]);
    }

    /**
     * Render the necessary JavaScript and CSS assets for the comments functionality.
     */
    public function renderAssets() {

        // URLs for FieldtypeComments assets
        $urlsComments = config()->urls->FieldtypeComments;

        // Include jQuery from CDN with integrity check and crossorigin attribute
        $jQuery = Html::scriptSrcTag('https://code.jquery.com/jquery-3.6.3.min.js', [
            'integrity' => 'sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=',
            'crossorigin' => 'anonymous',
        ]);

        // Include comments JavaScript file from the FieldtypeComments module
        $commentsJS = Html::scriptSrcTag("{$urlsComments}comments.min.js");

        // return all
        return $this->style() . $jQuery . $commentsJS . $this->script();
    }

    /**
     * Render a comment
     * @param Comment $comment
     * @param array|string $opt Default options
     * @return string
     */
    private function item(Comment $comment, $opt = array()) {

        $defaults = array(
            'depth' => 0,
        );
        $opt = array_merge($defaults, $opt);

        $text = $comment->getFormatted('text');
        $cite = $comment->getFormatted('cite');
        $website = $comment->getFormatted('website');
        $field = $comment->getField();
        $page = $comment->getPage();
        $classes = array();
        $metas = array();

        $stars = null;
        if($comment->stars) {
            $stars = Html::p($comment->renderStars());
        }

        $gravatar = '';
        $depth = $opt['depth'];
        $commentsDepth = $field->get('depth');

        $replies = '';
        if($commentsDepth >= $depth && $page->cbox_1 == 0) {
            $replies = $this->commentReply($comment->id);
        }

        if($field->get('useGravatar')) {
            $img = $comment->gravatar($field->get('useGravatar'), $field->get('useGravatarImageset'));
            if($img) $gravatar = "<img class='comment-avatar' src='$img' alt='$cite'>";
        }

        if($website) $cite = "<a href='$website' rel='nofollow' target='_blank'>$cite</a><br>";
        $created = wireDate('relative', $comment->created);

        $classes = implode(' ', $classes);
        $metas = implode('', $metas);

        return <<<HTML
            <div id='Comment{$comment->id}' class='{$classes}' data-comment='{$comment->id}'>
                <p class='CommentGravatar'>$gravatar</p>
                <p class='comment-info lead text-sm'>
                    $cite
                    $created<br>
                    $metas
                </p>
                <div class='comment-body'>
                    $text
                    $stars
                </div>
            </div>
            $replies
        HTML;
    }

    /**
     * return list comments
     */
    private function list($comments, $depth = 0, $opt = [], $count = 0) {

        $defaults = [
            'style' => '',
            'ulClass' => '',
            'childLimit' => 20,

        ];
        $opt = array_merge($defaults, $opt);

        // get current page
        $page = $comments->getPage();

        // get global comments
        $globalComments = $page->comments;

        // set css class
        $ulClass = $opt['ulClass'] ?: 'listComments';
        $depth ++;
        $items = '';
        $replyTo = '';

        foreach($comments as $comment) {

            $parent = $comment->parent_id;
            $count++;

            if($parent != 0) {
                $commentParent = $globalComments->get("id=$parent");
                $parentContent = sanitizer()->text($commentParent->getFormatted('text'), ['maxLength' => 15]) . ' ...';
                $replyTo = sprintf($this->t['replyTo'],$count, $commentParent->getFormatted('cite'), $parentContent) . ' ';
                $replyTo = Html::small($replyTo,['class' => 'lead']);
            }

            if($comment->status < 1) continue; // skip unapproved or spam comments

            $items .=
            "<li id='Comment{$comment->id}'
                class='CommentListItem Comment{$comment->id}'
                data-comment='{$comment->id}'>  $replyTo" . $this->item($comment, ['depth' => $depth]) .
            "</li>";

            if($comment->children->count) {
                $items .= $this->list($comment->children->find("limit=$opt[childLimit],status>=1"), $depth, ['ulClass' => 'commentChild'], $count = 0);
            }
        }

        if($items) {
            return "<ul class='{$ulClass}' style='$opt[style]'>{$items}</ul>";
        }
    }

    /**
     * Render a comment repply
     * @param int $commentId get comment id to set reply button url
     *
     */
    private function commentReply($commentId) {
        return "<a class='CommentActionReply btn -primary'
                data-comment-id='$commentId' href='#Comment$commentId'>{$this->t['reply']}</a>";
    }

    /**
     * render comment form
     * @param Page $page
     * @param bool $closed
     */
    public function form($page = '', $closed = null) {

        if(!$page->id) return '';

        if(!is_bool($closed)) {
            $closed = _site()->disableComments;
        }

        if($closed == true || $page->cbox_1 == 1) return '';

        $header = Html::h3($this->t['postComment']);

         // comments form with all options specified (these are the defaults)
        $commentForm = $page->comments->renderForm(array(
            // 'headline' => '',	// Headline (with markup) above form, or specify false for no headline
            'successMessage' => Html::p($this->t['successMessage'], ['class' => 'success']),
            'errorMessage' => Html::p($this->t['errorMessage'], ['class' => 'error margin-y-sm']),
            'pendingMessage' => Html::p($this->t['pendingMessage'], ['class' => 'pending margin-y-sm']),
            'processInput' => true,
            'encoding' => 'UTF-8',
            'attrs' => array(
                'id' => $this->formID,
                'action' => './',
                'method' => 'post',
                'class' => 'outline',
                'rows' => 5,
                'cols' => 50,
                ),
                'labels' => array(
                    'cite' => $this->t['commentCite'],    // Your Name
                    'email' => $this->t['commentEmail'],  // Your E-Mail
                    'website' => $this->t['commentWebsite'],// Website
                    'stars' => $this->t['commentStars'],  // Your Rating
                    'text' => $this->t['comment'],    // Comments
                    'submit' => $this->t['submit'], // Submit
                    'starsRequired' => $this->t['starsRequired'], // Please select a star rating
                ),
                'classes' => array(
                    'form' => 'formClass -bg',
                    'wrapper' => '', // when specified, wrapper inside <form>...</form>
                    'label' => 'form-label',
                    'labelSpan' => '',
                    'cite' => 'CommentFormCite {id}_cite',
                    'citeInput' => 'required form-control',
                    'email' => 'CommentFormEmail {id}_email',
                    'emailInput' => 'required email form-control',
                    'text' => 'CommentFormText {id}_text',
                    'textInput' => 'required form-control',
                    'website' => 'CommentFormWebsite {id}_website',
                    'websiteInput' => 'website form-control',
                    'stars' => 'CommentFormStars {id}_stars',
                    'starsRequired' => 'CommentFormStarsRequired',
                    'honeypot' => 'CommentFormHP {id}_hp',
                    'notify' => 'CommentFormNotify',
                    'radioLabel' => '',
                    'radioInput' => '',
                    'submitButton' => 'CommentFormSubmit {id}_submit btn -primary'
                ),
                // the name of a field that must be set (and have any non-blank value), typically set in Javascript to keep out spammers
                // to use it, YOU must set this with a <input hidden> field from your own javascript, somewhere in the form
                'requireSecurityField' => '', // not used by default

                // the name of a field that must NOT be set
                // creates an input field that a (human) visitor should ignore, maybe hiding it with css is a good idea
                'requireHoneypotField' => '',

                // should a redirect be performed immediately after a comment is successfully posted?
		        'redirectAfterPost' => true, // null=unset (must be set to true to enable)

                // When a comment is saved to a page, avoid updating the modified time/user
                'quietSave' => true,
            ));

        return $header . $commentForm;
    }

    /**
     * Generate and return meta information for article comments.
     *
     * This function generates and returns meta information related to article comments. It takes a Page object,
     * a CommentArray object representing the comments, and an optional array of configuration options.
     *
     * @param Page $item - The Page object representing the article.
     * @param CommentArray $comments - The CommentArray containing the comments for the article.
     * @param mixed|null $opt - Optional configuration options for customizing the output (default: empty array).
     * @return string - The generated HTML content containing comments meta information.
     */
    public function meta($item, $comments, $opt = array()) {

        // set default link id
        $linkId = '?loadComments=1#' . $this->commentListID;

        // Basic options
        $default = [
            'closedComments' => $item->cbox_1,
            'commentsCount' => 0
        ];

        // Merge configuration options with default options
        $opt = array_merge($default, $opt);

        // If comments are disabled, return empty string
        if (_site()->disableComments == true) {
            return '';
        }

        // If there are no comments, return an empty string
        if (!$comments) {
            return '';
        }

        // Define the default comment text and closed comments text
        $commentText = $this->t['noComments'];
        $closedText = $this->t['commentsClosed'] . " ( $opt[commentsCount] )";

        // If comments count is greater than zero, set the appropriate comment text
        if ($opt['commentsCount']) {
            $commentText = $opt['commentsCount'] . ' ' . _n($this->t['comment'], $this->t['comments'], $opt['commentsCount']);
        }

        // If comments are closed, display closed comments text
        $commentText = $opt['closedComments'] == 1 ? "<small>$closedText</small>" : $commentText;

        // set link id
        if( $opt['commentsCount'] == 0) {
            $linkId = '?loadComments=1#'.$this->formID;
        }

        $linkID = session()->get('loadComments') == $item->id ? '#partial_blogComments' : '#commentsContent';
        // $linkID = Html::a(rtrim($item->url, '/') . $linkID, $commentText);
        $linkID = Html::a('./'.$linkID, $commentText);
        // set comment link
        // $commentLink = $item->template == 'blog-post' ? $linkId : "{$item->url}?loadComments=1{$linkId}";
        // $commentLink = "<a class='link' href='{$commentLink}'>{$commentText}</a>";

        // return the comments meta information
        return <<<HTML
            <span class='comments'>
                {$linkID}
            </span>
        HTML;
    }

    /**
     * Styles for comments
     */
    public function style() {

        $css = <<<CSS

            #CommentList {
                .pagination {
                    margin: var(--sp-lg);
                }
            }

            .CommentFormReply {
                margin-top: var(--sp-xl);
                margin-bottom: var(--sp-xl);
            }

            .CommentActionReply {
                outline: var(--sp-6xs) dashed var(--color-white) !important;
                outline-offset: var(--sp-4xs);
                box-shadow: var(--sh-xs);
            }

            .listComments {
                .commentChild {
                    background: color-mix(in srgb, var(--color-violet), transparent 40%);
                    color: var(--color-white);
                    padding: var(--sp-md);
                    border-radius: var(--br);
                    margin-left: var(--sp-xs);
                    @media (min-width: 64rem) {
                        margin-left: var(--sp-5xl);
                    }
                }

                .comment-body {
                    margin-bottom: var(--sp-xl);
                }

                li {
                    background: var(--color-silver);
                    color: var(--color-black);
                    margin-top: var(--sp-md);
                    margin-bottom: var(--sp-md);
                    padding: var(--sp-md);
                    list-style: none;
                    border-radius: var(--br);
                }
            }

            .CommentForm_new {
                .CommentForm {
                    display: grid;
                    flex-direction: column;
                    p {
                        margin: 0;
                        &:label {
                            display: block;
                        }
                        &:textarea {
                            max-width: 100%;
                        }
                    }

                    .CommentFormSubmit {}

                    @media (min-width: 64rem) {
                        max-width: var(--width-md);
                    }
                }

                .success {
                    background: var(--color-success);
                    color: var(--color-white);
                    padding: var(--sp-md);
                }
                .pending {
                    background: var(--color-warning);
                    color: var(--color-white);
                    padding: var(--sp-md);
                }
                .error {
                    background: var(--color-error);
                    color: var(--color-white);
                    padding: var(--sp-md);
                }
            }

            #CommentPostNote {
                /* position: fixed;
                top: 0;
                left: 0; */
                padding: var(--sp-xl);
            }

            /*** COMMENT STARS **********************************************/
            .CommentStars > span,
            .CommentForm .CommentStars > span,
            .CommentList .CommentStars > span {
                display: inline-block;
                position: relative;
                width: 1.1em;
                color: var(--color-gray);
            }
            span.CommentStarOn,
            .CommentForm .CommentStars > span.CommentStarOn,
            .CommentList .CommentStars > span.CommentStarOn {
                color: var(--color-salmon);
            }

            span.CommentStarPartial {
                position: relative;
            }
            span.CommentStarPartial span.CommentStarOn {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                overflow-x: hidden;
                line-height: 0;
            }

            .CommentForm .CommentStarsInput > span:hover {
                cursor: pointer;
            }
        CSS;

        return Html::styleTag($css);

    }

    /**
     * scripts for comments
     */
    public function script() {

        $js = <<<JS
            function fadeOutAndRemoveElement() {
                var element = document.getElementById('CommentPostNote');
                if (element) {
                    // Add a class to your fade animation
                    element.classList.add('fade-out');

                    // Once the animation is finished (2 seconds), remove the element from the DOM
                    setTimeout(function() {
                        if (element) {
                            element.remove();
                        }
                    }, 4000);
                }
            }

            // Set a delay of 4 seconds (4000 ms)
            setTimeout(fadeOutAndRemoveElement, 4000);
        JS;

        return Html::scriptTag($js);
    }

}
