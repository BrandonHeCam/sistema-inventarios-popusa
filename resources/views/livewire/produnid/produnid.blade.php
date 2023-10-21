<div class="row sales layout-top-spacing">
	
	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">		
					@can('Presentaciones_Create')	
					<li>
						<a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal" 
						>Agregar</a>
					</li>	
					@endcan
				</ul>
			</div>
			@can('Presentaciones_Search')	
			@include('common.searchbox')
			@endcan
			
			<div class="widget-content">		
				

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #3B3F5C">
							<tr>
								<th class="table-th text-white">CLAVE PRODUCTO</th>
								<th class="table-th text-white">UNIDAD</th>
								<th class="table-th text-white">FACTOR</th>
								<th class="table-th text-white">UNIDAD AUX</th>
								<th class="table-th text-white">CODBAR</th>
								<th class="table-th text-white">FECHA</th>
								
							</tr>
						</thead>
						<tbody>
						@foreach($produnids as $produnid)	
							<tr>
							<td><h7>{{$produnid->cve_prod}}</h7></td>
							<td><h7>{{$produnid->unidad}}</h7></td>
							<td><h7>{{$produnid->factor}}</h7></td>
							<td><h7>{{$produnid->conver}}</h7></td>							
							<td><h7>{{$produnid->codbar}}</h7></td>
							<td><h7>{{$produnid->created_at}}</h7></td>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$produnids->links()}}
		</div>

	</div>


</div>


</div>

@include('livewire.produnid.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('Producto-added', msg =>{
			$('#theModal').modal('hide')
		});
		window.livewire.on('Producto-updated', msg =>{
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