<?php

namespace App\Controller;

use App\Entity\Recept;
use App\Form\ReceptType;
use App\Repository\ReceptRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/recept')]
final class ReceptController extends AbstractController
{
    #[Route(name: 'app_recept_index', methods: ['GET'])]
    public function index(ReceptRepository $receptRepository): Response
    {
        return $this->render('recept/index.html.twig', [
            'recepts' => $receptRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recept_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recept = new Recept();
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recept);
            $entityManager->flush();

            return $this->redirectToRoute('app_recept_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recept/new.html.twig', [
            'recept' => $recept,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recept_show', methods: ['GET'])]
    public function show(Recept $recept): Response
    {
        return $this->render('recept/show.html.twig', [
            'recept' => $recept,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recept_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recept $recept, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recept_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recept/edit.html.twig', [
            'recept' => $recept,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recept_delete', methods: ['POST'])]
    public function delete(Request $request, Recept $recept, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recept->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($recept);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recept_index', [], Response::HTTP_SEE_OTHER);
    }
}
