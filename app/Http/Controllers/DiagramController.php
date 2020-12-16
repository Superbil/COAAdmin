<?php

namespace App\Http\Controllers;

use App;

class DiagramController extends Controller
{
    public function index()
    {
        return view('diagram.index', compact('image', 'next', 'previous'));
    }

    public function view($image)
    {
        $images = ['441748', '441751', '441752'];

        foreach ($images as $i => $v) {
            if ($image == $v) {
                $next = ($i == 2) ? null : $images[$i + 1];
                $previous = ($i == 0) ? null : $images[$i - 1];
            }
        }
        return view('diagram', compact('image', 'next', 'previous'));
    }
}
