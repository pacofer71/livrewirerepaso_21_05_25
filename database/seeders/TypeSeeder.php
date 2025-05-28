<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            "Tecnología" => "#1E90FF",   // Azul DodgerBlue
            "Salud" => "#28A745",        // Verde
            "Educación" => "#FFC107",    // Amarillo ámbar
            "Entretenimiento" => "#E83E8C", // Rosa fuerte
            "Viajes" => "#17A2B8"        // Cian claro
        ];
        foreach($tipos as $nombre=>$color){
            Type::create(compact('nombre', 'color'));
        }
    }
}
