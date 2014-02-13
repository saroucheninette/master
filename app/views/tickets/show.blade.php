@extends('layouts.master')
@section('jsplugins')
     <script type="text/javascript" src="{{ URL::asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
@stop
@section('topbar')
    <li> <a href="{{URL::to('tickets')}}" >{{ trans('menu.tickets')}}</a></li>
    <li class="active">{{ trans('messages.show')}}</li>
@stop
@section('content')
<div class="panel">
    <div class="panel-heading">
       <div class="panel-title"> <i class="fa fa-search"></i> {{ trans('ticket.show_ticket')}} : #{{$ticket->Tickets_id}}</div>
    </div>
    <div class="panel-body">
        <div class="panel">
            <div class="panel-heading">
                  <ul class="nav panel-tabs">
                    {{ Form::Tab(trans('messages.basic'),1,$errors);}}
                    {{ Form::Tab(trans('ticket.reproduction'),2,$errors);}}
                    {{ Form::Tab(trans('ticket.resolution'),3,$errors);}}
                    {{ Form::Tab(trans('messages.history'),4,$errors);}}
                  </ul>
           </div>
             <div class="panel-body">
                 <div class="tab-content padding-none border-none">
                     <div id="tab1" class="tab-pane active">
                         {{ Form::LabelBox(trans('model.name'),$ticket->Name) }} <br/>
                         {{ Form::LabelBox(trans('model.desc'),null) }}
                         <textarea name="DescriptionHtml">{{ $ticket->DescriptionHtml }}</textarea>
                       
                     </div>
                     <div id="tab2" class="tab-pane">
                         la
                     </div>
                     <div id="tab3" class="tab-pane">
                         la
                     </div>
                     <div id="tab4" class="tab-pane">
                         la
                     </div>
                     
                 </div>
             </div>
       </div>
    </div>
</div>
@stop


@section('jscode')
     <script type='text/javascript'>
            ro_richtextbox('DescriptionHtml');
     </script>
@stop