@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

echo.
echo ============================================================
echo REORGANIZANDO ESTRUTURA DE PASTAS - PHP TEMAS
echo ============================================================
echo.

REM Criar estrutura de pastas principais
echo 📁 Criando estrutura de pastas...

mkdir "00_Introducao\01_OlaMundo" 2>nul
mkdir "01_Tipos_Dados\01_Conversoes" 2>nul
mkdir "01_Tipos_Dados\02_Operacoes" 2>nul
mkdir "02_Logica_Calculos\01_Calculo_Simples" 2>nul
mkdir "02_Logica_Calculos\02_Geometria" 2>nul
mkdir "03_Formularios\01_Entrada_Dados" 2>nul
mkdir "03_Formularios\02_Validacao" 2>nul
mkdir "04_Strings_Arrays" 2>nul
mkdir "05_Funcoes" 2>nul
mkdir "06_Banco_Dados" 2>nul
mkdir "07_Projetos_Integradores" 2>nul

echo   ✓ Estrutura de pastas criada
echo.
echo 📦 Movendo pastas antigas...
echo.

REM Mover conversordetemperatura
if exist "conversordetemperatura" (
    if exist "01_Tipos_Dados\01_Conversoes\01_ConversorDeTemperatura" (
        rmdir /s /q "01_Tipos_Dados\01_Conversoes\01_ConversorDeTemperatura" >nul 2>&1
    )
    move "conversordetemperatura" "01_Tipos_Dados\01_Conversoes\01_ConversorDeTemperatura" >nul 2>&1
    if !errorlevel! equ 0 (
        echo   ✓ conversordetemperatura → 01_Tipos_Dados\01_Conversoes\01_ConversorDeTemperatura
    ) else (
        echo   ✗ Erro ao mover conversordetemperatura
    )
) else (
    echo   ⚠ conversordetemperatura não encontrada
)

REM Mover CalculoDoImposto
if exist "CalculoDoImposto" (
    if exist "02_Logica_Calculos\01_Calculo_Simples\01_CalculoDeImposto" (
        rmdir /s /q "02_Logica_Calculos\01_Calculo_Simples\01_CalculoDeImposto" >nul 2>&1
    )
    move "CalculoDoImposto" "02_Logica_Calculos\01_Calculo_Simples\01_CalculoDeImposto" >nul 2>&1
    if !errorlevel! equ 0 (
        echo   ✓ CalculoDoImposto → 02_Logica_Calculos\01_Calculo_Simples\01_CalculoDeImposto
    ) else (
        echo   ✗ Erro ao mover CalculoDoImposto
    )
) else (
    echo   ⚠ CalculoDoImposto não encontrada
)

REM Mover areatriangulo
if exist "areatriangulo" (
    if exist "02_Logica_Calculos\02_Geometria\01_AreaDoTriangulo" (
        rmdir /s /q "02_Logica_Calculos\02_Geometria\01_AreaDoTriangulo" >nul 2>&1
    )
    move "areatriangulo" "02_Logica_Calculos\02_Geometria\01_AreaDoTriangulo" >nul 2>&1
    if !errorlevel! equ 0 (
        echo   ✓ areatriangulo → 02_Logica_Calculos\02_Geometria\01_AreaDoTriangulo
    ) else (
        echo   ✗ Erro ao mover areatriangulo
    )
) else (
    echo   ⚠ areatriangulo não encontrada
)

REM Mover form
if exist "form" (
    if exist "03_Formularios\01_Entrada_Dados\01_FormularioBasico" (
        rmdir /s /q "03_Formularios\01_Entrada_Dados\01_FormularioBasico" >nul 2>&1
    )
    move "form" "03_Formularios\01_Entrada_Dados\01_FormularioBasico" >nul 2>&1
    if !errorlevel! equ 0 (
        echo   ✓ form → 03_Formularios\01_Entrada_Dados\01_FormularioBasico
    ) else (
        echo   ✗ Erro ao mover form
    )
) else (
    echo   ⚠ form não encontrada
)

echo.
echo ============================================================
echo ✅ REORGANIZAÇÃO CONCLUÍDA COM SUCESSO!
echo ============================================================
echo.
echo Estrutura final:
echo.
echo 00_Introducao\
echo   └── 01_OlaMundo\
echo.
echo 01_Tipos_Dados\
echo   ├── 01_Conversoes\
echo   │   └── 01_ConversorDeTemperatura\
echo   └── 02_Operacoes\
echo.
echo 02_Logica_Calculos\
echo   ├── 01_Calculo_Simples\
echo   │   └── 01_CalculoDeImposto\
echo   └── 02_Geometria\
echo       └── 01_AreaDoTriangulo\
echo.
echo 03_Formularios\
echo   ├── 01_Entrada_Dados\
echo   │   └── 01_FormularioBasico\
echo   └── 02_Validacao\
echo.
echo 04_Strings_Arrays\
echo 05_Funcoes\
echo 06_Banco_Dados\
echo 07_Projetos_Integradores\
echo.
echo ============================================================
echo.
pause
