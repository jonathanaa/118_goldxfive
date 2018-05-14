##參考https://ithelp.ithome.com.tw/articles/10191922

import websocket
import _thread
import time

import pandas as pd
import nltk

import json
def translate(dialogue):
	testStr = dialogue
	tokens = nltk.word_tokenize(testStr)
	df_tag = pd.DataFrame(index = tokens)
	df_tag['universal'] = nltk.pos_tag(tokens, tagset='universal')
	array_length=len(df_tag)#陣列大小
	noun_array = []#名詞的陣列
	i = 0 
	while i < array_length:
		#print(df_tag.ix[i,"universal"][1])
		if df_tag.ix[i,"universal"][1] == 'NOUN':
			noun_array.append(df_tag.ix[i,"universal"][0])   
		i += 1 
	numarr=json.dumps(noun_array)#名詞陣列JSON打包
	output='{"type":"nlp_done","data":'+numarr+'}'#輸出結果JSON打包
	print('translate finish !!!!')
	ws.send(output)

def on_message(ws, message):
	message_decode = json.loads(message)
	event_type = message_decode['type']
	#status = message_decode['status']
	dialogue = message_decode['dialogue']
	print ("i receieve")
	print (message)
	print ('run' in message)
    # 沒有人的時候
	if 'login' in event_type:
		print('login')
	if 'nlp' in event_type:
		print('receieve')
		translate(dialogue)
	if 'pong' in event_type: 
		print ('pong')
	if 'shutdown' in event_type:
		ws.close()
def on_error(ws, error):
	print (error)

def on_close(ws):
	print ("### closed ###")

def on_open(ws):
	def run(*args):
		for i in range(3):
			time.sleep(1)
		time.sleep(1)
		ws.send('{"type":"login","name":"nlp","status":"nlp is running"}')
        #ws.close()
		print ("thread terminating...")
	_thread.start_new_thread(run, ())   

if __name__ == '__main__':  
    websocket.enableTrace(True)
    ws = websocket.WebSocketApp("ws://localhost:9999",
                                on_message = on_message,
                                on_error = on_error,
                                on_close = on_close)
    ws.on_open = on_open
    ws.run_forever()