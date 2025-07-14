<?php

namespace App\Http\Controllers\laws_and_regulations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LawsRegsType;
use App\Models\LawsRegsSection;
use App\Models\LawsRegsFiles;
use Illuminate\Support\Facades\Storage;

class AdminLawsAndRegulationsController extends Controller
{
    public function LawsAndRegulationsType()
    {
        $LawsRegsType = LawsRegsType::all();

        return view('admin.pages.laws_and_regulations.page_type', compact('LawsRegsType'));
    }

    public function LawsAndRegulationsTypeCreate(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        LawsRegsType::create([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function LawsAndRegulationsUpdate(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        $LawsRegsType = LawsRegsType::findOrFail($id);

        $LawsRegsType->update([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

    public function LawsAndRegulationsDelete($id)
    {
        $LawsRegsType = LawsRegsType::findOrFail($id);

        $LawsRegsType->delete();

        return redirect()->back()->with('success', 'ข้อมูลถูกลบเรียบร้อยแล้ว');
    }

    public function LawsAndRegulationsShowSection($id)
    {
        $LawsRegsType = LawsRegsType::findOrFail($id);
        $LawsRegsSection = LawsRegsSection::where('type_id', $id)->get();

        return view('admin.pages.laws_and_regulations.page_section', compact('LawsRegsType', 'LawsRegsSection'));
    }

    public function LawsAndRegulationsSectionCreate(Request $request, $TypeId)
    {
        $request->validate([
            'section_name' => 'required|string',
        ]);

        LawsRegsSection::create([
            'type_id' => $TypeId,
            'section_name' => $request->section_name,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function LawsAndRegulationsSectionUpdate(Request $request, $TypeId)
    {
        $request->validate([
            'section_name' => 'required|string',
        ]);

        $LawsRegsSection = LawsRegsSection::findOrFail($TypeId);

        $LawsRegsSection->update([
            'section_name' => $request->section_name,
        ]);

        return redirect()->back()->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function LawsAndRegulationsSectionDelete($id)
    {
        $LawsRegsSection = LawsRegsSection::findOrFail($id);
        $LawsRegsSection->delete();

        return redirect()->back()->with('success', 'โพสถูกลบแล้ว');
    }

    public function LawsAndRegulationsShowDetails($id)
    {
        $LawsRegsSection = LawsRegsSection::findOrFail($id);
        $LawsRegsFiles = LawsRegsFiles::where('section_id', $id)->get();

        return view('admin.pages.laws_and_regulations.page_detail', compact('LawsRegsSection', 'LawsRegsFiles'));
    }

    public function LawsAndRegulationsDetailCreate(Request $request, $DetailsId)
    {
        $request->validate([
            'files_path.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        if ($request->hasFile('files_path')) {
            foreach ($request->file('files_path') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('laws_and_regulations_file', $filename, 'public');

                $fileType = $file->getClientOriginalExtension();

                LawsRegsFiles::create([
                    'section_id' => $DetailsId,
                    'files_path' => $path,
                    'files_type' => $fileType,
                ]);
            }
        }

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function LawsAndRegulationsDetailDelete($fileId)
    {
        $file = LawsRegsFiles::findOrFail(id: $fileId);

        if (Storage::exists($file->files_path)) {
            Storage::delete($file->files_path);
        }

        $file->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
