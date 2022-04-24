<?php

namespace Framework;

use Twig\Environment;

class Controller
{
    public Environment $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../src/View');
        $this->twig = new \Twig\Environment($loader);
    }
}