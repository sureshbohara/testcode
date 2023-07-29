<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Action</th>
                <th>Image</th>
                <th>Name</th>
                <th>Parent Category</th>
                <th>Order Level</th>
                <th>Type</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($category as $data)
            <tr>

              <td>
                <div class="dropdown">
                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Action
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  
                    <li><a class="dropdown-item" href="{{ route('category.edit', $data['id']) }}"><i class="bi bi-arrow-right"></i> Edit</a></li>

                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#type{{$data['id']}}">
                        <i class="bi bi-arrow-right"></i> Highlight Category
                    </a>
                   </li>
                  
                 <li>
                    <form action="{{ route('category.destroy', $data['id']) }}" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <a class="dropdown-item" href="#" onclick="confirmDelete(event)" title="delete data">
                            <i class="bi bi-arrow-right"></i> Delete Data
                        </a>
                    </form>
                </li>
               

                </ul>
                </div>
                </td>

                <td>
                     <img src="{{ $data->image ? asset('images/'.$data->image) : asset('noimage.png') }}" alt="avatar" class="img-fluid" style="width:50px">
                </td>
                <td>{{ $data->name }} </td>
                <td>
                   @if(isset($data['parentcategory']['name']))
                     {{$data['parentcategory']['name']}}
                   @endif
                  </td>
                <td>{{ $data->order_level }} </td>
                <td>{{ $data->type }} </td>

                <td>
                <form id="status{{ $data['id'] }}" action="{{ route('status.category') }}" method="post">@csrf
                    <input type="hidden" value="{{ $data['id'] }}" name="status_id">
                    <div id="checkbox{{ $data['id'] }}">
                        <label class="switch">
                            <input type="checkbox" {{ $data['status'] ? 'checked' : '' }} onchange="changeStatus({{ $data['id'] }}, this.checked)">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </form>
                </td>
            </tr>
             @include('backend.highlight.category')
            @endforeach
        </tbody>
    </table>
    {{ $category->links(); }}
</div>
