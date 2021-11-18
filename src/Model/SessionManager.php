<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class SessionManager extends AbstractManager
{
    /**
     * Get datas users
     *
     * @return array
     */
    public function getLogin(): array
    {
        $statement = $this->pdo->query('SELECT musician.id, musician.nickname, musician.password, musician.avatar 
                                        FROM musician;');
        $logs = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $logs;
    }

    /**
     * Verify if user Exists
     *
     * @param  string $nickname
     * @return bool
     */
    public function userExists(string $nickname): bool
    {
        $statement = $this->pdo->prepare('SELECT musician.id FROM musician WHERE nickname = :nickname;');
        $statement->bindValue(':nickname', $nickname, \PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetchAll();

        if (count($row) === 0) {
            return false;
        } else {
            return true;
        }
    }
}
