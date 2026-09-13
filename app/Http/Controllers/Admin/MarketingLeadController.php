<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingLead;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MarketingLeadController extends Controller
{
    public function index()
    {
        $leads = MarketingLead::latest()->paginate(20);
        return view('backend.admin.marketing_leads.index', compact('leads'));
    }

    public function saveWebhook(Request $request)
    {
        $request->validate([
            'marketing_webhook_url' => 'nullable|url'
        ]);

        \Illuminate\Support\Facades\DB::table('settings')->updateOrInsert(
            ['title' => 'marketing_webhook_url'],
            ['value' => $request->marketing_webhook_url, 'lang' => 'en', 'status' => 1]
        );

        Toastr::success(__('Settings Updated Successfully'));
        return back();
    }

    public function export()
    {
        $leads = MarketingLead::all();
        
        $filename = "marketing_leads_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add CSV headers
        fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'Course ID', 'Is Synced', 'Submitted At']);

        foreach ($leads as $lead) {
            fputcsv($handle, [
                $lead->id,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->course_id,
                $lead->is_synced ? 'Yes' : 'No',
                $lead->created_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
        exit;
    }

    public function destroy($id)
    {
        try {
            MarketingLead::findOrFail($id)->delete();
            return response()->json([
                'title' => __('deleted'),
                'message' => __('deleted_successfully'),
                'status' => 'success',
                'is_reload' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'title' => __('error'),
                'message' => $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}
