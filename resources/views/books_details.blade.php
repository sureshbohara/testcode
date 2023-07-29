<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> 
                                <img id="main-image" src="{{ $booksDetails->image ? asset('images/'.$booksDetails->image) : asset('noimage.png') }}" width="250" /> </div>
                           </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> 
                                    <a href="{{route('front.home')}}">
                                      <i class="bi bi-arrow-left-circle"></i>
                                      <span class="ml-1">Back</span> 
                                     </a>
                                 </div>
                            </div>
                            <div class="mt-4 mb-3">
                                Category : 
                             <span class="text-uppercase text-muted brand">
                                {{$booksDetails['category']['name']}}
                             </span>
                                <h5 class="text-uppercase">Book Name : {{$booksDetails['name']}}</h5>
                                <div class="price d-flex flex-row align-items-center">
                                    @if ($booksDetails->stock > 0)
                                    <p>Availability: In Stock</p>
                                    @else
                                      <p>Availability: Out of Stock</p>
                                    @endif (Books) 
                                </div>
                                </div>
                            </div>
                            <p class="about">{{$booksDetails['short_details']}}</p>
                             {!! $booksDetails['long_details'] !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>