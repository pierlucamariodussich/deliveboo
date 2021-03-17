@extends('layouts.main')
@section('content')
<InfoRestaurant data="{{$restaurant[0]}}"> </InfoRestaurant>
<TypeMenu data="{{$restaurant[0]}}"></TypeMenu>
<PreFooter></PreFooter>
@endsection