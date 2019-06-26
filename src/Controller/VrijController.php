<?php

namespace App\Controller;

use App\Entity\Kamer;
use App\Entity\Reservering;
use App\Repository\StatusRepository;
use App\Repository\ReserveringRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\VrijType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\KamerRepository;
use App\Repository\TypeRepository;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


class VrijController extends AbstractController {


    /**
     * @Route("/", name="vrij_index", methods={"GET", "POST"})
     */
    public function index(Request $request, KamerRepository $kamerRepository) {

        $form = $this->createForm(VrijType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            // dump($contact);
            //halt();
            //go to mail
//            $message = (new \Swift_Message('You Got Mail!'))
//                               ->setFrom($contactFormData['from'])
//                          ->setTo('our.own.real@email.address')
//                           ->setBody(
//                                   $contactFormData['message'],
//                                   'text/plain'
//                               )
//                      ;
//
//          $mailer->send($message);
            // prijs   $contactFormData['prijs']
            //  $result1 = substr($contactFormData['Van'], 0, 5);
            //  $result2 = substr($contactFormData['Tot'], 0, 5);
            $newDate = $contact['Van'];
            $newDate = $newDate->format('Y-m-d');
            $newDate2 = $contact['Tot'];
            $newDate2 = $newDate2->format('Y-m-d');

            return $this->render('kamer/vrij.html.twig', [
                'kamers' => $kamerRepository->findPrice($newDate, $newDate2, $contact['pers']),
                'pers' => $contact['pers'],
                'van' => $newDate,
                'tot' => $newDate2
            ]); // year month date
//$contactFormData['Van'], $contactFormData['Tot']
        }

        return $this->render('default/index.html.twig', [

            'our_form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/vrij/{id}/{van}/{tot}", name="kamer_Reser", methods={"GET"})
     */
    public function show(Request $request, Kamer $kamer): Response
    {

        $van = $request->attributes->get('van');
        $tot = $request->attributes->get('tot');

        //$dagen = $van - $tot;
        $earlier = new DateTime($van);
        $later = new DateTime($tot);
        $dagen = $later->diff($earlier)->format("%a");

        return $this->render('kamer/reserveer.html.twig', [
            'kamer' => $kamer,
            'van'=> $van,
            'tot'=> $tot,
            'dagen'=> $dagen,
        ]);
    }
    /**
     * @Route("/Betaal/{id}/{van}/{tot}", name="reservering_betaal", methods={"GET","POST"})
     */
    public function new(Request $request,ReserveringRepository $reserveringRepository,  KamerRepository $kamerRepository, StatusRepository $statusRepository): Response
    {

        $van = $request->attributes->get('van');
        $earlier = new DateTime($van);

        $tot = $request->attributes->get('tot');
        $later = new DateTime($tot);

        $earlier = new DateTime($van);
        $later = new DateTime($tot);
        $dagen = $later->diff($earlier)->format("%a");

        // get user
        $user = $this->getUser();
        //get kamer id
        $kam = $request->attributes->get('id');


        $kamer = $kamerRepository->find($kam);

        $een = 3;
        $status = $statusRepository->find($een);
        $entityManager = $this->getDoctrine()->getManager();
        $reservering = new Reservering();
        $reservering->setKlant($user);
        $reservering->setKamer($kamer);
        $reservering->setStart($earlier);
        $reservering->setEind($later);
        $reservering->setBetaald(0);
        $reservering->setStatus($status);
        $entityManager->persist($reservering);
        $entityManager->flush();
//        $form = $this->createForm(ReserveringType::class, $reservering);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($reservering);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('reservering_index');
//        }
//
        return $this->render('reservering/index.html.twig', [
            'reserverings' => $reserveringRepository->findBy(['klant' => $user]),
        ]);
    }
}
