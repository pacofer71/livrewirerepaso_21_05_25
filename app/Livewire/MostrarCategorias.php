<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class MostrarCategorias extends Component
{
    public function render()
    {
        $categorias=Category::orderBy('id', 'desc')->get();
        return view('livewire.mostrar-categorias', compact('categorias'));
    }
}
