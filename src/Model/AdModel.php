<?php

namespace App\Model;

class AdModel extends AbstractManager
{
    public function getAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM ad');
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
}

