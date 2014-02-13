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
              <table class="display tbl_details dataTable" id="datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('ticket.tickettype') }}</th>
                    <th>{{ trans('model.name') }}</th>
                    <th>{{ trans('model.desc') }}</th>
                    <th>{{ trans('ticket.datestart') }}</th>
                    <th>{{ trans('ticket.dateend') }}</th>
                    <th>{{ trans('model.creator') }}</th>
                    <th>{{ trans('ticket.category') }}</th>
                    <th>{{ trans('messages.action') }}</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($tickets as $t)
                  <tr class="gradeA">
                    <td>{{ $t->Tickets_id }}</td>
                    <td>{{ $t->TicketType() }}</td>
                    <td>{{ $t->Name }}</td>
                    <td>{{ substr($t->DescriptionText,0,50).'...' }}</td>
                    <td>{{ $t->getDate($t->DateStart) }}</td>
                    <td>{{ $t->getDate($t->DateEnd) }}</td>
                    <td>{{ $t->getUser($t->Users_id_created) }}</td>
                    <td>{{ $t->Category() }}</td>
                    
                     <td class="center">
                           @if(Perm::CanModify('ticket'))
                           <span><a href="{{URL::route('tickets.edit',$t->Tickets_id)}}" class="action-icons c-edit" original-title="{{ trans('messages.edit')}}">{{ trans('messages.edit')}}</a></span>
                           @endif
                           @if(Perm::CanRead('ticket'))
                          <span><a href="{{URL::route('tickets.show',$t->Tickets_id)}}" class="action-icons c-show" href="#" original-title="{{ trans('messages.show')}}">{{ trans('messages.show')}}</a></span>
                          @endif
                          @if(Perm::CanDelete('ticket'))
                          <span><a href="{{URL::route('tickets.destroy',$t->Tickets_id)}}" class="action-icons c-delete" href="#" original-title="{{ trans('messages.delete')}}">{{ trans('messages.delete')}}</a></span>
                          @endif
                    </td>
                 
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
@stop

@section('jscode')
<script type="text/javascript">
    datatable('datatable');
     /*$('#datatable').dataTable( {
	"aoColumnDefs": [{ 'bSortable': true, 'aTargets': [ -1 ] }],
	"oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
	"iDisplayLength": 5,
	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
	"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
  });	*/
 

</script>
@stop