<?php

namespace Database\Seeders;

use App\Models\AtividadeMaquina;
use Illuminate\Database\Seeder;

class AtividadeMaquinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AtividadeMaquina::factory()->create([
            'hashcode_maquina' => '$2y$10$meLLu4qZwa9GXlGSB9/KLu/KDT.ayLqTAFKbtxP/qQpieyFe2.wUW',
            'data_hora_inicio' => now(),
            'last_notification' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
