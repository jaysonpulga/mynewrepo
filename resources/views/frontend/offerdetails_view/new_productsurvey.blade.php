<style>
fieldset, label { margin: 0; padding: 0;  }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 2em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
 float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 

.description {
    color: #999;
    font-size: 13px;
}

.headerquestion_p
{
	font-size:20px;
}

.highlight
{
    border: 1px solid red !important;
}
</style>
<style>
.header_question123
{
    padding-left: 12px ;
	padding-bottom :2px;
	padding-top :4px;
    background: #e0e0e0;
	border-top : solid 1px #cec7c7;
	border-right : solid 1px #cec7c7;
	border-left : solid 1px #cec7c7;
}

.header_question_
{
	padding-bottom :2px;
	padding-top :2px;
    background: #e0e0e0;
	border-top : solid 1px #cec7c7;
	border-right : solid 1px #cec7c7;
	border-left : solid 1px #cec7c7;
}


.content_question123
{
    background: #fff;
    padding: 20px;
    font-size: 14px;
    margin-bottom: 20px;
	border-bottom : solid 1px #cec7c7;
	border-right : solid 1px #cec7c7;
	border-left : solid 1px #cec7c7;
	clear:both;
	padding-bottom:20px;

}

.callout 
{
    border-radius: 1px !important;
    margin: 0 0 20px 0 !important;
    padding: 10px !important;
    border-left: 7px solid #eee;
}

</style>
<style>

.level
{
	width: 35px;
	height: 35px;
	font-size: 15px;
	line-height: 35px;
	position: absolute;
	border-radius: 50%; 
	text-align: center;
	left: 16px;
	top: 0;
	color: #3b5998; 
	border: #3b5998 2px solid; 
	background-color: #f7f7f7; 
	display: inline-block; 
	font-size: 1.1em; 
	
}

.level_end
{
	width: 35px;
	height: 35px;
	font-size: 15px;
	line-height: 35px;
	position: absolute;
	border-radius: 50%; 
	text-align: center;
	left: 16px;
	top: 0;
	color: #3b5998; 
	border: #3b5998 2px solid; 
	background-color: #3b5998; 
	display: inline-block; 
	font-size: 1.1em; 
	
}

.texthere
{
	display: inline-block;
	vertical-align: middle;
	font-size: 1.3em;
	font-weight: 500;
	margin-left: 65px;
	margin-bottom:12px;
	margin-top :7px
}

.end
{

	display: inline-block;
	vertical-align: middle;
	font-size: 1.3em;
	font-weight: 500;
	margin-left: 65px;
	margin-top :5px
}

.timediv
{
	margin-left: 65px;
	margin-right: 15px;
	padding: 0;
	position: relative;
}
</style>
<style>
div._5ts1_notif
{
    
	margin-top: 1px;
	margin-bottom: 1px;
	margin-left: 2px;
	margin-right: 2px
}


div._5ts1{
    
	margin-top: 16px;
	margin-bottom: 16px;
	margin-left: 25px;
	margin-right: 25px
}

div._5ts1_congrats  {
    /*margin: 16px;*/
	margin-bottom:30px;
	margin-top:8px;
	margin-left:2px;
	margin-right:2px;
	
	
}
._57z0 {
    background: #e9ebee 
	url('https://static.xx.fbcdn.net/rsrc.php/v3/y0/r/QjB9SjWn3pR.png') no-repeat 13px 13px;
    background-position: left 13px top 13px;
    background-size: 18px 18px;
}
._57yz {
    border: 1px solid #dadde1;
    border-radius: 1px;
    color: #4b4f56;
    display: flex;
    font: 14px/18px -apple-system, BlinkMacSystemFont, Roboto, Arial, Helvetica, sans-serif;
    justify-content: space-between;
    line-height: 20px;
    padding-left: 44px;
}

._57y- {
    background: #fff;
    flex-grow: 1;
    padding: 8px;
}

._57z0_shipping
{
    background: #f39c12 
	url('http://localhost/azmproject/public/azmproject_images/shipping_icon.png') no-repeat 15px 15px;
    background-position: left 9px top 15px;
    background-size: 25px 25px;
	
}

._57z0_thanks
{
    background: #33b4ff 
	url('https://static.xx.fbcdn.net//rsrc.php/v3/yk/r/JBtftO-nIgj.png') no-repeat 15px 15px;
    background-position: left 9px top 10px;
    background-size: 20px 20px;
}

.progress {
height: 35px !important;  
}

.progress-bar {
   padding-top : 7px !important; 
    font-size: 17px !important; 
    line-height: 20px !important; 
    color: #fff !important; 
    text-align: center !important; 

}


._585n {
    background-color: #3578e5;
    border: 1px solid #3578e5;
    border-radius: 3px;
    overflow: hidden;
    padding: 0 0 0 40px;
	 border-radius: 1px;
}

.sp_h3TdUYJbNzz.sx_174afe {
    width: 20px;
    height: 20px;
    background-position: -161px -196px;
}

._585r {
    background: #fff;
    margin: 0;
    padding: 9px 10px;
}

._50f4 {
    font-size: 14px;
    line-height: 18px;
}




.sp_h3TdUYJbNzz.sx_174afe {
    width: 20px;
    height: 20px;
    background-position: -161px -196px;
}

i.img {
    -ms-high-contrast-adjust: none;
}
._585p {
    float: left;
    margin: 8px 0 0 -30px;
}
.sp_h3TdUYJbNzz {
    background-image: url('https://static.xx.fbcdn.net//rsrc.php/v3/yk/r/JBtftO-nIgj.png');
    background-repeat: no-repeat;
    display: inline-block;
    height: 12px;
    width: 16px;
}

i, cite, em, var, address, dfn {
    font-style: italic;
}
</style>
<?php //print_r($tracking_status); ?>
<div class="row" >
<div class="box" >
<div class="box-body">


<div id="tracking_status">	
<div class="col-sm-12">
	<form id="purchased_form" method="post"> 
	{{ csrf_field() }}
		<div class="col-sm-12">
			@if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
				<div style='border-radius:16px;background-color:#7bc7ea;padding:5px;text-align:center;font-size:17px;color:#fff'>
					<b>Thank you for purchasing our product you recieved ${{@$fee_product_purchased}} to your vcc account</b>
				</div>
			@elseif( !empty(@$tracking_status[0]->remarks) )
				<div class="row">
					<div class="col-lg-12">
						<div class="_57yz _57z0">
							<div class="_57y-">
							<h5>
								{{@$tracking_status[0]->statusWithDetails}}
							</h5>
							</div>
						</div>
					</div>
				</div>
			@endif	
			<h2>Verify Purchase</h2>
			<div class="row">
										<div class="col-lg-6">
											<span style='font-size:20px' > Courier </span><br>
											<select class="form-control required" id='shipment_company' onchange='shipmentData()'>
												<option value=''>-----</option>
												<option value='FEDEX'>FEDEX</option>
												<option value='UPS'>UPS</option>
												<option value='USPS'>USPS</option>
												<option value='DHL'>DHL</option>
											 </select>
											 <input   name='checkbox_status_bar' id='checkbox_shipment' value='checkbox_shipment'  type='checkbox'  style='display:none'/>
											 <br>
										</div>
										<script>
										
										$("#shipment_company").val("{{ @$tracking_status[0]->shipment_company }}");
										
										var shipment_company = "{{ (!empty(@$tracking_status[0]->shipment_company) && @$tracking_status[0]->remarks == 'Delivered') ? 'true' : 'false' }}";
										if(shipment_company == 'true' )
										{
											$("#shipment_company").attr('readonly', true);
										}
										else
										{
											$("#shipment_company").attr('readonly', false);
										}
									
										</script>
										
								    	
										<div class="col-lg-6">
										    
											<span style='font-size:20px' > Tracking Number </span><br>
											<input  onfocusout="shipmentData()"  type="text" id='saveTrackingnumber' class="form-control required"  value="{{  @$tracking_status[0]->tracking_number }}"  {{ (!empty(@$tracking_status[0]->tracking_number) && @$tracking_status[0]->remarks == 'Delivered') ? "readonly" : "" }} />
											<input   name="checkbox_status_bar" id='checkbox_trackingnumber' value='checkbox_trackingnumber'  type='checkbox'  style='display:none'/>
										</div>
												
				</div>
				<br>
				<div class="row">
					<div class="col-lg-12">
					<span style='font-size:20px' > Notes </span><br>
						<textarea class="form-control productsurvey_ans" data-fieldtype="textarea"  id='tracking_notes'  rows="3" style="width:100%" {{ (!empty(@$tracking_status[0]->tracking_number) && @$tracking_status[0]->remarks == 'Delivered') ? "readonly" : "" }} > {{  @$tracking_status[0]->notes }}</textarea>
					</div>
				</div>
		</form>			
				<br>
				<div class="row ">
					<div class="form-group">
						<div class="col-lg-12">
					
							<button  id='productsurvey' type="button" class="btn" style='background-color:#6ece16;color:#fff'> Submit </button>	
							
    						@if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
    							 <div class="pull-right">
    							     <a href="#step-2" class="btn btn-primary back"><< back </a>
                                      <a href="#step-4" class="btn btn-primary proceed_review_product">next >></a>
                                </div>
    						@endif
						
						</div>	
					</div>	
				</div>
		</div>
		
		<script>
		    $(".proceed_review_product").click(function() 
            {
              setClasses(4-1, $(".step-wizard ul li").length-1);
              
            });
            
            $(".back").click(function() 
            {
              setClasses(2-1, $(".step-wizard ul li").length-1);
              
            });
		</script>
		
		
	
		<div class="col-sm-4">
		
			<div style='width:70%' class='pull-right'>
				<span style='color:#777;font-size:15px;'>Complete the survey and<br> get rewarded</span>
				<div style='border-radius:16px;background-color:#6ece16;padding:5px;text-align:center;font-size:17px;color:#fff'><b>Reward:${{$fee_product_purchased}}</b></div>
				<br>
		
				
				@if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
					
						<div style='background-color:#098dad;padding:5px;text-align:center;font-size:17px;color:#fff'><b> <i class="fa fa-fw fa-check"></i>Item Delivered</b></div>
						<div style='background-color:#62bce6;padding:8px;font-size:13px;color:#fff'>
							{{@$tracking_status[0]->statusWithDetails}}
						</div>
				@endif	
		
			</div>	

			
		</div>
		
	
		
</div>


<div style="clear:both;margin-bottom:10px;" class="col-sm-12 pull-right"></div>	

</div>


</div><!--end 12-->
</div><!--end box-->
</div><!--end box-body-->




@include('frontend.offerdetails_view.function.tracking')
@include('frontend.offerdetails_view.function.purchased_suvey')
@include('frontend.offerdetails_view.function.checking_tracking_number')
@include('frontend.offerdetails_view.function.vcc_account')


<script>
Array.prototype.contains = function (val) 
{ 
	for(var i = 0; i < this.length; i++ )
	{
		
		if(this[i] === val) return true;
	}
	return false;
	
}  
</script>




<script>
function Inputcheck(id)
{
	var input = $('input#'+id+'.form-control.productsurvey_ans').val();

	if(input != '')
	{
		$('.putcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#checkbox_'+id).prop('checked',true);
		
	}
	else
	{
		$('.putcheck_'+id).empty();
		$('#checkbox_'+id).prop('checked',false);
	}

	statusbar();
}


function textareacheck(id)
{
	
	
	var textarea = $('textarea#'+id+'.form-control.productsurvey_ans').val();

	if(textarea != '')
	{
		$('.putcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#checkbox_'+id).prop('checked',true);
	}
	else
	{
		$('.putcheck_'+id).empty();
		$('#checkbox_'+id).prop('checked',false);
	}
	
	statusbar();


}


function ratingtstar(id)
{
	//var rating = $('fieldset#'+id+'.rating.productsurvey_ans').val();
	
	var rating = $("input[type='radio']:checked", $('fieldset#'+id+'.rating.productsurvey_ans')).val();
	
	if(rating != '')
	{
		$('.putcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#checkbox_'+id).prop('checked',true);
	}
	else
	{
		$('.putcheck_'+id).empty();
		$('#checkbox_'+id).prop('checked',false);
	};
	
	statusbar();
	
	
}

</script>



<script type="text/javascript">
$(document).ready(function()
{
	// fixing the issue on step css
	/*
	var url = window.location.href;     // Returns full URL
	var parts = url.split("/");
	var last_part = parts[parts.length-1];
	var end = last_part.split("#");
	var step  = end[1];	
	
	if(step === "step-2")
	{
		$('#secondstep').removeClass('done');
	} 
	*/
	
	// get the data submited
	//getPurchasedData(); // purchased_survey.blade.php
	
	// check the traking status 
	//checking_tracking_number(); //checking_tracking_number.blade.php
	
	
});

</script>
	

<script>
$.extend({
    xResponse: function(url, data) {
        // local var
        var theResponse = null;
        // jQuery ajax
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
			dataType: "html",
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
// Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;
      var pusher = new Pusher('44f094e6f806a4e2fe69', {
		  cluster: 'ap1',
        encrypted: true
      });

      // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('{{Auth::user()->id}}_channel');
	  
	channel.bind('{{Auth::user()->id}}_event', function(data) {
		
	//location.reload();
	
	});
</script>




<script>
var favorite = [];

function test()
{
	$.each($("input[name='checkbox_status_bar']"), function(){
		
		var id = $(this).val()
		var status = $("#"+id).is(":checked");
		if(status == true)
		{
			 if(favorite.contains(id)) 
			 { } 
			else{ favorite.push(id);} 
		}
		else
		{
			var vv = favorite.indexOf(id);
			favorite.splice(vv,1);
		}
	}); 
	
	alert(favorite);
	
}
</script>


<script>
var purcahsed = [];

function statusbar()
{
	

$.each($("input[name='checkbox_status_bar']"), function(){
		
		var id = $(this).val()
		var status = $("#"+id).is(":checked");
		if(status == true)
		{
			 if(purcahsed.contains(id)) 
			 { } 
			else{ purcahsed.push(id);} 
		}
		else
		{
			var vv = purcahsed.indexOf(id);
			purcahsed.splice(vv,1);
		}
}); 



var Delivered_count = 0;
	
var Delivered = "{{ @$tracking_status[0]->remarks }}" ;
if(Delivered == "Delivered")
{
	Delivered_count = 1;
}
	
	
var number_of_question = "<?php echo count($purchare_review_questions) ?>";
var shipment_company = 1;
var tracking_number = 1;
var delivered = 1;
var total_item = parseInt(number_of_question) + parseInt(shipment_company) + parseInt(tracking_number) + parseInt(delivered);

var total_done = parseInt(purcahsed.length) + parseInt(Delivered_count);

var percent  = (100/total_item);
var total_percent = Math.round(percent) * total_done;

if((total_percent > 100) || (total_percent == 99))
{
	total_percent = 100;
}



var  myWidth = total_percent;
$('#stat_progress').width(myWidth + '%');
$('#stat_complete').empty().html(total_percent+"% Completed");

}
</script>



<script type="text/javascript">
//shipmentData();

function  shipmentData()
{
   var a = 0;
   var b = 0;
   
	var shipment_company = $('#shipment_company').val();
	
	if(shipment_company != '')
	{
		$('#checkbox_shipment').prop('checked',true);
		 a = 1;
	}
	else
	{
		$('#checkbox_shipment').prop('checked',false);
		 a = 0;
	}
	
	var saveTrackingnumber = $('#saveTrackingnumber').val();
	
	if(saveTrackingnumber != '')
	{
		$('#checkbox_trackingnumber').prop('checked',true);
		b = 1;
	}
	else
	{
		$('#checkbox_trackingnumber').prop('checked',false);
		b = 0;
	}
	
	var c = parseInt(a) + parseInt(b);
	
	if(c == 2)
	{
		$('.putcheck_shipment').empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
	}
	else
	{
		$('.putcheck_shipment').empty();
	}
	
	statusbar();
}
</script>