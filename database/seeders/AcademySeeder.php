<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Academy;

class AcademySeeder extends Seeder
{
    public function run(): void
    {
        Academy::updateOrCreate(
            ['slug' => 'dancelife-huelva'],
            [
                'name' => 'Dancelife Studio',
                'description' => '¿Quieres conocer gente nueva mientras te diviertes? En nuestras clases descubrirás ritmo, amistades, buena energía y momentos únicos.',
                'phone' => '+34 664 39 35 29',
                'email' => 'info@dancelifehuelva.com',
                'whatsapp' => '+34 664 39 35 29',
                'address' => '25-27, C. Platero, 21006 Huelva',
                'instagram_url' => 'https://www.instagram.com/dancelifehuelva/?hl=es',
                'hero_title' => 'SALSA, BACHATA Y BAILE URBANO',
                'hero_text' => 'Clases de bailes latinos con Charlie y Vero. Clases de baile urbano con Lidia Fernández y Celia Gonzales.',
            ]
        );
    }
}
