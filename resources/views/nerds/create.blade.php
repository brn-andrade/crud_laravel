<!DOCTYPE html>
<html>
    <head>
        <title>CRUDE CRIAR</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
    <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL:: to( 'nerds') }}">Nerd Alert</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('nerds') }}">View All Nerds</a></li>
                <li><a href="{{ URL::to('nerds/create') }}">Create a Nerd</a>
            </ul>
        </nav>
        <h1>Create a Nerd</h1>
       @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        {!! Form::open(['route' =>['nerds.store'], 'method' => 'POST' ]) !!}

        <div class="form-group">
             {{Form::label('name','', 'Name')}}
            {{Form::text ('name','', array ('class' => 'form-control'))}}
        </div>

        <div class="form-group">
            {{ Form::label('email','', 'Email') }}
            {{ Form::email('email','',array('class' => 'form-control')) }}
        </div>


            {{ Form::label('nerd_level', 'Nerd Level') }}
            {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'),  array('class' => 'form-control')) }}


        {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}

    </div>

    </body>
</html>
