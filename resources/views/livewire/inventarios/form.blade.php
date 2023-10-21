@include('common.modalHead')


<div class="row">

<div class="col-sm-12 col-md-4">
<div class="form-group">
	<label>Zona</label>
	<select wire:model='id_zona' class="form-control">
		<option value="Elegir" disabled>Elegir</option>
		@foreach($zonas as $zona)
		<option value="{{$zona->id}}" >{{$zona->descripcion}}</option>
		@endforeach
	</select>
	@error('id_zona') <span class="text-danger er">{{ $message}}</span>@enderror
</div>
</div>

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Folio</label>
		<input type="text"  wire:model.lazy="folio" class="form-control" placeholder="ej: 13072023" >
		@error('folio') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Estatus</label>
		
		<select wire:model.lazy="status" class="form-control">
			<option value="Elegir" selected>Elegir</option>
			<option value="Active" selected>Activo</option>
			<option value="Locked" selected>Bloqueado</option>
		</select>
		
		@error('status') <span class="text-danger er">{{ $message}}</span>@enderror
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

<div class="col-sm-12">
	<div class="form-group">
		<label >Observaciones</label>
		<textarea class="form-control" wire:model.lazy="observaciones" cols="10" rows="4" ></textarea>
		@error('observaciones') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>


</div>
@include('common.modalFooter')