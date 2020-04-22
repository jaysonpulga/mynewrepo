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
		  <h3 class="box-title">
			<span class="box-title2" style="padding-right:20px"><i class="fa fa-fw fa-list-alt"></i>Archived List</span>
		  </h3>	
		</div>
		<br>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="loadarchived"  class="table  table-hover" cellspacing="0" width="100%">
				<thead>
				<tr>

				  <th>Campaign</th>
				  <th>Product</th>
				  <th>Activity</th>
				
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
	
loadarchived();

});

var loadarchived;

function loadarchived()
{
	
loadarchived =  $('#loadarchived').DataTable({ 

	"processing": true, //Feature control the processing indicator.
	// Load data for the table's content from an Ajax source
	"ajax": {
		"url": "{{asset('GetUserArchived')}}",
		"type": "GET",
	},
	"bDestroy": true,
	"columns"    : [
	{'data': 'Title'},
	{'data': 'product_name'},
	{'data': 'activity'},

	],
	"fnRowCallback": function( nRow, aData, iDisplayIndex) {
	$(nRow).attr("id",aData['id']);
	return nRow;
	},

}); 

}


function reload_table()
{
    loadarchived.ajax.reload(null,false); //reload datatable ajax 
}


function editoffer(id)
{
	 window.location = "{{ asset('admin/editoffer/')}}/"+id;
}
</script>
@endsection
