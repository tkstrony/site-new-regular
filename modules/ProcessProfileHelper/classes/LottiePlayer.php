<?php namespace ProcessWire;

/**
 * The LottiePlayer class allows for loading and customizing a Lottie animation player.
 *
 * This class provides methods to load a Lottie JSON file and configure various options such as loop, controls,
 * dimensions, and playback settings. It then generates the necessary HTML to render the player.
 *
 * Example usage:
 * ```php
    // load lottie item from - assets/lottie/{item-name.json}
    $lottie = (new LottiePlayer())->load('hand-1.json', [
        'loop' => false,
        'controls' => true,
        'maxWidth' => 200,
        'autoplay' => true
    ]);
    echo $lottie->render();
 * ```
 */
class LottiePlayer
{
    private string $src;
    private bool $loop;
    private bool $controls;
    private int $maxWidth;
    private string $background;
    private float $speed;
    private int $direction;
    private string $playMode;
    private bool $autoplay;

    public function __construct()
    {
        $this->background = 'transparent';
        $this->speed = 1.0;
        $this->direction = 1;
        $this->playMode = 'normal';
        $this->autoplay = false;
    }

    /**
     * Loads a Lottie JSON file and configures the player options.
     *
     * @param string $file The name of the Lottie JSON file to load.
     * @param array $options An associative array of player options.
     *                       Available options:
     *                       - 'loop' (bool): Whether to loop the animation. Default is true.
     *                       - 'controls' (bool): Whether to show player controls. Default is true.
     *                       - 'width' (int): The width of the player in pixels. Default is 300.
     *                       - 'height' (int): The height of the player in pixels. Default is 300.
     *                       - 'background' (string): The background color of the player. Default is 'transparent'.
     *                       - 'speed' (float): The playback speed of the animation. Default is 1.0.
     *                       - 'direction' (int): The playback direction (1 for forward, -1 for reverse). Default is 1.
     *                       - 'playMode' (string): The play mode of the animation. Default is 'normal'.
     *                       - 'autoplay' (bool): Whether to autoplay the animation. Default is false.
     * @return self Returns the instance of the LottiePlayer for method chaining.
     */
    public function load(string $file, array $options = []): self
    {

        $this->src = $this->getFileUrl($file);
        $this->loop = $options['loop'] ?? true;
        $this->controls = $options['controls'] ?? true;
        $this->maxWidth = $options['maxWidth'] ?? 300;
        $this->background = $options['background'] ?? $this->background;
        $this->speed = $options['speed'] ?? $this->speed;
        $this->direction = $options['direction'] ?? $this->direction;
        $this->playMode = $options['playMode'] ?? $this->playMode;
        $this->autoplay = $options['autoplay'] ?? $this->autoplay;

        return $this;
    }

    /**
     * Generates the full URL for the Lottie JSON file.
     *
     * @param string $file The name of the Lottie JSON file.
     * @return string The full URL of the Lottie JSON file.
     */
    private function getFileUrl(string $file): string
    {
        $baseDir = urls()->templates . 'assets'.DIRECTORY_SEPARATOR.'lottie'.DIRECTORY_SEPARATOR;
        return $baseDir . $file;
    }

    /**
     * Renders the HTML for the Lottie player.
     *
     * @return string The HTML string for embedding the Lottie player.
     */
    public function render($id = '', $opt = array()): string
    {
        if(!$id) {
            $id = 'lottie-' . rand();
        }

        // set css class
        $class = isset($opt['class']) ?  $id . ' ' . $opt['class'] : $id;
        
        // defaault options
        $def = [
            'id' => $id,
            'class' => $class,
            'src'=> $this->src,
            'background'=> $this->background,
            'speed'=> $this->speed,
            'style'=> 'max-width: ' . $this->maxWidth . 'px;',
            'styleTag' => '',
            'direction'=> $this->direction,
            'playMode'=> $this->playMode,
            'loop'=> $this->loop,
            'controls'=> $this->controls ? true : false,
            'autoplay'=> $this->autoplay ? true : false
        ];
        $opt = array_merge($def, $opt);

        // set style
        $style = '';
        if($opt['styleTag']) {
            $style = Html::styleTag("#$id" . $opt['styleTag']);
            $style = _globalRegion(_baseName(__CLASS__) . '_' . $id, $style);
        }

        // return player
       return $style . Html::el('dotlottie-player', '', $opt,['allowEmpty' => true]). $this->loadScript();
    }

    public function loadScript() {
        $script = Html::scriptSrcTag('https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs',['defer' => true, 'type' => 'module']);
        return _globalRegion(_baseName(__CLASS__), $script);
    }
}
