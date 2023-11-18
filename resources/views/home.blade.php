<?php
  //カウント数が記録してあるファイルを読み書きできるモードで開く
  $fp = fopen('count.dat', 'r+b');

  //ファイルを排他ロックする
  flock($fp, LOCK_EX);

  //ファイルからカウント数を取得する
  $count = fgets($fp);

  //カウント数を1増やす
  $count++;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>ホーム / MH4G情報管理.com</title>
     
        @vite(['resources/css/app.css','resources/js/_ajaxbookmark.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <x-app-layout>
    <body class="bg-gray-200">
        <div class="w-[92%] min-h-[85vh] mx-auto bg-white shadow">
            <div class="w-[50%] mx-auto  space-y-6 pb-8">
                <h1 class="text-4xl font-semibold py-6">ホーム</h1>
                <div>
                    <p class="text-xl font-semibold">総来場者数 : <span class="text-xl text-red-500"><?php echo $count; ?></span></p>
                </div>
                <div class="shadow space-y-4 rounded-lg">
                    <h2 class="text-2xl font-semibold py-3 bg-blue-200  rounded-lg"><このサイトでできること></h2>
                
                    <div class="border-b">
                        <h3 class="text-xl font-semibold px-2">ギルクエ投稿</h3>
                        <p class="text-lg py-2 px-6 ">
                            <a href="/posts/create" class="text-blue-500 visited:text-violet-600">こちら</a>からギルドクエスト情報を投稿するこどができます。
                            <br>
                            自分の投稿したギルクエは、<a href="/posts/myposts" class="text-blue-500 visited:text-violet-600">こちら</a>から閲覧、管理することができ、絞り込みや並び替えに対応しています。
                        </p>
                    </div>
                    <div class="border-b">
                        <h3 class="text-xl font-semibold px-2">ギルクエ閲覧</h3>
                        <p class="text-lg py-2 px-6 ">
                            <a href="/posts" class="text-blue-500 visited:text-violet-600">こちら</a>から自分や他の人が投稿したギルクエを見ることができます。
                            <br>
                            絞り込みや並び替えに対応しており、気に入ったクエストはブックマークをすることができます。
                            <br>
                            ブクマしたギルクエは<a href="/posts/mybookmark" class="text-blue-500 visited:text-violet-600">こちら</a>から閲覧できます。
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold px-2">ダイレクトメッセージ</h3>
                        <p class="text-lg py-2 px-6 ">
                            DMを送受信できます。
                            <br>
                            自分の欲しいギルクエを投稿した人にDMを送ることで、譲渡や交換の依頼を行えます。
                            <br>
                            （DM機能を利用するには、<a href="/config" class="text-blue-500 visited:text-violet-600">こちら</a>からアカウントを公開に設定する必要があります。）
                        </p>
                    </div>
                </div>
                
                
                <div class="shadow  rounded-lg ">
                    <h2 class="text-2xl font-semibold py-3 bg-blue-200  rounded-lg"><更新履歴></h2>
                    <div class="overflow-y-scroll h-[20vh]">
                       <div class="">
                            <p class="text-xl text-red-500 font-semibold pl-6 inline-block py-2">2023-11-18 : </p>
                            <p class="text-xl inline-block py-2">リリース開始！</p>
                        </div> 
                        
                    </div>
                    
                    
                </div>
                
               
                
   
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
       
    </body>
    </x-app-layout>
</html>
<?php
  //ポインターをファイルの先頭に戻す
  rewind($fp);

  //最新のアクセス数をファイルに書き込む
  fwrite($fp, $count);

  //ファイルのロックを解除する
  flock($fp, LOCK_UN);

  //ファイルを閉じる
  fclose($fp);
?>