<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    public function browseByChoice()
    {
        $adModel = new AdModel();

        if (!empty($_COOKIE)) {
            if ($_COOKIE['firstChoice'] === 'band') {
                $ads = $adModel->getAdMusician();
                return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
            }
            if ($_COOKIE['firstChoice'] === 'musician') {
                $ads = $adModel->getAdBand();
                return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
            }
        }           
        $ads = $adModel->getAll();
        return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    }
}
