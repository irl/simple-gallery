#shell script to process and upload photos
DIRLISTING=($(find *.jpg))
count=$(cat count.txt)
i=0
while [ $i -lt ${#DIRLISTING[@]} ]
do
	mv ${DIRLISTING[$i]} $count".jpg"
	mogrify -auto-orient -resize 640 $count".jpg"
	#add folder called old
	mv $count".jpg" "old/"
i=$(($i + 1))
count=$(($count + 1))
done

echo $count > count.txt
#replace with rsync instead scp is not practical at all
rsync -ave ssh old/ example.com:/var/www/example.com/photos/

echo "all done"
