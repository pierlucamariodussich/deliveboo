@extends('layouts.main')


@section('content')
    <OrdersComponent ordersarr="{{ $orders }}">
    </OrdersComponent>
@endsection
