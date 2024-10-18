<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CKEditor 5 - Quick start ZIP</title>
        <link rel="stylesheet" href="../../assets/vendor/ckeditor5.css">
        <style>
            .main-container {
                width: 795px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>
      <textarea name="content" id="editor"></textarea>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

    </body>
</html>
