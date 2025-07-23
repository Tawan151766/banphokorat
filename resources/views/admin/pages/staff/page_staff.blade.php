@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">จัดการข้อมูลพนักงาน</h4>
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
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                เพิ่มพนักงาน
            </button>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">เพิ่มพนักงาน</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('StaffCreate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">ชื่อ-นามสกุล</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="0xx-xxx-xxxx">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">ระดับตำแหน่ง</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="">เลือกระดับตำแหน่ง</option>
                                                @foreach(\App\Models\Staff::getRoles() as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="department" class="form-label">ตำแหน่ง</label>
                                            <input type="text" class="form-control" id="department" name="department" placeholder="ระบุตำแหน่ง">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="img" class="form-label">รูปภาพ</label>
                                            <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                            <small class="text-muted">รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ตัวอย่างรูปภาพ</label>
                                            <div class="border rounded p-3 text-center" style="min-height: 150px;">
                                                <img id="imagePreview" src="#" alt="ตัวอย่างรูปภาพ" style="max-width: 100%; max-height: 120px; display: none;">
                                                <div id="imagePlaceholder" class="text-muted">
                                                    <i class="fas fa-image fa-3x mb-2"></i>
                                                    <p>ไม่มีรูปภาพ</p>
                                                </div>
                                            </div>
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

            <table id="basic-datatables" class="table table-striped table-hover datatable-th">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">รูปภาพ</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">ระดับตำแหน่ง</th>
                        <th class="text-center">ตำแหน่ง</th>
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $index => $person)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                @if($person->img)
                                    <img src="{{ asset('storage/' . $person->img) }}" alt="{{ $person->full_name }}" 
                                         class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $person->full_name }}</td>
                            <td class="text-center">{{ $person->phone ?? '-' }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    @if($person->role == 'leader') bg-danger
                                    @elseif($person->role == 'coleader') bg-warning
                                    @else bg-info
                                    @endif">
                                    {{ $person->role_name }}
                                </span>
                            </td>
                            <td class="text-center">{{ $person->department ?? '-' }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $person->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('StaffDelete', $person->id) }}"
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

            @foreach ($staff as $person)
                <div class="modal fade" id="editModal-{{ $person->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel-{{ $person->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="margin-top: 5%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel-{{ $person->id }}">แก้ไขข้อมูลพนักงาน</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('StaffUpdate', $person->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="full_name-{{ $person->id }}" class="form-label">ชื่อ-นามสกุล</label>
                                                <input type="text" class="form-control" id="full_name-{{ $person->id }}"
                                                    name="full_name" value="{{ $person->full_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone-{{ $person->id }}" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control" id="phone-{{ $person->id }}"
                                                    name="phone" value="{{ $person->phone }}" placeholder="0xx-xxx-xxxx">
                                            </div>
                                            <div class="mb-3">
                                                <label for="role-{{ $person->id }}" class="form-label">ระดับตำแหน่ง</label>
                                                <select class="form-control" id="role-{{ $person->id }}" name="role" required>
                                                    @foreach(\App\Models\Staff::getRoles() as $key => $value)
                                                        <option value="{{ $key }}" {{ $person->role == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="department-{{ $person->id }}" class="form-label">ตำแหน่ง</label>
                                                <input type="text" class="form-control" id="department-{{ $person->id }}"
                                                    name="department" value="{{ $person->department }}" placeholder="ระบุตำแหน่ง">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="img-{{ $person->id }}" class="form-label">รูปภาพ</label>
                                                <input type="file" class="form-control" id="img-{{ $person->id }}" 
                                                    name="img" accept="image/*" onchange="previewEditImage(this, {{ $person->id }})">
                                                <small class="text-muted">รองรับไฟล์: JPG, PNG, GIF (ขนาดไม่เกิน 2MB)</small>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">รูปภาพปัจจุบัน</label>
                                                <div class="border rounded p-3 text-center" style="min-height: 150px;">
                                                    @if($person->img)
                                                        <img id="editImagePreview-{{ $person->id }}" 
                                                             src="{{ asset('storage/' . $person->img) }}" 
                                                             alt="{{ $person->full_name }}" 
                                                             style="max-width: 100%; max-height: 120px;">
                                                    @else
                                                        <div id="editImagePreview-{{ $person->id }}" class="text-muted">
                                                            <i class="fas fa-image fa-3x mb-2"></i>
                                                            <p>ไม่มีรูปภาพ</p>
                                                        </div>
                                                    @endif
                                                </div>
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

        // Image preview for create modal
        document.getElementById('img').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'block';
            }
        });

        // Image preview for edit modal
        function previewEditImage(input, staffId) {
            const file = input.files[0];
            const preview = document.getElementById('editImagePreview-' + staffId);
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="max-width: 100%; max-height: 120px;">';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush