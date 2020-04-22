@extends('frontend.layouts.main')
@section('content')
<!-- Include Bootstrap CSS -->
<style>
.user-block img {
    width: 185px !important; 
    height: 185px !important; 
    float: left;
}
.user-block .description {
    color: #999;
    font-size: 15px !important;
	margin-left:180px;
	margin-top:5px;
}
.create_box
{
	padding-top:10px;
	padding-bottom:10px;
	padding-right:60px;
	padding-left:60px;
}


.tile-bar
{
	font-weight:bold;
	font-size:22px;
}



.box-title2
{
	font-weight:bold;
	font-size:24px;
}


</style>
<style>
.hidebutton
{
	display: none !important;
}

.showbutton
{
	display: inline !important;
}
.marginpadding
{
	clear:both;
	padding-top:25px !important;
}
</style>
<style>
#container2 {
  position: relative;
  width: 100%;
  height:65px;
}

.step-wizard {
  display: inline-block;
  position: relative;
  width: 85%;
}



.step-wizard ul {
  position: absolute;
  width: 100%;
  list-style-type: none;
    padding-left: 20px;
  /*
  left: -4%;
  */
}
.step-wizard li {
  display: inline-block;
 /*text-align: center;*/
  width: 14.7%;
}
.step-wizard li .step {
  position: absolute;
  display: inline-block;
  line-height: 40px;
  width: 40px;
  height: 40px;
  color:#fff;
  border-radius: 50%;
  border-color: #6ece16;
  background: #6ece16;
  -webkit-transition: background-color 0.6s ease, border-color 0.6s ease;
  -o-transition: background-color 0.6s ease, border-color 0.6s ease;
  transition: background-color 0.6s ease, border-color 0.6s ease;
}
.step-wizard li .titlex {
 font-weight:bold;
  line-height: 80%;
  position: relative;
  width: 100%;
  left:52px;
  line-height:2px;
  /*padding-top: 42px;*/
  color: #969c9c;
  -webkit-transition: color 0.6s ease;
  -o-transition: color 0.6s ease;
  transition: color 0.6s ease;
  

}
.step-wizard li.active .step {
  border-color: #0aa89e;
}

.step-wizard li.active .titlex {
  color: black;
}


.step-wizard li.done .step {
  color: white;
  background-color: #ccefac;
  border-color: #ccefac;
}


.step-wizard li.not_done .step {
  color: white;
  background-color: #ccefac;
  border-color: #ccefac;
}


.step-wizard li > a {
  display: inline;
  width: 100%;
  color: black;
  position: relative;
  text-align: center;
    text-decoration: none !important;
}

.step-wizard li > a:hover .step {
  border-color: #0aa89e;
  text-decoration: none !important;

}




.step-wizard li > a:hover .titlex {
  color: black;
  text-decoration: none !important;

}

.step-wizard li > a:hover > span .last_title 
{
	padding-bottom:3px;
	border-bottom:3px solid #6ece16;
}

div.step-wizard > ul  > li.active.focus >  a  > span.titlex > span.last_title 
{
	padding-bottom:3px;
	border-bottom:3px solid #3c8dbc;
}


div.step-wizard li.focus .step {
   background: #3c8dbc !important;
   
}



@media only screen and (max-width: 1200px) {
  .step-wizard li {
    width: 17%;
  }
  .step-wizard li .titlex {
    font-size: 12px;
  }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
}

@media only screen and (max-width: 900px) {
  .step-wizard li {
    width: 19%;
  }
  .step-wizard li .titlex {
    font-size: 12px;
  }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
}


@media only screen and (max-width: 660px) {
    
  .step-wizard li {
    width: 19%;
  }
  .step-wizard li .titlex {
    font-size: 11px;
     left: 49px;
  }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
}



@media only screen and (max-width: 570px) {
    
  .step-wizard li {
    width: 19.3%;
  }
 .step-wizard li .titlex {
    font-weight: bold;
    font-size: 11px;
    position: relative;
    width: 100%;
    left: 43px;
 }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
}


@media only screen and (max-width: 550px) {
    
  .step-wizard li {
    width: 19.2%;
  }
 .step-wizard li .titlex {
  top:37px;
  left:1px;
 }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
    
    #container2 {
  position: relative;
  width: 100%;
  height:96px;
}

}


@media only screen and (max-width: 440px) {
    
  .step-wizard li {
    width: 19%;
  }
 .step-wizard li .titlex {
  top:37px;
  left:1px;
 }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
    
    #container2 {
  position: relative;
  width: 100%;
  height:96px;
}
}




@media only screen and (max-width: 360px) {
    
  .step-wizard li {
    width: 19%;
  }
 .step-wizard li .titlex {
  top:37px;
  left:1px;
  font-size: 10px;
 }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
    
    #container2 {
  position: relative;
  width: 100%;
  height:96px;
}
}



@media only screen and (max-width: 359px) {
    
  .step-wizard li {
    width: 18%;
  }
 .step-wizard li .titlex {
  top:37px;
  left:1px;
 }
      .step-wizard {
      display: inline-block;
      position: relative;
      width: 100%;
    }
    
    #container2 {
  position: relative;
  width: 100%;
  height:96px;
}
}



@media only screen and (max-width: 300px) {
    
  .step-wizard li {
    width: 18%;
  }
 .step-wizard li .titlex {
display:none;
 }
     #container2 {
  position: relative;
  width: 100%;
  height:70px;
}
      

}

.contentarea { width:100%; padding:10px; display:none}
.contentarea.active { display:block}

.box {
  
    border-radius: 0px !important;
	border-top: 2px solid #d2d6de !important;
	padding-right: 1px !important;
	padding-left: 1px !important;
	
  
}


.disabled {
    pointer-events:none; //This makes it not clickable
    opacity:0.6;         //This grays it out to look disabled
}



.not_availble
{
 display:none !important;
}


.availble_step4
{
 display:inline !important;
}

.content-header2 {
    position: relative;
    padding-top: 15px;
}

</style>
<?php
    $check_step2_remove_disabled = 0;
    $check_step2_is_active = 0;
    $check_step3_remove_disabled = 0;
    $check_step3_is_active = 0;
    $check_step4_remove_disabled = 0;
    $check_step4_is_active = 0;
    $check_step_competed_offers_remove_disabled = 0;
    $check_step_competed_offers_is_active = 0;
    $check_step5_remove_disabled = 0;
    $check_step5_is_active = 0;
	if( $status_step2  == "active_step2" )
	{
		$check_step2_remove_disabled = 1;
	}
    if( $status_step3  == "active_step3" )
	{
		$check_step2_is_active = 1;
		$check_step3_remove_disabled = 1;
	}
    if( $status_step4  == "active_step4" )
	{
    	$check_step3_is_active = 1;
    	$check_step4_remove_disabled = 1;
	}
    if( $status_step5  == "active_step5" )
	{
		$check_step4_is_active = 1;
		$check_step_competed_offers_remove_disabled = 1;
	}      
?> 
<div class="row">
	<div class="col-sm-12">	
    	<div class="content-header2">
            <ol class="breadcrumb" id='breadcrumb'>
              <li><a href="{{asset('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
        </div>
	</div>
</div>

<script>
    $(".stp1").click(function() 
    {
      setClasses(1-1, $(".step-wizard ul li").length-1);
      
    });
    
    $(".back").click(function() 
    {
      setClasses(2-1, $(".step-wizard ul li").length-1);
      
    });
</script>




<div id="container2">
  <div class="step-wizard row">

  
    <ul>
      
        
      <li class="active">
        <a href="#step-1" >
          <span class="step">1</span>
		  <span class="titlex"  >Product<br><span class='last_title'>Details</span></span>
        </a>
      </li>
      
      
     <li class="{{($check_step2_is_active == 1) ? 'active':'not_done' }} {{(@$check_step2_remove_disabled == 0) ? 'disabled':'' }}"  >
         <a href="#step-2">
          <span class="step">2</span>
          <span class="titlex">Purchase<br><span class='last_title'>Product</span></span>
        </a>
      </li>
      
      <li class="{{($check_step3_is_active == 1) ? 'active':'not_done' }} {{(@$check_step3_remove_disabled == 0) ? 'disabled':'' }}"  >
         <a href="#step-3">
          <span class="step">3</span>
          <span class="titlex">Verify<br><span class='last_title'>Purchase</span></span>
        </a>
      </li>

      <li class="{{($check_step4_is_active == 1) ? 'active':'not_done' }} {{(@$check_step4_remove_disabled == 0) ? 'disabled':'' }}"   >
        <a href="#step-4" >
          <span class="step">4</span>
          <span class="titlex">Review<br><span class='last_title'>Product</span></span>
        </a>
      </li>
	  
	   <li class="{{($check_step_competed_offers_is_active == 1) ? 'active':'not_done' }} {{(@$check_step_competed_offers_remove_disabled == 0) ? 'disabled':'' }}"  >
        <a href="#step-5" >
          <span class="step">5</span>
          <span class="titlex">Product<br><span class='last_title'>Completed</span></span>
        </a>
      </li>

      
  
	 <!--
      <li class="{{($check_step5_is_active == 1) ? 'active':'not_done' }} {{($offerdetails[0]->allow_return_product == 'off') ? 'not_availble':'' }}  {{($check_step5_remove_disabled == 0) ? 'disabled':'' }}">
         <a href="#step-5">
          <span class="step">5</span>
          <span class="titlex">Return<br><span class='last_title'>Product</span></span>
        </a>
      </li>
	-->

    </ul>
  </div>


</div>



<div class="full-content">

	 <div id="step-1" class="contentarea active" >@include('frontend.offerdetails_view.new_productdetails')</div>
	 
	 <div id="step-2" class="contentarea" >
	     @if($source_campaign == "insight")
	         @include('frontend.offerdetails_view.new_productpurchase_insight')
	     @elseif($source_campaign == "fullbuy")
	          @include('frontend.offerdetails_view.new_productpurchase_fullbuy')
	     @endif
	  </div>
	 
	 <div id="step-3" class="contentarea" >@include('frontend.offerdetails_view.new_productsurvey')</div>
	 
	 <div id="step-4" class="contentarea" >@include('frontend.offerdetails_view.new_amazonreview')</div>
	 
	 <div id="step-5" class="contentarea">  @include('frontend.offerdetails_view.new_productcompleted')</div>
	
	 <div id="step-6" class="contentarea {{($offerdetails[0]->allow_return_product == 'off') ? 'not_availble':'' }}"> @include('frontend.offerdetails_view.new_productreturn') </div>
	
</div> 
 
 

<script>
$(document).ready(function() {
    
  // initial state setup
  var href = window.location.hash;
  
  setClasses(hastValue(href)-1, $(".step-wizard ul li").length-1);

 
});
</script>

<script>
$(".step-wizard ul a").click(function() {
      
    var step = $(this).find("span.step")[0].innerText;
    
    
    var href_val =  $(this).attr('href');
    var steps = $(".step-wizard ul li").length;
    setClasses(hastValue(href_val) - 1, steps - 1)
  
  });
</script>

<script>
function setClasses(index, steps) {
	  
   if (index < 0 || index > steps) return;
   
    $(".step-wizard ul li").each(function() {
	 $(this).removeClass('focus');
    });
	
	
	$(".step-wizard ul li:eq(" + index + ")").addClass("focus")


    $(".step-wizard ul li:eq(" + index + ")").addClass("active")
    
    
    $(".full-content > div").removeClass("active").eq(index).addClass("active");
	$(".step-wizard ul li:eq(" + index + ")").removeClass("not_done");
	
}
</script>
	


<script>
function hastValue(value)
{

    if(value ==  "#step-2" &&  "{{$status_step2}}" == "inactive_step2")
    {
    	swal({
    	    
			  title: "",
			  text:  "Purchase Product will be available on {{$getschedule->sched_date}}",
			  type: "warning",
		});
		
        val = 1;
        return false;
    }
    
    if(value ==  "#step-3" && "{{$status_step3}}" == "inactive_step3" )
    {
    	swal({
    	    
			  title: "",
			  text:  "Verify Purchase is not yet available",
			  type: "warning",
		});
		
        val = 1;
        return false;
    }
    
    
    if(value ==  "#step-4" &&  "{{$status_step4}}" == "inactive_step4")
    {
    	swal({
    	    
			  title: "",
			  text:  "Review Product is not yet available",
			  type: "warning",
		});
		
        val = 1;
        return false;
    }
    
    if(value ==  "#step-5" &&  "{{$status_step5}}" == "inactive_step5")
    {
    	swal({
    	    
			  title: "",
			  text:  "Product Completed not yet available",
			  type: "warning",
		});
		
        val = 1;
        return false;
    }
    

    switch(value) {
      case "#step-1":
        val = 1;
        $("ol#breadcrumb.breadcrumb").empty().html("<li><a href='{{asset('dashboard')}}'><i class='fa fa-dashboard'></i> Dashboard</a></li><li class='active'>Product Details</li>");
        break;
      case "#step-2":
        val = 2;
         $("ol#breadcrumb.breadcrumb").empty().html("<li><a href='{{asset('dashboard')}}'><i class='fa fa-dashboard'></i> Dashboard</a></li><li><a href='#step-1' class='stp1'>Product Details</a></li><li class='active'>Purchase Product</li>");
        break;
      case "#step-3":
        val = 3;
        $("ol#breadcrumb.breadcrumb").empty().html("<li><a href='{{asset('dashboard')}}'><i class='fa fa-dashboard'></i> Dashboard</a></li><li><a href='#step-1' class='stp1'>Product Details</a></li><li class='active'>Verify Purchase</li>");
        break;
    case "#step-4":
        val = 4;
        $("ol#breadcrumb.breadcrumb").empty().html("<li><a href='{{asset('dashboard')}}'><i class='fa fa-dashboard'></i> Dashboard</a></li><li><a href='#step-1' class='stp1'>Product Details</a></li><li class='active'>Review Product</li>");
        break; 
    case "#step-5":
        val = 5;
        $("ol#breadcrumb.breadcrumb").empty().html("<li><a href='{{asset('dashboard')}}'><i class='fa fa-dashboard'></i> Dashboard</a></li><li><a href='#step-1' class='stp1'>Product Details</a></li><li class='active'>Product Completed</li>");
        break; 
    }

return val;

}
</script>

<script type="text/javascript">
$(document).on('click', '.SaveAnswer', function(e)
{
e.preventDefault();

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
		else if ( $(this).data('fieldtype') != "Radio" )
		{
			answersamazonList.push({
					   model: 'amazon_survey',
					  questionId: questionId,
					  answer: $(this).val(),
					  'fieldtype':$(this).data('fieldtype')
			});
		} 
	
		

    });
	
	 var answersproductList = [];
    //Loop over all questions
    $(".productsurvey_ans").each(function() {
		
		var questionId = $(this).attr("id");
		
		
		if($(this).data('fieldtype') == "rating_star" ) 
		{
			
			var answer = $("input[type='radio']:checked", $(this)).val();
			if (answer !== undefined) 
			{
					answersproductList.push({
					  model: 'product_survey',
					  questionId: questionId,
					  answer: answer,
					  'fieldtype':$(this).data('fieldtype')
					});
			}
		}
		else if ( $(this).data('fieldtype') != "Radio" )
		{
			answersproductList.push({
					   model: 'product_survey',
					  questionId: questionId,
					  answer: $(this).val(),
					  'fieldtype':$(this).data('fieldtype')
			});
		} 
	
		

    });
	
//var newArray = $.merge(answersamazonList, answersproductList);	
 var myJSON = JSON.stringify(answersamazonList);	
 alert(myJSON);

return false;

saveAnswer(offerid="{{$offerdetails[0]->id}}",answersproductList,answersamazonList);

});
</script>

<script type="text/javascript"> 
function saveAnswer(offerid,answersproductList,answersamazonList)
{
	
	$.ajax({
		url: "{{route('saveAnswer')}}",
		type: 'POST',
		data: {offerid:offerid, answersproductList:answersproductList, answersamazonList:answersamazonList,"_token":$('#token').val()},
		dataType: 'json',
		beforeSend: function() {
			
			/*
			loading = $("body").waitMe({
				effect: 'timer',
				text: 'Saving...',
				bg: 'rgba(255,255,255,0.90)',
				color: '#555'
			}); 
			*/
		},
		success: function(data)
		{

			if(data.success == "success")
			{
				
				
				swal({
					  title: 'Successfully Submited - <br>Thank you!',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					 
						window.location.href = "{{asset('dashboard')}}";
					  
					});
	
			}
			
		},
		error: function(error){ 
			promptAjaxMessage(error.result, error.message);
			console.log(error);
		}

	});

}


function Cancel_request(id)
{
	swal({	
	
		title: 'Cancel Request',
		text: 'would you like to cancel this offer? ',
		type: 'question',
		showCancelButton: true,					
		cancelButtonText: "Stay this page",	
		confirmButtonText: 'Yes, I am sure',	
		}).then(function(){
			
			
		
			
			$.ajax({
					url: "{{route('canceloffer')}}",
					type: 'POST',
					data: {offerid:id,"_token":$('#token').val()},
					dataType: 'json',
					success: function(data)
					{

						if(data.success == "success")
						{
							
							
							swal({
								  title: 'Request Canceled',
								  text:  "",
								  type: 'success',
								}).then(function (result) {
								 
									window.location.href = "{{asset('dashboard')}}";
								  
								});
				
						}
						
					},
					error: function(error){ 
						promptAjaxMessage(error.result, error.message);
						console.log(error);
					}

				});
					
				
			
		},function(dismiss) {
		window.location.reload();
	});
}
</script>
@endsection
