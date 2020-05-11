@extends('layouts.app')
@section('content')

    <style>
        .overlayBubble {
            padding-left: 30px;
        }
    </style>
    <div class="columns">
        <div class="column is-4"></div>
        <div class="column is-4">
            <div class="box has-text-centered overlayHeader" >
                <h1 class="title">Generate new overlay</h1>
                <form action="{{URL::to('/twitch/overlay/generate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Nom de l'overlay</label>
                    <input id="name" name="name" type="text" class="input">
                    <br><br>
                    <label for="checkbox">Custom page:</label>
                    <input id="checkbox" name="checkbox" type="checkbox" class="checkbox">
                    <br><br>
                    <label for="checkbox">Custom content (only if custom page is needed):</label>
                    <br>
                    <input type="file" name="file" id="file">
                    <br><br>
                    <button type="submit"  class="button is-primary">Generate</button>
                </form>

            </div>
        </div>

    </div>
    <div class="columns is-multiline overlayBubble">
        @if($overlays)
            @foreach($overlays as $overlay)
                <div class="column is-4 has-text-centered">
                    <div class="box" >
                        <h1 class="title">Overlay: {{$overlay->name}}</h1>

                        <hr>
                        <a href="{{URL::to('/twitch/overlay/faker')}}?faker=follower&overlay={{$overlay->overlay_code}}" class="button is-danger is-small">Faker Followers</a>
                        <hr>
                        <p class="subtitle">Followers alerts:</p>
                        <div class="columns">
                            <div class="column is-9">
                                <input type="text" class="input is-small" disabled value="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}">
                            </div>
                            <div class="column is-1">
                                <a target="_blank" href="{{URL::to('/twitch/overlay/followers/')}}/{{$overlay->user_id}}/{{$overlay->overlay_code}}" class="button is-primary is-small">LAUNCH</a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
