<?php
    $project = json_decode(json_encode($message->message['project']));
?>

<?php if($message->from_user == 1): ?>
    <div class="chat-wrapper-details-inner-chat  <?php if(Auth::guard('web')->check()): ?> chat-reply <?php endif; ?>">
        <div class="chat-wrapper-details-inner-chat-flex">
            <div class="chat-wrapper-details-inner-chat-thumb">
                <?php if($data->client?->image): ?>
                    <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                        <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. $data?->client?->image, load_from: $data?->client?->load_from ?? '')); ?>" alt="<?php echo e($data->client?->fullname); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/uploads/profile/'.$data->client?->image)); ?>" alt="">
                    <?php endif; ?>
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('author')); ?>">
                <?php endif; ?>
            </div>
            <div class="chat-wrapper-details-inner-chat-contents <?php echo e(!empty($project->type) ? "bg-danger p-2 text-dark bg-opacity-10" : ""); ?>">
                <p class="chat-wrapper-details-inner-chat-contents-para <?php echo e(!empty($project) ? "d-none" : ""); ?>">
                <?php if(!empty($message->message['message'])): ?>
                    <span class="chat-wrapper-details-inner-chat-contents-para-span"><?php echo e($message->message['message'] ?? ''); ?></span>
                    <?php endif; ?>

                    <?php if(!empty($message->file)): ?>
                        <br />
                        <br />
                        <?php
                            $ext = pathinfo($message->file, PATHINFO_EXTENSION);
                        ?>
                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                            <?php if($ext == 'pdf' || $ext == 'docx' || $ext == 'zip' || $ext == 'doc' || $ext == 'csv' || $ext == 'txt' || $ext == 'xlx' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'rar' || $ext == '7z'): ?>
                                <a class="download-pdf-chat mt-2" href="<?php echo e(render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from)); ?>" download><?php echo e(__('Download file')); ?></a>
                            <?php else: ?>
                                <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'media-uploader/live-chat/'.$message->file, load_from: $message->load_from)); ?>">
                                <br />
                                <a class="download-pdf-chat mt-2" href="<?php echo e(render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from)); ?>" download><?php echo e(__('Download file')); ?></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($ext == 'pdf' || $ext == 'docx' || $ext == 'zip' || $ext == 'doc' || $ext == 'csv' || $ext == 'txt' || $ext == 'xlx' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'rar' || $ext == '7z'): ?>
                                <a class="download-pdf-chat mt-2" href="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" download><?php echo e(__('Download file')); ?></a>
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" alt="<?php echo e($message->file ?? ''); ?>">
                                <br />
                                <a class="download-pdf-chat mt-2" href="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" download><?php echo e(__('Download file')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </p>

                <?php if(!empty($project)): ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 <?php echo e(($project->type ?? '') == 'job'?'d-none' : ''); ?>">
                                <?php if(($project->type ?? '') == 'job'): ?>
                                    <span></span>
                                <?php else: ?>
                                    <?php
                                        $projectImage = $project->image ?? null;
                                        if (is_string($projectImage)) {
                                            $imageArray = json_decode($projectImage, true);
                                            $firstImage = is_array($imageArray) ? ($imageArray[0] ?? null) : $projectImage;
                                        } elseif (is_array($projectImage)) {
                                            $firstImage = $projectImage[0] ?? null;
                                        } else {
                                            $firstImage = null;
                                        }
                                    ?>
                                    <?php if($firstImage): ?>
                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                            <img class="img-fluid rounded-start" src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'project/'. $firstImage, load_from: $project->load_from ?? '')); ?>" alt="<?php echo e($project->title ?? ''); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/uploads/project/'.$firstImage)); ?>" class="img-fluid rounded-start" alt="<?php echo e($project->title ?? ''); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="<?php echo e(($project->type ?? '') == 'job'?'col-md-12' : 'col-md-8'); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($project->title); ?></h5>
                                    <?php if(($project->type ?? '') == 'job'): ?>
                                        <a class="btn btn-primary btn-sm" target="_blank" href="<?php echo e(route('job.details', ['username' => $project->username, 'slug' => $project->slug])); ?>"><?php echo e(__('View details')); ?></a>
                                    <?php else: ?>
                                        <a class="btn btn-primary btn-sm" target="_blank" href="<?php echo e(route('project.details', ['username' => $project->username, 'slug' => $project->slug])); ?>"><?php echo e(__('View details')); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if(($project->type ?? '') == 'job'): ?>
                            <h5><?php echo e($project->interview_message ?? ''); ?></h5>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <span class="chat-wrapper-details-inner-chat-contents-time mt-2" data-timestamp="<?php echo e($message->created_at->timestamp); ?>">
                    <?php echo e($message->created_at->diffForHumans()); ?>

                    <div class="message-status">
                    <?php if($message->from_user == 1): ?>
                        <?php if($message->is_seen == 1): ?>
                            <svg class="tick-icon tick-seen" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <svg class="tick-icon tick-seen" fill="currentColor" viewBox="0 0 20 20" style="margin-left: -8px;">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        <?php else: ?>
                            <svg class="tick-icon tick-delivered" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <svg class="tick-icon tick-delivered" fill="currentColor" viewBox="0 0 20 20" style="margin-left: -8px;">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                </span>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if($message->from_user == 2): ?>
    <div class="chat-wrapper-details-inner-chat">
        <div class="chat-wrapper-details-inner-chat-flex">
            <div class="chat-wrapper-details-inner-chat-thumb">
                 <a href="<?php echo e(route('freelancer.profile.details', $data?->freelancer?->username)); ?>" target="_blank">
                    <?php if($data->freelancer?->image): ?>
                         <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                             <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'profile/'. $data?->freelancer?->image, load_from: $data?->freelancer?->load_from ?? '')); ?>" alt="<?php echo e($data->freelancer?->fullname); ?>">
                         <?php else: ?>
                            <img src="<?php echo e(asset('assets/uploads/profile/'.$data->freelancer?->image)); ?>" alt="">
                         <?php endif; ?>
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('author')); ?>">
                    <?php endif; ?>
                </a>
            </div>
            <div class="chat-wrapper-details-inner-chat-contents">
                <p class="chat-wrapper-details-inner-chat-contents-para">
                    <?php if(!empty($message->message['message'])): ?>
                    <span class="chat-wrapper-details-inner-chat-contents-para-span"><?php echo e($message->message['message'] ?? ''); ?></span>
                    <?php endif; ?>
                    <?php if(!empty($message->file)): ?>
                        <br />
                        <br />
                            <?php
                                $ext = pathinfo($message->file, PATHINFO_EXTENSION);
                            ?>
                            <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                <?php if($ext == 'pdf' || $ext == 'docx' || $ext == 'zip' || $ext == 'doc' || $ext == 'csv' || $ext == 'txt' || $ext == 'xlx' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'rar' || $ext == '7z'): ?>
                                <a class="download-pdf-chat mt-2" href="<?php echo e(render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from)); ?>" download><?php echo e(__('Download file')); ?></a>
                                <?php else: ?>
                                    <img src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'media-uploader/live-chat/'.$message->file, load_from: $message->load_from)); ?>">
                                    <br />
                                    <a class="download-pdf-chat mt-2" href="<?php echo e(render_frontend_cloud_image_if_module_exists('media-uploader/live-chat/'. $message->file, load_from: $message->load_from)); ?>" download><?php echo e(__('Download file')); ?></a>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if($ext == 'pdf' || $ext == 'docx' || $ext == 'zip' || $ext == 'doc' || $ext == 'csv' || $ext == 'txt' || $ext == 'xlx' || $ext == 'xlsx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'rar' || $ext == '7z'): ?>
                                    <a class="download-pdf-chat mt-2" href="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" download><?php echo e(__('Download file')); ?></a>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" alt="<?php echo e($message->file ?? ''); ?>">
                                    <br />
                                    <a class="download-pdf-chat mt-2" href="<?php echo e(asset('assets/uploads/media-uploader/live-chat/'. $message->file)); ?>" download><?php echo e(__('Download file')); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                    <?php endif; ?>
                </p>

                <?php if(!empty($project)): ?>
                    <div class="card mb-3" style="max-width: 540px; margin-left:auto">
                        <div class="row g-0">
                            <div class="col-md-4 <?php echo e(($project->type ?? '') == 'job'?'d-none' : ''); ?>">
                                <?php if(($project->type ?? '') == 'job'): ?>
                                    <span></span>
                                <?php else: ?>
                                    <?php
                                        $projectImage = $project->image ?? null;
                                        if (is_string($projectImage)) {
                                            $imageArray = json_decode($projectImage, true);
                                            $firstImage = is_array($imageArray) ? ($imageArray[0] ?? null) : $projectImage;
                                        } elseif (is_array($projectImage)) {
                                            $firstImage = $projectImage[0] ?? null;
                                        } else {
                                            $firstImage = null;
                                        }
                                    ?>
                                    <?php if($firstImage): ?>
                                        <?php if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])): ?>
                                            <img class="img-fluid rounded-start" src="<?php echo e(render_frontend_cloud_image_if_module_exists( 'project/'. $firstImage, load_from: $project->load_from ?? '')); ?>" alt="<?php echo e($project->title ?? ''); ?>">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('assets/uploads/project/'.$firstImage)); ?>" class="img-fluid rounded-start" alt="<?php echo e($project->title ?? ''); ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="<?php echo e(($project->type ?? '') == 'job'?'col-md-12' : 'col-md-8'); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($project->title); ?></h5>
                                    <a class="btn btn-primary btn-sm" target="_blank" href="<?php echo e(route('project.details', ['username' => $project->username, 'slug' => $project->slug])); ?>"><?php echo e(__('View details')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <span class="chat-wrapper-details-inner-chat-contents-time mt-2" data-timestamp="<?php echo e($message->created_at->timestamp); ?>">
                    <?php echo e($message->created_at->diffForHumans()); ?>

                </span>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Users/ahmetsahin/Desktop/xilancer/core/Modules/Chat/Resources/views/components/client/message.blade.php ENDPATH**/ ?>