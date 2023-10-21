@include('common.modalHead')

<div class="row">
	
<div class="col-sm-12 col-md-4">
<div class="form-group">
	<label>Almacen</label>
	<select wire:model='id_almacen' class="form-control">
		<option value="Elegir" disabled>Elegir</option>
		@foreach($almacenes as $almacen)
		<option value="{{$almacen->id}}" >{{$almacen->descripcion}}</option>
		@endforeach
	</select>
	@error('id_almacen') <span class="text-danger er">{{ $message}}</span>@enderror
</div>
</div>	

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Clave</label>
		<input type="text" wire:model.lazy="clave" 
		class="form-control zona-clave" placeholder="Ej. 100" autofocus >
		@error('zonas') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

<div class="col-sm-12 col-md-12">
	<div class="form-group">
		<label >Descripcion</label>
		<input type="text" wire:model.lazy="descripcion" 
		class="form-control zonas-descripcion" placeholder="Ej. Tapanco" autofocus >
		@error('zonas') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>


</div>
@include('common.modalFooter')