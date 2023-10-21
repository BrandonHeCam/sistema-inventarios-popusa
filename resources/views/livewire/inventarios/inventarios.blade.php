<div class="row sales layout-top-spacing">
	
	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">		
					@can('Inventarios_Create')	
					<li>
						<a href="javascript:void(0)" class="tabmenu bg-primary" data-toggle="modal" data-target="#theModal" 
						>Agregar</a>
					</li>	
					@endcan
				</ul>
			</div>
			@can('Inventarios_Search')	
			@include('common.searchbox')
			@endcan
			
			<div class="widget-content">		
				

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #000000">
							<tr>
								<th class="table-th text-white">ZONA</th>
								<th class="table-th text-white">FOLIO</th>
								<th class="table-th text-white">STATUS</th>
								<th class="table-th text-white">FECHA INICIAL</th>
								<th class="table-th text-white">FECHA FINAL</th>
								<th class="table-th text-white">OBSERVACIONES</th>
								<th class="table-th text-white text-center">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $inventario)
							<tr>
								<td><h6>{{$inventario->zona}}</h6></td>
								<td><h6>{{$inventario->folio}}</h6></td>
								<td class="text-left"><span class="badge {{ $inventario->status == 'ACTIVE' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{$inventario->status}}</span></td>
								<td><h6>{{$inventario->fechaInicial}}</h6></td>
								<td><h6>{{$inventario->fechaFinal}}</h6></td>
								<td><h6>{{$inventario->observaciones}}</h6></td>
								

								<td class="text-center">
								@can('Inventarios_Update')	
									<a href="javascript:void(0)" 
									wire:click="Edit({{$inventario->id}})"
									class="btn btn-warning mtmobile" title="Edit">
									<i class="fas fa-edit"></i>
								</a>
								@endcan
								

							@can('Inventarios_Destroy')	
								<a href="javascript:void(0)"
								onclick="Confirm('{{$inventario->id}}')" 
								class="btn btn-danger" title="Delete">
								<i class="fas fa-trash"></i>
							</a>
							@endcan

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$data->links()}}
		</div>

	</div>


</div>


</div>

@include('livewire.inventarios.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('Inventario-added', msg =>{
			$('#theModal').modal('hide')
		});
		window.livewire.on('Inventario-updated', msg =>{
			$('#theModal').modal('hide')
		});
	});



	function Confirm(id)
	{	

		swal({
			title: 'CONFIRMAR',
			text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cerrar',
			cancelButtonColor: '#fff',
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar'
		}).then(function(result) {
			if(result.value){
				window.livewire.emit('deleteRow', id)
				swal.close()
			}

		})
	}


</script>