<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $textList = $this->getTextList();
        $boxes = $this->getBoxes();
        return view('admin', compact('textList', 'boxes'));
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

public function locateText(Request $request)
{
    $selectedText = $request->input('selected_text');
    $placement = $request->input('placement');
    $style = $this->getStyle($request);

    $boxes = $this->getBoxes();

    // Check if the selected text already exists in any box
    $existingPlacement = null;

    foreach ($boxes as $index => $box) {
        if (isset($box['text']) && $box['text'] === $selectedText) {
            $existingPlacement = $index;
            break;
        }
    }

    // Find the index of the selected text in the text list
    $textList = $this->getTextList();
    $selectedTextIndex = array_search($selectedText, $textList);

    // Ensure the placement is valid and the text is not already present in the selected box
    if ($placement >= 0 && $placement < 16 && $existingPlacement !== $placement) {
        // Remove the text from its existing placement if found

        $text = $selectedText;

        if ($existingPlacement !== null) {
            $text = $boxes[$existingPlacement]['text'];
            $boxes[$existingPlacement]['text'] = null;
            $boxes[$existingPlacement]['style'] = '';
        }

        // Place the selected text on the new placement
        $boxes[$placement]['text'] = $text;
        $boxes[$placement]['style'] = $style;
        $boxes[$placement]['boxNumber'] = $placement + 1;
    }

    $this->saveBoxes($boxes);

    return redirect('/');
}

}
