@extends('backend.layouts.master')
@section('title', __('Story Section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title mb-0" style="font-weight: 500;">{{ __('Story Section') }}</h3>

                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">

                        <form action="{{route('website.success_story_section.save')}}" id="setting-form" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
<div class="col-12 col-lg-12">
    <div class="d-flex justify-content-between align-items-center gap-12 sandbox_mode_div mb-4">
        <input type="hidden" name="success_section_status" value="0">
        <label class="form-label" for="success_section_status">{{ __('Enable Section') }}</label>
        <div class="setting-check">
            <input type="checkbox" name="success_section_status" value="1" id="success_section_status"
                   class="sandbox_mode" {{ setting('success_section_status') === '0' ? '' : 'checked' }}>
            <label for="success_section_status"></label>
        </div>
    </div>
</div>
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Badge Tag / Eyebrow -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="success_section_eyebrow" class="form-label">{{ __('tag_badge_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_section_eyebrow"
                                               placeholder="{{ __('e.g. SUCCESS STORIES') }}" name="success_section_eyebrow" value="{{ setting('success_section_eyebrow', $lang) ?: 'SUCCESS STORIES' }}">
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="success_section_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_section_title"
                                               placeholder="{{ __('enter_title') }}" name="success_section_title" value="{{ setting('success_section_title', $lang) ?: 'What Says My Students About The Platform' }}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="success_section_description" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control summernote" id="success_section_description" rows="5"
                                                  name="success_section_description" placeholder="{{ __('enter_description') }}">{{ setting('success_section_description', $lang) }}</textarea>
                                    </div>
                                </div>

                                <!-- Button Text -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_section_btn_text" class="form-label">{{ __('button_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_section_btn_text"
                                               placeholder="{{ __('e.g. Join Now') }}" name="success_section_btn_text" value="{{ setting('success_section_btn_text', $lang) ?: 'Join Now' }}">
                                    </div>
                                </div>

                                <!-- Button Link -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_section_btn_url" class="form-label">{{ __('button_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_section_btn_url"
                                               placeholder="{{ __('e.g. #register') }}" name="success_section_btn_url" value="{{ setting('success_section_btn_url', $lang) ?: '#register' }}">
                                    </div>
                                </div>


                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('save_&_publish') }}</button>
                                    @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/summernote-lite.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/summernote-lite.min.js') }}"></script>
@endpush
