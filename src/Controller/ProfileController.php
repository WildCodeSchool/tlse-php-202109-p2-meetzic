<?php

namespace App\Controller;

use App\Model\AdModel;
use App\Model\ProfileManager;
use App\Model\SessionManager;


class ProfileController extends AbstractController
{

    /**
     * show
     *
     * @param  int $id
     * @return string
     */
    public function show(int $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $tupple = $profileManager->selectAllColumnById($id);

        $getId = setcookie('getId', $_GET['id']);
        return $this->twig->render('PublicProfile/publicProfile.html.twig', ['tupple' => $tupple], ['getId' => $getId]);
    }

    /**
     * profileView
     *
     * @return string
     */
    public function profileView(): string
    {
        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }

    /**
     * addProfile
     *
     * @return string
     */
    public function addProfile(): string
    {
        $errors = [];
        $sessionManager = new SessionManager();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valuesInput = array_map('trim', $_POST);

            if (!empty($valuesInput['nickname']) || !empty($valuesInput['password'])) {
                $userExists = $sessionManager->userExists($valuesInput['nickname']);

                if ($userExists) {
                    $errors[] = "Cet identifiant existe déjà !";
                } else {
                    $profileManager = new ProfileManager();
                    $id = $profileManager->editProfile($valuesInput);
                    $_SESSION['nickname'] = $valuesInput['nickname'];
                    $_SESSION['id'] = $id;
                    header('Location:' . $_COOKIE['previous']);
                    // header('Location:/privateShow?id=' . $id);
                }
            } else {
                $errors[] = "Merci de renseigner tous les champs";
            }
        }
        return $this->twig->render('PrivateProfile/privateProfile.html.twig', ['errors' => $errors]);
    }

    public function showProfileValidate(string $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $input = $profileManager->selectAllInputValidateProfile($id);
        $adPrivate = new AdModel();
        $newad = $adPrivate->getAdById($id);

        return $this->twig->render('PrivateProfile/privateValidate.html.twig', ['input' => $input, 'ad' => $newad]);
    }

    /**
     * deleteById
     *
     * @param  string $id
     * @return void
     */
    public function deleteById(string $id): void
    {
        $profileManager = new ProfileManager();
        $id = $_GET['id'];
        $profileManager->deleteProfile($id);
        header('Location:/home');
    }

    public function contact($getId)
    {
        $getId = $_COOKIE['getId'];
        $profileManager = new ProfileManager();
        $tupple = $profileManager->selectAllColumnById($getId);

        return $this->twig->render('PublicProfile/contact.html.twig', ['tupple' => $tupple]);
    }

    public function validation($getId)
    {
        $getId = $_COOKIE['getId'];
        $profileManager = new ProfileManager();
        $tupple = $profileManager->selectAllColumnById($getId);

        return $this->twig->render('PublicProfile/validation.html.twig', ['tupple' => $tupple]);
    }
}
