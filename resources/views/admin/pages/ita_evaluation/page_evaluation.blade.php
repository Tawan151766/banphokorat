@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">การประเมิน ITA</h4>
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
                สร้างการประเมิน ITA
            </button>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="margin-top: 2%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">สร้างการประเมิน ITA</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ItaEvaluationCreate') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-3">ข้อมูลการประเมิน</h6>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">ชื่อ</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">คำอธิบาย</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ita_date" class="form-label">วันที่ประเมิน</label>
                                            <input type="date" class="form-control" id="ita_date" name="ita_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-bold mb-0">เนื้อหา ITA</h6>
                                            <button type="button" class="btn btn-success btn-sm" onclick="addContentRow()">
                                                <i class="fas fa-plus"></i> เพิ่มเนื้อหา
                                            </button>
                                        </div>
                                        <div id="contentContainer">
                                            <div class="content-row mb-3 p-3 border rounded">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">เนื้อหาที่ 1</small>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeContentRow(this)" style="display: none;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">URL</label>
                                                    <input type="url" class="form-control" name="contents[0][url]" placeholder="https://example.com">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">คำอธิบาย</label>
                                                    <textarea class="form-control" name="contents[0][description]" rows="2" placeholder="คำอธิบายเนื้อหา"></textarea>
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
                        <th class="text-center">ชื่อ</th> 
                        <th class="text-center">URL</th>
                        <th class="text-center">คำอธิบาย</th>
                        <th class="text-center">วันที่ประเมิน</th>
                        <!-- <th class="text-center">จำนวนเนื้อหา</th> -->
                        <th class="text-center">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itaEvaluations as $index => $evaluation)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $evaluation->name }}</td>
                           
                            
                            <td>
                                @if($evaluation->contents && $evaluation->contents->count() > 0)
                                    @foreach($evaluation->contents as $content)
                                        <div class="mb-1">
                                            <a href="{{ $content->url }}" target="_blank" class="text-primary text-decoration-none">
                                                <i class="fas fa-external-link-alt me-1"></i>
                                                {{ Str::limit($content->url, 40) }}
                                            </a>
                                          
                                        </div>
                                    @endforeach
                                @else
                                    <span class="text-muted">ไม่มี URL</span>
                                @endif
                            </td> <td>{{ Str::limit($evaluation->description, 50) }}</td><td class="text-center">{{ $evaluation->ita_date ? $evaluation->ita_date->format('d/m/Y') : '-' }}</td>
                            <!-- <td class="text-center">
                                <span class="badge bg-info">{{ $evaluation->contents_count ?? 0 }} รายการ</span>
                            </td> -->
                            <td class="text-center">
                                <a href="{{ route('ItaEvaluationShowContents', $evaluation->id) }}"
                                    class="btn btn-primary btn-sm" title="จัดการเนื้อหา"><i class="bi bi-plus-square"></i></a>

                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $evaluation->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('ItaEvaluationDelete', $evaluation->id) }}"
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

            @foreach ($itaEvaluations as $evaluation)
                <div class="modal fade" id="editModal-{{ $evaluation->id }}" tabindex="-1"
                    aria-labelledby="editModalLabel-{{ $evaluation->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl" style="margin-top: 2%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel-{{ $evaluation->id }}">แก้ไขการประเมิน ITA</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('ItaEvaluationUpdate', $evaluation->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold mb-3">ข้อมูลการประเมิน</h6>
                                            <div class="mb-3">
                                                <label for="name-{{ $evaluation->id }}" class="form-label">ชื่อ</label>
                                                <input type="text" class="form-control" id="name-{{ $evaluation->id }}"
                                                    name="name" value="{{ $evaluation->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description-{{ $evaluation->id }}" class="form-label">คำอธิบาย</label>
                                                <textarea class="form-control" id="description-{{ $evaluation->id }}" name="description" rows="3">{{ $evaluation->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ita_date-{{ $evaluation->id }}" class="form-label">วันที่ประเมิน</label>
                                                <input type="date" class="form-control" id="ita_date-{{ $evaluation->id }}"
                                                    name="ita_date" value="{{ $evaluation->ita_date ? $evaluation->ita_date->format('Y-m-d') : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0">เนื้อหา ITA</h6>
                                                <button type="button" class="btn btn-success btn-sm" onclick="addEditContentRow({{ $evaluation->id }})">
                                                    <i class="fas fa-plus"></i> เพิ่มเนื้อหา
                                                </button>
                                            </div>
                                            <div id="editContentContainer-{{ $evaluation->id }}">
                                                @if($evaluation->contents && $evaluation->contents->count() > 0)
                                                    @foreach($evaluation->contents as $index => $content)
                                                        <div class="edit-content-row mb-3 p-3 border rounded">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <small class="text-muted">เนื้อหาที่ {{ $index + 1 }}</small>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeEditContentRow(this, {{ $evaluation->id }})" {{ $evaluation->contents->count() <= 1 ? 'style=display:none;' : '' }}>
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                            <input type="hidden" name="contents[{{ $index }}][id]" value="{{ $content->id }}">
                                                            <div class="mb-2">
                                                                <label class="form-label">URL</label>
                                                                <input type="url" class="form-control" name="contents[{{ $index }}][url]" value="{{ $content->url }}" placeholder="https://example.com">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label">คำอธิบาย</label>
                                                                <textarea class="form-control" name="contents[{{ $index }}][description]" rows="2" placeholder="คำอธิบายเนื้อหา">{{ $content->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="edit-content-row mb-3 p-3 border rounded">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <small class="text-muted">เนื้อหาที่ 1</small>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeEditContentRow(this, {{ $evaluation->id }})" style="display: none;">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">URL</label>
                                                            <input type="url" class="form-control" name="contents[0][url]" placeholder="https://example.com">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label">คำอธิบาย</label>
                                                            <textarea class="form-control" name="contents[0][description]" rows="2" placeholder="คำอธิบายเนื้อหา"></textarea>
                                                        </div>
                                                    </div>
                                                @endif
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

        let contentIndex = 1;

        function addContentRow() {
            const container = document.getElementById('contentContainer');
            const newRow = document.createElement('div');
            newRow.className = 'content-row mb-3 p-3 border rounded';
            newRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">เนื้อหาที่ ${contentIndex + 1}</small>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeContentRow(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <label class="form-label">URL</label>
                    <input type="url" class="form-control" name="contents[${contentIndex}][url]" placeholder="https://example.com">
                </div>
                <div class="mb-2">
                    <label class="form-label">คำอธิบาย</label>
                    <textarea class="form-control" name="contents[${contentIndex}][description]" rows="2" placeholder="คำอธิบายเนื้อหา"></textarea>
                </div>
            `;
            container.appendChild(newRow);
            contentIndex++;
            updateRemoveButtons();
        }

        function removeContentRow(button) {
            const row = button.closest('.content-row');
            row.remove();
            updateRemoveButtons();
            reindexContentRows();
        }

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.content-row');
            rows.forEach((row, index) => {
                const removeBtn = row.querySelector('.btn-danger');
                if (rows.length > 1) {
                    removeBtn.style.display = 'inline-block';
                } else {
                    removeBtn.style.display = 'none';
                }
                
                // Update row number
                const label = row.querySelector('.text-muted');
                label.textContent = `เนื้อหาที่ ${index + 1}`;
            });
        }

        function reindexContentRows() {
            const rows = document.querySelectorAll('.content-row');
            rows.forEach((row, index) => {
                const urlInput = row.querySelector('input[type="url"]');
                const textareaInput = row.querySelector('textarea');
                
                urlInput.name = `contents[${index}][url]`;
                textareaInput.name = `contents[${index}][description]`;
            });
            contentIndex = rows.length;
        }

        // Edit Modal Functions
        let editContentIndexes = {};

        function addEditContentRow(evaluationId) {
            const container = document.getElementById(`editContentContainer-${evaluationId}`);
            const currentRows = container.querySelectorAll('.edit-content-row');
            const newIndex = currentRows.length;
            
            if (!editContentIndexes[evaluationId]) {
                editContentIndexes[evaluationId] = newIndex;
            } else {
                editContentIndexes[evaluationId]++;
            }

            const newRow = document.createElement('div');
            newRow.className = 'edit-content-row mb-3 p-3 border rounded';
            newRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">เนื้อหาที่ ${newIndex + 1}</small>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeEditContentRow(this, ${evaluationId})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <label class="form-label">URL</label>
                    <input type="url" class="form-control" name="contents[${newIndex}][url]" placeholder="https://example.com">
                </div>
                <div class="mb-2">
                    <label class="form-label">คำอธิบาย</label>
                    <textarea class="form-control" name="contents[${newIndex}][description]" rows="2" placeholder="คำอธิบายเนื้อหา"></textarea>
                </div>
            `;
            container.appendChild(newRow);
            updateEditRemoveButtons(evaluationId);
        }

        function removeEditContentRow(button, evaluationId) {
            const row = button.closest('.edit-content-row');
            row.remove();
            updateEditRemoveButtons(evaluationId);
            reindexEditContentRows(evaluationId);
        }

        function updateEditRemoveButtons(evaluationId) {
            const container = document.getElementById(`editContentContainer-${evaluationId}`);
            const rows = container.querySelectorAll('.edit-content-row');
            
            rows.forEach((row, index) => {
                const removeBtn = row.querySelector('.btn-danger');
                if (rows.length > 1) {
                    removeBtn.style.display = 'inline-block';
                } else {
                    removeBtn.style.display = 'none';
                }
                
                // Update row number
                const label = row.querySelector('.text-muted');
                label.textContent = `เนื้อหาที่ ${index + 1}`;
            });
        }

        function reindexEditContentRows(evaluationId) {
            const container = document.getElementById(`editContentContainer-${evaluationId}`);
            const rows = container.querySelectorAll('.edit-content-row');
            
            rows.forEach((row, index) => {
                const hiddenInput = row.querySelector('input[type="hidden"]');
                const urlInput = row.querySelector('input[type="url"]');
                const textareaInput = row.querySelector('textarea');
                
                if (hiddenInput) {
                    hiddenInput.name = `contents[${index}][id]`;
                }
                urlInput.name = `contents[${index}][url]`;
                textareaInput.name = `contents[${index}][description]`;
            });
            
            editContentIndexes[evaluationId] = rows.length;
        }
    </script>
@endpush