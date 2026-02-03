@extends('layouts.index')
@section('title', 'Product')
@section('content')
    <a href="/product/them" class="btn btn-sm btn-light border text-succes">Add Product</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th>action</th>
        </tr>
        @foreach ($product as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>
                    <a href="/product/delete/{{ $item['id'] }}" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
@push('scripts')
<script>
    alert("Product here")
</script>
@endpush
