<div class="box box-info padding-1">
    <div class="box-body ">
       <div class="row">
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Client Name</label>
                   <input type="text" name="client_name" placeholder="Client Name" value="{{$receipt->client_name}}" class="form-control" required>

               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Client Phone</label>
                   <input type="text" name="client_phone" placeholder="Client Phone" value="{{$receipt->client_phone}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Client Email</label>
                   <input type="email" name="client_email" placeholder="Client Email" value="{{$receipt->client_email}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Property</label>
                   <select name="estate_name" class="form-control" required>
                       <option value="">--Select Property--</option>
                       @foreach($properties as $property)
                           <option value="{{$property->name}}">{{$property->name}}</option>
                           @endforeach
                   </select>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Payment Type</label>
                   <input type="text" name="payment_type" placeholder="e.g Transfer" value="{{$receipt->payment_type}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Number of Properties</label>
                   <input type="text" name="number" placeholder="Number" value="{{$receipt->number}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Payment Plan</label>
                   <input type="text" name="payment_plan" placeholder="eg. Monthly" value="{{$receipt->payment_plan}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for=""> Senders Bank </label>
                   <input type="text" name="bank" placeholder="Bank" value="{{$receipt->bank}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Senders Name</label>
                   <input type="text" name="account_name" placeholder="Account Name" value="{{$receipt->account_name}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Amount Paid</label>
                   <input type="text" name="amount" placeholder="Amount" value="{{$receipt->amount}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Payment Date</label>
                   <input type="text" name="payment_date" placeholder="Date of Payment" value="{{$receipt->payment_date}}" class="form-control" required>
               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Description</label>
                   <textarea class="form-control" required name="description" rows="3" placeholder="Enter description">{{$receipt->description}}</textarea>

               </div>
           </div>
           <div class="col-md-6">
               <div class="form-group">
                   <label for="">Image</label>
                   <div class="custom-file">
                       <input type="file" name="file" class="custom-file-input" id="customFile">
                       <label class="custom-file-label" for="customFile">Upload Image</label>
                   </div>
               </div>
           </div>
       </div>
        <div class="form-group">
           <input type="hidden" value="{{session('user')->id}}" name="user_id">
        </div>














    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
