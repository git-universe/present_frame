<?php

/**
 * Class Ajax
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Ajax extends Controller
{
    public function index()
    {
        echo "Tu nimaš kj iskat... ajde beži!";
    }

    public function comment() {

        if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            //Request identified as ajax request
            
            $ajax = ($_SERVER[ 'HTTP_X_REQUESTED_WITH' ] === 'XMLHttpRequest');

            $comment_model = $this->loadModel('CommentModel');

            switch ($_POST['type']) {
                case 'insert':
                    $newId = $comment_model->newComment($_POST['userId'], $_POST['presentationId'], $_POST['comment']);
                    if($newId) {
                        header('Content-Type: application/json; charset=UTF-8');
                        echo json_encode($newId);
                    } else {
                        header('HTTP/1.1 500 Internal Server Error');
                        header('Content-Type: application/json; charset=UTF-8');
                        die(json_encode(array('message' => 'Could not insert new comment', 'code' => 1337)));
                    }
                    break;

                case 'edit':
                    if ( $comment_model->setComment($_POST['commentId'], $_POST['comment']) ){
                        echo json_encode("comment updated");
                    } else {
                        header('HTTP/1.1 500 Internal Server Error');
                        header('Content-Type: application/json; charset=UTF-8');
                        die(json_encode(array('message' => 'Could not update comment', 'code' => 1337)));
                    }
                    break;
            }
            
        } else {
            header('Location: '. URL.$_SESSION['lang']);
        }
    }
}