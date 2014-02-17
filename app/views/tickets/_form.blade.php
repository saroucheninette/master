<div class="panel-body">
        <div class="panel">
            <div class="panel-heading">
              
              <ul class="nav panel-tabs">
                {{ Form::Tab(trans('messages.basic'),1,$errors, 
                            array(  'Name',
                                    'DateStart',
                                    'DateEnd',
                                    'Status_id',
                                    'Environments_id',
                                    'Impacts_id',
                                    'Categories_id',
                                    'TicketTypes_id',
                                    'IsActive',
                                    'IsPublic',
                                    'DescriptionHtml'
                                    ),
                            'active');}}
                {{ Form::Tab(trans('ticket.reproduction'),2,$errors);}}
                {{ Form::Tab(trans('ticket.resolution'),3,$errors);}}
                {{ Form::Tab(trans('messages.optional'),4,$errors);}}
              </ul>
            </div>
             <div class="panel-body">
              <div class="tab-content padding-none border-none">
                  <div id="tab1" class="tab-pane active">
                     <div class="input-group">{{ Form::TextBox(trans('model.name'),'Name',$errors);}}</div>
                     <div class="input-group"> 
                      {{ Form::TextBox(trans('ticket.datestart'),'DateStart',$errors,'150px;');}}
                      {{ Form::TextBox(trans('ticket.dateend'),'DateEnd',$errors,'150px;');}}
                       {{ Form::SelectModel(trans('ticket.status'),'Status_id',new \App\Models\TicketStatus(),$errors,'NEW');}}
                     </div>
                      <div class="input-group">
                     
                      {{ Form::SelectModel(trans('ticket.environment'),'Environments_id',new \App\Models\TicketEnvironments(),$errors);}}
                     
                       </div>  
                      <div class="input-group"> 
                           {{ Form::SelectModel(trans('ticket.category'),'Categories_id',new \App\Models\TicketCategories(),$errors);}}
                           {{ Form::SelectModel(trans('ticket.impact'),'Impacts_id',new \App\Models\TicketImpacts(),$errors);}}
                      </div>
                      <div class="input-group">
                      {{ Form::SelectModel(trans('ticket.tickettype'),'TicketTypes_id',new \App\Models\TicketTypes(),$errors);}}
                      {{ Form::SelectModel(trans('model.active'),'IsActive','YesNo',$errors,1,'80px');}} 
                      {{ Form::SelectModel(trans('model.public'),'IsPublic','YesNo',$errors,1,'80px');}} 
                      </div>
                      {{ Form::RichTextBox(trans('model.desc'),'DescriptionHtml',$errors,$ticket->DescriptionHtml);}}
                      {{ Form::HiddenBox('DescriptionText',$ticket->DescriptionText) }}
                  </div>
                  <div id="tab2" class="tab-pane">
                      {{ Form::RichTextBox(trans('ticket.reproduction'),'ReproductionHtml',$errors,$ticket->ReproductionText)}}
                      {{ Form::HiddenBox('ReproductionText',$ticket->ReproductionText) }}
                  </div>
                  <div id="tab3" class="tab-pane">
                      {{ Form::RichTextBox(trans('ticket.resolution'),'ResolutionHtml',$errors,$ticket->ResolutionText)}}
                      {{ Form::HiddenBox('ResolutionText',$ticket->ResolutionText) }}
                  </div>
                   <div id="tab4" class="tab-pane">
                       <div class="form_element">
                      {{ Form::SelectModel(trans('ticket.priority'),'Priorities_id',new \App\Models\TicketPriorities(),$errors);}}
                      {{ Form::SelectModel(trans('ticket.rollback'),'RollbackStates_id',new \App\Models\TicketRollbackstates(),$errors);}}
                      </div>
                           
                   </div>
              </div>
                 
             </div>
        </div>
</div>
