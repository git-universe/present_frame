<?php

/**
 * Class Register
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Register extends Controller
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
            if($_POST["form_type"] == "register") {
                //var_dump($_POST);
                $username = $_POST['user_name'];
                $email = $_POST['user_email'];
                $pass = $_POST['user_password_new'];
                $passRepeat = $_POST['user_password_repeat'];

                if($pass != $passRepeat){
                    array_push ( $errors , $lang_model->translate("Passwords are not matching!") ); //translate!
                } else {
                    $passHashed = $reg_model->password_hash($pass, PASSWORD_DEFAULT);
                }

                if( $reg_model->isUser($username) ) {
                    array_push ( $errors , $lang_model->translate("User with that username already exists!") ); //translate!
                }

                if( $reg_model->isEmail($email) ) {
                    array_push ( $errors , $lang_model->translate("User with that email already exists!") ); //translate!
                }

                if(count($errors) == 0) {
                    if ( $reg_model->registerUser($username, $email, $passHashed) ) {
                        array_push ( $messages , $lang_model->translate("User registered successfully. You can now login to the page.") ); //translate!
                    } else {
                        array_push ( $errors , $lang_model->translate("User registered unsuccsessfully. Please try again later...") ); //translate!
                    }
                    
                }

            }
        }
        
        require 'application/views/_templates/header.php';
        require 'application/views/register/index.php';
        require 'application/views/_templates/footer.php';
    }
}