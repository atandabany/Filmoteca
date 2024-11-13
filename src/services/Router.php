<?php

class Router
{
    public function route()
    {
        // Récupérer l'URL demandée
        $url = $_SERVER['REQUEST_URI'];

        // Nettoyer l'URL pour obtenir la route (exclure le préfixe '/')
        $route = ltrim($url, '/');

        // Afficher la route sélectionnée
        var_dump($route);
    }
}
