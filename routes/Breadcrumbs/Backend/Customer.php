<?php

Breadcrumbs::register('admin.customer.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.customer.management'), route('admin.customer.index'));
});

Breadcrumbs::register('admin.customer.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(trans('labels.backend.customer.create'), route('admin.customer.create'));
});
Breadcrumbs::register('admin.customer.edit', function ($breadcrumbs,$id) {
    $breadcrumbs->parent('admin.customer.index');
    $breadcrumbs->push(trans('labels.backend.customer.edit'), route('admin.customer.edit',$id));
});