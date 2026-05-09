@extends('frontend.layout.master')
@section('site_title',__('Edit Project'))
@section('style')
    <x-summernote.summernote-css />
    <x-select2.select2-css/>
    <style>
        .disabled-link {
            background-color: #ccc !important;
            pointer-events: none;
            cursor: default;
        }
         .sticky {
             position: fixed;
             top: 0;
             width: 100%;
             z-index: 9995;
             background: #fff;
             -webkit-box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
             -moz-box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
             box-shadow: 0px 2px 5px 0px rgba(104, 104, 104, 0.49);
         }
    </style>
@endsection
@section('content')
    <main>
        <x-breadcrumb.user-profile-breadcrumb :title="__('Edit Project')" :innerTitle="__('Edit Project')"/>
        <!-- Account Setup area Starts -->
        <div class="account-area section-bg-2 pat-100 pab-100">
            <div class="container">
                <div class="setup-wrapper create-project-wrap">
                    <div class="setup-wrapper-flex">
                        @include('frontend.user.freelancer.project.create.project-sidebar')
                        <div class="create-project-wrapper">
                            <x-validation.error />
                            <form action="{{ route('freelancer.project.edit',$project_details->id )}}" id="submit_edit_project_form" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="removed_images" id="removed_images" value="">
                                <input type="hidden" name="keep_existing" value="1">
                                <input type="hidden" name="basic_title" id="set_basic_title">
                                <input type="hidden" name="standard_title" id="set_standard_title">
                                <input type="hidden" name="premium_title" id="set_premium_title">

                                @include('frontend.user.freelancer.project.edit.project-introduction')
                                @include('frontend.user.freelancer.project.edit.project-image')
                                @include('frontend.user.freelancer.project.edit.project-package-charge')
                                @include('frontend.user.freelancer.project.edit.project-footer')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Account Setup area end -->
    </main>
@endsection

@section('script')
    @include('frontend.user.freelancer.project.edit.edit-project-js')
    <x-summernote.summernote-js-function />
    <script>
        initializeSummernote($('#project_description'), {
            onKeyup: function(e) {
                setTimeout(function(){
                    let description_min_length = 10;
                    let project_description_length = $('#project_description').val().length;
                    if(project_description_length < description_min_length){
                        $('#project_description_char_length_check').html('<p class="text text-danger">{{ __('Length is short, minimum ') }}'+ description_min_length +' {{ __('required') }}.</p>');
                    }else{
                        $('#project_description_char_length_check').html('<p class="text text-success">{{ __('Length is valid') }}</p>');
                    }
                },200);
            }
        })
    </script>
    <x-select2.select2-js />

    <script>
        let selectedFiles = [];
        let removedImages = [];
        let existingImagesCount = 0;

        $(document).ready(function() {
            existingImagesCount = $('.existing-image-preview').length;

            $('.upload-trigger-area').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#upload_project_photo').click();
            });

            // Handle file selection
            $('#upload_project_photo').on('change', function(e) {
                const newFiles = Array.from(e.target.files);
                
                if (newFiles.length === 0) return;

                // Add new files
                newFiles.forEach(file => {
                    const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                    if (!exists) {
                        selectedFiles.push(file);
                    }
                });

                const totalImages = existingImagesCount + selectedFiles.length - removedImages.length;

                if (totalImages > 5) {
                    alert('Maximum 5 images allowed total. Please remove some images first.');
                    selectedFiles = selectedFiles.slice(0, 5 - (existingImagesCount - removedImages.length));
                }

                updateNewImagesPreview();
                updateFileInput();
            });

            // Remove existing image
            $(document).on('click', '.remove-media-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const imageName = $(this).data('image');
                const $element = $(this);
                
                Swal.fire({
                    title: '{{ __("Are you sure?") }}',
                    text: '{{ __("You want to remove this media?") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ __("Yes, remove it!") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removedImages.push(imageName);
                        $('#removed_images').val(JSON.stringify(removedImages));
                        
                        $element.closest('.existing-image-preview').fadeOut(300, function() {
                            $(this).remove();
                            existingImagesCount--;

                            if ($('.existing-image-preview').length === 0 && selectedFiles.length === 0) {
                                $('.project_photos_preview').html('<p class="text-muted">{{ __("No images uploaded") }}</p>');
                            }
                        });
                        
                        Swal.fire(
                            '{{ __("Removed!") }}',
                            '{{ __("Media has been removed.") }}',
                            'success'
                        );
                    }
                });
            });

            // Remove new media
            $(document).on('click', '.remove-new-media-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const index = $(this).data('index');
                selectedFiles.splice(index, 1);
                updateNewImagesPreview();
                updateFileInput();

                if (selectedFiles.length === 0) {
                    document.getElementById('upload_project_photo').value = '';
                }
            });

            // Update form before submit
            $('#submit_edit_project_form').on('submit', function() {
                $('#removed_images').val(JSON.stringify(removedImages));
            });
        });

        function updateNewImagesPreview() {
            // Remove old new images preview
            $('.new-image-preview').remove();

            if (selectedFiles.length === 0) return;

            const previewContainer = $('.project_photos_preview');
            
            // Remove "no images" message if it exists
            previewContainer.find('.text-muted').remove();

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const isImage = file.type.startsWith('image/');
                    const mediaTag = isImage
                        ? `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #28a745;">`
                        : `<video src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #28a745;" muted loop></video>`;
                    
                    previewContainer.append(`
                        <div class="new-image-preview" style="position: relative; width: 100px; height: 100px;">
                            ${mediaTag}
                            <span class="remove-new-media-btn" style="position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); z-index: 10;" data-index="${index}" title="Remove media">×</span>
                            <span style="position: absolute; bottom: 5px; left: 5px; background: rgba(40, 167, 69, 0.9); color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px;">New</span>
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });
        }

        function updateFileInput() {
            const input = document.getElementById('upload_project_photo');
            const dt = new DataTransfer();

            selectedFiles.forEach(file => {
                dt.items.add(file);
            });

            input.files = dt.files;
        }
    </script>
@endsection
