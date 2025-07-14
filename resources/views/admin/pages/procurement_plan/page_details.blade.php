@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">แผนจัดซื้อจัดจ้าง</h4>
        <ul class="breadcrumbs mb-1 ps-0 ms-0 text-start">
            <li class="nav-home ms-3">
                <a href="#">
                    <i class="icon-home"></i> หน้าหลัก
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $ProcurementPlanType->type_name }}</a>
            </li>
        </ul>
    </div>

    <div class="card mb-3">
        <div class="card-body py-3">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                แนบไฟล์เอกสาร
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">แนบไฟล์เอกสาร</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ProcurementPlanDetailCreate', $ProcurementPlanType->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file_post" class="form-label">แนบไฟล์เพิ่มเติม</label>
                                    <input type="file" class="form-control" id="file_post" name="file_post">
                                    <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf, doc, docx, xls,
                                        xlsx</small>
                                    <div id="file-list" class="mt-1">
                                        <div class="d-flex flex-wrap gap-3"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <table id="basic-datatables" class="table table-striped table-hover datatable-th">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>ไฟล์</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ProcurementPlanFile as $index => $details)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <!-- แสดงชื่อไฟล์ -->
                                {{ basename($details->files_path) }}
                            </td>
                            <td class="text-center">
                                <a href="{{ Storage::url($details->files_path) }}" class="btn btn-info btn-sm"
                                    target="_blank">
                                    <i class="bi bi-file-earmark"></i>
                                </a>
                                <form action="{{ route('ProcurementPlanDetailDelete', $details->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('ยืนยันการลบใช่หรือไม่?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const datatableLangs = {
            'th': {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "infoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "infoFiltered": "(กรองข้อมูลจากทั้งหมด _MAX_ แถว)",
                "thousands": ",",
                "lengthMenu": "แสดง _MENU_ แถว",
                "loadingRecords": "กำลังโหลด...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบข้อมูลที่ตรงกัน",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending": ": เรียงจากน้อยไปมาก",
                    "sortDescending": ": เรียงจากมากไปน้อย"
                }
            }
        };

        $(document).ready(function() {
            $('.datatable-th').DataTable({
                language: datatableLangs['th']
            });
        });
    </script>
@endpush
