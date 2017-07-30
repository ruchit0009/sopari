<?php

namespace App\Models\Common\Traits\Observer;

/**
 * Class UserRelationship
 * @package App\Models\Access\Client\Traits\Relationship
 */
trait CommonObserver
{

    protected static function boot()
    {
        parent::boot();


        static:: saving(function ($model) {

            $model->modified_by = \Auth::User()->id;
        });

        static:: saved(function ($model) {

            $model->modified_by = \Auth::User()->id;
        });


        static:: updating(function ($model) {

            $model->modified_by = \Auth::User()->id;
        });

        static:: updated(function ($model) {

            $model->modified_by = \Auth::User()->id;
        });


        static:: creating(function ($model) {

            $model->created_by = \Auth::User()->id;
            
        });

        static:: created(function ($model) {

            $model->created_by = \Auth::User()->id;
        });


        static:: deleting(function ($model) {

            $model->deleted_by = \Auth::User()->id;
            $model->save();
        });

        static:: deleted(function ($model) {

            $model->deleted_by = \Auth::User()->id;
        });
    }
}
