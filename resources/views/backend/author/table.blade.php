<div class="card-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Action</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $data)
            <tr>


                <td>
                <div class="dropdown">
                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Action
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#author{{$data['id']}}">
                        <i class="bi bi-arrow-right"></i> Edit
                    </a>
                    </li>
            
                 <li>
                    <form action="{{ route('author.destroy', $data['id']) }}" method="post" id="deleteForm">
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
                    <img src="{{ $data->image ? asset('images/'.$data->image) : asset('noimage.png') }}" alt="{{$data['name']}}" class="img-fluid" width="50px">
                </td>

                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>
                <form id="status{{ $data['id'] }}" action="{{ route('status.author') }}" method="post">@csrf
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
             @include('backend.author.edit')
            @endforeach
        </tbody>

    </table>
      {{ $authors->links(); }}
</div>
