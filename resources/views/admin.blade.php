<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <form method="POST" action="/admin">
        @csrf
        <label for="text">Text:</label>
        <input type="text" id="text" name="text" required><br><br>

        <label for="placement">Placement:</label>
        <select id="placement" name="placement">
            <option value="0">Box 1</option>
            <option value="1">Box 2</option>
            <option value="2">Box 3</option>
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
