@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\Cart::getContent() as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <a href="{{ route('add-cart', [$product->id]) }}" class="btn btn-success btn-sm">+</a>
                    <a href="{{ route('remove-cart', [$product->id]) }}" class="btn btn-danger btn-sm">-</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <a href="{{ route('payment')}}" class="btn btn-primary">Checkout</a>
@endsection
