<?php

namespace App\Controller;

use App\Entity\Cnpahs;
use App\Form\CnpahsType;
use App\Repository\CnpahsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cnpahs')]
final class CnpahsController extends AbstractController
{
    #[Route(name: 'app_cnpahs_index', methods: ['GET'])]
    public function index(CnpahsRepository $cnpahsRepository): Response
    {
        return $this->render('cnpahs/index.html.twig', [
            'cnpahses' => $cnpahsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cnpahs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cnpahs = new Cnpahs();
        $form = $this->createForm(CnpahsType::class, $cnpahs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cnpahs);
            $entityManager->flush();

            return $this->redirectToRoute('app_cnpahs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cnpahs/new.html.twig', [
            'cnpahs' => $cnpahs,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cnpahs_show', methods: ['GET'])]
    public function show(Cnpahs $cnpahs): Response
    {
        return $this->render('cnpahs/show.html.twig', [
            'cnpahs' => $cnpahs,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cnpahs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cnpahs $cnpahs, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CnpahsType::class, $cnpahs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cnpahs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cnpahs/edit.html.twig', [
            'cnpahs' => $cnpahs,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cnpahs_delete', methods: ['POST'])]
    public function delete(Request $request, Cnpahs $cnpahs, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cnpahs->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cnpahs);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cnpahs_index', [], Response::HTTP_SEE_OTHER);
    }
}
