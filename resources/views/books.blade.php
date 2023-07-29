<div id="myData" class="wrapper">
 <div class="row">
@foreach($books as $key => $data)
<div class="col-md-4" style="width:25%;">
 <div class="card" style="width: 100%;">
   <img class="card-img-top" src="{{ $data->image ? asset('images/'.$data->image) : asset('noimage.png') }}" alt="{{ $data->name }}">
   <div class="card-body">
    <h6 class="card-title">
      <a href="{{route('books.details',$data['slug'])}}" style="text-decoration: none;">
      <i class="bi bi-book-half"></i> {{ $data->name }}  <i class="bi bi-tag"></i> {{ $data->category->name }}
      </a>
    </h6>
  </div>
  <div class="card-footer">
    @if($data->authors->isEmpty())
        <a href="#" class="card-text" style="text-decoration: none;">
            <i class="bi bi-people-fill"></i> Books Store
        </a>
    @else
      @foreach($data->authors as $value)
          <a href="{{ route('category.author', $value['name']) }}" class="card-text" style="text-decoration: none;">
              <i class="bi bi-people-fill"></i> {{ $value['name'] }}
          </a>
      @endforeach
    @endif
</div>
</div>
</div>
@endforeach
</div>
</div>
