<?php
$archivo = fopen("capturas.txt","r+")or die("El archivo no existe, realizar un registro para crearlo");;//Se declara la variable la cual abrira el archivo .txt "capturas.txt"
while (!feof($archivo)) {//Se hace un ciclo que mientras se nigue la funcion "feof()" con parametro el archivo de texto, se ejecute el siguiente algoritmo. La funcion feof() determina si se esta apuntando al final del archivo, por eso se hace la negacion, para que mientras no se apunte al final, continue el ciclo.
    $arch = fgetcsv($archivo);//Se declara la variable "arch" y se le asigna lo que retornara la funcion "fgetcsv()" que tiene como parametro de entrada el archvi de tecto "capturas.txt". La funcion "fgetcsv()" realiza una separacion por comas y las va registrando en un string, el cual puede ir separandose por indices.
    
    //Se crea el arrelo "user_access" el cual se le iran asignando los valores a cada posicion, estos valores seran los que se vayan obteniendo de la separacion por comas que hace la funcion "fgetcsv()" y se iran agregando a los campos descritos a continuacion.
    $user_access[]=[
        'ocupacion'=>$arch[0],
        'matricula'=>$arch[1],
        'name'=>$arch[2],
        'carrera'=>$arch[3],
        'email'=>$arch[4],
        'telefono'=>$arch[5]
    ];
}