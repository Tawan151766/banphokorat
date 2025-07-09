@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">ผลการดำเนินงาน</h4>
        <ul class="breadcrumbs mb-1 ps-0 ms-0 text-start">
            <li class="nav-home ms-3">
                <a href="#">
                    <i class="icon-home"></i> หน้าหลัก
                </a>
            </li>
        </ul>
    </div>

    <div class="card mb-3">
        <div class="card-body py-3">

            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                สร้างหัวข้อ
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">สร้างหัวข้อ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('PerformanceResultsTypeCreate') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="type_name" class="form-label">หัวข้อ</label>
                                    <input type="text" class="form-control" id="type_name" name="type_name">
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
                        <th>หัวข้อ</th>
                        <th>การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($PerfResultsType as $index => $details)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $details->type_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('PerformanceResultsShowSection', $details->id) }}"
                                    class="btn btn-primary btn-sm" title="เพิ่มเมนู"><i class="bi bi-plus-square"></i></a>

                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $details->id }}" title="แก้ไข">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('PerformanceResultsDelete', $details->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('ยืนยันการลบใช่หรือไม่?')"><i class="bi bi-trash" title="ลบ"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach ($PerfResultsType as $details)
                <div class="modal fade" id="editModal-{{ $details->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel-{{ $details->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel-{{ $details->id }}">แก้ไขหัวข้อ</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('PerformanceResultsUpdate', $details->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="type_name-{{ $details->id }}" class="form-label">หัวข้อ</label>
                                        <input type="text" class="form-control" id="type_name-{{ $details->id }}"
                                            name="type_name" value="{{ $details->type_name }}">
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
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <style>
    #basic-datatables {
        border: 1px solid #dee2e6; /* เส้นรอบตาราง */
    }

    #basic-datatables th,
    #basic-datatables td {
        border: 1px solid #dee2e6; /* เส้นในแต่ละช่อง */
    }

    #basic-datatables thead th {
        background-color: #f8f9fa; /* สีหัวตาราง */
    }
</style> --}}

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
