<!-- Add Portfolio Popup Starts -->
<div class="popup-fixed portfolioadd-popup">
    <div class="popup-contents">
        <span class="popup-contents-close popup-close"> <i class="fas fa-times"></i> </span>
        <h5 class="popup-contents-title">{{ __('Add New Portfolio') }}</h5>
        <div class="error_msg_container mb-4"></div>
        
        <form action="#" id="add_portfolio_form">
            @csrf
            <!-- Upload Zone -->
            <div class="photo-uploaded mb-4">
                <div class="photo-uploaded-icon">
                    <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>
                </div>
                <div class="portfolio_photo_preview_container mb-2 hidden">
                    <img src="" class="portfolio_photo_preview">
                </div>
                <span class="font-medium text-base-300 change_image_text">{{ __('Click or drag to upload portfolio image') }}</span>
                <span class="text-sm text-base-400 mt-2">{{ __('Recommended: 1200px width, Max 20MB') }}</span>
                <input class="photo-uploaded-file" type="file" name="image" id="upload_portfolio_photo" accept="image/*">
            </div>

            <div class="popup-contents-form custom-form">
                <div class="mb-4">
                    <label for="portfolio_title">{{ __('Portfolio Title') }}</label>
                    <input type="text" name="portfolio_title" id="portfolio_title" class="form--control" placeholder="{{ __('e.g. Modern Dashboard Design') }}">
                    <div class="flex justify-between mt-1">
                        <span id="portfolio_title_error" class="text-xs text-red-500"></span>
                        <span id="portfolio_title_char_counter" class="char-counter">0 / 60</span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="portfolio_description">{{ __('Project Description') }}</label>
                    <textarea name="portfolio_description" id="portfolio_description" class="form--control" rows="4" placeholder="{{ __('Describe the project objectives and your role...') }}"></textarea>
                    <div class="flex justify-between mt-1">
                        <span id="portfolio_description_error" class="text-xs text-red-500"></span>
                        <span id="portfolio_description_char_counter" class="char-counter">0 / 1200</span>
                    </div>
                </div>
            </div>

            <div class="popup-contents-btn">
                <button type="button" class="btn-profile btn-outline-gray popup-close flex-1">{{ __('Cancel') }}</button>
                <button type="submit" class="btn-profile btn-bg-1 add_portfolio flex-1">{{ __('Save Project') }}</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Portfolio Popup Ends -->
