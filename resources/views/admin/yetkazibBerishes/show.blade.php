@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.yetkazibBerish.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.yetkazib-berishes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.yetkazibBerish.fields.id') }}
                        </th>
                        <td>
                            {{ $yetkazibBerish->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.yetkazibBerish.fields.delivery_type') }}
                        </th>
                        <td>
                            {{ $yetkazibBerish->delivery_type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.yetkazib-berishes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection