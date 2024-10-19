$(document).ready(function () {


    $('#articlesTable').DataTable({

        processing: true, // Show the processing indicator
        serverSide: true, // Enable server-side processing
        ajax: {
            url: '/articles', // Fetch data from the categories.index route
            type: 'GET'
        },
        columns: [
            { data: 'title', name: 'title' },
            { data: 'short_description', name: 'short_description' },
            { data: 'status', name: 'status' },
            { data: 'category_name', name: 'category_name' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Reset the form when the modal is hidden
    $('#modalArticle').on('hide.bs.modal', function () {
        $('#articleForm')[0].reset();
        $(this).removeData('category-id');
    });


    $('#articleForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Ensure the Quill editor has been initialized before accessing its content
        if (quill) {
            $('#description').val(quill.root.innerHTML); // Set the hidden input value
        }

        // Create a FormData object to hold form data
        var formData = new FormData(this);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // Use jQuery AJAX to submit the form
        $.ajax({
            url: '/article', // Adjust the URL to your Laravel route
            type: 'POST',
            data: formData,
            contentType: false, // Important for FormData
            processData: false, // Important for FormData
            success: function (data) {
                // Handle success (e.g., show a success message or redirect)
                console.log(data);
                alert('Article created successfully!');

                // Optionally, reset the form
                $('#articleForm')[0].reset();
                quill.setContents([]); // Clear the Quill editor
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handle error
                console.error('Error:', textStatus, errorThrown);
                alert('There was an error creating the article.');
            }
        });
    });



});