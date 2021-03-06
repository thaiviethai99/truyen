<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\Truyen;
use App\Models\TruyenChap;
use App\Models\Website;
use DB;
use Illuminate\Http\Request;
use App\Jobs\TestJob;
include base_path() . '/vendor/simplehtmldom/simple_html_dom.php';
class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('client');
    }

    public function index()
    {
        dispatch(new TestJob());
        $newSlideShow = Truyen::where('is_slideshow', 1)->where('is_delete', 0)->orderBy('created_date', 'desc')->take(8)->get();
        $truyens      = Truyen::orderBy('id', 'desc')->take(8)->get();
        $totalTruyen  = count($truyens);
        return view('home.home', compact('newSlideShow', 'truyens', 'totalTruyen'));
    }

    public function pagingHome(Request $request)
    {
        $output  = '';
        $id      = $request->id;
        if($request->has('cateId')){
            $truyens = Truyen::where('id', '<', $id)->where('cate_id',$request->cateId)->orderBy('id', 'DESC')->take(8)->get();
        }else {
            $truyens = Truyen::where('id', '<', $id)->orderBy('id', 'DESC')->take(8)->get();
        }
        
        if (!$truyens->isEmpty()) {
            $output = view("home.ajax_paging_home", compact('truyens'))->render();
            echo $output;
        }
    }

    public function detail(Request $request)
    {
        $id      = $request->id;
        $truyen  = Truyen::find($id);
        $truyens = Truyen::where('cate_id', $truyen->cate_id)->where('id', '!=', $truyen->id)->orderBy('id', 'desc')->take(3)->get();
        $website     = Website::find($truyen->website_id);
        $websiteName = $website->name;
        if ($websiteName == 'blogtruyen.com' || $websiteName == 'mangak.info') {
            $truyenChaps = TruyenChap::where('truyen_id', $id)->orderBy('title', 'desc')->get();
        } else {
            $truyenChaps = TruyenChap::where('truyen_id', $id)->orderBy('title', 'desc')->get();
        }

        return view('home.detail', compact('truyen', 'truyens', 'truyenChaps'));
    }

    public function view(Request $request)
    {
        $chapNumber  = $request->chapNumber;
        $slug        = $request->slug;
        $truyen      = Truyen::where('slug', $slug)->first();
        //update view
        $truyen->total_view=$truyen->total_view+1;
        $truyen->save();
        $truyenChaps = TruyenChap::where('truyen_id', $truyen->id)->orderBy('title', 'desc')->get();
        $sql         = "SELECT c.title,i.chap_img,c.folder_name
            FROM truyen t ,truyen_chap c,truyen_chap_img i
            WHERE
                c.id=i.truyen_chap_id
            and t.id=c.truyen_id
            AND c.chap_number='" . $chapNumber . "'
            And t.slug='" . $slug . "'";
        $listImg = DB::select($sql);

        return view('home.view', compact('truyen', 'truyenChaps', 'listImg', 'chapNumber'));
    }

    public function cate(Request $request)
    {
        $cateId      = $request->id;
        $cate        = Cate::find($cateId);
        $truyens     = Truyen::where('cate_id', $cateId)->orderBy('id', 'desc')->take(8)->get();
        $totalTruyen = count($truyens);
        return view('home.cate', compact('cate', 'truyens', 'totalTruyen'));
    }

    public function findTitle(Request $request)
    {
        $truyens = Truyen::where('title', 'like', '%' . $request->get('q') . '%')->take(5)->get();
        return response()->json($truyens);
    }
}
