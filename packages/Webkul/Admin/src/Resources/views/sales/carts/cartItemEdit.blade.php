@extends('admin::layouts.master')

@section('page_title')
salam 
    {{-- {{ __('admin::app.sales.orders.view-title', ['order_id' => $order->increment_id]) }} --}}
@stop

@section('content-wrapper')
    <div class="content full-page">

        <div class="page-header">
            <div class="page-title">
                <h1>
                    {{-- {!! view_render_event('sales.order.title.before', ['order' => $order]) !!} --}}

                    {{-- <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('admin.sales.orders.index') }}'"></i> --}}

                    {{-- {{ __('پیش فاکتور ایکس', ['order_id' => $order->increment_id]) }} --}}
                    {{-- admin::app.sales.orders.view-title --}}

                    {{-- {!! view_render_event('sales.order.title.after', ['order' => $order]) !!} --}}
                </h1>
            </div>
        </div>

        <div class="page-content">

            <tabs>
                {{-- {!! view_render_event('sales.order.tabs.before', ['order' => $order]) !!} --}}

                <tab name="ویرایش پیش پرداخت" :selected="true">
                    <div class="sale-container">
                        <accordian title="ویرایش محصول" :active="true">
                            <div slot="body">
                                <div class="table">
                                    <div class="table-responsive">
                                        <form action="{{ route('admin.sales.carts.cartItemEdit', $cartItem->id) }}"  method="POST">
                                            {{ csrf_field() }}
                                            <table>
                                                <thead>
                                                    <tr>
                                                        {{-- <th>{{ __('admin::app.sales.orders.SKU') }}</th> --}}
                                                        <th>{{ __('id') }}</th>
                                                        <th>{{ __('admin::app.sales.orders.product-name') }}</th>
                                                        <th>{{ __('admin::app.sales.orders.price') }}</th>
                                                        {{-- <th>{{ __('admin::app.sales.orders.item-status') }}</th> --}}
                                                        {{-- <th>{{ __('admin::app.sales.orders.subtotal') }}</th> --}}
                                                        <th>{{ __('درصد تخفیف') }}</th>
                                                        {{-- <th>{{ __('admin::app.sales.orders.tax-amount') }}</th> --}}
                                                        {{-- <th>{{ __('admin::app.sales.orders.grand-total') }}</th> --}}
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            {{ $cartItem->id }}
                                                        </td>

                                                        <td>
                                                            <input type="text" value="{{$cartItem->name}}" name="name"/>
                                                        </td>
                                                        
                                                        <td>
                                                            <input type="text" value="{{$cartItem->price}}" name="price"/>
                                                        </td>

                                                        {{-- <td>
                                                            {{ core()->formatBasePrice($cartItem->base_total) }}
                                                        </td> --}}

                                                        <td>
                                                            <input type="text" value="{{$cartItem->tax_percent}}" name="tax_percent"/>
                                                        </td>

                                                        {{-- <td>
                                                            {{ core()->formatBasePrice($cartItem->base_tax_amount) }}
                                                        </td>

                                                        <td>
                                                            {{ core()->formatBasePrice($cartItem->base_total + $cartItem->base_tax_amount - $cartItem->base_discount_amount) }}
                                                        </td> --}}
                                                    </tr>
                                                   
                                                    
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-lg btn-primary"
                                            style="background: #4fd13d; border-radius: .5rem; font-size: 1rem; font-weight: bold; margin-left: 2rem; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                save
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </accordian>
                    </div>
                </tab>

                {{-- {!! view_render_event('sales.order.tabs.after', ['order' => $order]) !!} --}}
            </tabs>
        </div>

    </div>
@stop
