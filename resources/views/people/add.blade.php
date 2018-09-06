@extends('layouts.app')

@section('content')
    <div class="container">

        {{ Form::open(array('url' => 'admin/people/add_post')) }}
        {{ Form::token() }}
            <h3>Add Tradesperson</h3>
            <div class="form-group">
                {{ Form::label('first_name', 'First Name') }}
                {{ Form::text('first_name', null, ['class' => 'form-control'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('last_name', 'Last Name') }}
                {{ Form::text('last_name', null, ['class' => 'form-control'] ) }}
            </div>
            <div class="form-group">
                {{ Form::label('trades', 'Trades') }}
                {{ Form::select('trades[]', $trades, null, ['id' => 'trades', 'multiple' => 'multiple', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'E-Mail Address') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('address', 'Address') }}
                {{ Form::text('address', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('dob', 'Date of Birth') }}
                {{ Form::date('dob', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('phone', 'Phone') }}
                {{ Form::text('phone', null, ['class' => 'form-control']) }}
            </div>
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}


    </div>

@endsection