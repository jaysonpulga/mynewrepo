@extends('frontend.layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('jpages/jPages.css')}}" >
<script src="{{ asset('jpages/jPages.js')}}" ></script>

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
	   
		<div class="box box-primary custom_box" >
            <div class="box-header with-border">
              <h3 id='titlebox' class="box-title">MAILBOX</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
			  
			  
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" id="delete_all" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" id="refresh" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <!-- /.pull-right -->
				
				

					<div id="pagination" > 
						<div class="holder inline pull-right"></div>
					</div>
				
              </div>
			  
			  
              <div class="table-responsive mailbox-messages">
                <table id='mail' class="table table-hover table-striped">
                  <tbody id="mail_data"></tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
			
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
              </div>
            </div>
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
	
loadMail("{{$task}}");


});

function jpages(){
	
			$("div.holder").jPages({
			  containerID : "mail_data",
			  previous : "«",
			  next : "»",
			  perPage : 15,
			  delay :5,
			  startPage    : 1,
			  startRange   : 1,
			  midRange     : 5,
			  endRange     : 1
			});
}


function loadMail(task)
{
	
	$('#titlebox').empty().append(task);
	var container = $("#mail > tbody");
	var dataTable,url;
	if(task == 'inbox')
	{
        url = "{{asset('mail/getData/inbox')}}",
		
		$('#inboxlist').addClass('active');
		$('#trashlist').removeClass('active');

		
		$('#delete_all').attr('onClick','Delete("INBOX")');	
		$('#refresh').attr('onClick','loadMail("INBOX")');	
			
    }
	else if(task == 'trash')
	{

		url = "{{asset('mail/getData/trash')}}",
		
		$('#trashlist').addClass('active');
		$('#inboxlist').removeClass('active');
		
		$('#delete_all').attr('onClick','Delete("TRASH")');	
		$('#refresh').attr('onClick','loadMail("TRASH")');
	}
	
	
	 $.ajax({
		 
			url			:	url,
			dataType 	: 	"JSON",
			beforeSend	: function(){},
			success		:	function(response)
			{
				
				console.log(response);
				
				if(response.length > 0)
				{
					
						container.empty();
						$.each(response, function(i,res){
							console.log(res);
								
								
								
							if(task == "inbox")
							{
								dataTable += '<tr class="mailbox_message '+((res.status == "unread") ? "unread" : "read")+'">';
							}
							else
							{
								dataTable += '<tr class="mailbox_message">';
							}
							
									dataTable += "<td ><input  class='hover' type='checkbox' id='case' value='"+res.id+"' ></td>";
									dataTable += '<td> From: ' +res.sender+ '</td>';
									dataTable += "<td class='hover2' title='read message'  onclick=\"GetMessage_details("+res.id+",\'"+res.message_type+"'\);\"  >" +res.subject+ "<br>" + add3Dots(res.message) + "</td>";
									dataTable += '<td>'+timeAgo(res.created_at)+'</td>';
								dataTable += '</tr>';
							
			
				
							
			
						});
						
				}
				else
				{
					dataTable += '<tr>';
					dataTable += '<td colspan="10" ><center>No message available</center></td>';	
					dataTable += '</tr>';
				}	

					container.empty().hide().append(dataTable).animate({ opacity: "show" }, "slow"); // append student data display on table
					
					jpages();
		
			}
			
	}); 
			
}



function GetMessage_details(id,message_type)
{	
	
	
	window.location.href = "{{asset('mail/getData/message/view/id')}}/"+id+"/type/"+message_type;
}



</script>


<script>

function add3Dots(string)
{
  var dots = "  ........  ";
  var limit  = 100;
  if(string.length > limit)
  {
    // you can also use substr instead of substring
    string = string.substring(0,limit) + dots;
  }

    return string;
}



function removeDuplicates(num) 
{
	
  var x,
      len=num.length,
      out=[],
      obj={};
 
  for (x=0; x<len; x++) {
    obj[num[x]]=0;
  }
  for (x in obj) {
    out.push(x);
  }
  return out;

} 
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
