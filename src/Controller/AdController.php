<?php

namespace App\Controller;

use App\Model\AdModel;

class AdController extends AbstractController
{
    public function browse()
    {
        return $this->twig->render('Home/ad.html.twig');
    }
}
