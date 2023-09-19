<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class BlogController extends Controller
{
    public function index(){
        return view('blogs', [
            'blogs' => Blog::latest()->paginate(10)
        ]);
    }
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $filename = $request->file('upload')->storeAs('blog_images', str_replace(' ', '-', $request->file('upload')->getClientOriginalName()), 'public_disk');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/'.$filename); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function create(){
        return view('blogs.create-blog');
    }

    public function show(){
        return view('blogs.blogs', [
            'blogs' => Blog::latest()->paginate(50)
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:250',
            'description' => 'required',
            'body' => 'required',
        ]);
        Blog::create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail->storeAs('blog_images', str_replace(' ', '-', $request->thumbnail->getClientOriginalName()), 'public_disk'),
            'description' => $request->description,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'body' => $request->body
        ]);
        return back()->with('success', 'Blog has been uploaded!');
    }


    public function read(Blog $blog){
        SEOMeta::setTitle($blog->title);
        SEOMeta::setDescription($blog->description);
        SEOMeta::setCanonical("https://vitalneon.com/blog/".$blog->slug);
        SEOMeta::setRobots("index, follow");
        SEOMeta::addMeta("apple-mobile-web-app-title", "VitalNeon");
        SEOMeta::addMeta("application-name", "VitalNeon");

        OpenGraph::setTitle($blog->title);
        OpenGraph::setDescription($blog->description); 
        OpenGraph::setUrl("https://vitalneon.com/blog/".$blog->slug);
        OpenGraph::addProperty("type", "article");
        OpenGraph::addProperty("locale", "eu");
        OpenGraph::addImage("https://vitalneon.com/storage/".$blog->thumbnail);

        TwitterCard::setTitle($blog->title);
        TwitterCard::setSite("@vitalneon");
        TwitterCard::setImage("https://vitalneon.com/storage/".$blog->thumbnail);
        TwitterCard::setDescription($blog->description);

        JsonLd::setTitle($blog->title);
        JsonLd::setDescription($blog->description);
        JsonLd::addImage("https://vitalneon.com/storage/".$blog->thumbnail);
        JsonLd::setType("WebSite");
        return view('read-blog', [
            'blog' => $blog
        ]);
    }

    public function update(Blog $blog){
        return view('blogs.update-blog',[
            'blog' => $blog
        ]);
    }


    public function update_blog(Request $request, Blog $blog){
        $this->validate($request, [
            'title' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:150',
            'body' => 'required',
            'slug' => 'required',
            'description' => 'required'
        ]);

        $array = array(
            "title" => $request->title,
            "body" => $request->body,
            "slug" => $request->slug,
            "description" => $request->description,
        );

        if($request->hasFile('thumbnail')){
            $thumbnail = $request->thumbnail->storeAs('blog_images', str_replace(' ', '-', $request->thumbnail->getClientOriginalName()), 'public_disk');
            $array['thumbnail'] = $thumbnail;
        }

        $blog->update(array_filter($array));
        $blog->save();
        return back()->with('success', 'Blog Successfully Updated!');
    }

    public function search(Request $request){
        $blogs = Blog::where('title', 'LIKE', '%'.$request->search.'%')->orWhere('description', 'LIKE', '%'.$request->search.'%')->get();
        return view('blogs', [
            'blogs' => $blogs
        ]);
    }
}
