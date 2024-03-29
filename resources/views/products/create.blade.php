@extends('layouts.parent')
@section('title', 'Create New Product')

@section('content')
    <div class="row">
        <div class="col-12">
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            @include('messages.message')
            <form method="post" action="{{ route('my-dashboard.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">Name En</label>
                            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                                id="exampleInputEmail1" value="{{ old('name_en') }}">
                            @error('name_en')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Name Ar</label>
                            <input type="text" name="name_ar" class="form-control" id="exampleInputEmail1"
                                value="{{ old('name_ar') }}">
                            @error('name_ar')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" step="0.1" name="price" class="form-control" id="exampleInputEmail1"
                                value="{{ old('price') }}">
                            @error('price')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1"
                                value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="exampleInputEmail1">Details En</label>
                            <textarea class="form-control  " name="details_en" id="" cols="30" rows="2">{{ old('details_en') }}</textarea>
                            @error('details_en')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1">Details AR</label>
                            <textarea class="form-control " name="details_ar" id="" cols="30" rows="2">{{ old('details_ar') }}</textarea>
                            @error('details_ar')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}> Active </option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}> Not Active </option>
                            </select>
                            @error('status')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Brand</label>
                            <select name="brand_id" class="form-control " id="">
                                @forelse ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}> {{ $brand->name_en }}
                                    </option>
                                @empty
                                    <option value=""> No Brand </option>
                                @endforelse
                            </select>
                            @error('brand_id')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="exampleInputEmail1">Sub Category</label>
                            <select name="subcategory_id" class="form-control" id="">
                                <option value="" selected disabled> Choose Subcategory </option>

                                @forelse ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name_en }}
                                    </option>

                                @empty
                                    <option value=""> No Subcategory </option>
                                @endforelse
                            </select>
                            @error('subcategory_id')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            @error('photo')
                                <div class="alert alert-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" name="index" class="btn btn-primary">Create</button>
                    <button type="submit" name="return" class="btn btn-primary">Create & Return</button>
                </div>
            </form>
        </div>
    </div>
@endsection
