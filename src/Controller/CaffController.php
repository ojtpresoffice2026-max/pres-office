<?php

namespace App\Controller;

use App\Entity\Caff;
use App\Form\CaffType;
use App\Repository\CaffRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/caff')]
final class CaffController extends AbstractController
{
    #[Route(name: 'app_caff_index', methods: ['GET'])]
    public function index(CaffRepository $caffRepository): Response
    {
        return $this->render('caff/index.html.twig', [
            'caffs' => $caffRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_caff_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $caff = new Caff();
        $form = $this->createForm(CaffType::class, $caff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($caff);
            $entityManager->flush();

            return $this->redirectToRoute('app_caff_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caff/new.html.twig', [
            'caff' => $caff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caff_show', methods: ['GET'])]
    public function show(Caff $caff): Response
    {
        return $this->render('caff/show.html.twig', [
            'caff' => $caff,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_caff_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Caff $caff, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CaffType::class, $caff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_caff_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('caff/edit.html.twig', [
            'caff' => $caff,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_caff_delete', methods: ['POST'])]
    public function delete(Request $request, Caff $caff, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caff->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($caff);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_caff_index', [], Response::HTTP_SEE_OTHER);
    }
}
