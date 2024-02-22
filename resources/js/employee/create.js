let employee = {
    init:function(){
        employee.addEmployee();
    },

    addEmployee:function(){
        $(document).on('click', '#addEmployeeBtn', function(e){
            e.preventDefault();
            let form = $('#addEmployee');
            let btn = $(this);
            let btnText = btn.text();
            if(form.valid()){
                showButtonLoader(btn, btnText, true);
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success:function(response){
                        showButtonLoader(btn, btnText, false);
                        if (response.success) {
                            successToaster(response.message);
                            setTimeout(() => {
                                window.location.href = response.redirectUrl;
                            }, 1000);
                        }else{
                            errorToaster(response.message);
                        }
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                        errorToaster(jqXHR.responseJSON);
                        showButtonLoader(btn, btnText, false);
                    }
                });
            }
        });
    }
};

$(function(){
    employee.init();
})