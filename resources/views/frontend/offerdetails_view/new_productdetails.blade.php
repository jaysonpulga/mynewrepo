<style>
.campaign_name1
{
	/*font-family: "Amazon Ember",Arial,sans-serif !important;*/
	font-weight: 400!important;
	display: inline;
	
}

.campaign_name_current
{
	font-family: "Amazon Ember",Arial,sans-serif !important;
	font-weight: 501!important;
	font-size: 17px!important;
    line-height: 1.3!important;
	display: inline;
	color: #555!important;
	
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

</style>
<style>
.padding
{
	padding-top:50px;
	padding-right:15px;
	padding-left:15px;
	padding-bottom:40px;

}
.img_desc {
    width: 400px !important; 	
}
.img2 {
    width: 400px !important; 	
}
.tile-bar
{
	font-weight:bold;
	font-size:24px;
}
.title
{
	font-weight:bold;
	font-size:23px;
}


.product_details
{
	font-size:15px;
	color: #4a4141;
	/*letter-spacing: 0.1em;*/
	line-height: 25px;
}


.summary_prod
{
	font-size:15px;
	color: #4a4141;
	line-height: 25px;
}

.product_name
{
	font-size:20px;
	font-weight:bold;
}
.description_p{
    color: #1d1b1b;
    font-size: 15px !important;
	margin-left:22px;
	margin-top:5px;
}
.STRIKETHROUGH 
{
    text-decoration: line-through;
	color: #a0a0a0; 
}
</style>
<style>
#gridview {
    text-align: center;
}

div.image {
    margin: 10px;
    display: inline-block;
    position: relative;
}

div.image img {
    width: 100%;
    max-width: 400px;
    height: auto;
    border: 1px solid #ccc;
}

div.preview-image 
{
    /*float: left;*/
    padding: 0px 0px 20px 2px;
}



div.preview-image img.focused {
    border: #fbb20f 2px solid;
}

div.image img:hover {
    box-shadow: 0 5px 5px 0 rgba(0, 0, 0, 0.32), 0 0 0 0px
        rgba(0, 0, 0, 0.16);
        
}

.heading {
    padding: 10px 10px;
    margin-bottom: 10px;
    font-size: 1.2em;
}

#grid {
    margin-bottom: 30px;
}

.quick_look {
    display: none;
    position: absolute;
    bottom: 20px;
    left: 50%;
    margin-left: -51px;
    background: transparent;
    border: #FFF 2px solid;
    padding: 8px 25px;
    color: #FFF;
    font-size: 14px;
    cursor: pointer;
}

.quick_look:hover {
    background: #FFF;
    color: #333;
}

.product-info {
    float: left;
    margin-left: 20px;
}

div.product-info ul {
    margin: 10px 0px;
    padding: 0;
}

div.product-info li {
    cursor: pointer;
    list-style-type: none;
    display: inline-block;
    color: #F0F0F0;
    text-shadow: 0 0 1px #666666;
    font-size: 14px;
}

div.product-info .selected {
    color: #e4a400;
    text-shadow: 0 0 5px #ffb900;
}

.product-title {
    font-size: 1.5em;
}

.product-category {
    margin: 20px 0px;
    font-size: 0.9em;
    color: #c4c4c5;
    text-transform: uppercase;
    border-left: #c4c4c5 3px solid;
    padding: 0px 5px 0px 5px;
    text-transform: uppercase;
}

button.btn-info {
    padding: 10px;
    margin: 20px 20px 10px 0px;
    padding: 10px 20px;
    background: #67bdf7;
    border: #60b2e8 1px solid;
    border-radius: 3px;
    color: #FFF;
}

.ui-widget-header {
    border: none !important;
    background: none !important;
}

#product-view {
    border: #CCC 1px solid;
    overflow: auto;
    display: inline-block;
    padding-top: 20px;
    margin-top: 30px;
    text-align:left;
}


#thumbnail-container1
{
	/*float: left;*/ 
	width: 70px;
   /*float: none;*/
	display:inline;
}


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


/* preview enlarged */
#preview-enlarged
{

	/*
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    max-width: 100%;
    max-height: 100%;
	*/
	
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

.box-body {

    padding-right: 1px !important;
	padding-left: 1px !important;
	padding-top:20px  !important;
}

.btn {
    border-radius: 16px !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid transparent;
}



</style>
<div class="row" >
<div class="box" >
<div class="box-body">
<div class="col-lg-12">
    
 

	
	@if(!@$images->isEmpty())	
		
		<div class="col-sm-5">	
			<div class="preview-image">
		
				
				<div id="preview-enlarged" style='height: 330px; width: 100%; background-color: #d8cfcf'>
						<img style='height: 100%; width: 100%; object-fit: contain' src="{{ cdn_asset('offer_images')}}/{{$images[0]->image_path}}"/> 
				</div>
				
				
				<div id="thumbnail-container"  >
					@foreach($images as $key => $imagedata)
						<?php $classdata = (($key == 0) ? 'focused' : ''); ?>
						<div class="product-thum-wrapper"><img class="thumbnailxx {{$classdata}}" src="{{ cdn_asset('offer_images')}}/{{$imagedata['image_path']}}"></div>	 
					@endforeach
				</div>
			

				
			</div>
		</div>
		
	@else
			<!--
			 <div class="col-md-5">
				<img class="img2 img-bordered-sm img-responsive" src="{{ asset('public/offer_images')}}/default_product.jpg" alt="user image">
			 </div>
			 -->
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
						<span class="product_name_1">{{$offerdetails[0]->product_name}} </span><br>
						
						<!--
						<span class='product_details_2'><b>Active Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}} -  {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('M,d Y')}}  </span><br>
						-->
					
						
						@if(!empty($offerdetails[0]->user_product_id))
						
						
							
								<?php 
									 $user_price = number_format($offerdetails[0]->user_product_price,2);
									 $user_discount = $offerdetails[0]->user_product_discount;
								?>
							
							
								
								@if($user_discount > 0 ) 
								
										
										@if($offerdetails[0]->user_product_discount_label == "Percentage")
											
											<?php
										
												$discount_percent = $user_discount / 100;
												$discount_price = 	$user_price * number_format($discount_percent,2);
												$final_price2 = $user_price - number_format($discount_price,2); 
												$final_price =  number_format($final_price2, 2, '.', ' ');
										
											?>
								
										@elseif($offerdetails[0]->user_product_discount_label == "Dollar")
										
											<?php
										
											
												$discounted_price   = number_format($user_price) - number_format($user_discount,2);
												$final_price2        =  number_format($discounted_price,2); 
												$final_price =  number_format($final_price2, 2, '.', ' ');
										
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
						
								@if($user_discount > 0 ) 
							
							
									<?php  $original_price = number_format($user_price); ?>
									<span class='product_price_1'><span class="STRIKETHROUGH">${{$original_price}}</span></span>&nbsp;&nbsp; 
								
									
									@if($offerdetails[0]->user_product_discount_label == "Percentage")
									
										<span style="background-color:#bb0a0a;padding:4px;border-radius:16px;font-size:12px"><span style="color:#fff">{{$user_discount}}% Off</span></span>					
										
									@elseif($offerdetails[0]->user_product_discount_label == "Dollar")
									
										
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
							     
							    <!--
							    <a href="{{$offerdetails[0]->prod_review_link}}" target="_blank">Product Review Page <i class="fa fa-fw fa-long-arrow-right"></i> </a>
							    -->
							    
				                <?php
				                   // print_r($offer_last_date);
				                    //echo $offerdetails[0]->start_date;
				                    
				                  
				                ?>
							    
							    <span class='product_details_2'><b>Offer Date:</b> {{ \Carbon\Carbon::parse($offerdetails[0]->start_date)->format('F,d Y')}} -  {{ \Carbon\Carbon::parse($offer_last_date)->format('F,d Y')}}  </span>
							  
							 </span> 
							 <div style='border-bottom:1px solid #ccc1c1;margin-bottom:12px'></div>
							 <div class='product_details_2'>{!! html_entity_decode($offerdetails[0]->Summary) !!}</div>
					
							
							
					</div>
					
				</div>
		
				
					
				<div class="row product_details">
					<div class="col-sm-12">
						
						<!--
						@if($offerdetails[0]->prod_review_link != "")
							
						<span class='product_details_2' ><b>Product Review Page</b><br><a href="{{$offerdetails[0]->prod_review_link}}" target="_blank">{{$offerdetails[0]->prod_review_link}}</a></span><br>
											
						@endif
						
						-->
						
						
						@if($offerdetails[0]->Title != "")
							
						<span class='product_details_2'><b>Campaign</b>: <span> {{$offerdetails[0]->Title}}</span</span><br>
											
						@endif
						
						
						@if($offerdetails[0]->product_brand != "")
							
						<span class='product_details_2'><b>Brand</b>: <span> {{$offerdetails[0]->product_brand}}</span</span><br>
											
						@endif
						
						
						@if($offerdetails[0]->shipping_carrier != "")
    						<!--	
    						<span class='product_details_2'><b>Shipping Carrier</b> : <span> {{$offerdetails[0]->shipping_carrier}}</span></span><br>
    						-->					
						@endif
					
					
						
					
					
					</div>
					
				</div>
				<br>
				
	</div>
	
	<div class="col-sm-2">
    	    @if(@$offerdetails[0]->campaign_type == 'compare campaign' || @$offerdetails[0]->campaign_type == 'addtocart campaign')
    	    <a href="{{asset('redirecting')}}/{{$offer_id}}"  class="btn btn-block btn-success">Continue This Job</a>
    	    @endif
			<a href="{{asset('dashboard')}}"  class="btn btn-block btn-default">Back</a>
	</div>
    <div class="col-sm-12">
        
				<div class="row">
				
						<div class="col-lg-12">
							 <h3>Product Details</h3>
							 
							 <div style='border-bottom:solid 1px #ccc6c6;margin-top:-8px;margin-bottom:12px'></div>
								<div class='product_details_2'>  {!!html_entity_decode( $offerdetails[0]->product_description) !!}   </div>
						</div>
				
				</div>
				
	</div>
</div>
</div>
</div>
</div>


<div class="row" >
    <div class="box" >
        <div class="box-body">
        	<div class="col-lg-sm">
        	
        		
        				<div class="col-lg-12">
        					 <h3>Detail & Instruction</h3>
        					  <div style='border-bottom:solid 1px #ccc6c6;margin-top:-8px;margin-bottom:12px'></div>
        						<div class='product_details_2'>  {!!html_entity_decode( $offerdetails[0]->detail_instruction) !!} </div>
        				</div>
        	
        	</div>
        </div>
    </div>
</div>
