<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categorias = [
            "Tecnología" => "#1E90FF",   // Azul DodgerBlue
            "Salud" => "#28A745",        // Verde
            "Educación" => "#FFC107",    // Amarillo ámbar
            "Entretenimiento" => "#E83E8C", // Rosa fuerte
            "Viajes" => "#17A2B8"        // Cian claro
        ];
        foreach($categorias as $nombre=>$color){
            Category::create(compact('nombre', 'color'));
        }
    }
}
