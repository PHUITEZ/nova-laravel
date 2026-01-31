@extends('layouts.master')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
    <div class="flexBetween mb4">
        <h2 style="margin:0;">Chi Tiết Đơn Hàng #{{$order->id}}</h2>
        <a href="{{route('admin.orders')}}" style="text-decoration:underline;">&larr; Quay Lại</a>
    </div>
    <div class="row">
        <div class="col col6">
            <div class="glassContainer" style="padding:2rem;">
                <h3 class="mb2">Thông Tin Khách Hàng</h3>
                <p><strong>Họ Tên:</strong> {{$order->user->name}}</p>
                <p><strong>Email:</strong> {{$order->user->email}}</p>
                <p><strong>Ngày Đặt:</strong> {{$order->createdAt ? $order->createdAt->format('d/m/Y H:i') : 'N/A'}}</p>
                <form action="{{route('admin.orders.update', $order->id)}}" method="POST" class="mt4">
                    @csrf
                    <label style="display:block;margin-bottom:0.5rem;">Cập Nhật Trạng Thái</label>
                    <div class="flexCenter" style="justify-content:flex-start;gap:1rem;">
                        <select name="status" class="formInput" style="width:auto;">
                            <option value="pending" {{$order->status == 'pending' ? 'selected' : ''}}>Pending</option>
                            <option value="processing" {{$order->status == 'processing' ? 'selected' : ''}}>Processing</option>
                            <option value="completed" {{$order->status == 'completed' ? 'selected' : ''}}>Completed</option>
                            <option value="cancelled" {{$order->status == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                        </select>
                        <button type="submit" class="primaryButton">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col col6">
            <div class="glassContainer" style="padding:2rem;">
                <h3 class="mb2">Sản Phẩm</h3>
                <table class="cartTable">
                    <thead>
                        <tr>
                            <th>Sản Phẩm</th>
                            <th>Giá</th>
                            <th>SL</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems ?? [] as $item)
                            <tr>
                                <td>{{$item->product->name}}</td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{number_format($item->price * $item->quantity)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flexBetween mt4"
                    style="font-size:1.2rem;border-top:1px solid var(--border-light);padding-top:1rem;">
                    <span>Tổng Cộng</span>
                    <span>{{number_format($order->total)}} đ</span>
                </div>
            </div>
        </div>
    </div>
@endsection