<?php

namespace App\Http\Controllers\ita_evaluation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItaEvaluation;
use App\Models\ItaContent;

class ItaEvaluationController extends Controller
{
    public function index()
    {
        $itaEvaluations = ItaEvaluation::with('contents')
            ->orderBy('ita_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.ita_evaluation.index', compact('itaEvaluations'));
    }

    public function show($id)
    {
        $itaEvaluation = ItaEvaluation::with('contents')->findOrFail($id);

        return view('frontend.ita_evaluation.show', compact('itaEvaluation'));
    }

    public function getContents($evaluationId)
    {
        $itaContents = ItaContent::where('evaluation_id', $evaluationId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($itaContents);
    }
}