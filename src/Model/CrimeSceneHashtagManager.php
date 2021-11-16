<?php

namespace App\Model;

class CrimeSceneHashtagManager extends AbstractManager
{
    public const TABLE = 'crime_scene_hashtag';

    /**
     * Insert new join in database
     */
    public function insert(array $join): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        "(crimescene_id, hashtag_id) VALUES (:crimescene_id, :hashtag_id)");
        $statement->bindValue('crimescene_id', $join['crimescene_id'], \PDO::PARAM_INT);
        $statement->bindValue('hashtag_id', $join['hashtag_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
