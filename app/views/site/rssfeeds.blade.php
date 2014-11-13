@extends('site.layouts.angular')

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
    <h3>Our Rss Feeds</h3>

</div>
@include( 'site/rss' )
@stop