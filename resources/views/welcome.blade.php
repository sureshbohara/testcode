<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <style type="text/css">
            .navbar-nav .dropdown-menu {
                display: none;
            }
            .navbar-nav .nav-item:hover .dropdown-menu {
                display: block;
            }
        </style>
    </head>
    <body>
         <section>
             <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarScroll">
                          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                           @foreach($getCategories as $category)
                            <li class="nav-item">
                              <a class="nav-link mainCat" href="{{route('category.books',$category->slug)}}">
                                {{$category['name']}}
                              </a>
                                @if($category->subCategories->count() > 0)
                                <ul class="dropdown-menu">
                                  @foreach ($category->subCategories as $subCategory)
                                    <li><a class="dropdown-item" href="{{route('category.books',$subCategory->slug)}}">{{$subCategory['name']}}</a></li>

                                      @foreach ($subCategory->subCategories as $subSubCat)
                                        <li><a class="dropdown-item" href="{{route('category.books',$subSubCat->slug)}}">&nbsp;&minus; {{$subSubCat['name']}}</a></li>
                                      @endforeach

                                  @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach

                           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle bg-danger text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Author By Books
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              @foreach(\App\Models\Author::where('status',1)->get() as $key=> $data)
                              <li><a class="dropdown-item" href="{{ route('category.author', $data['name']) }}">{{$data['name']}}</a></li>
                              @endforeach
                            </ul>
                          </li>

                          </ul>
                          <form class="d-flex">
                            <input class="form-control me-2" type="search" name="search" id="search" placeholder="Search Books & Category" aria-label="Search">
                          </form>
                        </div>
                      </div>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('category')}}">View All Books List</a>
                    </div>
                </div>
                 <div class="row py-4" id="results">
                        @include('books')
                 </div>
             </div>
         </section>

         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 
       <script type="text/javascript">
        $("body").on("keyup","#search",function(){
          let searchData = $("#search").val();
          if(searchData.length > 0){
            $.ajax({
              type:'get',
              url:"{{route('search.items')}}",
              data:{search:searchData},
              success:function(result){
              $('#results').html(result)
              }
            });
          }
          if(searchData.length < 1) $('.myData').html("");
        });
        </script>
    </body>
</html>
