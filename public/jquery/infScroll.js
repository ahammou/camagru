$(document).ready(function() {
    $('#loader').on('inview', function(event, isInView) {
        if (isInView) {
            var lastItem = $('.post').length;
            $.ajax({
                type: 'POST',
                url: 'controller/backend/pagination.php',
                data: {
                    offset: lastItem
                },
                success: function(data) {
                    if (data != '') {
                        $('.posts').append(data);
                    } else
                        $('#loader').hide();
                }
            });
        }
    });
});