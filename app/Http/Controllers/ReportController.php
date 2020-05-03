<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\ReportPost;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $my_id = auth()->user()->id;
        $data = $request->validate([
            'content_report' => 'required|min:5',
        ]);

        $report = new Report();

        $report->user_id = $my_id;
        $report->content_report = $request->content_report;
        $report->is_read = 0;

        $report->save();
    }

    public function storePost(Request $request)
    {
        $my_id = auth()->user()->id;
        $post_id = $request->post_id;
        $type = $request->type;
        $content = $request->content_report;
        

        $report = new ReportPost();
        $report->user_id = $my_id;
        $report->post_id = $post_id;
        $report->type = $type;
        $report->content_report = $content;
        $report->is_read = 0;

        $report->save();
    }
}
