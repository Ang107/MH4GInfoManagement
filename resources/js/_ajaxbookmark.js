$(function () {
    let bookmark = $('.bookmark-toggle'); //bookmark-toggleのついたiタグを取得し代入。
    let bookmarkPostId; //変数を宣言
    bookmark.on('click', function () { //onはイベントハンドラー
    
      let $this = $(this); //this=イベントの発火した要素＝iタグを代入
      bookmarkPostId = $this.data('post-id'); //iタグに仕込んだdata-post-idの値を取得
      //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/posts/bookmark', //通信先アドレスで、このURLをあとでルートで設定します
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'post_id': bookmarkPostId //いいねされた投稿のidを送る
        },
      })
      //通信成功した時の処理
      .done(function (data) {
        console.log('success');
        $this.toggleClass('bookmarked'); //bookmarkdクラスのON/OFF切り替え。
        $this.closest('.grandparent-container').find('.child-container .bookmark-counter').html(data.post_bookmarks_count);
        $this.next('.bookmark-counter').html(data.post_bookmarks_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail'); 
      });
    });
});