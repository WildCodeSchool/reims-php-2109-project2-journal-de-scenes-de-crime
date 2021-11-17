<?php

namespace App\Model;

class CrimeSceneManager extends AbstractManager
{
    public const TABLE = 'crime_scene';

    /**
     * Insert new crime scene in database
     */
    public function insert(array $crimeScene): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (name, title, adress, 
        description, date, victim) VALUES (:name, :title, :adress, :description, :date, :victim)");
        $statement->bindValue('name', $crimeScene['name'], \PDO::PARAM_STR);
        $statement->bindValue('title', $crimeScene['title'], \PDO::PARAM_STR);
        $statement->bindValue('adress', $crimeScene['adress'], \PDO::PARAM_STR);
        $statement->bindValue('description', $crimeScene['description'], \PDO::PARAM_STR);
        $statement->bindValue('date', $crimeScene['date'], \PDO::PARAM_STR);
        $statement->bindValue('victim', $crimeScene['victim'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
        /**
         * Update crime scene in database
         */
    public function update(array $crimeScene): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET name=:name, title=:title, adress=:adress, description=:description, 
        date=:date, victim=:victim WHERE id=:id");
        $statement->bindValue('id', $crimeScene['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $crimeScene['name'], \PDO::PARAM_STR);
        $statement->bindValue('title', $crimeScene['title'], \PDO::PARAM_STR);
        $statement->bindValue('adress', $crimeScene['adress'], \PDO::PARAM_STR);
        $statement->bindValue('description', $crimeScene['description'], \PDO::PARAM_STR);
        $statement->bindValue('date', $crimeScene['date'], \PDO::PARAM_STR);
        $statement->bindValue('victim', $crimeScene['victim'], \PDO::PARAM_STR);
        return $statement->execute();
    }
        /**
        * Delete row form an ID
        */
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
    /**
     * Search in crime scene
     */
    public function search(string $query): array
    {
        $statement = $this->pdo->prepare("SELECT crime_scene.id, title, description, name, date, adress, victim, 
        GROUP_CONCAT(keyword) FROM " . static::TABLE .
        " LEFT join crime_scene_hashtag on crime_scene.id = crime_scene_hashtag.crimescene_id" .
        " LEFT join hashtag on crime_scene_hashtag.hashtag_id = hashtag.id " .
        " WHERE title LIKE :q OR description LIKE :q OR name LIKE :q OR adress 
        LIKE :q OR date LIKE :q OR victim LIKE :q OR keyword LIKE :q group by crime_scene.id");
        $statement->bindValue('q', "%$query%", \PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
}
