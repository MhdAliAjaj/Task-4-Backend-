<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('CheckRole');
    }
    public function index(Request $request)
    {
        // $request =User::all();
        // return view('Admin.index',compact($request));
        // // return ($request);
        //return  'Iam Admin';


        return view('Admin.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:7',
            
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        //$user->is_admin=$request->input('is_admin');
        $user->save();

        // Optionally, you can redirect the user to a success page
        return redirect()->route('admin.index')->with('success','User Added successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('Admin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:7',
            
        ]);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=$request->input('password');
        $user->save();

        /* -------way 1 for update------------*/ 
        // $user = new User();
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password'));
        // //$user->is_admin=$request->input('is_admin');
        // $user->update();

        // // Optionally, you can redirect the user to a success page
        // return redirect()->route('admin.index')->with('success','User Updated successfully.');


        /************************************************** */


        return redirect()->route('admin.index')->with('success','User Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $users=User::findOrFail($id);
         $users->delete();
         return redirect()->route('admin.index',compact('users'));
         //return view ('Admin.index',compact('users'));  فيها مشكلة  
    }

    public function filter(){

        //way1:
        $users=User::where('is_admin',false)->get();
        return view('Admin.index', compact('users'));


        //way2:
        // return view('Admin.index', ['users' => User::where('is_admin',true)->get()]);

    }
    public function search(Request $request)
    {
        $request->validate(
            ['q'=>['string']]
        );  
        //query
        $users=User::where('name','LIKE','%'.$request->input('q').'%')->get();
        //return dd($users);
        //show query via view
        
         return view('Admin.index', compact('users'));
    }


}
