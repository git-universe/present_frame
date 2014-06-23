<?php

/**
 * Class Presentation
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Presentations extends Controller
{
    public function index()
    {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');
        $present_model = $this->loadModel('PresentationModel');

        $menuCategories = $cat_model->getMenuCategories($_SESSION['lang']);
        $categories = $cat_model->getCategories();
        
        require 'application/views/_templates/header.php';
        require 'application/views/presentations/index.php';
        require 'application/views/_templates/footer.php';
    }

    public function presentation($id = 0, $fullPage = false) {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');

        $menuCategories = $cat_model->getMenuCategories($_SESSION['lang']);

        if ($fullPage == 'full') {
            require 'application/views/presentations/presentation.php';
        } else {
            require 'application/views/_templates/header.php';
            require 'application/views/presentations/presentation-page.php';
            require 'application/views/_templates/footer.php';
        }
    }

    public function category($id = 0) {
        $lang_model = $this->loadModel('LangModel');
        $cat_model = $this->loadModel('CategoryModel');
        $present_model = $this->loadModel('PresentationModel');


        $menuCategories = $cat_model->getMenuCategories($_SESSION['lang']);
        $categories = $cat_model->getCategories();
        $details = $cat_model->getCategoryTranslations($id, $_SESSION['lang'])[0];

        require 'application/views/_templates/header.php';
        require 'application/views/presentations/category.php';
        require 'application/views/_templates/footer.php';
    }
}