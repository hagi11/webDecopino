@extends('layouts.appAdmin')

@section('content')

    <h2 class="text-center mt-4 mb-3">Creacion de pedidos</h2>
    <hr>
    <a href=" {{ url('mprpedido') }}" class="btn btn-info float-end btn-sm">Volver</a>


    <form action="{{ route('pedidos.update', $estado->id) }}" method="POST">

    @csrf
    @method('PUT')
    
    <div class="row mb-3">
        <label for="estadoenvio" class="col-md-4 col-form-label text-md-end">{{ __('Seleccione estado envio') }}</label>

        <div class="col-md-6">
            <select name="estadoenvio" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">    
  
                
                    <option value="0"> creado</option>
                    <option value="1"> enviado</option>
                    <option value="2"> entregado</option>
                    <option value="3"> cancelado</option>
                
            </select>
        </div>
      </div>

    <div class = "col-lg-4">
       
        <input type = "hidden" name = "fregistro" class = "form-control form-control-sm m-2" value = "1">
    </div>
    {{-- <!-- <div class = "col-lg-4">
        <label for = "factualizado" class = "form-label">Factualizado</label>
        <input type = "data" name = "factualizado" class = "form-control form-control-sm m-2" value = "{{ old('factualizado') }}">
    </div> --> --}}


    <div class = "col-lg-4">
        
        <input type = "submit" name = "" class = "btn btn-success btn-sm m-2">
        <a href = "{{ url('mprpedido') }}" class = "btn btn-secondary btn-sm m-2">Cancelar</a>

    </div>
</form>

@stop