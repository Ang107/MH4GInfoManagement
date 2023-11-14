<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>DM一覧</title>
    </head>
    <x-app-layout> 
        <body class="bg-gray-200">
            <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow">
                <div class="w-[40%] mx-auto  space-y-6 ">
                    <h1 class="text-4xl font-semibold py-6" id='title'>DM一覧</h1>
                    <table class="w-full  border-collapse  rounded shadow text-lg text-gray-700">
                        @foreach ($rooms as $room)
                            @if ($room->last_sent_message != null)
                                @if (Auth::id() != $room->invite_user_id)
                                        <tr class="hover:bg-gray-300 border-b rounded-lg bg-gray-100">
                                            <td class="w-[25%] rounded-l-lg">
                                                <a class="block w-full h-full text-center p-2 text-blue-500 visited:text-violet-600" href="/users/{{$room->invite_user->id}}">
                                                    {{$room->invite_user->name}}
                                                </a>
                                            </td>
                                            <td class="w-[50%] ">
                                                <a class="block w-full h-full py-3 text-gray-500" href="/DM/{{$room->invite_user->id}}">
                                                    {{$room->last_sent_message}}
                                                </a>
                                            </td>
                                            <td class="w-[25%] rounded-r-lg">
                                                <a class="block w-full h-full py-1 text-center" href="/DM/{{$room->invite_user->id}}">
                                                    {{$room->last_sent_at->format('Y-m-d')}}<br>{{$room->last_sent_at->format('H:i')}}
                                                </a>
                                            </td>
                                        </tr>
                                @else
                                    <tr class="hover:bg-gray-300 border-b rounded-lg bg-gray-100">
                                        <td class="w-[25%] rounded-l-lg">
                                            <a class="block w-full h-full p-2 text-center text-blue-500 visited:text-violet-600" href="/users/{{$room->invited_user->id}}">
                                                {{$room->invited_user->name}}
                                            </a>
                                        </td>
                                        <td class="w-[50%]">
                                            <a class="block w-full h-full py-3 text-gray-500" href="/DM/{{$room->invited_user->id}}">
                                                {{$room->last_sent_message}}
                                            </a>
                                        </td>
                                        <td class="w-[25%] rounded-r-lg">
                                            <a class="block w-full h-full py-1 text-center" href="/DM/{{$room->invited_user->id}}">
                                                {{$room->last_sent_at->format('Y-m-d')}}<br>{{$room->last_sent_at->format('H:i')}}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach 
                    </table>
                    
                </div>
            </div>

        </body>
    </x-app-layout> 
</html>