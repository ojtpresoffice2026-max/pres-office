<?php

namespace App\Controller;

use App\Entity\Cea;
use App\Form\CeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cea')]
final class CeaController extends AbstractController
{
    #[Route(name: 'app_cea_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ceas = $entityManager
            ->getRepository(Cea::class)
            ->findAll();

        return $this->render('cea/index.html.twig', [
            'ceas' => $ceas,
        ]);
    }

    #[Route('/new', name: 'app_cea_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cea = new Cea();
        $form = $this->createForm(CeaType::class, $cea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cea);
            $entityManager->flush();

            return $this->redirectToRoute('app_cea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cea/new.html.twig', [
            'cea' => $cea,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cea_show', methods: ['GET'])]
    public function show(Cea $cea): Response
    {
        return $this->render('cea/show.html.twig', [
            'cea' => $cea,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cea_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cea $cea, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CeaType::class, $cea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cea/edit.html.twig', [
            'cea' => $cea,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cea_delete', methods: ['POST'])]
    public function delete(Request $request, Cea $cea, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cea->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cea_index', [], Response::HTTP_SEE_OTHER);
    }
}
