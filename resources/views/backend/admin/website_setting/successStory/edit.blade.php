@extends('backend.layouts.master')
@section('title', __('edit_success_story'))
@section('content')
    @php
        $currentMediaType = old('media_type', $success->media_type ?? (!empty($success->video) ? 'video' : 'image'));
        $currentVideo = $success->video ?? '';
        if (preg_match('/(?:youtube\.com|youtu\.be)/i', $currentVideo)) {
            $detectedSource = 'youtube';
        } elseif (preg_match('/vimeo\.com/i', $currentVideo)) {
            $detectedSource = 'vimeo';
        } elseif (preg_match('/\.mp4$/i', $currentVideo) && \Illuminate\Support\Str::startsWith($currentVideo, 'http')) {
            $detectedSource = 'mp4';
        } else {
            $detectedSource = 'upload';
        }
        $currentVideoSource = old('video_source', $detectedSource);

        $videoMediaId = old('video_media_id', $success->video_media_id);
        if (empty($videoMediaId) && !empty($success->video)) {
            $matchedMedia = \App\Models\MediaLibrary::where('original_file', $success->video)->first();
            if ($matchedMedia) {
                $videoMediaId = $matchedMedia->id;
            }
        }
    @endphp
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title">{{__('edit_success_story') }}</h3>

                    <div class="bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <form>
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option
                                                    value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('success-stories.update',$success->id) }}" class="form-validate form"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <input type="hidden" name="id" value="{{ $success->id }}">
                                    <input type="hidden" value="{{ $lang }}" name="lang">
                                    <input type="hidden"
                                           value="{{ $success_language->translation_null == 'not-found' ? '' : $success_language->id }}"
                                           name="translate_id">
                                    <input type="hidden" class="is_modal" value="0"/>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="title" class="form-label">{{ __('name') }}</label>
                                            <input type="text" class="form-control rounded-2" id="title"
                                                   name="title"
                                                   placeholder="{{ __('name') }}"
                                                   value="{{ $success_language->title }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="title_error error"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Position -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="position" class="form-label">{{ __('position') }}</label>
                                            <input type="text" class="form-control rounded-2" id="position" name="position" placeholder="{{ __('position') }}" value="{{ $success->position }}">
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="rating" class="form-label">{{ __('rating') }}</label>
                                            <input type="number" class="form-control rounded-2" id="rating" name="rating" placeholder="1 to 5" min="1" max="5" step="0.1" value="{{ $success->rating }}">
                                        </div>
                                    </div>

                                    <!-- Success Description -->
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="description" class="form-label">{{ __('description') }}</label>
                                            <textarea class="form-control" id="description" name="description">{{ __($success->description)  }}</textarea>
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
                                                    <option value="image" {{ $currentMediaType == 'image' ? 'selected' : '' }}>{{ __('Image') }}</option>
                                                    <option value="video" {{ $currentMediaType == 'video' ? 'selected' : '' }}>{{ __('Video') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Section (Shown when Image is selected) -->
                                    <div class="col-lg-12 media_type_image_section {{ $currentMediaType == 'image' ? '' : 'd-none' }}">
                                        @include('backend.common.media-input',[
                                            'title' => __('image'),
                                            'name'  => 'success_media_id',
                                            'col'   => 'col-12 mb-4',
                                            'size'  => '(473x337)',
                                            'label' => __('image'),
                                            'image' => $success->image,
                                            'edit'  => $success,
                                            'image_object'  => $success->image,
                                            'media_id'  => $success->success_media_id,
                                        ])
                                    </div>

                                    <!-- Video Section (Shown when Video is selected) -->
                                    <div class="col-lg-12 media_type_video_section {{ $currentMediaType == 'video' ? '' : 'd-none' }}">
                                        <div class="p-3 mb-4 rounded border bg-light">
                                            <div class="row">
                                                <!-- Video Source Dropdown -->
                                                <div class="col-lg-12 mb-3">
                                                    <label for="video_source" class="form-label">{{ __('Video Source') }}</label>
                                                    <div class="select-type-v2">
                                                        <select id="video_source" name="video_source" class="form-select form-select-lg without_search">
                                                            <option value="upload" {{ $currentVideoSource == 'upload' ? 'selected' : '' }}>{{ __('Upload') }}</option>
                                                            <option value="youtube" {{ $currentVideoSource == 'youtube' ? 'selected' : '' }}>{{ __('Youtube') }}</option>
                                                            <option value="vimeo" {{ $currentVideoSource == 'vimeo' ? 'selected' : '' }}>{{ __('Vimeo') }}</option>
                                                            <option value="mp4" {{ $currentVideoSource == 'mp4' ? 'selected' : '' }}>{{ __('MP4') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Upload Option via Built-in Media Library -->
                                                <div class="col-lg-12 upload_video_div {{ $currentVideoSource == 'upload' ? '' : 'd-none' }} mb-3">
                                                    @include('backend.common.media-input',[
                                                        'title' => __('Upload Video File'),
                                                        'name'  => 'video_media_id',
                                                        'col'   => 'col-12 mb-2',
                                                        'size'  => '(MP4, WebM, OGG)',
                                                        'label' => __('Upload Video File'),
                                                        'for'   => 'video',
                                                        'image' => $videoMediaId ?? '',
                                                        'media_id' => $videoMediaId ?? '',
                                                    ])
                                                    <div class="nk-block-des text-danger">
                                                        <p class="video_media_id_error error"></p>
                                                        <p class="video_file_error error"></p>
                                                    </div>
                                                </div>

                                                <!-- Video Link Option -->
                                                <div class="col-lg-12 video_link_div {{ $currentVideoSource != 'upload' ? '' : 'd-none' }} mb-3">
                                                    <label for="video" class="form-label">{{ __('Video Link / URL') }}</label>
                                                    <input type="text" class="form-control rounded-2" id="video" name="video" placeholder="e.g. https://www.youtube.com/watch?v=... or Vimeo URL" value="{{ $success->video }}">
                                                    <div class="nk-block-des text-danger">
                                                        <p class="video_error error"></p>
                                                    </div>
                                                </div>

                                                @if(!empty($success->video))
                                                    <div class="col-lg-12 mb-2">
                                                        <div class="p-2 bg-white rounded border">
                                                            <label class="form-label fw-bold mb-1 small">{{ __('Current Video') }}:</label>
                                                            <div class="d-flex flex-column gap-2" style="max-width: 400px;">
                                                                @php
                                                                    $isYt = preg_match('/(?:youtube\.com|youtu\.be)/i', $success->video);
                                                                    $isVm = preg_match('/vimeo\.com/i', $success->video);
                                                                @endphp
                                                                @if($isYt || $isVm)
                                                                    <div>
                                                                        <a href="{{ $success->video }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-external-link-alt me-1"></i> {{ __('Open Current Video Link') }}
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <video src="{{ \Illuminate\Support\Str::startsWith($success->video, ['http://', 'https://']) ? $success->video : asset($success->video) }}" controls style="max-height: 150px; width: 100%; border-radius: 6px;"></video>
                                                                @endif

                                                                <div class="form-check mt-1">
                                                                    <input class="form-check-input" type="checkbox" name="remove_video" id="remove_video" value="1">
                                                                    <label class="form-check-label text-danger small fw-semibold" for="remove_video">
                                                                        {{ __('Remove current video') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection

@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
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
