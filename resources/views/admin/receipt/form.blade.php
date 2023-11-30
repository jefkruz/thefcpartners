<div class="box box-info padding-1">
    <div class="box-body ">
       <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('client_name') }}
                   {{ Form::text('client_name', $receipt->client_name, ['class' => 'form-control' . ($errors->has('client_name') ? ' is-invalid' : ''), 'placeholder' => 'Client Name']) }}
                   {!! $errors->first('client_name', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('client_phone') }}
                   {{ Form::text('client_phone', $receipt->client_phone, ['class' => 'form-control' . ($errors->has('client_phone') ? ' is-invalid' : ''), 'placeholder' => 'Client Phone']) }}
                   {!! $errors->first('client_phone', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('client_email') }}
                   {{ Form::email('client_email', $receipt->client_email, ['class' => 'form-control' . ($errors->has('client_email') ? ' is-invalid' : ''), 'placeholder' => 'Client Email']) }}
                   {!! $errors->first('client_email', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('estate_name') }}
                   {{ Form::text('estate_name', $receipt->estate_name, ['class' => 'form-control' . ($errors->has('estate_name') ? ' is-invalid' : ''), 'placeholder' => 'Estate Name']) }}
                   {!! $errors->first('estate_name', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('payment_type') }}
                   {{ Form::text('payment_type', $receipt->payment_type, ['class' => 'form-control' . ($errors->has('payment_type') ? ' is-invalid' : ''), 'placeholder' => 'eg. Transfer']) }}
                   {!! $errors->first('payment_type', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('number of properties') }}
                   {{ Form::text('number', $receipt->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'Number']) }}
                   {!! $errors->first('number', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('payment_plan') }}
                   {{ Form::text('payment_plan', $receipt->payment_plan, ['class' => 'form-control' . ($errors->has('payment_plan') ? ' is-invalid' : ''), 'placeholder' => 'eg. Monthly']) }}
                   {!! $errors->first('payment_plan', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('bank name') }}
                   {{ Form::text('bank', $receipt->bank, ['class' => 'form-control' . ($errors->has('bank') ? ' is-invalid' : ''), 'placeholder' => 'Bank']) }}
                   {!! $errors->first('bank', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('account_name') }}
                   {{ Form::text('account_name', $receipt->account_name, ['class' => 'form-control' . ($errors->has('account_name') ? ' is-invalid' : ''), 'placeholder' => 'Account Name']) }}
                   {!! $errors->first('account_name', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('amount paid') }}
                   {{ Form::text('amount', $receipt->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount']) }}
                   {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('description') }}
                   <textarea class="form-control" required name="description" rows="3" placeholder="Enter description">{{$receipt->description}}</textarea>

               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   {{ Form::label('Image') }}
                   <div class="custom-file">
                       <input type="file" name="file" class="custom-file-input" id="customFile">
                       <label class="custom-file-label" for="customFile">Upload Image</label>
                   </div>
               </div>
           </div>
       </div>
        <div class="form-group">
           <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
        </div>














    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
