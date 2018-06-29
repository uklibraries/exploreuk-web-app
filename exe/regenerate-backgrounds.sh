#!/bin/bash

size="1200x"
dir="theme/images"

wget -O "$dir/bg-001.big.jpg" https://nyx.uky.edu/dips/xt7sf7664q86/data/1998ua001/Box_12/Folder_item_346_0044/346_0044.jpg
wget -O "$dir/bg-002.big.jpg" https://nyx.uky.edu/dips/xt7qrf5kb01p/data/96pa103_182/96pa103_182.jpg
wget -O "$dir/bg-003.big.jpg" https://nyx.uky.edu/dips/xt7q833mwz5w/data/4/51_p/51/51.jpg
wget -O "$dir/bg-004.big.jpg" https://nyx.uky.edu/dips/xt7sf7664q86/data/1998ua001/Box_5a/Folder_item_113_0001/113_0001.jpg
wget -O "$dir/bg-005.big.jpg" https://nyx.uky.edu/dips/xt7prr1pgv6h/data/3/1293_p/1293/1293.jpg
wget -O "$dir/bg-006.big.jpg" https://nyx.uky.edu/dips/xt734t6f3d29/data/1997av027/Box_29/Item_4070/1997av027_4066.jpg
wget -O "$dir/bg-007.big.jpg" https://nyx.uky.edu/dips/xt7tdz03077b/data/pa79m104/pa79m104_4/pa79m104_4_888_p/888/888.jpg
wget -O "$dir/bg-008.big.jpg" https://nyx.uky.edu/dips/xt7sf7664q86/data/1998ua001/Box_5/Folder_item_090_0037a/090_0037a.jpg
wget -O "$dir/bg-009.big.jpg" https://nyx.uky.edu/dips/xt7sbc3svg22/data/pa46m4_003/pa46m4_003.jpg

for id in $(seq -f '%03g' 9); do
    echo "Shrinking bg-$id.big.jpg -> bg-$id.jpg ($size)"
    convert "$dir/bg-$id.big.jpg" -resize $size -strip "$dir/bg-$id.jpg"
    rm -f "$dir/bg-$id.big.jpg"
done
