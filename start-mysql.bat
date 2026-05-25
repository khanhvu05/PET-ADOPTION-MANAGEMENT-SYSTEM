@echo off
echo ============================================
echo  Khoi dong MySQL (XAMPP MariaDB)
echo ============================================

:: Kiem tra MySQL da chay chua
netstat -ano | findstr ":3306" >nul 2>&1
IF %ERRORLEVEL% EQU 0 (
    echo [OK] MySQL dang chay tren cong 3306.
    goto :create_db
)

echo [...] Dang khoi dong MySQL...
start "" /B "C:\xampp\mysql\bin\mysqld.exe" --defaults-file="C:\xampp\mysql\bin\my.ini"
timeout /t 5 /nobreak >nul

:: Kiem tra lai
netstat -ano | findstr ":3306" >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
    echo [CANH BAO] MySQL khong khoi dong duoc qua script nay.
    echo.
    echo Hay lam thu cong:
    echo  1. Mo XAMPP Control Panel: C:\xampp\xampp-control.exe
    echo  2. Nhan nut [Start] o dong MySQL
    echo  3. Sau do chay lai script nay hoac chay: php artisan migrate
    pause
    exit /b 1
)

:create_db
echo [OK] MySQL dang hoat dong.
echo.
echo [...] Tao database 'pet_adoption' (neu chua co)...
"C:\xampp\mysql\bin\mysql.exe" -u root -h 127.0.0.1 -P 3306 -e "CREATE DATABASE IF NOT EXISTS pet_adoption CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

IF %ERRORLEVEL% EQU 0 (
    echo [OK] Database 'pet_adoption' san sang.
) ELSE (
    echo [LOI] Khong the tao database. Kiem tra mat khau MySQL trong file .env
)

echo.
echo [...] Chay Laravel Migration...
php artisan migrate --seed

echo.
echo ============================================
echo  Hoan tat! Truy cap: http://127.0.0.1:8000
echo ============================================
pause
