<?php

namespace App\Model;

class ProfileManager extends AbstractManager
{
    public function selectNicknameById(int $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT m.avatar, m.nickname, m.experience, m.status, m.description, 
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
        $tupple = $statement->fetch(\PDO::FETCH_ASSOC);

        return $tupple;
    }
}
