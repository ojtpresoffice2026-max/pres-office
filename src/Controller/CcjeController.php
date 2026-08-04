<?php

namespace App\Controller;

use App\Entity\Ccje;
use App\Form\CcjeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ccje')]
final class CcjeController extends AbstractController
{
    #[Route(name: 'app_ccje_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ccjes = $entityManager
            ->getRepository(Ccje::class)
            ->findAll();

        return $this->render('ccje/index.html.twig', [
            'ccjes' => $ccjes,
        ]);
    }

    #[Route('/new', name: 'app_ccje_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ccje = new Ccje();
        $form = $this->createForm(CcjeType::class, $ccje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ccje);
            $entityManager->flush();

            return $this->redirectToRoute('app_ccje_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ccje/new.html.twig', [
            'ccje' => $ccje,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ccje_show', methods: ['GET'])]
    public function show(Ccje $ccje): Response
    {
        return $this->render('ccje/show.html.twig', [
            'ccje' => $ccje,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ccje_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ccje $ccje, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CcjeType::class, $ccje);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ccje_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ccje/edit.html.twig', [
            'ccje' => $ccje,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ccje_delete', methods: ['POST'])]
    public function delete(Request $request, Ccje $ccje, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ccje->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ccje);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ccje_index', [], Response::HTTP_SEE_OTHER);
    }
}
