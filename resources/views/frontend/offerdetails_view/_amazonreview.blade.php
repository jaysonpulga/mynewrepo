<style>

fieldset, label { margin: 0; padding: 0; }

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

.headerquestion

{

	font-size:24px;

	font-weight:bold;

}




</style>

<style>
.header_question
{
    padding-left: 12px ;
	padding-bottom :2px;
	padding-top :4px;
    background: #e0e0e0;
	border-top : solid 1px #cec7c7;
	border-right : solid 1px #cec7c7;
	border-left : solid 1px #cec7c7;
}
.content_question
{
    background: #fff;
    padding: 20px;
    font-size: 14px;
    margin-bottom: 20px;
	border-bottom : solid 1px #cec7c7;
	border-right : solid 1px #cec7c7;
	border-left : solid 1px #cec7c7;
}
</style>








<div class="row">
<div class="col-lg-12">
<div class="col-lg-12">
<div style="clear:both;margin-bottom:30px"></div>



<div id='target_panel'></div> 
<br>


<div class="row">
		<div class="col-lg-12">
			<div class="col-lg-12">
					<span class='pull-right' style='margin-right:5px'>complete the survey and get&nbsp;<b><span style='font-size:18px;color:blue'>  ${{$fee_amazon_rebate}}</span></b></span><br>
			</div>
		</div>
	</div>


<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-12">
			<!-- status bar  -->
				<div class="progress">
					<div id='stat_progress_amazon' class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
					  <span id='stat_complete_amazon'>0% Completed</span>
					</div>
				</div>
		</div>		
	</div>
</div>


<div class="row">


<form id="amazon_form" method="post"> 
{{ csrf_field() }}
<ul class="timeline">
@foreach($amazonreview as  $key => $amazondata)

<li>
	<span class='level'>{{$key+1}}</span>
	
	<div class="timediv">
	
		<div class="header_question">
			<div class="row">
				<div class="col-md-8">
				@if (!empty($amazondata->header_label))
					<p class='headerquestion' >{{$amazondata->header_label}}</p>
				@endif
				</div>
				<div class="col-md-2" style="float:right;margin-right:10px">
					<span style="float:right;clear:both">
						<span class='amazonputcheck_{{$amazondata->id}}'></span>
						<input  id='amazoncheckbox_{{$amazondata->id}}'  name="amazoncheckbox_status_bar"  type='checkbox'  value='amazoncheckbox_{{$amazondata->id}}'  style='display:none'/>
					</span>
				</div>
			</div>
		</div>
		
		<div class="content_question">	
			
			@if (!empty($amazondata->question))
				 <span class="description">{{$amazondata->question}}</span><br>
			@endif


			@if ($amazondata->form == "TextField")
				
				<input onfocusout="amazonInputcheck('{{$amazondata->id}}')" class="form-control amazonstart_ans" data-fieldtype="inputfield" id="{{$amazondata->id}}"  style="width:100%" required id="amazon_answer" name="amazon_answer[]" >

			@elseif($amazondata->form == "file_upload")
		
			<br><input type="file" disabled onchange="amazonfileupload('{{$amazondata->id}}')"   class="amazonstart_ans filename" accept=".jpg,.jpeg.,.gif,.png,.mp4,.mp3,.vlc" data-fieldtype="file" id="{{$amazondata->id}}"/>
			<br>
			<div id='file_{{$amazondata->id}}'></div>
		
			<p class="note">
                <span class="dxeBase_MaterialCompact" id="ContentHolder_AllowedFileExtensionsLabel" style="font-size:8pt;">Allowed file extensions: .jpg, .jpeg, .gif, .png, .vlc, .mp4</span>
                <br>
                <span class="dxeBase_MaterialCompact" id="ContentHolder_MaxFileSizeLabel" style="font-size:8pt;">Maximum file size: 400 kb.</span>
            </p>
			
			
			<script>	
				$('.filename').bind('change', function() {

					  if(this.files[0].size > 393631){
					   alert("File is too big!");
					   this.value = "";
					};

				});
			</script>
			
				

			@elseif($amazondata->form == "TextArea")

	
			<textarea onfocusout="amazontextareacheck('{{$amazondata->id}}')" class="form-control amazonstart_ans" data-fieldtype="textarea" id="{{$amazondata->id}}"   rows="3" style="width:100%" ></textarea>

				

			@elseif($amazondata->form == "rating_star")	

			<fieldset disabled onchange="amazonratingtstar('{{$amazondata->id}}')" class="rating amazonstart_ans" data-fieldtype="rating_star"  id="{{$amazondata->id}}"   >

				<input type="radio" id="star5_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="5"  />

				<label class = "full" for="star5_{{$amazondata->id}}" title="Awesome - 5 stars"></label>

				<input type="radio" id="star4andhalf_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="4andhalf" />

				<label class="half" for="star4andhalf_{{$amazondata->id}}" title="Pretty good - 4.5 stars"></label>

				<input type="radio" id="star4_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="4" />

				<label class = "full" for="star4_{{$amazondata->id}}" title="Pretty good - 4 stars"></label>

				<input type="radio" id="star3andhalf_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="3andhalf" />

				<label class="half" for="star3andhalf_{{$amazondata->id}}" title="Meh - 3.5 stars"></label>

				<input type="radio" id="star3_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="3" />

				<label class = "full" for="star3_{{$amazondata->id}}" title="Meh - 3 stars"></label>

				<input type="radio" id="star2andhalf_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="2andhalf" />

				<label class="half" for="star2andhalf_{{$amazondata->id}}" title="Kinda bad - 2.5 stars"></label>

				<input type="radio" id="star2_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="2" />

				<label class = "full" for="star2_{{$amazondata->id}}" title="Kinda bad - 2 stars"></label>

				<input type="radio" id="star1andhalf_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="1andhalf" />

				<label class="half" for="star1andhalf_{{$amazondata->id}}" title="Meh - 1.5 stars"></label>

				<input type="radio" id="star1_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="1" />

				<label class = "full" for="star1_{{$amazondata->id}}" title="big time - 1 star"></label>

				<input type="radio" id="starhalf_{{$amazondata->id}}"  name="rating_{{$amazondata->id}}" value="half" />

				<label class="half" for="starhalf_{{$amazondata->id}}" title="big time - 0.5 stars"></label>

			</fieldset>
			<br>
			<br>

			@if ($amazondata->required == "1")
				<br><small style="color:red"><i class="fa fa-fw fa-asterisk"></i>(Required)</small><br>
			@endif

			@endif
			</div>

	</div>

</li>
@endforeach
<li>
	<span class='level_end'></span>
	<span class='end'></span>
</li>

<ul>

</form>


</div>
<hr>



<!-- button row -->
<div class="row  pull-right">
	<div class="form-group">
		<div class="col-lg-12">
			<div class="btn-group mr-2 sw-btn-group" role="group">
				<button class="btn btn-default sw-btn-prev showbutton" type="button"><< Previous</button>
			</div>
			<button id='finish'  type="submit" class="btn bg-primary"><i class="fa fa-fw fa-save"></i>  Finish</button>	
			
		</div>	
	</div>	
</div>
<!-- /button row -->

	



</div><!--end 12-->
</div><!--end 12-->
</div><!--end row-->


@include('frontend.offerdetails_view.function.amazon_function')


<script type="text/javascript">

function amazonInputcheck(id)
{

	var input = $('input#'+id+'.form-control.amazonstart_ans').val();

	if(input != '')
	{
		$('.amazonputcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#amazoncheckbox_'+id).prop('checked',true);
	}
	else
	{
		$('.amazonputcheck_'+id).empty();
		$('#amazoncheckbox_'+id).prop('checked',false);
	}
	statusbar_amazon();

}


function amazontextareacheck(id)
{
	

	var textarea = $('textarea#'+id+'.form-control.amazonstart_ans').val();
	
	if(textarea != '')
	{
		$('.amazonputcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#amazoncheckbox_'+id).prop('checked',true);
	}
	else
	{
		$('.amazonputcheck_'+id).empty();
		$('#amazoncheckbox_'+id).prop('checked',false);
	}
	statusbar_amazon();
	
	
}


function amazonratingtstar(id)
{
	
	var rating = $("input[type='radio']:checked", $('fieldset#'+id+'.rating.amazonstart_ans')).val();
	
	if(rating != '')
	{
		$('.amazonputcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
		$('#amazoncheckbox_'+id).prop('checked',true);
	}
	else
	{
		$('.amazonputcheck_'+id).empty();
		$('#amazoncheckbox_'+id).prop('checked',false);
	};
	statusbar_amazon();
	
}





function amazonfileupload(id)
{
	
	$('.amazonputcheck_'+id).empty().html('<p style="font-size:25px;color:#38c138"><i class="fa fa-fw fa-check-square-o"></i></p>');
	$('#amazoncheckbox_'+id).prop('checked',true);
	statusbar_amazon();
}

</script>




<script type="text/javascript">
$(document).ready(function()
{
	getthirdstep();
	
});



function ifcursor_is_inStep3()
{
	
	// fixing the issue on step css
	var url = window.location.href;     // Returns full URL
	var parts = url.split("/");
	var last_part = parts[parts.length-1];
	var end = last_part.split("#");
	var step  = end[1];	
	
	
	
	if(step === "step-3")
	{
		$('#thirdstep').removeClass('done');
	} 
	
	
}


function getthirdstep()
{

	

		$.ajax({

		url: "{{route('getthirdstep')}}",

		type: 'GET',

		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},

		dataType: 'json',

		success: function(data)

		{

				console.log(data.length);

				if(data.length > 0)
				{

					$('#finish').text('Update Amazon Review');
					//$('#fourtstep').addClass('done'); // if user submited the amazon survey
					ifcursor_is_inStep4();

				}

				console.log(data);

				$.each(data, function(index) {
					
				

					//console.log(data[index].answer);
					
					//check if kung mataas ang binigay na puntos
					if(data[index].form == "rating_star")
					{
						// get if the form is rating star and first array
						if(index == 0)
						{
							checkifyouareallowtosubmit_amazonfile(data[index].answer);  // get if the form is rating star and first array
						}

						$('#star'+data[index].answer+'_'+data[index].questionId).prop('checked',true);
						
						
						amazonratingtstar(data[index].questionId);
						

					}

			
					
					else if(data[index].form == "inputfield")
					{
						
						$("#"+data[index].questionId+'.amazonstart_ans').val(data[index].answer);
						amazonInputcheck(data[index].questionId);
						
						
						
					}
					else if(data[index].form == "textarea")
					{
						$("#"+data[index].questionId+'.amazonstart_ans').val(data[index].answer);
						amazontextareacheck(data[index].questionId);
					}
					
					else if (data[index].form == "file" ) 
					{
						if(data[index].answer != "")
						{
							$("#file_"+data[index].questionId).empty().html('<object  height="250" data="'+data[index].answer+'"></object>');
							amazonfileupload(data[index].questionId);

						}
					}

				

				});

			
				
		},

		error: function(error){ 

			console.log(error);

		}



	});

	 

}

</script>	





<script>

Array.prototype.contains = function (val) 
{ 
	for(var i = 0; i < this.length; i++ )
	{
		
		if(this[i] === val) return true;
	}
	return false;
	
}  


var CheckDuplicateID = [];
 var filesToUpload_file = [];

$(".filename").change(function() {
	
	var id = $(this).attr('id');
	
	getBaseUrl(id);
	

});

function getBaseUrl(id)
{
	//var file_data = $('#'+id).prop('files')[0].name; 
	

		
	if ( ! window.FileReader ) {
			return alert( 'FileReader API is not supported by your browser.' );
		}
		var $i = $( '#'+id ), // Put file input ID here
			input = $i[0]; // Getting the element from jQuery
		if ( input.files && input.files[0] ) {
			file = input.files[0]; // The file
			
			filename = input.files[0].name; // The file
			
			fr = new FileReader(); // FileReader instance
			fr.onload = function () {
				// Do stuff on onload, use fr.result for contents of file
				//$( '#file-content' ).append( $( '<div/>' ).html( fr.result ) )
				
				//$('#base64_'+id).val( fr.result);
				
				var ax = [];
				var ax = {"id":id,"file":fr.result};
				//var ax = {"id":id,"file":filename};
		
				var checkId = id;
				
				if(CheckDuplicateID.contains(checkId)) 
				{ 
						for (var i = 0; i < filesToUpload_file.length; i++)
						{	
							if(filesToUpload_file[i].id == checkId)
							{
								// change the value	
								filesToUpload_file[i].file = fr.result;
								//filesToUpload_file[i].file = filename;
							}	
						
						}
				} 
				else{									
				CheckDuplicateID.push(checkId); 
				filesToUpload_file.push(ax); 
				}  
			
				
			
				
			};
			//fr.readAsText( file );
			fr.readAsDataURL( file );
		} else {
			// Handle errors here
			alert( "File not selected or browser incompatible." )
		}
   
 
   
   
}



	

$("#amazon_form").on("submit", amazonsurvey);

function amazonsurvey(event)
{

	event.preventDefault();	
	
	//var file_data = $('.filename').prop('files')[0]; 
	

	  var answersamazonList = [];

    //Loop over all questions

    $(".amazonstart_ans").each(function() {


		var questionId = $(this).attr("id");
		if($(this).data('fieldtype') == "rating_star" ) 
		{

			

			var answer = $("input[type='radio']:checked", $(this)).val();

			if (answer !== undefined) 

			{

					answersamazonList.push({

					  model: 'amazon_survey',

					  questionId: questionId,

					  answer: answer,

					  'fieldtype':$(this).data('fieldtype')

					});

			}

		}
		else if ( $(this).data('fieldtype') != "Radio" &&  $(this).data('fieldtype') != "file" )
		{

			answersamazonList.push({

					   model: 'amazon_survey',

					  questionId: questionId,

					  answer: $(this).val(),

					  'fieldtype':$(this).data('fieldtype')

			});

		}
		
		else if ( $(this).data('fieldtype') == "file" )
		{
			var base64file = '';
			
			if(filesToUpload_file.length > 0)
			{
				var array_position = filesToUpload_file.findIndex(x => x.id === questionId);
				
				
			  if(typeof filesToUpload_file[array_position] != 'undefined') 
			  {
				base64file = filesToUpload_file[array_position].file;
			  }
			 
				
			}
			answersamazonList.push({

					   model: 'amazon_survey',
					   questionId: questionId,
					   answer: base64file,
					  'fieldtype':$(this).data('fieldtype')

			});

		}
		
		
		
		 
		



    });
	

	$.ajax({

		url: "{{asset('submit_amazonsesurvey')}}",

		type: 'POST',

		data: {offerid:"{{$offerdetails[0]->id}}", answersamazonList:answersamazonList,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() 
		{
				
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Saving Survey........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},	
		success: function(data)
		{
		
			loading.waitMe('hide');
			if(data.success == "success")

			{

				loading.waitMe('hide');

				swal({

					  title: 'Amazon Review submited!',

					  text:  "",

					  type: 'success',

					}).then(function (result) {
						
						
							location.reload();
							$('#smartwizard').smartWizard('goToStep',2); 
							//$('#smartwizard').smartWizard('goToStep',3); 
							//$('#fourtstep').addClass('done');
						
							
					});

	

			} 

		
		},

		error: function(error){ 

			console.log(error);

		}



	});

}
</script>




<script>

var amazon_array = [];

function statusbar_amazon()
{
	

$.each($("input[name='amazoncheckbox_status_bar']"), function(){
		
		var id = $(this).val()
		var status = $("#"+id).is(":checked");
		if(status == true)
		{
			 if(amazon_array.contains(id)) 
			 { } 
			else{ amazon_array.push(id);} 
		}
		else
		{
			var vv = amazon_array.indexOf(id);
			amazon_array.splice(vv,1);
		}
}); 



var number_of_question_amazon = "<?php echo count($amazonreview) ?>";
var total_item_azm = parseInt(number_of_question_amazon);

var total_done_azm = parseInt(amazon_array.length);

var percent_azm  = (100/total_item_azm);
var total_percent_azm = Math.round(percent_azm) * total_done_azm;

if(total_percent_azm > 100)
{
	total_percent_azm = 100;
}



var  myWidth_azm = total_percent_azm;
$('#stat_progress_amazon').width(myWidth_azm + '%');
$('#stat_complete_amazon').empty().html(total_percent_azm+"% Completed");

}
</script>





<script>
/*
function  AddAmountAmzonsurvey()
{
		var cc_id = $('#cc_id').val();
	

	$.ajax({		
		url: "https://fncc.herokuapp.com/api/retrivecard",		
		type: 'POST',		
		data: {cardid:cc_id},
		beforeSend: function() {
								
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Updating Virtual Card........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
						
		},		
		success: function(data){
				
			var info = $.parseJSON(data);
			var spend_amount = info.spendingLimit;
			var currentamount = spend_amount.amount;
			
			amazon_updateAmountFromSurvey_VCreditCard(currentamount,cc_id)
			//$('#myvcc').empty().append(spend_amount.amount);

		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
	
}

function amazon_updateAmountFromSurvey_VCreditCard(currentamount,cc_id)
{
	var amount_per_amazon_survey = 5;
	
	const inputvalue = { 
		cardid	: cc_id,
		amount	: currentamount + amount_per_amazon_survey // update existing VCC in bento			
	};

	
	$.ajax({		
		url: "https://fncc.herokuapp.com/api/updatecard",		
		type: 'POST',		
		data: inputvalue,			
		success: function(data){
			
			//console.log(data);
			var array = JSON.parse(data);
			
			console.log(array.spendingLimit);
			//alert(array['cardID'] + '' + array['amount']);
			
			if(data.length > 0)	
			{				
					
				//OfferID_createUserVirtualcc(cc_id,amount_per_tracking_number);
				submit_Amazonsurvey(cc_id,amount_per_amazon_survey,pay_method='submit_Amzonsurvey')
			}		
		},		
		error: function(error){ 			
		console.log(error);		
		}	
	});
	
}
*/
</script>


<script>
/*
function submit_Amazonsurvey(cc_id,virtual_amount,pay_method)
{		
	$.ajax({		
		url: "{{route('createUserVirtualcc')}}",		
		type: 'POST',		
		data: {cc_id:cc_id,virtual_amount:virtual_amount,"_token":$('#token').val(),offer_id:"{{$offerdetails[0]->id}}",pay_method:pay_method},
		dataType: 'json',		
		success: function(data)	{
			
			
			if(data.success == "success")
			{
		
				swal({
					  title: 'Virtual CC Updated',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
								
						$('#smartwizard').smartWizard('goToStep',2);

						getVCCamountinBento(cc_id);		
						
				});
				loading.waitMe('hide');
				
	
			}
			
		},		
		error: function(error){ 		
		console.log(error);		
		}	
	});	
}*/
</script>
