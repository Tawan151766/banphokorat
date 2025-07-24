<!-- Create Modal for Main Menu -->
<div class="modal fade" id="createMenuModal" tabindex="-1" aria-labelledby="createMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createMenuModalLabel">
                    <i class="fas fa-plus me-2"></i>เพิ่มเมนูหลัก
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('MenuCreate') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body py-4 px-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="main_name" class="form-label fw-bold">ชื่อเมนู <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                    <input type="text" class="form-control" id="main_name" name="main_name" value="{{ old('main_name') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label fw-bold">Link (Path)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}" placeholder="/your-path">
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                               <label for="main_order" class="form-label fw-bold">ลำดับการแสดง</label>
                               <div class="input-group">
                                   <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                   <input type="number" class="form-control" id="main_order" name="main_order" value="{{ old('main_order', 0) }}">
                               </div>
                            </div> -->
                            <input type="hidden" name="level" value="main">
                            <input type="hidden" name="parent_id" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกเมนูหลัก</button>
                </div>
            </form>
        </div>
    </div>
</div>
