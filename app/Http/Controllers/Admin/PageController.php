<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $canOrder = true;

    protected $defaultOrderColumn = 'order';
    protected $defaultOrderDirection = 'asc';

    protected function getModel()
    {
        return Page::class;
    }
}