function myFunction() {
  var CHANNEL_ACCESS_TOKEN = "ASk / zs9tVto / qnxaLsVtMeW15jLfL0BOQ8gn5g85zjCPnpHAzO2GJFLi0DVVf4AgCEkrwk1nCZXBfqpzFYvYzcphpZdAfWIAZkbSlPtzvomTPpTrJ2e8lnh";
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
  try{
    var response = UrlFetchApp.fetch("https://www.google.com/search?q=" + mes);
  }
   catch(e){//エラーが出たら
    return "検索エラー(コンパス 調べたい駅名でお願いします。)";
  }

  //作成したメッセージをFormular_botに返す
  var meseage = '駅の情報はこのようになっています。' + url;
  return meseage;  
}
}
