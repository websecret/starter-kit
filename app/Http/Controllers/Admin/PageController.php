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
}