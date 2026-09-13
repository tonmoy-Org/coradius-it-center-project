@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $orderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : '';
    $orderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : '';
    
    $nameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : (!empty($mcSettings['order_name_label']) ? $mcSettings['order_name_label'] : __('Your Full Name'));
    $namePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : (!empty($mcSettings['order_name_placeholder']) ? $mcSettings['order_name_placeholder'] : '');
    $phoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : (!empty($mcSettings['order_phone_label']) ? $mcSettings['order_phone_label'] : __('Mobile Number'));
    $phonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : (!empty($mcSettings['order_phone_placeholder']) ? $mcSettings['order_phone_placeholder'] : '');
    $emailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : (!empty($mcSettings['order_email_label']) ? $mcSettings['order_email_label'] : __('Email address'));
    $emailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : (!empty($mcSettings['order_email_placeholder']) ? $mcSettings['order_email_placeholder'] : '');
    
    $addressLabel = !empty($mcSettings['address_label']) ? $mcSettings['address_label'] : (!empty($mcSettings['order_address_label']) ? $mcSettings['order_address_label'] : __('Full Address'));
    $addressPlaceholder = !empty($mcSettings['address_placeholder']) ? $mcSettings['address_placeholder'] : (!empty($mcSettings['order_address_placeholder']) ? $mcSettings['order_address_placeholder'] : '');
    $passwordLabel = !empty($mcSettings['password_label']) ? $mcSettings['password_label'] : (!empty($mcSettings['order_password_label']) ? $mcSettings['order_password_label'] : __('Create account password'));
    $passwordPlaceholder = !empty($mcSettings['password_placeholder']) ? $mcSettings['password_placeholder'] : (!empty($mcSettings['order_password_placeholder']) ? $mcSettings['order_password_placeholder'] : '');
    $termsLabel = !empty($mcSettings['terms_label']) ? $mcSettings['terms_label'] : (!empty($mcSettings['order_terms_label']) ? $mcSettings['order_terms_label'] : '');

    $privacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : '';
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : __('PAY NOW');
    $payNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : (!empty($mcSettings['order_btn_text']) ? $mcSettings['order_btn_text'] : $heroBtnText);
    
    $billingDetailsTitle = !empty($mcSettings['billing_details_title']) ? $mcSettings['billing_details_title'] : __('Billing Details');
    $yourOrderTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : (!empty($mcSettings['your_order_title']) ? $mcSettings['your_order_title'] : __('Your Order'));
    
    $is_enrolled = false;
    if(auth()->check() && isset($course)) {
        $is_enrolled = $course->enrolls()->whereHas('checkout', function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }
@endphp

@if(isset($course))
<section class="order-form-section p-t-60 p-b-35" style="background: #ffffff;">
    @include('frontend.homePage.sticky_promo_bar')
    <div class="container container-1278">
        <div class="mc-registration-section" id="register">
            @if($is_enrolled && !(auth()->check() && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')))
                <div class="text-center p-5 shadow-sm" style="border: 2px dashed var(--color-primary, #0056D2); border-radius: 12px; background-color: var(--color-blue-tint, #EAF2FE); margin-top: 20px; margin-bottom: 20px;">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary, #0056D2)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <h3 class="fw-bold mb-3" style="color: var(--color-text-ink, #0A1E3F); font-size: 24px;">আপনি ইতিমধ্যে এই কোর্সে ভর্তি হয়েছেন!</h3>
                    <p class="text-muted mb-4" style="font-size: 16px;">কোর্সটি শুরু করতে এখনই আপনার লার্নিং ড্যাশবোর্ডে প্রবেশ করুন।</p>
                    <a href="{{ route('my-profile') }}" class="template-btn px-5 py-3" style="font-size: 16px; border-radius: 8px;">ড্যাশবোর্ডে যান (Go to Dashboard)</a>
                    

                </div>
            @else
            
            <form action="{{ route('masterclass.checkout') }}" method="post" class="form">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="type" value="course">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="coupon_code" id="applied_coupon_code">
                
                <div class="row gx-lg-5">
                    <!-- Left Column: Billing Details -->
                    <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                        
                        <!-- Coupon Section -->
                        <div class="coupon-section mb-5">
                            <div class="d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                <span class="text-dark" style="font-weight: 500;">{{ __('Have a coupon?') }}</span>
                                <a href="javascript:void(0)" class="text-decoration-none coupon-toggle" style="color: var(--color-primary, #0056D2); font-weight: 500;" onclick="document.querySelector('.coupon-form-wrapper').style.display = document.querySelector('.coupon-form-wrapper').style.display === 'none' ? 'block' : 'none'">{{ __('Click here to enter your code') }}</a>
                            </div>
                            <div class="coupon-form-wrapper mt-4 p-4 shadow-sm" style="display: none; transition: all 0.3s ease; border: 1px dashed #e2e8f0; border-radius: 4px;">
                                <p class="text-muted small mb-3">{{ __('If you have a coupon code, please apply it below.') }}</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <input type="text" id="guest_coupon_code" class="form-control" placeholder="{{ __('Coupon code') }}" style="height: 45px; border: 1px solid #e2e8f0; border-radius: 4px; max-width: 300px; flex: 1 1 180px;">
                                    <button type="button" class="template-btn apply-coupon-btn px-4 border-0" id="apply_guest_coupon_btn" style="height: 45px; border-radius: 4px; line-height: 1;">{{ __('Apply') }}</button>
                                </div>
                            </div>
                        </div>

                        @if(!empty($billingDetailsTitle))
                        <h4 class="fw-bold mb-4" style="color: #0A1E3F; font-size: 22px;">{{ $billingDetailsTitle }}</h4>
                        @endif
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $nameLabel }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" placeholder="{{ $namePlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('name')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $addressLabel }} <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="{{ $addressPlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('address')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $emailLabel }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" placeholder="{{ $emailPlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('email')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark mb-2">{{ $phoneLabel }} <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}" placeholder="{{ $phonePlaceholder }}" required style="height: 50px; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            @error('phone')
                                <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        

                    </div>
                    
                    <!-- Right Column: Your Order -->
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                        @if(!empty($yourOrderTitle))
                        <h4 class="fw-bold mb-4" style="color: #0A1E3F; font-size: 22px;">{{ $yourOrderTitle }}</h4>
                        @endif
                        
                        <div class="order-summary-box mb-4">
                            <table class="table border-bottom" style="margin-bottom: 0;">
                                <thead>
                                    <tr>
                                        <th class="border-0 fw-bold" style="padding: 12px 0;">{{ __('Product') }}</th>
                                        <th class="border-0 fw-bold text-end" style="padding: 12px 0;">{{ __('Subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-top">
                                        <td class="align-middle py-3 border-0" style="padding-left: 0;">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ getFileLink('295x248', $course->image) }}" alt="{{ $course->title }}" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-1 fw-bold text-dark" style="font-size: 15px;">{{ $course->title }}</h6>
                                                    <span class="text-muted small">x 1</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-end py-3 border-0 fw-semibold" style="padding-right: 0;">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="py-3 border-0 fw-bold text-dark" style="padding-left: 0;">{{ __('Subtotal') }}</td>
                                        <td class="py-3 border-0 text-end fw-semibold" style="padding-right: 0;">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                    <tr class="border-top coupon-discount-row" style="display: none;">
                                        <td class="py-3 border-0 fw-bold text-dark" style="padding-left: 0;">{{ __('Discount') }}</td>
                                        <td class="py-3 border-0 text-end fw-semibold text-danger" style="padding-right: 0;" id="order_discount">
                                            -
                                        </td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="py-3 border-0 fw-bold text-dark" style="padding-left: 0;">{{ __('Total') }}</td>
                                        <td class="py-3 border-0 text-end fw-bold" style="padding-right: 0; font-size: 20px; color: #0056D2;" id="order_total">
                                            {{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        

                        
                        <div class="mb-4">
                            @if(!empty($privacyNotice))
                            <div class="text-muted small mb-3" style="font-size: 13px; line-height: 1.6;">
                                {!! $privacyNotice !!}
                            </div>
                            @endif
                            <div class="d-flex align-items-start gap-2">
                                <input type="checkbox" name="agree" id="agree_terms" required style="margin-top: 4px; width: 16px; height: 16px;">
                                <label for="agree_terms" class="fw-semibold text-dark small" style="cursor: pointer;">
                                    {!! !empty($termsLabel) ? $termsLabel : __('I have read and agree to the website\'s') !!} <a href="{{ route('terms.conditions') }}" target="_blank" class="text-primary text-decoration-none">{{ __('Terms') }}</a> {{ __('and') }} <a href="{{ route('refund.policy') }}" target="_blank" class="text-primary text-decoration-none">{{ __('Refund Policy') }}</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="template-btn w-100 text-center border-0" style="border-radius: 4px;">
                            {{ $payNowBtnText }} <span id="pay_now_btn_price">{{ $course->is_free ? __('free') : get_price($course->price, userCurrency()) }}</span>
                        </button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</section>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const applyBtn = document.getElementById('apply_guest_coupon_btn');
        if (applyBtn) {
            applyBtn.addEventListener('click', function() {
                const code = document.getElementById('guest_coupon_code').value;
                const courseId = '{{ $course->id }}';
                
                // Get email if provided (it will be validated on backend)
                const emailInput = document.querySelector('input[name="email"]');
                const email = emailInput ? emailInput.value : '';
                
                if (!code) {
                    if (typeof toastr !== 'undefined') toastr.error("Please enter a coupon code");
                    else alert("Please enter a coupon code");
                    return;
                }
                
                applyBtn.disabled = true;
                applyBtn.innerText = 'Applying...';
                
                fetch('{{ route('check.guest.coupon') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code: code, course_id: courseId, email: email })
                })
                .then(response => response.json())
                .then(data => {
                    applyBtn.disabled = false;
                    applyBtn.innerText = 'Apply';
                    
                    if (data.success) {
                        if (typeof toastr !== 'undefined') toastr.success(data.success);
                        
                        document.getElementById('applied_coupon_code').value = code;
                        
                        // Update UI
                        document.querySelector('.coupon-discount-row').style.display = 'table-row';
                        document.getElementById('order_discount').innerText = '-' + data.discount_amount_formatted;
                        document.getElementById('order_total').innerText = data.total_formatted;
                        
                        const payNowBtnPrice = document.getElementById('pay_now_btn_price');
                        if (payNowBtnPrice) {
                            payNowBtnPrice.innerText = data.total_formatted;
                        }
                    } else if (data.error) {
                        if (typeof toastr !== 'undefined') toastr.error(data.error);
                        else alert(data.error);
                    }
                })
                .catch(error => {
                    applyBtn.disabled = false;
                    applyBtn.innerText = 'Apply';
                    console.error('Error:', error);
                });
            });
        }
    });
</script>
@endpush

@endif
