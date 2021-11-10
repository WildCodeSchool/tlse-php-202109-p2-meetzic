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
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar, musician.id FROM ad
        JOIN musician ON musician.id=ad.musician_id 
        WHERE musician.band_id IS NOT NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdMusician(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar, musician.id FROM ad
        JOIN musician ON musician.id=ad.musician_id  
        WHERE musician.band_id IS NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdBandSearch(string $search): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad
        JOIN musician ON musician.id = ad.musician_id
        WHERE ad.description LIKE %:search% or title LIKE %:search% HAVING musician.band_id IS NOT NULL;');
        $statement->bindValue(':search', $search, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }

    public function getAdMusicianSearch(string $search): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM ad
        JOIN musician ON musician.id = ad.musician_id WHERE ad.description LIKE %:search% or title LIKE %:search% HAVING musician.band_id IS NULL;');
        $statement->bindValue(':search', $search, \PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result === false ? null : $result;
    }
}
