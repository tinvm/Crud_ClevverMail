<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crud ClevverMail</title>

        <link href="<?php echo base_url('assets/bootstrap-3.3.7/css/bootstrap.min.css') ?>" rel="stylesheet">

        <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>" rel="stylesheet">

        <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') ?>" rel="stylesheet">

    </head>

    <body>

        <div class="container">

            <h3>Customer Data</h3>
            <br/>

            <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>

            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

            <br/>
            <br/>

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>

                        <th>Email</th>

                        <th>Created Date</th>

                        <th style="width:125px;">Action</th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>

        <!-- Create Form -->
        <div class="modal fade" id="modal_form" role="dialog">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h3 class="modal-title">Customer Form</h3>
                    </div>

                    <div class="modal-body form">

                        <form action="#" id="form" class="form-horizontal">

                            <input type="hidden" value="" name="id"/>

                            <div class="form-body">

                                <div class="form-group">

                                    <label class="control-label col-md-3">Name</label>

                                    <div class="col-md-9">

                                        <input name="name" placeholder="Name" class="form-control" type="text" required>

                                        <span class="help-block"></span>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="control-label col-md-3">Email</label>

                                    <div class="col-md-9">

                                        <input name="email" placeholder="Email" class="form-control" type="email" required>

                                        <span class="help-block"></span>

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="modal-footer">

                        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url('assets/jquery/jquery-3.1.0.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>

        <script src="<?php echo base_url('assets/bootstrap-datepicker-1.6.1/js/bootstrap-datepicker.min.js') ?>"></script>

        <script src="<?php echo base_url('js/customer.js') ?>"></script>


    </body>
</html>