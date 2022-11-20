@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <h2 class="text-center mt-5 mb-5">Banners</h2>
    @if(session('type'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        <strong>Mensaje: </strong>{{session('message')}}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table table-stripped table-hover table-bordered mt-5">
        <thead>
            <th>ID</th>
            <th>IMAGEN</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>FREGISTRO</th>
            <th>FACTUALIZADO</th>
            <th>EDITAR</th>
            <th>Mostrar</th>

        </thead>
        <tbody>
            @foreach($banners as $banner)
            <tr>
                <td> {{$banner->id}} </td>

                <td><img src="{{asset($banner->ruta)}}" style="width: 100px;"></td>
                <td> {{$banner->nombre}} </td>
                <td> {{$banner->descripcion}} </td>



                <td>
                    @foreach($lista as $list)
                    @if ($list['id']== $banner->id)
                    @if ($list['tipo']=='combo')
                    combo
                    @else
                    producto
                    @endif
                    @endif
                    @endforeach
                </td>

                <td>
                    @foreach($lista as $list)
                    @if ($list['id']== $banner->id)

                    {{$list['nombre']}}
                    @else

                    @endif

                    @endforeach
                </td>







                <td>{{substr($banner->fregistro,0,10)}} </td>
                <td>{{substr($banner->factualizado,0,10)}}</td>




                <td>
                    <a href="{{ route ('mprbanners.edit',$banner->id) }}" class="btn btn-success">

                        <img src="{{url('img/icons/edit.png')}}" width="30">
                    </a>

                </td>

                <td>

                    <form action="{{ route ('mprbanners.destroy',$banner->id)}}" method="POST">
                        @csrf
                        @method('DELETE')


                        <button class="btn btn-danger" style="padding-left: 12px;" >
                            @if ($banner->estado == 1)
                                <img src="{{url('img/icons/si.png')}}"  width="30">
                            @else
                                <img src="{{url('img/icons/no.png')}}" width="30">
                            @endif
                        </button>


                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @stop()