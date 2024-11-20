<?php

namespace App\Repository;

use App\Core\DatabaseConnection;
use App\Service\EntityMapper;
use App\Entity\Film;

class FilmRepository
{
    private \PDO $db;
    private EntityMapper $entityMapperService;

    public function __construct()
    {
        $this->db = DatabaseConnection::getConnection();
        $this->entityMapperService = new EntityMapper();
    }

    public function findAll(): array
    {
        $query = 'SELECT * FROM film';
        $stmt = $this->db->query($query);

        $films = $stmt->fetchAll();

        // return $this->entityMapperService->mapToEntities($films, Film::class);
        return $films;
    }

    public function find(int $id): ?FilmEntity
    {
        $query = 'SELECT * FROM film WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $film = $stmt->fetch();

        if (!$film) {
            return null; // Si aucun film n'est trouvé, retourner null
        }

        // Mapper les données en objet FilmEntity
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

        return $filmEntity;
    }


}