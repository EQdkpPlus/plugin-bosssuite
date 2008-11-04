#!/bin/sh
templates="wow_style wow_styleV default defaultV WoWMaevahEmpire WoWMaevahEmpireV WoWMoonclaw01 WoWMoonclaw01V wowV "
files="admin/settings admin/offsets bossloot bossprogress"
for template in $templates 
do
	echo "Creating template files for $template"
	mkdir templates/$template
	touch templates/$template/index.html
	mkdir templates/$template/admin
	touch templates/$template/admin/index.html
	
	for file in $files
	do
		sed s:m9wow3eq:$template:g templates/m9wow3eq/$file.html > templates/$template/$file.html
	done
done
