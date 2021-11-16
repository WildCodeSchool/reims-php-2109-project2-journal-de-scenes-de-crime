<?php

namespace App\Model;

class HashtagManager extends AbstractManager
{
    public const TABLE = 'hashtag';

    /**
     * Insert new hashtag in database
     */
    public function insert(array $hashtag): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`keyword`) VALUES (:keyword)");
        $statement->bindValue('keyword', $hashtag['keyword'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function selectOneByKeyword(string $keyword)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE keyword=:keyword");
        $statement->bindValue('keyword', $keyword, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
