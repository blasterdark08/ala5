<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\KamerRepository;


class ContactController extends AbstractController {


    /**
     * @Route("/contact", name="contact_test", methods={"GET", "POST"})
     */
    public function index(Request $request, \Swift_Mailer $mailer) {

     $form = $this->createForm(ContactType::class);
     $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            // dump($contactFormData);
            //halt();
            //go to mail
            $message = (new \Swift_Message('You Got Mail!'))
                               ->setFrom($contactFormData['from'])
                          ->setTo('damiandoel2000@gmail.com')
                           ->setBody(
                                   $contactFormData['message'],
                                   'text/plain'
                               )
                      ;

          $mailer->send($message);


            return $this->render('contact/index.html.twig', [
                'verstuurd' => 'Verstuurd!',
            ]);
        }

        return $this->render('contact/index.html.twig', [
            'verstuurd' => '',
            'our_form' => $form->createView(),
        ]);

    }

}
