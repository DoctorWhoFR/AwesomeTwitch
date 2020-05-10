@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
                <a href="{{$login}}" class="button is-fullwidth twitchbtn"><i class="fab fa-twitch"></i>   LOGIN WITH TWITCH</a>
        </div>
    </div>
@endsection
