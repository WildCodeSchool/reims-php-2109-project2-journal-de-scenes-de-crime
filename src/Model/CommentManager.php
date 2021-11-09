<?php

namespace App\Model;

class CommentManager extends AbstractManager
{
    public const TABLE = 'comment';

    /**
     * Insert new comment  in database
     */
    public function insert(array $commentScene): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name, message)
         VALUES (:name, :message)");
        $statement->bindValue('name', $commentScene['name'], \PDO::PARAM_STR);
        $statement->bindValue('message', $commentScene['message'], \PDO::PARAM_STR);
        
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    /**
    * Get one row from database by ID.
    *
    */
    public function selectOneByIdWithComment(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT c.name, c.message, c.date FROM " . static::TABLE . " AS c JOIN crime_scene AS cs ON cs.id = c.crimescene_id WHERE cs.id = :id;");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
