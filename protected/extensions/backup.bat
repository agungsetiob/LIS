@echo off 
for /f "delims=" %%a in ('wmic OS Get localdatetime ^| find "."') do set dt=%%a
set year=%dt:~0,4%
set mm=%dt:~4,2%
set day=%dt:~6,2%
set waktu_jam=%dt:~8,2%
set waktu_menit=%dt:~10,2%
set waktu_detik=%dt:~10,2%

set dirName=%day%.%mm%.%year%_%waktu_jam%.%waktu_menit%.%waktu_detik%
mysqldump -uroot -p4dm1nl1s lisypm > C:\xampp\htdocs\_backup\andi_%dirName%.sql