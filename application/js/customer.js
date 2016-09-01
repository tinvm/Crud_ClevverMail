var save_method;
var table;

$(document).ready(function () {

    table = $('#table').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('customer/ajax_list')?>",
            "type": "POST"
        },

        "columnDefs": [
            {
                "targets": [-1],
                "orderable": false,
            },
        ],

    });

    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,
    });

    $("input").change(function () {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();
    });

    $("textarea").change(function () {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();
    });

    $("select").change(function () {

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();
    });

});


function add_customer() {
    save_method = 'add';

    $('#form')[0].reset();

    $('.form-group').removeClass('has-error');

    $('.help-block').empty();

    $('#modal_form').modal('show');

    $('.modal-title').text('Add Customer');
}

function edit_customer(id) {
    save_method = 'update';

    $('#form')[0].reset();

    $('.form-group').removeClass('has-error');

    $('.help-block').empty();

    $.ajax({
        url: "<?php echo site_url('customer/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

            $('[name="id"]').val(data.id);

            $('[name="firstName"]').val(data.name);

            $('[name="lastName"]').val(data.email);

            $('#modal_form').modal('show');

            $('.modal-title').text('Edit customer');

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax
}

function save() {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('customer/ajax_add')?>";
    } else {
        url = "<?php echo site_url('customer/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function (data) {

            if (data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable

        }
    });
}

function delete_customer(id) {
    if (confirm('Are you sure delete this data?')) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('customer/ajax_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });

    }
}