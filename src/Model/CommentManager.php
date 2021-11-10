<?php

namespace App\Model;

class CommentManager extends AbstractManager
{
    public const TABLE = 'comment';

    /**
     * Insert new comment  in database
     */
    public function insert(array $sceneComments): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name, message, crimescene_id)
         VALUES (:name, :message, :crimescene_id)");
        $statement->bindValue('name', $sceneComments['name'], \PDO::PARAM_STR);
        $statement->bindValue('message', $sceneComments['message'], \PDO::PARAM_STR);
        $statement->bindValue('crimescene_id', $sceneComments['crimescene_id'], \PDO::PARAM_INT);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    /**
    * Get one row from database by ID.
    *
    */
    public function selectAllByCrimeSceneId(int $crimeSceneId)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT name, message, date FROM " . static::TABLE .
        " WHERE crimescene_id = :id;");
        $statement->bindValue('id', $crimeSceneId, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
