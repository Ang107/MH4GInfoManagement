<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use App\Models\Armor;
use App\Models\ArmorPort;
use App\Models\Bookmark;
use App\Models\Monster;
use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    #ギルクエ一覧
    public function index(Post $post,Request $request,)
    {
        $areas = Area::get();
        $armors = Armor::get();
        $armor_ports = ArmorPort::get();
        $monsters = Monster::get();
        $weapons = Weapon::get();
        $sort = $request->query('sort');
        switch ($sort) {
            case 'newer':
                return view('posts.index')->with(['posts' => $post->getPaginateByLimitNewer(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons, 'request' => $request]);
                break;
            case 'older':
                return view('posts.index')->with(['posts' => $post->getPaginateByLimitOlder(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            case 'more_bookmark':
                return view('posts.index')->with(['posts' => $post->getPaginateByLimitBookmark(20,$request),'sort' => $sort,'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            default:
                // $sort が指定されていない場合の処理
                return view('posts.index')->with(['posts' => $post->getPaginateByLimitNewer(20,$request),'sort' => "newer", 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
        }
    }
    
    #マイギルクエ一覧
    public function show_myposts(Post $post,Request $request,)
    {
        $areas = Area::get();
        $armors = Armor::get();
        $armor_ports = ArmorPort::get();
        $monsters = Monster::get();
        $weapons = Weapon::get();
        $sort = $request->query('sort');
        switch ($sort) {
            case 'newer':
                return view('posts.show_myposts')->with(['posts' => $post->getPaginateByLimitNewer_myposts(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons, 'request' => $request]);
                break;
            case 'older':
                return view('posts.show_myposts')->with(['posts' => $post->getPaginateByLimitOlder_myposts(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            case 'more_bookmark':
                return view('posts.show_myposts')->with(['posts' => $post->getPaginateByLimitBookmark_myposts(20,$request),'sort' => $sort,'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            default:
                // $sort が指定されていない場合の処理
                return view('posts.show_myposts')->with(['posts' => $post->getPaginateByLimitNewer_myposts(20,$request),'sort' => "newer", 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
        }
    }
    
    #ブクマしたギルクエ一覧
    public function show_mybookmark(Post $post,Request $request,)
    {
        $areas = Area::get();
        $armors = Armor::get();
        $armor_ports = ArmorPort::get();
        $monsters = Monster::get();
        $weapons = Weapon::get();
        $sort = $request->query('sort');
        switch ($sort) {
            case 'newer':
                return view('posts.show_mybookmark')->with(['posts' => $post->getPaginateByLimitNewer_mybookmark(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons, 'request' => $request]);
                break;
            case 'older':
                return view('posts.show_mybookmark')->with(['posts' => $post->getPaginateByLimitOlder_mybookmark(20,$request),'sort' => $sort, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            case 'more_bookmark':
                return view('posts.show_mybookmark')->with(['posts' => $post->getPaginateByLimitBookmark_mybookmark(20,$request),'sort' => $sort,'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
                break;
            default:
                // $sort が指定されていない場合の処理
                return view('posts.show_mybookmark')->with(['posts' => $post->getPaginateByLimitNewer_mybookmark(20,$request),'sort' => "newer", 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,'request' => $request]);
        }
    }
    
    #ギルクエ詳細
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
     //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    
    #ブックマーク
    public function bookmark(Request $request)
    {
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得
    
        // すでにいいねがされているか判定するためにbookmarksテーブルから1件取得
        $already_bookmarked = Bookmark::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
        if (!$already_bookmarked) { 
            $bookmark = new Bookmark; // bookmarkクラスのインスタンスを作成
            $bookmark->post_id = $post_id;
            $bookmark->user_id = $user_id;
            $bookmark->save();
        } else {
            // 既にいいねしてたらdelete 
            Bookmark::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        // 投稿のいいね数を取得
        $post_bookmarks_count = Post::withCount('bookmarks')->findOrFail($post_id)->bookmarks_count;
        $param = [
            'post_bookmarks_count' => $post_bookmarks_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
        
    }
    
    #ギルクエ投稿画面
    public function create()
    {
        $areas = Area::get();
        $armors = Armor::get();
        $armor_ports = ArmorPort::get();
        $monsters = Monster::get();
        $weapons = Weapon::get();
        return view('posts.create')->with(['areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,]);
    }
    
    #ギルクエ登録
    public function store(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        if ($input_post['generator'] == null){
            $input_post['generator'] = '-不明-';
        }
        if ($input_post['default_level'] == null){
            $input_post['default_level'] = '-不明-';
        }
        
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    #ギルクエ編集画面
    public function edit(Post $post)
    {
        $areas = Area::get();
        $armors = Armor::get();
        $armor_ports = ArmorPort::get();
        $monsters = Monster::get();
        $weapons = Weapon::get();
        return view('posts.edit')->with(['post' => $post, 'areas' => $areas, 'armors' => $armors, 'armor_ports' => $armor_ports,'monsters' => $monsters, 'weapons' => $weapons,]);
    }
    
    #ギルクエ更新
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        if ($input_post['generator'] == null){
            $input_post['generator'] = '-不明-';
        }
        if ($input_post['default_level'] == null){
            $input_post['default_level'] = '-不明-';
        }
        
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    #ギルクエ削除
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts/myposts');
    }
    
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
}
?>