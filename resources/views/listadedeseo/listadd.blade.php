@extends('layouts.app')

@section('content')

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Combo</th>
            <th scope="col">Articulo</th>
            <th scope="col">Producto</th>
            <th scope="col">Estados</th>
            <th scope="col">Eliminar</th>

          </tr>
        </thead>
        <tbody>
            @foreach($listadeseo as $lista)
            <tr>
            <td>{{$lista->id}}</td>
            <td>{{$lista->cliente}}</td>
            <td>{{$lista->combo}}</td>
            <td>{{$lista->articulo}}</td>
            <td>{{$lista->Producto}}</td>
            <td>{{$lista->estado}}</td>
            <td>
            <center>
                    <form action="{{route('listaDeseos.destroy', $lista->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Eliminar
                        </button>
                    </form>
                </center>
            </td>

           
        </tr>
            @endforeach

        </tbody>
      </table>

    <!-- Start Wishlist  -->
    <div class="wishlist-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price </th>
                                    <th>Stock</th>
                                    <th>Add Item</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="images/img-pro-01.jpg" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									Lorem ipsum dolor sit amet
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 80.0</p>
                                    </td>
                                    <td class="quantity-box">In Stock</td>
                                    <td class="add-pr">
                                        <a class="btn hvr-hover" href="#">Add to Cart</a>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="images/img-pro-02.jpg" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									Lorem ipsum dolor sit amet
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 60.0</p>
                                    </td>
                                    <td class="quantity-box">In Stock</td>
                                    <td class="add-pr">
                                        <a class="btn hvr-hover" href="#">Add to Cart</a>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="images/img-pro-03.jpg" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									Lorem ipsum dolor sit amet
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ 30.0</p>
                                    </td>
                                    <td class="quantity-box">In Stock</td>
                                    <td class="add-pr">
                                        <a class="btn hvr-hover" href="#">Add to Cart</a>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Wishlist -->


      @stop()
