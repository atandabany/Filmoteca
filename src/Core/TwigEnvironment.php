<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEnvironment
{
    public static function create(): Environment
    {
        // Définit le dossier où se trouvent les templates (vues)
        $loader = new FilesystemLoader(__DIR__ . '/../templates');

        // Initialise Twig avec le chargeur sans options de cache ni debug
        return new Environment($loader);
    }
}
