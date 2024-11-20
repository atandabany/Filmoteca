<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FilmRepository;
use App\Entity\FilmEntity;


class FilmController
{
    public function list()
    {
        $filmRepository = new FilmRepository();
        $films = $filmRepository->findAll();

        if (empty($films)) {
            http_response_code(204); // Pas de contenu
            echo json_encode(['message' => 'Aucun film trouvé.']);
            return;
        }

        $filmEntities = [];
        foreach ($films as $film) {
            $filmEntity = new FilmEntity();
            $filmEntity->setId((int) $film['id'])
                       ->setTitle($film['title'])
                       ->setYear(isset($film['year']) ? (int) $film['year'] : null)
                       ->setType($film['type'])
                       ->setSynopsis($film['synopsis'] ?? null)
                       ->setDirector($film['director'] ?? null)
                       ->setCreatedAt(new \DateTime($film['created_at']))
                       ->setUpdatedAt(isset($film['updated_at']) ? new \DateTime($film['updated_at']) : null)
                       ->setDeletedAt(isset($film['deleted_at']) ? new \DateTime($film['deleted_at']) : null);

            $filmEntities[] = $filmEntity->toArray();
        }

        header('Content-Type: application/json');
        echo json_encode($filmEntities, JSON_PRETTY_PRINT);
    }

    public function read()
    {
        // Récupérer l'identifiant du film (par exemple, via $_GET)
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'L\'identifiant du film est requis.']);
            return;
        }

        $filmRepository = new FilmRepository();
        $film = $filmRepository->find($id);

        if (!$film) {
            http_response_code(404);
            echo json_encode(['error' => 'Film non trouvé.']);
            return;
        }

        // Convertir l'objet FilmEntity en tableau pour l'affichage JSON
        $filmData = [
            'id' => $film->getId(),
            'title' => $film->getTitle(),
            'year' => $film->getYear(),
            'type' => $film->getType(),
            'synopsis' => $film->getSynopsis(),
            'director' => $film->getDirector(),
            'createdAt' => $film->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $film->getUpdatedAt() ? $film->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            'deletedAt' => $film->getDeletedAt() ? $film->getDeletedAt()->format('Y-m-d H:i:s') : null
        ];

        header('Content-Type: application/json');
        echo json_encode($filmData, JSON_PRETTY_PRINT);
    }


    public function create()
    {
        echo "Création d'un film";
    }

    // Convertir l'objet FilmEntity en tableau pour l'affichage JSON
    $filmData = [
        'id' => $film->getId(),
        'title' => $film->getTitle(),
        'year' => $film->getYear(),
        'type' => $film->getType(),
        'synopsis' => $film->getSynopsis(),
        'director' => $film->getDirector(),
        'createdAt' => $film->getCreatedAt()->format('Y-m-d H:i:s'),
        'updatedAt' => $film->getUpdatedAt() ? $film->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        'deletedAt' => $film->getDeletedAt() ? $film->getDeletedAt()->format('Y-m-d H:i:s') : null
    ];

    header('Content-Type: application/json');
    echo json_encode($filmData, JSON_PRETTY_PRINT);
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