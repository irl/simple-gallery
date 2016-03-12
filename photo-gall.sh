#shell script to process and upload photos
DIRLISTING=($(find *.jpg))
count=$(cat count.txt)
i=0
while [ $i -lt ${#DIRLISTING[@]} ]
do
	cp ${DIRLISTING[$I]} "backup/"
	mv ${DIRLISTING[$i]} $count".jpg"
	mogrify -auto-orient -resize 1200 $count".jpg"
	#add folder called old
	mv $count".jpg" "old/"
i=$(($i + 1))
count=$(($count + 1))
done

echo $count > count.txt
#rsync -ave ssh old/ example.com:/var/www/example.com/photos/

echo "all done"
