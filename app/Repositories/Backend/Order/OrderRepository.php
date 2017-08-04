<?php

namespace App\Repositories\Backend\Order;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Auth;
//model
use App\Models\Order\OrderModel;
use App\Models\Product\ProductModel;
use App\Models\Customer\CustomerModel;
use App\Models\Order\OrderProductModel;
/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository {

    /**
     * Associated Repository Model.
     */
    const MODEL = OrderModel::class;

    /**
     * 
     * @return type
     */
    public function getProduct() {
        return ProductModel::pluck('name', 'id')->prepend('Select Product', '')->all();
    }
    
    /**
     * 
     * @return type
     */
    public function getCustomer() {
        return CustomerModel::pluck('name', 'id')->prepend('Select Customer', '')->all();
    }
    
    /**
     * 
     * @param type $id
     */
    public function orderDetails($id){
        
        return OrderProductModel::where('order_id',$id)->get()->toArray();
    }

    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable() {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
                ->select([
            config('access.order_table') . '.id',
            config('access.customer_table') . '.name',
            config('access.order_table') . '.qty',
            config('access.order_table') . '.grand_total',
            config('access.order_table') . '.delivery_charge',
            config('access.order_table') . '.packing',
            config('access.order_table') . '.final_amount',
            config('access.order_table') . '.created_at',
        ])
        ->leftJoin(config('access.customer_table'),config('access.customer_table') . '.id','=',config('access.order_table') . '.customer_id');
//        $dataTableQuery = $dataTableQuery->orderBy(config('access.order_table') . '.id','desc');

        return $dataTableQuery;
    }

    /**
     * @param array $input
     */
    public function create($input) {
        $order = $this->createUserStub($input);

        return DB::transaction(function () use ($order,$input) {
                    if ($order->save()) {
                        $this->orderProduct($input, $order->id);
                        return ['status' => 'true', 'id' => $order->id];
                    }

                    throw new GeneralException(trans('exceptions.backend.order.create_error'));
                });
    }
    
    public function orderProduct($input,$id){
      
        $totalPrice = 0;
        $finalQty = 0;
        
        foreach ($input['product'] as $prod){
            $productData = [];
            $productData['order_id'] = $id;
            $productData['qty'] = $prod['qty'];
            $productData['product_id'] = $prod['product_id'];
            $productData['price'] = $prod['price'];
            $productData['total_price'] = $prod['price']*$prod['qty']*65;
            OrderProductModel::create($productData);
            $qty = 0;
               $product = ProductModel::find($prod['product_id']); 
               $qty = $product['qty'] - $prod['qty'];
            ProductModel::where('id',$prod['product_id'])->update(['qty'=>$qty]);
            $totalPrice = $totalPrice + $productData['total_price'];
            $finalQty = $finalQty + $productData['qty'];
        }
          
        $dCharge = $finalQty * 20;
        $pCharge = $finalQty * 40;
        $orderData['qty'] = $finalQty;
        $orderData['grand_total'] = $totalPrice;
        $orderData['delivery_charge'] = $dCharge ;
        $orderData['packing'] = $pCharge;
        $orderData['final_amount'] = $totalPrice + $dCharge + $pCharge;
       
        OrderModel::where('id',$id)->update($orderData);
        $cust = CustomerModel::find($input['customer_id']);
        $newPrice = $cust['order_payment'] + $orderData['final_amount'];
        CustomerModel::where('id',$input['customer_id'])->update(['order_payment'=>$newPrice]);
    }

  

    /**
     * @param Model $order
     * @param array $input
     *
     * @return bool
     * @throws GeneralException
     */
    public function update(Model $order, array $input) {
        
        $this->updateProduct($order, $input);
        $order->customer_id = $input['customer_id'];
        $order->qty = 0;
        $order->grand_total = 0;
        $order->delivery_charge = 0;
        $order->packing = 0;
        $order->final_amount = 0;

        return DB::transaction(function () use ($order,$input) {
                    if ($order->save()) {
                        $this->orderProduct($input, $order->id);
                        return true;
                    }
                    throw new GeneralException(trans('exceptions.backend.order.update_error'));
                });
    }
    
    public function updateProduct($order,$input){
        $orderDetails = OrderModel::find($order->id);
        
       $customer =  CustomerModel::find($orderDetails['customer_id']);
        $newPrice = $customer['order_payment'] - $orderDetails['final_amount'];
        CustomerModel::where('id',$orderDetails['customer_id'])->update(['order_payment'=>$newPrice]);
        $orderProduct = OrderProductModel::where('order_id',$order->id)->get();
        
        foreach ($orderProduct as $prod){
            $qty = 0;
               $product = ProductModel::find($prod['product_id']); 
               $qty = $product['qty'] + $prod['qty'];
            ProductModel::where('id',$prod['product_id'])->update(['qty'=>$qty]);
            OrderProductModel::where('id',$prod['id'])->forceDelete();
        }
        
    }

    /**
     * @param Model $order
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $order) {
//        $this->softDeleteAll($order->id);
        if ($order->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.order.delete_error'));
    }

    /**
     * @param Model $order
     *
     * @throws GeneralException
     */
    public function forceDelete(Model $order) {
//        if (!empty($order->image)) {
//            unlink($this->imgPath . '/' . $order->image);
//        }
        if (is_null($order->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.order.delete_first'));
        }

        DB::transaction(function () use ($order) {
            if ($order->forceDelete()) {
                event(new UserPermanentlyDeleted($order));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.order.delete_error'));
        });
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input) {

        $order = self::MODEL;
        $order = new $order;
        $order->customer_id = $input['customer_id'];
        $order->qty = 0;
        $order->grand_total = 0;
        $order->delivery_charge = 0;
        $order->packing = 0;
        $order->final_amount = 0;
       

        return $order;
    }

}
