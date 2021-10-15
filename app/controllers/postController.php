<?php 

/*
    ./app/controllers/postController.php
*/

namespace App\Controllers\PostController;
use App\Models\PostModel;

function indexAction(\PDO $conn) {
    include_once '../app/models/postModel.php';
    $posts = postModel\findAll($conn);
    GLOBAL $content, $titleZone;
    ob_start();
    include '../app/views/posts/index.php';
    $content = ob_get_clean();
}