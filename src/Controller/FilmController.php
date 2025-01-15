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

        // Si le formulaire est soumis
        if (!empty($_POST)) {
            // Mapper les données POST vers une entité Film
            try {
                $film = $entityMapper->mapToEntity(data : $_POST, entityClass : Film::class);
                $film->setCreatedAt(new \DateTime());
                $film->setUpdatedAt(new \DateTime());

                $filmRepository->save($film);

                // Rediriger vers liste des films 
                header('Location: /film/list'); 
                exit;
            } catch (\Exception $exception) {
                
            }
        }

        echo $this->renderer->render('film/create.html.twig'); 
    }




    public function read(array $queryParams)
    {
        $filmRepository = new FilmRepository();
        $film = $filmRepository->find((int) $queryParams['id']);
        echo $this->renderer->render('film/read.html.twig', ['film' => $film,]);
        
        
        dd($film); //A retirer
    }

    public function update(array $queryParams)
{
    $filmRepository = new FilmRepository();
    $entityMapper = new EntityMapper();

    // Récupérer le film à mettre à jour en fonction de son ID
    $originalFilm = $filmRepository->find((int) $queryParams['id']);

    // Si le formulaire est soumis
    if (!empty($_POST)) {
        try {
            // Mapper les données POST vers une nouvelle entité Film
            $film = $entityMapper->mapToEntity($_POST, Film::class);

            // Conserver l'ID et la date de création de l'objet d'origine
            $film->setId($originalFilm->getId());
            $film->setCreatedAt($originalFilm->getCreatedAt());

            // Mettre à jour la date de modification
            $film->setUpdatedAt(new \DateTime());

            // Sauvegarder les modifications
            $filmRepository->modify($film);

            // Rediriger vers la liste des films après la mise à jour
            header('Location: /film/list');
            exit;
        } catch (\Exception $exception) {
            // Gérer les erreurs si le mappage échoue
            echo 'Erreur: ' . $exception->getMessage();
        }
    }

    // Rendre le formulaire avec les données du film
    echo $this->renderer->render('film/update.html.twig', ['film' => $originalFilm]);
}






    public function delete()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $filmRepository = new FilmRepository();
            $filmId = (int) $_GET['id']; // Récupérer l'ID du film

            $filmRepository->delete($filmId);

            // Rediriger vers la liste des films après la suppression
            header('Location: /film/list');
            exit;
        }
    }
        
        

}
