            
            <div id="pendiente" class="container tab-pane"><br>
                <div class="card table-responsive card-info">
                    <div class="card-header text-center">
                        <h4 class="card-title">
                            <i class="fas fa-business-time"></i> <b>PENDIENTE</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="example4">
                            <thead>
                                <tr>
                                    <th class="text-center"><font size=2>NRO</th>
                                    <th class="text-center"><font size=2>FECHA HORA </th>
                                    <th class="text-center"><font size=2>CONTACTO</th>
                                    <th class="text-center"><font size=2>DESCRIPCION</th>
                                    <th class="text-center"><font size=2>ESTADO</th>
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
                                @foreach ($pendientesi as $item)
                                    <tr style="text-transform:uppercase;">
                                        <td ><font size=2>{{$item->numero}}</td>
                                        <td ><font size=2>{{$item->fechareclamo}}</td>
                                        <td ><font size=2>{{ App\AuContacto::find($item->contacto_id)->nombrecompleto }}</td>
                                        <td ><font size=2>{{$item->descripcion}}</td>
                                            <td class="text-center">
                                                @if($item->estado == 2)
                                                    <span class="badge badge-danger">RETRAZADO {{ App\AuReclamoReiteracion::where('reclamo_id', $item->id)->count() }}</span>
                                                @else
                                                    <span class="badge badge-warning">PENDIENTE</span>
                                                @endif
                                            </td>

                                            
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
                                        @if($item->estado== 2)      
                                        @can('au-gestionreclamo.reclamo.retrazado.detalle.printf') 
                                        <td class="text-center" width="5px">
                                            <a class="btn btn-warning btn-sm" data-toggle="tooltip" href="{{route('au-gestionreclamo.reclamo.retrazado.detalle.printf',$item->id)}}" title="Detalles del Reclamo">
                                                <i class="fas fa-list-alt">
                                                </i>
                                            </a>
                                        </td>
                                        @endcan
                                        @endif
                                    </tr>                                    
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>