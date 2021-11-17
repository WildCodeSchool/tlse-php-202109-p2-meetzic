<?php

namespace App\Model;

class FilterModel extends AbstractManager
{
    public function getAllInstrument(): ?array
    {
        $statement = $this->pdo->query('SELECT instrument.name, instrument.id FROM instrument');
        $result1 = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result1 === false ? null : $result1;
    }

    public function getAllGenre(): ?array
    {
        $statement = $this->pdo->query('SELECT genre.id, genre.name FROM genre');
        $result1 = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result1 === false ? null : $result1;
    }
}
