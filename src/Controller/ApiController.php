<?php

namespace App\Controller;

use App\Service\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
final class ApiController extends AbstractController
{
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    #[Route('/api/evenements', name: 'api_evenements', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $categorie = $request->query->get('categorie');
        $acces = $request->query->get('acces');

        if ($categorie !== null && !in_array($categorie, $this->store->getCategories())) {
            return new JsonResponse(['erreur' => "Catégorie inconnue : $categorie"], 400);
        }
        if ($acces !== null && !in_array($acces, ['gratuit', 'payant'])) {
            return new JsonResponse(['erreur' => "Accès inconnu : $acces (valeurs possibles : gratuit ou payant)"], 400);
        }-
        $evenements = $this->store->getEvenements();

        if ($categorie !== null) {
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

        return new JsonResponse(array_values($this->store->getEvenements()));
        dd($categorie, $acces);
    }


    #[Route('/api/evenements/{id}', name: 'api_evenement_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $evenement = $this->store->getEvenements()[$id] ?? null;

        if (!$evenement) {
            return new JsonResponse(['erreur' => "Événement $id introuvable"], 404);
        }

        return new JsonResponse($evenement);
    }
}
