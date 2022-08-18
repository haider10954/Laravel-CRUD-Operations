<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $customer = Customer::get();
            return view('customer', ["customers" => $customer]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::all();
        return view('customer.customer', ["customers" => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Customer::where('slug',str()->slug($request->name))->count();
        if($check < 1)
        {
            $request->request->add(['slug' => str()->slug($request->name)]);
        }
        $this->validateFormData($request,'create');
        $data = $request->only('name','email','slug');
        $customer = Customer::create($data);
        if(empty($customer->slug))
        {
            $customer->slug = str()->slug($customer->name).'-'.$customer->id;
        }
        $customer->save();
        return redirect()->route('customer.index')->with('success','Customer Added successfully.');
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
        $customers = Customer::where('id',$id)->first();
        return view('customer.edit_customer')->with('customers', $customers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validateFormData($request,'update');
        $data = $request->only('name','email');
        $customer->update($data);
        return redirect()->route('customer.index')->with('success','Customer Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success','Customer Deleted successfully.');
    }

    public function validateFormData($request,$action)
    {
        $rules = [
            'name' => 'required|max:255',
            'slug' => ['nullable','unique:categories,slug'],
            'email' => 'required|email|max:255',
        ];
    }
}
