<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class infoController extends Controller
{
    // public Request $request;
    public function print(Request $request)
    {
        dd($request->all());
        echo $request->method();
    }
    //
    public function index(Request $request)
    {
        // dd($request->all());

        //validation
        $validatedData = $request->validate([
            "name" => 'required|string',
            'email' => 'required| email | unique:info_tbl,email',
            'password' => 'required | string | min:4',
            'image' => 'image | mimes:jpg,jpeg,gif,png',
        ]);
        // If there are no validation errors, 
        // dd($validatedData) should display the validated input data. 
        // If you're not seeing any output from dd, it means that the validation was successful and $validatedData contains the validated input.
        // dd($validatedData);

        // $user = User::create($validatedData);
        //or,

        $info_user = new Info();

        $info_user->name = $validatedData['name'];
        $info_user->email = $validatedData['email'];
        $info_user->password = bcrypt($validatedData['password']);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //image name
            // $imageName = time().'.'.$request->image->extension();  
            $count = count(Storage::disk('public')->files('Images')) + 1;
            $image_name = time() . '_' . $count . '.' . $image->getClientOriginalExtension();

            //store the file
            $image_path = $request->image->move(public_path('images'), $image_name);
            // $image_path=$image->store('Images','public');

            $validatedData['image'] = $image_name;
            $info_user->imageName = $validatedData['image'];
        }

        // dd($info_user->toJson());
        // Print or dump the image path
        // echo "Image Path: $image_path";
        //  dump($image_path);
        $info_user->save();

        return redirect()->route('home')->with('success', 'User created Sucessfully');

        // return redirect()->back()->with('success', 'User created successfully.');
    }

    public function show()
    {
        $infoData = Info::all();

        return view('form', compact('infoData'));
    }

    public function edit($id)
    {
        $info = Info::find($id);

        if ($info)
            return view('product', compact("info"));
        else {
            return  redirect()->back()->withErrors(['erros'=>'Invalid Credentials']);
        }
    }
    public function update(Request $request, $id)
    {
        $info = Info::findOrFail($id);

        $validate_data = $request->validate([
            'email' => 'required|email|unique:info_tbl,email',
            'password' => 'required|min:4',
        ]);
        // dd($request->all());
        // dd($info->all());

        try {
            $update = $info->update($validate_data);

            if ($update) {
                return to_route('home');
            } else {
                return redirect()->back()->withErrors(["errors" => 'Invalid Credentials']);
            }
        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->withErrors(['errors' => 'An error occured. ' . $e]);
        }
    }

    public function destroy($id)
    {
        // dd($id);
        $query = "delete from info_tbl where id=?";
        $deleted = DB::delete($query, [$id]);
        if ($deleted) {
            return redirect()->route('home')->with('deleteSuccess', 'Item deleted successfully.');
        } else
            return redirect()->back()->with('error', 'Item not found or deletion failed.');
    }
}
