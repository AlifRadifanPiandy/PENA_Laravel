@extends('layouts.admin')

@section('content')
    <!--begin::Section-->
    <div>
        <!--begin::Heading-->
        <div class="col-12 row m-0">
            <div class="me-auto col-12 col-md-6">
                <h1 class="anchor fw-bolder mb-5 me-auto" id="striped-rounded-bordered">Data Content</h1>
            </div>
            <div class="d-flex col-12 col-md-6 p-0">
                <div class="btn-group btn-group-sm me-3 ms-auto" role="group" aria-label="Small button group">
                    <button class="btn btn-primary px-2 ps-3" onClick="dataexport('copy')">Copy</button>
                    <button class="btn btn-primary px-2" onClick="dataexport('csv')">CSV</button>
                    <button class="btn btn-primary px-2" onClick="dataexport('excel')">Excel</button>
                    <button class="btn btn-primary px-2" onClick="dataexport('pdf')">PDF</button>
                    <button class="btn btn-primary px-2 pe-3" onClick="dataexport('print')">Print</button>
                </div>
                <button class="btn btn-primary me-auto me-md-0" data-bs-toggle="modal"
                    data-bs-target="#tambah">Tambah</button>
            </div>
        </div>
        <!--end::Heading-->
        <!--begin::Block-->
        <div class="my-5 table-responsive">
            <table id="myTable" class="table table-striped table-hover table-rounded border gs-7" style="font-size: 13px">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                        <th>No</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $ct)
                        <tr>
                            <td style="width:10px">{{ $loop->iteration }}</td>
                            <td>{{ $ct->code }}</td>
                            <td>{{ $ct->title }}</td>
                            <td>{{ substr($ct->body, 0, 75) }}...</td>
                            <td style="min-width: 100px;">
                                <a href="#" class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit" onclick="edit({{ $ct->id }})"><i
                                        class="bi bi-pencil-fill"></i></a>
                                <a href="#" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus" onclick="hapus({{ $ct->id }})"><i
                                        class="bi bi-x-lg"></i></a>
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
                    <h3 class="modal-title">Tambah Konten</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
                <form class="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-9 mb-8">
                            <div class="col-4">
                                <label class="required fw-bold mb-2">Code</label>
                                <input type="text" class="form-control form-control-solid" id="code" name="code"
                                    required>
                            </div>
                            <div class="col-8">
                                <label class="required fw-bold mb-2">Title</label>
                                <input type="text" class="form-control form-control-solid" id="title" name="title"
                                    required>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-12">
                                <label class="required fw-bold mb-2">Body</label>
                                <textarea class="form-control form-control-solid" name="body" id="bb" rows="10" required></textarea>
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
                    <h3 class="modal-title" id="et">Edit Konten</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </div>
                </div>
                <form class="form" method="post" action="">
                    @csrf
                    <input type="hidden" class="d-none" id="eid" name="id">
                    <div class="modal-body">
                        <div class="row g-9 mb-8">
                            <div class="col-4">
                                <label class="required fw-bold mb-2">Code</label>
                                <input type="text" class="form-control form-control-solid" id="ecd"
                                    name="code" required readonly>
                            </div>
                            <div class="col-8">
                                <label class="required fw-bold mb-2">Title</label>
                                <input type="text" class="form-control form-control-solid" id="eti"
                                    name="title" required>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-12">
                                <label class="required fw-bold mb-2">Body</label>
                                <textarea class="form-control form-control-solid" id="ebd" name="body" rows="10" required></textarea>
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
                    <h3 class="modal-title">Hapus Konten</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
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
        function edit(id) {
            $.ajax({
                url: "/api/content/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(response) {
                    var mydata = response.data;
                    $("#eid").val(id);
                    $("#eti").val(mydata.title);
                    $("#ecd").val(mydata.code);
                    $("#ebd").val(mydata.body);
                    $("#et").text("Edit " + mydata.title);
                }
            });
        }

        function hapus(id) {
            $.ajax({
                url: "/api/content/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(response) {
                    var mydata = response.data;
                    $("#hi").val(id);
                    $("#hd").text("Apakah anda yakin ingin menghapus " + mydata.title + "?");
                }
            });
        }
    </script>
@endsection
