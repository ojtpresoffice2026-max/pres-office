<?php

namespace App\Controller;

use App\Entity\Cthm;
use App\Form\CthmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cthm')]
final class CthmController extends AbstractController
{
    #[Route(name: 'app_cthm_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cthms = $entityManager
            ->getRepository(Cthm::class)
            ->findAll();

        return $this->render('cthm/index.html.twig', [
            'cthms' => $cthms,
        ]);
    }

    #[Route('/new', name: 'app_cthm_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cthm = new Cthm();
        $form = $this->createForm(CthmType::class, $cthm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cthm);
            $entityManager->flush();

            return $this->redirectToRoute('app_cthm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cthm/new.html.twig', [
            'cthm' => $cthm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cthm_show', methods: ['GET'])]
    public function show(Cthm $cthm): Response
    {
        return $this->render('cthm/show.html.twig', [
            'cthm' => $cthm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cthm_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cthm $cthm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CthmType::class, $cthm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cthm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cthm/edit.html.twig', [
            'cthm' => $cthm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cthm_delete', methods: ['POST'])]
    public function delete(Request $request, Cthm $cthm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cthm->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cthm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cthm_index', [], Response::HTTP_SEE_OTHER);
    }
}
