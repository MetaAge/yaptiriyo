<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            // chat warning
            $(document).on('click','.contact_warning_chat_message',function(){
                toastr.warning("{{__('Please login as a client to chat with freelancer.')}}");
                return false;
            });

            // Earning toggle
            $(document).on('change', '#earningToggle', function() {
                const $toggleSwitch = $(this);
                const isChecked = $toggleSwitch.is(':checked');
                const $toggleLabel = $('.toggle-label');
                const $toggleInfo = $('p.text-sm.text-gray-500.mt-2');
                const $toggleSlider = $toggleSwitch.next('.toggle-slider');

                // Show loading state - disable the switch
                $toggleSwitch.prop('disabled', true);

                $.ajax({
                    url: "{{ route('freelancer.toggle.earning') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        show_earning: isChecked ? 1 : 0
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update the UI immediately without reloading
                            if (isChecked) {
                                $toggleLabel.html('<span class="text-green-600"><i class="fas fa-eye mr-1"></i> {{ __("Earnings are Visible") }}</span>');
                                $toggleInfo.text('{{ __("Clients can see your total earnings") }}');
                                // Toggle is ON - move slider to right
                                $toggleSlider.addClass('toggle-on').removeClass('toggle-off');
                            } else {
                                $toggleLabel.html('<span class="text-gray-600"><i class="fas fa-eye-slash mr-1"></i> {{ __("Earnings are Hidden") }}</span>');
                                $toggleInfo.text('{{ __("Clients cannot see your earnings") }}');
                                // Toggle is OFF - move slider to left
                                $toggleSlider.addClass('toggle-off').removeClass('toggle-on');
                            }

                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr) {
                        toastr.error('{{ __("Something went wrong") }}');
                        // Revert the toggle visually AND programmatically
                        $toggleSwitch.prop('checked', !isChecked);
                        const $slider = $toggleSwitch.next('.toggle-slider');
                        if (!isChecked) {
                            $slider.addClass('toggle-on').removeClass('toggle-off');
                        } else {
                            $slider.addClass('toggle-off').removeClass('toggle-on');
                        }
                    },
                    complete: function() {
                        // Re-enable the toggle
                        $toggleSwitch.prop('disabled', false);
                    }
                });
            });


            //available for work or not
            $(document).on('click','#check_work_availability',function(e){
                e.preventDefault();
                let user_id = $(this).data('user_id');
                let check_work_availability = $(this).data('check_work_availability');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To change work availability status !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, change it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.work.availability.status') }}",
                            method:'post',
                            data:{user_id:user_id,check_work_availability:check_work_availability},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('.display_work_availability').load(location.href + ' .display_work_availability');
                                    toastr.success("{{ __('Work Availability Status Successfully Changed') }}")
                                }
                            }
                        })
                    }
                })
            })

            $('#country_id').select2();
            $('#state_id').select2();

            // change country and get state
            $(document).on('change','#country_id', function() {
                let country = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.state.all') }}",
                    data: {
                        country: country
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select State')}}</option>";
                            let all_state = res.states;
                            $.each(all_state, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.state + "</option>";
                            });
                            $(".get_country_state").html(all_options);
                            $(".state_info").html('');
                            if(all_state.length <= 0){
                                $(".state_info").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                            }
                        }
                    }
                })
            })

            // professional title length check
            $('#professional_title_char_length_check').hide()
            $('#professional_title').on('keydown keyup change', function(){
                let title_min_length = 10;
                let title_max_length = 60;
                let professional_title_length = $('#professional_title').val().length;
                $('#professional_title_char_length_check').show();

                if(professional_title_length < title_min_length){
                    $('#professional_title_char_length_check').html('<p class="text text-danger">{{ __('Length is short, minimum') }} '+ title_min_length +' {{ __('required') }}.</p>');
                }else if(professional_title_length > title_max_length){
                    $('#professional_title_char_length_check').html('<p class="text text-danger">{{ __('Length is not valid, maximum') }} '+ title_max_length +' {{ __('allowed') }}.</p>');
                }else{
                    $('#professional_title_char_length_check').html('<p class="text text-success">{{ __('Length is valid') }}</p>');
                }
            });

            // professional description length check
            $('#professional_description_char_length_check').hide()
            $('#professional_description').on('keydown keyup change', function(){
                let description_min_length = 50;
                let description_max_length = 1500;
                let professional_description_length = $('#professional_description').val().length;
                $('#professional_description_char_length_check').show();

                if(professional_description_length < description_min_length){
                    $('#professional_description_char_length_check').html('<p class="text text-danger">{{ __('Length is short, minimum') }} '+ description_min_length +' {{ __('required') }}.</p>');
                }else if(professional_description_length > description_max_length){
                    $('#professional_description_char_length_check').html('<p class="text text-danger">{{ __('Length is not valid, maximum') }} '+ description_max_length +' {{ __('allowed') }}.</p>');
                }else{
                    $('#professional_description_char_length_check').html('<p class="text text-success">{{ __('Length is valid') }}</p>');
                }
            });

            //update profile
            $(document).on('click','.edit_public_profile_info',function(e){
                e.preventDefault();
                let first_name = $('#first_name').val();
                let last_name = $('#last_name').val();
                let title = $('#professional_title').val();
                let description = $('#professional_description').val();
                let country_id = $('#country_id').val();
                let state_id = $('#state_id').val();

                if(first_name == '' || last_name =='' || title == '' || description == '' || country_id==''){
                    toastr.warning("{{ __('Please fill all fields.') }}")
                    return false;
                }else{
                    $.ajax({
                        url:"{{ route('freelancer.profile.details.update') }}",
                        method:'post',
                        data:{first_name:first_name,last_name:last_name,title:title,description:description,country_id:country_id,state_id:state_id},
                        success:function(res){
                            if(res.status=='success'){
                                $('#profileModal').modal('hide');
                                $('.display_profile_info').load(location.href + ' .display_profile_info');
                                toastr.success("{{ __('Profile Info Successfully Updated') }}")
                            }
                        },
                        error:function(err){
                            let error = err.responseJSON;
                            $('.error_msg_container').html('');
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                            });
                        }
                    });
                }
            });

            //update hourly rate
            $(document).on('click','.edit_public_hourly_rate',function(e){
                e.preventDefault();
                let hourly_rate = $('#hourly_rate').val();

                if(hourly_rate == ''){
                    toastr.warning("{{ __('price is required.') }}")
                    return false;
                }else{
                    $.ajax({
                        url:"{{ route('freelancer.profile.details.hourly.rate.update') }}",
                        method:'post',
                        data:{hourly_rate:hourly_rate},
                        success:function(res){
                            if(res.status=='success'){
                                $('#priceModal').modal('hide');
                                $('.display_hourly_rate').load(location.href + ' .display_hourly_rate');
                                toastr.success("{{ __('Price Successfully Updated') }}")
                            }
                        },
                        error:function(err){
                            let error = err.responseJSON;
                            $('.error_msg_container').html('');
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                            });
                        }
                    });
                }
            });

            //Portfolio add Popup
            $(document).on('click', '.popup-overlay, .popup-close', function() {
                $('.portfolioadd-popup, .popup-overlay').removeClass('popup-active');
            });
            $(document).on('click', '.add-portfolio-click', function() {
                $('.portfolioadd-popup, .popup-overlay').toggleClass('popup-active');
            });

            //portfolio photo upload
            document.querySelector('#upload_portfolio_photo').addEventListener('change', function() {
                $("#add_portfolio_form").find('.change_image_text').text("{{__('Click to change photo')}}")
                if (this.files && this.files[0]) {
                    let img = document.querySelector('.portfolio_photo_preview');
                    $('.portfolio_photo_preview_container').removeClass('hidden');
                    img.onload = () =>{
                        URL.revokeObjectURL(img.src);
                    }
                    img.src = URL.createObjectURL(this.files[0]);
                    document.querySelector(".portfolio_photo_preview").files = this.files;
                }
            });

            // portfolio title character counter
            $('#portfolio_title').on('input keyup change', function(){
                let title_max_length = 60;
                let portfolio_title_length = $(this).val().length;
                $('#portfolio_title_char_counter').text(portfolio_title_length + ' / ' + title_max_length);
                
                if(portfolio_title_length > title_max_length) {
                    $('#portfolio_title_char_counter').addClass('limit-reached');
                } else {
                    $('#portfolio_title_char_counter').removeClass('limit-reached');
                }
            });

            // portfolio description character counter
            $('#portfolio_description').on('input keyup change', function(){
                let description_max_length = 1200;
                let portfolio_description_length = $(this).val().length;
                $('#portfolio_description_char_counter').text(portfolio_description_length + ' / ' + description_max_length);
                
                if(portfolio_description_length > description_max_length) {
                    $('#portfolio_description_char_counter').addClass('limit-reached');
                } else {
                    $('#portfolio_description_char_counter').removeClass('limit-reached');
                }
            });

            //add portfolio
            $(document).on('submit','#add_portfolio_form',function(e){
                e.preventDefault();
                let image = $('#upload_portfolio_photo').val();
                let title = $('#portfolio_title').val();
                let description = $('#portfolio_description').val();
                let formData = new FormData(this);

                if(image == '' || title == '' || description == ''){
                    toastr.warning("{{ __('Image, title and description fields are require') }}")
                    return false;
                }else{
                    @if(moduleExists('SecurityManage'))
                    let module_exits = "<?php echo moduleExists('SecurityManage') ?? '' ?>"
                    if (module_exits) {
                        let words = JSON.parse('<?php echo json_encode(\Modules\SecurityManage\Entities\Word::select('word')->where("status", "active")->pluck("word")->toArray()); ?>');

                        let combinedText = (title + ' ' + description).toLowerCase();

                        function checkAnyWordExists(words, text) {
                            return words.some(word => text.includes(word.toLowerCase()));
                        }
                        let anyWordExists = checkAnyWordExists(words, combinedText);
                        function getAllMatchedWords(words, text) {
                            return words.filter(word => text.includes(word.toLowerCase()));
                        }
                        let matchedWords = getAllMatchedWords(words, combinedText);

                        if (anyWordExists) {
                            toastr.warning('You cannot use restricted words: ' + matchedWords.join(', '));
                            return false;
                        }
                    }
                    @endif

                    $.ajax({
                        url:"{{ route('freelancer.portfolio.add') }}",
                        method:'post',
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success:function(res){
                            if(res.status=='success'){
                                $('#add_portfolio_form')[0].reset();
                                $('.portfolio_photo_preview_container').addClass('hidden');
                                $('.portfolio_photo_preview').attr('src', '');
                                $('#portfolio_title_char_counter').text('0 / 60');
                                $('#portfolio_description_char_counter').text('0 / 1200');
                                $('.portfolioadd-popup, .popup-overlay').removeClass('popup-active');
                                $('.portfolio_details_display').load(location.href + ' .portfolio_details_display');
                                toastr.success("{{ __('Portfolio Successfully Added') }}")
                            }
                            if(res.status == 'error') {
                                toastr.error(res.message);
                            }
                        },
                        error:function(err){
                            let error = err.responseJSON;
                            $('.error_msg_container').html('');
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger-600 text-sm">'+value+'<p>');
                            });
                        }
                    });
                }
            });

            //Open and close Popup for display Portfolio details
            $(document).on('click', '.popup-overlay, .popup-close', function() {
                $('.change-portfolio-popup, .portfolio_edit_popup, .popup-overlay').removeClass('popup-active');
            });
            $(document).on('click', '.click-portfolio', function() {
                $('.change-portfolio-popup, .popup-overlay').toggleClass('popup-active');
            });

            // view portfolio details
            $(document).on('click','.view_portfolio_details',function(e){
                let portfolio_id = $(this).data('id');
                $.ajax({
                    url:"{{ route('freelancer.portfolio.details') }}",
                    method:'post',
                    data:{id:portfolio_id},
                    success:function(res){
                        $('.change-portfolio-popup .popup-contents').html(res);
                    }
                });
            });

            //portfolio photo change
            document.querySelector('#change_portfolio_photo').addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    let img = document.querySelector('.edit_portfolio_photo_preview');
                    img.onload = () =>{
                        URL.revokeObjectURL(img.src);
                    }
                    img.src = URL.createObjectURL(this.files[0]);
                    document.querySelector(".edit_portfolio_photo_preview").files = this.files;
                }
            });

            //edit portfolio popup
            $(document).on('click','.edit_portfolio_details',function(){
                let portfolio_id = $(this).data('id');
                let portfolio_title = $(this).data('title');
                let portfolio_description = $(this).data('description');
                let portfolio_image_name = $(this).data('image');
                let portfolio_image = "../assets/uploads/portfolio/" + portfolio_image_name;

                $('#edit_portfolio_title_char_length_check').html('');
                $('#edit_portfolio_description_char_length_check').html('');
                $('.error_msg_container').html('');

                $('#edit_portfolio_id').val(portfolio_id);
                $('#portfolio_target_img').attr('src', portfolio_image);
                $('#edit_portfolio_title').val(portfolio_title);
                $('#edit_portfolio_description').val(portfolio_description);
                
                // Update counters
                $('#edit_portfolio_title_char_counter').text(portfolio_title.length + ' / 60');
                $('#edit_portfolio_description_char_counter').text(portfolio_description.length + ' / 1200');
                
                $('.change-portfolio-popup, .popup-overlay').removeClass('popup-active');
                $('.portfolio_edit_popup, .popup-overlay').toggleClass('popup-active');
            });

            // edit portfolio title character counter
            $('#edit_portfolio_title').on('input keyup change', function(){
                let title_max_length = 60;
                let portfolio_title_length = $(this).val().length;
                $('#edit_portfolio_title_char_counter').text(portfolio_title_length + ' / ' + title_max_length);
                
                if(portfolio_title_length > title_max_length) {
                    $('#edit_portfolio_title_char_counter').addClass('limit-reached');
                } else {
                    $('#edit_portfolio_title_char_counter').removeClass('limit-reached');
                }
            });

            // edit portfolio description character counter
            $('#edit_portfolio_description').on('input keyup change', function(){
                let description_max_length = 1200;
                let portfolio_description_length = $(this).val().length;
                $('#edit_portfolio_description_char_counter').text(portfolio_description_length + ' / ' + description_max_length);
                
                if(portfolio_description_length > description_max_length) {
                    $('#edit_portfolio_description_char_counter').addClass('limit-reached');
                } else {
                    $('#edit_portfolio_description_char_counter').removeClass('limit-reached');
                }
            });

            //update portfolio
            $(document).on('submit','#edit_portfolio_form',function(e){
                e.preventDefault();
                let image = $('#edit_upload_portfolio_photo').val();
                let title = $('#edit_portfolio_title').val();
                let description = $('#edit_portfolio_description').val();
                let formData = new FormData(this);

                if(image == '' || title == '' || description == ''){
                    toastr.warning("{{ __('Image, title and description fields are require') }}")
                    return false;
                }else {
                    @if(moduleExists('SecurityManage'))
                    let module_exits = "<?php echo moduleExists('SecurityManage') ?? '' ?>"
                    if (module_exits) {
                        let words = JSON.parse('<?php echo json_encode(\Modules\SecurityManage\Entities\Word::select('word')->where("status", "active")->pluck("word")->toArray()); ?>');

                        let combinedText = (title + ' ' + description).toLowerCase();

                        function checkAnyWordExists(words, text) {
                            return words.some(word => text.includes(word.toLowerCase()));
                        }
                        let anyWordExists = checkAnyWordExists(words, combinedText);

                        function getAllMatchedWords(words, text) {
                            return words.filter(word => text.includes(word.toLowerCase()));
                        }

                        let matchedWords = getAllMatchedWords(words, combinedText);

                        if (anyWordExists) {
                            toastr.warning('You cannot use restricted words: ' + matchedWords.join(', '));
                            return false;
                        }
                    }
                    @endif
                    $.ajax({
                        url: "{{ route('freelancer.portfolio.edit') }}",
                        method: 'post',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            if(res.status=='success'){
                                $('.portfolio_edit_popup, .popup-overlay').removeClass('popup-active');
                                $('.portfolio_details_display').load(location.href + ' .portfolio_details_display');
                                toastr.success("{{ __('Portfolio Successfully Updated') }}")
                            }
                        },
                        error: function (err) {
                            let error = err.responseJSON;
                            $('.error_msg_container').html('');
                            $.each(error.errors, function (index, value) {
                                $('.error_msg_container').append('<p class="text-danger">'+value+'<p>');
                            });
                        }
                    });
                }
            });

            //delete portfolio
            $(document).on('click','.delete_portfolio',function(e){
                e.preventDefault();
                let portfolio_id = $(this).data('id');
                $('.change-portfolio-popup, .popup-overlay').removeClass('popup-active');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To delete this portfolio !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.portfolio.delete') }}",
                            method:'post',
                            data:{id:portfolio_id},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('.portfolio_details_display').load(location.href + ' .portfolio_details_display');
                                    toastr.success("{{ __('Portfolio Successfully Deleted') }}")
                                }
                            }
                        })
                    }
                })
            })

            //delete project
            $(document).on('click','.delete_project',function(e){
                e.preventDefault();
                let project_id = $(this).data('project-id');
                $('.change-portfolio-popup, .popup-overlay').removeClass('popup-active');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To delete this project !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.project.delete') }}",
                            method:'post',
                            data:{project_id:project_id},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('.project_wrapper_area').load(location.href + ' .project_wrapper_area');
                                    toastr.success("{{ __('Project Successfully Deleted') }}")
                                }
                            }
                        })
                    }
                })
            })

            //choose skill
            const myTagInput = new TagsInputs({
                selector: 'skill_input',
                duplicate: false,
                max: 30,
            });

            @php
                $array_skill = explode(",",$skills);
                $array_length =  count($array_skill);
            @endphp

            @for($i = 0; $i<=($array_length-1); $i ++ )
            myTagInput.addData(["{{$array_skill[$i]}}"]);
            @endfor

            $(document).on('click','.choose_skill',function (){
                let skill = $(this).text();
                myTagInput.addData([skill]);
            });

            //update skill
            $('.edit_skill_wrapper').hide();
            $(document).on('click','.display_edit_skill_wrapper',function(){
                $('.edit_skill_wrapper').show();
                $('.freelancer_skill_list').hide();
            });
            $(document).on('click','.update_freelancer_skill',function(){
                let skill = $('#skill_input').val();
                $.ajax({
                    url: "{{ route('freelancer.account.skill.add') }}",
                    type: 'post',
                    data: {skill: skill},
                    success: function(res){
                        if(res.status == 'ok'){
                            toastr.success("{{ __('Skill Successfully Updated') }}");
                            $('.edit_skill_wrapper').hide();
                            $('.freelancer_skill_list').show();
                            $('.freelancer_skill_list').load(location.href + ' .freelancer_skill_list');
                        }
                    }
                });
            });

            // todo add education
            $(document).on('click','.add_education',function(){
                let institution = $('#institution').val();
                let degree = $('#degree').val();
                let subject = $('#subject').val();
                let start_date = $('#start_date_edu').val();
                let end_date = $('#end_date_edu').val();
                if(institution == '' || degree == '' || subject == '' || start_date == '' || end_date == ''){
                    toastr.warning("{{ __('Please fill all fields !') }}");
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('freelancer.account.education.add') }}",
                        type: 'post',
                        data: {
                            institution: institution,
                            degree:degree,
                            subject:subject,
                            start_date:start_date,
                            end_date:end_date,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_education_data').load(location.href + " #display_user_education_data");
                                $(addEducationForm)[0].reset();
                                toastr.success("{{ __('Education Successfully Added') }}");
                            }
                        }
                    });
                }
            });

            // edit education
            $(document).on('click','.edit_single_education',function(){
                let id = $(this).data('id');
                let institution = $(this).data('institution');
                let subject = $(this).data('subject');
                let degree = $(this).data('degree');
                let start_date = $(this).data('start_date');
                let end_date = $(this).data('end_date');

                $('#edit_id').val(id);
                $('#edit_institution').val(institution);
                $('#edit_subject').val(subject);
                $('#edit_degree').val(degree);
                $('#edit_start_date_edu').val(start_date);
                $('#edit_start_date_edu').parent().find('.date-picker').val(start_date);
                $('#edit_end_date_edu').val(end_date);
                $('#edit_end_date_edu').parent().find('.date-picker').val(end_date);
            });

            // update education
            $(document).on('click','.update_single_education',function(){
                let id = $('#edit_id').val();
                let institution = $('#edit_institution').val();
                let subject = $('#edit_subject').val();
                let degree = $('#edit_degree').val();
                let start_date = $('#edit_start_date_edu').val();
                let end_date = $('#edit_end_date_edu').val();
                if(institution == '' || subject == '' || degree == '' || start_date == '' || end_date == ''){
                    toastr.warning('Please fill all fields !');
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('freelancer.account.education.update') }}",
                        type: 'post',
                        data: {
                            id: id,
                            institution: institution,
                            subject:subject,
                            degree:degree,
                            start_date:start_date,
                            end_date:end_date,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                toastr.success("{{ __('Education Successfully Updated') }}");
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_education_data').load(location.href + " #display_user_education_data");
                                $(addExperienceForm)[0].reset();
                            }
                        }
                    });
                }
            });

            //delete education
            $(document).on('click','.delete_education',function(e){
                e.preventDefault();
                let education_id = $(this).data('id');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To delete this education !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.education.delete') }}",
                            method:'post',
                            data:{id:education_id},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('#display_user_education_data').load(location.href + ' #display_user_education_data');
                                    toastr.success("{{ __('Education Successfully Deleted') }}")
                                }
                            }
                        })
                    }
                })
            })

            // change country and get state
            $(document).on('change', '#country_id , #edit_country_id', function() {
                let country = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.state.all') }}",
                    data: {
                        country: country
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select State')}}</option>";
                            let all_state = res.states;
                            $.each(all_state, function(index, value) {
                                all_options += "<option value='" + value.id +
                                    "'>" + value.state + "</option>";
                            });
                            $(".get_country_state").html(all_options);
                            $(".state_info").html('');
                            if(all_state.length <= 0){
                                $(".state_info").html('<span class="text-danger"> {{ __('No state found for selected country!') }} <span>');
                            }
                        }
                    }
                })
            })

            // add experience
            $(document).on('click','.add_experience',function(){
                let experience_title = $('#experience_title').val();
                let organization = $('#organization').val();
                let address = $('#address').val();
                let short_description = $('#short_description').val();
                let start_date = $('#start_date').val();
                let end_date = $('#end_date').val();

                if(experience_title == '' || organization == '' || address == '' || short_description == '' || start_date == ''){
                    toastr.warning("{{ __('Please fill all fields !') }}");
                    return false;
                }
                if(end_date != '' && start_date >end_date){
                    toastr.warning("{{ __('Start date must not greater than end date !') }}");
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('freelancer.account.experience.add') }}",
                        type: 'post',
                        data: {
                            experience_title: experience_title,
                            organization:organization,
                            address:address,
                            short_description:short_description,
                            country_id:1,
                            state_id:1,
                            start_date:start_date,
                            end_date:end_date,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_experience_data').load(location.href + " #display_user_experience_data");
                                $(addExperienceForm)[0].reset();
                                toastr.success("{{ __('Experience Successfully Added') }}");
                            }
                        }
                    });
                }
            });

            // edit experience
            $(document).on('click','.edit_single_experience',function(){
                let id = $(this).data('id');
                let title = $(this).data('title');
                let organization = $(this).data('organization');
                let address = $(this).data('address');
                let short_description = $(this).data('short_description');
                let start_date = $(this).data('start_date');
                let end_date = $(this).data('end_date');

                $('#edit_id').val(id);
                $('#edit_experience_title').val(title);
                $('#edit_organization').val(organization);
                $('#edit_address').val(address);
                $('#edit_short_description').val(short_description);
                $('#edit_start_date').val(start_date);
                $('#edit_start_date').parent().find('.date-picker').val(start_date);
                $('#edit_end_date').parent().find('.date-picker').val(end_date);
                $('#edit_end_date').val(end_date);
            });

            // update experience
            $(document).on('click','.update_single_experience',function(){
                let id = $('#edit_id').val();
                let experience_title = $('#edit_experience_title').val();
                let organization = $('#edit_organization').val();
                let address = $('#edit_address').val();
                let short_description = $('#edit_short_description').val();
                let start_date = $('#edit_start_date').val();
                let end_date = $('#edit_end_date').val();
                if(experience_title == '' || organization == '' || address == '' || short_description == '' || start_date == ''){
                    toastr.warning('Please fill all fields !');
                    return false;
                }
                if(end_date != '' && start_date >end_date){
                    toastr.warning("{{ __('Start date must not greater than end date !') }}");
                    return false;
                }else{
                    $.ajax({
                        url: "{{ route('freelancer.account.experience.update') }}",
                        type: 'post',
                        data: {
                            id: id,
                            experience_title: experience_title,
                            organization:organization,
                            address:address,
                            short_description:short_description,
                            country_id:1,
                            state_id:1,
                            start_date:start_date,
                            end_date:end_date,
                        },
                        success: function(res){
                            if(res.status == 'ok'){
                                $('.popup-fixed, .popup-overlay').removeClass('popup-active');
                                $('#display_user_experience_data').load(location.href + " #display_user_experience_data");
                                $(addExperienceForm)[0].reset();
                                toastr.success("{{ __('Experience Successfully Updated') }}");
                            }
                        }
                    });
                }
            });

            //delete experience
            $(document).on('click','.delete_experience',function(e){
                e.preventDefault();
                let education_id = $(this).data('id');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To delete this experience !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, delete it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.experience.delete') }}",
                            method:'post',
                            data:{id:education_id},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('#display_user_experience_data').load(location.href + ' #display_user_experience_data');
                                    toastr.success("{{ __('Experience Successfully Deleted') }}")
                                }
                            }
                        })
                    }
                })
            })

            //available for order or not
            $(document).on('click','#available_for_order_or_not',function(e){
                e.preventDefault();
                let project_id = $(this).data('id');
                let project_on_off = $(this).data('project_on_off');
                Swal.fire({
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('To change availability status !') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('Yes, change it!') }}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"{{ route('freelancer.availability.status') }}",
                            method:'post',
                            data:{id:project_id,project_on_off:project_on_off},
                            success:function(res){
                                if(res.status == 'success'){
                                    $('.display_availability_for_order_or_not_'+project_id).load(location.href + ' .display_availability_for_order_or_not_'+project_id);
                                    toastr.success("{{ __('Availability Status Successfully Changed') }}")
                                }
                            }
                        })
                    }
                })
            })

            // view as a client
            $(document).on('click','.view_as_a_client',function(){
                $('.change_client_view').html('<a href="javascript:void(0)" class="px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm view_original"> {{ __('Exit View as Client') }} </a>')
                $('.price_edit_show_hide').hide();
                $('.edit_info_show_hide').hide();
                $('.create_project_show_hide').hide();
                $('.order_availability_show_hide').hide();
                $('.add_experience_show_hide').hide();
                $('.edit_experience_show_hide').hide();
                $('.delete_experience_show_hide').hide();
                $('.add_education_show_hide').hide();
                $('.edit_education_show_hide').hide();
                $('.delete_education_show_hide').hide();
                $('.edit_skill_show_hide').hide();
                $('.add_portfolio_show_hide').hide();
                $('.profile-wrapper-item-bottom.profile-border-top').addClass("d-none")
            })

            $(document).on('click','.view_original',function(){
                $('.change_client_view').html('<a href="javascript:void(0)" class="px-4 text-primary border py-1 rounded-lg hover:text-primary/90 hover:border-primary transition mb-4 flex items-center justify-center gap-2 text-sm view_as_a_client"> {{ __('View as Client') }} </a>')
                $('.price_edit_show_hide').show();
                $('.edit_info_show_hide').show();
                $('.create_project_show_hide').show();
                $('.order_availability_show_hide').show();
                $('.add_experience_show_hide').show();
                $('.edit_experience_show_hide').show();
                $('.delete_experience_show_hide').show();
                $('.add_education_show_hide').show();
                $('.edit_education_show_hide').show();
                $('.delete_education_show_hide').show();
                $('.edit_skill_show_hide').show();
                $('.add_portfolio_show_hide').show();
                $('.profile-wrapper-item-bottom.profile-border-top').removeClass("d-none")
            })

            //view project reject details
            $(document).on('click','.view_project_reject_reason_details',function(){
                let description = $(this).data('project-reject-description')
                $('.project_reject_reason_description').text(description);
            })

            // promotion plugin js start
            $(document).on('change','#get_package_budget',function (){
                let package_budget = $(this).find(':selected').attr('data-budget')
                $('#set_package_budget').val(package_budget);
            });

            //promote project
            $(document).on('click', '#get_package_budget, .wallet_selected_payment_gateway , .payment_getway_image ul li',function() {
                let site_default_currency_symbol = '{{ site_currency_symbol() }}';
                let gateway = $('#order_from_user_wallet').val();
                let package_budget = $('#set_package_budget').val();

                <?php
                $transaction_type = get_static_option('promote_transaction_fee_type') ?? '';
                $transaction_charge = get_static_option('promote_transaction_fee_charge') ?? 0;
                ?>

                if(gateway == 'wallet' || gateway == 'manual_payment'){
                    $('.show_hide_transaction_section').addClass('d-none');
                    let wallet_balance = {{ Auth::check() ? (Auth::user()->user_wallet?->balance ?? 0) : 0 }};
                    if(package_budget > wallet_balance){
                        $('.display_wallet_shortage_balance').html('<span class="text-danger">{{__('Wallet Balance Shortage:')}}'+ site_default_currency_symbol + (package_budget-wallet_balance) +'<a class="btn btn-primary btn-sm ml-2" href="{{ route('freelancer.wallet.history') }}" target="_blank">{{ __('Deposit Wallet') }}</a></span>');
                    }
                }else{
                    if("{{ $transaction_charge > 0}}"){
                        let transaction_amount = 0;
                        $('.show_hide_transaction_section').removeClass('d-none');
                        let transaction_type = "{{ $transaction_type }}";
                        let transaction_charge = parseFloat("{{ $transaction_charge }}");
                        transaction_amount = transaction_type == 'fixed' ? transaction_charge : (package_budget*transaction_charge/100);
                        $('.currency_symbol').text(site_default_currency_symbol);
                        $('.transaction_fee_amount').text(transaction_amount.toFixed(2));
                        $('#transaction_fee').val(transaction_amount)
                    }
                }
            });

            $(document).on('click','.open_project_promote_modal',function(){
                $('#set_project_id_for_promote').val($(this).data('project-id'))

                if($('#set_project_id_for_promote').val() == 0){
                    $('.heading_title_for_promotion_modal').text("{{ __('Promote Profile') }}")
                    $('.warning_for_promotion_modal').text("{{ __("Notice: Days refers to the number of days a freelancer profile will be displayed in the talent page promotional area after he buy a package.") }}")
                }else{
                    $('.heading_title_for_promotion_modal').text("{{ __('Promote Project') }}")
                    $('.warning_for_promotion_modal').text("{{ __("Notice: Days refers to the number of days a freelancer project will be displayed in the project promotional area after he buy a package.") }}")

                }
            })

            $(document).on('click','.confirm_promote_project',function(){
                let package_budget = $('#set_package_budget').val();
                let payment_gateway = $('#order_from_user_wallet').val();
                let manual_payment_image = $('input[name="manual_payment_image"]').val();

                if(package_budget == ''){
                    toastr.warning("{{ __('Please choose package plan') }}")
                    return false;
                }
                if(payment_gateway == 'manual_payment'){
                    if(manual_payment_image == ''){
                        toastr.warning("{{ __('Please choose image for manual payment.') }}")
                        return false;
                    }
                }

                //load spinner
                $('#promote_project_load_spinner').html('<i class="fas fa-spinner fa-pulse"></i>')
                setTimeout(function () {
                    $('#promote_project_load_spinner').html('');
                }, 10000);
            });

            // Portfolio thumbnail click
            $('.portfolio-thumb').on('click', function() {
                let img = $(this).data('img');
                $('#portfolio-main-img').attr('src', img);

                // Update active state
                $('.portfolio-thumb').removeClass('border-2 border-primary').addClass('border border-gray-200 hover:border-primary');
                $(this).removeClass('border border-gray-200 hover:border-primary').addClass('border-2 border-primary');
            });

        });
    }(jQuery));
</script>

<script>
    $(document).ready(function() {
        // More About Me toggle
        $('#more-about-btn').click(function () {
            $('#hidden-sections').removeClass('hidden');
            $('#more-about-btn').addClass('hidden');
            $('#hide-about-btn').removeClass('hidden');
            $('html, body').animate({
                scrollTop: $("#hidden-sections").offset().top - 100
            }, 500);
        });

        $('#hide-about-btn').click(function () {
            $('#hidden-sections').addClass('hidden');
            $('#hide-about-btn').addClass('hidden');
            $('#more-about-btn').removeClass('hidden');

            // Optional: Scroll back to the "More About Me" button
            $('html, body').animate({
                scrollTop: $("#more-about-btn").offset().top - 100
            }, 500);
        });

        // Portfolio Image Change
        $('.portfolio-thumb').on('click', function () {
            let img = $(this).data('img');
            $('#portfolio-main-img').attr('src', img);

            // Update active state
            $('.portfolio-thumb').removeClass('border-2 border-primary').addClass('border border-gray-200 hover:border-primary');
            $(this).removeClass('border border-gray-200 hover:border-primary').addClass('border-2 border-primary');
        });

        // Skills toggle
        $('#toggle-skills-btn').on('click', function() {
            const $hiddenSkills = $('#hidden-skills');
            const $skillsText = $('#toggle-skills-text');
            const $skillsIcon = $('#toggle-skills-icon');

            if ($hiddenSkills.hasClass('hidden')) {
                $hiddenSkills.removeClass('hidden');
                $skillsText.text('{{ __("Show Less") }}');
                $skillsIcon.removeClass('ti-tabler-chevron-down').addClass('ti-tabler-chevron-up');
            } else {
                $hiddenSkills.addClass('hidden');
                $skillsText.text('{{ __("Show More") }}');
                $skillsIcon.removeClass('ti-tabler-chevron-up').addClass('ti-tabler-chevron-down');
            }
        });

        // Reviews toggle
        // Reviews toggle
        $('#toggle-reviews-btn').on('click', function(e) {
            e.preventDefault(); // This prevents any default link behavior

            const $hiddenReviews = $('.review-item.hidden');
            const $reviewsText = $('#toggle-reviews-text');
            const $reviewsIcon = $('#toggle-reviews-icon');

            if ($hiddenReviews.length > 0) {
                // Show all reviews
                $hiddenReviews.removeClass('hidden');
                $reviewsText.text('{{ __("Show Less Reviews") }}');
                $reviewsIcon.removeClass('ti-tabler-arrow-right').addClass('ti-tabler-arrow-up');
                $reviewsIcon.removeClass('-rotate-45').addClass('rotate-0');
            } else {
                // Hide reviews beyond first 3
                $('.review-item:gt(2)').addClass('hidden');
                $reviewsText.text('{{ __("Show All Reviews") }}');
                $reviewsIcon.removeClass('ti-tabler-arrow-up').addClass('ti-tabler-arrow-right');
                $reviewsIcon.removeClass('rotate-0').addClass('-rotate-45');
            }

            // Optional: Smooth scroll to reviews section if it's far down
            if ($(window).scrollTop() > $('#reviews').offset().top - 100) {
                $('html, body').animate({
                    scrollTop: $('#reviews').offset().top - 100
                }, 500);
            }
        });

        // Show edit skill wrapper
        $('.display_edit_skill_wrapper').on('click', function() {
            $('.freelancer_skill_list').hide();
            $('.edit_skill_wrapper').removeClass('hidden').show();
        });

        // Cancel editing skills
        $('.cancel_edit_skill').on('click', function() {
            $('.edit_skill_wrapper').addClass('hidden').hide();
            $('.freelancer_skill_list').show();
        });

        // Contact warning for non-logged in users
        $(document).on('click','.contact_warning_chat_message',function(){
            toastr.warning("{{__('Please login as a client to chat with freelancer.')}}");
            return false;
        });
    });
    // Initialize video players for profile details page
    function initializeProfileVideoPlayers() {
        const videoContainers = document.querySelectorAll('.carousel-slide');

        videoContainers.forEach(container => {
            const video = container.querySelector('video');
            const durationBadge = container.querySelector('.video-duration');
            const progressCircle = container.querySelector('.progress-ring-circle');
            const volumeButton = container.querySelector('.video-volume-control');
            const volumeMutedIcon = container.querySelector('.volume-muted');
            const volumeUnmutedIcon = container.querySelector('.volume-unmuted');

            if (!video) return;

            const radius = 18;
            const circumference = 2 * Math.PI * radius;

            // Get video duration and display it
            video.addEventListener('loadedmetadata', function() {
                if (durationBadge) {
                    const duration = Math.floor(video.duration);
                    const minutes = Math.floor(duration / 60);
                    const seconds = duration % 60;
                    durationBadge.textContent = minutes + ':' + seconds.toString().padStart(2, '0');
                    durationBadge.style.display = 'block';
                }
            });

            // Update circular progress bar
            video.addEventListener('timeupdate', function() {
                if (progressCircle && video.duration) {
                    const progress = (video.currentTime / video.duration) * 100;
                    const offset = circumference - (progress / 100) * circumference;
                    progressCircle.style.strokeDashoffset = offset;
                }
            });

            // Volume button click handler
            if (volumeButton) {
                volumeButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (video.muted) {
                        video.muted = false;
                        volumeMutedIcon.style.display = 'none';
                        volumeUnmutedIcon.style.display = 'block';
                    } else {
                        video.muted = true;
                        volumeMutedIcon.style.display = 'block';
                        volumeUnmutedIcon.style.display = 'none';
                    }
                });
            }

            // Hover to play
            container.addEventListener('mouseenter', function() {
                if (video && video.paused) {
                    container.classList.add('video-playing');
                    video.play().catch(err => console.log('Play error:', err));
                }
            });

            // Stop on mouse leave
            container.addEventListener('mouseleave', function() {
                if (video && !video.paused) {
                    container.classList.remove('video-playing');
                    video.pause();
                    video.currentTime = 0;
                    if (progressCircle) {
                        progressCircle.style.strokeDashoffset = circumference;
                    }
                    // Reset to muted when leaving
                    video.muted = true;
                    if (volumeMutedIcon && volumeUnmutedIcon) {
                        volumeMutedIcon.style.display = 'block';
                        volumeUnmutedIcon.style.display = 'none';
                    }
                }
            });

            // Pause other videos when one plays
            video.addEventListener('play', function() {
                document.querySelectorAll('.carousel-slide video').forEach(otherVideo => {
                    if (otherVideo !== video && !otherVideo.paused) {
                        otherVideo.pause();
                        otherVideo.currentTime = 0;
                        const otherContainer = otherVideo.closest('.carousel-slide');
                        if (otherContainer) {
                            otherContainer.classList.remove('video-playing');
                            const otherProgress = otherContainer.querySelector('.progress-ring-circle');
                            if (otherProgress) {
                                otherProgress.style.strokeDashoffset = circumference;
                            }
                        }
                    }
                });
            });

            // Initialize progress circle
            if (progressCircle) {
                progressCircle.style.strokeDasharray = circumference;
                progressCircle.style.strokeDashoffset = circumference;
            }
        });
    }

    // Call the function after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        initializeProfileVideoPlayers();
    });
    // Delete project functionality
    $(document).on('click', '.delete-project-btn', function(e) {
        e.preventDefault();

        const projectId = $(this).data('project-id');
        const projectCard = $(this).closest('.card-animate');
        const projectTitle = projectCard.find('h3 a').text().trim();
        const deleteUrl = "{{ route('freelancer.project.delete') }}";
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: '{{ __("Delete Project") }}',
            text: '{{ __("Are you sure you want to delete") }} "' + projectTitle + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __("Yes, delete it!") }}',
            cancelButtonText: '{{ __("Cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        project_id: projectId  // Important: use 'project_id' to match controller
                    },
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Remove the project card with animation
                            projectCard.fadeOut(300, function() {
                                $(this).remove();

                                toastr.success('{{ __("Project deleted successfully") }}');

                                // Check if no projects left
                                if ($('.project_wrapper_area .card-animate').length === 0) {
                                    $('.project_wrapper_area').html(
                                        '<div class="border border-gray-200 rounded-2xl p-8 text-center">' +
                                        '<p class="text-base-400">{{ __("No services added yet.") }}</p>' +
                                        '</div>'
                                    );
                                }
                            });
                        } else {
                            toastr.error('{{ __("Failed to delete project") }}');
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = '{{ __("Something went wrong") }}';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        Swal.close();
                    }
                });
            }
        });
    });
</script>

<script>
    let isClientView = false;

    function toggleClientView() {
        isClientView = !isClientView;
        const button = document.getElementById('clientViewToggleBtn');
        const textSpan = document.getElementById('clientViewText');

        if (isClientView) {
            // Switch to client view (logged out simulation)
            button.classList.remove('border-primary', 'text-primary');
            button.classList.add('bg-primary', 'text-white');
            textSpan.textContent = '{{ __("Return to Freelancer View") }}';

            // Hide ALL freelancer-only elements as if logged out
            hideAllFreelancerElements();
            showClientViewBanner();

            // Also simulate that Contact Me button shows "Login Required" state
            simulateLoggedOutContactMeButton();
        } else {
            // Return to freelancer view
            button.classList.remove('bg-primary', 'text-white');
            button.classList.add('border-primary', 'text-primary');
            textSpan.textContent = '{{ __("View as Client") }}';

            // Restore all freelancer elements
            restoreAllFreelancerElements();
            hideClientViewBanner();

            // Restore Contact Me button
            restoreContactMeButton();
        }
    }



    function hideAllFreelancerElements() {
        // Hide ONLY specific buttons and controls, NOT layout containers

        // 1. Hide "Add Service" button
        document.querySelectorAll('.create_project_show_hide').forEach(el => {
            el.style.display = 'none';
        });

        // 2. Hide project action buttons (the entire action section in cards)
        document.querySelectorAll('.project_wrapper_area .card-animate').forEach(card => {
            // Hide the action section with border-t (Delete, Edit, Promote buttons)
            const actionSection = card.querySelector('.mt-2.pt-2.border-t');
            if (actionSection) {
                actionSection.style.display = 'none';
            }
        });

        // 3. Hide skill editing buttons
        document.querySelectorAll('.edit_skill_show_hide, .edit_skill_wrapper').forEach(el => {
            el.style.display = 'none';
        });

        // 4. Hide education controls
        document.querySelectorAll('.add_education_show_hide, .edit_single_education, .delete_education').forEach(el => {
            el.style.display = 'none';
        });

        // 5. Hide experience controls
        document.querySelectorAll('.add_experience_show_hide, .edit_single_experience, .delete_experience').forEach(el => {
            el.style.display = 'none';
        });

        // 6. Hide portfolio controls
        document.querySelectorAll('.add_portfolio_show_hide').forEach(el => {
            el.style.display = 'none';
        });

        // Hide edit/delete buttons in portfolio
        document.querySelectorAll('.portfolio_details_display').forEach(portfolio => {
            const editDeleteBtns = portfolio.querySelector('.flex.gap-3');
            if (editDeleteBtns && editDeleteBtns.querySelector('a[href*="edit"], a[href*="delete"]')) {
                editDeleteBtns.style.display = 'none';
            }
        });

        // 7. Hide earning toggle and work availability toggle cards in sidebar
        // Find all cards in the sidebar and check if they contain toggle switches
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            const sidebarCards = sidebar.querySelectorAll('.border.rounded-2xl.p-6.bg-white');
            sidebarCards.forEach(card => {
                // Check if this card contains a toggle switch or specific text
                const hasToggle = card.querySelector('.toggle-switch');
                const cardText = card.textContent;

                // Check for earnings toggle text (translated)
                const hasEarningsText = cardText.includes('Show Earnings') ||
                    cardText.includes('Earnings are Visible') ||
                    cardText.includes('Earnings are Hidden');

                // Check for work availability text (translated)
                const hasWorkText = cardText.includes('Available for Work') ||
                    cardText.includes('Available for work');

                if (hasToggle || hasEarningsText || hasWorkText) {
                    card.style.display = 'none';
                }
            });
        }

        // 8. Hide the "View as Client" button in sidebar
        document.querySelectorAll('.change_client_view').forEach(el => {
            el.style.display = 'none';
        });
    }

    function restoreAllFreelancerElements() {
        // Restore all hidden elements by removing inline display style

        // 1. Restore "Add Service" button
        document.querySelectorAll('.create_project_show_hide').forEach(el => {
            el.style.display = '';
        });

        // 2. Restore project action sections
        document.querySelectorAll('.project_wrapper_area .card-animate').forEach(card => {
            const actionSection = card.querySelector('.mt-2.pt-2.border-t');
            if (actionSection) {
                actionSection.style.display = '';
            }
        });

        // 3. Restore skill editing
        document.querySelectorAll('.edit_skill_show_hide, .edit_skill_wrapper').forEach(el => {
            el.style.display = '';
        });

        // 4. Restore education controls
        document.querySelectorAll('.add_education_show_hide, .edit_single_education, .delete_education').forEach(el => {
            el.style.display = '';
        });

        // 5. Restore experience controls
        document.querySelectorAll('.add_experience_show_hide, .edit_single_experience, .delete_experience').forEach(el => {
            el.style.display = '';
        });

        // 6. Restore portfolio controls
        document.querySelectorAll('.add_portfolio_show_hide').forEach(el => {
            el.style.display = '';
        });

        document.querySelectorAll('.portfolio_details_display').forEach(portfolio => {
            const editDeleteBtns = portfolio.querySelector('.flex.gap-3');
            if (editDeleteBtns) {
                editDeleteBtns.style.display = '';
            }
        });

        // 7. Restore all sidebar cards (including toggle cards)
        const sidebar = document.querySelector('aside');
        if (sidebar) {
            const sidebarCards = sidebar.querySelectorAll('.border.rounded-2xl.p-6.bg-white');
            sidebarCards.forEach(card => {
                card.style.display = '';
            });
        }

        // 8. Restore "View as Client" button
        document.querySelectorAll('.change_client_view').forEach(el => {
            el.style.display = '';
        });
    }

    function simulateLoggedOutContactMeButton() {
        const contactBtn = document.getElementById('contact-me-btn');
        if (contactBtn) {
            // Change button to show login required state
            contactBtn.innerHTML = '{{ __("Login to Contact") }} <i class="fa-solid fa-arrow-right -rotate-45 text-sm ml-1"></i>';
            contactBtn.classList.add('opacity-75');
            contactBtn.href = 'javascript:void(0)';
            contactBtn.onclick = function() {
                toastr.warning("{{__('Please login as a client to chat with freelancer.')}}");
            };
        }
    }

    function restoreContactMeButton() {
        const contactBtn = document.getElementById('contact-me-btn');
        if (contactBtn && @json(Auth::guard('web')->check())) {
            // Restore original contact button
            contactBtn.innerHTML = '{{ __("Contact me") }} <i class="fa-solid fa-arrow-right -rotate-45 text-sm ml-1"></i>';
            contactBtn.classList.remove('opacity-75');
            contactBtn.href = "{{ route('client.live.chat') }}?freelancer_id={{ $user->id }}";
            contactBtn.onclick = null;
        }
    }

    function showClientViewBanner() {
        // Remove existing banner if any
        hideClientViewBanner();

        // Create banner
        const banner = document.createElement('div');
        banner.id = 'clientViewBanner';
        banner.className = 'bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-lg';
        banner.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-eye text-blue-500 mr-3 text-lg"></i>
                    <div>
                        <p class="font-semibold text-blue-800">{{ __('Viewing as Client') }}</p>
                        <p class="text-sm text-blue-600">{{ __('All freelancer controls are now hidden') }}</p>
                    </div>
                </div>
                <button onclick="toggleClientView()"
                        class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                    {{ __('Exit View') }}
        </button>
    </div>
`;

        // Insert after the profile section
        const profileSection = document.querySelector('section.mb-8');
        if (profileSection) {
            profileSection.parentNode.insertBefore(banner, profileSection.nextSibling);
        }
    }

    function hideClientViewBanner() {
        const banner = document.getElementById('clientViewBanner');
        if (banner) {
            banner.remove();
        }
    }


</script>
<script>
    // Add video handling for profile carousels
    document.querySelectorAll('.carousel-container video').forEach(video => {
        video.addEventListener('play', () => {
            // Optional: Pause other videos
            document.querySelectorAll('.carousel-container video').forEach(v => {
                if (v !== video) v.pause();
            });
        });
    });
    // Add video handling for profile carousels
    document.querySelectorAll('.carousel-container video').forEach(video => {
        video.addEventListener('play', () => {
            // Optional: Pause other videos
            document.querySelectorAll('.carousel-container video').forEach(v => {
                if (v !== video) v.pause();
            });
        });
    });

    // Work availability toggle - FIXED
    // Work availability toggle - SIMPLIFIED AND FIXED
    $(document).on('change', '#workAvailabilityToggle', function() {
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked');
        const newStatus = isChecked ? 1 : 0;

        // Prevent multiple clicks
        if (checkbox.prop('disabled')) {
            return;
        }

        // Disable during request
        checkbox.prop('disabled', true);

        // Store current state for rollback
        const originalState = isChecked;

        // Send AJAX request
        $.ajax({
            url: "{{ route('freelancer.work.availability.status') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: '{{ $user->id }}',
                check_work_availability: newStatus
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Success - checkbox state is already correct
                    toastr.success('{{ __("Work availability updated successfully") }}');

                    // Update the status text if it exists
                    const statusText = checkbox.closest('.border.rounded-2xl.p-6.bg-white')
                        .find('.font-medium.text-base-300');

                    if (statusText.length) {
                        statusText.text(
                            newStatus === 1 ?
                                '{{ __("Available for Work") }}' :
                                '{{ __("Not Available") }}'
                        );
                    }
                } else {
                    // Error - revert checkbox
                    checkbox.prop('checked', !originalState);
                    toastr.error(response.message || '{{ __("Failed to update") }}');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                // Error - revert checkbox
                checkbox.prop('checked', !originalState);
                toastr.error('{{ __("Something went wrong") }}');
            },
            complete: function() {
                // Always re-enable the checkbox
                checkbox.prop('disabled', false);
            }
        });
    });

</script>