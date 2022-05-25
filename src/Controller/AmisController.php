<?php

namespace App\Controller;

use App\Entity\Amis;
use App\Form\EditProfilAmisType;
use App\Repository\AmisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Dompdf\Dompdf;
use Dompdf\Options;

class AmisController extends AbstractController
{

    /**
     * @Route("/consultation", name="amis_consultation", methods={"GET"})
     */
    public function index(AmisRepository $amisRepository): Response
    {
        return $this->render('amis/consultation.html.twig', [
            'amies' => $amisRepository->findAll()
        ]);
    }

    /**
     * MODIFIER LE PROFIL DE L'UTILISATEUR CONNECTE
     */
    /**
     * @Route("/amis/profil/modifier", name="amis_edit")
     */
    public function edit(Request $request)
    {
        $amis = $this->getUser();
        $form = $this->createForm(EditProfilAmisType::class, $amis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amis);
            $em->flush();

            $this->addFlash('modif', 'Profil mis à jour');
            return $this->redirectToRoute('amis_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amis/profil.edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * SUPPRIMER LE PROFIL DE L'UTILISATEUR CONNECTE
     */
    //à venir

    /**
     * MODIFIER UN AMIS
     */
    /**
     * @Route("/amis/{id}/edit", name="amis_edit_id", methods={"GET", "POST"})
     */
    public function editAmis(Request $request, Amis $amis, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EditProfilAmisType::class, $amis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('edit', 'L\'amis a bien été modifié !');
            return $this->redirectToRoute('amis_consultation', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('amis/modif.html.twig', [
            'amis' => $amis,
            'form' => $form,
        ]);
    }

    /**
     * SUPPRIMER UN AMIS
     */
    /**
     * @Route("/amis/delete/{id}", name="amis_delete", methods={"POST"})
     */
    public function deleteAmis(Request $request, Amis $amis, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $amis->getId(), $request->request->get('_token'))) {
            $entityManager->remove($amis);
            $entityManager->flush();
        }

        $this->addFlash('delete', 'L\'amis a bien été supprimé !');
        return $this->redirectToRoute('amis_consultation', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * PDF DE TOUT LES AMIS
     */
    /**
     * @Route("/amis/pdf", name="amis_pdf", methods={"GET"})
     */
    public function pdfAmis(AmisRepository $amisRepository)
    {
        $pdfOption = new Options();
        $pdfOption->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOption);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('amis/pdf.html.twig', [
            'amies' => $amisRepository->findAll()
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("listeAmis.pdf", [
            "Attachment" => true
        ]);
    }
    
}
