<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionCategory;
use App\Models\SessionCategoryMap;
use App\Models\Session;

class SessionCategoryController extends Controller {

    public function detail($category_slug) {
        $sessionCategory = SessionCategory::where('slug', $category_slug)->with('cover_media')->first();
        $sessionCategories = SessionCategory::with('cover_media')->orderBy('id', 'desc')->get();
        $sessionCategoryMap = SessionCategoryMap::where('session_category_id', $sessionCategory->id)->with('session')->get();
        $sessions = (object) array_column($sessionCategoryMap->toArray(), 'session');
        return view('sessions.index')
                        ->withPagetitle('Sessions')
                        ->withPageheader('Sessions')
                        ->withSessions(json_decode(json_encode($sessions)))
                        ->withSessionCategory($sessionCategory)
                        ->withSessionCategories($sessionCategories);
    }

}
