<form id="booksStore"  enctype="multipart/form-data">@csrf
<div class="card-body">
<div class="row">
   <div class="col-md-8 col-12">
       <div class="row">

          <div class="form-group col-lg-6 col-12 mb-4">
             <label>Book Name</label>
             <input type="text" name="name" class="form-control rounded-0" placeholder="Books Name" value="{{old('name')}}" />
         </div>

         <div class="form-group col-lg-6 col-12 mb-4">
             <label>Category</label>
             <select class="form-control rounded-0 select2" name="category_id">
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

          <div class="form-group col-lg-6 col-12 mb-4">
            <label>Books Stock</label>
            <input type="text" name="stock" class="form-control rounded-0" placeholder="Books Stock" value="{{old('stock')}}" />
        </div>

         <div class="form-group col-lg-6 col-12 mb-4">
             <label>Books Tags</label>
             <input type="text" name="tags[]" id="tags" class="form-control rounded-0" placeholder="Books tags" value="{{ is_array(old('tags')) ? implode(',', old('tags')) : old('tags') }}" />
         </div>



        
        <div class="form-group col-lg-12">
                <label>Short Details</label>
                <textarea name="short_details" class="form-control rounded-0">{{old('short_details')}}</textarea>
        </div>

        <div class="form-group col-lg-12">
                <label>Long Details</label>
                <textarea name="long_details" class="form-control rounded-0 editor">{{old('long_details')}}</textarea>
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
            <label>Authos Name</label> <br>
            @foreach(\App\Models\Author::where('status',1)->get() as $key=> $author)
            <input type="checkbox" name="author_id[]" id="author" value="{{ $author->id }}"> {{$author['name']}} <br>
            @endforeach
        </div>

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