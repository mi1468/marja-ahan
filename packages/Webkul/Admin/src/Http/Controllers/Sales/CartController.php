<?php

namespace Webkul\Admin\Http\Controllers\Sales;

// use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;
use Webkul\Admin\DataGrids\CartDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\CartRepository;
use \Webkul\Sales\Repositories\OrderCommentRepository;


 use Webkul\Checkout\Contracts\CartItem;
use Webkul\Checkout\Models\CartItem as ModelsCartItem;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\CartRepository  $cartRepository
     * @param  \Webkul\Sales\Repositories\OrderCommentRepository  $orderCommentRepository
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected CartRepository $cartRepository,
        protected OrderCommentRepository $orderCommentRepository
    )
    {
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(CartDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        
        
        

        $order = $this->cartRepository->findOrFail($id);
      //  dd($order);
      Log::info($order);
      Log::info("after get cart");
        
        return view($this->_config['view'], compact('order'));
        
        // $order = DB::table('cart')->where('id', $id)->first();
        // // return view('result/artista', compact('artista'));
        // return view($this->_config['view'], compact('order'));
    }

    public function cartItemShow($id)
    {
        Log::info('in cartItemEdit');
        
         
        $cartItem = DB::table('cart_items')->where('id', $id)->first();
       
        
        // dd($cartItem);

        return view($this->_config['view'], compact('cartItem' )); // 
    }


    public function updateCartItem(Request $request) 
    {
        $cartItem = ModelsCartItem::findOrFail($request->id);

        // if ($cartItem->updateOrFail($request->all()) === false) {
        //     return response(
        //         "Couldn't update the user with id {$request->id}",
        //         Response::HTTP_BAD_REQUEST
        //     );
        // }

        // dd($cartItem);

        if ($cartItem->update($request->all()) === false) {
            return response(
                "Couldn't update the user with id {$request->id}",
                Response::HTTP_BAD_REQUEST
            );
        }
        
        $cartItem = DB::table('cart_items')->where('id', $request->id)->first();
       
        
        // dd($cartItem);

        return view($this->_config['view'], compact('cartItem' )); // 
    
    }

    // public function cartItemEdit($Request $request): Response
    // {
        
        
        
         
    //     $cartItem = DB::table('cart_items')->where('id', $id)->first();
       

      
        
    //     $cartItem->name       = Input::get('name');
      
        
    //     $cartItem->save();

    //     // redirect
    //     Session::flash('message', 'Successfully updated shark!');
    //     return Redirect::to('sharks');
        
    //     // dd($cartItem);

    //     return view($this->_config['view'], compact('cartItem' )); // 
    // }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $result = $this->orderRepository->cancel($id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    }

    /**
     * Add comment to the order
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment($id)
    {
        Event::dispatch('sales.order.comment.create.before');

        $comment = $this->orderCommentRepository->create(array_merge(request()->all(), [
            'order_id'          => $id,
            'customer_notified' => request()->has('customer_notified'),
        ]));

        Event::dispatch('sales.order.comment.create.after', $comment);

        session()->flash('success', trans('admin::app.sales.orders.comment-added-success'));

        return redirect()->back();
    }
}