@extends('admin_panel/partial.master')
@section('stylesheets')
<link rel="stylesheet" href="{{  asset('admin_panel/plugins/select2/css/select2.min.css') }}">
 <style>
   .error{
     color:red;
     font-style: italic;
   }
   </style>
@endsection
@section('content')


  <div class="col-md-12">
        <div class="card">
           <div class="card-header">
             <h3 class="card-title">Add Supplier</h3>
           </div>
            <div class="card-body">
              @if(Session::has('message'))
                  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
              @endif
              <form action="{{ url('admin/add_supplier') }}" method="post" id="form_validation" enctype="multipart/form-data">
                        @csrf

                     <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail2">Name</label>
                         <input type="text" name="name" required class="form-control"  value="{{old('name')}}"  >
                          @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                    </div>
                     <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Whats app Number</label>
                        <input type="number" name="mobile" required class="form-control"  value="{{ old('mobile') }}">
                        @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                     </div> -->
                     <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control"  value="{{ old('email') }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                     </div> -->

                     <div class="col-md-6">
                                <div class="form-group">
                                    <label>Services</label>
                                <select class="select2" name="services[]" required multiple="multiple" data-placeholder="services" style="width: 100%;">
                                @foreach($services as $value)
                                <option value="{{ $value->id }}"  >{{ $value->name }}</option>
                                @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail2">Category</label>
                                <select name="category" class="form-control" required>
                                    <option value="">--Select Category--</option>
                                @foreach($categories as $row)

                                @if (old('category') == $row->id)
                                <option value="{{ $row->id }}" selected>{{ $row->name  }}</option>
                                @else
                                <option value="{{ $row->id }}">{{ $row->name  }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" required accept="image/*" class="form-control" >
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <div class="form-check">
                                        <input type="checkbox" name="is_free" value="1" class="form-check-input is_free" >
                                        <label class="form-check-label" for="exampleCheck2">Is Free</label>
                                      </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group display">
                                <label >Amount</label>
                                <input type="number"  required name="amount" class="form-control validity_in_days"  min="0" value="{{ old('amount') }}">
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                         </div>
                     </div>
                    <div  id="dynamic_field">
                     <div class="row">
                          <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="exampleInputEmail2">Supplier Name</label>
                                      <input type="text" name="supplier_name[]" required class="form-control"  value="{{old('supplier_name')}}"  >
                                        @error('supplier_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                   </div>
                          </div>
                          <div class="col-md-5">
                             <div class="form-group">
                               <label for="exampleInputEmail1">Whats app Number</label>
                               <input type="number" name="mobile[]" required class="form-control"  value="{{ old('mobile') }}">
                               @error('mobile')
                               <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                              </div>
                            </div>
                          <div class="col-md-2">
                                  <div class="form-group">
                                      <button type="button"  id="add" class="btn btn-success">+</button>
                                    </div>
                          </div>

                     </div>
                    </div>

                    <!-- <div class="col-md-6 ">
                            <div class="form-group display_total_price">
                                <label for="exampleInputEmail1">Total price</label>
                                <input type="number"  required name="total_price" class="form-control display_total_price"  min="1" value="{{ old('total_price') }}">
                                @error('total_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                      </div> -->
                       <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                      <div class="form-check">
                                        <input type="checkbox" name="is_lifetime_access" value="1" class="form-check-input is_lifetime_access" >
                                        <label class="form-check-label" for="exampleCheck2">Is Lifetime Access</label>
                                      </div>
                                    </div>
                                </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group display">
                                <label >Validity In days</label>
                                <input type="number"  required name="validity_in_days" class="form-control validity_in_days"  min="1" value="{{ old('validity_in_days') }}">
                                @error('validity_in_days')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                         </div> -->
                        <!-- <div class="col-md-6">
                           <div class="form-group">
                          <label >Supplier Images(max 5)</label>
                          <input type="file" multiple="multiple" name="mul_images[]" class="form-control">
                           </div>
                        </div> -->
                       <div class="col-md-6">
                       </div>

                            <!-- </div> -->
                            <button type="submit" class="btn btn-primary btn-sm">Create</button>
              </div>
                        </div>
        </div>
              <!-- /.card -->
                </form>
           </div>

        </div>
              </div>


@endsection
@section('scripts')
<script src="{{ asset('admin_panel/dist/js/validate.js') }}"></script>
<script src="{{ asset('admin_panel/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    var i=1;
     $('.select2').select2()
      $('.is_free').click(function(){
            if($(this).prop("checked") == true){
               $('.display_total_price').prop('disabled',true);
            }
            else if($(this).prop("checked") == false){
                $('.display_total_price').prop('disabled',false);

            }
        });
      $('.is_lifetime_access').click(function(){
            if($(this).prop("checked") == true){
               $('.validity_in_days').prop('disabled',true);
            }
            else if($(this).prop("checked") == false){
                $('.validity_in_days').prop('disabled',false);

            }
        });

// $("#form_validation").validate()
$('#add').click(function(){

 i++;
var data=`<div class="row" id="row${i}">
                          <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="exampleInputEmail2">Supplier Name</label>
                                      <input type="text" name="supplier_name[]" required class="form-control"  value="{{old('supplier_name')}}"  >
                                        @error('supplier_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                   </div>
                          </div>
                          <div class="col-md-5">
                             <div class="form-group">
                               <label for="exampleInputEmail1">Whats app Number</label>
                               <input type="number" name="mobile[]" required class="form-control"  value="{{ old('mobile') }}">
                               @error('mobile')
                               <div class="alert alert-danger">{{ $message }}</div>
                               @enderror
                              </div>
                            </div>
                          <div class="col-md-2">
                                  <div class="form-group">
                                      <button type="button" id="${i}" class="btn btn-danger btn_remove">-</button>
                                    </div>
                          </div>

              </div>`;


               $('#dynamic_field').append(data);
});

$(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
  console.log(button_id);
      $('#row'+button_id+'').remove();
});
 });
</script>

@endsection
