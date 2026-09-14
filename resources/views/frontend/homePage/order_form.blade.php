@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
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
    if (!$blueSectionImage && !empty($course->image)) {
        $blueSectionImage = getFileLink('original_image', $course->image);
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
        padding: 0;
        flex: 1 1 400px;
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
        padding: 50px 40px;
        flex: 1 1 500px;
        background: #ffffff;
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
    .lead-form-side .form-label {
        font-weight: 500;
        color: #334155;
        margin-bottom: 6px;
        display: block;
        font-size: 14px;
    }
    .lead-form-side .form-control {
        height: 48px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        padding: 10px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
        background-color: #ffffff;
        width: 100%;
        color: #1e293b;
    }
    .lead-form-side .form-control:focus {
        border-color: #0056D2;
        box-shadow: 0 0 0 3px rgba(0, 86, 210, 0.15);
        outline: none;
    }
    .lead-form-side .btn-submit-profile {
        background-color: #0056D2;
        color: #ffffff;
        font-weight: 600;
        font-size: 16px;
        border-radius: 6px;
        padding: 12px 24px;
        width: 100%;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .lead-form-side .btn-submit-profile:hover {
        background-color: #0044ab;
    }
    
    @media (max-width: 768px) {
        .lead-card {
            flex-direction: column;
        }
        .lead-info-side {
            padding: 0;
            min-height: 250px;
        }
        .lead-form-side {
            padding: 40px 30px;
        }
    }
</style>

<section class="lead-capture-wrapper" id="register">
    @include('frontend.homePage.sticky_promo_bar')
    <div class="container container-1278">
        
        <div class="lead-card" data-aos="fade-up">
            <!-- Left Info Side -->
            <div class="lead-info-side">
                @if(!empty($blueSectionImage))
                    <img src="{{ $blueSectionImage }}" alt="Lead Form Banner" class="lead-info-full-img">
                @endif
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

                    <button type="submit" class="btn btn-submit-profile w-100 text-center">
                        {{ $payNowBtnText }}
                    </button>
                </form>
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
