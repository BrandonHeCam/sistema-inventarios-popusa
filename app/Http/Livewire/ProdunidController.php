<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Produnid;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\produnidImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ProdunidController extends Component
{
    use WithFileUploads;
	use WithPagination;

	public $file, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 10;

	public function mount()
	{
		$this->pageTitle = 'Presentaciones';
		$this->componentName = 'Productos';
	}


	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	public function render()
	{
		if(strlen($this->search) > 0)
			$data = Produnid::where('cve_prod', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Produnid::orderBy('cve_prod','asc')->paginate($this->pagination);

            
		return view('livewire.produnid.produnid', ['produnids' => $data])
		->extends('layouts.theme.app')
		->section('content');

	}	


	public function resetUI()
	{
		$this->file = '';
		$this->selected_id = 0;
		$this->resetValidation();
	}


	public function Store(){
		$this->validate([
			'file' => 'required|mimes:xlsx,xls' 
		]);

		$import = new produnidImport();
        $import->setFirstRow(true); // Restablecer la variable $firstRow a true antes de importar

		Excel::import(new produnidImport, $this->file);

		session()->flash('message', 'File import');
		$this->resetUI();
		$this->emit('Producto-added','Archivo Registrado');
		
	}

	
}