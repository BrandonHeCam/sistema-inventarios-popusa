@include('common.modalHead')

<div class="row">
	

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >File</label>
		<input type="file" wire:model.lazy="file" 
		class="form-control existencias-file"  autofocus >
		@error('file') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>

</div>

@include('common.modalFooter')
