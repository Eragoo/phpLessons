<?php

class dbClass
{

    private function getConnectionParams($cfgFileName)
    {
       $res = $json_str = file_get_contents($cfgFileName);
       $cfg = json_decode($json_str, true);
       return $cfg;
    }

    private function getConnection()
    {
        $cfg = $this->getConnectionParams("/Applications/MAMP/htdocs/webpra/2/model/database/db_config.json");
        try{
            $pdo = new PDO("{$cfg['dsn']}", "{$cfg['user']}", "{$cfg['password']}");
        } catch (PDOException $e) {
            print "Couldn't create table: " . $e->getMessage() . "<br/>";
        }
        return $pdo;
    }

    public function write($values)
    {
        $pdo = $this->getConnection();
        $sql = "INSERT INTO posts (username, content, datetime) VALUE (:username, :content, :datetime)";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $values["username"]);
        $statement->bindParam(":content", $values["content"]);
        $statement->bindParam(":datetime", $values["datetime"]);
        $res = $statement->execute();

        $pdo = null;
    }
//I can combine all selects into one query () method, but I'm very lazy

     public function selectAll()
    {
        $pdo = $this->getConnection();
        $sql = "SELECT username, content, datetime FROM posts WHERE id>0 ORDER BY datetime DESC";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function selectNotes($start, $per_page)
    {
        $pdo = $this->getConnection();
        $sql = "SELECT username, content, datetime FROM posts WHERE id>0 ORDER BY datetime DESC LIMIT {$start},{$per_page}";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }


    public function getCount()
    {
        $pdo = $this->getConnection();
        $sql = "SELECT count(*) FROM posts";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $count = $res[0]['count(*)'];

        return $count;

    }
}









