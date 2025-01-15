<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\TemplateRenderer;
use App\Entity\Film;
use App\Repository\FilmRepository;
use App\Service\EntityMapper;

class FilmController
{
    private TemplateRenderer $renderer;

    public function __construct()
    {
        $this->renderer = new TemplateRenderer();
    }

    public function list(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $films = $filmRepository->findAll();

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

        //dd($films);

        echo $this->renderer->render('film/list.html.twig', [
            'films' => $films,
        ]);

        // header('Content-Type: application/json');
        // echo json_encode($films);
    }


    public function create(): void
    {
        $filmRepository = new FilmRepository();
        $entityMapper = new EntityMapper();

        if (!empty($_POST)) {
            try {
                $film = $entityMapper->mapToEntity(data: $_POST, entityClass: Film::class);
                $film->setCreatedAt(new \DateTime());
                $film->setUpdatedAt(new \DateTime());
                $filmRepository->save($film);
                header('Location: /film/list');
                exit;
            } catch (\Exception $exception) {
                echo 'Erreur: ' . $exception->getMessage();
            }
        }
        echo $this->renderer->render('film/create.html.twig');
    }


    public function read(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $film = $filmRepository->find((int) $queryParams['id']);
        echo $this->renderer->render('film/read.html.twig', ['film' => $film,]);
        //dd($film);
    }


    public function update(array $queryParams)
    {
        if (isset($queryParams['id'])) {
            $filmRepository = new FilmRepository();
            $entityMapper = new EntityMapper();
            $film = $filmRepository->find((int) $queryParams['id']);
            if (!empty($_POST)) {
                try {
                    $updatedFilm = $entityMapper->mapToEntity($_POST, Film::class);
                    $updatedFilm->setId($film->getId());
                    $updatedFilm->setCreatedAt($film->getCreatedAt());
                    $updatedFilm->setUpdatedAt(new \DateTime()); 
                    $filmRepository->modify($updatedFilm);
                    header('Location: /film/list');
                    exit;
                } catch (\Exception $exception) {
                    echo 'Erreur: ' . $exception->getMessage();
                }
            }
            echo $this->renderer->render('film/update.html.twig', ['film' => $film]);
        }
    }


    public function delete()
    {
        if (isset($_GET['id'])) {
            $filmRepository = new FilmRepository();
            $filmId = (int) $_GET['id'];
            $filmRepository->delete($filmId);
            header('Location: /film/list');
            exit;
        }
    }
}
