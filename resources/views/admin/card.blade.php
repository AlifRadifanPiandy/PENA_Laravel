@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Card</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambah">Add new</button>
    </div>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Title</th>
          <th>Description</th>
          <th>Button</th>
          <th>Status</th>
          <th>Sort</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cards as $cd)
        <tr>
          <td style="width:10px">{{ $loop->iteration }}</td>
          <td>{{ $cd->title }}</td>
          <td>{{ substr($cd->description,0,75) }}...</td>
          <td>
            <a href="{{ $cd->url }}" class="btn btn-primary fs-9 p-3" target="_blank">
              {{ $cd->button }}
            </a>
          </td>
          <td>
            @if ($cd->show)
              <span class="badge badge-success">Show</span>
            @else
              <span class="badge badge-danger">Hide</span>    
            @endif
          </td>
          <td>
            <span class="badge badge-primary">{{ $cd->sort }}</span>
          </td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $cd->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $cd->id }})"><i class="bi bi-x-lg"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!--end::Block-->
</div>
<!--end::Section-->

<div class="modal fade" tabindex="-1" id="tambah">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Add Card</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-8">
                <label class="required fw-bold mb-2">Title</label>
                <input type="text" class="form-control form-control-solid" id="title" name="title" required>
              </div>
              <div class="col-6 col-md-2">
                <label class="required fw-bold mb-2">Show</label>
                <select class="form-select form-select-solid" id="show" name="show" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Show</option>
                  <option value="0">Hide</option>
                </select>
              </div>
              <div class="col-6 col-md-2">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="sort" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-5">
                <label class="required fw-bold mb-2">Button Text</label>
                <input type="text" class="form-control form-control-solid" id="button" name="button" required>
              </div>
              <div class="col-7">
                <label class="required fw-bold mb-2">Button URL</label>
                <input type="text" class="form-control form-control-solid" id="url" name="url" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="required fw-bold mb-2">Description</label>
                <textarea class="form-control form-control-solid" name="description" rows="5" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="store">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="edit">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="et">Edit Card</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-12 col-md-8">
                <label class="required fw-bold mb-2">Title</label>
                <input type="text" class="form-control form-control-solid" id="eti" name="title" required>
              </div>
              <div class="col-6 col-md-2">
                <label class="required fw-bold mb-2">Show</label>
                <select class="form-select form-select-solid" id="esh" name="show" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Show</option>
                  <option value="0">Hide</option>
                </select>
              </div>
              <div class="col-6 col-md-2">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="esr" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-5">
                <label class="required fw-bold mb-2">Button Text</label>
                <input type="text" class="form-control form-control-solid" id="ebt" name="button" required>
              </div>
              <div class="col-7">
                <label class="required fw-bold mb-2">Button URL</label>
                <input type="text" class="form-control form-control-solid" id="eur" name="url" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="required fw-bold mb-2">Description</label>
                <textarea class="form-control form-control-solid" id="eds" name="description" rows="5" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="update">Save</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="hapus">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Delete Card</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Are you sure you want to delete this card?</label>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" name="submit" value="destroy">Delete</button>
          </div>
        </form>
      </div>
  </div>
</div>

<script type="text/javascript">
  function edit(id){
    $.ajax({
      url: "/api/card/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#eid").val(id);
        $("#eti").val(mydata.title);
        $("#esh").val(mydata.show);
        $("#esr").val(mydata.sort);
        $("#ebt").val(mydata.button);
        $("#eur").val(mydata.url);
        $("#eds").val(mydata.description);
        $("#et").text("Edit "+mydata.title);
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/card/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#hi").val(id);
        $("#hd").text('Are you sure you want to delete "'+mydata.title+'"?');
      }
    });
  }
</script>
@endsection