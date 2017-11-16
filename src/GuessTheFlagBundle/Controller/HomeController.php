<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/home")
     */
    public function homeAction()
    {
        return $this->render('GuessTheFlagBundle:Home:home.html.twig', [
            // ...
        ]);
    }
}
