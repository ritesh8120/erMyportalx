let login = {
    init:function(){
        login.submit();
    },

    submit:function(){
        $(document).on('click', '#loginBtn', function(e){
            e.preventDefault();
            let form = $('#loginForm');
            let btn = $(this);
            let btnText = btn.text();
            if(form.valid()){
                showButtonLoader(btn, btnText, true);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success:function(data){
                        successToaster(data.message);
                        showButtonLoader(btn, btnText, false);
                        window.location.href = data.redirectUrl;
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        errorToaster(jqXHR.responseJSON.message);
                        showButtonLoader(btn, btnText, false);
                    }
                });
            }
        });
    }
};

$(function() {
    login.init();
})