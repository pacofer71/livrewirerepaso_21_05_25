<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUpdateCategoria extends Form
{
    public ?Category $category=null;
    public string $nombre="";
    
    #[Validate(['required', 'color_hex'])]
    public string $color="";

    public function rules():array{
        return [
            'nombre'=>['required', 'string', 'min:3', 'max:100', 'unique:categories,nombre,'.$this->category->id],
           //'color'=>['rquired', 'color_hex'],
        ];
    }

    public function formSetCategory(Category $categoria){
        $this->category=$categoria;
        $this->nombre=$categoria->nombre;
        $this->color=$categoria->color;
    }

    public function formUpdate(){
        $datos=$this->validate();
        $this->category->update($datos);
    }

   

    public function formCancelar(){
        $this->resetValidation();
        $this->reset();
    }
}
