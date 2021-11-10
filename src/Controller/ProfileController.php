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
}
