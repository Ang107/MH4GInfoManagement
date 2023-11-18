<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>ギルクエ詳細 / MH4G情報管理.com</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="../../../css/posts/show.css" type="text/css">
        @vite(['resources/css/app.css','resources/js/_ajaxbookmark.js'])
    </head>
    <x-app-layout> 
        <body class="bg-gray-200">
            <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow pb-8">
                <div class="w-[40%] mx-auto  space-y-6 ">
                    <h1 class="inline-block align-middle text-4xl font-semibold py-6">ギルクエ詳細</h1>
                    <div id="bookmark-button" class="inline-block p-2 my-0 mx-4 align-middle border rounded-lg">
                        @auth
                        <!-- Post.phpに作ったisbookmarkdByメソッドをここで使用 -->
                            @if (!$post->isBookmarkedBy(Auth::user()))
                                <span class="bookmarks">
                                    <i class="px-2 fas fa-star  star text-2xl bookmark-toggle " data-post-id="{{ $post->id }}"></i>
                                    <span class="px-2 bookmark-counter text-xl">{{$post->bookmarks->count()}}</span>
                                </span><!-- /.bookmarks -->
                            @else
                                <span class="bookmarks">
                                    <i class="px-2 fas fa-star star text-2xl bookmark-toggle bookmarked" data-post-id="{{ $post->id }}"></i>
                                    <span class="px-2 bookmark-counter text-xl">{{$post->bookmarks->count()}}</span>
                               
                                </span><!-- /.bookmarks -->
                            @endif
                        @endauth
                    </div>
                    <span class="block align-middle flex justify-between">
                        @auth
                            @if (Auth::id()!=$post->user->id)
                                <button type="button" class="bg-gray-100 hover:bg-gray-300 text-blue-500 font-bold py-2 px-4 border-2 border-gray-400 rounded ml-6 " onclick="location.href='/DM/{{$post->user_id}}'">投稿者にDMを送る</button>
                            @else
                                <button type="button" class="bg-gray-100 hover:bg-gray-300 text-blue-500 font-bold py-2 px-4 border-2 border-gray-400 rounded ml-3" onclick="location.href='/posts/{{ $post->id }}/edit'">
                                    編集
                                </button>
                                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deletePost({{ $post->id }})" class="bg-gray-100 hover:bg-gray-300 text-red-600 font-bold py-2 px-4 border-2 border-gray-400 rounded mr-3 ">削除</button> 
                                </form>
                            @endif
                        @endauth
                    </span>
                    
                    
                    <table class="shadow  w-full  text-xl text-center ">
                        <tr class="border-b ">
                            <td class="w-[50%]">
                                <p  class="block m-3 mx-3 mb-0 text-xl font-semibold text-gray-900 ">投稿日時</p>
                            </td>
                            <td  class="px-2 ">
                                {{ $post->created_at}}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td>
                                <p  class="block  m-3 mb-0 text-xl font-semibold text-gray-900 ">投稿者</p>
                            </td>
                            <td  class=" px-2 ">
                                <a href="/users/{{$post->user->id}}" class="text-blue-500 visited:text-violet-600">{{ $post->user->name}}</a>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td>
                                <p for="Level" class="block m-3 mb-0 text-xl font-semibold text-gray-900 ">初期レベル</p>
                            </td>
                            <td >{{ $post->default_level}}</td>
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="LMonster" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">左モンスター/初期エリア</p>
                            </td>
                            @if ( $post->left_monster_area == -1)
                                <td class="">{{ $post->left_monster->name}}---</td>
                            @else
                                <td class="">{{ $post->left_monster->name}}-{{ $post->left_monster_area}}</td>
                            @endif
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="RMonster" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">右モンスター/初期エリア</p>
                            </td>
                            @if ( $post->right_monster_area == -1 )
                                <td class="">{{ $post->right_monster->name}}---</td>
                            @else
                                <td class="">{{ $post->right_monster->name}}-{{ $post->right_monster_area}}</td>
                            @endif
                        </tr>
                        <tr class="border-b ">
                            <td >
                                <p class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">エリア構成</p>
                            </td>
                            <td  class="area">{{ $post->area_1->name}}-{{ $post->area_2->name}}-{{ $post->area_3->name}}-{{ $post->area_4->name}}</td>
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="TreasureArea" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">お宝エリアの場所</p>
                            </td>
                            @if ( $post->treasure_area_number == -1)
                                <td class="treasure_area_number ">-不明-</td>
                            @else
                                <td class="treasure_area_number">{{ $post->treasure_area_number}}</td>
                            @endif
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="Weapon" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">入手できる武器</p>
                            </td>
                            <td class="weapon">{{ $post->weapon->name}}</td>
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="Armor" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">入手できる防具/部位</p>
                            </td>
                            <td class="armor">{{ $post->armor->name}}-{{ $post->armor_port->name}}</td>
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="generator" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">作成者</p>
                            </td>
                            <td  class="generator">{{ $post->generator}}</td>
                        </tr>
                        <tr class="border-b ">
                            <td>
                                <p for="remark" class=" m-3 mb-0 text-xl font-semibold text-gray-900 ">備考</p>
                            </td>
                            <td class="text-left remark px-4 py-2.5">{{ $post->remark}}</td>
                        </tr>
                    </table>
                    
                
                </div>
            </div>
            <script>
                function deletePost(id) {
                    'use strict'
            
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
        </body>
    </x-app-layout> 
</html>