@extends('layouts.app')
@section('content')
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <div class="box has-text-centered">
                <h1 class="title">Get overlay</h1>
                <a href="" class="button is-primary">Generer un overlay</a>

            </div>
        </div>

    </div>
    <div class="columns" style="padding: 25px;">
        @foreach($overlays as $overlay)
            <div class="column is-2 has-text-centered">
                <div class="box" style="background-color: #c4c4c4">
                    <h1 class="title">Overlay:</h1>
                    <input type="text" class="submit" disabled value="http://127.0.0.1:8000/twitch/overlay/{{$overlay->user_id}}/{{$overlay->overlay_code}}">
                    <br><br>
                    <a href="http://127.0.0.1:8000/twitch/overlay/{{$overlay->user_id}}/{{$overlay->overlay_code}}" class="button is-primary">Charger l'overlay</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
