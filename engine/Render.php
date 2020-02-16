<?php

// PSR - 4
namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params = [])
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        ob_start();
        extract($params);
        $templatePath = App::call()->config['templates_dir'] . $template . ".php";
        if (file_exists($templatePath)) {
            include $templatePath;
        }
        return ob_get_clean();
    }
}