<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

abstract class PopupController extends Controller
{
    public function form(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        return ['html' => view($this->getFormViewPath(), $this->getFormViewData($request, $model))->render()];
    }
}