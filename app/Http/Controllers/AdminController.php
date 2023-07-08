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
        $json = Storage::disk('gcs')->get('boxes.json');
        return json_decode($json, true) ?: [];
    }

    private function saveBoxes($boxes)
    {
        $json = json_encode($boxes);
        Storage::disk('gcs')->put('boxes.json', $json);
    }

    public function createText(Request $request)
    {
        $text = $request->input('text');
        $placement = $request->input('placement');
        $style = $this->getStyle($request);

        $boxes = $this->getBoxes();

        $boxes[$placement]['text'] = $text;
        $boxes[$placement]['style'] = $style;

        // Add the color picker input handling
        $textColor = $request->input('text-color');
        if ($textColor) {
            $boxes[$placement]['style'] .= 'color: ' . $textColor . ';';
        }

        $this->saveBoxes($boxes);

        return redirect('/');
    }

    private function getStyle(Request $request)
    {
        $style = '';

        if ($request->input('italic')) {
            $style .= 'font-style: italic;';
        }

        if ($request->input('bold')) {
            $style .= 'font-weight: bold;';
        }

        $fontSize = $request->input('font-size');
        if ($fontSize) {
            $style .= 'font-size: ' . $fontSize . 'px;';
        }

        return $style;
    }

}
