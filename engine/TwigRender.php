<?php


namespace app\engine;


use app\interfaces\IRenderer;

class TwigRender implements IRenderer
{
    private $twig;

    public function __construct()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        $loader = new \Twig\Loader\FilesystemLoader('../twigtemplates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function renderTemplate($template, $params = []) {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'template' => $template,
                'params' => '$params'
            ]
        ]);
        return $this->twig->render($template . '.twig', $params);
    }
}