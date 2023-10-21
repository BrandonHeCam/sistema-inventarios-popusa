<?php

namespace App\Http\Livewire;


use App\Models\Conteos;
use App\Models\Productos;
use App\Models\Existencias;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Inventarios;


class ConteosController extends Component
{

	use WithFileUploads;
	use WithPagination;



	public $id_producto, $cve_prod, $desc_prod, $conteo1, $conteo2, $id_existencia, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

	//muestra la lista de sugerencias de la busqueda
	public $showlist = false;
	//dato a buscar
	public $codbar = "";
	//Almacena los datos para sugerencia
	public $results;
	//Almacena los datos a los que se hicieron click
	public $product;
	
	// buscar y agregar producto por escaner y/o manual
	public function ScanCode($barcode, $cant = 1)
	{
		$this->ScanearCode($barcode, $cant);
	}

	// incrementar cantidad item en carrito
	public function increaseQty(Productos $product, $conteo1 = 1)
	{
		$this->IncreaseQuantity($product, $conteo1);
	}

	//Obtener registros en la busqueda
	public function searchProduct(){

		if(!empty($this->codbar)){

			$this->results = Productos::orderby('codbar', 'asc')
				->select('*')
				->where('codbar', 'like', '%' . $this->codbar . '%')
				->get();

			$this->showlist = true;    
		}else{
			$this->showlist = false;
		}
	}

	//Obtener registro seleccionado por su id es para obtener la informacion de masivos == productos
	public function getProduct($id = 0){

		$result = Productos::select('*')
			->where('id', $id)
			->first();
		
		$this->codbar = $result->codbar;
		$this->product = $result;
		$this->showlist = false; 	
	}
 	
	//funcion para validar el bloqueo

	//////////////////////////
	
	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Conteos';
	}

	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


	//Render original
	public function render()
	{
		//Llave foranea de almacen
		if (strlen($this->search) > 0)
			$conteos = Conteos::where('cve_prod', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$conteos = Conteos::orderBy('id','asc')->paginate($this->pagination);

		return view('livewire.conteo.conteo', [
			'data' => $conteos])
			->extends('layouts.theme.app')
			->section('content');
	}

	public function Store()
	{
		$rules = [
			'codbar' => 'required|',
		];

		$messages = [
            'codbar' => 'La clave es requeridad'
		];

		$this->validate($rules, $messages);
		
		$decision = Conteos::where('codbar', $this->codbar)->first();
		//$limite = Conteos::where('codbar', $this->codbar)->where('created_at', $this->created_at)->first();
		
		if(is_null($decision)){
			$conteos = new Conteos([
				'codbar' => $this->codbar,
				'cve_prod' => $this->product->cve_prod,
				'conteo1' => $this->conteo1,
				'conteo2' => $this->conteo2,
				'id_usuario' => Auth()->user()->id,
				'id_producto' => $this->product->id,
			]);	
				$conteos->save();
				$this->resetUI();
				$this->emit('Conteo-added','Conteo Registrado');
		}else{
			$conteos = Conteos::UpdateOrCreate([
				//'folio' => $this->folio,
				'codbar' => $this->codbar,
			],[
				'conteo2' => $this->conteo1,
			]);
			$this->resetUI();
			$this->emit('Conteo-added','Conteo Registrado');
		}
	}


	public function Edit($id)
	{		
		$record = Conteos::find($id, ['id','codbar','cve_prod','conteo1','conteo2','id_usuario','id_producto']);
		$this->codbar= $record->codbar;
		$this->cve_prod = $record->cve_prod;
		$this->conteo1 = $record->conteo1;
		$this->conteo2 = $record->conteo2;
		$this->selected_id = $record->id;
		$this->emit('show-modal', 'show modal!');
	}


	public function Update()
	{
		$rules = [
			'codbar' => 'required|',
		];

		$messages = [
            'codbar' => 'El codigo es requerido',
		];

		$this->validate($rules, $messages);
		
		$conteos = Conteos::find($this->selected_id);

		$conteos->update([
			'codbar' => $this->codbar,
			'cve_prod' => $this->cve_prod,
			'conteo1' => $this->conteo1,
            'conteo2' => $this->conteo2,
    	]);

		$this->resetUI();
		$this->emit('Conteo-updated', 'Conteo Actualizado');
	}


	public function resetUI() 
	{
	    $this->codbar ='';
		$this->cve_prod ='';
		$this->conteo1 ='';
		$this->conteo2 ='';
		$this->selected_id =0;
	}

	protected $listeners =['deleteRow' => 'Destroy', 'scan-code'  =>  'ScanCode',];

	
	public function Destroy(Conteos $conteos)
	{   	
		$conteos->delete();
		$this->resetUI();
		$this->emit('Datos-deleted', 'Datos Eliminados');
	}
}
