@extends('admin.layout.main')

@section('content')

<h2>Product</h2>
<!-- Default Modals -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">create product</button>
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">create product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('product_create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Enter shop name">
                      </div>
                      
                      <div class="form-group">
                        
                        <label for="exampleFormControlSelect1">Select Shop</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="shop_id">
                            @foreach ($shop as $shop)
                          <option value="{{$shop->id}}">{{$shop->name}}</option>
                          @endforeach
                        </select>
                        
                      </div> 
                     
                      
                        <div class="form-group mt-3">
                          <label for="formGroupExampleInput">Website link</label>
                          <input type="text" name="website" class="form-control" id="formGroupExampleInput" placeholder="Enter sub title">
                        </div>
                      <div class="form-group mt-3">
                        <label for="formGroupExampleInput2">Text</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="form-group mt-3">
                          <label for="formGroupExampleInput2">Logo</label>
                          <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Save</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  {{-- table starts --}}
  <div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead class="table-light">
            <tr>
                
                
                <th scope="col">Name</th>
                <th scope="col">Website URL</th>
                <th scope="col">Text</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $product)
            <tr>
               
               <td>{{$product->name}}</td>
               <td>{{$product->website}}</td>
               <td>{{$product->description}}</td>
               <td><img height="100" width="100" src="{{ asset($product->image) }}"></td>
               <td>
                <a class="btn btn-warning" href="{{url('/product_edit',$product->id)}}"><i class="bx bx-bx bxs-pencil"></i></a>
                <a class="btn btn-danger" href="{{ url('/product_delete',$product->id) }}"><i class="bx bx-bx bxs-trash"></i></a>
                   
               </td>
            </tr>
               @endforeach
                

        </tbody>
        <tfoot class="table-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Website URL</th>
                <th scope="col">Text</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </tfoot>
    </table>
    <!-- end table -->
  
</div>
<!-- end table responsive -->
  {{-- table ends --}}
@endsection