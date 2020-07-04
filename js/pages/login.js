$(document).ready(function () {
    var lg = new function () {
        var lg  = this;
        lg.$wrapper = $(".form-wrapper");
        lg.$form = $("#login-form");
        lg.$user = $("#user");
        lg.$pass = $("#pass");
        lg.$btn  = $("#send");
        lg.token = $("#token").val();
        var loading = new _loading();
        loading.hide();
        
        
        lg.$form.submit(function (e) {
            e.preventDefault();
            lg.send();
        });
        
        
        let user, pass;
        lg.validate = function(){
             user = '';
             pass = '';
            
            var error = 0;
            lg.$user.removeClass('is-invalid');
            if(empty(lg.$user.val())){
                lg.$user.parent()
                  .find('.invalid-feedback')
                  .text("Digite un nombre de usuario");
                lg.$user.addClass('is-invalid');
                error++
            }
            
            lg.$pass.removeClass('is-invalid');
            if(empty(lg.$pass.val())){
                lg.$pass.parent()
                  .find('.invalid-feedback')
                  .text("Digite una contraseña");
                lg.$pass.addClass('is-invalid');
                error++;
            }
            
            user = lg.$user.val();
            pass = lg.$pass.val();
            
            return (error == 0);
        };
        
        lg.send = function(){
            if(lg.validate()) {
                $.ajax({
                           method    : 'POST',
                           dataType  : 'json',
                           url       : BASE_URL + "/login/validate",
                           data      : {user:user,
                               pass:window.btoa(pass),
                               screen :  screen.width + "x" + screen.height
                           },
                           beforeSend: function () {
                               loading.show();
                           }
                       })
                
                 .done(function (r) {
                     loading.hide();
                     if (r.status == 'ok') {
                         location.href= BASE_URL;
                     }
                    
                     if (r.status == 'error') {
                         Toast({
                                   title: r.msg,
                                   icon: "error"
                               });
                     }
                 })
                
                 .fail(function () {
                     loading.hide();
                     Toast({
                               title: "Oops!, Algo ha salido mal, porfavor recargue e intente nuevamente",
                               icon: "error"
                           });
                 })
            }
        }
    };
});