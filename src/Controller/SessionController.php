<?php

namespace App\Controller;

use App\Model\SessionManager;

class SessionController extends AbstractController
{
    private array $errors = [];

    /**
     * Display the login page and connect the user
     *
     * @return string
     */
    public function login()
    {
        // Call database
        $sessionManager = new SessionManager();
        $logs = $sessionManager->getLogin();
        // Check POST datas
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['nickname']) && !empty($_POST['password'])) {
                $nickname = $this->cleanPostData($_POST['nickname']);
                $password = $this->cleanPostData($_POST['password']);
                $lenghtOfTable = count($logs);
                for ($i = 0; $i < $lenghtOfTable; $i++) {
                    $hash = password_hash($logs[$i]['password'], PASSWORD_DEFAULT);
                    $verified = password_verify($password, $hash);

                    if ($nickname !== $logs[$i]['nickname']) {
                        $this->errors[] = "L'identifiant est incorrect";
                    } elseif (!$verified) {
                        $this->errors[] = "Le mot de passe est incorrect";
                        break;
                    } else {
                        $_SESSION['nickname'] = $nickname;
                        $_SESSION['id'] = $logs[$i]['id'];
                        header('Location:' . $_COOKIE['previous']);
                    }
                }
            } else {
                $this->errors[] = "Merci de renseigner tous les champs";
            }
        }
        return $this->twig->render('Session/login.html.twig', ['errors' => $this->errors]);
    }
}
