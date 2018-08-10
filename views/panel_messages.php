<?php 
    include '../php/connect.php';
    $_SESSION['adminpanel'] = "messages";
?>
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeIn">
    <div class="card-body">
        <h2 class="white-text mb-0">Manage Messages</h2>
    </div>
</div>
<br>
<div class="container animated fadeIn d-flex justify-content-between">
    <span class="blue-text h1-responsive"><i class="fa fa-envelope-o" aria-hidden="true"></i> Messages</span>
</div>
<br>
<div class="customheighttbl">
    <table class="table table-hover animated fadeIn table-responsive">
        <thead class="mdb-color darken-3">
            <tr class="text-white">
                <th width="20%">Email</th>
                <th width="20%">Name</th>
                <th width="20%">Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblmessages">
            
        </tbody> 
        
    </table>
</div>

<input id="messageidholder" type="hidden" value="" />
<input id="emailholder" type="hidden" value="" />    
<input id="nameholder" type="hidden" value="" />  

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Delete</strong></h4>
                <button type="button" id="messagemodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to delete this message?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="deletemessage()">Delete</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>


<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header deep-orange lighten-1 white-text">
                <h4 class="modal-title w-100" id="modallabelview"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p id="datemessage"></p>
                <p id="messagebody"></p>
            </div>
            <div class="container">
                <div class="collapse" id="collapsereply">
                    <p class="error" id="errormsgreply"></p>
                    <div class="md-form">
                        <i class="fa fa-pencil prefix"></i>
                        <textarea type="text" id="txtreply" class="md-textarea"></textarea>
                        <label for="txtreply">Reply</label>
                    </div>
                </div>
            </div>
            
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" id="btnreply" class="btn btn-info ld-over-inverse">
                    Reply
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script>
    $(document).ready(function () {
        $('body').on('click', '#tdrow',function(){
            document.getElementById("messageidholder").value = $(this).attr('data-id');
            document.getElementById("emailholder").value = $(this).closest("tr").find(".email").text().trim();
            document.getElementById("nameholder").value = $(this).closest("tr").find(".name").text().trim();
        }); 
        $('body').on('click', '.showmessage', function(){
            var email = $(this).closest("tr").find(".email").text();
            var datemsg = $(this).closest("tr").find(".datemsg").text();
            var message = $(this).closest("tr").find(".message").text();
            $("#modallabelview").text("From: " + email);
            $("#datemessage").text(datemsg);
            $("#messagebody").text(message);
        });
        $("#viewmodal").on('hidden.bs.modal', function(){
            $("#txtreply").val("");
            $("#collapsereply").collapse('hide');
            $("#btnreply").text("Reply");
            $("#btnreply").html('<div class="ld ld-ring ld-spin"></div> Reply');
            $("#btnreply").removeClass("btn-success");
            $("#btnreply").addClass("btn-info");  
            $("#errormsgreply").html("");
        })
        showmessage();
    }); 
    function showmessage(){
        $.ajax({
            url: "php/message.php",
            method: "POST",
            data: {action: "showmessage"},
            beforeSend: function(){
                data = "<td colspan=4>" + load2() + "</td>";
                $('#tblmessages').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $("#tblmessages").html(data);
            }
        })
    }
    $("#btnreply").on('click', function(){
        if($("#btnreply").html().indexOf("Reply") >= 0){
            $("#collapsereply").collapse('show');
            $("#btnreply").html('<div class="ld ld-ring ld-spin"></div>Send');
        }
        else{
            sendreply();
        }
    })
</script>
