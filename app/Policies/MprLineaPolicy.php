<?php

namespace App\Policies;

use App\Models\MprLinea;
use App\Models\clientes\MclCliente;
use Illuminate\Auth\Access\HandlesAuthorization;

class MprLineaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(MclCliente $mclCliente)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @param  \App\Models\MprLinea  $mprLinea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(MclCliente $mclCliente, MprLinea $mprLinea)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(MclCliente $mclCliente)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @param  \App\Models\MprLinea  $mprLinea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(MclCliente $mclCliente, MprLinea $mprLinea)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @param  \App\Models\MprLinea  $mprLinea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(MclCliente $mclCliente, MprLinea $mprLinea)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @param  \App\Models\MprLinea  $mprLinea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(MclCliente $mclCliente, MprLinea $mprLinea)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @param  \App\Models\MprLinea  $mprLinea
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(MclCliente $mclCliente, MprLinea $mprLinea)
    {
        //
    }
}
