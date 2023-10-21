<?php


namespace App\Http\Livewire;

use App\Models\Almacenes;
use App\Models\Zonas;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class ZonasController extends Component
{

    use WithFileUploads;
    use WithPagination;

	public $id_almacen, $clave, $descripcion, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

	
    //Método para darle titulo a la vista 
	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Zonas';
		$this->id_almacen = 'Elegir';
	}

    //Método para la paginación de las zonas
	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	//Render original
	public function render()
	{
		//Llave foranea de almacen
		if (strlen($this->search) > 0)
			$zonas = Zonas::join('almacenes as d', 'd.id', 'zonas.id_almacen')
				->select('zonas.*', 'd.descripcion as almacen')
				->where('zonas.descripcion', 'like', '%' . $this->search . '%')
				->orderBy('zonas.clave', 'asc')
				->paginate($this->pagination);
		else
		    $zonas = Zonas::join('almacenes as d', 'd.id', 'zonas.id_almacen')
				->select('zonas.*', 'd.descripcion as almacen')
				->orderBy('zonas.clave', 'asc')
				->paginate($this->pagination);


		return view('livewire.zonas.zonas', [
			'data' => $zonas,
			'almacenes' => Almacenes::orderBy('id', 'asc')->get(),
		])
			->extends('layouts.theme.app')
			->section('content');
	}


   //Método ligado al buscador
   public function resetUI() 
   {
       $this->id_almacen = 'Elegir';
	   $this->clave ='';
       $this->descripcion ='';
       $this->search ='';
       $this->selected_id =0;
   }

   //Método para guardar los registros de acuerdo a los campos de la base de datos
	public function Store()
	{
		$rules = [
            'id_almacen' => "required|",
			'clave' => "required|unique:zonas|min:1",
			'descripcion' => "required"
		];

		$messages = [
            'id_almacen' => 'Seleccione un almacen',
			'clave.required' => 'La clave es requerida',
			'clave.unique' => 'Ya existe la clave de la zona',
			'descripcion.required' => 'La descripcion es requerida',
		];

		$this->validate($rules, $messages);

		$zonas = Zonas::create([
            'id_almacen' => $this->id_almacen,
			'clave' => $this->clave,
            'descripcion' => $this->descripcion,
		]);

        $zonas->save();
		$this->resetUI();
		$this->emit('Zona-added','Zona Registrada');

	}

	//Método para que redireccione al formulario de editar las Zonas
	public function Edit($id)
	{
		$record = Zonas::find($id, ['id','id_almacen', 'clave','descripcion']);
        $this->id_almacen = $record->id_almacen;
		$this->clave = $record->clave;
		$this->descripcion = $record->descripcion;
        $this->selected_id = $record->id;

		$this->emit('show-modal', 'show modal!');
	}

	//Método para actualizar un registro en particular
	public function Update()
	{
		$rules =[
            'id_almacen' => "required|",
			'clave' => "required|min:1|unique:zonas,clave,{$this->selected_id}",
            'descripcion' => "required|"
		];

		$messages =[
            'id_almacen' => 'Nombre del almacen es requerido',
			'clave.required' => 'La clave es requerida',
			'clave.unique' => 'Ya existe la clave de la zona',
            'descripcion.required' => 'La descripcion es requerida'
		];

		$this->validate($rules, $messages);


		$zonas = Zonas::find($this->selected_id);
		$zonas->update([
            'id_almacen' => $this->id_almacen,
			'clave' => $this->clave,
            'descripcion' => $this->descripcion
		]);

        $zonas->save();
		$this->resetUI();
		$this->emit('Zona-updated', 'Zona Actualizada');
	}

	protected $listeners =['deleteRow' => 'Destroy'];

	//Método para eliminar las zonas
	public function Destroy(Zonas $zonas)
	{   	
		$zonas->delete();
		$this->resetUI();
		$this->emit('Zona-deleted', 'Zona Eliminada');

	}

}
