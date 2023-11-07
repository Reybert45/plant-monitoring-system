var token = $("meta[name='csrf-token']").attr("content");
$(document).ready(function() {
    getUserList();

    $(".reset-btn").click(function() {
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
    });
    $("#add-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);
        var username = $("#createForm").find("input[name='username'").val();
        var email = $("#createForm").find("input[name='email'").val();
        var first_name = $("#createForm").find("input[name='first_name'").val();
        var middle_name = $("#createForm").find("input[name='middle_name'").val();
        var last_name = $("#createForm").find("input[name='last_name'").val();
        var suffix_id = $("#createForm").find("select[name='suffix_id'").val();
        var gender_id = $("#createForm").find("select[name='gender_id'").val();
        var birthdate = $("#createForm").find("input[name='birthdate'").val();
        var password = $("#createForm").find("input[name='password'").val();
        var confirm_password = $("#createForm").find("input[name='confirm_password'").val();

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.ajax({
            url: '../user/store',
            type: "POST",
            data: {
                username: username,
                email: email,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                suffix_id: suffix_id,
                gender_id: gender_id,
                birthdate: birthdate,
                password: password,
                confirm_password: confirm_password,
                current_address: {
                    street_id: $("#createForm").find("#current_address select[name='street_id']").val(),
                    barangay_id: $("#createForm").find("#current_address select[name='barangay_id']").val(),
                    region_id: $("#createForm").find("#current_address select[name='region_id']").val(),
                    city_id: $("#createForm").find("#current_address select[name='city_id']").val(),
                    province_id: $("#createForm").find("#current_address select[name='province_id']").val(),
                    zipcode_id: $("#createForm").find("#current_address select[name='zipcode_id']").val(),
                },
                permanent_address: {
                    street_id: $("#createForm").find("#permanent_address select[name='street_id']").val(),
                    barangay_id: $("#createForm").find("#permanent_address select[name='barangay_id']").val(),
                    region_id: $("#createForm").find("#permanent_address select[name='region_id']").val(),
                    city_id: $("#createForm").find("#permanent_address select[name='city_id']").val(),
                    province_id: $("#createForm").find("#permanent_address select[name='province_id']").val(),
                    zipcode_id: $("#createForm").find("#permanent_address select[name='zipcode_id']").val(),
                },
                _token: token   
            }
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    $("#edit-btn").click(function() {
        var html = $(this).html();
        var btn = $(this);
        var id = $(this).data('id');
        var username = $("#editForm").find("input[name='username'").val();
        var email = $("#editForm").find("input[name='email'").val();
        var first_name = $("#editForm").find("input[name='first_name'").val();
        var middle_name = $("#editForm").find("input[name='middle_name'").val();
        var last_name = $("#editForm").find("input[name='last_name'").val();
        var suffix_id = $("#editForm").find("select[name='suffix_id'").val();
        var gender_id = $("#editForm").find("select[name='gender_id'").val();
        var birthdate = $("#editForm").find("input[name='birthdate'").val();
        var password = $("#editForm").find("input[name='password'").val();
        var confirm_password = $("#editForm").find("input[name='confirm_password'").val();
        var is_active = $("#editForm").find("select[name='is_active'").val();

        $(this).prop("disabled", true);
        $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

        $.ajax({
            url: '../user/update',
            type: "POST",
            data: {
                id: id,
                username: username,
                email: email,
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                suffix_id: suffix_id,
                gender_id: gender_id,
                birthdate: birthdate,
                password: password,
                confirm_password: confirm_password,
                is_active: is_active,
                current_address: {
                    street_id: $("#editForm").find("#current_address select[name='street_id']").val(),
                    barangay_id: $("#editForm").find("#current_address select[name='barangay_id']").val(),
                    region_id: $("#editForm").find("#current_address select[name='region_id']").val(),
                    city_id: $("#editForm").find("#current_address select[name='city_id']").val(),
                    province_id: $("#editForm").find("#current_address select[name='province_id']").val(),
                    zipcode_id: $("#editForm").find("#current_address select[name='zipcode_id']").val(),
                },
                permanent_address: {
                    street_id: $("#editForm").find("#permanent_address select[name='street_id']").val(),
                    barangay_id: $("#editForm").find("#permanent_address select[name='barangay_id']").val(),
                    region_id: $("#editForm").find("#permanent_address select[name='region_id']").val(),
                    city_id: $("#editForm").find("#permanent_address select[name='city_id']").val(),
                    province_id: $("#editForm").find("#permanent_address select[name='province_id']").val(),
                    zipcode_id: $("#editForm").find("#permanent_address select[name='zipcode_id']").val(),
                },
                _token: token
            }
        }).then(function(res) {
            iziToastAlert(res, btn, html);
        });
    });

    var address_statuses_list = ["#current_address","#permanent_address"];
    $.map(address_statuses_list, function(address_status) {
        $(address_status).find("select[name='street_id'").change(function() {
            var id = $(this).val();

            $(address_status).find("select[name='barangay_id'").val('');
            $.map($(address_status).find("select[name='barangay_id'] option"), function(option) {
                var street_id = $(option).data('street_id');
                    if($(option).val() != "") {
                    $(option).prop("hidden", true);
                }

                if(id == street_id) {
                    $(option).prop("hidden", false);
                }
            });
        });
        
        $(address_status).find("select[name='barangay_id'").change(function() {
            var id = $(this).val();

            $(address_status).find("select[name='region_id'").val('');
            $.map($(address_status).find("select[name='region_id'] option"), function(option) {
                var barangay_id = $(option).data('barangay_id');
                    if($(option).val() != "") {
                    $(option).prop("hidden", true);
                }

                if(id == barangay_id) {
                    $(option).prop("hidden", false);
                }
            });
        });
        
        $(address_status).find("select[name='region_id'").change(function() {
            var id = $(this).val();

            $(address_status).find("select[name='city_id'").val('');
            $.map($(address_status).find("select[name='city_id'] option"), function(option) {
                var region_id = $(option).data('region_id');
                    if($(option).val() != "") {
                    $(option).prop("hidden", true);
                }

                if(id == region_id) {
                    $(option).prop("hidden", false);
                }
            });
        });
        
        $(address_status).find("select[name='city_id'").change(function() {
            var id = $(this).val();

            $(address_status).find("select[name='province_id'").val('');
            $.map($(address_status).find("select[name='province_id'] option"), function(option) {
                var city_id = $(option).data('city_id');
                    if($(option).val() != "") {
                    $(option).prop("hidden", true);
                }

                if(id == city_id) {
                    $(option).prop("hidden", false);
                }
            });
        });

        $(address_status).find("select[name='province_id'").change(function() {
            var id = $(this).val();

            $(address_status).find("select[name='zipcode_id'").val('');
            $.map($(address_status).find("select[name='zipcode_id'] option"), function(option) {
                var province_id = $(option).data('province_id');
                    if($(option).val() != "") {
                    $(option).prop("hidden", true);
                }

                if(id == province_id) {
                    $(option).prop("hidden", false);
                }
            });
        });
        
    });
});

function getUserList() 
{
    $.get("../user/data").then(function(data) {
        $("#data-container").html(data);
    });
}

$("#data-container").on("click", ".delete-btn", function() {
    var id = $(this).data('id');
    var html = $(this).html();
    var btn = $(this);

    $(this).prop("disabled", true);
    $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');

    $.post("../user/delete?_token="+ token + "&id=" + id).then(function(res) {
        iziToastAlert(res, btn, html);
    });
});

$("#editUser").on("shown.bs.modal", function(e) {
    let btn = $(e.relatedTarget);
    let user = JSON.parse(atob(btn.data('user')));
    
    $("#editForm").trigger("reset");
    $("#edit-btn").attr("data-id", btn.data('id'));
    $("#editForm").find("input[name='username']").val(user.username);
    $("#editForm").find("input[name='email']").val(user.email);
    $("#editForm").find("input[name='first_name']").val(user.first_name);
    $("#editForm").find("input[name='middle_name']").val(user.middle_name);
    $("#editForm").find("input[name='last_name']").val(user.last_name);
    $("#editForm").find("input[name='birthdate']").val(user.birthdate);
    $("#editForm").find("select[name='suffix_id']").val(user.suffix_id);
    $("#editForm").find("select[name='gender_id']").val(user.gender_id);
    $("#editForm").find("select[name='is_active']").val(user.is_active);
    $("#editForm").find("#current_address select[name='street_id']").val(user.current_address_street_id);
    $("#editForm").find("#current_address select[name='barangay_id']").val(user.current_address_barangay_id);
    $("#editForm").find("#current_address select[name='region_id']").val(user.current_address_region_id);
    $("#editForm").find("#current_address select[name='city_id']").val(user.current_address_city_id);
    $("#editForm").find("#current_address select[name='province_id']").val(user.current_address_province_id);
    $("#editForm").find("#current_address select[name='zipcode_id']").val(user.current_address_zipcode_id);

    $("#editForm").find("#permanent_address select[name='street_id']").val(user.permanent_address_street_id);
    $("#editForm").find("#permanent_address select[name='barangay_id']").val(user.permanent_address_barangay_id);
    $("#editForm").find("#permanent_address select[name='region_id']").val(user.permanent_address_region_id);
    $("#editForm").find("#permanent_address select[name='city_id']").val(user.permanent_address_city_id);
    $("#editForm").find("#permanent_address select[name='province_id']").val(user.permanent_address_province_id);
    $("#editForm").find("#permanent_address select[name='zipcode_id']").val(user.permanent_address_zipcode_id);
});

function iziToastAlert(res, btn, html) {
    let iziToastAlertConf = {
        close: true,
        displayMode: 2,
        layout: 2,
        title: res.status,
        message: res.message,
        position: 'topRight',
        transitionIn: 'bounceInDown',
        transitionOut: 'flipOutX',
        onClosing: function() {
            $(btn).html(html);
            $(btn).prop("disabled", false);
            if (res.status == "Success") {
                getUserList();
            }
        },
        timeout: res.timeout,
    };

    if (res.status == "Success") {
        $("#createUser").modal("hide");
        $("#editUser").modal("hide");
        $("#createForm").trigger("reset");
        $("#editForm").trigger("reset");
        $(".span-error").empty();
        iziToast.success(iziToastAlertConf);
    } else {
        if(res.errors !== undefined) {
            $(".span-error").empty();
            $(btn).html(html);
            $(btn).prop("disabled", false);
            $.each(res.errors, function(index, object) {
                $("."+index.replace(".","_")+"-error").html('<span class="fa fa-exclamation-circle"></span> '+object[0]);
            });
        } else {
            iziToast.error(iziToastAlertConf);
        }
    }
}