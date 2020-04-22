<script id="feedback-template" type="text/template">
	<div class="row" style='margin-top:20px;'>
		<div class="col-lg-12">
			<div class="form-group has-feedback">
				<div class="col-lg-12">
					<div class="callout callout-info">
						<strong style="font-size:22px;"> Hi {{Auth::user()->name}} ! </strong><br><br>
						<span style="font-size:16px">We find that your feedback is great on our product survey, would  you like to post it in amazon where you purchased our product to redeem us rewards and get points?<span><br>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$( ".accept_feedback" ).click(function() {
			var template = $('#feedback_form-template').html();
			$("#target_panel").empty().hide().append(template).animate({ opacity: "show" }, "slow");
		});
	</script>
</script>

<script id="alreadysubmit-template" type="text/template">
	<div class="row" style='margin-top:20px;'>
		<div class="col-lg-12">
			<div class="form-group has-feedback">
				<div class="callout callout-success">
					<strong style="font-size:22px;"> Hi {{Auth::user()->name}} ! </strong><br><br>
					<span style="font-size:16px">You have already submitted a screenshot of the Amazon survey , now you have received extra rebate cashback: ${{$fee_amazon_rebate}}, 
					
				</div>
			</div>
		</div>
	</div>
	<script>
		$( ".accept_feedback" ).click(function() {
			var template = $('#upload-form-template').html();
			$("#target_panel").empty().hide().append(template).animate({ opacity: "show" }, "slow");
		});
	</script>
</script>



<script id="upload-form-template" type="text/template">
<div class="row">
	<div class="form-group">
		<div class="col-sm-12">
			<div class="header_question">
				<div class="row">
					<div class="col-sm-12">
						<p style='font-size:16px'></p>
					</div>
				</div>
			</div>
			<div class="content_question">	
				<div class="form-group">			
					<h4><i class="fa fa-fw fa-info-circle"></i> instruction</h4>	
					<p style="font-size:16px">
					<ul>
					  <li>Copy your answer to amazon survey same as you filled in our product survey</li>
					  <li>Make a screen shot of your reviewed and upload it here</li>
					  <li>Wait for admin approval and earn points</li>
					</ul>  
					</p>
					<form id="amazon_submit_file" method="post"> 
						<input type="file" required  name='upload_file_amazon' accept=".jpg,.jpeg.,.gif,.png,.mov,.mp4,.mp3"  /><br>
						<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-upload"></i> upload screen shot</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<script>
var loading ="";
$("#amazon_submit_file").on("submit", amazon_submit_file);

function amazon_submit_file(event)
{
	
	event.preventDefault();	
	var formData = new FormData(this);
	
	formData.append('offerid',"{{$offerdetails[0]->id}}");
	formData.append('_token',$('#token').val());
	formData.append('amazon_rebate',"{{$fee_amazon_rebate}}");
	
	
	// save data template
    $.ajax({
		url 	: "{{ asset('submit_your_amazon_ss_file')}}",
		type	: "POST",
		data	: formData,
		processData: false,
		contentType: false,
		beforeSend: function() {
					

			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Submiting your file ........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},
        success: function(data)
        {
			console.log(data);
			loading.waitMe('hide');
		
			if(data.success == 'success') //if success close modal and reload student table
            {
             
					swal({
					  title: 'Successfully Submited',
					  text:  " Thank you for submitting a survey on amazon, now you have received extra rebate cashback: ${{$fee_amazon_rebate}}.",
					  type: 'success',
					}).then(function (result) {

						var template = $('#thanks-template').html();
						$("#target_panel").empty().append(template);
					  
					});
				
            }
				
		
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			loading.waitMe('hide');
            alert('Error adding / update data');
        }
    }); 				

	
}    
</script>
</script>





<script id="thanks-template" type="text/template">

</script>


<script id="approved-template" type="text/template">
<div class="row" style='margin-top:20px;'>
	<div class="col-lg-12">
		<div class="form-group has-feedback">
			<div class="callout callout-info">
				<div style='font-size:17px;color:#fff'>
					<p><strong style="font-size:22px;"> Hi {{Auth::user()->name}} ! </strong><p>
            		<b>Thank you for your uploading your review on amazon, you received ${{@$fee_product_purchased}} to your vcc account</b><br>
            		<span style="font-size:14px">The Admin approved your file </span><br>
					<span style="font-size:14px" id='remarks'></span>
            	</div>
        	</div>
		</div>
	</div>
</div>
</script>


<script id="Rejected-template" type="text/template">
<div class="row" style='margin-top:20px;'>
	<div class="col-lg-12">
		<div class="form-group has-feedback">
				<div class="callout callout-success">
					<p><strong style="font-size:22px;"> Hi {{Auth::user()->name}} ! </strong></p>
					<span style="font-size:16px">Sorry, your file is rejected</span><br>
					<span id='remarks'></span>
				</div>
		</div>
	</div>
</div>
</script>



<script id="question-template" type="text/template">
<div class="row" style='margin-top:10px;'>
	<div class="form-group">
		<div class="col-lg-12">
			<div class="header_question">
				<div class="row">
					<div class="col-md-12">
						<p style='font-size:16px'></p>
					</div>
				</div>
			</div>
			
			<div class="content_question">	
				<div class="form-group">			
					<P>Thank you for answering our product survey, it looks like you enjoyed the product.</P>
					<P>Do you want to post your review on amazon?</P>
					<input id="yes" name="positit1" value="yes" type="radio"><label>&nbsp; <label for="yes">Yes</label> </label><br>
					<input id="no" name="positit1" value="no" type="radio"><label>&nbsp; <label for="no">No</label> </label>
					<br><br>
					<button  type="button" onclick='didyouppost()' class="btn btn-warning accept_feedback">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
</script>

<script id="willyou-template" type="text/template">
<div class="row" style='margin-top:10px;'>
	<div class="form-group">
		<div class="col-lg-12">
			<div class="header_question">
				<div class="row">
					<div class="col-md-12">
						<p style='font-size:16px'></p>
					</div>
				</div>
			</div>
			
			<div class="content_question">	
				<div class="form-group">			
					<P>Will you post your review in amazon within 5 days ?</P>
					<input id="yes" name="positit2" value="yes" type="radio"><label>&nbsp; <label for="yes">Yes</label> </label><br>
					<input id="no" name="positit2" value="no" type="radio"><label>&nbsp; <label for="no">No</label> </label>
					<br><br>
					<button  type="button"  onclick='willyoupost()' class="btn btn-warning accept_feedback">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
</script>


<script id="thankyou-template" type="text/template">
	<div style='border-radius:16px;background-color:#7bc7ea;padding:5px;text-align:center;font-size:17px;color:#fff'>
		<b>Thank you for submitting your product review you received ${{@$fee_product_purchased}} to your vcc account</b>
	</div>
</script>



<script id="thankyou-withoutpoint-template" type="text/template">
	<div style='border-radius:16px;background-color:#7bc7ea;padding:5px;text-align:center;font-size:17px;color:#fff'>
		<b>Thank you for taking our product reviews, you may continue to mark as completed this offer</b>
	</div>
</script>




<script>
$.extend({
    xResponseABC: function(url, data) {
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



<script type="text/javascript">
function checkifyouareallowtosubmit_amazonfile(rating_star_value)
{

    var result_amazon =  $.xResponseABC("{{asset('checkif_alreadysubmitedamazonsurvey_file')}}",{offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()});


    var star_val = rating_star_value.split("and");
	
	if(star_val[1])
	{
		var star_replace = star_val[1].replace("half", .5);
		var new_rate = (Number(star_val[0]) + Number(star_replace));
	}
	else
	{
		var new_rate = star_val[0];
	}
		
		
		
		

	if(new_rate >= 3 && result_amazon.status == "notyet_submited")
	{
	    
		var template = $('#question-template').html();
		$('#target_panel').empty().html(template);
		
		
		$('html, body').animate({
            scrollTop: $('html, body').offset().top
        }, 500);
                
	
	}
	else if(new_rate >= 3 && result_amazon.status == "already_submited")
	{
		
		
		if(result_amazon.data['didyoupost_in_amazon'] == "no")
		{
			var template = $('#thankyou-withoutpoint-template').html();
			$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
			return false;
		}
	
		
		if(result_amazon.data['didyoupost_in_amazon'] == "yes" && result_amazon.data['file_path'] == "")
		{
			var template = $('#upload-form-template').html();
			$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
			return false;
		}
	
	
		
		if(result_amazon.data.status == "approved")
		{
			
		
			var template = $('#approved-template').html();
			$('#target_panel').empty().html(template);
			$('#remarks').empty().html('remarks: ' + result_amazon.data.remarks);
			return false;
			
			
		}
		else if(result_amazon.data.status === "rejected")
		{
		
			var template = $('#Rejected-template').html();
			$('#target_panel').empty().html(template);
			$('#remarks').empty().html('remarks: ' + result_amazon.data.remarks);
			return false;
			
		}
		else
		{
		
			
			var template = $('#alreadysubmit-template').html();
			$('#target_panel').empty().html(template);
		}
	
	}
	


}
</script>


<script type="text/javascript">
function checkifyouareallowtosubmit_amazonfile_copy_and_disabledmuna(rating_star_value)
{

    var result_amazon =  $.xResponseABC("{{asset('check_survey_amazon_to_earn')}}",{offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()});
    
    	
	if(result_amazon.data != "")
	{
		
		if(result_amazon.data['didyoupost_in_amazon'] == "yes")
		{
			 var template = $('#upload-form-template').html();
			$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
		
		}
		else if(result_amazon.data['didyoupost_in_amazon'] == "no")
		{
			
			var template = $('#thankyou-withoutpoint-template').html();
			$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
			
		}
		
		return false; 
	}

		
	var star_val = rating_star_value.split("and");
	
	if(star_val[1])
	{
		var star_replace = star_val[1].replace("half", .5);
		var new_rate = (Number(star_val[0]) + Number(star_replace));
	}
	else
	{
		var new_rate = star_val[0];
	}
	
	// if pasado at mataas sa number 3
	if(new_rate >= 3)
	{
		//$('#fourtstep').addClass('done');	
		var template = $('#question-template').html();
		$('#target_panel').empty().html(template);
	
	}
	
	


}
</script>



<script>
var loading = "";
function didyouppost()
{
	
	
	var positit1 =  $("input[name='positit1']:checked").val();
	
	$.ajax({
		url: "{{asset('submit_survey_amazon_continue')}}",
		type: 'POST',
		data: {didyoupost_in_amazon:positit1,offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val(),'earn':'{{@$fee_product_purchased}}'},
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Submitting your answer .....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
			
				loading.waitMe('hide');
				
				if(data == "yes")
				{
				
					var template = $("#upload-form-template").html();
					$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
					
				}
				else if(data == "no")
				{
				    
					var template = $('#thankyou-withoutpoint-template').html();
					$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
					
					swal({
    					  title: "",
    					  text:  "Thank you for taking our product reviews, you may mark as completed this offer",
    					  type: 'success',
    					}).then(function (result) {
    					
    					window.location.href = '{{asset("vip/campaign/getdata/insight/offerdetails/")}}'+'/{{ $offerdetails[0]->id }}/#step-5';
    				
    				});
					
				}
			
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});
	

}


function willyoupost()
{
	 var positit2 =  $("input[name='positit2']:checked").val();
	 
	/* $.xResponseABC("{{asset('submit_survey_amazon_to_earn')}}",{offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val(),"willyoupost_in_5days":positit2,'earn2':'2'});
	 
	if(positit2 == "no" || positit2 == "yes" )
	{
		var template = $('#thankyou-template').html();
		$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
		
	} */
	
	
	$.ajax({
		url: "{{asset('submit_survey_amazon_to_earn')}}",
		type: 'POST',
		data: {willyoupost_in_5days:positit2,offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val(),'earn2':'{{@$fee_product_purchased}}'},
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Saving Data .....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
				loading.waitMe('hide');
			
				
				if(positit2 == "no" || positit2 == "yes" )
				{
					var template = $('#thankyou-template').html();
					$("#target_panel").empty().hide().html(template).animate({ opacity: "show" }, "slow");
					
				}
			
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});
	
	
}
</script>


