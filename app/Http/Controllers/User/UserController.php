<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Mail\UserCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Traits\ApiResponser;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    use ValidatesRequests, ApiResponser;

    public function __construct()
    {
        $this->middleware('client.credentials')->only(['store','resend']);
        $this->middleware('transform.input:' . UserTransformer::class)->only(['index','show']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); 

        return $this->showAll($users); 
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

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return $this->showOne($user, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // $user = User::findOrFail($id);
        return $this->showOne($user); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'admin' => 'nullable|in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ];

        $this->validate($request, $rules);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email !== $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return  $this->errorResponse('Only verified users can modify the admin field', 409);            
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
          
        }

        $user->save();

        return $this->showOne($user); // Fixed variable
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['data' => $user], 200);
    }

    public function verify($token)
    {
        $user = User::where('verification_token',$token)->firstOrFail();
        $user->verification_token = null;

        $user->save();

        return $this->showMessage('the account has been verified successfully');
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('The user is already verified', 409);
        }
    
        retry(5, function() use ($user){
            Mail::to($user)->send(new UserCreated($user));
        },100);
        return $this->showMessage('The verification email has been resent');
    }


}

