##參考https://ithelp.ithome.com.tw/articles/10191922

import pandas as pd

import nltk
nltk.download("stopwords")
nltk.download('wordnet')
nltk.download('averaged_perceptron_tagger')
nltk.download('punkt')
nltk.download('universal_tagset')
from nltk.stem.porter import PorterStemmer

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
testStr = "This is a apple"

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
print(df_tag)
print(df_tag.ix[1,"universal"][1])##df_tag.ix[第幾個,"INDEX的值"][的第幾個(0:內容 1:詞性)]