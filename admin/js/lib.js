function redirect(url)
{
    location.href = url;
}
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    if ($('#page').length > 0) {
        $('#page').keypress(function(e) {
            if( (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode == 13) ){

                var page=parseInt($(this).val().trim());
                var totalPage=parseInt($(this).attr('data-total-page'));
                if (page <= 0)
                    page=1;
                if (e.keyCode == 13) {
                    if (page<= totalPage) {
                        var url=$(this).attr('data-url');
                        redirect(url+'&p='+page);
                    }else{
                        $('#page').css('border-color', '#dc3545');
                        $('#page').css('box-shadow', 'rgb(220 53 69 / 15%) 0px 0px 0px 0.2rem');
                        $('#page').popover('show');
                    }
                }

            }else{
                return false;
            }
        });
    }

    if ($('#limit').length > 0) {
        $('#limit').change(function() {
            var limit=$(this).val();
            var url=$(this).attr('data-url');
            redirect(url+'&limit='+limit);
        });
    }
});