<!-- Upload Gallery Start -->
<div class="setup-wrapper-contents">
    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-item-top profile-border-bottom">
            <h4 class="create-project-wrapper-title">{{ __('Upload Project Media') }} </h4>
        </div>
        <div class="create-project-wrapper-upload">
            <div class="create-project-wrapper-upload-browse center-text radius-10">
                <div class="project_photos_preview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
                    <!-- Preview images will appear here -->
                </div>
                <span class="create-project-wrapper-upload-browse-icon mt-3">
        <i class="fa-solid fa-image"></i>
    </span>
                <span class="create-project-wrapper-upload-browse-para"> {{ __('Drag and drop or Click to browse images/videos') }} </span>
                <input class="upload-gallery" type="file" name="images[]" id="upload_project_photo" multiple accept="image/*,video/*">
            </div>
            <p class="mt-3"><strong>{{ __('info:') }}</strong> {{ __('Recommended image dimensions 1770x960 pixels. You can upload multiple images/videos (max 5 total)') }}</p>
        </div>
    </div>
</div>
<!-- Upload Gallery Ends -->
