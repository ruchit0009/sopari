<?php

namespace App\Models\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\Attribute\OrderAttribute;
use App\Models\Common\Traits\Observer\CommonObserver;

class OrderProductModel extends Model {

    use SoftDeletes,
        CommonObserver,
        OrderAttribute;

    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id','qty','product_id','price','total_price'];
    
      protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->table = config('access.order_product_table');
    }


}
