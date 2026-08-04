<?php

namespace App\Controller;

use App\Entity\Cba;
use App\Form\CbaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cba')]
final class CbaController extends AbstractController
{
    #[Route(name: 'app_cba_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cbas = $entityManager
            ->getRepository(Cba::class)
            ->findAll();

        return $this->render('cba/index.html.twig', [
            'cbas' => $cbas,
        ]);
    }

    #[Route('/new', name: 'app_cba_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cba = new Cba();
        $form = $this->createForm(CbaType::class, $cba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cba);
            $entityManager->flush();

            return $this->redirectToRoute('app_cba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cba/new.html.twig', [
            'cba' => $cba,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cba_show', methods: ['GET'])]
    public function show(Cba $cba): Response
    {
        return $this->render('cba/show.html.twig', [
            'cba' => $cba,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cba_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cba $cba, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CbaType::class, $cba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cba_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cba/edit.html.twig', [
            'cba' => $cba,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cba_delete', methods: ['POST'])]
    public function delete(Request $request, Cba $cba, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cba->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cba);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cba_index', [], Response::HTTP_SEE_OTHER);
    }
}
