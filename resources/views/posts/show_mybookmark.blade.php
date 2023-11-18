<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>ブクマしたギルクエ / MH4G情報管理.com</title>
        <link rel="stylesheet" href="/css/posts/index.css" type="text/css">
        @vite(['resources/css/app.css','resources/js/_ajaxbookmark.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <x-app-layout>
    <body class="bg-gray-200">
        <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow">
            <div class="w-[95%] mx-auto  space-y-6">
                <h1 class="text-4xl font-semibold py-6" id='title'>ブクマしたギルクエ</h1>
                
                    <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="bg-gray-100 hover:bg-gray-300 text-blue-500 font-bold py-2 px-4 border-2 border-gray-400 rounded ">絞り込み</button>
                <form id="sort_filter" action="/posts/mybookmark" method="GET" class="inline-block">
                    @csrf
                    <select name='sort' id="sort_id" class="mx-4 rounded cursor-pointer" onchange="submit(this.form)">
                        @if($sort == 'newer')
                            <option value="newer" selected>日付が新しい順</option>
                            <option value="older">日付が古い順</option>
                            <option value="more_bookmark">ブックマークが多い順</option>
                        @elseif($sort == 'older')
                            <option value="newer">日付が新しい順</option>
                            <option value="older" selected>日付が古い順</option>
                            <option value="more_bookmark">ブックマークが多い順</option>
                        @elseif($sort == 'more_bookmark')
                            <option value="newer">日付が新しい順</option>
                            <option value="older">日付が古い順</option>
                            <option value="more_bookmark" selected>ブックマークが多い順</option>
                        @endif
                    </select>
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-3xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow ">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t bg-gray-100">
                                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                        絞り込み
                                    </h3>
                                    <button type="button" class="text-gray-500 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="defaultModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="">
                                    <button type="button" onclick="filterReset()" class="block bg-gray-100 hover:bg-gray-300 text-red-600 font-bold mt-4 mb-2 ml-auto mr-[5%] py-2 px-4 border-2 border-gray-400 rounded">検索条件をリセット
                                    </button>
                                    <table class="shadow w-[90%] mx-auto mb-8  ">
                                        <tr class="border-b ">
                                            <td>
                                                <label for="Level" class="block mx-3 mb-0 text-xl font-semibold text-gray-900 ">初期レベル</label>
                                            </td>
                                            <td>
                                                <select name='Lv' id="Level" class="ml-4 my-3 rounded cursor-pointer">
                                                    <option value="-1">-----</option>
                                                    <option value="1">58 ↓ (上位下位)</option>
                                                    <option value="2">59 ↑ (G級)</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <label for="LMonster" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">左モンスター/初期エリア</label>
                                            </td>
                                            <td>
                                                <select name='Lmon' id="LMonster" class="ml-4  my-3 rounded cursor-pointer">
                                                    @foreach($monsters as $monster)
                                                        <option value="{{$monster->id}}">{{$monster->name}}</option>
                                                    @endforeach
                                                </select>
                                                <select name='LmonA' id="LMonsterArea" class="rounded ml-2  my-3  cursor-pointer">
                                                    <option value="-1">---</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <label for="RMonster" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">右モンスター/初期エリア</label>
                                            </td>
                                            <td>
                                                <select name='Rmon' id="RMonster" class="ml-4 my-3 rounded cursor-pointer">
                                                    @foreach($monsters as $monster)
                                                        <option value="{{$monster->id}}">{{$monster->name}}</option>
                                                    @endforeach
                                                </select>
                                                <select name='RmonA' id="RMonsterArea" class="rounded ml-2  my-3  cursor-pointer">
                                                    <option value="-1">---</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class=" ">
                                            <td rowspan="2">
                                                <label class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">エリア構成</label>
                                            </td>
                                            <td>
                                                <label for="Area1" class="w-[20%] inline-block ml-4 mt-3 align-bottom text-base font-semibold text-gray-900 ">エリア1</label>
                                                <label for="Area2" class="w-[20%] inline-block ml-2 mt-3 align-bottom text-base font-semibold text-gray-900 ">エリア2</label>
                                                <label for="Area3" class="w-[20%] inline-block ml-2 mt-3 align-bottom text-base font-semibold text-gray-900 ">エリア3</label>
                                                <label for="Area4" class="w-[20%] inline-block ml-2 mt-3 align-bottom text-base font-semibold text-gray-900 ">エリア4</label>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <select name='A1' id="Area1" class="w-[20%] ml-4 mb-3 rounded  cursor-pointer">
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach 
                                                </select>
                                                
                                                <select name='A2' id="Area2" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach 
                                                </select>
                                                
                                                <select name='A3' id="Area3" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach 
                                                </select>
                                                
                                                <select name='A4' id="Area4" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                                    @endforeach 
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <label for="TreasureArea" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">お宝エリアの場所</label>
                                            </td>
                                            <td>
                                                <select name='TrAr' id="TreasureArea" class=" ml-4 my-3 rounded  cursor-pointer">
                                                    <option value="-1">---</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <label for="Weapon" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">入手できる武器</label>
                                            </td>
                                            <td>
                                                <select name='Wea' id="Weapon" class=" ml-4 my-3 rounded  cursor-pointer">
                                                <option value="-1">-----</option>
                                                @foreach($weapons as $weapon)
                                                    <option value="{{$weapon->id}}">{{$weapon->name}}</option>
                                                @endforeach 
                                            </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b ">
                                            <td>
                                                <label for="Armor" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">入手できる防具/部位</label>
                                            </td>
                                            <td>
                                                <select name='Arm' id="Armor" class=" ml-4 my-3 rounded  cursor-pointer">
                                                    <option value="-1">-----</option>
                                                    @foreach($armors as $armor)
                                                        <option value="{{$armor->id}}">{{$armor->name}}</option>
                                                    @endforeach 
                                                </select>
                                                <select name='ArmPo' id="ArmorPort" class=" ml-2 my-3 rounded  cursor-pointer">
                                                    <option value="-1">---</option>
                                                    @foreach($armor_ports as $armor_port)
                                                        <option value="{{$armor_port->id}}">{{$armor_port->name}}</option>
                                                    @endforeach 
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td>
                                                <label for="UserID" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">投稿者のID</label>
                                            </td>
                                            <td>
                                                <input type="text" name='UID' id="UserID" class="w-[30%] ml-4 my-3 rounded ">
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b bg-gray-200">
                                    <input type="submit" value="この条件で検索" class="mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-2 border-gray-400 rounded"/>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($posts->count() == 0)
                    <p class="text-4xl text-center font-semibold py-6" id='title'>該当するギルドクエストがありません</p>
                @else
                <table  class="w-full text-center border-collapse border divide-x divide-y shadow">
                    <tr class="border divide-x divide-y bg-cyan-100">
                        <th class="border" rowspan="2">投稿日</th>
                        <th class="border" rowspan="2">投稿者</th>
                        <th class="border" rowspan="2">初期レベル</th>
                        <th class="border" colspan="2">左モンスター</th>
                        <th class="border" colspan="2">右モンスター</th>
                        <th class="border" rowspan="2">エリア</th>
                        <th class="border" rowspan="2">宝</th>
                        <th class="border" rowspan="2">武器</th>
                        <th class="border" rowspan="2">防具</th>
                        <th class="border" rowspan="2">作成者</th>
                        <th class="border" rowspan="2">ブクマ数</th>
                        <th class="border" rowspan="2">ブクマ</th>
                        <th class="border" rowspan="2"></th>
                    </tr>
                    <tr class="border divide-x divide-y bg-cyan-100">
                        <th >モンスター名</th>
                        <th >初期エリア</th>
                        <th >モンスター名</th>
                        <th >初期エリア</th>
                    </tr>
                    @foreach ($posts as $post)
                        <tr class="border divide-x divide-y odd:bg-gray-100 even:bg-white grandparent-container">
                            <td class="created_at px-2 py-2.5 w-[8%] ">{{ $post->created_at->format('Y-m-d')}}</td>
                            <td class="user  px-2 py-2.5  w-[8%]">
                                <a href="/users/{{$post->user->id}}" class="text-blue-500 visited:text-violet-600">{{ $post->user->name}}</a>
                            </td>
                            <td class="default_level px-2 py-2.5 w-[6%]">{{ $post->default_level}}</td>
                            <td class="monster px-2 py-2.5 w-[9%]">{{ $post->left_monster->name}}</td>
                            @if ( $post->left_monster_area == -1)
                                <td class="monster_area px-2 py-2.5 w-[5%]">---</td>
                            @else
                                <td class="monster_area px-2 py-2.5 w-[5%]">{{ $post->left_monster_area}}</td>
                            @endif
                            <td class="monster px-2 py-2.5  w-[9%]">{{ $post->right_monster->name}}</td>
                            @if ( $post->right_monster_area == -1)
                                <td class="monster_area px-2 py-2.5 w-[5%]">---</td>
                            @else
                                <td class="monster_area px-2 py-2.5 w-[5%]">{{ $post->right_monster_area}}</td>
                            @endif
                            <td class="area px-2 py-2.5 w-[9%]">{{ $post->area_1->name}}-{{ $post->area_2->name}}-{{ $post->area_3->name}}-{{ $post->area_4->name}}</td>
                            @if ( $post->treasure_area_number == -1)
                                <td class="treasure_area_number px-2 py-2.5 w-[5%]">-不明-</td>
                            @else
                                <td class="treasure_area_number px-2 py-2.5 w-[5%]">{{ $post->treasure_area_number}}</td>
                            @endif
                            <td class="weapon px-2 py-2.5 w-[6%]">{{ $post->weapon->name}}</td>
                            <td class="armor px-2 py-2.5 w-[8%]">{{ $post->armor->name}}{{ $post->armor_port->name}}</td>
                            <td class="generator px-2 py-2.5 w-[8%]">{{ $post->generator}}</td>
                            <td class="px-2 py-2.5 w-[5%] child-container">
                                <span id="bookmark_count_id" class="bookmark-counter ">{{$post->bookmarks_count}}</span>
                                </span>
                            </td>
                            <td class="bookmark_buuton px-2  w-[5%]">
                                @auth
                                <!-- Post.phpに作ったisbookmarkdByメソッドをここで使用 -->
                                    @if (!$post->isBookmarkedBy(Auth::user()))
                                        <span class="bookmarks">
                                            <i class="fas fa-star  star text-2xl bookmark-toggle " data-post-id="{{ $post->id }}"></i>
                                        </span><!-- /.bookmarks -->
                                    @else
                                        <span class="bookmarks">
                                            <i class="fas fa-star star text-2xl bookmark-toggle bookmarked" data-post-id="{{ $post->id }}"></i>
                                        </span><!-- /.bookmarks -->
                                    @endif
                                @endauth
                            </td>
                            <td class="detail py-2.5 ">
                                <a class="text-blue-500 visited:text-violet-600" href="/posts/{{ $post->id }}">詳細</a>
                            </td>
                        </tr>
    
                    @endforeach
                </table>
                <div class='paginate flex justify-center pb-8' >
                    {{ $posts->appends(request()->query())->links()}}
                </div>
                @endif
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
        <script>
            
            document.getElementById('UserID').value = "{{ $request->query('UID')}}";
            document.getElementById('Level').value = "{{ $request->query('Lv')}}";
            document.getElementById('LMonster').value = "{{ $request->query('Lmon')}}";
            document.getElementById('LMonsterArea').value = "{{$request->query('LmonA')}}";
            document.getElementById('RMonster').value = "{{ $request->query('Rmon')}}";
            document.getElementById('RMonsterArea').value = "{{ $request->query('RmonA')}}";
            document.getElementById('Area1').value = "{{$request->query('A1')}}";
            document.getElementById('Area2').value = "{{$request->query('A2')}}";
            document.getElementById('Area3').value = "{{$request->query('A3')}}";
            document.getElementById('Area4').value = "{{$request->query('A4')}}";
            document.getElementById('TreasureArea').value = "{{ $request->query('TrAr')}}";
            document.getElementById('Weapon').value = "{{$request->query('Wea')}}";
            document.getElementById('Armor').value = "{{$request->query('Arm')}}";
            document.getElementById('ArmorPort').value = "{{ $request->query('ArmPo')}}";
            
            
            function filterReset(){
                document.getElementById('Level').value = -1;
                document.getElementById('LMonster').value = 1;
                document.getElementById('LMonsterArea').value = -1;
                document.getElementById('RMonster').value = 1; 
                document.getElementById('RMonsterArea').value = -1;
                document.getElementById('Area1').value = 1;
                document.getElementById('Area2').value = 1;
                document.getElementById('Area3').value = 1;
                document.getElementById('Area4').value = 1;
                document.getElementById('TreasureArea').value = -1;
                document.getElementById('Weapon').value = -1;
                document.getElementById('Armor').value = -1;
                document.getElementById('ArmorPort').value = -1;
                document.getElementById('UserID').value = '';
            }
        </script>
    </body>
    </x-app-layout>
</html>