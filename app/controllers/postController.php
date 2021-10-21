<?php 

/*
    ./app/controllers/postController.php
*/

namespace App\Controllers\PostController;
use \App\Models\PostModel;

function indexAction(\PDO $conn) {
    include_once '../app/models/postModel.php';
    $posts = PostModel\findAll($conn);
    GLOBAL $content, $titleZone;
    ob_start();
    include '../app/views/posts/index.php';
    $content = ob_get_clean();
}

function showAction(\PDO $conn, int $id) {
    include_once '../app/models/postModel.php';
    $post = PostModel\findOneById($conn, $id);
    GLOBAL $content;
    ob_start();
       include '../app/views/posts/show.php';
    $content = ob_get_clean();
}

function addFormAction(\PDO $conn) {
    GLOBAL $content, $titleZone;
    $titleZone = 'Add a post';
    ob_start();
    include '../app/views/posts/addForm.php';
    $content = ob_get_clean();

}

function addInsertAction(\PDO $conn) {
    include_once '../app/models/postModel.php';
    
    PostModel\insert($conn, $_POST);
    
    header('location:' . BASE_URL);
}

function deleteAction(\PDO $conn, int $id) {
    include_once '../app/models/postModel.php';
      $reponse = PostModel\deleteOneById($conn,$id);
      if($reponse == 1):
        header('location:' . BASE_URL);
      else:
        GLOBAL $content;
        $content = "<h1>Erreur la page n'a pas pu être affichée</h1>
                    <div>
                    <a href=".BASE_URL.">Retour</a>
                    </div>";

      endif;
}

function updateFormAction(\PDO $conn, int $id) {
    include_once '../app/models/postModel.php';
    $post = PostModel\findOneById($conn,$id);
    GLOBAL $content, $titleZone;
    $titleZone = "Edit a post";
    ob_start();
    include '../app/views/posts/updateForm.php';
    $content = ob_get_clean();
}



function updateEditAction(\PDO $conn, int $id, array $data){
    include_once '../app/models/postModel.php';
    PostModel\updateOneById($conn,$id,$data);
    header("location: " . BASE_URL . "post/". $id . "/" .\Core\Functions\slugify($_POST["title"]) .".html");
}

    
