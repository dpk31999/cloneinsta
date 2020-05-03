<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Report;

class ReportController extends Controller
{
    public function index()
    {

        $reports = Report::all();


        return view('admin.report',compact('reports'));
    }

    public function getReport(Report $report)
    {
        $report->is_read = 1;
        $report->save();

        $name = $report->user->name;
        $email = $report->user->email;


        return response()->json([
            'report' => $report,
            'name' => $name,
            'email' => $email,
        ], 200);
    }
}
