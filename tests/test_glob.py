
from simplegallery import SimpleGallery

def test_glob():
    g = SimpleGallery("tests/testphotos", "/tmp")
    photos = set(g._discover_photos())
    expected_photos = set(['test1.jpeg', 'test1.Jpeg',
                           'test2.JPEG', 'test7.jpG'])
    print("Discovered photos: {}".format(repr(photos)))
    assert photos == expected_photos
