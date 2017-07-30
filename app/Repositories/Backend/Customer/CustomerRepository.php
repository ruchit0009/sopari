<?php

namespace App\Repositories\Backend\Customer;



use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Auth;

//model
use App\Models\Customer\CustomerModel;
/**
 * Class CustomerRepository.
 */
class CustomerRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = CustomerModel::class;

   
    /**
     * @param int  $status
     * @param bool $trashed
     *
     * @return mixed
     */
    public function getForDataTable()
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            
            ->select([
                config('access.customer_table').'.id',
                config('access.customer_table').'.name',
                config('access.customer_table').'.order_payment',
                config('access.customer_table').'.credit_payment',
                
            ]);
        $dataTableQuery = $dataTableQuery->orderBy(config('access.customer_table') . '.id','desc');
         
        return $dataTableQuery;
    }

    /**
     * @param array $input
     */
    public function create($input)
    {
        $cust = $this->createUserStub($input);

       return DB::transaction(function () use ($cust) {
            if ($cust->save()) {
//                event(new CustomerCreated($cust));
                return ['status' => 'true', 'id' => $cust->id];
            }

            throw new GeneralException(trans('exceptions.backend.customer.create_error'));
        });
    }

    /**
     * @param Model $cust
     * @param array $input
     *
     * @return bool
     * @throws GeneralException
     */
    public function update(Model $cust, array $input)
    {

        $cust->name = $input['name'];
       
       
       return DB::transaction(function () use ($cust) {
            if ($cust->save()) {
                return true;
            }
            throw new GeneralException(trans('exceptions.backend.customer.update_error'));
        });
    }
    
    /**
     * @param Model $cust
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $cust)
    {
//        $this->softDeleteAll($cust->id);
        if ($cust->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.customer.delete_error'));
    }

    /**
     * @param Model $cust
     *
     * @throws GeneralException
     */
    public function forceDelete(Model $cust)
    {
//        if (!empty($cust->image)) {
//            unlink($this->imgPath . '/' . $cust->image);
//        }
        if (is_null($cust->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.customer.delete_first'));
        }

        DB::transaction(function () use ($cust) {
            if ($cust->forceDelete()) {
                event(new UserPermanentlyDeleted($cust));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.customer.delete_error'));
        });
    }
 
    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
       
        $cust = self::MODEL;
        $cust = new $cust;
        $cust->name = $input['name'];

        return $cust;
    }
}
