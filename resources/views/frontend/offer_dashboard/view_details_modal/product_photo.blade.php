<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="{{ asset('public/adminlte/bootstrap/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/adminlte/dist/css/AdminLTE.min.css')}}">

<!-- load jQuery and jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<!-- load jQuery UI CSS theme -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">



<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />


<style>
@media (min-width: 1200px)
.col-xl-3 {
    flex: 0 0 25%;
    max-width: 25%;
}

.campaign.campaign-item {
    margin-bottom: 1.25rem;
}
.campaign {
    position: relative;
    background-color: #fff;
    padding: 1.3rem;
    cursor: pointer;
    border: 1px solid #f3f3f3;
    border-radius: .3125rem;
    box-shadow: 0 1px 5px 0 rgba(0,0,0,.1);
}

.pr-0, .px-0 {
    padding-right: 0!important;
}
.pl-0, .px-0 {
    padding-left: 0!important;
}

.mb-2, .my-2 {
    margin-bottom: 5rem!important;
	margin-top: 5px !important;
}

.top-space
{
	margin-top: 17px!important;
}

.badge {

    border-radius: 1px !important;
	margin-left:2px !important;
}

.campaign .badge {
    font-size: 13px;
    padding: .6em;
    font-weight: 400;
}

.badge-warning {
    color: #fff;
    background-color: #fb3;
}
.campaign .campaign-actions {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-end;
	font-size: 22px;
}

.campaign .preview {
    display: block;
    position: relative;
    margin-bottom: 1.25rem;
}
.campaign .lozad {
    background-size: contain;
    background-position: 50%;
    background-repeat: no-repeat;
}

.mb-0, .my-0 {
    margin-bottom: 0!important;
}
.embed-responsive-4by3:before {
    padding-top: 75%;
}

.embed-responsive:before {
    display: block;
    content: "";
}
.campaign .title {
    font-size: 16px;
	font-weight: 800;
}


.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.campaign .title a {
    color: #333e48;
    font-family: Roboto-Medium,sans-serif;
    font-weight: 500;
}

</style>



<style>
.align-items-center {
    align-items: center!important;
}
.d-flex {
    display: flex!important;
}


.campaign .full-price {
    display: inline-block;
    margin-right: .3rem;
}
.strikethrough {
    text-decoration: line-through;
}
.text-danger {
    color: #f86c6b!important;
}

.campaign .price {
    font-weight: 700;
}

.text-green {
    color: #4dbd74!important;
}
</style>


<style>
.campaign .discount {
    color: #666;
}
.align-items-center {
    align-items: center!important;
}
.justify-content-end {
    justify-content: flex-end!important;
}


.campaign .percent {
    font-size: 12px;
    text-transform: uppercase;
    border-radius: .1875rem;
    border: 1px solid #20a8d8;
    padding: .3125rem .9375rem;
    white-space: nowrap;
}

.campaign .discount {
    color: #666;
}

.p-text
{
font-size:14px;
}


.row-flex
{

    display: flex;
    flex-wrap: wrap;
	margin-right:1px;
    margin-left:1px;
}
}

.d-flex {
    display: flex!important;
}

.col-7-flex {
    flex: 0 0 58.33333%;
    max-width: 58.33333%;
}
.col-5-flex {
    flex: 0 0 41.66667%;
    max-width: 41.66667%;
}
</style>





<style>

.product-gallery .slider-main-img {
    height: 37rem;
    width: 37rem;
    visibility: hidden;
}


.product-gallery .slider-main-img .slick-slide {
    height: 37rem;
    display: flex;
}


.product-gallery .slider-main-img .slick-slide > div {
    display: flex;
    margin: 0 auto;
}

.product-gallery .slider-main-img .slick-slide img {
    max-width: 100%;
    width: auto;
    height: auto;
    margin: auto;
}

.product-gallery .slider-nav {
    height: 37rem;
    max-width: 3.75rem;
    visibility: hidden;
}


/* slider-nav */

.product-gallery .slider-nav {
    height: 23.75rem;
    max-width: 5.75rem;
    visibility: hidden;
}


.product-gallery .slider-nav .slick-slide.slick-current {
    border: 2px solid #20a8d8;
}

.product-gallery .slider-nav .slick-slide {
    height: 5.5rem;
    width: 5.5rem !important;
    display: flex;
    margin-top: 0.625rem;
    border-radius: 3px;
    overflow: hidden;
    border: 2px solid transparent;
    align-items: center;
    justify-content: center;
}

.product-gallery .slider-nav .slick-slide img {
    max-width: 5.5rem;
    max-height: 5.5rem;
    width: auto;
    height: auto;
    margin: auto;
}




.row-campaign {
    display: flex;
    flex-wrap: wrap;
    margin-right: -8px;
    margin-left: -8px;
}


.product-gallery .slider-nav .slick-arrow {
    text-align: center;
    color: #a09393;
}

.product-gallery .slider-nav .slick-arrow {
    text-align: center;
    color: #a09393;
}
</style>


<style>
.campaign-slider {
    position: relative;
}
@media (min-width: 768px)
.ml-md-3, .mx-md-3 {
    margin-left: 1.875rem !important;
}


@media (min-width: 768px)
.flex-md-row {
    flex-direction: row-campaign !important;
}

.justify-content-center {
    justify-content: center !important;
}
</style>




<style>
@media (min-width: 1200px){

	#showInfopreview > .modal-lg {
		width: 1135px !important; 
	}
}

@media (min-width: 992px){
	.p-lg-5 {
		padding: 3.125rem!important;
	}
}



@media (min-width: 576px)
.flex-sm-row {
    flex-direction: row!important;
}

.justify-content-between {
    justify-content: space-between!important;
}

.mb-2-5, .my-2-5 {
    margin-bottom: 1.5625rem!important;
}

.align-items-start {
    align-items: flex-start!important;
}
.justify-content-between {
    justify-content: space-between!important;
}

.mr-1, .mx-1 {
    margin-right: .625rem!important;
}


.text-dark {
    color: #333e48!important;
}

.mb-1-5, .my-1-5 {
    margin-bottom: .9375rem!important;
}
.mb-0, .my-0 {
    margin-bottom: 0!important;
}

.mb-3, .my-3 {
    margin-bottom: 1.875rem!important;
}

.lato-medium {
    font-size: 15px;
}


.campaign-single .percent {
    font-size: 15px;
    text-transform: uppercase;
    border-radius: .1875rem;
    border: none;
    padding: .1875rem .3125rem;
    white-space: nowrap;
}


.modal-campaign .modal-footer, .modal-campaign .modal-header {
    border-width: 0;
}

.p-0 {
    padding: 0!important;
}

.mt-3, .my-3 {
    margin-top:50px !important;
}

.modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 1.5rem;
    border-top: 1px solid #c8ced3;
    border-bottom-right-radius: .3rem;
    border-bottom-left-radius: .3rem;
}


.pb-2-5, .py-2-5 {
    padding-bottom: 1.5625rem!important;
}

.pt-2-5, .py-2-5 {
    padding-top: 1.5625rem!important;
}
.w-100 {
    width: 100%!important;
}
.border-top {
    border-top: 1px solid #c8ced3!important;
}

.modal-campaign .modal-footer, .modal-campaign .modal-header {
    border-width: 0;
}

.p-0 {
    padding: 0!important;
}

.modal_campaign.modal-description.collapsed .show-description, .modal-campaign .modal-description .hide-description {
    display: block;
}

.modal_campaign .modal-description .show-description {
    display: none;
}

.modal_campaign .modal-description.collapsed .hide-description {
    display: none;
}

.modal_campaign .modal-description.collapsed .show-description, .modal_campaign .modal-description .hide-description {
    display: block;
}

</style>




<div class="campaign-slider ml-md-3 mx-md-0 mx-auto" >

        <div class="product-gallery col-12 col-md  flex-column flex-md-row d-flex">
	
			<div class="slider-nav d-md-block d-none">
			
				 @foreach($campaign_photo as $img)
			
					
					<img src="{{ cdn_asset('offer_images')}}/{{ $img->image_path }}" alt="name of image" >
					
					
				@endforeach
				
		
				
			</div>


            <div class="slider-main-img">
			
			
				 @foreach($campaign_photo as $img)
			
					
					<img src="{{ cdn_asset('offer_images')}}/{{ $img->image_path }}" alt="name of image" >
					
					
				@endforeach
			
				
				
				
			</div>

		</div>

</div>





<script>
$(function () {
$('.slider-main-img').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: !1,
			dots: !1,
			fade: !0,
			asNavFor: ".slider-nav",
			initialSlide: 0,
			responsive: [{
				breakpoint: 767,
				settings: {
					dots: !0
				}
			}]
});


$('.slider-nav').slick({
			slidesToShow: 5,
			slidesToScroll: 1,
			asNavFor: ".slider-main-img",
			dots: !1,
			vertical: !0,
			focusOnSelect: !0,
			initialSlide: 0,
			prevArrow: '<div class="arrow-up"><span class="glyphicon glyphicon-menu-up"></span></div>',
			nextArrow: '<div class="arrow-down"><span class="glyphicon glyphicon-menu-down"></span></div>',
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 5
				}
			}]

			


		});

$('.slider-main-img').css("visibility", "visible");
$('.slider-nav').css("visibility", "visible");

});
</script>


<style>
nav.slick__arrow {
  height: 0;
  overflow: hidden;
}

nav.slick__arrow, ul.slick-dots {
  display: none!important;
}
</style>


