#! /bin/bash


read -p "Select directory number: " number

cd bike_${number}

compt=0

SAVEIFS=$IFS
IFS=$(echo -en "\n\b")
for f in *
do
	if [ "$f" != infos ]
	then
		mv "$f" image"$compt"
		let compt++
	fi  
done
IFS=$SAVEIFS