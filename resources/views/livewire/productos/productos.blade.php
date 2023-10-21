<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Productos_Create')
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-primary" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                    @endcan

                </ul>
            </div>
            @can('Productos_Search')
            @include('common.searchbox')
            @endcan

            <div class="widget-content">


                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #000000">
                            <tr>

                                <th class="table-th text-white">DIVISION</th>
                                <th class="table-th text-white">CLAVE PRODUCTO</th>
                                <th class="table-th text-white">CLASE</th>
                                <th class="table-th text-white">SUBCLASE</th>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white">UNIDAD BASE</th>
                                <th class="table-th text-white">ROTACION</th>
                                <th class="table-th text-white">COSTO PROMEDIO</th>
                                <th class="table-th text-white">CODBAR</th>
                                <th class="table-th text-white">FACTOR</th>
                                <th class="table-th text-white">UNIDAD AUX</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                            <tr>
                                <td>
                                    <h7>{{$producto->cse_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->cve_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->sub_cse}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->sub_subcse}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->desc_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->uni_med}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->cve_tial}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->costo_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->codbar}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->factor}}</h7>
                                </td>
                                <td>
                                    <h7>{{$producto->conver}}</h7>
                                </td>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$productos->links()}}
                </div>

            </div>


        </div>


    </div>

    @include('livewire.productos.form')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('Producto-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('Producto-updated', msg => {
            $('#theModal').modal('hide')
        });


    });



    function Confirm(id) {

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
            if (result.value) {
                window.livewire.emit('deleteRow', id)
                swal.close()
            }

        })
    }
</script>