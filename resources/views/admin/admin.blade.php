@extends('layouts.admin')

@section('content')
<!--begin::Section-->
<div>
  <!--begin::Heading-->
  <div class="col-12 row m-0">
    <div class="me-auto col-12 col-md-6">
      <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Admin</h1>
    </div>
    <div class="d-flex col-12 col-md-6 p-0">
      <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
        <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
        <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
        <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
        <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
        <button class="btn btn-primary px-2 pe-3" onClick="dataexport('print')">Print</button>
      </div>
      <button class="btn btn-primary me-auto me-md-0" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
    </div>
  </div>
  <!--end::Heading-->
  <!--begin::Block-->
  <div class="my-5 table-responsive">
    <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
      <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
          <th>No</th>
          <th>Nama</th>
          <th>Username</th>
          <th>Status</th>
          <th>Hak akses</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($admins as $admin)
        <?php
          $privilege = explode(",",$admin->privilege);
        ?>
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td style="min-width: 320px;">{{ $admin->name }}</td>
          <td>{{ $admin->username }}</td>
          <td>
            @if ($admin->status=="active")
              <span class="badge badge-primary">{{ $admin->status }}</span>
            @else
              <span class="badge badge-dark">{{ $admin->status }}</span>    
            @endif
          </td>
          <td style="min-width: 100px;">
            <span class="badge badge-success">{{ str_replace(",",", ",$admin->privilege) }}</span>
          </td>
          <td style="min-width: 100px;">
            <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit" onclick="edit({{ $admin->id }})"><i class="bi bi-pencil-fill"></i></a>
            <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus" onclick="hapus({{ $admin->id }})"><i class="bi bi-x-lg"></i></a>
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
          <h3 class="modal-title">Tambah Admin</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="required fw-bold mb-2">Nama</label>
                <input type="text" class="form-control form-control-solid" id="name" name="name" required>
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-select form-select-solid" name="status" tabindex="-1" aria-hidden="true" required>
                  <option value="active">Aktif</option>
                  <option value="nonactive">Non aktif</option>
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Username</label>
                <input type="text" class="form-control form-control-solid" id="username" name="username" required>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid" id="password" name="password" required>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <label class="required fw-bold mb-2">Hak akses</label>
              <br>
              @php
                $prev = [
                  ['C1','Content'],
                  ['EC1','EIC Card'],
                  ['EC2','EIC Category'],
                  ['F1','FAQ'],
                  ['G1','Gallery'],
                  ['S1','Sponsor'],
                  ['M1','Data Master'],
                  [6,'Data Admin']
                ];
              @endphp
              @foreach ($prev as $p)
                <div class="col-6 mt-0">
                  <input type="checkbox" name="privilege[]" value="{{$p[0]}}" @if($p[0]=="1") checked @endif>
                  <label for="p{{$p[0]}}"> {{$p[1]}}</label>
                </div>
              @endforeach
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
          <h3 class="modal-title" id="eti">Edit Admin</h3>
          <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </div>
        </div>
        <form class="form" method="post" action="">
          @csrf
          <input type="hidden" class="d-none" id="eid" name="id">
          <div class="modal-body">
            <div class="row g-9 mb-8">
              <div class="col-8">
                <label class="required fw-bold mb-2">Nama</label>
                <input type="text" class="form-control form-control-solid" id="enm" name="name" required>
              </div>
              <div class="col-4">
                <label class="required fw-bold mb-2">Status</label>
                <select class="form-select form-select-solid" id="est" name="status" tabindex="-1" aria-hidden="true" required>
                  <option value="active">Aktif</option>
                  <option value="nonactive">Non aktif</option>
                </select>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <div class="col-6">
                <label class="required fw-bold mb-2">Username</label>
                <input type="text" class="form-control form-control-solid" id="eun" name="username" required>
              </div>
              <div class="col-6">
                <label class="required fw-bold mb-2">Password</label>
                <input type="password" class="form-control form-control-solid" id="eps" name="password">
                <small class="text-danger">Kosongkan jika tidak ingin mengganti password</small>
              </div>
            </div>
            <div class="row g-9 mb-8">
              <label class="required fw-bold mb-2">Hak akses</label>
              <br>
              @php
                $prev = [
                  ['C1','Content'],
                  ['EC1','EIC Card'],
                  ['EC2','EIC Category'],
                  ['F1','FAQ'],
                  ['G1','Gallery'],
                  ['S1','Sponsor'],
                  ['M1','Data Master'],
                  [6,'Data Admin']
                ];
              @endphp
              @foreach ($prev as $p)
                <div class="col-4 mt-0">
                  <input class="epv" type="checkbox" id="p{{$p[0]}}" name="privilege[]" value="{{$p[0]}}">
                  <label for="p{{$p[0]}}"> {{$p[1]}}</label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="submit" value="update">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="hapus">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Hapus Admin</h3>
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
  $(document).ready(function () {
    $('#tpv').select2({  dropdownParent: $("#tambah")  });
    $('#epv').select2({  dropdownParent: $("#edit")  });
  });
  function edit(id){
    $.ajax({
      url: "/api/admin/"+id,
      type: 'GET',
      dataType: 'json', // added data type
      success: function(response) {
        var mydata = response.data;
        $("#eid").val(id);
        $("#enm").val(mydata.name);
        $("#eun").val(mydata.username);
        $("#est").val(mydata.status);
        //Clear all checked
        $(".epv").each(function(){
          $(this).prop( "checked",false)
        });
        //Set checked
        pvs = mydata.privilege.split(",");
        for (let i = 0; i < pvs.length; i++) {
          $(".epv").each(function(){
            if($(this).val()==pvs[i]){
              $(this).prop( "checked",true)
            }
          });
        }
        $("#eti").text("Edit "+mydata.name);
      }
    });
  }
  function hapus(id){
    $.ajax({
      url: "/api/admin/"+id,
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