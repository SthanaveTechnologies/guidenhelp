$(document).ready(function() {
    
        $('#subCategoriesTable').DataTable({
            
            processing: true, // Show the processing indicator
            serverSide: true, // Enable server-side processing
            ajax: {
                url: '/subCategories', // Fetch data from the categories.index route
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
    
        
        $('#subCategoriesTable').on('click', '.edit-subCategory', function() {
            var $row = $(this).closest('tr'); // Get the closest <tr> for this button
    
            // Retrieve data from the <tr>
            var title = $row.find('td:eq(0) p').text(); // Title in first <td>
            var description = $row.find('td:eq(1) p').text(); // Description in second <td>
            var id = $(this).data('id');
    
            // Fill the modal inputs
            $('#title').val(title);
            $('#des').val(description);
    
            // Optionally store the ID for use in an update
            $('#modalSubCat').data('category-id', id);
        });
    
        // Reset the form when the modal is hidden
        $('#modalSubCat').on('hide.bs.modal', function() {
            $('#subCategoryForm')[0].reset();
            $(this).removeData('category-id');
        });
        $('#subCategoryForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
    
            // Get form data
            var title = $('#title').val();
            var description = $('#des').val();
            var id = $('#modalSubCat').data('category-id');
    
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
                    $('#modalSubCat').modal('hide'); // Hide modal
                    $('#subCategoriesTable').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
    
        
            $('#subCategoriesTable').on('click', '.delete-subCategory', function() {
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
                        $('#subCategoriesTable').DataTable().ajax.reload();
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