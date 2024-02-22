$(function () {

    $(document).on("change", ".commonSelect2", function() {
        var commonSelectVal = $(this).attr("aria-describedby");
        var values = $(this).val();
        if (values !="" && values !=undefined) {
            $("#"+commonSelectVal).hide();
        }
    });

    $('.commonSelect2').each(function () {
        $(this).select2({            
            dropdownParent: $(this).parent()            
        });            
    });

    $('.js-Select2').select2();
    
    registrationText = $("#registration-tab").text();
    loginText = $("#login-tab").text();

    $(document).on("click", ".showHidePassword", function() {
        var obj = $(this);
        $(obj).find('em').toggleClass('icon-eye1 icon-eye-off');
        $(obj).siblings(".form-control").attr('type', function(index, attr) {
            return attr == 'text' ? 'password' : 'text';
        });
    });
  
    // Hide show modal box and reset modal popup
    $('.modal').on('hidden.bs.modal', function() {
        if ($(this).attr('id')!="imageCropperModal") {
            $(this).find('form').trigger('reset'); 
        }
        $('input').removeClass('is-invalid');
        $('input').removeClass('is-valid');
        $('.invalid-feedback').text('');
    });

    if(window.location.hash == '#login-tab'){
        var firstTabEl = document.querySelector('#authTab li:last-child button')
        var firstTab = new bootstrap.Tab(firstTabEl)
        firstTab.show()
        $(".registrationWrap_left_content h1, .registrationWrap_left_content p span").text(loginText);
    }
    

    if ($(window).width()>991) {
        $(document).on("click", "#authTab .nav-link", function(e) {
            e.preventDefault();
            var tab = $('#login-tab');
            if(tab.hasClass('active')){
                $(".registrationWrap_left_content h1, .registrationWrap_left_content p span").text(loginText);
                $(".registrationWrap_left").removeClass('slideAnimation');
                $(".registrationWrap_left").css('transform', 'translateX(100%)');
                setTimeout(() => {
                    $(".registrationWrap_left").addClass('slideAnimation');
                    $(".registrationWrap_left").css('transform', 'translateX(0)');
                }, 100);
            }
            else{
                $(".registrationWrap_left_content h1, .registrationWrap_left_content p span").text(registrationText);
                $(".registrationWrap_left").removeClass('slideAnimation');
                $(".registrationWrap_left").css('transform', 'translateX(100%)');
                setTimeout(() => {
                    $(".registrationWrap_left").addClass('slideAnimation');
                    $(".registrationWrap_left").css('transform', 'translateX(0)');
                }, 100);

            }
        });
    }
    if ($(window).width()<990) {
        $(document).on("click", "#authTab .nav-link", function(e) {
            e.preventDefault();
            var tab = $('#login-tab');
            if(tab.hasClass('active')){
                $(".registrationWrap_left_content h1, .registrationWrap_left_content p span").text(loginText);
            }
            else{
                $(".registrationWrap_left_content h1, .registrationWrap_left_content p span").text(registrationText);
            }
        });
    }

    
    
});

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "closeHtml": '<span class="btn-trigger"><em class="icon-close"></em></span>',
    "preventDuplicates": true,
    "showDuration": "1500",
    "hideDuration": "1500",
    "timeOut": "5000",
    "toastClass": "toastr",
    "extendedTimeOut": "5000"
};

window.commonLoader = function (isLoad) {
    if (isLoad) {
        $('.fullpageLoader').removeClass('d-none');
    } else {
        $('.fullpageLoader').addClass('d-none');
    }
}


window.addEventListener("pageshow", function ( event ) {
    var historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
      window.location.reload();
    }
});

//Common success taoster
window.successToaster = function (message, title = '') {
    toastr.remove();
    toastr.options.closeButton = true;
    toastr.success(message, title, { timeOut: 5000 });
}
window.errorToaster = function (message, title) {
    toastr.remove();
    toastr.options.closeButton = true;
    toastr.error(message, title, { timeOut: 5000 });
}

window.handleError = function (errorResponse) {
    if (errorResponse.responseText) {
        var errors = JSON.parse(errorResponse.responseText);
        if (errorResponse.status === 422 || errorResponse.status === 429) {
            if (errors.errors) {
                for (var field in errors.errors) {
                    errorToaster(errors.errors[field]);
                    return false;
                }
            } else {
                errorToaster(errors.error.message);
            }
        } else {
            if (errors.message) {
                errorToaster(errors.message);
            } else {
                errorToaster(errors.error.message);
            }
            return false;
        }
    } else if (errorResponse.status === 0) {
        errorToaster("error.internet_connection");
    } else {
        errorToaster(errorResponse.statusText);
    }
}

window.showSendChatButtonLoader = function (btnObj, btnName, btnStatus) {
    if (btnStatus) {
        $(btnObj).html(btnName + ' ' + ' <em class="icon-send"></em>...<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="visually-hidden"></span>');
    } else {
        btnObj.html(btnName+ ' <em class="icon-send"></em>');
    }
    btnObj.attr("disabled", btnStatus);
}

window.showButtonLoader = function (btnObj, btnName, btnStatus) {
    if (btnStatus) {
        $(btnObj).html(btnName + ' ' + '...<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="visually-hidden"></span>');
    } else {
        btnObj.html(btnName);
    }
    btnObj.attr("disabled", btnStatus);
}

window.pageLoader = function (id) {
    $('#' + id).html('<div class="pageLoader col-sm-12 text-center"><div class="spinner-border" role="status"></div></div>');
}



window.deleteRecord = function (obj, type) {
    bootbox.confirm({
        message: "Are you sure want to delete?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-primary justify-content-center'
            },
            cancel: {
                label: 'No',
                className: 'btn-light justify-content-center'
            },

        },
        className: "text-center",
        closeButton: false,
        animate: true,
        callback: function (result) {
            if (result) {
                $.ajax({
                    type: "DELETE",
                    data: { '_token': obj.attr('data-token'), type: type },
                    url: obj.attr('data-url'),
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message, type, { timeOut: 2000 });
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(data.message, type, { timeOut: 2000 });
                        }
                    }, error: function (err) {
                    }
                });
            }
        }
    });
}

window.updateStatus = function (obj, status, type, message ="") {
    if(message =="")
    {
       message = status
    }
    Swal.fire({
        title: 'Are you sure',
        text: `you want to ${message} this ${type}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "put",
                url: obj.attr('data-url'),
                data: { status: status },
                success: function (data) {
                    if (data.success) {
                        successToaster(data.message, type)
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    } else {
                        errorToaster(data.message, type)
                    }
                }, error: function (err) {
                    errorToaster(err.message, type)
                }
            })
        } 
      })
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});