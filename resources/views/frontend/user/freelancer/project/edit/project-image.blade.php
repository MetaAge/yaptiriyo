<!-- Upload Gallery Start -->
<div class="setup-wrapper-contents">
    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-item-top profile-border-bottom">
            <h4 class="create-project-wrapper-title">{{ __('Upload Media') }} </h4>
        </div>
        <div class="create-project-wrapper-upload">
            <div class="create-project-wrapper-upload-browse center-text radius-10">

                <div class="project_photos_preview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px; min-height: 50px;">
                    @php
                        $existing_images = $project_details->media;
                    @endphp

                    @if(!empty($existing_images))
                        @foreach($existing_images as $index => $image)
                            <div class="existing-image-preview" data-image="{{ $image }}" style="position: relative; width: 100px; height: 100px;">
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <img src="{{ render_frontend_cloud_image_if_module_exists('project/'.$image, load_from: $project_details->load_from) }}"
                                         alt="project"
                                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;">
                                @else
                                    @php $ext = pathinfo($image, PATHINFO_EXTENSION); @endphp
                                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif']))
                                        <img src="{{ asset('assets/uploads/project/'.$image) }}" 
                                             alt="{{ __('Project Media') }}" 
                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;">
                                    @else
                                        <video src="{{ asset('assets/uploads/project/'.$image) }}" 
                                               style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd;" 
                                               muted></video>
                                    @endif
                                @endif
                                <span class="remove-media-btn" 
                                      style="position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); z-index: 10;" 
                                      data-image="{{ $image }}" 
                                      title="Remove media">×</span>
                                <span style="position: absolute; bottom: 5px; left: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">{{ $index + 1 }}</span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">{{ __('No images uploaded') }}</p>
                    @endif
                </div>

                <div class="upload-trigger-area" style="cursor: pointer; padding: 20px; text-align: center;">
                    <span class="create-project-wrapper-upload-browse-icon mt-3">
                        <i class="fa-solid fa-image"></i>
                    </span>
                    <span class="create-project-wrapper-upload-browse-para"> {{ __('Click to add more images/videos (up to 5 total)') }} </span>
                </div>
                <input class="upload-gallery" type="file" name="images[]" id="upload_project_photo" multiple accept="image/*,video/*" style="display: none;">
            </div>
            <p class="mt-3">
                <strong>{{ __('info:') }}</strong> {{ __('Recommended image dimensions 1770x960 pixels. You can have up to 5 media (images/videos) total.') }}
            </p>
        </div>
    </div>
</div>
<!-- Upload Gallery Ends -->