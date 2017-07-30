<?php

namespace App\Models\Customer\Traits\Attribute;

/**
 * Class UserAttribute.
 */
trait CustomerAttribute
{
 

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }
    
  

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

   
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.customer.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }


    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
      
            return '<a href="'.route('admin.customer.destroy', $this).'"
                 data-method="delete"
                 data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                 data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                 data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
                 class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
        

        return '';
    }

 

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            
            $this->edit_button.
            $this->delete_button;
    }
}
