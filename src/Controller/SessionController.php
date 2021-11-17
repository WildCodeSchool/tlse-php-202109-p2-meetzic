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

                for ($i = 0; $i < count($logs); $i++) {
                    $hash = password_hash($logs[$i]['password'], PASSWORD_DEFAULT);
                    $verified = password_verify($password, $hash);

                    if ($nickname !== $logs[$i]['nickname']) {
                        $this->errors[] = "L'identifiant est incorrect";
                    } elseif (!$verified) {
                        $this->errors[] = "Le mot de passe est incorrect";
                        break;
                    } else {
                        $_SESSION['nickname'] = $nickname;
                        header('Location:' . $_COOKIE['previous']);
                    }
                }
            } else {
                $this->errors[] = "Merci de renseigner tous les champs";
            }
        }
        return $this->twig->render('Session/login.html.twig', ['errors' => $this->errors]);
    }

    public function creation()
    {
        $this->previousPage();

        $sessionManager = new SessionManager();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                !empty($_POST['newNickname']) || !empty($_POST['newPassword']) || !empty($_POST['confirmNewPassword'])
            ) {
                $newNickname = $this->cleanPostData($_POST['newNickname']);
                $newPassword = $this->cleanPostData($_POST['newPassword']);
                $confirmNewPassword = $this->cleanPostData($_POST['confirmNewPassword']);
                $userExists = $sessionManager->userExists($newNickname);

                if (empty($_POST['newNickname'])) {
                    $this->errors[] = "Merci de saisir un pseudo";
                } elseif (empty($_POST['newPassword'])) {
                    $this->errors[] = "Merci de saisir votre mot de passe";
                } elseif ($newPassword !== $confirmNewPassword) {
                    $this->errors[] = "Les mots de passes ne sont pas identiques";
                } elseif ($userExists) {
                    $this->errors[] = "Cet identifiant existe déjà !";
                } else {
                    $newUser = $sessionManager->newUser($newNickname, $newPassword);
                    $_SESSION['nickname'] = $newNickname;
                    header('Location: private');
                }
            } else {
                $this->errors[] = "Merci de renseigner tous les champs";
            }
        }
        return $this->twig->render('Session/creation.html.twig', ['errors' => $this->errors]);
    }
}
