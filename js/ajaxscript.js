$('form').submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    $this.parent().parent().removeClass('animated shake');
    $this.parent().find('.alert').remove();
    var submit = true;
    var btn = $(this).find('button');
    $this.find('input[type="text"],input[type="password"]').attr('style', '');

    $this.find('input[type="text"],input[type="password"]').each(function () {
        if ($(this).val() == "") {
            $(this).focus().css({'border-color': '#f44', 'box-shadow': '0 0 8px #f44'});
            submit = false;
            $this.parent().parent().addClass('animated shake');
            return false;
        }
    });
    if (submit == true) {
        btn.button('loading');
        $.post('controller.php', $(this).serialize(), function (data) {
            if (data.error == 1) {
                $this.parent().prepend('<div class="alert alert-danger">' + data.message + '</div>');
                $this.parent().parent().addClass('animated shake');
                if (data.focus && data.focus != "undefined") {
                    $('input[name="' + data.focus + '"]').focus().css({
                        'border-color': '#f44',
                        'box-shadow': '0 0 8px #f44'
                    });
                }
            } else if(data.error == 2) {
                $this.parent().prepend('<div class="alert alert-danger">' + data.message + '</div>');
                $this.parent().parent().addClass('animated shake');
                $('input[name="email"], input[name="phone"]').focus().css({
                    'border-color': '#f44',
                    'box-shadow': '0 0 8px #f44'
                });
            }
            else {
                if (data.redir == "okk") {
                    $this.parent().prepend('<div class="alert alert-success">Вы успешно авторизовались, ждите...</div>');
                    window.location = 'admin/index.php';
                } else {
                    $this.parent().prepend('<div class="alert alert-success">' + data.message + '</div>');
                }
            }
        }, "JSON").error(function () {
            alert('Request not complete.');
        }).always(function () {
            btn.button('reset')
        });
    }
    setTimeout(function () {

    }, 100)

});
