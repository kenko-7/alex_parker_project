<?php 
/*
    ./app/controllers/categoriesController.php
 */

namespace App\Controllers\CategoriesController;
use \App\Models\CategoriesModel;
use App\Models\PostModel;


function indexAction(\PDO $conn) {
    include_once '../app/models/categoriesModel.php';
    $categories = CategoriesModel\findAll($conn);
    include_once '../app/models/postModel.php';
    $nbrPosts = PostModel\findNumberOfPostsByCategories($conn);
    include '../app/views/categories/index.php';
}
