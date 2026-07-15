<?php

namespace App\Http\Controllers\Frontend\Freelancer;

use App\Events\AdminEvent;
use App\Helper\LogActivity;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\AdminNotification;
use App\Models\Project;
use App\Models\ProjectAttribute;
use App\Models\ProjectSubCategory;
use App\Models\ProjectHistory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\CurrencySwitcher\App\Models\SelectedCurrencyList;
use Modules\Service\Entities\SubCategory;

class ProjectController extends Controller
{
    // project create
    // project create
    public function create_project(Request $request)
    {
        if ($request->isMethod('post')) {

            if(moduleExists('SecurityManage')) {
                $combinedText = strtolower($request->project_title . ' ' . $request->project_description);

                $restrictedWords = \Modules\SecurityManage\Entities\Word::where('status', 'active')->pluck('word')->toArray();

                $matchedWords = array_filter($restrictedWords, function($word) use ($combinedText) {
                    return strpos($combinedText, strtolower($word)) !== false;
                });

                if (count($matchedWords) > 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => __('You cannot use restricted words: ') . implode(', ', $matchedWords)
                    ]);
                }
            }

            $slug_validation = moduleExists('CurrencySwitcher')
                ? 'required|max:191'
                : 'required|max:191|unique:projects,slug';

            $request->validate([
                'project_title' => 'required',
                'project_description' => 'required|min:50',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'neighborhood_id' => 'required',
                'slug' => $slug_validation,
                'images' => 'required|array|max:5',
                'images.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff,svg,webp,gif,avif,mp4,mov,avi,wmv,mkv|max:10240', // Added video mimes, increased max for videos
                'basic_title' => 'required|max:191',
                'basic_regular_charge' => 'required|numeric|integer',
                'basic_discount_charge' => 'nullable|numeric|integer|lte:basic_regular_charge',
                'standard_regular_charge' => 'nullable|numeric|integer',
                'standard_discount_charge' => 'nullable|numeric|integer|lte:standard_regular_charge',
                'premium_regular_charge' => 'nullable|numeric|integer',
                'premium_discount_charge' => 'nullable|numeric|integer|lte:premium_regular_charge',
                'checkbox_or_numeric_title' => 'nullable|array|max:191',
                'meta_title' => 'nullable|max:255',
                'meta_description' => 'nullable|max:500',
            ]);

            if ($request->hasFile('images')) {
                $request->validate([
                    'images' => 'required|array|max:5',
                    'images.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff,svg,webp,gif,avif,mp4,mov,avi,wmv,mkv|max:10240', // Added video mimes
                ]);
            }

            if (get_static_option('project_auto_approval') == 'yes') {
                $project_auto_approval = 1;
                $project_approve_request = 1;
            } else {
                $project_auto_approval = 0;
                $project_approve_request = 0;
            }

            $standard_title = null;
            $premium_title = null;
            $standard_regular_charge = null;
            $standard_discount_charge = null;
            $premium_regular_charge = null;
            $premium_discount_charge = null;

            if ($request->offer_packages_available_or_not == 1) {
                $standard_title = $request->standard_title;
                $premium_title = $request->premium_title;
                $standard_regular_charge = $request->standard_regular_charge;
                $standard_discount_charge = $request->standard_discount_charge;
                $premium_regular_charge = $request->premium_regular_charge;
                $premium_discount_charge = $request->premium_discount_charge;
            }

            $basic_regular_charge = null;
            $basic_discount_charge = null;
            $user_id  = Auth::guard('web')->user()->id;
            $slug = !empty($request->slug) ? $request->slug : $request->project_title;

            if (moduleExists('CurrencySwitcher')) {
                $slug = $this->generateUniqueSlug($request->slug ?? $request->project_title);
                $get_user_currency = SelectedCurrencyList::where('currency', get_currency_according_to_user())->first() ?? null;
                if (!empty($get_user_currency)) {
                    $basic_regular_charge = $request->basic_regular_charge / $get_user_currency->conversion_rate;
                    $basic_discount_charge = $request->basic_discount_charge / $get_user_currency->conversion_rate;
                    $standard_regular_charge = $request->standard_regular_charge / $get_user_currency->conversion_rate;
                    $standard_discount_charge = $request->standard_discount_charge / $get_user_currency->conversion_rate;
                    $premium_regular_charge = $request->premium_regular_charge / $get_user_currency->conversion_rate;
                    $premium_discount_charge = $request->premium_discount_charge / $get_user_currency->conversion_rate;
                }
            }

            DB::beginTransaction();
            try {
                $imageNames = [];
                $upload_folder = 'project';
                $storage_driver = Storage::getDefaultDriver();
                if ($request->hasFile('images')) {
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif'];
                    foreach ($request->file('images') as $file) { // Changed $image to $file for clarity
                        $extension = strtolower($file->getClientOriginalExtension());
                        $fileName = time() . '-' . uniqid() . '.' . $extension;
                        if (in_array($extension, $imageExtensions)) {
                            // Handle image: resize
                            $resize_full_image = Image::make($file)->resize(750, 410);
                            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                                add_frontend_cloud_image_if_module_exists($upload_folder, $file, $fileName, 'public');
                            } else {
                                $resize_full_image->save('assets/uploads/project/' . $fileName);
                            }
                        } else {
                            // Handle video: no resize, direct upload
                            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                                add_frontend_cloud_image_if_module_exists($upload_folder, $file, $fileName, 'public');
                            } else {
                                $file->move('assets/uploads/project/', $fileName);
                            }
                        }
                        $imageNames[] = $fileName;
                    }
                }

                $project = Project::create([
                    'user_id' => $user_id,
                    'category_id' => $request->category,
                    'title' => $request->project_title,
                    'slug' => Str::slug(purify_html($slug), '-', null),
                    'description' => $request->project_description,
                    'image' => $imageNames, // CHANGED: No json_encode() needed - Laravel cast handles it
                    'basic_title' => $request->basic_title,
                    'standard_title' => $standard_title,
                    'premium_title' => $premium_title,
                    'basic_revision' => $request->basic_revision,
                    'standard_revision' => $request->standard_revision,
                    'premium_revision' => $request->premium_revision,
                    'basic_delivery' => $request->basic_delivery,
                    'standard_delivery' => $request->standard_delivery,
                    'premium_delivery' => $request->premium_delivery,
                    'basic_regular_charge' => $basic_regular_charge ?? $request->basic_regular_charge,
                    'basic_discount_charge' => $basic_discount_charge ?? $request->basic_discount_charge,
                    'standard_regular_charge' => $standard_regular_charge,
                    'standard_discount_charge' => $standard_discount_charge,
                    'premium_regular_charge' => $premium_regular_charge,
                    'premium_discount_charge' => $premium_discount_charge,
                    'project_on_off' => 1,
                    'status' => $project_auto_approval,
                    'project_approve_request' => $project_approve_request,
                    'offer_packages_available_or_not' => $request->offer_packages_available_or_not,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'neighborhood_id' => $request->neighborhood_id,
                    // Fiyatlandırma tipi ilk alt kategoriden miras alınır (mobil API paritesi).
                    'pricing_type' => \Modules\Service\Entities\SubCategory::whereIn('id', (array) $request->subcategory)
                        ->value('pricing_type') ?? \App\Enums\PricingType::FIXED,
                    'load_from' => in_array($storage_driver, ['CustomUploader']) ? 0 : 1, //added for cloud storage 0=local 1=cloud
                ]);
                $project->project_sub_categories()->attach($request->subcategory);

                $arr = [];
                if (!empty($request->checkbox_or_numeric_title)) {
                    foreach ($request->checkbox_or_numeric_title as $key => $attr):
                        $attr_value = preg_replace('/[^a-z0-9_]/', '_', strtolower($attr));
                        $field_type = $request->checkbox_or_numeric_select[$key] ?? 'checkbox';

                    switch ($field_type) {
                        case 'checkbox':
                            $fallback_value = "off";
                            break;
                        case 'numeric':
                            $fallback_value = 0;
                            break;
                        case 'text':
                            $fallback_value = "";
                            break;
                        default:
                            $fallback_value = "off";
                    }

                    $basic_price = $request->$attr_value["basic_price"] ?? null;
                    $standard_price = $request->$attr_value["standard_price"] ?? null;
                    $premium_price = $request->$attr_value["premium_price"] ?? null;
                    $is_paid = ($basic_price || $standard_price || $premium_price) ? 1 : 0;


                    $arr[] = [
                        'user_id' => $user_id,
                        'create_project_id' => $project->id,
                        'check_numeric_title' => $attr,
                        'basic_check_numeric' => $request->$attr_value["basic"] ?? $fallback_value,
                        'standard_check_numeric' => $request->$attr_value["standard"] ?? $fallback_value,
                        'premium_check_numeric' => $request->$attr_value["premium"] ?? $fallback_value,
                        'basic_extra_price' => $basic_price,
                        'standard_extra_price' => $standard_price,
                        'premium_extra_price' => $premium_price,
                        'is_paid' => $is_paid,
                        'type' => $request->checkbox_or_numeric_select[$key] ?? null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    endforeach;
                }

                $data = Validator::make($arr, ["*.basic_check_numeric" => "nullable"]);
                $data->validated();

                ProjectAttribute::insert($arr);

                // generate meta
                $metaData = $this->generateProjectMetaData($request, $imageNames[0] ?? null);
                $project->metaData()->create($metaData);

                //security manage
                if (moduleExists('SecurityManage')) {
                    LogActivity::addToLog('Project create', 'Freelancer');
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();

                if ($request->hasFile('images')) {
                    foreach ($imageNames as $fileName) { // Changed $imgName to $fileName
                        $delete_path = 'assets/uploads/project/' . $fileName;
                        File::delete($delete_path);
                    }
                }
                toastr_error((config('app.debug') ? "DB Hata (Line " . $e->getLine() . "): " . $e->getMessage() : __('Basic check numeric field is required')));
                \Log::error("Project Create Exception: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine());
                return back();
            }

            try {
                $message = get_static_option('project_create_email_message') ?? __('A new project is just created.');
                $message = str_replace(["@project_title"], [$project->title], $message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('project_create_email_subject') ?? __('Project Create Email'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
            }

            //create project notification to admin
            AdminNotification::create([
                'identity' => $project->id,
                'user_id' => $user_id,
                'type' => 'Create Project',
                'message' => __('A new project has been created'),
            ]);
            event(new AdminEvent(__('A project has been created.')));
            toastr_success(__('Project Successfully Created'));
            return redirect()->route('freelancer.profile.details', Auth::guard('web')->user()->username);
        }

        return view('frontend.user.freelancer.project.create.create-project');
    }

    // project edit
    public function edit_project(Request $request, $id)
    {
        $project_details = Project::with('project_attributes')
            ->where('user_id', Auth::guard('web')->user()->id)
            ->where('id', $id)->first();
        $get_sub_categories_from_project_category = SubCategory::where('category_id', $project_details->category_id)->get() ?? '';

        if ($request->isMethod('post')) {

            // **ADDED: Prevent restricted words check**
            if(moduleExists('SecurityManage')) {
                $combinedText = strtolower($request->project_title . ' ' . $request->project_description);

                $restrictedWords = \Modules\SecurityManage\Entities\Word::where('status', 'active')->pluck('word')->toArray();

                $matchedWords = array_filter($restrictedWords, function($word) use ($combinedText) {
                    return strpos($combinedText, strtolower($word)) !== false;
                });

                if (count($matchedWords) > 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => __('You cannot use restricted words: ') . implode(', ', $matchedWords)
                    ]);
                }
            }
            // **END OF ADDITION**

            $slug_validation = moduleExists('CurrencySwitcher')
                ? 'required|max:191'
                : 'required|max:191|unique:projects,slug,' . $id;

            $regular_charge_validation = moduleExists('CurrencySwitcher')
                ? 'required|numeric'
                : 'required|numeric|integer';

            $request->validate([
                'project_title' => 'required|unique:projects,title,' . $id,
                'project_description' => 'required|min:50',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'neighborhood_id' => 'required',
                'slug' => $slug_validation,
                'basic_title' => 'required|max:191',
                'basic_regular_charge' => $regular_charge_validation,
                'basic_discount_charge' => 'nullable|numeric|lte:basic_regular_charge',
                'standard_regular_charge' => 'nullable|numeric',
                'standard_discount_charge' => 'nullable|numeric|lte:standard_regular_charge',
                'premium_regular_charge' => 'nullable|numeric',
                'premium_discount_charge' => 'nullable|numeric|lte:premium_regular_charge',
                'checkbox_or_numeric_title' => 'nullable|array|max:191',
                'meta_title' => 'nullable|max:255',
                'meta_description' => 'nullable|max:500',
            ]);

            if ($request->hasFile('images')) {
                $request->validate([
                    'images' => 'nullable|array|max:5',
                    'images.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff,svg,webp,gif,avif,mp4,mov,avi,wmv,mkv|max:10240', // Added video mimes
                ]);
            }

            // Handle removed images
            $removed_images = [];
            if ($request->has('removed_images') && !empty($request->removed_images)) {
                $removed_images = json_decode($request->removed_images, true) ?? [];
            }

            // Get existing media - Laravel cast makes it an array automatically
            $old_media = $project_details->image ?? [];
            if (is_string($old_media)) {
                // Fallback in case it's still a string
                $decoded = json_decode($old_media, true);
                $old_media = (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                    ? $decoded
                    : (empty($old_media) ? [] : [$old_media]);
            }

            if ($request->has('keep_existing') && $request->keep_existing == '1') {
                // Remove the media marked for deletion
                $old_media = array_diff($old_media, $removed_images);
                $old_media = array_values($old_media); // Re-index array
            }

            $standard_title = null;
            $premium_title = null;
            $standard_regular_charge = null;
            $standard_discount_charge = null;
            $premium_regular_charge = null;
            $premium_discount_charge = null;
            $basic_regular_charge = null;
            $basic_discount_charge = null;

            if ($request->offer_packages_available_or_not == 1) {
                $standard_title = $request->standard_title;
                $premium_title = $request->premium_title;
                $standard_regular_charge = $request->standard_regular_charge;
                $standard_discount_charge = $request->standard_discount_charge;
                $premium_regular_charge = $request->premium_regular_charge;
                $premium_discount_charge = $request->premium_discount_charge;
            }

            $user_id  = Auth::guard('web')->user()->id;
            $slug = !empty($request->slug) ? $request->slug : $request->project_title;

            if (moduleExists('CurrencySwitcher')) {
                $slug = $this->generateUniqueSlug($request->slug ?? $request->project_title);
                $get_user_currency = SelectedCurrencyList::where('currency', get_currency_according_to_user())->first() ?? null;
                if (!empty($get_user_currency)) {
                    $basic_regular_charge = $request->basic_regular_charge / $get_user_currency->conversion_rate;
                    $basic_discount_charge = $request->basic_discount_charge / $get_user_currency->conversion_rate;
                    $standard_regular_charge = $request->standard_regular_charge / $get_user_currency->conversion_rate;
                    $standard_discount_charge = $request->standard_discount_charge / $get_user_currency->conversion_rate;
                    $premium_regular_charge = $request->premium_regular_charge / $get_user_currency->conversion_rate;
                    $premium_discount_charge = $request->premium_discount_charge / $get_user_currency->conversion_rate;
                }
            }

            DB::beginTransaction();
            try {
                $fileNames = $old_media; // Start with existing media (changed var name)
                $upload_folder = 'project';
                if ($request->hasFile('images')) {
                    // If keep_existing is not set, delete ALL old images (REPLACE mode)
                    if (!$request->has('keep_existing') || $request->keep_existing != '1') {
                        // Delete all old media from cloud or local storage
                        if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                            foreach ($old_media as $oldFile) {
                                delete_frontend_cloud_image_if_module_exists('project/' . $oldFile);
                            }
                        } else {
                            foreach ($old_media as $oldFile) {
                                $delete_old_path = 'assets/uploads/project/' . $oldFile;
                                if (file_exists($delete_old_path)) {
                                    File::delete($delete_old_path);
                                }
                            }
                        }
                        $fileNames = []; // Clear existing media array
                    } else {
                        // Keep existing mode - Delete only the media marked for removal
                        // First remove from array
                        $fileNames = array_diff($fileNames, $removed_images);
                        $fileNames = array_values($fileNames); // Re-index
                        // Then delete files
                        if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                            foreach ($removed_images as $removedFile) {
                                delete_frontend_cloud_image_if_module_exists('project/' . $removedFile);
                            }
                        } else {
                            foreach ($removed_images as $removedFile) {
                                $delete_path = 'assets/uploads/project/' . $removedFile;
                                if (file_exists($delete_path)) {
                                    File::delete($delete_path);
                                }
                            }
                        }
                    }
                       // Upload new media
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif'];
                    foreach ($request->file('images') as $file) {
                        // Check if we haven't exceeded the 5 image limit
                        if (count($fileNames) >= 5) {
                            break;
                        }

                        $extension = strtolower($file->getClientOriginalExtension());
                        $fileName = time() . '-' . uniqid() . '.' . $extension;
                        if (in_array($extension, $imageExtensions)) {
                            // Handle image: resize
                            $resize_full_image = Image::make($file)->resize(750, 410);
                            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                                add_frontend_cloud_image_if_module_exists($upload_folder, $file, $fileName, 'public');
                            } else {
                                $resize_full_image->save('assets/uploads/project/' . $fileName);
                            }
                        } else {
                            // Handle video: no resize
                            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                                add_frontend_cloud_image_if_module_exists($upload_folder, $file, $fileName, 'public');
                            } else {
                                $file->move('assets/uploads/project/', $fileName);
                            }
                        }
                        $fileNames[] = $fileName; // Add to array
                    }
                } else {
                    // No new images uploaded, but handle removed images
                    if (!empty($removed_images)) {
                        // Remove from array
                        $fileNames = array_diff($fileNames, $removed_images);
                        $fileNames = array_values($fileNames); // Re-index

                        // Delete files
                        if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                            foreach ($removed_images as $removedImage) {
                                delete_frontend_cloud_image_if_module_exists('project/' . $removedImage);
                            }
                        } else {
                            foreach ($removed_images as $removedImage) {
                                $delete_img = 'assets/uploads/project/' . $removedImage;
                                if (file_exists($delete_img)) {
                                    File::delete($delete_img);
                                }
                            }
                        }
                    }
                }

                // Ensure we don't exceed 5 images total
                if (count($fileNames) > 5) {
                    $fileNames = array_slice($fileNames, 0, 5);
                }

                // Ensure imageNames is not empty
                if (empty($fileNames)) {
                    DB::rollBack();
                    toastr_error(__('At least one media file is required'));
                    return back();
                }

                Project::where('id', $id)->update([
                    'user_id' => $user_id,
                    'category_id' => $request->category,
                    'title' => $request->project_title,
                    'slug' => Str::slug(purify_html($slug), '-', null),
                    'description' => $request->project_description,
                    'image' => $fileNames,
                    'basic_title' => $request->basic_title,
                    'standard_title' => $standard_title,
                    'premium_title' => $premium_title,
                    'basic_revision' => $request->basic_revision,
                    'standard_revision' => $request->standard_revision,
                    'premium_revision' => $request->premium_revision,
                    'basic_delivery' => $request->basic_delivery,
                    'standard_delivery' => $request->standard_delivery,
                    'premium_delivery' => $request->premium_delivery,
                    'basic_regular_charge' => $basic_regular_charge ?? $request->basic_regular_charge,
                    'basic_discount_charge' => $basic_discount_charge ?? $request->basic_discount_charge,
                    'standard_regular_charge' => $standard_regular_charge,
                    'standard_discount_charge' => $standard_discount_charge,
                    'premium_regular_charge' => $premium_regular_charge,
                    'premium_discount_charge' => $premium_discount_charge,
                    'project_on_off' => 1,
                    'project_approve_request' => $project_details->project_approve_request == 1 ? 1 : 0,
                    'status' => get_static_option('project_auto_approval') == 'yes' ? 1 : 0,
                    'offer_packages_available_or_not' => $request->offer_packages_available_or_not ?? 0,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'neighborhood_id' => $request->neighborhood_id,
                    // Fiyatlandırma tipi ilk alt kategoriden miras alınır (mobil API paritesi).
                    'pricing_type' => \Modules\Service\Entities\SubCategory::whereIn('id', (array) $request->subcategory)
                        ->value('pricing_type') ?? \App\Enums\PricingType::FIXED,
                ]);

                //update product pivot table data
                $project = Project::find($id);
                $project->project_sub_categories()->sync($request->subcategory);

                ProjectAttribute::where('create_project_id', $id)->delete();

                $arr = [];
                if (!empty($request->checkbox_or_numeric_title)) {
                    foreach ($request->checkbox_or_numeric_title as $key => $attr):
                        $attr_value = preg_replace('/[^a-z0-9_]/', '_', strtolower($attr));
                        $field_type = $request->checkbox_or_numeric_select[$key] ?? 'checkbox';

                    switch ($field_type) {
                        case 'checkbox':
                            $fallback_value = "off";
                            break;
                        case 'numeric':
                            $fallback_value = 0;
                            break;
                        case 'text':
                            $fallback_value = "";
                            break;
                        default:
                            $fallback_value = "off";
                    }

                    $basic_price = $request->$attr_value["basic_price"] ?? null;
                    $standard_price = $request->$attr_value["standard_price"] ?? null;
                    $premium_price = $request->$attr_value["premium_price"] ?? null;
                    $is_paid = ($basic_price || $standard_price || $premium_price) ? 1 : 0;

                    $arr[] = [
                        'user_id' => $user_id,
                        'create_project_id' => $id,
                        'check_numeric_title' => $attr,
                        'basic_check_numeric' => $request->$attr_value["basic"] ?? $fallback_value,
                        'standard_check_numeric' => $request->$attr_value["standard"] ?? $fallback_value,
                        'premium_check_numeric' => $request->$attr_value["premium"] ?? $fallback_value,
                        'basic_extra_price' => $basic_price,
                        'standard_extra_price' => $standard_price,
                        'premium_extra_price' => $premium_price,
                        'is_paid' => $is_paid,
                        'type' => $request->checkbox_or_numeric_select[$key] ?? null,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    endforeach;
                }

                $data = Validator::make($arr, ["*.basic_check_numeric" => "nullable"]);
                $data->validated();

                ProjectAttribute::insert($arr);

                // generate meta - pass the first image
                $firstImage = !empty($fileNames) ? $fileNames[0] : null;
                $metaData = $this->generateProjectMetaData($request, $firstImage);
                $project->metaData()->updateOrCreate([], $metaData);

                $project_id_from_project_history_table = ProjectHistory::where('project_id', $id)->first();

                if (empty($project_id_from_project_history_table)) {
                    ProjectHistory::Create([
                        'project_id' => $project->id,
                        'user_id' => $project->user_id,
                        'reject_count' => 0,
                        'edit_count' => 1,
                    ]);
                } else {
                    ProjectHistory::where('project_id', $id)->update([
                        'edit_count' => $project_id_from_project_history_table->edit_count + 1
                    ]);
                }

                //security manage
                if (moduleExists('SecurityManage')) {
                    LogActivity::addToLog('Project edit', 'Freelancer');
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                if ($request->hasFile('images')) {
                    foreach ($fileNames as $fileName) { // Exclude existing, only delete new uploads on error
                        if (!in_array($fileName, $old_media)) {
                             $delete_path = 'assets/uploads/project/' . $fileName;
                             File::delete($delete_path);
                         }
                     }
                }
                toastr_error((config('app.debug') ? "DB Hata (Line " . $e->getLine() . "): " . $e->getMessage() : __('Basic check numeric field is required')));
                \Log::error("Project Edit Exception: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine());
                return back();
            }

            try {
                $message = get_static_option('project_edit_email_message') ?? __('A new project is just edited.');
                $message = str_replace(["@project_title"], [$project->title], $message);
                Mail::to(get_static_option('site_global_email'))->send(new BasicMail([
                    'subject' => get_static_option('project_edit_email_subject') ?? __('Project Edit Email'),
                    'message' => $message
                ]));
            } catch (\Exception $e) {
            }

            //edit project notification to admin
            AdminNotification::create([
                'identity' => $id,
                'user_id' => $user_id,
                'type' => 'Edit Project',
                'message' => __('A project has been edited.'),
            ]);
            event(new AdminEvent(__('A project has been edited.')));

            toastr_success(__('Project Successfully Updated'));
            return redirect()->route('freelancer.profile.details', Auth::guard('web')->user()->username);
        }

        return view('frontend.user.freelancer.project.edit.edit-project', compact('project_details', 'get_sub_categories_from_project_category'));
    }

    // project preview
    public function project_preview()
    {
        $all_projects = Project::with('project_attributes')->where('user_id', Auth::guard('web')->user()->id)->latest()->get();
        return view('frontend.user.freelancer.project.preview.all-projects', compact('all_projects'));
    }

    // project description

    public function project_description(Request $request)
    {
        if ($request->ajax()) {
            $project_title_and_description = Project::select(['title', 'description'])->where('id', $request->project_id)->first();
            return view('frontend.user.freelancer.project.preview.project-description', compact('project_title_and_description'))->render();
        }
    }

    // project delete
    public function delete_project(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        ProjectAttribute::where('create_project_id', $project->id)->delete();
        ProjectHistory::where('project_id', $project->id)->delete();
        $project->delete();
        return response()->json(['status' => 'success']);
    }


    private function generateUniqueSlug($slug, $project_id = null)
    {
        $counter = 1;
        $existingSlugs = Project::where('slug', 'like', $slug . '%')
            ->where('id', '!=', $project_id)
            ->pluck('slug')
            ->toArray();

        if (empty($existingSlugs)) {
            return $slug;
        }

        $newSlug = $slug;
        while (in_array($newSlug, $existingSlugs)) {
            $newSlug = $slug . '-' . $counter;
            $counter++;
        }

        return $newSlug;
    }

    /**
     * Generate meta data
     */
    private function generateProjectMetaData(Request $request, ?string $imageName = null): array
    {
        // Meta title
        $meta_title = $request->meta_title ?? $request->project_title;
        $meta_title = strlen($meta_title) > 60 ? substr($meta_title, 0, 57) . '...' : $meta_title;

        // Meta description
        $meta_description = $request->meta_description ?? $request->project_description;
        $meta_description = strlen($meta_description) > 160
            ? substr(strip_tags($meta_description), 0, 157) . '...'
            : strip_tags($meta_description);

        // Keywords from title
        $title_words = explode(' ', strtolower($request->project_title));
        $keywords = collect($title_words)
            ->filter(function ($word) {
                $stopWords = [
                    'a',
                    'an',
                    'and',
                    'are',
                    'as',
                    'at',
                    'be',
                    'by',
                    'for',
                    'from',
                    'has',
                    'he',
                    'in',
                    'is',
                    'it',
                    'its',
                    'of',
                    'on',
                    'that',
                    'the',
                    'to',
                    'was',
                    'will',
                    'with',
                    'have',
                    'had',
                    'would',
                    'could',
                    'should',
                    'may',
                    'can',
                    'this',
                    'these',
                    'those',
                    'they',
                    'them',
                    'their',
                    'there',
                    'here',
                    'when',
                    'where',
                    'why',
                    'how',
                    'what',
                    'who',
                    'which',
                    'do',
                    'does',
                    'did',
                    'get',
                    'got',
                    'make',
                    'made',
                    'take',
                    'took',
                    'come',
                    'came',
                    'go',
                    'went',
                    'see',
                    'saw',
                    'know',
                    'knew',
                    'think',
                    'thought'
                ];
                return strlen(trim($word)) > 2 && !in_array(trim($word), $stopWords);
            })
            ->map(fn($word) => trim($word))
            ->unique()
            ->take(10)
            ->implode(', ');

        if (is_string($imageName)) {
            $mediaArray = json_decode($imageName, true);
        } elseif (is_array($imageName)) {
            $mediaArray = $imageName;
        } else {
            $mediaArray = null;
        }
          // Find first image (skip videos)
        $imageExtensions = ['jpg', 'jpeg', 'png', 'bmp', 'tiff', 'svg', 'webp', 'gif', 'avif'];
        $firstImage = null;
        if (is_array($mediaArray) && !empty($mediaArray)) {
            foreach ($mediaArray as $file) {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), $imageExtensions)) {
                    $firstImage = $file;
                    break;
                }
            }
        }
        $firstImage = $firstImage ?? null; // Fallback to null if no image
        $image_url = $firstImage
            ? asset('assets/uploads/project/' . $firstImage)
            : null;

        return [
            'meta_title' => purify_html($meta_title),
            'meta_description' => purify_html($meta_description),
            'meta_tags' => purify_html($keywords),

            'facebook_meta_tags' => purify_html($keywords),
            'facebook_meta_description' => purify_html($meta_description),
            'facebook_meta_image' => $image_url,

            'twitter_meta_tags' => purify_html($keywords),
            'twitter_meta_description' => purify_html($meta_description),
            'twitter_meta_image' => $image_url,
        ];
    }
}
