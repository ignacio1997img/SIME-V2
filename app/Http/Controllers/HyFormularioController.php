<?php

namespace App\Http\Controllers;

use App\HyFormulario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HyFormularioController extends Controller
{
   
    protected function index()
    {
        $forms = HyFormulario::all();
        return view('Hyso.Formularios.indexFormulario', compact('forms'));
    }

    public function mguardar(Request $request){

        if($request->hasFile("urlpdf")){
            $file=$request->file("urlpdf");
            
            $nombre = "hyso_".time().".".$file->guessExtension();
                
            $ruta = storage_path("files/pdf/hyso/".$nombre);

            if($file->guessExtension()=="pdf"){
                copy($file, $ruta);
            }else{
                dd("NO ES UN PDF");
            }
        }
        $producto = request()->except('_token');

        $producto['urlpdf'] = 'hyso/'.$nombre;


        HyFormulario::insert($producto);
        toastr()->success('Ha sido registrado con exito' , 'Información' , ["closeButton" => "true","progressBar" => "true" ]);
        return redirect()->route('formulario.index');

    }

    public function urlfile($id){
        // return $id;
        // $file = HyFormulario::where('id',$id)->first();
        $file = HyFormulario::Pdf($id);
        return response()->json(['response' => [
            'urlpdf' => $file->urlpdf,
            'nombre' => $file->nombre,
            ]
        ], 201);
    }

    public function view_ingresoformularios($id)
    {
        
        $formu=HyFormulario::find($id);

       return view('Hyso.Formularios.indexIngresoFormulario', compact('formu'));
    }
   
}
