@isset($edit)
    @php
        $image = $image_object;
        $inputId = !empty($name) ? 'media_input_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $name) : 'apkThumb';
        $formattedSizeHint = '';
        if (!empty($size)) {
            $cleanSize = trim($size);
            if (str_contains(strtolower($cleanSize), 'recommended')) {
                $formattedSizeHint = $cleanSize;
                if (!str_starts_with($formattedSizeHint, '(')) {
                    $formattedSizeHint = '(' . $formattedSizeHint . ')';
                }
            } else {
                $cleanSize = str_replace(['(', ')'], '', $cleanSize);
                $formattedSizeHint = '(Recommended Size: ' . $cleanSize . ')';
            }
        }
    @endphp
    <div class="{{ $col }} custom-image">
        <div class="mb-4 gallery-modal" data-for="{{ $for ?? 'image' }}" data-selection="{{ $selection ?? 'single' }}">
            <label for="{{ $inputId }}" class="form-label mb-1">
                {{ $label }}
                @if(!empty($formattedSizeHint))
                    <small class="text-primary font-12 ms-1 fw-semibold">{{ $formattedSizeHint }}</small>
                @endif
            </label>
            <label for="{{ $inputId }}" class="file-upload-text">
                <p>
                    <span class="file_selected"></span>
                    {{ __('files_selected') }}
                </p>
                <span class="file-btn">{{ __('choose_file') }}</span>
            </label>
            <input class="d-none" type="hidden" name="{{ $name }}" data-type="{{ $type ?? '' }}" id="{{ $inputId }}"
                   value="{{ old('image') ? old('image') : ($media_id ? : '') }}">
        </div>
        <div class="selected-files d-flex flex-wrap gap-20">
            @if($image)
                <div class="selected-files-item">
                    @if (arrayCheck('image_80x80',$image) && is_file_exists($image['image_80x80'], $image['storage']))
                        <img
                            src="{{ getFileLink('80x80',$image) }}"
                            alt="gallery image"
                            class="selected-img">
                    @else
                        <img src="{{ static_asset('images/default/default-image-80x80.png') }}"
                             data-default="{{ static_asset('images/default/default-image-80x80.png') }}"
                             alt="category-banner" class="selected-img">
                    @endif
                    <div class="remove-icon" data-id="{{ $media_id }}">
                        <i class='las la-times'></i>
                    </div>
                </div>
            @endif
            <div class="selected-files-item {{ $image && arrayCheck('image_80x80',$image) && is_file_exists($image['image_80x80'], $image['storage']) ? 'd-none' : '' }}">
                <img class="selected-img"
                     src="{{ static_asset('images/default/default-image-80x80.png') }}"
                     alt="Headphone">
            </div>
        </div>
    </div>
@else
    @php
        $media = '';
        $imageVal = is_array($image) ? ($image['id'] ?? '') : $image;
        if ($imageVal && (is_numeric($imageVal) || is_string($imageVal))) {
            $media = \App\Models\MediaLibrary::find($imageVal);
        }
        $hasImageArray = is_array($image) && arrayCheck('image_80x80', $image) && is_file_exists($image['image_80x80'], $image['storage'] ?? 'local');
        $hasMediaImg = $media && (
            ($media->image_variants && arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']))
            || ($media->type != 'image' && !empty($media->original_file))
        );
        $hasActive = $hasMediaImg || $hasImageArray;
        $inputId = !empty($name) ? 'media_input_' . preg_replace('/[^a-zA-Z0-9_]/', '_', $name) : 'apkThumb';
        $formattedSizeHint = '';
        if (!empty($size)) {
            $cleanSize = trim($size);
            if (str_contains(strtolower($cleanSize), 'recommended')) {
                $formattedSizeHint = $cleanSize;
                if (!str_starts_with($formattedSizeHint, '(')) {
                    $formattedSizeHint = '(' . $formattedSizeHint . ')';
                }
            } else {
                $cleanSize = str_replace(['(', ')'], '', $cleanSize);
                $formattedSizeHint = '(Recommended Size: ' . $cleanSize . ')';
            }
        }
    @endphp
    <div class="{{ $col }} custom-image">
        <div class="mb-4 gallery-modal" data-for="{{ $for ?? 'image' }}" data-selection="{{ $selection ?? 'single' }}">
            <label for="{{ $inputId }}" class="form-label mb-1">
                {{ $label }}
                @if(!empty($formattedSizeHint))
                    <small class="text-primary font-12 ms-1 fw-semibold">{{ $formattedSizeHint }}</small>
                @endif
            </label>
            <label for="{{ $inputId }}" class="file-upload-text">
                <p><span
                        class="file_selected">{{ $hasActive ? 1 : '0' }} </span>{{ __('files_selected') }}
                </p>
                <span class="file-btn">{{ __('choose_file') }}</span>
            </label>
            <input class="d-none" type="hidden" name="{{ $name }}" data-type="{{ $type ?? '' }}" id="{{ $inputId }}"
                   value="{{ is_array($image) ? ($image['id'] ?? '') : $image }}">
        </div>
        <div class="selected-files d-flex flex-wrap gap-20">
            @if($media)
                <div class="selected-files-item">
                    @if (arrayCheck('image_80x80',$media->image_variants) && is_file_exists($media->image_variants['image_80x80'], $media->image_variants['storage']))
                        <img
                            src="{{ getFileLink('80x80',$media->image_variants) }}"
                            alt="{{ $media->name }}"
                            class="selected-img">
                    @else
                        <img src="{{ $media->type != 'image' && file_exists(public_path('images/default/default-'.$media->type.'-190x230.png')) ? static_asset('images/default/default-'.$media->type.'-190x230.png') : static_asset('images/default/default-image-80x80.png') }}"
                             data-default="{{ static_asset('images/default/default-image-80x80.png') }}"
                             alt="{{ $media->name }}" class="selected-img">
                    @endif
                    <div class="remove-icon" data-id="{{ $media->id }}">
                        <i class='las la-times'></i>
                    </div>
                </div>
            @elseif($hasImageArray)
                <div class="selected-files-item">
                    <img
                        src="{{ getFileLink('80x80',$image) }}"
                        alt="image"
                        class="selected-img">
                    <div class="remove-icon" data-id="">
                        <i class='las la-times'></i>
                    </div>
                </div>
            @endif
            <div class="selected-files-item {{ $hasActive ? 'd-none' : '' }}">
                <img class="selected-img"
                     src="{{ static_asset('images/default/default-image-80x80.png') }}"
                     alt="Headphone">
            </div>
        </div>
    </div>
@endif
