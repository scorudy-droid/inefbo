<%
Response.ContentType = "text/plain"

' Definir la ruta del archivo TXT en el servidor
Dim rutaArchivo, fso, archivo, contador

' Crea un archivo llamado contador.txt en la misma carpeta que este script
rutaArchivo = Server.MapPath("contador.txt")

' Crear el objeto para manejar archivos (FileSystemObject)
Set fso = Server.CreateObject("Scripting.FileSystemObject")

' 1. LEER EL VALOR ACTUAL
If fso.FileExists(rutaArchivo) Then
    Set archivo = fso.OpenTextFile(rutaArchivo, 1) ' 1 = Modo Lectura
    If Not archivo.AtEndOfStream Then
        contador = archivo.ReadLine
    Else
        contador = 0
    End If
    archivo.Close
Else
    contador = 0
End If

' Validar que sea un número, si no, empezar en 0
If Not IsNumeric(contador) Then
    contador = 0
Else
    contador = CInt(contador)
End If

' 2. SUMAR 1 AL CONTADOR
contador = contador + 1

' 3. GUARDAR EL NUEVO VALOR EN EL TXT (Sobrescribe el anterior)
Set archivo = fso.CreateTextFile(rutaArchivo, True) ' True = Sobrescribir
archivo.WriteLine(contador)
archivo.Close

' Limpiar objetos de memoria
Set archivo = Nothing
Set fso = Nothing

' 4. ENVIAR EL RESULTADO LIMPIO AL HTML
Response.Write(contador)
%>
