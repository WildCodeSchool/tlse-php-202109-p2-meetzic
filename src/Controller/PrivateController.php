<?php

namespace App\Controller;

use App\Controller\AbstractController;

class PrivateController extends AbstractController
{
    public function test()
    {
        return $this->twig->render('PrivateProfile/privateProfile.html.twig');
    }
}
