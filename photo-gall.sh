#shell script to remove all files and folders after 30days
DIRLISTING=($(find *.jpg))
count=$(cat count.txt)
i=0
while [ $i -lt ${#DIRLISTING[@]} ]
do
	mv ${DIRLISTING[$i]} $count".jpg"
	mogrify -auto-orient -resize 640 $count".jpg"
	mv $count".jpg" "old/"
i=$(($i + 1))
count=$(($count + 1))
done

echo $count > count.txt
#replace with rsync instead scp is not practical at all
rsync -ave ssh old/ yakamo.org:/var/www/photos.yakamo.org/photos/

echo "all done"
