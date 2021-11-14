<?php

namespace App\Model;

class ProfileManager extends AbstractManager
{
    public function selectAllColumnById(int $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT m.avatar, m.nickname, m.experience, m.status, m.description, 
            i.name instrument, g.name style, b.name band, ad.title, ad.description annonce
            FROM musician m 
            LEFT JOIN musician_has_genre mg ON m.id = mg.musician_id
            LEFT JOIN genre g ON g.id = mg.genre_id
            LEFT JOIN instrument i ON i.id = m.instrument_id
            LEFT JOIN band b ON b.id = m.band_id
            LEFT JOIN ad ON ad.musician_id = m.id
            WHERE m.id = :id;'
        );
        $statement->bindValue(':id', $id, \PDO::PARAM_STR);
        $statement->execute();
        $tupple = $statement->fetch(\PDO::FETCH_ASSOC);

        return $tupple;
    }

    public function editProfile(array $valuesInput): int
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO musician
            (nickname, password, email, avatar, experience/*, description*/, status, instrument_id)
            VALUES 
            (:nickname, :password, :email, :avatar, :experience/*, :description*/, :status, 
            (SELECT :instrument 
            FROM instrument 
            WHERE instrument.id = :instrument));'
        );
        $statement->bindValue(':nickname', $valuesInput['nickname'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $valuesInput['password'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $valuesInput['email'], \PDO::PARAM_STR);
        $statement->bindValue(':avatar', $valuesInput['avatar'], \PDO::PARAM_STR);
        $statement->bindValue(':experience', $valuesInput['experience'], \PDO::PARAM_STR);
        //$statement->bindValue(':description', $valuesInput['description'], \PDO::PARAM_STR);
        $statement->bindValue(':status', $valuesInput['status'], \PDO::PARAM_INT);
        $statement->bindValue(':instrument', $valuesInput['instrument'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function insertBand(array $band): int
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO band
            (name, description, status)
            VALUES (
            ":nameBand", 
            ":descriptionBand", 
            ":statusBand");'
        );
        $statement->bindValue(':nameBand', $band['nameBand'], \PDO::PARAM_STR);
        $statement->bindValue(':descriptionBand', $band['descriptionBand'], \PDO::PARAM_STR);
        $statement->bindValue(':statusBand', $band['statusBand'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectAllInputValidateProfile(int $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT m.avatar, m.nickname, m.experience, m.status, m.description, m.password, m.email, 
            i.name instrument, g.name style, b.name band
            FROM musician m 
            LEFT JOIN musician_has_genre mg ON m.id = mg.musician_id
            LEFT JOIN genre g ON g.id = mg.genre_id
            LEFT JOIN instrument i ON i.id = m.instrument_id
            LEFT JOIN band b ON b.id = m.band_id
            WHERE m.id = :id;'
        );
        $statement->bindValue(':id', $id, \PDO::PARAM_STR);
        $statement->execute();
        $input = $statement->fetch(\PDO::FETCH_ASSOC);

        return $input;
    }
}
