<?php
namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminMenuController extends Controller
{
    public function SmallSubMenuCreatePage(Request $request)
    {
        $parentId = $request->input('parent_id');
        $parentMenu = null;
        if ($parentId) {
            $parentMenu = \App\Models\Menu::find($parentId);
        }
        return view('admin.pages.menu.create_smallsub', compact('parentId', 'parentMenu'));
    }

    public function SmallSubMenuCreate(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:menus,id',
            'small_sub_menus' => 'required|array|min:1',
            'small_sub_menus.*.name' => 'required|string|max:255',
            'small_sub_menus.*.order' => 'nullable|integer|min:0',
        ], [
            'parent_id.required' => 'ไม่พบเมนูย่อย',
            'parent_id.exists' => 'ไม่พบเมนูย่อย',
            'small_sub_menus.required' => 'กรุณากรอกเมนูเล็กย่อยอย่างน้อย 1 รายการ',
            'small_sub_menus.*.name.required' => 'กรุณาระบุชื่อเมนูเล็กย่อย',
            'small_sub_menus.*.name.max' => 'ชื่อเมนูเล็กย่อยต้องไม่เกิน 255 ตัวอักษร',
        ]);

        try {
            foreach ($request->small_sub_menus as $smallSubMenuData) {
                if (!empty($smallSubMenuData['name'])) {
                    \App\Models\Menu::create([
                        'name' => $smallSubMenuData['name'],
                        'parent_id' => $request->parent_id,
                        'level' => 'small_sub',
                        'order_no' => $smallSubMenuData['order'] ?? 0
                    ]);
                }
            }
            return redirect()->route('MenuIndex')->with('success', 'เพิ่มเมนูเล็กย่อยสำเร็จ');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()])->withInput();
        }
    }
    public function SubMenuCreate(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:menus,id',
            'sub_menus' => 'required|array|min:1',
            'sub_menus.*.name' => 'required|string|max:255',
            'sub_menus.*.order' => 'nullable|integer|min:0',
        ], [
            'parent_id.required' => 'ไม่พบเมนูหลัก',
            'parent_id.exists' => 'ไม่พบเมนูหลัก',
            'sub_menus.required' => 'กรุณากรอกเมนูย่อยอย่างน้อย 1 รายการ',
            'sub_menus.*.name.required' => 'กรุณาระบุชื่อเมนูย่อย',
            'sub_menus.*.name.max' => 'ชื่อเมนูย่อยต้องไม่เกิน 255 ตัวอักษร',
        ]);

        try {
            foreach ($request->sub_menus as $subMenuData) {
                if (!empty($subMenuData['name'])) {
                    Menu::create([
                        'name' => $subMenuData['name'],
                        'parent_id' => $request->parent_id,
                        'level' => 'sub',
                        'order_no' => $subMenuData['order'] ?? 0
                    ]);
                }
            }
            return redirect()->route('MenuIndex')->with('success', 'เพิ่มเมนูย่อยสำเร็จ');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()])->withInput();
        }
    }
    public function SubMenuCreatePage(Request $request)
    {
        $parentId = $request->input('parent_id');
        $parentMenu = null;
        if ($parentId) {
            $parentMenu = \App\Models\Menu::find($parentId);
        }
        return view('admin.pages.menu.create_sub', compact('parentId', 'parentMenu'));
    }
    public function MenuIndex()
    {
        $type = request('type');
        $query = Menu::with(['children', 'attachments']);
        if ($type === 'main') {
            $query = $query->mainMenus();
        } elseif ($type === 'sub') {
            $query = $query->subMenus();
        } elseif ($type === 'smallsub' || $type === 'small_sub') {
            $query = $query->where('level', 'small_sub')->orderBy('order_no');
        } else {
            $query = $query->orderBy('order_no');
        }
        $menus = $query->get();
        return view('admin.pages.menu.index', compact('menus'));
    }

    public function MenuCreatePage()
    {
        $allMenus = Menu::with(['children' => function($query) {
            $query->orderBy('order_no');
        }])->mainMenus()->get();
        
        return view('admin.pages.menu.create', compact('allMenus'));
    }

    public function MenuCreate(Request $request)
    {
        $rules = [
            'main_name' => 'required|string|max:255',
            'main_order' => 'nullable|integer|min:0',
            'sub_menus.*.name' => 'nullable|string|max:255',
            'sub_menus.*.order' => 'nullable|integer|min:0',
            'small_sub_menus.*.name' => 'nullable|string|max:255',
            'small_sub_menus.*.parent_type' => 'nullable|in:main,sub',
            'small_sub_menus.*.parent_id' => 'nullable',
            'small_sub_menus.*.order' => 'nullable|integer|min:0'
        ];

        $messages = [
            'main_name.required' => 'กรุณาระบุชื่อเมนูหลัก',
            'main_name.max' => 'ชื่อเมนูหลักต้องไม่เกิน 255 ตัวอักษร',
            'sub_menus.*.name.max' => 'ชื่อเมนูย่อยต้องไม่เกิน 255 ตัวอักษร',
            'small_sub_menus.*.name.max' => 'ชื่อเมนูย่อยเล็กต้องไม่เกิน 255 ตัวอักษร',
            'main_order.integer' => 'ลำดับการแสดงต้องเป็นตัวเลข',
            'main_order.min' => 'ลำดับการแสดงต้องไม่น้อยกว่า 0'
        ];

        $request->validate($rules, $messages);

        try {
            \DB::beginTransaction();

            $mainMenu = Menu::create([
                'name' => $request->main_name,
                'link' => $request->link,
                'parent_id' => null,
                'level' => 'main',
                'order_no' => $request->main_order ?? 0
            ]);

            $createdMenus = ['main' => $mainMenu];
            $subMenuIds = [];

            if ($request->has('sub_menus')) {
                foreach ($request->sub_menus as $index => $subMenuData) {
                    if (!empty($subMenuData['name'])) {
                        $subMenu = Menu::create([
                            'name' => $subMenuData['name'],
                            'parent_id' => $mainMenu->id,
                            'level' => 'sub',
                            'order_no' => $subMenuData['order'] ?? 0
                        ]);
                        $subMenuIds["new_sub_{$index}"] = $subMenu->id;
                        $createdMenus['sub'][] = $subMenu;
                    }
                }
            }

            if ($request->has('small_sub_menus')) {
                $smallSubMenus = $request->small_sub_menus;
                $is2D = false;
                foreach ($smallSubMenus as $v) {
                    if (is_array($v)) {
                        $is2D = true;
                        break;
                    }
                }
                if ($is2D) {
                    foreach ($smallSubMenus as $parentIdx => $smallSubArr) {
                        if (!is_array($smallSubArr)) continue;
                        foreach ($smallSubArr as $smallSubMenuData) {
                            if (!empty($smallSubMenuData['name'])) {
                                $parentId = null;
                                if (($smallSubMenuData['parent_type'] ?? null) === 'main') {
                                    $parentId = $mainMenu->id;
                                } elseif (($smallSubMenuData['parent_type'] ?? null) === 'sub') {
                                    $selectedParentId = $smallSubMenuData['parent_id'] ?? null;
                                    if (strpos($selectedParentId, 'new_sub_') === 0) {
                                        $parentId = $subMenuIds[$selectedParentId] ?? null;
                                    } else {
                                        $parentId = $selectedParentId;
                                    }
                                }
                                if ($parentId) {
                                    $smallSubMenu = Menu::create([
                                        'name' => $smallSubMenuData['name'],
                                        'parent_id' => $parentId,
                                        'level' => 'small_sub',
                                        'order_no' => $smallSubMenuData['order'] ?? 0
                                    ]);
                                    $createdMenus['small_sub'][] = $smallSubMenu;
                                }
                            }
                        }
                    }
                } else {
                    foreach ($smallSubMenus as $smallSubMenuData) {
                        if (!empty($smallSubMenuData['name'])) {
                            $parentId = null;
                            if (($smallSubMenuData['parent_type'] ?? null) === 'main') {
                                $parentId = $mainMenu->id;
                            } elseif (($smallSubMenuData['parent_type'] ?? null) === 'sub') {
                                $selectedParentId = $smallSubMenuData['parent_id'] ?? null;
                                if (strpos($selectedParentId, 'new_sub_') === 0) {
                                    $parentId = $subMenuIds[$selectedParentId] ?? null;
                                } else {
                                    $parentId = $selectedParentId;
                                }
                            }
                            if ($parentId) {
                                $smallSubMenu = Menu::create([
                                    'name' => $smallSubMenuData['name'],
                                    'parent_id' => $parentId,
                                    'level' => 'small_sub',
                                    'order_no' => $smallSubMenuData['order'] ?? 0
                                ]);
                                $createdMenus['small_sub'][] = $smallSubMenu;
                            }
                        }
                    }
                }
            }

            \DB::commit();

            $successMessage = 'สร้างเมนู "' . $request->main_name . '" สำเร็จ';
            
            $subCount = isset($createdMenus['sub']) ? count($createdMenus['sub']) : 0;
            $smallSubCount = isset($createdMenus['small_sub']) ? count($createdMenus['small_sub']) : 0;
            
            if ($subCount > 0) {
                $successMessage .= ' พร้อมเมนูย่อย ' . $subCount . ' รายการ';
            }
            if ($smallSubCount > 0) {
                $successMessage .= ' และเมนูย่อยเล็ก ' . $smallSubCount . ' รายการ';
            }

            return redirect()->route('MenuIndex')->with('success', $successMessage);

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()
                ->withErrors(['error' => 'เกิดข้อผิดพลาดในการสร้างเมนู: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function MenuUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'level' => 'required|in:main,sub,small_sub',
            'order_no' => 'nullable|integer'
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update([
            'name' => $request->name,
            'link' => $request->link,
            'parent_id' => $request->parent_id,
            'level' => $request->level,
            'order_no' => $request->order_no ?? 0
        ]);

        $existingSubIds = $menu->children()->where('level', 'sub')->pluck('id')->toArray();
        $sentSubIds = [];
        $tempSubIdMap = [];
        if ($request->has('sub_menus')) {
            foreach ($request->sub_menus as $subKey => $subData) {
                // Update existing sub-menu
                if (!empty($subData['id']) && isset($subData['name'])) {
                    $subMenu = Menu::find($subData['id']);
                    if ($subMenu) {
                        $subMenu->update([
                            'name' => $subData['name'],
                            'link' => $subData['link'] ?? null
                        ]);
                        $sentSubIds[] = $subMenu->id;
                        $tempSubIdMap[$subData['id']] = $subMenu->id;
                    }
                }
                // Create new sub-menu (id is empty or temp)
                elseif (empty($subData['id']) && isset($subData['name']) && trim($subData['name']) !== '') {
                    $newSub = Menu::create([
                        'name' => $subData['name'],
                        'link' => $subData['link'] ?? null,
                        'parent_id' => $menu->id,
                        'level' => 'sub',
                        'order_no' => 0
                    ]);
                    $sentSubIds[] = $newSub->id;
                    $tempSubIdMap[$subKey] = $newSub->id;
                }
            }
        }
        $toDeleteSubIds = array_diff($existingSubIds, $sentSubIds);
        if (!empty($toDeleteSubIds)) {
            Menu::whereIn('id', $toDeleteSubIds)->delete();
        }

        $existingSmallIds = $menu->children()->with('smallSubs')->get()->pluck('smallSubs')->flatten()->pluck('id')->toArray();
        $sentSmallIds = [];
        if ($request->has('small_sub_menus')) {
            foreach ($request->small_sub_menus as $parentId => $smallArr) {
                if (!is_array($smallArr)) continue;
                $realParentId = $parentId;
                if (!is_numeric($parentId) && isset($tempSubIdMap[$parentId])) {
                    $realParentId = $tempSubIdMap[$parentId];
                }
                foreach ($smallArr as $smallKey => $smallData) {
                    if (!empty($smallData['id']) && isset($smallData['name'])) {
                        $smallSub = Menu::find($smallData['id']);
                        if ($smallSub) {
                            $smallSub->update([
                                'name' => $smallData['name'],
                                'link' => $smallData['link'] ?? null
                            ]);
                            $sentSmallIds[] = $smallSub->id;
                        }
                    }
                    elseif (empty($smallData['id']) && isset($smallData['name']) && trim($smallData['name']) !== '') {
                        $newSmall = Menu::create([
                            'name' => $smallData['name'],
                            'link' => $smallData['link'] ?? null,
                            'parent_id' => is_numeric($realParentId) ? $realParentId : null,
                            'level' => 'small_sub',
                            'order_no' => 0
                        ]);
                        $sentSmallIds[] = $newSmall->id;
                    }
                }
            }
        }

        $toDeleteSmallIds = array_diff($existingSmallIds, $sentSmallIds);
        if (!empty($toDeleteSmallIds)) {
            Menu::whereIn('id', $toDeleteSmallIds)->delete();
        }

        return redirect()->back()->with('success', 'อัพเดทเมนูสำเร็จ');
    }

   
    public function MenuDelete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->back()->with('success', 'ลบเมนูสำเร็จ');
    }

    public function MenuAttachments($menuId)
    {
        $menu = Menu::with('attachments')->findOrFail($menuId);
        return view('admin.pages.menu.attachments', compact('menu'));
    }


    public function AttachmentCreate(Request $request, $menuId)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'word_file' => 'nullable|file|mimes:doc,docx|max:10240',
            'excel_file' => 'nullable|file|mimes:xls,xlsx|max:10240',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5120'
        ]);

        $attachment = new MenuAttachment();
        $attachment->menu_id = $menuId;
        $attachment->title = $request->title;

        // อัพโหลดไฟล์
        if ($request->hasFile('word_file')) {
            $attachment->word_file = $request->file('word_file')->store('menu_attachments/word', 'public');
        }
        if ($request->hasFile('excel_file')) {
            $attachment->excel_file = $request->file('excel_file')->store('menu_attachments/excel', 'public');
        }
        if ($request->hasFile('pdf_file')) {
            $attachment->pdf_file = $request->file('pdf_file')->store('menu_attachments/pdf', 'public');
        }
        if ($request->hasFile('image_file')) {
            $attachment->image_file = $request->file('image_file')->store('menu_attachments/images', 'public');
        }

        $attachment->save();

        return redirect()->back()->with('success', 'เพิ่มไฟล์แนบสำเร็จ');
    }

    // ลบไฟล์แนบ
    public function AttachmentDelete($id)
    {
        $attachment = MenuAttachment::findOrFail($id);
        
        // ลบไฟล์จาก storage
        if ($attachment->word_file) Storage::disk('public')->delete($attachment->word_file);
        if ($attachment->excel_file) Storage::disk('public')->delete($attachment->excel_file);
        if ($attachment->pdf_file) Storage::disk('public')->delete($attachment->pdf_file);
        if ($attachment->image_file) Storage::disk('public')->delete($attachment->image_file);

        $attachment->delete();

        return redirect()->back()->with('success', 'ลบไฟล์แนบสำเร็จ');
    }
    public function AttachmentUpdate(Request $request, $menuId, $attachmentId)
    {
        $attachment = MenuAttachment::where('menu_id', $menuId)->findOrFail($attachmentId);
        $request->validate([
            'title' => 'nullable|string|max:255',
            'word_file' => 'nullable|file|mimes:doc,docx|max:10240',
            'excel_file' => 'nullable|file|mimes:xls,xlsx|max:10240',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5120'
        ]);

        $attachment->title = $request->title;

        // if prev file delete then upload
        if ($request->hasFile('word_file')) {
            if ($attachment->word_file) Storage::disk('public')->delete($attachment->word_file);
            $attachment->word_file = $request->file('word_file')->store('menu_attachments/word', 'public');
        }
        if ($request->hasFile('excel_file')) {
            if ($attachment->excel_file) Storage::disk('public')->delete($attachment->excel_file);
            $attachment->excel_file = $request->file('excel_file')->store('menu_attachments/excel', 'public');
        }
        if ($request->hasFile('pdf_file')) {
            if ($attachment->pdf_file) Storage::disk('public')->delete($attachment->pdf_file);
            $attachment->pdf_file = $request->file('pdf_file')->store('menu_attachments/pdf', 'public');
        }
        if ($request->hasFile('image_file')) {
            if ($attachment->image_file) Storage::disk('public')->delete($attachment->image_file);
            $attachment->image_file = $request->file('image_file')->store('menu_attachments/images', 'public');
        }

        $attachment->save();

        return redirect()->back()->with('success', 'แก้ไขไฟล์แนบสำเร็จ');
    }
}
