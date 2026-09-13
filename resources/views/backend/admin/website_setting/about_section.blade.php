@extends('backend.layouts.master')
@section('title', __('about_me_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title mb-0" style="font-weight: 500;">{{ __('about_me_section') }}</h3>

                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">

                        <form action="{{route('website.about_section.save')}}" id="setting-form" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
<div class="col-12 col-lg-12">
    <div class="d-flex justify-content-between align-items-center gap-12 sandbox_mode_div mb-4">
        <input type="hidden" name="about_me_status" value="{{ setting('about_me_status') === '0' ? 0 : 1 }}">
        <label class="form-label" for="about_me_status">Enable Section</label>
        <div class="setting-check">
            <input type="checkbox" value="1" id="about_me_status"
                   class="sandbox_mode" {{ setting('about_me_status') === '0' ? '' : 'checked' }}>
            <label for="about_me_status"></label>
        </div>
    </div>
</div>
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Badge Tag -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_tag" class="form-label">{{ __('tag_badge_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_tag"
                                               placeholder="" name="about_me_tag" value="{{ setting('about_me_tag', $lang) }}">
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_title"
                                               placeholder="" name="about_me_title" value="{{ setting('about_me_title', $lang) }}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_description" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control summernote" id="about_me_description" rows="5"
                                                  name="about_me_description" placeholder="">{{ setting('about_me_description', $lang) }}</textarea>
                                    </div>
                                </div>

                                <!-- Button Text -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="about_me_btn_text" class="form-label">{{ __('button_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_btn_text"
                                               placeholder="" name="about_me_btn_text" value="{{ setting('about_me_btn_text', $lang) }}">
                                    </div>
                                </div>

                                <!-- Button Link -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="about_me_btn_url" class="form-label">{{ __('button_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_btn_url"
                                               placeholder="" name="about_me_btn_url" value="{{ setting('about_me_btn_url', $lang) }}">
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="about_me_image" class="form-label mb-1">{{ __('image') }} (600x600)</label>
                                        <label for="about_me_image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="about_me_image" id="about_me_image">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ setting('about_me_image') ? getFileLink('80x80', setting('about_me_image')) : static_asset('images/about/about_me_instructor.jpg') }}" alt="about me image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Switch -->


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
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush







