<?php

namespace App\Controller;

class AboutController extends AbstractController
{
    /**
     * Display about page
     *
     * @return string
     */
    public function about()
    {
        return $this->twig->render('About/about.html.twig');
    }
}
