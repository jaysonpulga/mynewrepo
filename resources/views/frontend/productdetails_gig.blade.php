@extends('frontend.layouts.main')

@section('content')

<!--// div secondpanel -->
	@include('frontend.layouts.secondpanel')  
<!--  ~end secondpanel -->
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
#container {
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
.step-wizard li > a {
  display: inline;
  width: 100%;
  color: black;
  position: relative;
  text-align: center;
}
.step-wizard li > a:hover .step {
  border-color: #0aa89e;
}
.step-wizard li > a:hover .titlex {
  color: black;
}
@media only screen and (max-width: 1200px) {
  .step-wizard li {
    width: 24%;
  }
}
@media only screen and (max-width: 375px) {
  .step-wizard li {
    width: 22%;
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


.product_name_1
{
	/*font-family: "Amazon Ember",Arial,sans-serif !important;*/
	font-weight: 400!important;
	font-size: 30px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important;
}

.product_price_1
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 18px!important;
	line-height: 1.255!important;
	display: inline;
	
}


.product_details_2
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 400!important;
	font-size: 14px!important;
	line-height: 1.255!important;
	display: inline;
	color: #555!important
}

.photo_fix
{
	max-height: 450px;
	min-height: 450px;
	height : 450px;
	overflow: hidden;
	background-color:none;
	margin-bottom:5px;
}

.STRIKETHROUGH 
{
    text-decoration: line-through;
	color: #a0a0a0; 
}

.btn {
    border-radius: 16px !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}

</style>
<style>
#product-view {
    border: #CCC 1px solid;
    overflow: auto;
    display: inline-block;
    padding-top: 20px;
    margin-top: 30px;
    text-align:left;
}

#thumbnail-container 
{
   float: none;
   margin-top:5px;
}


.thumbnails li 
{
      display: inline;
      margin: 0 10px 0 0;
}
	
	
.thumbnail {
     display: inline !important;
     padding: 1px !important;
     margin-bottom: 20px 
     line-height: 1.42857143;
    border-radius: 1px !important;
   
}	
	
	

/* Responsive Styles */
@media screen and (min-width: 1224px) {
    div.image {
        width: 300px;
    }
}

@media screen and (min-width: 1044px) and (max-width: 1224px) {
    div.image {
        width: 250px;
    }
}

@media screen and (min-width: 845px) and (max-width: 1044px) {
    div.image {
        width: 200px;
    }
}
@media screen and (max-width: 560px) {
    #preview-enlarged {
        float: none;
    }

	.thumbnails li {
		display: inline;
		margin: 0 10px 0 0;
	}
}





</style>
<div class="row" >
<div class="col-sm-12">	
<div class="box" >
<div class="box-body">
	
		
	@if(!empty($images))	
		<div class="col-sm-5">	
			<div class="preview-image">
				<div id="preview-enlarged" style='height: 300px; width: 100%; background-color: #d8cfcf'>
						<img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$images}}"/> 
				</div>
			</div>
		</div>
	@else
			<div class="col-sm-5">	
        			<div class="preview-image">
        				<div id="preview-enlarged" style='height: 330px; width: 100%; background-color: #d8cfcf'>
        						<img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/default_product.jpg"/> 
        				</div>
        				<div id="thumbnail-container">
        					<div class="product-thum-wrapper"><img class="thumbnailxx focused" src="{{ cdn_asset('offer_images')}}/default_product.jpg"></div>	 
        				</div>
        			</div>
		</div>
	@endif
	
	
	
	<script>
		$("#thumbnail-container  img").click(function() {
			$("#thumbnail-container   img").css("border", "1px solid #ccc");
			var src = $(this).attr("src");
			$("#preview-enlarged img").attr("src", src);
			$(this).css("border", "#fbb20f 2px solid");
			
		});
	</script>
	
		
			
	<div class="col-sm-5">
					
				<div class="row product_details">
					<div class="col-md-12">
						<span class="product_name_1">{{$offerdetails[0]->product_name}}  </span><br>
						
						<!--
						<span class='product_details_2'><b>Active Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}} -  {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}}  </span><br>
						-->
					
						
						@if(!empty($offerdetails[0]->product_id))
							
								<?php 
									 $user_price = number_format($offerdetails[0]->product_price,2);
									 $user_discount = $offerdetails[0]->product_discount;
								?>
							
							
								
								@if(    $user_discount > 0 ) 
										
										@if($offerdetails[0]->product_discount_label == "Percentage")
											
											<?php
										
												$discount_percent = $user_discount / 100;
												$discount_price = 	$user_price * number_format($discount_percent,2);
												$final_price2 = $user_price - number_format($discount_price,2); 
										        $final_price =  number_format($final_price2, 2, '.', ' ');
											?>
								
										@elseif($offerdetails[0]->product_discount_label == "Dollar")
										
											<?php
										
											
												$discounted_price   = number_format($user_price) - number_format($user_discount,2);
												//$final_price        =  number_format($discounted_price,2); 
										        	$final_price =  number_format($discounted_price, 2, '.', ' ');
											?>
									
										@endif
							
							
								@else
									<?php 
									//$final_price = $user_price; 
									$final_price =  number_format($user_price, 2, '.', ' ');
									?>
									
								@endif
							
							
								<!--<span>Price : <span class='product_price_2'>${{$final_price}}</span></span><br>-->
								
								<span><span class='product_price_1'><b>${{$final_price}}</b>&nbsp;&nbsp;</span></span>
						
						    @if(    $user_discount > 0 ) 
							
							
									<?php  $original_price = number_format($user_price); ?>
									<span class='product_price_1'><span class="STRIKETHROUGH">${{$original_price}}</span></span>&nbsp;&nbsp; 
								
									
									@if($offerdetails[0]->product_discount_label == "Percentage")
									
										<span style="background-color:#bb0a0a;padding:4px;border-radius:16px;font-size:12px"><span style="color:#fff">{{$user_discount}}% Off</span></span>					
										
									@elseif($offerdetails[0]->product_discount_label == "Dollar")
									
										
										<span style="color:red"> Discount: ${{$user_discount}}</span>	
											
									@endif
									
					
							@endif
							
						
						@endif
						
						
						
						
						
						<!--
						<span class='product_details_2'><a href="{{$offerdetails[0]->prod_review_link}}" target="_blank" > {{$offerdetails[0]->prod_review_link}} </a></span><br>
						-->
						
						
					</div>
				</div>
				<br>
				
				<div class="row product_details">
				
					<div class="col-sm-12">
					    
					 
					
					
							 <b>Offer Summary</b> <span style='float:right'>
							     
							 <!--<a href="{{$offerdetails[0]->prod_review_link}}" target="_blank">Product Review Page <i class="fa fa-fw fa-long-arrow-right"></i> </a> -->
							 
							 <span class='product_details_2'><b>Offer Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('F,d Y')}} -  {{ \Carbon\Carbon::parse($last_date_offer)->format('F,d Y')}}  </span>
							     
							     
							     </span> 
							     
							     
							     
							     
							 <div style='border-bottom:1px solid #ccc1c1;margin-bottom:12px'></div>
							 <div class='product_details_2'>{!! html_entity_decode($offerdetails[0]->Summary) !!}</div>
							
							
							
					</div>
					
				</div>
		
				
					
				<div class="row product_details">
					<div class="col-sm-12">
						
				
						
						@if($offerdetails[0]->title != "")
							
						<span class='product_details_2'><b>Campaign</b>: <span> {{$offerdetails[0]->title}}</span</span><br>
											
						@endif
						
						
						@if($offerdetails[0]->product_brand != "")
							
						<span class='product_details_2'><b>Brand</b>: <span> {{$offerdetails[0]->product_brand}} </span</span><br>
											
						@endif
						
						
					
					</div>
					
				</div>
			
				
			</div>
			
			<div class="col-sm-2">
					<button type="button" data-offer_id="{{$offerdetails[0]->id}}" class="btn btn-block btn-addtocart btn-success">Start this job</button>
					<a href="{{asset('dashboard')}}"  class="btn btn-block btn-default">Back</a>
			</div>
			
	


			<div class="col-sm-12">
				<div class="row">
				
						<div class="col-sm-12">
							 <h3>Product Details</h3>
							 
							 <div style='border-bottom:solid 1px #ccc6c6;margin-top:-8px;margin-bottom:12px'></div>
							 
							 
								<div class='product_details_2'>  {!! $offerdetails[0]->product_description !!}   </div>
						</div>
				
				</div>
			</div>
		
		
		
		
			
			
			
			
</div>
</div>
</div>
</div>


<!-- modal -->
<div id="offer_schedule" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span id='ordertitle'></span></h4>
			  </div>
		  
		 
			  <div class="modal-body">

				<div class='row' style="max-height:450px;overflow-y: scroll;">
					 
						<table id='campaign_schedule'  class="table table-bordered" width="100%" >
				
						<thead align="center">
						<tr>
							<th></th>
							<th width='30%'>Schedule Date</th>
							<th width='20%'>Slot</th>
							<th>Availble Time</th>
						</tr>
						</thead>
						
						<tbody ></tbody>
						</table>

					  
				</div>
			
			  </div>
			  
			  
			<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>

<!-- modal -->
<div id="fullcalendar_sched" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content  -->
        <div class="modal-content">
		
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title"><span id='ordertitle'>Choose  when you will buy the product from an available date below, You must buy the product on the day chosen to be eligible for points and rebates. <br> * <i>(blue square)</i> - Available dates</span></h5>
			  </div>
		  
		 
			  <div class="modal-body">
			
					<center>
						  <!-- THE CALENDAR -->
						  <div id="start_date"></div>
						   
					</center>
					
					<input id='date_holder' type='hidden' />	
					<input id='offer_id_x' type='hidden' />	
					
					<input id='idx' type='hidden' />	
					<input id='get' type='hidden' />	
					
				
					
			  </div>
			  
			  
			<div class="modal-footer">
				<span id='youselect' style='float:left'></span>
			
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id='getdata' type="button"  class="btn btn-primary" >Save</button>
			</div>
			  
        </div>
    </div>
</div>
<style>
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 1px solid #d3d3d3;
    background: transparent !important;
    font-weight: normal;
    color: #555555;
}
.highlight{
  background-color: #3c8dbc !important;
  color: #ffffff !important;
  
}

.highlight > a{
  color: #ffffff !important;
  
}

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    border: 1px solid #aaaaaa !important;
    background: #ffffff !important;
    font-weight: normal !important;
    color: #212121 !important;
}
</style>
 <script>
     $(document).ready(function(){
         $('.btn-addtocart').click(function(){
             var offer_id = $(this).attr('data-offer_id');
             $.ajax({
                 url:"{{route('addtocart_getconfirm')}}",
                 type:"POST",
                 headers:{"X-CSRF-TOKEN":$('meta[name="_token"]').attr("content")},
                 data:{offer_id:offer_id},
                 beforeSend:function(){
                     $('body').waitMe({
                         effect:'timer',
                         text:'Please wait...'
                     })
                 },
                 success:function(data){
                     $('body').waitMe('hide');
                     console.log(data)
                     if(data.success == true){
                         swal({
                             type:'success',
                             title:'Congrats !',
                             text:'You got this offer !'
                         }).then(function(){
                             window.location.href = "{{asset('campaign/getdata/gig/offerdetails/')}}/"+offer_id+"#step-2";
                         })
                     }else{
                         swal({
                             type:'error',
                             title:'Failed !',
                             text:'You already got this product'
                         })
                     }
                 }
             })
         })
     })
 </script>
 

@endsection
