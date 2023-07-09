<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <main class="max-w-4xl mx-auto">
        <h1 class="font-bold text-2xl mt-8">Text Control Panel</h1>
        <table class="table table-auto mt-4 border border-collapse border-slate-500">
            <thead>
                <tr>
                <th class="border border-slate-500 px-3 py-2">text</th>
                <th class="border border-slate-500 px-3 py-2">location</th>
                <th class="border border-slate-500 px-3 py-2">style</th>
                <th class="border border-slate-500 px-3 py-2">size(px)</th>
                <th class="border border-slate-500 px-3 py-2">color</th>
                <th class="border border-slate-500 px-3 py-2">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($textList as $index => $text)
                    @php
                        $currentPosition = collect($boxes)->pluck('text')->search($text);
                        $currentPosition = $currentPosition !== false ? $currentPosition + 1 : null;
                    @endphp
                    <form action="/admin" method="POST">
                        @csrf
                        <tr>
                            <td class="border border-slate-500 px-3 py-2">
                                <input type="hidden" name="selected_text" value="{{ $text }}">
                                {{ $text }}
                            </td>
                            <td class="border border-slate-500 px-3 py-2">
                                <select name="placement" id="placement_{{ $index }}" class="border border-slate-500 p-2">
                                @for ($i = 1; $i <= 16; $i++)
                                    <option value="{{ $i-1 }}" @if ($currentPosition === $i) selected @endif>
                                        Box {{$i}}
                                        @if ($currentPosition === $i)
                                            (Current Position)
                                        @endif
                                    </option>
                                @endfor
                                </select>
                            </td>
                            <td class="border border-slate-500 px-3 py-2">
                                <div class="flex gap-2">
                                    <input type="checkbox" name="bold" id="bold_{{ $index }}">
                                    Bold
                                    <input type="checkbox" name="italic" id="italic_{{ $index }}">
                                    Italic
                                </div>
                            </td>
                            <td class="border border-slate-500 px-3 py-2">
                                <input type="number" name="font-size" class="border border-slate-500 w-20" id="font_size_{{ $index }}">
                            </td>
                            <td class="border border-slate-500 px-3 py-2">
                                <input type="color" name="text-color" id="color_{{ $index }}">
                            </td>
                            <td class="border border-slate-500 px-3 py-2"><button type="submit" class="bg-slate-100 border border-slate-400 p-2 rounded">Save</button></td>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('index') }}" class="mt-12 px-3 py-2 rounded bg-orange-500 text-white inline-block font-bold hover:bg-orange-400">Back to Box Map</a>

    </main>
</body>
</html>
