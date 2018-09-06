@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open(array('url' => $action)) }}
        {{ Form::token() }}
        <h3>Amend Tradesperson</h3>
        <div class="form-group">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', $person->first_name, ['class' => 'form-control'] ) }}
        </div>
        <div class="form-group">
            {{ Form::label('last_name', 'Last Name') }}
            {{ Form::text('last_name', $person->last_name, ['class' => 'form-control'] ) }}
        </div>
        <div class="form-group">
            {{ Form::label('trades', 'Trades') }}
            {{ Form::select('trades[]', $trades, $person->trades()->get()->pluck('id'), ['id' => 'trades', 'multiple' => 'multiple', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'E-Mail Address') }}
            {{ Form::email('email', $person->email, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', $person->address, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('dob', 'Date of Birth') }}
            {{ Form::date('dob', $person->dob, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('phone', 'Phone') }}
            {{ Form::text('phone', $person->phone, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}


    </div>

@endsection