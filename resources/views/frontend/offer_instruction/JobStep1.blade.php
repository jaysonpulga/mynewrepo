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

.content-header2 {
    position: relative;
    padding-top: 15px;
}

.timer-clock {
    font-family: sans-serif;
    color: black;
    font-weight: 100;
    text-align: center;
    font-size: 25px;
}

.timer-clock div {
    padding: 5px;
    display: inline-block;
}

div#clockdiv.timer-alert .minutes, div#clockdiv.timer-alert .seconds , div#clockdiv.timer-alert .hours {
    color: #cc0000;
    font-weight: 900;
    font-size: 150%;
}


.timer-clock .smalltext {
    padding-top: 5px;
    font-size: 16px;
}

.timer-clock div {
    padding: 1px;
    display: inline-block;
}
.timer-clock div span {
    padding: 1px !important;
    width: 100%;
    display: inline-block;
}
</style>


<div class="row">
	<div class="col-sm-12">	
    	<div class="content-header2">
            <ol class="breadcrumb" id='breadcrumb'>
              <li><a href="{{asset('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            </ol>
        </div>
	</div>
</div>

<div id="content">
<section class="row">



<div class="col-md-4">

	<!-- box1 !-->
	<div class="box">
		<div class="box-header with-border">
		  <strong><center><h3 class="box-title">Market Research Job</h3></center></strong>
		</div>
		<div class="box-body">
			<ul style="color: rgba(47, 47, 47, 0.86);" class="ne elBulletList listBorder0 listSize3 listIcon6 listIconBlack de-editing-element" data-bold="inherit" contenteditable="true">
					<li>
						<b>Length: (180 mins to complete)</b>
					</li>
					<b>
						<li>
							<b>Yes, Earn Bonus Points!</b>
						</li>
					</b>
			</ul>
			<div class="box-header">
				<div class="col-lg-6">
					<p>Platform: Amazon.com</p>
					<p>Earnings: <br> 400 Points</p>
				</div>
				<div class="col-lg-6">
					<p>Campaign type: Research</p>
					<p>Required time: <br> 180 minutes</p>
				</div>
           </div>
		</div>
	</div>
	<!-- endbox1 !-->
	
	<!-- box2 !-->
	<div class="box">
		<div class="box-body">
			<div id="clockdiv" class="timer-clock timer-alert"></div>
		</div>
	</div>	
	<!-- endbox2 !-->
	
	
	 <!-- box 3-->
	<div class="box">
		<div class="box-body">
			<div class="box-header">
				<div class="col-sm-6">
			    	<button type="button"  class="btn btn-block btn-danger cancel btn-lg">Cancel</button>
				</div>
				<div class="col-sm-6">
					<a href="{{asset('dashboard')}}"  class="btn btn-block btn-primary btn-lg">Back</a>
				</div>
           </div>
		</div>
	</div>	
	<!-- endbox3 !-->
	

	
</div>

<div class="col-md-8">
	<div class="col-md-12">
		@if($offerdetails[0]->campaign_type == "insight campaign")
			  @include('frontend.offer_instruction.insight.insight_campaign')
	     @elseif($offerdetails[0]->campaign_type == "fullbuy campaign")
	          @include('frontend.offer_instruction.fullbuy.fullbuy_campaign')
	     @endif
	</div>
</div>

</section>	 
</div>


<script>
$(document).ready(function(){
		
		
		var dd = ""
		var row_id = "{{$offerdetails[0]->transact_id}}";	
		var countDownDate = new Date("{{$offerdetails[0]->confirm_date}} {{$offerdetails[0]->confirm_time}}");
	
		var timer =  countDownDate.setHours(countDownDate.getHours() + 3);
	
		dd +=	'<div>';
		dd +=		'<div>';
		dd +=			'<span id="hours_'+row_id+'" class="hours" >00</span>';
		dd +=			'<div class="smalltext">Hours</div>';
		dd +=		'</div>';
		dd +=		'<div>';
		dd +=			'<span id="time_'+row_id+'" class="minutes" >00</span>';
		dd +=			'<div class="smalltext">Minutes</div>';
		dd +=		'</div>';
		dd +=		'<div>';
		dd +=			'<span id="seconds_'+row_id+'" class="seconds">00</span>';
		dd +=			'<div class="smalltext">Seconds</div>';
		dd +=		'</div>';
		dd +=	'</div>';
	
	
	$("#clockdiv").empty().html(dd);
	timerko(row_id,timer);
	

});
</script>


<script>
function timerko(id,timer){
	
	// Set the date we're counting down to
	var countDownDate = new Date(timer).getTime();
	
	// Update the count down every 1 second
	var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor(((distance % (1000 * 60 * 60 )) / (1000 * 60)));
  var seconds = Math.floor(((distance % (1000 * 60)) / 1000));
    
  // Output the result in an element with id="demo"
  // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  // + minutes + "m " + seconds + "s ";
  //document.getElementById("demo").innerHTML =  minutes + "m " + seconds + "s ";
  
  //$("span#claim_"+id).empty().html(minutes + "m " + seconds + "s ");
  
  $("span#hours_"+id).empty().html(hours);
   $("span#time_"+id).empty().html(minutes);
  $("span#seconds_"+id).empty().html(seconds);
  

    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
	 $("#clockdiv").empty().html("<div style='style:font-color:red'><h3 ><center>EXPIRED</center></h3></div>");
	  expired_campaign(id)
    //document.getElementById("demo").innerHTML = "EXPIRED";
  }
  
}, 100);


}
</script>

<script>
function expired_campaign(id)
{
	
	var offer_id = "{{$offerdetails[0]->id}}";
		
	$.post("{{asset('expired_campaign')}}", {get_sched_id:id,"_token":$('#token').val(),offer_id:offer_id}, function(data){
		
		swal({ 				    
		  title: '',
		  text:  "This campaign is invalid",
		  type: 'error',
		}).then(function (result){
			
			window.location.href = "{{asset('dashboard')}}";
		
		});
	
	});
	
}
</script>

<script type="text/javascript">
var loading ="";
$(document).on('click', '.cancel', function(e){
e.preventDefault();

var offer_id = "{{ $offerdetails[0]->id }}";
var get_sched_id = "{{$offerdetails[0]->transact_id}}";



swal({	

	title: 'Cancel Request',
	text: 'would you like to cancel this campaign? ',
	type: 'question',
	showCancelButton: true,					
	cancelButtonText: "Stay this page",	
	confirmButtonText: 'Yes, I am sure',	
	}).then(function(){


   	    $.ajax({
					url: "{{asset('cancel_campaign')}}",
					type: 'POST',
					data: {offer_id:offer_id,"_token":$('#token').val(),get_sched_id:get_sched_id},
					dataType: 'json',
					success: function(data)
					{

						if(data.result == "success")
						{
							
							
							swal({
								  title: 'Campaign Cancelled',
								  text:  "",
								  type: 'success',
								}).then(function (result) {
								 
									window.location.href = "{{asset('dashboard')}}";
								  
								});
				
						}
						
					},
					error: function(error){ 
						console(error.result, error.message);
						console.log(error);
					}

		});

});
return false;


});
</script>



@endsection