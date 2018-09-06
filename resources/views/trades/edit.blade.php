@extends('layouts.app')

@section('content')
    <div class="container">

        {{ Form::open(array('url' => $action)) }}
        {{ Form::token() }}
        <h3>Edit Tradesperson</h3>
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $trade->name, ['class' => 'form-control'] ) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

    </div>

@endsection