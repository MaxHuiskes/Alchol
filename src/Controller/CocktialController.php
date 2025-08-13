<?php

namespace App\Controller;

use App\Service\CocktailService;
use App\Repository\ReceptRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\AlcoholSelectionType;
use Symfony\Component\HttpFoundation\Request;

final class CocktialController extends AbstractController
{

    #[Route('/cocktail/{id}', name: 'cocktail_show')]
    public function show(int $id, ReceptRepository $receptRepository): Response
    {
        $cocktail = $receptRepository->find($id);

        if (!$cocktail) {
            throw $this->createNotFoundException('Cocktail not found');
        }

        return $this->render('cocktails/show.html.twig', [
            'recept' => $cocktail
        ]);
    }

    #[Route('/', name: 'cocktail_index')]
    public function index(Request $request, ReceptRepository $receptRepository): Response
    {
        $form = $this->createForm(AlcoholSelectionType::class);
        $form->handleRequest($request);

        $canMake = [];
        $almost = [];
        $containsSome = []; // <-- initialize here

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);
          $canMake = [];
            $almost = [];
            $containsSome = [];

            $selectedalcohols = $form->get('alcohol')->getData()->toArray();
            $selectedIds = array_map(fn($a) => $a->getId(), $selectedalcohols);

            foreach ($receptRepository->findAll() as $recept) {
                $neededIds = $recept->getalcohol()->map(fn($a) => $a->getId())->toArray();
                $missing = array_diff($neededIds, $selectedIds);
                $matched = array_intersect($neededIds, $selectedIds);

                if (count($missing) === 0) {
                    $canMake[] = $recept;
                } elseif (count($missing) === 1) {
                    $almost[] = [
                        'recept' => $recept,
                        'missing' => $missing,
                    ];
                } elseif (count($matched) > 0) {
                    // At least one ingredient is selected, but recipe is incomplete
                    $containsSome[] = [
                        'recept' => $recept,
                        'missing' => $missing,
                    ];
                }
            }

        }

        return $this->render('cocktails/index.html.twig', [
            'form' => $form->createView(),
            'canMake' => $canMake,
            'containsSome' => $containsSome,
            'almost' => $almost
        ]);
    }

}