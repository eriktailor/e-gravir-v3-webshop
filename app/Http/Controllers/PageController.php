<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display terms page (from markdown)
     */
    public function terms()
    {
        $markdown = file_get_contents(resource_path('markdown/terms.md'));
        $html = Str::markdown($markdown);

        return view('pages.terms', compact('html'));
    }
}
