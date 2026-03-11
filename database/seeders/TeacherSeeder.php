<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Academy;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $academy = Academy::first();

        $teachers = [
            [
                'name' => 'Charlie',
                'bio' => 'Profesor de bailes latinos especializado en salsa y bachata.',
                'sort_order' => 1
            ],
            [
                'name' => 'Vero',
                'bio' => 'Profesora de bailes latinos con amplia experiencia en enseñanza social.',
                'sort_order' => 2
            ],
            [
                'name' => 'Pablo',
                'bio' => 'Profesor colaborador en clases latinas y dinámicas grupales.',
                'sort_order' => 3
            ],
            [
                'name' => 'Lidia Fernández',
                'bio' => 'Profesora de baile urbano con enfoque en coreografía y técnica.',
                'sort_order' => 4
            ],
            [
                'name' => 'Celia Gonzalez',
                'bio' => 'Profesora de urbano especializada en trabajo coreográfico y performance.',
                'sort_order' => 5
            ]
        ];

        foreach ($teachers as $teacher) {

            Teacher::updateOrCreate(
                [
                    'academy_id' => $academy->id,
                    'name' => $teacher['name']
                ],
                $teacher + [
                    'academy_id' => $academy->id,
                    'is_active' => true
                ]
            );
        }
    }
}
