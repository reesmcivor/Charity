@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('trades/add') }}" class="btn btn-outline-primary" role="button">Add Trade</a>

        @if($trades->count())
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($trades as $trade)
                    <tr>
                        <td>{{ $trade->id}}</td>
                        <td>{{ $trade->name}}</td>
                        <td>
                            <a class="button" href="{{ url('/admin/trades/edit', [$trade->id]) }}">Edit</a> |
                            <a class="button" href="{{ url('/admin/trades/remove', [$trade->id]) }}" onclick="return confirm('Are you sure?')">Delete</a>
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
            {{ $trades->links() }}
        </div>
    </div>
@endsection