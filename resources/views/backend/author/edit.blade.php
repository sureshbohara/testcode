<div class="modal fade" id="author{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Author Name  : {{$data['name']}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateStore" action="{{ route('author.update', $data['id']) }}" method="post" enctype="multipart/form-data">
@csrf
 @method('PUT')

       <div class="modal-body">
         <div class="row">
            <div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Name</label>
    <input type="text" name="name" class="form-control rounded-0" value="{{$data['name']}}" />
</div>

<div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Email</label>
    <input type="email" name="email" class="form-control rounded-0" value="{{$data['email']}}" />
</div>


<div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Address</label>
    <input type="text" name="address" class="form-control rounded-0" value="{{$data['address']}}" />
</div>

<div class="form-group col-lg-6 col-12 mb-4">
    <label>Preview Profile</label>
     <img src="{{ $data->image ? asset('images/'.$data->image) : asset('noimage.png') }}" alt="{{$data['name']}}" class="img-fluid" id="img">
</div>
<div class="form-group col-lg-12 col-12 mb-4">
    <label>Author Profile</label>
    <input type="file" name="image" class="form-control rounded-0" id="input" />
</div>

<div class="form-group col-lg-12">
    <label>Content</label>
    <textarea name="content" class="form-control rounded-0 editor">{!! $data['content'] !!}</textarea>
</div>
         </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

