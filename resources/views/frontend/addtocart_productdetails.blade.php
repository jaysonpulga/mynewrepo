@extends('frontend.layouts.main')

@section('content')
<style>
    .box-header h1{
        font-size: 38px;
    }
    .contentarea.active{
    display:block;
}
.contentarea{
    display:none;
}
</style>
<!--// div secondpanel -->
	@include('frontend.layouts.secondpanel')  
<!--  ~end secondpanel -->
<div class="full-content">
    <div id="step-1" class="contentarea active"></div>
    <div id="step-2" class="contentarea">
        <div class="row">
            <div class="box">
                <div class="box-body" style="padding-top:0px !important;">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="box-header text-center">
                                    <h1>Thank You! Now Complete The Following Steps</h1>
                                    <span>In order to receive your points. Search for the following steps below.</span>
                                </div>
                                <div class="col-sm-6">	
                        			<div class="preview-image">
                        				<div id="preview-enlarged" style="height: 300px; width: 100%; background-color: #d8cfcf">
                        				   
                        					<img style="height: 100%; width: 100%; object-fit: contain" src="https://researchsale.com/seller_beta/public/offer_images/{{(@$images != '') ? $images:'default_product.jpg'}}"> 
                        				</div>
                        			</div>
                		        </div>
                		        <style>
                		            .out_of_time h4{
                		                color:red;
                		            }
                		        </style>
                        		<div class="row">
                        		    <div class="col-sm-6 remaining">
                            		    <div style="text-align:center;">
                            		        <h4>Time Remaining</h4>
                            		    </div>
                            		</div>
                            		<div class="col-sm-3" style="margin:20px 0 20px 0;">
                            		    <div style="text-align:right;">
                            		        <h2 class="minutes">00</h2>
                            		    </div>
                            		</div>
                            		<div class="col-sm-3"style="margin:20px 0 20px 0;">
                            		    <div style="text-align:left;">
                            		        <h2 class="seconds">00</h2>
                            		    </div>
                            		</div>
                            		<div class="col-sm-3">
                            		    <div style="text-align:right;">
                            		        <h4>Minutes</h4>
                            		    </div>
                            		</div>
                            		<div class="col-sm-3">
                            		    <div style="text-align:left;">
                            		        <h4>Seconds</h4>
                            		    </div>
                            		</div>
                            		<div class="col-sm-6 text-center">
                            		    <h3>Earn Points: <span class="label label-success">55</span></h3>
                            		</div>
                        		</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box step_box">
                <div class="box-body" style="padding-top:0px !important;">
                    <div class="col-lg-12" style="padding-bottom:15px;">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="box-header">
                                    <h3 class="text-bold">Step 1.  <span style="font-size:18px;font-weight:500;"> Find The Product On Amazon.com using the keyword <span class="label label-success">{{@$primary}}</span> in the searchbar</span></h3>
                                </div>
                                <div class="box-header">
                                    <span>Maybe you have to click through multiple pages. but it is listed somewhere To show us that you found the correct item paste of the ASIN of the product below.</span>
                                </div>
                                <button class="btn btn-primary btn-ASIN">How can i find ASIN?</button>
                                    <div class="box-header">
                                        <label>ASIN</label>
                                        @if($steps_done[0]->step1 == 0)
                                            <input type="text" class="form-control" name="ASIN" placeholder="Enter Your ASIN Here !">
                                            <div class="box-header">
                                                <button class="btn btn-primary btn-check_asin">Validate your ASIN !</button>
                                            </div>
                                        @else
                                            <input type="text" class="form-control" aria-describedby="emailHelp" value="{{@$offerdetails[0]->product_id}}" placeholder="Enter Your ASIN Here !" disabled><br>
                                            <span style="color:green;">Perfect ! ASIN is valid</span>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box step_box">
                <div class="box-body" style="padding-top:0px !important;">
                    <div class="col-lg-12">
                        <div class='form-group'>
                            <div class="col-lg-12">
                                <div class="box-header">
                                    <h3 class="text-bold">Step 2.  <span style="font-size:18px;font-weight:500;"> Add the product to your cart.</span></h3>
                                </div>
                                <div class="box-header">
                                    <span>Don't buy just add it to your cart.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box step_box">
                <div class="box-body">
                    <div class="col-lg-12" style="padding-bottom:15px;">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="box-header">
                                    <h3 class="text-bold">Step 3.  <span style="font-size:18px;font-weight:500;"> Take a screenshot of your cart, and post it here</span></h3>
                                </div>
                                    <div class="box-header">
                                        <div class="col-lg-12">
                                            <div class="col-md-4">
                                                <span>Upload here!</span>
                                            </div>
                                            <div class="col-md-8">
                                                <div style="margin-bottom:5px;">
                                                    @if(@$steps_done[0]->step3 == 1)
                                                        <input type="file" id="" name="" disabled>
                                                    @else
                                                        <input type="file" id="file" name="screenshot">
                                                    @endif
                                                </div>
                                                @if(@$steps_done[0]->step3 == 1)
                                                    <div style="margin-bottom:5px;">
                                                        <span>You had uploaded your screenshot</span>
                                                    </div>
                                                @else
                                                    <div style="margin-bottom:5px;">
                                                        <span>Please Check ASIN First!</span>
                                                    </div>
                                                    @if(@$steps_done[0]->step1 == 1)
                                                        <button class="btn btn-primary btn-upload_ss" style="margin-bottom:15px;">Submit</button><br>
                                                    @else
                                                        <button class="btn btn-primary btn-upload_ss" style="margin-bottom:15px;" disabled>Submit</button><br>
                                                    @endif
                                                    <a href="javascript:void(0)" class="cancel_gig" style="color:rgb(78, 146, 223);">Cancel this Gig !</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModalfind-asin" class="modal fade in" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">How to find an ASIN of a product?</h4>
              </div>
              <div class="modal-body" style="padding-right: 45px;">
                    <ol class="ol-circle">
                        <li>
                            <p class="mbxl">Find "ASIN" in url</p>
                        </li>
                            <div class="panel panel-default">
                                <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                         <img style="object-fit:contain;width:100%;" src="https://reviewers.club/vip_beta/public/help_images/find-asin-1.png" class="mtl width-100">
                                    </div>
                                </div>
                            </div>
                            <li>
                                <p class="mbxl">Find "ASIN" in product description</p>
                            </li>
                              <div class="panel panel-default">
                                <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                         <img style="object-fit:contain;width:100%;" src="https://reviewers.club/vip_beta/public/help_images/find-asin-2.png" class="mtl width-100">
                                    </div>
                                </div>
                            </div>
                     </ol>  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
    </div>
</div>
<script>
	    $(document).ready(function(){
	        var href = window.location.hash;
	        var new_href = href.replace('#',"");
	        console.log(new_href)
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
        $('.btn-ASIN').click(function(){
            $('#myModalfind-asin').modal('show');
        })
        $('.btn-check_asin').click(function(){
            var asin = $('input[name="ASIN"]').val();
            var offer_id = "{{@$offer_id}}";
            if(asin == ''){
                swal({
                    type:'warning',
                    title:'Warning',
                    text:'Please input the product ASIN'
                })
            }else{
                $.ajax({
                    url:"{{asset('campaign/addtocart/addtocart_check_asin')}}",
                    type:"POST",
                    headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                    data:{asin:asin,offer_id:offer_id},
                    beforeSend:function(){
                      $('body').waitMe({
                            effect: 'timer',
            				text: 'Validating ASIN ........ ',
            				bg: 'rgba(255,255,255,0.90)',
            				color: '#555'
                      })  
                    },
                    success:function(data){
                        $('body').waitMe('hide');
                        if(data.success == true){
                            swal({
                                type:'success',
                                title:"Congratulations",
                                text:"Your ASIN is Valid"
                            }).then(function(){
                                location.reload();
                            })
                        }else{
                            swal({
                                type:'error',
                                title:'Invalid',
                                text:"Your ASIN is incorrect please try again!"
                            })
                        }
                    }
                })
            }
        })
        $('.cancel_gig').click(function(){
            var offer_id = "{{@$offer_id}}";
            swal({
                 type:'question',
                title:'Are you sure?',
                text:'Do you want to cancel this gig?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function(isConfirm){
                $.ajax({
                    url:"{{asset('campaign/gig/cancel')}}",
                    type:"POST",
                    headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                    data:{offer_id:offer_id},
                    beforeSend:function(){
                      $('body').waitMe({
                            effect: 'timer',
            				text: 'Updating........ ',
            				bg: 'rgba(255,255,255,0.90)',
            				color: '#555'
                      })  
                    },
                    success:function(data){
                        $('body').waitMe('hide');
                        if(data.success == true){
                            swal({
                                type:'success',
                                title:"Congratulations",
                                text:"Gig has been denied"
                            }).then(function(){
                                // location.reload();
                                window.location.href="{{asset('user/gig')}}";
                            })
                        }else{
                            swal({
                                type:'error',
                                title:'Invalid',
                                text:"Error"
                            })
                        }
                    }
                })
            })
        })
        $('.btn-upload_ss').click(function(){
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            var offer_id = "{{@$offer_id}}";
            fd.append('offer_id',offer_id)
            if($('input[name="screenshot"]').val() == ''){
                swal({
                    type:'warning',
                    title:'Warning',
                    text:'Screenshot is Required'
                })
            }else{
                $.ajax({
                    url:"{{asset('campaign/addtocart/gig/upload_screenshot')}}",
                    type:"POST",
                    data:fd,
                    contentType: false,
                    processData: false,
                    headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                    beforeSend:function(){
                      $('body').waitMe({
                            effect: 'timer',
            				text: 'Uploading Photo........ ',
            				bg: 'rgba(255,255,255,0.90)',
            				color: '#555'
                      })  
                    },
                    success:function(data){
                        $('body').waitMe('hide');
                        if(data.success == true){
                            swal({
                                type:'success',
                                title:'Successfully !',
                                text:'Congratulations you have received '+data.points+' points'
                            }).then(function(){
                                window.location.href="{{asset('dashboard')}}";
                            })
                        }
                    },
                    error:function(){
                        swal({
                            type:'error',
                            title:'Error !'
                        })
                    }
                })
            }
        })
    })
</script>
<script>
    var offer_id = "{{@$steps_done[0]->offer_id}}";
    var countDownDate = new Date("{{@$steps_done[0]->date_claimed}}");
	var timer =  countDownDate.setHours(countDownDate.getHours() + 1);
	timerko(timer,offer_id);
    function timerko(timer,offer_id)
    {
    	var countDownDate = new Date(timer).getTime();
    	var x = setInterval(function() {
    		console.log('run_time');
          var now = new Date().getTime();
          var distance = countDownDate - now;
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor(((distance % (1000 * 60 * 60)) / (1000 * 60)));
          var seconds = Math.floor(((distance % (1000 * 60)) / 1000));
           $(".minutes").empty().html(minutes);
          $(".seconds").empty().html(seconds);
            
          // If the count down is over, write some text 
          if (distance < 0) {
            clearInterval(x);
            $(".minutes").empty().html('00');
            $(".seconds").empty().html('00');
            $(".remaining").addClass('out_of_time');
            $(".remaining h4").html('Campaign Is Expired');
            $('.step_box').each(function(){
                $(this).addClass('hide');
            })
         	expired_campaign(offer_id);
            //document.getElementById("demo").innerHTML = "EXPIRED";
          }
        }, 1000);
    }
    function expired_campaign(offer_id){
        $.ajax({
            url:"{{asset('campaign/gig/update_to_expired')}}",
            type:"POST",
            headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
            data:{offer_id:offer_id},
            success:function(data){
            }
        })
    }
</script>
@endsection