<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin');
    }

    private function getBoxes()
    {
        $boxes = Storage::exists('boxes.json')
            ? json_decode(Storage::get('boxes.json'), true)
            : [];

        return $boxes;
    }

    private function saveBoxes($boxes)
    {
        Storage::put('boxes.json', json_encode($boxes));
    }
}
