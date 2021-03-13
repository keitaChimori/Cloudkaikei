$(function AddBtn(){
  //DOM要素を取得し、指定した要素の後ろに増やしたいhtmlタグをclickイベント時に追加
  $(document).on('click', 'DOM要素', function(){    //要素名を指定
    // 追加するhtmlを変数に格納
    var tr = ''+
    '<tr>'+
      '<td><input type="" name=""></td>'+
      '<td><input type="" name=""></td>'+
      '<td><input type="" name=""></td>'+
      '<td><input type="" name=""></td>'+
      '<td><button type="submit"></td>'+
    '</tr>';
    /*イベント発生時に操作を行った要素(おそらく追加ボタンはtd要素に追加するとおもうので)の親要素の後ろに
    作成したhtmlを追加*/
    $(this).closest("tr").after($(tr));
  })
});