@php
    if (!request()->has('type')) {
        header("Location: " . request()->url() . "?type=main");
        exit;
    }
@endphp
@extends('admin.layouts.kaiadmin')
@section('content')
    <div class="page-header mb-2">
        <h4 class="fw-bold mb-2 me-3">จัดการเมนู</h4>
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
            <div class="d-flex flex-wrap align-items-center mb-2 gap-2">
                <div class="d-flex align-items-stretch gap-2">
                    <button type="button" class="btn btn-primary btn-sm h-100 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createMenuModal">
                        เพิ่มเมนู
                    </button>
    @include('admin.pages.menu.create_modal')
                    <form method="GET" action="" class="d-inline-block h-100">
                        <select name="type" id="menuType" class="form-select form-select-sm h-100" onchange="this.form.submit()" style="min-height: 32px;">
                            <!-- <option value="" {{ request('type')=='' ? 'selected' : '' }}>ทั้งหมด</option> -->
                            <option value="main" {{ request('type')=='main' ? 'selected' : '' }}>เมนูหลัก</option>
                            <option value="sub" {{ request('type')=='sub' ? 'selected' : '' }}>เมนูย่อย</option>
                            <option value="smallsub" {{ request('type')=='smallsub' ? 'selected' : '' }}>เมนูเล็กย่อย</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="menu-ita-datatable" class="table table-striped table-hover datatable-th">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">ชื่อเมนู</th>
                            <th class="text-center">ระดับ</th>
                            <th class="text-center">ไฟล์แนบ</th>
                            <th class="text-center">การจัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $index => $menu)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    {{ $menu->name }}

                                </td>
                                <td class="text-center">
                                    @php
                                        $type = request('type');
                                        $level = $menu->level;
                                    @endphp
                                    @if($type === 'main' || ($type === '' && $level === 'main'))
                                        <span class="badge bg-primary">เมนูหลัก</span>
                                    @elseif($type === 'sub' || ($type === '' && $level === 'sub'))
                                        <span class="badge bg-success">เมนูย่อย</span>
                                    @elseif($type === 'smallsub' || $type === 'small_sub' || ($type === '' && $level === 'small_sub'))
                                        <span class="badge bg-warning text-dark">เมนูเล็กย่อย</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td class="text-center">-</td>
                                <td class="text-center">
                                    <a href="{{ route('MenuAttachments', $menu->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-paperclip"></i> ไฟล์แนบ ({{ $menu->attachments->count() }})
                                    </a>
                                    <!-- ปุ่มเพิ่มเมนูย่อย/เล็กย่อยถูกลบออก -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $menu->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
    <!-- Edit Modal -->
    @include('admin.pages.menu.partials.edit_modal', ['menu' => $menu])
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $menu->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if($menus->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center text-muted">ไม่มีเมนูหลัก</td>
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
    $('#menu-ita-datatable').DataTable({
        language: datatableLangs['th']
    });
});
</script>
<script>
// Modal create menu: dynamic submenu/smallsubmenu
document.addEventListener('click', function(e) {
    // Add submenu
    if (e.target && e.target.id === 'btn-add-submenu-create') {
        const submenuList = document.getElementById('submenu-list-create');
        if (!submenuList) return;
        const empty = submenuList.querySelector('input[name^="sub_menus"][name$="[name]"][value=""]');
        if (empty) return;
        const subId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
        const li = document.createElement('li');
        li.className = 'mb-2 submenu-row';
        li.innerHTML = `
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text bg-light"><i class="fas fa-caret-right"></i></span>
                <input type="hidden" name="sub_menus[${subId}][id]" value="">
                <input type="text" class="form-control" name="sub_menus[${subId}][name]" value="" placeholder="ชื่อเมนูย่อย">
                <button type="button" class="btn btn-outline-danger btn-remove-submenu"><i class="fas fa-trash"></i></button>
            </div>
            <ul class="mb-0 ps-4" id="smallsubmenu-list-${subId}"></ul>
            <button type="button" class="btn btn-outline-success btn-sm mt-1 btn-add-smallsubmenu" data-sub-id="${subId}"><i class="fas fa-plus"></i> เพิ่มเมนูเล็กย่อย</button>
        `;
        submenuList.appendChild(li);
    }
    // Remove submenu
    if (e.target && e.target.closest('.btn-remove-submenu')) {
        e.target.closest('.submenu-row').remove();
    }
    // Add small submenu
    if (e.target && e.target.closest('.btn-add-smallsubmenu')) {
        const btn = e.target.closest('.btn-add-smallsubmenu');
        const subId = btn.getAttribute('data-sub-id');
        const smallsubmenuList = document.getElementById('smallsubmenu-list-' + subId);
        if (!smallsubmenuList) return;
        const empty = smallsubmenuList.querySelector('input[name^="small_sub_menus"][name$="[name]"][value=""]');
        if (empty) return;
        const smallId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
        const li = document.createElement('li');
        li.className = 'mb-1 smallsubmenu-row';
        li.innerHTML = `
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-angle-double-right"></i></span>
                <input type="hidden" name="small_sub_menus[${subId}][${smallId}][id]" value="">
                <input type="text" class="form-control" name="small_sub_menus[${subId}][${smallId}][name]" value="" placeholder="ชื่อเมนูเล็กย่อย">
                <button type="button" class="btn btn-outline-danger btn-remove-smallsubmenu"><i class="fas fa-trash"></i></button>
            </div>
        `;
        smallsubmenuList.appendChild(li);
    }
    // Remove small submenu
    if (e.target && e.target.closest('.btn-remove-smallsubmenu')) {
        e.target.closest('.smallsubmenu-row').remove();
    }
});
</script>
<script>
// Modal create menu: dynamic submenu/smallsubmenu
document.addEventListener('click', function(e) {
    // Add submenu
    if (e.target && e.target.id === 'btn-add-submenu-create') {
        const submenuList = document.getElementById('submenu-list-create');
        if (!submenuList) return;
        const empty = submenuList.querySelector('input[name^="sub_menus"][name$="[name]"][value=""]');
        if (empty) return;
        const subId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
        const li = document.createElement('li');
        li.className = 'mb-2 submenu-row';
        li.innerHTML = `
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text bg-light"><i class="fas fa-caret-right"></i></span>
                <input type="hidden" name="sub_menus[${subId}][id]" value="">
                <input type="text" class="form-control" name="sub_menus[${subId}][name]" value="" placeholder="ชื่อเมนูย่อย">
                <button type="button" class="btn btn-outline-danger btn-remove-submenu"><i class="fas fa-trash"></i></button>
            </div>
            <ul class="mb-0 ps-4" id="smallsubmenu-list-${subId}"></ul>
            <button type="button" class="btn btn-outline-success btn-sm mt-1 btn-add-smallsubmenu" data-sub-id="${subId}"><i class="fas fa-plus"></i> เพิ่มเมนูเล็กย่อย</button>
        `;
        submenuList.appendChild(li);
    }
    // Remove submenu
    if (e.target && e.target.closest('.btn-remove-submenu')) {
        e.target.closest('.submenu-row').remove();
    }
    // Add small submenu
    if (e.target && e.target.closest('.btn-add-smallsubmenu')) {
        const btn = e.target.closest('.btn-add-smallsubmenu');
        const subId = btn.getAttribute('data-sub-id');
        const smallsubmenuList = document.getElementById('smallsubmenu-list-' + subId);
        if (!smallsubmenuList) return;
        const empty = smallsubmenuList.querySelector('input[name^="small_sub_menus"][name$="[name]"][value=""]');
        if (empty) return;
        const smallId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
        const li = document.createElement('li');
        li.className = 'mb-1 smallsubmenu-row';
        li.innerHTML = `
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light"><i class="fas fa-angle-double-right"></i></span>
                <input type="hidden" name="small_sub_menus[${subId}][${smallId}][id]" value="">
                <input type="text" class="form-control" name="small_sub_menus[${subId}][${smallId}][name]" value="" placeholder="ชื่อเมนูเล็กย่อย">
                <button type="button" class="btn btn-outline-danger btn-remove-smallsubmenu"><i class="fas fa-trash"></i></button>
            </div>
        `;
        smallsubmenuList.appendChild(li);
    }
    // Remove small submenu
    if (e.target && e.target.closest('.btn-remove-smallsubmenu')) {
        e.target.closest('.smallsubmenu-row').remove();
    }
});
</script>
<script>
    function openAddSubMenuModal(menuId, menuName) {
        document.getElementById('parentMenuId').value = menuId;
        document.getElementById('parentMenuName').textContent = menuName;
        document.getElementById('subMenuName').value = '';
        document.getElementById('subMenuOrder').value = 0;
        var modal = new bootstrap.Modal(document.getElementById('addSubMenuModal'));
        modal.show();
    }
    function confirmDelete(id) {
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "การลบเมนูนี้จะลบเมนูย่อยและไฟล์แนบทั้งหมดด้วย!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ลบเลย!',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `{{ url('/Admin/Menu') }}/${id}/delete`;
                form.submit();
            }
        });
    }
</script>
@endpush