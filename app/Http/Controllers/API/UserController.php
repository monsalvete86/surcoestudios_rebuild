<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
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
        // $this->authorize('isAdmin');
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::latest()->paginate(5);
        }

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
            'name' => 'required|string|max:191',            
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);
        
        return User::create([
            'name' => $request['name'],
            'apellido' => isset($request['apellido']) ? $request['apellido'] : '',
            'tipo_id' => isset($request['tipo_id']) ? $request['tipo_id'] : '',
            'documento' => isset($request['documento']) ? $request['documento'] : '',
            'lugar_expe' => isset($request['lugar_expe']) ? $request['lugar_expe'] : '',
            'email' => $request['email'],
            'type' => isset($request['type']) ? $request['type'] : '' ,
            'bio' => isset($request['bio']) ? $request['bio'] : '',
            'photo' => isset($request['photo']) ? $request['photo'] : '',
            'telefonos' => isset($request['telefonos']) ? $request['telefonos'] : '',
            'password' => Hash::make($request['password']),
        ]);
    }


    public function updateProfile(Request $request)
    {
        
        $user_aux = auth('api')->user();
        $user = User::findOrFail($user_aux->id);
       
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

       
        $currentPhoto = $user->photo;
        

        if(isset($request->photo) && $request->photo != '' && $request->photo != $currentPhoto){
            
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }
        

        if(!empty($request->password)){
           // $request->merge(['password' => Hash::make($request['password'])]);
        }
        
        $user->name = $request['name'];
        $user->apellido = isset($request['apellido']) ? $request['apellido'] : '';
        if(isset($request['tipo_id'])){
            $user->tipo_id = isset($request['tipo_id']) ? $request['tipo_id'] : '';
        }
        if(isset($request['documento']) && $request['documento']!=''){
            $user->documento = isset($request['documento']) ? $request['documento'] : '';
        }
        
        $user->email = $request['email'];
        if(isset($request['type']) && $request['type']!=''){
            $user->type = isset($request['type']) ? $request['type'] : '' ;
        }
        else {
             
        }
        $user->bio = isset($request['bio']) ? $request['bio'] : '';
        
        if(isset($request['photo'])) {
            $user->photo = isset($request['photo']) ? $request['type'] : '';
        }
        $user->telefonos = isset($request['telefonos']) ? $request['telefonos'] : '';
        if(!empty($request['password'])) {
            
            $user->password = Hash::make($request['password']);
             
        }
        return $user->password;
        $user->save();
        
        return ['message' => "Success"];
    }


    public function profile()
    {
        return auth('api')->user();
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

        $user = User::findOrFail($id);        

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

       
        $currentPhoto = $user->photo;
        

        if(isset($request->photo) && $request->photo != $currentPhoto){
            
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }
        

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
       
        $user->name = $request['name'];
        $user->apellido = isset($request['apellido']) ? $request['apellido'] : '';
        $user->tipo_id = isset($request['tipo_id']) ? $request['tipo_id'] : '';
        $user->documento = isset($request['documento']) ? $request['documento'] : '';
        $user->lugar_expe = isset($request['lugar_expe']) ? $request['lugar_expe'] : '';
        $user->email = $request['email'];
        $user->type = isset($request['type']) ? $request['type'] : '' ;
        $user->bio = isset($request['bio']) ? $request['bio'] : '';
        
        if(isset($request['photo'])) {
            $user->photo = isset($request['photo']) ? $request['photo'] : '';
        }
        $user->telefonos = isset($request['telefonos']) ? $request['telefonos'] : '';
        if(isset($request['password'])) {
            $user->password = Hash::make($request['password']);
        }
        
        $user->save();
        
        

        return ['message' => 'Updated the user info'];
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

        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return ['message' => 'User Deleted'];
    }

    public function getTutors(){
       
        $users = User::where('type','=','author')->select('id','name')->orderBy('name', 'asc')->get();
        return ['users' => $users];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                ->orWhere('documento', 'LIKE', "%$search%")
                ->orWhere('email','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(10);
        }

        return $users;

    }
}
