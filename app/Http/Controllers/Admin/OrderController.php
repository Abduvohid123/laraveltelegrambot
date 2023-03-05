<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Location;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\YetkazibBerish;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::with(['user', 'product', 'location', 'payment_type', 'yetkazish'])->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('product_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::pluck('location_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = Payment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $yetkazishes = YetkazibBerish::pluck('delivery_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('locations', 'payment_types', 'products', 'users', 'yetkazishes'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('product_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $locations = Location::pluck('location_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = Payment::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $yetkazishes = YetkazibBerish::pluck('delivery_type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('user', 'product', 'location', 'payment_type', 'yetkazish');

        return view('admin.orders.edit', compact('locations', 'order', 'payment_types', 'products', 'users', 'yetkazishes'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        return redirect()->route('admin.orders.index');
    }

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('user', 'product', 'location', 'payment_type', 'yetkazish');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
