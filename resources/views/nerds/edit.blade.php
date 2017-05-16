<!DOCTYPE html>
<html>
<head>
    <title>CRUDE EDITAR</title>
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
    <h1>Edit {{$nerd ->name}}</h1>

    {{ Html::ul($errors->all()) }}

    {!! Form::model($nerd,['route' =>['nerds.update', $nerd->id],'method'=> 'PUT'] ) !!}
{{--    {!! Form::open(['route' =>['nerds.update' ,$nerd->id], 'method' => 'PUT' ]) !!}--}}

    <div class="form-group">
        {{Form::label('name','', 'Name')}}
        {{Form::text ('name',$nerd->name, array ('class' => 'form-control'))}}
    </div>

    <div class="form-group">
        {{ Form::label('email','', 'Email') }}
        {{ Form::email('email',$nerd->email,array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
    {{ Form::label('nerd_level', 'Nerd Level') }}
    {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'),$nerd->nerd_level,  array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Edit the Nerd!', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}

</div>

</body>
</html>
