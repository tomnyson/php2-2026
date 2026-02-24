@extends('layouts.index')
@section('title', 'products')
@section('content')
    <a href="/product/add" class="btn btn-sm btn-light border text-succes">Add product</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> price </th>
            <th> image </th>
            <th> status </th>
            <th>action</th>
        </tr>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['price'] }}</td>
                <td><img src="{{ $item['image'] }}" alt="" width="100"></td>
                <td>{{ $item['status'] == 1 ? 'active' : 'disable' }}</td>
                <td>
                     <a href="/product/show/{{ $item['id'] }}" class="btn btn-success">View
                        
                    </a>
                    <a href="/product/delete/{{ $item['id'] }}" class="btn btn-danger">Delete
                        
                    </a>
                       <a href="/product/update/{{ $item['id'] }}" class="btn btn-primary">Edit
                        
                    </a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
