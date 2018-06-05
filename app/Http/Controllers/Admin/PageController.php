<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected function getModel()
    {
        return Page::class;
    }

    protected function getDataFromSaveRequest(Request $request)
    {
        $data = parent::getDataFromSaveRequest($request);
        $data['order'] = Page::query()->count() ? (Page::query()->max('order') + 1) : 0;
        return $data;
    }

    public function save(Request $request, $model)
    {
        $model = parent::save($request, $model);
        $model->syncImages($request->input('images', []));
        return $model;
    }
}