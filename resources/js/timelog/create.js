const { parseJSON } = require("jquery");

let Timelog = {
    init: function () {
        $('#removeBtn').hide();

        Timelog.addEditTimeLog();
        Timelog.addMoreBtn();
        Timelog.removeBtn();
        Timelog.changeWorkingHours();
        countWorkingHours();
    },

    addEditTimeLog: function () {
        $(document).on("click", "#addEditTimelogBtn", function (e) {
            e.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            let form = $("#addEditTimelog");
            let btn = $(this);
            let btnText = btn.text();
            $('.help-block').html('');
            if (form.valid()) {
                showButtonLoader(btn, btnText, true);
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: form.serialize(),
                    success: function (response) {
                        showButtonLoader(btn, btnText, false);
                        if (response.success) {
                            successToaster(response.message);
                            setTimeout(() => {
                                window.location.href = response.redirectUrl;
                            }, 1000);
                        } else {
                            errorToaster(response.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.responseJSON) {
                            let errors = jqXHR.responseJSON.errors;
                            if (errors) {
                                for (const key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        const element = errors[key];
                                        $("#" + key + "-error")
                                            .html(errors[key])
                                            .show();
                                    }
                                }
                            }
                            errorToaster(
                                jqXHR.responseJSON.message ||
                                    "An error occurred."
                            ); // Check if responseJSON.message exists, else provide a default error message
                        } else {
                            errorToaster("An error occurred."); // Provide a default error message if responseJSON is not available
                        }
                        showButtonLoader(btn, btnText, false);
                    },
                });
            }
        });
    },

    addMoreBtn: function () {
        $(document).on('click', '#addMoreBtn', function (e) { 
            e.preventDefault();
            commonLoader(true);
            let url = $('#addMoreUrl').val();
            let count = $('.appended').length + 1;
            $.post(url,{"_token": $('#token').val(), count:count} ,function(data, status){
                $('#appendData').append(data);
                $('#removeBtn').show();
                countWorkingHours();
                commonLoader(false);
            });
        })
    },

    removeBtn: function (){
        $(document).on('click', '#removeBtn', function(e){
            e.preventDefault();
            $('#appendData').find(".appended").last().remove();
            let count = $('#appendData').find(".appended").length;
            if(count == 0){
                $('#removeBtn').hide();
            }
            countWorkingHours();
        });
    },

    changeWorkingHours: function (){
        $(document).on('change', '.working_hours', function(){
            countWorkingHours();
        });
    },
};

$(function () {
    Timelog.init();
});

window.countWorkingHours = function () {
    let totalHours = 0;
    let totalMinutes = 0;

    $('.working_hours').each(function() {
        let value = $(this).val().trim();
        if (value !== '') {
            let parts = value.split(':');
            let hours = parseInt(parts[0]);
            let minutes = parseInt(parts[1]);
            totalHours += hours;
            totalMinutes += minutes;
        }
    });

    // Adjust total hours if total minutes exceed 60
    totalHours += Math.floor(totalMinutes / 60);
    totalMinutes %= 60;

    $('#total_hours').text(totalHours + ':' + (totalMinutes < 10 ? '0' : '') + totalMinutes);
}