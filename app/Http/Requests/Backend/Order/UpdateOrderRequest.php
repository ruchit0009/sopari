<?php

namespace App\Http\Requests\Backend\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use App\Models\Product\ProductModel;
use App\Models\Order\OrderProductModel;
class UpdateOrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->hasRole(1);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        $rules = [
                    'customer_id' => 'required',
        ];
        
        foreach ($this->request->get('product') as $key => $val) {
           
            $product = ProductModel::find($val['product_id']);
            $orderProduct = OrderProductModel::find($val['id']);
             $qty = $product['qty'] + $orderProduct['qty'];
            $rules['product.'.$key.'.product_id'] = 'required';
            $rules['product.'.$key.'.qty'] = 'required|numeric|max:' . $qty;
            $rules['product.'.$key.'.price'] = 'required|numeric';
        }
        
         return $rules;
    }
}
