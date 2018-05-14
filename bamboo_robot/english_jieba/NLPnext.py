##參考https://ithelp.ithome.com.tw/articles/10191922

import pandas as pd

import nltk
import json
#nltk.download("stopwords")
#nltk.download('wordnet')
#nltk.download('averaged_perceptron_tagger')
#nltk.download('punkt')
#nltk.download('universal_tagset')
#from nltk.stem.porter import PorterStemmer

#porter_stemmer = PorterStemmer()

#from nltk.stem.lancaster import LancasterStemmer
#lancaster_stemmer = LancasterStemmer()
#from nltk.stem import SnowballStemmer
#snowball_stemmer = SnowballStemmer('english')
#from nltk.stem import WordNetLemmatizer
#wordnet_lemmatizer = WordNetLemmatizer()
#print("test---------------------------")

#from nltk.corpus import stopwords
#stops = stopwords.words('english')
#from string import punctuation
#testStr = "This value is also called cut-off in the literature. If float, the parameter represents a proportion of documents, integer absolute counts. This parameter is ignored if vocabulary is not None."
testStr = "This is a apple and an eraser"

tokens = nltk.word_tokenize(testStr)
#print(tokens)
#tokens = nltk.wordpunct_tokenize(testStr) ## 請注意，差異在cut-off
#print(tokens)

#df = pd.DataFrame(index = tokens)
#df['porter_stemmer'] = [porter_stemmer.stem(t) for t in tokens]
#df['lancaster_stemmer'] = [lancaster_stemmer.stem(t) for t in tokens]
#df['snowball_stemmer'] = [snowball_stemmer.stem(t) for t in tokens]
#df['wordnet_lemmatizer'] = [wordnet_lemmatizer.lemmatize(t) for t in tokens]
#df

#df = pd.DataFrame(index = [t for t in tokens if t not in stops])
#df['porter_stemmer'] = [porter_stemmer.stem(t.lower()) for t in tokens if t not in stops]
#df['lancaster_stemmer'] = [lancaster_stemmer.stem(t.lower()) for t in tokens if t not in stops]
#df['snowball_stemmer'] = [snowball_stemmer.stem(t.lower()) for t in tokens if t not in stops]
#df['wordnet_lemmatizer'] = [wordnet_lemmatizer.lemmatize(t.lower()) for t in tokens if t not in stops]
#df

df_tag = pd.DataFrame(index = tokens)
#df_tag['default'] = nltk.pos_tag(tokens)
df_tag['universal'] = nltk.pos_tag(tokens, tagset='universal')
print("output")
array_length=len(df_tag)#陣列大小
noun_array = []
i = 0 
while i < array_length:
	#print(df_tag.ix[i,"universal"][1])
	if df_tag.ix[i,"universal"][1] == 'NOUN':
		noun_array.append(df_tag.ix[i,"universal"][0])   
	i += 1 
print(df_tag)
numarr=json.dumps(noun_array)
print(numarr)
output='{"type":"nlp","name":"nlp","data":'+numarr+'}'
print(output)
"""{
"type":"nlp",
"name":"nlp",
"data":[
{"noun":"output"},{}
]
}"""

data = '{"epay_proj_cd":"105-N91","payment_name":"褚嘉蓉","payment_id":"99110118","cost":"1873","is_receipt":"1","receipt_title":"收據標頭","comp_no":"","tel":"0914145214","email":"mmmfewhav@yahoo.com.tw","end_pay_date":"","cartData":{"sum":1873,"productData":[{"product_name":"森77杯","cost":"985"},{"product_name":"除臭鳥","cost":"888"}]}}'
out_json = json.loads(data) # Decode into a Python object
print("out_json")
insidearray_len=len(out_json['cartData']['productData'])
#print(out_json.get('cartData').get('productData').get('product_name'))
j = 0
while j < insidearray_len:
	print(out_json['cartData']['productData'][j]['product_name'])#class:dict
	j += 1
in_json = json.dumps(out_json) # Encode the data
print("in_json")
print(in_json)#class:str

#print(df_tag.ix[0,"universal"][0])##df_tag.ix[第幾個,"INDEX的值"][的第幾個(0:內容 1:詞性)]