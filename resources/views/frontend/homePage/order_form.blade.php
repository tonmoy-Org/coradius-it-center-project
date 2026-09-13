@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : 'Get Free Access Now';
    $payNowBtnText = $heroBtnText;
    
    $is_enrolled = false;
    if(auth()->check() && isset($course)) {
        $is_enrolled = $course->enrolls()->whereHas('checkout', function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }
@endphp

@if(isset($course))
<style>
    .lead-capture-wrapper {
        background: transparent;
        padding: 60px 0;
        font-family: 'Inter', sans-serif;
    }
    .lead-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 20px 40px rgba(0, 86, 210, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 86, 210, 0.1);
        display: flex;
        flex-wrap: wrap;
        max-width: 1000px;
        margin: 0 auto;
    }
    .lead-info-side {
        background: linear-gradient(145deg, #0056D2 0%, #003b93 100%);
        color: white;
        padding: 50px 40px;
        flex: 1 1 400px;
        position: relative;
        overflow: hidden;
    }
    .lead-info-side::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        opacity: 0.5;
        pointer-events: none;
    }
    .lead-info-content {
        position: relative;
        z-index: 2;
    }
    .lead-form-side {
        padding: 50px 40px;
        flex: 1 1 500px;
        background: #ffffff;
    }
    .lead-badge {
        background: rgba(255,255,255,0.2);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 20px;
        backdrop-filter: blur(5px);
    }
    .lead-title {
        font-size: 32px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 20px;
        color: #ffffff !important;
    }
    .lead-desc {
        font-size: 16px;
        opacity: 0.9;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .feature-list li {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 15px;
    }
    .feature-list li svg {
        margin-right: 12px;
        color: #4ade80;
    }
    .form-heading {
        color: #0A1E3F;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .form-subheading {
        color: #64748b;
        font-size: 15px;
        margin-bottom: 30px;
    }
    .modern-input {
        height: 56px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 10px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        background-color: #f8fafc;
        width: 100%;
        color: #1e293b;
    }
    .modern-input:focus {
        border-color: #0056D2;
        box-shadow: 0 0 0 4px rgba(0, 86, 210, 0.1);
        background-color: #ffffff;
        outline: none;
    }
    .modern-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }
    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #64748b;
        font-size: 13px;
        margin-top: 20px;
    }
    
    @media (max-width: 768px) {
        .lead-card {
            flex-direction: column;
        }
        .lead-info-side {
            padding: 40px 30px;
        }
        .lead-form-side {
            padding: 40px 30px;
        }
        .lead-title {
            font-size: 26px;
        }
    }
</style>

<section class="lead-capture-wrapper" id="register">
    @include('frontend.homePage.sticky_promo_bar')
    <div class="container container-1278">
        
        <div class="lead-card" data-aos="fade-up">
            <!-- Left Info Side -->
            <div class="lead-info-side">
                <div class="lead-info-content">
                    <div class="lead-badge">১০০% ফ্রি এক্সেস</div>
                    <h2 class="lead-title">{{ $course->title }}</h2>
                    <p class="lead-desc">আজই আমাদের সাথে যুক্ত হোন এবং ডিজিটাল স্কিল শেখা শুরু করুন। এক্সক্লুসিভ ট্রেনিং ম্যাটেরিয়ালস পেতে নিচের ফর্মটি পূরণ করুন।</p>
                    
                    <ul class="feature-list">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            ইন্সট্যান্ট আজীবন এক্সেস
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            স্টেপ-বাই-স্টেপ ভিডিও টিউটোরিয়াল
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            এক্সপার্ট গাইডলাইন
                        </li>
                    </ul>
                    
                    <div style="margin-top: 40px; text-align: center;">
                        <img src="{{ getFileLink('295x248', $course->image) }}" alt="{{ $course->title }}" class="rounded shadow" style="width: 100%; max-width: 280px; border: 4px solid rgba(255,255,255,0.2);">
                    </div>
                </div>
            </div>
            
            <!-- Right Form Side -->
            <div class="lead-form-side">
                <h3 class="form-heading">আপনার ফ্রি স্পটটি নিশ্চিত করুন</h3>
                <p class="form-subheading">অ্যাক্সেস ডিটেইলস পাঠাতে আপনার সঠিক তথ্য দিন।</p>
                
                <form action="{{ route('masterclass.checkout') }}" method="post" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <input type="hidden" name="type" value="course">
                    <input type="hidden" name="quantity" value="1">
                    
                    <div class="mb-4">
                        <label class="modern-label">আপনার নাম <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="modern-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="আপনার সম্পূর্ণ নাম লিখুন" required>
                        @error('name')
                            <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="modern-label">ইমেইল <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="modern-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="আপনার সঠিক ইমেইল লিখুন" required>
                        @error('email')
                            <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="modern-label">মোবাইল নাম্বার <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="modern-input @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="আপনার মোবাইল নাম্বার লিখুন" required>
                        @error('phone')
                            <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4" style="margin-top: 10px;">
                        <div class="d-flex align-items-start gap-2">
                            <input type="checkbox" name="agree" id="agree_terms" required style="margin-top: 4px; width: 18px; height: 18px; cursor: pointer;">
                            <label for="agree_terms" class="text-muted small" style="cursor: pointer; line-height: 1.5; font-size: 13px;">
                                আমি মার্কেটিং সংক্রান্ত যোগাযোগ গ্রহণে সম্মত এবং মেনে নিচ্ছি <a href="{{ route('terms.conditions') }}" target="_blank" class="text-primary text-decoration-none fw-semibold">শর্তাবলী</a> ও <a href="{{ route('refund.policy') }}" target="_blank" class="text-primary text-decoration-none fw-semibold">গোপনীয়তা নীতি</a>।
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="template-btn w-100 text-center border-0" style="border-radius: 4px; padding: 15px 0; font-size: 18px;">
                        {{ $payNowBtnText }}
                    </button>
                    
                    <div class="secure-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        আপনার তথ্য ১০০% নিরাপদ এবং কারও সাথে শেয়ার করা হবে না।
                    </div>
                </form>
        </div>
    </div>
</section>

@endif

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.lead-form-side form');
    if (!form) return;
    
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        
        submitBtn.disabled = true;
        let originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = 'অপেক্ষা করুন...';
        
        let formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(result => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            
            if (result.status === 422) {
                // Validation errors
                const errors = result.body.errors;
                let firstError = '';
                for (const field in errors) {
                    if (!firstError) firstError = errors[field][0];
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const errorMsg = document.createElement('span');
                        errorMsg.className = 'invalid-feedback d-block text-danger small mt-1';
                        errorMsg.innerHTML = `<strong>${errors[field][0]}</strong>`;
                        input.parentNode.appendChild(errorMsg);
                    }
                }
                if (firstError && typeof toastr !== 'undefined') {
                    toastr.error(firstError);
                }
            } else if (result.status === 200 || result.status === 201) {
                if(result.body.success) {
                    if (typeof toastr !== 'undefined') toastr.success(result.body.message || 'Successfully submitted!');
                    form.reset();
                } else {
                    if (typeof toastr !== 'undefined') toastr.error(result.body.message || 'Something went wrong');
                }
            } else {
                if (typeof toastr !== 'undefined') toastr.error('Something went wrong');
            }
        })
        .catch(error => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            console.error('Error:', error);
            if (typeof toastr !== 'undefined') toastr.error('An unexpected error occurred');
        });
    });
});
</script>
