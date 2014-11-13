@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.settings') }}} ::
@parent
@stop

{{-- New Laravel 4 Feature in use --}}
@section('styles')
@parent
body {
background: #f2f2f2;
}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h3>My Rss Feeds
        <div class="pull-right">
            <a href="{{{ URL::to('rssfeed/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
        </div>
    </h3>

</div>
<table id="myfeeds" class="table table-striped table-hover">
    <thead>
    <tr>
        <th class="col-md-1">#</th>
        <th class="col-md-4">Title</th>
        <th class="col-md-5">Feed Url</th>
        <th class="col-md-2">
            <a href="#" class="btn btn-success">
                <i class="fa fa-edit"></i>
                Add
            </a>
        </th>
    </tr>
    </thead>
</table>

@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        oTable = $('#myfeeds').dataTable( {
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::to('rssfeed/data') }}",
            "fnDrawCallback": function ( oSettings ) {
                $(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
            }
        });
    });
</script>
@stop