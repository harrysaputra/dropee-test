<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <form method="POST" action="/admin">
        @csrf
        <label for="text">Text:</label>
        <select name="selected_text" id="selected_text">
            @foreach ($textList as $index => $text)
                <option value="{{ $text }}">{{ $text }}</option>
            @endforeach
        </select>

        <label for="placement">Placement:</label>
        <select id="placement" name="placement">
            @for ($i = 0; $i < 16; $i++)
                <option value="{{ $i }}">Box {{ $i + 1 }}</option>
            @endfor
        </select><br><br>

        <label for="italic">Italic:</label>
        <input type="checkbox" id="italic" name="italic"><br><br>

        <label for="bold">Bold:</label>
        <input type="checkbox" id="bold" name="bold"><br><br>

        <label for="font-size">Font Size:</label>
        <input type="number" id="font-size" name="font-size" min="1" max="100"><br><br>

        <!-- Add the color picker input for the text color -->
        <label for="text-color">Text Color:</label>
        <input type="color" id="text-color" name="text-color"><br><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
