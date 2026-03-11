<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animateur;
use App\Models\Seminaire;
use App\Models\Activite;

class SeminairSeeder extends Seeder
{
    public function run(): void
    {
        // Create animators
        $animator1 = Animateur::create([
            'nom' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'telephone' => '0123456789',
            'bio' => 'Expert en développement web',
        ]);

        $animator2 = Animateur::create([
            'nom' => 'Marie Martin',
            'email' => 'marie@example.com',
            'telephone' => '0987654321',
            'bio' => 'Spécialiste en design',
        ]);

        // Create seminars
        $seminar1 = Seminaire::create([
            'theme' => 'Séminaire Web Development',
            'date_debut' => '2024-03-01',
            'date_fin' => '2024-03-03',
            'description' => 'Séminaire avancé sur le développement web avec Laravel et Vue.js',
            'cout_journalier' => 500.00,
            'animateur_id' => $animator1->id,
        ]);

        $seminar2 = Seminaire::create([
            'theme' => 'Atelier PHP',
            'date_debut' => '2024-04-15',
            'date_fin' => '2024-04-16',
            'description' => 'Introduction approfondie à PHP et bonnes pratiques',
            'cout_journalier' => 350.00,
            'animateur_id' => $animator1->id,
        ]);

        $seminar3 = Seminaire::create([
            'theme' => 'Design Thinking Workshop',
            'date_debut' => '2024-05-10',
            'date_fin' => '2024-05-12',
            'description' => 'Séminaire pratique sur le design thinking et l\'innovation',
            'cout_journalier' => 600.00,
            'animateur_id' => $animator2->id,
        ]);

        // Create activities
        Activite::create([
            'nom' => 'Atelier pratique de développement web',
            'description' => 'Séance pratique sur les concepts avancés de développement web',
            'seminaire_id' => $seminar1->id,
        ]);

        Activite::create([
            'nom' => 'Séance de Q&A',
            'description' => 'Questions et réponses interactives sur les nouvelles technologies web',
            'seminaire_id' => $seminar1->id,
        ]);

        Activite::create([
            'nom' => 'Atelier pratique PHP',
            'description' => 'Séance pratique sur les concepts avancés de PHP',
            'seminaire_id' => $seminar2->id,
        ]);

        Activite::create([
            'nom' => 'Atelier pratique de design thinking',
            'description' => 'Séance pratique sur les concepts avancés de design thinking',
            'seminaire_id' => $seminar3->id,
        ]);
    }
}
