<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class HomeController extends BaseController
{
    public function index(Request $request)
    {
        return view('admin.home.index');
    }

    public function newCounts()
    {
        return [
//            'reviews' => [
//                'type' => 'success',
//                'count' => Review::query()->ofStatus('new')->count(),
//            ],
        ];
    }
}