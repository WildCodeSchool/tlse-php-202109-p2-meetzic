<?php

namespace App\Model;

class FilterModel extends AbstractManager
{
    public function getAllInstruments(): ?array
    {
        $statement = $this->pdo->query('SELECT instrument.name, instrument.id FROM instrument');
        $instruments = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $instruments === false ? null : $instruments;
    }

    public function getAllGenres(): ?array
    {
        $statement = $this->pdo->query('SELECT genre.id, genre.name FROM genre');
        $genres = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $genres === false ? null : $genres;
    }
}
