// pre defined functions
function getDateTime(){
	var today = new Date();
	var date = (today.getMonth() + 1) + "-" + today.getDate() + "-" + today.getFullYear();
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	var datetime = date + " " + time;
	return datetime;
}
function load1(){
	$output = '<div class="divspace"><br><br><br><br><br></div>'+
				'<center><img src="img/loading.gif"></center>'+
				'<div class="divspace"><br><br><br><br><br></div>';
	return $output;
}
function load2(){
	$output = '<center><img src="img/loading2.gif"></center>';
	return $output;
}


// function login 
function login(){
	var email = document.getElementById("loginemail");
    var password = document.getElementById("loginpassword");
    if (!email.value.trim() && !password.value.trim()) {
        $("#errormsglogin").html("<strong>Please enter your Email and Password</strong>");
    } 
    else if (!email.value.trim()) {
        $("#errormsglogin").html("<strong>Please enter your Email</strong>");
    }

    else if (!password.value.trim()) {
        $("#errormsglogin").html("<strong>Please enter your Password</strong>");
    }
    else{
    	$("#btnlogin").addClass("running");
    	$.post('php/checklogin.php', {
            email: email.value,
            password: password.value,
        }, function(data) {
            data = jQuery.parseJSON(data);
            if(!data) {
            	$("#btnlogin").removeClass("running");
                $("#errormsglogin").html("<strong>Invalid Email and Password</strong>");
            }
            else {
            	$.post("php/account.php", {
		    		email: email.value,
		    		password: password.value,
		    		action: "checkactive"
		    	}, function(data){
		    		data = $.parseJSON(data);
		    		if(!data){	
		    			$.post('php/account.php', {
		    				action: "unsetusersessions"
		    			});
		    			$("#btnlogin").removeClass("running");
		    			$("#errormsglogin").html("<strong>Account is Deactivated</strong>");
		    		}
		    		else{
		        		window.location = window.location.href;
		    		}
		    	});
            }
        });
    	
        
    }
}
document.getElementById("btnlogin").addEventListener('click', e => {
	login();
});
document.getElementById("loginemail").addEventListener('keypress', e => {
	if(e.which == 13){
		login();
	}
	
});
document.getElementById("loginpassword").addEventListener('keypress', e => {
	if(e.which == 13){
		login();
	}
	
});
//end function login

//start function register
function register(){
	var email = document.getElementById("email");
	var password = document.getElementById("password");
	var password2 = document.getElementById("password2");
	var name = document.getElementById("name");
	var contact = document.getElementById("contact");
	var address = document.getElementById("address");
	if(!email.value.trim() && !password.value.trim() && !password2.value.trim() && !name.value.trim() && !contact.value.trim() && !address.value.trim()){
		$("#errormsgreg").html("<strong>Please fill up the details</strong>");
	}
	else if(!email.value.trim()){
		$("#errormsgreg").html("<strong>Please enter your email</strong>");
	} 
	else if(!password.value.trim()){
		$("#errormsgreg").html("<strong>Please enter your password</strong>");
	}
	else if(!password2.value.trim()){
		$("#errormsgreg").html("<strong>Please repeat your password</strong>");
	}
	else if(!name.value.trim()){
		$("#errormsgreg").html("<strong>Please enter your name</strong>");
	}
	else if(!contact.value.trim()){
		$("#errormsgreg").html("<strong>Please enter your contact #</strong>");
	}
	else if(!address.value.trim()){
		$("#errormsgreg").html("<strong>Please enter your address</strong>");
	}
	else if(password.value !== password2.value){
		$("#errormsgreg").html("<strong>Password do not match</strong>");
	}
	else{
		$("#btnregister").addClass("running");
        $.post('php/account.php', {
            email: email.value,
            password: password.value,
            name: name.value,
            contact: contact.value,
            address: address.value,
            action: "add"
        }, function(data) {
            data = jQuery.parseJSON(data);
            if(!data) {
            	$("#btnregister").removeClass("running");
                $("#errormsgreg").html("<strong>Email is already in use</strong>");
            }
            else {
            	$.post('php/checklogin.php', {
            		email: email.value,
            		password: password.value
            	}, function(data){
		            data = jQuery.parseJSON(data);
		            if(!data) {
		            	$("#btnregister").removeClass("running");
		                $("#errormsgreg").html("<strong>Invalid Email and Password</strong>");
		            }
		            else {
		            	window.location = window.location.href;
		            }
            	});

            }
        });
    }
}
document.getElementById("btnregister").addEventListener('click', e => {
	register();
});

document.getElementById("email").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("password").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("password2").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("name").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("contact").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("address").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
document.getElementById("answer").addEventListener('keypress', e => {
	if(e.which == 13){
		register();
	}
});
//end function register


//Default navbar
function defaultnav() {
	document.getElementById("nav").className += " pink";
}

// Start of Loading of header, navbar and footer
function load() {
	// $.get('views/header.php', function(data) {
	// 	$('#header').html(data);
	// });
	$.get('views/navbar.php', function(data) {
		$('#navbar').html(data);
	});
	$.get('views/footer.php', function(data) {
		$('#footer').html(data)
	});
}
// End of loading of header and footer

// Start of Function for web content navigated by numbers
function web_content(content) {
	var content = content;
	if(content == "1") {
		$.ajax({
			url: "views/home.php",
			method: "POST",
			beforeSend: function(){
				$('#web_content').html(load1());
			},
			success: function(data){
				$('#web_content').html(data);
			}
		})
	}
}
// End of functions for web content
//Start function for admin panel
function panel(nav) {
	$('#panel').html(load1());
	if(nav == "orders") {
		$.get('views/panel_orders.php', function(data) {
			$('#panel').html(data);
		});
	}
	if(nav == "accounts") {
		$.get('views/panel_users.php', function(data) {
			$('#panel').html(data);
		});
	}
	if(nav == "products") {
		$.get('views/panel_products.php', function(data) {
			$('#panel').html(data);
		});
	}
	if(nav == "messages"){
		$.get('views/panel_messages.php', function(data) {
			$('#panel').html(data);
		});
	}
	if(nav == "settings"){
		$.get('views/panel_settings.php', function(data) {
			$('#panel').html(data);
		});
	}
	whitetext(nav);
}
//end function for admin panel


//start content for account 
function account_content(content) {
	var content = content;
	if(content == "1") {
		$.ajax({
			url: "views/accountprofile.php",
			method: "POST",
			beforeSend: function(){
				$('#account').html(load2());
			},
			success: function(data){
				$('#account').html(data);
			}
		})
	}
	else if(content == "2") {
		$.ajax({
			url: "views/newpassword.php",
			method: "POST",
			beforeSend: function(){
				$('#account').html(load2());
			},
			success: function(data){
				$('#account').html(data);
			}
		})
	}
}
//end content for account 

//start content for info 
function info_content(content) {
	if(content == "1"){
		$.ajax({
			url: "views/infoprofile.php",
			method: "POST",
			beforeSend: function(){
				$('#info').html(load2());
			},
			success: function(data){
				$('#info').html(data);
			}
		})
	}
	else if(content == "2") {
		$.ajax({
			url: "views/newinfo.php",
			method: "POST",
			beforeSend: function(){
				$('#info').html(load2());
			},
			success: function(data){
				$('#info').html(data);
			}
		})
	}
}
//end content for info
//Change password
function checknewpass() {
	var oldpassword = document.getElementById("oldpassword");
	var newpassword = document.getElementById("newpassword");
	var newpassword2 = document.getElementById("newpassword2");
	if(!oldpassword.value.trim() && !newpassword.value.trim() && !newpassword2.value.trim()){
		$("#errormsgnewpass").html("<strong>Please fill up the details</strong>");
	}
	else if(!oldpassword.value.trim()) {
		$("#errormsgnewpass").html("<strong>Please enter your old password</strong>");
	}
	else if(!newpassword.value.trim()){
		$("#errormsgnewpass").html("<strong>Please enter your new password</strong>");
	}
	else if(!newpassword2.value.trim()){
		$("#errormsgnewpass").html("<strong>Please retype your new password</strong>");
	}
	else if(newpassword.value != newpassword2.value){
		$("#errormsgnewpass").html("<strong>New password do not match</strong>");
	}
	else{
		$.post('php/account.php', {
			oldpassword: oldpassword.value,
			action: "checkoldpassword"
		}, function(data){
			data = jQuery.parseJSON(data);
			if(!data){
				$("#errormsgnewpass").html("<strong>Old password is incorrect</strong>");
			}
			else{
				$.post('php/account.php', {
					password: newpassword.value,
					action: "changepass"
				}, function(data){
					window.location = window.location.href;
				});
			}
		});
	}
}

//change info
function checknewinfo() {
	var name = document.getElementById("infoname");
	var contact = document.getElementById("infocontact");
	var address = document.getElementById("infoaddress");
	if(!name.value.trim() && !contact.value.trim() && !address.value.trim()){
		$("#errormsgnewinfo").html("<strong>Please fill up the details</strong>");
		return false;
	}
	else if(!name.value.trim()){
		$("#errormsgnewinfo").html("<strong>Plese enter your name</strong>");
		return false;
	}
	else if(!contact.value.trim()){
		$("#errormsgnewinfo").html("<strong>Please enter your contact #</strong>");
		return false;
	}
	else if(!address.value.trim()){
		$("#errormsgnewinfo").html("<strong>Please enter your complete address</strong>");
		return false;
	}
	else{
		$.post('php/account.php', {
			name: name.value,
			contact: contact.value,
			address: address.value,
			action: "changeinfo"
		}, function(data){
			$.get('views/infoprofile.php', function(data){
				$('#info').html(data);
			});
		});
	}
}

//funciton for messaging
function checkmessage(status){
	if(status == 0){
		var email = document.getElementById("msgemail");
		var name = document.getElementById("msgname");
		var message = document.getElementById("msgmessage");
		if(!email.value.trim() && !name.value.trim() && !message.value.trim()){
			$("#errormsgmessage").html("<strong>Please fill up the details</strong>");
		}
		else if(!email.value.trim()){
			$("#errormsgmessage").html("<strong>Please enter your email</strong>");
		}
		else if(!name.value.trim()){
			$("#errormsgmessage").html("<strong>Please enter your name</strong>");
		}
		else if(!message.value.trim()){
			$("#errormsgmessage").html("<strong>Please enter your message</strong>");
		}
		else{
			$.post('php/message.php', {
				email: email.value,
				name: name.value,
				message: message.value,
				status: status,
				action: "addmessage"
			}, function(data){
			});
			$.ajax({
				url: "php/message.php",
				method: "POST",
				data: {name: name.value, email: email.value, message: message.value, status: status, action: "addmessage"},
				beforeSend: function(){
					document.getElementById("btnsendmessage").className += " running";
					$("#modalMessage").modal('hide');
				},
				success: function(){
					$("#btnsendmessage").removeClass("running btn-pink");
					document.getElementById("btnsendmessage").className += " btn-success";
					$("#btnsendmessage").html('Sent <i class="fa fa-check" aria-hidden="true"></i>');
					setTimeout(function(){
						$("#btnsendmessage").removeClass("btn-success");
						document.getElementById("btnsendmessage").className += " btn-pink";
						$("#btnsendmessage").html('<i class="fa fa-envelope" aria-hidden="true"></i> Message Us');
					}, 3000);
				}
			});
		}
	}
	else{
		var message = document.getElementById("msgmessage");
		if(!message.value.trim()){
			$("#errormsgmessage").html("<strong>Please enter your message</strong>");
		}
		else{
			$.ajax({
				url: "php/message.php",
				method: "POST",
				data: {message: message.value, status: status, action: "addmessage"},
				beforeSend: function(){
					document.getElementById("btnsendmessage").className += " running";
					$("#modalMessage").modal('hide');
				},
				success: function(){
					$("#btnsendmessage").removeClass("running btn-pink");
					document.getElementById("btnsendmessage").className += " btn-success";
					$("#btnsendmessage").html('Sent <i class="fa fa-check" aria-hidden="true"></i>');
					setTimeout(function(){
						$("#btnsendmessage").removeClass("btn-success");
						document.getElementById("btnsendmessage").className += " btn-pink";
						$("#btnsendmessage").html('<i class="fa fa-envelope" aria-hidden="true"></i> Message Us');
					}, 3000);
				}
			});
		}
	}
}

//add product
function addproduct() {
	var title = document.getElementById("title");
	var description = document.getElementById("description");
	var category = document.getElementById("category");
	var price = document.getElementById("price");
	var image = document.getElementById("image");
	if(!title.value.trim() && !description.value.trim() && !category.value.trim() && !price.value.trim() && !image.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please enter the details of the product</strong>");
	}
	else if(!title.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please enter the title of the product</strong>");
	}
	else if(!description.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please enter the description of the product</strong>");
	}
	else if(!category.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please choose the category of the product</strong>");
	}
	else if(category.value == "-- Choose Category --"){
		$("#errormsgaddproduct").html("<strong>Please choose the category of the product</strong>");
	}
	else if(!price.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please enter the price of the product</strong>");
	}
	else if(!image.value.trim()){
		$("#errormsgaddproduct").html("<strong>Please choose an image of the product</strong>");
	}
	else if(!validateimage()){

	}
	else{
		$.post('php/product.php', {
			title: title.value,
			action: "checkproduct"
		}, function(data){
			// data = jQuery.parseJSON(data);
			if(data){
				$("#errormsgaddproduct").html("<strong>Title of product is already taken</strong>");
			}
			else{
				var form_data = new FormData();
				form_data.append("image", image.files[0]);
				form_data.append("action", "addproduct");
				form_data.append("title", title.value);
				form_data.append("description", description.value);
				form_data.append("category", category.value);
				form_data.append("price", price.value);
				$.ajax({
					url: "php/product.php",
					method: "POST",
					data: form_data,	
					contentType: false,
					cache: false,
					processData: false,
					beforeSend: function(){
						$("#modalclose").click();
					},
					success: function(data){
						data = jQuery.parseJSON(data);
						$('#newproductmodal').removeData();
						$("#cupcake").html(data.cupcake);
						$("#mug").html(data.mug);
						$("#mugwithcake").html(data.mugwithcake);
					}
				});
			}
		});
	}
} 	
function editproduct(){
	var prodid = document.getElementById("productidholder");
	var title = document.getElementById("edittitle");
	var description = document.getElementById("editdescription");
	var category = document.getElementById("editcategory");
	var price = document.getElementById("editprice");
	var image = document.getElementById("editimage");
	if(!title.value.trim() && !description.value.trim() && !category.value.trim() && !price.value.trim() && !image.value.trim()){
		$("#errormsgeditproduct").html("<strong>Please enter the details of the product</strong>");
	}
	else if(!title.value.trim()){
		$("#errormsgeditproduct").html("<strong>Please enter the title of the product</strong>");
	}
	else if(!description.value.trim()){
		$("#errormsgeditproduct").html("<strong>Please enter the description of the product</strong>");
	}
	else if(!category.value.trim()){
		$("#errormsgeditproduct").html("<strong>Please choose the category of the product</strong>");
	}
	else if(category.value == "-- Choose Category --"){
		$("#errormsgeditproduct").html("<strong>Please choose the category of the product</strong>");
	}
	else if(!price.value.trim()){
		$("#errormsgeditproduct").html("<strong>Please enter the price of the product</strong>");
	}
	else if($("#btnchangeimage").text() == "Cancel"){
		if(!image.value.trim()){
			$("#errormsgeditproduct").html("<strong>Please choose an image of the product</strong>");
		}
		else if(!validateimageforedit()){

		}
		else{
			$.post('php/product.php', {
				prodid: prodid.value,
				title: title.value,
				action: "checkproductedit"
			}, function(data){
				var res = jQuery.parseJSON(data);
				if(res){
					$("#errormsgeditproduct").html("<strong>Title of product is already taken</strong>");
				}				
				else{
					$.get('views/load2.php', function(data){
			            data = "<td colspan=4>" + data + "</td>";
			            $('#cupcake').html(data);
			            $('#mug').html(data);
			            $('#mugwithcake').html(data);
			        });
					var form_data = new FormData();
					form_data.append("image", image.files[0]);
					form_data.append("action", "editproductwithnewimage");
					form_data.append("prodid", prodid.value);
					form_data.append("title", title.value);
					form_data.append("description", description.value);
					form_data.append("category", category.value);
					form_data.append("price", price.value);
					$.ajax({
						url: "php/product.php",
						method: "POST",
						data: form_data,	
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function(){
							$("#editprodmodalclose").click();
						},
						success: function(data){
							data = jQuery.parseJSON(data);
							$("#cupcake").html(data.cupcake);
							$("#mug").html(data.mug);
							$("#mugwithcake").html(data.mugwithcake);
						}
					});
				}
			});
		}
	}
	else{
		$.post('php/product.php', {
			prodid: prodid.value,
			title: title.value,
			action: "checkproductedit"
		}, function(data){
			var res = jQuery.parseJSON(data);
			if(res){
				$("#errormsgeditproduct").html("<strong>Title of product is already taken</strong>");
			}
			else{
				$.get('views/load2.php', function(data){
		            data = "<td colspan=4>" + data + "</td>";
		            $('#cupcake').html(data);
		            $('#mug').html(data);
		            $('#mugwithcake').html(data);
		        });
				$.post('php/product.php', {
					prodid: prodid.value,
					title: title.value,
					description: description.value,
					category: category.value,
					price: price.value,
					action: "editproduct"
				}, function(data){
					data = jQuery.parseJSON(data);
					$("#cupcake").html(data.cupcake);
					$("#mug").html(data.mug);
					$("#mugwithcake").html(data.mugwithcake);
				});
				$.ajax({
					url: "php/product.php",
					method: "POST",
					data: {prodid: prodid.value,
					title: title.value,
					description: description.value,
					category: category.value,
					price: price.value,
					action: "editproduct"},
					beforeSend: function(){
						$("#editprodmodalclose").click();
					},
					success: function(data){
						data = jQuery.parseJSON(data);
						$("#cupcake").html(data.cupcake);
						$("#mug").html(data.mug);
						$("#mugwithcake").html(data.mugwithcake);
					}
				})
			}
		});
	}
}

function validateimage(){
    var fuData = document.getElementById('image');
    var FileUploadPath = fuData.value;
    var size = fuData.files[0].size;
    var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
    if (Extension == "gif" || Extension == "png" || Extension == "bmp"
            || Extension == "jpeg" || Extension == "jpg") {
        if (fuData.files && fuData.files[0]) {
            var reader = new FileReader();
           reader.onload = function(e) {
               $('#imageshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(fuData.files[0]);
        }
        var filename = fuData.value.split('\\').pop();
    	$("#addproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return true;
    }
    else if(size > 200000){
    	$("#errormsgaddproduct").html("<strong>The size of image is too big</strong>");
        $('#imageshow').attr('src', 'img/NoImage.png');
        var filename = fuData.value.split('\\').pop();
    	$("#addproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
    else {
        $("#errormsgaddproduct").html("<strong>Only images with JPG, JPEG, PNG</strong>");
        $('#imageshow').attr('src', 'img/NoImage.png');
        var filename = fuData.value.split('\\').pop();
    	$("#addproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
}
function validateimageforedit(){
    var fuData = document.getElementById('editimage');
    var FileUploadPath = fuData.value;
    var size = fuData.files[0].size;
    var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
    if (Extension == "gif" || Extension == "png" || Extension == "bmp"
            || Extension == "jpeg" || Extension == "jpg") {
        if (fuData.files && fuData.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               $('#editimageshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(fuData.files[0]);
        }
        var filename = fuData.value.split('\\').pop();
    	$("#editproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return true;
    }
    else if(size > 200000){
    	$("#errormsgeditproduct").html("<strong>The size of image is too big</strong>");
        fuData.value = "";
        $('#imageshow').attr('src', 'img/NoImage.png');
        var filename = fuData.value.split('\\').pop();
    	$("#editproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
    else {
        $("#errormsgeditproduct").html("<strong>Only images with JPG, JPEG, PNG</strong>");
        fuData.value = "";
        $('#editimageshow').attr('src', 'img/NoImage.png');
        var filename = fuData.value.split('\\').pop();
    	$("#editproductlabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
}

function deletemessage(){
	$.get('views/load2.php', function(data){
        data = "<td colspan=4>" + data + "</td>";
        $('#tblmessages').html(data);
    });
	var messageid = document.getElementById("messageidholder");
	$("#messagemodalclose").click();
	$.post('php/message.php', {
			messageid: messageid.value,
			action: "deletemessage"
		}, function(data){
			$("#tblmessages").html(data);
	});
}

function addadmin(){
	var accid = document.getElementById("accidholder");
	var acctype = document.getElementById("acctypeholder");
	$.ajax({
		url: "php/account.php",
		method: "POST",
		data: {accid: accid.value, action: "addadmin"},
		beforeSend: function(){
			$.get('views/load2.php', function(data){
		        data = "<td colspan=5>" + data + "</td>";
		        $('#walkin').html(data);
		        $('#admin').html(data);
		    });
		},
		success: function(data){
			data = jQuery.parseJSON(data);
			$("#addmodalclose").click();
			$("#walkin").html(data.walkin);
			$("#admin").html(data.admin);
		}
	})
}
function deleteaccount(){
	var accid = document.getElementById("accidholder");
	var acctype = document.getElementById("acctypeholder");
	$.ajax({
		url: "php/account.php",
		method: "POST",
		data: {accid: accid.value, acctype: acctype.value, action: "deleteaccount"},
		beforeSend: function(){
			if(acctype.value == "walkin"){
				data = "<td colspan=5>" + load2() + "</td>";
		        $('#walkin').html(data);
			}
			else if(acctype.value == "admin"){
				data = "<td colspan=5>" + load2() + "</td>";
		        $('#admin').html(data);
			}
			$("#deleteaccmodalclose").click();
		},
		success: function(data){
			if(acctype.value == "walkin"){
				$("#walkin").html(data);
			}
			else if(acctype.value == "admin"){
				$("#admin").html(data);
			}
		}
	})
}
function deactivateaccount(){
	var accid = document.getElementById("accidholder");
	var acctype = document.getElementById("acctypeholder");
	if(acctype.value == "walkin"){
		data = "<td colspan=5>" + load2() + "</td>";
        $('#walkin').html(data);
	}
	else if(acctype.value == "admin"){
		data = "<td colspan=5>" + load2() + "</td>";
        $('#admin').html(data);
	}
	$("#deactivateaccmodalclose").click();
	$.post('php/account.php', {
		accid: accid.value,
		acctype: acctype.value,
		action: "deactivateaccount"
	}, function(data){
		if(acctype.value == "walkin"){
			$("#walkin").html(data);
		}
		else if(acctype.value == "admin"){
			$("#admin").html(data);
		}
	});
}
function activateaccount(){
	var accid = document.getElementById("accidholder");
	var acctype = document.getElementById("acctypeholder");
	if(acctype.value == "walkin"){
		data = "<td colspan=5>" + load2() + "</td>";
        $('#walkin').html(data);
	}
	else if(acctype.value == "admin"){
		data = "<td colspan=5>" + load2() + "</td>";
        $('#admin').html(data);
	}
	$("#activateaccmodalclose").click();
	$("#deactivateaccmodalclose").click();
	$.post('php/account.php', {
		accid: accid.value,
		acctype: acctype.value,
		action: "activateaccount"
	}, function(data){
		if(acctype.value == "walkin"){
			$("#walkin").html(data);
		}
		else if(acctype.value == "admin"){
			$("#admin").html(data);
		}
	});
}

function removeadmin(){
	var accid = document.getElementById("accidholder");
	data = "<td colspan=5>" + load2() + "</td>";
    $('#walkin').html(data);
    $('#admin').html(data);
    $("#removeadminclose").click();
	$.post('php/account.php', {
		accid: accid.value,
		action: "removeadmin"
	}, function(data){
		data = jQuery.parseJSON(data);
		$("#walkin").html(data.walkin);
		$("#admin").html(data.admin);
	});
}

function deleteproduct(){
	var prodid = document.getElementById("productidholder");
	var oldimage = document.getElementById("oldimageholder");
	var category = document.getElementById("categoryholder");
	if(category.value == "cupcake"){
		data = "<td colspan=4>" + load2() + "</td>";
        $('#cupcake').html(data);
	}
	else if(category.value == "mug"){
		data = "<td colspan=4>" + load2() + "</td>";
        $('#mug').html(data);
	}
	else if(category.value == "mugwithcake"){
		data = "<td colspan=4>" + load2() + "</td>";
        $('#mugwithcake').html(data);
	}
	$.ajax({
		url: "php/product.php",
		method: "POST",
		data: {prodid: prodid.value,
		oldimage: oldimage.value,
		category: category.value,
		action: "deleteprod"},
		beforeSend: function(){
			$("#deleteprodmodalclose").click();
		},
		success: function(data){
			if(category.value == "cupcake"){
				$("#cupcake").html(data);
			}
			else if(category.value == "mug"){
				$("#mug").html(data);
			}
			else if(category.value == "mugwithcake"){
				$("#mugwithcake").html(data);
			}
		}
	})
}
function addtocart(prodid, button){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {prodid: prodid, action: "additem"},
		beforeSend: function(){
			document.getElementById(button).className += " running";
			$("#" + button).prop("onclick", false);
		},
		success: function(data){
			$("#" + button).removeClass('running btn-primary');
			document.getElementById(button).className += " btn-success";
			$("#" + button).html('<i class="fa fa-check" aria-hidden="true"></i>');
			document.getElementById(button).className += " animated bounce";
			setTimeout(function() {
					$("#" + button).removeClass("animated bounce btn-success");
					document.getElementById(button).className += " btn-primary";
					document.getElementById(button).onclick = function(){
							addtocart(prodid, button);
					};
					$("#" + button).html('<i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart');
			}, 1000 );
			updateitembadge();
		}
		
	});
}
function updateitembadge(){
	$.post('php/cart.php', {
		action: "itembadge"
	}, function(data){
		data = $.parseJSON(data);
		$("#itembadgecounter").removeClass("badge-danger");
		document.getElementById("itembadgecounter").className += " badge-success animated wobble";
		document.getElementById("itemcart").className += " animated swing";
		setTimeout(function(){
			$("#itembadgecounter").removeClass("animated wobble badge-success");
			$("#itemcart").removeClass("animated swing infinite");
			document.getElementById("itembadgecounter").className += " badge-danger";
		}, 1000);
		setTimeout(function(){
			$("#itembadgecounter").text(data);
		}, 500);

	});
}
function updatetotalpayment(){
	$.post('php/cart.php', {
		action: "totalpayment_text"
	}, function(data){
		data = $.parseJSON(data);
		document.getElementById("totalpayment_modal").className += " animated rubberBand green-text";
		setTimeout(function(){
			$("#totalpayment_modal").removeClass("animated rubberBand green-text");
		}, 1000);
		setTimeout(function(){
			$("#totalpayment_modal").text(data);
		}, 300);
	})
}
function showcartitem(){
	$('#cartitemlist').html(load2());
	$.post('php/cart.php', {
		action: "showcartitem"
	}, function(data){
		data = $.parseJSON(data);
		$("#cartitemlist").html(data.output);
		$("#totalpayment").html(data.totalpayment);
		updatetotalpayment();
		if(!data.showpayment){
			$("#payment").html("");
			$("#checkoutsubmodal").html("");
		}
		else{
			$("#checkoutsubmodal").html('<a href="checkout.php" class="btn btn-success waves-effect waves-light">Proceed to Checkout</a>');
		}

	});
}
function incrementitem(prodid, button){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {prodid: prodid, action: "incrementitem"},
		beforeSend: function(){
			$("#" + button).prop("onclick", false);
			$("#itemcount" + prodid).html('<i class="fa fa-sort-up" aria-hidden="true"></i>');
			$("#itemcount" + prodid).removeClass("badge-primary");
			document.getElementById("itemcount" + prodid).className += " badge-dark white-text animated rubberBand infinite";
		}, 
		success: function(data){
			data = $.parseJSON(data);
			$("#itemcount" + prodid).removeClass("badge-dark rubberBand infinite white-text");
			document.getElementById("itemcount" + prodid).className += " badge-success pulse";
			setTimeout(function(){
				$("#itemcount" + prodid).removeClass("badge-success animated pulse");
				document.getElementById("itemcount" + prodid).className += " badge-primary";
				document.getElementById(button).onclick = function(){
										incrementitem(prodid, button)};
			}, 1000);
			setTimeout(function(){
				$("#itemcount" + prodid).text(data);
			}, 300);
			updatetotalpayment();
			updateitembadge();
		}
	});
}
function decrementitem(prodid, button){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {prodid: prodid, action: "decrementitem"},
		beforeSend: function(){
			$("#" + button).prop("onclick", false);
			$("#itemcount" + prodid).html('<i class="fa fa-sort-down" aria-hidden="true"></i>');
			$("#itemcount" + prodid).removeClass("badge-primary");
			document.getElementById("itemcount" + prodid).className += " badge-dark white-text animated rubberBand infinite";
		}, 
		success: function(data){
			data = $.parseJSON(data);
			if(!data.status){
				$("#itemcount" + prodid).removeClass("badge-dark rubberBand infinite white-text");
				document.getElementById("itemcount" + prodid).className += " badge-warning swing";
				setTimeout(function(){
					$("#itemcount" + prodid).removeClass("badge-warning animated swing");
					document.getElementById("itemcount" + prodid).className += " badge-primary";
					document.getElementById(button).onclick = function(){
											decrementitem(prodid, button)};
				}, 1000)
				setTimeout(function(){
					$("#itemcount" + prodid).text(data.quantity);
				}, 300);
			}
			else{
				$("#itemcount" + prodid).removeClass("badge-dark rubberBand infinite white-text");
				document.getElementById("itemcount" + prodid).className += " badge-danger pulse";
				setTimeout(function(){
					$("#itemcount" + prodid).removeClass("badge-danger animated pulse");
					document.getElementById("itemcount" + prodid).className += " badge-primary";
					document.getElementById(button).onclick = function(){
											decrementitem(prodid, button)};
				}, 1000);
				setTimeout(function(){
					$("#itemcount" + prodid).text(data.quantity);
				}, 300);
				updatetotalpayment()
				updateitembadge();
			}
		}
	});
}
function removeitem(prodid){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {prodid: prodid, action: "removeitem"},
		beforeSend: function(){
			$("#cartitems").removeClass("fadeIn");
			document.getElementById("item" + prodid).className += " animated fadeOutLeft";
		},
		success: function(data){
			updateitembadge();
			setTimeout(function(){
				$.ajax({
					url: "php/cart.php",
					method: "POST",
					data: {action: "cartitems"},
					success: function(data){
						data = $.parseJSON(data);
						$('#cartitems').html(data);
						document.getElementById("cartitems").className += " fadeIn";
					}
				});
				$.ajax({
					url: "php/cart.php",
					method: "POST",
					data: {action: "totalpayment"},
					success: function(data){
						data = $.parseJSON(data);
						$('#divpayment').html(data);
						document.getElementById("divpayment").className += " fadeIn";
					}
				});
			}, 800)
			setTimeout(function(){
				updatepayment_cart()
			}, 700)
		}
	});
}
function increaseitem(prodid){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {prodid: prodid, action: "increaseitem_cart"},
		beforeSend: function(){
			$("#quantitypanel" + prodid).addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			if(!data){
				$("#txtquantity" + prodid).addClass("bg-danger");
				setTimeout(function(){
					$("#txtquantity" + prodid).removeClass("bg-danger");
				}, 1000)
				$("#errormsgcartitems").html('<strong>We only allowed 50 pcs on every product</strong>');
				setTimeout(function(){
					$("#errormsgcartitems").html("");
				}, 5000)
			}
			else{
				$("#quantitypanel" + prodid).removeClass("running");
				$("#txtquantity" + prodid).val(data)
				updatepayment_cart();
				updateitembadge();
			}
		}
	});
}
function decreaseitem(prodid){
	if(document.getElementById("txtquantity" + prodid).value == 1){
		$("#txtquantity" + prodid).addClass("bg-danger");
		setTimeout(function(){
			$("#txtquantity" + prodid).removeClass("bg-danger");
		}, 1000);
	}
	else{
		$.ajax({
			url: "php/cart.php",
			method: "POST",
			data: {prodid: prodid, action: "decreaseitem_cart"},
			beforeSend: function(){
				$("#quantitypanel" + prodid).addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#quantitypanel" + prodid).removeClass("running");
				$("#txtquantity" + prodid).val(data);
				updatepayment_cart();
				updateitembadge();
			}
		});
	}
}
function changequantity(prodid, quantity){
	if(quantity <= 0){
		$("#txtquantity" + prodid).val("");
		$("#txtquantity" + prodid).addClass("bg-danger");
		setTimeout(function(){
			$("#txtquantity" + prodid).removeClass("bg-danger");
		}, 1000)
	}
	else if(!$.isNumeric(quantity)){
		$("#txtquantity" + prodid).val("");
		$("#txtquantity" + prodid).addClass("bg-danger");
		setTimeout(function(){
			$("#txtquantity" + prodid).removeClass("bg-danger");
		}, 1000)
	}
	else if(quantity > 50){
		$("#txtquantity" + prodid).val("");
		$("#txtquantity" + prodid).addClass("bg-danger");
		setTimeout(function(){
			$("#txtquantity" + prodid).removeClass("bg-danger");
		}, 1000)
		$("#errormsgcartitems").html('<strong>We only allowed 50 pcs on every product</strong>');
		setTimeout(function(){
			$("#errormsgcartitems").html("");
		}, 5000)
	}
	else{
		$.ajax({
			url: "php/cart.php",
			method: "POST",
			data: {prodid: prodid, quantity: quantity, action: "changequantity_cart"},
			beforeSend: function(){
				$("#quantitypanel" + prodid).addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#quantitypanel" + prodid).removeClass("running");
				$("#txtquantity" + prodid).val(data)
				$("#txtquantity" + prodid).addClass("bg-info");
				setTimeout(function(){
					$("#txtquantity" + prodid).removeClass("bg-info");
				},1000)
				updatepayment_cart();
				updateitembadge();
			}
		});
	}
}
function updatepayment_cart(){
	$.ajax({
		url: "php/cart.php",
		method: "POST",
		data: {action: "totalpayment_text"},
		success: function(data){
			data = $.parseJSON(data);
			$("#totalpayment_cart").addClass("rubberBand green-text");
			setTimeout(function(){
				$("#totalpayment_cart").removeClass("rubberBand green-text");
			}, 1000)
			setTimeout(function(){
				$("#totalpym").text(data);
			}, 300)
		}
	});
}
function editannouncement(){
	var txt = document.getElementById("txtannouncement");
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {announce: txt.value, action: "editannouncement"},
		beforeSend: function(){
			$("#collapseannouncement").collapse('hide');
			$("#bqannouncement").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#bqannouncement").removeClass("running");
			$("#announcement").text(data);
			$("#bqannouncement").addClass("animated fadeIn");
			setTimeout(function(){
				$("#bqannouncement").removeClass("animated fadeIn");
			},1000);
		}
	});
}
function clearannouncement(){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {action: "clearannouncement"},
		beforeSend: function(){
			$("#collapseannouncement").collapse('hide');
			$("#clearannouncement").modal('hide')
			$("#bqannouncement").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#bqannouncement").removeClass("running");
			$("#announcement").text(data);
			$("#bqannouncement").addClass("animated fadeIn");
			setTimeout(function(){
				$("#bqannouncement").removeClass("animated fadeIn");
			},1000);
		}
	});
}
function editwork(){
	var txt = document.getElementById("txtwork");
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {work: txt.value, action: "editwork"},
		beforeSend: function(){
			$("#collapsework").collapse('hide');
			$("#bqwork").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#bqwork").removeClass("running");
			$("#work").text(data);
			$("#bqwork").addClass("animated fadeIn");
			setTimeout(function(){
				$("#bqwork").removeClass("animated fadeIn");
			},1000);
		}
	});
}
function clearwork(){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {action: "clearwork"},
		beforeSend: function(){
			$("#collapsework").collapse('hide');
			$("#clearwork").modal('hide')
			$("#bqwork").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#bqwork").removeClass("running");
			$("#work").text(data);
			$("#bqwork").addClass("animated fadeIn");
			setTimeout(function(){
				$("#bqwork").removeClass("animated fadeIn");
			},1000);
		}
	});
}
function initproductlist(){
	$.ajax({
		url: "php/product.php",
		method: "POST",
		data: {action: "productlist"},
		beforeSend: function(){
			$(".btnselectprod").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$(".btnselectprod").removeClass("running");
			$("#productlist").html(data);
			$("#productlistmodal").modal('show');
		}
	});
}
function selectfeaturedprod(prodid){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {prodid: prodid, action: "addfeaturedprod"},
		beforeSend: function(){
			$("#featuredprod").addClass("running");
			$("#productlistmodal").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#featuredprod").removeClass("running");
			$("#featuredprod").html(data);
			$("#featuredprod").addClass("animated fadeIn");
			setTimeout(function(){
				$("#featuredprod").removeClass("animated fadeIn");
			}, 1000)
		}
	});
}
function clearfeaturedprod(){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {action: "clearfeaturedprod"},
		beforeSend: function(){
			$("#featuredprod").addClass("running");
			$("#clearfeaturedprod").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#featuredprod").removeClass("running");
			$("#featuredprod").html(data);
			$("#featuredprod").addClass("animated fadeIn");
			setTimeout(function(){
				$("#featuredprod").removeClass("animated fadeIn");
			}, 1000)
		}
	});
}
function validateimage_addcarousel(){
    var fuData = document.getElementById('slideimage');
    var FileUploadPath = fuData.value;
    var size = fuData.files[0].size;
    var Extension = FileUploadPath.substring(
            FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
    if (Extension == "gif" || Extension == "png" || Extension == "bmp"
            || Extension == "jpeg" || Extension == "jpg") {
    	$("#errorcarousel").html("")
	    var file = fuData.files[0];
		var filename = fuData.value.split('\\').pop();
		$("#slidelabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return true;
    }
    else if(size > 10000000){
    	$("#errorcarousel").html("<strong>The size of image is too big</strong>");
        var file = fuData.files[0];
		var filename = fuData.value.split('\\').pop();
		$("#slidelabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
    else {
        $("#errorcarousel").html("<strong>Only images with JPG, JPEG, PNG</strong>");
        var file = fuData.files[0];
		var filename = fuData.value.split('\\').pop();
		$("#slidelabel").html('<i class="fa fa-file-photo-o" aria-hidden="true"></i> ' + filename);
        return false;
    }
}
function addslide(){
	var image = document.getElementById('slideimage');
	if(!image.value){
		$("#errorcarousel").html("<strong>Select Image</strong>");
	}
	else if(!validateimage_addcarousel()){

	}
	else{
		var form_data = new FormData();
		form_data.append("image", image.files[0]);
		form_data.append("action", "addslide");
		$.ajax({
			url: "php/settings.php",
			method: "POST",
			data: form_data,	
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function(){
				$("#divcarousel").addClass("running");
				$("#collapsecarousel").collapse('hide');
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#divcarousel").removeClass("running");
				$("#carouselslides").html(data);
				$("#carouselslides").addClass("animated fadeIn");
				setTimeout(function(){
					$("#carouselslides").removeClass("animated fadeIn");
				}, 1000);
			}
		});
	}
	
}
function clearcarousel(){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {action: "clearcarousel"},
		beforeSend: function(){
			$("#divcarousel").addClass("running");
			$("#clearcarousel").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#divcarousel").removeClass("running");
			$("#carouselslides").html(data);
			$("#carouselslides").addClass("animated fadeIn");
			setTimeout(function(){
				$("#carouselslides").removeClass("animated fadeIn");
			}, 1000)
		}
	});
}
function removeslide(id){
	$.ajax({
		url: "php/settings.php",
		method: "POST",
		data: {slideid: id, action: "removeslide"},
		beforeSend: function(){
			$("#divcarousel").addClass("running");
			$("#clearcarousel").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#divcarousel").removeClass("running");
			$("#carouselslides").html(data);
			$("#carouselslides").addClass("animated fadeIn");
			setTimeout(function(){
				$("#carouselslides").removeClass("animated fadeIn");
			}, 1000)
		}
	});
}
function addoptionaddress(){
	var name = document.getElementById("addressname");
	var address = document.getElementById("addressaddress");
	var contact = document.getElementById("addresscontact");
	if(!name.value && !address.value && !contact.value){
		$("#errormsgaddress").html("<strong>Please fill up the details</strong>");
	}
	else if(!name.value){
		$("#errormsgaddress").html("<strong>Please enter name</strong>");	
	}
	else if(!address.value){
		$("#errormsgaddress").html("<strong>Please enter address</strong>");
	}
	else if(!contact.value){
		$("#errormsgaddress").html("<strong>Please enter contact</strong>")
	}
	else{
		$.ajax({
			url: "php/account.php",
			method: "POST",
			data: {name: name.value, address: address.value, contact: contact.value, action: "addaddress"},
			beforeSend: function(){
				$("#divaddress").addClass("running");
				$("#collapseaddress").collapse('hide');
				name.value = "";
				address.value = "";
				contact.value = "";
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#divaddress").removeClass("running");
				$("#divaddress").html(data);
				$("#divaddress").addClass("animated fadeIn");
				setTimeout(function(){
					$("#divaddress").removeClass("animated fadeIn");
				}, 1000)
			}
		});
	}
}
function editoptionaddress(addid){
	var name = document.getElementById("editaddname" + addid);
	var address = document.getElementById("editaddadd" + addid);
	var contact = document.getElementById("editaddcontact" + addid);
	if(!name.value){
		$("#errormsgeditadd" + addid).html("<strong>Please enter name</strong>");
	}
	else if(!address.value){
		$("#errormsgeditadd" + addid).html("<strong>Please enter address</strong>");
	}
	else if(!contact.value){
		$("#errormsgeditadd" + addid).html("<strong>Please enter contact #</strong>");
	}
	else{
		$.ajax({
			url: "php/account.php",
			method: "POST",
			data: {addid: addid, name: name.value, address: address.value, contact: contact.value, action: "editoptaddress"},
			beforeSend: function(){
				$("#collapseeditaddress" + addid).collapse('hide');
				$("#divaddress").addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#divaddress").removeClass("running");
				$("#divaddress").html(data);
				$("#divaddress").addClass("animated fadeIn");
				setTimeout(function(){
					$("#divaddress").removeClass("animated fadeIn");
				}, 1000)
			}
		});
	}
}
function removeoptionaddress(addid){
	$.ajax({
		url: "php/account.php",
		method: "POST",
		data: {addressid: addid, action: "removeaddress"},
		beforeSend: function(){
			$("#collapseaddress").collapse('hide');
			$("#add" + addid).addClass("animated fadeOutRight");
		},
		success: function(data){
			data = $.parseJSON(data);
			setTimeout(function(){
				$("#add" + addid).removeClass("animated fadeOutRight");
				$("#divaddress").html(data);
				$("#divaddress").addClass("animated fadeIn");
			}, 800);
			setTimeout(function(){
				$("#divaddress").removeClass("animated fadeIn");
			}, 1000)
		}
	});
}
function removealloptaddress(){
	$.ajax({
		url: "php/account.php",
		method: "POST",
		data: {action: "removealladdress"},
		beforeSend: function(){
			$("#divaddress").addClass("running");
			$("#collapseaddress").collapse('hide');
			$("#deleteoptaddress").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#divaddress").removeClass("running");
			$("#divaddress").html(data);
			$("#divaddress").addClass("animated fadeIn");
			setTimeout(function(){
				$("#divaddress").removeClass("animated fadeIn");
			}, 1000);
		}
	});
}
function pickup(){
	$.post('php/checkout.php', {
		action: "delivery_pickup"
	});
}
function deliver(){
	$.post('php/checkout.php', {
		action: "delivery_deliver"
	});
}
function address(addid){
	$.post('php/checkout.php', {
		action: "pick_address",
		addid: addid
	});
}
function proceedtolvl2(){
	$.ajax({
		url: "php/checkout.php",
		method: "POST",
		data: {action: "proceedtolvl2"},
		beforeSend: function(){
			$(".ld-over").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#delivercircle i").removeClass("blue-text fa-circle flash infinite");
			$("#delivercircle i").addClass("green-text fa-check-circle wobble");
			$("#addresscircle i").removeClass("green-text fa-check-circle wobble");
			$("#addresscircle i").addClass("blue-text fa-circle animated flash infinite");
			setTimeout(function(){
				$("#delivercircle i").removeClass("animated wobble");
			}, 1000)
			$(".ld-over").removeClass("running fadeInRight");
			$(".ld-over").addClass("fadeOutLeft");
			setTimeout(function(){
				$("#divcheckout").html(data);
			}, 300)
		}
	});
}
function backtolvl1(){
	$.ajax({
		url: "php/checkout.php",
		method: "POST",
		data: {action: "backtolvl1"},
		beforeSend: function(){
			$(".ld-over").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#addresscircle i").removeClass("blue-text fa-circle flash infinite");
			$("#addresscircle i").addClass("fa-circle wobble");
			$("#delivercircle i").removeClass("green-text fa-check-circle")
			$("#delivercircle i").addClass("blue-text fa-circle animated flash infinite");
			setTimeout(function(){
				$("#addresscircle i").removeClass("animated wobble");
			}, 1000)
			$(".ld-over").removeClass("running fadeInRight");
			$(".ld-over").addClass("fadeOutRight");
			setTimeout(function(){
				$("#divcheckout").html(data);
			}, 300)
		}
	})
}
function proceedtolvl3(){
	$.ajax({
		url: "php/checkout.php",
		method: "POST",
		data: {action: "proceedtolvl3"},
		beforeSend: function(){
			$(".ld-over").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#addresscircle i").removeClass("blue-text fa-circle flash infinite");
			$("#addresscircle i").addClass("green-text fa-check-circle wobble");
			$("#ordercircle i").removeClass("green-text fa-check-circle wobble");
			$("#ordercircle i").addClass("blue-text fa-circle animated flash infinite");
			setTimeout(function(){
				$("#addresscircle i").removeClass("animated wobble");
			}, 1000)
			$(".ld-over").removeClass("running fadeInRight");
			$(".ld-over").addClass("fadeOutLeft");
			setTimeout(function(){
				$("#divcheckout").html(data);
			}, 300)
		}
	});
	
}
function proceedtolvl3_anon(){
	var email = document.getElementById("addemail");
	var name = document.getElementById("addname");
	var address = document.getElementById("addaddress");
	var contact = document.getElementById("addcontact");
	if(!name.value){
		$("#errormsgcheckoutaddress").html('<strong>Please enter your name</strong>');
	}
	else if(!address.value){
		$("#errormsgcheckoutaddress").html('<strong>Please enter your complete address</strong>');
	}
	else if(!contact.value){
		$("#errormsgcheckoutaddress").html('<strong>Please enter your contact number</strong>');
	}
	else{
		$.ajax({
			url: "php/checkout.php",
			method: "POST",
			data: {action: "proceedtolvl3_anon", email: email.value, name: name.value, address: address.value, contact: contact.value},
			beforeSend: function(){
				$(".ld-over").addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#addresscircle i").removeClass("blue-text fa-circle flash infinite");
				$("#addresscircle i").addClass("green-text fa-check-circle wobble");
				$("#ordercircle i").removeClass("green-text fa-check-circle wobble");
				$("#ordercircle i").addClass("blue-text fa-circle animated flash infinite");
				setTimeout(function(){
					$("#addresscircle i").removeClass("animated wobble");
				}, 1000)
				$(".ld-over").removeClass("running fadeInRight");
				$(".ld-over").addClass("fadeOutLeft");
				setTimeout(function(){
					$("#divcheckout").html(data);
				}, 300)
			}
		});
	}
	
}
function backtolvl2(){
	$.ajax({
		url: "php/checkout.php",
		method: "POST",
		data: {action: "backtolvl2"},
		beforeSend: function(){
			$(".ld-over").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#ordercircle i").removeClass("blue-text fa-circle flash infinite");
			$("#ordercircle i").addClass("fa-circle wobble");
			$("#addresscircle i").removeClass("green-text fa-check-circle")
			$("#addresscircle i").addClass("blue-text fa-circle animated flash infinite");
			setTimeout(function(){
				$("#ordercircle i").removeClass("animated wobble");
			}, 1000)
			$(".ld-over-full").removeClass("running fadeInRight");
			$(".ld-over-full").addClass("fadeOutRight");
			setTimeout(function(){
				$("#divcheckout").html(data);
			}, 300)
		}
	});
}
function ordercomplete(){
	$.ajax({
		url: "php/checkout.php",
		method: "POST",
		data: {action: "ordercomplete"},
		beforeSend: function(){
			$(".ld-over-full").addClass("running");
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#ordercircle i").removeClass("blue-text fa-circle flash infinite");
			$("#ordercircle i").addClass("green-text fa-check-circle wobble");
			setTimeout(function(){
				$("#ordercircle i").removeClass("animated wobble");
			}, 1000)
			$(".ld-over").removeClass("running fadeInRight");
			$(".ld-over").addClass("fadeOutLeft");
			setTimeout(function(){
				$("#divcheckout").html(data);
			}, 300)
			updateitembadge();
		}
	});
}
function acceptorder(id){
	$.ajax({
		url: "php/orders.php",
		method: "POST",
		data: {orderid: id, action: "acceptorder"},
		beforeSend: function(){
			$("#divpending").parent().parent().addClass("running");
			$("#divaccept").parent().parent().addClass("running");
			$("#divpending").removeClass("fadeIn");
			$("#divaccept").removeClass("fadeIn");
			$("#divpending").parent().removeClass("orderdiv");
			$("#divaccept").parent().removeClass("orderdiv");
		},
		success: function(data){
			data = $.parseJSON(data);
			if(data.addclass == true){
				$("#divpending").parent().addClass("orderdiv");
			}
			if(data.addclass2 == true){
				$("#divaccept").parent().addClass("orderdiv");
			}
			$("#divaccept").parent().parent().removeClass("running");
			$("#divpending").parent().parent().removeClass("running");
			$("#divpending").html(data.data);
			$("#divaccept").html(data.data2);
			$("#divpending").addClass("fadeIn");
			$("#divaccept").addClass("fadeIn");
		}
	});
}
function finishorder(id){
	$.ajax({
		url: "php/orders.php",
		method: "POST",
		data: {orderid: id, action: "finishorder"},
		beforeSend: function(){
			$("#divaccept").parent().parent().addClass("running");
			$("#divfinish").parent().parent().addClass("running");
			$("#divaccept").removeClass("fadeIn");
			$("#divfinish").removeClass("fadeIn");
			$("#divaccept").parent().removeClass("orderdiv");
			$("#divfinish").parent().removeClass("orderdiv");
		},
		success: function(data){
			data = $.parseJSON(data);
			if(data.addclass == true){
				$("#divaccept").parent().addClass("orderdiv");
			}
			if(data.addclass2 == true){
				$("#divfinish").parent().addClass("orderdiv");
			}
			$("#divaccept").parent().parent().removeClass("running");
			$("#divfinish").parent().parent().removeClass("running");
			$("#divaccept").html(data.data);
			$("#divfinish").html(data.data2);
			$("#divaccept").addClass("fadeIn");
			$("#divfinish").addClass("fadeIn");
		}
	});
}
function completeorder(id){
	$.ajax({
		url: "php/orders.php",
		method: "POST",
		data: {orderid: id, action: "completeorder"},
		beforeSend: function(){
			$("#divfinish").parent().parent().addClass("running");
			$("#divfinish").removeClass("fadeIn");
			$("#divfinish").parent().removeClass("orderdiv");
		},
		success: function(data){
			data = $.parseJSON(data);
			if(data.addclass == true){
				$("#divfinish").parent().addClass("orderdiv");
			}
			$("#divfinish").parent().parent().removeClass("running");
			$("#divfinish").html(data.data);
			$("#divfinis").addClass("fadeIn");
		}
	});
}
function cancelorder(){
	var id = document.getElementById("orderidholder");
	$.ajax({
		url: "php/orders.php",
		method: "POST",
		data: {orderid: id.value, action: "cancelorder"},
		beforeSend: function(){
			$("#myorders").parent().addClass("running");
			$("#myorders").removeClass("fadeIn");
			$("#cancelordermodal").modal('hide');
		},
		success: function(data){
			data = $.parseJSON(data);
			$("#myorders").parent().removeClass("running");
			$("#myorders").html(data);
			$("#myorders").addClass("fadeIn");
		}
	})
}
function declineorder(id){
	$.ajax({
		url: "php/orders.php",
		method: "POST",
		data: {orderid: id, action: "declineorder"},
		beforeSend: function(){
			$("#divpending").parent().parent().addClass("running");
			$("#divpending").removeClass("fadeIn");
			$("#divpending").parent().removeClass("orderdiv");
		},
		success: function(data){
			data = $.parseJSON(data);
			if(data.addclass == true){
				$("#divpending").parent().addClass("orderdiv");
			}
			$("#divpending").parent().parent().removeClass("running");
			$("#divpending").html(data.data);
			$("#divpending").addClass("fadeIn");
		}
	});
}
function checkemail(){
	var email = document.getElementById("forgotemail");
	if(!email.value){
		$("#errormsgforgotpass").html('<strong>Please enter you email</strong>');
	}
	else{
		$.ajax({
			url: "php/account.php",
			method: "POST",
			data: {action: "checkemail", email: email.value},
			beforeSend: function(){
				$("#btnforgotpass").addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				if(!data){
					$("#btnforgotpass").removeClass("running");
					$("#errormsgforgotpass").html('<strong>Email not found</strong>');
				}
				else{
					$("#btnforgotpass").removeClass("running");
					$("#errormsgforgotpass").removeClass("error");
					$("#errormsgforgotpass").addClass("green-text h6-responsive text-center");
					$("#errormsgforgotpass").html("<strong>Verification link has been sent to your email</strong>");
					setTimeout(function(){
						$("#modalLogin").modal('hide');
					}, 5000)
				}
			}
		})
	}
}
function newpassword(){
	var password1 = document.getElementById("changepass1");
	var password2 = document.getElementById("changepass2");
	if(!password1.value){
		$("#errormsgnewpass").html('<strong>Please enter new password</strong>');
	}
	else if(!password2.value){
		$("#errormsgnewpass").html('<strong>Please confirm new password</strong>');
	}
	else if(password1.value != password2.value){
		$("#errormsgnewpass").html('<strong>Password do not match</strong>');
	}
	else{
		$.ajax({
			url: "php/account.php",
			method: "POST",
			data: {action: "newpassword", password: password1.value},
			beforeSend: function(){
				$("#btnconfirmnewpass").addClass("running");
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#divchangepass").addClass("animated fadeOut");
				setTimeout(function(){
					$("#divchangepass").removeClass("fadeOut");
					$("#divchangepass").html(data);
					$("#divchangepass").addClass("fadeIn");
				}, 500)
			}
		})
	}
}
function sendreply(){
	var email = document.getElementById("emailholder");
	var message = document.getElementById("txtreply");
	var name = document.getElementById("nameholder");
	var client_msg = $("#messagebody").text();
	if(!message.value.trim()){
		$("#errormsgreply").html('<strong>Please enter your message</strong>');
	}
	else{
		$.ajax({
			url: "php/message.php",
			method: "POST",
			data: {action: "sendreply", message: message.value, email: email.value, client_msg: client_msg, name: nameholder.value},
			beforeSend: function(){
				$("#btnreply").addClass("running");
			},
			success: function(data){
				$("#btnreply").removeClass("running btn-info");
				$("#btnreply").addClass("btn-success");
				$("#btnreply").html('<i class="fa fa-check" aria-hidden="true"></i> Sent');
				setTimeout(function(){
					$("#viewmodal").modal('hide');
				}, 2000)
			}
		})
	}
}