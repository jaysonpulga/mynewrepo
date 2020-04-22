<div class='margin-steps-insight'> 
<div class="col-lg-12">
      <h2 class="heading-xxl">Buy Product Instruction</h2>
      <h3 class="heading-m"></h3>
<form id='step6_data'  name='step6_data' >
@csrf       
      <ol class="ol-circle">
            <li class="mbm">
                <p>Add the product to your cart and complete the purchase.</p> 
            </li>
             <li class="mbm">
                <p>After your purchase take note of your order number and paste it below:</p> 
                <div class="list-full-width">
                    <div class="mbl mtxl">
                        <div>
                            <div class="">
                                <input type="text" id="order_number" name="order_number" placeholder="Order Number" {{ !empty(@$users_offer_purchase_6th_steps->order_number) ? "readonly" : "" }} value="{{@$users_offer_purchase_6th_steps->order_number}}" autocomplete="on" class="form-control" required> <!---->
                            </div>
                        </div>
                    </div> 
                </div>
            </li>
             <li class="mbm">
                <p>Copy the tracking number provided with your order for order verification. We will confirm your order so we can provide your cashback soon.</p> 
            </li>
        </ol>
</form>
</div> 

<div style="clear:both;margin-top:15px"></div>
<div class="col-lg-12">
       <div class="pull-left">
           <button class="btn btn-default prev" >Previous</button>
      </div> 
       @if((empty(@$users_offer_purchase_6th_steps)))
            <div class="pull-right">
                <button type="submit" form="step6_data" value="Submit" class="submit6 btn btn-primary" >Submit</button>
            </div>
        @endif
   
</div>
<div style="clear:both;margin-bottom:15px"></div>

</div>



<script>

function applicationContextPath() {
    if (location.pathname.split('/').length > 1)
        return "/" + location.pathname.split('/')[1];
    else
        return "/";
}

var loading;
$("#step6_data").on("submit", submit_step6); 
   
function submit_step6(event)
{
   var redirect_url = "{{ url('')}}";
   var url = new URL(redirect_url);
   var pathname = url.pathname; 
   var redirect_path =  redirect_url+''+pathname+'/campaign/instruction/offerdetails/{{ @$offerdetails[0]->id }}';
   

    
    event.preventDefault();
    var formData = new FormData(this);
    
    formData.append('offer_id',"{{@$offerdetails[0]->id}}");
    formData.append('product_id',"{{@$offerdetails[0]->product_id}}");
    
     $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
			  });

     // save data template
        $.ajax({
    		url 	: "{{ route('submit_step6')}}",
    		type	: "POST",
    		data	: formData,
    		processData: false,
		    contentType: false,
			dataType: 'json',
    		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Submiting Data........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    		},
            success: function(data)
            {
    	        loading.waitMe('hide');
    	    
				if(data.result == "success")
				{
					$('#order_number').attr("readonly", 'readonly');
					$('.6th').addClass('done');
					$('.submit6').addClass('hide');
					
					
					var step = 6;
					var steps2 = $(".step-wizard2 ul li").length;
					 setClasses2(step, steps2 - 1);
					 Step(step);
					
					
					
					swal({
						  title: 'Submitted Succesfully',
						  text:  "Proceed to Verify Purchase",
						  type: 'success',
						}).then(function () {
							
						
						
						window.location = data.url;
					
					})
				}	
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
    			loading.waitMe('hide');
                alert('Error adding / submiting data');
            }
        });
    
}

$(".prcdvp").click(function() 
{
  setClasses(3-1, $(".step-wizard ul li").length-1);
  
});


</script>

                      