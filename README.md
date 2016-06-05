# simple-gallery
simple photos gallery

Example: http://photos.yakamo.org
Example: http://pics.foxk.it

This is a simple single file photo gallery, this is very rough and improvements n suggestions welcome.

create a folder on your computer called photos-upload/ and place photo-gall.sh in it, dump your images and then run photo-gall.sh to upload straight to your site, make sure to change locations in photo-gall.sh

I have added upload.py which is photogall.sh rewriten in python.  
make sure to create a file called count.txt <- this file keeps track of the file numbering  

requirements:
-------------
rsync

imagemagick

ToDo:
-----

figure out some kind of error checking for missing files in the count sequence  
add watermarking to the python uploader and options to choose image resize as well  
