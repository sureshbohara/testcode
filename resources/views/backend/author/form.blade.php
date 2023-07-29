<form id="authorStore" enctype="multipart/form-data">@csrf
<div class="card-body">
<div class="row">

<div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Name</label>
    <input type="text" name="name" class="form-control rounded-0" placeholder="Enter Author Name" />
</div>

<div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Email</label>
    <input type="email" name="email" class="form-control rounded-0" placeholder="Enter Author Email" />
</div>


<div class="form-group col-lg-6 col-12 mb-4">
    <label>Author Address</label>
    <input type="text" name="address" class="form-control rounded-0" placeholder="Enter Author address" />
</div>

<div class="form-group col-lg-6 col-12 mb-4">
    <label>Preview Profile</label>
     <img src="{{ asset('noimage.png') }}" class="form-control" alt="avatar" id="img" width="50px">
</div>
<div class="form-group col-lg-12 col-12 mb-4">
    <label>Author Profile</label>
    <input type="file" name="image" class="form-control rounded-0" id="input" />
</div>

<div class="form-group col-lg-12">
    <label>Content</label>
    <textarea name="content" class="form-control rounded-0 editor"></textarea>
</div>

</div>
</div>
<div class="card-footer">
    <button class="btn btn-primary btn-sm"> Submit Data</button>
</div>
</form>