<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $textList = $this->getTextList();
        return view('admin', compact('textList'));
    }

    private function getTextList()
    {
        return [
            'Dropee.com',
            'B2B Marketplace',
            'SaaS enabled marketplace',
            'Provide Transparency',
            'Build Trust',
        ];
    }

    private function getTextFromList($selectedText)
    {
    $textList = $this->getTextList();
        if (isset($textList[$selectedText])) {
            return $textList[$selectedText];
        }
        return '';
    }

    private function getBoxes()
    {
        $boxes = Storage::disk('s3')->exists('boxes.json')
        ? json_decode(Storage::disk('s3')->get('boxes.json'), true)
        : [];

        return $boxes;
    }

    private function saveBoxes($boxes)
    {
        Storage::disk('s3')->put('boxes.json', json_encode($boxes));
    }

    public function locateText(Request $request)
    {
        $selectedText = $request->input('selected_text');
        $placement = $request->input('placement');
        $style = $this->getStyle($request);

        $boxes = $this->getBoxes();

        $boxes[$placement]['text'] = $selectedText;
        $boxes[$placement]['style'] = $style;

        // Ensure the placement is valid
        if ($placement >= 0 && $placement < count($boxes)) {
            $text = $this->getTextFromList($selectedText);
            $boxes[$placement] = [
                'text' => $selectedText,
                'style' => $style,
            ];

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

        $textColor = $request->input('text-color');
        if ($textColor) {
            $style .= 'color: ' . $textColor;
        }

        return $style;
    }

}
