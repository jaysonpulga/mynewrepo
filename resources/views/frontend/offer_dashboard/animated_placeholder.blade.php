<style>
@keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animation {
     animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    position: relative;
    overflow: hidden;
}

.image-background {

    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 500px 104px;
    height: 100%;
    position: relative;
}

.animated-text {

  background: #f6f7f8;
  background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
   background-size: 500px 104px;
  margin: 0 5px 5px;
  height: 10px;

}

.animated-text2 {

  background: #f6f7f8;
  background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
   background-size: 500px 104px;
  margin: 0 4px 4px;
  height: 20px;

}

.btn-default_xx {
    background-color: #f6f7f8 !important;
	background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%) !important;
	background-size: 500px 104px
    color:#f6f7f8 !important;
    border: 2px solid #f6f7f8 !important;
    border-radius: 100px !important;
	 height: 30px;
}

</style>

<script id="featured-template" type="text/template">

<div id="1">
	<div class="col-md-3 ">
		<div class="fancybox thumbnail featured-box">


				<center>
					<div class='photo_fix'>
						<div class="image-background animation"></div>
					</div>
				</center>
				
				<div  style='margin-bottom: 10px;'>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
				</div>
				
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				
				<a href="javascript:void(0)" style="width:100%;margin-top:7px;margin-bottom:3px;"  class="btn  btn-flat btn-default_xx animation" data-id="${value.id}" > </a>
				
		</div>	
	</div>			
</div>

<div id="2">
	<div class="col-md-3 ">
		<div class="fancybox thumbnail featured-box">


				<center>
					<div class='photo_fix'>
						<div class="image-background animation"></div>
					</div>
				</center>
				
				<div  style='margin-bottom: 10px;'>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
				</div>
				
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				
				<a href="javascript:void(0)" style="width:100%;margin-top:7px;margin-bottom:3px;"  class="btn  btn-flat btn-default_xx animation" data-id="${value.id}" > </a>
				
		</div>	
	</div>			
</div>

<div id="3">
	<div class="col-md-3 ">
		<div class="fancybox thumbnail featured-box">


				<center>
					<div class='photo_fix'>
						<div class="image-background animation"></div>
					</div>
				</center>
				
				<div  style='margin-bottom: 10px;'>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
				</div>
				
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				
				<a href="javascript:void(0)" style="width:100%;margin-top:7px;margin-bottom:3px;"  class="btn  btn-flat btn-default_xx animation" data-id="${value.id}" > </a>
				
		</div>	
	</div>			
</div>

<div id="4">
	<div class="col-md-3 ">
		<div class="fancybox thumbnail featured-box">


				<center>
					<div class='photo_fix'>
						<div class="image-background animation"></div>
					</div>
				</center>
				
				<div  style='margin-bottom: 10px;'>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
						<div class='animated-text animation'></div>
				</div>
				
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				<hr style="margin-top: 3px;margin-bottom: 3px;">
				<div><div class='animated-text2 animation'></div></div>
				
				<a href="javascript:void(0)" style="width:100%;margin-top:7px;margin-bottom:3px;"  class="btn  btn-flat btn-default_xx animation" data-id="${value.id}" > </a>
				
		</div>	
	</div>			
</div>

</script>
