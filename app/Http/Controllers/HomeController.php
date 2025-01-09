<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $gender = $request->input('gender');
        $hobby = $request->input('hobby');
        
        $query = "
            SELECT id,
                name,
                gender,
                hobby,
                instagram,
                criteria
            FROM users
            WHERE (:genderFilter IS NULL OR gender = :gender)
            AND (:hobbyFilter IS NULL OR JSON_EXTRACT(hobby, '$') LIKE :hobby)
            AND id != :id
            AND visibility = TRUE
        ";

        // Use DB::select for named parameter binding
        $users = DB::select($query, [
            'genderFilter' => $gender ?: null, // Check for NULL in the query
            'gender' => $gender,               // Actual comparison
            'hobbyFilter' => $hobby ? json_encode($hobby) : null,
            'hobby' => $hobby ? '%' . $hobby . '%' : null,
            'id' => Auth::user()->id,
        ]);

        // Check if the current user has liked each user
        $likedUsers = Auth::user()->likes()->pluck('liked_user_id')->toArray();

        return view('home', ['users' => $users, 'likedUsers' => $likedUsers]);
    }

    public function visible(){
        $currentUser = Auth::user();

        if($currentUser->visibility){
            DB::statement("
                UPDATE users
                SET visibility = FALSE, fund = fund - 1000
                WHERE id = :id
            ", ["id" => $currentUser->id]);
        }else{
            DB::statement("
                UPDATE users
                SET visibility = TRUE
                WHERE id = :id
            ", ["id" => $currentUser->id]);
        }

        return redirect()->back();
    }

    public function like(User $user)
    {
        $currentUser = Auth::user();
        
        if ($currentUser->likes()->where('liked_user_id', $user->id)->exists()) {
            $currentUser->likes()->detach($user->id);
            return back()->with('success', 'User unliked successfully!');
        }else{
            $currentUser->likes()->attach($user->id);
            return back()->with('success', 'User liked successfully!');
        }
    }
}
