@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Sponsor & Medpart</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
        <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
        <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
        <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
        <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
        <button class="btn btn-primary px-2 pe-3" onClick="dataexport('print')">Print</button>
      </div>
      <button class="btn btn-primary me-auto me-md-0" data-bs-toggle="modal" data-bs-target="#tambah">Add new</button>
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
          <th>Class</th>
          <th>Type</th>
          <th>Sort</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sponsors as $s)
        @php
          $image = $s->logo;
          if (empty($image)) {$image="not-available.jpg";}

          $type = $s->type;
          if($type==1){$type="Sponsor";}
          else if($type==2){$type="Media Partner";}
          else if($type==3){$type="Support";}
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">
            <div class="symbol symbol-30px me-5">
              <img src="/assets/img/sponsor/{{ $s->logo }}" class="h-30 align-self-center of-cover" alt="">
            </div>
            {{ $s->title }}
          </td>
          <td>{{ $s->class }}</td>
          <td style="min-width: 100px;">
            <span class="badge badge-success">{{ $type }}</span>
          </td>
          <td style="min-width: 100px;">
            <span class="badge badge-success">{{ $s->sort }}</span>
          </td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $s->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $s->id }})"><i class="bi bi-x-lg"></i></a>
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
          <h3 class="modal-title">Add Sponsor/Medpart</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-7">
                <label class="required fw-bold mb-2">Title</label>
                <input type="text" class="form-control form-control-solid" id="title" name="title" required>
              </div>
              <div class="col-5">
                <label class="required fw-bold mb-2">Type</label>
                <select class="form-select form-select-solid" name="type" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Sponsor</option>
                  <option value="2">Media Partner</option>
                  <option value="3">Support</option>
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-7">
                <label class="fw-bold mb-2">Class</label>
                <input type="text" class="form-control form-control-solid" id="class" name="class">
              </div>
              <div class="col-5">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="sort" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="fw-bold mb-2">Logo</label>
                <input type="file" class="form-control form-control-solid" id="logo" name="logo">
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
          <h3 class="modal-title" id="et">Edit Sponsor</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-7">
                <label class="required fw-bold mb-2">Title</label>
                <input type="text" class="form-control form-control-solid" id="eti" name="title" required>
              </div>
              <div class="col-5">
                <label class="required fw-bold mb-2">Type</label>
                <select class="form-select form-select-solid" id="ety" name="type" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Sponsor</option>
                  <option value="2">Media Partner</option>
                  <option value="3">Support</option>
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-7">
                <label class="fw-bold mb-2">Class</label>
                <input type="text" class="form-control form-control-solid" id="ecl" name="class">
              </div>
              <div class="col-5">
                <label class="required fw-bold mb-2">Sort</label>
                <input type="text" class="form-control form-control-solid" id="eso" name="sort" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-12">
                <label class="fw-bold mb-2">Logo</label>
                <input type="file" class="form-control form-control-solid" name="logo">
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
      url: "/api/sponsor/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#eid").val(id);
        $("#eti").val(mydata.title);
        $("#ety").val(mydata.type);
        $("#ecl").val(mydata.class);
        $("#eso").val(mydata.sort);
        $("#et").text("Edit "+mydata.title);
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/sponsor/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#hi").val(id);
        $("#hd").text("Apakah anda yakin ingin menghapus "+mydata.title+"?");
      }
    });
  }
</script>
@endsection