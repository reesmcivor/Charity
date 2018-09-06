@extends('layouts.app')

@section('content')
    <div class="container">

        {{ Form::open(array('url' => 'admin/trades/add_post')) }}
        {{ Form::token() }}
        <h3>Add Tradesperson</h3>
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control'] ) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}


    </div>

@endsection