<!-- Edit Modal for Menu ID: {{ $menu->id }} -->
<div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $menu->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel{{ $menu->id }}">
                    <i class="fas fa-edit me-2"></i>แก้ไขเมนู: <span class="fw-bold">{{ $menu->name }}</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('MenuUpdate', $menu->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body py-4 px-4">
                    <div class="row g-4">
                        <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="edit_name{{ $menu->id }}" class="form-label fw-bold">ชื่อเมนู <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-bars"></i></span>
                                            <input type="text" class="form-control" id="edit_name{{ $menu->id }}" name="name" value="{{ $menu->name }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_link{{ $menu->id }}" class="form-label fw-bold">Link (Path)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            <input type="text" class="form-control" id="edit_link{{ $menu->id }}" name="link" value="{{ $menu->link }}" placeholder="/your-path">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">เมนูย่อย (แก้ไขได้):</label>
                                        <ul class="mb-1 ps-3 small" id="submenu-list-{{ $menu->id }}">
                                            @if($menu->children && $menu->children->count())
                                                @foreach($menu->children as $sub)
                                                    <li class="mb-2 submenu-row">
                                                        <div class="input-group input-group-sm mb-1">
                                                            <span class="input-group-text bg-light"><i class="fas fa-caret-right"></i></span>
                                                            <input type="hidden" name="sub_menus[{{ $sub->id }}][id]" value="{{ $sub->id }}">
                                                            <input type="text" class="form-control" name="sub_menus[{{ $sub->id }}][name]" value="{{ $sub->name }}" placeholder="ชื่อเมนูย่อย">
                                                            <input type="text" class="form-control" name="sub_menus[{{ $sub->id }}][link]" value="{{ $sub->link }}" placeholder="Link (Path)">
                                                            <button type="button" class="btn btn-outline-danger btn-remove-submenu"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                        <ul class="mb-0 ps-4" id="smallsubmenu-list-{{ $sub->id }}">
                                                            @if($sub->smallSubs && $sub->smallSubs->count())
                                                                @foreach($sub->smallSubs as $small)
                                                                    <li class="mb-1 smallsubmenu-row">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-text bg-light"><i class="fas fa-angle-double-right"></i></span>
                                                                            <input type="hidden" name="small_sub_menus[{{ $sub->id }}][{{ $small->id }}][id]" value="{{ $small->id }}">
                                                                            <input type="text" class="form-control" name="small_sub_menus[{{ $sub->id }}][{{ $small->id }}][name]" value="{{ $small->name }}" placeholder="ชื่อเมนูเล็กย่อย">
                                                                            <input type="text" class="form-control" name="small_sub_menus[{{ $sub->id }}][{{ $small->id }}][link]" value="{{ $small->link }}" placeholder="Link (Path)">
                                                                            <button type="button" class="btn btn-outline-danger btn-remove-smallsubmenu"><i class="fas fa-trash"></i></button>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        <button type="button" class="btn btn-outline-success btn-sm mt-1 btn-add-smallsubmenu" data-sub-id="{{ $sub->id }}">
                                                            <i class="fas fa-plus"></i> เพิ่มเมนูเล็กย่อย
                                                        </button>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="btn-add-submenu-{{ $menu->id }}">
                                            <i class="fas fa-plus"></i> เพิ่มเมนูย่อย
                                        </button>
                                    </div>
                                    <div class="mb-3">
                            @if($menu->level !== 'main')
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="edit_level{{ $menu->id }}" class="form-label fw-bold">ระดับเมนู</label>
                                        <select class="form-select" id="edit_level{{ $menu->id }}" name="level" required>
                                            <option value="main" {{ $menu->level == 'main' ? 'selected' : '' }}>เมนูหลัก</option>
                                            <option value="sub" {{ $menu->level == 'sub' ? 'selected' : '' }}>เมนูย่อย</option>
                                            <option value="small_sub" {{ $menu->level == 'small_sub' ? 'selected' : '' }}>เมนูย่อยเล็ก</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="level" value="main">
                            @endif
                        </div>
                        <div class="col-md-12">
                            @if($menu->level !== 'main')
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="edit_parent_id{{ $menu->id }}" class="form-label fw-bold">เมนูหลัก (ถ้ามี)</label>
                                        <select class="form-select" id="edit_parent_id{{ $menu->id }}" name="parent_id">
                                            <option value="">ไม่มีเมนูหลัก</option>
                                            @foreach($menus as $parentMenu)
                                                @if($parentMenu->id != $menu->id)
                                                    <option value="{{ $parentMenu->id }}" {{ $menu->parent_id == $parentMenu->id ? 'selected' : '' }}>
                                                        {{ $parentMenu->name }}
                                                    </option>
                                                    @foreach($parentMenu->children as $child)
                                                        @if($child->id != $menu->id)
                                                            <option value="{{ $child->id }}" {{ $menu->parent_id == $child->id ? 'selected' : '' }}>
                                                                -- {{ $child->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_order_no{{ $menu->id }}" class="form-label fw-bold">ลำดับการแสดง</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-sort-numeric-down"></i></span>
                                            <input type="number" class="form-control" id="edit_order_no{{ $menu->id }}" name="order_no" value="{{ $menu->order_no }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <input type="hidden" name="parent_id" value="">
                                <input type="hidden" name="order_no" value="{{ $menu->order_no }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                </div>
            </form>
            <script>
            // Inline script for dynamic submenu/smallsubmenu in edit modal (fix small_sub_menus name)
            (function(menuId) {
                var addSubBtn = document.getElementById('btn-add-submenu-' + menuId);
                var submenuList = document.getElementById('submenu-list-' + menuId);
                if (!addSubBtn || !submenuList) return;
                addSubBtn.onclick = function() {
                    var subId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
                    var li = document.createElement('li');
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
                };
                submenuList.onclick = function(e) {
                    if (e.target.closest('.btn-remove-submenu')) {
                        e.target.closest('.submenu-row').remove();
                    }
                    if (e.target.closest('.btn-add-smallsubmenu')) {
                        var btn = e.target.closest('.btn-add-smallsubmenu');
                        var subId = btn.getAttribute('data-sub-id');
                        var smallsubmenuList = document.getElementById('smallsubmenu-list-' + subId);
                        if (!smallsubmenuList) return;
                        var smallId = 'new_' + Date.now() + '_' + Math.floor(Math.random()*1000);
                        var li = document.createElement('li');
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
                    if (e.target.closest('.btn-remove-smallsubmenu')) {
                        e.target.closest('.smallsubmenu-row').remove();
                    }
                };
            })({{ $menu->id }});
            </script>

        </div>
    </div>
</div>