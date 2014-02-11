@extends('layouts.master')
@section('topbar')
    <li class="active">{{ trans('menu.tickets')}}</li>
@stop
@section('content')
    <div class="panel panel-visible">
            <div class="panel-heading">
              <div class="panel-title"><i class="fa fa-table"></i>{{ trans('menu.tickets')}}</div>
              @if(Perm::Instance()->CanAdd('ticket'))
              <div style="float:right">
                 <a class="btn btn-success btn-gradient" href='{{ URL::to('/tickets/create')}}' style="font-weight: bold" alt="{{ trans('messages.add')}}"><span class="glyphicons glyphicons-circle_plus"> </span>  {{ trans('messages.add')}}</a>
              </div>
              @endif
            </div>
            <div class="panel-body">
              <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                  <tr>
                    <th>{{ trans('model.id') }}</th>
                    <th>{{ trans('ticket.tickettype') }}</th>
                    <th>{{ trans('model.name') }}</th>
                    <th>{{ trans('model.desc') }}</th>
                    <th>{{ trans('ticket.datestart') }}</th>
                    <th>{{ trans('ticket.dateend') }}</th>
                    <th>{{ trans('model.creator') }}</th>
                    <th>{{ trans('ticket.category') }}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $t)
                  <tr>
                    <td>{{ $t->Tickets_id }}</td>
                    <td>{{ $t->TicketType() }}</td>
                    <td>{{ $t->Name }}</td>
                    <td>{{ substr($t->DescriptionText,0,50).'...' }}</td>
                    <td>{{ $t->getDate($t->DateStart) }}</td>
                    <td>{{ $t->getDate($t->DateEnd) }}</td>
                    <td>{{ $t->getUser($t->Users_id_created) }}</td>
                    <td>{{ $t->Category() }}</td>
                    
                   <!-- <td class="hidden-xs text-center"><div class="btn-group">
                        <button type="button" class="btn btn-info btn-gradient"> <span class="glyphicons glyphicons-user"></span> </button>
                        <button type="button" class="btn btn-success btn-gradient"> <span class="glyphicon glyphicon-earphone"></span> </button>
                        <button type="button" class="btn btn-danger btn-gradient dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-cogwheel"></span> </button>
                        <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
                          <li><a><i class="fa fa-user"></i> View Profile </a></li>
                          <li><a><i class="fa fa-envelope-o"></i> Message </a></li>
                        </ul>
                      </div></td>-->
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
@stop

@section('jscode')
<script type="text/javascript">
     $('#datatable').dataTable( {
	"aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
	"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
	"iDisplayLength": 6,
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	"sDom": 'T<"clearfix">lfr<"clearfix">tip'
  });	
  
  //$("select[name='datatable_length']").chosen();	
  //$.fn.editable.defaults.mode = 'popup';
  //$('.xedit').editable();
</script>
@stop