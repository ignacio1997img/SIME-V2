            
            <div id="entrada" class="container tab-pane active"><br>
                <div class="card table-responsive card-info">
                    <div class="card-header text-center">
                        <h4 class="card-title">
                            <b>BANDEJA DE ENTRADA</b>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="example">
                            <thead>
                                <tr>
                                    <th class="text-center">FECHA</th>
                                    <th class="text-center">DOCUMENTO</th>
                                    <th class="text-center">CITE</th>
                                    <th class="text-center">REMITENTE:</th>
                                    <th class="text-center">REFERENCIA</th>     
                                    <th></th>                        
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrantes as $entrantes)
                                    <tr style="text-transform:uppercase;">
                                        <td><font size=2>{{\Carbon\Carbon::parse($entrantes->fechahraenvio)->format('d/m/Y H:i:s')}}</font></td>
                                        @if($entrantes->interna == 1)
                                            <td><font size=2> INTERNA</font></td>
                                        @else
                                            <td><font size=2> EXTERNA</font></td>
                                        @endif
                                        <td><font size=2> {{ $entrantes->sigla}}</font></td>
                                        <td><font size=2> {{ $entrantes->de}}</font></td>
                                        <td><font size=2> {{ $entrantes->referencia}}</font></td>    
                                        <td class="text-center" width="5px">
                                            <a class="btn btn-warning btn-sm" data-toggle="tooltip" href="{{route('doc-tramite.derivar.proceso',$entrantes->idm)}}" title="Recibir">
                                                <i class="fas fa-envelope-open-text"></i>
                                            </a>
                                        </td>                                    
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>