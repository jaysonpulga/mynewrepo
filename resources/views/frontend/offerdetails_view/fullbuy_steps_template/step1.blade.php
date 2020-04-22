<div class='margin-steps-insight'>
    <div class="col-lg-12">
          <h2 class="heading-xxl">Make an Idea List on Amazon</h2>
          <h3 class="heading-m"></h3>
          <ol class="ol-circle">
              <li class="mbm">
                 
                 Make an Idea List with this name: 
                 <strong>Ideas - {{$offerdetails[0]->fullbuy_keyword}}  </strong> <i title="How to create list" data-toggle="tooltip" class="fa fa-info-circle text-primary cursor-pointer createlist"></i>
              
              </li>
          </ol>
    </div>
    <div class="text-danger idea-list-warning">
        <h5 class="no-mt"><strong>Please Note:</strong></h5>
        <ul>
            <li>Create an Idea List, not a Wishlist</li> 
            <li>Make sure to use the following name: ( Ideas - {{$offerdetails[0]->fullbuy_keyword}}  )</li>
        </ul>
    </div>
    <div style="clear:both;margin-top:15px"></div>
    <div class="col-lg-12">
    	   <div class="col-sm-12">
    	       <div class="pull-right">
    	             <button class="btn btn-help btn-help-s createlist" style='border: 1px solid; margin-right:5px'>
                            How to make an Idea List
                   </button> 
                   <button  class="btn btn-primary next_move">Next</button>
               </div>
            </div>	
    </div>
    <div style="clear:both;margin-bottom:15px"></div>
</div>

<script type="text/javascript">
$( ".createlist" ).click(function() {
  	var options = { backdrop : 'static'}
	$('#myModal-createlist').modal(options);
});
</script>


<!-- Modal -->
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
            
            <!--
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
            -->
            
            <!--
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
            --->
            
            
           
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
       