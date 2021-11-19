<?php

namespace App\Model;

class AdModel extends AbstractManager
{
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar, musician.id FROM ad
        JOIN musician ON musician.id=ad.musician_id;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad WHERE id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function getAdBand(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar, musician.id 
        FROM ad JOIN musician ON musician.id=ad.musician_id 
        WHERE musician.band_id IS NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdMusician(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar, musician.id 
        FROM ad JOIN musician ON musician.id=ad.musician_id 
        WHERE musician.band_id IS NOT NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdBandSearch(?string $query): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad 
        JOIN musician ON musician.id = ad.musician_id 
        WHERE ad.description LIKE :query OR ad.title LIKE :query 
        HAVING musician.band_id IS NOT NULL;');
        $statement->bindValue(':query', "%$query%", \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function getAdMusicianSearch(?string $query): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad 
        JOIN musician ON musician.id = ad.musician_id 
        WHERE ad.description LIKE :query OR ad.title LIKE :query 
        HAVING musician.band_id IS NULL;');
        $statement->bindValue(':query', "%$query%", \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function getAdSearch(?string $query): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad
        JOIN musician ON musician.id = ad.musician_id 
        WHERE ad.description LIKE :query OR ad.title LIKE :query');
        $statement->bindValue(':query', "%$query%", \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function setAd(array $adInputs)
    {
        $statement = $this->pdo->prepare('INSERT INTO ad (title, description, musician_id) 
        VALUES (:title, :description, (SELECT musician.id FROM musician WHERE musician.id = :musician_id));');
        $statement->bindValue(':title', $adInputs['title'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $adInputs['description'], \PDO::PARAM_STR);
        $statement->bindValue(':musician_id', $_SESSION['id'], \PDO::PARAM_STR);
        $statement->execute();
    }

    public function getAdById(string $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad WHERE musician_id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }
}
