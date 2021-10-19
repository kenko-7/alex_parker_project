<?php
/*
./app/router.php
*/


// ROUTE DETAIL D'UN POST
// PATTERN: ?postID=x
// CTRL: postsController
// ACTION: show
if (isset($_GET['postID'])) :
    include_once '../app/controllers/postController.php';
    \App\Controllers\PostController\showAction($conn, $_GET['postID']);

elseif  (isset($_GET['post'])) :
    include_once '../app/router/postRouter.php';

else :
    include '../app/controllers/postController.php';
    App\Controllers\PostController\indexAction($conn);

endif;
