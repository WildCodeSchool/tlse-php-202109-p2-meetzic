<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    public function browse()
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
        } else {
            $ads = $adModel->getAll();
            return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
        }
    }

    public function browseBySearch(string $query)
    {
        $adModel = new AdModel();
        if (!empty($query)) {
            if ($_COOKIE['firstChoice'] === 'band') {
                $ads = $adModel->getAdMusicianSearch($query);
                return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
            }
            if ($_COOKIE['firstChoice'] === 'musician') {
                $ads = $adModel->getAdBandSearch($query);
                return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
            }
        } elseif ($_COOKIE['firstChoice'] === 'band') {
            $ads = $adModel->getAdMusician();
            return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
        } elseif ($_COOKIE['firstChoice'] === 'musician') {
            $ads = $adModel->getAdBand();
            return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
        }
    }
}
