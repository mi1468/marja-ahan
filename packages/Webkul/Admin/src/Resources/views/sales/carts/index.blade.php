@extends('admin::layouts.content')

@section('page_title')
    {{ __('پیش فاکتور') }}
    {{-- admin::app.sales.orders.title --}}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('پیش فاکتور') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="page-content">
            <datagrid-plus src="{{ route('admin.sales.carts.index') }}"></datagrid-plus>
        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => app('Webkul\Admin\DataGrids\CartDataGrid')])
@endpush