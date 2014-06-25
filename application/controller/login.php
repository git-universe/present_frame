<?php

/**
 * Class Login
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Login extends Controller
{

    public function index()
    {
        $lang_model = $this->loadModel('LangModel');
        $reg_model = $this->loadModel('UserModel');
        $cat_model = $this->loadModel('CategoryModel');

        $menuCategories = $cat_model->getMenuCategories($_SESSION['lang']);

        /**
         * @var array $errors Collection of error messages
         */
        $errors = array();
        /**
         * @var array $messages Collection of success / neutral messages
         */
        $messages = array();


        if (isset($_POST["form_type"])) {
            if($_POST["form_type"] == "login") {
               
                $user = $reg_model->getUserLogin($_POST['user_name'], $_POST['user_password']);

                if($user != false && !isset($_SESSION['username'])) {
                    if($user->disabled == false) {
                        $_SESSION['username'] = $user->username;
                        $_SESSION['admin'] = $user->admin;
                        header("Location: " . URL . $_SESSION['lang']);
                        die();
                    } else {
                        array_push ( $errors , $lang_model->translate("User was disabled by administrators on this page...") ); //translate!
                    }
                } else {
                    array_push ( $errors , $lang_model->translate("Wrong username or password...") ); //translate!
                }
            }
        }
        
        require 'application/views/_templates/header.php';
        require 'application/views/login/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function logout() {
        session_destroy();
        header("Location: " . URL . $_SESSION['lang']);
        die();
    }
}