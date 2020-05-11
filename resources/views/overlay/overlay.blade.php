@extends('layouts.without')
@section('content')
    @if($default)
        @if($followed)
            {{ html_entity_decode($code) }}
        @endif
    @else
        @if($followed)
            <section class="hero is-fullheight followers">
                <div class="hero-body has-text-centered">
                    <div class="container box followersBox target">
                        <div class="followersContents">
                            <h1 class="title">
                                Bienvenue {{$followers->data[0]->from_name}} !!!
                            </h1>
                            <h2 class="subtitle">
                                Assie toi, détend toi ^^ <3
                                <div class="columns ">
                                    <div class="column is-4"></div>
                                    <div class="column is-4">
                                        <progress class="progress" value="15" max="30">15%</progress>
                                        <h1 class="title is-4">Objectif Followers: {{$followers->total}}/30</h1>
                                    </div>

                                </div>
                            </h2>
                        </div>
                    </div>
                </div>
            </section>
            <script src="{{asset('bounce.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.3/howler.js"></script>
            <script>
                var bounce = new Bounce();
                bounce.translate({
                    from: { x: -500, y: 0 },
                    to: { x: 50, y: 0 }
                });
                bounce.applyTo(document.querySelectorAll(".target"));

                sound = new Howl({
                    src: ["followd.mp3"]
                });
                sound.play();

                var intervalID = window.setInterval(myCallback, 10000);

                function myCallback()
                {
                    // Your code here
                    // Parameters are purely optional.
                    document.location.reload(true);
                }

            </script>
        @else
            <script>
                var intervalID = window.setInterval(myCallback, 5000);

                function myCallback()
                {
                    // Your code here
                    // Parameters are purely optional.
                    document.location.reload(true);
                }

            </script>
        @endif
    @endif


@endsection
