<link rel="stylesheet" href="{{ asset('public/app.css')}}">
<style>
#container22 {
  position: relative;
  width: 100%;
  text-align: center;
  height: 90px;
}

.step-wizard2 {
  display: inline-block;
  position: relative;
  width: 100%;
}
/*
.step-wizard2 .progress2 {
  position: absolute;
  top: 40px;
  left: 11%;
  width: 80%;
}
*/
.step-wizard2 .progress2 {
    position: absolute;
    top: 40px;
    left: 10%;
    width: 75%;
}

.step-wizard2 .progressbar2 {
  position: absolute;
  background-color: #3c8dbc;
  opacity: 0.6;
  height: 12px;
  border: 1px solid e5e6e6;
  width: 0%;
  -webkit-transition: width 0.6s ease;
  -o-transition: width 0.6s ease;
  transition: width 0.6s ease;
}
.step-wizard2 .progressbar2.empty {
  opacity: 1;
  width: 100%;
  background-color: #e5e6e6;
}



.step-wizard2 ul {
      list-style: none;
      margin-bottom: 1.5em;
 }

.step-wizard2 ul {
    margin-top: 10px !important;
}


.step-wizard2 ul {
  position: absolute;
  width: 100%;
  list-style-type: none;
  padding-top: 0px;
  padding-bottom: 0px;
  padding-right: 0px;
  padding-left: 0px;
  left: -5%;
}
.step-wizard2 li {
  display: inline-block;
  text-align: center;
  width: 14.7%;
}
.step-wizard2 li .step2 {
  position: absolute;
  display: inline-block;
  line-height: 35px;
  width: 42px;
  height: 42px;
  border-radius: 50%;
  border: 3px solid;
  border-color: #e5e6e6;
  background: #ffffff;
  -webkit-transition: background-color 0.6s ease, border-color 0.6s ease;
  -o-transition: background-color 0.6s ease, border-color 0.6s ease;
  transition: background-color 0.6s ease, border-color 0.6s ease;
}
.step-wizard2 li .title {
  position: absolute;
  width: 100%;
  left: 20px;
  padding-top: 42px;
  color: #969c9c;
  -webkit-transition: color 0.6s ease;
  -o-transition: color 0.6s ease;
  transition: color 0.6s ease;
}
.step-wizard2 li.active .step2 {
  border-color: #3c8dbc;
}
.step-wizard2 li.active .title {
  color: black;
}
.step-wizard2 li.done .step2 {
  color: white;
  background-color: #3c8dbc;
  border-color: #3c8dbc;
}
.step-wizard2 li > a {
  display: block;
  width: 100%;
  color: black;
  position: relative;
  text-align: center;
}

.step-wizard2 li.done .step2:after {
     content: '\2713';
}


.step-wizard2 li > a  {
  pointer-events: none;
  cursor: default;
}


.step-wizard2 li > a:hover .step2 {
  border-color: #0aa89e;
}
.step-wizard2 li > a:hover .title {
  color: black;
}



.contentarea2 {
  width: 100%;
  display: none
}
.contentarea2.active {
  display: block
}    


.hide
{
    display:none;
}

.show
{
    display:inline;
}

.margin-steps-insight
{
    margin-left:70px;
    margin-right:70px;
}

.adjust_button_step3
{
    float:none;
    margin-top:0px;
}


@media only screen and (max-width: 780px) {
     .margin-steps-insight
    {
        margin-left:0px;
        margin-right:0px;
    }


}

@media only screen and (max-width: 400px) {
 .margin-steps-insight


    .adjust_button_step3
    {
        float:left;
        margin-top:10px;
    }
}




</style>



<div class="row" >
<div class="box" >
<div class="box-body">

<div class="col-sm-12">
		
		<center>
			<h4 style="color: hsla(243, 30%, 41%, 1);font-weight: bold;">
				Now please ensure you complete the job within 60 minutes because otherwise, your
				claim will be deemed invalid and deleted from your Claims &amp; Cashback list.
			</h4>
		</center>
		<hr>
                
        <div id="container22">
		
		

              <div class="step-wizard2">
                <div class="progress2">
                  <div class="progressbar2 empty"></div>
                  <div id="prog2" class="progressbar2"></div>
                </div>
                <ul>
                  <li class="1st active {{ (@$users_offer_purchase_products->step1 == 1) ? "done" : "" }} " >
                    <a href="#">
                      <span class="step2">1</span>
                    </a>
                  </li>
                  <li class="2nd {{ (@$users_offer_purchase_products->step2 == 1) ? "done" : "" }}">
                    <a href="#">
                      <span class="step2">2</span>
                    </a>
                  </li>
                  <li class="3rd {{ (@$users_offer_purchase_products->step3 == 1) ? "done" : "" }}">
                    <a href="#">
                      <span class="step2">3</span>
                    </a>
                  </li>
                  
                  <li class="4rt {{ (@$users_offer_purchase_products->step4 == 1) ? "done" : "" }} ">
                    <a href="#">
                      <span class="step2">4</span>
                    </a>
                  </li>
                  
                  <li class="5th {{ (@$users_offer_purchase_products->step5 == 1) ? "done" : "" }}">
                    <a href="#">
                      <span class="step2">5</span>
                    </a>
                  </li>
                  
                  <li class="6th {{ (@$users_offer_purchase_products->step6 == 1) ? "done" : "" }}" >
                    <a href="#">
                      <span class="step2">6</span>
                    </a>
                  </li>
                  
                  
                  
                </ul>
              </div>
              
        </div>
        
   
       <div class="full-content2">

                         <div class="contentarea2 active" id="step1">
                                @include('frontend.offerdetails_view.insight_steps_template.step1')   
                         </div>

                         <div class="contentarea2" id="step2">
                                  @include('frontend.offerdetails_view.insight_steps_template.step2')    
                          </div>
                          
                          <div class="contentarea2" id="step3">
                                  @include('frontend.offerdetails_view.insight_steps_template.step3')
                          </div>
                          
                          <div class="contentarea2" id="step4">
                                 @include('frontend.offerdetails_view.insight_steps_template.step4')
                          </div>
                          
                       <div class="contentarea2" id="step5">
                                @include('frontend.offerdetails_view.insight_steps_template.step5')
                        </div>
                          
                      <div class="contentarea2" id="step6">
                                @include('frontend.offerdetails_view.insight_steps_template.step6')
                      </div>
                          
             
        </div>
   
                   
                   
               
                       
        
<div style="clear:both;margin-bottom:10px;"></div>	
</div>           
</div>
</div><!--end box-->
</div><!--end row-->

<script>
$(document).ready(function() {
 LoadStep();
});    
</script>


<script>
function LoadStep()
{
    var step1 = "{{ !empty(@$users_offer_purchase_products->step1) ? @$users_offer_purchase_products->step1 : "0" }}";
    var step2 = "{{ !empty(@$users_offer_purchase_products->step2) ? @$users_offer_purchase_products->step2 : "0" }}";
    var step3 = "{{ !empty(@$users_offer_purchase_products->step3) ? @$users_offer_purchase_products->step3 : "0" }}";
    var step4 = "{{ !empty(@$users_offer_purchase_products->step4) ? @$users_offer_purchase_products->step4 : "0" }}";
    var step5 = "{{ !empty(@$users_offer_purchase_products->step5) ? @$users_offer_purchase_products->step5 : "0" }}";
    var step6 = "{{ !empty(@$users_offer_purchase_products->step6) ? @$users_offer_purchase_products->step6 : "0" }}";
    var steps2 = $(".step-wizard2 ul li").length;
      
    if(step1 == 0)
    {
         // initial state setup
         setClasses2(0, steps2 - 1);
         return false;
    }
    if(step2 == 0)
    {
         // initial state setup
         setClasses2(1, steps2 - 1);
         return false;
    }
   if(step3 == 0)
    {
         // initial state setup
         setClasses2(2, steps2 - 1);
         return false;
    }
    else if(step4 == 0)
    {
         // initial state setup
         setClasses2(3, steps2 - 1);
         return false;
    }
    else if(step5 == 0)
    {
         // initial state setup
         setClasses2(4, steps2 - 1);
         return false;
    }
    else if(step6 == 0)
    {
         // initial state setup
         setClasses2(5, steps2 - 1);
         return false;
    }
    else
    {
         // initial state setup
         setClasses2(5, steps2 - 1);
         return false;
    }

}
</script>



<script>
function setClasses2(index2, steps2) {
      
    if (index2 < 0 || index2 > steps2)  return;
 
    if (index2 == 0) {
      $(".prev").prop('disabled', true);
    } else {
      $(".prev").prop('disabled', false);
    }
      
    $(".step-wizard2 ul li").each(function() {
      $(this).removeClass("active");
    });
   
       
    $(".step-wizard2 ul li:eq(" + index2 + ")").addClass("active")
    

    var pp = index2 * (100 / steps2);

    $("#prog2").width(pp + '%');
    
    
    
    $(".full-content2 > div").removeClass("active").eq(index2).addClass("active");
    
}
  
  
  $(".step-wizard2 ul a").click(function() {
    var step = $(this).find("span.step2")[0].innerText;
    var steps2 = $(".step-wizard2 ul li").length;
    setClasses2(step - 1, steps2 - 1)
  });
  
  
  $(".prev").click(function() {
    var step = $(".step-wizard2 ul li.active span.step2")[0].innerText;
    var steps2 = $(".step-wizard2 ul li").length;
    setClasses2(step - 2, steps2 - 1);
  });
  
  
  $(".next_move").click(function() {
	  
        if ($(this).text() == 'done') {
            
          var step = $(".step-wizard2 ul li.active span.step2")[0].innerText;
          var steps2 = $(".step-wizard2 ul li").length;
          
        
        } else {
         // var step = $(".step-wizard2 ul li.active span.step")[0].innerText;
          
          var step = $(".step-wizard2 ul li.active span.step2")[0].innerText;
          var steps2 = $(".step-wizard2 ul li").length;
          
           $(".step-wizard2 ul li:lt(" + step + ")").addClass("done");
          
          setClasses2(step, steps2 - 1);
          Step(step);
          
        }
    });    
</script>




<script>
function Step(step)
{
    	
	$.ajax({

		url: "{{route('update_purchase_product_steps')}}",
		type: 'POST',
		data: {"_token":$('#token').val(),offer_id:"{{@$offerdetails[0]->id}}",product_id:"{{@$offerdetails[0]->product_id}}",step:step},
		success: function(data)
		{
		    console.log(data);
		},
		error: function(error){ 
			console.log(error);
		}
		
	});
	
}
</script>