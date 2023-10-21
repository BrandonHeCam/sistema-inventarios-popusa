<?php

namespace App\Http\Livewire;
use App\Models\Almacenes;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AlmacenesController extends Component
{
    use WithFileUploads;
	use WithPagination;

	public $clave, $descripcion, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

	
    //Método para darle titulo a la vista 
	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Almacenes';
	}

    //Método para la paginación de los almacenes
	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


    //Para mostrar la tabla de los almacenes
	public function render()
	{
		if(strlen($this->search) > 0)
			$data = Almacenes::where('clave', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Almacenes::orderBy('id','asc')->paginate($this->pagination);

		return view('livewire.almacenes.almacenes', ['almacenes' => $data])
 		->extends('layouts.theme.app')
		->section('content');
	}

    //Método para guardar los registros de acuerdo a los campos de la base de datos
	public function Store()
	{
		$rules = [
			'clave' => 'required|unique:almacenes',
            'descripcion' => 'required|unique:almacenes|min:3'
		];

		$messages = [
			'clave.required' => 'La clave es requerida',
            'clave.unique' => 'La clave ya existe',
			'descripcion.unique' => 'Ya existe esa descripcion',
			'descripcion.min' => 'El nombre de la descripcion debe tener al menos 10 caracteres'
		];

		$this->validate($rules, $messages);

		$almacenes = Almacenes::create([
            'clave' => $this->clave,
            'descripcion' => $this->descripcion
		]);

        $almacenes->save();
		$this->resetUI();
		$this->emit('almacen-added','Almacen Registrado');

	}

 	//Método para que redireccione al formulario de editar los almacenes
	public function Edit($id)
	{
		$record = Almacenes::find($id, ['id','clave', 'descripcion']);
		
        $this->clave = $record->clave;
        $this->descripcion = $record->descripcion;
	    $this->selected_id = $record->id;

		$this->emit('show-modal', 'show modal!');
	}


    //Método para actualizar un registro en particular
	public function Update()
	{
		$rules =[
			'clave' => "required|unique:almacenes,clave,{$this->selected_id}",
            'descripcion' => "required"            
		];

		$messages =[
			'clave.required' => 'Nombre de la clave es requerida',
			'clave.unique' => 'El nombre de la clave ya existe'
		];

		$this->validate($rules, $messages);


		$almacenes = Almacenes::find($this->selected_id);
		$almacenes->update([
			'clave' => $this->clave,
            'descripcion' => $this->descripcion
		]);

        $almacenes->save();
		$this->resetUI();
		$this->emit('almacen-updated', 'Almacen Actualizado');
	}


    //Método ligado al buscador
	public function resetUI() 
	{
		$this->clave ='';
		$this->descripcion ='';
		$this->search ='';
		$this->selected_id =0;
	}

	protected $listeners =['deleteRow' => 'Destroy'];

	//Método para eliminar los almacenes
	public function Destroy(Almacenes $almacenes)
	{   	

		$almacenes->delete();
		$this->resetUI();
		$this->emit('almacenes-deleted', 'Almacen Eliminada');

	}

}
