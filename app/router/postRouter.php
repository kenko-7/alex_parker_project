<?php 
/*
    ./app/router/postRouter/postRouter.php
*/

use \App\Controllers\PostController;
include_once '../app/controllers/postController.php';

switch ($_GET['post']):

    case "addForm":
    PostController\addFormAction($conn);
    break;

    case "addInsert":
    PostController\addInsertAction($conn);
    break;

    case "delete":
    PostController\deleteAction($conn, $_GET['id']);
    break;

    case "updateForm":
    PostController\updateFormAction($conn);
    break;

    case "updateEdit":
    PostController\updateEditAction($conn);
    break;

endswitch;