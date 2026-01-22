@extends('layouts.index')
@section('title', 'danh mục')
@section('content')
    <a href="/danhmuc/them" class="btn btn-sm btn-light border text-succes">Them danh muc</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> image </th>
            <th>action</th>
        </tr>
        @foreach ($danhmuc as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['image'] }}</td>
                <td>
                    <a href="/danhmuc/delete/{{ $item['id'] }}" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
@push('scripts')
<script>
    alert("hello world")
</script>
@endpush
