<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $company_id = $request->company_id;
        $listing = Employee::when($company_id, function ($employee) use ($company_id) {
            return $employee->whereCompanyId($company_id);
        })->with('company:id,name,email')->paginate($per_page);
        if($request->ajax()) {
            return response(['employees' => $listing], 200);
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
        $companies = Company::pluck('name', 'id');
        return view ('form', compact('companies'));
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
            'first_name' => ['required', 'min:5', 'max:50'],
            'last_name' => ['required', 'min:5', 'max:50'],
            'company_id' => ['required', 'integer'],
            'email' => ['required', 'email'],
            'phone_no' => ['required'],
        ]);
        [ 'first_name' => $first_name, 'last_name' => $last_name, 'company_id'=> $company_id , 'email'=> $email ,
            'phone_no'=> $phone_no ]  = $request->all();
        Employee::create([ 'first_name' => $first_name, 'last_name' => $last_name, 'company_id'=> $company_id ,
            'email'=> $email , 'phone_no'=> $phone_no ]);
        return redirect()->route('employees.index');
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
        $model = Employee::findOrFail($id);
        $companies = Company::pluck('name', 'id');
        return view('form', compact('model', 'companies'));
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
        $request->validate([
            'first_name' => ['required', 'min:5', 'max:50'],
            'last_name' => ['required', 'min:5', 'max:50'],
            'company_id' => ['required', 'integer'],
            'email' => ['required', 'email'],
            'phone_no' => ['required'],
        ]);
        $path = null;
        if($request->hasFile('logo')) {
            $path = $request->file('logo')->store('/');
        }
        [ 'first_name' => $first_name, 'last_name' => $last_name, 'company_id'=> $company_id , 'email'=> $email ,
            'phone_no'=> $phone_no ]  = $request->all();
        Employee::where('id', $id)->update([ 'first_name' => $first_name, 'last_name' => $last_name, 'company_id'=> $company_id ,
            'email'=> $email , 'phone_no'=> $phone_no ]);
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::whereId($id)->delete($id);
        return redirect()->route('employees.index');
    }
}
