<?php

namespace App\Livewire;

use App\Livewire\Forms\FormUpdateCategoria;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarCategorias extends Component
{
    
    public bool $openUpdate=false;
    public FormUpdateCategoria $uform;
    
    #[On('evtCrearCategoria')]
    public function render()
    {
        $categorias=Category::orderBy('id', 'desc')->get();
        return view('livewire.mostrar-categorias', compact('categorias'));
    }

    public function confirmarBorrar(Category $category){
        $this->dispatch('evtPermisoBorrar', $category->id);
    }
    
    #[On('evtBorrarOk')]
    public function borrar(Category $category){
        $category->delete();
        $this->dispatch('mensaje', 'Categoria Borrada');
    }

    public function edit(Category $category){
        $this->uform->formSetCategory($category);
        $this->openUpdate=true;
    }

    public function update(){
        $this->uform->formUpdate();
        $this->cancelar();
        $this->dispatch('mensaje', 'Categoria editada');

    }
    public function cancelar(){
        $this->openUpdate=false;
        $this->uform->formCancelar();
    }
}
