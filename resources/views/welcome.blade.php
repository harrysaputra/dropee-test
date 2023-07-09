<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="bg-slate-50">
    <main class="max-w-4xl mx-auto mt-12">
        <h1 class="text-4xl font-medium text-orange-500">dropmee</h1>
        <p class="text-md text-gray-500">Moving the text on the boxes via panel.</p>
        <div class=" grid grid-cols-4 gap-4 mt-8">
            @foreach($boxes as $box)
                <div id="{{ $box['boxNumber'] }}" class="rounded-md shadow p-4 relative min-h-[100px] bg-white" >
                    <span class="absolute top-0 left-1 text-xs text-gray-300">{{ $box['boxNumber'] }}</span>
                    <p style="{{ $box['style'] }}">{{ $box['text'] }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-12 flex items-center justify-between">
            <a href="{{ route('admin') }}" class=" px-3 py-2 rounded bg-orange-500 text-white inline-block font-bold hover:bg-orange-400">Go to text panel</a>
            <div class="text-gray-500 text-sm">
                Laravel 10 + tailwind 3 + Vercel + AWS
                <a href="https://github.com/harrysaputra/dropee-test" class="bg-slate-100 border border-slate-300 ml-2 px-2 py-1 rounded hover:bg-white"> dropmee @ github</a>
            </div>
        </div>
        </main>
</body>
</html>
