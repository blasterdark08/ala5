<?php

namespace App\Controller;

use App\Entity\Reservering;
use App\Entity\Kamer;
use App\Entity\User;
use App\Form\ReserveringType;
use App\Repository\ReserveringRepository;
use App\Repository\KamerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/reservering")
 */
class ReserveringController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="reservering_index", methods={"GET"})
     */
    public function index(ReserveringRepository $reserveringRepository): Response
    {
        $user = $this->getUser()->getId();
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->render('reservering/index.html.twig', [
                'reserverings' => $reserveringRepository->findAll(),
            ]);
        } else {
            return $this->render('reservering/index.html.twig', [
                'reserverings' => $reserveringRepository->findBy(['klant' => $user]),
            ]);

    }}
    /**
     * @Route("/checkin", name="reservering_checkin", methods={"GET"})
     */
    public function checkin(ReserveringRepository $reserveringRepository): Response
    {

        $now = new \DateTime();

        $data = $reserveringRepository->getCheckIn($now);

        return $this->render('reservering/index.html.twig', [
            'reserverings' => $data,
        ]);
    }
    /**
     * @Route("/checkout", name="reservering_checkout", methods={"GET"})
     */
    public function checkout(ReserveringRepository $reserveringRepository): Response
    {

        $now = new \DateTime();

        $data = $reserveringRepository->getCheckOut($now);

        return $this->render('reservering/index.html.twig', [
            'reserverings' => $data,
        ]);
    }
    /**
     * @Route("/new", name="reservering_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservering = new Reservering();
        $form = $this->createForm(ReserveringType::class, $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservering);
            $entityManager->flush();

            return $this->redirectToRoute('reservering_index');
        }

        return $this->render('reservering/new.html.twig', [
            'reservering' => $reservering,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservering_show", methods={"GET"})
     */
    public function show(Reservering $reservering, KamerRepository $kamerRepository): Response
    {

        $kip = $reservering->getKlant();
        $kam = $reservering->getKamer();

       $users = $this->getDoctrine()
           ->getRepository(User::class)
            ->find($kip);

        //return $this->render('user/index.html.twig', [
       //     'users' => $users,
      //  ]);

        return $this->render('reservering/show.html.twig', [
            'reservering' => $reservering,
            'user' => $users,
            'kamer' => $kamerRepository->find($kam)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservering_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservering $reservering): Response
    {
        $form = $this->createForm(ReserveringType::class, $reservering);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservering_index', [
                'id' => $reservering->getId(),
            ]);
        }

        return $this->render('reservering/edit.html.twig', [
            'reservering' => $reservering,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservering_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservering $reservering): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservering->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservering);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservering_index');
    }
    /**
     * @Route("/{id}/betaald", name="reservering_Betaal", methods={"GET"})
     */
    public function update($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reservering = $entityManager->getRepository(Reservering::class)->find($id);

        if (!$reservering) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $reservering->setBetaald(1);
        $entityManager->flush();

        return $this->redirectToRoute('reservering_show', [
            'id' => $reservering->getId()
        ]);
    }
}
