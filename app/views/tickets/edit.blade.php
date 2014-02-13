@extends('layouts.master')
@section('jsplugins')
     <script type="text/javascript" src="{{ URL::asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
@stop
@section('topbar')
    <li> <a href="{{URL::to('tickets')}}" >{{ trans('menu.tickets')}}</a></li>
    <li class="active"> <a href="{{URL::to("tickets/{$ticket->Tickets_id}/edit")}}" >{{ trans('messages.modify')}}</a></li>
@stop
@section('content')
{{ Form::model($ticket, array('route' => array('tickets.update', $ticket->Tickets_id), 'method' => 'PUT')) }}
<div class="panel">
    <div class="panel-heading">
       <div class="panel-title"> <i class="fa fa-pencil"></i> {{ trans('ticket.edit_ticket')}} : #{{$ticket->Tickets_id}} </div>
       <div style="float:right">
           <input type="submit" value="{{ trans('messages.modify')}}" class="btn btn-success btn-gradient" style="font-weight: bold" />
       </div>
    </div>
    @include('tickets._form')
{{ Form::close() }}
@stop
@section('jscode')
     <script type='text/javascript'>
            richtextbox('DescriptionHtml','DescriptionText');
            richtextbox('ReproductionHtml','ReproductionText');
            richtextbox('ResolutionHtml','ResolutionText');
            datebox('DateStart');
            datebox('DateEnd');
     </script>
@stop