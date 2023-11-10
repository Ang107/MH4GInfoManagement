<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>DM詳細</title>
 
   
    </head>
    <x-app-layout> 
        <body class="bg-gray-200">
            <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow">
                <div class="w-[30%] mx-auto  space-y-3 ">
                    <h1 class="text-4xl font-semibold py-6" id='title'>
                        <a href="/users/{{$user->id}}">
                            {{$user->name}}
                        </a>
                    </h1>
                    <div class="shadow rounded-lg">
                        <div  class="overflow-y-scroll h-[60vh]">
                            <div id="scroll">
                                @foreach ($messages as $message)
                                    @if ($message->user_id == Auth::id())
                                        <div class="text-right">
                                            <p class="bg-sky-500 break-all text-white text-base text-left p-2  mr-3 max-w-[70%] rounded-t-lg rounded-bl-lg rounded-br inline-block">
                                                {{$message->body}}
                                            </p>
                                            <p class="text-right text-sm text-gray-600 pr-3">{{$message->sent_at->format('Y-m-d')}} {{$message->sent_at->format('H:i')}}</p>
                                        </div>
                                    @else
                                        <div class="text-left">
                                            <p class="bg-gray-200 break-all text-base text-left p-2 ml-3 max-w-[70%]  rounded-t-lg rounded-br-lg rounded-bl inline-block">
                                                {{$message->body}}
                                            </p>
                                            <p class="text-left text-sm text-gray-600 pl-3">{{$message->sent_at->format('Y-m-d')}} {{$message->sent_at->format('H:i')}}</p>
                                        </div>
                                    @endif
                                    <br>
                                @endforeach
                            </div>
                        </div>
                        <form action="/DM/{{ $user->id }}" method="POST">
                            @csrf
                            <input type="hidden" name="message[user_id]" value="{{Auth::id()}}" />
                            <input type="hidden" name="message[room_id]" value="{{$room->id}}" />
                            <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                @if ($room->invite_user->private == 0 and $room->invited_user->private == 0 )
                                <textarea id="chat" rows="4" name="message[body]" class="block mx-4 my-2 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="新しいメッセージを作成"></textarea>
                                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                                    </svg>
                                </button>
                                @elseif ($room->invite_user->private == 1 and $room->invite_user_id == Auth::id())
                                    <p class="text-red-500 p-2">自身の<a href="/config" class="text-blue-500 visited:text-violet-600">アカウントが非公開</a>であるため、メッセージは送信できません。</p>
                                @elseif ($room->invited_user->private == 1 and $room->invited_user_id == Auth::id())
                                    <p class="text-red-500 p-2">自身の<a href="/config" class="text-blue-500 visited:text-violet-600">アカウントが非公開</a>であるため、メッセージは送信できません。</p>
                                @else
                                    <p class="text-red-500 p-2">相手のアカウントが非公開であるため、メッセージは送信できません。</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                function scroll_under(){
                    const scroll = document.getElementById("scroll");
                    scroll.scrollIntoView(false);
                }
                scroll_under();
            </script>
        </body>
    </x-app-layout> 
</html>