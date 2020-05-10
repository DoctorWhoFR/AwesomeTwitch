@extends('layouts.app')
@section('content')

    <style>
        .overlayHeader {
            background-color: #9c88ff;
        }

    </style>
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <div class="box has-text-centered overlayHeader" style="">
                <h1 class="title">Generate new overlay</h1>
                <form action="{{URL::to('/twitch/overlay/generate')}}" method="POST">
                    @csrf
                    <label for="name">Nom de l'overlay</label>
                    <input id="name" name="name" type="text" class="input">
                    <br><br>
                    <button type="submit"  class="button is-primary">Generate</button>
                </form>

            </div>
        </div>

    </div>
    <div class="columns is-multiline" style="padding: 25px;">
        @if($overlays)
            @foreach($overlays as $overlay)
                <div class="column is-4 has-text-centered">
                    <div class="box" style="background-color: #c4c4c4">
                        <h1 class="title">Overlay: {{$overlay->name}}</h1>

                        <hr>
                        <a href="{{URL::to('/twitch/overlay/faker')}}?faker=follower&overlay={{$overlay->user_id}}" class="button is-danger is-small">Faker Followers</a>
                        <hr>
                        <p class="subtitle">Followers alerts:</p>
                        <div class="columns">
                            <div class="column is-9">
                                <input type="text" class="input is-small" disabled value="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}">
                            </div>
                            <div class="column is-1">
                                <a target="_blank" href="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}" class="button is-primary is-small">Charger l'overlay</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
