<?php 

/*
    ./app/models/postModel.php
*/

namespace App\Models\PostModel;

function findAll(\PDO $conn, int $limit = 10){
    $sql = "SELECT *,
            p.id as postID,
            c.id as categorieId,
            c.name as categorieName,
            p.created_at as postDate
            FROM posts p
            JOIN categories c on p.category_id = c.id
            ORDER BY p.created_at DESC 
            LIMIT :limit;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':limit',$limit,\PDO::PARAM_INT);
    $rs->execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}

function findOneById(\PDO $conn, int $id) :array {
    $sql = "SELECT *,
            p.id as postID,
            c.id as categorieId,
            c.name as categorieName,
            p.created_at as postDate
            FROM posts p
            JOIN categories c on p.category_id = c.id
            WHERE p.id = :id;";
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
                quote = :quote,
                category_id = :category_id ;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':title', $data['title'], \PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], \PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], \PDO::PARAM_STR);
    $rs->bindValue(':category_id', $data['category_id'], \PDO::PARAM_INT);
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
                quote = :quote,
                category_id = :category_id
            WHERE id = :id;";
    $rs = $conn->prepare($sql);
    $rs->bindValue(':id', $id, \PDO::PARAM_INT);
    $rs->bindValue(':title', $data['title'], \PDO::PARAM_STR);
    $rs->bindValue(':text', $data['text'], \PDO::PARAM_STR);
    $rs->bindValue(':quote', $data['quote'], \PDO::PARAM_STR);
    $rs->bindValue(':category_id', $data['category_id'], \PDO::PARAM_INT);
    return $rs->execute();
}

function findNumberOfPostsByCategories(\PDO $conn) {
    $sql = "SELECT COUNT(id) AS nbrPostsByCategory, category_id
    FROM posts
    GROUP BY category_id;";
    $rs = $conn -> query($sql);
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}