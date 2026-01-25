<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;

class FirebaseController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(
                storage_path('app/firebase/pet-paradise-77c4d-firebase-adminsdk-fbsvc-4fbbc4ad57.json')
            );

        $this->auth = $factory->createAuth();
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
            $firebaseUser = $signInResult->data();

            // Find or create local user
            $user = User::firstOrCreate(
                ['email' => $firebaseUser['email']],
                [
                    'name' => $firebaseUser['displayName'] ?? explode('@', $firebaseUser['email'])[0],
                    'role' => 'user', // default to user
                ]
            );

            Auth::login($user);

            return redirect()->intended('/')->with('success', 'Logged in successfully!');
        } catch (InvalidPassword $e) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        } catch (UserNotFound $e) {
            return back()->withErrors(['email' => 'User not found.']);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Login failed.']);
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Create Firebase user
            $firebaseUser = $this->auth->createUser([
                'email' => $request->email,
                'password' => $request->password,
                'displayName' => $request->name,
            ]);

            // Create local user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password), // still hash for local
                'role' => 'user',
            ]);

            Auth::login($user);

            return redirect('/')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Registration failed.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully!');
    }

    /**
     * Admin: List all users and their roles
     */
    public function listUsers()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Admin: Set user as admin
     */
    public function makeAdmin($userId)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $user = User::findOrFail($userId);
        $user->update(['role' => 'admin']);

        return redirect()->back()->with('success', "{$user->name} is now an admin!");
    }

    /**
     * Admin: Remove admin role from user
     */
    public function removeAdmin($userId)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Prevent removing admin role from yourself
        if (Auth::id() == $userId) {
            return redirect()->back()->with('error', 'You cannot remove your own admin role!');
        }

        $user = User::findOrFail($userId);
        $user->update(['role' => 'user']);

        return redirect()->back()->with('success', "{$user->name} is no longer an admin.");
    }

    public function test()
    {
        return response()->json(
            $this->auth->listUsers()
        );
    }
}
