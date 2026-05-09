<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::where('user_id', auth('sanctum')->user()->id)->latest()->get();
        return response()->json([
            'portfolios' => $portfolios,
            'portfolio_path' => asset('assets/uploads/portfolio/'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20480',
            'title' => 'required|string|min:5|max:191',
            'description' => 'required|string|min:10',
        ]);

        $imageName = '';
        if ($image = $request->file('image')) {
            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $resize_full_image = Image::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

            $upload_folder = 'portfolio';
            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                add_frontend_cloud_image_if_module_exists($upload_folder, $image, $imageName, 'public');
                $load_from = 1;
            } else {
                $resize_full_image->save('assets/uploads/portfolio/' . $imageName);
                $load_from = 0;
            }
        }

        $portfolio = Portfolio::create([
            'user_id' => auth('sanctum')->user()->id,
            'username' => auth('sanctum')->user()->username,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'load_from' => $load_from,
        ]);

        return response()->json([
            'msg' => __('Portfolio created successfully'),
            'portfolio' => $portfolio
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:191',
            'description' => 'required|string|min:10',
        ]);

        $portfolio = Portfolio::where('user_id', auth('sanctum')->user()->id)->findOrFail($id);

        if ($image = $request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20480',
            ]);

            // Delete old image
            if ($portfolio->load_from == 1) {
                delete_frontend_cloud_image_if_module_exists('portfolio/' . $portfolio->image);
            } else {
                if (file_exists('assets/uploads/portfolio/' . $portfolio->image)) {
                    @unlink('assets/uploads/portfolio/' . $portfolio->image);
                }
            }

            $imageName = time().'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $resize_full_image = Image::make($image)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

            if (cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi'])) {
                add_frontend_cloud_image_if_module_exists('portfolio', $image, $imageName, 'public');
                $portfolio->load_from = 1;
            } else {
                $resize_full_image->save('assets/uploads/portfolio/' . $imageName);
                $portfolio->load_from = 0;
            }
            $portfolio->image = $imageName;
        }

        $portfolio->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'msg' => __('Portfolio updated successfully'),
            'portfolio' => $portfolio
        ]);
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::where('user_id', auth('sanctum')->user()->id)->findOrFail($id);
        
        if ($portfolio->load_from == 1) {
            delete_frontend_cloud_image_if_module_exists('portfolio/' . $portfolio->image);
        } else {
            if (file_exists('assets/uploads/portfolio/' . $portfolio->image)) {
                @unlink('assets/uploads/portfolio/' . $portfolio->image);
            }
        }

        $portfolio->delete();

        return response()->json(['msg' => __('Portfolio deleted successfully')]);
    }
}
