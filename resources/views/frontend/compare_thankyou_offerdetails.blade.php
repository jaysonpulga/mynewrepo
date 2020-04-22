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
		<div class="box-body">
		    <div class="col-lg-12">
	            <div class="form-group">
					<div class="col-lg-12">
					    <h4><span class="purple">7</span>Proceed to Checkout. Buy this item and share your Order ID below.</h4>
					</div>	
				</div>
	        </div>
			<div class="col-lg-12" style="margin-top:10px;">
    		    <div class="row">
    		        <div class="form-group">
    		            <div class="col-md-3">
    		                <img class="img-responsive img-bordered" style='height: 200px; width: 280px; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$images[0]->image_path}}"/>
    		            </div>
    		            <div class="col-md-9">
    		                <div class="row">
    		                    <div class="col-md-9">
        		                    <h4>{{@$offer_details[0]->product_name}}</h4>
        		                </div>
    		                </div>
    		                <div class="row">
    		                    <div class="col-md-9">
        		                    {!!html_entity_decode( $offer_details[0]->product_description) !!}
        		                </div>
    		                </div>
    		                <div class="row">
    		                    <div class="col-md-9">
        		                    Price: USD {{number_format($offer_details[0]->user_product_price,2)}} (exclusing VAT/TAX)
        		                </div>
    		                </div>
    		                <div class="row" style="margin-top:5px;">
    		                    <div class="col-md-9">
    		                        MarketPlace: Amazon.com
    		                    </div>
    		                </div>
    		                <!--<div class="row" style="margin-top:5px;">-->
    		                <!--    <div class="pull-right">-->
    		                <!--        <button class="btn btn-success btnnext">Continue to the next step</button>-->
    		                <!--    </div>-->
    		                <!--</div>-->
    		            </div>
    		        </div>
    		    </div>
    		</div>
		</div>
	</div>
	<div class="box">
	    <div class="box-body">
	        <div class="col-lg-12">
	            <div class="form-group">
					<div class="col-lg-12">
					    <h4><span class="purple">8</span>Share Your Amazon Order ID Below.</h4>
					</div>	
				</div>
	        </div>
	        <div class="col-lg-12">
	            <div class="form-group">
					<div class="col-lg-12">
					    <div class="col-md-3">
					        <h5>Amazon Order ID:</h5> 
					    </div>
					    <div class="col-md-9">
					        <input type="text" {{ !empty(@$order_num) ? "disabled" : "" }} class="form-control" value="{{@$order_num}}" name="order_num" placeholder="Enter Order ID">
					    </div>
					</div>	
				</div>
	        </div>
	        <div class="col-lg-12" style="margin-top:15px;">
	            <div class="form-group">
					<div class="col-lg-12">
					    <p>The order amount will be refunded on your PayPal Account which is set in your profile. We will refund after the order is shipped by Amazon.</p>
					</div>	
				</div>
	        </div>
	        <div class="col-lg-12">
	            <div class="form-group">
	                <div class="col-lg-12">
	                    <div class="pull-right">
                            <button class="btn btn-success btn-order_id" {{ !empty(@$order_num) ? "disabled" : "" }}>Submit</button>
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<script>
    $(document).ready(function(){
        // $('.btn-order_id').click(function(){
        //     var order_num = $('input[name="order_num"]').val();
        //     var offer_id = "{{$offer_id}}";
        //     if(order_num == ''){
        //         swal({
        //             type:'warning',
        //             title:'Warning!',
        //             text:'Please input Order ID',
        //         })
        //     }
        //     else{
        //         $.ajax({
        //         url:'{{asset("campaign/compare/order_num")}}',
        //         type:'POST',
        //         headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
        //         data:{order_num:order_num,offer_id:offer_id},
        //         beforeSend:function(){
        //           $("body").waitMe({
        //             effect: 'timer',
        //             text: 'Please Wait........ ',
        //             bg: 'rgba(255,255,255,0.90)',
        //             color: '#555'
        //             });  
        //         },
        //         success:function(data){
        //             $('body').waitMe('hide');
        //             if(data.success == true){
        //                 swal({
        //                     type:'success',
        //                     title:'Congratulations !',
        //                     text:'Your Order number has been sent !'
        //                 }).then(function(){
        //                     window.location.href = "{{asset('campaign/thankyou/done')}}/"+offer_id;
        //                 })
        //             }
        //         }
        //     })
        //     }
        // })
        $('.btn-order_id').click(function(){
            var order_num = $('input[name="order_num"]').val();
            var offer_id = "{{$offer_id}}";
            if(order_num == ''){
                swal({
                    type:'warning',
                    title:'Warning!',
                    text:'Please input Order ID',
                })
            }
            else{
                $.ajax({
                url:'{{asset("campaign/compare/order_num")}}',
                type:'POST',
                headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                data:{order_num:order_num,offer_id:offer_id},
                beforeSend:function(){
                  $("body").waitMe({
                    effect: 'timer',
                    text: 'Please Wait........ ',
                    bg: 'rgba(255,255,255,0.90)',
                    color: '#555'
                    });  
                },
                success:function(data){
                    $('body').waitMe('hide');
                    if(data.success == true){
                        swal({
                            type:'success',
                            title:'Congratulations !',
                            text:'Your Order number has been sent !'
                        }).then(function(){
                            window.location.href = "{{asset('campaign/compare/tracking_number')}}/"+offer_id;
                        })
                    }
                }
            })
            }
        })
    })
</script>
@endsection