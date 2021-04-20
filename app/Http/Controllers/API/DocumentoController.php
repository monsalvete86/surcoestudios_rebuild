<?php

namespace App\Http\Controllers\API;

use App\Documento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
        return Documento::latest()->paginate(5);
        //}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($request,[
            //'nombre' => 'required|max:450'
            //, 'ruta' => 'required'
        //]);
        
        $extencion =  '.' .explode('/', explode(':', substr($request->ruta, 0, strpos($request->ruta, ';')))[1])[1];
        //print_r($name);
        //print_r($request->ruta);        
        $aux_file = explode("base64,",$request->ruta);
        //print_r($aux_file[0]);
        $base = base64_decode($aux_file[1]);
        $fileName = uniqid().$extencion;
        file_put_contents('documentos/'.$fileName, $base);
        
       
            //print_r($name); exit;
        //\Image::make($request['ruta'])->save(public_path('documentos/').$name);
           // print_r($request['img']); exit; die;
        $request['ruta'] = $fileName;
        //}        
       // $contents = file_get_contents($request->ruta->path());
            
    // ...or just move it somewhere else (eg: local `storage` directory or S3)
           // $newPath = $request->ruta->store('/documentos', 's3');

        

      
        return Documento::create([
            'nombre' => $request['nombre']
            , 'ruta' => $request['ruta']
            , 'id_modulo' => $request['id_modulo']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);

        $this->validate($request,[
            'nombre' => 'required|max:450'
            , 'ruta' => 'required|max:450'
        ]);

        $documento->update($request->all());
        return ['message' => 'Documento actualizado'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        $documento = Documento::findOrFail($id);
        
        $documento->delete();

        /*
        $userPhoto = public_path('documentos/').$currentPhoto;
        if(file_exists($userPhoto)){
            @unlink($userPhoto);
        }*/
        return ['message' => 'Documento eliminado'];
    }

    public function search ()
    {
        if ($search = \Request::get('q')) {
            $documentos = Documento::where(function ($query) use ($search) {
                $query->where('documento', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $documentos = Documento::latest()->paginate(5);
        }

        return $documentos;
    }

    public function getDocumentos ($id)
    {
        
        $documentos = Documento::where(function ($query) use ($id) {
            $query->where('id_modulo', 'LIKE', "%$id%");
        })->paginate(80);
       

        return $documentos;
    }
}
