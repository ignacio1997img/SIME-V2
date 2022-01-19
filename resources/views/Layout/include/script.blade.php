<!-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
                  <!-- index -->
  
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
                  
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
                      <!-- fin index -->




<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>



<!-- PARA PONER NUMERICO AL LOS INPUT  -->
<!-- <input type="text" class="form-control" id="nit" name="nit" onkeypress='return validaNumericos(event)' required> -->
<script type="text/javascript">
  function validaNumericos(event) {
      if(event.charCode >= 48 && event.charCode <= 57){
        return true;
      }
      return false;        
  }
</script>


<!-- numeros decimmales con 3 de presiciones y usando STEP=""ANY" EN EL IMPUT PARA VALIDAR EL BOOSTRAP -->
<script type="text/javascript">
    const inputs = document.querySelector("#inputDecimal")
    inputs.onkeydown = (e)=>{
        const currentValue = inputs.value;
    
        const regex = /^\d{0,6}(\.\d{1,3})?$/

        setTimeout(function(){
        const newValue = inputs.value

        if(!regex.test(newValue))
          inputs.value = currentValue; 
        }, 0); 
    }
    const input = document.querySelector("#inputDecimal1")
    input.onkeydown = (e)=>{
        const currentValue = input.value;
    
        const regex = /^\d{0,6}(\.\d{1,3})?$/

        setTimeout(function(){
        const newValue = input.value

        if(!regex.test(newValue))
          input.value = currentValue; 
        }, 0); 
    }
</script>



<script type="text/javascript">

    $(function()
    {
      $('.select2').select2()
      
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })     
      $('.select2bs5').select2({
        theme: 'bootstrap4'
      }) 
      // $('.select2bs5').select2({
      //   theme: 'bootstrap4'
      // }) 
    });

    
    $(document).ready(function () {
        $("#example2").dataTable({
            //"scrollY":        "500px",
            //"scrollCollapse": true,
            //"paging":         true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]],
            
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            
        });
        $("#example3").dataTable({
            //"scrollY":        "500px",
            //"scrollCollapse": true,
            //"paging":         true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]],
            
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            
        });
        $("#example4").dataTable({
            //"scrollY":        "500px",
            //"scrollCollapse": true,
            //"paging":         true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]],
            
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            
        });
        $("#example5").dataTable({
            //"scrollY":        "500px",
            //"scrollCollapse": true,
            //"paging":         true,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]],
            
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            
        });
        
    });

    setInterval(     
                   
            function () 
            {          

            }, 3000 //en medio minuto se recargará solo la campana de notificación..
        );

    

</script>

