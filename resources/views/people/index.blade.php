@extends('layouts.app')

@section('content')
<div class="container">

    <a href="{{ route('people/add') }}" class="btn btn-outline-primary" role="button">Add Trades Person</a>

    <div id="toolbar" class="card mt-3">
        <div class="card-body">
        {{ Form::open(array('url' => 'admin/people/index/', 'class' => 'form-inline')) }}
            <div class="form-group">
                {{ Form::label('trade_id', 'Trade') }}
                {{ Form::select('trades', $trades, $trade, ['id' => 'trades', 'class' => 'form-control mx-sm-3 ']) }}
            </div>
            <div class="form-group">
                {{ Form::label('location', 'Location') }}
                {{ Form::text('location', $location, ['class' => 'form-control mx-sm-3', 'placeholder' => 'Location'] ) }}
            </div>
            {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>

    @if($people->count())
        <table class="table my-3">
            <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($people as $person)
                <tr>
                    <td>{{ $person->first_name }}</td>
                    <td>{{ $person->last_name }}</td>
                    <td>{{ $person->email }}</td>
                    <td>{{ $person->address }}</td>
                    <td>{{ $person->dob }}</td>
                    <td>{{ $person->phone }}</td>
                    <td>
                        <a class="button" href="{{ url('/admin/people/edit', [$person->id]) }}">Edit</a> |
                        <a class="button" href="{{ url('/admin/people/remove', [$person->id]) }}" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="card mt-3">
            <div class="alert alert-warning mb-0" role="alert">
                There are no results to be displayed
            </div>
        </div>
    @endif

    <div class="align-center">
        {{ $people->appends(request()->input())->links() }}
    </div>
</div>
@endsection