<?php

namespace App\Repository;

use PDO;

class FilmRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllFilms(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM films");
        return $stmt->fetchAll();
    }

    public function getFilmById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM films WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function createFilm(string $title, string $director, int $year): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO films (title, director, year) VALUES (:title, :director, :year)"
        );
        $stmt->execute(['title' => $title, 'director' => $director, 'year' => $year]);
    }

    public function updateFilm(int $id, string $title, string $director, int $year): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE films SET title = :title, director = :director, year = :year WHERE id = :id"
        );
        $stmt->execute(['id' => $id, 'title' => $title, 'director' => $director, 'year' => $year]);
    }

    public function deleteFilm(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM films WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
