<?php
/*
* 1.变量名字以 $ 开始
* 2.没有意义的变量名尽量避免
* 3.变量名不能以数字开头
* 4.变量中不能有运算符号
* 5.别的语言不能用系统关键字命名,php可以,因为前面有$符号区分了.
* 6.变量名称区分大小写(驼峰式命名:多个单词组成,第一个单词小写,后面每个单词首字母大写)
*/
$name = "Oliver Kahn <br>";
$position = "Goal Keeper <br>";
$age = 38;
$int = 10;
$INT = 20;
echo $name;
echo $position;
echo $age;
echo "<br>";
echo $int;
echo "<br>";
echo $INT;
        $a = $b = $c = $d = 10;
echo $a;
echo "<br>" .$b;    //.表示连接符号,连接两个字符串
echo "<br>" .$c;
echo "<br>" .$d;
echo "<br>";

var_dump(10);//可以打印一个值或者变量,输出他的类型和内容.
var_dump($c);//可以打印$c的值,输出他的类型和内容.
//isset();//判断一个变量是否存在,如isset($a);
$bool = isset($age);    //判断$a是否存在,并把结果赋给变量$bool
echo $bool;
var_dump($bool);    //打印出$bool的值,并查看它的类型

//
//unset();    //删除一个变量
//unset($c);    //释放变量$c
//
//empty();    //判断内容是否为空,内容为空则返回真;
//var_dump(em pty($c));    //判断 $c 是否为空,注意 0和 null 都为空