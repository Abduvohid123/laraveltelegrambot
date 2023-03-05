<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreYetkazibBerishRequest;
use App\Http\Requests\UpdateYetkazibBerishRequest;
use App\Http\Resources\Admin\YetkazibBerishResource;
use App\Models\YetkazibBerish;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YetkazibBerishApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('yetkazib_berish_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new YetkazibBerishResource(YetkazibBerish::all());
    }

    public function store(StoreYetkazibBerishRequest $request)
    {
        $yetkazibBerish = YetkazibBerish::create($request->all());

        return (new YetkazibBerishResource($yetkazibBerish))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(YetkazibBerish $yetkazibBerish)
    {
        abort_if(Gate::denies('yetkazib_berish_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new YetkazibBerishResource($yetkazibBerish);
    }

    public function update(UpdateYetkazibBerishRequest $request, YetkazibBerish $yetkazibBerish)
    {
        $yetkazibBerish->update($request->all());

        return (new YetkazibBerishResource($yetkazibBerish))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(YetkazibBerish $yetkazibBerish)
    {
        abort_if(Gate::denies('yetkazib_berish_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $yetkazibBerish->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
