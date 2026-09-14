@extends('backend.layouts.master')
@section('title', __('success_story'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{ __('add_new_success_story') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('success-stories.store') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('name') }}</label>
                                        <input type="text" class="form-control rounded-2" id="title" name="title"
                                               placeholder="{{ __('name') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Position -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="position" class="form-label">{{ __('position') }}</label>
                                        <input type="text" class="form-control rounded-2" id="position" name="position" placeholder="{{ __('position') }}">
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="rating" class="form-label">{{ __('rating') }}</label>
                                        <input type="number" class="form-control rounded-2" id="rating" name="rating" placeholder="1 to 5" min="1" max="5" step="0.1" value="5">
                                    </div>
                                </div>

                                <!-- Success Description -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="description" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Media Type Dropdown -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="media_type" class="form-label">{{ __('Card Media Type') }}</label>
                                        <div class="select-type-v2">
                                            <select id="media_type" name="media_type" class="form-select form-select-lg without_search">
                                                <option value="image" {{ old('media_type', 'image') == 'image' ? 'selected' : '' }}>{{ __('Image') }}</option>
                                                <option value="video" {{ old('media_type') == 'video' ? 'selected' : '' }}>{{ __('Video') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Section (Shown when Image is selected) -->
                                <div class="col-lg-12 media_type_image_section {{ old('media_type', 'image') == 'image' ? '' : 'd-none' }}">
                                    @include('backend.common.media-input',[
                                        'title' => __('image'),
                                        'name'  => 'success_media_id',
                                        'col'   => 'col-12 mb-4',
                                        'size'  => '(473x337)',
                                        'label' => __('image'),
                                        'image' => old('success_media_id')
                                    ])
                                </div>

                                <!-- Video Configuration Section -->
                                <div class="col-lg-12 media_type_video_section {{ old('media_type') == 'video' ? '' : 'd-none' }}">
                                    <div class="p-3 mb-4 rounded border bg-light">
                                        <div class="row">
                                            <!-- Video Source Dropdown -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="video_source" class="form-label">{{ __('Video Source') }}</label>
                                                <div class="select-type-v2">
                                                    <select id="video_source" name="video_source" class="form-select form-select-lg without_search">
                                                        <option value="upload" {{ old('video_source', 'upload') == 'upload' ? 'selected' : '' }}>{{ __('Upload') }}</option>
                                                        <option value="youtube" {{ old('video_source') == 'youtube' ? 'selected' : '' }}>{{ __('Youtube') }}</option>
                                                        <option value="vimeo" {{ old('video_source') == 'vimeo' ? 'selected' : '' }}>{{ __('Vimeo') }}</option>
                                                        <option value="mp4" {{ old('video_source') == 'mp4' ? 'selected' : '' }}>{{ __('MP4') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Upload Option via Built-in Media Library -->
                                            <div class="col-lg-12 upload_video_div {{ old('video_source', 'upload') == 'upload' ? '' : 'd-none' }} mb-3">
                                                @include('backend.common.media-input',[
                                                    'title' => __('Upload Video File'),
                                                    'name'  => 'video_media_id',
                                                    'col'   => 'col-12 mb-2',
                                                    'size'  => '(MP4, WebM, OGG)',
                                                    'label' => __('Upload Video File'),
                                                    'for'   => 'video',
                                                    'image' => old('video_media_id')
                                                ])
                                                <div class="nk-block-des text-danger">
                                                    <p class="video_media_id_error error"></p>
                                                    <p class="video_file_error error"></p>
                                                </div>
                                            </div>

                                            <!-- Video Link Option -->
                                            <div class="col-lg-12 video_link_div {{ old('video_source') && old('video_source') != 'upload' ? '' : 'd-none' }} mb-3">
                                                <label for="video" class="form-label">{{ __('Video Link / URL') }}</label>
                                                <input type="text" class="form-control rounded-2" id="video" name="video" placeholder="e.g. https://www.youtube.com/watch?v=... or Vimeo URL" value="{{ old('video') }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="video_error error"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
    <!-- End Oftions Section -->
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script>
        $(document).ready(function() {
            function handleMediaTypeChange() {
                let mediaType = $('#media_type').val();
                if (mediaType === 'video') {
                    $('.media_type_video_section').removeClass('d-none');
                    $('.media_type_image_section').addClass('d-none');
                } else {
                    $('.media_type_video_section').addClass('d-none');
                    $('.media_type_image_section').removeClass('d-none');
                }
            }

            function handleVideoSourceChange() {
                let source = $('#video_source').val();
                if (source === 'upload') {
                    $('.upload_video_div').removeClass('d-none');
                    $('.video_link_div').addClass('d-none');
                } else if (source) {
                    $('.upload_video_div').addClass('d-none');
                    $('.video_link_div').removeClass('d-none');
                } else {
                    $('.upload_video_div').addClass('d-none');
                    $('.video_link_div').addClass('d-none');
                }
            }

            $(document).on('change', '#media_type', handleMediaTypeChange);
            $(document).on('select2:select', '#media_type', handleMediaTypeChange);
            $(document).on('change', '#video_source', handleVideoSourceChange);
            $(document).on('select2:select', '#video_source', handleVideoSourceChange);

            handleMediaTypeChange();
            handleVideoSourceChange();

            // Direct fallback click handler to ensure gallery modal opens reliably
            $(document).on('click', '.gallery-modal, .file-upload-text, .file-btn', function (e) {
                var $targetModal = $(this).closest('.gallery-modal');
                if ($targetModal.length) {
                    window.get_data_for = $targetModal.attr('data-for') || 'image';
                    window.selection = $targetModal.attr('data-selection') || 'single';
                    window.selector = $targetModal.closest('.custom-image');
                }
                var modalEl = document.getElementById('addMedia');
                if (modalEl && !$(modalEl).hasClass('show')) {
                    try {
                        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                            var bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                            bsModal.show();
                        } else if (typeof $.fn.modal !== 'undefined') {
                            $('#addMedia').modal('show');
                        }
                    } catch(err) {
                        console.error(err);
                    }
                }
            });
        });
    </script>
@endpush
