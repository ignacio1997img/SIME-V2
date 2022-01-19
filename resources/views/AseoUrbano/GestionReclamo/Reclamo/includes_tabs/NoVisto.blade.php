            
            <div id="novisto" class="container tab-pane active"><br>
                <div class="card table-responsive card-info">
                    <div class="card-header text-center">
                        <h4 class="card-title">
                            <i class="fas fa-eye-slash"></i> <b>NO VISTO</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="example2">
                            <thead>
                                <tr>
                                    <th class="text-center"><font size=2>NRO</th>
                                    <th class="text-center"><font size=2>FECHA HORA</th>
                                    <th class="text-center"><font size=2>CONTACTO</th>
                                    <th class="text-center"><font size=2>DIRECCION:</th>  
                                    @can('au-reclamosreiteracion.store')  
                                        <th></th> 
                                    @endcan
                                    @can('au-gestionreclamo.reclamo.atenderreclamo.view')          
                                        <th></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendiente as $item)
                                    <tr style="text-transform:uppercase;">
                                        <td ><font size=2>{{$item->numero}}</td>
                                        <td ><font size=2>{{$item->fechareclamo}}</td>
                                        <td ><font size=2>{{$item->nombrecompleto}}</td>
                                        <td ><font size=2>{{$item->descripcion}}</td>
                                        @can('au-reclamosreiteracion.store')  
                                            <td class="text-center" width="5px">
                                                <a class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalReiteracion" data-reclamo="{{$item->id}}"  href=""><i class="fas fa-phone-volume"></i></a>
                                            </td>
                                        @endcan
                                        @can('au-gestionreclamo.reclamo.atenderreclamo.view')
                                            <td class="text-center" width="5px">
                                                <a class="btn btn-outline-success btn-sm" data-toggle="tooltip" href="{{route('au-gestionreclamo.reclamo.atenderreclamo.view',$item->id)}}" title="Atender Reclamo">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </a>
                                            </td>
                                        @endcan
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>