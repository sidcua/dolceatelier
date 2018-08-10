<!-- Modal: Register Form-->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header light-blue darken-3 white-text">
                <h4 class="title"><i class="fa fa-user-plus"></i> Register</h4>
                <button type="button" class="close waves-effect waves-light white-text" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
                <p class="error animated fadeInTop" id="errormsgreg"></p>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="md-form form-sm">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="email" name="email" class="form-control">
                                    <label for="email">Email</label>
                                </div>

                                <div class="md-form form-sm">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <label for="password">Password</label>
                                </div>

                                <div class="md-form form-sm">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="password2" name="password2" class="form-control">
                                    <label for="password2">Repeat password</label>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="md-form form-sm">
                                    <i class="fa fa-user prefix" aria-hidden="true"></i>
                                    <input type="text" id="name" name="name" class="form-control">
                                    <label for="name">Name</label>
                                </div>

                                <div class="md-form form-sm">
                                    <i class="fa fa-phone prefix" aria-hidden="true"></i>
                                    <input type="text" id="contact" name="contact" class="form-control">
                                    <label for="contact">Contact #</label>
                                </div>

                                <div class="md-form form-sm">
                                    <i class="fa fa-map prefix" aria-hidden="true"></i>
                                    <input type="text" id="address" name="address" class="form-control">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-info ld-over-inverse" id="btnregister" name="register">
                            <div class="ld ld-ring ld-spin"></div>
                            Submit
                        </button>
                    </div>
                </div>
                
            <!--Footer-->
            <div class="modal-footer">
                <div class="options text-center text-md-right mt-1 waves-effect">
                    <p>Already have an account? <a href="#modalLogin" data-dismiss="modal" data-toggle="modal">Log In</a></p>
                </div>
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<script>
</script>