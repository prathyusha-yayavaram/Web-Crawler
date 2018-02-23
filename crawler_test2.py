import urllib.request
import re
from bs4 import BeautifulSoup
from urllib.parse import quote_plus
import string
import sys

def strip_string_to_lowercase(s):
    tmpStr = s.lower().strip()
    retStrList = []
    for x in tmpStr:
        if x in string.ascii_lowercase:
            retStrList.append(x)

    return ''.join(retStrList)
  
def cleanhtml(raw_html):
  cleanr = re.compile('<.*?>')
  cleantext = re.sub(cleanr, '', str(raw_html))
  cleanr = re.compile('[.*?]')
  cleantext = re.sub(cleanr, '', str(raw_html))
  cleanr = re.compile('{.*?}')
  cleantext = re.sub(cleanr, '', str(raw_html))
  cleanr = re.compile("'")
  cleantext = re.sub(cleanr, '', str(raw_html))
  cleanr = re.compile("\n")
  cleantext = re.sub(cleanr, '', str(raw_html))
  cleanr = re.compile("\r")
  cleantext = re.sub(cleanr, '', str(raw_html))
  return cleantext


url = ['www.khazanajewellery.com/','www.tanishq.co.in/','www.bluestone.com/','www.malabargoldanddiamonds.com/','www.kalyanjewellersonline.com/','www.grtjewels.com/','www.nakshatra.world/','www.damasjewellery.com/?SID=mkh8bclvs7b6kq50jiht7roiv3','www.nirvanaonline.com/','www.abharan.com/','www.littlenathella.com/','www.shanthijewellers.com/','www.kiahjewels.com/','www.moirafinejewellery.com/','www.orra.co.in/']
idd = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
name = ["khazana","tanishq","bluestone","malabar","kalyan","grt","nakshatra","ddamas","nirvana","abharan","littlenathella","shanthi","kiah","moira","orra"]

ofile = open("D:/Nazeer/OldPc/E/newfolder/4S/Web Mining/project/index_complete/"+"indexed_content.txt",'w')

allcontent = []

for j in  range(0,15):
  k=url[j]
  print("\n\n")
  print("reading "+url[j]+"\n\n\n")
  html = urllib.request.urlopen('http://'+str(k)).read()
  soup = BeautifulSoup(html, 'html.parser')
  texts = soup.findAll(text=True)



  paragraph = cleanhtml(texts)

  array=[]

  paragraph.lower()

  ##paragraph = re.sub(r'<[^>]*?>', '', str(paragraph))

  for i in paragraph.split(" "):
    i = strip_string_to_lowercase(i)
    i.replace("'", "")
    i.replace("\r", "")
    i.replace("\n", "")
    if(len(i)<15):
        if(re.search(",",str(i))):
            a=5
        elif(i=="" or i=='n'):
            a=4
        else:
            array.append(str(i))

  file = open("D:/Nazeer/OldPc/E/newfolder/4S/Web Mining/project/index_alpha_wise/"+name[j]+".txt",'w') 
  afile = open("D:/Nazeer/OldPc/E/newfolder/4S/Web Mining/project/index_freq/"+name[j]+".txt",'w')

  prev='ooooo'
  freq=1  
  for i in sorted(array):
      str(i).lower()
      if(i=='\u2032'):
        a=1
      if(i==prev):
        freq = freq+1
      else:
        allcontent.append(prev+" "+str(j+1)+"/"+str(freq))
        prev=i
        freq=1
      afile.write(prev+" "+str(j+1)+"/"+str(freq)+"\n")
      file.write(str(i+"\n"))
  
  file.close()
  afile.close()
print("First step successfully done\n")

allcontent.sort();
prev='oooo'
freq=1
string=''
for i in allcontent:
  k = i.split(" ")
  z = k[0]
  if(z==prev):
    l = k[1]
    string = string + '-' + str(l)
  else:
    ofile.write(str(string+'\n'))
    prev=k[0]
    string = k[0]+" "+k[1]

ofile.close()
