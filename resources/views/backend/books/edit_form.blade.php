<form  action="{{route('books.update',$books['id'])}}" method="post" enctype="multipart/form-data">@csrf
     @method('PUT')
<div class="card-body">
<div class="row">
   <div class="col-md-8 col-12">
       <div class="row">

          <div class="form-group col-lg-6 col-12 mb-4">
             <label>Book Name</label>
             <input type="text" name="name" class="form-control rounded-0" value="{{$books['name']}}" />
         </div>

         <div class="form-group col-lg-6 col-12 mb-4">
             <label>Category</label>
             <select class="form-control rounded-0 select2" name="category_id">
                <option value="0" selected disabled>--- select category ---</option>
                @foreach($getCategories as $cat)
                    <option value="{{$cat->id}}" {{$books->category_id == $cat->id ? 'selected' : ''}}>
                        &minus; {{$cat->name}}
                    </option>
                    @if($cat->subCategories->isNotEmpty())
                        @foreach($cat->subCategories as $subCat)
                            <option value="{{$subCat->id}}" {{$books->category_id == $subCat->id ? 'selected' : ''}}>
                                &#8727; {{$subCat->name}}
                            </option>
                            @if($subCat->subCategories->isNotEmpty())
                                @foreach($subCat->subCategories as $subSubCat)
                                    <option value="{{$subSubCat->id}}" {{$books->category_id == $subSubCat->id ? 'selected' : ''}}>
                                        &#8729;&#8729;&#8729;&#8729; {{$subSubCat->name}}
                                    </option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
         </div>

          <div class="form-group col-lg-6 col-12 mb-4">
            <label>Books Stock</label>
            <input type="text" name="stock" class="form-control rounded-0" placeholder="Books Stock" value="{{$books['stock']}}" />
        </div>

         <div class="form-group col-lg-6 col-12 mb-4">
             <label>Books Tags</label>
             <input type="text" name="tags[]" id="tags" class="form-control rounded-0" placeholder="Product tags" value="{{ is_array($books->tags) ? implode(',', $books->tags) : $books->tags }}" />
         </div>



        
        <div class="form-group col-lg-12">
                <label>Short Details</label>
                <textarea name="short_details" class="form-control rounded-0">{{$books['short_details']}}</textarea>
        </div>

        <div class="form-group col-lg-12">
                <label>Long Details</label>
                <textarea name="long_details" class="form-control rounded-0 editor">{!! $books['long_details'] !!}</textarea>
        </div>

        <div class="form-group col-lg-12 col-12 mb-4">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control rounded-0" placeholder="Enter Meta Title" value="{{$books['meta_title']}}" />
        </div>


        <div class="form-group col-lg-12">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control rounded-0" rows="2">{!!$books['meta_description']!!}</textarea>
        </div>

       </div>
   </div>
   <div class="col-md-4 col-12 card rounded-0">
     <div class="row card-body">

       

        <div class="form-group col-lg-12 col-12 mb-4">
        <label>Authors</label> <br>
           @foreach(\App\Models\Author::where('status', 1)->get() as $key => $author)
            <input type="checkbox" name="author_id[]" id="author{{ $key }}" value="{{ $author->id }}" 
            {{ in_array($author->id, $books->authors->pluck('id')->toArray()) ? 'checked' : '' }}>
           <label for="author{{ $key }}">{{ $author['name'] }}</label> <br>
          @endforeach
    </div>


         <div class="form-group col-lg-12 col-12 mb-4">
           <img src="{{ $books->image ? asset('images/'.$books->image) : asset('noimage.png') }}" alt="{{$books['name']}}" class="img-fluid" id="img">
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