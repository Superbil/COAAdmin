<?php

namespace App\Http\Controllers;

use App;

class DiagramOController extends Controller
{
    public function index()
    {
        return view('diagramO.index', compact('image', 'next', 'previous'));
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
        return view('diagramO', compact('image', 'next', 'previous'));
    }
}
