<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'middleware' => 'setlang'], function () {
    Route::get('app-status', [\App\Http\Controllers\Api\AppStatusController::class, 'getStatus']);

    //freelancer route start
    Route::group(['prefix' => 'freelancer'], function () {

        // user registration
        Route::controller(\App\Http\Controllers\Api\Freelancer\RegisterController::class)->group(function () {
            Route::post('register', 'register');
            Route::post('resend-otp', 'resend_otp');
            Route::post('email-verify', 'email_verify');
        });

        // forget password
        Route::controller(\App\Http\Controllers\Api\Freelancer\ForgetPasswordController::class)->group(function () {
            Route::post('forget-password', 'forget_password');
            Route::post('confirm-email-by-otp', 'confirm_email_by_otp');
            Route::post('reset-password', 'reset_password');
        });

        // user login
        Route::controller(\App\Http\Controllers\Api\Freelancer\LoginController::class)->group(function () {
            Route::post('login', 'login');
        });

        //category manage
        Route::controller(\App\Http\Controllers\Api\Freelancer\CategoryManageController::class)->group(function () {
            Route::get('category/all', 'category');
            Route::get('category/with-projects', 'categoriesWithProjects');
        });

        //language
        Route::controller(\App\Http\Controllers\Api\Freelancer\LanguageController::class)->group(function () {
            Route::get('language/all', 'all_language');
            Route::post('language/string-translate', 'string_translate');
        });

        //job info
        Route::controller(\App\Http\Controllers\Api\Freelancer\JobController::class)->group(function () {
            Route::get('job/details/{id?}', 'job_details');
            Route::post('job/filter', 'jobs_filter');
        });

        //front subscription list
        Route::controller(\App\Http\Controllers\Api\Freelancer\SubscriptionController::class)->group(function () {
            Route::get('subscription/types', 'types');
            Route::post('subscription/list', 'all_front_subscription');
        });

        //social login
        Route::controller(\App\Http\Controllers\Api\Freelancer\SocialLoginController::class)->group(function () {
            Route::post('social/login', 'social_login');
        });

        //iyzico public web callback for 3DS
        Route::controller(\App\Http\Controllers\Api\Freelancer\IyzicoCallbackController::class)->group(function () {
            Route::post('iyzico/3ds-callback-web', 'handle3dsCallbackWeb');
            Route::get('iyzico/3ds-callback-web/result', function() { return "Processing payment..."; });
        });

        //authenticated api
        Route::group(['middleware' => 'auth:sanctum'], function () {

            //logout
            Route::controller(\App\Http\Controllers\Api\Freelancer\LoginController::class)->group(function () {
                Route::post('logout', 'logout');
            });
            //country manage
            Route::controller(\App\Http\Controllers\Api\Freelancer\CountryManageController::class)->group(function () {
                Route::get('country/all', 'country');
                Route::post('state/all', 'state');
                Route::post('city/all', 'city');
            });
            //module list info
            Route::controller(\App\Http\Controllers\Api\Freelancer\ModuleListController::class)->group(function () {
                Route::get('module/module-status', 'module_list');
            });
            //personal info
            Route::controller(\App\Http\Controllers\Api\Freelancer\PersonalInfoController::class)->group(function () {
                Route::get('personal/info', 'personal_info');
                Route::post('personal/info/update', 'personal_info_update');
                Route::post('profile/image/update', 'profile_image_update');
                Route::post('profile/password/update', 'change_password');
                Route::get('profile/details', 'profile_details');
                Route::post('account/delete', 'account_delete');
                Route::post('update/token', 'update_firebase_token');
            });
            //projects
            Route::controller(\App\Http\Controllers\Api\Freelancer\ProjectController::class)->group(function () {
                Route::get('project/list', 'project_list');
                Route::post('project/create', 'create_project');
                Route::get('project/details/{id}', 'project_details');
                Route::post('project/update', 'update_project');
                Route::post('project/delete', 'delete_project');
                Route::post('project/availability', 'availability_status');
                Route::post('project/user-work-availability-status', 'work_availability_status');
                Route::post('project/subscription-promote-toggle', 'toggle_subscription_promotion');
            });
            //portfolios
            Route::controller(\App\Http\Controllers\Api\Freelancer\PortfolioController::class)->group(function () {
                Route::get('portfolio/list', 'index');
                Route::post('portfolio/store', 'store');
                Route::post('portfolio/update/{id}', 'update');
                Route::post('portfolio/delete/{id}', 'destroy');
            });
            //order info
            Route::controller(\App\Http\Controllers\Api\Freelancer\OrderController::class)->group(function () {
                Route::get('order/all', 'all_order');
                Route::get('order/details/{id?}', 'order_details');
                Route::post('order/accept', 'order_accept');
                Route::post('order/decline', 'order_decline');
                Route::post('order/submit', 'order_submit');
            });
            //job info
            Route::controller(\App\Http\Controllers\Api\Freelancer\JobController::class)->group(function () {
                Route::get('job/all', 'all_job');
                Route::get('job/my-proposals', 'my_proposal');
                Route::get('job/my-offers', 'my_offer');
                Route::post('job/proposal-send', 'job_proposal_send');
            });
            //support ticket
            Route::controller(\App\Http\Controllers\Api\Freelancer\TicketController::class)->group(function () {
                Route::get('department/all', 'all_department');
                Route::get('ticket/all', 'all_ticket');
                Route::get('ticket/single/all-message/{id?}', 'all_message');
                Route::post('ticket/create', 'create_ticket');
                Route::get('ticket/details/{id?}', 'ticket_details');
                Route::post('ticket/message-send', 'ticket_message_send');
            });
            //wallet
            Route::controller(\App\Http\Controllers\Api\Freelancer\WalletController::class)->group(function () {
                Route::get('wallet/history', 'wallet_history');
                Route::post('wallet/deposit', 'deposit');
                Route::post('wallet/deposit/update-payment', 'payment_update');
            });
            //withdraw
            Route::controller(\App\Http\Controllers\Api\Freelancer\WithdrawController::class)->group(function () {
                Route::get('withdraw/settings', 'withdraw_settings');
                Route::post('withdraw/request', 'withdraw_request');
                Route::get('withdraw/history', 'withdraw_history');
            });
            //notification
            Route::controller(\App\Http\Controllers\Api\Freelancer\NotificationController::class)->group(function () {
                Route::get('notification/unread', 'unread_notification');
                Route::get('notification/unread/count', 'unread_notification_count');
                Route::post('notification/read', 'read_notification');
            });
            Route::controller(\App\Http\Controllers\Api\Freelancer\PaymentListController::class)->group(function () {
                Route::get('gateway/list', 'gateway_list');
            });
            //subscription list
            Route::controller(\App\Http\Controllers\Api\Freelancer\SubscriptionController::class)->group(function () {
                Route::get('subscription/history/list', 'all_subscription');
                Route::post('subscription/buy', 'buy_subscription');
                Route::post('subscription/switch-to-free', 'switch_to_free');
                Route::post('subscription/validate-iap', 'validate_iap');
                Route::post('subscription/buy/update-payment', 'payment_update');
            });
            //promotion list
            Route::controller(\App\Http\Controllers\Api\Freelancer\BuyPromotePackageController::class)->group(function () {
                Route::get('promotion/package/list', 'package_list');
                Route::post('promotion/package/buy', 'buy_package');
                Route::post('promotion/package/update-payment', 'payment_update');
            });
            //live chat
            Route::controller(\Modules\Chat\Http\Controllers\Api\Freelancer\OfferController::class)->group(function () {
                Route::post('offer/send', 'offer_send');
                Route::get('offer/details/{id?}', 'offer_details');
            });
            //live chat
            Route::controller(\Modules\Chat\Http\Controllers\Api\Freelancer\ChatController::class)->group(function () {
                Route::get('chat/client-list', 'client_list');
                Route::get('chat/fetch-record/{live_chat_id?}', 'fetch_record');
                Route::post('chat/message-send', 'message_send');
                Route::get('chat/credentials', 'credentials');
                Route::get('chat/unseen-message/count', 'unseen_message_count');
            });
            //agora voice call
            Route::controller(\App\Http\Controllers\Api\AgoraController::class)->group(function () {
                Route::post('agora/token', 'generateToken');
                Route::post('agora/call/initiate', 'initiateCall');
                Route::post('agora/call/accept', 'acceptCall');
                Route::post('agora/call/end', 'endCall');
                Route::post('agora/call/decline', 'declineCall');
                Route::get('agora/call/history', 'callHistory');
            });

            // Iyzico Card Management
            Route::controller(\App\Http\Controllers\Api\Freelancer\IyzicoCardController::class)->group(function () {
                Route::get('iyzico/cards', 'listCards');
                Route::post('iyzico/card/save', 'saveCard');
                Route::post('iyzico/card/delete', 'deleteCard');
            });

            // Iyzico Callback Management
            Route::controller(\App\Http\Controllers\Api\Freelancer\IyzicoCallbackController::class)->group(function () {
                Route::post('iyzico/3ds-complete', 'handle3dsCallback');
            });

            // Emergency Service (Freelancer Side)
            Route::controller(\App\Http\Controllers\Api\Client\EmergencyController::class)->group(function () {
                Route::post('emergency/accept/{id}', 'accept');
                Route::get('emergency/pending', 'pendingForFreelancer');
                Route::get('emergency/accepted', 'acceptedForFreelancer');
            });

            // Reels (Freelancer Side)
            Route::controller(\App\Http\Controllers\Api\ReelController::class)->group(function () {
                Route::post('reels/store', 'store');
                Route::post('reels/delete/{id}', 'destroy');
            });
        });

        // Public Reels
        Route::get('reels', [\App\Http\Controllers\Api\ReelController::class, 'index']);
    });
    //freelancer route end

    //client route start
    Route::group(['prefix' => 'client'], function () {

        // user registration
        Route::controller(\App\Http\Controllers\Api\Client\RegisterController::class)->group(function () {
            Route::post('register', 'register');
            Route::post('resend-otp', 'resend_otp');
            Route::post('email-verify', 'email_verify');
        });
        // forget password
        Route::controller(\App\Http\Controllers\Api\Client\ForgetPasswordController::class)->group(function () {
            Route::post('forget-password', 'forget_password');
            Route::post('confirm-email-by-otp', 'confirm_email_by_otp');
            Route::post('reset-password', 'reset_password');
        });
        // user login
        Route::controller(\App\Http\Controllers\Api\Client\LoginController::class)->group(function () {
            Route::post('login', 'login');
        });
        //category manage
        Route::controller(\App\Http\Controllers\Api\Client\CategoryManageController::class)->group(function () {
            Route::get('category/all', 'category');
        });
        Route::controller(\App\Http\Controllers\Api\Client\JobController::class)->group(function () {
            Route::get('skill/all', 'skill');
        });
        //language
        Route::controller(\App\Http\Controllers\Api\Client\LanguageController::class)->group(function () {
            Route::get('language/all', 'all_language');
            Route::post('language/string-translate', 'string_translate');
        });

        //project info
        Route::controller(\App\Http\Controllers\Api\Client\ProjectWithFilterController::class)->group(function () {
            Route::get('projects/all', 'projects');
            //            Route::get('projects/all/pro', 'pro_projects')->name('pro.projects.all');
            Route::post('projects/all/filter', 'projects_filter');
            Route::get('project/details/{id?}', 'project_details');
        });

        // Price Estimator
        Route::controller(\App\Http\Controllers\Api\Client\PriceEstimatorController::class)->group(function () {
            Route::post('estimate-price', 'estimate');
        });

        // Work Stories
        Route::controller(\App\Http\Controllers\Api\Client\WorkStoryController::class)->group(function () {
            Route::get('work-stories', 'stories');
        });

        //profile details
        Route::controller(\App\Http\Controllers\Api\Client\ProfileDetailsController::class)->group(function () {
            Route::get('profile/details/{username?}', 'profile_details');
        });

        //country manage
        Route::controller(\App\Http\Controllers\Api\Client\CountryManageController::class)->group(function () {
            Route::get('country/all', 'country');
            Route::post('state/all', 'state');
            Route::post('city/all', 'city');
        });

        //iyzico public web callback for 3DS
        Route::controller(\App\Http\Controllers\Api\Client\IyzicoCallbackController::class)->group(function () {
            Route::post('iyzico/3ds-callback-web', 'handle3dsCallbackWeb');
            Route::get('iyzico/3ds-callback-web/result', function() { return "Processing payment..."; });
        });

        //authenticated api
        Route::group(['middleware' => 'auth:sanctum'], function () {

            //logout
            Route::controller(\App\Http\Controllers\Api\Client\LoginController::class)->group(function () {
                Route::post('logout', 'logout');
            });
            //personal info
            Route::controller(\App\Http\Controllers\Api\Client\PersonalInfoController::class)->group(function () {
                Route::get('personal/info', 'personal_info');
                Route::post('personal/info/update', 'personal_info_update');
                Route::post('profile/image/update', 'profile_image_update');
                Route::post('profile/password/update', 'change_password');
                Route::post('account/delete', 'account_delete');
                Route::post('update/token', 'update_firebase_token');
            });
            //payment gateway list info
            Route::controller(\App\Http\Controllers\Api\Client\PaymentGatewayListController::class)->group(function () {
                Route::get('payment/gateway-list', 'payment_gateway_list');
            });
            //module list info
            Route::controller(\App\Http\Controllers\Api\Client\ModuleListController::class)->group(function () {
                Route::get('module/module-status', 'module_list');
            });
            //order info
            Route::controller(\App\Http\Controllers\Api\Client\OrderController::class)->group(function () {
                Route::post('order/confirm-order', 'user_order_confirm');
                Route::post('order/payment-update', 'payment_update');
                Route::get('order/all', 'all_order');
                Route::get('order/details/{id?}', 'order_details');
                Route::post('order/request-revision/for/order/or/milestone', 'request_revision');
                Route::post('order/approve/milestone', 'order_milestone_approve');
                Route::post('order/rating', 'order_rating');
            });
            //job info
            Route::controller(\App\Http\Controllers\Api\Client\JobController::class)->group(function () {
                Route::post('job/create', 'job_create');
                Route::post('job/edit', 'job_edit');
                Route::get('job/all', 'all_job');
                Route::get('job/details/{id?}', 'job_details');
                Route::post('job/proposals/filter', 'job_proposal_filter');
                Route::post('job/proposal/add-to-shortlist', 'add_remove_shortlist');
                Route::post('job/proposal/reject', 'reject_proposal');
                Route::post('job/open/close', 'open_close');
            });
            //my offer
            Route::controller(\App\Http\Controllers\Api\Client\OfferController::class)->group(function (){
                Route::get('offer/all', 'all_offers');
                Route::get('offer/details/{id}', 'offer_details');
                Route::post('offer/reject', 'offer_reject');
            });
            //support ticket
            Route::controller(\App\Http\Controllers\Api\Client\TicketController::class)->group(function () {
                Route::get('department/all', 'all_department');
                Route::get('ticket/all', 'all_ticket');
                Route::get('ticket/single/all-message/{id?}', 'all_message');
                Route::post('ticket/create', 'create_ticket');
                Route::get('ticket/details/{id?}', 'ticket_details');
                Route::post('ticket/message-send', 'ticket_message_send');
            });
            //wallet
            Route::controller(\App\Http\Controllers\Api\Client\WalletController::class)->group(function () {
                Route::get('wallet/history', 'wallet_history');
                Route::post('wallet/deposit', 'deposit');
                Route::post('wallet/deposit/update-payment', 'payment_update');
            });
            //notification
            Route::controller(\App\Http\Controllers\Api\Client\NotificationController::class)->group(function () {
                Route::get('notification/unread', 'unread_notification');
                Route::get('notification/unread/count', 'unread_notification_count');
                Route::post('notification/read', 'read_notification');
            });
            //live chat
            Route::controller(\Modules\Chat\Http\Controllers\Api\Client\ChatController::class)->group(function () {
                Route::get('chat/freelancer-list', 'freelancer_list');
                Route::get('chat/fetch-record/{live_chat_id?}', 'fetch_record');
                Route::post('chat/message-send', 'message_send');
                Route::get('chat/credentials', 'credentials');
                Route::get('chat/unseen-message/count', 'unseen_message_count');
            });
            //agora voice call
            Route::controller(\App\Http\Controllers\Api\AgoraController::class)->group(function () {
                Route::post('agora/token', 'generateToken');
                Route::post('agora/call/initiate', 'initiateCall');
                Route::post('agora/call/accept', 'acceptCall');
                Route::post('agora/call/end', 'endCall');
                Route::post('agora/call/decline', 'declineCall');
                Route::get('agora/call/history', 'callHistory');
            });
            
            // Iyzico Card Management
            Route::controller(\App\Http\Controllers\Api\Client\IyzicoCardController::class)->group(function () {
                Route::get('iyzico/cards', 'listCards');
                Route::post('iyzico/card/save', 'saveCard');
                Route::post('iyzico/card/delete', 'deleteCard');
            });

            // Iyzico 3DS Callback (from client app)
            Route::controller(\App\Http\Controllers\Api\Client\IyzicoCallbackController::class)->group(function () {
                Route::post('iyzico/3ds-complete', 'handle3dsCallback');
            });

            // User Addresses
            Route::controller(\App\Http\Controllers\Api\Client\UserAddressController::class)->group(function () {
                Route::get('addresses', 'index');
                Route::post('addresses/store', 'store');
                Route::post('addresses/update/{id}', 'update');
                Route::post('addresses/delete/{id}', 'destroy');
                Route::post('addresses/make-default/{id}', 'make_default');
            });

            // Emergency Service (Client Side)
            Route::controller(\App\Http\Controllers\Api\Client\EmergencyController::class)->group(function () {
                Route::post('emergency/create', 'create');
                Route::get('emergency/status/{id}', 'status');
                Route::post('emergency/cancel/{id}', 'cancel');
                Route::post('emergency/complete/{id}', 'complete');
                Route::post('emergency/select-offer/{id}', 'selectOffer');
                Route::get('emergency/active', 'activeForClient');
            });
        });
    });
    //client route end

    // projects list api for test
    Route::controller(\App\Http\Controllers\Api\Client\ProjectController::class)->group(function () {
        Route::get('projects/list', 'project_list');
        Route::get('projects/popular', 'top_projects');
        Route::get('project-details/{slug}', 'project_details');
    });


    // freelancer api route for test
    Route::prefix('freelancers')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Api\Client\FreelancerApiController::class, 'index'])
            ->name('api.freelancers.index');
    });

    // mobile app banner
    Route::controller(\App\Http\Controllers\Api\Mobile\BannerController::class)->group(function () {
        Route::get('banner/all', 'all_banners');
    });
});
