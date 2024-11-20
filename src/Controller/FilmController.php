<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FilmRepository;

class FilmController
{
    public function list()
    {
        $filmRepository = new FilmRepository();
        $films = $filmRepository->findAll();

        header('Content-Type: application/json');
        echo json_encode($films);
    }

    public function create()
    {
        echo "Création d'un film";
    }

    public function read()
    {
        echo "Lecture d'un film";
    }

    public function update()
    {
        echo "Mise à jour d'un film";
    }

    public function delete()
    {
        echo "Suppression d'un film";
    }
}