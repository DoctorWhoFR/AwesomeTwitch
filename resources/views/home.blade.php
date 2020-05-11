@extends('layouts.app')
@section('content')
    <br>
    <div class="columns">
        <div class="column is-4">
        </div>
        <div class="column is-4">
            <div class="box has-text-centered hometitle">
                <h1 class="title is-4"><i class="fas fa-user-alt"></i> Bienvenue {{Auth::user()->name }} <i class="fas fa-user-alt"></i></h1>
                <p>La dernière personne qui à follow est: <strong>{{$followers->data[0]->from_name}}</strong> {{$followers->total}}/50</p>
                <br>
                <a href="{{url()->route('twitch.overlay')}}" class="button is-success">OVERLAY</a>
            </div>
        </div>
    </div>

@endsection
