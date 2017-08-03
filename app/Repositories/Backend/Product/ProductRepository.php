<?php

namespace App\Repositories\Backend\Product;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Auth;
//model
use App\Models\Product\ProductModel;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository {

    /**
     * Associated Repository Model.
     */
    const MODEL = ProductModel::class;

    public function getProduct() {
        return ProductModel::pluck('name', 'id')->prepend('Select Product', '')->all();
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
            config('access.product_table') . '.id',
            config('access.product_table') . '.name',
            config('access.product_table') . '.qty',
        ]);
//        $dataTableQuery = $dataTableQuery->orderBy(config('access.product_table') . '.id','desc');

        return $dataTableQuery;
    }

    /**
     * @param array $input
     */
    public function create($input) {
        $product = $this->createUserStub($input);

        return DB::transaction(function () use ($product) {
                    if ($product->save()) {
//                event(new ProductCreated($product));
                        return ['status' => 'true', 'id' => $product->id];
                    }

                    throw new GeneralException(trans('exceptions.backend.product.create_error'));
                });
    }

    /**
     * 
     * @param array $input
     */
    public function addQuantity(array $input) {
        
        $product = ProductModel::find($input['product']);
        $totalQty = $product['qty']+$input['qty'];
        ProductModel::where('id',$input['product'])->update(['qty'=>$totalQty]);
        return $product['name'];
    }

    /**
     * @param Model $product
     * @param array $input
     *
     * @return bool
     * @throws GeneralException
     */
    public function update(Model $product, array $input) {

        $product->name = $input['name'];
        $product->qty = $input['qty'];


        return DB::transaction(function () use ($product) {
                    if ($product->save()) {
                        return true;
                    }
                    throw new GeneralException(trans('exceptions.backend.product.update_error'));
                });
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $product) {
//        $this->softDeleteAll($product->id);
        if ($product->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.product.delete_error'));
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     */
    public function forceDelete(Model $product) {
//        if (!empty($product->image)) {
//            unlink($this->imgPath . '/' . $product->image);
//        }
        if (is_null($product->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.product.delete_first'));
        }

        DB::transaction(function () use ($product) {
            if ($product->forceDelete()) {
                event(new UserPermanentlyDeleted($product));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.product.delete_error'));
        });
    }

    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input) {

        $product = self::MODEL;
        $product = new $product;
        $product->name = $input['name'];
        $product->qty = $input['qty'];

        return $product;
    }

}
