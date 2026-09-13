@php
    $mcSettings = $mcSettings ?? (old('masterclass_settings') ?: []);
    if (!is_array($mcSettings)) {
        $mcSettings = json_decode($mcSettings ?? '[]', true) ?: [];
    }

    $supportStatus = !empty($mcSettings['support_status']);
    $supportTitle = old('masterclass_settings.support_title', $mcSettings['support_title'] ?? '');
    $supportTitleIcon = old('masterclass_settings.support_title_icon', $mcSettings['support_title_icon'] ?? '');
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

    // Bottom strip banner
    $stripIcon = old('masterclass_settings.support_strip_icon', $mcSettings['support_strip_icon'] ?? '');
    $stripText1 = old('masterclass_settings.support_strip_text_1', $mcSettings['support_strip_text_1'] ?? '');
    $stripText2 = old('masterclass_settings.support_strip_text_2', $mcSettings['support_strip_text_2'] ?? '');
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
                <label class="form-label">Title Icon Class</label>
                <input type="text" name="masterclass_settings[support_title_icon]" class="form-control rounded-2 mb-2"
                       value="{{ $supportTitleIcon }}">
                <label class="form-label small text-muted mb-1">Upload Title Icon</label>
                <input type="file" name="support_title_icon_file" class="form-control form-control-sm rounded-2" accept="image/*">
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

            <!-- Support Image Upload & URL -->
            <div class="col-lg-6 mb-4">
                <label class="form-label">Upload Support Image File</label>
                <input type="file" name="support_image_file" class="form-control rounded-2" accept="image/*">
            </div>
            <div class="col-lg-6 mb-4">
                <label class="form-label">Support Image URL</label>
                <input type="text" name="masterclass_settings[support_image_url_custom]" class="form-control rounded-2"
                       value="{{ $mcSettings['support_image_url'] ?? '' }}">
            </div>
            @if(!empty($mcSettings['support_image_url']))
                <div class="col-12 mb-4">
                    <label class="small text-muted d-block mb-1">Current Support Image Preview:</label>
                    <img src="{{ dynamic_asset($mcSettings['support_image_url']) }}" alt="Support Image Preview" class="rounded border p-1" style="max-height: 100px; object-fit: contain; background: #f8fafc;" onerror="this.onerror=null; this.src='{{ static_asset('images/support/support_right_top.png') }}';">
                </div>
            @endif

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

                                <label class="form-label">Upload Icon</label>
                                <input type="file" name="support_feature_icon_files[{{ $idx }}]"
                                       class="form-control font-12 bg-white mb-2 support-feature-file-input" accept="image/*">

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

                                <label class="form-label">Upload Icon</label>
                                <input type="file" name="support_channel_icon_files[{{ $cIdx }}]"
                                       class="form-control font-12 bg-white mb-2 support-channel-icon-file-input" accept="image/*">

                                <label class="form-label">Team Avatars Image</label>
                                <input type="file" name="support_channel_avatar_files[{{ $cIdx }}]"
                                       class="form-control form-control-sm rounded-2 bg-white mb-1 support-channel-file-input" accept="image/*">
                                <input type="text" name="masterclass_settings[support_channels_list][{{ $cIdx }}][team_avatar]"
                                       class="form-control form-control-sm rounded-2 bg-white mb-2 support-channel-avatar-input"
                                       value="{{ $chCard['team_avatar'] ?? '' }}">

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

            <!-- Bottom Banner Strip -->
            <div class="col-12 mb-3">
                <label class="form-label mb-3 border-bottom pb-2 w-100">Bottom Banner Strip</label>
            </div>
            <div class="col-md-2 mb-4">
                <label class="form-label">Badge Icon</label>
                <input type="text" name="masterclass_settings[support_strip_icon]" class="form-control rounded-2"
                       value="{{ $stripIcon }}">
            </div>
            <div class="col-md-5 mb-4">
                <label class="form-label">Left Text</label>
                <input type="text" name="masterclass_settings[support_strip_text_1]" class="form-control rounded-2"
                       value="{{ $stripText1 }}">
            </div>
            <div class="col-md-5 mb-4">
                <label class="form-label">Right Highlight Text</label>
                <input type="text" name="masterclass_settings[support_strip_text_2]" class="form-control rounded-2"
                       value="{{ $stripText2 }}">
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
                    $(this).find('.support-feature-file-input').attr('name', 'support_feature_icon_files[' + index + ']');
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

                            <label class="form-label">Upload Icon</label>
                            <input type="file" name="support_feature_icon_files[${nextIndex}]"
                                   class="form-control font-12 bg-white mb-2 support-feature-file-input" accept="image/*">

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
                    $(this).find('.support-channel-icon-file-input').attr('name', 'support_channel_icon_files[' + index + ']');
                    $(this).find('.support-channel-file-input').attr('name', 'support_channel_avatar_files[' + index + ']');
                    $(this).find('.support-channel-avatar-input').attr('name', 'masterclass_settings[support_channels_list][' + index + '][team_avatar]');
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

                            <label class="form-label">Upload Icon</label>
                            <input type="file" name="support_channel_icon_files[${nextIndex}]"
                                   class="form-control font-12 bg-white mb-2 support-channel-icon-file-input" accept="image/*">

                            <label class="form-label">Team Avatars Image</label>
                            <input type="file" name="support_channel_avatar_files[${nextIndex}]"
                                   class="form-control form-control-sm rounded-2 bg-white mb-1 support-channel-file-input" accept="image/*">
                            <input type="text" name="masterclass_settings[support_channels_list][${nextIndex}][team_avatar]"
                                   class="form-control form-control-sm rounded-2 bg-white mb-2 support-channel-avatar-input"
                                   value="">

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

        });
    })(jQuery);
</script>
@endpush




