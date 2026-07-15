<script>
    (function($){
        "use strict";
        $(document).ready(function(){
            // add to short list
            $(document).on('click', '.job_open_close', function(e) {
                let job_id = $(this).data('job-id');
                let job_on_off = $(this).data('job-on-off');
                let title, text, confirmation;

                if(job_on_off == 0){
                    title = "<?php echo e(__('Are you sure to open this job?')); ?>";
                    text = "<?php echo e(__('If you open this job it will publicly visible and freelancer will send job proposal')); ?>";
                    confirmation = "<?php echo e(__('Yes, open it!')); ?>";
                }else{
                    title = "<?php echo e(__('Are you sure to close this job?')); ?>";
                    text = "<?php echo e(__('If you close this job it will not publicly visible and freelancer will not send job proposal')); ?>";
                    confirmation = "<?php echo e(__('Yes, close it!')); ?>";
                }

                Swal.fire({
                    title: title,
                    text: text,
                    icon: "<?php echo e(__('warning')); ?>",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: confirmation
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:"<?php echo e(route('client.job.open.close')); ?>",
                            method:"post",
                            data:{job_id:job_id},
                            success:function(res){
                                if(res.status == 1){
                                    $('.job_open_close_location_'+ job_id).load(mainPageUrl.href + ' .job_open_close_location_' + job_id)
                                    toastr_success_js("<?php echo e(__('Job successfully open')); ?>");
                                }else{
                                    $('.job_open_close_location_'+ job_id).load(mainPageUrl.href + ' .job_open_close_location_' + job_id)
                                    toastr_success_js("<?php echo e(__('Job successfully closed')); ?>")
                                }
                            }
                        })
                    }
                })
            });

            // pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                let value = $('#set_filter_type_value').val();
                histories(page,value);
            });
            function histories(page,value){
                $.ajax({
                    url: "<?php echo e(route('client.job.paginate.data').'?page='); ?>" + page,
                    data:{value:value},
                    success:function(res){
                        $('.search_result').html(res);
                    }
                });
                mainPageUrl.href = "<?php echo e(route('client.job.paginate.data').'?page='); ?>" + page
            }


            //jobs filter
            $(document).on('click','.jobs_filter_for_client',function(){
                let value = $(this).data('val');
                $('#set_filter_type_value').val(value);
                $.ajax({
                    url: "<?php echo e(route('client.job.filter')); ?>",
                    method:'POST',
                    data:{value:value},
                    success:function(res){
                        $('.search_result').html(res);
                    }
                });
            })
        });
    }(jQuery));
</script>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/resources/views/frontend/user/client/job/my-job/all-jobs-js.blade.php ENDPATH**/ ?>