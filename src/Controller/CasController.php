<?php

namespace App\Controller;

use App\Entity\Cas;
use App\Form\CasType;
use App\Repository\CasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cas')]
final class CasController extends AbstractController
{
    #[Route(name: 'app_cas_index', methods: ['GET'])]
    public function index(CasRepository $casRepository): Response
    {
        return $this->render('cas/index.html.twig', [
            'cass' => $casRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cas = new Cas();
        $form = $this->createForm(CasType::class, $cas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cas);
            $entityManager->flush();

            return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cas/new.html.twig', [
            'cas' => $cas,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cas_show', methods: ['GET'])]
    public function show(Cas $cas): Response
    {
        return $this->render('cas/show.html.twig', [
            'cas' => $cas,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cas $cas, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CasType::class, $cas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cas/edit.html.twig', [
            'cas' => $cas,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cas_delete', methods: ['POST'])]
    public function delete(Request $request, Cas $cas, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cas->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cas);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cas_index', [], Response::HTTP_SEE_OTHER);
    }
}
