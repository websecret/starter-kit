<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return new PageResource($page);
    }
}