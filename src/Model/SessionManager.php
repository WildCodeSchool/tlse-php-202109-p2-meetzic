<?php

namespace App\Model;

class SessionManager extends AbstractManager 
{    
    /**
     * Get datas users
     *
     * @return array
     */
    public function getLogin(): array
    {
        $statement = $this->pdo->query('SELECT musician.id, musician.nickname, musician.password, musician.avatar FROM musician;');
        $logs = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $logs;
    }
    
    /**
     * Add a new user
     *
     * @param  string $newNickname
     * @param  string $newPassword
     * @return void
     */
    public function newUser(string $newNickname, string $newPassword): void
    {
        $statement = $this->pdo->prepare('INSERT INTO musician (nickname, password) VALUES (:newNickname, :newPassword)');
        $statement->bindValue(':newNickname', $newNickname, \PDO::PARAM_STR);
        $statement->bindValue(':newPassword', $newPassword, \PDO::PARAM_STR);

        $row = $statement->execute();
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