<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>プロフィール編集</title>
    </head>
    <x-app-layout>
    <body class="bg-gray-200">
        <div class="w-[92%]  mx-auto bg-white min-h-[90vh] shadow">
            <div class="w-[30%] mx-auto  space-y-6 ">
                <h1 class="text-4xl font-semibold py-6 inline-block align-middle">プロフィール編集</h1>
                <div class="w-full">
                @auth
                    
                        <form action="/users/{{ Auth::id() }}" class="space-y-6 " method="POST">
                            @csrf
                            @method('PUT')
                            <div class='user_name'>
                                <label for="name" class="block mb-2 text-xl font-medium text-gray-900 " >名前</label>
                                <input type='text' name='user[name]' value="{{ Auth::user()->name }}" maxlength="8" class="block p-2.5  text-left text-xl text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"/>
                            </div>
                            <div class='user_profile'>
                                <label for="profile" class="block mb-2 text-xl font-medium text-gray-900 ">自己紹介</label>
                                <textarea id="profile" rows=7 maxlength="400" name='user[profile]' class="block p-2.5 w-full text-left text-xl text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ Auth::user()->profile }}</textarea>
                            </div>
                            
                            <input type="submit" value="保存" class=" inline bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border-2 border-gray-400 rounded "/>
                            <button type="button" onclick="location.href='/users/{{ Auth::id() }}'" class="inline  bg-gray-100 hover:bg-gray-300 text-balck font-bold py-2 px-4 border-2 border-gray-400 rounded mx-6"/>
                                キャンセル
                            </button>
                        </form>

                @endauth
                </div>
            </div>
        </div>
        
 
    </body>
    </x-app-layout>
</html>