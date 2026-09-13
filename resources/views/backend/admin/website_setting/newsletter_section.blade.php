@extends('backend.layouts.master')
@section('title', __('Newsletter Section Settings'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title mb-4" style="font-weight: 500;">{{ __('Newsletter Section Settings') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('footer.update-setting') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="site_lang" value="{{$lang}}">

                            <div class="card border mb-4 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                <div class="card-header bg-light py-3 px-4 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-dark" style="font-size: 15px; font-weight: 500;">
                                        {{ __('Newsletter Section Settings') }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2 m-0">
                                        <input type="hidden" name="show_newsletter" value="{{ setting('show_newsletter') == 1 ? 1 : 0 }}">
                                        <label class="form-label m-0" for="show_newsletter" style="font-size: 13px; font-weight: 400;">{{ __('Enable Newsletter') }}</label>
                                        <div class="setting-check m-0">
                                            <input type="checkbox" value="1" id="show_newsletter" class="sandbox_mode" {{ setting('show_newsletter') == 1 ? 'checked' : '' }}>
                                            <label for="show_newsletter"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row gx-20 gy-3">
                                        <div class="col-12">
                                            <label for="title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Newsletter Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="title" name="newsletter_title"
                                                   placeholder="{{ __('enter_title') }}" value="{{ setting('newsletter_title',$lang) ?: 'Subscribe Newsletter' }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="newsletter_description" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Newsletter Description') }}</label>
                                            <textarea class="form-control rounded-2 py-2" id="newsletter_description" name="newsletter_description" rows="2"
                                                      placeholder="{{ __('Enter Newsletter Description') }}">{{ setting('newsletter_description',$lang) ?: '' }}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label for="promo_banner_countdown_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Countdown Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="promo_banner_countdown_title" name="promo_banner_countdown_title"
                                                   placeholder="{{ __('Enter Countdown Title (Leave blank to remove)') }}" value="{{ setting('promo_banner_countdown_title', $lang) }}">
                                            <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                                <p>{{ __('If left blank, the title text above the timer will be completely removed.') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="promo_banner_countdown" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Global Promo Countdown Date (Applies to Footer & Sticky Banner)') }}</label>
                                            <input type="datetime-local" class="form-control rounded-2 py-2" id="promo_banner_countdown" name="promo_banner_countdown"
                                                   value="{{ setting('promo_banner_countdown') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="get_access_btn_title" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Title') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_title" name="get_access_btn_title"
                                                   placeholder="{{ __('Enter Button Title') }}" value="{{ setting('get_access_btn_title', $lang) ?: (setting('get_access_btn_title') ?: 'Get Access') }}">
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="get_access_btn_link" class="form-label" style="font-size: 13.5px; color: #334155; font-weight: 400;">{{ __('Get Access Button Link') }}</label>
                                            <input type="text" class="form-control rounded-2 py-2" id="get_access_btn_link" name="get_access_btn_link"
                                                   placeholder="{{ __('Enter Button Link (Default: #register)') }}" value="{{ setting('get_access_btn_link') ?: '' }}">
                                            <div class="nk-block-des text-muted mt-1" style="font-size: 12px;">
                                                <p>{{ __('Leave blank to default to the Order Form / Billing Details section (#register).') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                <button type="submit" class="btn sg-btn-primary px-4"><i class="las la-save me-1"></i> {{ __('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
