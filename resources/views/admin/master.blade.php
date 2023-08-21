@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Master</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    </div>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="row mt-3">
    @foreach($masters as $m)
    <div class="col-md-3">
      <div class="p-4">
        <div class="rounded border p-5 row form-check d-flex">
          <span class="fw-bold" style="width: fit-content">{{ $m->code }}</span>
          <input class="est form-check-input ms-auto" type="checkbox" id="s{{ $m->id }}" name="status" @if ($m->status) checked @endif>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <!--end::Block-->
</div>
<!--end::Section-->

<div class="modal fade" tabindex="-1" id="tambah">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Data Master</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Code</label>
                <input type="text" class="form-control form-control-solid" id="code" name="code" required>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-select form-select-solid" id="status" name="status" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Show</option>
                  <option value="0">Hide</option>
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
          <h3 class="modal-title" id="eti">Edit Data Master</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Code</label>
                <input type="text" class="form-control form-control-solid" id="ecd" name="code" required readonly>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-select form-select-solid" id="est" name="status" tabindex="-1" aria-hidden="true" required>
                  <option value="1">Show</option>
                  <option value="0">Hide</option>
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
          <h3 class="modal-title">Hapus Data Master</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <input type="hidden" class="d-none" id="hi" name="id">
            <label class="fw-bold mb-2" id="hd">Apakah anda yakin ingin menghapus konten ini?</label>
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
      url: "/api/master/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#eid").val(id);
        $("#ecd").val(mydata.code);
        $("#est").val(mydata.status);
        //$("#eti").text("Edit "+mydata.code);
      }
    });
  }
  $(".est").change(function(){
    var id = $(this).attr("id").substr(1);
    if($(this).is(":checked")){
      var status = 1;
    }else{
      var status = 0;
    }
    updateData(id,status)
  });

  function updateData(id,val) {
    const dataUpdate = new Object();
    dataUpdate.id = parseInt(id);
    dataUpdate.status = parseInt(val);
    //dataUpdate.success = 1;

    $.ajax({
        url: "/api/masterpost",
        type: 'POST',
        data: dataUpdate,
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'text',
        success: function(data) {
          Toast.fire({icon: 'success',title: "Data master berhasil diupdate"})
        },
        error: function(err) {
          Swal.fire({icon: 'danger',title: JSON.stringify(err)})
        }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/master/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#hi").val(id);
        $("#hd").text('Apakah anda yakin ingin menghapus "'+mydata.code+'"?');
      }
    });
  }
</script>
@endsection