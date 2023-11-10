<nav x-data="{ open: false }" class="w-full" >
    <div class="bg-gray-700 border-t  flex flex-row justify-center">
          <div class="p-6">
            <h3 class="text-blue-200 text-base font-semibold ">サイトマップ</h3>
            <div class="inline-block">
                <p>
                <a href="/home" class="text-slate-50/75 hover:text-slate-50/100 text-base">ホーム</a>
                </p>
                <p>
                    <a href="/posts/create" class="text-slate-50/75 hover:text-slate-50/100 text-base">新規ギルクエ投稿</a>
                </p>
                <p>
                    <a href="/posts" class="text-slate-50/75 hover:text-slate-50/100 text-base">ギルクエ一覧</a>
                </p>
                <p>
                    <a href="/" class="text-slate-50/75 hover:text-slate-50/100 text-base">DM一覧</a>
                </p>
            </div>
            <div class="inline-block pl-6">
                <p>
                <a href="/users/{{Auth::id()}}" class="text-slate-50/75 hover:text-slate-50/100 text-base">マイプロフィール</a>
                </p>
                <p>
                    <a href="/posts/myposts" class="text-slate-50/75 hover:text-slate-50/100 text-base">マイギルクエの管理</a>
                </p>
                <p>
                    <a href="/posts/mybookmark" class="text-slate-50/75 hover:text-slate-50/100 text-base">ブクマしたギルクエ</a>
                </p>
                <p>
                    <a href="/config" class="text-slate-50/75 hover:text-slate-50/100 text-base">アカウント設定</a>
                </p>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-blue-200 text-base font-semibold " >コンタクト</h3>
            <p class="text-slate-50  text-base">ご意見、バグ報告などは<a class="text-blue-400 hover:text-slate-50/100" href="https://forms.gle/doToYY76ZVRL7ZPeA">コチラ</a>のフォームからご連絡ください。</p>
        </div>
    </div>
    <div class="bg-gray-900 border-t text-white flex justify-center py-2">
        <p>Copyright © 2023 MH4G情報管理.com. All Rights Reserved.</p>
    </div>
  

</nav>
