@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{$combo->nombre}} ${{$combo->total}}</h2>
<table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">valor</th>
                    <th scope="col">cantidad</th>
                    <th scope="col">producto</th>
                    <th scope="col">articulo</th>
                </tr>
            </thead>
           
            <tbody>
            @foreach ($comPros as $comPro)
                <tr>
                    <td>{{$comPro -> id}}</td>
                    <td>${{$comPro -> valor}}</td>
                    <td>{{$comPro -> cantidad}}</td>
                    @if ($comPro->producto != '')
                    <td>{{$comPro -> producto}}</td>
                    <td>Null</td>
                    @else
                    <td>Null</td>
                    <td>{{$comPro -> articulo}}</td>
                    @endif

                </tr>
                @endforeach
<tr>
    <td colspan="3">

    </td>
    <td colspan="1">
        <a href="{{route('combo.index')}}" class="btn btn-primary">volver</a>
    </td>
    <td colspan="1">
        <a href="{{route('combo.edit',$combo->id)}}" class="btn btn-info">editar</a>
    </td>
</tr>
               </tbody>
        </table>

</div>

@endsection