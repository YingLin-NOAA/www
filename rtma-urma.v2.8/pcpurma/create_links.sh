#!/bin/bash
set -x
date=$date
date=`date -d "$date - 20 day" +%Y%m%d`
urmadir=/home/www/emc/htdocs/users/verification/precip/rtma-urma.v2.8/pcpurma/daily

cd loop-images 
rm -f *.png

#make symbolic links; pcpurma2 means 2 side-by-side plots.  
for i in `seq 1 20`
do
  day=`expr $i - 5`
  PDY=`date -d "$date + $day day" +%Y%m%d`
  echo $PDY $day
  myimg=pcpurma2.${PDY}.png
  if [ -s ../daily/$myimg ]; then
    ln -s ../daily/$myimg ${i}_pcpurma2.png
  else
    ln -s ../missing-image/noimage.png ${i}_pcpurma2.png
  fi
done





