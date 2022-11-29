@extends('layouts.appAdmin')

@section('content')
<div>
    <h2>
        Combo
    </h2>
    @if (Auth::guard('usuarios')->user()->variables(2)->crear==1)
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <ul class="nav justify-content-center  ">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('combo.create')}}">Agregar Combo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<hr>
<br>
<div class="container">
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">nombre</th>
                    <th scope="col">descuento</th>
                    <th scope="col">valor</th>
                    <th scope="col">vistas</th>
                    <th scope="col">compras</th>
                    <th scope="col">creado</th>
                    <th scope="col">actulizado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($combos as $combo)
                <tr>
                    <td>{{$combo -> id}}</td>
                    <td>{{$combo -> nombre}}</td>
                    <td>{{$combo -> descuento}}</td>
                    <td>{{$combo -> total}}</td>
                    <td>{{$combo -> vistas}}</td>
                    <td>{{$combo -> compras}}</td>
                    <td>{{substr($combo->fregistro,0,10)}}</td>
                    <td>{{substr($combo->factualizado,0,10)}}</td>
                    <td>
                        @if (Auth::guard('usuarios')->user()->variables(2)->mostrar==1)
                        <div class="list-group">
                            <button>
                                <a href="{{route('verComboAdmin',$combo->id)}}" class="list-group-item list-group-item-action">Ver</a>
                            </button>
                        </div>
                        @endif
                        @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
                        <div>
                            <form action="{{route('combo.destroy',$combo->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este combo?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                        @endif
                        @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
                        <div>
                            <button>
                                <a href="{{route('combo.edit',$combo->id)}}" class="btn btn-info">Editar</a>
                            </button>
                        </div>
                        @endif
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>


</div>


@endsection

@section('js')
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
@endsection