<?php

namespace App\Controller;

use DateTime;
use App\Entity\Reservering;
use App\Entity\User;
use App\Repository\KamerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends AbstractController
{

    /**
     * @Route("/pdf/{id}/{van}/{tot}", name="pdf")
     */
    public function index(Request $request, Reservering $reservering, KamerRepository $kamerRepository) :response
    {
        //get kamer die bij reservering hoort id
        $kam = $reservering->getKamer();

        //get klant id
        $kip = $reservering->getKlant();
        //get user by reservation
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($kip);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        $van = $request->attributes->get('van');
        $tot = $request->attributes->get('tot');
        $earlier = new DateTime($van);
        $later = new DateTime($tot);
        $dagen = $later->diff($earlier)->format("%a");
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('default/mypdf.html.twig', [
            'reservering' => $reservering,
            'van' => $van,
            'tot' => $tot,
            'dagen' => $dagen,
            'kamer' => $kamerRepository->find($kam),
            'user' => $users
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }
}
