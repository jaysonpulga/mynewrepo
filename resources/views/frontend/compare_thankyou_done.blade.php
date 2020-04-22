@extends('frontend.layouts.main')

@section('content')
<style>.content-header2 {
    position: relative;
    padding-top: 15px;
}
span.purple{
    background: #3c8dbc;
    border-radius: 0.8em;
    -moz-border-radius: 0.8em;
    -webkit-border-radius: 0.8em;
    color: rgb(255, 255, 255);
    display: inline-block;
    font-weight: bold;
    line-height: 1.6em;
    margin-right: 15px;
    text-align: center;
    width: 1.6em;
}
.box{
    border-top: 1px solid rgb(210, 214, 222) !important;
}
</style>
<style>
.stepper{padding-left:0}
.stepper li a{ padding:1.5rem;font-size:15px;text-align:center }
.stepper li a .circle {  
display: inline-block;
color: #fff;
border-radius: 5px;
background: rgba(0,0,0,.38);
width: 35px;
min-width: 35px;
height: 35px;
text-align: center;
line-height: 35px;
margin-right: .5rem;
font-size: 80%;
}

.stepper li a .label {
	font-size: 15px;
}

.stepper li a.disabled span.label{ 
pointer-events: none;
cursor: default;
color:#c0c3c5 !important;
}


.stepper li > a.disabled{ 
pointer-events: none;
cursor: default;
}

.stepper li a span.label{ color: rgba(0,0,0,.87);!important}

.stepper li a .label{ display:inline-block }
.stepper li a:hover .circle{ background-color:#167495}
.stepper li a.disabled{ cursor:default; color:#c0c3c5 !important}
.stepper li a.disabled .circle{ background: rgb(204, 206, 208);  }
.stepper li.active a .circle,.stepper li.completed a .circle{background-color:#20a8d8}
.stepper li.active a .label,.stepper li.completed a .label{font-weight:600;color:rgba(0,0,0,.87)}
.stepper li.warning a .circle{background-color:#f86c6b}


.stepper-horizontal{position:relative;display:flex;justify-content:space-between}
.stepper-horizontal li{transition:.5s;display:flex;align-items:center;flex-grow:1;position:relative}
.stepper-horizontal li a{padding:1rem 1.5rem}.stepper-horizontal li a .label{margin-top:.63rem}

.stepper-horizontal li:not(:first-child):before,.stepper-horizontal li:not(:last-child):after{ content:"";position:relative;flex:1;margin:.5rem 0 0;height:1px;background-color:rgba(0,0,0,.1)}

@media (max-width:47.9375rem)
{ 
.stepper-horizontal{flex-direction:column}
.stepper-horizontal li{ align-items:flex-start;flex-direction:column}
.stepper-horizontal li a{padding:1.5rem}
.stepper-horizontal li a .label{flex-flow:column nowrap;order:2;margin-top:0}
.stepper-horizontal li:not(:last-child):after{ 
	content: "";
    position: absolute;
    width: 1px;
    height: calc(100% - 49px);
    left: 3.1rem;
    top: 5.9rem; } 
}

.stepper-vertical{ position:relative;display:flex;flex-direction:column;justify-content:space-between}
.stepper-vertical li{display:flex;align-items:flex-start;flex:1;flex-direction:column;position:relative}
.stepper-vertical li a{align-self:flex-start;display:flex;position:relative}
.stepper-vertical li a .circle{order:1}
.stepper-vertical li a .label{flex-flow:column nowrap;order:2;margin-top:0}
.stepper-vertical li.completed a .label{ font-weight:500}
.stepper-vertical li .step-content{ display:block;margin-top:0;margin-left:3.13rem;padding:.94rem}

.stepper-vertical li .step-content p{font-size:.88rem}.stepper-vertical li:not(:last-child):after{ 
content:"";
position:absolute;
width:1px;height:calc(100% - 40px);
left:2.19rem;
top:3.44rem;
background-color:rgba(0,0,0,.1) 
}
.hide{
    display:none;
}
.highlight{
    border:1px solid red;
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
<div class="row">
    <div class="box">
	    <div class="box-header text-center with-border" style="background-color:#3c8dbc;color:white;">
	        <h4>Compare And Buy Campaign</h4>
	    </div>
	    @if(@$status[0]->completed_process == 1)
	    <div class="box-body">
            <div class="col-lg-12"style="margin-bottom:15px;" >
                <div class="form-group">
					<div class="col-lg-12">
					    <h4 style="font-weight:400;"><span class="purple">10</span>Thank you for purchasing our product. You have been claimed the Cashback: <strong style="margin-left:5px;">${{@$cashback}}</strong> And Bonus Points: <strong style="margin-left:5px;">{{@$points}}</strong></h4>
					</div>	
				</div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-lg-12">
                        <button id="completedthisoffer" type="submit" class="btn" style="background-color:#6ece16;color:#fff">Mark As Completed Offer</button>
                    </div>
                </div>
            </div>
	   </div>
	   @else
	   <div class="box-body">
            <div class="col-lg-12"style="margin-bottom:15px;" >
                <div class="form-group">
					<div class="col-lg-12">
					    <h4 style="font-weight:400;"><span class="purple">10</span>You Haven't Complete the process Yet</h4>
					</div>	
				</div>
            </div>
	   </div>
	   @endif
	</div>
</div>
<script>
var loading = "";


$("#completedthisoffer").click(function() 
{
	
		$.ajax({
		url: "{{asset('markasoffercompleted')}}",
		type: 'POST',
		data: {offer_id:"{{@$offer_id}}","_token":$('#token').val()},
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
@endsection