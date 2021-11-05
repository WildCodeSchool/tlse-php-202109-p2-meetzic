<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    public function browse()
    {
        $adModel = new AdModel();
        $ads = $adModel->getAll();
        return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    }
}
