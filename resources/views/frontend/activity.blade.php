@extends('frontend.layouts.main')

@section('content')

<style>
.custom_box
{
		border: 1px solid #abaaaa;
	      border-radius: 1px !important;
}

</style>




<!-- Main content -->
<section class="content">
<!-- Main row -->
<div class="row">



<!-- Main Box-->
	<div class="box box-widget custom_box">
		<div class="box-header with-border">
		  <h1 class="box-title">
			<span  style="padding-right:20px"><i class="fa fa-fw fa-list-alt"></i>Activity Lists</span>
		  </h1>	
		</div>
		<br>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="activitylist"  class="table  table-hover table-striped" cellspacing="0" width="100%">
				<thead>
				<tr>
				  <th>Activity</th>
				  <th>Date</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- /.box-body -->
    </div>
	
		  
</div>
<!-- /.row (main row) -->
</section>


<script>
$(document).ready(function(){
	
activitylist();

});

var activitylist;

function activitylist()
{
	
activitylist =  $('#activitylist').DataTable({ 

	"processing": true, //Feature control the processing indicator.
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": "{{asset('GetUserActivities')}}",
		"type": "GET",
	},
	"bDestroy": true,
	"columns"    : [
	{'data': 'activity_info'},
	{'data': 'date_task'},
	],
	"fnRowCallback": function( nRow, aData, iDisplayIndex) {
	$(nRow).attr("id",aData['id']);
	return nRow;
	},

}); 

}


function reload_table()
{
    activitylist.ajax.reload(null,false); //reload datatable ajax 
}


</script>
@endsection
