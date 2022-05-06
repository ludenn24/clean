(function($) {
    "use strict";

    var tpj = jQuery;
    var revapi24;

    //---- on ready function -----//
    jQuery(document).ready(function($) {

    /*--------------------------
     counterdown
    ---------------------------- */
        function e() {
            var e = new Date;
            e.setDate(e.getDate() + 3);
            var dd = e.getDate();
            var mm = e.getMonth() + 1;
            var y = e.getFullYear();
            var futureFormattedDate = mm + "/" + dd + "/" + y + ' 12:00:00';
            return futureFormattedDate;
        }

        //----- Contact Form Submition ------//
        function checkRequire(formId , targetResp){
            targetResp.html('');
            var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
            var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
            var image = /\.(jpe?g|gif|png|PNG|JPE?G)$/;
            var mobile = /^[\s()+-]*([0-9][\s()+-]*){6,20}$/;
            var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
            var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
            var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
            var check = 0;
            $('#er_msg').remove();
            var target = (typeof formId == 'object')? $(formId):$('#'+formId);
            target.find('input , textarea , select').each(function(){
                if($(this).hasClass('require')){
                    if($(this).val().trim() == ''){
                        check = 1;
                        $(this).focus();
                        targetResp.html('<div class="alert alert-warning" role="alert">Debe completar este campo para continuar.</div>');
                        $(this).addClass('error');
                        return false;
                    }else{
                        $(this).removeClass('error');
                    }
                }
                if($(this).val().trim() != ''){
                    var valid = $(this).attr('data-valid');
                    if(typeof valid != 'undefined'){
                        if(!eval(valid).test($(this).val().trim())){
                            $(this).addClass('error');
                            $(this).focus();
                            check = 1;
                            targetResp.html('<div class="alert alert-warning" role="alert">'+$(this).attr('data-error')+'</div>');
                            return false;
                        }else{
                            $(this).removeClass('error');
                        }
                    }
                }
            });
            return check;
        }

        $(".submitForm").on("click", function() {
            var _this = $(this);
            var targetForm = _this.closest('form');
            var errroTarget = targetForm.find('.response');
            var check = checkRequire(targetForm , errroTarget);
            if(check == 0){
                var formData = new FormData($("#FormRegistro")[0]);
                $.ajax({
                    type : 'POST',
                    url : 'registrar',
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                }).done(function(resp){
                    if(resp.response == 'success'){
                        targetForm.find('input').val('');
                        targetForm.find('textarea').val('');
                        errroTarget.html('<div class="alert alert-success" role="alert">Mensaje enviado correctamente.</div>');
                    }else{
                        errroTarget.html('<p style="color:red;">Algo salió mal, inténtenlo de nuevo.</p>');
                    }
                });
            }
        });


    });

})(jQuery);
