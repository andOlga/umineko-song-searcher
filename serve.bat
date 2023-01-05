echo off
cls
python3 -V 2> nul
if errorlevel 1 goto setup
start /min "" python3 -m http.server
start msedge --app=http://localhost:8000
exit
:setup
echo We need to run some initial setup. Please press any key, click the "Install" button in the window that shows,
echo and then run this script again after it's done.
pause > nul
REM This will open the Microsoft Store with the Python installer:
python3
