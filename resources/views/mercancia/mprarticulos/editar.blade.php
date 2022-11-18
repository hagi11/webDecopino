@extends('layouts.appAdmin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection

@section('content')

<div class="container-lg w-25 border p-4 mt-2 mb-2">
    <form id="formArticulo" action=" {{ route('mprarticulos.update',$articulos->id) }}"  method="POST">
        @csrf
        @method('PUT')
        <br>
        <div class="col-lg-11">
            <label for="nombre" class="form-label">NOMBRE</label><br>
            <input type="text" id="nombre" name="nombre" class="form-control form-control-sm m-2" value="{{ old('nombre',$articulos->nombre) }}">
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-11">
            <label for="descripcion" class="form-label">DESCRIPTION</label><br>
            <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm m-2" value="{{ old('descripcion',$articulos->descripcion) }}">
            @error('descripcion')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-11">
            <label for="precio" class="form-label">PRECIO</label><br>
            <input type="number" id="precio" name="precio" class="form-control form-control-sm m-2" value="{{ old('precio',$articulos->precio) }}">
            @error('precio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-11">
            <label for="existencia" class="form-label">EXISTENCIA</label><br>
            <input type="number" id="existencia" name="existencia" class="form-control form-control-sm m-2" value="{{ old('existencia',$articulos->existencia) }}">
            @error('existencia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-8">
            <label for="marca" class="form-label">MARCA</label><br>
            <select name="marca" name="marca" class="form-control form-control-sm m-2">
                <option value="">Seleccione Marca Del Producto</option>
                    @foreach ($tmarticulos as $marca)
                        @if($marca->id == $articulos->marca)
                            <option value=" {{ $marca->id }}" selected>{{ $marca->nombre }}</option>
                        @else
                            <option value=" {{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endif
                    @endforeach
            </select>
        </div>

        <div class="col-lg-11">
            <label for="tipoarticulo" class="form-label">TYPE/ARTICLE</label><br>
            <select name="tipoarticulo" name="tipoarticulo" class="form-control form-control-sm m-2">
                <option value="">Seleccione Tipo De Articulo Del Producto</option>
                @foreach ($tparticulos as $tparticulo)
                        @if($tparticulo->id == $articulos->tipoarticulo)
                            <option value=" {{ $tparticulo->id }}" selected>{{ $tparticulo->nombre }}</option>
                        @else
                            <option value=" {{ $tparticulo->id }}">{{ $tparticulo->nombre }}</option>
                        @endif
                    @endforeach
            </select>
        </div>
</form>

        <form action="{{route('mprimagenes.update',$articulos->id)}}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <input type="hidden" name="tipo" value="articulo">
        </form>

        <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Imagenes cargadas</h3>
    </div>
    <div class="panel-body">
        <table class="table table-primary" id='imagenesCargadas'>
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Quitar</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="row mb-0">
          <div class="col-md-6 offset-md-4">
            <a href=" {{route('adminArticulos')}}" class="btn btn-danger" style="text-align:right">Volver</a></td>
              <button type="submit" id="guardar" class="btn btn-primary">
                  {{ __('Guardar') }}
              </button>
          </div>
      </div>
</div>


@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

<script>
    var habilitar = 0;
    Dropzone.options.myAwesomeDropzone = {
        paramName: "imagen", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 4000, // Tamaño máximo en MB
        dictDefaultMessage: "Arrastre una imagen al recuadro para subirla",
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.jfif",
        maxFiles: 5,
        timeout: 10000,
        success: function() {
            load_images();
        },
        init: function() {
            load_images();
        },
    }

    function load_images() {
        habilitar=0;
        $.ajax({
            type: "post",
            url: "{{route('cargarImagenes')}}",
            data: {
                id:"{{$articulos->id}}",
                tipo:"articulo",
                '_token': $("meta[name='csrf-token']").attr("content")
            },

            success: function(res) {
                $("#imagenesCargadas tbody").remove();
                $("#imagenesCargadas").append("<tbody></tbody>");
                for (var i = 0; i < res.length; i++) {
                    habilitar = 1;
                    var code = "<tr id='img" + res[i]['id'] + "'><td>" + res[i]['id'] + "</td> <td>" + res[i]['ruta'] + "</td><td> <img src='{{asset('aqui')}}'/></td><td><button  value='" + res[i]['id'] + "' class='btn btn-outline-danger' onclick='eliminarDelImg(" + res[i]['id'] + ")'>Quitar</button> </td> </tr>";
                    code = code.replace('aqui', res[i]['ruta']);
                    $("#imagenesCargadas tbody").append(code);
                }
            }
        });
    }

    function eliminarDelImg(eliminarId) {
        let url = "{{route('mprimagenes.destroy',1)}}";
        url = url.replace('1', eliminarId);
        $.ajax({
            type: "DELETE",
            url: url,
            data: {
                '_token': $("meta[name='csrf-token']").attr("content")
            },
            success: function(res) {
                load_images();
            }

        });
    }

    $('#guardar').click(function(){
        if(habilitar==1){
            console.log('actulizar imagenes');
            document.getElementById('formArticulo').submit();
        }else {
            alert("No a seleccionado ninguna imagen");
        }
    });
</script>
@endsection
