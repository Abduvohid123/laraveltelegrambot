<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyYetkazibBerishRequest;
use App\Http\Requests\StoreYetkazibBerishRequest;
use App\Http\Requests\UpdateYetkazibBerishRequest;
use App\Models\YetkazibBerish;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YetkazibBerishController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('yetkazib_berish_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yetkazibBerishes = YetkazibBerish::all();

        return view('admin.yetkazibBerishes.index', compact('yetkazibBerishes'));
    }

    public function create()
    {
        abort_if(Gate::denies('yetkazib_berish_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yetkazibBerishes.create');
    }

    public function store(StoreYetkazibBerishRequest $request)
    {
        $yetkazibBerish = YetkazibBerish::create($request->all());

        return redirect()->route('admin.yetkazib-berishes.index');
    }

    public function edit(YetkazibBerish $yetkazibBerish)
    {
        abort_if(Gate::denies('yetkazib_berish_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yetkazibBerishes.edit', compact('yetkazibBerish'));
    }

    public function update(UpdateYetkazibBerishRequest $request, YetkazibBerish $yetkazibBerish)
    {
        $yetkazibBerish->update($request->all());

        return redirect()->route('admin.yetkazib-berishes.index');
    }

    public function show(YetkazibBerish $yetkazibBerish)
    {
        abort_if(Gate::denies('yetkazib_berish_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.yetkazibBerishes.show', compact('yetkazibBerish'));
    }

    public function destroy(YetkazibBerish $yetkazibBerish)
    {
        abort_if(Gate::denies('yetkazib_berish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yetkazibBerish->delete();

        return back();
    }

    public function massDestroy(MassDestroyYetkazibBerishRequest $request)
    {
        YetkazibBerish::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
