@extends('backend.layouts.master')
@section('title', __('Sticky Promo Bar Settings'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title mb-0" style="font-weight: 500;">{{ __('Sticky Promo Bar Settings') }}</h3>

                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('website.sticky_promo.save') }}" id="setting-form" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">

                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Sticky Promo Bar Settings') }}
                                    </h6>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-12 col-lg-12">
                                            <div class="d-flex align-items-center justify-content-between gap-2 sandbox_mode_div mb-4">
                                                <input type="hidden" name="show_sticky_promo_bar" value="0">
                                                <label class="form-label m-0" for="show_sticky_promo_bar" style="font-size: 13px; font-weight: 400;">Enable Section</label>
                                                <div class="setting-check m-0">
                                                    <input type="checkbox" name="show_sticky_promo_bar" value="1" id="show_sticky_promo_bar" class="sandbox_mode" {{ setting('show_sticky_promo_bar') == 1 ? 'checked' : '' }}>
                                                    <label for="show_sticky_promo_bar"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Promo Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_title" name="sticky_promo_title"
                                                   value="{{ setting('sticky_promo_title', $lang) ?: setting('sticky_promo_title') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_btn_text" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Button Text') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_btn_text" name="sticky_promo_btn_text"
                                                   value="{{ setting('sticky_promo_btn_text', $lang) ?: setting('sticky_promo_btn_text') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="sticky_promo_btn_link" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Button Link') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="sticky_promo_btn_link" name="sticky_promo_btn_link"
                                                   value="{{ setting('sticky_promo_btn_link') ?: '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                <button type="submit" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection






