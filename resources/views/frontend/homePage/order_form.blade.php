@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    } elseif(isset($hero_course) && $hero_course) {
        $course = $hero_course;
        $mcSettings = is_array($hero_course->masterclass_settings) ? $hero_course->masterclass_settings : json_decode($hero_course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }

    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : 'Get Free Access Now';
    $payNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : (!empty($mcSettings['order_btn_text']) ? $mcSettings['order_btn_text'] : $heroBtnText);
    
    $is_enrolled = false;
    if(auth()->check() && isset($course)) {
        $is_enrolled = $course->enrolls()->whereHas('checkout', function ($query) {
            $query->where('user_id', auth()->id());
        })->exists();
    }

    $blueSectionImage = '';
    if (!empty($mcSettings['order_form_image_media_id'])) {
        $media = \App\Models\MediaLibrary::find($mcSettings['order_form_image_media_id']);
        if ($media && !empty($media->image_variants)) {
            $blueSectionImage = getFileLink('original_image', $media->image_variants);
        }
    }
    if (!$blueSectionImage && !empty($mcSettings['order_form_image_url'])) {
        $blueSectionImage = dynamic_asset($mcSettings['order_form_image_url']);
    }

    $orderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : 'আপনার ফ্রি স্পটটি নিশ্চিত করুন';
    $orderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : 'অ্যাক্সেস ডিটেইলস পাঠাতে আপনার সঠিক তথ্য দিন।';
    $orderFormBtnText = !empty($mcSettings['order_form_button_text']) ? $mcSettings['order_form_button_text'] : (!empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : (!empty($mcSettings['order_btn_text']) ? $mcSettings['order_btn_text'] : $heroBtnText));
@endphp

@if(isset($course))
<style>
    .lead-capture-wrapper {
        background: transparent;
        padding: 60px 0 100px 0;
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif);
    }
    .lead-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 16px 40px rgba(0, 56, 148, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 86, 210, 0.15);
        display: flex;
        flex-wrap: wrap;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 auto;
    }
    .lead-info-side {
        background: linear-gradient(145deg, #0056D2 0%, #003b93 100%);
        color: white;
        padding: 0;
        flex: 0 0 50%;
        max-width: 50%;
        width: 50%;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 450px;
    }
    .lead-info-full-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .lead-form-side {
        padding: 45px 38px;
        flex: 0 0 50%;
        max-width: 50%;
        width: 50%;
        background: #ffffff;
    }
    .form-heading {
        color: #0A1E3F;
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 8px;
        line-height: 1.3;
    }
    .form-subheading {
        color: #4B5A72;
        font-size: 14.5px;
        margin-bottom: 26px;
        line-height: 1.45;
    }
    .lead-form-side .form-label {
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 6px;
        display: block;
        font-size: 14px;
    }
    .lead-form-side .form-control {
        height: 48px;
        border-radius: 8px;
        border: 1px solid #CBD5E1;
        padding: 10px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
        background-color: #F8FAFC;
        width: 100%;
        color: #1E293B;
    }
    .lead-form-side .form-control:focus {
        background-color: #ffffff;
        border-color: #0056D2;
        box-shadow: 0 0 0 4px rgba(0, 86, 210, 0.12);
        outline: none;
    }
    .lead-form-side .btn-submit-profile {
        font-family: var(--body-font, "Hind Siliguri", "Inter", sans-serif) !important;
        background-color: #0056D2 !important;
        background: #0056D2 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 16px !important;
        border-radius: 8px !important;
        padding: 12px 24px !important;
        width: 100% !important;
        border: none !important;
        cursor: pointer !important;
        box-shadow: 0 4px 14px rgba(0, 86, 210, 0.25) !important;
        position: relative !important;
        overflow: hidden !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .lead-form-side .btn-submit-profile::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.35), transparent) !important;
        transition: all 0.6s ease !important;
        pointer-events: none !important;
    }
    .lead-form-side .btn-submit-profile:hover {
        background-color: #FF7A00 !important;
        background: #FF7A00 !important;
        box-shadow: 0 8px 22px rgba(255, 122, 0, 0.45) !important;
        transform: translateY(-2px) !important;
        color: #ffffff !important;
    }
    .lead-form-side .btn-submit-profile:hover::before {
        left: 100% !important;
    }
    .lead-form-side .btn-submit-profile i {
        font-size: 14px !important;
        margin-left: 6px !important;
        transition: transform 0.3s ease !important;
    }
    .lead-form-side .btn-submit-profile:hover i {
        transform: translateX(4px) !important;
    }
    
    @media (max-width: 768px) {
        .lead-capture-wrapper {
            padding: 15px 0 40px 0;
        }
        .lead-card {
            flex-direction: column;
            border-radius: 8px;
        }
        .lead-info-side {
            padding: 0;
            min-height: 250px;
            flex: 0 0 100%;
            max-width: 100%;
            width: 100%;
        }
        .lead-form-side {
            padding: 30px 20px;
            flex: 0 0 100%;
            max-width: 100%;
            width: 100%;
        }
    }
    
    .order-form-bottom-text {
        background-color: #eaf2fe;
        color: #0056D2;
        padding: 12px 18px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 500;
        line-height: 1.5;
        border: 1px dashed rgba(0, 86, 210, 0.3);
        margin-top: 20px;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-align: left;
    }
    .order-form-bottom-text i {
        font-size: 16px;
        flex-shrink: 0;
    }
    .order-form-bottom-text div > p {
        margin-bottom: 0;
    }
    .order-form-bottom-text div > p:last-child {
        margin-bottom: 0;
    }
</style>

<section class="lead-capture-wrapper" id="register">
    @include('frontend.homePage.sticky_promo_bar')
    <div class="container container-1278 px-lg-0 px-3">
        
        <div class="lead-card" data-aos="fade-up">
            <!-- Left Info Side (Only shown if image is uploaded) -->
            @if(!empty($blueSectionImage))
                <div class="lead-info-side">
                    <img src="{{ $blueSectionImage }}" alt="Lead Form Banner" class="lead-info-full-img">
                </div>
            @endif
            
            <!-- Right Form Side -->
            <div class="lead-form-side {{ empty($blueSectionImage) ? 'w-100' : '' }}" style="{{ empty($blueSectionImage) ? 'flex: 0 0 100% !important; max-width: 100% !important; width: 100% !important;' : '' }}">
                @if(!isset($mcSettings['pricing_status']) || !empty($mcSettings['pricing_status']))
                    @if(!empty($orderFormTitle))
                        <h3 class="form-heading">{!! $orderFormTitle !!}</h3>
                    @endif
                    @if(!empty($orderFormSubtitle))
                        <div class="form-subheading">{!! $orderFormSubtitle !!}</div>
                    @endif
                @endif
                
                @if((!isset($mcSettings['use_custom_lead_form']) || !empty($mcSettings['use_custom_lead_form'])) && !empty($mcSettings['custom_lead_form']))
                    <!-- Custom Embedded Lead Form (e.g. LeadsNimble / External CRM) -->
                    <div class="custom-embedded-lead-form mb-3">
                        {!! $mcSettings['custom_lead_form'] !!}
                    </div>
                    <script>
                        (function() {
                            function executeEmbedScripts() {
                                var container = document.querySelector('.custom-embedded-lead-form');
                                if (!container) return;
                                var scripts = container.querySelectorAll('script');
                                scripts.forEach(function(oldScript) {
                                    if (oldScript.dataset.executed) return;
                                    var newScript = document.createElement('script');
                                    Array.from(oldScript.attributes).forEach(function(attr) {
                                        newScript.setAttribute(attr.name, attr.value);
                                    });
                                    newScript.dataset.executed = "true";
                                    newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                                    oldScript.parentNode.replaceChild(newScript, oldScript);
                                });
                            }
                            if (document.readyState === 'loading') {
                                document.addEventListener('DOMContentLoaded', executeEmbedScripts);
                            } else {
                                executeEmbedScripts();
                            }
                        })();
                    </script>
                @else
                    <!-- Default Static Lead Form -->
                    <form action="{{ route('masterclass.checkout') }}" method="post" class="form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course->id }}">
                        <input type="hidden" name="type" value="course">
                        <input type="hidden" name="quantity" value="1">
                        
                        <div class="mb-4">
                            <label class="form-label">আপনার নাম <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-2 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="আপনার সম্পূর্ণ নাম লিখুন" required>
                            @error('name')
                                <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">ইমেইল <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-2 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="আপনার সঠিক ইমেইল লিখুন" required>
                            @error('email')
                                <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">মোবাইল নাম্বার <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control rounded-2 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="আপনার মোবাইল নাম্বার লিখুন" required>
                            @error('phone')
                                <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">হোয়াটসঅ্যাপ নাম্বার <span class="text-danger">*</span></label>
                            <input type="tel" name="whatsapp_number" class="form-control rounded-2 @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number') }}" placeholder="আপনার হোয়াটসঅ্যাপ নাম্বার লিখুন" required>
                            @error('whatsapp_number')
                                <span class="invalid-feedback d-block text-danger small mt-1"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-submit-profile w-100 text-center">
                            <span>{{ $orderFormBtnText }}</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>
                @endif

                @if(!empty($mcSettings['order_form_bottom_text']))
                    <div class="order-form-bottom-text">
                        <i class="fas fa-info-circle"></i>
                        <div>{!! $mcSettings['order_form_bottom_text'] !!}</div>
                    </div>
                @endif
            </div>
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
