<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AppliedCoupon;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Course;
use App\Repositories\BookRepository;
use App\Repositories\CartRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\CouponRepository;
use App\Repositories\CourseRepository;
use App\Traits\PaymentTrait;
use App\Traits\SmsSenderTrait;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CartController extends Controller
{
    use PaymentTrait, SmsSenderTrait;

    protected $courseRepository;

    protected $bookRepository;

    protected $cartRepository;

    protected $checkout;

    public function __construct(CourseRepository $courseRepository, BookRepository $bookRepository, CartRepository $cartRepository, CheckoutRepository $checkout)
    {
        $this->courseRepository = $courseRepository;
        $this->bookRepository   = $bookRepository;
        $this->cartRepository   = $cartRepository;
        $this->checkout         = $checkout;
    }

    public function addToCart(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            if (auth()->check()) {
                $user_id  = auth()->id();
                if ($request->type == 'course') {
                    $course        = $this->courseRepository->find($request->id);
                    $cartable_type = Course::class;
                } else {
                    if (addon_is_activated('book_store')) {
                        return response()->json([
                            'error' => __('addon_not_installed_yet'),
                        ]);
                    }
                    $course        = $this->bookRepository->find($request->id);
                    $cartable_type = Book::class;
                }

                $cart     = Cart::where('user_id', $user_id)
                    ->where('cartable_id', $request->id)
                    ->where('cartable_type', $cartable_type)
                    ->first();

                $has_cart = $this->cartRepository->hasCart($user_id);

                if ($cart) {
                    $response = [
                        'status'  => 'success',
                        'title'   => 'success',
                        'message' => __('course_already_added_to_cart'),
                        'items'   => session()->get('items'),
                    ];

                    return response()->json($response);
                } else {
                    $quantity  = $request->quantity ?? 1;
                    $sub_total = $course->is_free ? 0 : $course->price * $quantity;
                    $tax       = $shipping_cost = 0;
                    $trx_id    = $has_cart ? $has_cart->trx_id : Str::random();
                    $cart      = $this->cartRepository->store([
                        'instructor_id' => $course->instructor_ids,
                        'user_id'       => $user_id,
                        'quantity'      => $quantity,
                        'price'         => $course->is_free ? 0 : $course->price,
                        'discount'      => $course->discount_check,
                        'trx_id'        => $trx_id,
                        'tax'           => 0,
                        'sub_total'     => $sub_total,
                        'total_amount'  => ($sub_total + $tax + $shipping_cost) - $course->discount_check,
                        'shipping_cost' => 0,
                        'cartable_id'   => $course->id,
                        'cartable_type' => $cartable_type,
                    ]);

                    $courses   = $this->courseRepository->cartCourse();
                    $books     = addon_is_activated('book_store') ? $this->bookRepository->cartBooks() : [];
                }
            } else {
                $session_carts = session()->get('carts');
                if ($request->type == 'course') {
                    $carts['course_'.$request->id] = [
                        'id'       => $request->id,
                        'type'     => $request->type,
                        'quantity' => $request->quantity ?? 1,
                    ];
                } else {
                    if (addon_is_activated('book_store')) {
                        return response()->json([
                            'error' => __('addon_not_installed_yet'),
                        ]);
                    }
                    $carts['book_'.$request->id] = [
                        'id'       => $request->id,
                        'type'     => $request->type,
                        'quantity' => $request->quantity ?? 1,
                    ];
                }

                if ($session_carts) {
                    $carts = array_merge($session_carts, $carts);
                }
                session()->put('carts', $carts);
                $total_items   = session()->get('carts');

                $course_ids    = $books_ids = [];

                foreach ($total_items as $item) {
                    if ($item['type'] == 'course') {
                        $course_ids[] = $item['id'];
                    } else {
                        $books_ids[] = $item['id'];
                    }
                }
                $courses       = $this->courseRepository->findCourses($course_ids);
                $books         = addon_is_activated('book_store') ? $this->bookRepository->findBooks($books_ids) : [];
            }

            $carts    = [
                'courses' => $courses,
                'books'   => $books,
            ];

            $response = [
                'success'     => __('added_to_cart_successfully'),
                'html'        => view('frontend.cart_component', compact('carts'))->render(),
                'total_items' => count($courses) + count($books),
            ];

            // dd($carts);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json([
                'error' => __($e->getMessage()),
            ]);
        }
    }

    public function studentCheckout($user_id, $trx_id)
    {
        $input                   = [
            'paginate' => setting('paginate'),
            'user_id'  => $user_id,
        ];
        $carts                   = $this->cartRepository->all($input);
        $sub_total               = $carts->sum('sub_total');
        $discount                = $carts->sum('discount');
        $coupon_discount         = $carts->sum('coupon_discount');
        $tax                     = $carts->sum('tax');
        $total_amount            = $carts->sum('total_amount');

        $data                    = [];
        $data['user_id']         = $user_id;
        $data['trx_id']          = $trx_id;
        $data['sub_total']       = $sub_total;
        $data['tax']             = $tax;
        $data['discount']        = $discount;
        $data['coupon_discount'] = $coupon_discount;
        $data['total_amount']    = $total_amount;
        $data['payable_amount']  = $total_amount;

        $unpaid_checkout         = $this->checkout->unpaidCheckout($user_id);
        if (!empty($unpaid_checkout)) {
            $this->checkout->update($data, $trx_id);
        }
    }

    public function itemRemove(Request $request)
    {
        try {
            if (auth()->check()) {
                $this->cartRepository->deleteCart([
                    'id'   => $request->id,
                    'type' => $request->type == 'course' ? Course::class : Book::class,
                ]);

            } else {
                $carts = session()->get('carts');
                unset($carts[$request->type.'_'.$request->id]);
                session()->put('carts', $carts);
            }
            Toastr::success(__('item_removed_from_cart'));

            return back();

        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function cartView(CouponRepository $couponRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $trx_id         = '';
            $carts          = $this->cartRepository->all([
                'user_id' => auth()->id(),
            ]);
            if (count($carts) > 0) {
                $trx_id = $carts->first()->trx_id;
            }

            $coupons        = $couponRepository->appliedCoupons([
                'user_id' => auth()->id(),
                'trx_id'  => $trx_id,
            ], 'coupon');

            $total_discount = $coupons->sum('coupon_discount');

            $data           = [
                'user_carts'     => $carts,
                'coupons'        => $coupons,
                'total_discount' => $total_discount,
            ];

            return view('frontend.cart', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function coursePayment()
    {
        $user_id = auth()->user()->id;
        $token   = csrf_token();
        $carts   = $this->cartRepository->all(
            [
                'type'     => Course::class,
                'user_id'  => $user_id,
                'paginate' => setting('paginate'),
            ]
        );

        $data    = [
            'carts'           => $carts,
            'total_amount'    => $carts->sum('total_amount'),
            'sub_total'       => $carts->sum('sub_total'),
            'tax'             => $carts->sum('tax'),
            'discount'        => $carts->sum('discount'),
            'shipping_cost'   => $carts->sum('shipping_cost'),
            'coupon_discount' => $carts->sum('coupon_discount'),
            'token'           => $token,
            'trx_id'          => $carts->first()->trx_id,
            'currency'        => setting('default_currency'),
            'jazz_data'       => $this->jazzCashPayment(),
            'jazz_url'        => config('jazz_cash.TRANSACTION_POST_URL'),
        ];

        return view('api.payment', $data);
    }

    public function applyCoupon(Request $request, CouponRepository $couponRepository): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'code' => 'required',
        ]);

        try {
            $user            = auth()->user();
            $success         = false;
            $carts           = Cart::where('user_id', $user->id)->get();
            $coupon          = $couponRepository->couponByCode($request->code);

            if ($coupon->start_date <= now() && $coupon->end_date > now()) {
                $is_coupon_applied = $couponRepository->isCouponApplied([
                    'id'      => $coupon->id,
                    'user_id' => $user->id,
                ]);

                if ($is_coupon_applied) {
                    return response()->json([
                        'error' => __('coupon_already_applied'),
                    ]);
                }

                if ($coupon->type == 'course') {
                    $repo       = new CourseRepository();
                    $course     = $repo->findCourses($carts->where('cartable_type', Course::class)->pluck('cartable_id')->toArray());
                    $duplicates = array_intersect($coupon->course_ids, $course->pluck('id')->toArray());

                    if (count($duplicates) > 0) {
                        $carts   = $carts->where('cartable_type', Course::class)->whereIn('cartable_id', $duplicates);
                        $success = true;
                    } else {
                        return response()->json([
                            'error' => __('invalid_coupon'),
                        ]);
                    }
                } elseif ($coupon->type == 'instructor') {
                    $repo       = new CourseRepository();
                    $course     = $repo->findCourses($carts->where('cartable_type', Course::class)->pluck('cartable_id')->toArray());
                    $duplicates = array_intersect($coupon->instructor_ids, array_unique(array_merge(...$course->pluck('instructor_ids')->toArray())));

                    if (count($duplicates) > 0) {
                        $duplicates = array_intersect($coupon->instructor_ids, array_unique(array_merge(...$course->pluck('instructor_ids')->toArray())));
                        $carts      = [];
                        foreach ($duplicates as $duplicate) {
                            $carts[] = Cart::where('user_id', $user->id)->whereJsonContains('instructor_id', (string) $duplicate)->first();
                        }
                        $success    = true;
                    } else {
                        return response()->json([
                            'error' => __('invalid_coupon'),
                        ]);
                    }
                } elseif ($coupon->type == 'global') {
                    $success = true;
                }
            } else {
                return response()->json([
                    'error' => __('coupon_expired'),
                ]);
            }

            DB::beginTransaction();

            $discount_amount = 0;
            $applied_coupon  = '';

            if ($success) {
                foreach ($carts as $cart) {
                    $discount_amount += $coupon->discount_type == 'percent' ? ($cart->price * $coupon->discount) / 100 : $coupon->discount;
                }

                $applied_coupon = $couponRepository->couponApply([
                    'user_id'         => $user->id,
                    'coupon_id'       => $coupon->id,
                    'trx_id'          => $carts->first()->trx_id,
                    'coupon_discount' => $discount_amount,
                ]);
            }

            $carts           = Cart::where('user_id', $user->id)->get();

            $total_amount    = $carts->sum('total_amount') - $discount_amount;

            DB::commit();

            return response()->json([
                'success'         => __('coupon_applied_successfully'),
                'subtotal'        => get_price($carts->sum('sub_total'), userCurrency()),
                'coupon_discount' => get_price($discount_amount, userCurrency()),
                'total'           => get_price($total_amount, userCurrency()),
                'html'            => $applied_coupon ? view('frontend.components.coupon', compact('applied_coupon'))->render() : '',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function deleteAppliedCoupon($id): \Illuminate\Http\RedirectResponse
    {

        try {
            AppliedCoupon::destroy($id);
            Toastr::success(__('coupon_removed_successfully'));

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function masterclassCheckout(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:marketing_leads,email',
            'phone'           => 'required|string|max:30|unique:marketing_leads,phone',
            'whatsapp_number' => 'nullable|string|max:30',
            'whatsapp'        => 'nullable|string|max:30',
            'id'              => 'required',
        ], [
            'email.unique' => 'Already submitted, try a new email',
            'phone.unique' => 'Already submitted, try a new number',
        ]);

        try {
            $whatsappNum = $request->whatsapp_number ?: ($request->whatsapp ?: $request->phone);

            // 1. Save Marketing Lead
            $marketingLead = \App\Models\MarketingLead::create([
                'name'            => $request->name,
                'email'           => $request->email,
                'phone'           => $request->phone,
                'whatsapp_number' => $whatsappNum,
                'course_id'       => $request->id,
            ]);

            // 2. Trigger Webhook
            $webhookUrl   = setting('marketing_webhook_url');
            if (empty($webhookUrl)) {
                $webhookUrl = \Illuminate\Support\Facades\DB::table('settings')->where('title', 'marketing_webhook_url')->value('value');
            }

            $webhookToken = setting('marketing_webhook_token');
            if (empty($webhookToken)) {
                $webhookToken = \Illuminate\Support\Facades\DB::table('settings')->where('title', 'marketing_webhook_token')->value('value');
            }

            if (!empty($webhookUrl)) {
                try {
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Accept'       => 'application/json',
                    ];

                    if (!empty($webhookToken)) {
                        $cleanToken = preg_replace('/^Bearer\s+/i', '', trim($webhookToken));
                        $headers['Authorization'] = 'Bearer ' . $cleanToken;
                    }

                    $response = \Illuminate\Support\Facades\Http::withHeaders($headers)->post($webhookUrl, [
                        'name'                     => $request->name,
                        'email'                    => $request->email,
                        'phone'                    => $request->phone,
                        'whatsapp'                 => $whatsappNum,
                        'whatsapp_number'          => $whatsappNum,
                        'আপনার ওয়াটস অ্যাপ নাম্বার' => $whatsappNum,
                        'course_id'                => $request->id,
                    ]);

                    if ($response->successful()) {
                        $marketingLead->update(['is_synced' => 1]);
                    } else {
                        \Illuminate\Support\Facades\Log::error('Marketing Webhook Failed with status ' . $response->status() . ': ' . $response->body());
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Marketing Webhook Failed: ' . $e->getMessage());
                }
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => __('Successfully submitted!')]);
            }

            Toastr::success(__('Successfully submitted!'));
            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            Toastr::error($e->getMessage());
            return back()->withInput();
        }
    }
public function checkGuestCoupon(Request $request, CouponRepository $couponRepository): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'code'      => 'required',
            'course_id' => 'required',
        ]);

        try {
            $coupon = $couponRepository->couponByCode($request->code);

            if (!$coupon) {
                return response()->json(['error' => __('invalid_coupon')]);
            }

            if (auth()->check() || $request->filled('email')) {
                $user = auth()->user() ?? \App\Models\User::where('email', $request->email)->first();
                if ($user) {
                    $is_coupon_applied = $couponRepository->isCouponApplied([
                        'id'      => $coupon->id,
                        'user_id' => $user->id,
                    ]);
                    if ($is_coupon_applied) {
                        return response()->json(['error' => 'You have already used this coupon.']);
                    }
                }
            }

            if ($coupon->start_date <= now() && $coupon->end_date > now()) {
                $course = $this->courseRepository->find($request->course_id);

                if (!$course) {
                    return response()->json(['error' => __('course_not_found')]);
                }

                $success = false;

                if ($coupon->type == 'course') {
                    if (in_array($course->id, $coupon->course_ids ?? [])) {
                        $success = true;
                    }
                } elseif ($coupon->type == 'instructor') {
                    $instructor_ids = is_array($course->instructor_ids) ? $course->instructor_ids : (json_decode($course->instructor_ids ?? '[]', true) ?? []);
                    $duplicates = array_intersect($coupon->instructor_ids ?? [], $instructor_ids);
                    if (count($duplicates) > 0) {
                        $success = true;
                    }
                } elseif ($coupon->type == 'global') {
                    $success = true;
                }

                if ($success) {
                    $price = $course->is_free ? 0 : $course->price;
                    $discount_amount = $coupon->discount_type == 'percent' ? ($price * $coupon->discount) / 100 : $coupon->discount;
                    
                    return response()->json([
                        'success'                   => __('coupon_applied_successfully'),
                        'discount_amount'           => $discount_amount,
                        'total'                     => max(0, $price - $discount_amount),
                        'discount_amount_formatted' => get_price($discount_amount, userCurrency()),
                        'total_formatted'           => get_price(max(0, $price - $discount_amount), userCurrency()),
                    ]);
                } else {
                    return response()->json(['error' => __('invalid_coupon')]);
                }

            } else {
                return response()->json(['error' => __('coupon_expired')]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
