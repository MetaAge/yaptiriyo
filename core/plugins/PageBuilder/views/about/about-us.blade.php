<!-- About Us -->
<section class="px-6 py-12 md:py-20 lg:py-[120px]" style="padding-top: {{ $padding_top }}px; padding-bottom: {{ $padding_bottom }}px; background-color: {{ $section_bg }}">
    <div class="max-w-7xl mx-auto">
        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 ">

            <!-- Left Content -->
            <div class=" border p-6 space-y-4  border-base-300/10 rounded-xl">
                <!-- About Us Label -->
                <div>
                    <span class="text-secondary font-medium text-sm pb-4">About Us</span>
                </div>

                <!-- Main Heading -->
                @if(!empty($title))
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-medium text-gray-900 leading-snug">
                            {!! $title !!}
                        </h1>
                    </div>
                @endif

                <!-- Description Paragraphs -->
                @if(!empty($description))
                    <div class="space-y-4 text-gray-600 text-sm leading-relaxed ">
                        {!! $description !!}
                    </div>
                @endif

                <!-- Repeater Data (Credibility Items) -->
                @if(!empty($repeater_data))
                    <div class="space-y-4 text-gray-600 text-sm leading-relaxed">
                        @foreach($repeater_data['title_'] ?? [] as $key => $rep_title)
                            <div>
                                @if(!empty($rep_title))
                                    <h3 class="font-medium text-gray-900 mb-1">{{ $rep_title }}</h3>
                                @endif
                                @if(!empty($repeater_data['description_'][$key]))
                                    <p>{{ $repeater_data['description_'][$key] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Content -->
            <!-- Image -->
            @if(!empty($image))
                <div class="w-full rounded-xl overflow-hidden">
                    {!! render_image_markup_by_attachment_id($image, '', 'w-full h-auto rounded-xl') !!}
                </div>
            @endif


        </div>
    </div>
</section>