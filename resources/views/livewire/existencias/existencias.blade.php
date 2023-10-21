<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    @can('Existencias_Create')
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-primary" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                    @endcan
                </ul>
            </div>
            @can('Existencias_Search')
            @include('common.searchbox')
            @endcan

            <div class="widget-content">


                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #000000">
                            <tr>

                                <th class="table-th text-white">LUGAR</th>
                                <th class="table-th text-white">CLAVE PRODUCTO</th>
                                <th class="table-th text-white">EXISTENCIAS</th>
                                <th class="table-th text-white">COSTO</th>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white">CLASE</th>
                                <th class="table-th text-white">CLAVE ROTACION</th>
                                <th class="table-th text-white">CODBAR</th>
                                <th class="table-th text-white">MEDIDA BASE</th>
                                <th class="table-th text-white">DESCRIPCION LUGAR</th>
                                <th class="table-th text-white">ROTACION</th>
                                <th class="table-th text-white">FECHA</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($existencias as $existencia)
                            <tr>
                                <td>
                                    <h7>{{$existencia->lugar}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->cve_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->existencia}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->costo}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->desc_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->cse_prod}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->cve_tial}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->codbar}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->uni_med}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->des_lug}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->des_tial}}</h7>
                                </td>
                                <td>
                                    <h7>{{$existencia->created_at}}</h7>
                                </td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$existencias->links()}}
                </div>

            </div>


        </div>


    </div>

    @include('livewire.existencias.form')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('Existencias-added', msg => {
            $('#theModal').modal('hide')
        });
        window.livewire.on('Existencias-updated', msg => {
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