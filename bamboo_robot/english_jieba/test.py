import pandas as pd

import nltk

from nltk.stem.porter import PorterStemmer
porter_stemmer = PorterStemmer()
from nltk.stem.lancaster import LancasterStemmer
lancaster_stemmer = LancasterStemmer()
from nltk.stem import SnowballStemmer
snowball_stemmer = SnowballStemmer('english')
from nltk.stem import WordNetLemmatizer
wordnet_lemmatizer = WordNetLemmatizer()

from nltk.corpus import stopwords
stops = stopwords.words('english')
from string import punctuation
testStr = "This value is also called cut-off in the literature. If float, the parameter represents a proportion of documents, integer absolute counts. This parameter is ignored if vocabulary is not None."

tokens = nltk.word_tokenize(testStr)
print(tokens)
tokens = nltk.wordpunct_tokenize(testStr) ## 請注意，差異在cut-off
print(tokens)