@extends('layouts.main')
@section('content')
    <JoinComponent></JoinComponent>
    <PartnerSectionHome style="background-image: url({{ asset('img/homepage/rider.jpg') }})"
        loginlink="{{ route('login') }}" registerlink="{{ route('register') }}" 
        auth="{{ isset(Auth::user()->getRestaurant) }}"
        @auth
        @if(isset(Auth::user()->getRestaurant))
        dashboardlink="{{ route('restaurant.show', Auth::user()->getRestaurant->id) }}" 
        @endif
        @endauth>
        


    </PartnerSectionHome>
    <InfoSectionHome></InfoSectionHome>
@endsection
