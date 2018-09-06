@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('jobs/add') }}" class="btn btn-outline-primary" role="button">Add Job</a>

        <div id="toolbar" class="card mt-3">
            <div class="card-body">
                {{ Form::open(array('url' => 'admin/jobs/index/', 'class' => 'form-inline')) }}
                <div class="form-group">
                    {{ Form::label('month', 'Job Date') }}
                    {{ Form::select('filter_date', $months, $filter_date, ['id' => 'month', 'class' => 'form-control mx-sm-3', 'placeholder' => 'Filter by date...']) }}
                </div>
                {{ Form::submit('Filter', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
            </div>
        </div>

        @if($jobs->count())
            <table class="table my-3">
                <thead>
                <tr>
                    <th>Trades person</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->people->full_name }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->description }}</td>
                        <td>{{ $job->date }}</td>
                        <td>
                            <a class="button" href="{{ url('/admin/jobs/edit', [$job->id]) }}">Edit</a> |
                            <a class="button" href="{{ url('/admin/jobs/remove', [$job->id]) }}" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="card mt-3">
                <div class="alert alert-warning mb-0" role="alert">
                    There are no results to be displayed</p>
                </div>
            </div>
        @endif

        <div class="align-center">
            {{ $jobs->appends(request()->input())->links() }}
        </div>
    </div>
@endsection