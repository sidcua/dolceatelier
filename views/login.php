
<!--Modal: Login Form-->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header pink darken-3 white-text">
                <h4 class="title" id="modallogintitle"><i class="fa fa-user"></i> Log in</h4>
                <button type="button" id="btnclose" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
                
                <div class="modal-body" id="loginmodalbody">
                    <p class="error" id="errormsglogin"></p>
                    <div class="md-form form-sm">
                        <i class="fa fa-envelope prefix"></i>
                        <input onKeyDown="if(event.keyCode==13)login();" type="email" id="loginemail" name="email" class="form-control">
                        <label for="loginemail">Email</label>
                    </div>

                    <div class="md-form form-sm">
                        <i class="fa fa-lock prefix"></i>
                        <input onKeyDown="if(event.keyCode==13)login();" type="password" id="loginpassword" name="password" class="form-control">
                        <label for="loginpassword">Password</label>
                    </div>
                    <div class="text-center mt-2">
                        <button onclick="login()" id="btnlogin" name="btnlogin" class="btn btn-pink ld-over-inverse">
                            <div class="ld ld-ring ld-spin"></div>
                            Log In
                        </button>
                    </div>

                </div>
            <!--Footer-->
            <div class="modal-footer">
                <div class="options text-center text-md-right mt-1">
                    <p>Not a member? <a href="#modalRegister" data-dismiss="modal" data-toggle="modal">Sign Up</a></p>
                    <p>Forgot <a class="blue-text" onclick="forgotpass()">Password?</a></p>
                </div>
                <button type="button"" class="btn btn-outline-pink waves-effect ml-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login Form-->
<script>
    function forgotpass(){
        $("#loginmodalbody").addClass("animated fadeOutLeft");
        var output = '<p class="error" id="errormsgforgotpass"></p>'+
                    '<p class="h6-responsive text-center">Note: We will send a verification link to  your email</p><br>'+
                        '<div class="md-form form-sm">' +
                        '<i class="fa fa-envelope prefix"></i>' +
                        '<input type="email" id="forgotemail" class="form-control">' +
                        '<label for="forgotemail">Email</label>' +
                    '</div>' +
                    '<div class="text-center mt-2">'+
                        '<button id="btnforgotpass" onclick="checkemail()" class="btn btn-pink ld-over-inverse">'+
                            '<div class="ld ld-ring ld-spin"></div>'+
                            'Verify'+
                        '</button>'+
                    '</div>';
        setTimeout(function(){
            $("#modallogintitle").html('<i class="fa fa-question-circle" aria-hidden="true"></i> Forgot Password');
            $("#loginmodalbody").removeClass("fadeOutLeft");
            $("#loginmodalbody").addClass("fadeInRight");
            $("#loginmodalbody").html(output);
        }, 300);
        setTimeout(function(){
            $("#loginmodalbody").removeClass("animated fadeInRight");
        }, 1200)
        
    }
</script>
