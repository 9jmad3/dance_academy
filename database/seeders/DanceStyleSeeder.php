<?php

namespace Database\Seeders;

use App\Models\Academy;
use App\Models\DanceStyle;
use Illuminate\Database\Seeder;

class DanceStyleSeeder extends Seeder
{
    public function run(): void
    {
        $academy = Academy::firstOrCreate(
            ['slug' => 'dancelife-huelva'],
            ['name' => 'Dancelife Studio']
        );

        foreach ([
            [
                'name' => 'Latino',
                'description' => 'Clases de baile latino donde se trabajan salsa y bachata en distintos niveles, con enfoque social, técnico y dinámico.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Salsa',
                'description' => 'Clases de salsa con distintos niveles donde trabajarás ritmo, técnica y social dance.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bachata',
                'description' => 'Clases de bachata con diferentes niveles centradas en conexión, musicalidad y estilo.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Urbano',
                'description' => 'Clases de baile urbano con coreografías modernas, energía y trabajo de grupo.',
                'sort_order' => 4,
            ],
        ] as $style) {
            DanceStyle::updateOrCreate(
                [
                    'academy_id' => $academy->id,
                    'name' => $style['name'],
                ],
                $style + [
                    'academy_id' => $academy->id,
                    'is_active' => true,
                ]
            );
        }
    }
}
