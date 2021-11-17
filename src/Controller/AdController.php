<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    public function browse()
    {
        $this->previousPage();

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
        $choice = isset($_COOKIE['firstChoice']) ? $_COOKIE['firstChoice'] : null;
        $ads = $adModel->getAll();
        if (empty($query)) {
            if ($choice === 'band') {
                $ads = $adModel->getAdMusician();
            } else {
                $ads = $adModel->getAdBand();
            }
        } else {
            if ($choice === 'band') {
                $ads = $adModel->getAdMusicianSearch($query);
            } else {
                $ads = $adModel->getAdBandSearch($query);
            }
        }
        return $this->twig->render('Home/ad.html.twig', ['ads' => $ads]);
    }

    public function addAd($id)
    {
        var_dump($_SESSION);
        return $this->twig->render('AdSubmit/adsubmit.html.twig', ['id' => $_SESSION['id']]);
    }

    public function insertAd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adInputs = array_map('trim', $_POST);
            $adModel = new AdModel();
            $ad = $adModel->setAd($adInputs);
            header('Location:/private/show?id=' . $_SESSION['id']);
        }
        return "";
    }
}
