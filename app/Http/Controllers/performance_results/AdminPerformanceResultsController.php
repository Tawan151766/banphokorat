<?php

namespace App\Http\Controllers\performance_results;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerfResultsType;
use App\Models\PerfResultsSection;
use App\Models\PerfResultsSubTopic;
use App\Models\PerfResultsFile;
use Illuminate\Support\Facades\Storage;

class AdminPerformanceResultsController extends Controller
{
    public function PerformanceResultsType()
    {
        $PerfResultsType = PerfResultsType::all();

        return view('admin.pages.performance_results.page_type', compact('PerfResultsType'));
    }

    public function PerformanceResultsTypeCreate(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        PerfResultsType::create([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function PerformanceResultsUpdate(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string',
        ]);

        $PerfResultsType = PerfResultsType::findOrFail($id);

        $PerfResultsType->update([
            'type_name' => $request->type_name,
        ]);

        return redirect()->back()->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

    public function PerformanceResultsDelete($id)
    {
        $PerfResultsType = PerfResultsType::findOrFail($id);

        $PerfResultsType->delete();

        return redirect()->back()->with('success', 'ข้อมูลถูกลบเรียบร้อยแล้ว');
    }

    public function PerformanceResultsShowSection($id)
    {
        $PerfResultsType = PerfResultsType::findOrFail($id);
        $PerfResultsSection = PerfResultsSection::where('type_id', $id)->get();

        return view('admin.pages.performance_results.page_section', compact('PerfResultsType', 'PerfResultsSection'));
    }

    public function PerformanceResultsSectionCreate(Request $request, $TypeId)
    {
        $request->validate([
            'section_name' => 'required|string',
            'date' => 'nullable|date',
        ]);

        // dd($request);

        PerfResultsSection::create([
            'type_id' => $TypeId,
            'section_name' => $request->section_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function PerformanceResultsSectionUpdate(Request $request, $TypeId)
    {
        $request->validate([
            'section_name' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $PerfResultsSection = PerfResultsSection::findOrFail($TypeId);

        $PerfResultsSection->update([
            'section_name' => $request->section_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function PerformanceResultsSectionDelete($id)
    {
        $PerfResultsSection = PerfResultsSection::findOrFail($id);
        $PerfResultsSection->delete();

        return redirect()->back()->with('success', 'โพสถูกลบแล้ว');
    }

    public function PerfResultsSubTopicShowSection($id)
    {
        $PerfResultsSection = PerfResultsSection::findOrFail($id);
        $PerfResultsSubTopic = PerfResultsSubTopic::where('section_id', $id)->get();

        return view('admin.pages.performance_results.page_sub_topic', compact('PerfResultsSection', 'PerfResultsSubTopic'));
    }

    public function PerfResultsSubTopicCreate(Request $request, $SubTopicId)
    {
        $request->validate([
            'topic_name' => 'required|string',
            'date' => 'nullable|date',
        ]);

        // dd($request);

        PerfResultsSubTopic::create([
            'section_id' => $SubTopicId,
            'topic_name' => $request->topic_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function PerfResultsSubTopicUpdate(Request $request, $TypeId)
    {
        $request->validate([
            'topic_name' => 'required|string',
            'date' => 'nullable|date',
        ]);

        $PerfResultsSubTopic = PerfResultsSubTopic::findOrFail($TypeId);

        $PerfResultsSubTopic->update([
            'topic_name' => $request->topic_name,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function PerfResultsSubTopicDelete($id)
    {
        $PerfResultsSubTopic = PerfResultsSubTopic::findOrFail($id);
        $PerfResultsSubTopic->delete();

        return redirect()->back()->with('success', 'โพสถูกลบแล้ว');
    }

    public function PerfResultsShowDetails($id)
    {
        $PerfResultsSubTopic = PerfResultsSubTopic::findOrFail($id);
        $PerfResultsFile = PerfResultsFile::where('sub_topic_id', $id)->get();

        return view('admin.pages.performance_results.page_detail', compact('PerfResultsSubTopic', 'PerfResultsFile'));
    }

    public function PerfResultsDetailsCreate(Request $request, $DetailsId)
    {
        // Validate the files
        $request->validate([
            'files_path.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx', // max size 2MB
        ]);

        if ($request->hasFile('files_path')) {
            foreach ($request->file('files_path') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('perfresults_file', $filename, 'public');

                $fileExtension = $file->getClientOriginalExtension();

                // Create record in the database
                PerfResultsFile::create([
                    'sub_topic_id' => $DetailsId,
                    'files_path' => $path,
                    'files_type' => $fileExtension,
                ]);
            }
        }

        return redirect()->back()->with('success', 'สร้างข้อมูลสำเร็จ');
    }

    public function PerfResultsDetailsDelete($fileId)
    {
        // ค้นหาไฟล์ที่ต้องการลบจากฐานข้อมูล
        $file = PerfResultsFile::findOrFail(id: $fileId);

        // ลบไฟล์จาก storage
        if (Storage::exists($file->files_path)) {
            Storage::delete($file->files_path);
        }

        // ลบข้อมูลไฟล์จากฐานข้อมูล
        $file->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลสำเร็จ');
    }
}
