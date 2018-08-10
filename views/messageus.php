<?php 
	session_start();
	if($_SESSION['accID'] == ""){
		$status = 0;
	}
	else{
		$status = 1;
	}
?>
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header pink darker-4 white-text">
                <h4 class="title"><i class="fa fa-envelope-open" aria-hidden="true"></i> Message</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body mb-0">
        		<p class="error" id="errormsgmessage"></p>
        		<?php 
        			if($status == 0 ){
        				echo '<div class="md-form form-sm">
		                <i class="fa fa-envelope prefix"></i>
		                <input type="email" id="msgemail" class="form-control">
		                <label for="email">Email</label>
			            </div>

			            <div class="md-form form-sm">
			                <i class="fa fa-user prefix"></i>
			                <input type="text" id="msgname" class="form-control">
			                <label for="name">Name</label>
			            </div>';
        			}
        		?>
	            <div class="md-form" form-sm>
				    <i class="fa fa-pencil prefix"></i>
				    <textarea type="text" id="msgmessage" class="md-textarea"></textarea>
				    <label for="message">Message</label>
				</div>

	            <div class="text-center mt-1-half">
	                <button onclick="checkmessage(<?php echo $status; ?>)" class="btn pink darker-4 mb-1">Submit</button>
	            </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>