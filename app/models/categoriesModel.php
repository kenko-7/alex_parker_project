<?php 

/*
    ./app/models/categoriesModel.php
*/

namespace App\Models\CategoriesModel;


function findAll (\PDO $conn) :array {
    $sql = "SELECT * 
            FROM categories 
            ORDER BY name ASC;";
    $rs = $conn->query($sql);
    $rs -> execute();
    return $rs->fetchAll(\PDO::FETCH_ASSOC);
}