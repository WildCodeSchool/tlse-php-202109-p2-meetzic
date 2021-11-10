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
        define('LOGIN', 'Yolodu31');
        define('PASSWORD', 'tacos');
        $hash = password_hash(PASSWORD, PASSWORD_DEFAULT);

        // Check POST datas
        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['nickname']) && !empty($_POST['password'])) {
                $nickname = $this->cleanPostData($_POST['nickname']);
                $password = $this->cleanPostData($_POST['password']);
                $verified = password_verify($password, $hash);

                if ($nickname !== LOGIN) {
                    $errors[] = "L'identifiant est incorrect";
                } elseif (!$verified) {
                    $errors[] = "Le mot de passe est incorrect";
                } else {
                    $_SESSION['nickname'] = $nickname;
                    header('Location:' . $_COOKIE['previous']);
                }
            } else {
                $errors[] = "Merci de renseigner tous les champs";
            }
        }
        return $this->twig->render('Session/login.html.twig', ['errors' => $errors]);
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
