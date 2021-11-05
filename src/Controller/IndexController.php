<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class IndexController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
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
        if (!empty($_COOKIE)) {
            header('Location: home');
        }

        return $this->twig->render('Index/index.html.twig');
    }
}
