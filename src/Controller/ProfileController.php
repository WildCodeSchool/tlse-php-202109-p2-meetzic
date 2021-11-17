<?php

namespace App\Controller;

use App\Model\ProfileManager;

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

        return $this->twig->render('PublicProfile/publicProfile.html.twig', ['tupple' => $tupple]);
    }

    /**
     * profileView
     *
     * @return string
     */
    public function profileView(): string
    {
        $this->previousPage();

        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }

    /**
     * addProfile
     *
     * @return string
     */
    public function addProfile(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valuesInput = array_map('trim', $_POST);

            $profileManager = new ProfileManager();
            $id = $profileManager->editProfile($valuesInput);
            header('Location:/privateShow?id=' . $id);
        }

        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }

    /**
     * showProfileValidate
     *
     * @param  int $id
     * @return string
     */
    public function showProfileValidate(int $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $input = $profileManager->selectAllInputValidateProfile($id);

        return $this->twig->render('PrivateProfile/privateValidate.html.twig', ['input' => $input]);
    }

    /**
     * deleteById
     *
     * @param  int $id
     * @return string
     */
    public function deleteById(int $id): string
    {
        $profileManager = new ProfileManager();
        $id = $_SESSION['id'];
        $profileManager->deleteProfile($id);
        header('Location:/home');

        return $this->twig->render('PrivateProfile/delete.html.twig');
    }
}
