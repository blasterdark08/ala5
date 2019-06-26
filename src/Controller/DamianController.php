<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DamianController extends AbstractController
{
    /**
     * @Route("/damian", name="damian")
     */
    public function index()
    {
        return $this->render('damian/index.html.twig', [
            'controller_name' => 'DamianController',
        ]);
    }
}
