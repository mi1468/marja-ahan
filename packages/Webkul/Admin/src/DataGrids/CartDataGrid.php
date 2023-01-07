<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\Ui\DataGrid\DataGrid;

class CartDataGrid extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Sort cart.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('cart')
            // ->leftJoin('addresses as cart_address_shipping', function ($leftJoin) {
            //     $leftJoin->on('cart_address_shipping.cart_id', '=', 'carts.id')
            //         ->where('cart_address_shipping.address_type', OrderAddress::ADDRESS_TYPE_SHIPPING);
            // })
            // ->leftJoin('addresses as cart_address_billing', function ($leftJoin) {
            //     $leftJoin->on('cart_address_billing.cart_id', '=', 'carts.id')
            //         ->where('cart_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
            // })
            ;
            // ->addSelect('carts.id', 'carts.increment_id', 'carts.base_sub_total', 'carts.base_grand_total', 'carts.created_at', 'channel_name', 'status')
            // ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'cart_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'cart_address_billing.last_name) as billed_to'))
            // ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'cart_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'cart_address_shipping.last_name) as shipped_to'));

        // $this->addFilter('billed_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'cart_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'cart_address_billing.last_name)'));
        // $this->addFilter('shipped_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'cart_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'cart_address_shipping.last_name)'));
        // $this->addFilter('increment_id', 'carts.increment_id');
        // $this->addFilter('created_at', 'carts.created_at');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => 'آی دی پیش فاکتور',
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'customer_id',
            'label'      => trans('آی دی مشتری'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'customer_first_name',
            'label'      => trans('نام'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'customer_last_name',
            'label'      => trans('نام خانوادگی'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'shipping_method',
            'label'      => 'روش حمل و نقل',
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'items_count',
            'label'      => trans('تعداد'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'grand_total',
            'label'      => trans('قیمت کل'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
        ]);

        // $this->addColumn([
        //     'index'      => 'status',
        //     'label'      => trans('admin::app.datagrid.status'),
        //     'type'       => 'checkbox',
        //     'options'    => [
        //         'processing'      => trans('shop::app.customer.account.cart.index.processing'),
        //         'completed'       => trans('shop::app.customer.account.cart.index.completed'),
        //         'canceled'        => trans('shop::app.customer.account.cart.index.canceled'),
        //         'closed'          => trans('shop::app.customer.account.cart.index.closed'),
        //         'pending'         => trans('shop::app.customer.account.cart.index.pending'),
        //         'pending_payment' => trans('shop::app.customer.account.cart.index.pending-payment'),
        //         'fraud'           => trans('shop::app.customer.account.cart.index.fraud'),
        //     ],
        //     'sortable'   => true,
        //     'searchable' => true,
        //     'filterable' => true,
        //     'closure'    => function ($value) {
        //         if ($value->status == 'processing') {
        //             return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.carts.cart-status-processing') . '</span>';
        //         } elseif ($value->status == 'completed') {
        //             return '<span class="badge badge-md badge-success">' . trans('admin::app.sales.carts.cart-status-success') . '</span>';
        //         } elseif ($value->status == 'canceled') {
        //             return '<span class="badge badge-md badge-danger">' . trans('admin::app.sales.carts.cart-status-canceled') . '</span>';
        //         } elseif ($value->status == 'closed') {
        //             return '<span class="badge badge-md badge-info">' . trans('admin::app.sales.carts.cart-status-closed') . '</span>';
        //         } elseif ($value->status == 'pending') {
        //             return '<span class="badge badge-md badge-warning">' . trans('admin::app.sales.carts.cart-status-pending') . '</span>';
        //         } elseif ($value->status == 'pending_payment') {
        //             return '<span class="badge badge-md badge-warning">' . trans('admin::app.sales.carts.cart-status-pending-payment') . '</span>';
        //         } elseif ($value->status == 'fraud') {
        //             return '<span class="badge badge-md badge-danger">' . trans('admin::app.sales.carts.cart-status-fraud') . '</span>';
        //         }
        //     },
        // ]);

        // $this->addColumn([
        //     'index'      => 'billed_to',
        //     'label'      => trans('admin::app.datagrid.billed-to'),
        //     'type'       => 'string',
        //     'searchable' => true,
        //     'sortable'   => true,
        //     'filterable' => true,
        // ]);

        // $this->addColumn([
        //     'index'      => 'shipped_to',
        //     'label'      => trans('admin::app.datagrid.shipped-to'),
        //     'type'       => 'string',
        //     'searchable' => true,
        //     'sortable'   => true,
        //     'filterable' => true,
        // ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.sales.carts.view',
            'icon'   => 'icon eye-icon',
        ]);
    }
}
