'use strict';

const express = require('express');
const line = require('@line/bot-sdk');
const { cachedDataVersionTag } = require('v8');
const PORT = process.env.PORT || 3000;

const config = {
    channelSecret : '4eb24c737dc1a14b83b0f3c49999e7bc',
    channelAccessToken : 'PRIh3UgVs719mUK2yZwVbxeHohKDasZGxmiZ6ahvldcfC5KNnr9X9sxlRczZWALHCEkrwk1nCZXBfqpzFYvYzcphpZdAfWIAZkbSlPtzvokKi79G8+GCw3oLxfMMxJnJsL3m197jR9Jh4xYo2/FpWgdB04t89/1O/w1cDnyilFU='
};

const app = express();

app.post('/webhook', line.middleware(config), (req, res) => {
    console.log(req.body.events);
    Promise
      .all(req.body.events.map(handleEvent))
      .then((result) => res.json(result));
});

const client = new line.Client(config);

async function handleEvent(event) {
  if (event.type !== 'message' || event.message.type !== 'text') {
    return Promise.resolve(null);
  } else{
    mes = '駅名を入れて送信してください。';
  }

  let mes =''
  if(event.message.text !== '駅'){
    mes = '【現在の' + event.message.text + 'の情報です】' + "https://www.google.com/search?q=" + event.message.text;
  }

  
  return client.replyMessage(event.replyToken, {
    type: 'text',
    text:  mes//実際に返信の言葉を入れる箇所
  });
  
}


app.listen(PORT);
console.log(`Server running at ${PORT}`);
