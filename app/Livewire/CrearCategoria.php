<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearCategoria;
use Livewire\Component;

class CrearCategoria extends Component
{
    public bool $openCrear=false;
    
    public FormCrearCategoria $cform;

    public function render()
    {
        return view('livewire.crear-categoria');
    }

    public function store(){
        $this->cform->formStore();
        $this->cancelar();
        $this->dispatch('evtCrearCategoria')->to(MostrarCategorias::class);
        $this->dispatch('mensaje', 'Categoria Creada con exito');
    }
    public function cancelar(){
        $this->openCrear=false;
        $this->cform->formCancelar();
    }
}
