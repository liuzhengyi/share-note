#! /bin/bash -

# this file 'compile.sh' is used to concatenate 
# the model file and it's corresponding template file

# note:
# 	this file should be placed under the root dir of 
# the site, for me is '/var/www/b/dbd', i.e. the $WEBROOT.

if [ $# != 1 -a $# != 2 ] ; then
	echo "usage: $0 h|m|u|i [mname]";
	echo "try $0 h";
	exit 1;
else 
	case "$1" in
		'h')
			echo  "usage: ./$0 h|m|u|i";
			echo  "h	print this help and quit";
			echo  "m	compile models/modules/*.php";
			echo  "u	compile models/uiparts/*.php";
			echo  "i	compile models/*.php";
			exit 0;
			;;
		'm')
			MNAME="$2";
			COMPILE_DST="modules/$MNAME/";
			COMPILE_SRC1="models/modules/$MNAME/";
			COMPILE_SRC2="templates/default/modules/$MNAME/";
			;;
		'u')
			COMPILE_DST="uiparts/";
			COMPILE_SRC1="models/uiparts/";
			COMPILE_SRC2="templates/default/uiparts/";
			;;
		'i')
			COMPILE_DST="";
			COMPILE_SRC1="models/";
			COMPILE_SRC2="templates/default/";
			;;
		*)
			echo "usage: ./$0 h|m|u|i ";
			;;
	esac

fi

WEBROOT="/var/www/b/dbd/";
# this file should under the $WEBROOT dir!
COMPILE_MSG="<?php \n// this file is compiled by compile.sh \n\
// if you want to change this page \n\
// modify the corresponding model file and template file \n\
// gipsa 2012
\
?>";

FILEPATH='';
FILE='';
FILE_SRC1='';
FILE_SRC2='';
FILE_DST='';

for FILEPATH in `find "$COMPILE_SRC1" -maxdepth 1 -type f -name '*.php'` ; do
#	FILE=`echo $FILEPATH | sed "s/^models\/modules\///g"`;
	FILE=`echo $FILEPATH | sed "s/^.*\///g"`;
	FILE_SRC1="$COMPILE_SRC1$FILE";
	FILE_SRC2="$COMPILE_SRC2$FILE";
	FILE_DST="$COMPILE_DST$FILE";
	echo -ne "$COMPILE_MSG" > "$FILE_DST";
	cat "$FILE_SRC1" "$FILE_SRC2" >> "$FILE_DST";
	if [ 0 == "$?" ]; then
		echo "OK. file $FILE_DST created.";
	else
		if [ -e "$FILE_DST" ]; then
			rm "$FILE_DST";
		fi
		echo "FAILED. file $FILE_DST not create.";
	fi
done;

unset WEBROOT;
unset COMPILE_MSG;
unset COMPILE_SRC1;
unset COMPILE_SRC2;
unset COMPILE_DST;

unset FILEPATH;
unset FILE;
unset FILE_SRC1;
unset FILE_SRC2;
unset FILE_DST;
unset MNAME
