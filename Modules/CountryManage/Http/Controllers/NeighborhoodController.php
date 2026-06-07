<?php

namespace Modules\CountryManage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\CountryManage\Entities\Neighborhood;

class NeighborhoodController extends Controller
{
    // display all neighborhood and add new neighborhood
    public function all_neighborhood(Request $request)
    {
        if($request->isMethod('post')){
            $request->validate([
                'country'=> 'required',
                'state'=> 'required',
                'city'=> 'required',
                'neighborhood'=> 'required|max:191',
            ]);
            
            // Validate unique neighborhood per city
            $exists = Neighborhood::where('neighborhood', $request->neighborhood)
                ->where('city_id', $request->city)
                ->exists();
                
            if ($exists) {
                return redirect()->back()->withErrors(['neighborhood' => __('This neighborhood is already registered in the selected city.')]);
            }

            Neighborhood::create([
                'neighborhood' => $request->neighborhood,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'status' => $request->status ?? 1,
            ]);
            toastr_success(__('New Neighborhood Successfully Added'));
        }
        $all_countries = Country::all_countries();
        $all_states = State::all_states();
        $all_cities = City::all(); // load all cities for select or dynamic filters

        $all_neighborhoods = Neighborhood::with(['country', 'state', 'city'])->latest()->paginate(10);
        return view('countrymanage::neighborhood.all-neighborhood', compact('all_states', 'all_countries', 'all_cities', 'all_neighborhoods'));
    }

    // edit neighborhood
    public function edit_neighborhood(Request $request)
    {
        $request->validate([
            'neighborhood'=> 'required|max:191',
            'country'=> 'required',
            'state'=> 'required',
            'city'=> 'required',
        ]);

        $exists = Neighborhood::where('neighborhood', $request->neighborhood)
            ->where('city_id', $request->city)
            ->where('id', '!=', $request->neighborhood_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['neighborhood' => __('This neighborhood is already registered in the selected city.')]);
        }

        Neighborhood::where('id', $request->neighborhood_id)->update([
            'neighborhood'=>$request->neighborhood,
            'city_id'=>$request->city,
            'state_id'=>$request->state,
            'country_id'=>$request->country,
        ]);
        return redirect()->back()->with(toastr_success(__('Neighborhood Successfully Updated')));
    }

    // change status
    public function neighborhood_status($id)
    {
        $neighborhood = Neighborhood::select('status')->where('id', $id)->first();
        $neighborhood->status == 1 ? $status = 0 : $status = 1;
        Neighborhood::where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with(toastr_success(__('Status Successfully Changed')));
    }

    // delete single neighborhood
    public function delete_neighborhood($id)
    {
        Neighborhood::find($id)->delete();
        return redirect()->back()->with(toastr_error(__('Neighborhood Successfully Deleted')));
    }

    // delete multi neighborhood
    public function bulk_action_neighborhood(Request $request)
    {
        Neighborhood::whereIn('id', $request->ids)->delete();
        return redirect()->back()->with(toastr_success(__('Selected Neighborhoods Successfully Deleted')));
    }

    // import settings
    public function import_settings()
    {
        $all_countries = Country::all_countries();
        $all_states = State::all_states();
        $all_cities = City::all();
        return view('countrymanage::neighborhood.import-neighborhood', compact('all_countries', 'all_states', 'all_cities'));
    }

    // import settings update
    public function update_import_settings(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);

                $all_countries = Country::all_countries();
                $all_states = State::all_states();
                $all_cities = City::all();

                return view('countrymanage::neighborhood.import-neighborhood', [
                    'import_data' => $csv_data,
                    'all_countries' => $all_countries,
                    'all_states' => $all_states,
                    'all_cities' => $all_cities
                ]);
            }
        }
        toastr_error(__('something went wrong try again!'));
        return back();
    }

    // import neighborhood to database
    public function import_to_database_settings(Request $request)
    {
        $request->validate([
            'neighborhood' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_neighborhoods = 0;
        $x = 0;
        $neighborhood = array_search($request->neighborhood, $csv_data, true);

        foreach ($data as $index => $item) {
            if($x == 0){
                $x++;
                continue ;
            }
            if ($index === 0) {
                continue;
            }
            if (empty($item[$neighborhood])){
                continue;
            }

            $find_neighborhood = Neighborhood::where('neighborhood', $item[$neighborhood])
                ->where('country_id', $request->country_id)
                ->where('state_id', $request->state_id)
                ->where('city_id', $request->city_id)
                ->count();

            if ($find_neighborhood < 1) {
                $neighborhood_data = [
                    'neighborhood' => $item[$neighborhood] ?? '',
                    'country_id' => $request->country_id,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'status' => $request->status ?? 1,
                ];
                Neighborhood::create($neighborhood_data);
                $imported_neighborhoods++;
            }
        }
        toastr_success($imported_neighborhoods.' '. __('Neighborhoods imported successfully'));
        return redirect()->route('admin.neighborhood.import.csv.settings');
    }

    // pagination
    function pagination(Request $request)
    {
        if($request->ajax()){
            $all_neighborhoods = Neighborhood::with(['country', 'state', 'city'])->latest()->paginate(10);
            return view('countrymanage::neighborhood.search-result', compact('all_neighborhoods'))->render();
        }
    }

    // search neighborhood
    public function search_neighborhood(Request $request)
    {
        $all_neighborhoods = Neighborhood::with(['country', 'state', 'city'])
            ->where('neighborhood', 'LIKE', "%". strip_tags($request->string_search) ."%")
            ->paginate(10);
        if($all_neighborhoods->total() >= 1){
            return view('countrymanage::neighborhood.search-result', compact('all_neighborhoods'))->render();
        }else{
            return response()->json([
                'status'=>__('nothing')
            ]);
        }
    }
}
