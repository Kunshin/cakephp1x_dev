$(document).ready(function() {

    $(document).on('click', '.confirmDelete', function() {

        console.log($(this).data('href'));

        $('.actionDelete').replaceWith(
            '<a type="button" class="btn btn-danger actionDelete" href="'+$(this).data('href')+'">Delete</a>'
        );

    });

});