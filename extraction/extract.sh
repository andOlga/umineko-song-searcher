#!/bin/bash
if [ ! -e 'extract.bat' ] ; then
    echo "extract.bat needs to be in the same folder as extract.sh for this script to work."
    echo "Please download extract.bat and run this again."
    exit
fi
echo "NOTE: This is meant to be used on the Steam Answer Arcs installation or Umineko Project (v8.1b)."
echo 'This will "work" on Steam Question arcs, but many tracks will be missing.'
echo "This will NOT work on the original Japanese release."
echo "Make sure this script is in the root game folder (where the .exe is) and"
echo "Press Enter to continue..."
read trash
echo "Please wait while the soundtrack is being extracted..."
cp extract.bat extract_real.sh
sed -ri 's/^echo .+//g' extract_real.sh
sed -i 's/CLS//g' extract_real.sh
sed -i 's/PAUSE//g' extract_real.sh
sed -i 's/COPY/cp/g' extract_real.sh
sed -i 's|\\|/|g' extract_real.sh
sed -i 's/EXPLORER/xdg-open/g' extract_real.sh
sed -i 's|> nul|> /dev/null 2>\&1|g' extract_real.sh
bash extract_real.sh
rm extract_real.sh
