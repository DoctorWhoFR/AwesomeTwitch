@extends('layouts.app')
@section('content')
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <div class="box has-text-centered" style="background-color: #d5b8ff">
                <h1 class="title">Generate new overlay</h1>
                <form action="">
                    <label for="name">Nom de l'overlay</label>
                    <input id="name" type="text" class="input">
                    <br><br>
                    <a href="{{URL::to('twitch/overlay/generate')}}" class="button is-primary">Generate</a>
                </form>

            </div>
        </div>

    </div>
    <div class="columns is-multiline" style="padding: 25px;">
        @foreach($overlays as $overlay)
            <div class="column is-4 has-text-centered">
                <div class="box" style="background-color: #c4c4c4">
                    <h1 class="title">Overlay:</h1>

                    <hr>
                    <a href="{{URL::to('/twitch/overlay/faker')}}?faker=follower&overlay={{$overlay->user_id}}" class="button is-danger is-small">Faker Followers</a>
                    <a href="{{URL::to('/twitch/overlay/faker')}}?faker=follower&overlay={{$overlay->user_id}}" class="button is-danger is-small">Faker Followers</a>
                    <a href="{{URL::to('/twitch/overlay/faker')}}?faker=follower&overlay={{$overlay->user_id}}" class="button is-danger is-small">Faker Followers</a>
                    <hr>
                    <p class="subtitle">Followers alerts:</p>
                    <input type="text" class="input is-small" disabled value="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}">
                    <br><br>
                    <a target="_blank" href="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}" class="button is-primary">Charger l'overlay</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection
