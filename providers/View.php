<?php
namespace App\Providers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function render($template, $data = [])
    {
        $loader = new FilesystemLoader('views');
        $twig   = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        $twig->addGlobal('uploads', UPLOADS);
        $twig->addGlobal('session', $_SESSION);
        if (isset($_SESSION['fingerPrint']) and $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
            $guest = false;
        } else {
            $guest = true;
        }
        $twig->addGlobal('guest', $guest);
        echo $twig->render($template . ".php", $data);
    }

    public static function redirect($url)
    {
        return header('location:' . BASE . '/' . $url);
    }
}