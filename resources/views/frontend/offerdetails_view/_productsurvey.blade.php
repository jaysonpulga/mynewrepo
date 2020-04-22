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



<div class="row">
<div class="col-lg-12">
<div style="clear:both;margin-bottom:30px"></div>

<div id="tracking_status">	

	@if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
		<div class="row">
			<div class="col-lg-12">
				<div class="_57yz _57z0 _5ts1">
					<div class="_57y-"><h5>{{$tracking_status[0]->status_msg}}</h5>
					</div>
				</div>
			</div>
		</div>
	@endif	
	
	
	
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-12">
				<div class="col-lg-12">
					<span class='pull-right' style='margin-right:5px'>complete the survey and get&nbsp;<b><span style='font-size:18px;color:blue'>  ${{$fee_product_purchased}}</span></b></span><br>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-12">
				<div class="col-lg-12">		
					<!-- status bar  -->
					
					
					
					<div class="progress">
						<div id='stat_progress' class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
						  <span id='stat_complete'>0% Completed</span>
						</div>
						
					</div>
					
						@if(!empty(@$tracking_status[0]->remarks) && @$tracking_status[0]->remarks == "Delivered" )	
							
								<div id='results' style="100%">
									<div class="_585n _5ts1_congrats">
									<i alt="Notice" class="_585p img sp_h3TdUYJbNzz sx_174afe"></i>
										<div class="_585r _50f4"><b><p>Thank you for purchasing our product you recieved ${{@$fee_product_purchased}} to your vcc account</p></b></div>
									</div>
								</div>
						@endif
					
				</div>
			</div>
		</div>
	</div>
	
	

	<div class="row">
	<div class="form-group">
	<div class="col-lg-12">
	
	<form id="productsurvey_form" method="post"> 
	{{ csrf_field() }}
	
	
	<ul class="timeline">
	
		<li>
			<span class='level'>1</span>
			
			<span class='texthere'>Shipping courier and tracking number</span>
			
			<div class="timediv">
				
				<div class='row'>
					
					
						
						
						@if(!empty(@$tracking_status[0]->remarks))
						
								<div id='results'>
									<div class="_57yz _57z0_shipping _5ts1">
										<div class="_57y-">
									
										<p style='font-size:17px'><b>{{$tracking_status[0]->remarks}}</b></p>
										<p>{{$tracking_status[0]->statusWithDetails}}</p>
										</div>
									</div>
								</div>

						@endif
				
				
						<div class="col-lg-12">
						
						
							<div class="header_question_"> 
							
							
								<div class="row">
									<!--  checkbox  check-->
									<div class="col-md-12" style="float:right;margin-right:10px">
										<span style="float:right;clear:both">
											<span class='putcheck_shipment'></span>
										</span>
									</div>
								</div>
								
								
							</div>
							
							
							
							<div class="content_question123">
									<div id='purchased_form'>
									
										<div>
											<label for="exampleInputEmail1"><small style="color:red"><i class="fa fa-fw fa-asterisk"></i></small>Select Shipment Company : </label><br>
											<select class="form-control required" id='shipment_company' onchange='shipmentData()'>
												<option value=''>-----</option>
												<option value='FEDEX'>FEDEX</option>
												<option value='UPS'>UPS</option>
												<option value='USPS'>USPS</option>
												<option value='DHLexpress'>DHL Express</option>
											 </select>
											 <input   name='checkbox_status_bar' id='checkbox_shipment' value='checkbox_shipment'  type='checkbox'  style='display:none'/>
											 
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
										
										<br>
										<div>
											<label for="exampleInputEmail1"><small style="color:red"><i class="fa fa-fw fa-asterisk"></i></small>Input Tracking Number : </label><br>
											<input  onfocusout="shipmentData()"  type="text" id='saveTrackingnumber' class="form-control required"  value="{{  @$tracking_status[0]->tracking_number }}"  {{ (!empty(@$tracking_status[0]->tracking_number) && @$tracking_status[0]->remarks == 'Delivered') ? "readonly" : "" }} />
											<input   name="checkbox_status_bar" id='checkbox_trackingnumber' value='checkbox_trackingnumber'  type='checkbox'  style='display:none'/>
										</div>
									
									
									</div>
								
							</div>		
						</div>	
				</div>	
			</div>
		
		</li>
		
		@foreach($purchare_review_questions as   $key => $purchasedata)

		<li>
			<span class='level'>{{  $key + 2 }}</span>
			<span class='texthere'>Question Survey  {{  $key + 1 }}</span>
			
			
			<div class="timediv">

				
					
						<div class="header_question123" >
							<div class="row">
							
									<div class="col-md-8">
									@if (!empty($purchasedata->header_label))
										 <p class='headerquestion_p' >{{$purchasedata->header_label}}</p>
									@endif
									</div>
									
									<!--  checkbox  check-->
									<div class="col-md-2" style="float:right;margin-right:10px">
										<span style="float:right;clear:both">
											<span class='putcheck_{{$purchasedata->id}}'></span>
											<input  id='checkbox_{{$purchasedata->id}}'  name="checkbox_status_bar"  type='checkbox'  value='checkbox_{{$purchasedata->id}}'  style='display:none'/>
										</span>
									</div>
									
							</div>
						</div>
						
						<div class="content_question123">	
						
							@if (!empty($purchasedata->question))
							 <span class="description">{{$purchasedata->question}}</span><br>
							@endif
						
							@if ($purchasedata->form == "TextField")
								<input onfocusout="Inputcheck('{{$purchasedata->id}}')" class="form-control productsurvey_ans" data-fieldtype="inputfield" id="{{$purchasedata->id}}"    style="width:100%" name="amazon_answer[]" >
							@elseif($purchasedata->form == "TextArea")
								<textarea  onfocusout="textareacheck('{{$purchasedata->id}}')"  class="form-control productsurvey_ans" data-fieldtype="textarea" id="{{$purchasedata->id}}"   rows="3" style="width:100%" ></textarea>
							@elseif($purchasedata->form == "rating_star")	
							<fieldset  onchange="ratingtstar('{{$purchasedata->id}}')" class="rating productsurvey_ans" data-fieldtype="rating_star"  id="{{$purchasedata->id}}"   >
								<input type="radio" id="star5_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="5"  />
								<label class = "full" for="star5_{{$purchasedata->id}}" title="Awesome - 5 stars"></label>
								<input type="radio" id="star4andhalf_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="4andhalf" />
								<label class="half" for="star4andhalf_{{$purchasedata->id}}" title="Pretty good - 4.5 stars"></label>
								<input type="radio" id="star4_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="4" />
								<label class = "full" for="star4_{{$purchasedata->id}}" title="Pretty good - 4 stars"></label>
								<input type="radio" id="star3andhalf_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="3andhalf" />
								<label class="half" for="star3andhalf_{{$purchasedata->id}}" title="Meh - 3.5 stars"></label>
								<input type="radio" id="star3_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="3" />
								<label class = "full" for="star3_{{$purchasedata->id}}" title="Meh - 3 stars"></label>
								<input type="radio" id="star2andhalf_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="2andhalf" />
								<label class="half" for="star2andhalf_{{$purchasedata->id}}" title="Kinda bad - 2.5 stars"></label>
								<input type="radio" id="star2_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="2" />
								<label class = "full" for="star2_{{$purchasedata->id}}" title="Kinda bad - 2 stars"></label>
								<input type="radio" id="star1andhalf_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="1andhalf" />
								<label class="half" for="star1andhalf_{{$purchasedata->id}}" title="Meh - 1.5 stars"></label>
								<input type="radio" id="star1_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="1" />
								<label class = "full" for="star1_{{$purchasedata->id}}" title="big time - 1 star"></label>
								<input type="radio" id="starhalf_{{$purchasedata->id}}" name="rating_{{$purchasedata->id}}" value="half" />
								<label class="half" for="starhalf_{{$purchasedata->id}}" title="big time - 0.5 stars"></label>
							</fieldset>
							<br>
							<br>
							@endif
							
							@if ($purchasedata->required == "1")
								<br><small style="color:red"><i class="fa fa-fw fa-asterisk"></i>(Required)</small><br>
							@endif
						
						</div>
					
			</div>
			
			
		</li>
		
		@endforeach	
		
		<li>
			<span class='level_end'></span>
			<span class='end'></span>
		</li>
		
		
        </ul>
		</form>
		</div>
		</div>
		</div>
		
	<hr>

	<div style="clear:both;margin-bottom:10px;" class="col-lg-12 pull-right"></div>	
		
		
	<!-- button row -->
		<div class="row pull-right">
			<div class="form-group">
				<div class="col-lg-12">
					<div class="btn-group mr-2 sw-btn-group" role="group">
						<button class="btn btn-default sw-btn-prev showbutton" type="button"><< Previous</button>
						&nbsp;&nbsp;
						<button id="secondnextbutton"class="btn btn-default sw-btn-next {{  $showbutton === 'show' ? 'showbutton' : 'hidebutton'  }}" type="button">Next >></button> &nbsp;&nbsp;
					</div>
					<button  id='productsurvey' type="button" class="btn bg-primary"><i class="fa fa-fw fa-save"></i>  Submit</button>	
					
					<!--<button onclick='test()' type="button" class="btn bg-primary"> text</button>-->
					
				</div>	
			</div>	
		</div>
	<!-- /button row -->
		
		

</div>


</div><!--end 12-->
</div><!--end row-->



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
	var url = window.location.href;     // Returns full URL
	var parts = url.split("/");
	var last_part = parts[parts.length-1];
	var end = last_part.split("#");
	var step  = end[1];	
	
	if(step === "step-2")
	{
		$('#secondstep').removeClass('done');
	} 
	
	// get the data submited
	getPurchasedData(); // purchased_survey.blade.php
	
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


@include('frontend.offerdetails_view.function.tracking')
@include('frontend.offerdetails_view.function.purchased_suvey')
@include('frontend.offerdetails_view.function.checking_tracking_number')
@include('frontend.offerdetails_view.function.vcc_account')


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
shipmentData();

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