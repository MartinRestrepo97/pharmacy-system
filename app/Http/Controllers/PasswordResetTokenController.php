<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
use Illuminate\Http\Request;

class PasswordResetTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passwordResetTokens = PasswordResetToken::all();
        return view('password_reset_tokens.index', compact('passwordResetTokens'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PasswordResetToken $passwordResetToken)
    {
        return view('password_reset_tokens.show', compact('passwordResetToken'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PasswordResetToken $passwordResetToken)
    {
        $passwordResetToken->delete();
        return redirect()->route('password_reset_tokens.index')->with('success', 'Password Reset Token deleted successfully.');
    }
}