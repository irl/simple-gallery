#send photos to gallery server

import glob
import os

#------------------------------------------------------------------------
maindir = "/home/user/photos-upload/" #where the photos and count file will be, use absolute paths
offsiteloc = "url.org:/var/www/photos/" #the server to send to include exact path "myserver.com:/var/www/photos/"
#------------------------------------------------------------------------

olddir = os.path.join(maindir, "old")

logger = logging.getLogger("upload")
logger.setLevel(logging.INFO)

if not maindir or not offsiteloc:
	raise RuntimeException("Ensure you have set the maindir and offsiteloc "
			       "configuration variables.")

if os.path.exists(os.path.join(maindir, "count.txt")) == False:
	# Initialise the counter
	with open(os.path.join(maindir, "count.txt"), "w") as handle:
		handle.write("0")

if os.path.exists(olddir) == False:
	os.system("mkdir " + olddir)

with open(os.path.join(maindir, "count.txt"), "r") as handle:
	count = int(handle.read())

files = glob.glob(os.path.join(maindir, "*"))

photos = []
for x in files:
	if ".jpg" in x or ".JPG" in x:
		if x[-4:] == ".jpg" or x[-4:] == ".JPG":
			photos.append(x)

if len(photos) == 0:
	print "Could not find any photos"
else:
	for x in photos:
		os.system("mogrify -auto-orient -resize 640 " + x)
		os.system("mv " + x + " " + maindir + str(count) + ".jpg")
		count += 1

	with open(maindir + "count.txt","w") as handle:
		handle.write(str(count))
	os.system("rsync -ave ssh " + maindir + "*.jpg " + offsiteloc)
	os.system("mv " + maindir + "*.jpg " + maindir + "old/")
	print "Finished Uploading images."
