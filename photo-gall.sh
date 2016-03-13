#!/bin/bash
#shell script to process and upload photos
DIRLISTING=($(find *.jpg))
count=$(cat count.txt)
i=0
while [ $i -lt ${#DIRLISTING[@]} ]
do
	cp ${DIRLISTING[$i]} "backup/"$count".jpg"
	mv ${DIRLISTING[$i]} $count".jpg"
	mogrify -auto-orient -resize 1200 $count".jpg"
	convert $count".jpg" -font Palatino -pointsize 13 -draw "gravity SouthEast fill black text 0,1 'copyright©yourname 2016' fill white text 0,2 'copyright©yourname 2016'" $count".jpg"
	#add folder called old
	mv $count".jpg" "old/"
i=$(($i + 1))
count=$(($count + 1))
done

echo $count > count.txt
rsync -ave ssh old/ example.com:/var/www/example.com/photos/

echo "all done"
