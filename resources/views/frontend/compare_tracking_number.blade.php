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
	    <div class="box-body">
		    <div class="col-lg-12">
	            <div class="form-group">
					<div class="col-lg-12">
					    <h4><span class="purple">9</span>Verify Purchase.</h4>
					</div>	
				</div>
				<div class="col-lg-12" style="margin-top:10px;">
        		    <div class="row">
        		        <div id="tracking_status">	
                            <div class="col-sm-9">
                        			@if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
                        				<div style='border-radius:16px;background-color:#7bc7ea;padding:5px;text-align:center;font-size:17px;color:#fff'>
                        					<b>Thank you for purchasing our product you recieved ${{@$cashback}} to your vcc account and {{@$points}} Points</b>
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
										<select class="form-control required" id='shipment_company'>
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
										<input  onfocusout=""  type="text" id='saveTrackingnumber' class="form-control required"  value="{{  @$tracking_status[0]->tracking_number }}"  {{ (!empty(@$tracking_status[0]->tracking_number) && @$tracking_status[0]->remarks == 'Delivered') ? "readonly" : "" }} />
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
                            </div>
                            <div class="col-sm-3">
                    			<div style='' class='pull-right'>
                    				<span style='color:#777;font-size:15px;'>Complete the survey and<br> get rewarded</span>
                    				<div style='border-radius:16px;background-color:#6ece16;padding:10px;text-align:center;font-size:17px;color:#fff'><b>Cashback:${{@$cashback}} Points:{{@$points}}</b></div>
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
        		    </div>
    		    </div>
	        </div>
	   </div>
	   <div class="box-footer">
	       <div class="pull-right">
	           @if((!empty(@$tracking_status[0]->active_survey_date && @$tracking_status[0]->remarks == "Delivered")))
	           <button  id='productsurvey' type="button" class="btn" style='background-color:#6ece16;color:#fff'> Proceed </button>
	           @else
	           <button  id='productsurvey' type="button" class="btn" style='background-color:#6ece16;color:#fff'> Submit </button>
	           @endif
	       </div>
	   </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#productsurvey').click(function(){
            var offer_id = "{{@$id}}";
            var shipment_company = $('select option:selected').val();
            var trucking_number = $('#saveTrackingnumber').val();
            var tracking_notes = $('#tracking_notes').val();
            if(shipment_company == ''){
                check('Please select Courier !');
            }else if(trucking_number == ''){
                check('Please input tracking number');
            }else{
                $.ajax({
                    url:"{{asset('submit_tracking_number_and_survey')}}",
                    type:"POST",
                    headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                    data:{offer_id:offer_id,shipment_company:shipment_company,trucking_number:trucking_number,tracking_notes:tracking_notes,type:'compare'},
                    beforeSend:function(){
                        $("body").waitMe({
                            effect: 'timer',
                            text: 'Verifying Tracking Number ........ ',
                            bg: 'rgba(255,255,255,0.90)',
                            color: '#555'
                        });
                    },
                    success:function(data){
                        $("body").waitMe('hide');
                        console.log(data)
                        
                        if(data.result.status == 'Delivered' || data.result.status == 'delivered'){
                            swal({
                                type:'success',
                                title:"Successfully",
                                text:'Thanks for purchasing this product ,  you have received cashback rebate: ${{@$cashback}}'
                            }).then(function(){
                                // window.location.href="{{asset('campaign/thankyou/done/')}}/"+offer_id;
                                location.reload();
                            })
                        }else if(data.result == 'verified'){
                            window.location.href="{{asset('campaign/thankyou/done/')}}/"+offer_id;
                        }
                        else{
                            swal({
                                type:'warning',
                                title:"Successfully",
                                text: data.result.statusWithDetails
                            }).then(function(){
                                location.reload();
                            })
                        }
                        
                    },
                    error:function(){
                        $("body").waitMe('hide');
                        alert('error');
                    }
                })
            }
        })
        function check(message){
            swal({
                type:'warning',
                title:'Required',
                text:message,
            })
        }
    })
</script>
@endsection