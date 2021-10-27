<?php

namespace App\Model;

class CrimeSceneManager extends AbstractManager
{
        public const TABLE = 'crime_scene';
    
        /**
         * Show crime scene in database
         */
        public function show()
        {
            $statement = $this->pdo->prepare("SELECT name, title, adress, description, date, victim FROM . self::TABLE");
            return $statement->execute();
        }
        /**
         * Insert new item in database
         */
        public function insert(array $crime_scene): string
        {
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name, title, adress, description, date, victim`) VALUES (:name, :title, :adress, :description, :date, :victime)");
            $statement->bindValue('name', $crime_scene['name'], \PDO::PARAM_STR);
            $statement->bindValue('title', $crime_scene['title'], \PDO::PARAM_STR);
            $statement->bindValue('adress', $crime_scene['adress'], \PDO::PARAM_STR);
            $statement->bindValue('description', $crime_scene['description'], \PDO::PARAM_STR);
            $statement->bindValue('date', $crime_scene['date'], \PDO::PARAM_STR);
            $statement->bindValue('victim', $crime_scene['victim'], \PDO::PARAM_STR);
    
            return $statement->execute();
        }
    
        /**
         * Update item in database
         */
        public function update(array $item): bool
        {
            $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE id=:id");
            $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
            $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);
    
            return $statement->execute();
        }
    
}
