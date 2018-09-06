@extends('layouts.app')

@section('content')
    <div class="container">

        {{ Form::open(array('url' => $action)) }}
        {{ Form::token() }}
        <h3>Add Tradesperson</h3>
        <div class="form-group">
            {{ Form::label('people_id', 'Trades Person') }}
            {{ Form::select('people_id', $people, $job->person_id, ['id' => 'people_id', 'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-live-search-style' => "startsWith" ]) }}
        </div>
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $job->title, ['class' => 'form-control'] ) }}
        </div>
        <div class="form-group">
            {{ Form::label('location', 'Location') }}
            {{ Form::text('location', $job->location, ['class' => 'form-control'] ) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', $job->description, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('date', 'Date of Job') }}
            {{ Form::date('date', $job->date, ['class' => 'form-control']) }}
        </div>
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}


    </div>

@endsection