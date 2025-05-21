<?php

namespace App\Livewire;

use Livewire\Component;

class CrearCategoria extends Component
{
    public bool $openCrear=false;
    public function render()
    {
        return view('livewire.crear-categoria');
    }
}
