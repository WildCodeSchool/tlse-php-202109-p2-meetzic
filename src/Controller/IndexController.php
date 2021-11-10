<?php

namespace App\Controller;

class IndexController extends AbstractController
{
    /**
     * Display index page and save first choice in cookie
     *
     * @return string
     */
    public function index()
    {

        if (!empty($_GET)) {
            if ($_GET['firstChoice'] === 'band') {
                setcookie('firstChoice', 'band');
            } elseif ($_GET['firstChoice'] === 'musician') {
                setcookie('firstChoice', 'musician');
            }
            header('Location: home');
        }

        return $this->twig->render('Index/index.html.twig');
    }
}
