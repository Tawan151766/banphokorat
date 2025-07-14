<?php

namespace App\Http\Controllers\procurement_plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProcurementPlanType;
use App\Models\ProcurementPlanFile;
use Illuminate\Support\Facades\Storage;

class AdminProcurementPlanController extends Controller
{
     public function ProcurementPlanType()
    {
        $ProcurementPlanType = ProcurementPlanType::all();

        return view('admin.pages.procurement_plan.page_type', compact('ProcurementPlanType'));
    }

    public function ProcurementPlanTypeCreate(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        ProcurementPlanType::create([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function ProcurementPlanTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        $ProcurementPlanType = ProcurementPlanType::findOrFail($id);

        $ProcurementPlanType->update([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

    // public function ProcurementPlanTypeDelete($id)
    // {
    //     $ProcurementPlanType = ProcurementPlanType::findOrFail($id);
    //     $ProcurementPlanType->delete();

    //     return redirect()->back()->with('success', 'ข้อมูลถูกลบเรียบร้อยแล้ว');
    // }
    public function ProcurementPlanTypeDelete($id)
    {
        // หา ManpowerPlanType ตาม ID ที่รับมา
        $ProcurementPlanType = ProcurementPlanType::findOrFail($id);

        // ลบไฟล์ทั้งหมดที่เกี่ยวข้องกับประเภทนี้
        $files = ProcurementPlanFile::where('type_id', $id)->get();
        foreach ($files as $file) {
            // ลบไฟล์ออกจาก storage
            if (Storage::disk('public')->exists($file->files_path)) {
                Storage::disk('public')->delete($file->files_path);
            }

            // ลบข้อมูลไฟล์ออกจากฐานข้อมูล
            $file->delete();
        }

        // ลบ ManpowerPlanType
        $ProcurementPlanType->delete();

        return redirect()->back()->with('success', 'ข้อมูลและไฟล์ถูกลบเรียบร้อยแล้ว');
    }

    public function ProcurementPlanShowDetail($id)
    {
        $ProcurementPlanType = ProcurementPlanType::findOrFail($id);
        $ProcurementPlanFile = ProcurementPlanFile::where('type_id', $id)->get();

        return view('admin.pages.procurement_plan.page_details', compact('ProcurementPlanType', 'ProcurementPlanFile'));
    }

    public function ProcurementPlanDetailCreate(Request $request, $Id)
    {
        $request->validate([
            'file_post' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv',
        ]);

        if ($request->hasFile('file_post')) {
            $file = $request->file('file_post'); // รับไฟล์เดียว
            $filename = time() . '_' . $file->getClientOriginalName();
            $fileType = $file->extension();
            $folder = ($fileType == 'pdf') ? 'procurement_plan_files' : 'procurement_files';
            $path = $file->storeAs($folder, $filename, 'public');

            ProcurementPlanFile::create([
                'type_id' => $Id,
                'files_path' => $path,
                'files_type' => $fileType,
            ]);
        }

        return redirect()->back()->with('success', 'เพิ่มข้อมูลสำเร็จ');
    }

    public function ProcurementPlanDetailDelete($id)
    {
        $file = ProcurementPlanFile::findOrFail($id);

        // ลบไฟล์ออกจาก storage
        if (Storage::disk('public')->exists($file->files_path)) {
            Storage::disk('public')->delete($file->files_path);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $file->delete();

        return redirect()->back()->with('success', 'ลบไฟล์สำเร็จ');
    }
}
