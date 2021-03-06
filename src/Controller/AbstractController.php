<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected Environment $twig;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => (ENV === 'dev'),
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $this->startSession();
        $this->varTwig();
    }

    /**
     * Save the previous page visited in cookie
     *
     * @return void
     */
    public function previousPage(): void
    {
         //Store current requested URL PATH in the cookie
        if (filter_has_var(INPUT_SERVER, "REQUEST_URI")) {
            setcookie('previous', $_SERVER["REQUEST_URI"]);
        } else {
            setcookie('previous', "/");
        }
    }

    /**
     * Start a session
     *
     * @return void
     */
    public function startSession(): void
    {
        session_start();
    }

    /**
     * Use to clean data from POST ?
     *
     * @param  string $data
     * @return string
     */
    public function cleanPostData(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Define variables to be use in twig
     *
     * @return void
     */
    public function varTwig(): void
    {
        if (!empty($_SESSION)) {
            $sessionId = $_SESSION['id'];
            $deposit = "adsubmit?id=" . $sessionId;
            $redirection = "privateShow?id=" . $sessionId;
            $connected = true;
            $contact = "contact?id= . $sessionId";
            $validation = "contact?id=" . $sessionId;
        } else {
            $sessionId = "";
            $redirection = "login";
            $deposit = "login";
            $connected = false;
            $contact = "login";
            $validation = "contact?id=" . $sessionId;
        }

        $this->twig->addGlobal('sessionId', $sessionId);
        $this->twig->addGlobal('redirection', $redirection);
        $this->twig->addGlobal('deposit', $deposit);
        $this->twig->addGlobal('connected', $connected);
        $this->twig->addGlobal('contact', $contact);
        $this->twig->addGlobal('validation', $validation);
    }
}
