<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Book;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\QuizAnswer;
use App\Models\Resource;
use App\Models\SubmitedAssignment;
use App\Models\Wishlist;
use App\Repositories\AssignmentRepository;
use App\Repositories\BookRepository;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    protected $course;

    protected $book;

    protected $user;

    public function __construct(CourseRepository $course, BookRepository $book, UserRepository $user)
    {
        $this->course = $course;
        $this->book   = $book;
        $this->user   = $user;
    }

    public function myProfile()
    {

        // dd(session()->get('carts'));
        try {
            $purchased_course = $this->course->activeCourses([
                'my_course' => 1,
                'user_id'   => Auth::user()->id,
                'paginate'  => 5,
            ]);

            $data             = [
                'purchased_course' => $purchased_course,
                'purchased_book'   => 0,
                'course_wishlist'  => Wishlist::where('user_id', auth()->id())->where('wishable_type', Course::class)->count(),
                'book_wishlist'    => addon_is_activated('book_store') ? Wishlist::where('user_id', auth()->id())->where('wishable_type', Book::class)->count() : 0,
                'assignment'       => 0,
                'balance'          => auth()->user()->balance,
                'total_meeting'    => Meeting::whereJsonContains('invitation_ids', (string) auth()->id())->count(),
            ];

            return view('frontend.profile.profile_dashboard', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function purchaseCourses(Request $request): View|Factory|JsonResponse|RedirectResponse|Application
    {
        try {
            $courses = $this->course->activeCourses([
                'my_course' => 1,
                'user_id'   => auth()->id(),
                'paginate'  => setting('paginate'),
            ], ['enrolls']);
            if ($courses->previousPageUrl()) {
                if ($courses->onLastPage()) {
                    $total_results = $courses->total();
                } else {
                    $total_results = $request->page * $courses->perPage();
                }
            }

            if ($courses->onFirstPage()) {
                $total_results = $courses->count();
            }

            if (request()->ajax()) {
                $course_view = '';
                foreach ($courses as $key => $course) {
                    $vars = [
                        'course' => $course,
                        'key'    => $key,
                    ];
                    $course_view .= view('frontend.profile.components.purchase_course', $vars)->render();
                }

                return response()->json([
                    'success'       => true,
                    'html'          => $course_view,
                    'next_page'     => $courses->nextPageUrl(),
                    'total_results' => $total_results ?? 0,
                    'total_courses' => $courses->total(),
                ]);
            }

            $data    = [
                'courses'       => $courses,
                'total_courses' => $courses->total(),
                'total_results' => $total_results ?? 0,
            ];

            return view('frontend.profile.purchase_courses', $data);
        } catch (Exception $e) {
            if (\request()->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            } else {
                Toastr::error($e->getMessage());

                return back();
            }
        }
    }

    /* public function recentlyViewedCourses(RecentViewRepository $recent_view_repository)
    {
         $recent_view_courses = $recent_view_repository->all([
            'user_id'        => auth()->user()->id,
            'type'           => 'course'
        ]);

         return view('frontend.profile.recently_viewed_courses', compact('recent_view_courses'));
     }*/

    public function purchaseBook()
    {
        return view('frontend.profile.purchase_book');
    }

    public function recentlyViewedBook()
    {
        return view('frontend.profile.recently_viewed_book');
    }

    public function wishlistBook()
    {
        return view('frontend.profile.wishlist_book');
    }

    public function notification(NotificationRepository $notification)
    {
        $notifications       = $notification->all([
            'user_id'  => auth()->user()->id,
            'paginate' => setting('paginate'),
        ]);

        $total_notifications = $notification->UserNotification([
            'user_id' => auth()->user()->id,
        ])->count();
        $data                = [
            'notifications'       => $notifications,
            'total_notifications' => $total_notifications,
        ];

        return view('frontend.profile.notification', $data);
    }

    public function notificationUpdate(Request $request, NotificationRepository $notification)
    {
        $selected_ids    = $request->selected_id;
        $data            = [];
        $data['is_read'] = $request->update_type;

        try {
            $notification->update($data, $selected_ids);
            $response = [
                'status'  => 200,
                'title'   => 'success',
                'message' => __('update_successful'),
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'status'  => 400,
                'title'   => 'error',
                'message' => __($e->getMessage()),
            ];

            return response()->json($response);
        }
    }

    public function notificationDelete(Request $request, NotificationRepository $notification): JsonResponse|RedirectResponse
    {
        $selected_ids = $request->selected_id;

        if (! $selected_ids) {
            $response = [
                'status'  => 400,
                'title'   => 'error',
                'message' => __('item_not_found'),
            ];

            return response()->json($response);
        }
        $data         = [];
        try {
            $notification->delete($selected_ids);
            $response = [
                'status'  => 200,
                'title'   => 'success',
                'message' => __('delete_successful'),
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'status'  => 400,
                'title'   => 'error',
                'message' => __($e->getMessage()),
            ];

            return response()->json($response);
        }
    }

    public function profileSetting()
    {
        return view('frontend.profile.setting');
    }

    public function systemStatus(Request $request, SettingRepository $setting): JsonResponse|\Illuminate\Routing\Redirector|RedirectResponse|Application
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        try {
            if (array_key_exists('maintenance_secret', $request->all())) {
                $command = $request['maintenance_secret'];
                if ($setting->update($request)) {
                    Artisan::call('down --refresh=15 --secret='.$command);
                    Toastr::success(__('Updated Successfully'));

                    return redirect('/'.$command);
                } else {
                    Toastr::error(__('Something went wrong, please try again'));

                    return back();
                }
            }
            if (config('app.demo_mode')) {
                $response['message'] = __('This function is disabled in demo server.');
                $response['title']   = __('Ops..!');
                $response['status']  = 'error';

                return response()->json($response);
            }
            if ($setting->statusChange($request->data)) {
                if ($request['data']['name'] == 'maintenance_mode') {
                    Artisan::call('up');
                }

                if ($request['data']['name'] == 'migrate_web') {
                    if (is_dir('resources/views/admin/store-front')) {
                        envWrite('MOBILE_MODE', 'off');
                        Artisan::call('optimize:clear');
                    } else {
                        $response['message'] = __('migrate_permission');
                        $response['title']   = __('error');
                        $response['status']  = 'error';
                        $response['type']    = 'migrate_error';

                        return response()->json($response);
                    }
                }

                $response['message'] = __('Updated Successfully');
                $response['title']   = __('Success');
                $response['status']  = 'success';
            } else {
                $response['message'] = __('Something went wrong, please try again');
                $response['title']   = __('Ops..!');
                $response['status']  = 'error';
            }

            return response()->json($response);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['title']   = __('Ops..!');
            $response['status']  = 'error';

            return response()->json($response);
        }
    }

    public function accountDelete(Request $request, UserRepository $user): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $user_id     = $request->id;
        $logged_user = $user->find($user_id);
        if ($logged_user->is_deleted == 0) {
            try {
                $user->userDelete($user_id);
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Toastr::success(__('delete_successful'));
                $data = [
                    'status'  => 'success',
                    'message' => __('delete_successful'),
                    'title'   => __('success'),
                ];

                return response()->json($data);
            } catch (\Exception $e) {
                $data = [
                    'status'  => 'danger',
                    'message' => $e->getMessage(),
                    'title'   => __('error'),
                ];

                return response()->json($data);
            }
        } else {
            $data = [
                'status'  => 'danger',
                'message' => __('you_account_has_been_deleted'),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function editProfile()
    {
        return view('frontend.profile.edit_profile');
    }


    public function meeting(LiveClassRepository $liveClassRepository)
    {
        $courses    = $this->course->activeCoursesIDs([
            'my_course' => 1,
            'user_id'   => auth()->id(),
            'paginate'  => setting('paginate'),
        ], ['enrolls']);

        $my_meeting = $liveClassRepository->myMeeting($courses);
        $data       = [
            'my_meeting' => $my_meeting,
        ];

        return view('frontend.profile.meeting', $data);
    }

    public function updateProfile(Request $request)
    {
        // Prevent non-admin users from changing their phone number.
        // Even if they bypass the frontend disabled input, we force it to the current value.
        $request->merge(['phone' => Auth::user()->phone]);

        $validate = $request->validate([
            'first_name' => 'required|string',
            'phone'      => 'required|numeric|unique:users,phone,'.Request()->user_id,
            'email'      => 'required|email|unique:users,email,'.Request()->user_id,
            'image'      => 'mimes:jpg,JPG,JPEG,jpeg,png,PNG,webp,WEBP|max:5120',
        ]);

        $id       = Auth::user()->id;
        try {
            $this->user->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return redirect()->back();
        } catch (Exception $e) {
            Toastr::warning(__($e->getMessage()));

            return redirect()->back();
        }
    }

    public function myAssignment(Request $request, CourseRepository $course)
    {
        $assignments                = Assignment::where('status', 1)->CourseAssignment()->paginate(setting('paginate'));

        if ($assignments->previousPageUrl()) {
            $input['total_results'] = $request->page * $assignments->perPage();
        }

        if ($assignments->onFirstPage()) {
            $input['total_results'] = $assignments->count();
        }
        $input['total_assignments'] = $assignments->total();
        if (request()->ajax()) {
            return response()->json($this->ajaxFilter($assignments, $input));
        }

        //$due_assignments = Assignment::where('status', 1)->CourseAssignment()->count();
        $my_assignments             = Assignment::where('status', 1)->CourseAssignment()->pluck('id');

        //$due_assignments = Assignment::where('status', 1)->CourseAssignment()->count();
        $my_assignments             = Assignment::where('status', 1)->CourseAssignment()->pluck('id');

        $submited_assignment        = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->count();
        $due_assignments            = $my_assignments->count() - $submited_assignment;
        $complete_assignment        = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->where('status', 1)->count();
        $failed_assignment          = SubmitedAssignment::whereIn('assignment_id', $my_assignments)->where('status', 2)->count();

        $data                       = [
            'assignments'         => $assignments,
            'due_assignments'     => $due_assignments,
            'complete_assignment' => $complete_assignment,
            'failed_assignment'   => $failed_assignment,
        ];

        return view('frontend.profile.my_assignment', $data);
    }

    protected function ajaxFilter($assignments, $input): array
    {
        try {
            $assignment_view = '';
            foreach ($assignments as $key => $assignment) {
                $vars = [
                    'assignment' => $assignment,
                    'key'        => $key,
                ];

                $assignment_view .= view('frontend.profile.my_assignment_load_more', $vars)->render();
            }

            return [
                'assignments' => $assignment_view,
                'next_page'   => $assignments->nextPageUrl(),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function assignmentDetails($slug, AssignmentRepository $assignmentRepository)
    {
        $assignment           = Assignment::where('slug', $slug)->first();
        $submitted_assignment = SubmitedAssignment::where('user_id', auth()->user()->id)->where('assignment_id', $assignment->id)->first();
        $data                 = [
            'assignment'           => $assignment,
            'submitted_assignment' => $submitted_assignment,
        ];

        return view('frontend.profile.submit_assignment', $data);
    }

    public function assignmentSubmit(Request $request, SubmitedAssignmentRepository $submitedAssignmentRepository)
    {

        $request->validate([
            'submitted_file' => 'required|mimes:pdf,zip',
        ]);
        try {
            $submitted_assignment = SubmitedAssignment::where('user_id', auth()->user()->id)->where('assignment_id', $request->assignment_id)->first();

            if (blank($submitted_assignment)) {
                $request['user_id'] = auth()->user()->id;
                $submitedAssignmentRepository->store($request->all());
                Toastr::success(__('submitted_successful'));

                return response()->json(['success' => __('submitted_successful'), 'is_reload' => true]);

            } elseif ($submitted_assignment->status == 0) {
                $request['user_id']       = auth()->user()->id;
                $request['assignment_id'] = $request->assignment_id;
                $submitedAssignmentRepository->update($request->all(), $submitted_assignment->id);
                Toastr::success(__('submitted_successful'));

                return response()->json(['success' => __('submitted_successful'), 'is_reload' => true]);
            } else {
                Toastr::success(__('not_allowed'));

                return response()->json(['error' => __('not_allowed')]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function submittedAssignmentDelete(Request $request, SubmitedAssignmentRepository $submitedAssignmentRepository)
    {

        $submitted_id = $request->id;
        try {
            $submitedAssignmentRepository->delete($submitted_id);
            $response = [
                'status'  => 'success',
                'title'   => __('success'),
                'message' => __('delete_successful'),
            ];

            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'status'  => 400,
                'title'   => 'error',
                'message' => __($e->getMessage()),
            ];

            return response()->json($response);
        }
    }

    public function resourceDownload($id): \Symfony\Component\HttpFoundation\BinaryFileResponse|RedirectResponse
    {
        try {
            $resource  = Resource::whereHas('course', function ($query) {
                $query->whereHas('enrolls.checkout', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })->find($id);
            if (! $resource) {
                abort(404);
            }
            $file_path = public_path($resource->source);
            $extension = explode('.', $file_path)[1];

            return response()->download($file_path, $resource->slug.".$extension");
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function oneSignalSubscribe(Request $request): JsonResponse
    {
        try {
            $user                          = auth()->user();

            if ($request->player_id) {
                $user->onesignal_player_id = $request->player_id;
            }

            $user->is_onesignal_subscribed = $request->subscribed;
            $user->save();

            return response()->json([
                'success' => 'OneSignal subscription status updated successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
