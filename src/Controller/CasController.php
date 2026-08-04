<?php

namespace App\Controller;

use App\Entity\Cas;
use App\Form\CasType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cas')]
final class CasController extends AbstractController
{
    #[Route(name: 'app_cas_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cas = $entityManager
            ->getRepository(Cas::class)
            ->findAll();

        return $this->render('cas/index.html.twig', [
            'cas' => $cas,
        ]);
    }

    #[Route('/new', name: 'app_cas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ca = new Cas();
        $form = $this->createForm(CasType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ca);
            $entityManager->flush();

            return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cas/new.html.twig', [
            'ca' => $ca,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cas_show', methods: ['GET'])]
    public function show(Cas $ca): Response
    {
        return $this->render('cas/show.html.twig', [
            'ca' => $ca,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cas $ca, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CasType::class, $ca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cas/edit.html.twig', [
            'ca' => $ca,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cas_delete', methods: ['POST'])]
    public function delete(Request $request, Cas $ca, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ca->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ca);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
    }
}
