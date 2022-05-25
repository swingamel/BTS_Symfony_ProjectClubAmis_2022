<?php

namespace App\Controller;

use App\Entity\Action;
use App\Form\Action1Type;
use App\Form\Action2Type;
use App\Repository\ActionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/action")
 */
class ActionController extends AbstractController
{
    /**
     * @Route("/", name="app_action_index", methods={"GET"})
     */
    public function index(ActionRepository $actionRepository): Response
    {
        return $this->render('action/index.html.twig', [
            'actions' => $actionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_action_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ActionRepository $actionRepository): Response
    {
        $action = new Action();
        $form = $this->createForm(Action1Type::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actionRepository->add($action);

            $this->addFlash('success', 'L\'action a bien été créée.');
            return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('action/new.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_action_show", methods={"GET"})
     */
    public function show(Action $action): Response
    {
        return $this->render('action/show.html.twig', [
            'action' => $action,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_action_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Action $action, ActionRepository $actionRepository): Response
    {
        $form = $this->createForm(Action1Type::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actionRepository->add($action);

            $this->addFlash('edit', 'L\'action a bien été modifiée !');
            return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('action/edit.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_action_delete", methods={"POST"})
     */
    public function delete(Request $request, Action $action, ActionRepository $actionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $action->getId(), $request->request->get('_token'))) {
            $actionRepository->remove($action);
        }
        $this->addFlash('delete', 'L\'action a bien été supprimée !');
        return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
    }
}
