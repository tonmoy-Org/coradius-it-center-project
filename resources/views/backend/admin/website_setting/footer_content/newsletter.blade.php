@extends('backend.layouts.master')
@section('title', __('newsletter_settings'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title mb-4" style="font-weight: 500;">{{ __('Footer & Contact Page Settings') }}</h3>
                    <div class="default-tab-list default-tab-list-v2 bg-white redious-border website-setting-social-link p-20 p-sm-30">
                        @include('backend.admin.website_setting.component.footer_setting_sidebar')
                        
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">

                            <!-- SECTION 2: FOOTER CONTACT & GENERAL INFORMATION -->
                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Footer Contact & General Information') }}
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-12">
                                            <label for="footer_logo_description" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Logo Description') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="footer_logo_description" name="footer_logo_description" rows="2">{{ setting('footer_logo_description',$lang) ?: '' }}</textarea>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="footer_get_in_touch_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Get In Touch Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="footer_get_in_touch_title" name="footer_get_in_touch_title"
                                                   value="{{ setting('footer_get_in_touch_title', $lang) }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="footer_get_in_touch_desc" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Footer Get In Touch Description') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="footer_get_in_touch_desc" name="footer_get_in_touch_desc"
                                                   value="{{ setting('footer_get_in_touch_desc',$lang) ?: '' }}">
                                        </div>

                                        <!-- Contact Address -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_address" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Address') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_address" name="contact_address"
                                                   value="{{ setting('contact_address',$lang) }}">
                                        </div>

                                        <!-- Contact Phone Number -->
                                        <div class="col-md-6 col-12">
                                            <label for="contact_phone" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Phone Number') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_phone" name="contact_phone"
                                                   value="{{ setting('contact_phone') ?: '' }}">
                                        </div>

                                        <!-- Phone Schedule / Hours -->
                                        <div class="col-md-4 col-12">
                                            <label for="contact_phone_schedule" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Phone Schedule / Hours') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_phone_schedule" name="contact_phone_schedule"
                                                   value="{{ setting('contact_phone_schedule', $lang) }}">
                                        </div>

                                        <!-- Contact Email Address -->
                                        <div class="col-md-4 col-12">
                                            <label for="contact_email" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Contact Email Address') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="contact_email" name="contact_email"
                                                   value="{{ setting('contact_email') ?: '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-30 mb-20">
                                <button type="submit" class="btn sg-btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 500;">{{ __('Update Settings') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
