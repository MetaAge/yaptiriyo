<div class="project-preview-contents mt-4">
    <h4 class="project-preview-contents-title">{{ $project_title_and_description->title }}</h4>
    <hr>

    @php
        // Use the accessor method
        $project_images = $project_title_and_description->images ?? [];
    @endphp

    @if(!empty($project_images))
        <div class="project-images-gallery mb-4">
            <h5 class="mb-3">{{ __('Project Images') }} ({{ count($project_images) }})</h5>
            <div class="row g-3">
                @foreach($project_images as $index => $image)
                    <div class="col-md-4 col-sm-6">
                        <div class="project-image-item" style="position: relative;">
                            @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                <img src="{{ render_frontend_cloud_image_if_module_exists('project/'.$image, load_from: $project_title_and_description->load_from) }}"
                                     alt="{{ $project_title_and_description->title }}"
                                     class="img-fluid rounded"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/uploads/project/'.$image) }}"
                                     alt="{{ $project_title_and_description->title }}"
                                     class="img-fluid rounded"
                                     style="width: 100%; height: 200px; object-fit: cover;">
                            @endif
                            <span style="position: absolute; bottom: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 3px 8px; border-radius: 3px; font-size: 12px;">
                                {{ $index + 1 }}/{{ count($project_images) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
    @endif

    <h5 class="mb-3">{{ __('Description') }}</h5>
    <p class="project-preview-contents-para">{!! $project_title_and_description->description !!}</p>
</div>