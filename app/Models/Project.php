<?php

namespace App\Models;

use Modules\Pages\Entities\MetaData;
use Modules\Service\Entities\Category;
use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'basic_title',
        'standard_title',
        'premium_title',
        'basic_revision',
        'standard_revision',
        'premium_revision',
        'basic_delivery',
        'standard_delivery',
        'premium_delivery',
        'basic_regular_charge',
        'basic_discount_charge',
        'standard_regular_charge',
        'standard_discount_charge',
        'premium_regular_charge',
        'premium_discount_charge',
        'project_on_off',
        'project_approve_request',
        'status',
        'offer_packages_available_or_not',
        'is_pro',
        'pro_expire_date',
        'meta_title',
        'meta_description',
        'meta_tags',
        'load_from',
        'is_synced',
        'is_fake',
        'country_id',
        'state_id',
        'city_id',
        'neighborhood_id',
        'video_url',
        'is_emergency'
    ];

    protected $casts = [
        'status' => 'integer',
        'project_approve_request' => 'integer',
        'is_emergency' => 'integer',
        'image' => 'array'
    ];

    protected $appends = [
        'is_pro_project',
        'media',
        'images',
        'first_image',
    ];

    public function project_attributes()
    {
        return $this->hasMany(ProjectAttribute::class, 'create_project_id', 'id');
    }

    public function project_creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('is_suspend', 0);
    }

    public function project_history()
    {
        return $this->hasOne(ProjectHistory::class, 'project_id', 'id');
    }

    public function project_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function project_sub_categories()
    {
        return $this->belongsToMany(SubCategory::class, 'project_sub_categories')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'identity', 'id');
    }

    public function complete_orders()
    {
        return $this->hasMany(Order::class, 'identity', 'id')->where('status', 3)->where('is_project_job', 'project');
    }

    public function ratings()
    {
        return $this->hasManyThrough(Rating::class, Order::class, "identity", "order_id", "id", "id")
            ->where("is_project_job", "project")->where('sender_type', 1);
    }

    public function metaData()
    {
        return $this->morphOne(MetaData::class, 'meta_taggable');
    }

    public function getIsProProjectAttribute()
    {
        return $this->is_pro === 'yes' && $this->pro_expire_date && $this->pro_expire_date > now();
    }

    /**
     * All media (images + videos)
     */
    public function getMediaAttribute(): array
    {
        $rawImage = $this->getRawOriginal('image');
        
        if (empty($rawImage)) {
            return [];
        }

        // If it's a JSON string, decode it
        if (is_string($rawImage)) {
            $decoded = json_decode($rawImage, true);
            return is_array($decoded) ? $decoded : [$rawImage];
        }

        // If it's already an array, return it
        if (is_array($rawImage)) {
            return $rawImage;
        }

        return [];
    }

    /**
     * All images (alias for media, for backward compatibility)
     */
    public function getImagesAttribute(): array
    {
        $media = $this->media;
        
        // Filter out videos, return only images
        return array_values(array_filter($media, function($file) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
            return in_array($extension, $imageExtensions);
        }));
    }

    /**
     * First image (for meta / cards) - skips videos
     */
    public function getFirstImageAttribute(): ?string
    {
        $images = $this->images;
        return !empty($images) ? $images[0] : null;
    }

    public function country()
    {
        return $this->belongsTo(\Modules\CountryManage\Entities\Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(\Modules\CountryManage\Entities\State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(\Modules\CountryManage\Entities\City::class, 'city_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(\Modules\CountryManage\Entities\Neighborhood::class, 'neighborhood_id');
    }

    public function service_areas()
    {
        return $this->hasMany(ProjectServiceArea::class, 'project_id', 'id');
    }
}
