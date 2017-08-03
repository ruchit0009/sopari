<?php

Breadcrumbs::register('admin.order.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.order.management'), route('admin.order.index'));
});

Breadcrumbs::register('admin.order.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.index');
    $breadcrumbs->push(trans('labels.backend.order.create'), route('admin.order.create'));
});
Breadcrumbs::register('admin.order.edit', function ($breadcrumbs,$id) {
    $breadcrumbs->parent('admin.order.index');
    $breadcrumbs->push(trans('labels.backend.order.edit'), route('admin.order.edit',$id));
});