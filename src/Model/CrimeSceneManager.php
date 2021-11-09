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
}
