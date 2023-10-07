@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Space</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->space }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('add-cart', [$product->id]) }}" class="btn btn-success btn-sm">Add To Cart</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
