<div class='margin-steps-insight'>  
<div class="col-lg-12">
  <h2 class="heading-xxl">Create a List</h2>
  <h3 class="heading-m"></h3>
    <ol class="ol-circle">
        <li class="mbm"> Create a list and call it  <u> {{@$offerdetails[0]->product_keywords}} </u>  <i title="How to create list" data-toggle="tooltip" class="fa fa-info-circle text-primary cursor-pointer createlist"></i>  </li>
        <li class="mbm"> Add the product to the list </li>
        <li class="mbm"> Below the product page you will see several related products and highly rated products listed. </li>
        <li class="mbm"> Add the two products with the highest rating and with the most number of reviews </li>

  
    <h3 class="heading-m"></h3>
  <form id='step4_data'  name='step4_data' >
    @csrf

         <li class="mbm">
           Check the following that apply:
            <div class="checkbox">
              
                <div class="checkbox">
                    <input type="checkbox"value=1 id="is_idealist" name="is_idealist" class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->is_idealist) ? "checked" : "" }} >
                    <label for="is_idealist" class="control-label mll pls">I’m sure the link I share is a direct or shortened link to my Idea List, and not to a Wishlist</label> <!---->
                </div> 
                <div class="checkbox"><input type="checkbox" value='1' id="idealist_product_count" name="idealist_product_count" class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->idealist_product_count) ? "checked" : "" }}>
                    <label for="idealist_product_count" class="control-label mll pls">My Idea List contains at least 3 products, including ASIN  <u> {{@$offerdetails[0]->product_id}} </u>   </label> <!---->
                </div> 
                <div class="checkbox"><input type="checkbox" value='1' id="idealist_public" name="idealist_public" class="no-ml" required {{ !empty(@$users_offer_purchase_4rt_steps->idealist_public) ? "checked" : "" }}> 
                    <label for="idealist_public" class="control-label mll pls">My Idea List is public (not all customers are able to change the setting from private to public)</label> <!---->
                </div>
            </div>
        </li>
        
         <h3 class="heading-m"></h3>
        
        <li class="mbm">
            <p>Share your Idea List URL with us:</p> 
            <div class="list-full-width">
                <div class="mbl mtxl">
                    <div>
                        <div class="">
                            <label for="url" class="control-label" style="display: none;"></label> 
                            <input type="text" id="url" name="url"   value="{{@$users_offer_purchase_4rt_steps->url}}"  {{ !empty(@$users_offer_purchase_4rt_steps->url) ? "readonly" : "" }}  placeholder="Idea List URL" autocomplete="on" class="form-control" required> <!---->
                        </div>
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
      
        @if((empty(@$users_offer_purchase_4rt_steps)))
        
            <div class="pull-right">
                  <button type="submit" form="step4_data" value="Submit" class="submit btn btn-primary" >Submit</button>
            </div>
            
            <div  class="pull-right hide" id='tempbutton4'>
                 <button class="btn btn-primary next_move" >Next</button>
            </div>
            
        @elseif((!empty(@$users_offer_purchase_4rt_steps)))
          <div  class="pull-right">
              <button class="btn btn-primary next_move" >Next</button>
          </div>
       @endif
        
        <button class="btn btn-help btn-help-s pull-right createlist" style='border: 1px solid; margin-right:5px'>
                How to make an Idea List
       </button> 
      
       
   
 
</div>
<div style="clear:both;margin-bottom:15px"></div>

</div>













<script>
var loading;
$("#step4_data").on("submit", submit_step4); 
function submit_step4(event)
{
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
    		url 	: "{{ route('submit_step4')}}",
    		type	: "POST",
    		data	: formData,
    		processData: false,
		    contentType: false,
    		beforeSend: function() {
    					
    
    			loading = $("body").waitMe({
    				effect: 'timer',
    				text: 'Submiting ideal list data........',
    				bg: 'rgba(255,255,255,0.90)',
    				color: '#555'
    			}); 
    				
    		},
            success: function(data)
            {
 
    	    	loading.waitMe('hide');
    	    	
    	        $('#url').attr("readonly", 'readonly');
    	    	$('.4rt').addClass('done');
    	    	$('.submit').addClass('hide');
    	    	$('#tempbutton4').removeClass('hide').addClass('show');
    	    	
    	    	
    	    	swal({
					  title: 'Submitted Succesfully',
					  text:  "",
					  type: 'success',
					}).then(function (result) {
					
					var step = 4;
					var steps2 = $(".step-wizard2 ul li").length;
					 setClasses2(step, steps2 - 1);
                      Step(step);
				
				})
    	    	
    	    	
                ///location.reload();
              //alert(data);
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
    			loading.waitMe('hide');
                alert('Error adding / submiting data');
            }
        });
    
}
</script>

<script type="text/javascript">
$( ".createlist" ).click(function() {
  	var options = { backdrop : 'static'}
	$('#myModal-createlist').modal(options);
});
</script>



<!-- Modal -->

<div id="myModal-createlist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">How to make an idea list?</h4>
      </div>
      <div class="modal-body">
            
            <ol class="ol-circle">
                            
                    <li>
                        <p class="mbxl">Click "Add List" and "Create List</p>
                    </li>
                    
                    <div class="panel panel-default">
                        <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                            <div class="panel-body">
                                 <img src="{{ asset('public/help_images/create-list-1.png')}}" class="mtl width-100">
                            </div>
                        </div>
                    </div>
                    
                    <li>
                        <p class="mbxl">Select "Ideal List"</p>
                    </li>
                    
                    <li>
                        <p class="mbxl">Give your "List Name"</p>
                    </li>
                    
                    <li>
                        <p class="mbxl">Click "Create List" button</p>
                    </li>
                    
                      <div class="panel panel-default">
                        <div id="collapse-create-list-desktop" class="panel-collapse collapse in">
                            <div class="panel-body">
                                 <img src="{{ asset('public/help_images/create-list-2.png')}}" class="mtl width-100">
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
       


<!-- Modal -->
<!--
<div id="myModal-createlist" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">How to create an idea list?</h4>
      </div>
      <div class="modal-body">
            <h5 class="no-mt">There are 3 ways of creating an idea list, pick the one that is most convenient.</h5>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" href="#collapse-create-list-mobileapp">1: Create an idea list in the mobile app</a></h4>
                </div>
                <div id="collapse-create-list-mobileapp" class="panel-collapse collapse">
                    <div class="panel-body">
                
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
     
                                        <div class="carousel-inner">
                                          <div class="item active">
                                            <img src="{{ asset('public/help_images/create-list-mobileapp-1.png')}}" alt="First slide">
                                          </div>
                                          <div class="item">
                                            <img src="{{ asset('public/help_images/create-list-mobileapp-2.png')}}" alt="Second slide">
                                          </div>
                                          <div class="item">
                                            <img src="{{ asset('public/help_images/create-list-mobileapp-3.png')}}" alt="Third slide">
                                          </div>
                                        </div>
                                        
                                        
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                          <span class="fa fa-angle-left"></span>
                                        </a>
                                        
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                          <span class="fa fa-angle-right"></span>
                                        </a>
                                    
                                    </div>
                            </div>
                        </div>
                        
                        
                       
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" href="#collapse-create-list-mobile">2: Create an idea list on mobile</a></h4>
                </div>
                <div id="collapse-create-list-mobile" class="panel-collapse collapse">
                    <div class="panel-body">
                      
                      
                          <div class="row">
                            <div class="col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
     
                                        <div class="carousel-inner">
                                          <div class="item active">
                                            <img src="{{ asset('public/help_images/create-list-mobile-1.png')}}" alt="First slide">
                                          </div>
                                          <div class="item">
                                            <img src="{{ asset('public/help_images/create-list-mobile-2.png')}}" alt="Second slide">
                                          </div>
                                          <div class="item">
                                            <img src="{{ asset('public/help_images/create-list-mobile-3.png')}}" alt="Third slide">
                                          </div>
                                        </div>
                                        
                                        
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                          <span class="fa fa-angle-left"></span>
                                        </a>
                                        
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                          <span class="fa fa-angle-right"></span>
                                        </a>
                                    
                                    </div>
                            </div>
                        </div>
                      
                      
                      
                      
                      
                      
                      
                    </div>
                </div>
            </div> 
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a data-toggle="collapse" href="#collapse-create-list-desktop">3: Create an idea list on desktop</a></h4>
                </div>
                <div id="collapse-create-list-desktop" class="panel-collapse collapse">
                    <div class="panel-body">
                        <img src="{{ asset('public/help_images/create-list-desktop.png')}}" class="mtl width-100">
                    </div>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
-->
                       
                        
