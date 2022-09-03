<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\locaciones\Departamento;
use App\Models\locaciones\MadCiudad;
use App\Models\administracion\MadPersona;
use App\Models\administracion\MadSesion;
use App\Models\administracion\MadTiParametro;
use App\Models\administracion\MadParametro;
use App\Models\clientes\MclCliente;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

   
    use RegistersUsers;

    public function showRegistrationForm()
    {
       $departamentos = Departamento::all();
       $ciudades = MadCiudad::where('departamento',76)->get();
       $identificaciones = MadParametro::where('tiparametro',1)->get();

    //    select('usuarios.id', 'usuarios.name as user_name', 'usuarios.email', 'r.name as rol_name')
    //    ->join('model_has_roles as mr', 'mr.model_id', 'usuarios.id')
    //    ->join('roles as r','mr.role_id', 'r.id')
    //    ->where('usuarios.id', $id );

        return view('auth.register', compact('departamentos','ciudades','identificaciones'));

    }



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:madpersonas'],
            'contrasenia' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $personas = new MadPersona();

        $personas->tidentificacion = $data['tidentificacion'];
        
        $personas->identificacion = $data['identificacion'];
        $personas->nombre = $data['nombre'];
        $personas->apellido = $data['apellido'];
        $personas->correo = $data['correo'];
        $personas->telefono = $data['telefono'];
        $personas->direccion = $data['direccion'];
        $personas->estado = '1';
        $personas->ciudad = $data['ciudad'];

        $personas->save();

        // $clientes = new MclCliente();

        // $clientes->login = $data['correo'];
        // $clientes->contrasenia = $data['contrasenia'];
        // $clientes->estado = '1';
        // $clientes->persona = $personas->id;

        // $clientes->save();



        return MclCliente::create([
            'login' => $data['correo'],
            'contrasenia' => Hash::make($data['contrasenia']),
            'persona' => $personas->id,
            'estado' => '1',
        ]);
    }
}
