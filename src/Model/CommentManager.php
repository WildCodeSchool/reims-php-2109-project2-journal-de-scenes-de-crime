<?php

namespace App\Model;

class CrimeSceneComment extends AbstractManager
{
    public const TABLE = 'comment';
    /**
    * Get one row from database by ID.
    *
    */
    public function selectOneByIdWithComment(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
