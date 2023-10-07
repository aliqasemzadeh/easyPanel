@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            افزودن محصول
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label for="name" class="form-label">نام محصول</label>
                <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="نوع میوه...">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
                <div class="mb-3">
                    <label for="image" class="form-label">عکس</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="عکس">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            <div class="mb-3">
                <label for="description" class="form-label">توضیحات</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="space" class="form-label">حجم</label>
                <input type="text" class="form-control" id="space" name="space" value="{{ old('space') }}" placeholder="حجم">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bandwidth" class="form-label">bandwidth</label>
                <input type="text" class="form-control" id="bandwidth" name="bandwidth" value="{{ old('bandwidth') }}" placeholder="bandwidth">
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label"> duration</label>
                <input type="text" class="form-control" id="duration" value="{{ old('duration') }}" name="duration">
                @error('duration')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="price">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>



            <button class="btn btn-primary" type="submit">افزودن</button>
            </form>
        </div>
    </div>
@endsection
