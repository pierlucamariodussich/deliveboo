@extends('layouts.main')
@section('content')
    <DashboardComponent 
    restaurantdata="{{$restaurant}}" 
    dishesdata="{{$restaurant->getDishes}}"
    orderlist="{{ route('orders.show', $restaurant->id) }}"
    createdish="{{ route('dishes.create') }}"></DashboardComponent>
@endsection
