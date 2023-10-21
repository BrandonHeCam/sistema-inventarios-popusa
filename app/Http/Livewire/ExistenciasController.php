<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Existencias;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\existenciasImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ExistenciasController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $file, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function mount()
    {
        $this->pageTitle = 'Importacion';
        $this->componentName = 'Existencias SAI';
    }


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0)
            $data = Existencias::where('desc_prod', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Existencias::orderBy('cve_prod', 'asc')->paginate($this->pagination);


        return view('livewire.existencias.existencias', ['existencias' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    public function resetUI()
    {
        $this->file     = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }


    public function Store()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new existenciasImport();
        $import->setFirstRow(true); // Restablecer la variable $firstRow a true antes de importar

        Excel::import(new existenciasImport, $this->file);

        session()->flash('message', 'File import');
        $this->resetUI();
        $this->emit('Existencias-added', 'Archivo Registrado');
    }
}
