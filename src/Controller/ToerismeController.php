<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ToerismeController extends AbstractController
{
    /**
     * @Route("/toerisme", name="toerisme")
     */
    public function index()
    {
        return $this->render('toerisme/index.html.twig', [
            'controller_name' => 'ToerismeController',
        ]);
    }
}
