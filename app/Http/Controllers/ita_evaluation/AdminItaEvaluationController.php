<?php

namespace App\Http\Controllers\ita_evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItaEvaluation;
use App\Models\ItaContent;

class AdminItaEvaluationController extends Controller
{
    public function ItaEvaluationIndex()
    {
        $itaEvaluations = ItaEvaluation::with('contents')
            ->withCount('contents')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.ita_evaluation.page_evaluation', compact('itaEvaluations'));
    }

    public function ItaEvaluationCreate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ita_date' => 'nullable|date',
            'contents' => 'nullable|array',
            'contents.*.url' => 'nullable|string|max:500',
            'contents.*.description' => 'nullable|string',
        ]);

        // สร้าง ITA Evaluation
        $itaEvaluation = ItaEvaluation::create([
            'name' => $request->name,
            'description' => $request->description,
            'ita_date' => $request->ita_date,
        ]);

        // สร้าง ITA Contents (ถ้ามี)
        if ($request->has('contents') && is_array($request->contents)) {
            foreach ($request->contents as $content) {
                // ตรวจสอบว่ามี URL หรือไม่ (ข้ามถ้าไม่มี)
                if (!empty($content['url'])) {
                    ItaContent::create([
                        'evaluation_id' => $itaEvaluation->id,
                        'url' => $content['url'],
                        'description' => $content['description'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'สร้างข้อมูลการประเมิน ITA และเนื้อหาสำเร็จ');
    }

    public function ItaEvaluationUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ita_date' => 'nullable|date',
            'contents' => 'nullable|array',
            'contents.*.id' => 'nullable|integer|exists:ita_contents,id',
            'contents.*.url' => 'nullable|string|max:500',
            'contents.*.description' => 'nullable|string',
        ]);

        $itaEvaluation = ItaEvaluation::findOrFail($id);

        // อัปเดตข้อมูลการประเมิน
        $itaEvaluation->update([
            'name' => $request->name,
            'description' => $request->description,
            'ita_date' => $request->ita_date,
        ]);

        // จัดการ Contents
        if ($request->has('contents') && is_array($request->contents)) {
            // เก็บ ID ของ contents ที่ส่งมา
            $submittedContentIds = [];
            
            foreach ($request->contents as $contentData) {
                // ข้ามถ้าไม่มี URL
                if (empty($contentData['url'])) {
                    continue;
                }

                if (!empty($contentData['id'])) {
                    // อัปเดต content ที่มีอยู่
                    $content = ItaContent::where('id', $contentData['id'])
                        ->where('evaluation_id', $id)
                        ->first();
                    
                    if ($content) {
                        $content->update([
                            'url' => $contentData['url'],
                            'description' => $contentData['description'] ?? null,
                        ]);
                        $submittedContentIds[] = $content->id;
                    }
                } else {
                    // สร้าง content ใหม่
                    $newContent = ItaContent::create([
                        'evaluation_id' => $id,
                        'url' => $contentData['url'],
                        'description' => $contentData['description'] ?? null,
                    ]);
                    $submittedContentIds[] = $newContent->id;
                }
            }

            // ลบ contents ที่ไม่ได้ส่งมา (ถูกลบออกจาก form)
            ItaContent::where('evaluation_id', $id)
                ->whereNotIn('id', $submittedContentIds)
                ->delete();
        } else {
            // ถ้าไม่มี contents ส่งมา ให้ลบทั้งหมด
            ItaContent::where('evaluation_id', $id)->delete();
        }

        return redirect()->back()->with('success', 'อัปเดตข้อมูลการประเมิน ITA และเนื้อหาสำเร็จ');
    }

    public function ItaEvaluationDelete($id)
    {
        $itaEvaluation = ItaEvaluation::findOrFail($id);
        $itaEvaluation->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลการประเมิน ITA เรียบร้อยแล้ว');
    }

    public function ItaEvaluationShowContents($id)
    {
        $itaEvaluation = ItaEvaluation::findOrFail($id);
        $itaContents = ItaContent::where('evaluation_id', $id)->orderBy('created_at', 'desc')->get();

        return view('admin.pages.ita_evaluation.page_content', compact('itaEvaluation', 'itaContents'));
    }

    public function ItaContentCreate(Request $request, $evaluationId)
    {
        $request->validate([
            'url' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        ItaContent::create([
            'evaluation_id' => $evaluationId,
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'เพิ่มเนื้อหา ITA สำเร็จ');
    }

    public function ItaContentUpdate(Request $request, $id)
    {
        $request->validate([
            'url' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        $itaContent = ItaContent::findOrFail($id);

        $itaContent->update([
            'url' => $request->url,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'แก้ไขเนื้อหา ITA สำเร็จ');
    }

    public function ItaContentDelete($id)
    {
        $itaContent = ItaContent::findOrFail($id);
        $itaContent->delete();

        return redirect()->back()->with('success', 'ลบเนื้อหา ITA เรียบร้อยแล้ว');
    }
}