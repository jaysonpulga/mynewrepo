<style>
.innertube_design
{
	padding-left:15px;
	padding-right:15px;
	padding-top:10px;
	padding-bottom:1px
}
.footer_design
{
	padding-left:8px;
	padding-right:8px;
	padding-top:5px;
	padding-bottom:5px;
	background-color:#e4e4e4;

	
}

.btn2-default {
	background-color: #cec8c8;
	color: #444;
	border-color: #fff;
}

.btn2-primary {
	background-color: #3c8dbc;
	color: #fff;
	border-color: #fff;
}


.btn2 {
	display: inline-block;
	padding: 3px 10px;
	margin-bottom: 0;
	font-size: 14px;
	font-weight: 400;
	line-height: 1.42857143;
	text-align: center;
	white-space: nowrap;
	vertical-align: middle;
	-ms-touch-action: manipulation;
	touch-action: manipulation;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	background-image: none;
	border: 1px solid transparent;
	border-radius: 15px;
}


#image_div {
    width: 450px;
    position: relative;
}
#image_div img {
    width: 100%;
}

#image_div #image_label {
    position: absolute;
    top: 152px;
    margin-left: 30px;
    font-size: 35px;
}

#image_div #image_label_name {
    position: absolute;
    bottom: 7px;
    margin-left: 30px;
    font-size: 23px;
}

#image_div #image_label span {
    background-color: transparent;
    padding: 7px;
    box-sizing: border-box;
    color: white;
    font-weight: normal;
}

#image_div #image_label_name span {
    background-color: transparent;
    padding: 7px;
    box-sizing: border-box;
    color: white;
    font-weight: normal;
}

</style>
	
	


<?php 
	 $GetCurrentAmount =  App\Http\Controllers\frontend\UserVccController::GetCurrentAmount();
	 $getVCC_id =  App\Http\Controllers\frontend\UserVccController::getVCC_id();		
	 $wallet_amount = App\Http\Controllers\frontend\UserDashboardController::getWalletAmount();
?>
	
<div style='clear:both;margin-top:10px'></div>			
<div class='row'>
	<div class="col-sm-6">					
			<h4>Hello {{Auth::user()->name}} <span id='count_notif'></span>  </h4>
			<span id='notif_dash'> </span>
	<br>
	</div>
    <div class="col-sm-6">
		<span id='visa-card' class="pull-right">
			 <div class="small-box bg-aqua">
			     <a href="{{asset('user/mywallet')}}">
					<div class="innertube_design" style="color:white;">
						<center>
							<span style='font-size:16px;border-bottom:1px solid #fff'>Your Virtual Wallet</span><br>
							<span style='font-size:25px'><b><span>$<?php echo  number_format(@$wallet_amount, 2, '.', ' ') ; ?></span></span></span></b>
						</center>
					</div>
					</a>
					<div class=" footer_design">
						<center>
							<span><a href="javascript:void(0)" class="btn2 btn2-default" id="transactionxx" >Transactions</a></span>
							<input  type="hidden" name="cc_id" id="cc_id" value="{{ $getVCC_id }}">
							<!--<span><a href="#" class="btn2 btn2-primary" id="btnShowInfo" >View Visa Card</a></span>-->
						</center>
						
						
						<a class="showmodalmessage">test </a>
					</div>

			 </div>
		</span>
	</div>
	<!--<div class="col-sm-6">-->
	<!--	<span id='visa-card' class="pull-right">-->
	<!--		 <div class="small-box bg-aqua">-->
	<!--				<div class="innertube_design">-->
	<!--					<center>-->
	<!--						<span style='font-size:16px;border-bottom:1px solid #fff'>Your Virtual Wallet</span><br>-->
							<!--<span style='font-size:25px'><b><span>$<?php echo  number_format($GetCurrentAmount, 2, '.', ' ') ; ?></span></b></span>-->
	<!--						<span style='font-size:25px'><b><span>$<span id='myvcc'>0.00</span></span></span></b>-->
	<!--					</center>-->
	<!--				</div>-->
	<!--				<div class=" footer_design">-->
	<!--					<center>-->
	<!--						<span><a href="javascript:void(0)" class="btn2 btn2-default" id="transactionxx" >Transactions</a></span>-->
	<!--						<input  type="hidden" name="cc_id" id="cc_id" value="{{ $getVCC_id }}">-->
	<!--						<span><a href="#" class="btn2 btn2-primary" id="btnShowInfo" >View Visa Card</a></span>-->
	<!--					</center>-->
	<!--				</div>-->

	<!--		 </div>-->
	<!--	</span>-->
	<!--</div>-->
</div>

<!--///Manychat widget facebook send me message -->
<!--
<div class='row'>
    <div class="mcwidget-embed" data-widget-id="7287534"></div>
</div>
-->

<div id="showInfo" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><center>Your Virtual Credit Card</center></h4>
          </div>
          <div class="modal-body" id="showinfo_mb">
            LOADING DATA. . . . . . . . . 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->

<style>
    #show_transaction .modal-dialog .modal-content {
    border-radius: 32px !important;
}
</style>

<div id="show_transaction" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><center>Transaction History</center></h4>
          </div>
          <div class="modal-body" id="showinfo_images">
        
                 <table id="transactionTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Claimed At</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>    
                </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
 </div>
<!-- /.content -->



<script type="text/javascript">
$(document).ready(function(){
	checkVirtualCCamount();
	Notification();
	GetNotificationDashboard();
});

                                        


function removeitem(notif_id,offer_id,idx)
{
    //alert(notif_id + ' ' + offer_id + ' ' + id );
    // $('#div_'+idx).fadeOut(300, function(){ $('#div_'+idx).remove();});
    
       $.ajax({
        
    		url: "{{asset('user/remove/item_notification')}}",
    		type: 'POST',
    		data: {"_token":$('#token').val(),notif_id:notif_id,offer_id:offer_id,idx:idx},
    		success: function(data)
    		{
    			
    	    	console.log(data);
    	    	
    	    	if(data == "save")
    	    	{
    	    	    
    	    	    $('#div_'+idx).fadeOut(300, function(){ $('#div_'+idx).remove();});
    	    	    GetNotificationDashboard();
    	    	}
    			
    		},
    		error: function(error){ 
    			console.log(error);
    		}
    
    });
    
}





function Notification()
{
	
	
		$.ajax({
		url: "{{asset('user/get/notification')}}",
		type: 'POST',
		data: {"_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
			
			var datax = '';
			
			console.log(data.all_notif);
			console.log(data.count_new_notif);
			
			if(data.count_new_notif.length > 0)
			{
				
				$('#notif').removeClass('hidden').addClass('show').empty().html(data.count_new_notif.length);
				$('#notif_header').removeClass('hidden').addClass('show').empty().html('You have '+data.count_new_notif.length+' notification(s)');
			
			}
			else
			{
				$('#notif').removeClass('show').addClass('hidden');
				$('#notif_header').removeClass('hidden').addClass('show').empty().html('You dont have new notification');
			}
			
			if(data.all_notif.length > 0 )
			{
				
				
				
				$.each( data.all_notif, function( i, val ) 
				{
					
					
						if(val.notif_read == 0)
						{
							var val_msg = "<strong><span>" + val.notif_message + " <b>"+ val.Title.slice(0, 15)+ '</b>' +   (val.Title.length > 15 ? "..." : "") +  "</span></strong>";
						}
						else
						{
							var val_msg = "<span>" + val.notif_message + " <b>"+ val.Title.slice(0, 15)+ '</b>' +   (val.Title.length > 15 ? "..." : "") + " </span>";
						}
						
						
					
			
					  datax  += "<li>";
					  datax  +=  "<a  href="+val.url+" id='offer_details'   data-offer_id="+val.offer_id+"  data-user_id="+val.user_id+" data-notif_read="+val.notif_read+"  >";
					  datax  +=  "<div class='contain'><div class='div1'>" +val.icon+ "</div> <div class='div2'>"+val_msg+"</div> </div>";
					  datax  += "</a>";
					  datax  += "</li>";
				
						
				
				
				
				});

	  
				$('#ulbody').empty().html(datax);
						
			}
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
	
	
}





function checkVirtualCCamount()
{
	
	
		$.ajax({
		url: "{{route('checkVirtualCCamount')}}",
		type: 'GET',
		data: {"_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
			if(data.length > 0)
			{
				//$('#myvcc').empty().append(data[0].virtual_amount);
				getVCCamountinBento(data[0].cc_id);
			}
			
		},
		error: function(error){ 
			console.log(error);
		}

	});
	
	
}

function getVCCamountinBento(cc_id)
{
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/retrivecard",		
		type: 'POST',		
		data: {cardid:cc_id},			
		success: function(data){
				
			var info = $.parseJSON(data);
			var spend_amount = info.spendingLimit;
			$('#myvcc').empty().append(spend_amount.amount.toFixed(2));

		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
}



</script>



<script type="text/javascript">

count_unreadInbox();
function count_unreadInbox()
{

 var number= Math.floor(Math.random() * 230) + 999;

	
	$.ajax({
			url : "{{asset('mail/getnumber/message/unread')}}",
			dataType: "JSON",
			success: function(response)
			{
	
				//alert(response.unread_inbox);
				
				if(response.unread_inbox != 0)
				{
					$('.count_unread').empty().append(response.unread_inbox);
					

				}
				if(response.unread_inbox == 0)
				{
					$('.count_unread').empty();

				}
				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				console.log('Error checking count unread message');
			}
	});
	
}
 
</script> 



<script>
$(document).ready(function () 
{
	
    // Read the cookie and if it's defined scroll to id

	var div_id = 	sessionStorage.getItem("div_id");
    if(div_id) { scrollToID(div_id, 1000); }

	// Handle event onclick, setting the cookie when the href != #
   $(document).on("click", "#offer_details", function(e){
	   
	
		
		var current_url = window.location.href;
		
        e.preventDefault();
        var offer_id = $(this).data('offer_id');
		var user_id = $(this).data('user_id');
		var notif_read = $(this).data('notif_read');
		var href = $(this).attr('href');
		
		sessionStorage.setItem("div_id",offer_id);

		if(href == current_url)
		{
			scrollToID(offer_id, 1000);
        }
		else
		{	
           window.location.href = href;
        }
		
		if(notif_read == 0)
		{
			read_notification(offer_id,user_id); // update notification mark as read;
		}

	});
	 

  

    // scrollToID function
    function scrollToID(offer_id, speed) 
	{
	
		
		if(offer_id)
		{
			
		
			setTimeout(function()
			{
				
					
				var offSet = 70;
				var obj = $('#'+offer_id).offset();
				var targetOffset = obj.top - offSet;
				$('html,body').animate({ scrollTop: targetOffset }, speed);
				
				sessionStorage.removeItem('div_id');
	
			
			}, 500);
		
		}
		
		
    }
});
</script>






<script>
function read_notification(offer_id,user_id)
{
	
	var result_amazon =  $.xResponseupdate("{{asset('user/get/read_notification')}}",{"offer_id":offer_id,"_token":$('#token').val(),"user_id":user_id});
	

	if(result_amazon.status == "success")
	{
		
		Notification();
	}
}
</script>

<script>
$.extend({
    xResponseupdate: function(url, data) {
        // local var
        var theResponse = null;
        // jQuery ajax
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
			dataType: "json",
            async: false,
            success: function(respText) {
                theResponse = respText;
            }
        });
        // Return the response text
        return theResponse;
    }
});
</script>






<script>
var loading = "";

function createNewAccountVcc()
{

	const inputvalue = { 
		"fname"   : "{{Auth::user()->name}}",				  
		"lname"   : "", 			  
		"strt"    : "Street",				  
		"city"    : "CITY",				 
		"state"   : "AL",				  
		"zip"	  : "9002",				  
		"amount"  : 1			
	};
		
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/runmanualgen",		
		type: 'POST',		
		data: inputvalue,
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Getting Information....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},		
		success: function(data){
			
			console.log(data);
			
			var array = JSON.parse(data);
			
			//console.log(array);
			//alert(array['cardID'] + '' + array['amount']);
			
			if(data.length > 0)	
			{				
				var result = $.xResponse("{{route('createUserVirtualcc')}}",{'cc_id':array["cardID"],'virtual_amount':array["amount"],"_token":$('#token').val()});	
				if(result == "success")
				{
					showTableinfo(array["cardID"]);
					loading.waitMe('hide');
				}
			}		
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
	
}
</script>


<script>

function getCardID()
{
	
	var CardID = $.xResponse("{{route('getCardID2')}}",{"_token":$('#token').val()});
	showTableinfo(CardID);
}
</script>


<script>
function showTableinfo(cc_id)
{
	$("#showInfo").modal("show");
	var html = '';
	$.post('https://fncc.herokuapp.com/api/getinfo', {cardid:cc_id}, function(data){
		
		var info = $.parseJSON(data);
		 console.log(info);
		var cardimp = info.body;
		var userinfo = info.infos.data;
		var locinfo = info.infos.body;
		var spend = userinfo.spendingLimit;
		 
		let dummyTxt=cardimp.pan

		let joy=dummyTxt.match(/.{1,4}/g);
		var ccid = (joy.join(' '));

		html +=  '<center>';
		html +=  '<div id="image_div">';
		
		html +=  '<input type="hidden" value='+cardimp.pan+' id="cardnumber_cvv" />';
		html +=  '<input type="hidden" value='+userinfo.expiration+' id="expiration" />';
		html +=  '<input type="hidden" value='+cardimp.cvv+' id="cvv" />';
		
		html +=  '<img src="{{ asset('public/azmproject_images/visacard.png')}} ">';
		html +=  '<p id="image_label"><span>'+ccid+'</span></p>';
		html +=  '<p id="image_label_name"><span>'+userinfo.alias+'</span></p>';
		html +=  '</div>';
		html +=  '<br><div>';
		html +=  '<p><a href="javascript:void(0)" id="send_email_cc" >Click here</a> to email your credit card code and card valid date</p>';
		html +=  '</div>'
		html +=  '</center>';
		
		 
		 
		$("#showinfo_mb").empty();
		$("#showinfo_mb").empty().append(html);
		// console.log(user.firstName);
	});
}
</script>

<script>
$(document).on("click", "#send_email_cc", function()
{
   //alert('This information has been sent to the email in your profile');
   
   
   var cardnumber_cvv = $('#cardnumber_cvv').val();
   var expiration = $('#expiration').val();
   var cvv = $('#cvv').val();
   
   $.ajax({		
		url: "{{route('SendEmailVccinformation')}}",		
		type: 'POST',		
		data: {"_token":$('#token').val(),cardnumber_cvv:cardnumber_cvv,expiration:expiration,cvv:cvv},
		beforeSend: function() {
					
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Sending Virtual Card Information.........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
					
		},		
		success: function(data)	{
			
        	loading.waitMe('hide');
        	
        	swal({
					  title: "",
					  text:  data,
					  type: 'success',
					}).then(function (result) {

				}); 
		
		
		
		
		
			
		},		
		error: function(error){ 		
		console.log(error);		
		}	
	});	


});
</script>


<script>
function checkifhaveAlreadyVcc()
{
	$.ajax({		
		url: "{{route('checkifhaveAlreadyVcc')}}",		
		type: 'POST',		
		data: {"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
					
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Updating Virtual Card.........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
					
		},		
		success: function(data)	{
			
			if(data.status =='existAccount')
			{
		
				getVccAccountUser(data.cc_id);
	
			}
			else if(data.status =='noAccount')
			{
				submit_andcreateCard();
			}
			else
			{
				submit_andcreateCard();
			}
			
		},		
		error: function(error){ 		
		console.log(error);		
		}	
	});	
}
</script>

<script>
$(document).on("click", "#btnShowInfo", function()
{
    
	var result = $.xResponse("{{route('checkifhaveAlreadyVcc2')}}",{"_token":$('#token').val()});
	
	if(result == "noaccount")
	{	
		// create new Vcc account
		createNewAccountVcc();
		
	}
	else if(result == "existaccount")
	{
		//get information of existing  Vcc Account
		getCardID();
	}
	else
	{
		alert('error');
	}


});
</script>


<script>
var table;

// $(document).on("click", "#transactionxx", function()
// {
// $("#show_transaction").modal("show");    
// table =  $('#transactionTable').DataTable({ 

//                 	"order":[],
//                 	"processing": true, //Feature control the processing indicator.
//                 	//"serverSide": true,
//                 	// Load data for the table's content from an Ajax source
//                 	/*
//                 	'language': {
//                             'loadingRecords': '&nbsp;',
//                           'processing': '<div class="spinner"></div>'
//                     },
//                 	*/
//                 	"ajax": {
//                 		"url": "{{asset('transaction')}}",
//                 		"data" : {id:'{{Auth::user()->id}}', _token: "{{csrf_token()}}"},
//                 		"type": "post",
//                 	},
//                 	"bDestroy": true,
//                 	"columns"    : [
//                 	//{'data': 'id'},
//                 	{'data': 'product_name'},
//                 	{'data': 'pay_method'},
//                 	{'data': 'virtual_amount'},
//                 	{'data': 'created_at'},
//                 	],
                
//                 	"fnRowCallback": function( nRow, aData, iDisplayIndex) {
//                 	$(nRow).attr("id",aData['id']);
//                 	return nRow;
//                 	},
                
//      }); 
	 
	
// });
$(document).on("click", "#transactionxx", function()
{
    $("#show_transaction").modal("show");    
    table =  $('#transactionTable').DataTable({ 
                    	"order": [[ 0, "desc" ]],
            "iTotalRecords": "0",
            "ajax": {
              "url": "{{asset('user/unpaid_campaign')}}",
              "dataSrc": function(json){                
                if(json.data == null){
                  return [];
                }
                console.log(json.data)
                return json.data;
              }
            },
            "bDestroy": true,
              "columns": [
            {'data':'image',"width":'351px','classname':'row_overflow'}, 
            {"data":'claimed_at'},
            {'data':'status'},
            {'data': 'id',render:function(data){
                return '<a href="#" class="btn btn-sm btn-info btn-flat pull-left loading">Campaign Details</a>';
            }},
          ],
                    
    }); 
});
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}    
</script>
<style>
    .row_overflow{
        white-space: nowrap; 
          width: 100px; 
          overflow: hidden;
          text-overflow:ellipsis;
          border: 1px solid #000000;
    }
</style>


<script>
function GetNotificationDashboard()
{
	
	    var datax = '';
		$.ajax({
		url: "{{asset('user/get/getdashboard_notofication')}}",
		type: 'POST',
		data: {"_token":$('#token').val()},
		dataType: 'json',
		success: function(data)
		{
		   
		    if(data.all_notif.length == 0)
			{
				$('#count_notif').empty().html('<span style="font-size:12px" >- you have no action yet</span>');
			}
			else if(data.all_notif.length == 1)
			{
				$('#count_notif').empty().html('- you have '+data.all_notif.length+' action');
			}
			else if(data.all_notif.length > 1)
			{
				$('#count_notif').empty().html('- you have '+data.all_notif.length+' actions');
			}
			
			
			
			$.each( data.all_notif, function( i, val ) 
			{
					
			       
					  datax  += "<div id='div_"+val.id+"' >";
					  datax  += "- "+val.action_status;
					  datax  +=  "<a href='javascript:void(0)' onclick='removeitem("+val.notif_id+","+val.offer_id+","+val.id+")'   title='remove notification'  class='remove_notifxx'  data-notif_id="+val.notif_id+"  data-offer_id="+val.offer_id+" data-id="+val.id+"  >";
                      datax  += "<i class='fa fa-fw fa-close'></i>";
					  datax  += "</a>";
					  datax  += "</div>";
					  
					  if (i++ == 2) return false;;
				
						
				
				
				
			});
			
			$('#notif_dash').empty().html(datax);
			
			
		    //console.log(data);
		},
		error: function(error){ 
			console.log(error);
		}

	});
	
	
}
</script>




