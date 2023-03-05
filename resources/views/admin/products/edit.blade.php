@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="product_title">{{ trans('cruds.product.fields.product_title') }}</label>
                <input class="form-control {{ $errors->has('product_title') ? 'is-invalid' : '' }}" type="text" name="product_title" id="product_title" value="{{ old('product_title', $product->product_title) }}" required>
                @if($errors->has('product_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_description">{{ trans('cruds.product.fields.product_description') }}</label>
                <textarea class="form-control {{ $errors->has('product_description') ? 'is-invalid' : '' }}" name="product_description" id="product_description">{{ old('product_description', $product->product_description) }}</textarea>
                @if($errors->has('product_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('product_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="1" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1" required>
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.product.fields.image') }}</label>
                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="text" name="image" id="image" value="{{ old('image', $product->image) }}" required>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection