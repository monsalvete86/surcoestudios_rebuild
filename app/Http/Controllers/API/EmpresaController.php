<?php



namespace App\Http\Controllers\API;



use App\Empresa;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



class EmpresaController extends Controller

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

        return Empresa::latest()->paginate(5);

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

        $this->validate($request,[

            'empresa' => 'required|string|max:450'

            , 'nit' => 'required|string|max:50'

        ]);



        return Empresa::create([

            'empresa' => $request['empresa']

            , 'nit' => $request['nit'],
            'estado' => $request['estado'],

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

        $empresa = Empresa::findOrFail($id);



        $this->validate($request,[

            'empresa' => 'required|string|max:450'

            , 'nit' => 'required|string|max:50'

        ]);



        $empresa->update($request->all());

        return ['message' => 'Empresa actualizada'];

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



        $empresa = Empresa::findOrFail($id);

        

        $empresa->delete();



        return ['message' => 'Empresa eliminada'];

    }



    public function search ()

    {

        if ($search = \Request::get('q')) {

            $empresas = Empresa::where(function ($query) use ($search) {

                $query->where('empresa', 'LIKE', "%$search%")

                        ->orWhere('nit', 'LIKE', "%$search%");

            })->paginate(20);

        } else {

            $empresas = Empresa::latest()->paginate(5);

        }



        return $empresas;

    }

}

