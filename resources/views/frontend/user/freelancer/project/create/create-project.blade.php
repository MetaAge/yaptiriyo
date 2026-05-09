@extends('frontend.layout.master')
@section('site_title',__('Create Project'))
@section('style')
    <x-summernote.summernote-css />
    <x-select2.select2-css/>
    <style>
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
   <x-breadcrumb.user-profile-breadcrumb :title="__('Create Project')" :innerTitle="__('Create Project')"/>
    <!-- Account Setup area Starts -->
    <div class="account-area section-bg-2 pat-100 pab-100">
        <div class="container">
            <div class="setup-wrapper create-project-wrap">
                <div class="setup-wrapper-flex">
                    @include('frontend.user.freelancer.project.create.project-sidebar')
                    <div class="create-project-wrapper">
                        <x-validation.error />
                         <form action="{{ route('freelancer.project.create') }}" id="submit_create_project_form" method="post" enctype="multipart/form-data">
                            @csrf
                             <input type="hidden" name="basic_title" id="set_basic_title">
                             <input type="hidden" name="standard_title" id="set_standard_title">
                             <input type="hidden" name="premium_title" id="set_premium_title">

                            @include('frontend.user.freelancer.project.create.project-introduction')
                            @include('frontend.user.freelancer.project.create.project-image')
                            @include('frontend.user.freelancer.project.create.project-package-charge')
                            @include('frontend.user.freelancer.project.create.project-footer')
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
   @include('frontend.user.freelancer.project.create.project-js')
   <x-summernote.summernote-js-function />
   <script>
       initializeSummernote($('.description'), {
           onKeyup: function(e) {
               setTimeout(function(){
                   let description_min_length = 50;
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

   <script>
       let selectedFiles = []; // Store selected files
       let isRemoving = false; // Flag to prevent file input trigger

       $(document).ready(function() {
           $('#upload_project_photo').on('change', function(e) {
               if (isRemoving) {
                   isRemoving = false;
                   return;
               }

               const newFiles = Array.from(e.target.files);

               // Add new files to existing ones
               newFiles.forEach(file => {
                   // Check if file already exists (by name and size)
                   const exists = selectedFiles.some(f => f.name === file.name && f.size === file.size);
                   if (!exists) {
                       selectedFiles.push(file);
                   }
               });

               // Check total count
               if (selectedFiles.length > 5) {
                   alert('Maximum 5 images allowed');
                   selectedFiles = selectedFiles.slice(0, 5); // Keep only first 5
               }

               updatePreview();
               updateFileInput();
           });

           // Handle remove button clicks with event delegation
           $(document).on('click', '.remove-media-btn', function(e) {
               e.preventDefault();
               e.stopPropagation();
               e.stopImmediatePropagation();

               const index = parseInt($(this).attr('data-index'));
               removeImage(index);
               return false;
           });
       });

       function updatePreview() {
           const previewContainer = $('.project_photos_preview');
           previewContainer.empty();

           if (selectedFiles.length === 0) {
               return;
           }

           selectedFiles.forEach((file, index) => {
               const reader = new FileReader();
               reader.onload = function(e) {
                   const isImage = file.type.startsWith('image/');
                   const mediaTag = isImage
                       ? `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd; pointer-events: none;">`
                       : `<video src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px; border: 2px solid #ddd; pointer-events: none;" muted loop></video>`;
                   const mediaDiv = $(`
        <div class="media-preview-wrapper" style="position: relative; width: 100px; height: 100px; display: inline-block; margin: 5px;">
            ${mediaTag}
            <span class="remove-media-btn" data-index="${index}" style="position: absolute; top: -8px; right: -8px; background: #dc3545; color: white; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.3); z-index: 10;" title="Remove media">×</span>
        </div>
    `);
                   previewContainer.append(mediaDiv);
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

       function removeImage(index) {
           isRemoving = true;
           selectedFiles.splice(index, 1);
           updatePreview();
           updateFileInput();

           // Reset input if no files left
           if (selectedFiles.length === 0) {
               $('#upload_project_photo').val('');
           }

           setTimeout(() => {
               isRemoving = false;
           }, 100);
       }

       // Clear files when form is reset
       $('#submit_create_project_form').on('reset', function() {
           selectedFiles = [];
           $('#upload_project_photo').val('');
           $('.project_photos_preview').empty();
       });
   </script>

   <x-select2.select2-js />
@endsection
