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
            <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow">
                <div class="w-[40%] mx-auto  space-y-6 ">
                    <h1 class="inline-block align-middle text-4xl font-semibold py-6">新規ギルクエ投稿</h1>
                    <div>
                        <form action="/posts" method="POST">
                            @csrf
                            <input type="hidden" name="post[user_id]" value="{{Auth::id()}}" />
                            <p class="text-red-500 text-right ">赤枠の項目は入力必須です。</p>
                            <table class="shadow  w-full  ">
                                <tr class="border-b ">
                                    <td>
                                        <label for="Level" class="block mx-3 mb-0 text-xl font-semibold text-gray-900 ">初期レベル</label>
                                    </td>
                                    <td>
                                        <input type="text" name='post[default_level]' id="Level" class="w-[30%] ml-4 my-3 rounded  cursor-pointer">
                                    </td>
                                </tr>
                                <tr class="border-b ">
                                    <td>
                                        <label for="LMonster" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">左モンスター/初期エリア</label>
                                    </td>
                                    <td>
                                        <select name='post[left_monster_id]' id="LMonster" class="ml-4  my-3 rounded cursor-pointer border-red-500">
                                            @foreach($monsters as $monster)
                                                <option value="{{$monster->id}}">{{$monster->name}}</option>
                                            @endforeach
                                        </select>
                                        <select name='post[left_monster_area]' id="LMonsterArea" class="rounded ml-2  my-3  cursor-pointer">
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
                                        <select name='post[right_monster_id]' id="RMonster" class="ml-4 my-3 rounded cursor-pointer">
                                            @foreach($monsters as $monster)
                                                <option value="{{$monster->id}}">{{$monster->name}}</option>
                                            @endforeach
                                        </select>
                                        <select name='post[right_monster_area]' id="RMonsterArea" class="rounded ml-2  my-3  cursor-pointer">
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
                                        <select name='post[area_1_id]' id="Area1" class="w-[20%] ml-4 mb-3 rounded  cursor-pointer">
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach 
                                        </select>
                                        
                                        <select name='post[area_2_id]' id="Area2" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach 
                                        </select>
                                        
                                        <select name='post[area_3_id]' id="Area3" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach 
                                        </select>
                                        
                                        <select name='post[area_4_id]' id="Area4" class="w-[20%] ml-2 mb-3 rounded  cursor-pointer">
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
                                        <select name='post[treasure_area_number]' id="TreasureArea" class=" ml-4 my-3 rounded  cursor-pointer">
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
                                        <select name='post[weapon_id]' id="Weapon" class=" ml-4 my-3 rounded  cursor-pointer border-red-500">
                                        <option hidden value="-1">-----</option>
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
                                        <select name='post[armor_id]' id="Armor" class=" ml-4 my-3 rounded  cursor-pointer border-red-500">
                                            <option hidden value="-1">-----</option>
                                            @foreach($armors as $armor)
                                                <option value="{{$armor->id}}">{{$armor->name}}</option>
                                            @endforeach 
                                        </select>
                                        <select name='post[armor_port_id]' id="ArmorPort" class=" ml-2 my-3 rounded  cursor-pointer border-red-500">
                                            <option hidden value="-1">---</option>
                                            @foreach($armor_ports as $armor_port)
                                                <option value="{{$armor_port->id}}">{{$armor_port->name}}</option>
                                            @endforeach 
                                        </select>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td>
                                        <label for="generator" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">作成者</label>
                                    </td>
                                    <td>
                                        <input type="text" name='post[generator]' id="generator" class="w-[30%] ml-4 my-3 rounded  cursor-pointer">
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td>
                                        <label for="remark" class=" mx-3 mb-0 text-xl font-semibold text-gray-900 ">備考</label>
                                    </td>
                                    <td>
                                        <textarea id="remark" rows=4 maxlength="250" name='post[remark]' class="ml-4 my-3 block p-2.5 w-[80%] text-left text-xl text-gray-900 bg-gray-50 rounded-lg  focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <div class="flex items-center justify-center p-6 space-x-2 border-t  ">
                                <input type="submit" value="投稿" class="mx-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-2 border-gray-400 rounded"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
            if ("{{ old('post.default_level')}}" != ""){
                document.getElementById('Level').value ="{{ old('post.default_level')}}";
            }
            if ("{{ old('post.left_monster_id')}}" != ""){
                document.getElementById('LMonster').value = "{{ old('post.left_monster_id')}}";
            }
            if ("{{ old('post.left_monster_area')}}" != ""){
                document.getElementById('LMonsterArea').value = "{{ old('post.left_monster_area')}}";
            }
            if ("{{ old('post.right_monster_id')}}" != ""){
                document.getElementById('RMonster').value = "{{ old('post.right_monster_id')}}";
            }
            if ("{{ old('post.right_monster_area')}}" != ""){
                document.getElementById('RMonsterArea').value = "{{ old('post.right_monster_area')}}";
            }
            if ("{{ old('post.area_1_id')}}" != ""){
                document.getElementById('Area1').value = "{{ old('post.area_1_id')}}";
            }
            if ("{{ old('post.area_2_id')}}"!= ""){
                document.getElementById('Area2').value = "{{ old('post.area_2_id')}}";
            }
            if ("{{ old('post.area_3_id')}}" != ""){
                document.getElementById('Area3').value = "{{ old('post.area_3_id')}}";
            }
            if ("{{ old('post.area_4_id')}}" != ""){
                document.getElementById('Area4').value = "{{ old('post.area_4_id')}}";
            }
            if ("{{ old('post.treasure_area_number')}}" != ""){
                document.getElementById('TreasureArea').value = "{{ old('post.treasure_area_number')}}";
            }
            if ("{{ old('post.weapon_id')}}" != ""){
                document.getElementById('Weapon').value = "{{ old('post.weapon_id')}}";
            }
            if ("{{ old('post.armor_id')}}" != ""){
                document.getElementById('Armor').value = "{{ old('post.armor_id')}}";
            }
            if ("{{ old('post.armor_port_id')}}" != ""){
                document.getElementById('ArmorPort').value = "{{ old('post.armor_port_id')}}";
            }
            if ("{{ old('post.generator')}}" != ""){
                document.getElementById('generator').value = "{{ old('post.generator')}}";
            }
            </script>
        </body>
    </x-app-layout> 
</html>