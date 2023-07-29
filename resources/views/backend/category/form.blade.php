<form id="categoryStore" enctype="multipart/form-data">@csrf
<div class="card-body">
<div class="row">
   <div class="col-md-8 col-12">
       <div class="row">

          <div class="form-group col-lg-4 col-12 mb-4">
             <label>Category Name</label>
             <input type="text" name="name" class="form-control rounded-0" placeholder="Category Name" value="{{old('name')}}" />
         </div>

         <div class="form-group col-lg-4 col-12 mb-4">
             <label>Parent Category</label>
             <select class="form-control rounded-0 select2" name="parent_id">
                <option value="0" selected disabled>--- select category ---</option>
                @foreach($getCategories as $category)
                    <option value="{{$category->id}}"> <b> {{$category->name}}</b></option>
                    @if($category->subCategories->isNotEmpty())
                        @foreach($category->subCategories as $subCat)
                            <option value="{{$subCat->id}}">&nbsp; &minus;&minus; {{$subCat->name}}</option>

                            @if($subCat->subCategories->isNotEmpty())
                                @foreach($subCat->subCategories as $subSubCat)
                                    <option value="{{$subSubCat->id}}">&nbsp;&nbsp; &minus;&minus;&minus; {{$subSubCat->name}}</option>
                                @endforeach
                            @endif

                        @endforeach
                    @endif
                @endforeach
            </select>
         </div>

         <div class="form-group col-lg-4 col-12 mb-4">
             <label>Order Level</label>
             <input type="number" name="order_level" class="form-control rounded-0" placeholder="Category Order Level" value="{{old('order_level')}}"/>
         </div>



        <div class="form-group col-lg-12">
                <label>Details</label>
                <textarea name="description" class="form-control rounded-0 editor">{{old('description')}}</textarea>
        </div>

        <div class="form-group col-lg-12 col-12 mb-4">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control rounded-0" placeholder="Enter Meta Title" value="{{old('meta_title')}}" />
        </div>


        <div class="form-group col-lg-12">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control rounded-0" rows="2">{{old('meta_description')}}</textarea>
        </div>

       </div>
   </div>
   <div class="col-md-4 col-12 card rounded-0">
     <div class="row card-body">

         <div class="form-group col-lg-12 col-12 mb-4">
           <img src="{{ asset('noimage.png') }}" alt="avatar" class="img-fluid" id="img">
        </div>

        <div class="form-group col-lg-12 col-12 mb-4">
         <label>Thumnail Image</label>
         <input type="file" name="image" class="form-control" id="input">
        </div>
       </div>

       <div class="row card-footer">
        
        <button type="submit" name="button" class="btn btn-success btn-sm col-md-4 rounded-0" value="public">Save & Public</button>
        <button type="submit" name="button" class="btn btn-danger btn-sm col-md-4 rounded-0" value="draft">Save & Draft</button>
        <button type="submit" name="button" class="btn btn-warning btn col-md-4 rounded-0" value="unpublish"> Unpublish</button>
       </div>
   </div>
</div>
</div>
</form>