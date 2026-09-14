@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
    }
    $showCurriculumSection = !isset($mcSettings['show_curriculum_section']) || !empty($mcSettings['show_curriculum_section']);
    $curriculumTitle = !empty($mcSettings['curriculum_title']) ? $mcSettings['curriculum_title'] : '';
@endphp

<!--====== Start Syllabus Section ======-->
@if(isset($course) && $course->sections->count() > 0 && $showCurriculumSection)
<style>
    .custom-syllabus-accordion .accordion-item {
        border: 1px solid var(--color-border-tint, #D9E8FC);
        border-radius: 8px !important;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        transition: all 0.3s ease;
        background: var(--color-white, #ffffff);
    }
    .custom-syllabus-accordion .accordion-item:hover {
        border-color: var(--color-primary, #0056D2);
        box-shadow: 0 8px 20px rgba(0, 86, 210, 0.08);
    }
    .custom-syllabus-accordion .accordion-button {
        background: var(--color-white, #ffffff) !important;
        color: var(--color-text-ink, #0A1E3F) !important;
        font-weight: 700;
        font-size: 16px;
        padding: 20px 24px;
        box-shadow: none !important;
    }
    .custom-syllabus-accordion .accordion-button:not(.collapsed) {
        background: var(--color-blue-tint, #EAF2FE) !important;
        color: var(--color-primary, #0056D2) !important;
        border-bottom: 1px solid var(--color-border-tint, #C7DCFA) !important;
    }
    .custom-syllabus-accordion .accordion-button::after {
        background-size: 1rem;
    }
    .custom-syllabus-accordion .accordion-body {
        background: var(--color-white, #ffffff) !important;
        padding: 0;
    }
</style>

<section class="syllabus-section p-t-60 p-b-60 position-relative overflow-hidden bg-white" id="syllabus">
    <div class="container container-1278">
        @if(!empty($curriculumTitle))
        <div class="common-heading text-center m-b-40" data-aos="fade-up">
            <h2 class="fw-bold m-b-0" style="color: var(--color-text-ink, #0A1E3F); font-size: 28px; line-height: 1.25;">
                {!! format_title_highlight($curriculumTitle) !!}
            </h2>
        </div>
        @endif
        
        <div class="accordion custom-syllabus-accordion accordion-flush" id="curriculumAccordion">
            @foreach($course->sections as $key => $section)
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ min($key * 80, 400) }}">
                    <div class="accordion-header" id="course-curriculum-heading{{ $key }}">
                        <div class="accordion-button {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? '' : 'collapsed' }}"
                             role="button" 
                             data-bs-toggle="collapse" 
                             data-bs-target="#course-curriculum-collapse{{ $key }}"
                             {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                             aria-controls="course-curriculum-collapse{{ $key }}">
                            <i class="fal fa-book-open me-2 text-warning"></i> {{ $section->title }}
                        </div>
                    </div>
                    <div id="course-curriculum-collapse{{ $key }}"
                         class="accordion-collapse collapse {{ $key == 0 && (count($course->lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                         aria-labelledby="course-curriculum-heading{{ $key }}" 
                         data-bs-parent="#curriculumAccordion">
                        <div class="accordion-body">
                            @if(count($course->lessons) > 0)
                                <div class="course-playlist">
                                    <ul class="list-unstyled mb-0 px-4 py-2">
                                        @foreach($course->lessons->where('section_id', $section->id) as $k => $lesson)
                                            <li class="py-3 border-bottom {{ $loop->last ? 'border-0' : '' }}">
                                                <a href="#" 
                                                   class="d-flex align-items-center justify-content-between text-dark text-decoration-none {{ $lesson->is_free == 1 ? 'player-src' : '' }}"
                                                   @if($lesson->is_free == 1)
                                                       data-poster="{{ $lesson->image ? getFileLink('402x238', $lesson->image) : ($course->image ? getFileLink('402x248', $course->image) : '') }}"
                                                       data-type="{{ $lesson->lesson_type }}" 
                                                       data-source="{{ $lesson->source }}"
                                                       data-video="{{ getVideoId($lesson->source, $lesson->source_data) }}"
                                                   @endif>
                                                    <div class="d-flex align-items-center gap-3">
                                                        @if($lesson->lesson_type == 'video')
                                                            <i class="fal fa-play-circle text-primary fs-5"></i>
                                                        @elseif($lesson->lesson_type == 'audio')
                                                            <i class="fal fa-microphone text-primary fs-5"></i>
                                                        @else
                                                            <i class="fal fa-file-alt text-primary fs-5"></i>
                                                        @endif
                                                        
                                                        <span class="fw-medium text-dark fs-6">{{ $lesson->title }}</span>
                                                        
                                                        @if($lesson->is_free == 1)
                                                            <span class="badge ms-2" style="background-color: #0056D2; color: #ffffff;">{{ __('free') }}</span>
                                                        @endif
                                                    </div>
                                                    <span class="small text-muted fw-semibold">{{ $lesson->duration }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
