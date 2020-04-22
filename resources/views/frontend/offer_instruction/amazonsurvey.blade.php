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

	font-size:15px;
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
<div class="row" >
<div class="box" >
<div class="box-body">
<div id="tracking_status">	
<div class="col-sm-12">
<div class="col-sm-9">
<div id='target_panel'></div> 
<h2>Review Product</h2>
<form id="amazon_form" method="post"> 
{{ csrf_field() }}
@foreach($amazonreview as  $key => $amazondata)
<div class="row">	
	<div class="col-sm-12">

		@if (!empty($amazondata->header_label))
			<span style='font-size:20px' > {{$amazondata->header_label}} </span> <br>
		@endif
		
		@if (!empty($amazondata->question))
			<span class="description">{{$amazondata->question}}</span><br>
		@endif
		

		@if ($amazondata->form == "TextField")
			<input  class="form-control amazonstart_ans" data-fieldtype="inputfield" id="{{$amazondata->id}}"  style="width:100%" required id="amazon_answer" name="amazon_answer[]" >
		
		@elseif($amazondata->form == "file_upload")
		
			<br><input type="file"   class="amazonstart_ans filename" accept=".jpg,.jpeg.,.gif,.png,.mp4,.mp3,.vlc" data-fieldtype="file" id="{{$amazondata->id}}"/>
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

	
			<textarea  class="form-control amazonstart_ans" data-fieldtype="textarea" id="{{$amazondata->id}}"   rows="3" style="width:100%" ></textarea>

		@elseif($amazondata->form == "rating_star")	
     
			<fieldset   class="rating amazonstart_ans" data-fieldtype="rating_star"  id="{{$amazondata->id}}"  >

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

				<label class = "full" for="star1_{{$amazondata->id}}" title=`````"big time - 1 star"></label>

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
<br>


@endforeach			
	

<div class="row ">
    
    
	<div class="form-group">
	    
	    @if($amazon_review_answers->isEmpty())
    		<div class="col-lg-12">
    			<button  type="submit" class="btn" style='background-color:#6ece16;color:#fff'> Submit </button>	
    		</div>	
		@endif
		
		 @if( !empty($amazon_review_answers) && count($amazon_review_answers) > 0 )
			 <div class="col-lg-12">
                  <a href="javascript:void(0)" class="btn btn-primary proceed_competed"><i class="fa fa-fw fa-check-circle-o"></i> Mark As completed this campaign</a>
				  
				  
				  
            </div>
    	@endif
    	    
    
    	<div id='div_panel_next'></div>
		
	</div>
	
	
	
	
</div>

</form>	

	

<br>
<br>			

</div>
		
		<div class="col-sm-3">
		    
			<div style='width:70%' class='pull-right'>
				<span style='color:#777;font-size:15px;'>Complete the product review and get rewarded</span>
				<div style='border-radius:16px;background-color:#6ece16;padding:5px;text-align:center;font-size:17px;color:#fff'><b>Reward:${{$fee_amazon_rebate}}</b></div>
			</div>	
			
			
		</div>
			
			
</div><!--end 12-->
	
		
</div><!--end tracking_status-->

</div><!--end box-body-->
</div><!--end box-->
</div><!--end row-->


@include('frontend.offerdetails_view.function.amazon_function')




<script type="text/javascript">
$(document).ready(function()
{
	getthirdstep();
	
});

</script>

<script>
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
					//ifcursor_is_inStep4();

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
						$('fieldset#'+data[index].questionId+'.rating.amazonstart_ans').prop('disabled', true);

					}

					else if(data[index].form == "inputfield")
					{
						
						$("#"+data[index].questionId+'.amazonstart_ans').val(data[index].answer);
						$("#"+data[index].questionId+'.amazonstart_ans').css('readonly','readonly');
						
						$('input#'+data[index].questionId+'.form-control.amazonstart_ans').prop('readonly', true);
				
					}
					else if(data[index].form == "textarea")
					{
						$("#"+data[index].questionId+'.amazonstart_ans').val(data[index].answer);
						$('textarea#'+data[index].questionId+'.form-control.amazonstart_ans').prop('readonly', true);

					}
					
					else if (data[index].form == "file" ) 
					{
						if(data[index].answer != "")
						{
							$("#file_"+data[index].questionId).empty().html('<object  height="250" data="'+data[index].answer+'"></object>');
							$('input#'+data[index].questionId+'.amazonstart_ans.filename').prop('disabled', true);
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
</script>



<script>
$("#amazon_form").on("submit", amazonsurvey);

function amazonsurvey(event)
{
	event.preventDefault();	
	  var answersamazonList = [];
	  
	  var answer='';

    //Loop over all questions

    $(".amazonstart_ans").each(function() {


		var questionId = $(this).attr("id");
		if($(this).data('fieldtype') == "rating_star" ) 
		{

			

			answer = $("input[type='radio']:checked", $(this)).val();

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
    
    

	var star_value = answer.split("and");
	
	if(star_value[1])
	{
		var star_replace = star_value[1].replace("half", .5);
		var new_rate_val = (Number(star_value[0]) + Number(star_replace));
	}
	else
	{
		var new_rate_val = star_value[0];
	}


	$.ajax({

		url: "{{asset('submit_amazonsesurvey')}}",
		type: 'POST',

		data: {offerid:"{{$offerdetails[0]->id}}", answersamazonList:answersamazonList,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() 
		{
				
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Review Survey Submitting........',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
				
		},	
		success: function(data)
		{
		
			loading.waitMe('hide');
			if(data.success == "success")
			{

                    // if pasado at mataas sa number 3
                	if(new_rate_val >= 3)
                	{
                	  	   swal({
        				    
        					  title: 'Review Survey Submited!',
        					  text:  "Thank you for answering our product survey, it looks like you enjoyed the product",
        					  type: 'success',
        					}).then(function (result) 
        					{
        					    getthirdstep();
        			    	});
        			    	
        			    	
        			    	
        			    	
                	
                	}
                	else
                	{
                	    
                	       swal({
        				    
        					  title: 'Review Survey Submited!',
        					  text:  "Thank you for sharing your thoughts",
        					  type: 'success',
        					  
        					}).then(function (result) 
        					{
        					    location.reload();
        			    	});
                	
                	    
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
var loading = "";
$(".proceed_competed").click(function() 
{

		$.ajax({
		url: "{{asset('markasoffercompleted')}}",
		type: 'POST',
		data: {offer_id:"{{$offerdetails[0]->id}}","_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
		
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'this campaign will move to the completed offer table.....',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			
		},
		success: function(data)
		{
			
			if(data.result == "success")
			{
				//loading.waitMe('hide');
				console.log(data);
				
				// submit_purchasesurvey();  // saving purchase survey data
			   // getfirststep();			// get Status of Shipment company
			  // checkifcomplete();        //check status
				
				
				
				loading.waitMe('hide');
				swal({
					  title: 'Success, Campaign Completed!',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
						window.location.href = "{{asset('dashboard')}}";
				}); 
				
				
				
			}
			
		},
		error: function(error){ 
			console.log(error);
			loading.waitMe('hide'); 
		}

	});

});
</script>
	