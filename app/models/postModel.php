<?php 

/*
    ./app/models/postModel.php
*/

namespace App\Models\PostModel;

function findAll(\PDO $conn, int $limit = 10){
    $sql = "SELECT * 
            FROM posts
            ORDER BY created_at DESC
            LIMIT :limit;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findOneById(\PDO $conn, int $id) :array {
    $sql = "SELECT *
            FROM posts 
            WHERE id = :id;";
    $rs= $conn->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetch(\PDO::FETCH_ASSOC);
}

function insert(\PDO $conn, array $data) :int {
    $sql = "INSERT INTO posts
            SET title = :title,
                text = :text,
                created_at = NOW(),
                quote = :quote ;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':title', $data['title'], \PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], \PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], \PDO::PARAM_STR);
    $rs->execute();
    return $conn->lastInsertId();
}

function deleteOneById(\PDO $conn, int $id) {
    $sql = "DELETE FROM posts
            WHERE id = :id;";
            $rs = $conn -> prepare($sql);
            $rs->bindValue(':id', $id, \PDO::PARAM_INT);
            return ($rs->execute())?1:0;
}


function updateOneById(\PDO $conn,int $id, array $data){
    $sql = "UPDATE posts 
            SET title = :title,
                text = :text,
                updated_at = NOW(),
                quote = :quote
            WHERE id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->bindValue(':title', $data['title'], \PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], \PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], \PDO::PARAM_STR);
    return $rs->execute();
}