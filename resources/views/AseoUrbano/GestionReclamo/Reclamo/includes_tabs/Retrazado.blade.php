            
            <div id="retrazado" class="container tab-pane"><br>
                <div class="card table-responsive card-info">
                    <div class="card-header text-center">
                        <h4 class="card-title">
                            <i class="fas fa-stopwatch"></i> <b>RETRAZADO</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="example3">
                            <thead>
                                <tr>
                                    <th class="text-center"><font size=2>NRO</th>
                                    <th class="text-center"><font size=2>FECHA HORA </th>
                                    <th class="text-center"><font size=2>CONTACTO</th>
                                    <th class="text-center"><font size=2>DESCRIPCION</th>
                                    <th class="text-center"><font size=2>REITERADO</th>    
                                    @can('au-reclamosreiteracion.store')  
                                        <th></th> 
                                    @endcan
                                    @can('au-gestionreclamo.reclamo.atenderreclamo.view')          
                                        <th></th>
                                    @endcan    
                                    @can('au-gestionreclamo.reclamo.retrazado.detalle.printf')          
                                        <th></th>
                                    @endcan                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retrazados as $item)
                                    <tr style="text-transform:uppercase;">
                                        <td ><font size=2>{{$item->numero}}</td>
                                        <td ><font size=2>{{$item->fechareclamo}}</td>
                                        <td ><font size=2>{{ App\AuContacto::find($item->contacto_id)->nombrecompleto }}</td>
                                        <td ><font size=2>{{$item->descripcion}}</td>
                                        <td ><font size=2>{{ App\AuReclamoReiteracion::where('reclamo_id', $item->id)->count() }}</td>
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
                                        @can('au-gestionreclamo.reclamo.retrazado.detalle.printf') 
                                        <td class="text-center" width="5px">
                                            <a class="btn btn-warning btn-sm" data-toggle="tooltip" href="{{route('au-gestionreclamo.reclamo.retrazado.detalle.printf',$item->id)}}" title="Detalles del Reclamo">
                                                <i class="fas fa-list-alt">
                                                </i>
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