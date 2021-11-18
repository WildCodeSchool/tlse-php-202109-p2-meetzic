<?php

namespace App\Model;

class ProfileManager extends AbstractManager
{

    /**
     * selectAllColumnById return all column for profile public
     *
     * @param  int $id
     * @return array
     */
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

    /**
     * editProfile insert all elements of profile private
     *
     * @param  array $valuesInput
     * @return int
     */
    public function editProfile(array $valuesInput): int
    {
        $bandId = null;
        if (!empty($valuesInput['band']) && $valuesInput['band'] === "1") {
            $statement = $this->pdo->prepare(
                'INSERT INTO band
                (name, description, status)
                VALUES 
                (:name, :description, :status);'
            );
            $statement->bindValue(':name', $valuesInput['bandName'], \PDO::PARAM_STR);
            $statement->bindValue(':description', $valuesInput['description'], \PDO::PARAM_STR);
            $statement->bindValue(':status', $valuesInput['status'], \PDO::PARAM_INT);
            $statement->execute();
            $bandId = (int)$this->pdo->lastInsertId();
        }

        $statement = $this->pdo->prepare(
            'INSERT INTO musician
            (nickname, password, email, avatar, experience, description, status, instrument_id, band_id)
            VALUES 
            (:nickname, :password, :email, :avatar, :experience, :description, :status, 
            (SELECT :instrument 
            FROM instrument 
            WHERE instrument.id = :instrument), 
            :bandId);'
        );
        $statement->bindValue(':nickname', $valuesInput['nickname'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $valuesInput['password'], \PDO::PARAM_STR);
        $statement->bindValue(':email', $valuesInput['email'], \PDO::PARAM_STR);
        $statement->bindValue(':avatar', $valuesInput['avatar'], \PDO::PARAM_STR);
        $statement->bindValue(':experience', $valuesInput['experience'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $valuesInput['description'], \PDO::PARAM_STR);
        $statement->bindValue(':status', $valuesInput['status'], \PDO::PARAM_INT);
        $statement->bindValue(':instrument', $valuesInput['instrument'], \PDO::PARAM_INT);
        $statement->bindValue(':bandId', $bandId, \PDO::PARAM_INT);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * selectAllInputValidateProfile select all elements for profile private
     *
     * @param  string $id
     * @return array
     */
    public function selectAllInputValidateProfile(string $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT m.id, m.avatar, m.nickname, m.experience, m.status, m.description, m.password, m.email, 
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

    /**
     * deleteProfile
     *
     * @param  int $id
     * @return void
     */
    public function deleteProfile($id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM musician_has_genre WHERE musician_id = :idmusician;');
        $statement->bindValue(':idmusician', $id, \PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->pdo->prepare('DELETE FROM ad WHERE musician_id = :idmusician;');
        $statement->bindValue(':idmusician', $id, \PDO::PARAM_INT);
        $statement->execute();

        $statement = $this->pdo->prepare('DELETE FROM musician WHERE id = :id;');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
