<!-- resources/views/quill-editor.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quill Editor Example</title>
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Quill Editor Integration</h2>
        <form action="/submit-article" method="POST">
            @csrf
            <!-- Quill Editor for Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div id="quillEditor" style="height: 200px;"></div>
            </div>

            <!-- Hidden input field to store Quill content -->
            <input type="hidden" name="description" id="description">

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </form>
    </div>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!-- Your custom Quill JavaScript -->
    <script src="{{ asset('assets/js/quill.js') }}"></script>
</body>

</html>
