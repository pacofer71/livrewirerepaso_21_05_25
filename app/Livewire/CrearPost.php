<?php

namespace App\Livewire;

use App\Livewire\Forms\FormCrearPost;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrearPost extends Component
{
    use WithFileUploads;

    public bool $openCrear=false;

    public FormCrearPost $cform;

    public function render()
    {
        $categorias=Category::select('nombre', 'id')->orderBy('nombre')->get();
        return view('livewire.crear-post', compact('categorias'));
    }

    public function store(){
        $this->cform->formStore();
    }
    public function cancelar(){
        $this->openCrear=false;
        $this->cform->formCancelar();
    }
}
