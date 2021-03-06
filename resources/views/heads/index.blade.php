@extends('admin')
@section('content')
<div id="ribbon">

	<span class="ribbon-button-alignment"> 
		<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
			<i class="fa fa-refresh"></i>
		</span> 
	</span>

	<!-- breadcrumb -->
	<ol class="breadcrumb">
		<li>Setup</li><li>Subhead</li>
	</ol>
	<!-- end breadcrumb -->

	<!-- You can also add more buttons to the
	ribbon for further usability

	Example below:

	<span class="ribbon-button-alignment pull-right">
	<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
	<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
	<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
</span> -->

</div>
<!-- MAIN CONTENT -->
<div id="content">

	<div class="row">
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa fa-table fa-fw "></i> 
				Setup
				<span>> 
					Revenue Heads
				</span>
			</h1>
		</div>

		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			<!-- Button trigger modal -->
			<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-md header-btn hidden-mobile"><span class="glyphicon glyphicon-plus"></span> Add Head</a>
			&nbsp;&nbsp;&nbsp;
			<a data-toggle="modal" href="#myModal2" class="btn btn-primary btn-md header-btn hidden-mobile"><span class="glyphicon glyphicon-plus"></span> Add Subhead</a>
		</div>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title">
						<!-- <img src="{{ asset('template/img/logo1.png')}}" width="150" alt="SmartAdmin"> -->
					</h4>
				</div>
				<div class="modal-body no-padding">
				<form id="login-form" method="POST" action="/add_heads" class="smart-form">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<fieldset>
							
							<section>
								<div class="row">
									<label class="label col col-2">Revenue Name</label>
									<div class="col col-10">
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="revenue_name">
										</label>
									</div>
								</div>
							</section>

							<section>
								<div class="row">
									<label class="label col col-2">Revenue Code</label>
									<div class="col col-10">
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="revenue_code">
										</label>
									</div>
								</div>
							</section>

							<section>
								<div class="row">
									<label class="label col col-2">Amount</label>
									<div class="col col-10">
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="amount">
										</label>
									</div>
								</div>
							</section>
							
							
							<section>
								<div class="row">
									<label class="label col col-2">MDA</label>
									<div class="col col-10">
										<label class="input">
											<select class="form-control" name="mda_id" >

												<option value="">Select MDA</option>
												@if(isset($igr->mdas))
													@foreach($igr->mdas as $mda)
												<option value="{{$mda->id}}">{{$mda->mda_name}}</option>
													@endforeach
												@else
												<option value="">NO MDA</option>
												@endif
												
											</select>	
										</label>
									</div>
								</div>
							</section>

							<section>
								<div class="row">
							
								<label class="label col col-2">Tax</label>
								<div class="col-md-10">
								<label class="input">
									<div class="radio">
										<label>
											<input type="radio" class="radiobox" value="1" name="taxiable">
											<span>Yes</span> 
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" class="radiobox" checked="checked" value="0" name="taxiable">
											<span>No</span> 
										</label>
									</div>
								</label>
							</div>
							</div>
							</section>

							
							
						</fieldset>
						
						<footer>
							<button type="submit" class="btn btn-primary">
								ADD
							</button>

						</footer>
					</form>						
						

					</div>

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->



		<!-- Modal -->
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">
							<!-- <img src="{{ asset('template/img/logo1.png')}}" width="150" alt="SmartAdmin"> -->
						</h4>
					</div>
					<div class="modal-body no-padding">
					<form id="login-form" method="POST" action="/add_subhead" class="smart-form">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
								
								<section>
									<div class="row">
										<label class="label col col-2">Subhead Name</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" name="subhead_name">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Subhead Code</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" name="subhead_code">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Amount</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" name="amount">
											</label>
										</div>
									</div>
								</section>


								<section>
									<div class="row">
										<label class="label col col-2">Select MDA</label>
										<div class="col col-10">
											<label class="input">
												<select class="form-control" name="mda_id" id="mda2" >

													<option value="">Select MDA</option>
													@if(isset($igr->mdas))
														@foreach($igr->mdas as $mda)
															
													<option value="{{$mda->id}}">{{$mda->mda_name}}</option>
															
														@endforeach
													@else
													<option value="">NO MDA</option>
													@endif
													
												</select>	
											</label>
										</div>
									</div>
								</section>
								
								
								<section>
									<div class="row">
										<label class="label col col-2">Revenue Heads</label>
										<div class="col col-10">
											<label class="input">
												<select class="form-control" name="revenuehead_id" id="heads" >

													<option value="">Select Revenue Head</option>
													
												</select>	
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Gov %</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" name="gov">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Agency %</label>
										<div class="col col-10">
											<label class="input"> <i class="icon-append fa fa-user"></i>
												<input type="text" name="gency">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
								
									<label class="label col col-2">Tax</label>
									<div class="col-md-10">
									<label class="input">
										<div class="radio">
											<label>
												<input type="radio" class="radiobox" value="1" name="taxiable">
												<span>Yes</span> 
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" class="radiobox" checked="checked" value="0" name="taxiable">
												<span>No</span> 
											</label>
										</div>
									</label>
								</div>
								</div>
								</section>

								
								
							</fieldset>
							
							<footer>
								<button type="submit" class="btn btn-primary">
									ADD
								</button>

							</footer>
						</form>						
							

						</div>

					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->



		<br />
		<br />

		<div class="row">
			<div class="col-md-12">
			<form method="post" action="/revenue_heads" >

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="col-sm-3">
					<div class="form-group">
						<select name="station" class="form-control" onchange="this.form.submit()" id="mda">
							<option value="">Select MDA</option>
							@if(isset($igr->mdas))
								@foreach($igr->mdas as $mda)
							<option value="{{$mda->id}}">{{$mda->mda_name}}</option>
								@endforeach
							@endif
						</select>						
					</div>
					

				</div>
			</form>	
		</div>
		</div>







		<!-- widget grid -->
		<section id="widget-grid" class="">

			<!-- row -->
			<div class="row">
				
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				@include('include.warning')
				@include('include.message')
				@include('include.error')

					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
								<!-- widget options:
								usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
								data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
							-->
							
							<!-- end widget -->
							
					

							<header>
								<span class="widget-icon"> <i class="fa fa-table"></i> </span>
								<h2>LIST OF REVENUE HEADS</h2>

							</header>

							<!-- widget div-->
							<div>

								<!-- widget edit box -->
								<div class="jarviswidget-editbox">
									<!-- This area used as dropdown edit box -->

								</div>
								<!-- end widget edit box -->

								<!-- widget content -->
								<div class="widget-body no-padding">

								<table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%">
										<thead>
											<tr>
												<th data-hide="phone">HEAD CODE</th>
												<th data-hide="phone,tablet">HEAD</th>
												<th>SUBHEAD CODE</th>
												<th>SUBHEAD</th>
												<th>AMOUNT</th>
												<th>GOV %</th>
												<th>AGENCY %</th>
												<th data-hide="phone,tablet"> ACTION</th>
												
											</tr>
										</thead>
										<tbody>
										@if(isset($heads))
											@foreach($heads as $heads)
											<tr>
												<td>{{$heads->heads_imei}}</td>
												<td>{{$heads->name}}</td>
												<td>{{$heads->mda->mda_name}}</td>
												<td>{{$heads->activation_code}}</td>
												<td>{{$heads->amount}}</td>
												<td>{{$heads->gov}}</td>
												<td>{{$heads->agency}}</td>
												
											<td> <a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a> &nbsp;&nbsp;<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
												
											</tr>
											@endforeach
										@endif

										</tbody>
									</table>

								</div>
								<!-- end widget content -->

							</div>
							<!-- end widget div -->

						</div>
						<!-- end widget -->

					</article>
					<!-- WIDGET END -->
					</div>
				</div>
				
				<!-- end row -->
				
				<!-- end row -->
				
			</section>
			<!-- end widget grid -->

		</div>
		<!-- END MAIN CONTENT -->

		@stop
		@push('scripts')
		<script type="text/javascript">
			$("#mda").select2({
			  placeholder: "Select MDA",
			});

			$("#lga").select2({
			  placeholder: "Select LGA",
			});
		</script>

		<script>

		    $('#mda2').change(function(){
		        $.get("{{ url('/list_heads')}}", 
		        { option: $(this).val() }, 
		        function(data) {
		            $('#heads').empty(); 
		            $.each(data, function(key, element) {
		                $('#heads').append("<option value='" + key +"'>" + element + "</option>");
		            });
		        });
		    });

		</script>

		<script type="text/javascript">

	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	
	$(document).ready(function() {
		
		pageSetUp();
		
		/* // DOM Position key index //
	
		l - Length changing (dropdown)
		f - Filtering input (search)
		t - The Table! (datatable)
		i - Information (records)
		p - Pagination (paging)
		r - pRocessing 
		< and > - div elements
		<"#id" and > - div with an id
		<"class" and > - div with a class
		<"#id.class" and > - div with an id and class
		
		Also see: http://legacy.datatables.net/usage/features
		*/	

		/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"oLanguage": {
				"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},
			"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_dt_basic) {
						responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_dt_basic.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_dt_basic.respond();
				}
			});

		/* END BASIC */
		
		/* COLUMN FILTER  */
		var otable = $('#datatable_fixed_column').DataTable({
	    	//"bFilter": false,
	    	//"bInfo": false,
	    	//"bLengthChange": false
	    	//"bAutoWidth": false,
	    	//"bPaginate": false,
	    	//"bStateSave": true // saves sort state using localStorage
	    	"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
	    	"t"+
	    	"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
	    	"autoWidth" : true,
	    	"oLanguage": {
	    		"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
	    	},
	    	"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}		

		});

	    // custom toolbar
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

	    // Apply the filter
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
	    	
	    	otable
	    	.column( $(this).parent().index()+':visible' )
	    	.search( this.value )
	    	.draw();

	    } );
	    /* END COLUMN FILTER */   

	    /* COLUMN SHOW - HIDE */
	    $('#datatable_col_reorder').dataTable({
	    	"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
	    	"t"+
	    	"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
	    	"autoWidth" : true,
	    	"oLanguage": {
	    		"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
	    	},
	    	"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_col_reorder) {
					responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_col_reorder.respond();
			}			
		});

	    /* END COLUMN SHOW - HIDE */

	    /* TABLETOOLS */
	    $('#datatable_tabletools').dataTable({

			// Tabletools options: 
			//   https://datatables.net/extensions/tabletools/button_options
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
			"oLanguage": {
				"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
			},		
			"oTableTools": {
				"aButtons": [
				"copy",
				"csv",
				"xls",
				{
					"sExtends": "pdf",
					"sTitle": "SmartAdmin_PDF",
					"sPdfMessage": "SmartAdmin PDF Export",
					"sPdfSize": "letter"
				},
				{
					"sExtends": "print",
					"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
				}
				],
				"sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
			},
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_tabletools) {
					responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_tabletools.respond();
			}
		});

	    /* END TABLETOOLS */

	})

</script>

<!-- Your GOOGLE ANALYTICS CODE Below -->
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
</script>
@endpush
