<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Checkout;
use App\Models\Course;
use App\Models\Enroll;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Organization;
use App\Models\Payout;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Admin\Dashboard\AdvanceEarningStatistic;
use App\Services\Admin\Dashboard\BestSellingCourse;
use App\Services\Admin\Dashboard\CourseStatistic;
use App\Services\Admin\Dashboard\DateWiseQuery;
use App\Services\Admin\Dashboard\EarningStatistic;
use App\Services\Admin\Dashboard\EnrolmentStatistic;
use App\Services\Admin\Dashboard\InstructorStatistic;
use App\Services\Admin\Dashboard\OrganizationStatistic;
use App\Services\Admin\Dashboard\StudentStatistic;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private function sinceLastMonthWiseQuery($query)
    {

        // Get the last day of the last month
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:s:i');

        return $query->where('created_at', '<=', $lastDayOfLastMonth);
    }

    public function index(Request $request)
    {
        $today = Carbon::today();
        $thisWeek = Carbon::today()->subDays(7);
        $thisMonth = Carbon::today()->startOfMonth();

        $totalLeads = \App\Models\MarketingLead::count();
        $todayLeads = \App\Models\MarketingLead::whereDate('created_at', $today)->count();
        $weeklyLeads = \App\Models\MarketingLead::where('created_at', '>=', $thisWeek)->count();
        $monthlyLeads = \App\Models\MarketingLead::where('created_at', '>=', $thisMonth)->count();

        // Chart Data (Last 7 Days)
        $chartData = [];
        $chartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('M d');
            $chartData[] = \App\Models\MarketingLead::whereDate('created_at', $date)->count();
        }

        // Chart Data (Last 30 Days)
        $monthlyChartData = [];
        $monthlyChartLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $monthlyChartLabels[] = $date->format('M d');
            $monthlyChartData[] = \App\Models\MarketingLead::whereDate('created_at', $date)->count();
        }

        // Recent 5 Leads
        $recentLeads = \App\Models\MarketingLead::latest()->take(5)->get();

        $data = [
            'totalLeads'         => $totalLeads,
            'todayLeads'         => $todayLeads,
            'weeklyLeads'        => $weeklyLeads,
            'monthlyLeads'       => $monthlyLeads,
            'chartLabels'        => json_encode($chartLabels),
            'chartData'          => json_encode($chartData),
            'monthlyChartLabels' => json_encode($monthlyChartLabels),
            'monthlyChartData'   => json_encode($monthlyChartData),
            'recentLeads'        => $recentLeads,
        ];

        return view('backend.admin.dashboard_multi', $data);
    }

    public function instructorDashboard()
    {
        return view('backend.admin.dashboard');
    }

    public function profile(UserRepository $userRepository)
    {
        $user_id = auth()->user()->id;
        $user    = $userRepository->find($user_id);

        return view('backend.admin.auth.profile', compact('user'));
    }

    public function profileUpdate(Request $request, UserRepository $userRepository): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $id = auth()->user()->id;
        $request->validate([
            'first_name' => 'required|string|max:255',
            //'last_name' => 'required|max:255',
            'email'      => 'required|email|unique:users,email,'.Request()->id,
            'phone'      => 'required|unique:users,phone,'.Request()->id,
        ]);

        try {
            $userRepository->update($request->all(), auth()->user()->id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function passwordChange()
    {
        return view('backend.admin.auth.password_change');
    }

    public function passwordUpdate(Request $request, UserRepository $userRepository)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => 'required|min:6|max:32|confirmed',
        ]);

        $user = $userRepository->findByEmail(auth()->user()->email);
        if (Hash::check($request->current_password, $user->password)) {
            try {
                $user->password = bcrypt($request->password);
                $user->save();
                Toastr::success(__('successfully_password_changed'));
                $this->logout($request);

                return response()->json([
                    'success' => __('successfully_password_changed'),
                    'route'   => route('login'),
                ]);
            } catch (Exception $e) {
                Toastr::warning(__($e->getMessage()));

                return response()->json(['error' => $e->getMessage()]);
            }
        } else {
            Toastr::warning(__('sorry_old_password_not_match'));

            return response()->json(['error' => 'sorry_old_password_not_match']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
