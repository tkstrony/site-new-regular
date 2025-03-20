<?php namespace ProcessWire;

/**
 * Template file for pages using the "user-zone" template.
 *
 * Access to this page is restricted to users with the "login-register" role.
 * Users with this role are also blocked from accessing the admin panel by default (see admin.php).
 *
 * User todos will be stored under the admin tree:
 * Admin → Access → Users → user-name → {todo}
 *
 * This template uses the LoginRegister module.
 * @link https://github.com/ryancramerdesign/LoginRegister
 */

if(user()->isLoggedin() && !user()->hasRole('login-register')) {
    $session->logout();
    _flashMessage()->error(_t('notPremissions'), _home()->httpUrl);
}

// translations
$tNew = _t('createNew');
$tUpdate = _t('update');
$tDelete = _t('delete');
$tSubmit = _t('submit');

// limit todo
$todoLimit = 5;
?>

<!-- custom titile -->
<head id="html-head" pw-append>
    <title><?= page()->title ?></title>
</head>

<body id="body">

    <header>
        <div>
            <a class='btn tooltip-button' href="<?= _site()->url ?>" data-tooltip="<?= _t('backTo') . ' ' . _home()->title ?>">
                <?= Html::img(_site()?->logo,['width' => 40, 'height' => 40, 'class' => 'logo', 'lozad' => false]) ?>
                <span class='siteName'><?= _site()->name ?></span>
            </a>
        </div>
    </header>

    <div id='todos' class='todos'>
    <?php

    // set messages
    if(input()->get('logout') ) {
        echo _alpine()->alert(_t('loggedOut'),'success',['autoHide' => true]);
    }

    if(input()->get('login') ) {
        echo _alpine()->alert(_t('loggedIn'),'success',['autoHide' => true]);
    }

    // get user profile
    if(input()->get('profile') || input()->get('register') || input()->get('forgot')) {
        echo Html::a(page()->url, _t('backTo') . ' ' . page()->title, ['class' => 'btn -primary']);
    }

    $loginRegister = $modules->get('LoginRegister');

    try {
        echo $loginRegister->execute() . '<br>';
    } catch (\Exception $e){
        _flashMessage()->error($e->getMessage());
    }

    if(user()->isLoggedin() && !input()->get('profile') && !input()->get('logout')) {

        $todo = $user->children("template=user-todo,include=all");

        $todoID = input()->get('todoID');
        $userId = user()->id;
        $title = input()->get('title');

        if(input()->get('deleteTodo') && $todoID) {
            $todo = pages()->findOne("template=user-todo,id=$todoID,include=all");
            $todo->delete();
            _flashMessage()->warning($tDelete . " - $title");
        }

        if(input()->get('updateTodo') && $title) {
            $todo = pages()->findOne("template=user-todo,id=$todoID,include=all");
            $todo->setAndSave('title', $title);
            _flashMessage()->success($tUpdate . " - $title", './');
        }

        if(input()->get('createTodo') && $title) {

            if($todo?->count() >= $todoLimit) {
                _flashMessage()->warning(_t('todoLimit'));
            }

            try {
                $p = $pages->new([
                    'template' => 'user-todo',
                    'parent' => $userId,
                    'title' => $title
                ]);
            }  catch (WireException $e) {
                // An error occurred while creating the page
                $message = $e->getMessage();
                $log->error($message);
                // eror for user
                _flashMessage()->error(_t('errorCreating') . " - $p->title");
            }

            _flashMessage()->success($tNew . " - $p->title");
        }

        echo <<<HTML
            <h3 class='title'>$tNew</h3>
            <form
                action=''
                hx-get="{$page->url}"
                hx-target="#body"
            >
                <input type="text" name="title" id="" required>
                <input type="hidden" name="createTodo" value='createTodo'>
                <button type='submit'

                >{$tSubmit}</button>
            </form>
        HTML;

        echo Html::h3('Todos', ['class' => 'title']);

        foreach ($user->children("template=user-todo,include=all,limit=$todoLimit") as $todo) {
            echo <<<HTML
                <form
                    action=''
                    hx-get="{$page->url}"
                    hx-target="#body"
                >
                    <input type='text' name='title' value='{$todo->title}'>
                    <input type='hidden' name='todoID' value='{$todo->id}'>
                    <input class='btn' type='submit' name='updateTodo' value='{$tUpdate}'>
                    <input class='btn' type='submit' name='deleteTodo' value='{$tDelete}'>
                </form>
            HTML;
        }
    }
    ?>
    </div>

    <footer>
  		<!-- Color Mode -->
        <?= (new ColorMode('system'))->render(); ?>
    </footer>

    <?= _partial('_scripts-JS'); // partials/js/_scripts-JS.php ?>

<?php
    // Set style
    $style = <<<CSS
        header {
            justify-items: left;
        }
        #body {
            max-width: var(--mw-lg);
            .title {
                margin-top: var(--sp-xl);
            }

            .todos {
                max-width: var(--mw-xs);
            }

            .LoginRegisterMessage {
                color: var(--color-accent);
                border: var(--sp-4xs) dotted var(--color-primary);
                border-radius: var(--br);
            }

            .LoginRegisterError {
                color: var(--color-error);
            }

            .Inputfield:not(.InputfieldSubmit) {
                background: var(--color-bg);
                border: var(--sp-5xs) dotted var(--color-accent);
                border-radius: var(--br);
                margin-bottom: var(--sp-lg);
            }
        }
        footer {
            margin: var(--sp-5xl) 0;
        }
    CSS;

    // set region
    echo Html::styleTag($style);
?>

</body>