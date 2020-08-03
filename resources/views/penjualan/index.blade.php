@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Penjualan')])

@section('content')
<link href="{{ asset('material') }}/css/tabel.css" rel="stylesheet" />
<div class="content">
  <div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
		<div class="card">
		<div class="card-header card-header-primary">
			<h4 class="card-title ">Penjualan
				<div class="float-sm-right form-group">
				 <input type="text" name="serach" id="serach" class="form-control" />
				</div>
      </h4>
			<p class="card-category"> Pak Joko</p>
		  </div>
		  <div class="card-body ">
			<div class="table-responsive-sm tableFixHead">
			  <table class="table ">
					<thead class=" text-primary">
						<th class="sorting" data-sorting_type="asc" data-column_name="nobukti" style="cursor: pointer" scope="col">NOMOR<span id="nobukti_icon"></span></th>
						<th class="sorting" data-sorting_type="desc" data-column_name="tanggal" style="cursor: pointer"scope="col">TANGGAL<span id="tanggal_icon"></span></th>
						<th class="sorting" data-sorting_type="asc" data-column_name="customer" style="cursor: pointer"scope="col">CUSTOMER<span id="customer_icon"></th>
						<th scope="col">NILAI</th>
						<th scope="col">BAYAR</th>
						<th scope="col">KREDIT</th>
						<th scope="col">Pt. NOTA</th>
						<th scope="col">TITIP</th>
						<th scope="col">SALDO</th>
						<th scope="col">TINDAKAN</th>
					</thead>
					<tbody id="bodyjual">
					@include('penjualan.data')
					</tbody>
				</table>
			  <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
				<input type="hidden" name="hidden_perpage" id="hidden_perpage" value="20" />
				<input type="hidden" name="hidden_column_name" id="hidden_column_name" value="tanggal" />
				<input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
			</div>
			{!! $data->links() !!}
		  </div>
		</div>
	  </div>
	  
	</div>
  </div>
</div>
@endsection
@section('scripts')
  @parent
<script type="text/javascript">
  function myFunction() {
	 alert("I am an alert box!");
	}
	
$(document).ready(function(){
	function clear_icon(){
		$('#kode_icon').html('');
		$('#akun_icon').html('');
	}
	function fetch_data(page, sort_type, sort_by, query){
		$.ajax({
			url:"/penjualan/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
			success:function(data){
				$('#bodyjual').html('');
				$('#bodyjual').html(data);
			}
		})
	}
	$(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
	var page = $('#hidden_page').val();
	
  fetch_data(page, sort_type, column_name, query);
 });
	$(document).on('click', '.sorting', function(){
		var column_name = $(this).data('column_name');
		var order_type = $(this).data('sorting_type');
		var reverse_order = '';
		
		if(order_type == 'asc'){
			$(this).data('sorting_type', 'desc');
			reverse_order = 'desc';
			clear_icon();
			$('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
		}
		if(order_type == 'desc'){
			$(this).data('sorting_type', 'asc');
			reverse_order = 'asc';
			clear_icon();
			$('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
		}
		
		$('#hidden_column_name').val(column_name);
		$('#hidden_sort_type').val(reverse_order);
		var page = $('#hidden_page').val();
		var query = $('#serach').val();
		
		fetch_data(page, reverse_order, column_name, query);
	});

	$(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });

});	
      </script>
@stop