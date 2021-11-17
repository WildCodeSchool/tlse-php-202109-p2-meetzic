<?php

namespace App\Controller;

use App\Model\ProfileManager;

class ProfileController extends AbstractController
{
    public function show(int $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $tupple = $profileManager->selectAllColumnById($id);

        return $this->twig->render('PublicProfile/publicProfile.html.twig', ['tupple' => $tupple]);
    }

    public function profileView()
    {
        $this->previousPage();

        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }

    public function addProfile(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valuesInput = array_map('trim', $_POST);

            $profileManager = new ProfileManager();
            $id = $profileManager->editProfile($valuesInput);
            header('Location:/private/show?id=' . $id);
        }

        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }

    public function showProfileValidate(int $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $input = $profileManager->selectAllInputValidateProfile($id);

        return $this->twig->render('PrivateProfile/privateValidate.html.twig', ['input' => $input]);
    }

    public function deleteById(?string $id)
    {
        $profileManager = new ProfileManager();
        $id = array_map('trim', $_GET);
        var_dump($id);
        $profileManager->deleteProfile($id);
        //header('Location:/home');

        return $this->twig->render('PrivateProfile/delete.html.twig');
    }
}
