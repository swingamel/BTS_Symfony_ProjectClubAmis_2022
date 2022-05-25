<?php

namespace App\Controller;

use App\Entity\Amis;
use App\Entity\Inscription;
use App\Form\InscriptionSearchType;
use App\Form\InscriptionType;
use App\Repository\ActionRepository;
use App\Repository\AmisRepository;
use App\Repository\InscriptionRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscription")
 */
class InscriptionController extends AbstractController
{
    /**
     * @Route("/", name="app_inscription_index", methods={"GET"})
     */
    public function index(InscriptionRepository $inscriptionRepository): Response
    {
        $inscriptions = $inscriptionRepository->findAll();

        return $this->render('inscription/index.html.twig', [
            'inscriptions' => $inscriptions
        ]);
    }

    /**
     * @Route("/new", name="app_inscription_new", methods={"GET", "POST"})
     * @param Request $request
     * @param InscriptionRepository $inscriptionRepository
     * @return Response
     */
    public function new(Request $request, InscriptionRepository $inscriptionRepository): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionRepository->add($inscription);
            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_inscription_show", methods={"GET"})
     */
    public function show(Inscription $inscription): Response
    {
        return $this->render('inscription/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_inscription_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Inscription $inscription, InscriptionRepository $inscriptionRepository): Response
    {
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionRepository->add($inscription);
            return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscription/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_inscription_delete", methods={"POST"})
     */
    public function delete(Request $request, Inscription $inscription, InscriptionRepository $inscriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $inscriptionRepository->remove($inscription);
        }

        return $this->redirectToRoute('app_inscription_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/inscription/pdf", name="inscription_pdf", methods={"GET"})
     */
    public function pdfInscription(InscriptionRepository $inscriptionRepository)
    {
        $pdfOption = new Options();
        $pdfOption->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOption);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('inscription/pdf.html.twig', [
            'inscriptions' => $inscriptionRepository->findAll()
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("listeInscriptionAmis.pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("art_cat/", name="article_list")
     * Method({"GET", "POST"})
     */
    /*
    public function inscriptionsParNom(Request $request)
    {
        $inscriptionsSearch = new InscriptionSearch();
        $form = $this->createForm(InscriptionSearchType::class, $inscriptionsSearch);
        $form->handleRequest($request);

        $inscriptions = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $action = $inscriptionsSearch->getAction();

            if ($action != "")
                $inscriptions = $action->getAction();

            else
                $inscriptions = $this->getDoctrine()->getRepository(Inscription::class)->findAll();
        }
        return $this->render('inscription/index.html.twig', ['form' => $form->createView(), 'inscriptions' => $inscriptions]);
    }*/
}
