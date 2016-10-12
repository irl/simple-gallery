#send photos to gallery server

import glob
import logging
import os
import sys
import subprocess

#------------------------------------------------------------------------
sourcedir = "/home/user/photos-upload/" #where the photos and count file will be, use absolute paths
publishdir = "url.org:/var/www/photos/" #the server to send to include exact path "myserver.com:/var/www/photos/"
#------------------------------------------------------------------------

olddir = os.path.join(sourcedir, "old")

logging.basicConfig()
#logger.setLevel(logging.INFO)

class SimpleGallery:

    def __init__(self, sourcedir, publishdir):
        logger = logging.getLogger("upload")
        self.sourcedir = os.path.abspath(sourcedir)
        self.publishdir = publishdir
        logger.debug("Source directory is set to: {}".format(self.sourcedir))
        logger.debug("Publish directory is set to: {}".format(self.publishdir))

    def _check_paths(self):
        if os.path.exists(os.path.join(self.sourcedir, "count.txt")) == False:
            # Initialise the counter
            with open(os.path.join(self.sourcedir, "count.txt"), "w") as handle:
                handle.write("0")

        if os.path.exists(olddir) == False:
            # Create olddir
            subprocess.check_output(["mkdir", olddir])

    def _read_count(self):
        with open(os.path.join(self.sourcedir, "count.txt"), "r") as ch:
            self.count = int(ch.read())

    def _discover_photos(self):
        extensions = (".jpeg", ".jpg")
        files = glob.glob(os.path.join(self.sourcedir, "*"))

        photos = []
        for name in files:
            if name.lower().endswith(extensions):
                photos.append(os.path.basename(name))

        return photos

    def _do_upload(self, photos):
        logger = logging.getLogger("upload")
        if len(photos) == 0:
            logger.error("Could not find any photos in {}.".format(self.sourcedir))
            sys.exit(1)

        for x in photos:
            os.system("mogrify -auto-orient -resize 640 " + x)
            os.system("mv " + x + " " + self.sourcedir + str(self.count) + ".jpg")
            self.count += 1

        with open(self.sourcedir + "count.txt","w") as handle:
            handle.write(str(self.count))

        os.system("rsync -ave ssh " + os.path.join(self.sourcedir,"*.jpg") + " " + self.publishdir)
        os.system("mv " + self.sourcedir + "*.jpg " + sourcedir + "old/")
        logger.info("Finished Uploading images.")

    def upload(self):
        self._check_paths()
        self._read_count()
        photos = self._discover_photos()
        self._do_upload(photos) 

if __name__ == "__main__":
    g = SimpleGallery(sourcedir, publishdir)
    g.upload()
 
