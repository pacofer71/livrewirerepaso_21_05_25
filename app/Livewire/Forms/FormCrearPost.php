<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FormCrearPost extends Form
{
    #[Validate(['required', 'string', 'min:3', 'max:150', 'unique:posts,titulo'])]
    public string $titulo="";
    
    #[Validate(['required', 'string', 'min:10', 'max:500'])]
    public string $contenido="";
    
    #[Validate(['required', 'in:Publicado,Borrador'])]
    public string $estado="";
    
    #[Validate(['nullable', 'image', 'max:2048'])]
    public $imagen;

    #[Validate(['required', 'exists:categories,id'])]
    public int $category_id;

    public function formStore(){
        $this->validate();
    }
    public function formCancelar(){
        $this->resetValidation();
        $this->reset();
        
    }

}
