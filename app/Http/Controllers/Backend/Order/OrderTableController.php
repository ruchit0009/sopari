<?php

namespace App\Http\Controllers\Backend\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Order\OrderRepository;
use Yajra\Datatables\Facades\Datatables;
use Auth;

class OrderTableController extends Controller {

    /**
     * @var JobRepository
     */
    protected $order;

    /**
     * @param JobRepository $jobs
     */
    public function __construct(OrderRepository $order) {
        $this->order = $order;
    }

    /**
     * @param ManageJobRequest $request
     *
     * @return mixed
     */
    public function __invoke() {
//      echo  date('Y-m-d'); exit;
        return Datatables::of($this->order->getForDataTable())
                        ->escapeColumns(['name','qty'])
                      
                       
                        ->editColumn('id', function ($order) {
//                            echo $order->created_at;exit;
                             if(date('Y-m-d',strtotime($order->created_at)) == date('Y-m-d')){
                                 return $order->action_buttons;
                             }
                                
                            
                        })
                        ->withTrashed()
                        ->make(true);
    }

}
