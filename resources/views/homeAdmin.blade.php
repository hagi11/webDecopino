@extends('layouts.appAdmin')

@section('content')

inicio

{{Auth::guard('usuarios')->user()->variables(3)->leer}} 

@endsection

