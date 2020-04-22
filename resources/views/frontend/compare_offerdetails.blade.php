@extends('frontend.layouts.main')

@section('content')
<style>
.content-header2 {
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
.stepnum:hover{
    cursor:default;
}
</style>
<style>
.stepper{padding-left:0}
.stepper li a{ padding:1.5rem;font-size:15px;text-align:center }
.stepper li a .circle {  
display: inline-block;
color: #fff;
border-radius: 5px;
background: rgba(0,0,0,.1);
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

.stepper li:not(.not_done) a .circle:after{
    content: '\2713';
}
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
.contentarea.active{
    display:block;
}
.contentarea{
    display:none;
}
.current span{
    border:2px solid rgb(37, 170, 225);
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
<div class="full-content">
	 <div id="step-1" class="contentarea active" >@include('frontend.offerdetails_view.new_productdetails')</div>
	 <div id="step-2" class="contentarea">
	     <div class="row">
    	<div class="box">
    	    <div class="box-header text-center with-border" style="background-color:#3c8dbc;color:white;">
    	        <h4>Compare And Buy Campaign</h4>
    	    </div>
    		<div class="box-body">
    			<div class="col-lg-12">
    				<div class="form-group">
    					<div class="col-lg-12">
    					    <h4><span class="purple">1</span>Go to <b>amazon.com </b> and search for <small class="label bg-purple">{{@$primary}}</small></h4>
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
        		            <h4 style="font-weight:400;"><span class="purple">2</span>Search for these four products, fill in the ASIN and add the four products to your cart. Follow these instructions:</h4>
        		        </div>
        		    </div>
        		        <div class="form-group">
        		        <div class="col-lg-12">
        		            <ul class="stepper stepper-horizontal">
                            	@php $count = 0; @endphp
                    		    @foreach($competitors as $competitor)
                    		    @php $count++; @endphp
                    		        @if(@$competitor->addtocart == 1 && @$competitor->verified == 1)
                    		            @php 
                        		            @$done = $competitor->competitor_product_row + 1;
                        		        @endphp
                    		            <li class="active" data-competitor_row="{{$competitor->competitor_product_row}}">
                    		        @elseif(@$competitor->verified == 0 && $competitor->competitor_product_row == @$done || @$competitor->verified == 1)
                    		            <li class=" current not_done disabled" data-competitor_row="{{$competitor->competitor_product_row}}">
                    		        @else
                    		            <li class="{{($count == 1) ? 'current':''}} {{(@$competitor->active == 1) ? 'active':'not_done' }} {{(@$count == 1) ? 'disabled':'' }}" data-competitor_row="{{$competitor->competitor_product_row}}">
                    		        @endif
                                		<a href="javascript:void(0)" class="stepnum">
                                			<span class="circle">{{$count}}</span>
                                		</a>
                                	</li>
                    		    @endforeach
                            </ul>
        		        </div>
        		    </div>
        		    <style>
        		        .contentarea2{
        		            display:none;
        		        }
        		        .contentarea2.active{
        		            display:block;
        		        }
        		    </style>
        		    <div class="full-content">
            		    @php 
            		        $count = 0; 
            		        $total = count($competitors);
            		    @endphp
            		    @foreach($competitors as $competitor)
            		    @php $count++; @endphp
                		    @if(@$competitor->addtocart == 1 && @$competitor->verified == 1)
                		        @php 
                		            @$done = $competitor->competitor_product_row + 1;
                		        @endphp
                    		        @if(@$total == @$done - 1)
                    		            <div class="contentarea2 active" id="{{@$done - 1}}" data-competitor_row="{{$competitor->competitor_product_row}}">
                    		        @else
                    		            <div class="contentarea2" id="{{@$done - 1}}" data-competitor_row="{{$competitor->competitor_product_row}}">
                    		        @endif
                		    @elseif(@$competitor->verified == 0 && $competitor->competitor_product_row == @$done || @$competitor->verified == 1)
                		        <div class="contentarea2 active" id="{{@$done - 1}}" data-competitor_row="{{$competitor->competitor_product_row}}">
                		    @else
                		        <div class="contentarea2 {{(@$count != 1) ? '':'active' }}" id="{{@$done - 1}}" data-competitor_row="{{$competitor->competitor_product_row}}">
                		    @endif
                		        <div class="form-group">
                    		        <div class="col-lg-12">
                    		            <div class="row setup-content">
                                            <div class="col-md-3">
                                                <!--<img class="img-responsive img-bordered" src="https://images-na.ssl-images-amazon.com/images/I/81JmKcsAdOL.jpg">-->
                                                @if($count == 1)
                                                    <img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$images[0]->image_path}}"/>
                                                @else
                                                    <img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$competitor->competitor_image_path}}"/>
                                                @endif
                                            </div>
                                            <div class="col-md-9">
                                                <h3>Product {{$count}}</h3>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Fill the ASIN </label>
                                                    @if(@$competitor->verified == 1)
                                                    <input type="text" value="{{@$competitor->product_id}}" data-competitor_row="{{$competitor->competitor_product_row}}" class="form-control" required="required" name="product_{{$count}}" placeholder="Please Fill ASIN" disabled>
                                                    @else
                                                    <input type="text" data-competitor_row="{{$competitor->competitor_product_row}}" class="form-control" required="required" name="product_{{$count}}" placeholder="Please Fill ASIN" >
                                                    @endif
                                                </div>
                                                <p class="error_msg" style="display: none; color: red;">Whoops - ASIN not correct. Try Again</p>
                                                <p class="success_msg" style="display: none; color: green; font-size: 14px; font-weight: bolder;">Perfect! Add this product to your cart.</p>
                                                <div class="form-group verified_mess_{{$competitor->competitor_product_row}}">
                                                    @if(@$competitor->verified == 0)
                                                        @if($total == $count)
                                                            <button data-offer_id="{{$offer_id}}" last_row="true" data-competitor_row="{{$competitor->competitor_product_row}}" class="btn btn-success checkAsinCompare loading" data-product_id="{{$count}}">Validate ASIN</button>
                                                            
                                                        @else
                                                        <button data-offer_id="{{$offer_id}}" data-competitor_row="{{$competitor->competitor_product_row}}" class="btn btn-success checkAsinCompare loading" data-product_id="{{$count}}">Validate ASIN</button>
                                                        @endif
                                                    @else
                                                        <span style="color:green">Perfect! Add this product to your cart</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="check_in_cart" style="position:relative;">
                                                        <label>
                                                            @if(@$competitor->addtocart == 1)
                                                            <input type="checkbox" required="required" name="check_in_cart" data-competitor_row="{{$competitor->competitor_product_row}}" class="check_in_cart" checked> I added this product to my Cart!
                                                            @else
                                                            <input type="checkbox" required="required" name="check_in_cart" data-competitor_row="{{$competitor->competitor_product_row}}" class="check_in_cart"> I added this product to my Cart!
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="pull-right">
                                                    <!--<button class="btn prevBtn btn-lg"data-step="{{$count}}" type="button">Previous</button>-->
                                                    @if($total == $count)
                                                        @if(@$competitor->verified == 1)
                                                            @if(@$total == @$done - 1)
                                                                <button class="btn finishBtn btn-lg step_{{$count+1}}" type="button" data-competitor_row="{{$competitor->competitor_product_row}}" disabled>Finish</button>
                                                            @else
                                                                <button class="btn finishBtn btn-lg step_{{$count+1}}" type="button" data-competitor_row="{{$competitor->competitor_product_row}}">Finish</button>
                                                            @endif
                                                            
                                                        @else
                                                            <button class="btn finishBtn btn-lg step_{{$count+1}}" data-competitor_row="{{$competitor->competitor_product_row}}" type="button" disabled>Finish</button>
                                                        @endif
                                                        
                                                    @else
                                                        @if(@$competitor->verified == 1)
                                                            <button data-competitor_row="{{$competitor->competitor_product_row}}" class="btn nextBtn btn-lg" type="button">Next</button>
                                                        @else
                                                            <button data-competitor_row="{{$competitor->competitor_product_row}}" class="btn nextBtn btn-lg step_{{$count+1}}" data-step="{{$count+2}}" disabled type="button">Next</button>
                                                        @endif
                    		                        @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                    		        </div>
                    		    </div>
                		    </div>
                		    
            		    @endforeach
        		    </div>
    		    </div>
		    </div>
		</div>
		<div class="box box-solid">
            <div class="box-header with-border">
                <div class="alert alert-success alert-dismissible succes-msg" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Yeah! Good Job</h4>
                        Whoop Whoop! You have added the right asins! Now You are ready to continue!
                </div>
                <h4><span class="purple">3</span>Add all the products above to your shopping cart and proceed to the next step! </h4>
                <div class="box-footer">
                    @if(@$total == @$done - 1)
                        <a href="javascript:void(0)" class="btn btn-primary pull-right nextStep loading update_step_done">Continue to the next step!</a>
                    @else
                        <a href="{{asset('campaign/offerdetails/finish')}}/{{@$offerdetails[0]->id}}" class="btn disabled btn-primary pull-right nextStep loading">Continue to the next step!</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
	 </div>
</div>
<script>
    $(document).on('click','.update_step_done',function(){
        var offer_id = "{{$offer_id}}";
        $.ajax({
            url:'{{asset("campaign/update/compare/next_step_done")}}',
            type:"POST",
            headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
            data:{offer_id:offer_id},
            success:function(data){
                window.location.href="{{asset('campaign/offerdetails/finish/')}}/"+offer_id;
            }
        })
    })
</script>
<script>
	    $(document).ready(function(){
	        var href = window.location.hash;
	        var new_href = href.replace('#',"");
	        if(new_href == 'step-2'){
	            $('div#step-1').removeClass('active');
	            $('div#step-2').addClass('active');
	        }else{
	            $('div#step-2').removeClass('active');
	            $('div#step-1').addClass('active');
	        }
	        $('.continue').click(function(){
	            $('div#step-1').removeClass('active');
	            $('div#step-2').addClass('active');
	        })
	    })
	</script>
    <script>
        $(document).ready(function(){
            var arrayFromPHP = <?php echo json_encode($competitors) ?>;
            var length = arrayFromPHP.length;
            var count = 0;
            $.each(arrayFromPHP, function (i, elem) {
                count++;
               if(elem.active == 1){
                   $('input[data-competitor_id="'+elem.competitor_id+'"]').val(elem.product_id);
                   $('input[data-competitor_id="'+elem.competitor_id+'"]').prop('disabled',true);
                   $('.checkAsinCompare[data-competitor_id="'+elem.competitor_id+'"]').prop('disabled',true);
                   var step = elem.competitor_id + 2;
                  $('.contentarea2').each(function(){
                      if($(this).attr('id') == 'step'+step){
                            $(this).addClass('active');
                        }else{
                            $(this).removeClass('active');
                        }
                  })
                   if(count == length){
                       var step = elem.competitor_id + 1;
                    //   $('.finishBtn').prop('disabled',false);
                       $('.contentarea2').each(function(){
                           if($(this).attr('id') == 'step'+step){
                                $(this).addClass('active');
                            }else{
                                $(this).removeClass('active');
                            }
                       })
                   }
               }else{
                   var step = elem.competitor_id + 1;
                   $('.step_'+step).prop('disabled',true);
               }
               
            });
            
            $('.nextBtn').click(function(){
                var row = $(this).attr('data-competitor_row');
                var offer_id = "{{$offer_id}}";
                var check = $('input[data-competitor_row="'+row+'"]').is(':checked');
                if(check == true){
                    $.ajax({
                        url:'{{asset("campaign/update/compare/update_compare_addtocart")}}',
                        type:"POST",
                        headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                        data:{row:row,offer_id:offer_id},
                        success:function(data){
                            var new_row = parseInt(row) + 1;
                            $('ul.stepper li[data-competitor_row="'+row+'"]').removeClass('current not_done disabled');
                            $('ul.stepper li[data-competitor_row="'+row+'"]').addClass('active');
                            $('.contentarea2[data-competitor_row="'+row+'"]').removeClass('active');
                            
                            $('.contentarea2[data-competitor_row="'+new_row+'"]').addClass('active');
                            $('ul.stepper li[data-competitor_row="'+new_row+'"]').addClass('current disabled');
                            console.log(new_row)
                            // location.reload();
                        }
                    })
                }else{
                    swal({
                        type:'error',
                        title:'Required !',
                        text:'Checkbox is Required !'
                    })
                }
            })
            $('.finishBtn').click(function(){
                var row = $(this).attr('data-competitor_row');
                var offer_id = "{{$offer_id}}";
                var check = $('input[data-competitor_row="'+row+'"]').is(':checked');
                if(check == true){
                    $.ajax({
                        url:'{{asset("campaign/update/compare/update_compare_addtocart")}}',
                        type:"POST",
                        headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                        data:{row:row,offer_id:offer_id},
                        beforeSend:function(){
                            $("body").waitMe({
                                effect: 'timer',
                                text: 'Please Wait ........ ',
                                bg: 'rgba(255,255,255,0.90)',
                                color: '#555'
                            }); 
                        },
                        success:function(data){
                            $.ajax({
                                url:'{{asset("campaign/update/compare/update_compare_addtocart")}}',
                                type:"POST",
                                headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                                data:{row:row,offer_id:offer_id,last:'last'},
                                success:function(data){
                                    $('body').waitMe('hide');
                                    if(data.success == true){
                                        swal({
                                            type:'success',
                                            title:"Successfully !",
                                            text:"Updated successfully"
                                        }).then(function(){
                                            $('.finishBtn').addClass('active');
                                            $('.nextStep').removeClass('disabled');
                                            location.reload();
                                        })
                                    }
                                }
                            })
                            
                        }
                    })
                }else{
                    swal({
                        type:'error',
                        title:'Required !',
                        text:'Checkbox is Required !'
                    })
                }
            })
            $('.prevBtn').click(function(){
                var step = $(this).attr('data-step');
                $('.contentarea2').each(function(){
                    if($(this).attr('id') == 'step'+step){
                        $(this).addClass('active');
                    }else{
                        $(this).removeClass('active');
                    }
                })
            })
            // $('ul.stepper li').click(function(){
            //     var step = 'step'+$(this).attr('data-step');
            //     console.log(this)
            //     $('.contentarea2').each(function(){
            //         if($(this).attr('id') == step){
            //             $(this).addClass('active');
            //         }else{
            //             $(this).removeClass('active');
            //         }
            //     })
            // })
            $('.checkAsinCompare').click(function(){
                var product_id = $(this).attr('data-product_id');
                var ASIN = $('input[name="product_'+product_id+'"]').val();
                var offer_id = $(this).attr('data-offer_id');
                var competitor_row = $(this).attr('data-competitor_row');
                var last_row = false;
                if($(this).attr('last_row')){
                    last_row = true;
                }
                if(ASIN == ''){
                    swal({
                        type:'warning',
                        title:'Warning !',
                        text:'Please Input ASIN'
                    })
                }else{
                    $.ajax({
                    url:'{{asset("campaign/update/check_asin_competitor")}}',
                    type:'POST',
                    headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                    data:{product_id:product_id,ASIN:ASIN,offer_id:offer_id,competitor_row:competitor_row},
                    beforeSend:function(){
                        $("body").waitMe({
                            effect: 'timer',
                            text: 'Verifying ASIN ........ ',
                            bg: 'rgba(255,255,255,0.90)',
                            color: '#555'
                        });   
                    },
                    success:function(data){
                        $("body").waitMe('hide');
                        if(data.success == true){
                            swal({
                                type:'success',
                                title:'Congratulations !',
                                text:data.message
                            }).then(function(){
                                $('input[data-competitor_row="'+competitor_row+'"][name="product_'+product_id+'"]').attr('disabled',true);
                                $('.verified_mess_'+competitor_row).html('');
                                $('.verified_mess_'+competitor_row).html('<span style="color:green">Perfect! Add this product to your cart</span>');
                                $('.nextBtn[data-competitor_row="'+competitor_row+'"]').attr('disabled',false);
                                if(last_row == true){
                                    $('.finishBtn').attr('disabled',false);
                                }
                                // location.reload();
                            })
                        }else{
                            swal({
                                type:'error',
                                title:'Invalid !',
                                text:data.message
                            })
                        }
                    }
                })
                }
                
            })
        })
    </script>
@endsection