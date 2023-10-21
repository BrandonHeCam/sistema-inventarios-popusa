<?php


namespace App\Http\Livewire;

use App\Models\Zonas;
use App\Models\Inventarios;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class InventariosController extends Component
{

    use WithFileUploads;
    use WithPagination;

	public $id_zona, $folio, $status, $fechaInicial, $fechaFinal, $observaciones, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

	
    //Método para darle titulo a la vista 
	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Inventarios';
		$this->id_zona = 'Elegir';
	}

    //Método para la paginación de los inventarios
	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	//Render original
	public function render()
	{
		//Llave foranea de zona
		if (strlen($this->search) > 0)
			$inventarios = Inventarios::join('zonas as d', 'd.id', 'inventarios.id_zona')
				->select('inventarios.*', 'd.descripcion as zona')
				->where('inventarios.folio', 'like', '%' . $this->search . '%')
				->orderBy('inventarios.folio', 'asc')
				->paginate($this->pagination);
		else
		    $inventarios = Inventarios::join('zonas as d', 'd.id', 'inventarios.id_zona')
				->select('inventarios.*', 'd.descripcion as zona')
				->orderBy('inventarios.folio', 'asc')
				->paginate($this->pagination);


		return view('livewire.inventarios.inventarios', [
			'data' => $inventarios,
			'zonas' => Zonas::orderBy('id', 'asc')->get(),
		])
			->extends('layouts.theme.app')
			->section('content');
	}


   //Método ligado al buscador
   public function resetUI() 
   {
       $this->id_zona = 'Elegir';
       $this->folio ='';
       $this->status = '';
	   $this->fechaInicial = '';
	   $this->fechaFinal = '';
       $this->observaciones ='';
       $this->search ='';
       $this->selected_id =0;
   }

   //Método para guardar los registros de acuerdo a los campos de la base de datos
	public function Store()
	{
		$rules = [
            'id_zona' => "required|",
		    'folio' => "required|",
            'status' => "required|",
			'fechaInicial' => "required|",
			'fechaFinal' => "required|",
            'observaciones' => "required|"
		];

		$messages = [
            'id_zona' => 'Seleccione la zona',
            'folio.required' => 'El folio es requerido',
			'status.required' => 'Se require seleccionar el status',
			'fechaInicial' => 'Se requiere la fecha inicial',
			'fechaFinal' => 'Se requiere la fecha final',
            'observaciones.required' => 'Las observaciones es requerido'
		];

		$this->validate($rules, $messages);

		$inventarios = Inventarios::create([
            'id_zona' => $this->id_zona,
	        'folio' => $this->folio,
    		'status' => $this->status,
			'fechaInicial' => $this->fechaInicial,
			'fechaFinal' => $this->fechaFinal,
            'observaciones' => $this->observaciones
		]);

        $inventarios->save();
		$this->resetUI();
		$this->emit('Inventario-added','Inventario Registrado');

	}

	//Método para que redireccione al formulario de editar las Inventarios
	public function Edit($id)
	{
		$record = Inventarios::find($id, ['id','id_zona', 'folio','status','fechaInicial','fechaFinal','observaciones']);
        $this->id_zona = $record->id_zona;
		$this->folio = $record->folio;
		$this->status = $record->status;
		$this->fechaInicial = $record->fechaInicial;
		$this->fechaFinal = $record->fechaFinal;
        $this->observaciones = $record->observaciones;
		$this->selected_id = $record->id;

		$this->emit('show-modal', 'show modal!');
	}


	//Método para actualizar un registro en particular
	public function Update()
	{
		$rules =[
            'id_zona' => "required|",
            //'folio' => "required|unique:inventarios,folio,{$this->selected_id}",
			'status' => "required|",
			'fechaInicial' => "required|",
			'fechaFinal' => "required|",
            'observaciones' => "required|"
		];

		$messages =[
            'id_zona' => 'Seleccione la zona',
			'folio.required' => 'El folio es requerido',
            'status.required' => 'Se require seleccionar el status',
			'fechaInicial' => 'Se requiere la fecha inicial',
			'fechaFinal' => 'Se requiere la fecha final',
            'observaciones.required' => 'Las observaciones es requerido'
		];

		$this->validate($rules, $messages);


		$inventarios = Inventarios::find($this->selected_id);
		$inventarios->update([
            'id_zona' => $this->id_zona,
            'folio' => $this->folio,
			'status' => $this->status,
			'fechaInicial' => $this->fechaInicial,
			'fechaFinal'=> $this->fechaFinal,
            'observaciones' => $this->observaciones
            
		]);

        $inventarios->save();
		$this->resetUI();
		$this->emit('Inventario-updated', 'Inventario Actualizada');
	}

	protected $listeners =['deleteRow' => 'Destroy'];

	//Método para eliminar las inventarios
	public function Destroy(Inventarios $inventarios)
	{   	
		$inventarios->delete();
		$this->resetUI();
		$this->emit('Inventario-deleted', 'Inventario Eliminado');

	}

}
