#### shell编程
- bash提供了编程环境;程序是有指令和数据组成的,程序编程风格分为过程式和对象式:
	- 过程式: 以指令为中心,数据服务于指令
    1. 顺序执行,自上而下一条一条执行
		2. 循环执行,迭代,或者遍历的方式对一类对象上逐个运行某种操作叫循环执行
		3. 选择执行,多条可用路径中选择一个
	- 对象式: 以数据为中心,指令服务于数据
- 编程语言:机器语言（0,1）、汇编语言(人类能够识别的语言)、高级语言(非常接近于人类的思维特性,同时又接近机器的识别特性,需要编译器或者解释器转换成机器语言),高级语言又分为静态语言和动态语言两种:
	- 静态语言:编译型语言,需要事先转换成可执行格式,才能执行(C,C++,JAVA,C#)
		- 有一个程序开发环境,不需要借助额外的二进制程序,我们就可以直接写代码,写完代码需要一个编译器将其直接转换成二进制可以独立运行的,这样的语言就陈伟静态语言;此类语言一般都是__强类型(变量)__语言
	- 动态语言:解释型语言,通常都是弱类型语言;边解释边执行.(asp,php,shell,python,perl)
	- 面向过程: 以指令为中心来组织代码,数据服务于代码,代表:Shell, C
	- 面向对象: 以数据为中心来组织代码,围绕数据来组织指令,JAVA,Python,perl,C
- 命令hash: 缓存此前命令的查找结果,我们平时执行命令时,系统并不是上来就直接找PATH环境变量下的给的各程序路径,而是先去缓存中看是不是有已经找到的完整路径的结果了,如果有,就直接引用缓存中的执行程序路径;如果没有,系统才会发起真正的查找操作,这就叫命令hash.
	- -d cat 删除hash表中的cat路径记录
	- -r 清空hash表
- shell是过程式、解释执行的编程,shell编程就是命令的堆砌.
- 编程语言的基本结构:
	- 数据存储:变量、数组
	- 表达式
	- 语句
- 关键字:不管哪种语言,通常都会提供一些控制语句或者关键字,这些关键字最后能够被我们的解释器或者编译器转化为机器识别的指令.
- 变量:编址的存储单元,是内存空间,变量类型决定了数据的存储格式
- 在内存中存储数值10和字符10 的区别
	- 字符: 1和0分别都是ASCII码,每个ASCII码占8bit16bit
	- 数值: 转换为2进制表达是1010,共4位,计算机的最小存储单位是bit,所以最终要占8bit
- 变量类型:用来确定数据的存储格式和长度、变量能够参与的运算、表示数据范围
	- 字符
	- 数值
		- 整型
		- 浮点型:存储方式是,小数点之前存放一个位置,小数点之后存放一个位置,小数点单独存放一个位置
		- 日期时间型
		- 布尔型,真假型
	- 逻辑运算:与、或、非(门)、异或(操作数相同则为假,否则为真);`与或`运算为短路逻辑运算,
			A) 与:有一个为假,结果一定为假,可以理解为相乘
            1 && 1 = 1
            1 && 0 = 0
            0 && 0 = 0
            0 && 1 = 0
			> COMMAND1 && COMMAND2, 若COMMAND1为"假",则COMMAND2不会在执行,否则,COMMAND1为"真",则COMMAND2必须执行
			B) 或:有一个为真,结果一定为真,可以理解为相加
            1 || 0 = 1
            1 || 1 = 1
            0 || 1 = 1
            0 || 0 = 0
			> COMMAND1 || COMMAND2, 若COMMAND1为"真",则COMMAND2不会在执行,否则,COMMAND1为"假",则COMMAND2必须执行
			C) 非,取反
            !0 = 1
            !1 = 0
	- 强弱类型变成语言:
	    - 变量的声明：说明变量的类型，定义变量名称.
		- 强类型:变量在使用前必须事先声明变量类型,甚至还需要初始化(给一个原始值,一般数值初始化为0,字符初始化为空NULL)；
		- 弱类型:变量随时用,随时声明,甚至不区分类型,一般不区分类型都会默认为字符串，相当于把声明和赋值同时进行.
		    ```bash
		    NAME=jerry  //声明和赋值同时进行
		    ```
        - 多数强类型语言都需要先声明的， 但是python是例外，python是强类型语言，但是他使用变量也不需要事先声明
- bash变量类型:
    - bash是弱类型语言, 它把所有要存储的数据统统当做字符进行,且不支持浮点数
	- 环境变量:作用域为当前shell进程及其子进程,声明方法:export NAME=VALUE或者declare -x NAME=VALUE
	- 本地变量:比如父shell中定义的变量,在子shell中不能引用,作用域为整个bash进程
	    ```bash
	      [root@Aphey ~]# NAME=Jerry
        [root@Aphey ~]# echo $NAME
        Jerry
        [root@Aphey ~]# bash
        [root@Aphey ~]# echo $NAME

        [root@Aphey ~]#
	    ```
	- 局部变量:声明方法 local VARNAME=VALUE,作用域为:当前shell进程中某代码段,常用于函数
	- 位置变量 $1,$2,$3...;特殊命令:shift,和位置变量运用的
	- 特殊变量:用来保存某些特殊数据的变量
	  - $0：命令本身
		- $?: 上一条命令的退出状态码,0表示成功,1-255表示失败.
		- $#: 查看命令参数的个数.
		- $*: 参数列表,传递给脚本的所有参数,所有参数当成一个字串.
		- $@: 参数列表,传递给脚本的所有参数,每个参数都是一个独立字串.
- 引用变量: ${VARNAME},花括号可以省略. 有些情况是不能省略的,比如:

    ```bash
    [root@ZhumaTech tmp]# ANIMAL=pig
    [root@ZhumaTech tmp]# echo "There are lots of ${ANIMAL}s"
    There are lots of pigs
    ```

- 任何一个脚本在执行时会启动一个子shell进程;
- 命令行中启动的脚本会继承当前shell环境变量
- 系统自动执行的脚本(非命令行启动)就需要自我定义需要的各环境变量
- 导出环境变量有两种方法(export和declare)
	- export VARNAME=VALUE
	- 1. VARNAME1=VALUE
	  2. export VARNAME1
	- declare -x NAME=VALUE, -x选项表示export导出变量
	- 1. NAME=VALUE
		2. delcare -x NAME
- 环境变量只对当前shell及其子shell有效,比如我在A Session上声明了某个环境变量,复制A Session为B Session,再查看这个变量,___会发现这个变量为空___
- 特殊变量:
	- $?:上一个命令的执行状态返回值,程序执行以后可能有两类返回值:
		1. 程序执行结果
		2. 程序执行状态返回码(0-255)
			- 0:正确执行
			- 1-255:错误执行,1,2,127系统预留;其他数字可以自定义
			- 输出重定向的特殊用法:
			- /dev/null:软件设备,bit bucket 数据黑洞

				```bash
				[root@ZhumaTech ~]# id jerry &>/dev/null
				[root@ZhumaTech ~]# echo $?
				0
				[root@ZhumaTech ~]# id jerr &>/dev/null
				[root@ZhumaTech ~]# echo $?            
				1
				```

- 撤销变量:
	- 其实设置变量的命令前面省略了 set ,所以撤销变量的命令就是unset VARNAME
- 查看shell中的变量,set即可,不带任何选项和参数.
- 如果要查看当前shell中的环境变量:
	- printenv
	- env
	- export
	- declare -x
- 在bash中,变量也可以做到只读,也就是所谓的常量,变量赋值以后再也不能修改也不能销毁,永远只能保持这一个值,只有等到shell进程终止;
- 实现只读变量的方法:
	- 使用readonly关键字
		```bash
		[root@mail sh]# readonly name=tom
		[root@mail sh]# echo $name
		tom
		[root@mail sh]# name=jerry	//不能修改
		-bash: name: readonly variable
		```
	- declare -r VARNAME=VALUE  //设置只读变量
		```bash
		[root@mail sh]# declare -r haha=xiao
		[root@mail sh]# echo $haha
		xiao
		[root@mail sh]# haha=ku
		-bash: haha: readonly variable
		```
- 脚本:命令堆砌,按实际需要,结合命令流程控制机制实现的源程序
- 对字符串类型的变量来说,我们要改变其值,还可以给字符串后面附加一些内容,常用在$PATH添加上.

    ```bash
    [root@ZhumaTech ~]# ANIMALS=pig
    [root@ZhumaTech ~]# ANIMALS=$ANIMALS:goat
    [root@ZhumaTech ~]# echo $ANIMALS
    pig:goat
    ```

- 对shell来讲,默认所有变量的值都是字符串,所以默认是不能做算数运算的.

	```bash
	[root@ZhumaTech ~]# A=2
	[root@ZhumaTech ~]# B=3
	[root@ZhumaTech ~]# C=$A+$B
	[root@ZhumaTech ~]# echo $C
	2+3
	```
- bash的配置文件:
		1. 全局配置:对所有用户都生效
			- /etc/profile
			- /etc/profile.d/*.sh
			- /etc/bashrc
		2. 个人配置:仅对当前用户有效
			- ~/.bash_profile
			- ~/.bashrc
	- profile类的文件:为交互式登录shell进程提供配置;
		1. 设定环境变量
		2. 运行命令或脚本,比如在/etc/profile里(或者在/etc/profile.d/中新建一个脚本)添加一句 `echo "Welcome $UID, your home is $HOME"`; 这样用户开机就会看到这么一句
	- bashrc类的文件:为非交互式登录的shell进程提供配置;
		1. 设定本地变量
		2. 定义命令别名
- shell登录分为交互式登录和非交互式登录两种:    
    - 交互式登录(直接通过终端输入账号密码登录;或者`su - USERNAME` 切换的用户)系统读取顺序为: `/etc/profile--> /etc/profile.d/*sh --> ~/.bash_profile --> ~/.bashrc --> /etc/bashrc`;越往后优先级越高
    - 非交互式登入(`su USERNAME`或者图形界面下打开的终端,或者执行脚本,脚本会单独打开一个shell)读取顺序为: `~/.bash --> /etc/bashrc --> /etc/profile.d/*.sh`
- 脚本:命令的堆砌,按照实际需要结合命令流程控制机制实现的源程序,但很多命令不具有幂等性,需要程序逻辑来判断运行条件是否满足,以避免其运行中发生错误.
- shebang:魔数,脚本中交shebang __第一行__必须是#!/FULLPATHOFSHELL
- 脚本也可以作为脚本的参数来执行,比如 bash first.sh,此时,就算这个脚本文件没有执行权限也能被运行.
#### 条件判断
- bash中条件判断类型通常有三种:表达式 [ expression ],[[ expression ]],test expression
	- 整数测试: 比较两个数的大小
	- 字符测试:字符是不是空的
	- 文件测试: 判断文件是不是存在,或判断文件的类型等
- 条件测试的表达式:

	```bash
	[root@ZhumaTech ~]# A=1
	[root@ZhumaTech ~]# B=2
	```

	1. [ expression ] `[ $A -eq $B ]`

	    ```bash
	    [root@ZhumaTech ~]# [ $A -lt $B ]
	    [root@ZhumaTech ~]# echo $?
	    0
	    ```

	2. `[[ expression ]]`

	    ```bash
	    [root@ZhumaTech ~]# [ $A -gt $B ]
	    [root@ZhumaTech ~]# echo $?
	    1
	    ```

	3. \# test expression

	    ```bash
	    [root@ZhumaTech ~]# test $A -eq $B
	    [root@ZhumaTech ~]# echo $?
	    1
			[root@vm1 ~]# test 2 -lt 3
			[root@vm1 ~]# echo $?
			0
	    ```

- 整数比较(双目比较:比较两个数大小):
	- -eq (equal):测试两个整数是否相等:相等为真,不等为假

		```bash
		[root@ZhumaTech ~]# echo $A
		3
		[root@ZhumaTech ~]# echo $B
		3
		[root@ZhumaTech ~]# [ $A -eq $B ]
		[root@ZhumaTech ~]# echo $?
		0
		```	 
	- -ne (not equal):测试两个整数是否不等:不等为真;相等为假
	- -gt (greater than):测试一个整数是否大于另外一个整数,大于为真,小于等于为假
	- -ge: 大于或等于
	- -le: 小于或等于
- 字符串测试:__所有字符串和变量做等值或大小比较都要引号,否则可能出错;字符串测试要用双中括号__
    - ==: 是否等于
    - \>: 是否大于,比较ASCII码,a比b小
    - <: 是否小于
    - !=: 是否不等于
    - =~: 左侧字符串是否能够被右侧的模式所匹配,___一般用于`[[ ]]`测试___
        ```bash
        [root@localhost tmp]# name=Aphey
        [root@localhost tmp]# [[ $name =~ ^A* ]]    //测试$name能不能被"^A*"匹配到
        [root@localhost tmp]# echo $?
        0
				[root@vm1 ~]# [ tom == Tom ]
				[root@vm1 ~]# echo $?
				1
				[root@vm1 ~]# [ tom == tom ]
				[root@vm1 ~]# echo $?
				0
				// 不加引号,无法做出正确的比较测试,比如下面的例子
				[root@vm1 ~]# [ a > b ]
				[root@vm1 ~]# echo $?
				0
				[root@vm1 ~]# [ a < b ]
				[root@vm1 ~]# echo $?
				0
				// 字符串的比较最好用双中括号来测试,否则可能无法做出正确测试,比如下面的例子
				[root@vm1 ~]# [ "a" < "b" ]
				[root@vm1 ~]# echo $?				
				0
				[root@vm1 ~]# [ "a" > "b" ]
				[root@vm1 ~]# echo $?
				0
				// 正确的表达形式如下
				[root@vm1 ~]# [[ "a" > "b" ]]
				[root@vm1 ~]# echo $?
				1
				[root@vm1 ~]# [[ "a" < "b" ]]
				[root@vm1 ~]# echo $?
				0
        ```
    - `-z "STRING"`: 测试字符串是否为空,空则为真,不空为假
    - `-n "STRING"`: 字符串是否不空,不空为真,空为假
- 命令间的逻辑关系,___只看符号左边的整个执行结果___:
	- 逻辑与: &&
	- 逻辑或: ||
	- 例题:如果'/etc/inittab'行数大于100,则输出它是大文件,否则输出小文件.

	    ```
	    #!/bin/bash
	    LINES=`wc -l /etc/inittab`
	    FINLINES=`echo $LINES|cut -d' ' -f1`
	    [ $FINLINES -gt 100 ] && echo "This is a big file" || echo "This is a small file"
	    ```

	- 如果用户已存在,则输出用户存在,不存在则添加用户`id user1 && echo "user1 exists" || useradd user1`
	- 如果用户不存在,就添加用户,否则,显示其已存在`! id user1 && useradd user1 || echo "user1 exists"`
	- 如果用户不存在,就添加,并且设定密码,否则显示其已经存在`! id user1 && useradd1 && echo "user1"| passwd --stdin user1|| echo "user1 exists"`
- 用户添加,并统计系统有多少个用户

	```bash
	#!/bin/bash
	! id user1 &>/dev/null && useradd user1 && echo "user1" | passwd --stdin user1 $
	! id user2 &>/dev/null && useradd user2 && echo "user2" | passwd --stdin user2 $
	! id user3 &>/dev/null && useradd user3 && echo "user3" | passwd --stdin user3 $

	USERS=`wc -l /etc/passwd|cut -d: -f1`
	echo "`echo $USERS|cut -d' ' -f1` users"
	```

- 给定一个用户:
	- 如果其UID为0.就显示此为管理员
	- 否则,就显示为普通用户

	    ```bash
	    #!/bin/bash
	    NAME=user1
	    USERID=`id -u $NAMEUSER`
	    [ $USERID -eq 0 ] && echo "$NAME is a manager." ||"$NAME is a common user"
	    ```

- 条件判断,控制结构:
	- 单分支if语句

	    ```bash
	    if 判断条件;then
	    	条件为真的分支代码;
	    	...
	    fi
	    ```

	- 双分支的if语句

	    ```
	    if 判断条件;then
            条件为真的分支代码;
	    	...
	    else
            条件为假的分支代码;
	    	...
	    if
	    ```

- shell中如何进行算术运算,有些时候,乘法符号需要转义:
	- 用let命令

	    ```bash
	    [root@ZhumaTech sh]# A=3
	    [root@ZhumaTech sh]# B=6
	    [root@ZhumaTech sh]# let C=$A+$B
	    [root@ZhumaTech sh]# echo $C
	    9
	    ```

	- $[算术运算表达式]

	    ```bash
	    [root@ZhumaTech sh]# C=$[$A+$B]
	    [root@ZhumaTech sh]# echo $C
	    9
	    ```

	- $((算术表达式))

        ```bash
        [root@ZhumaTech sh]# D=$(($B-$A))
        [root@ZhumaTech sh]# echo $D
        3
        ```

	- expr命令;`expr [arg1 arg2 arg3 ....] `运算符也算是参数算术表达式; 算术表达式,表达式中各操作数和运算符之间要有空格并且要使用命令引用

        ```bash
        [root@ZhumaTech sh]# F=`expr $A \* $B`  //*要转义,否则表示所有文件
        [root@ZhumaTech sh]# echo $F
        18
        ```
- 增强型赋值:变量做某种算术运算后回存至此变量中
	```bash
	[root@vm1 ~]# declare -i i=1
	[root@vm1 ~]# let i=$i+2
	[root@vm1 ~]# echo $i
	3
	[root@vm1 ~]# echo $i
	3
	[root@vm1 ~]# let i+=3
	[root@vm1 ~]# echo $i
	6
	[root@vm1 ~]# echo $i
	6
	```
	- 经常用到的增强型赋值:`+=, -=, *=,/=,%=`
- bash内建有随机数生成器:$RANDOM
- 练习:写一个脚本,判定历史命令的总条数是否大于1000,如果大于,显示"some commands has gone",否则显示"OK"

    ```bash
    #!/bin/bash
    HISTNUM=`history | tail -1 | cut -d' ' -f2`
    if [ $HISTNUM -gt $HISTSIZE ]; then
            echo "some commands will be gone"
    else
            echo "OK"
    fi
    ```
#### 整数测试及特殊变量
- exit:直接退出当前脚本;还可以自定义退出状态码,比如1~255;如果未给脚本指定推出状态码,整个脚本的推出状态码取决于脚本中执行的最后一条命令的状态码

    ```
    #!/bin/bash
    #
    NAME=user18
    # ----当这个用户不存在时,提示无此用户并退出脚本----
    if ! grep "$NAME" /etc/passwd >/dev/null; then
            echo "No such user: $NAME"
            exit 1
    fi
    # -----------------------------------------------
    USERID=`grep "\<$NAME\>" /etc/passwd|cut -d: -f3 `
    GRPID=`grep "\<$NAME\>" /etc/passwd|cut -d: -f4 `
    if [ $USERID -eq $GRPID ]; then
            echo "${NAME}'s a good guy"
    else
            echo "${NAME}'s a bad guy"
    fi
    ```

- bash中常用的条件测试有三种:表达式 [ expression ],[[ expression ]],test expression
	- 整数测试:(双目操作:两个数做大小比较);
	- 文件测试:
		- `-[e|a]` FILE:单目测试,测试文件是否存在

	        ```bash
	        [root@ZhumaTech ~]# [ -e /etc/inittab ]
	        [root@ZhumaTech ~]# echo $?
	        0
	        ```

	    - -b FILEPATH: 文件存在且是块设备文件
	    - -c FILEPATH: 存在且为字符设备文件    
		- -f FILEPATH: 测试文件是否为普通文件
		- -d DIRPATH: 测试文件是否为目录
		- `-[h|L]`:存在且为符号链接文件
		- -p FILEPATH:测试文件是否存在且为管道文件
		- -S FILEPATH:是否存在且为套接字文件
		- -g FILEPATH:文件存在且被设置了sgid
		- -u FILEPATH:文件存在且被设置了suid
		- -k FILEPATH:文件存在且被设置了stic
		- -r FILE: 测试当前用户对指定文件是否有对应权限
		- -w FILE: 测试当前用户对指定文件是否有对应权限
		- -x FILE: 测试当前用户对指定文件是否有对应权限
		- -s FILE:测试文件是否存在且非空
		- -t fd: fd表示文件描述符是否已经打开且与某终端相关
		- -N FILE: 文件自从上次被读取后是否被修改过
		- -O FILE: 当前有效用户是否为文件属主
		- -G FILE: 当前有效用户是否为文件属组
		- FILE1 -ef FILE2: FILE1和FILE2是否指向同一个设备上的相同inode
		- FILE1 -nt FILE2: FILE1是否新于FILE2
		- FILE1 -ot FILE2: FILE1是否旧于FILE2
-  组合条件:
	- -a: 与关系 [ $# -gt 1 -a $# -le 3]
	- -o: 或关系
	- !: 非关系
	```
	[root@localhost tmp]# [ -z "$hostName" -o "$hostName"=="localhost.localdomain" ]
    [root@localhost tmp]# echo $?
    0
    // 和下面的命令表达的是同样的意思
    [root@localhost tmp]# [ -z "$hostName" ]||[ "$hostName"=="localhost.localdomain" ]
    [root@localhost tmp]# echo $?
    0
    // 如果主机名存在切主机名为localhost.localdomain,则修改主机名为aphey.com
    [root@localhost tmp]# [ -n "$hostName" -a "$hostName"=="localhost.localdomain" ] && hostname aphey.com
    [root@localhost tmp]# hostname
    aphey.com
    // 如果主机名存在切主机名为aphey.com,则修改主机名为localhost.localdomain
    [root@localhost tmp]# [ -n "$hostName" ]&& [ "$hostName"=="aphey.com" ] && hostname localhost.localdomain
    [root@localhost tmp]# hostname
    localhost.localdomain
	```
- 多分枝的if语句

    ```
    if 判断条件1; then
    		执行语句1
    		...
    elif 判断条件2; then
    		执行语句2
    		...
    elif 判断条件3; then
    		执行语句3
    		...
    else
    		执行语句4
    		...
    fi
    ```

- 测试脚本是否有语法错误: bash -n SHELL.sh
- 脚本单步执行;即把每步操作都显示出来: bash -x SHELL.sh
- 例题:给定一个文件,如果是一个普通文件,就显示之;如果是一个目录,亦显示之;否则显示成无法识别之文件

	```
	[root@ZhumaTech sh]# nano filetest2.sh    
	#!/bin/bash
	#
	FILE=/etc/rc.d/rc.sysinit

	if [ ! -e $FILE ]; then
	        echo "No such file exists"
	        exit 6
	fi

	if [ -f $FILE ]; then
	        echo "Common file."
	elif [ -d $FILE ]; then
	        echo "Directory"
	else
	        echo "Unknown"
	fi

	[root@ZhumaTech sh]#
	[root@ZhumaTech sh]# bash -x filetest2.sh
	+ FILE=/etc/rc.d/rc.sysinit
	+ '[' '!' -e /etc/rc.d/rc.sysinit ']'
	+ '[' -f /etc/rc.d/rc.sysinit ']'
	+ echo 'Common file.'
	Common file.
	```

- 位置变量,$1 就是引用第一个参数,$2 就是引用第二个参数,以此类推,具体看下面的练习,
- 练习:写一个脚本,能接受一个参数(文件路径),判定:此参数如果是一个存在的文件,就显示"OK";否则就显示"No such file"

    ```
    [root@ZhumaTech sh]# nano filetest3.sh
    #!/bin/bash
    #

    if [ -e $1 ]; then
            echo "OK"
    else
            echo "No such file"
    fi

    [root@ZhumaTech sh]# bash filetest3.sh  /etc/fstab
    OK
    [root@ZhumaTech sh]# bash filetest3.sh  /etc/fstaba
    No such file
    ```
    - 上述练习中如果我们忘了给参数,执行结果也是通过的:

        ```
        [root@ZhumaTech sh]# bash -x filetest3.sh  
        + '[' -e ']'
        + echo OK
        OK
        ```

- 如果不给路径, $1是有意外情况发生的,所以我们在脚本中应该判定用户必须给这个脚本参数.如果不给参数,我们就不执行.
	- 特殊变量:
		- $?: 上一条命令的退出状态码
		- $#: 查看命令参数的个数
		- $*: 参数列表
		- $@: 参数列表
		- $0: 执行脚本时的脚本路径及名称

	```
	[root@ZhumaTech sh]# cat  filetest3.sh
	#!/bin/bash
	#
	if [ $# -lt 1 ]; then
	        echo "请输入参数 "
	        exit 3
	fi

	if [ -e $1 ]; then
	        echo "OK"
	else
	        echo "No such file"
	fi
	```

- 位置变量常用命令:shift,轮替`shif n: 一次轮替掉n个`

	```
	[root@ZhumaTech sh]# nano shift.sh

	#!/bin/bash
	echo $1
	shift 2
	echo $1
	shift 2
	echo $1
	shift 2
	[root@ZhumaTech sh]# bash shift.sh 1 2 3 4 5
	1
	3
	5
	```    
- read [选项] [变量名]
- read还能把一个行从标准输入读入以后还能以空格为分割符将其切割成字段,把切割后的结果对位保存在指定变量当中
    ```
    [root@localhost ~]# read name
    Obama
    [root@localhost ~]# echo $name
    Obama
    [root@localhost ~]# read a b c
    //对位分割
    how old are you?
    [root@localhost ~]# echo $a
    how
    [root@localhost ~]# echo $c
    are you?
    [root@localhost ~]# echo $d
    Hello
    [root@localhost ~]# echo $e
    World
    [root@localhost ~]# echo $f
    ```
	- -p "Prompt": "提示消息": 在等待read输入时,输出提示信息
    - -t \#: \#秒数: read命令会一直等待用户输入,使用此选项可以制定等待时间
    - -n: 字符数: read命令只接受制定的字符数,就会执行,不用按回车
    - -s: 隐藏输入的数据,适用于机密信息的输入

    ```
    #!/bin/bash
	read  -t 30 -p "Please input two integers:" A B	//指定30秒内要求用户输入两个整数
	[ -z $A ] && A=100		//如果$A为空,则自动为$A赋值为100
	[ -z $B ] && B=1000		//如果$B为空,则自动为$B赋值为1000
	echo "$A plus $B is $[$A+$B]"
    ```



#### 案例:
- 判断给出文件的行数
    ```
    [root@mail sh]# vi linecount.sh

    #!/bin/bash
    linecount=$(wc -l $1 |cut -d : -f1)
    echo "$1 has $linecount lines"
    [root@mail sh]# chmod +x linecount.sh
    [root@mail sh]# ./linecount.sh /etc/passwd
    /etc/passwd has 40 lines
    ```
- 求出/etc/passwd中第10行和第20行用户uid的和
    ```
    [root@mail sh]# vi sum.sh

    #!/bin/bash
    num1=`head -10 /etc/passwd|tail -n 1|cut -d: -f3`
    num2=`head -20 /etc/passwd|tail -n 1|cut -d: -f3`
    sum=$[$num1+$num2]
    echo $sum
    ```
- 传递两个文件路径作为脚本的参数,计算这俩文件中所有空白行之和
    ```
    [root@localhost tmp]# vi spacelines.sh

    spaceline1=`grep "^[[:space:]]*$" $1 |wc -l`
    spaceline2=`grep "^[[:space:]]*$" $2| wc -l`
    sum=$[$spaceline1+$spaceline2]
    echo $sum
    ```
- 统计/etc/,/var,/usr目录共有多少个以一级子目录和文件
    ```
    [root@localhost tmp]# vi count.sh

    #!/bin/bash
    countetc= `ls -l /etc|grep "^[-d]"|wc -l`
    countvar= `ls -l /var|grep "^[-d]"|wc -l`
    countusr= `ls -l /usr|grep "^[-d]"|wc -l`
    ```
- 接受一个文件路径作为参数:如果参数个数小于1,则提示用户:"至少应该给一个参数",并立即退出;如果参数个数不小于1,则显示第一个参数所指巷的文件中的空白行数
    ```
    [root@localhost tmp]# vi test.sh

    #!/bin/bash
    [ $# -ge 1 ] && grep "^[[:space:]]*$" $1
    [ $# -lt 1 ] && echo "You have to add at least one parameter" && exit 6
    ```
##### for 循环
- 循环种类:
	- for循环
	- while循环
	- until循环
- 用法:

	```
	for 变量 in 列表;do
		循环体;
	done
	```

- 如何生成列表:
	- 整数列表:
		- {1..100} 花括号会自动展开
		- seq命令,在for中做列表时,记得替换`seq NUM`
			- seq 10 :从1到10
			- seq 5 10:从5到10
			- seq 2 2 10: 从2开始每次间隔2,到10为止,中间的2叫步进
			- seq 1 2 10: 从1开始每次间隔2,到10位置,中间的2叫步进

- 1到100整数的和

	```
	[root@ZhumaTech sh]# nano sum.sh

	#!/bin/bash
	declare -i SUM=0
	for I in {1..100}; do
	        let SUM=$[$SUM+$I]
	done

	echo "The sum is $SUM"

	[root@ZhumaTech sh]# bash sum.sh
	The sum is 5050
	```

- 依次向/etc/passwd中的每个用户问好

	```
	[root@ZhumaTech sh]# LINES=`wc -l /etc/passwd|cut -d' ' -f1`
	[root@ZhumaTech sh]# for I in `seq 1 $LINES`; do echo "Hello, `head -n $I /etc/passwd | tail -1 | cut -d: -f1`"; done
	```

- 只向/etc/passwd中shell是/bin/bash的用户问好.并说明他的shell

    ```
    [root@ZhumaTech sh]# nano shell.sh
    #!/bin/bash

    LINES=`grep '/bin/bash$' /etc/passwd |wc -l|cut -d' ' -f1`

    for I in `seq 1 $LINES`; do
             echo " hello, `grep '/bin/bash' /etc/passwd | head -n $I | tail -1 | cut -d: -f1` and your shell is `grep '/bin/bash' /etc/passwd | head -n $I | tail -1 | cut -d: -f7`;
    done
    ```
##### until循环

	```
	until CONDITION; do
		statement
		...
	done

	进入循环:条件不满足
	退出循环:条件满足
	```

- 每隔5s,检测hadoop用户是否登陆进系统

	```
	[root@ZhumaTech sh]# vi hadoop.sh
	#!/bin/bash
	who | grep "hadoop" &> /dev/null
	RETVAL=$?
	until [ $RETVAL -eq 0 ]; do
	        echo "hadoop is not logged on"
	        sleep 5
	        who | grep "hadoop" &> /dev/null
	        RETVAL=$?
	done

	echo "hadoop is logged on"
	```

- 任何时候,我们取一个命令返回值来做条件的时候,可以把命令当作条件,所以上面的命令可以简写成

	```
	[root@ZhumaTech sh]# vi hadoop.sh
	#!/bin/bash
	until who | grep "hadoop" &> /dev/null; do
	        echo "hadoop is not logged on"
	        sleep 5
	done
	echo "hadoop is logged on"
	```

- for循环的另一种形式
	- 第一种常规的

	```
	for 变量 in 列表; do
		循环体
	done
	```

	- 第二种;近似于c语言的风格

	```bash
	for (( expr1 ; expr2 ; expr3 )); do
		循环体
	done
	//expr1 用来指定初始条件
	//expr2 用来判定什么时候退出循环
	//expr3 用来修正这个变量的值
	```  	

	//计算100以内正整数的和

	```
	[root@ZhumaTech sh]# vi 100.sh
	#!/bin/bash
	declare -i SUM=0
	for (( I=1; I<=100; I++ )); do
	        let SUM+=$I
	done
	echo $SUM

	[root@ZhumaTech sh]# ./100.sh  
	5050
	```
##### while循环:适合循环次数未知的场景;必须要有退出条件;外面先赋予一个值里面在修正这个值
- 语法格式

	```bash
	while CONDITION; do
	   statement
	   ...
    done
	```

	```
	//计算100以内所有正整数的和
	#!/bin/bash
	declare -i I=1
	declare -i SUM=0

	while [ $I -le 100 ]; do
	  let SUM+=$I
	  let I++
	done
	echo $SUM
	```

	```
	//当输入quit时,退出脚本,否则把小写字母改成大写字母
	#!/bin/bash
	read -p "Input somthing that will be translated into Capital way" STRING
	while [ $STRING != 'quit' ]; do
	        echo $STRING|tr 'a-z' 'A-Z'
	        read -p "Input somthing that will be translated into Capital way" STRING

	done
	```
##### case 语句
	```
	case SWITCH in
	VALUE1)
	statement
	...
	;;
	VALUE2)
	statement
	...
	;;
	*)
	statement
	...
	;;
	esac
	```
- case支持glob风格的通配符:
    - `*`: 任意长度任意字符;
    - `?`: 任意单个字符;
    - `[]`: 指定范围内的任意单个字符
    - `a|b`: a或b
    - string: string整个字符串
	```
	// 判断参数是什么类型
	case $1 in
	[1-9])
		echo "Digit" ;; //必须要加双分号
	[a-z])
		echo "Lower letter"
	;;	//双份号的位置可以放在上行结尾,也可以放在这一行开头
	[A-Z])
		echo "Capital letter" ;;
	*)	//其他情况
		echo "Other character" ;;
	esac
	```

	```
	//写一个脚本,能够接受参数start,stop,restart,status其中之一
	#!/bin/bash
	case $1 in
	'start')
	    echo 'The argument you input was "start".' ;;
	'stop')
	    echo 'The argument you input was "st".' ;;
	'restart')
	    echo 'The argument you input was "start".' ;;
	'status')
	    echo 'The argument you input was "status".' ;;
	*)
	    echo '`basename $0` {start|stop|restart|status}' ;;
	esac
	```

	```
	#!/bin/bash
	DEBUG=0	//初始化DEBUG变量值
	ADD=0	//初始化ADD初始化值
	DEL=0	//初始化DEL变量的值

	for I in `seq 0 $#`; do	//在脚本后面的所有参数间进行循环
	if [ $# -gt 0 ]; then	//参数大于0个的时候才进行下面的分析
	case $1 in
	-v|--verbose)
	  DEBUG=1	//当选项为-v|--verbose的时候使DEBUG值为1
	  shift ;;	//论题掉-v|--verbose选项
	-h|--help)
	  echo "Usage: `basename $0` --add USER_LIST --del USER_LIST -v|--verbose -h|--help"
	  exit 0
	  ;;
	--add)
	  ADD=1	//当选项为--add的时候,使变量$ADD为1
	  ADDUSERS=$2	//当选项为--add的时候,使变量$ADDUSERS为$2位置函数上的值
	  shift 2	//轮替掉两个位置,即 --add选项和 后面的用户名
	  ;;
	--del)
	  DEL=1	//当选项为--del的时候,使变量$DEL为1
	  DELUSERS=$2	//当选项为--del的时候,使变量$DELUSERS为$2位置函数上的值
	  shift 2	//轮替掉两个位置,即 --del选项和 后面的用户名
	  ;;
	*)
	  echo "Usage: `basename $0` --add USER_LIST --del USER_LIST -v|--verbose -h|--help"
	  exit 7
	  ;;
	esac
	fi
	done

	if [ $ADD -eq 1 ]; then
	  for USER in `echo $ADDUSERS | sed 's@,@ @g'`; do	//用一个循环来添加位置参数$2上的用户
	    if id $USER &> /dev/null; then	//当用户名存在的时候
	      [ $DEBUG -eq 1 ] && echo "$USER exists."	//输出用户名已存在
	    else	//否则(即id $USER不存在时)
	      useradd $USER		//创建用户
	      [ $DEBUG -eq 1 ] && echo "Add user $USER finished."	//当DEBUG为一(即有了-v选项),输出详细信息
	    fi
	  done
	fi

	if [ $DEL -eq 1 ]; then
	  for USER in `echo $DELUSERS | sed 's@,@ @g'`; do	//为DELUSERS(当选项为--del时,位置参数2上的用户名)做循环操作
	    if id $USER &> /dev/null; then	//当用户存在时
	      userdel -r $USER		//执行删除用户命令
	      [ $DEBUG -eq 1 ] && echo "Delete $USER finished."	//当$DEBUG为1时(即有-v选项时),输出详细信息
	    else	//否则,即id $USER 不存在时
	      [ $DEBUG -eq 1 ] && echo "$USER not exist."	//有-v选项时输出详细信息
	    fi
	  done
	fi
	```

- 案例,写一个脚本,可以接受选项及参数,而后能获取每一个选项,以及选项的参数,并能根据选项及参数做出特定的操作.比如:adminusers.sh --add tom,jerry --del tom,blair -v|--verbose -h|--help

    ```
    //首先我们学习一下如何识别-v|--verbose
    #!/bin/bash
    DEBUG=0 //初始化变量DEBUG的值
    case $1 in
    -v|--verbose)	//当选项是-v或者--verbose的时候
    	DEBUG=1 ;;	//赋予变量$DEBUG为1
    *)
    	echo "Unknow options" ;; 	//否则这显示为未知选项
    [ $DEBUG -eq 1 ] && echo "Hello" 	//再行判断和输出详情
    ```

- 案例,写一个脚本,可以接受选项及参数,而后能获取每一个选项,以及选项的参数,并能根据选项及参数做出特定的操作.查看当前系统登陆的用户数 -v|--verbose显示详细信息;-c|--count显示用户数; -h|--help:显示帮助

    ```
    #!/bin/bash
    declare -i SHOWNUM=0	//初始化SHOWNUM
    declare -i SHOWUSERS=0	//初始化SHOWUSERS
    for I in `seq 1 $#`; do
      if [ $# -gt 0 ]; then	//参数大于0的时候,执行多分枝选择
        case $1 in
        -h|--help)
          echo "Usage: `basename $0` -h|--help -c|--count -v|--verbose"
          exit 0 ;;
        -v|--verbose)
          let SHOWUSERS=1 	
          shift ;;	//轮替掉这个选项
        -c|--count)
          let SHOWNUM=1
          shift ;;	//轮替掉这个选项
        *)
          echo "Usage: `basename $0` -h|--help -c|--count -v|--verbose"
          exit 8 ;;	//当选项不是我们需要的选项的时候,就错误退出
        esac
      fi
    done

    if [ $SHOWNUM -eq 1 ]; then
      echo "Logged users: `who | wc -l`."	//当识别选项为-c|--count的时候,输出用户个数
      if [ $SHOWUSERS -eq 1 ]; then	//当识别选项为-c|--count,并且加-v|--verbose选项的时候,输出用户个数和详细列表
        echo "They are:"
        who
      fi      
    fi
    ```    
#### 数组和字符串处理
- 变量: 存储单个元素的内存空间
- 数组: 存储多个相同属性的元素的连续的内存空间;对于数组的引用,我们只需要使用数组名.
    - 数组名
    - 索引: 编号从0开始,属于数值索引,索引也支持自定义格式,而不仅仅是数值格式;引用数组中的元素: ${ARRAY_NAME[INDEX]}
    - bash的数组支持稀疏格式:数组可以有第一个元素,第二个元素,然后直接跳到第六个元素,中间没有也是可以的
- 声明数组:
    - `declare -a ARRAY_NAME`
    - `declare -a ARRAY_NAME`: 关联数组
- 数组元素的赋值方式:
    1. 一次只赋值一个元素: ARRAY_NAME[INDEX]=VALUE
        ```
        //稀疏格式,一次赋值一个元素
        weekdays[0]="Sunday"
        weekdays[4]="Friday"
        ```
    2. 一次赋值全部元素: ARRAY_NAME=("VALUE1","VALUE2","VALUE3" ....)
    3. 只赋值特定元素: ARRAY_NAME=([0]="VALUE1" [3]="VALUE2")
    4. read -a ARRAY
- 引用数组元素${ARRAY_NAME[INDEX]};[INDEX]省略时,表示引用下标为0的元素
    ```
    [root@localhost system]# weekdays[0]="Sun"
    [root@localhost system]# weekdays[1]="Mon"
    [root@localhost system]# weekdays[4]="Thursday"
    [root@localhost system]# echo ${weekdays[1]}
    Mon
    [root@localhost system]# echo ${weekdays}   //下标省略,表示第0个
    Sun
    ```
- 数组长度(数组中有多少个元素):`${#ARRAY_NAME[*]}`或者`${#ARRAY_NAME[@]}`
- 示例: 生成10个随机数,找出其中最大值:
    ```
    [root@localhost tmp]# vi array.sh
    #!/bin/bash
    declare -a rand
    declare -i max=0

    for i in {0..9}; do
            rand[$i]=$RANDOM
            echo ${rand[$i]}
            [ ${rand[$i]} -gt $max ] && max=${rand[$i]}
    done

    echo "Max:$max"
    ```
- 示例:随机生成10个数,求出最大值和最小值的和
    ```
    [root@localhost tmp]# vi array.sh
    #!/bin/bash
    declare -a rand
    declare -i max=0    //初始化最大值
    declare -i min=0    //初始化最小值

    for i in {0..9}; do
            rand[$i]=$RANDOM    //获取随机数
            echo ${rand[$i]}    //输出随机数
            [ ${rand[$i]} -gt $max ] && max=${rand[$i]} //如果随机数大于最大值,则让最大值等于这个随机数
            [ $i -eq 0 ] && min=${rand[$i]} //让最小值min等于第一次生成的随机数
            [ ${rand[$i]} -lt $min ] && min=${rand[$i]} //若后面生成的随机数小于最小值,则让最小值min等于随机数
    done
    echo "max:$max"
    echo "min:$min"
    echo "sum=$[$max+$min]"
    ```
- 练习:写一个脚本:定义一个数组,数组中的元素是/var/log目录下所有以.log结尾的文件;要统计其下标为偶数的文件中的行数之和
    ```
    [root@localhost tmp]# vi array1.sh
    #!/bin/bash  
    declare -a files
    files=(/var/log/*.log)  //能够实现把/var/log/*.log展开为空格分开的多个元素
    declare -i lines=0
    for i in $(seq 0 $[${#files[*]}-1]); do // 对元素做循环操作,seq 从0到元素个数-1
        if [ $[$i%2] -eq 0 ];then       // 对元素下标为偶数的的元素进行操作
    	let lines+=$(wc -l ${files[$i]} | cut -d' ' -f1)
        fi
    done
    echo "Lines: $lines."
    ```
- 引用数组中的所有元素
    - 所有元素: $(ARRAY[@])或者$(ARRAY[*])
    - 取出特定元素(数组切片,或者元素切片): `${ARRAY[@]:OFFSET:NUMBER}`; OFFSET: 要跳过的元素个数; NUMBER: 要取出的元素个数
        ```
        [root@localhost tmp]# weekdays=([0]="Sunday" [1]="Monday" [2]="Tuesday" [3]="Wednesday" [4]="Thursday" [5]="Friday" [6]="Saturday")
        [root@localhost tmp]# echo ${weekdays[@]}
        Sunday Monday Tuesday Wednesday Thursday Friday Saturday
        [root@localhost tmp]#  echo ${weekdays[*]:2:2}
        Tuesday Wednesday
        ```
    - 数组切片我们还可以只设置偏移数字,设置偏移多少个元素,取出其他全部的元素`${ARRAY[@]:OFFSET}`
        ```
        [root@localhost tmp]# echo ${weekdays[@]}
        Sunday Monday Tuesday Wednesday Thursday Friday Saturday
        [root@localhost tmp]# echo ${weekdays[*]:2}
        Tuesday Wednesday Thursday Friday Saturday
        ```
- 向数组中追加元素:`ARRAY[${#ARRAY[*]}]`
- 从数组中删除元素:`unset ARRAY[INDEX]`
#### bash的字符串处理工具:
- 字符串切片: ${VAR:OFFSET:NUMBER},取字符串的子串
    ```
    [root@localhost tmp]# echo ${name:2:3}
    ama
    ```   
- 取字符串的最右侧几个字符: ${VAR: -LENGTH};注意空格
    ```
    [root@localhost tmp]# name=Obama
    [root@localhost tmp]# echo ${name: -4}
    bama
    ```
- 基于模式取子串:也叫截取变量字符串`${PARAMETER#KEYWORD},${PARAMETER##KEYWORD},${PARAMETER%KEYWORD},${PARAMETER%%KEYWORD}``:看例子
    ```
    [root@Aphey boot]# FILE=/usr/local/src
    [root@Aphey boot]# echo $FILE
    /usr/local/src
    [root@Aphey boot]# echo ${FILE#/}   //从左往右,省略掉第一个关键字"/"及其左边的内容
    usr/local/src
    [root@Aphey boot]# echo ${FILE##*/} //从左往右,省略掉第一个关键字到最右的关键字"/"及他们左边的内容
    src
    [root@Aphey boot]# FILE=a/usr/local/src
    [root@Aphey boot]# echo ${FILE%/*}     //从右往左,省略掉第一个关键字"/"及其右边的内容
    a/usr/local
    [root@Aphey boot]# echo ${FILE%%/*}    //从右往左,省略掉第一个关键字到最左的关键字"/"及他们右边的内容
    a
    ```
- 查找替换:${VAR/PATTERN/SUBSTITUTE}: 查找变量中自左而右第一次被PATTERN匹配到的字符串,再用SUBSTITUTE替换;
- 查找替换:${VAR//PATTERN/SUBSTITUTE}: 查找所有被PATTERN匹配到的字符串,再用SUBSTITUTE替换;
- 行首行尾的锚定:${VAR/#PATTERN/SUBSTITUTE}: 查找变量所表示的字符串中,行首被PATTERN所匹配的字符串用SUBSTITUTE替换;行尾用${VAR/%PATTERN/SUBSTITUTE}表示
    ```
    [root@localhost tmp]# user=$(head -1 /etc/passwd)
    [root@localhost tmp]# echo $user
    root:x:0:0:root:/root:/bin/bash
    [root@localhost tmp]# echo ${user/root/ROOT}
    ROOT:x:0:0:root:/root:/bin/bash
    [root@localhost tmp]# echo ${user//root/ROOT}
    ROOT:x:0:0:ROOT:/ROOT:/bin/bash
    [root@localhost tmp]# echo ${user/#root/ROOT}   //只匹配行首的
    ROOT:x:0:0:root:/root:/bin/bash
    [root@localhost tmp]# user="admin:$user:root"   
    [root@localhost tmp]# echo $user
    admin:root:x:0:0:root:/root:/bin/bash:root
    [root@localhost tmp]# echo ${user/#root/ROOT}   //root不在行首所以不匹配,不替换
    admin:root:x:0:0:root:/root:/bin/bash:root
    [root@localhost tmp]# echo ${user/%root/ROOT}   //root在行尾,所以用ROOT替换
    admin:root:x:0:0:root:/root:/bin/bash:ROOT
    ```
- 查找并删除 `${VAR/PATTERN}`查找变量中自左而右第一次被PATTERN匹配到的字符串并删除;`${VAR//PATTERN}`查找变量中自左而右所有被PATTERN匹配到的字符串并删除;行首行尾,和上面锚定的用法一样
- 变量字符大小写转换:`${VAR^^}` 把VAR中所有小写字符换成大写;`${VAR,,}`把VAR中所有大写换成小写
    ```
    [root@localhost tmp]#
    [root@localhost tmp]# echo ${user^^}
    ADMIN:ROOT:X:0:0:ROOT:/ROOT:/BIN/BASH:ROOT
    [root@localhost tmp]# myuser=`echo ${user^^}
    [root@localhost tmp]# echo $myuser
    ADMIN:ROOT:X:0:0:ROOT:/ROOT:/BIN/BASH:ROOT
    [root@localhost tmp]# echo ${myuser,,}
    admin:root:x:0:0:root:/root:/bin/bash:root
    ```
- 变量赋值:有时候我们写脚本的时候,比如有read命令-t选项,用户没有输如值,那么变量的值就为空了.注意: 减号是最常用的.
    - ${parameter:-word}: 如果一个变量为空或未定义,则变量展开为"word",否则,展开为parameter的值;
        ```
        [root@Aphey boot]# A=3
        [root@Aphey boot]# echo ${A:-30}    //意思是,如果变量A有值,那么A就等于他自身.
        3
        [root@Aphey boot]# unset A  //释放变量A,此时变量A为空
        [root@Aphey boot]# echo ${A:-30}    //意思是,如果变量A为空,那么展开后的值就是word,也就是30;因此这里展开就变成30.
        30
        [root@Aphey boot]# echo $A  //变量A仍为空

        ```
    - ${parameter:+word}: 如果一个变量为空或未定义,不做任何操作,否则,展开为"word"的值;___其实就是如果变量为空,就让为空;如果不为空,不管它的值是多少,都让它变成"word".___
        ```
        [root@Aphey boot]# unset A
        [root@Aphey boot]# echo $A  //A为空

        [root@Aphey boot]# echo ${A:+30}    //A为空,那么输出也为空

        [root@Aphey boot]# A=5      //A不为空,
        [root@Aphey boot]# echo ${A:+30}    //输出我想要的值,30.
        30
        ```
    - ${parameter:=word}: 如果一个变量为空或未定义,则变量展开为"word",并将展开后的值赋给parameter;
        ```
        [root@Aphey boot]# unset A
        [root@Aphey boot]# echo $A  //$A为空

        [root@Aphey boot]# echo ${A:=30}    //展开后的值为word,也就是30,并把这个值赋给变量.
        30
        [root@Aphey boot]# echo $A  //查看变量的值,果然是word,也就是30.
        30
        ```
    - ${parameter:?error_infomation}: 如果一个变量为空或未定义,那么返回error_infomation;否则返回变量自身的值
        ```
        [root@Aphey boot]# unset A
        [root@localhost tmp]# echo ${A:?empty}
        -bash: A: empty
        [root@localhost tmp]# A=3
        [root@localhost tmp]# echo ${A:?empty}
        3
        ```
    - ${parameter:offset:length}: 取子串,从offset处的后一个字符开始,取length长的子串;做字符串切片; offset是指 略(偏移)过去几个;后面的长度可以省略,省略的意思是,跳过去后的内容全部显示出来
        ```
        [root@Aphey boot]# A="Hello World"
        [root@Aphey boot]# echo ${A:2:3}    //从第三个字符开始,取出3个字符并显示.
        llo
        [root@Aphey boot]# echo ${A:2}  //跳过两个字符,并显示剩余的所有字符
        llo World
        ```
- 为脚本读取配置文件:在RHEL系统上,在/etc/rc.d/init.d/下有很多服务脚本,他们也可以支持配置文件的.这些配置文件都放在/etc/sysconfig/服务脚本同名的配置文件.要引用这些配置文件的方法很简单,在脚本里添加`. CONFFILE`或者`source CONFFILE`; 定义文本文件,每行定义"name=value"
- 命令`mktemp`:创建临时文件或者目录.语法是`maketmp /tmp/file.XXX`,至少3个X,`maketmp -d /tmp/file.XXX`就是创建临时目录的命令;常用来保存到某变量中做引用;我们还可以用`--tmpdir=/PATH/TO/SOMEWHERE来指定临时文件目录位置
    ```
    [root@Aphey tmp]# mktemp /tmp/file.XX
    mktemp: too few X's in template `/tmp/file.XX'
    [root@Aphey tmp]# mktemp /tmp/file.XXX
    /tmp/file.jSl
    [root@Aphey tmp]# mktemp /tmp/file.XXXX
    /tmp/file.DxyK
    [root@mail tmp]# tmpfile=$(mktemp /tmp/file.XXXX)   //用来做引用
    [root@mail tmp]# echo $tmpfile  
    /tmp/file.IEVQ
    ```
