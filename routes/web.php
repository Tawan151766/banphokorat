<?php
// ...existing code...
    // Menu Management
// ...existing code...

use App\Http\Controllers\activity\ActivityController;
use App\Http\Controllers\activity\AdminActivityController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ita_evaluation\AdminItaEvaluationController;
use App\Http\Controllers\ita_evaluation\ItaEvaluationController;
use App\Http\Controllers\laws_and_regulations\AdminLawsAndRegulationsController;
use App\Http\Controllers\laws_and_regulations\LawsAndRegulationsController;
use App\Http\Controllers\menu\AdminMenuController;
use App\Http\Controllers\performance_results\AdminPerformanceResultsController;
use App\Http\Controllers\performance_results\PerformanceResultsController;
use App\Http\Controllers\press_release\AdminPressReleaseController;
use App\Http\Controllers\press_release\PressReleaseController;
use App\Http\Controllers\procurement\AdminProcurementController;
use App\Http\Controllers\procurement\ProcurementController;
use App\Http\Controllers\procurement_plan\AdminProcurementPlanController;
use App\Http\Controllers\procurement_plan\ProcurementPlanController;
use App\Http\Controllers\staff\AdminStaffController;
use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('auth.login');
});

// auth
Route::get('/LoginPage', [AuthController::class, 'LoginPage'])->name('LoginPage');
Route::get('/RegisterPage', [AuthController::class, 'RegisterPage'])->name('RegisterPage');
Route::post('/login', [AuthController::class, 'Login'])->name('Login');
Route::post('/register', [AuthController::class, 'Register'])->name('Register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    
    // Admin
    Route::get('/Admin', [AdminController::class, 'Admin'])->name('Admin');

    // Activity
    Route::get('/Admin/Activity/page', [AdminActivityController::class, 'ActivityHome'])->name('ActivityHome');
    Route::post('/Admin/Activity/create', [AdminActivityController::class, 'ActivityCreate'])->name('ActivityCreate');
    Route::delete('/Admin/Activity/delete{id}', [AdminActivityController::class, 'ActivityDelete'])->name('ActivityDelete');
    Route::get('/Admin/Activity/update/page/{id}', [AdminActivityController::class, 'ActivityUpdatePage'])->name('ActivityUpdatePage');
    Route::put('/Admin/Activity/update/{id}', [AdminActivityController::class, 'ActivityUpdate'])->name('ActivityUpdate');
    Route::put('/Admin/Activity/{id}/updatefile', [AdminActivityController::class, 'ActivityUpdateFile'])->name('ActivityUpdateFile');

    // PressRelease
    Route::get('/Admin/PressRelease/page', [AdminPressReleaseController::class, 'PressReleaseHome'])->name('PressReleaseHome');
    Route::post('/Admin/PressRelease/create', [AdminPressReleaseController::class, 'PressReleaseCreate'])->name('PressReleaseCreate');
    Route::delete('/Admin/PressRelease/delete{id}', [AdminPressReleaseController::class, 'PressReleaseDelete'])->name('PressReleaseDelete');
    Route::get('/Admin/PressRelease/update/page/{id}', [AdminPressReleaseController::class, 'PressReleaseUpdatePage'])->name('PressReleaseUpdatePage');
    Route::put('/Admin/PressRelease/update/{id}', [AdminPressReleaseController::class, 'PressReleaseUpdate'])->name('PressReleaseUpdate');
    Route::put('/Admin/PressRelease/updatefile/{id}', [AdminPressReleaseController::class, 'updateFile'])->name('updateFile');

    // PerformanceResults
    Route::get('/Admin/PerformanceResults/page', [AdminPerformanceResultsController::class, 'PerformanceResultsType'])->name('PerformanceResultsType');
    Route::post('/Admin/PerformanceResults/create/name', [AdminPerformanceResultsController::class, 'PerformanceResultsTypeCreate'])->name('PerformanceResultsTypeCreate');
    Route::put('/Admin/PerformanceResults/{id}/update', [AdminPerformanceResultsController::class, 'PerformanceResultsUpdate'])->name('PerformanceResultsUpdate');
    Route::delete('/Admin/PerformanceResults/{id}/delete', [AdminPerformanceResultsController::class, 'PerformanceResultsDelete'])->name('PerformanceResultsDelete');

    Route::get('/Admin/PerformanceResults/show/section/{id}', [AdminPerformanceResultsController::class, 'PerformanceResultsShowSection'])->name('PerformanceResultsShowSection');
    Route::post('/Admin/PerformanceResults/show/section/create/{id}', [AdminPerformanceResultsController::class, 'PerformanceResultsSectionCreate'])->name('PerformanceResultsSectionCreate');
    Route::put('/Admin/PerformanceResults/show/section/update/{id}', [AdminPerformanceResultsController::class, 'PerformanceResultsSectionUpdate'])->name('PerformanceResultsSectionUpdate');
    Route::delete('/Admin/PerformanceResults/show/section/delete/{id}', [AdminPerformanceResultsController::class, 'PerformanceResultsSectionDelete'])->name('PerformanceResultsSectionDelete');

    Route::get('/Admin/PerformanceResults/show/section/topic/{id}', [AdminPerformanceResultsController::class, 'PerfResultsSubTopicShowSection'])->name('PerfResultsSubTopicShowSection');
    Route::post('/Admin/PerformanceResults/show/section/topic/create/{id}', [AdminPerformanceResultsController::class, 'PerfResultsSubTopicCreate'])->name('PerfResultsSubTopicCreate');
    Route::put('/Admin/PerformanceResults/show/section/topic/update/{id}', [AdminPerformanceResultsController::class, 'PerfResultsSubTopicUpdate'])->name('PerfResultsSubTopicUpdate');
    Route::delete('/Admin/PerformanceResults/show/section/topic/delete/{id}', [AdminPerformanceResultsController::class, 'PerfResultsSubTopicDelete'])->name('PerfResultsSubTopicDelete');

    Route::get('/Admin/PerformanceResults/show/section/topic/detail/{id}', [AdminPerformanceResultsController::class, 'PerfResultsShowDetails'])->name('PerfResultsShowDetails');
    Route::post('/Admin/PerformanceResults/show/section/topic/detail/create/{id}', [AdminPerformanceResultsController::class, 'PerfResultsDetailsCreate'])->name('PerfResultsDetailsCreate');
    Route::delete('/Admin/PerformanceResults/show/section/topic/detail/delete/{id}', [AdminPerformanceResultsController::class, 'PerfResultsDetailsDelete'])->name('PerfResultsDetailsDelete');

    // LawsAndRegulations
    Route::get('/Admin/LawsAndRegulations/page', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsType'])->name('LawsAndRegulationsType');
    Route::post('/Admin/LawsAndRegulations/create/name', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsTypeCreate'])->name('LawsAndRegulationsTypeCreate');
    Route::put('/Admin/LawsAndRegulations/{id}/update', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsUpdate'])->name('LawsAndRegulationsUpdate');
    Route::delete('/Admin/LawsAndRegulations/{id}/delete', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsDelete'])->name('LawsAndRegulationsDelete');

    Route::get('/Admin/LawsAndRegulations/show/section/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsShowSection'])->name('LawsAndRegulationsShowSection');
    Route::post('/Admin/LawsAndRegulations/show/section/create/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsSectionCreate'])->name('LawsAndRegulationsSectionCreate');
    Route::put('/Admin/LawsAndRegulations/show/section/update/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsSectionUpdate'])->name('LawsAndRegulationsSectionUpdate');
    Route::delete('/Admin/LawsAndRegulations/show/section/delete/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsSectionDelete'])->name('LawsAndRegulationsSectionDelete');

    Route::get('/Admin/LawsAndRegulations/show/section/detail/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsShowDetails'])->name('LawsAndRegulationsShowDetails');
    Route::post('/Admin/LawsAndRegulations/show/section/detail/create/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsDetailCreate'])->name('LawsAndRegulationsDetailCreate');
    Route::delete('/Admin/LawsAndRegulations/show/section/detail/delete/{id}', [AdminLawsAndRegulationsController::class, 'LawsAndRegulationsDetailDelete'])->name('LawsAndRegulationsDetailDelete');

    // ProcurementPlan
    Route::get('/Admin/ProcurementPlan/page', [AdminProcurementPlanController::class, 'ProcurementPlanType'])->name('ProcurementPlanType');
    Route::post('/Admin/ProcurementPlan/create/name', [AdminProcurementPlanController::class, 'ProcurementPlanTypeCreate'])->name('ProcurementPlanTypeCreate');
    Route::put('/Admin/ProcurementPlan/{id}/update', [AdminProcurementPlanController::class, 'ProcurementPlanTypeUpdate'])->name('ProcurementPlanTypeUpdate');
    Route::delete('/Admin/ProcurementPlan/{id}/delete', [AdminProcurementPlanController::class, 'ProcurementPlanTypeDelete'])->name('ProcurementPlanTypeDelete');
    Route::get('/Admin/ProcurementPlan/show/detail/{id}', [AdminProcurementPlanController::class, 'ProcurementPlanShowDetail'])->name('ProcurementPlanShowDetail');
    Route::post('/Admin/ProcurementPlan/show/detail/create/{id}', [AdminProcurementPlanController::class, 'ProcurementPlanDetailCreate'])->name('ProcurementPlanDetailCreate');
    Route::delete('/Admin/ProcurementPlan/show/detail/delete/{id}', [AdminProcurementPlanController::class, 'ProcurementPlanDetailDelete'])->name('ProcurementPlanDetailDelete');

    // admin Procurement
    Route::get('/Admin/Procurement/page', [AdminProcurementController::class, 'ProcurementHome'])->name('ProcurementHome');
    Route::post('/Admin/Procurement/create', [AdminProcurementController::class, 'ProcurementCreate'])->name('ProcurementCreate');
    Route::delete('/Admin/Procurement/delete{id}', [AdminProcurementController::class, 'ProcurementDelete'])->name('ProcurementDelete');
    Route::put('/Admin/Procurement/update/{id}', [AdminProcurementController::class, 'ProcurementUpdate'])->name('ProcurementUpdate');

    // ITA Evaluation
    Route::get('/Admin/ItaEvaluation/page', [AdminItaEvaluationController::class, 'ItaEvaluationIndex'])->name('ItaEvaluationIndex');
    Route::post('/Admin/ItaEvaluation/create', [AdminItaEvaluationController::class, 'ItaEvaluationCreate'])->name('ItaEvaluationCreate');
    Route::put('/Admin/ItaEvaluation/{id}/update', [AdminItaEvaluationController::class, 'ItaEvaluationUpdate'])->name('ItaEvaluationUpdate');
    Route::delete('/Admin/ItaEvaluation/{id}/delete', [AdminItaEvaluationController::class, 'ItaEvaluationDelete'])->name('ItaEvaluationDelete');

    Route::get('/Admin/ItaEvaluation/show/contents/{id}', [AdminItaEvaluationController::class, 'ItaEvaluationShowContents'])->name('ItaEvaluationShowContents');
    Route::post('/Admin/ItaEvaluation/show/contents/create/{id}', [AdminItaEvaluationController::class, 'ItaContentCreate'])->name('ItaContentCreate');
    Route::put('/Admin/ItaEvaluation/show/contents/update/{id}', [AdminItaEvaluationController::class, 'ItaContentUpdate'])->name('ItaContentUpdate');
    Route::delete('/Admin/ItaEvaluation/show/contents/delete/{id}', [AdminItaEvaluationController::class, 'ItaContentDelete'])->name('ItaContentDelete');

    // Staff Management
    Route::get('/Admin/Staff/page', [AdminStaffController::class, 'StaffIndex'])->name('StaffIndex');
    Route::post('/Admin/Staff/create', [AdminStaffController::class, 'StaffCreate'])->name('StaffCreate');
    Route::put('/Admin/Staff/{id}/update', [AdminStaffController::class, 'StaffUpdate'])->name('StaffUpdate');
    Route::delete('/Admin/Staff/{id}/delete', [AdminStaffController::class, 'StaffDelete'])->name('StaffDelete');

    // Menu Management
    Route::get('/Admin/Menu/page', [AdminMenuController::class, 'MenuIndex'])->name('MenuIndex');
    Route::get('/Admin/Menu/create', [AdminMenuController::class, 'MenuCreatePage'])->name('MenuCreatePage');
    Route::post('/Admin/Menu/create', [AdminMenuController::class, 'MenuCreate'])->name('MenuCreate');
    Route::get('/Admin/SubMenu/create', [AdminMenuController::class, 'SubMenuCreatePage'])->name('SubMenuCreatePage');
    Route::post('/Admin/SubMenu/create', [AdminMenuController::class, 'SubMenuCreate'])->name('SubMenuCreate');
    Route::put('/Admin/Menu/{id}/update', [AdminMenuController::class, 'MenuUpdate'])->name('MenuUpdate');
    Route::delete('/Admin/Menu/{id}/delete', [AdminMenuController::class, 'MenuDelete'])->name('MenuDelete');
    Route::get('/Admin/SmallSubMenu/create', [AdminMenuController::class, 'SmallSubMenuCreatePage'])->name('SmallSubMenuCreatePage');
    Route::post('/Admin/SmallSubMenu/create', [AdminMenuController::class, 'SmallSubMenuCreate'])->name('SmallSubMenuCreate');
    // Menu Attachments
    Route::get('/Admin/Menu/{menuId}/attachments', [AdminMenuController::class, 'MenuAttachments'])->name('MenuAttachments');
    Route::post('/Admin/Menu/{menuId}/attachments/create', [AdminMenuController::class, 'AttachmentCreate'])->name('AttachmentCreate');
    Route::put('/Admin/Menu/{menuId}/attachment/{attachmentId}/update', [AdminMenuController::class, 'AttachmentUpdate'])->name('AttachmentUpdate');
    Route::delete('/Admin/Menu/attachment/{id}/delete', [AdminMenuController::class, 'AttachmentDelete'])->name('AttachmentDelete');
});

// Frontend Routes
Route::get('/ita-evaluation', [ItaEvaluationController::class, 'index'])->name('ita.evaluation.index');
Route::get('/ita-evaluation/{id}', [ItaEvaluationController::class, 'show'])->name('ita.evaluation.show');
Route::get('/api/ita-evaluation/{evaluationId}/contents', [ItaEvaluationController::class, 'getContents'])->name('ita.evaluation.contents');

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/api/staff/{role}', [StaffController::class, 'getStaffByRole'])->name('staff.by.role');
