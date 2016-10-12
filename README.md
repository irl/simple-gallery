# simple-gallery
simple photos gallery

Example: http://photos.yakamo.org
Example: http://pics.foxk.it

This is a simple single file photo gallery, this is very rough and improvements n suggestions welcome.

If you want to have a nav bar, just add "nav.txt" with the relevent html links in it, this will appear at the top of the page just under the titles.  

I have added upload.py which is photogall.sh rewriten in python.  
make sure to create a file called count.txt <- this file keeps track of the file numbering  

requirements:
-------------
rsync

imagemagick

ToDo:
-----
  
fix "undefined index" error  
figure out some kind of error checking for missing files in the count sequence  
add watermarking to the python uploader and options to choose image resize as well  
