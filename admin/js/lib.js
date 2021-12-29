function redirect(url)
{
    location.href = url;
}

function initEditor(obj){

    tinymce.init({
        selector: obj,
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        file_browser_callback: function(field, url, type, win) {
            // n=url.indexOf("/minishop/");
            // if (n==-1) {
            //     url=url.replace('/minishop/','');
            // }
            tinyMCE.activeEditor.windowManager.open({
                file: 'kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
                title: 'KCFinder',
                width: 700,
                height: 500,
                inline: true,
                close_previous: false
            }, {
                window: win,
                input: field
            });
            
            return false;
        }
    });

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


    $('.imgUploader').each(function(){
        $(this).click(function(){
            var f=$(this);

            window.KCFinder={
                callBack:function(url){
                    n=url.indexOf("/minishop/");
                    if (n==0) {
                        url=url.replace('/minishop/','/');
                    }
                    f.val(url);
                    window.KCFinder=null;
                }
            };
            var win=window.open('kcfinder/browse.php?type=image','kcfinder_textbox','status=0,toolbar=0,location=0,menubar=0,directories=0,'+'resizable=1,scrollbars=0,width=600,height=400');
            win.focus();

        });
    });
});

