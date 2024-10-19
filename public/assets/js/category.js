$(document).ready(function () {


    $('#categoriesTable').DataTable({

        processing: true, // Show the processing indicator
        serverSide: true, // Enable server-side processing
        ajax: {
            url: '/categories', // Fetch data from the categories.index route
            type: 'GET'
        },
        columns: [
            { data: 'category_title', name: 'category_title' },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status' },
            { data: 'parent_title', name: 'parent_title' },
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

    $('#categoriesTable').on('click', '.edit-category', function () {
        var $row = $(this).closest('tr'); // Get the closest <tr> for this button

        // Retrieve data from the <tr>
        var title = $row.find('td:eq(0)').text(); // Title in first <td>
        var description = $row.find('td:eq(1)').text(); // Description in second <td>
        var categoryId = $(this).data('id'); // Assuming data-id is the category ID
        var parentId = $(this).data('parentid'); // Use 'data-parent-id' for consistency
        console.log(parentId);

        // Fill the modal inputs
        $('#title').val(title);
        $('#des').val(description);

        // Optionally store the ID for use in an update
        $('#modalCat').data('category-id', categoryId);

        // Show all options first
        $('#categoryDropdown option').show();

        // Hide the category option that matches the current category ID
        $('#categoryDropdown option').each(function () {
            if ($(this).val() == categoryId) {
                $(this).hide(); // Hide the option with the same category ID
            }
        });

        // Set the selected option in the dropdown based on the parentId
        $('#categoryDropdown option').each(function () {
            if ($(this).val() == parentId) {
                $(this).prop('selected', true); // Select the option that matches the parentId
                return false; // Break the loop once the match is found
            }
        });

        // Trigger change event if needed
        $('#categoryDropdown').change();
    });




    // Reset the form when the modal is hidden
    $('#modalCat').on('hide.bs.modal', function () {
        $('#categoryForm')[0].reset();
        $(this).removeData('category-id');
    });
    $('#categoryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Get form data
        var title = $('#title').val();
        var description = $('#des').val();
        var categoryId = $('#categoryDropdown').val();
        var id = $('#modalCat').data('category-id');

        // Determine whether to create or update
        var url = id ? '/categories/' + id : '/categories';

        // Perform AJAX request
        $.ajax({
            url: url,
            type: 'post',
            data: {
                title: title,
                description: description,
                parent_id: categoryId,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function (response) {
                console.log(response);
                alert('Category ' + (id ? 'updated' : 'created') + ' successfully!');
                $('#modalCat').modal('hide'); // Hide modal
                $('#categoriesTable').DataTable().ajax.reload();
            },
            error: function (xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });

    $('#categoriesTable').on('click', '.delete-category', function () {
        var id = $(this).data('id');

        var button = $(this);
        if (confirm('Are you sure you want to ' + (button.text().trim() === 'Deactivate' ?
            'deactivate' : 'activate') + ' this category?')) {
            $.ajax({
                url: '/categories/delete/' + id,
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    alert(response.message);
                    $('#categoriesTable').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        } else {
            return false;
        }
    });





});