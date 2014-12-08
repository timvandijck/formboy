@extends('app')

@section('content')
<div id="welcome">
    <div class="jumbotron">
        <div class="container">
            <h1 class="jumbotron__header">Formboy</h1>

            <p class="jumbotron__body">
                Creating beautifull webforms is now easy as pie!
            </p>
        </div>
    </div>

    <div class="container">
        <ol class="steps">
            <li class="steps__item">
                <div class="body">
                    <h2>No back-end skills required</h2>

                    <p>
                        Just write your code in HTML, CSS and Javascript. We take care of the rest!
                    </p>

                </div>
            </li>

            <li class="steps__item">
                <div class="body">
                    <h2>Manage your forms</h2>

                    <p>
                        Manage your forms with our powerful dashboards.
                    </p>

                </div>
            </li>

            <li class="steps__item">
                <div class="body">
                    <h2>Data made easy</h2>

                    <p>
                        Export your form data to Excel in just one click.
                    </p>
                </div>
            </li>
        </ol>
    </div>
</div>
@stop
