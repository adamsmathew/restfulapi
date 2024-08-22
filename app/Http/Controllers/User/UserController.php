<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); 

        return response()->json(['data' => $users], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    
        $request->validate($rules);
    
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
    
        $user = new User();
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = $user->generateVerificationCode(); // Use the non-static method with the object
        $data['admin'] = User::REGULAR_USER;
    
        $user = User::create($data);
    
        return response()->json(['data' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json(['data' => $user], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $rules = [
            'email' => 'email|unique:users,' . $user->id, 
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER, 
        ];
    
        $request->validate($rules);
    
        $updated = false;
    
        if ($request->has('name')) {
            $user->name = $request->name;
            $updated = true;
        }
    
        if ($request->has('email') && $user->email !== $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = $user->generateVerificationCode(); // Use the non-static method
            $user->email = $request->email;
            $updated = true;
        }
    
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $updated = true;
        }
    
        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return response()->json([
                    'error' => 'Only verified users can modify the admin field',
                    'code' => 409
                ], 409);
            }
            
            $user->admin = $request->admin;
            $updated = true;
        }
    
        if (!$updated) {
            return response()->json([
                'error' => 'You need to specify a different value to update',
                'code' => 422
            ], 422);
        }
    
        $user->save();
    
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
       
        $user->delete();

        return response()->json(['data' => $user],200);
    }
}
