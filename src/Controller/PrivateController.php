<?php

namespace App\Controller;

use App\Controller\AbstractController;

class PrivateController extends AbstractController
{
    public function test()
    {
        $this->previouspage();

        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }
}
