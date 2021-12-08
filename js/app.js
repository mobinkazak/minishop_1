$(document).ready(function() {
	$(document).on('click', '.m-closed', function() {
        var obj=$(this).parent();
        var data_row=$(this).attr('data-rows');
        if(data_row>0){
        	obj.find('.list-group').show();
	        $(this).removeClass('m-closed').addClass('m-opened');
	        $(this).children().children('.fa').removeClass('fa-angle-left').addClass('fa-angle-down');
        }
        
    });

    $(document).on('click', '.m-opened', function() {
        var obj=$(this).parent();
        var data_row=$(this).attr('data-rows');

		if(data_row>0){
			obj.find('.list-group').hide();
	        $(this).removeClass('m-opened').addClass('m-closed');
	        $(this).children().children('.fa').removeClass('fa-angle-down').addClass('fa-angle-left');
		}       
        

	});

});