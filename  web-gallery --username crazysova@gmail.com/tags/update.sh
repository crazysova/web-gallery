#!/bin/bash
#ls | grep ' ' | while read -r f; do mv "$f" `echo $f | tr ' ' '_'`; done
#залазит в каждую тапку дастаёт оттуда список картинок и записывает в файлы с именами папок.html
chmod 777 ./ -R
#Очищение файлов с даными
rm -f ./*.html
rm -f ./file_inc/*.html
rm -f ./file_inc/dir.html
rm -f ./file_inc/lowres/*
for file_rm in `ls -F1BbN --ignore=file_inc ./ | grep -e ./ | tr -d \/`; do
rm -f "$file_rm"/*.html
done
#Заполнение файлов даными
for file in `ls -F1BbN --ignore=file_inc ./ | grep -e ./ | tr -d \/`; do
ls "$file" | grep  -E -i '.jpg|.gif|.png' | sort -V >> "$file".html
#wc -l "$file".html >> "$file".html
echo "$file" >> ./file_inc/dir.html
cd "$file"
for file2 in `ls -F1BbN --ignore=file_inc ./ | grep -e ./ | tr -d \/`; do
ls "$file2" | grep  -E -i '.jpg|.gif|.png' | sort -V >> ../"$file"/"$file2".html
echo "$file"/"$file2" >> ../file_inc/dir.html
done
cd ../
done
#sh ./menu.sh
bash ./priv.sh
