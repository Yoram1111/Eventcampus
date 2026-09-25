<?php

namespace App\Service;

class Store
{
    public function getCategories(): array
    {
        return ['culturel', 'sportif', 'associatif', 'festif'];
    }

    public function getEvenements(): array
    {
        return [
            1 => [
                'id' => 1,
                'titre' => 'Soirée Étudiante Halloween',
                'description' => 'Grande soirée costumée pour célébrer Halloween au campus !',
                'date_debut' => '2024-10-31 20:00:00',
                'date_fin' => '2024-11-01 02:00:00',
                'lieu' => 'Amphithéâtre Central',
                'categorie' => 'festif',
                'organisateur' => 'BDE Campus',
                'prix' => 8.0,
                'places_disponibles' => 150,
                'places_totales' => 200,
                'image' => 'halloween.jpg',
                'statut' => 'ouvert'
            ],
            2 => [
                'id' => 2,
                'titre' => 'Tournoi de Football Inter-Promos',
                'description' => 'Affrontez les autres promos dans un tournoi de foot à 7 dans la bonne humeur.',
                'date_debut' => '2026-10-10 14:00:00',
                'date_fin' => '2026-10-10 18:00:00',
                'lieu' => 'Stade Universitaire',
                'categorie' => 'sportif',
                'organisateur' => 'Association Sportive',
                'prix' => 0.0,
                'places_disponibles' => 6,
                'places_totales' => 64,
                'image' => 'football.jpg',
                'statut' => 'ouvert'
            ],
            3 => [
                'id' => 3,
                'titre' => "Soirée Théâtre d'Improvisation",
                'description' => "Le club théâtre vous propose un match d'impro où le public choisit les thèmes.",
                'date_debut' => '2026-10-15 19:30:00',
                'date_fin' => '2026-10-15 22:00:00',
                'lieu' => 'Salle Molière',
                'categorie' => 'culturel',
                'organisateur' => 'Club Théâtre',
                'prix' => 5.0,
                'places_disponibles' => 0,
                'places_totales' => 120,
                'image' => 'theatre.jpg',
                'statut' => 'complet'
            ],
            4 => [
                'id' => 4,
                'titre' => 'Collecte Solidaire de Noël',
                'description' => 'Déposez vêtements, jouets et denrées non périssables pour les familles du quartier.',
                'date_debut' => '2026-11-05 10:00:00',
                'date_fin' => '2026-11-05 17:00:00',
                'lieu' => 'Hall B',
                'categorie' => 'associatif',
                'organisateur' => 'Association Solidarité Campus',
                'prix' => 0.0,
                'places_disponibles' => 40,
                'places_totales' => 50,
                'image' => 'collecte.jpg',
                'statut' => 'ouvert'
            ],
            5 => [
                'id' => 5,
                'titre' => 'Gala de Noël',
                'description' => "Soirée chic de fin d'année avec repas, DJ et photobooth.",
                'date_debut' => '2026-12-11 20:00:00',
                'date_fin' => '2026-12-12 03:00:00',
                'lieu' => 'Salle des Fêtes',
                'categorie' => 'festif',
                'organisateur' => 'BDE Campus',
                'prix' => 25.0,
                'places_disponibles' => 30,
                'places_totales' => 300,
                'image' => 'gala.jpg',
                'statut' => 'ouvert'
            ],
            6 => [
                'id' => 6,
                'titre' => 'Course Solidaire 10 km',
                'description' => 'Une course ouverte à tous, les bénéfices sont reversés à une association caritative.',
                'date_debut' => '2027-03-20 09:00:00',
                'date_fin' => '2027-03-20 12:00:00',
                'lieu' => 'Parc du Campus',
                'categorie' => 'sportif',
                'organisateur' => 'Bureau des Sports',
                'prix' => 5.0,
                'places_disponibles' => 180,
                'places_totales' => 250,
                'image' => 'course.jpg',
                'statut' => 'ouvert'
            ],
            7 => [
                'id' => 7,
                'titre' => 'Exposition Photo « Regards Étudiants »',
                'description' => 'Découvrez les meilleurs clichés réalisés par les étudiants du club photo.',
                'date_debut' => '2027-03-08 10:00:00',
                'date_fin' => '2027-03-12 18:00:00',
                'lieu' => 'Bibliothèque Universitaire',
                'categorie' => 'culturel',
                'organisateur' => 'Club Photo',
                'prix' => 0.0,
                'places_disponibles' => 95,
                'places_totales' => 100,
                'image' => 'expo-photo.jpg',
                'statut' => 'ouvert'
            ],
            8 => [
                'id' => 8,
                'titre' => 'Forum des Associations',
                'description' => 'Rencontrez toutes les associations du campus et trouvez celle qui vous correspond.',
                'date_debut' => '2025-09-18 10:00:00',
                'date_fin' => '2025-09-18 17:00:00',
                'lieu' => 'Parvis Principal',
                'categorie' => 'associatif',
                'organisateur' => 'BDE Campus',
                'prix' => 0.0,
                'places_disponibles' => 100,
                'places_totales' => 500,
                'image' => 'forum.jpg',
                'statut' => 'ouvert'
            ],
            9 => [
                'id' => 9,
                'titre' => 'Tournoi de Basket 3x3',
                'description' => 'Tournoi de basket en équipes de 3, annulé suite à des travaux au gymnase.',
                'date_debut' => '2026-10-24 13:00:00',
                'date_fin' => '2026-10-24 19:00:00',
                'lieu' => 'Gymnase Nord',
                'categorie' => 'sportif',
                'organisateur' => 'Bureau des Sports',
                'prix' => 3.0,
                'places_disponibles' => 32,
                'places_totales' => 32,
                'image' => 'basket.jpg',
                'statut' => 'annule'
            ],
            10 => [
                'id' => 10,
                'titre' => "Soirée de Fin d'Année",
                'description' => "La grande fête de fin d'année pour célébrer les diplômés.",
                'date_debut' => '2030-06-14 21:00:00',
                'date_fin' => '2030-06-15 04:00:00',
                'lieu' => 'Amphithéâtre Central',
                'categorie' => 'festif',
                'organisateur' => 'BDE Campus',
                'prix' => 12.0,
                'places_disponibles' => 350,
                'places_totales' => 350,
                'image' => 'fin-annee.jpg',
                'statut' => 'ouvert'
            ],
        ];
    }
}
