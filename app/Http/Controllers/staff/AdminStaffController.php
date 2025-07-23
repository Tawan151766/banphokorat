<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class AdminStaffController extends Controller
{
    public function StaffIndex()
    {
        $staff = Staff::orderBy('role')
            ->orderBy('full_name')
            ->get();

        return view('admin.pages.staff.page_staff', compact('staff'));
    }

    public function StaffCreate(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:leader,coleader,employee',
            'department' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
        ];

        // Handle image upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('staff_images', $filename, 'public');
            $data['img'] = $path;
        }

        Staff::create($data);

        return redirect()->back()->with('success', 'เพิ่มข้อมูลพนักงานสำเร็จ');
    }

    public function StaffUpdate(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:leader,coleader,employee',
            'department' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staff = Staff::findOrFail($id);

        $data = [
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'role' => $request->role,
            'department' => $request->department,
        ];

        // Handle image upload
        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($staff->img && Storage::disk('public')->exists($staff->img)) {
                Storage::disk('public')->delete($staff->img);
            }

            $image = $request->file('img');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('staff_images', $filename, 'public');
            $data['img'] = $path;
        }

        $staff->update($data);

        return redirect()->back()->with('success', 'อัปเดตข้อมูลพนักงานสำเร็จ');
    }

    public function StaffDelete($id)
    {
        $staff = Staff::findOrFail($id);

        // Delete image if exists
        if ($staff->img && Storage::disk('public')->exists($staff->img)) {
            Storage::disk('public')->delete($staff->img);
        }

        $staff->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลพนักงานเรียบร้อยแล้ว');
    }
}