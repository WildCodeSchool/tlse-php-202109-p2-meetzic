<?php

namespace App\Controller;

use App\Model\ProfileManager;
use Exception;

class SessionController extends AbstractController
{
    /**
     * Display the login page and connect the user
     *
     * @return string
     */
    public function login()
    {
        //TODO : Faire appel base de donnée: nickname + password
        define('LOGIN', 'tacos');
        define('PASSWORD', 'tacos');

        // Check POST datas
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['nickname']) && !empty($_POST['password'])) {
                $nickname = $this->cleanPostData($_POST['nickname']);
                $password = $this->cleanPostData($_POST['password']);

                if ($nickname !== LOGIN) {
                    throw new Exception("Mauvais identifiant !");
                } elseif ($password !== PASSWORD) {
                    throw new Exception("Mauvais password !");
                } else {
                    $_SESSION['nickname'] = $nickname;
                    header('Location:' . $_COOKIE['previous']);
                }
            } else {
                throw new Exception("Merci de renseigner les champs");
            }
        }
        return $this->twig->render('Session/login.html.twig');
    }

    /**
     * Display the creation page
     *
     * @return string
     */
    public function creation()
    {
        $this->previousPage();

        return $this->twig->render('Session/creation.html.twig');
    }
}
