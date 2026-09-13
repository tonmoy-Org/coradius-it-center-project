@extends('backend.layouts.master')
@section('title', __('Counter Section'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="section-title mb-0" style="font-weight: 500;">{{ __('Counter Section') }}</h3>

                    </div>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('website.counter_section.save') }}" id="setting-form" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">

                                <!-- Enable / Disable Section Status -->
                                <div class="col-12 mb-4">
                                    <div class="d-flex justify-content-between align-items-center gap-12 sandbox_mode_div">
                                        <input type="hidden" name="counter_section_status" value="{{ setting('counter_section_status') === '0' ? 0 : 1 }}">
                                        <label class="form-label mb-0 fw-semibold" for="counter_section_status">Enable Section</label>
                                        <div class="setting-check">
                                            <input type="checkbox" value="1" id="counter_section_status"
                                                   class="sandbox_mode" {{ setting('counter_section_status') === '0' ? '' : 'checked' }}>
                                            <label for="counter_section_status"></label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Counter Items Container -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="form-label mb-0 d-block">{{ __('Counter Items') }}</span>
                                        <button type="button" class="btn sg-btn-primary" id="add_counter_item_btn">
                                            <i class="las la-plus"></i> {{ __('Add Counter Item') }}
                                        </button>
                                    </div>

                                    <div id="counter_items_container">
                                        @php
                                            $counterItems = setting('counter_items');
                                            if (!is_array($counterItems) || empty($counterItems)) {
                                                $counterItems = [
                                                    ['title' => setting('counter_1_title') ?: 'Total Course', 'count' => setting('counter_1_count') ?: '22 +'],
                                                    ['title' => setting('counter_2_title') ?: 'Instructors',  'count' => setting('counter_2_count') ?: '9 +'],
                                                    ['title' => setting('counter_3_title') ?: 'Learners',     'count' => setting('counter_3_count') ?: '413 +'],
                                                    ['title' => setting('counter_4_title') ?: 'Satisfied',    'count' => setting('counter_4_count') ?: '2.03 %'],
                                                ];
                                            }
                                        @endphp

                                        @foreach($counterItems as $index => $item)
                                            <div class="card mb-4 counter-item-card" data-index="{{ $index }}">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="form-label mb-0">Counter Item <span class="item-number">{{ $index + 1 }}</span></span>
                                                        <button type="button" class="btn btn-sm text-danger remove-item-btn p-0 border-0 bg-transparent" title="{{ __('delete') }}"><i class="las la-trash-alt" style="font-size: 24px;"></i></button>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Item Title / Label</label>
                                                                <input type="text" class="form-control rounded-2" name="counter_items[{{ $index }}][title]" value="{{ $item['title'] ?? '' }}" placeholder="e.g. Total Course">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Item Count / Number</label>
                                                                <input type="text" class="form-control rounded-2" name="counter_items[{{ $index }}][count]" value="{{ $item['count'] ?? '' }}" placeholder="e.g. 22 +">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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

@push('js')
<script>
    $(document).ready(function() {
        let itemIndex = {{ count($counterItems) }};

        $('#add_counter_item_btn').click(function() {
            let nextNumber = $('.counter-item-card').length + 1;
            let template = `
            <div class="card mb-4 counter-item-card" data-index="${itemIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="form-label mb-0">Counter Item <span class="item-number">${nextNumber}</span></span>
                        <button type="button" class="btn btn-sm text-danger remove-item-btn p-0 border-0 bg-transparent" title="{{ __('delete') }}"><i class="las la-trash-alt" style="font-size: 24px;"></i></button>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Item Title / Label</label>
                                <input type="text" class="form-control rounded-2" name="counter_items[${itemIndex}][title]" value="" placeholder="e.g. New Item">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Item Count / Number</label>
                                <input type="text" class="form-control rounded-2" name="counter_items[${itemIndex}][count]" value="" placeholder="e.g. 100 +">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            $('#counter_items_container').append(template);
            itemIndex++;
            reindexItems();
        });

        $(document).on('click', '.remove-item-btn', function() {
            $(this).closest('.counter-item-card').remove();
            reindexItems();
        });

        function reindexItems() {
            $('.counter-item-card').each(function(index) {
                $(this).find('.item-number').text(index + 1);
            });
        }
    });
</script>
@endpush






