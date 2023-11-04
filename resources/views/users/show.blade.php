<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>ユーザープロフィール</title>
    </head>
    <x-app-layout>
    <body class="bg-gray-200">
        <div class="w-[92%]  mx-auto bg-white min-h-[90vh] shadow">
            <div class="w-[40%] mx-auto  space-y-6 ">
                <h1 class="text-4xl font-semibold my-6 inline-block align-middle">ユーザープロフィール</h1>
                @auth
                    @if (Auth::id()!=$user->id)
                        <button type="button" class="bg-gray-100 hover:bg-gray-300 text-blue-500 font-bold py-2 px-4 border-2 border-gray-400 rounded mx-6 " onclick="location.href='/DM/{{$user->id}}'">DMを送る</button>
                    @else
                        <button type="button" class="bg-gray-100 hover:bg-gray-300 text-blue-500 font-bold py-2 px-4 border-2 border-gray-400 rounded mx-6 " onclick="location.href='/users/edit'">編集</button>
                    @endif
                @endauth
   
                <table class="w-full text-xl my-6 shadow">
                    <tr class="border border-gray-400 divide-x divide-y">
                        <th class="px-2 py-2.5 w-[30%]">ユーザーID：</th>
                        <td class="px-2 py-2.5 w-[70%]">{{$user->id}}</td>
                    </tr>
                    <tr class="border border-gray-400 divide-x divide-y">
                        <th class="px-2 py-2.5 w-[30%]">名前：</th>
                        <td class="px-2 py-2.5 w-[70%]">{{$user->name}}</td>
                    </tr>
                    
                    <tr class="border border-gray-400 divide-x divide-y">
                        <th class="px-2 py-2.5 w-[30%]">自己紹介：</th>
                        <td class="px-2 py-2.5 w-[70%]">{{$user->profile}}</td>
                    </tr>
                </table>
                    
                    <form method="GET" id="sort_filter" action="/posts">
                        @csrf
                        <input type="hidden" name="UID" value="{{$user->id}}">
                        <a href="javascript:sort_filter.submit()"  class="text-2xl my-6 block text-blue-500 visited:text-violet-600">投稿したギルクエ</a>
                    </form>

            </div>
        </div>
        
 
    </body>
    </x-app-layout>
</html>