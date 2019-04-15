<?php

namespace App\Http\Controllers;

use App\Repository\Business;
use App\Repository\Customers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $users;
    private $business;

    function __construct()
    {
        $this->users = new User();
        $this->business = new Business();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()) return view('admin.pages.admin-login');
        $currentUser = Auth::user();
        $query = $request->input('search');
        if ($query == null) {
            $users = User::paginate(5);
            return view('admin.pages.users.list', compact('users', 'currentUser'));
        } else {
            $users = User::where('name', 'like', "%$query%")->orWhere('email', 'like', "%$query%")->paginate(5);
            return view('admin.pages.users.list', compact('users', 'query', 'currentUser'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, $this->users->rule());
        $data['password'] = bcrypt($data['password']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $this->users->create($data);
            return redirect()->route('users.index')->with('success', 'Create new user successfully');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (!Auth::user()) return view('admin.pages.admin-login');
        $current_user_id = Auth::user()->id;
        $user = $this->users->findOrFail($current_user_id);
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $path = 'uploads/img_profile';
        $rule = [
            'name' => 'max:191',
            'email' => 'email',
            'phone' => 'max:30',
            'address' => 'max:191',
            'newpassword' => 'min:6|max:191',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->has('change_password')) {
            $new_password = bcrypt($request->input('newpassword'));
            if (Hash::check($request->input('password'), Auth::user()->getAuthPassword())) {
                $data['password'] = $new_password;
            } else {
                return redirect()->back()->with('err_password', 'Incorrect password please reenter password');
            }
        } else {
            unset($data['password']);
            unset($rule['newpassword']);
        }
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $data['img'] = $this->business->saveImg($img, $path);
            if ($user->img != null && file_exists($path . '/' . $user->img)) {
                unlink($path . '/' . $user->img);
            }
        }
        /*    $validator = Validator::make($data,$rule);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{*/
        $user->update($data);
        return redirect()->route('users.profile')->with('success', "Update profile $user->name succesfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('user_id');
        if ($user_id = $this->users->findOrFail($id)) {
            if (($user_id->img != null) && (file_exists("upload/img_product/$user_id->img"))) {
                unlink("upload/img_product/$user_id->img");
            }
            $user_id->delete();
            return redirect()->route('users.index')->with('success', "Deleted $user_id->name");
        } else {
            return redirect()->route('users.index')->with('fail', 'User ko tồn tại');
        }
    }

    public function getCustomer(Request $request)
    {
        $query = $request->input('search');
        if ($query == null) {
            $customers = Customers::latest()->paginate(5);
            return view('admin.pages.users.customerList', compact('customers'));
        } else {
            $customers = Customers::where('username', 'like', "%$query%")->orWhere('email', 'like', "%$query%")->paginate(5);
            return view('admin.pages.users.customerList', compact('customers', 'query'));
        }
    }

    public function customerDetail($id)
    {
        $customer_id = Customers::find($id);
        echo "<p>Name: $customer_id->username </p>";
        echo "<p>Address: $customer_id->address </p>";
        echo "<p>Email: $customer_id->email</p>";
        echo "<p>Phone Number: $customer_id->phone</p>";
    }
}
