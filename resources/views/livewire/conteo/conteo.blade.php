<div class="row sales layout-top-spacing">
	
	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">		
					@can('Conteo_Create')	
					<li>
						<a href="javascript:void(0)" class="tabmenu bg-primary" data-toggle="modal" data-target="#theModal" 
						>Agregar</a>
					</li>	
					@endcan
				</ul>
			</div>
			@can('Conteo_Search')	
			@include('common.searchbox')
			@endcan
			
			<div class="widget-content">		
				

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #000000">
							<tr>
								<th class="table-th text-white">CODBAR</th>
								<th class="table-th text-white">CLAVE PRODUCTO</th>
								<th class="table-th text-white">CANTIDAD1</th>
								<th class="table-th text-white">CANTIDAD2</th>
								<th class="table-th text-white">FECHA</th>
								<th class="table-th text-white text-center">ACCIONES</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $conteo)	
							<tr>
							<td><h7>{{$conteo->codbar}}</h7></td>
							<td><h7>{{$conteo->cve_prod}}</h7></td>
							<td><h7>{{$conteo->conteo1}}</h7></td>
							<td><h7>{{$conteo->conteo2}}</h7></td>
							<td><h7>{{$conteo->created_at}}</h7></td>
							
								<td class="text-center">
								@can('Conteo_Update')
									<a href="javascript:void(0)" 
									wire:click="Edit({{$conteo->id}})"
									class="btn btn-warning mtmobile" title="Edit">
									<i class="fas fa-edit"></i></a>								
								@endcan
								

								@can('Conteo_Destroy')	
								<a href="javascript:void(0)"
								onclick="Confirm('{{$conteo->id}}')" 
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

@include('livewire.conteo.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('Conteo-added', msg =>{
			$('#theModal').modal('hide')
		});
		window.livewire.on('Conteo-updated', msg =>{
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