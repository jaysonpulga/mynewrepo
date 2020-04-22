@extends('frontend.layouts.main')
@section('content')
<style>
.text_c {
  display: inline-block;
  vertical-align: middle;
  line-height: normal;
  margin-top:10px;
}

.button_c
{
	margin-top:10px;
	margin-right:10px;
}

.chat-box-main {
  max-height: 100px;
   max-height: 100px;
 

}

	
.fixphoto
{
	max-height: 100px;

   overflow: hidden;

}

.fix_text
{
	max-height: 10px;
   overflow: hidden;
}

.photo_fix
{
	height: 247px;
    width: 100%;
	overflow: hidden;
	background-color:none;
	margin-bottom:14px;
}


@media (max-width: 1000px) {
	 .photo_fix
	{
		height: auto;
		width: 45%;
		overflow: hidden;
		background-color:none;
		margin-bottom:14px;
	}

}



.text_fix
{

	min-height: 75px;
	max-height: 75px;
	height : 75px;
	overflow: hidden;
	background-color:none;
	margin-bottom:8px;
}


span.text_fix_mod {
	font-size: 11px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1% !important;
}



.title_fix
{

	min-height: 55px;
	max-height: 55px;
	background-color:none;
	overflow : hidden;
	margin-bottom:8px;
}
span.title_fix_mod {
	 font-weight: bold;
	font-family: "Amazon Ember",Arial,sans-serif !important; 
	font-size: 18px !important;
	padding-left: 3px !important;
	padding-right: 3px !important;
   line-height: 1.5% !important;

}
.featured-box .title_fix, .featured-box .featured-box-price{
    padding-left:10px;
    padding-right:10px;
}
.featured-box .photo_fix .img-responsive{
    height: 100%;
    width: 100%;
}


</style>
<style>
    .thumbnail{
        padding:8px !important;
    }
    .circular-chart {
  display: block;
  max-height: 100px;
}
}
</style>
<section class="content">
<!-- Main content -->
    <section class="row">
        
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <div class="col-md-9 col-xs-12">
            <div id="content-widget-component">
                <div>
                            <h2 class="font-20 text-uppercase text-stable-dark">Gigs!</h2> 
                            <p>The aim of gigs is to provide your personal insights to the brands. You can earn points by doing small actions for the brands. You give your input so that brands can improve their product and marketing. No new Gigs available? Come back soon.</p>
                            <p>We don’t send invites for gigs, so check back regularly to get involved. The gigs you see are based on your activity and interests.</p>
                </div>
                
            </div>
            </div>
            <div class="col-md-3 col-xs-12" style="border-radius:5px;margin-bottom:15px;background-color:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <h2 class="font-20 text-uppercase text-stable-dark">
                    Daily Threshold 
                </h2>
                <div class="row threshold">
                   <h4 class="text-center"> <span>  {{@$vote_threshold}} / 3  </span>  </h4>
                  <h4 class="text-center"> Gigs </h4>
                </div>
         </div>
       </div>
       <div class="row">
            <div class="offerData2" style="display:block;">
                @if(@$avail_counts <= 0 )
                <div style="color:rgb(99, 107, 111);">
                    <div class="alert alert-warning alert-dismissible text-center">
                        Whoops, it seems you’re just too late. Someone else took your spot… 
                        Check back a couple of times a day, newslots can become available anytime soon.
                    </div>
                    Sorry... No Gig Available At This Moment.
                </div>
                @endif
                @if(@$avail_counts > 0 )
                @foreach(@$vote_products as $val)
                    <div id="{{@$val['id']}}">
            		    <div class="col-md-3">
                			<div class="fancybox thumbnail featured-box">
                			<center><div class="photo_fix">
                			    @if(@$val['vote_image'] == "")
                			    <img class="img-responsive" alt="" src="{{asset('public/default_product.png')}}" object-fit:="" contain="">
                			    @else
                			    <img class="img-responsive" style="width:100%;height:100%;" alt="" src="https://researchsale.com/seller_beta/public/offer_images/{{@$val['vote_image']}}" object-fit:="" contain="">
                			    @endif
                			    </div></center>
                			<div class="title_fix" style="margin-bottom: 15px;"><center><span class="title_fix_mod" style="font-size:18px;font-weight:600;"> Gig and Earn {{@$val['points']}} Points</span></center></div>
                			
                			
                			<hr style="margin-top: 3px;margin-bottom: 3px;">
                			<div class="featured-box-price"><span>Claims Expires On:</span> <span class="product_price"><br><strong>  {{@$val['exp_date']}}</strong></span></div>
                			
                			<hr style="margin-top: 3px;margin-bottom: 3px;">
                			
                			<div class="featured-box-price"> <span>Available Today</span> <span class="pull-right badge bg-grey" style="background-color:orange; font-weight: 200;">{{@$val['available_today']}}</span> </div>
                			<hr style="margin-top: 3px;margin-bottom: 3px;">
                			<div class="featured-box-price" style="margin-bottom:5px;"> <span>Product Price</span> <span class="product_price pull-right"><strong>  ${{number_format(@$val['product_price'],2)}}</strong></span> </div>
                			<!--<div class="featured-box-price"> <span>Total Votes</span> <span class="pull-right badge bg-grey" style="background-color:orange; font-weight: 200;">{{@$val['total_votes']}}</span> </div>-->
                			<!--<hr style="margin-top: 3px;margin-bottom: 3px;">-->
                			<div class="featured-box-price"><span><a href="javascript:void(0)" data-toggle="modal" data-target="#howvote_works">How does this work?</a></span></div>
                			@if(@$vote_threshold < 3)
                			    @if(empty($val['continue']))
                			        <a href="{{asset('campaign/getdata/gig/productdetails')}}/{{@$val['id']}}" style="width:100%" class="btn btn-default btn-flat">Buy & Earn Points</a>
                			    @else
                			        @if($val['continue']['status'] != 'active')
                			        <a href="javascript:void(0)" style="width:100%" class="btn btn-danger btn-flat">{{$val['continue']['status']}}</a>
                			        @else
                			        <div style="text-align:center;">Time Remaining: <span class="claim_mins">00</span>:<span class="claim_secs">00</span> minutes</div>
                			        <a href="{{asset('campaign/getdata/gig/offerdetails')}}/{{@$val['id']}}#step-2" style="width:100%" class="btn btn-success btn-flat">Continue</a>
                			        <script>
                			            $(document).ready(function(){
                			                var offer_id = "{{@$val['id']}}";
                                            var countDownDate = new Date("{{@$val['continue']['date_claimed']}}");
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
                                                   $("div#"+offer_id+" span.claim_mins").empty().html(minutes);
                                                  $("div#"+offer_id+" span.claim_secs").empty().html(seconds);
                                                    
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
                                                        $("div#"+offer_id+" span.claim_mins").empty().html('00');
                                                        $("div#"+offer_id+" span.claim_secs").empty().html('00');
                                                        $("div#"+offer_id+" a.btn").text('Expired');
                                                        $("div#"+offer_id+" a.btn").removeClass('btn-success');
                                                        $("div#"+offer_id+" a.btn").attr('href','javascript:void(0)');
                                                        $("div#"+offer_id+" a.btn").addClass('btn-danger');
                                                    }
                                                })
                                            }
                			            })
                			        </script>
                			        @endif
                			    @endif
                			@else
                			<a href="javascript:void(0)" style="width:100%" class="btn btn-default btn-flat btn-not_vote">Buy & Earn Points </a>	
                			@endif
                			</div>
                			@if(!empty($val['continue']))
                			    @if($val['continue']['status'] != 'active')
                    			    <p class="text-muted text-center">
                                        <a class="reject" data-id="{{@$val['id']}}">
                                            <b style="cursor: pointer;">Reject this Offer</b>
                                        </a>
                                    </p>
                			    @endif
                			@endif
        		        </div>
                    </div>
                    
                @endforeach
                @endif
            </div>
        </div>
    </section>
    <div id="howvote_works" class="modal fade in" role="dialog">


    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Votes </h4>
            </div>
            <div class="modal-body">
                
 <div class="panel">
     <!--               
    <div class="panel-heading bg-purple">
        <h4 class="text-center" style="color:white;">
            Market <br> Research Job
        </h4>
    </div>
    -->
    <p>Research and provide information about the product. After completion, you get to keep the product and 100% cashback – possibly even a bonus from the brand!</p>
    
    <!--<div class="panel-body">-->
    <div>
        
        
        <table class="table">

            <tbody>
                
            <!--    
            <tr>
                <td>
                    <small></small>
                </td>
            </tr>
            -->
            
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="loading" aria-expanded="true">
                                1. Click And Vote
                                <br>
                            <small>Sold out for today? - come back tomorrow</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">

                            You can simply claim a vote that you are invited for, by clicking the button 'Claim Job'
                            <br><br>
                            This will guide you through the steps.
                             </div>
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseBronze" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseBronze" class="loading" aria-expanded="true">
                                2. Give your honest opinion <br>
                                <small>It will take you 15-20 minutes</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseBronze" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            This will MAKE you money. Important to understand, you will get rewarded for the actions you take 2 ways:
                            <br><br>
                            <ul>
                                <li>you will get a product for free (100% cashback 24 hours after purchase)</li>
                                <li>you will get rewarded with a Bonus, immediately after completion of the job (3-6 bucks per job usually)</li>
                            </ul>
                                In order to complete the research Job, you start with completing the steps in the process.
                            <br><br>
                            What you do can vary. For example: searching the web with specific searchterms the brand provides, selecting your top results when you do that search and tell us why you picked those results as being the best. Also, providing information on how you think the product of the sponsoring brand fits into that search. This will help the brand by optimising their product, or their marketing pitch.
                            <br><br>
                            Those jobs usually take you 15-20 minutes to complete. When the product value is 20, in essence you make 23-26 bucks for the job.
                            <br><br>
                            Of course, we expect you to provide the best value possible.
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseBronzePoints" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseBronzePoints" class="loading" aria-expanded="true">
                                3. Buy the product <br>
                                <small>Order first, receive cashback in 24 hours</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseBronzePoints" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            At the end of the job, you will be granted with the instructions where to buy the specific product.
                            <br><br>
                            Simply follow the steps and buy the product with your own funds.
                            <br><br>
                            Cashback will be transferred in 24 hours after the the Order is paid.
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOrderID" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOrderID" class="loading" aria-expanded="true">
                                4. Fill in Order ID &amp; Paypal info <br>
                                <small>We need to validate your order</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOrderID" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            We need your Order ID in order to track if the order is placed indeed. This may take up to 24 hours.
                            <br><br>
                            We need your Paypal Email address in order to transfer the funds over to you.
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseBonus" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseBonus" class="loading" aria-expanded="true">
                                5. Get Bonus <br>
                                <small>Make money</small>

                            </a>
                        </h4>
                    </div>
                    <div id="collapseBonus" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            When you complete your job, we will transfer your Bonus right away to your Paypal account.
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseShipped" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseShipped" class="loading" aria-expanded="true">
                                6. Order will be shipped <br>
                                <small>This might take a few days</small>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseShipped" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            In some marketplaces, it can take up to 7 days until your order is shipped. In almost all situations, your creditcard is not charged upon the moment of shipment.
                            <br><br>
                            We consider only shipped orders as validated, and we pay the cashback only when the Order status is shipped.
                            <br><br>
                            Reason is that you might cancel your order in the meantime, which will leave us with a loss of funds.
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>
                    <div class="box-header no-border">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseCashback" class="loading" aria-expanded="true">
                            <i class="fa fa-fw fa-sort-down pull-right"></i>
                        </a>
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseCashback" class="loading" aria-expanded="true">
                                7. Get 100% cashback <br>
                                <small>In 24 hours after shipment</small>

                            </a>
                        </h4>
                    </div>
                    <div id="collapseCashback" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            We strive for immediate cashback transfer, but we notice that it can sometimes take up to 24 hours after the Order status is Shipped.
                            <br><br>
                            Reason is that our automated systems may need some time to get the correct data to define the exact amount of cashback.
                            <br><br>
                            Cashback includes the actual amount you paid for the product, including salestax. Shipping costs we do not include, because that might vary based on your location, and the value of potential other products you might have in your cart.
                            <br><br>
                            If you want free shipping, try to combine multiple items in one single order to get over the 'free shipping threshold'.
                        </div>
                    </div>

                </td>
            </tr>

        </tbody></table>
    </div>

</div>
            </div>

</div>
<!-- /.modal-content -->
</div> 
 </div>
    <!-- /.content -->

<!-- /.content-wrapper -->
</section>
<script>
    $(document).ready(function(){
        $('.btn-not_vote').click(function(){
            swal({
                type:'error',
                title:'',
                text:'You have reached your daily threshold try again tommorow !'
            })
        })
        $('.reject').click(function(){
            var offer_id = $(this).attr('data-id');
            swal({
                type:'question',
                title:'Are you sure?',
                text:'Do you want to Remove this Campaign?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then(function(isConfirm){
                $.ajax({
                url:"{{asset('campaign/gig/update_to_reject')}}",
                type:"POST",
                headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr('content')},
                data:{offer_id:offer_id},
                success:function(data){
                    if(data){
                        swal({
                            type:"success",
                            title:"Successfully",
                            text:"You have been Remove the Campaign"
                        }).then(function(){
                            location.reload();
                        })
                    }
                }
            })
                
            })
        })
        
    })
</script>
@endsection
