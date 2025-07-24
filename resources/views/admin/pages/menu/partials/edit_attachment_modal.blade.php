<!-- Edit Attachment Modal Partial -->
<div class="modal fade" id="editAttachmentModal{{ $attachment->id }}" tabindex="-1" aria-labelledby="editAttachmentModalLabel{{ $attachment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="margin-top: 5%;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editAttachmentModalLabel{{ $attachment->id }}">แก้ไขไฟล์แนบ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('AttachmentUpdate', [$menu->id, $attachment->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title_edit_{{ $attachment->id }}" class="form-label">หัวข้อ/ชื่อไฟล์</label>
                        <input type="text" class="form-control" id="title_edit_{{ $attachment->id }}" name="title" value="{{ $attachment->title }}" placeholder="ระบุหัวข้อหรือชื่อไฟล์">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="word_file_edit_{{ $attachment->id }}" class="form-label">ไฟล์ Word</label>
                                <input type="file" class="form-control" id="word_file_edit_{{ $attachment->id }}" name="word_file" accept=".doc,.docx">
                                @if($attachment->word_file)
                                    <small class="text-muted">ไฟล์ปัจจุบัน: <a href="{{ asset('storage/' . $attachment->word_file) }}" target="_blank">ดู/ดาวน์โหลด</a></small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="excel_file_edit_{{ $attachment->id }}" class="form-label">ไฟล์ Excel</label>
                                <input type="file" class="form-control" id="excel_file_edit_{{ $attachment->id }}" name="excel_file" accept=".xls,.xlsx">
                                @if($attachment->excel_file)
                                    <small class="text-muted">ไฟล์ปัจจุบัน: <a href="{{ asset('storage/' . $attachment->excel_file) }}" target="_blank">ดู/ดาวน์โหลด</a></small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pdf_file_edit_{{ $attachment->id }}" class="form-label">ไฟล์ PDF</label>
                                <input type="file" class="form-control" id="pdf_file_edit_{{ $attachment->id }}" name="pdf_file" accept=".pdf">
                                @if($attachment->pdf_file)
                                    <small class="text-muted">ไฟล์ปัจจุบัน: <a href="{{ asset('storage/' . $attachment->pdf_file) }}" target="_blank">ดู/ดาวน์โหลด</a></small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="image_file_edit_{{ $attachment->id }}" class="form-label">ไฟล์รูปภาพ</label>
                                <input type="file" class="form-control" id="image_file_edit_{{ $attachment->id }}" name="image_file" accept="image/*">
                                @if($attachment->image_file)
                                    <small class="text-muted">ไฟล์ปัจจุบัน: <a href="{{ asset('storage/' . $attachment->image_file) }}" target="_blank">ดู</a></small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>
