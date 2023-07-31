<div class="bootstrap-iso">
    <div class="modal fade" role="dialog" id="status_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Action Status<a data-dismiss="modal" class="pull-right btn-danger btn">&times;</a>
                    </div>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" style="left:40%">
                        <button class="btn btn-danger pull-right" data-dismiss="modal">&times;</button>
                        <h4>Are you sure?</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal ajax-post" id="delete_form" action="" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="delete_id">
                        <input type="hidden" name="delete_model">
                        <div class="form-group">
                            <label class="control-label col-md-5">&nbsp;</label>
                            <div class="col-md-5">
                                <button data-dismiss="modal" class="btn btn-danger">NO</button>
                                <button type="submit" class="btn btn-success">YES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="run_action_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" style="left:40%">
                        <button class="btn btn-danger btn-sm btn-raised pull-right" data-dismiss="modal">&times;
                        </button>
                        <h4>Are you sure?</h4>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal ajax-post" id="run_action_form" action="" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="action_element_id">
                        <div class="form-group">
                            <label class="control-label col-md-5">&nbsp;</label>
                            <div class="col-md-5">
                                <button data-dismiss="modal" class="btn btn-danger btn-raised">NO</button>
                                <button type="submit" class="btn btn-success btn-raised">YES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .autocomplete-suggestions {
        background-color: beige;
    }

    .centered {
        margin-left: auto;
        margin-top: auto;
        margin-bottom: auto;
        margin-right: auto;

        display: -webkit-box; /* OLD - iOS 6-, Safari 3.1-6, BB7 */
        display: -ms-flexbox; /* TWEENER - IE 10 */
        display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
        display: flex; /* NEW, Spec - Firefox, Chrome, Opera */
    }

    .centered-container {
        display: -webkit-box; /* OLD - iOS 6-, Safari 3.1-6, BB7 */
        display: -ms-flexbox; /* TWEENER - IE 10 */
        display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
        display: flex; /* NEW, Spec - Firefox, Chrome, Opera */

        justify-content: center;
        align-items: center;
    }


    .titlecolumn th {
        background: #6b64646b;
        white-space: nowrap;
        text-align: right;
        font-weight: bold;
        /*width: 5%;*/
    }
</style>

<script type="text/javascript">
    var current_url = window.location.href;
    (function (window, undefined) {
        if (typeof History != undefined) {
            History.Adapter.bind(window, 'statechange', function () { // Note: We are using statechange instead of popstate
                var State = History.getState(); // Note: We are using History.getState() instead of event.state
                if (State.url != current_url) {
                    ajaxLoad(State.url);
                }
            });
        }


    })(window);
    var form = null;
    jQuery(document).on('click', '.is-invalid', function () {
        $(this).removeClass("is-invalid");
        $(this).closest(".invalid-feedback").remove();
    });
    jQuery(document).on('change', '.is-invalid', function () {
        $(this).removeClass("is-invalid");
        $(this).closest(".invalid-feedback").remove();
    });
    jQuery(document).on('click', '.form-group', function () {
        $(this).find('.help-block').remove();
        $(this).closest(".form-group").removeClass('is-invalid');
    });
    jQuery(document).on('click', '.form-control', function () {
        $(this).find('.help-block').remove();
        $(this).closest(".form-group").removeClass('is-invalid');
    });
    jQuery(document).on('click', '.clear-form', function () {
        resetForm('model_form_id');
    });
    jQuery(document).on('click', '.load-page', function () {
        // closeSidebar();
        $(".system-container").html('<img style="height:120px !important;" class="centered" src="{{ url("img/Ripple.gif") }}"/>');
        $(".modal-backdrop").remove();
        $('.page-header-title').empty();
        $('.breadcrumb').empty();
        jQuery(".active").removeClass("active");
        jQuery(".loading-img").show();
        jQuery(".sb-site-container").trigger('click');
        jQuery(".profile-info").slideUp();
        var url = $(this).attr('href');
        $(this).closest('a').addClass("active");
        var status = 0;
        var material_active = $('input[name="material_page_loaded"]').val();
        if (!material_active) {
            window.location.href = url;
        }
        $.get(url, null)
            .done(function (response) {

                jQuery(".loading-img").hide();
                current_url = url;
                if (response.redirect) {
                    if (material_active == 1) {
                        setTimeout(function () {
                            ajaxLoad(response.redirect);
                        }, 1300);
                    } else {
                        window.location.href = response.redirect;
                    }

                }
                $(".system-container").html(response);
                var title = $(".system-title").html();
                History.pushState({state: 1}, title, url);
                prepareAjaxUpload();
                return false;
            })
            .fail(function (response) {
                window.location.href = url;
            });
        return false;

    });

    function gotoBottom(id) {
        var element = document.getElementById(id);
        if (element) {
            element.scrollTop = element.scrollHeight - element.clientHeight;
        }
    }

    function date_time(id) {
        @if(@Auth::user()->timezone)
            date = new Date('{{  \Carbon\Carbon::now(request()->user()->timezone)->toDateTimeString() }}');
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sun', 'Mon', 'Tue', 'Wed', 'Thurs', 'Fri', 'Sat');
        h = date.getHours();
        if (h < 10) {
            h = "0" + h;
        }
        m = date.getMinutes();
        if (m < 10) {
            m = "0" + m;
        }
        s = date.getSeconds();
        if (s < 10) {
            s = "0" + s;
        }
        result = '' + days[day] + ' ' + months[month] + ' ' + d + ' ' + year + ' ' + h + ':' + m + ':' + s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("' + id + '");', '1000');
        return true;
        @endif
    }

    jQuery(document).on('submit', '.ajax-post', function () {
        var form = $(this);
        var btn = form.find(".submit-btn");
        btn.prepend('<img class="processing-submit-image" style="height: 50px;margin:-10px !important;" src="{{ url("img/Ripple.gif") }}">');
        btn.attr('disabled', true);
//        showLoading();
        this.form = form;
        $(".fg-line").removeClass('has-error');
        var url = $(this).attr('action');
        var data = $(this).serialize();
        var material_active = $('input[name="material_page_loaded"]').val();

        $.post(url, data).done(function (response, status) {
            // $(".q-view").removeClass("active");
            $('.btn-close').trigger('click')

            var btn = form.find(".submit-btn");
            btn.find('img').remove();
            btn.attr('disabled', false);
            endLoading(response);
            removeError();
            if (response.call_back) {
                window[response.call_back](response);
                return false;
            }
            if (response.redirect) {
                if (material_active == 1) {
                    setTimeout(function () {
                        var s_class = undefined;
                        var params = getQueryParams(response.redirect);
                        if (params.ta_optimized) {
                            s_class = 'bootstrap_table';
                        } else if (params.t_optimized) {
                            s_class = 'ajax_tab_content';
                        }
                        ajaxLoad(response.redirect, s_class);
                    }, 1300);
                } else {
                    window.location.href = response.redirect;
                }

            } else if (response.force_redirect) {
                setTimeout(function () {
                    window.location.href = response.force_redirect;
                }, 1300);
            } else {
                let current_url = '{{ url()->current() }}';
                try {
                    return runAfterSubmit(response);
                } catch (err) {
                    setTimeout(function () {
                        // window.location.href = current_url;
                    }, 1300);
                }
            }
        })
            .fail(function (xhr, status, error) {
                var btn = form.find(".submit-btn");
                btn.find('img').remove();
                btn.attr('disabled', false);
                if (xhr.status == 422) {
                    form.find('.alert_status').remove();
                    var response = JSON.parse(xhr.responseText).errors;
                    for (field in response) {
                        form.find("input[name='" + field + "']").addClass('is-invalid');
                        form.find("input[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        form.find("input[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                        form.find("select[name='" + field + "']").addClass('is-invalid');
                        form.find("select[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        form.find("select[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                        form.find("textarea[name='" + field + "']").addClass('is-invalid');
                        form.find("textarea[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        form.find("textarea[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');
                    }

                    jQuery(".invalid-feedback").css('display', 'block');
                } else if (xhr.status == 406) {
                    form.find('#form-exception').remove();
                    form.find('.alert_status').remove();
                    form.prepend('<div id="form-exception" class="alert alert-warning"><strong>' + xhr.status + '</strong> ' + error + '<br/>' + JSON.parse(xhr.responseText) + '</div>');
                    // removeError();
                } else {
                    form.find('#form-exception').remove();
                    form.find('.alert_status').remove();
                    form.prepend('<div id="form-exception" class="alert alert-danger"><strong>' + xhr.status + '</strong> ' + error + '<br/>(' + url + ')</div>');
                    // removeError();
                }

            });
        return false;
    });

    function getQueryParams(qs) {
        qs = qs.split('+').join(' ');

        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
        }

        return params;
    }

    function ajaxLoad(url, s_class, active_tab) {
        if (s_class) {
            $("." + s_class).removeClass('centered-container');
            $("." + s_class).addClass('centered-container');
            $("." + s_class).html('<img style="height:120px !important;" class="centered" src="{{ url("img/Ripple.gif") }}"/>');
        }
        jQuery(".loading-img").show();
        var material_active = $('input[name="material_page_loaded"]').val();
        if (!material_active) {
            window.location.href = url;
        }
        if (active_tab) {
            setActiveTab(active_tab);
        }
        $.get(url, null, function (response) {
//                return false;

            jQuery(".loading-img").hide();
            if (s_class) {
                $("." + s_class).html(response);
                $("." + s_class).removeClass('centered-container');
            } else {
                $(".system-container").html(response);
            }
            current_url = url;
            if (response.redirect) {
                if (material_active == 1) {
                    setTimeout(function () {
                        ajaxLoad(response.redirect);
                    }, 1300);
                } else {
                    window.location.href = response.redirect;
                }

            }
            var title = $(".system-title").html();
            url = url.replace('optimized', 'tab_optmized');
            if (active_tab) {
                History.pushState({state: 1}, title, url);
                return false;
            }
            if (!s_class) {
                History.pushState({state: 1}, title, url);
            } else {
                $("." + s_class).removeClass('centered-container');
                return false;
            }
        });
        prepareAjaxUpload();
        autoFillAllSelects();
        return false;
    }

    function closeSidebar() {

        $("body").removeClass("sidebar-toggled"), $(".ma-backdrop").remove(), $(".sidebar, .ma-trigger").removeClass("toggled");

    }

    function setActiveTab(tab) {
        // alert(tab);
        jQuery(".auto-tab").removeClass('active');
        jQuery("." + tab).addClass('active');
    }

    function softError(element, reponse) {

    }

    function removeError() {
        setTimeout(function () {
            $("#form-exception").fadeOut();
            $("#form-success").fadeOut();
            $(".alert_status").fadeOut();
        }, 1200);

    }

    function resetField(field, placeholder) {
        setTimeout(function () {
            $("input[name='" + field + "']").attr('placeholder', placeholder);
            // $("input[name='"+field+"']").closest('fg-line').removeClass('has-error');
        }, 1300);
    }

    function hardError(element, response) {

    }

    function validationErrors(form, errors) {
        for (field in errors) {
            alert(errors[field]);
        }
    }

    function showLoading() {
        $(".alert_status").remove();
        $('.ajax-post').not(".persistent-modal .modal-body").prepend('<div id="" class="alert alert-success alert_status"><img style="" class="loading_img" src="{{ URL::to("img/ajax-loader.gif") }}"></div>');
    }

    function endLoading(data) {
        $(".alert_status").html('Success!');
        setTimeout(function () {


            if (data.id) {

            } else {
                $(".modal").not(".persistent-modal").modal('hide');
            }
            $(".alert_status").slideUp();
//            $("#principal_file_modal").modal('show');
        }, 800);
    }


    function autofillForm(data) {
        for (key in data) {
            var in_type = $('input[name="' + key + '"]').attr('type');
            if (in_type != 'file') {
                $('input[name="' + key + '"]').val(data[key]);
                $('input[name="' + key + '"]').click();
                $('textarea[name="' + key + '"]').val(data[key]);
                $('textarea[name="' + key + '"]').click();
                $('select[name="' + key + '"]').val(data[key]);
                $('select[name="' + key + '"]').click();
            }
        }
        jQuery("input[name='id']").val(data['id']);
    }

    jQuery(document).on('click', '.delete-btn', function () {
        var url = $(this).attr('href');
        deleteItem(url, null);
        return false;
    });

    function deleteItem(url, id, model) {
//        $("#delete_modal").modal('show');
        $("input[name='delete_id']").val(id);
        $("input[name='delete_model']").val(model);
        $("#delete_form").attr('action', url);
        if (id)
            $("#delete_form").attr('action', url + '/' + id);

        swal({
            title: "Are you sure?",
            text: "A deleted Item can never be recovered!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var url = $("#delete_form").attr('action');
                var data = $("#delete_form").serialize();
                $.post(url, data)
                    .done(function (response) {
                        swal("Deleted!", "Item Deleted Successfully", "success");
                        if (response.redirect) {
                            setTimeout(function () {
                                ajaxLoad(response.redirect);
                            }, 1300);

                        } else {
                            runAfterSubmit(response, url);
                        }
                    })
                    .fail(function (xhr, status, response) {
                        swal("Error!", response, "error");
                    });

            } else {
                swal("Cancelled", "Your Item is safe :)", "error");
            }
        });

    }

    function runSilentAction(url) {
        $("#run_action_form").attr('action', url);
        var url = $("#run_action_form").attr('action');
        var data = $("#run_action_form").serialize();
        $.post(url, data)
            .done(function (response) {
                if (response.redirect) {
                    setTimeout(function () {
                        ajaxLoad(response.redirect);
                    }, 0);

                } else if (response == 0) {
                    //do nothing
                } else {
                    try {
                        return runAfterSubmit(response);
                    } catch (err) {
                        //ignore
                    }
                }
            })
            .fail(function (xhr, status, response) {
                alert(response);
            });
    }

    function runPlainRequest(url, id, message) {

        if (id != undefined && id != 0) {
            url = url + '/' + id;
        }
        $("input[name='action_element_id']").val(id);
        $("#run_action_form").attr('action', url);

        $("#run_action_form").attr('action', url);
        if (id) {
            // $("#run_action_form").attr('action', url + '/' + id);
        }

        swal({
            title: "Are you sure?",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32c787",
            confirmButtonText: "Yes, Proceed!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var url = $("#run_action_form").attr('action');
                var data = $("#run_action_form").serialize();
                $.post(url, data)
                    .done(function (response) {
                        if (response.redirect) {
                            swal("Success!", "Action Completed Successfully", "success");
                            setTimeout(function () {
                                ajaxLoad(response.redirect);
                            }, 1300);

                        } else {
                            // swal("Success!", response, "success");
//                            runAfterSubmit(response);
                        }
                    })
                    .fail(function (xhr, status, response) {
                        if (response == 'Not Acceptable') {
                            swal('Error!', xhr.responseText, 'error');
                        } else {
                            swal("Error!", response, "error");
                        }

                    });

            } else {
                swal("Cancelled", "Action Cancelled by user", "error");
            }
        });
    }

    function runCustomPlainRequest(url, buttonID) {

        let title = $('#'+buttonID).data('title')? $('#'+buttonID).data('title') : 'Are you Sure?';
        $("#run_action_form").attr('action', url);

        swal({
            title: title,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#32c787",
            confirmButtonText: "Yes, Proceed!",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm:true,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                var url = $("#run_action_form").attr('action');
                var data = $("#run_action_form").serialize();
                $.post(url, data)
                    .done(function (response) {
                        // console.log('response from server is')
                        // console.log(response);

                        if (response.status) {
                            // swal("Success!", "Action Completed Successfully", "success");
                            setTimeout(function () {
                                swal.close();
                            }, 1000)
                            setTimeout(function () {

                                ajaxLoad(response.redirect);
                            }, 1600);
                            swal("Success!", "Action Completed Successfully", "success");

                            // ajaxLoad(response.redirect);
                        } else {
                            swal("Success!", "Action Completed Successfully", "success");
//                            runAfterSubmit(response);
                        }
                    })
                    .fail(function (xhr, status, response) {
                        if (response == 'Not Acceptable') {
                            swal('Error!', xhr.responseText, 'error');
                        } else {
                            swal("Error!", response, "error");
                        }

                    });

            } else {
                swal("Cancelled", "Action Cancelled by user", "error");
            }
        });
    }


    function reloadCsrf() {
    }

    function getEditItem(url, id, modal) {
        var url = url + '/' + id;
        $.get(url, null, function (response) {
            autofillForm(response);
            $("#" + modal).modal('show');
        });
    }

    function resetForm(id) {
        $("." + id).find("input[type=text],textarea,select").val("");
        $("input[name='id']").val('');
//        runAfterReset();
    }

    function autoFillSelectMultiple(id, url, function_call) {
        $("#"+id).html('<option value="">Please Select</option>');
        console.log('response is');
        $.get(url, null, function (response) {
            new Choices("#"+id, {removeItemButton: !0, choices: response}, );

            if (function_call) {
                window[function_call]();
            }

        });
    }

    function autoFillSelect(name, url, function_call) {
        $("select[name='" + name + "']").removeClass("is-invalid");
        $("select[name='" + name + "']").html('<option value="">Please Select</option>');


        $.get(url, null, function (response) {


            for (var i = 0; i < response.length; i++) {

                if (response[i].name) {
                    $("select[name='" + name + "']").append('<option value="' + response[i].id + '">' + response[i].name + '</option>');
                }
                if (response[i].label) {
                    $("select[name='" + name + "']").append('<option value="' + response[i].id + '">' + response[i].label + '</option>');
                }
                if (response[i].period) {
                    $("select[name='" + name + "' ]").append('<option rate="' + response[i].rate + '" value="' + response[i].id + '">' + response[i].period + ' days at ' + response[i].rate + ' % rate </option>');
                }


            }
            if (function_call) {
                window[function_call]();
            }
            jQuery('select[name="' + name + ']').attr('class', 'form-group select2');

            if (response.length > 20) {

                jQuery('select[name="' + name + ']').attr('class', 'form-group chosen-select');
                setTimeout(function () {
                    // $(".chosen-select").chosen({disable_search_threshold: 10});
                    // $(".chosen-select").trigger("chosen:updated");
                    // $(".chosen-container").width('100%');
                }, 1000)
            }
        });
    }

   // $(function (){
       $('.select2').select2({
           placeholder: 'Select an option'
       });
   // })

    function setSelectData(name, data, first_null) {
//        $("select[name='"+name+"']").html('');
        if (first_null) {
            $("select[name='" + name + "']").html('<option value=""></option>');

        }

        for (var i = 0; i < data.length; i++) {
            if (data[i].name) {
                $("select[name='" + name + "']").append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }

        }
        setTimeout(function () {
            $(".chosen-select").chosen({disable_search_threshold: 10});
            $(".chosen-select").trigger("chosen:updated");
            $(".chosen-container").width('100%');
        }, 20)

    }

    function prepareEdit(element, modal) {
        var data = $(element).data('model');

        autofillForm(data);
        $("#" + modal).modal('show');
    }

    function prepareOverlayModalEdit(element, modal) {
        var data = $(element).data('model');
        autofillForm(data);
    }

    function setAutoComplete(name, url) {
        var formatted = [];
        $.get(url, null, function (response) {
            for (var i = 0; i < response.length; i++) {
                var single = {value: response[i].name, data: response[i].name};
                formatted.push(single);
            }
            $("input[name='" + name + "']").autocomplete({
                lookup: formatted
            });
        });
    }


    $(document).ready(function () {
        // $('input[name="date_added"]').datetimepicker({
        //     timepicker: false
        // });


        prepareAjaxUpload();
        // $('input[name="date_to"]').datetimepicker();

    });


    function krajeeFileUpload(inputId,browseLabel,uploadUrl){
        let self = this;
        $("#"+inputId).fileinput({
            theme: 'fas',
            uploadUrl: uploadUrl,
            showCaption: false,
            showRemove:false,
            overwriteInitial: false,
            initialPreviewAsData: true,
            browseLabel: browseLabel,
            dropZoneEnabled: false,
            showUpload: false, // hide upload button
            previewFileIcon:'<i class="fas fa-file"></i>',
            maxFileCount: 10,
        });
    }

    function prepareAjaxUpload() {
        $('input[name="date_added"]').datetimepicker({
            timepicker: false
        });
        // $('input[name="date_to"]').datetimepicker();
        // $('input[name="date_to"]').datetimepicker();
        var form_url = $(".file-form").attr('action');
        var options = {
            target: '#output1',   // target element(s) to be updated with server response
            beforeSubmit: showRequest,  // pre-submit callback
            success: fileUploadFinish,  // post-submit callback
            dataType: 'json',
            error: endWithError

        };
        autoFillAllSelects();
        $('.file-form').ajaxForm(options);
    }

    // pre-submit callback
    function showRequest(formData, jqForm, options) {
        var btn = jqForm.find(".submit-btn");
        btn.prepend('<img class="processing-submit-image" style="height: 50px;margin:-10px !important;" src="{{ url("img/Ripple.gif") }}">');
        btn.attr('disabled', true);
        $(".alert_status").remove();
        $('.file-form').prepend('<div id="" class="alert alert-success alert_status"><img style="" class="loading_img" src="{{ URL::to("img/ajax-loader.gif") }}"></div>');
    }

    function fileUploadFinish(response, status, xhr, jqForm) {
        var btn = jqForm.find(".submit-btn");
        btn.find('img').remove();
        btn.attr('disabled', false);
        if (response.call_back) {
            endLoading();
            window[response.call_back](response);
            return false;
        }
        if (response.id || response.image) {
            $(".alert_status").remove();
            endLoading();
            runAfterSubmit(response);
        } else if (response.redirect) {
            endLoading(response);
            setTimeout(function () {
                ajaxLoad(response.redirect);
            }, 1300);

        } else {
            endWithMinorErrors(response);
        }
    }

    function endWithError(xhr, tetet, error, jqForm) {
        var btn = jqForm.find(".submit-btn");
        btn.find('img').remove();
        btn.attr('disabled', false);
        var error = xhr.statusText;
        response = xhr.responseText;
        response = JSON.parse(response).errors;
        if (xhr.status == 422) {
            $('.alert_status').remove();
            for (field in response) {
                $("input[name='" + field + "']").addClass('is-invalid');
                $("input[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                $("input[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                $("select[name='" + field + "']").addClass('is-invalid');
                $("select[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                $("select[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                $("textarea[name='" + field + "']").addClass('is-invalid');
                $("textarea[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                $("textarea[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

            }
        } else {
            $(".alert_status").remove();
            $('.file-form').prepend('<div id="" class="alert alert-danger alert_status"><strong>' + xhr.status + '</strong> ' + error + '</div>');
            removeError();
        }
    }

    jQuery(document).ready(function () {
        $("input[name='start_time']").attr('data-mask', '00:00:00');
        $("input[name='start_time']").addClass('input-mask');
        setInterval(function () {
        }, 30000);

    });

    function autoFillAllSelects() {
        var url = '{{ url(@Auth::user()->role.'/'.'autofill/data') }}';
        var data = [];
        $(".auto-fetch-select").each(function () {
            data.push($(this).attr('name') + ':' + $(this).data("model"));
        });
        if (data.length > 0) {
            $.get(url, {models: data}, function (response) {
                for (key in response) {
                    setSelectData(key, response[key]);
                }
            });
        }
    }

    function deleteModel(id, model) {
        var url = '{{ url(@Auth::user()->role.'/'.'delete/model') }}';
        return deleteItem(url, id, model);

    }

    @if(Auth::user())
    function loadTemplate(fn, data, id) {
        var url = '{{ url(Auth::user()->role) }}/templates/' + fn;
        $.get(url, data, function (response) {
            $("#" + id).html(response);
        });
    }

    @endif
    function loadGeneralTemplate(fn, data, id) {
        var url = '{{ url("general/templates") }}/' + fn;
        $.get(url, data, function (response) {
            $("#" + id).html(response);
        });
    }

    $(document).ready(function () {
        var url = window.location.href;
        prepareAjaxUpload();

        // ajaxLoad(url);
    });

    function validateRemote(form_class, url) {
        var data = $("." + form_class).serialize();
        $.post(url, data).done(function (response, status) {
            return true;
        })
            .fail(function (xhr, status, error) {
                if (xhr.status == 422) {
                    var response = JSON.parse(xhr.responseText).errors;
                    for (field in response) {
                        $("input[name='" + field + "']").addClass('is-invalid');
                        $("input[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        $("input[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                        $("select[name='" + field + "']").addClass('is-invalid');
                        $("select[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        $("select[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');

                        $("textarea[name='" + field + "']").addClass('is-invalid');
                        $("textarea[name='" + field + "']").closest(".form-group").find('.help-block').remove();
                        $("textarea[name='" + field + "']").closest(".form-group").append('<small class="help-block invalid-feedback">' + response[field] + '</small>');
                    }
                }
            });
        return false;
    }

    function getTabCounts(url, data) {
        $.get(url, data, function (response) {
            for (key in response) {
                // $(".tab_" + key).append('&nbsp;<span class="badge badge-info">' + response[key] + '</span>')
                $(".tab_badge_" + key).html('<sup class="him-counts">' + response[key] + '</sup>')
            }
        });
    }

    //array is the set of menu-label passed as slug you want to display count
    function setMenuCount(url, array) {
        $.get(url, function (response) {
            for (arr in array) {
                var element = array[arr];
                if (parseFloat(response[element]) > 0) {
                    $('.menu_item_' + element).empty().append('<span style="height: 25px; width: 25px; text-align: center; padding: 3px; background-color: dimgrey; color: white" class="rounded-circle btn btn-sm">' + response[element] + '</span>');
                }

            }
        });
    }

    function time_ago(time) {

        switch (typeof time) {
            case 'number':
                break;
            case 'string':
                time = +new Date(time);
                break;
            case 'object':
                if (time.constructor === Date) time = time.getTime();
                break;
            default:
                time = +new Date();
        }
        var time_formats = [
            [60, 'seconds', 1], // 60
            [120, '1 minute ago', '1 minute from now'], // 60*2
            [3600, 'minutes', 60], // 60*60, 60
            [7200, '1 hour ago', '1 hour from now'], // 60*60*2
            [86400, 'hours', 3600], // 60*60*24, 60*60
            [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
            [604800, 'days', 86400], // 60*60*24*7, 60*60*24
            [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
            [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
            [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
            [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
            [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
            [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
            [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
            [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
        ];
        var seconds = (+new Date() - time) / 1000,
            token = 'ago',
            list_choice = 1;

        if (seconds == 0) {
            return 'Just now'
        }
        if (seconds < 0) {
            seconds = Math.abs(seconds);
            token = 'from now';
            list_choice = 2;
        }
        var i = 0,
            format;
        while (format = time_formats[i++])
            if (seconds < format[0]) {
                if (typeof format[2] == 'string')
                    return format[list_choice];
                else
                    return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
            }
        return time;
    }

    $(document).ready(function () {
        toastr.options = {
            "positionClass": "toast-bottom-right",
        }
        @if($notice = request()->session()->get('notice'))
        @if($notice['type'] == 'warning')
        toastr.warning('{{ $notice['message'] }}');
        @elseif($notice['type'] == 'info')
        toastr.info('{{ $notice['message'] }}');
        @elseif($notice['type'] == 'error')
        toastr.error('{{ $notice['message'] }}');
        @elseif($notice['type'] == 'success')
        toastr.success('{{ $notice['message'] }}');
        @endif
        @endif
    });
    function loadDropZone(input_id, upload_url, showPreview=true, dropZoneEnabled=true,hideThumbnailContent=false, showDrag=true) {
        $('#'+input_id).fileinput({
            theme: 'fas',
            initialCaption: 'No file selected',
            allowedFileExtensions: ['jpg','jpeg', 'png', 'gif', 'pdf', 'xls', 'csv', 'doc', 'docx', 'xlsx'],
            uploadUrl: upload_url,
            autoReplace: true,
            uploadAsync: false,
            showCancel: false,
            showRemove: false,
            showClose: false,
            showUpload: false,
            showDrag: false,
            maxFileCount: 5,
            browseOnZoneClick: true,
            showPreview: showPreview,
            dropZoneEnabled:dropZoneEnabled,
            hideThumbnailContent: hideThumbnailContent,
            initialPreviewAsData: true,
            overwriteInitial: false,
            previewFileIcon: '<i class="fas fa-file"></i>',
            allowedPreviewTypes: ['image', 'pdf', 'text'],
            previewFileIconSettings: {
                'docx': '<i class="fas fa-file-word text-primary"></i>',
                'xlsx': '<i class="fas fa-file-excel text-success"></i>',
                'pptx': '<i class="fas fa-file-powerpoint text-danger"></i>',
                'jpg': '<i class="fas fa-file-image text-warning"></i>',
                'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
                'zip': '<i class="fas fa-file-archive text-muted"></i>',
            },
            fileActionSettings: {
                showDrag:false,
            },
        }).on("filebatchselected", function (event, files) {
            $('#' + input_id).fileinput("upload");
        });

    }
    function loadSummerNote(field_id, height=150, placeholder="Please type..."){
        $('#'+field_id).summernote({
            placeholder: placeholder,
            spellCheck: true,
            tabsize: 2,
            height: height,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    }

</script>

<script>
    $(document).ready(function () {
        // if (window.url + '/admin/settings/config' !== window.location.href) {
        //     $('#secondary-sidebar').html('');
        //     $('#secondary-sidebar').removeClass('sidebar sidebar-light sidebar-secondary sidebar-expand-md');
        // }
        @if($notice = request()->session()->get('sweet_alert'))
        swal('{{ $notice['title'] }}', '{{ $notice['message'] }}', '{{ $notice['type']}}');
        @endif
    });
</script>
<style type="text/css">
    .delete {
        color: red;
    }
</style>
<style>
    .him-counts {
        /*position: absolute;*/
        display: inline-block;
        vertical-align: baseline;
        font-style: normal;
        background: #03A9F4;
        padding: 1px 5px;
        border-radius: 2px;
        right: 4px;
        top: -11px;
        color: #FFF;
        font-size: 10px;
        line-height: 15px;
    }
</style>
