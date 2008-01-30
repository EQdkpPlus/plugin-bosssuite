#!/bin/sh
templates="wow_style default defaultV WoWMaevahEmpire WoWMaevahEmpireV WoWMoonclaw01 WoWMoonclaw01V wowV m9wow3eq"
files="admin/settings bossloot"
for template in $templates 
do
	echo "Creating template files for $template"
	for file in $files
	do
		sed s:wow_styleV:$template:g templates/wow_styleV/$file.html > templates/$template/$file.html
	done
done
