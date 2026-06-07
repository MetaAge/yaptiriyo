<script>
    (function($){
        "use strict";
        $(document).ready(function(){

            $('.select2-country, .select2-state, .select2-city').select2({
                dropdownParent: $('#addModal')
            });
            $('.select22-country, .select22-state, .select22-city').select2({
                dropdownParent: $('#editNeighborhoodModal')
            });

            // add neighborhood validation
            $(document).on('click','.add_neighborhood',function(e){
                let neighborhood = $('#neighborhood').val();
                let city = $('#city').val();
                let state = $('#state').val();
                let country = $('#country').val();
                if(neighborhood == '' || city == '' || state == '' || country == ''){
                    toastr_warning_js("{{ __('Please fill all fields !') }}");
                    return false;
                }
            });

            //show neighborhood in edit modal
            $(document).on('click','.edit_neighborhood_modal',function(){
                let neighborhood = $(this).data('neighborhood');
                let neighborhood_id = $(this).data('neighborhood_id');
                let city_id = $(this).data('city_id');
                let state_id = $(this).data('state_id');
                let country_id = $(this).data('country_id');

                $('#neighborhood_name').val(neighborhood).trigger("change");
                $('#neighborhood_id').val(neighborhood_id).trigger("change");
                $('#country_id').val(country_id).trigger("change");
                $('#state_id').val(state_id).trigger("change");
                $('#city_id').val(city_id).trigger("change");
            });

            // update neighborhood validation
            $(document).on('click','.edit_neighborhood',function(e){
                let neighborhood = $('#neighborhood_name').val();
                let city = $('#city_id').val();
                let state = $('#state_id').val();
                let country = $('#country_id').val();
                if(neighborhood == '' || city == '' || state == '' || country == ''){
                    toastr_warning_js("{{ __('Please fill all fields !') }}");
                    return false;
                }
            });

            // dynamic cascades for add modal:
            // country -> state
            $('#country').on('change', function() {
                let country = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.state.all') }}",
                    data: { country: country },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select State')}}</option>";
                            let all_state = res.states;
                            $.each(all_state, function(index, value) {
                                all_options += "<option value='" + value.id + "'>" + value.state + "</option>";
                            });
                            $("#state").html(all_options).trigger('change');
                            $("#city").html("<option value=''>{{__('Select City')}}</option>").trigger('change');
                        }
                    }
                })
            });

            // state -> city
            $('#state').on('change', function() {
                let state = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.city.all') }}",
                    data: { state: state },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select City')}}</option>";
                            let all_cities = res.cities;
                            $.each(all_cities, function(index, value) {
                                all_options += "<option value='" + value.id + "'>" + value.city + "</option>";
                            });
                            $("#city").html(all_options).trigger('change');
                        }
                    }
                })
            });


            // dynamic cascades for edit modal:
            // country -> state
            $('#country_id').on('change', function() {
                let country = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.state.all') }}",
                    data: { country: country },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select State')}}</option>";
                            let all_state = res.states;
                            $.each(all_state, function(index, value) {
                                all_options += "<option value='" + value.id + "'>" + value.state + "</option>";
                            });
                            $("#state_id").html(all_options).trigger('change');
                            $("#city_id").html("<option value=''>{{__('Select City')}}</option>").trigger('change');
                        }
                    }
                })
            });

            // state -> city
            $('#state_id').on('change', function() {
                let state = $(this).val();
                $.ajax({
                    method: 'post',
                    url: "{{ route('au.city.all') }}",
                    data: { state: state },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>{{__('Select City')}}</option>";
                            let all_cities = res.cities;
                            $.each(all_cities, function(index, value) {
                                all_options += "<option value='" + value.id + "'>" + value.city + "</option>";
                            });
                            $("#city_id").html(all_options).trigger('change');
                        }
                    }
                })
            });

            // pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                neighborhoods(page);
            });
            function neighborhoods(page){
                $.ajax({
                    url:"{{ route('admin.neighborhood.paginate.data').'?page='}}" + page,
                    success:function(res){
                        $('.search_result').html(res);
                    }
                });
            }

            // search neighborhood
            $(document).on('keyup','#string_search',function(){
                let string_search = $(this).val();
                $.ajax({
                    url:"{{ route('admin.neighborhood.search') }}",
                    method:'GET',
                    data:{string_search:string_search},
                    success:function(res){
                        if(res.status=='nothing'){
                            $('.search_result').html('<h3 class="text-center text-danger">'+"{{ __('Nothing Found') }}"+'</h3>');
                        }else{
                            $('.search_result').html(res);
                        }
                    }
                });
            })

        });
    }(jQuery));

    // toastr warning
    function toastr_warning_js(msg){
        Command: toastr["warning"](msg, "Warning !")
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    }
</script>
