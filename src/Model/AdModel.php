<?php

namespace App\Model;

class AdModel extends AbstractManager
{
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar FROM ad
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
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar FROM ad
        JOIN musician ON musician.id=ad.musician_id 
        WHERE musician.band_id IS NOT NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAdMusician(): array
    {
        $statement = $this->pdo->query('SELECT ad.title, ad.description, musician.avatar FROM ad
        JOIN musician ON musician.id=ad.musician_id  
        WHERE musician.band_id IS NULL;');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSearch(): array
    {
        $statement = $this->pdo->query('SELECT * FROM WhereIsMYBand ORDER BY id DESC');
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}
