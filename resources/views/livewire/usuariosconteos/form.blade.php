@include('common.modalHead')


<div class="row">

<div class="col-sm-12 col-md-4">
<div class="form-group">
	<label>Inventario</label>
	<select wire:model='id_inventario' class="form-control">
		<option value="Elegir" disabled>Elegir</option>
		@foreach($inventarios as $inventario)
		<option value="{{$inventario->id}}" >{{$inventario->folio}}</option>
		@endforeach
	</select>
	@error('id_inventario') <span class="text-danger er">{{ $message}}</span>@enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label>Usuario</label>
		<select wire:model='id_usuario' class="form-control">
			<option value="Elegir" disabled>Elegir</option>
			@foreach($users as $user)
			<option value="{{$user->id}}" >{{$user->name}}</option>
			@endforeach
		</select>
		@error('id_usuario') <span class="text-danger er">{{ $message}}</span>@enderror
</div>
</div>

<div class="col-sm-12 col-md-5">
	<div class="form-group">
		<label>Fecha Inicial</label>
		<input type="date"  wire:model.lazy="fechaInicial" class="form-control" placeholder="ej: 15/07/2023" >
		@error('fechaInicial') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

<div class="col-sm-12 col-md-5">
	<div class="form-group">
		<label>Fecha Final</label>
		<input type="date"  wire:model.lazy="fechaFinal" class="form-control" placeholder="ej: 15/07/2023" >
		@error('fechaFinal') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

</div>
@include('common.modalFooter')