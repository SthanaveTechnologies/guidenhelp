$(document).ready(function() {
console.log("rjoer");

    $('#categoriesTable').DataTable({
        
        processing: true, // Show the processing indicator
        serverSide: true, // Enable server-side processing
        ajax: {
            url: '/categories', // Fetch data from the categories.index route
            type: 'GET'
        },
        columns: [
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status' },
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

    $('.edit-category').on('click', function() {
        var $row = $(this).closest('tr'); // Get the closest <tr> for this button

        // Retrieve data from the <tr>
        var title = $row.find('td:eq(0) p').text(); // Title in first <td>
        var description = $row.find('td:eq(1) p').text(); // Description in second <td>
        var id = $(this).data('id');

        // Fill the modal inputs
        $('#title').val(title);
        $('#des').val(description);

        // Optionally store the ID for use in an update
        $('#modalCat').data('category-id', id);
    });

    // Reset the form when the modal is hidden
    $('#modalCat').on('hide.bs.modal', function() {
        $('#categoryForm')[0].reset();
        $(this).removeData('category-id');
    });
    $('#categoryForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get form data
        var title = $('#title').val();
        var description = $('#des').val();
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
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
            },
            success: function(response) {
                console.log(response);
                alert('Category ' + (id ? 'updated' : 'created') + ' successfully!');
                $('#modalCat').modal('hide'); // Hide modal
                $('#categoriesTable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });

    $('.delete-category').on('click', function() {
        var id = $(this).data('id');

        var button = $(this);
        if (confirm('Are you sure you want to ' + (button.text().trim() === 'Deactivate' ?
                'deactivate' : 'activate') + ' this category?')) {
            $.ajax({
                url: '/categories/' + id,
                type: 'post',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert(response.message);
                    $('#categoriesTable').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        } else {

            return false;
        }
    });



});