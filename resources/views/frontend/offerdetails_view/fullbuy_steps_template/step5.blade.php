<div class='margin-steps-insight'>  
<div class="col-lg-12">
<h2 class="heading-xxl">Product Survey</h2>
<h3 class="heading-m"></h3>
<form id='step5_data'  name='step5_data' >
  @csrf          
      <ol class="ol-circle">
            <li>
                <p> Look at your list and compare this product with other products in your list. What makes this product stand out? If you are to rank this product will it be your best pick, second pick or your worst pick? Please provide a reason why. </p> 
                <div class="list-full-width">
                    <div class="mbl mtxl">
                        <div>
                            <textarea id='question1' {{ !empty(@$users_offer_purchase_5th_steps->question1) ? "readonly" : "" }}  name='question1' class="form-control"  rows="3" style="width:100%" required>{{@$users_offer_purchase_5th_steps->question1}}</textarea>
                        </div>
                    </div> 
                </div>
               
            </li>
            
            <li class="mbm">
                <p>What improvements, in your opinion can be made to the product and the product listing to make it more appealing to buyers?</p> 
                <div class="list-full-width">
                    <div class="mbl mtxl">
                        <div>
                           <textarea id='question2' {{ !empty(@$users_offer_purchase_5th_steps->question2) ? "readonly" : "" }}  name='question2' class="form-control"  rows="3" style="width:100%" required>{{@$users_offer_purchase_5th_steps->question2}}</textarea>
                        </div>
                    </div> 
                </div>
            </li>
        </ol>
</form>
</div> 


<div style="clear:both;margin-top:15px"></div>
<div class="col-lg-12">
   
   <div class="pull-left">
       <button class="btn btn-default prev" >Previous</button>
  </div> 
  
    @if((empty(@$users_offer_purchase_5th_steps)))
    
        <div class="pull-right">
             <button type="submit" form="step5_data" value="Submit" class="submit5 btn btn-primary" >Submit</button>
        </div>
        
         <div  class="pull-right hide" id='tempbutton5'>
                 <button class="btn btn-primary next_move" >Next</button>
         </div>
        
        
    @elseif((!empty(@$users_offer_purchase_5th_steps)))
      <div  class="pull-right">
          <button class="btn btn-primary next_move" >Next</button>
      </div> 
  @endif
     
</div>

<div style="clear:both;margin-bottom:15px"></div>
</div>

<script>
var loading;
$("#step5_data").on("submit", submit_step5); 
   
function submit_step5(event)
{
    event.preventDefault();
    var formData = new FormData(this);
    
    formData.append('offer_id',"{{$offerdetails[0]->id}}");
    formData.append('product_id',"{{$offerdetails[0]->product_id}}");
    
     $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
			  });

     // save data template
        $.ajax({
    		url 	: "{{ route('submit_step5')}}",
    		type	: "POST",
    		data	: formData,
    		processData: false,
		    contentType: false,
    		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Submiting Product Survey........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    		},
            success: function(data)
            {
    
    	    	loading.waitMe('hide');
                ///location.reload();
              //alert(data);
              
              
              
                $('#question1').attr("readonly", 'readonly');
                $('#question2').attr("readonly", 'readonly');
    	    	$('.5th').addClass('done');
    	    	
    	    	
    	    	$('.submit5').addClass('hide');
    	    	$('#tempbutton5').removeClass('hide').addClass('show');
    	    	
    	    	
    	    	swal({
					  title: 'Submitted Succesfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
					var step = 5;
					var steps2 = $(".step-wizard2 ul li").length;
					 setClasses2(step, steps2 - 1);
                      Step(step);
				
				})
              
              
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
    			loading.waitMe('hide');
                alert('Error adding / submiting data');
            }
        });
    
}
</script>


                      