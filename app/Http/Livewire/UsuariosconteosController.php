<?php


namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Inventarios;
use App\Models\Usuariosconteos;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class UsuariosconteosController extends Component
{

    use WithFileUploads;
    use WithPagination;

	public $id_inventario, $id_usuario, $fechaInicial, $fechaFinal, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

	
    //Método para darle titulo a la vista 
	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Asignacion de Conteos';
		$this->id_inventario = 'Elegir';
		$this->id_usuario = 'Elegir';
	}

    //Método para la paginación de los usuario_conteos
	public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

	//Render original
	public function render()
	{
		//llave foranea de usuarios
		if (strlen($this->search) > 0)
			$usuariosconteos = Usuariosconteos::join('users as d', 'd.id', 'usuariosconteos.id_usuario')
				->select('usuariosconteos.*', 'd.name as user')
				->where('usuariosconteos.id_usuario', 'like', '%' . $this->search . '%')
				->orderBy('usuariosconteos.id_usuario', 'asc')
				->paginate($this->pagination);
		else
			$usuariosconteos = Usuariosconteos::join('users as d', 'd.id', 'usuariosconteos.id_usuario')
				->select('usuariosconteos.*', 'd.name as user')
				->orderBy('usuariosconteos.id_usuario', 'asc')
				->paginate($this->pagination);
	
		//Llave foranea de inventario
		if (strlen($this->search) > 0)
			$usuariosconteos = Usuariosconteos::join('inventarios as d', 'd.id', 'usuariosconteos.id_inventario')
				->select('usuariosconteos.*', 'd.folio as inventario')
				->where('usuariosconteos.id_inventario', 'like', '%' . $this->search . '%')
				->orderBy('usuariosconteos.id_inventario', 'asc')
				->paginate($this->pagination);
		else
			$usuariosconteos = Usuariosconteos::join('inventarios as d', 'd.id', 'usuariosconteos.id_inventario')
				->select('usuariosconteos.*', 'd.folio as inventario')
				->orderBy('usuariosconteos.id_inventario', 'asc')
				->paginate($this->pagination);

		return view('livewire.usuariosconteos.usuariosconteos', [
			'data' => $usuariosconteos,
			'inventarios' => Inventarios::orderBy('id', 'asc')->get(),
			'users' => User::orderBy('id', 'asc')->get()
			
		])
			->extends('layouts.theme.app')
			->section('content');
	}


   //Método ligado al buscador
   public function resetUI() 
   {
       $this->id_inventario = 'Elegir';
	   $this->id_usuario = 'Elegir';  
	   $this->fechaInicial = '';
	   $this->fechaFinal = '';
       $this->search ='';
       $this->selected_id =0;
   }

   //Método para guardar los registros de acuerdo a los campos de la base de datos
	public function Store()
	{
		$rules = [
            'id_inventario' => "required|",
			'id_usuario' => "required|",
			'fechaInicial' => "required|",
			'fechaFinal' => "required|",
		];

		$messages = [
            'id_inventario' => 'Seleccione un inventario',
			'id_usuario' => 'Seleccione un usuario',
			'fechaInicial' => 'Se requiere la fecha inicial',
			'fechaFinal' => 'Se requiere la fecha final'
		];

		$this->validate($rules, $messages);

		$usuariosconteos = Usuariosconteos::create([
            'id_inventario' => $this->id_inventario,
			'id_usuario' => $this->id_usuario,
			'fechaInicial' => $this->fechaInicial,
			'fechaFinal' => $this->fechaFinal
		]);

        $usuariosconteos->save();
		$this->resetUI();
		$this->emit('usuariosConteos-added','usuariosConteos Registrado');

	}

	//Método para que redireccione al formulario de editar los usuarios--conteos
	public function Edit($id)
	{
		$record = Usuariosconteos::find($id, ['id','id_inventario','id_usuario', 'fechaInicial','fechaFinal']);
        $this->id_inventario = $record->id_inventario;
		$this->id_usuario = $record->id_usuario;
		$this->fechaInicial = $record->fechaInicial;
		$this->fechaFinal = $record->fechaFinal;
		$this->selected_id = $record->id;

		$this->emit('show-modal', 'show modal!');
	}


	//Método para actualizar un registro en particular
	public function Update()
	{
		$rules =[
            'id_inventario' => "required|",
			'id_usuario' => "required|",
			'fechaInicial' => "required|",
			'fechaFinal' => "required|"
		];

		$messages =[
            'id_inventario' => 'Seleccione un inventario',
			'id_usuario' => 'Seleccione un usuario',
			'fechaInicial' => 'Se requiere la fecha inicial',
			'fechaFinal' => 'Se requiere la fecha final'
		];

		$this->validate($rules, $messages);


		$usuariosconteos = Usuariosconteos::find($this->selected_id);
		$usuariosconteos->update([
            'id_inventario' => $this->id_inventario,
			'id_usuario' => $this->id_usuario,
			'fechaInicial' => $this->fechaInicial,
			'fechaFinal'=> $this->fechaFinal            
		]);

        $usuariosconteos->save();
		$this->resetUI();
		$this->emit('usuariosConteos-updated', 'usuariosConteos Actualizada');
	}

	protected $listeners =['deleteRow' => 'Destroy'];

	//Método para eliminar las usuarios--conteos
	public function Destroy(Usuariosconteos $usuariosconteos)
	{   	
		$usuariosconteos->delete();
		$this->resetUI();
		$this->emit('usuariosConteos-deleted', 'usuariosConteos Eliminado');

	}

}
