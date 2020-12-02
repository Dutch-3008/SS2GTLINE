var CHANNEL_ACCESS_TOKEN = "ここにチャンネルアクセストークンを";
//webhook_urlから送られた場合
function doPost(e) {
  var reply_token= JSON.parse(e.postData.contents).events[0].replyToken;
  //きたメッセージを取得
  var user_message = JSON.parse(e.postData.contents).events[0].message.text;
  var mes = search(user_message);
  var url = 'https://api.line.me/v2/bot/message/reply';
  UrlFetchApp.fetch(url, {
    'headers': {
      'Content-Type': 'application/json; charset=UTF-8',
      'Authorization': 'Bearer ' + CHANNEL_ACCESS_TOKEN,
    },
    'method': 'post',
    'payload': JSON.stringify({
      'replyToken': reply_token,
      'messages': [{
        'type': 'text',
        'text': mes,
      }],
    }),
  });
  return ContentService.createTextOutput(JSON.stringify({'content': 'post ok'})).setMimeType(ContentService.MimeType.JSON);
}
function search(mes){
  //エラー処理
  try{
    var response = UrlFetchApp.fetch("https://www.google.com/search?q=" + mes);
  }

  //作成したメッセージをFormular_botに返す
  var meseage = 'こんなのどうでしょう?' + '【' + title + '】' + url;
  return meseage;  
}