<?php

/**
 * Class Admin
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Admin extends Controller
{

    function __construct() {
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
            header("Location: " . URL . $_SESSION['lang']);
            die();
        }

        parent::__construct();
    }

    public function index()
    {
        $lang_model = $this->loadModel('LangModel');

        require 'application/views/admin/header.php';
        require 'application/views/admin/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function pages()
    {
        $lang_model = $this->loadModel('LangModel');
        $page_model = $this->loadModel('PageModel');

        $pages = $page_model->getPages();

        require 'application/views/admin/header.php';
        require 'application/views/admin/pages.php';
        require 'application/views/_templates/footer.php';
    }

    public function page($pageId, $lang = null)
    {
       /* model init */
        $lang_model = $this->loadModel('LangModel');
        $page_model = $this->loadModel('PageModel');


        if(isset($_POST['form_type'])) {
            //var_dump($_POST);
            if($_POST['form_type'] == "page_edit") { // If from for editing was posted
                $page_model->setPage($pageId, $_POST['page_title'], $_POST['page_content']);
            } else {
                if ( !$page_model->newPage($_POST['page_title'], $_POST['page_content'], $_POST['page_language']) ) {
                    $error = "Problem creating new page. Please try again later...";
                }
                
                header("Location: " . URL . $_SESSION['lang']. '/admin/pages');
                die();
            }
        }

        $page_content = $page_model->getPage($pageId); // loads the page data if it exists for $pageId

        if( $page_content != false ) { //If content exists
            $title = $page_content->name;
            $content = $page_content->content;
            $lang = $page_content->short;
            $formType = "page_edit";
        } else if ($pageId == 0 && $lang_model->isLanguage($lang) ) { // If its a new translation for an existing language
            $title = "";
            $content = "";
            $formType = "page_new";
        } else {
            header("Location: " . URL . $_SESSION['lang'] . '/admin/pages');
            die();
        }

        require 'application/views/admin/header.php';
        require 'application/views/admin/pageedit.php';
        require 'application/views/_templates/footer.php';
    }
}