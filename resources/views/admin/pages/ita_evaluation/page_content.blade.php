@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">เนื้อหา ITA - {{ $itaEvaluation->name }}</h4>
        <ul class="breadcrumbs mb-1 ps-0 ms-0 text-start">
            <li class="nav-home ms-3">
                <a href="{{ route('ItaEvaluationIndex') }}">
                    <i class="icon-home"></i> การประเมิน ITA
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">เนื้อหา</a>
            </li>
        </ul>
    </div>

    <div class="card mb-3">
        <div class="card-body py-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>{{ $itaEvaluation->name }}</h5>
                    <p class="text-muted">{{ $itaEvaluation->description }}</p>
                    @if($itaEvaluation->ita_date)
                        <small class="text-info">วันที่ประเมิน: {{ $itaEvaluation->ita_date->format('d/m/Y') }}</small>
                    @endif
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                        เพิ่มเนื้อหา
                    </button>
                </div>
            </div>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">เพิ่มเนื้อหา ITA</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ItaContentCreate', $itaEvaluation->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input type="url" class="form-control" id="url" name="url" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">รายละเอียด</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table id="basic-datatables" class="table table-striped table-hover datatable-th">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">URL</th>
                        <th class="text-center">รายละเอียด</th>
                        <th class="text-center">วันที่สร้าง</th>
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itaContents as $index => $content)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ $content->url }}" target="_blank" class="text-primary">
                                    {{ Str::limit($content->url, 50) }}
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                            </td>
                            <td>{{ Str::limit($content->description, 50) }}</td>
                            <td class="text-center">{{ $content->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $content->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('ItaContentDelete', $content->id) }}"
                                    method="POST" style="display:inline;">
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

            @foreach ($itaContents as $content)
                <div class="modal fade" id="editModal-{{ $content->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel-{{ $content->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel-{{ $content->id }}">แก้ไขเนื้อหา ITA</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('ItaContentUpdate', $content->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="url-{{ $content->id }}" class="form-label">URL</label>
                                        <input type="url" class="form-control" id="url-{{ $content->id }}"
                                            name="url" value="{{ $content->url }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description-{{ $content->id }}" class="form-label">รายละเอียด</label>
                                        <textarea class="form-control" id="description-{{ $content->id }}" name="description" rows="3">{{ $content->description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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