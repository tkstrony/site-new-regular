<?php namespace ProcessWire; ?>

<main id="main">

<a href="https://phosphoricons.com/">
    <h3 class='title'>Phosphor Icons</h3>
  </a>

  <p>Types - <small class='lead'>(regular, thin, light, fill, duotone, bold)</small> 
  <br> Sizes - <small class='lead'>(2xs - xs - sm - md - lg - xl - 2xl - 3xl - 4xl - 5xl)</small></p>
  <br>
  <div class='icons'>
    <?= _icon('alarm',['size' => 'sm', 'type' => 'regular']) . Html::small('sm <br> regular') ?>
    <?= _icon('anchor',['size' => 'md', 'type' => 'thin']) . Html::small('md <br> thin') ?>
    <?= _icon('avocado',['size' => 'lg', 'type' => 'light']) . Html::small('lg <br> light') ?>
    <?= _icon('bowl-food',['size' => 'xl', 'type' => 'fill']) . Html::small('xl <br> fill') ?>
    <?= _icon('alien',['size' => '2xl', 'type' => 'duotone']) . Html::small('2xl <br> duotone') ?>
    <?= _icon('cactus',['size' => '3xl', 'type' => 'bold']) . Html::small('3xl <br> bold') ?>
  </div>

    <?=
        _phiki(
        <<<'PHP'
            /**
             * @link https://phosphoricons.com/
             */
            <?= _icon('alarm',['size' => 'sm', 'type' => 'regular']) ?>
        PHP);
    ?>
  <hr>

  <h3 class='title'> Typography </h3>

    <h1>H1 Hello World</h1>
    <h2>H2 Hello World</h2>
    <h3>H3 Hello World</h3>

    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero doloremque minima nihil, earum suscipit repellat tempora?</p>

    <blockquote>Blockquote Hello World</blockquote>

    <h3 class='title'> Links </h3>

    <a href="#">Link</a>
    <br>
    <a class='btn' href="#">Link Button</a><br>
    <a class='btn -icon' href="#"><?= _icon('carrot') ?></a>

    <section>
      <h3>Section</h3>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex tempore illo quod laboriosam exercitationem commodi.</p>
    </section>

  <h3 class='title'> Lists </h3>

  <ul>
    <li>Hello</li>
    <li>is</li>
    <li>world</li>
  </ul>

  <br>

    <ol>
      <li>Hello</li>
      <li>is</li>
      <li>world</li>
    </ol>

<br>

    <ul>
      <li>Coffee</li>
      <li>Tea
        <ul>
          <li>Black tea</li>
          <li>Green tea</li>
        </ul>
      </li>
      <li>Milk</li>
    </ul>


    <h3 class='title'> Buttons </h3>

    <button>Button</button>
    <button class="-primary">Btn primary</button>
    <button class="-secondary">Btn secondary</button>
    <button class="-accent">Btn accent</button>
    <button class="-warning">Btn warning</button>
    <button class="-success">Btn success</button>
    <button class="-error">Btn error</button>
    <button class="-icon">Btn icon <?= _icon('carrot',['size' => 'sm']) ?> </button>
    <button class="-disabled" disabled>Btn disabled</button>
    <button class="-link">Btn link</button>
    <button class="-bg-none">Background none</button>

    <button class="-primary --2xs">--2xs</button>
    <button class="-primary -xs">xs</button>
    <button class="-primary -sm">sm</button>
    <button class="-primary -md">md</button>
    <button class="-primary -lg">lg</button>
    <button class="-primary -xl">xl</button>

    <?=
        _phiki(
        <<<'HTML'
            <button class="-primary -xl">Btn primary</button>
        HTML,['grammar' => 'Html']);
    ?>

    <h3 class='title'>Copy to clipboard</h3>

    <?php 
    $someText = __('Copy this text!!!');
    echo Html::div($someText . _alpine()->copyToClipboard($someText), ['class' => 'df -ac']);
    
    echo _phiki(<<<'PHP'
        <?php
            $someText = __('Copy this text!!!');
            echo Html::div($someText .
            _alpine()->copyToClipboard($someText), ['class' => 'df -ac']);
        ?>
    PHP);
    ?>

    <h3 class='title'> Tooltip </h3>
  
    <!-- Example buttons with tooltips -->
    <button class="tooltip-button" data-tooltip="Tooltip 1">Button 1</button>
    <button class="tooltip-button" data-tooltip="Tooltip 2">Button 2</button>

    <!-- This tooltip is also enabled on mobile devices -->
    <button class="tooltip-button mobile-on" data-tooltip="Tooltip 3">Clickable on mobile</button>

    <!-- This tooltip appears automatically when the button is in view and stays visible for 5 seconds -->
    <button 
        class="tooltip-button" 
        data-tooltip="Hello" 
        data-start="2" 
        data-show="3"
      >
        1
    </button>

    <!-- This tooltip appears 2 seconds after the button is in view and stays visible for 5 seconds -->
    <button 
        class="tooltip-button" 
        data-tooltip="ProcessWire"
        data-start="5" 
        data-show="3">
       2
    </button>

    <!-- This tooltip appears 4 seconds after the button is in view and stays visible for 5 seconds -->
    <button 
        class="tooltip-button" 
        data-tooltip="Followers"
        data-start="8" 
        data-show="5">
       3
    </button>

    <?=
      _phiki(<<<'HTML'
        <!-- Example buttons with tooltips -->
        <button class="tooltip-button" data-tooltip="Tooltip 1">Button 1</button>
        <button class="tooltip-button" data-tooltip="Tooltip 2">Button 2</button>

        <!-- This tooltip is also enabled on mobile devices -->
        <button class="tooltip-button mobile-on" data-tooltip="Tooltip 3">Clickable on mobile</button>

        <!-- This tooltip appears automatically when the button is in view and stays visible for 5 seconds -->
        <button 
            class="tooltip-button" 
            data-tooltip="Hello" 
            data-start="2" 
            data-show="3"
          >
            1
        </button>

        <!-- This tooltip appears 2 seconds after the button is in view and stays visible for 5 seconds -->
        <button 
            class="tooltip-button" 
            data-tooltip="ProcessWire"
            data-start="5" 
            data-show="3">
          2
        </button>

        <!-- This tooltip appears 4 seconds after the button is in view and stays visible for 5 seconds -->
        <button 
            class="tooltip-button" 
            data-tooltip="Followers"
            data-start="8" 
            data-show="5">
          3
        </button>
      HTML,['grammar' => 'Html']);
    ?>

    <h3 class='outline'>Dialog</h3>

    <button onclick="dialog.showModal()">Open dialog</button>
    <dialog id="dialog">
        <h3 class="dialog">Dialog title</h3>
        <button title="Close" onclick="dialog.close()">close</button>
    </dialog>

    <?=
      _phiki(<<<'HTML'
        <button onclick="dialog.showModal()">Open dialog</button>
        <dialog id="dialog">
            <h3 class="dialog">Dialog title</h3>
            <button title="Close" onclick="dialog.close()">close</button>
        </dialog>
      HTML);
    ?>

    <h3 class='title'> Popover </h3>

    <button popovertarget="my-popover">Open Popover</button>

    <div id="my-popover" popover>
      <p>I am a popover with more information.</p>
    </div>

    <?=
      _phiki(<<<'HTML'
        <button popovertarget="my-popover">Open Popover</button>
        <div id="my-popover" popover>
          <p>I am a popover with more information.</p>
        </div>
      HTML,['grammar' => 'Html']);
    ?>

    <h3 class='title'> Alerts </h3>

    <p class='alert -success'>Alert Success</p>
    <p class='alert -warning'>Alert Warning</p>
    <p class='alert -error'>Alert Error</p>
    <p class='alert -primary'>Alert Primary</p>
    <p class='alert -secondary'>Alert Secondary</p>
    <p class='alert -accent'>Alert Accent</p>

    <?= _alpine()->alert('alert success', 'success') ?>
    <?= _alpine()->alert('alert warning', 'warning') ?>
    <?= _alpine()->alert('alert error', 'error') ?>
    <?= _alpine()->alert('alert primary', 'primary') ?>
    <?= _alpine()->alert('alert secondary', 'secondary') ?>
    <?= _alpine()->alert('alert accent', 'accent') ?>

    <?=
        _phiki(
        <<<'HTML'
             <p class='alert -success'>Alert Success</p>
        HTML,['grammar' => 'Html']);
    ?>

    <?=
        _phiki(
        <<<'PHP'
            <?= _alpine()->alert('alert success', 'success') ?>
        PHP);
    ?>
    
    <h3 class='title'> Table </h3>

    <div class="table-wrapper">
    <table>
      <caption>
        Front-end web developer course 2025
      </caption>
      <thead>
        <tr>
          <th>Person</th>
          <th>Most interest in</th>
          <th>Age</th>
          <th>Tall</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Chris</th>
          <td>HTML tables</td>
          <td>22</td>
          <td>182</td>
        </tr>
        <tr>
          <th>Dennis</th>
          <td>Web accessibility</td>
          <td>45</td>
          <td>167</td>
        </tr>
        <tr>
          <th>Sarah</th>
          <td>JavaScript frameworks</td>
          <td>29</td>
          <td>158</td>
        </tr>
        <tr>
          <th>Karen</th>
          <td>Web performance</td>
          <td>37</td>
          <td>158</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th>Average age</th>
          <td>183</td>
        </tr>
      </tfoot>
    </table>
  </div>

  <h3 class='title'> Form </h3>


  <form action='' method='Post' class='mw-3xs'>

    <?php if(_isPost()) {
        echo _alpine()->alert('Submit Form','success',['autoHide'=> true,'position' => 'fixed']);
      }
    ?>
  <fieldset>
    <legend>Personalia</legend>

      <label for="t1">Name</label>
      <input type="text" name="t1" id="t1">

      <label for="e1">E-mail adress</label>
      <input type="email" id='e1' name="e1" id="">

      <label for="txtarea1">Message</label>
      <textarea name="txtarea1" id="txtarea1">Content</textarea>

      <label for="cms">Choose a CMS:</label>

      <select name="cms" id="cms">
        <option value="processwire">ProcessWire</option>
        <option value="wordpress">WordPress</option>
        <option value="joomla">Joomla</option>
        <option value="payload">Payload</option>
      </select>

      <label for="myFile">Upload file</label>
      <input type="file" id="myFile" name="filename">

      <label for="multipleFiles">Upload multiple files</label>
      <input type="file" id="multipleFiles" name="files" multiple>


      <input id="c1" type="checkbox" name='c1'>
      <label for="c1">Checkbox</label>

      <input id="c2" type="checkbox" name='c2' checked>
      <label for="c2">Checkbox</label>

      <input id="r1" type="radio" name="r1" value="1">
      <label for="r1">Radio</label>

      <input id="r2" type="radio" name="r2" value="2" checked>
      <label for="r2">Radio</label>

      <input id="s1" type="checkbox" name='s1' class="switch">
      <label for="s1">Switch</label>

      <input id="s2" type="checkbox" name='s2' class="switch" checked>
      <label for="s2">Switch</label>


      <input id="c1d" type="checkbox" name='c1d' disabled>
      <label for="c1d">Checkbox</label>

      <input id="c2d" type="checkbox" name='c2d' checked disabled>
      <label for="c2d">Checkbox</label>

      <input id="r1d" type="radio" name="r1d" value="1" disabled>
      <label for="r1d">Radio</label>

      <input id="r2d" type="radio" name="r2d" value="2" checked disabled>
      <label for="r2d">Radio</label>

      <input id="s1d" type="checkbox" class="switch" name='s1d' disabled>
      <label for="s1d">Switch</label>

      <input id="s2d" type="checkbox" class="switch" name='s2d' checked disabled>
      <label for="s2d">Switch</label>

      <button class='-primary' type="submit">Submit</button>
    </fieldset>
  </form>


  <h3 class='title'> Cards </h3>
    <?php
        $firstCard_img = _home()?->images?->first;
        $card_1 = _component('_card',[
            'img' => $firstCard_img,
            'title' => 'First Card',
            'content' => Html::p('Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore aperiam ducimus.')
        ]);

        $nextCard_img = _home()?->images?->last;
        $card_2 = _component('_card',[
          'img' => $nextCard_img,
          'title' => 'Next card',
          'hoverable' => true,
          'content' => Html::p('Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore aperiam ducimus.')
        ]);
        $card_2 = _htmx(['modal' => true,'elType' => 'div', 'text' => $card_2, 'class' => ''])->getPage(1027, 'body');

        // set grid container
        echo _macy()
        ->setContainer('#cards-items')
        ->setTrueOrder(true)
        ->setWaitForImages(true)
        ->setMargin(20)
        ->setColumns(2)
        ->setBreakAt([
            700 => 1
        ])
        ->render();

      // set div
      echo Html::section($card_1 . $card_2, ['id' => 'cards-items']);

      echo _phiki(<<<'PHP'
                <?php
                  echo _component('_card',[
                  'img' => 'https://picsum.photos/640/420?random=1',
                  'title' => 'First Card',
                  'content' => Html::p('Lorem ipsum dolor sit amet ...')

                  // set images from page
                  $firstCard_img = _home()?->images?->first;
                  $card_1 = _component('_card',[
                      'img' => $firstCard_img,
                      'title' => 'First Card',
                      'content' => Html::p('Lorem ipsum dolor sit amet consectetur adipisicing elit.')
                  ]);

                  // hoverable card
                  $nextCard_img = _home()?->images?->last;
                  $card_2 = _component('_card',[
                    'img' => $nextCard_img,
                    'title' => 'Next card',
                    'hoverable' => true,
                    'content' => Html::p('Lorem ipsum dolor sit amet consectetur adipisicing elit.')
                  ]);
                  $card_2 = _htmx(['modal' => true,'elType' => 'div', 'text' => $card_2, 'class' => ''])
                  ->getPage(1027, 'body');

                  // set grid container
                  _macy()
                  ->setContainer('#cards-items')
                  ->setTrueOrder(true)
                  ->setWaitForImages(true)
                  ->setMargin(20)
                  ->setColumns(2)
                  ->setBreakAt([
                      700 => 1
                  ])
                  ->render();

                // set div
                echo Html::section($card_1 . $card_2, ['id' => 'cards-items']);
            ?>
      PHP);
  ?>

    <h3 class='title'>Htmx</h3>
    <?php
        echo _htmx([
            'text' => 'Get content from Hello World partial',
            'class' => 'btn -primary',
            'hx-trigger' => 'click once',
        ])->getPartial("_helloWorld") . '<br>';

        echo _htmx(['modal' => true,'text' => 'Click me to get field body from Contact Page'])->getPage(1032,'body') . '<br>';

        echo _htmx([
            'modal' => true,
            'text' => 'Load the Hello World Partial from the file partials/_helloWorld.php',
            'class' => 'btn -primary'
        ])->getPartial("_helloWorld");

        // load when content is visible
        // echo _htmx([
        //     'elType' => 'div',
        //     'class' => 'card -primary',
        //     'text' => ' ',
        //     'id' => 'hello-world', 
        //     'hx-trigger' => 'revealed', 
        //     'hx-swap'=>'innerHTML',
        // ])->getPartial("_helloWorld");

        echo 
        _phiki(<<<'PHP'
            <?php

              // get content
              echo _htmx([
                'text' => 'Get content from Hello World partial',
                'class' => 'btn -primary',
                'hx-trigger' => 'click once',
              ])->getPartial("_helloWorld") . '<br>';

              // get field ( load via modal )
              echo _htmx([
                'modal' => true,
                'text' => 'Click me to get field body from Contact Page'
              ])->getPage(1032,'body') . '<br>';

              // get modal
              echo _htmx([
                  'modal' => true,
                  'text' => 'Load the Hello World Partial from the file partials/_helloWorld.php',
                  'class' => 'btn -primary'
              ])->getPartial("_helloWorld");

              // load when content is visible
              echo _htmx([
                  'elType' => 'div',
                  'class' => 'card -primary',
                  'text' => ' ',
                  'id' => 'hello-world', 
                  'hx-trigger' => 'revealed', 
                  'hx-swap'=>'innerHTML',
              ])->getPartial("_helloWorld");
            ?>
        PHP);
    ?>

    <h3 class='title'>Embed</h3>

    <?php
        // Embed a media item using the Embera Oembed consumer.

        // Load via htmx
        echo Html::section(_embed(
          'https://youtu.be/ncS36UqaBvc?si=I-aFjEZrM6sf_G4X
          https://x.com/processwire/status/1829632147583308034'
        ));

        echo 
        _phiki(<<<'PHP'
            // Embed a media item using the Embera Oembed consumer.

            // Load via htmx
            echo Html::section(_embed(
              'https://youtu.be/ncS36UqaBvc?si=I-aFjEZrM6sf_G4X
              https://x.com/processwire/status/1829632147583308034'
            ));

            // Normal load
            echo Html::section(_embed(
            '<h3>No htmx</h3>
            https://youtu.be/ncS36UqaBvc?si=I-aFjEZrM6sf_G4X
            <hr>
            https://x.com/processwire/status/1829632147583308034'
            ,['filters' => false]),['class' => 'mw-md']);
        PHP);
    ?>

    <h3 class='title'>Tabs</h3>

    <?= _component('_tabs',[
      'tabs' =>
      [
          '1 Tab' => '<p>Hello World - 1</p>',
          '2 Tab' => '<p>Hello World - 2</p>',
          'Contact info' => pages()->get("template=contact")->body
      ],'activeTab' => 3])
    ?>

    <?= _component('_tabs',[
      'tabs' =>
      [
          '1 Tab' => '<p>Hello World - 3</p>',
          '2 Tab' => '<p>Hello World - 4</p>',
          'Home info' => pages()->get("template=home")->seo->titleTag
      ],'activeTab' => 1])
    ?>

    <?php
      echo 
      _phiki(<<<'PHP'
        <?= _component('_tabs',[
          'tabs' =>
          [
              '1 Tab' => '<p>Hello World - 1</p>',
              '2 Tab' => '<p>Hello World - 2</p>',
              'Contact info' => pages()->get("template=contact")->body
          ],'activeTab' => 3])
        ?>

        <?= _component('_tabs',[
          'tabs' =>
          [
              '1 Tab' => '<p>Hello World - 3</p>',
              '2 Tab' => '<p>Hello World - 4</p>',
              'Home info' => pages()->get("template=home")->seo->titleTag
          ],'activeTab' => 1])
        ?>
      PHP);
    ?>

    <h3 class='title'>Collapse</h3>
      <?php
        echo _alpine()->collapse('Expanded content','Click me', ['expanded' => false]);
        echo _alpine()->collapse(pages()->get("template=contact")->body,'Contact us', ['fullWidth' => false]);

        echo _phiki(<<<PHP
            <?php
              echo _alpine()->collapse('Expanded content','Click me', 
              ['expanded' => false]);
              echo _alpine()->collapse(pages()->get("template=contact")->body,'Contact us',
              ['fullWidth' => false]);
            ?>
        PHP);
      ?>

    <h3 class='title'>lightbox</h3>

    <?php
      echo _alpine()->lightbox('Open Lightbox', "<p>Hello World <img class='responsive' src='https://picsum.photos/640/420'></p>
      <a href='https://picsum.photos/640/420'>Read more</a>");

      echo _phiki(<<<PHP
          <?php
            echo _alpine()->lightbox('Open Lightbox', \n
            "<p>Hello World<img class='responsive' src='https://picsum.photos/640/420'></p>
            <a href='https://picsum.photos/640/420'>Read more</a>");
          ?>
      PHP);
    ?>


  <!-- Phiki https://github.com/phikiphp/phiki -->
  <?= _phiki(
      <<<HTML
          <?= _phiki(
            <<<'PHP'
                <?php echo 'hello world' ?> \n
            PHP);
          ?>  

          <?= _phiki(
            <<<'PHP'
                <?php echo 'hello world' ?> \n
            PHP,['grammar' => 'Php', 'title' => 'Phiki Example','theme' => 'CatppuccinMocha']); \n
          ?>
      HTML,
      ['grammar' => 'Php', 'title' => 'Phiki Example','theme' => 'TokyoNight']); 
  ?>

  <h3 class='title'>Photoswipe</h3>
    <?php 
        $ps = _photoswipe();
        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-200.jpg',
        [
            'data-width' => "1669",
            'data-height' => "2500",
        ]);

        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg',
            [
                'data-width' => "1875",
                'data-height' => "2500",
            ]);

          // render items
          echo $ps->render('#gallery',[
            'customStyle' => <<<CSS
                {
                    display: flex;
                    flex: wrap;
                    gap: var(--sp-sm);
                }
            CSS
        ]);

        // set next items
        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg',
        [
            'data-width' => "3500",
            'data-height' => "2500",
        ]);

        $ps->item(
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-2500.jpg',
        'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-200.jpg',
            [
            'data-width' => "1875",
            'data-height' => "2500",
            ]);
        echo $ps->render('#gallery_next',[
        'customStyle' => <<<CSS
            {
                display: flex;
                flex: wrap;
                gap: var(--sp-sm);
            }
        CSS]);

        echo _phiki(<<<'PHP'
          <?php 
            $ps = _photoswipe();
            $ps->item(
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-2500.jpg',
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/1/img-200.jpg',
            [
                'data-width' => "1669",
                'data-height' => "2500",
            ]);

            $ps->item(
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-2500.jpg',
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/2/img-200.jpg',
                [
                    'data-width' => "1875",
                    'data-height' => "2500",
                ]);

              // render items
              echo $ps->render('#gallery',[
                'customStyle' => <<<CSS
                    {
                        display: flex;
                        flex: wrap;
                        gap: var(--sp-sm);
                    }
                CSS
            ]);

            // set next items
            $ps->item(
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-2500.jpg',
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/3/img-200.jpg',
            [
                'data-width' => "3500",
                'data-height' => "2500",
            ]);

            $ps->item(
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-2500.jpg',
            'https://cdn.photoswipe.com/photoswipe-demo-images/photos/4/img-200.jpg',
                [
                'data-width' => "1875",
                'data-height' => "2500",
                ]);
            echo $ps->render('#gallery_next',[
            'customStyle' => <<<CSS
                {
                    display: flex;
                    flex: wrap;
                    gap: var(--sp-sm);
                }
            CSS]);
          ?>
      PHP);
  ?>
  
      <h3 class='title'>Splide</h3>
      <?php
        // load splide
        $splide = _splide();

        // set next items
        $splide->item(Html::p('Slide - 1'));
        $splide->item(Html::p('Slide - 2'));
        $splide->item(Html::p('Slide - 3'));
        $splide->item(Html::p('Slide - 4'));
        $splide->item(Html::p('Slide - 5'));
        $splide->item(Html::p('Slide - 6'));
        $splide->item(Html::p('Slide - 7'));
        $splide->item(Html::p('Slide - 8'));
        
        // init first slider
        echo $splide->render('.first-slider',[
            'perPage' => 3
        ]) . '<br>';


        foreach(page()->images as $img) {
        echo $splide->item(_htmx([
            'modal' => true,
            'text' => Html::img($img->url,['class' => 'responsive']),
            'elType' => 'button',
            'class' => 'card', 
        ])->loadHook("_loadImg/{$page->id}/$img->name"));
        }

        // init next slider
        echo $splide->render('.next-slider',[
            'perPage' => 3,
            'autoplay' => true,
        ]) . '<br>';

        echo _phiki(<<<'PHP'
          <?php
            // load splide
            $splide = _splide();

            // set items
            $splide->item(Html::p('Slide - 1'));
            $splide->item(Html::p('Slide - 2'));
            $splide->item(Html::p('Slide - 3'));

            // init custom slider
            echo $splide->render('.custom-slider',[
                'perPage' => 3
            ]) . '<br>';

            // set next slider
            $splide->item(Html::p('Slide - 4'));
            $splide->item(Html::p('Slide - 5'));
            $splide->item(Html::p('Slide - 6'));

            // init next slider
            echo $splide->render('.custom-next-slider',[
                'perPage' => 3
            ]) . '<br>';
          ?>
        PHP);
    ?>

<h3 class='title'>Logs</h3>

  <?php
  echo _phiki(
      <<<'PHP'
        <?php
          _log('custom-log-name', 'Hello ProcesWire Followers - log');
          _logMessage('Hello ProcesWire Followers - message');
          _logWarning('Hello ProcesWire Followers - warning');
          _logError('Hello ProcesWire Followers -error');

          _log('custom-log-name',[
            'Processwire CMS' => 'https://processwire.com/',
            'Weekly.pw' => 'https://weekly.pw/',
            'type' => '_log',
            'ip' => _getIP(),
            'time' => date('Y-m-d h:i')
          ]);

          _logMessage([
            'Processwire CMS' => 'https://processwire.com/',
            'Weekly.pw' => 'https://weekly.pw/',
            'type' => '_logMessage',
            'ip' => _getIP(),
            'time' => date('Y-m-d h:i')
          ]);

          _logWarning([
            'Processwire CMS' => 'https://processwire.com/',
            'Weekly.pw' => 'https://weekly.pw/',
            'type' => '_logWarning',
            'ip' => _getIP(),
            'time' => date('Y-m-d h:i')
          ]);

          _logError([
            'Processwire CMS' => 'https://processwire.com/',
            'Weekly.pw' => 'https://weekly.pw/',
            'type' => '_logError',
            'ip' => _getIP(),
            'time' => date('Y-m-d h:i')
          ]);

          // get array of logs
          var_dump(_getLogEntries('custom-log-name'));
          var_dump(_getLogEntries('custom-log-name','text'));
        ?>
    PHP);
		?>

    <h3 class='title'>lottie Player</h3>
    <?php
        $lottie = _lottie()->load('hand-1.json', [
          'loop' => true,
          'controls' => false,
          'maxWidth' => 500,
          'autoplay' => true,
        ])

        ->render('',[
          // 'styleTag' =>
          // <<<CSS
          //     {
          //       position: fixed;
          //       opacity: 0.20;
          //       z-index: -1;
          //       bottom: 0;
          //       left: 50%;
          //       transform: translateX(-50%);
          //     }
          // CSS
        ]
      );
      echo Html::p($lottie);


        echo _phiki(<<<'PHP'
            <?php
              $lottie = _lottie()->load('hand-1.json', [
                'loop' => true,
                'controls' => false,
                'maxWidth' => 500,
                'autoplay' => true,
              ])

              ->render('',[
                'styleTag' =>
                <<<CSS
                    {
                      position: fixed;
                      opacity: 0.20;
                      z-index: -1;
                      bottom: 0;
                      left: 50%;
                      transform: translateX(-50%);
                    }
                CSS
              ]);
            echo Html::p($lottie);
          ?>
        PHP)
    ?>

  </br>

  <style>
    .icons {
      display: flex;
      flex-wrap: wrap;
      gap: var(--sp-xs);
    }
  </style>

</main>