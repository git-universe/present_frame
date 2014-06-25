<?php

/**
 * Class User
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class User extends Controller
{

    function __construct() {
        if( !isset($_SESSION['admin']) ) {
            header("Location: " . URL . $_SESSION['lang']);
            die();
        }

        parent::__construct();
    }

    public function index()
    {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');
        $user_model = $this->loadModel('UserModel');

        /**
         * @var array $errors Collection of error messages
         */
        $errors = array();
        /**
         * @var array $messages Collection of success / neutral messages
         */
        $messages = array();

        $menuCategories = $cat_model->getMenuCategories( $_SESSION['lang'] );
        $userDetails = $user_model->getUserDetails( $_SESSION['username'] );

        if (isset($_POST["form_type"])) {

            if($_POST["form_type"] == "editUser") {
                $username = $_POST['user_name'];
                $email = $_POST['user_email'];

                if( $user_model->isUser($username) ) {
                    array_push ( $errors , $lang_model->translate("User with that username already exists!") ); //translate!
                }

                if(count($errors) == 0) {

                    if( $user_model->setUserDetails($userDetails->id, $_POST['user_name'], $_POST['user_email']) ) {
                        array_push ( $messages , $lang_model->translate("User profile updated successfully.") ); //translate!
                        $_SESSION['username'] = $username;
                        $userDetails = $user_model->getUserDetails( $_SESSION['username'] );
                    } else {
                        array_push ( $errors , $lang_model->translate("User profile was not updated. Please try again later...") ); //translate!
                    }

                }
            } else if ($_POST["form_type"] == "newPassword"){
                $passOld = $_POST['user_password_old'];
                $pass = $_POST['user_password_new'];
                $passRepeat = $_POST['user_password_repeat'];

                $user = $user_model->getUserLogin($_SESSION['username'], $passOld);

                if($user == false) {
                    array_push ( $errors , $lang_model->translate("Wrong old password...") ); //translate!
                }

                if($pass != $passRepeat){
                    array_push ( $errors , $lang_model->translate("Passwords are not matching!") ); //translate!
                } else {
                    $passHashed = $user_model->password_hash($pass, PASSWORD_DEFAULT);
                }

                if(count($errors) == 0) {

                    if( $user_model->setPassword($userDetails->id, $passHashed) ) {
                        array_push ( $messages , $lang_model->translate("Password updated successfully.") ); //translate
                    } else {
                        array_push ( $errors , $lang_model->translate("Password was not updated. Please try again later...") ); //translate!
                    }

                }
            }
        }

        require 'application/views/_templates/header.php';
        require 'application/views/user/index.php';
        require 'application/views/_templates/footer.php';
    }

}