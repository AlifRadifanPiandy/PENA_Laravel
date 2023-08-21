@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Gallery</h1>
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
          <th>Name</th>
          <th>Type</th>
          <th>Sort</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($galleries as $g)
        @php
          $type = $g->type;
          if($type==1){$type="EIC";}
          else if($type==2){$type="Semnas";}
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">
            <div class="symbol symbol-30px me-5">
              <img src="/assets/img/gallery/{{ $g->image }}" class="h-30 align-self-center of-cover" alt="">
            </div>
            {{ $g->name }}
          </td>
          <td style="min-width: 100px;">
            <span class="badge badge-success">{{ $type }}</span>
          </td>
          <td style="min-width: 100px;">
            <span class="badge badge-success">{{ $g->sort }}</span>
          </td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $g->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $g->id }})"><i class="bi bi-x-lg"></i></a>
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
  <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Add Image</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="required fw-bold mb-2">Name</label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" required>
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="sort" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="required fw-bold mb-2">Image</label>
                <input type="file" class="form-control form-control-solid" id="image" name="image">
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Type</label>
                <select class="form-select form-select-solid" name="type" tabindex="-1" aria-hidden="true" required>
                  <option value="1">EIC</option>
                  <option value="2">Semnas</option>
                </select>
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
  <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="et">Edit Image</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="required fw-bold mb-2">Name</label>
                <input type="text" class="form-control form-control-solid" id="enm" name="name" required>
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="eso" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="fw-bold mb-2">Image</label>
                <input type="file" class="form-control form-control-solid" name="image">
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Type</label>
                <select class="form-select form-select-solid" id="ety" name="type" tabindex="-1" aria-hidden="true" required>
                  <option value="1">EIC</option>
                  <option value="2">Semnas</option>
                </select>
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
          <h3 class="modal-title">Delete Sponsor</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus admin ini?</label>
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
      url: "/api/gallery/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#eid").val(id);
        $("#enm").val(mydata.name);
        $("#ety").val(mydata.type);
        $("#eso").val(mydata.sort);
        $("#et").text("Edit "+mydata.name);
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/gallery/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#hi").val(id);
        $("#hd").text("Apakah anda yakin ingin menghapus "+mydata.name+"?");
      }
    });
  }
</script>
@endsection