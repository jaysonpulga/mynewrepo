<div class='margin-steps-insight'>
    <div class="col-lg-12">
            <h2 class="heading-xxl">Search Product Links</h2>
            <h3 class="heading-m"></h3>
            <ol class="ol-circle">
                <li>
                    Read the article or scan the page for mentions of the product or a link to the featured product.
                </li> 
                <li class="mbm">
                   Click on the link <u>"URL"</u> found on the article to get to the product page on Amazon. 
                    <i title="How to find url?" data-toggle="tooltip" class="fa fa-info-circle text-primary cursor-pointer howto"></i>
                </li>
            </ol>
            
    </div>
    <div style="clear:both;margin-top:15px"></div>
    <div class="col-lg-12">
       <div class="pull-left">
           <button class="btn btn-default prev" >Previous</button>
      </div> 
      <div class="pull-right">
          <button class="btn btn-help btn-help-s howto" style='border: 1px solid'>
                How to find url
            </button>
          <button class="btn btn-primary next_move" >Next</button>
      </div> 
    </div>
    <div style="clear:both;margin-bottom:15px"></div>
</div>


<script type="text/javascript">
$( ".howto" ).click(function() {
  	var options = { backdrop : 'static'}
	$('#myModal').modal(options);
});
</script>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">How to find url to get to the product page on amazon</h4>
      </div>
      <div class="modal-body">
      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse1">Find url on desktop</a>
        </h4>
        </div>
         <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <img src="{{ asset('public/help_images/find-url-on-amazon.png')}}" class="mtl width-100">
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