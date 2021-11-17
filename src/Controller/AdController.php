<?php

namespace App\Controller;

use App\Model\AdModel;
use App\Model\FilterModel;

class AdController extends AbstractController
{
    public function browseByChoice()
    {
        $this->previousPage();

        $adModel = new AdModel();

        $instru = new FilterModel();
        $filter1 = $instru->getAllInstrument();

        $genre = new FilterModel();
        $filter = $genre->getAllGenre();

        if (isset($_COOKIE['firstChoice'])) {
            if ($_COOKIE['firstChoice'] === 'band') {
                $ads = $adModel->getAdMusician();
                return $this->twig->render(
                    'Home/ad.html.twig',
                    ['ads' => $ads, 'instruments' => $filter1, 'genres' => $filter]
                );
            }
            if ($_COOKIE['firstChoice'] === 'musician') {
                $ads = $adModel->getAdBand();
                return $this->twig->render(
                    'Home/ad.html.twig',
                    ['ads' => $ads, 'instruments' => $filter, 'genres' => $filter]
                );
            }
            $ads = $adModel->getAll();
            return $this->twig->render(
                'Home/ad.html.twig',
                ['ads' => $ads, 'instruments' => $filter,  'genres' => $filter]
            );
        }
    }
}
