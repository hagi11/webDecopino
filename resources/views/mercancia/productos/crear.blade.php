@extends('layouts.appAdmin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection

@section('content')


<div class="card-body">
    <form method="POST" id="formProducto" action="{{ route('productos.store') }}">
        @csrf
        <div class="row mb-3">
            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del producto') }}</label>

            <div class="col-md-6">
                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="precio" class="col-md-4 col-form-label text-md-end">{{ __('precio') }}</label>

            <div class="col-md-6">
                <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                @error('precio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="iva" class="col-md-4 col-form-label text-md-end">{{ __('iva') }}</label>

            <div class="col-md-6">
                <input id="iva" type="text" class="form-control @error('iva') is-invalid @enderror" name="iva" value="{{ old('iva') }}" required autocomplete="iva" autofocus>

                @error('iva')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="descuento" class="col-md-4 col-form-label text-md-end">{{ __('descuento') }}</label>

            <div class="col-md-6">
                <input id="descuento" type="text" class="form-control @error('descuento') is-invalid @enderror" name="descuento" value="{{ old('descuento') }}" required autocomplete="descuento" autofocus>

                @error('descuento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="existencia" class="col-md-4 col-form-label text-md-end">{{ __('existencia') }}</label>

            <div class="col-md-6">
                <input id="existencia" type="text" class="form-control @error('existencia') is-invalid @enderror" name="existencia" value="{{ old('existencia') }}" required autocomplete="existencia" autofocus>

                @error('existencia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="estilo" class="col-md-4 col-form-label text-md-end">{{ __('estilo') }}</label>

            <div class="col-md-6">
                <input id="estilo" type="text" class="form-control @error('estilo') is-invalid @enderror" name="estilo" value="{{ old('estilo') }}" required autocomplete="estilo" autofocus>

                @error('estilo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="dimension" class="col-md-4 col-form-label text-md-end">{{ __('dimension') }}</label>

            <div class="col-md-6">
                <input id="dimension" type="text" class="form-control @error('dimension') is-invalid @enderror" name="dimension" value="{{ old('dimension') }}" required autocomplete="dimension" autofocus>

                @error('dimension')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="peso" class="col-md-4 col-form-label text-md-end">{{ __('peso') }}</label>

            <div class="col-md-6">
                <input id="peso" type="text" class="form-control @error('peso') is-invalid @enderror" name="peso" value="{{ old('peso') }}" required autocomplete="peso" autofocus>

                @error('peso')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="material" class="col-md-4 col-form-label text-md-end">{{ __('material') }}</label>

            <div class="col-md-6">
                <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('material') }}" required autocomplete="material" autofocus>

                @error('material')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="color" class="col-md-4 col-form-label text-md-end">{{ __('color') }}</label>

            <div class="col-md-6">
                <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color" autofocus>

                @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tipopintura" class="col-md-4 col-form-label text-md-end">{{ __('tipo de pintura') }}</label>

            <div class="col-md-6">
                <input id="tipopintura" type="text" class="form-control @error('tipopintura') is-invalid @enderror" name="tipopintura" value="{{ old('tipopintura') }}" required autocomplete="tipopintura" autofocus>

                @error('tipopintura')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="acabado" class="col-md-4 col-form-label text-md-end">{{ __('acabado') }}</label>

            <div class="col-md-6">
                <input id="acabado" type="text" class="form-control @error('acabado') is-invalid @enderror" name="acabado" value="{{ old('acabado') }}" required autocomplete="acabado" autofocus>

                @error('acabado')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="detalle" class="col-md-4 col-form-label text-md-end">{{ __('detalle') }}</label>

            <div class="col-md-6">
                <input id="detalle" type="text" class="form-control @error('detalle') is-invalid @enderror" name="detalle" value="{{ old('detalle') }}" required autocomplete="detalle" autofocus>

                @error('detalle')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="garantia" class="col-md-4 col-form-label text-md-end">{{ __('garantia') }}</label>

            <div class="col-md-6">
                <input id="garantia" type="text" class="form-control @error('garantia') is-invalid @enderror" name="garantia" value="{{ old('garantia') }}" required autocomplete="garantia" autofocus>

                @error('garantia')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="proveedor" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Proveedor') }}</label>

            <div class="col-md-6">
                <select name="proveedor" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                    @foreach($proveedores as $proveedor)
                    <option value="{{$proveedor->id}}"> {{$proveedor->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="linea" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Linea') }}</label>

            <div class="col-md-6">
                <select name="linea" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                    @foreach($lineas as $linea)
                    <option value="{{$linea->id}}"> {{$linea->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="categoria" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Categoria') }}</label>

            <div class="col-md-6">
                <select name="categoria" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                    @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}"> {{$categoria->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <form action="{{ route('preStore') }}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="producto" value="">
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
                <a href=" {{route('adminProducto')}}" class="btn btn-danger" style="text-align:right">Volver</a></td>
                <button type="submit" id="crear" class="btn btn-primary">
                    {{ __('Crear') }}
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
            type: "GET",
            url: "{{route('showImg')}}",

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

    $('#crear').click(function(){
        if(habilitar==1){
            document.getElementById('formProducto').submit();
        }else {
            alert("No a seleccionado ninguna imagen");
        }
    });
</script>
@endsection