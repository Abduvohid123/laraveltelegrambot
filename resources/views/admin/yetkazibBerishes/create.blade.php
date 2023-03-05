@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.yetkazibBerish.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.yetkazib-berishes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="delivery_type">{{ trans('cruds.yetkazibBerish.fields.delivery_type') }}</label>
                <input class="form-control {{ $errors->has('delivery_type') ? 'is-invalid' : '' }}" type="text" name="delivery_type" id="delivery_type" value="{{ old('delivery_type', '') }}" required>
                @if($errors->has('delivery_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('delivery_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.yetkazibBerish.fields.delivery_type_helper') }}</span>
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