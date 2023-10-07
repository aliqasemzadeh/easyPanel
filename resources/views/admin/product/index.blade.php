@extends('layouts.admin')

@section('content')
    <a class="btn btn-primary" href="{{ route('admin.product.create') }}" role="button">ایجاد محصول</a>
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
                <a href="{{ route('admin.product.edit', [$product->id]) }}" class="btn btn-success btn-sm">Edit</a>
                <a href="{{ route('admin.product.delete', [$product->id]) }}" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
@endsection
