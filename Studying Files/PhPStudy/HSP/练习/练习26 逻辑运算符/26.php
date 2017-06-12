<?php
//逻辑运算符
//$a=90;$b=90;
//if($a==$b||$a>8){echo "ok1";} //ok1
//$b--;
//if($a>$b && $a>45){echo 'ok2';}//ok2
//if(!($a<=$b)){echo "ok3";} //ok3
//echo '<br>'.$b;


//$a=10;$b=7;
//if($a++>8 || $b++>7){	//逻辑或只要前面的$a++>8满足,后面的$b++>7就不执行
// echo 'ok';
//}
//echo '<br>a='.$a."<br>b=".$b;


//$a=10;$b=7;
//if($a++>10 && $b++>7){	//注意后++,意思是$a先和10比,再++,所以这里也没必要执行后面的$b++>7
// echo 'ok';
//}
//echo '<br>a='.$a."<br>b=".$b; //所以 a=11,b=7


//$a=10;$b=7;
//if(++$a>10 && ++$b>7){	//注意前++,意思是$a先++,再和10比
//    echo 'ok';
//}
//echo '<br>a='.$a."<br>b=".$b; //所以 a=11,b=8


//$e= false || true;
//$f= false or true;	//or的优先级低于=,所以这里的结果就变成了 $f=false
//var_dump($e,$f);


//$e= false || true;
//$f= true or false;	//or的优先级低于=,所以这里的结果就变成了 $f=true; or
//var_dump($e,$f);



$g= false && true;
$h= true and false;	//and的优先级低于=,所以这里的结果就变成了 $h=true
var_dump($g,$h);