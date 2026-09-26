<?php

namespace App\Controller;

use App\Service\Store;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    // Cahier des charges : accueil avec statistiques générales
    #[Route('/', name: 'app_accueil', methods: ['GET'])]
    public function index(): Response
    {
        $evenements = $this->store->getEvenements();

        $maintenant = date('Y-m-d H:i:s');
        $aVenir = array_filter($evenements, function ($e) use ($maintenant) {
            return $e['date_debut'] >= $maintenant;
        });

        usort($aVenir, function ($a, $b) {
            return strcmp($a['date_debut'], $b['date_debut']);
        });

        return $this->render('home/index.html.twig', [
            'prochains' => array_slice($aVenir, 0, 3),
            'nb_evenements' => count($evenements),
            'nb_a_venir' => count($aVenir),
        ]);
    }

    // Cahier des charges : page de statistiques
    #[Route('/statistiques', name: 'app_statistiques', methods: ['GET'])]
    public function statistiques(): Response
    {
        $evenements = $this->store->getEvenements();

        $parCategorie = [];
        foreach ($this->store->getCategories() as $categorie) {
            $parCategorie[$categorie] = 0;
        }
        foreach ($evenements as $e) {
            $parCategorie[$e['categorie']]++;
        }

        return $this->render('statistiques/index.html.twig', [
            'total' => count($evenements),
            'parCategorie' => $parCategorie,
        ]);
    }
}
