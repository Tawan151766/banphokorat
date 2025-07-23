<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $leaders = Staff::where('role', 'leader')->orderBy('full_name')->get();
        $coleaders = Staff::where('role', 'coleader')->orderBy('full_name')->get();
        $employees = Staff::where('role', 'employee')->orderBy('full_name')->get();

        return view('frontend.staff.index', compact('leaders', 'coleaders', 'employees'));
    }

    public function getStaffByRole($role)
    {
        $staff = Staff::where('role', $role)->orderBy('full_name')->get();
        return response()->json($staff);
    }
}