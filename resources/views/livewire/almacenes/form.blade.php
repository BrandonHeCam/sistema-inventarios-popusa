@include('common.modalHead')

<div class="row">
	

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Clave</label>
		<input type="text" wire:model.lazy="clave" 
		class="form-control almacenes-clave" placeholder="Ej. 100" autofocus >
		@error('almacenes') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

<div class="col-sm-12 col-md-12">
	<div class="form-group">
		<label >Descripcion</label>
		<input type="text" wire:model.lazy="descripcion" 
		class="form-control almacenes-descripcion" placeholder="Ej. 23PTE" autofocus >
		@error('descripcion') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>


</div>
@include('common.modalFooter')