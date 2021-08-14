@extends('layouts.app')

@section('content')

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>

    <h2>User Services</h2>

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ \Illuminate\Support\Facades\Session::get('success') }}</p>
        </div>
    @endif

    <table>
        <tr>
            <th>Name</th>
            <th>description</th>
            <th>Price</th>
            <th>Status</th>
            <th>Payment time</th>
        </tr>

        @forelse($userServices as $userService)
        <tr>
            <td>{{ $userService->service->name }}</td>
            <td>{{ $userService->service->description }}</td>
            <td>${{ $userService->price }}</td>
            <td>{{ $userService->status }}</td>
            <td>{{ $userService->created_at }}</td>
        </tr>
            @empty
                <tr>
                    <th></th>
                    <th></th>
                    <th>
                        No data found!
                    </th>
                    <th></th>
                    <th></th>
                </tr>
        @endforelse
    </table>
@endsection

