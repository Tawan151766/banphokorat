@extends('admin.layouts.kaiadmin')
@section('content')

    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">กิจกรรม</h4>
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
            <button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#myModal">
                เพิ่มข้อมูล
            </button>

            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">เพิ่มข้อมูลกิจกรรม</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ActivityCreate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <div class="mb-3">
                                    <input type="hidden" name="post_type_id"
                                        value="{{ $postTypes->firstWhere('type_name', 'กิจกรรม')->id }}">
                                    <label for="date" class="form-label">วันที่</label>
                                    <input type="date" class="form-control" id="date" name="date">
                                </div>

                                <div class="mb-3">
                                    <label for="title_name" class="form-label">ชื่อเรื่อง</label>
                                    <input type="text" class="form-control" id="title_name" name="title_name">
                                </div>

                                <div class="mb-3">
                                    <label for="topic_name" class="form-label">หัวข้อ</label>
                                    <input type="text" class="form-control" id="topic_name" name="topic_name">
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="รายละเอียด" id="details" name="details"></textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="title_image" class="form-label">รูปหัวข้อ</label>
                                    <input type="file" class="form-control" id="title_image[]" name="title_image">
                                </div>

                                <div class="mb-3">
                                    <label for="file_post" class="form-label">แนบไฟล์ภาพและPDF</label>
                                    <input type="file" class="form-control" id="file_post" name="file_post[]" multiple>
                                    <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน
                                        10MB)</small>
                                    <div id="file-list" class="mt-1">
                                        <div class="d-flex flex-wrap gap-3"></div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="file_video" class="form-label">แนบไฟล์วิดีโอ</label>
                                    <input type="file" class="form-control" id="file_video" name="file_video">
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

            <br>
            <br>

            <table id="basic-datatables" class="table table-striped table-hover datatable-th">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">วันที่</th>
                        <th class="text-center">ชื่อเรื่อง</th>
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                @if ($postDetails->isNotEmpty())
                    <tbody>
                        @foreach ($postDetails as $index => $postDetail)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $postDetail->date ?? 'N/A' }}</td>
                                <td>{{ $postDetail->title_name ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="mb-1 me-1">
                                            <a href="{{ route('ActivityUpdatePage', $postDetail->id) }}"
                                                class="btn btn-warning btn-sm" title="แก้ไข">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <div class="mb-1 me-1">
                                            <form action="{{ route('ActivityDelete', $postDetail->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    <script src="{{ asset('js/multipart_files.js') }}"></script>

    <style>
        .ck-editor__editable {
            min-height: 300px !important;
        }
    </style>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector("#details"))
                .catch(error => {
                    console.error("CKEditor error:", error);
                });
        });
    </script>

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
