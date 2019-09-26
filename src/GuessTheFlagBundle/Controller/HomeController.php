<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction()
    {
        $randomFlags = $this->getDoctrine()
            ->getRepository('GuessTheFlagBundle:Flag')
            ->getRandomFlags(4);

        return $this->render('GuessTheFlagBundle:Home:home.html.twig', [
            'randomFlags' => $randomFlags,
        ]);
    }
}
