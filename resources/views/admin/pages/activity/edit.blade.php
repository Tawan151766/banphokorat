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
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">แก้ไขข้อมูล</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">{{ $postDetail->title_name }}</a>
            </li>
        </ul>
    </div>

    <div class="card mb-3">
        <div class="card-body py-3">
            <div class="container"> <br>
                <form action="{{ route('PressReleaseUpdate', $postDetail->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="date" class="form-label">วันที่</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $postDetail->date }}">
                    </div>

                    <div class="mb-3">
                        <label for="title_name" class="form-label">ชื่อเรื่อง</label>
                        <input type="text" class="form-control" id="title_name" name="title_name"
                            value="{{ $postDetail->title_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="topic_name" class="form-label">หัวข้อ</label>
                        <input type="text" class="form-control" id="topic_name" name="topic_name"
                            value="{{ $postDetail->topic_name }}">
                    </div>

                    {{-- <div class="mb-3">
                        <label for="details" class="form-label">รายละเอียด</label>
                        <textarea class="form-control" id="details" name="details">{{ $postDetail->details }}</textarea>
                    </div> --}}
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="รายละเอียด" id="details" name="details">{{ $postDetail->details }}</textarea>
                        </div>
                    </div>

                    <h5>รูปภาพ</h5>
                    @if ($postDetail->photos->isNotEmpty())
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @foreach ($postDetail->photos as $photo)
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <img src="{{ asset('storage/' . $photo->post_photo_file) }}" alt="Image"
                                        style="width:100px; height:100px; object-fit:cover; margin-bottom:10px;">
                                    <label for="delete_photo_{{ $photo->id }}">
                                        <span class="text-danger">ลบ</span>
                                    </label>
                                    <input type="checkbox" name="delete_photo[]" id="delete_photo_{{ $photo->id }}"
                                        value="{{ $photo->id }}">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>ไม่มีรูปภาพ</p>
                    @endif

                    <br>

                    <h5>วิดีโอ</h5>
                    @if ($postDetail->videos->isNotEmpty())
                        @foreach ($postDetail->videos as $video)
                            <div>
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/' . $video->post_video_file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <label for="delete_video_{{ $video->id }}"><span class="text-danger">ลบ</span></label>
                                <input type="checkbox" name="delete_video[]" id="delete_video_{{ $video->id }}"
                                    value="{{ $video->id }}">
                            </div>
                        @endforeach
                    @else
                        <p>ไม่มีวิดีโอ</p>
                    @endif

                    <br>

                    <h5>ไฟล์ PDF</h5>
                    @if ($postDetail->pdfs->isNotEmpty())
                        <ul>
                            @foreach ($postDetail->pdfs as $pdf)
                                <li>
                                    <a href="{{ asset('storage/' . $pdf->post_pdf_file) }}"
                                        target="_blank">{{ basename($pdf->post_pdf_file) }}</a>
                                    <label for="delete_pdf_{{ $pdf->id }}"><span class="text-danger">ลบ</span></label>
                                    <input type="checkbox" name="delete_pdf[]" id="delete_pdf_{{ $pdf->id }}"
                                        value="{{ $pdf->id }}">
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>ไม่มีไฟล์ PDF</p>
                    @endif

                    <br>

                    <h6 class="text-center">
                        <span class="text-danger">#</span> อัปโหลดไฟล์ใหม่
                        (หากต้องการเปลี่ยนไฟล์เดิมให้เลือกไฟล์ที่มีอยู่แล้วตรงนี้ และอัปโหลดไฟล์ใหม่)
                        <span class="text-danger">#</span>
                    </h6>
                    <br>

                    <div class="mb-3">
                        <label for="file_post" class="form-label">แนบไฟล์ภาพและ PDF</label>
                        <input type="file" class="form-control" id="file_post" name="file_post[]" multiple>
                        <small class="text-muted">ประเภทไฟล์ที่รองรับ: jpg, jpeg, png, pdf (ขนาดไม่เกิน 10MB)</small>
                    </div>

                    <div class="mb-3">
                        <label for="file_video" class="form-label">อัปโหลดวิดีโอ</label>
                        <input type="file" class="form-control" id="file_video" name="file_video">
                    </div>

                    <br>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

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
