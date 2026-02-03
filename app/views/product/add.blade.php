@extends('layouts.index')
@section('title', $title)
@section('content')
    <h3>add products</h3>
    <form action="/product/add" method="post">
        <label for="">product</label>
        <input name="name" type="text">
        <label for="">price</label>
        <input name="price" type="text">
        <label for="">image</label>
        <input name="img" type="text">
        <label for="">status</label>
        <select name="status" id="">
            <option value="1">hoat dong</option>
            <option value="0">ko hoat dong</option>
        </select>
        <button type="submit" class="btn btn-success">them</button>
    </form>
@endsection
 
