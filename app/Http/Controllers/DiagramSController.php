<?php

namespace App\Http\Controllers;

use App;

class DiagramSController extends Controller
{
    public function index()
    {
        return view('diagramS.index', compact('image', 'next', 'previous'));
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
        return view('diagramS', compact('image', 'next', 'previous'));
    }
}
