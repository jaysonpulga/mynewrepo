@extends('frontend.layouts.main')

@section('content')
<style>
.new_stepper{padding-left:0}
.new_stepper li a.num{ padding:1.5rem;font-size:15px;text-align:center }
.new_stepper li a .circle {  
display: inline-block;
color: #fff;
border-radius: 50%;
background: rgba(0,0,0,.38);
width: 35px;
min-width: 35px;
height: 35px;
text-align: center;
line-height: 35px;
margin-right: .5rem;
font-size: 80%;
}

.new_stepper li a .label {
	font-size: 15px;
}

.new_stepper li a.disabled span.label{ 
pointer-events: none;
cursor: default;
color:#c0c3c5 !important;
}


.new_stepper li > a.disabled{ 
pointer-events: none;
cursor: default;
}
.prev_img{
    color:black !important;
}
.new_stepper li a span.label{ color: rgba(0,0,0,.87);!important; margin-top:8px; font-size:15px }

.new_stepper li a .label{ display:inline-block }
.new_stepper li a:hover .circle{ background-color:#167495}
.new_stepper li a.disabled{ cursor:default; color:#c0c3c5 !important}
.new_stepper li a.disabled .circle{ background: rgb(204, 206, 208);  }
.new_stepper li.active a .circle,.new_stepper li.completed a .circle{background-color:#20a8d8}
.new_stepper li.active a .label,.new_stepper li.completed a .label{font-weight:600;color:rgba(0,0,0,.87)}
.new_stepper li.warning a .circle{background-color:#f86c6b}

.new_stepper-vertical{position:relative;display:flex;flex-direction:column;justify-content:space-between}
.new_stepper-vertical li{display:flex;align-items:flex-start;flex:1;flex-direction:column;position:relative}
.new_stepper-vertical li a.num{align-self:flex-start;display:flex;position:relative}
.new_stepper-vertical li a .circle{order:1}
.new_stepper-vertical li a .label{flex-flow:column nowrap;order:2;margin-top:0}
.new_stepper-vertical li.completed a .label{font-weight:500}
.new_stepper-vertical li .step-content p{font-size:.88rem}

.new_stepper-vertical li.disabled:not(:last-child):after{ 
content: "";
position: absolute;
width: 1px;
height: calc(100% - 50px);
left: 3rem;
top: 6rem;
background-color: rgba(0,0,0,.1);
}

.new_stepper-vertical li .step-content {
    display: block;
    margin-top: 0px;
    margin-left: 65px;
    padding: 0.99rem;
}

.p-1 {
    padding: 2px !important;
}


</style>

<style>
    .thumbnails.image_picker_selector img{
        max-width: 50px;
        max-height: 50px;
    }
    .preview .circle{
        display: inline-block;
        color: rgb(255, 255, 255);
        border-radius: 50%;
        background-color: rgb(32, 168, 216);
        width: 35px;
        min-width: 35px;
        height: 35px;
        text-align: center;
        line-height: 35px;
        margin-right: .5rem;
        font-size: 80%;
    }
    ul.thumbnails.image_picker_selector{
        margin-right: auto !important;
        margin-left: auto !important;
        width: 275px !important;
    }
    .question{
        font-weight:600;
        font-size:15px;
        
    }
    .checked{
        color:orange;
    }
    .lozad{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: 40%;
    }
}

.lib-panel {
    margin-bottom: 20Px;
}
.lib-panel img {
    width: 100%;
    background-color: transparent;
}

.lib-panel .row,
.lib-panel .col-md-6 {
    padding: 0;
    background-color: #FFFFFF;
}


.lib-panel .lib-row {
    padding: 0 20px 0 20px;
}

.lib-panel .lib-row.lib-header {
    background-color: #FFFFFF;
    font-size: 20px;
    padding: 10px 20px 0 20px;
}

.lib-panel .lib-row.lib-header .lib-header-seperator {
    height: 2px;
    width: 26px;
    background-color: #d9d9d9;
    margin: 7px 0 7px 0;
}

.lib-panel .lib-row.lib-desc {
    position: relative;
    height: 100%;
    display: block;
    font-size: 13px;
}
.lib-panel .lib-row.lib-desc a{
    position: absolute;
    width: 100%;
    bottom: 10px;
    left: 20px;
}

.row-margin-bottom {
    margin-bottom: 20px;
}

.box-shadow {
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
    box-shadow: 0 0 10px 0 rgba(0,0,0,.10);
}

.no-padding {
    padding: 0;
}
.box-shadow{
    border:4px solid transparent;
}
.prev2.active .box-shadow{
    border:4px solid rgb(60, 141, 188); !important;
}
.lib-desc{
    margin-left:-20px;
    font-size:13px;
}
@media only screen and (max-width:800px){
    .lib-desc{
        margin-top: 10px;
        margin-left:0px;
    }
}
@media only screen and (max-width:1400px){
    .lib-desc{
        font-size: 12px;
    }
    .lozad{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: 0%;
    }
}
a.num:hover{
    cursor:default !important;
}
</style>
<section class="content">
    <div class="row">
	<section class='col-lg-12'>
	    <div class="box">
	        <div class="box-body preview">
                <section style="padding:20px 0px 20px 0px;">
                    <ul class="new_stepper new_stepper-vertical">
                        <li class="active disabled">
                            <a class="num" href="#">
                                    <span class="circle">1</span>
                                    <span class="label text-danger">Please Read The Context Situation</span><br>
                            </a>
                            <small style="margin-left:65px;margin-top:-10px;margin-bottom:20px;">This is the situation that you are in</small>
                            <div class="row" style="padding:.75rem;">
            				    <div class="col-lg-12" style="padding-left: 70px;">
            				        {{ @$preview[0]->survey_question_1 }}
                				</div>
            				</div>
                        </li>
                        <li class="active disabled">
                            <a class="num" href="#">
                                    <span class="circle">2</span>
                                    <span class="label text-danger">Read The Question and select one product by clicking at it</span>
                            </a>
                            <div class="row" style="padding:.75rem;">
            				    <div class="col-lg-12" style="padding-left: 70px;">
            				        {{ @$preview[0]->survey_question_2 }}
                				</div>
            				</div>
                        </li>
                        <li class="active disabled">
                            <a class="num" href="#">
                                    <span class="circle">3</span>
                                    <span class="label text-danger">Pick Image</span>
                            </a>
                            <div class="col-lg-12" style="padding-left: 50px;">
                                Pick Image that you would like to vote
            				        <div style='background-color:rgb(228,228,228);padding:10px 30px 0px 0px;margin-left:auto;margin-right:auto;'>
                				        <div class="row" style="padding-left:10px;">
                				            @foreach(@$preview as $image)
                				            <div class="col-sm-7 col-lg-4 col-xl-4 prev2" data-image_path="{{ @$image->image_path }}" data-image_id="{{$image->id}}" style="padding-right: 0px;">
                				                <a href="javascript:void(0)" data-id="{{$image->id}}" class="prev_img">
                				                <div id="lib-item" class="lib-item" data-category="view">
                                                    <div class="lib-panel">
                                                        <div class="row box-shadow"style="margin:0px 0px 10px 0px;padding:10px;">
                                                            <div class="col-sm-6" style="padding-top:5px">
                                              <!--                  <figure class="embed-responsive embed-responsive-4by3 mb-0 lozad" data-background-image="{{ asset('public/product_votes_images') }}/{{ @$image->image_path }}" data-loaded="true" style="background-image: url({{ asset('public/product_votes_images') }}/{{ @$image->image_path }});">-->
                                						        <!--</figure>-->
                                						        <img style="max-height:160px;object-fit: contain;"src="https://researchsale.com/seller_beta/public/product_votes_images/{{ @$image->image_path }}">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="lib-desc"style="overflow: hidden;text-overflow: ellipsis;margin-bottom:5px;">
                                                                    {{@$image->product_votes_description}}cwerqwecrqwecrqwerqwcerqwerqwer
                                                                </div>
                                                                <div class="lib-desc">
                                                                    <span style="color:red;">$ 50.00</span>
                                                                </div>
                                                                <div class="lib-desc">
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span class="fa fa-star checked"></span>
                                                                    <span><a href="javascript:void(0)"style="font-size:10px">( 1135 )</a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                </a>
                				            </div>
                				            
                				            @endforeach
                				        </div>
                                    </div>
        				    </div>
                        </li>
                        <li class="active disabled">
                            <a class="num" href="#">
                                    <span class="circle">4</span>
                                    <span class="label text-danger">Explain Your Choice</span>
                            </a>
        				    <div class="col-lg-12" style="padding-left: 60px;">
        				        <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Type here your explanation of your choice</label>
                                    <textarea class="form-control" name="explain" style="text-align:center" placeholder="Eg. A lot of function showed at this image. also five star and free shipping" id="explain" rows="3"></textarea>
                                </div>
            				</div>
                        </li>
                        <li class="active disabled">
                            <a class="num" href="#">
                                    <span class="circle">5</span>
                                    <span class="label text-danger">Vote and Earned Vote & Earn {{@$preview[0]->points}} Points</span>
                            </a>
                            <div class="col-lg-12" style="padding-left: 60px;">
        				        Earn Points with voting
                                <div id="campaign-submission-form" class="text-center fv-form fv-form-bootstrap4">
        						<div class="form-group fv-has-feedback">
        							<div class="pt-0-5 px-3 px-lg-0 mt-3">
        							</div>			
        						</div>
        						<button data-vote_id="{{@$preview[0]->vote_id}}" data-points="{{@$preview[0]->points}}" data-seller_id="{{@$preview[0]->seller_id}}"class="btn btn-primary btn-block btn-lg mt-1 btn-vote_now">Submit vote</button>
        					</div>
            				</div>
                        </li>
                    </ul>
				</section>
	        </div>
	    </div>
	</section>
</div>
</section>
<script>
    $(document).ready(function(){
        $('.prev2').click(function(){
            var image = $(this).attr('data-image_id');
            $('.prev2').each(function(){
                if($(this).attr('data-image_id') == image){
                    $(this).addClass('active');
                }else{
                    $(this).removeClass('active');
                }
            })
        })
        $('.btn-vote_now').click(function(){
            var vote_id = $(this).attr('data-vote_id');
            var seller_id = $(this).attr('data-seller_id');
            var points = $(this).attr('data-points');
            var explain = $('#explain').val();
            var check = $('input[name="terms"]:checked').val();
            var image_id = $('.prev2.active').attr('data-image_id');
            var image_path = $('.prev2.active').attr('data-image_path');
            if({{@$vote_threshold}} >= 3){
                swal({
                        type:'error',
                        title:'',
                        text:'You have reached your daily votes'
                    })
            }else if(explain == ''){
                swal({
                        type:'error',
                        title:'',
                        text:'Please explain your choice'
                    })
            }else if(image_id == undefined){
                swal({
                        type:'error',
                        title:'',
                        text:'Please Select image !'
                    })
            }
            else{
                $.ajax({
                url:'{{asset('user/submit_vote')}}',
                type:'POST',
                headers:{'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')},
                data:{vote_id:vote_id,explain:explain,seller_id:seller_id,points:points,image_id:image_id,image_path:image_path},
                success:function(data){
                    swal({
                        type:'success',
                        title:'',
                        text:"Your vote was successfull. You've earned "+points+" points" 
                    }).then(function(){
                        window.location.replace('{{asset('user/daily_thresholds')}}');
                    })
                },
                error:function(data){
                        swal({
                            type:'error',
                            title:'',
                            text:'Vote Failed Try again'
                        }).then(function(){
                            location.reload();
                        })
                    }
                })
            }
            
        })
    })
</script>
@endsection