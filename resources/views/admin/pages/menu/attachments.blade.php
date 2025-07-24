@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">จัดการไฟล์แนบ - {{ $menu->name }}</h4>
        <ul class="breadcrumbs mb-1 ps-0 ms-0 text-start">
            <li class="nav-home ms-3">
                <a href="{{ route('MenuIndex') }}">
                    <i class="icon-home"></i> จัดการเมนู
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <span>ไฟล์แนบ</span>
            </li>
        </ul>
    </div>

    <div class="card mb-3">
        <div class="card-body py-3">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                เพิ่มไฟล์แนบ
            </button>

            <!-- Create Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">เพิ่มไฟล์แนบ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('AttachmentCreate', $menu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">หัวข้อ/ชื่อไฟล์</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="ระบุหัวข้อหรือชื่อไฟล์">
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="word_file" class="form-label">ไฟล์ Word</label>
                                            <input type="file" class="form-control" id="word_file" name="word_file" accept=".doc,.docx">
                                            <small class="text-muted">รองรับไฟล์: DOC, DOCX (ขนาดไม่เกิน 10MB)</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="excel_file" class="form-label">ไฟล์ Excel</label>
                                            <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xls,.xlsx">
                                            <small class="text-muted">รองรับไฟล์: XLS, XLSX (ขนาดไม่เกิน 10MB)</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="pdf_file" class="form-label">ไฟล์ PDF</label>
                                            <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf">
                                            <small class="text-muted">รองรับไฟล์: PDF (ขนาดไม่เกิน 10MB)</small>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="image_file" class="form-label">ไฟล์รูปภาพ</label>
                                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                                            <small class="text-muted">รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 5MB)</small>
                                        </div>
                                    </div>
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

            <br><br>

            <div class="table-responsive">
                <table id="basic-datatables" class="table table-striped table-hover datatable-th">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">หัวข้อ</th>
                            <th class="text-center">ไฟล์ Word</th>
                            <th class="text-center">ไฟล์ Excel</th>
                            <th class="text-center">ไฟล์ PDF</th>
                            <th class="text-center">รูปภาพ</th>
                            <th class="text-center">วันที่สร้าง</th>
                            <th class="text-center">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menu->attachments as $index => $attachment)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $attachment->title ?: 'ไม่มีหัวข้อ' }}</td>
                                <td class="text-center">
                                    @if($attachment->word_file)
                                        <a href="{{ asset('storage/' . $attachment->word_file) }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fas fa-file-word"></i> ดาวน์โหลด
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($attachment->excel_file)
                                        <a href="{{ asset('storage/' . $attachment->excel_file) }}" target="_blank" class="btn btn-success btn-sm">
                                            <i class="fas fa-file-excel"></i> ดาวน์โหลด
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($attachment->pdf_file)
                                        <a href="{{ asset('storage/' . $attachment->pdf_file) }}" target="_blank" class="btn btn-danger btn-sm">
                                            <i class="fas fa-file-pdf"></i> ดาวน์โหลด
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($attachment->image_file)
                                        <a href="{{ asset('storage/' . $attachment->image_file) }}" target="_blank" class="btn btn-warning btn-sm">
                                            <i class="fas fa-image"></i> ดู
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $attachment->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAttachmentModal{{ $attachment->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $attachment->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($menu->attachments as $attachment)
                        @include('admin.pages.menu.partials.edit_attachment_modal', ['menu' => $menu, 'attachment' => $attachment])
                        @endforeach
                        
                        @if($menu->attachments->count() == 0)
                            <tr>
                                <td colspan="8" class="text-center text-muted">ไม่มีไฟล์แนบ</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@endsection

@section('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "การลบไฟล์แนบนี้จะไม่สามารถกู้คืนได้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `/Admin/Menu/attachment/${id}/delete`;
                form.submit();
            }
        });
    }
</script>
@endsection