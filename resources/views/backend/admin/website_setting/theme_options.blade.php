@extends('backend.layouts.master')
@section('title', __('theme_options'))
@section('content')
    <!-- Product Details -->
    <div class="container-fluid">
        <div class="row">
            @include('backend.admin.website_setting.sidebar_component')
            <div class="col-xxl-9 col-lg-8 col-md-8">
                <h3 class="section-title">{{ __('theme_options') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    <form action="{{ route('theme.options') }}" method="post" class="form">@csrf
                        <div class="row">
                            <div class="pageTitle">
                                <h6 class="sub-title">Website Mode</h6>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-sm-12 mb-4">
                                <label class="form-label fw-bold">Select Website Mode</label>
                                <select name="website_mode" id="website_mode" class="form-select" onchange="toggleSingleCourseSelect()">
                                    <option value="multiple_course" {{ setting('website_mode') == 'multiple_course' ? 'selected' : '' }}>Multiple Course (Marketplace)</option>
                                    <option value="single_course" {{ setting('website_mode') == 'single_course' || !setting('website_mode') ? 'selected' : '' }}>Single Course Website</option>
                                </select>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-sm-12 mb-4" id="single_course_select_div" style="display: {{ setting('website_mode') == 'single_course' || !setting('website_mode') ? 'block' : 'none' }};">
                                <label class="form-label fw-bold">Select Featured Course</label>
                                <select name="single_course_id" class="form-select select2">
                                    <option value="">Select a course...</option>
                                    @if(isset($courses))
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ setting('single_course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <script>
                                function toggleSingleCourseSelect() {
                                    var mode = document.getElementById('website_mode').value;
                                    var courseSelect = document.getElementById('single_course_select_div');
                                    if (mode === 'single_course') {
                                        courseSelect.style.display = 'block';
                                    } else {
                                        courseSelect.style.display = 'none';
                                    }
                                }
                            </script>

                        </div>



                        <div class="row mt-4">
                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('favicon') }}</h6>
                            </div>
                            <div class="col-lg-12 input_file_div mb-4">
                                <div class="mb-3">
                                    <label class="form-label mb-1">{{__('icon') }}</label>
                                    <label for="favicon"
                                           class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{__('choose_file') }}</span></label>
                                    <input class="d-none file_picker" type="file" id="favicon" name="favicon">
                                    <div class="nk-block-des text-danger">
                                        <p class="favicon_error error">{{ $errors->first('favicon') }}</p>
                                    </div>
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        @php
                                            $icon = setting('favicon');
                                        @endphp
                                        @if($icon)
                                            <img class="selected-img" src="{{ ($icon != [] && @is_file_exists($icon['image_96x96_url'])) ? static_asset($icon['image_96x96_url']) : static_asset('images/default/favicon/faviocns.png') }}" alt="favicon">
                                        @else
                                            <img class="selected-img" src="{{ static_asset('images/default/favicon/faviocns.png') }}" alt="favicon">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="pageTitle">
                                <h6 class="sub-title">{{ __('preloader') }}</h6>
                            </div>

                            <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                <input type="hidden" name="disable_preloader" value="{{ setting('disable_preloader') == 1 ? 1 : 0 }}">
                                <label class="form-label"
                                       for="disable_preloader">{{ __('disable_preloader') }}</label>
                                <div class="setting-check">
                                    <input type="checkbox" value="1" id="disable_preloader"
                                           class="sandbox_mode" {{ setting('disable_preloader') == 1 ? 'checked' : '' }}>
                                    <label for="disable_preloader"></label>
                                </div>
                            </div>


                            <div class="col-lg-12 input_file_div">
                                <div class="mb-3">
                                    <label class="form-label mb-1">{{__('preloader_logo') }}</label>
                                    <label for="preloader_logo"
                                           class="file-upload-text">
                                            <p>1 File Choosen</p>
                                            <span class="file-btn">{{__('choose_file') }}</span></label>
                                    <input class="d-none file_picker" type="file" id="preloader_logo" name="preloader_logo">
                                    <div class="nk-block-des text-danger">
                                        <p class="preloader_logo_error error">{{ $errors->first('preloader_logo') }}</p>
                                    </div>
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        @php
                                            $preloader_logo = setting('preloader_logo');
                                        @endphp
                                        @if($preloader_logo)
                                            <img class="selected-img" src="{{ getFileLink('original_image',setting('preloader_logo')) }}" alt="preloader_logo">
                                        @else
                                            <img class="selected-img" src="{{ static_asset('images/default/logo/logo.png') }}" alt="preloader_logo">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start align-items-center mt-30">
                                <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('backend.common.gallery-modal')
@endsection
@push('js_asset')
    <script src="{{ static_asset('admin/js/bootstrap-colorpicker.min.js') }}"></script>
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/axios.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link href="{{ static_asset('admin/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('div.colorpicker-component').colorpicker();
            var ColorPickedDom = null;
            $('div.colorpicker_wrapper').on('click', 'div.colorpicker-component span.color_picker_trick', function (e) {
                ColorPickedDom = $(this).parent();
                $(ColorPickedDom).colorpicker('show');
            });

        });
    </script>
@endpush

