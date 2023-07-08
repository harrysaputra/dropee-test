<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <main class="max-w-4xl mx-auto mt-8">
        <div class=" grid grid-cols-4 gap-4">
            @foreach($boxes as $box)
                <div id="{{ $box['boxNumber'] }}" class="border p-4 border-gray-800" style="{{ $box['style'] }}">
                    {{ $box['boxNumber'] }}. {{ $box['text'] }}
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
