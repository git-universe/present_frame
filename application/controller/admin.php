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

    public function categories()
    {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');

        $categories = $cat_model->getCategories();
        $languages = $lang_model->getLanguages();

        require 'application/views/admin/header.php';
        require 'application/views/admin/categories.php';
        require 'application/views/_templates/footer.php';
    }

    public function category($id = null) {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');

        $messages = array();
        $errors = array();

        $mainCategories = $cat_model->getEmptyMainCategories();
        $languages = $lang_model->getLanguages();

        if(isset($_POST['form_type'])) {
            //var_dump($_POST);

            if($_POST['form_type'] == "new_category") {
                $temp = $cat_model->insertCategory($_POST['category_name'], $_POST['category_priority'], $_POST['category_parent']);

                if ( !$temp ) {
                    array_push($errors, 'Could not create category '. $_POST['category_name'] .'!');
                } else {
                    array_push($messages, 'Successfully created category '. $_POST['category_name'] .'.');
                    $langId = $temp;
                }
            } else if($_POST['form_type'] == "edit_category") {
                $temp = $cat_model->updateCategory($id, $_POST['category_name'], $_POST['category_priority'], $_POST['category_parent']);

                if ( !$temp ) {
                    array_push($errors, 'Could not update category '. $_POST['category_name'] .'!');
                } else {
                    array_push($messages, 'Successfully updated category '. $_POST['category_name'] .'.');
                    $langId = $temp;
                }
            }

            if (count($errors) == 0) {
                foreach ($languages as &$l) {
                    if ( !$lang_model->setCategoryTranslation($_POST['category_name_' . $l->short], $id, $l->id) ) {
                        array_push($errors, 'Could not update translation for '. $l->short .' language!');
                    } else {
                        array_push($messages, 'Successfully updated translation for '. $l->short .' language.');
                    }
                }
            }
        }

        if( $id != null && $cat_model->isCategory($id) ) {
            $catDetails = $cat_model->getCategory($id);
        }

        require 'application/views/admin/header.php';
        require 'application/views/admin/category.php';
        require 'application/views/_templates/footer.php';
    }

    public function categorydelete($id = null) {
        $cat_model = $this->loadModel('CategoryModel');

        if($id != null && $cat_model->isCategory($id)) {
            $cat_model->deleteCategory($id);
        }

        header("Location: " . URL . $_SESSION['lang'] . '/admin/categories');
        die();
    }

    public function presentations() {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');
        $present_model = $this->loadModel('PresentationModel');

        $mainCategories = $cat_model->getMainCategories();
        $categories = $cat_model->getCategories();
        $languages = $lang_model->getLanguages();

        require 'application/views/admin/header.php';
        require 'application/views/admin/presentations.php';
        require 'application/views/_templates/footer.php';
    }

    public function presentation($id = null) {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');
        $present_model = $this->loadModel('PresentationModel');
        $slide_model = $this->loadModel('SlideModel');

        $messages = array();
        $errors = array();

        if(isset($_POST['form_type'])) {
            //var_dump($_POST);

            if( $_POST['form_type'] == "new_presentation" ) {
                $newId = $present_model->insertPresentation(
                    $_POST['present_name'],
                    $_POST['present_desc'], 
                    $_POST['present_priority'], 
                    $_POST['present_language'], 
                    $_POST['present_category']);

                header("Location: " . URL . $_SESSION['lang'] . '/admin/presentation/' . $newId);
                die();
            } else if ($_POST['form_type'] == "edit_presentation" ) {
                $executed = $present_model->updatePresentation(
                    $id,
                    $_POST['present_name'],
                    $_POST['present_desc'], 
                    $_POST['present_priority'], 
                    $_POST['present_language'], 
                    $_POST['present_category']);

                if (!$executed) {
                    array_push($errors, 'Could not update presentation '. $_POST['present_name'] .'!');
                } else {
                    array_push($messages, 'Presentation '. $_POST['present_name'] .' updated successfully!');
                }
            }   else if ($_POST['form_type'] == "new_slide" ) {
                $executed = $slide_model->insertSlide(
                    $_POST['slide_priority'],
                    $_POST['slide_content'], 
                    $id);

                if (!$executed) {
                    array_push($errors, 'Could not add a new slide!');
                } else {
                    array_push($messages, 'Slide added successfully!');
                }
            }
        }

        $languages = $lang_model->getLanguages();
        $categories = $cat_model->getInsertableCategories();

        if( $present_model->isPresentation($id) ) {
            $details = $present_model->getDetails($id);
            $slides = $slide_model->getSlides($id);
        }

        require 'application/views/admin/header.php';
        require 'application/views/admin/presentation.php';
        require 'application/views/_templates/footer.php';
    }

    public function presentation_delete($id) {
        $present_model = $this->loadModel('PresentationModel');

        $present_model->deletePresentation($id);

        header("Location: " . URL . $_SESSION['lang'] . '/admin/presentations');
        die();
    }

    public function slide($id, $action = 'edit') {
        $slide_model = $this->loadModel('SlideModel');

        if(isset($_POST['form_type'])) {
            //var_dump($_POST);

            if( $_POST['form_type'] == "edit_slide" ) {
                $slide_model->updateSlide($_POST['slide_priority'], $_POST['slide_content'], $id);
            }
        }

        if($action == 'delete') {
            $presId = $slide_model->deleteSlide($id);
            header("Location: " . URL . $_SESSION['lang'] . '/admin/presentation/' . $presId);
            die();
        }

        $lang_model = $this->loadModel('LangModel');

        $details = $slide_model->getSlide($id);

        require 'application/views/admin/header.php';
        require 'application/views/admin/slide.php';
        require 'application/views/_templates/footer.php';
    }
}