<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BbsController extends Controller
{
    
    public function index()
    {
        $articles = DB::table('articles')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('index', compact('articles'));
    }

    public function insert(Request $request)
    {
        $validator = $request->validate([
            'title'   => 'required',
            'content' => 'required|max:300', 
        ]);
        $request->session()->regenerateToken();

        $article = new Article;
        $article -> title = $request->title;
        $article -> content = $request->content;
        $article -> save();

        return $this->index();
    }

    public function delete(Request $request)
    {
        DB::table('articles')
                ->where('id', $request->id)
                ->delete();

        return $this->index();
    }

    public function update(Request $request)
    {
        $validator = $request->validate([
            'title'   => 'required',
            'content' => 'required|max:300', 
        ]);
        DB::table('articles')
                ->where('id', $request->id)
                ->update([
                    'title'   => $request->title,
                    'content' => $request->content,
                ]);
        return $this->index();
    }

}
