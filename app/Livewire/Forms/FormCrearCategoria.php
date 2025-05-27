<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearCategoria extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:100', 'unique:categories,nombre'])]
    public string $nombre="";
    
    #[Validate(['required', 'color_hex'])]
    public string $color="";

    public function formStore(){
        $datos=$this->validate();
        //vamos a guardar el registro
        Category::create($datos);

    }

    public function formCancelar(){
        $this->resetValidation();
        $this->reset();
    }
}
