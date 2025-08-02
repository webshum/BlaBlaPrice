<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/' . THEME;

    public $css = [];

    public $js = [];

    public $depends = [];

    public $jsOptions = [
        'type' => 'module',
        'defer' => true,
    ];

    public function init()
    {
        parent::init();
        
        if ($_ENV['APP_ENV'] === 'local') {
            $this->js[] = 'http://localhost:5173/@vite/client';
            $this->js[] = 'http://localhost:5173/resources/js/index.js';
        } else {
            $path = "@frontend/web/" . THEME . "/assets/.vite/manifest.json";
            $manifestPath =  Yii::getAlias($path);
            
            if (file_exists($manifestPath)) {
                $manifest = json_decode(file_get_contents($manifestPath), true);

                if (isset($manifest['resources/js/index.js'])) {
                    $file = $manifest['resources/js/index.js']['file'] ?? null;
                    $css = $manifest['resources/js/index.js']['css'][0] ?? null;

                    if ($file) {
                        $this->js[] = 'assets/' . $file;
                    }

                    if ($css) {
                        $this->css[] = 'assets/' . $css;
                    }
                }
            }
        }
    }
}
