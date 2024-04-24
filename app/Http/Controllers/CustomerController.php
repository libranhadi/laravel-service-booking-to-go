<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerValidationRequest;
use App\Models\FamilyList;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('nationality')->orderBy('cst_name', 'desc')->paginate(10);
        return view('customer.index', [
            "customers" => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create', [
            "nationalities" => Nationality::orderBy('nationality_name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerValidationRequest $request)
    {
        $customer = DB::transaction(function () use ($request) {
            $customer = Customer::create($request->except('family_lists'));
            $now = now();
            $familyListsDataWithCustomerId = array_map(function ($familyData) use ($customer, $now) {
                $familyData['cst_id'] = $customer->cst_id;
                $familyData['created_at'] = $now;
                $familyData['updated_at'] = $now;
                return $familyData;
            }, $request['family_lists']);
            FamilyList::insert($familyListsDataWithCustomerId);   
            
            return $customer;
        });

        return redirect()->route('customers.edit', ['id' => $customer->cst_id])
            ->with('success_message', 'Successfully created customer');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::with(["familyLists", 'nationality'])->where('cst_id', $id)->first();
        if (empty($customer)) {
            return redirect()->back()->with('error_message', 'Maaf data customer tidak ditemukan!');
        }

        return view('customer.edit', [
            "nationalities" => Nationality::orderBy('nationality_name', 'asc')->get(),
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerValidationRequest $request, $id)
    {
        $customer = Customer::where('cst_id', $id)->first();
        if (empty($customer)) {
            return redirect()->back()->with('error_message', 'Maaf data customer tidak ditemukan!');
        }

        DB::transaction(function () use ($request, $customer) {
            $customer->update($request->except('family_lists'));
            FamilyList::where('cst_id', $customer->cst_id)
                ->delete();

            $now = now();
            $familyListsDataWithCustomerId = array_map(function ($familyData) use ($customer, $now) {
                $familyData['cst_id'] = $customer->cst_id;
                $familyData['created_at'] = $now;
                $familyData['updated_at'] = $now;
                return $familyData;
            }, $request['family_lists']);

            FamilyList::insert($familyListsDataWithCustomerId);  
        });

        return redirect()->route('customers.index')
            ->with('success_message', 'Successfully edit customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('cst_id', $id)->first();
        if (empty($customer)) {
            return redirect()->back()->with('error_message', 'Maaf data customer tidak ditemukan!');
        }
        DB::transaction(function () use ($customer) {
            FamilyList::where('cst_id', $customer->id)->delete();
            $customer->delete();
        });

        return redirect()->route('customers.index')
            ->with('success_message', 'Successfully delete customer');
    }
}
