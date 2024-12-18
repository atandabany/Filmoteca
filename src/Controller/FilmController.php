<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\FilmEntity;
use App\Repository\FilmRepository;
use App\Core\TwigEnvironment;

class FilmController
{

    private FilmRepository $filmRepository;
    private \Twig\Environment $twig;

    public function __construct()
    {
        $this->filmRepository = new FilmRepository();
        $this->twig = TwigEnvironment::create();
    }

    public function list(array $queryParams)
    {
        //$filmRepository = new FilmRepository();
        //$films = $filmRepository->findAll();

       

        /* $filmEntities = [];
        foreach ($films as $film) {
            $filmEntity = new Film();
            $filmEntity->setId($film['id']);
            $filmEntity->setTitle($film['title']);
            $filmEntity->setYear($film['year']);
            $filmEntity->setType($film['type']);
            $filmEntity->setSynopsis($film['synopsis']);
            $filmEntity->setDirector($film['director']);
            $filmEntity->setCreatedAt(new \DateTime($film['created_at']));
            $filmEntity->setUpdatedAt(new \DateTime($film['updated_at']));

            $filmEntities[] = $filmEntity;
        } */

        // dd($films);

        // header('Content-Type: application/json');
        // echo json_encode($films);


        // Charger Twig
        //$twig = TwigEnvironment::create();

        // Rendre la vue Twig
        $films = $this->filmRepository->findAll();

        // Utilisation de Twig pour rendre la vue
        echo $this->twig->render('list.html.twig', [
            'films' => $films, // On passe les films à la vue
        ]);
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