$(".authForm").submit(function( event ) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "handler.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var res = jQuery.parseJSON(data);

            //сообщение о успешной регистрации
            if(Object.keys(res).length == 0){
                $('.messageBlock').html('Поздравляем, вы успешно зарегистрираны!<br>Для входа на сайт нажмите на ссылку - <a href="../signin/">войти</a>');
            }

            //вывод результатов валидации
            validationArea($('.authForm input[name="login"]'), $('.authForm input[name="login"]+h6'), res.login);
            validationArea($('.authForm input[name="password"]'), $('.authForm input[name="password"]+h6'), res.password);
            validationArea($('.authForm input[name="passwordСonf"]'), $('.authForm input[name="passwordСonf"]+h6'), res.passwordСonf);
            validationArea($('.authForm input[name="email"]'), $('.authForm input[name="email"]+h6'), res.email);
            validationArea($('.authForm input[name="name"]'), $('.authForm input[name="name"]+h6'), res.name);
        }
    });
});