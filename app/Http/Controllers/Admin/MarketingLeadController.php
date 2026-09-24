<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingLead;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MarketingLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = MarketingLead::query();
        
        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', \Carbon\Carbon::today());
                    break;
                case 'weekly':
                    $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereMonth('created_at', \Carbon\Carbon::now()->month)
                          ->whereYear('created_at', \Carbon\Carbon::now()->year);
                    break;
                case 'yearly':
                    $query->whereYear('created_at', \Carbon\Carbon::now()->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [
                            \Carbon\Carbon::parse($request->start_date),
                            \Carbon\Carbon::parse($request->end_date)
                        ]);
                    } elseif ($request->filled('start_date')) {
                        $query->where('created_at', '>=', \Carbon\Carbon::parse($request->start_date));
                    } elseif ($request->filled('end_date')) {
                        $query->where('created_at', '<=', \Carbon\Carbon::parse($request->end_date));
                    }
                    break;
            }
        }
        
        $leads = $query->latest()->paginate(20)->appends($request->all());
        return view('backend.admin.marketing_leads.index', compact('leads'));
    }

    public function saveWebhook(Request $request)
    {
        $request->validate([
            'marketing_webhook_url'   => 'nullable|url',
            'marketing_webhook_token' => 'nullable|string'
        ]);

        \Illuminate\Support\Facades\DB::table('settings')->updateOrInsert(
            ['title' => 'marketing_webhook_url'],
            ['value' => $request->marketing_webhook_url, 'lang' => 'en', 'status' => 1]
        );

        \Illuminate\Support\Facades\DB::table('settings')->updateOrInsert(
            ['title' => 'marketing_webhook_token'],
            ['value' => $request->marketing_webhook_token, 'lang' => 'en', 'status' => 1]
        );

        Toastr::success(__('Settings Updated Successfully'));
        return back();
    }

    public function export(Request $request)
    {
        $query = MarketingLead::query();
        
        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', \Carbon\Carbon::today());
                    break;
                case 'weekly':
                    $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
                    break;
                case 'monthly':
                    $query->whereMonth('created_at', \Carbon\Carbon::now()->month)
                          ->whereYear('created_at', \Carbon\Carbon::now()->year);
                    break;
                case 'yearly':
                    $query->whereYear('created_at', \Carbon\Carbon::now()->year);
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $query->whereBetween('created_at', [
                            \Carbon\Carbon::parse($request->start_date),
                            \Carbon\Carbon::parse($request->end_date)
                        ]);
                    } elseif ($request->filled('start_date')) {
                        $query->where('created_at', '>=', \Carbon\Carbon::parse($request->start_date));
                    } elseif ($request->filled('end_date')) {
                        $query->where('created_at', '<=', \Carbon\Carbon::parse($request->end_date));
                    }
                    break;
            }
        }
        
        $leads = $query->latest()->get();
        
        $filename = "marketing_leads_" . date('Y-m-d') . ".csv";
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add CSV headers
        fputcsv($handle, ['ID', 'Name', 'Email', 'Phone', 'WhatsApp Number', 'Is Synced', 'Submitted Date', 'Submitted Time']);

        foreach ($leads as $lead) {
            fputcsv($handle, [
                $lead->id,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->whatsapp_number,
                $lead->is_synced ? 'Yes' : 'No',
                $lead->created_at ? $lead->created_at->format('Y-m-d') : '',
                $lead->created_at ? $lead->created_at->format('h:i A') : ''
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
