<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    
    use HasFactory;
    
    #絞り込み検索による絞り込み
    public function filter($request)
    {
        $default_level = $request->query('Lv');
        $left_monster_id = $request->query('Lmon');
        $left_monster_area = $request->query('LmonA');
        $right_monster_id = $request->query('Rmon');
        $right_monster_area = $request->query('RmonA');
        $area_1_id = $request->query('A1');
        $area_2_id = $request->query('A2');
        $area_3_id = $request->query('A3');
        $area_4_id = $request->query('A4');
        $treasure_area_number = $request->query('TrAr');
        $weapon_id = $request->query('Wea');
        $armor_id = $request->query('Arm');
        $armor_port_id = $request->query('ArmPo');
        $user_id = $request->query('UID');
        
        $posts = new Post();
        
        if ($default_level == 1) {
            $posts = $posts->where('default_level', '<=', 58);
        } 
        elseif($default_level == 2){
            $posts = $posts->where('default_level', '>', 58);
        }
        if ($left_monster_id != 1  and $left_monster_id != null) {
            $posts = $posts->where('left_monster_id', $left_monster_id);
        } 
        if ($left_monster_area != -1 and $left_monster_area != null) {
            $posts = $posts->where('left_monster_area', $left_monster_area);
        }
        if ($right_monster_id != 1 and $right_monster_id != null) {
            $posts = $posts->where('right_monster_id', $right_monster_id);
        } 
        if ($right_monster_area != -1 and $right_monster_area != null) {
            $posts = $posts->where('right_monster_area', $right_monster_area);
        }
        if ($area_1_id != 1 and $area_1_id != null) {
            $posts = $posts->where('area_1_id', $area_1_id);
        }
        if ($area_2_id != 1 and $area_2_id != null) {
            $posts = $posts->where('area_2_id', $area_2_id);
        }
        if ($area_3_id != 1 and $area_3_id != null) {
            $posts = $posts->where('area_3_id', $area_3_id);
        }
        if ($area_4_id != 1 and $area_4_id != null) {
            $posts = $posts->where('area_4_id', $area_4_id);
        }
        if ($treasure_area_number != -1 and $treasure_area_number != null) {
            $posts = $posts->where('treasure_area_number', $treasure_area_number);
        }
        if ($weapon_id != -1 and $weapon_id != null) {
            $posts = $posts->where('weapon_id', $weapon_id);
        }
        if ($armor_id != -1 and $armor_id != null) {
            $posts = $posts->where('armor_id', $armor_id);
        }
        if ($armor_port_id != -1 and $armor_port_id != null) {
            $posts = $posts->where('armor_port_id', $armor_port_id);
        }
        if ($user_id != null) {
            $posts = $posts->where('user_id', $user_id);
        } 
         
          return $posts;
    }
    
    #アカウント非公開の場合の絞り込み
    public function  user_private_filter($posts)
    {   
        $posts = $posts->whereHas('user', function ($query)
            {   
            $query->where('private', "0")->orWhere('id', Auth::id()); 
            });
        return $posts;
    }
    
    #ギルクエ一覧
    public function  getPaginateByLimitNewer(int $limit_count,$request)
    {   
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    public function  getPaginateByLimitOlder(int $limit_count,$request)
    {
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('created_at', 'ASC')->paginate($limit_count);
    }
    public function getPaginateByLimitBookmark(int $limit_count,$request)
    {   
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->paginate($limit_count);
    }
    
    #マイギルクエ一覧
    public function  getPaginateByLimitNewer_myposts(int $limit_count,$request)
    {   
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        $posts = $posts->where('user_id', Auth::id());
        return $posts->withCount('bookmarks')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    public function  getPaginateByLimitOlder_myposts(int $limit_count,$request)
    {
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        $posts = $posts->where('user_id', Auth::id());
        return $posts->withCount('bookmarks')->orderBy('created_at', 'ASC')->paginate($limit_count);
    }
    public function getPaginateByLimitBookmark_myposts(int $limit_count,$request)
    {   
        $posts = $this->filter($request);
        $posts = $this->user_private_filter($posts);
        $posts = $posts->where('user_id', Auth::id());
        return $posts->withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->paginate($limit_count);
    }
    
    #ブックマーク一覧
    public function  getPaginateByLimitNewer_mybookmark(int $limit_count,$request)
    {   
        $bookmark = new Bookmark();
        $bookmark = $bookmark->where('user_id',Auth::id())->pluck('post_id');
        $posts = $this->filter($request);
        $posts = $posts->whereIn('id', $bookmark);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    public function  getPaginateByLimitOlder_mybookmark(int $limit_count,$request)
    {
        $bookmark = new Bookmark();
        $bookmark = $bookmark->where('user_id',Auth::id())->pluck('post_id');
        $posts = $this->filter($request);
        $posts = $posts->whereIn('id', $bookmark);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('created_at', 'ASC')->paginate($limit_count);
    }
    public function getPaginateByLimitBookmark_mybookmark(int $limit_count,$request)
    {   
        $bookmark = new Bookmark();
        $bookmark = $bookmark->where('user_id',Auth::id())->pluck('post_id');
        $posts = $this->filter($request);
        $posts = $posts->whereIn('id', $bookmark);
        $posts = $this->user_private_filter($posts);
        return $posts->withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->paginate($limit_count);
    }
    
    
    public function area_1()
    {
        return $this->belongsTo(Area::class,'area_1_id');
    }
    public function area_2()
    {
        return $this->belongsTo(Area::class,'area_2_id');
    }
    public function area_3()
    {
        return $this->belongsTo(Area::class,'area_3_id');
    }
    public function area_4()
    {
        return $this->belongsTo(Area::class,'area_4_id');
    }
    public function armor()
    {
        return $this->belongsTo(Armor::class);
    }
    public function armor_port()
    {
        return $this->belongsTo(ArmorPort::class);
    }
    public function left_monster()
    {
        return $this->belongsTo(Monster::class,'left_monster_id');
    }
    public function right_monster()
    {
        return $this->belongsTo(Monster::class,'right_monster_id');
    }
    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookmarks()   
    {
        return $this->hasMany(Bookmark::class);  
    }
    
    public function isBookmarkedBy($user): bool {
        return Bookmark::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
    protected $fillable = [
    'user_id',
    'default_level',
    'left_monster_id',
    'left_monster_area',
    'right_monster_id',
    'right_monster_area',
    'area_1_id',
    'area_2_id',
    'area_3_id',
    'area_4_id',
    'treasure_area_number',
    'weapon_id',
    'armor_id',
    'armor_port_id',
    'generator',
    'remark',
    ];
}
