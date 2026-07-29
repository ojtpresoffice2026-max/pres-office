<?php

namespace App\Controller;

use App\Entity\DocumentFiling;
use App\Form\DocumentFilingType;
use App\Repository\DocumentFilingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/document')]
final class DocumentFilingController extends AbstractController
{
    #[Route(name: 'app_document_filing_index', methods: ['GET'])]
    public function index(DocumentFilingRepository $documentFilingRepository): Response
    {
        return $this->render('document_filing/index.html.twig', [
            'document_filings' => $documentFilingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_filing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $documentFiling = new DocumentFiling();
        $form = $this->createForm(DocumentFilingType::class, $documentFiling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($documentFiling);
            $entityManager->flush();

            return $this->redirectToRoute('app_document_filing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_filing/new.html.twig', [
            'document_filing' => $documentFiling,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_filing_show', methods: ['GET'])]
    public function show(DocumentFiling $documentFiling): Response
    {
        return $this->render('document_filing/show.html.twig', [
            'document_filing' => $documentFiling,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_filing_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DocumentFiling $documentFiling, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentFilingType::class, $documentFiling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_document_filing_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_filing/edit.html.twig', [
            'document_filing' => $documentFiling,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_document_filing_delete', methods: ['POST'])]
    public function delete(Request $request, DocumentFiling $documentFiling, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentFiling->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($documentFiling);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_filing_index', [], Response::HTTP_SEE_OTHER);
    }
}
