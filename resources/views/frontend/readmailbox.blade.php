@extends('frontend.layouts.main')

@section('content')


<style>
.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}

</style>

<style>
.table-bordered td {
     border:none;
}

.table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: none;
}



.borderLeft
{
	border-left: 5px solid #0088cc !important;
	
}


.button_cancel
{
	
	color: #333;
    background-color: #d4d4d4;
    border-color: #8c8c8c;
}


.hover:hover{
    cursor: pointer;
}

.hover2:hover{
    cursor: pointer;
	text-decoration:underline
}

.btn-default{
    color: #333;
    background-color: rgb(242, 242, 242);
    border-color: #bfbfbf;
}

.unread
{
	font-weight:bold !important;
}

.read
{
	font-weight:normal !important;
}


.medium
{
	font-size:11px;
}


.mailbox-read-message {
    padding: 10px;
}

.mailbox-controls.with-border {
    border-bottom: 1px solid #f4f4f4;
}

.label-primary {
    background-color: #3c8dbc !important;
}

.pull-right-container {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -7px;

}

.bg-red
{
    background-color: #5cb85c !important;
}
</style>


<section class="content">
    <!-- Main content -->
    <section class="row">
	

	
	   <!-- Small boxes (Stat box) -->
      <div class="row">
	  
		<div class="col-md-3">
		
		
			  
			  <div class="box custom_box">
				<div class="box-header with-border">
				  <h3 class="box-title">Folders</h3>

				  <div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				  </div>
				</div>
				<div class="box-body no-padding">
				  <ul class="nav nav-pills nav-stacked">

					<li id='inboxlist'>
						<a href="{{asset('mail/inbox')}}"><i class="fa fa-inbox"></i> Inbox
							<span class="label label-primary pull-right count_unread"></span>
						</a>
					</li>
					<li id='trashlist' > <a href="{{asset('mail/trash')}}"><i class="fa fa-trash-o"></i> Trash</a></li>
					
				  </ul>
				</div>
				<!-- /.box-body -->
			  </div>
			
		</div>
	  
	   <div class="col-lg-9">
	   
	   
	   
				   <div class="box box-primary custom_box"  id='readmessage'>
						<div class="box-header with-border">
						  <h3 class="box-title">Read Mail</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body no-padding">
						  <div class="mailbox-read-info">
							<h3 id='mail_subject'>{{$messageData->subject}}</h3>
							<h5>
								<span id='mail_fullname' >From: {{$messageData->sender}}</span>
								<span  id='mail_time' class="mailbox-read-time pull-right"></span>
							</h5>
						  </div>
						  <!-- /.mailbox-read-info -->
						  
						  <div class="mailbox-controls with-border text-right">
								
								<input type='hidden' id='sender_id'  />
							
								<button type="button"  onclick="DeleteMessage()"  class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
								<i class="fa fa-trash-o"></i> Delete</button>
						
						  </div>
						  
						  
									  
						  <!-- /.mailbox-controls -->
						  <div  id='mail_message' class="mailbox-read-message">
						  {!!$messageData->message!!}
						  </div>
						  <!-- /.mailbox-read-message -->
						</div>
					   
						<div class="box-footer">
						</div>
						<!-- /.box-footer -->
					</div>
	   

			
		</div>
	  
	  </div>
      <!-- /.row (main row) -->	  
    
	</section>
    <!-- /.content -->
<!-- /.content-wrapper -->
</div>



<script>
$(document).ready(function(){
	

$('#mail_time').empty().append(formatDate("{{$messageData->created_at}}"));

});




</script>




<script>
function formatDate(datetime)
{

var monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];	
	
var someDate = new Date(datetime);
var dd = ("0" + someDate.getDate()).slice(-2);
var y = someDate.getFullYear();
var hours = someDate.getHours();
var minutes = someDate.getMinutes();
var ampm = hours >= 12 ? 'PM' : 'AM';
hours = hours % 24;
hours = hours ? hours : 12; // the hour '0' should be '12'
minutes = minutes < 10 ? '0'+minutes : minutes;

var strTime = hours + ':' + minutes + ' ' + ampm;

//var strTime = hours + ':' + minutes;


var datetime = dd + '  '+ monthNames[someDate.getMonth()] + '  '+y+' '+strTime;
return datetime;	

}
</script>


<script>
function timeAgo(dateString) {
        var rightNow = new Date();
        var then = new Date(dateString);

        /* if ($.browser.msie) {
            // IE can't parse these crazy Ruby dates
            then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
        } */

        var diff = rightNow - then;

        var second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24,
        week = day * 7;

        if (isNaN(diff) || diff < 0) {
            return ""; // return blank string if unknown
        }

        if (diff < second * 2) {
            // within 2 seconds
            return "right now";
        }

        if (diff < minute) {
            return Math.floor(diff / second) + " seconds ago";
        }

        if (diff < minute * 2) {
            return "about 1 minute ago";
        }

        if (diff < hour) {
            return Math.floor(diff / minute) + " minutes ago";
        }

        if (diff < hour * 2) {
            return "about 1 hour ago";
        }

        if (diff < day) {             return  Math.floor(diff / hour) + " hours ago";         }           if (diff > day && diff < day * 2) {
            return "yesterday";
        }

        if (diff < day * 365) {
            return Math.floor(diff / day) + " days ago";
        }

        else {
            return "over a year ago";
        }
}

</script>

@endsection
