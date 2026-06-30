<?php

namespace Modules\Service\Entities;

use App\Models\Skill;
use App\Models\JobPost;
use App\Models\Project;
use App\Models\UserWork;
use Modules\Blog\Entities\BlogPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'short_description', 'slug', 'meta_title', 'meta_description', 'status', 'image', 'selected_category'];
    protected $casts = ['status' => 'integer'];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\CategoryFactory::new();
    }

    public static function all_categories($type = null)
    {
        $query = self::select(['id', 'category', 'short_description', 'status', 'image'])->where('status', 1);

        // Check if hide empty categories setting is enabled AND type is specified
        if (get_static_option('hide_empty_categories') == 'on' && !is_null($type)) {
            if ($type == 'project') {
                $query->whereHas('projects', function ($projectQuery) {
                    $projectQuery->where('project_on_off', '1')
                        ->where('project_approve_request', 1)
                        ->where('status', '1');
                });
            } elseif ($type == 'job') {
                $query->whereHas('jobs', function ($jobQuery) {
                    $jobQuery->where('on_off', '1')->where('status', '1');
                });
            } elseif ($type == 'talent') {
                $query->whereHas('user_works');
            }
        }

        return $query->get();
    }

    public function skills()
    {
        return $this->hasMany(Skill::class, 'category_id');
    }

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')->select(['id', 'category_id', 'sub_category', 'slug', 'image', 'pricing_type'])->where('status', '1');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id', 'id')->select(['id', 'category_id', 'slug'])->where(['project_on_off' => '1', 'project_approve_request' => 1, 'status' => '1']);
    }

    public function jobs()
    {
        if (moduleExists('FakeDataGenerator')) {
            return $this->hasMany(JobPost::class, 'category', 'id')->select(['id', 'category', 'slug', 'is_fake'])->where(['on_off' => '1', 'status' => '1']);
        }

        return $this->hasMany(JobPost::class, 'category', 'id')->select(['id', 'category', 'slug'])->where(['on_off' => '1', 'status' => '1']);
    }

    public function blogs()
    {
        return $this->hasMany(BlogPost::class, 'category_id', 'id');
    }

    public function user_works()
    {
        return $this->hasMany(UserWork::class, 'category_id', 'id')
            ->whereHas('user', function ($query) {
                $query->where('user_type', '2')
                    ->where('is_email_verified', 1)
                    ->where('is_suspend', 0)
                    ->where('user_active_inactive_status', 1)
                    ->where('check_work_availability', 1);
            });
    }
}
