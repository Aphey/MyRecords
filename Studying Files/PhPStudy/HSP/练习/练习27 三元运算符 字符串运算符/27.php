<?php
/**
 * 三元运算符
 * 基本语法:
 * 表达式1 ? 表达式2 : 表达式3
 * 规则:
* 如果表达式1的运算结果为true,则去表达式2的值,否则,取表达式3的值
*/
$a=90;
$b=80;
$c=$a>$b? 12:900;
//12或者900 可以是表达式或者字符串
echo 'c=='.$c;

/**
 * 字符串运算符
 * 有两个字符串运算符,使用连接运算符"."
 * 有两个字符串（ string ）运算符。第一个是连接运算符（“.”），它返回其左右参数连接后的字符串。第二个是连接赋值运算符（“.=”），它将右边参数附加到左边的参数之后。
 * PS:当两个变量(基本数据类型),使用 . 连接的时候,就表示把他们的内容拼接起来.拼接的时候就会把他们的变量当做字符串
 */
$a  =  "Hello " ;
$b  =  $a  .  "World!" ;  // now $b contains "Hello World!"

$a  =  "Hello " ;
$a  .=  "World!" ;      // now $a contains "Hello World!"

/**
 * 类型运算符:用来判断一个变量是什么类型的运算符
* 基本语法:instanceof 用于确定一个php变量是否属于某一类class的实例,只能查看是否属于某一class
*/
//class MyClass
//{}
//class NotMyClass
//{}
//$a=new MyClass;
//var_dump($a instanceof MyClass);
//var_dump($a instanceof NotMyClass);

/***
 * 运算优先级
 *
 */
$a=3;
//$b=++$a*3;    //先加加,此时$b=(3+1)*3=12
$b=$a++*3;      //后加加,$b=3*3;$a=$a++;所以此时$b=9;$a=4
echo '$b='.$b;
echo '<br>$a='.$a;
