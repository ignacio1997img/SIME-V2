            
            <div id="realizado" class="container tab-pane"><br>
                <div class="card table-responsive card-info">
                    <div class="card-header text-center">
                        <h4 class="card-title">
                            <i class="fas fa-sync-alt"></i> <b>REALIZADO</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="example5">
                            <thead>
                                <tr>
                                    <th class="text-center"><font size=2>NRO</th>
                                    <th class="text-center"><font size=2>FECHA RECLAMO</th>
                                    <th class="text-center"><font size=2>RECLAMO</th>
                                    <th class="text-center"><font size=2>FECHA SOLUCION</th>
                                    <th class="text-center"><font size=2>SOLUCION</th>
                                    @can('au-gestionreclamo.reclamo.realizado.printf')
                                    <th></th>
                                    @endcan               
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($realizados as $item)
                                    <tr style="text-transform:uppercase;">
                                        <td class="text-center"><font size=2>{{$item->numero}}</td>
                                        <td ><font size=2>{{$item->fechareclamo}}</td>
                                        <td ><font size=2>{{$item->descripcion}}</td>
                                        <td ><font size=2>{{$item->fechaatendido}}</td>
                                        <td ><font size=2>{{$item->solucion}}</td>
                                        @can('au-gestionreclamo.reclamo.realizado.printf')
                                        <td class="text-center" width="5px">
                                            <a class="btn btn-outline-primary btn-sm" data-toggle="tooltip" href="{{route('au-gestionreclamo.reclamo.realizado.printf',$item->id)}}" title="Atender Reclamo">
                                                <i class="fas fa-print"></i>
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