<div class="modal fade" id="type{{$data['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Name  : {{$data['name']}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form  method="post" action="{{route('category.change',$data['id'])}}">@csrf

       <div class="modal-body">

         <div class="form-group mb-4">
          <label>Item Type</label>
          <select class="form-control" name="type" id="type">
            <option value="">---Select any option---</option>
            <option value="Popular" {{$data->type == 'Popular' ? 'selected' : ''}}>Popular</option>
            <option value="Latest" {{$data->type == 'Latest' ? 'selected' : ''}}>Latest</option>
            <option value="Upcomming" {{$data->type == 'Upcomming' ? 'selected' : ''}}>Uncomming</option>
            <option value="Top Item" {{$data->type == 'Top Item' ? 'selected' : ''}}>Top Item</option>

          </select>
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

