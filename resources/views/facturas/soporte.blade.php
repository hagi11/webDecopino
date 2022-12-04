@extends('layouts.app')

@section('content')

<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="card-header col-lg-12"><h1>SOPORTE DE PAGO NEQUI</h1></div>
            <div class="col-lg-6">
                <div class="card-body">
                <p>Adjunte el comprobante de pago y de click en continuar (solo imagenes).</p><br>

                <form action="{{ route('factura.update', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="comprobante_pago">Comprobante de pago:</label><br>
                    <input type="hidden" name="subir" value="1">
                    <input type="file" name="imagen" id="imagen" accept="image/*">
                    <br><br>
                    <button type="submit" class="btn btn-outline-dark" style="margin-right: 0.5cm">Cargar</button>
                    <a class="btn btn-outline-dark" href="{{route('factura.index')}}">Cargar mas tarde</a>
                </form>
                
                </div>
            </div>
            <div class="col-lg-6">
                <br>
                <img src="https://www.ocu.org/-/media/ta/images/qr-code.png?rev=2e1cc496-40d9-4e21-a7fb-9e2c76d6a288&hash=AF7C881FCFD0CBDA00B860726B5E340B&mw=960" alt="QR NEQUI" width="200" height="200">
            </div>
        </div>
    </div>
</div>
@endsection