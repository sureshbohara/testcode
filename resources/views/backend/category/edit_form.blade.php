<form id="updateStore" action="{{ route('category.update', $category['id']) }}" method="post" enctype="multipart/form-data">
@csrf
 @method('PUT')
<div class="card-body">
<div class="row">
   <div class="col-md-8 col-12">
       <div class="row">

          <div class="form-group col-lg-4 col-12 mb-4">
             <label>Category Name</label>
             <input type="text" name="name" class="form-control rounded-0" placeholder="Category Name" value="{{$category['name']}}" />
         </div>

         <div class="form-group col-lg-4 col-12 mb-4">
             <label>Parent Category</label>
               <select class="form-control rounded-0 select2" name="parent_id">
                <option value="0">--- Select category ---</option>
                @foreach($getCategories as $cat)
                    <option value="{{$cat->id}}" {{$category->parent_id == $cat->id ? 'selected' : ''}}>
                         {{$cat->name}}
                    </option>
                    @if($cat->subCategories->isNotEmpty())
                        @foreach($cat->subCategories as $subCat)
                            <option value="{{$subCat->id}}" {{$category->parent_id == $subCat->id ? 'selected' : ''}}>
                                &nbsp; &minus;&minus; {{$subCat->name}}
                            </option>
                            @if($subCat->subCategories->isNotEmpty())
                                @foreach($subCat->subCategories as $subSubCat)
                                    <option value="{{$subSubCat->id}}" {{$category->parent_id == $subSubCat->id ? 'selected' : ''}}>
                                        &nbsp;&nbsp; &minus;&minus; &minus; {{$subSubCat->name}}
                                    </option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>

         </div>

         <div class="form-group col-lg-4 col-12 mb-4">
             <label>Order Level</label>
             <input type="number" name="order_level" class="form-control rounded-0" placeholder="Category Order Level" value="{{$category['order_level']}}"/>
         </div>


        <div class="form-group col-lg-12">
                <label>Details</label>
                <textarea name="description" class="form-control rounded-0 editor">{{$category['description']}}</textarea>
        </div>

        <div class="form-group col-lg-12 col-12 mb-4">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control rounded-0" placeholder="Enter Meta Title" value="{{$category['meta_title']}}"/>
        </div>


        <div class="form-group col-lg-12">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control rounded-0" rows="2">{{$category['meta_description']}}</textarea>
        </div>

       </div>
   </div>
   <div class="col-md-4 col-12 card rounded-0">
     <div class="row card-body">

         <div class="form-group col-lg-12 col-12 mb-4">
           <img src="{{ $category->image ? asset('images/'.$category->image) : asset('noimage.png') }}" alt="{{$category['name']}}" class="img-fluid" id="img">

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