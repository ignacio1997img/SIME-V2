
<footer class="main-footer text-sm">
    <small>Copyright &copy; Sistemas EMAUT - 2021</small>
    Derechos Reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0
    </div>
  </footer>


<script>
    $(document).ready(function () {
        setInterval(     
            function () 
            {       
              $.get('{{route('activar_ajax_cargo')}}', function(data){});                
            }, 3000
        );   
        setInterval(     
          function () 
          {       
            $.get('{{route('desactivar_ajax_designacion')}}', function(data){});                
          }, 3000
        ); 
        //para activar los retrazos   "GESTION DE RECLAMO"
        setInterval(     
          function () 
          {       
            $.get('{{route('reclamo-activar.retrazo')}}', function(data){});                
          }, 3000
        ); 
    });
</script>

