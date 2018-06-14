<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $canOrder = true;

    protected function getModel()
    {
        return Page::class;
    }

    public function save(Request $request, $model)
    {
        $model = parent::save($request, $model);
        $model->syncImages($request->input('images', []));
        return $model;
    }
}