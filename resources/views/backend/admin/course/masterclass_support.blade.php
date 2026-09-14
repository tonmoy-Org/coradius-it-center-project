@php
    $mcSettings = $mcSettings ?? (old('masterclass_settings') ?: []);
    if (!is_array($mcSettings)) {
        $mcSettings = json_decode($mcSettings ?? '[]', true) ?: [];
    }

    $supportStatus = !empty($mcSettings['support_status']);
    $supportTitle = old('masterclass_settings.support_title', $mcSettings['support_title'] ?? '');
    $supportTitleIcon = old('masterclass_settings.support_title_icon', $mcSettings['support_title_icon'] ?? '');
    if (empty($supportTitleIcon) || preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $supportTitleIcon) || str_starts_with($supportTitleIcon, 'http')) {
        $supportTitleIcon = 'fas fa-headset';
    }
    $supportSubtitle = old('masterclass_settings.support_subtitle', $mcSettings['support_subtitle'] ?? '');
    $supportDescription = old('masterclass_settings.support_description', $mcSettings['support_description'] ?? '');
    $supportImageUrl = old('masterclass_settings.support_image_url_custom', $mcSettings['support_image_url'] ?? '');

    // Feature Cards (Dynamic List)
    $featureCards = old('masterclass_settings.support_features_list');
    if (!is_array($featureCards)) {
        if (!empty($mcSettings['support_features_list']) && is_array($mcSettings['support_features_list'])) {
            $featureCards = array_values($mcSettings['support_features_list']);
        } else {
            $featureCards = [];
        }
    }

    // Divider
    $dividerText = old('masterclass_settings.support_divider_text', $mcSettings['support_divider_text'] ?? '');

    // Support Channels (Dynamic List)
    $supportChannels = old('masterclass_settings.support_channels_list');
    if (!is_array($supportChannels)) {
        if (!empty($mcSettings['support_channels_list']) && is_array($mcSettings['support_channels_list'])) {
            $supportChannels = array_values($mcSettings['support_channels_list']);
        } else {
            $supportChannels = [];
        }
    }

@endphp

<style>
    .support-card-delete-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: transparent !important;
        background-color: transparent !important;
        color: #ef4444;
        border: none !important;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s ease, transform 0.2s ease;
        box-shadow: none !important;
        outline: none !important;
    }
    .support-card-delete-btn:hover {
        background: transparent !important;
        background-color: transparent !important;
        color: #b91c1c;
        transform: scale(1.15);
        box-shadow: none !important;
    }
    .gallery-modal {
        cursor: pointer;
    }
    .support-card-delete-btn:active {
        transform: scale(0.95);
    }
</style>

<!-- Section: Support Section -->
<div class="card border mb-4 rounded-3 shadow-sm">
    <div class="card-header bg-white py-3">
        <span class="form-label m-0">Support Section</span>
    </div>
    <div class="card-body p-4">
        <div class="row gx-20">
            <!-- Show Support Section Checkbox (Left side, consistent with upper sections) -->
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="setting-check">
                        <input type="checkbox" name="masterclass_settings[support_status]" value="1" id="support_status"
                            {{ $supportStatus ? 'checked' : '' }}>
                        <label for="support_status"></label>
                    </div>
                    <label class="form-label mb-0 cursor-pointer" for="support_status">Show Support Section</label>
                </div>
            </div>

            <!-- Support Title -->
            <div class="col-lg-6 col-md-6 mb-4">
                <label class="form-label">Support Title</label>
                <input type="text" name="masterclass_settings[support_title]" class="form-control rounded-2"
                       value="{{ $supportTitle }}">
                <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i> Use <code>{word}</code> or <code>&lt;mark&gt;word&lt;/mark&gt;</code> to highlight text.</small>
            </div>

            <!-- Title Icon -->
            <div class="col-lg-6 col-md-6 mb-4">
                <label class="form-label">Title Icon</label>
                <input type="text" name="masterclass_settings[support_title_icon]" class="form-control rounded-2"
                       value="{{ $supportTitleIcon }}" placeholder="fas fa-headset">
            </div>

            <!-- Subtitle -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Support Subtitle</label>
                <input type="text" name="masterclass_settings[support_subtitle]" class="form-control rounded-2"
                       value="{{ $supportSubtitle }}">
            </div>

            <!-- Description -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Support Description</label>
                <textarea name="masterclass_settings[support_description]" class="form-control rounded-2 summernote" rows="3">{{ $supportDescription }}</textarea>
            </div>

            <!-- Support Image Upload -->
            <div class="col-lg-12 mb-4">
                @include('backend.common.media-input', [
                    'title' => 'Support Image',
                    'label' => 'Support Image',
                    'for' => 'image',
                    'name' => 'support_image_media_id',
                    'col' => 'col-12',
                    'size' => '',
                    'image' => $mcSettings['support_image_media_id'] ?? ''
                ])
            </div>

            <!-- Dynamic Feature Cards -->
            <div class="col-12 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <div>
                        <label class="form-label">Feature Cards</label>
                    </div>
                    <button type="button" class="d-inline-flex align-items-center btn sg-btn-primary gap-2" id="add_support_feature_card_btn">
                        <i class="las la-plus"></i>
                        <span>Add Feature Card</span>
                    </button>
                </div>
                <div class="row g-3" id="support_features_container">
                    @forelse($featureCards as $idx => $fCard)
                        @php
                            $cardMediaId = $fCard['media_id'] ?? '';
                            $cardMedia = null;
                            if (!empty($cardMediaId)) {
                                $cardMedia = \App\Models\MediaLibrary::find($cardMediaId);
                            } elseif (!empty($fCard['icon']) && is_numeric($fCard['icon'])) {
                                $cardMedia = \App\Models\MediaLibrary::find($fCard['icon']);
                                $cardMediaId = $fCard['icon'];
                            }
                            $hasMedia = $cardMedia && $cardMedia->image_variants && arrayCheck('image_80x80', $cardMedia->image_variants) && is_file_exists($cardMedia->image_variants['image_80x80'], $cardMedia->image_variants['storage']);
                            $customIconUrl = (!$hasMedia && !empty($fCard['icon']) && (preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $fCard['icon']) || str_starts_with($fCard['icon'], 'http') || str_contains($fCard['icon'], 'uploads/') || str_contains($fCard['icon'], 'images/'))) ? $fCard['icon'] : '';
                            $isSelected = $hasMedia || !empty($customIconUrl);
                        @endphp
                        <div class="col-md-4 support-feature-card-item" data-index="{{ $idx }}">
                            <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="form-label mb-0 card-num-label">Card {{ $idx + 1 }}</h6>
                                    <button type="button" class="support-card-delete-btn remove-support-card-btn" title="Delete Card">
                                        <i class="las la-trash-alt"></i>
                                    </button>
                                </div>
                                <label class="form-label">Title</label>
                                <input type="text" name="masterclass_settings[support_features_list][{{ $idx }}][title]"
                                       class="form-control rounded-2 bg-white mb-2 support-feature-title-input"
                                       value="{{ $fCard['title'] ?? '' }}">

                                <input type="hidden" name="masterclass_settings[support_features_list][{{ $idx }}][icon]"
                                       class="support-feature-icon-input"
                                       value="{{ $fCard['icon'] ?? '' }}">

                                <div class="custom-image mb-2">
                                    <div class="gallery-modal" data-for="image" data-selection="single">
                                        <label class="form-label mb-1">Upload Icon</label>
                                        <div class="file-upload-text">
                                            <p><span class="file_selected">{{ $isSelected ? '1' : '0' }} </span>{{ __('files_selected') }}</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </div>
                                        <input class="d-none support-feature-media-id-input" type="hidden" name="masterclass_settings[support_features_list][{{ $idx }}][media_id]"
                                               value="{{ $cardMediaId }}">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        @if($hasMedia)
                                            <div class="selected-files-item">
                                                <img src="{{ getFileLink('80x80', $cardMedia->image_variants) }}"
                                                     alt="{{ $cardMedia->name }}"
                                                     class="selected-img">
                                                <div class="remove-icon" data-id="{{ $cardMedia->id }}">
                                                    <i class="las la-times"></i>
                                                </div>
                                            </div>
                                        @elseif($customIconUrl)
                                            <div class="selected-files-item">
                                                <img src="{{ dynamic_asset($customIconUrl) }}"
                                                     alt="icon"
                                                     class="selected-img">
                                                <div class="remove-icon" data-id="">
                                                    <i class="las la-times"></i>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="selected-files-item {{ $isSelected ? 'd-none' : '' }}">
                                            <img class="selected-img"
                                                 src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                 alt="default">
                                        </div>
                                    </div>
                                </div>

                                <label class="form-label">Description</label>
                                <textarea name="masterclass_settings[support_features_list][{{ $idx }}][desc]"
                                          class="form-control rounded-2 bg-white support-feature-desc-input" rows="2">{{ $fCard['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-3 text-muted no-cards-placeholder">
                            কোনো ফিচার কার্ড নেই। উপরে "Add Feature Card" বাটনে ক্লিক করে কার্ড যোগ করুন।
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Divider Text -->
            <div class="col-lg-12 mb-4">
                <label class="form-label">Section Divider Text</label>
                <input type="text" name="masterclass_settings[support_divider_text]" class="form-control rounded-2"
                       value="{{ $dividerText }}">
            </div>

            <!-- Support Channels Section (Dynamic Repeater) -->
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                    <div>
                        <label class="form-label">Support Channels</label>
                    </div>
                    <button type="button" class="d-inline-flex align-items-center btn sg-btn-primary gap-2" id="add_support_channel_btn">
                        <i class="las la-plus"></i>
                        <span>Add Support Channel</span>
                    </button>
                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="row g-3" id="support_channels_container">
                    @forelse($supportChannels as $cIdx => $chCard)
                        @php
                            $chMediaId = $chCard['media_id'] ?? '';
                            $chMedia = null;
                            if (!empty($chMediaId)) {
                                $chMedia = \App\Models\MediaLibrary::find($chMediaId);
                            } elseif (!empty($chCard['icon']) && is_numeric($chCard['icon'])) {
                                $chMedia = \App\Models\MediaLibrary::find($chCard['icon']);
                                $chMediaId = $chCard['icon'];
                            }
                            $hasChMedia = $chMedia && $chMedia->image_variants && arrayCheck('image_80x80', $chMedia->image_variants) && is_file_exists($chMedia->image_variants['image_80x80'], $chMedia->image_variants['storage']);
                            $customChIconUrl = (!$hasChMedia && !empty($chCard['icon']) && (preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $chCard['icon']) || str_starts_with($chCard['icon'], 'http') || str_contains($chCard['icon'], 'uploads/') || str_contains($chCard['icon'], 'images/'))) ? $chCard['icon'] : '';
                            $isChSelected = $hasChMedia || !empty($customChIconUrl);
                        @endphp
                        <div class="col-md-4 support-channel-card-item" data-index="{{ $cIdx }}">
                            <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="form-label mb-0 channel-num-label">Channel {{ $cIdx + 1 }} {{ !empty($chCard['title']) ? '('.$chCard['title'].')' : '' }}</h6>
                                    <button type="button" class="support-card-delete-btn remove-support-channel-btn" title="Delete Channel">
                                        <i class="las la-trash-alt"></i>
                                    </button>
                                </div>

                                <div class="form-check form-switch mb-2">
                                    <input type="checkbox" class="form-check-input support-channel-highlight-input"
                                           name="masterclass_settings[support_channels_list][{{ $cIdx }}][is_highlighted]"
                                           value="1" id="ch_highlight_{{ $cIdx }}"
                                           {{ !empty($chCard['is_highlighted']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-12 text-muted cursor-pointer" for="ch_highlight_{{ $cIdx }}">Highlight Channel</label>
                                </div>

                                <label class="form-label">Title</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][title]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-title-input"
                                       value="{{ $chCard['title'] ?? '' }}">

                                <label class="form-label">Subtitle</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][desc]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-desc-input"
                                       value="{{ $chCard['desc'] ?? '' }}">

                                <input type="hidden" name="masterclass_settings[support_channels_list][{{ $cIdx }}][icon]"
                                       class="support-channel-icon-input"
                                       value="{{ $chCard['icon'] ?? '' }}">

                                <div class="custom-image mb-2">
                                    <div class="gallery-modal" data-for="image" data-selection="single">
                                        <label class="form-label mb-1">Upload Icon</label>
                                        <div class="file-upload-text">
                                            <p><span class="file_selected">{{ $isChSelected ? '1' : '0' }} </span>{{ __('files_selected') }}</p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </div>
                                        <input class="d-none support-channel-media-id-input" type="hidden" name="masterclass_settings[support_channels_list][{{ $cIdx }}][media_id]"
                                               value="{{ $chMediaId }}">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        @if($hasChMedia)
                                            <div class="selected-files-item">
                                                <img src="{{ getFileLink('80x80', $chMedia->image_variants) }}"
                                                     alt="{{ $chMedia->name }}"
                                                     class="selected-img">
                                                <div class="remove-icon" data-id="{{ $chMedia->id }}">
                                                    <i class="las la-times"></i>
                                                </div>
                                            </div>
                                        @elseif($customChIconUrl)
                                            <div class="selected-files-item">
                                                <img src="{{ dynamic_asset($customChIconUrl) }}"
                                                     alt="icon"
                                                     class="selected-img">
                                                <div class="remove-icon" data-id="">
                                                    <i class="las la-times"></i>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="selected-files-item {{ $isChSelected ? 'd-none' : '' }}">
                                            <img class="selected-img"
                                                 src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                 alt="default">
                                        </div>
                                    </div>
                                </div>

                                <label class="form-label">Team Status Label</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][team_label]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-label-input"
                                       value="{{ $chCard['team_label'] ?? '' }}">

                                <label class="form-label">Button Text</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][btn_text]"
                                       class="form-control rounded-2 bg-white mb-2 support-channel-btn-text-input"
                                       value="{{ $chCard['btn_text'] ?? '' }}">

                                <label class="form-label">Button URL</label>
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][url]"
                                       class="form-control rounded-2 bg-white support-channel-url-input"
                                       value="{{ $chCard['url'] ?? '' }}">
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-3 text-muted no-channels-placeholder">
                            কোনো সাপোর্ট চ্যানেল নেই। উপরে "Add Support Channel" বাটনে ক্লিক করে চ্যানেল যোগ করুন।
                        </div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>
</div>

@push('js')
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            function renumberSupportCards() {
                var $cards = $('#support_features_container .support-feature-card-item');
                if ($cards.length === 0) {
                    if ($('#support_features_container .no-cards-placeholder').length === 0) {
                        $('#support_features_container').append(
                            '<div class="col-12 text-center py-3 text-muted no-cards-placeholder">' +
                            'কোনো ফিচার কার্ড নেই। উপরে "Add Feature Card" বাটনে ক্লিক করে কার্ড যোগ করুন।' +
                            '</div>'
                        );
                    }
                } else {
                    $('#support_features_container .no-cards-placeholder').remove();
                }

                $cards.each(function(index) {
                    $(this).attr('data-index', index);
                    $(this).find('.card-num-label').text('Card ' + (index + 1));
                    $(this).find('.support-feature-title-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][title]');
                    $(this).find('.support-feature-icon-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][icon]');
                    $(this).find('.support-feature-media-id-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][media_id]');
                    $(this).find('.support-feature-desc-input').attr('name', 'masterclass_settings[support_features_list][' + index + '][desc]');
                });
            }

            $(document).on('click', '#add_support_feature_card_btn', function(e) {
                e.preventDefault();
                $('#support_features_container .no-cards-placeholder').remove();
                var count = $('#support_features_container .support-feature-card-item').length;
                var nextIndex = count;
                var nextNum = count + 1;

                var html = `
                    <div class="col-md-4 support-feature-card-item" data-index="${nextIndex}">
                        <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="form-label mb-0 card-num-label">Card ${nextNum}</h6>
                                <button type="button" class="support-card-delete-btn remove-support-card-btn" title="Delete Card">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>
                            <label class="form-label">Title</label>
                            <input type="text" name="masterclass_settings[support_features_list][${nextIndex}][title]"
                                   class="form-control rounded-2 bg-white mb-2 support-feature-title-input">

                            <input type="hidden" name="masterclass_settings[support_features_list][${nextIndex}][icon]"
                                   class="support-feature-icon-input" value="">

                            <div class="custom-image mb-2">
                                <div class="gallery-modal" data-for="image" data-selection="single">
                                    <label class="form-label mb-1">Upload Icon</label>
                                    <div class="file-upload-text">
                                        <p><span class="file_selected">0 </span>{{ __('files_selected') }}</p>
                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                    </div>
                                    <input class="d-none support-feature-media-id-input" type="hidden" name="masterclass_settings[support_features_list][${nextIndex}][media_id]" value="">
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        <img class="selected-img" src="{{ static_asset('images/default/default-image-80x80.png') }}" alt="default">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">Description</label>
                            <textarea name="masterclass_settings[support_features_list][${nextIndex}][desc]"
                                      class="form-control rounded-2 bg-white support-feature-desc-input" rows="2"></textarea>
                        </div>
                    </div>
                `;

                $('#support_features_container').append(html);
                renumberSupportCards();
            });

            $(document).on('click', '.remove-support-card-btn', function(e) {
                e.preventDefault();
                $(this).closest('.support-feature-card-item').remove();
                renumberSupportCards();
            });

            $(document).on('click', '.support-feature-card-item .remove-icon', function() {
                $(this).closest('.support-feature-card-item').find('.support-feature-icon-input').val('');
                $(this).closest('.support-feature-card-item').find('.support-feature-media-id-input').val('');
            });

            // --- Support Channels Repeater ---
            function renumberSupportChannels() {
                var $channels = $('#support_channels_container .support-channel-card-item');
                if ($channels.length === 0) {
                    if ($('#support_channels_container .no-channels-placeholder').length === 0) {
                        $('#support_channels_container').append(
                            '<div class="col-12 text-center py-3 text-muted no-channels-placeholder">' +
                            'কোনো সাপোর্ট চ্যানেল নেই। উপরে "Add Support Channel" বাটনে ক্লিক করে চ্যানেল যোগ করুন।' +
                            '</div>'
                        );
                    }
                } else {
                    $('#support_channels_container .no-channels-placeholder').remove();
                }

                $channels.each(function(index) {
                    $(this).attr('data-index', index);
                    var title = $(this).find('.support-channel-title-input').val();
                    $(this).find('.channel-num-label').text('Channel ' + (index + 1) + (title ? ' (' + title + ')' : ''));
                    $(this).find('.support-channel-highlight-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][is_highlighted]').attr('id', 'ch_highlight_' + index);
                    $(this).find('label[for^="ch_highlight_"]').attr('for', 'ch_highlight_' + index);
                    $(this).find('.support-channel-title-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][title]');
                    $(this).find('.support-channel-desc-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][desc]');
                    $(this).find('.support-channel-icon-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][icon]');
                    $(this).find('.support-channel-media-id-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][media_id]');
                    $(this).find('.support-channel-label-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][team_label]');
                    $(this).find('.support-channel-btn-text-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][btn_text]');
                    $(this).find('.support-channel-url-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][url]');
                });
            }

            $(document).on('input', '.support-channel-title-input', function() {
                var index = $(this).closest('.support-channel-card-item').data('index');
                var val = $(this).val();
                $(this).closest('.support-channel-card-item').find('.channel-num-label').text('Channel ' + (index + 1) + (val ? ' (' + val + ')' : ''));
            });

            $(document).on('click', '#add_support_channel_btn', function(e) {
                e.preventDefault();
                $('#support_channels_container .no-channels-placeholder').remove();
                var count = $('#support_channels_container .support-channel-card-item').length;
                var nextIndex = count;
                var nextNum = count + 1;

                var html = `
                    <div class="col-md-4 support-channel-card-item" data-index="${nextIndex}">
                        <div class="p-3 bg-light rounded-3 border h-100 position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="form-label mb-0 channel-num-label">Channel ${nextNum}</h6>
                                <button type="button" class="support-card-delete-btn remove-support-channel-btn" title="Delete Channel">
                                    <i class="las la-trash-alt"></i>
                                </button>
                            </div>

                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input support-channel-highlight-input"
                                       name="masterclass_settings[support_channels_list][${nextIndex}][is_highlighted]"
                                       value="1" id="ch_highlight_${nextIndex}">
                                <label class="form-check-label font-12 text-muted cursor-pointer" for="ch_highlight_${nextIndex}">Highlight Channel</label>
                            </div>

                            <label class="form-label">Title</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][title]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-title-input">

                            <label class="form-label">Subtitle</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][desc]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-desc-input">

                            <input type="hidden" name="masterclass_settings[support_channels_list][${nextIndex}][icon]"
                                   class="support-channel-icon-input" value="">

                            <div class="custom-image mb-2">
                                <div class="gallery-modal" data-for="image" data-selection="single">
                                    <label class="form-label mb-1">Upload Icon</label>
                                    <div class="file-upload-text">
                                        <p><span class="file_selected">0 </span>{{ __('files_selected') }}</p>
                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                    </div>
                                    <input class="d-none support-channel-media-id-input" type="hidden" name="masterclass_settings[support_channels_list][${nextIndex}][media_id]" value="">
                                </div>
                                <div class="selected-files d-flex flex-wrap gap-20">
                                    <div class="selected-files-item">
                                        <img class="selected-img" src="{{ static_asset('images/default/default-image-80x80.png') }}" alt="default">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">Team Status Label</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][team_label]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-label-input"
                                   value="">

                            <label class="form-label">Button Text</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][btn_text]"
                                   class="form-control rounded-2 bg-white mb-2 support-channel-btn-text-input"
                                   value="">

                            <label class="form-label">Button URL</label>
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][url]"
                                   class="form-control rounded-2 bg-white support-channel-url-input">
                        </div>
                    </div>
                `;

                $('#support_channels_container').append(html);
                renumberSupportChannels();
            });

            $(document).on('click', '.remove-support-channel-btn', function(e) {
                e.preventDefault();
                $(this).closest('.support-channel-card-item').remove();
                renumberSupportChannels();
            });

            $(document).on('click', '.support-channel-card-item .remove-icon', function() {
                $(this).closest('.support-channel-card-item').find('.support-channel-icon-input').val('');
                $(this).closest('.support-channel-card-item').find('.support-channel-media-id-input').val('');
            });

        });
    })(jQuery);
</script>
@endpush




