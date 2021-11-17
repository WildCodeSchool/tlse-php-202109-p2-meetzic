<?php

namespace App\Controller;

use App\Model\AdModel;
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

    public function showProfileValidate(string $id): string
    {
        $this->previousPage();

        $profileManager = new ProfileManager();
        $input = $profileManager->selectAllInputValidateProfile($id);
        $adPrivate = new AdModel();
        $ad = $adPrivate->getAdById($id);



        return $this->twig->render('PrivateProfile/privateValidate.html.twig', ['input' => $input, 'ad' => $ad]);
    }
}
