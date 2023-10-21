@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>CodBar</label>
            <input wire:model='codbar' wire:keyup='searchProduct' type="text" class="form-control" placeholder="Ingresa CodBar" maxlength="5">
            @if($showlist)
                <ul>
                    @if(!empty($results))
                        @foreach($results as $result)
                            <li wire:click='getProduct({{ $result->id }})'>{{ $result->codbar}}</li>
                        @endforeach
                     @endif 
                </ul>
            @endif
          </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Conteo</label>
            <input type="text" wire:model="conteo1" 
            class="form-control conteo-conteo1" placeholder="Ej. 10" autofocus>
            @error('conteo1') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    
        @if(!empty($product))

            <div class="col-sm-12 col-md-4">
                <div class="form-group">
                    <label >Clave</label>
                    <input type="text" name="cve_prod"
                    class="form-control conteo-cve_prod"  value="{{$product->cve_prod}}" disabled>
                    @error('cve_prod') <span class="text-danger er">{{ $message}}</span>@enderror
                </div>
            </div>

            <div class="col-sm-12 col-md-10">
                <div class="form-group">
                    <label >Descripcion</label>
                    <input type="text" name="desc_prod"
                    class="form-control conteo-desc_prod" value="{{$product->desc_prod}}" disabled>
                    @error('desc_prod') <span class="text-danger er">{{ $message}}</span>@enderror
                </div>
            </div>  

        @endif 
         
</div>

@include('common.modalFooter')