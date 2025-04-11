<?php

namespace App\Http\Controllers;

use App\Models\PersonalAccessToken;
use Illuminate\Http\Request;

class PersonalAccessTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personalAccessTokens = PersonalAccessToken::all();
        return view('personal_access_tokens.index', compact('personalAccessTokens'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonalAccessToken $personalAccessToken)
    {
        return view('personal_access_tokens.show', compact('personalAccessToken'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonalAccessToken $personalAccessToken)
    {
        $personalAccessToken->delete();
        return redirect()->route('personal_access_tokens.index')->with('success', 'Personal Access Token deleted successfully.');
    }
}