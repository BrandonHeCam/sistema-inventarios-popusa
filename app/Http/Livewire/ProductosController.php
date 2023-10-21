<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Productos;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\excelImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProductosController extends Component
{
    use WithFileUploads;
    use WithPagination;



    public $file, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = 'Importacion';
        $this->componentName = 'Productos';
    }


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Productos::where('desc_prod', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Productos::orderBy('cve_prod', 'asc')->paginate($this->pagination);



        return view('livewire.productos.productos', ['productos' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function resetUI()
    {
        $this->file = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }


    public function Store()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new excelImport();
        $import->setFirstRow(true); // Restablecer la variable $firstRow a true antes de importar

        Excel::import(new excelImport, $this->file);

        session()->flash('message', 'File import');
        //dd($this->file);
        $this->resetUI();
        $this->emit('Producto-added', 'Producto Actualizado');
    }
}
