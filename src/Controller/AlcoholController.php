<?php

namespace App\Controller;

use App\Entity\Alcohol;
use App\Form\AlcoholType;
use App\Repository\AlcoholRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alcohol')]
final class AlcoholController extends AbstractController
{
    #[Route(name: 'app_alcohol_index', methods: ['GET'])]
    public function index(AlcoholRepository $alcoholRepository): Response
    {
        return $this->render('alcohol/index.html.twig', [
            'alcohols' => $alcoholRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alcohol_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alcohol = new Alcohol();
        $form = $this->createForm(AlcoholType::class, $alcohol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alcohol);
            $entityManager->flush();

            return $this->redirectToRoute('app_alcohol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alcohol/new.html.twig', [
            'alcohol' => $alcohol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alcohol_show', methods: ['GET'])]
    public function show(Alcohol $alcohol): Response
    {
        return $this->render('alcohol/show.html.twig', [
            'alcohol' => $alcohol,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alcohol_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alcohol $alcohol, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlcoholType::class, $alcohol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alcohol_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alcohol/edit.html.twig', [
            'alcohol' => $alcohol,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alcohol_delete', methods: ['POST'])]
    public function delete(Request $request, alcohol $alcohol, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alcohol->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($alcohol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alcohol_index', [], Response::HTTP_SEE_OTHER);
    }
}
