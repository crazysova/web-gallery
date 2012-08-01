#!/bin/bash
#echo '
#<div class="sign"><a href="index.php?p=rar"><p><img src="file_inc/rar.png"></p><p>Скачать</a></p></div>
#<div class="sign"><a href="index.php?p=Анимация2"><p><img src="file_inc/174.gif"></p><p>Анимация2</a></p></div>
#<div class="sign"><a href="index.php?p=Анимация"><p><img src="file_inc/137.gif"></p><p>Анимация</a></p></div>' > file_inc/priv.html
echo > file_inc/priv.html
mkdir -p ./file_inc/lowres
for f in `ls -1 *.html | sed 's/file_inc//g' | sed -e 's/Анимация.html//g' | sed -e 's/Анимация2.html//g'`; do
echo > ./file_inc/p_$f
fail=`cat $f | sed -n '1p;1q'`
convert -quality 80 -resize 300x300 -crop 180x180+0+0 "${f%.html}/$fail" "file_inc/lowres/${f%.html}${fail%.jpg}.jpg"

ls -p ./${f%.html} | grep -e / > /dev/null
if [ $? != 1 ]
then 
echo '<div class="sign"><a href="index.php?p=u&u='file_inc/p_$f'"><img width="180px" height="180px" src="file_inc/lowres/'${f%.html}${fail%.jpg}.jpg'"></a></div>' >> file_inc/priv.html
else
echo '<div class="sign"><a href="index.php?p='${f%.html}'"><img width="180px" height="180px" src="file_inc/lowres/'${f%.html}${fail%.jpg}.jpg'"></a></div>' >> file_inc/priv.html
fi

cd ${f%.html}
for f2 in `ls -1 *.html | sed 's/file_inc//g' | sed -e 's/Анимация.html//g' | sed -e 's/Анимация2.html//g'`; do
fail2=`cat $f2 | sed -n '1p;1q'`
convert -quality 80 -resize 300x300 -crop 180x180+0+0 "${f2%.html}/$fail2" "../file_inc/lowres/${f2%.html}${fail2%.jpg}.jpg"
echo '<div class="sign"><a href="index.php?p='${f%.html}/${f2%.html}'"><img width="180px" height="180px" src="file_inc/lowres/'${f2%.html}${fail2%.jpg}.jpg'"></a></div>' >> ../file_inc/p_$f
done
cd ../
done
