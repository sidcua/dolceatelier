<?php 
    session_start();
    include '../php/connect.php';
    $_SESSION['adminpanel'] = "accounts";
?>
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeIn">
    <div class="card-body">
        <h2 class="white-text mb-0">Manage Users</h2>
    </div>
</div>

<br>
<div class="container animated fadeIn d-flex justify-content-between">
    <span class="blue-text h1-responsive"><i class="fa fa-user" aria-hidden="true"></i> Accounts</span>
</div>
<br>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a onclick="acctype('walkin')" class="nav-link active" data-toggle="tab" href="#panel1" role="tab"><i class="fa fa-group" aria-hidden="true"></i> Walk In</a>
    </li>
    <li class="nav-item">
        <?php  
            if($_SESSION['position'] == "Admin") {
                echo '<a onclick=acctype("admin") class="nav-link" data-toggle="tab" href="#panel2" role="tab"><i class="fa fa-cog" aria-hidden="true"></i> Admin</a>';
            }
        ?>
    </li>
</ul>
<input id="accidholder" type="hidden" value="" />
<input id="acctypeholder" type="hidden" value="walkin" />
<!-- Tab panels -->
<div class="tab-content card animated fadeIn">
    <!--Panel 1-->
    <div class="tab-pane fade in show active customheighttbl" id="panel1" role="tabpanel">
        <table class="table table-hover table-responsive">
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th width="15%">Email</th>
                    <th width="15%">Name</th>
                    <th width="10%">Contact</th>
                    <th width="20%">Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="walkin">
                
            </tbody> 
        </table>
    </div>
    <!--/.Panel 1-->
    <!--Panel 2-->
    <div class="tab-pane fade customheighttbl" id="panel2" role="tabpanel">
        <table class="table table-hover table-responsive">
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th width="15%">Email</th>
                    <th width="15%">Name</th>
                    <th width="10%">Contact</th>
                    <th width="20%">Address</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="admin">
                
            </tbody>
        </table>
    </div>
    <!--/.Panel 2-->
</div>

<div class="modal fade" id="addadminmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header primary-color white-text">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Convert Account</strong></h4>
                <button type="button" id="addmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Convert this account to an Admin?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-primary waves-effect" onclick="addadmin()">Make as an Admin</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="deleteaccmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red white-text">
                <h4 class="modal-title red" id="myModalLabel"><strong>Delete</strong></h4>
                <button type="button" id="deleteaccmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to delete this account?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-danger waves-effect" onclick="deleteaccount()">Delete</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="deactivateaccmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header orange white-text">
                <h4 class="modal-title orange" id="myModalLabel"><strong>Deactivate</strong></h4>
                <button type="button" id="deactivateaccmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to deactivate this account?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-warning waves-effect" onclick="deactivateaccount()">Deactivate</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="activateaccmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header green white-text">
                <h4 class="modal-title" id="myModalLabel"><strong>Activate</strong></h4>
                <button type="button" id="activateaccmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Activate this account?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-success waves-effect" onclick="activateaccount()">Activate</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="removeadmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header cyan white-text">
                <h4 class="modal-title" id="myModalLabel"><strong>Remove Admin</strong></h4>
                <button type="button" id="removeadminclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Remove account as an Admin?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline-default waves-effect" onclick="removeadmin()">Remove</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>


<script>
    $(document).ready(function () {
        showwalkin();
        showadmin();
        $('body').on('click', '#acc',function(){
            document.getElementById("accidholder").value = $(this).attr('data-id');
        }); 
    });
    function acctype(type){
        document.getElementById("acctypeholder").value = type;
    }
    function showwalkin(){
        $.ajax({
            url: "php/account.php",
            method: "POST",
            data: {action: "showwalkin"},
            beforeSend: function(){
                data = "<td colspan=5>" + load2() + "</td>";
                $('#walkin').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $('#walkin').html(data);
            }
        })
    }
    function showadmin(){
        $.ajax({
            url: "php/account.php",
            method: "POST",
            data: {action: "showadmin"},
            beforeSend: function(){
                data = "<td colspan=5>" + load2() + "</td>";
                $('#admin').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $('#admin').html(data);
            }
        })
    }
</script>