<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    // public function browse(?string $search)
    // {
    //     if (!empty($search)){
    //         //TODO appeler requete qui recupére la liste des annonces
    //     }
    //     $adModel = new AdModel();

    //     if (!empty($_COOKIE)) {
    //         if ($_COOKIE['firstChoice'] === 'band') {
    //             $ads = $adModel->getAdMusician();
    //             return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    //         }
    //         if ($_COOKIE['firstChoice'] === 'musician') {
    //             $ads = $adModel->getAdBand();
    //             return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    //         }
    //     }
    //     $ads = $adModel->getAll();
    //     return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    // }

    public function browse()
    {
        // if (!empty($search)){
        //     //TODO appeler requete qui recupére la liste des annonces
        // }
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

    public function browseBySearch(?string $search)
    {
        // if (!empty($search)){
        //     //TODO appeler requete qui recupére la liste des annonces
        // }
        $adModel = new AdModel();

        if (!empty($_COOKIE) && empty($search)) {
            if ($_COOKIE['firstChoice'] === 'band') {
                $ads = $adModel->getAdMusician();
                return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
            }
            if ($_COOKIE['firstChoice'] === 'musician') {
                $ads = $adModel->getAdBand();
                return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
            }
        }

        if (!empty($_COOKIE) && !empty($search)){
            if ($_COOKIE['firstChoice'] === 'band') {
                $ads = $adModel->getAdMusicianSearch($search);
                return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
            }
            if ($_COOKIE['firstChoice'] === 'musician') {
                $ads = $adModel->getAdBandSearch($search);
                return $this->twig->render('Home/adsearch.html.twig', ['ads' => $ads]);
            }
        }
        $ads = $adModel->getAll();
        return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    }
}
