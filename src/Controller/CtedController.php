<?php

namespace App\Controller;

use App\Entity\Cted;
use App\Form\CtedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cted')]
final class CtedController extends AbstractController
{
    #[Route(name: 'app_cted_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cteds = $entityManager
            ->getRepository(Cted::class)
            ->findAll();

        return $this->render('cted/index.html.twig', [
            'cteds' => $cteds,
        ]);
    }

    #[Route('/new', name: 'app_cted_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cted = new Cted();
        $form = $this->createForm(CtedType::class, $cted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cted);
            $entityManager->flush();

            return $this->redirectToRoute('app_cted_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cted/new.html.twig', [
            'cted' => $cted,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cted_show', methods: ['GET'])]
    public function show(Cted $cted): Response
    {
        return $this->render('cted/show.html.twig', [
            'cted' => $cted,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cted_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cted $cted, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CtedType::class, $cted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cted_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cted/edit.html.twig', [
            'cted' => $cted,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cted_delete', methods: ['POST'])]
    public function delete(Request $request, Cted $cted, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cted->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cted);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cted_index', [], Response::HTTP_SEE_OTHER);
    }
}
