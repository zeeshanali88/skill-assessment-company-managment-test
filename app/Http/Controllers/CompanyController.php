<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $listing = Company::withCount('employees')->paginate($per_page);
        if($request->ajax()) {
            return response(['companies' => $listing], 200);
        }
        return view('listing', compact('listing'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:50'],
            'email' => ['sometimes','email'],
            'website' => ['sometimes', 'url'],
            'logo' => 'sometimes|image|dimensions:min_width=100,min_height=200'
        ]);
        $path = null;
        if($request->hasFile('logo')) {
            $path = $request->file('logo')->store('/');
        }
        [ 'name' => $name, 'email' => $email, 'website'=> $website ]  = $request->all();
        Company::create(['name' => $name, 'email' => $email, 'website' => $website, 'logo' => $path]);
        return redirect()->route('companies.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Company::findOrFail($id);
        return view('form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:5', 'max:50'],
            'email' => ['sometimes','email'],
            'website' => ['sometimes', 'url'],
            'logo' => ['image','dimensions:min_width=100,min_height=200']
        ]);
        $company = Company::findOrFail($id);
        $path = $company->logo;
        if($request->hasFile('logo')) {
            if($path) {
                Storage::delete($path);
            }
            $path = $request->file('logo')->store('/');
        }
        [ 'name' => $name, 'email' => $email, 'website'=> $website ]  = $request->all();
        Company::where('id', $id)->update(['name' => $name, 'email' => $email, 'website' => $website, 'logo' => $path]);
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::whereCompanyId($id)->delete();
        Company::whereId($id)->delete($id);
        return redirect()->route('companies.index');
    }
}
