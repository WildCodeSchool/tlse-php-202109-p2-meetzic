<?php

namespace App\Controller;

use App\Model\ProfileManager;

class ProfileController extends AbstractController
{
    public function publicProfile()
    {
        return $this->twig->render('PublicProfile/publicProfile.html.twig');
    }

    public function show(int $id): string
    {
        $profileManager = new ProfileManager();
        $tupple = $profileManager->selectNicknameById($id);

        return $this->twig->render('PublicProfile/publicProfile.html.twig', ['tupple' => $tupple]);
    }
}
