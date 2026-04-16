<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('user.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to intended page or home
        return redirect()->intended('/browsing');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        // Validate credentials
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to intended page
            return redirect()->intended('/browsing');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the password reset request form.
     */
    public function showForgotForm()
    {
        return view('user.forgot-password');
    }

    /**
     * Send a password reset link to the given user.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Send the password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status and redirect accordingly
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the password reset form with the given token.
     */
    public function showResetForm($token)
    {
        return view('user.reset-password', ['token' => $token]);
    }

    /**
     * Handle the password reset.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Update the user's password
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();

                // Fire the PasswordReset event
                event(new PasswordReset($user));

                // Log the user in after reset
                Auth::login($user);
            }
        );

        // Check the status and redirect
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user.login.form')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

////