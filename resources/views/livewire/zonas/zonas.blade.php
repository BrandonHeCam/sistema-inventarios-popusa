<div class="row sales layout-top-spacing">
	
	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">		
					@can('Zonas_Create')	
					<li>
						<a href="javascript:void(0)" class="tabmenu bg-primary" data-toggle="modal" data-target="#theModal" 
						>Agregar</a>
					</li>	
					@endcan
				</ul>
			</div>
			@can('Zonas_Search')	
			@include('common.searchbox')
			@endcan
			
			<div class="widget-content">		
				

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #000000">
							<tr>
								<th class="table-th text-white">ALMACEN</th>
								<th class="table-th text-white">CLAVE DE LA ZONA</th>
								<th class="table-th text-white">DESCRIPCION</th>
								<th class="table-th text-white text-center">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $zonas)
							<tr>
								<td><h6>{{$zonas->almacen}}</h6></td>
								<td><h6>{{$zonas->clave}}</h6></td>
								<td><h6>{{$zonas->descripcion}}</h6></td>

								<td class="text-center">
									@can('Zonas_Update')	
									<a href="javascript:void(0)" 
									wire:click="Edit({{$zonas->id}})"
									class="btn btn-warning mtmobile" title="Edit">
									<i class="fas fa-edit"></i>
								</a>
								@endcan
								
							@can('Zonas_Destroy')	
								<a href="javascript:void(0)"
								onclick="Confirm('{{$zonas->id}}')" 
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

@include('livewire.zonas.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('Zona-added', msg =>{
			$('#theModal').modal('hide')
		});
		window.livewire.on('Zona-updated', msg =>{
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