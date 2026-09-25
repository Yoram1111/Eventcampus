<?php

namespace App\Controller;

use App\Service\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EvenementController extends AbstractController
{
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    #[Route('/evenements', name: 'app_evenement_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $this->store->getEvenements(),
            'categories' => $this->store->getCategories(),
        ]);
    }

    #[Route('/evenements/categorie/{categorie}', name: 'app_evenement_categorie', requirements: ['categorie' => '[a-z]+'], methods: ['GET'])]
    public function categorie(string $categorie): Response
    {
        if (!in_array($categorie, $this->store->getCategories())) {
            $this->addFlash('danger', "La catégorie « $categorie » n'existe pas.");
            return $this->redirectToRoute('app_evenement_index');
        }

        $evenements = array_filter($this->store->getEvenements(), function ($e) use ($categorie) {
            return $e['categorie'] === $categorie;
        });

        return $this->render('evenement/categorie.html.twig', [
            'evenements' => $evenements,
            'categorie' => $categorie,
        ]);
    }

    #[Route('/evenements/par-mois/{annee}/{mois}', name: 'app_evenement_par_mois', requirements: ['annee' => '\d{4}', 'mois' => '\d{1,2}'], methods: ['GET'])]
    public function parMois(int $annee, int $mois): Response
    {
        if ($annee < 2024 || $annee > 2030 || $mois < 1 || $mois > 12) {
            $this->addFlash('danger', "Date invalide : l'année doit être entre 2024 et 2030 et le mois entre 1 et 12.");
            return $this->redirectToRoute('app_evenement_index');
        }

        $debut = sprintf('%d-%02d', $annee, $mois);

        $evenements = array_filter($this->store->getEvenements(), function ($e) use ($debut) {
            return str_starts_with($e['date_debut'], $debut);
        });

        return $this->render('evenement/par_mois.html.twig', [
            'evenements' => $evenements,
            'annee' => $annee,
            'mois' => $mois,
        ]);
    }

    #[Route('/evenements/filtre', name: 'app_evenement_filtre', methods: ['GET'])]
    public function filtre(Request $request): Response
    {
        $categorie = $request->query->get('categorie');
        $acces = $request->query->get('acces');

        $evenements = $this->store->getEvenements();

        if ($categorie) {
            $evenements = array_filter($evenements, function ($e) use ($categorie) {
                return $e['categorie'] === $categorie;
            });
        }

        if ($acces === 'gratuit') {
            $evenements = array_filter($evenements, function ($e) {
                return $e['prix'] == 0;
            });
        }

        if ($acces === 'payant') {
            $evenements = array_filter($evenements, function ($e) {
                return $e['prix'] > 0;
            });
        }

        return $this->render('evenement/filtre.html.twig', [
            'evenements' => $evenements,
            'categorie' => $categorie,
            'acces' => $acces,
            'categories' => $this->store->getCategories(),
        ]);
    }

    #[Route('/evenements/{id}', name: 'app_evenement_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id): Response
    {
        $evenement = $this->store->getEvenements()[$id] ?? null;

        if (!$evenement) {
            throw $this->createNotFoundException("L'événement n°$id n'existe pas.");
        }

        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}
