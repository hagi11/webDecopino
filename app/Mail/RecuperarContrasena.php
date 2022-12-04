<?php

namespace App\Mail;

use App\Models\clientes\MclCliente;
use App\Models\usuarios\MusUsuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RecuperarContrasena extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Recuperar Contrase«Ða";

    public $correo = "";

    public $tipo = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $tipo)
    {
        $this->correo = $correo;

        $this->tipo = $tipo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->tipo == "cliente") {
            $datos = MclCliente::all()->where('estado',1)
            ->where('login', $this->correo)->first();
        }else {
            $datos = MusUsuario::all()->where('estado',1)
            ->where('login', $this->correo)->first();
        }
        $password = Str::random(8);
        $passwordHash = Hash::make($password);
        $datos->contrasenia = $passwordHash;
        $datos->save();
        return $this->view('auth.recuperar', compact('datos', 'password'));
    }
}
