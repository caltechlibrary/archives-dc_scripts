IMAGE ARCHIVE MIGRATION
=======================

## Inventory
https://caltechlibrary.atlassian.net/wiki/x/coDpKQ

## Export Objects & Datastreams
In order to do size calculations we’ll export objects that have TIFFs separately
from those that do not.

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/TIFFs --pid_file=/tmp/pids/imageCollection-TIFF.pids --dsid=TIFF`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/TIFFs --pid_file=/tmp/pids/imageCollection-TIFF.pids --dsid=JP2`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/TIFFs --pid_file=/tmp/pids/imageCollection-TIFF.pids --dsid=JPG`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/TIFFs --pid_file=/tmp/pids/imageCollection-TIFF.pids --dsid=TN`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/TIFFs --pid_file=/tmp/pids/imageCollection-TIFF.pids --dsid=MODS`

We’ll export all the objects that only have JPGs next.

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/JPGs --pid_file=/tmp/pids/imageCollection-JPGwoTIFF.pids --dsid=JPG`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/JPGs --pid_file=/tmp/pids/imageCollection-JPGwoTIFF.pids --dsid=TN`

`drush --root=/var/www/html/drupal7 --user=1 idcrudfd --datastreams_directory=/tmp/imageCollection/JPGs --pid_file=/tmp/pids/imageCollection-JPGwoTIFF.pids --dsid=MODS`

## Move Exported Files to Workspace

`mv /tmp/imageCollection /mnt/Workspace/`

## Use ImageMagick to Retrieve Image Data

`time php get-imageCollection-TIFF-data.php /mnt/Workspace/imageCollection`