<?php

namespace App\Controller;

use App\Entity\Alchole;
use App\Form\AlcholeType;
use App\Repository\AlcholeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alchole')]
final class AlcholeController extends AbstractController
{
    #[Route(name: 'app_alchole_index', methods: ['GET'])]
    public function index(AlcholeRepository $alcholeRepository): Response
    {
        return $this->render('alchole/index.html.twig', [
            'alcholes' => $alcholeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alchole_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alchole = new Alchole();
        $form = $this->createForm(AlcholeType::class, $alchole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alchole);
            $entityManager->flush();

            return $this->redirectToRoute('app_alchole_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alchole/new.html.twig', [
            'alchole' => $alchole,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alchole_show', methods: ['GET'])]
    public function show(Alchole $alchole): Response
    {
        return $this->render('alchole/show.html.twig', [
            'alchole' => $alchole,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alchole_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Alchole $alchole, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlcholeType::class, $alchole);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alchole_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alchole/edit.html.twig', [
            'alchole' => $alchole,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alchole_delete', methods: ['POST'])]
    public function delete(Request $request, Alchole $alchole, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alchole->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($alchole);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alchole_index', [], Response::HTTP_SEE_OTHER);
    }
}
