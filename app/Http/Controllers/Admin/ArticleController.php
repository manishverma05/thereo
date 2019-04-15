<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller {

    public function getList() {
        return view('admin.article.index')
                        ->withPagetitle('Articles')
                        ->withPageheader('Articles');
    }

    public function getCreate() {
        return view('admin.article.create')
                        ->withPagetitle('New Article')
                        ->withPageheader('New Article');
    }

    public function postCreate(Request $request) {
        
    }

    public function getUpdate($article_unique_id) {
        return view('admin.article.create')
                        ->withPagetitle('New Article')
                        ->withPageheader('New Article');
    }

    public function postUpdate(Request $request, $article_unique_id) {
        
    }

    public function getCategoryCreate() {
        return view('admin.article.create')
                        ->withPagetitle('New Category')
                        ->withPageheader('New Category');
    }

    public function postCategoryCreate(Request $request) {
        
    }

    public function getCategoryUpdate($article_unique_id) {
        return view('admin.article.create')
                        ->withPagetitle('Update Category')
                        ->withPageheader('Update Category');
    }

    public function postCategoryUpdate(Request $request, $article_unique_id) {
        
    }

}
