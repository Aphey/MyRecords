### Linux系统文件删除的原理详解

#### 删除的原理描述

**删除的条件:**

1. 文件的硬链接数为0

2. 当这个文件的引用计数为0(没有进程占用,所以如果要删除什么文件,记得重启相关服务)

3. 当其他新文件覆盖了inode和block,或者系统回收了inode 和block,那么这个文件就再也找不回来了

### Linux 用户和用户组介绍

```
[root@localhost etc]# useradd -g root aphey //添加用户aphey,把他的默认组设为root组
[root@localhost etc]# id aphey	//可以查看用户的uid 和 gid
uid=500(aphey) gid=0(root) groups=0(root)
```

### linux用户分类

1. 超级用户(root	家目录:/root)
2. 普通用户(可以通过sudo 提权 家目录: /home/username)
3. 虚拟用户(伪用户):安装系统后默认存在,且默认情况下大部分时间不能登陆,但是他们是系统正常
   运行不可缺少的,他们的存在主要是方便系统管理,满足相应的系统进程对文件属主的要求.

#### 不同用户角色对应的UID

UID | 权限 |描述
---|---|---
0 | 超级用户 | 当用户的UID为0时,表示这个账号为超级管理员, 如果要添加一个系统管理员账号,只要将该账号的uid改成0即可
1-499 | 虚拟用户(伪用户) | 这个范围是保留给系统使用的UID,之所以这样划分, 是为了防止人为建立的账号账号的UID和系统UID之间冲突,并无其他特殊含义.
500-65535 | 普通用户 | 普通用户的UID是从500开始的,我们可以随时指定UID来创建用户


#### 切换用户时,提示符变成 -bash-4.1$ ,解决方法

```
[root@localhost ~]# rm -fr /home/aphey	//root用户删除掉用户aphey的宿主目录
[root@localhost ~]# su - aphey	//再切换到aphey用户,就出现了提示符错误
su: warning: cannot change directory to /home/aphey: No such file or directory
-bash-4.1$
-bash-4.1$
-bash-4.1$ logout	//切换到root用户
[root@localhost ~]# cd /home
[root@localhost home]# mkdir aphey	//创建aphey文件夹
[root@localhost home]# cp -a /etc/skel/\.bash* /home/aphey	//拷贝默认用户模板到aphey用户的宿主目录里
[root@localhost home]# chown -R aphey.root /home/aphey	//更改宿主目录及里面子文件的所有者和所属组
[root@localhost home]# su - aphey	//切换到aphey
[aphey@localhost ~]$ 		//提示符恢复正常
```

#### 用户和用户组的对应关系
##### 用户和用户组的对应关系有:一对一,一对多,多对一和多对多

```
//ls --full-time	//可以完整显示修改时间
[root@localhost oldboy]# ll --full-time
total 12
drwxr-xr-x. 2 root root 4096 2016-09-19 05:58:26.000000000 +0800 oldboydir
lrwxrwxrwx. 1 root root    9 2016-09-19 05:59:12.882243210 +0800 oldboydir_hard_link -> oldboydir
lrwxrwxrwx. 1 root root    9 2016-09-19 06:00:08.238240255 +0800 oldboydir_soft_link -> oldboydir
-rw-r--r--. 2 root root   19 2016-09-19 06:18:52.835240599 +0800 oldboyfile

//ls --time-style=long-iso	//可以以年月日,时分的格式显示时间,默认情况下显示的是修改时间
[root@localhost oldboy]# ll --time-style=long-iso
total 4
drwxr-xr-x. 2 root root 4096 2016-09-19 05:58 oldboydir
lrwxrwxrwx. 1 root root    9 2016-09-19 05:59 oldboydir_hard_link -> oldboydir
lrwxrwxrwx. 1 root root    9 2016-09-19 06:00 oldboydir_soft_link -> oldboydir
-rw-r--r--. 2 root root    0 2016-09-20 05:05 oldboyfile
-rw-r--r--. 2 root root    0 2016-09-20 05:05 oldboyfile_hard_link
lrwxrwxrwx. 1 root root   10 2016-09-19 05:47 oldboyfile_soft_link -> oldboyfile

[root@localhost oldboy]# stat oldboyfile	//stat filename 查看文件信息
  File: `oldboyfile'
  Size: 0               Blocks: 0          IO Block: 4096   regular empty file
Device: 803h/2051d      Inode: 791071      Links: 2
Access: (0644/-rw-r--r--)  Uid: (    0/    root)   Gid: (    0/    root)
Access: 2016-09-19 06:23:19.841240601 +0800
Modify: 2016-09-20 05:05:26.161170831 +0800
Change: 2016-09-20 05:05:26.161170831 +0800
```

***ls时,文件权限最后面有个.;.的意思是selinux是开启状态是创建的;C-6以后才有的***

### 文件的权限

#### 特殊位权限(SUID,SGID,SBit)

```
[root@localhost oldboy]# ll -d /tmp
drwxrwxrwt. 4 root root 20480 Sep 20 03:28 /tmp //这里权限里的小t表示粘着位
[root@localhost oldboy]# ll /usr/bin/passwd
-rwsr-xr-x. 1 root root 30768 Feb 22  2012 /usr/bin/passwd  //权限里的小s表示SUID,让用户暂时获得root权限
```
_案例: root 创建了一个/test/sample\.txt,现在将sample\.txt的权限改为-rwxrwxrwx,并切换用户到user1,请问user1可以删除sample.txt吗?_

***答案是不能,因为sample的权限信息等是存在 sample.txt对应的inode里面,但是sample\.txt却存在与/test目录的block里面,二/test的权限为默认权限,其他用户没有写权限,因此,user1不能删除,要想让user1可以删除两种方法,改变/test目录的所有者或者目录的权限***

#### 有关文件删除的说明

```
Inode(根目录inode) /目录的inode表数值及根目录的属性信息  --> Block
(根目录block)记录/tmp/目录与对应inode数值的关联数据--> Inode(tmp目录
的inode) /tmp/目录的inode表数值及根目录的属性信息 --> Block(tmp 目录
的block) /tmp/oldboyfile 与对应inode数值的关联数据 --> Inode(无file
文件名) Type:Regular FIles|-rw-r--r-- Access:.... /tmp/file的inode表
数值  --> Block 文件的数据内容:I'm oldboy
一句话总结,一个文件能否删除,就看上一级目录是否有删除的权限
```

#### 目录的权限

权限|对文件|对目录
---|---|---
r：读取权限，数字代号为"4"。|         对文件:可以查看文件内容 |  对目录:可以列出目录中的内容
w：写入权限，数字代号为"2"。|         对文件: 可以修改文件内容|  对目录:可以在目录中创建,删除文件(需要x权限配合)
x：执行或切换权限，数字代号为"1"。 |   对文件: 可以执行文件   |  对目录:可以进入目录
-：不具任何权限，数字代号为"0"。| |   |
s：特殊权限,功能说明：变更文件或目录的权限。|    |   |

#### umask
*root用户创建目录的默认权限是755,文件是644;普通用户创建目录的默认权限是775,文件是664*

*其实系统的默认权限是有umask值决定的*

*umask 用来控制文件权限的*
*文件的权限=666-umask;当umask之中有奇数位时,得到的结果在该位置上加1*
*目录的权限=777-umask*

#### 改变文件的属主

*命令*

```
命令格式:chown [选项] [所有者]:[所属组] 文件
Example:
[root@localhost oldboy]# chown -R aphey:aphey d33	//更改用户和组
[root@localhost oldboy]# ll -d d33
drwxr--r--. 2 aphey aphey 4096 Sep 22 17:05 d33
[root@localhost oldboy]# chown -R .root d33 	//用:组名或者.组名可以更改组也可以用chgrp来更改组
[root@localhost oldboy]# ll -d d33/
drwxr--r--. 2 aphey root 4096 Sep 22 17:05 d33
```
*有时候我们会看到一个文件的属主和用户组是数字,那么说明原来的用户可能被删除了*

```
chattr 改变文件的系统属性.让文件无法被修改(包括root) -i(immutable)[ɪ'mjuːtəb(ə)l] adj. 不变的；不可变的；不能变的

-i 如果对文件设置i属性,那么不允许对文件进行删除,改名;相当于把文件给锁定了!比a选项更严格也不能添加和修改数据;如果对目录设置i属性,那么只能修改目录下文件的额数据,但不允许建立和删除文件.
-a 如果对文件设置a属性, 那么只能在文件中增加数据, 但是不能删除也不能修改数据; 如果对目录设置a属性,那么只允许在目录中建立和修改文件,但是不允许删除;相对i选项要宽松点;当给文件追加+a属性后, 只能通过#echo 命令追加内容, vi/vim 都无法修改或者删除文件

lsattr 查看文件的系统属性
-a 显示所有文件和目录
-d 若目标是目录,仅列出目录本身的属性,而不是子文件的

[root@localhost oldboy]# chattr +i 123
[root@localhost oldboy]# rm -f 123
rm: cannot remove `123': Operation not permitted
[root@localhost oldboy]# lsattr 123
----i--------e- 123
[root@localhost oldboy]# chattr -i 123
[root@localhost oldboy]# lsattr 123
-------------e- 123
```

#### 正则表达式
##### 正则表达式就是处理字符串的方法,,以行为单位进行字符串的处理,通过一些特殊符号的辅助,可以让用户轻松搜索/替换某些特定字符串.

###### 正则表达式一般是基于grep来讲的

1. 基础正则表达式:BRE (Basic Regular Expression)
	1. ^word	表示搜索以word开头的内容
	2. word$	表示搜索以word结尾的内容
	3. ^$		表示空行,不是空格

		```
		//	准备练习资料
		[root@localhost ~]# cat oldboy.log 	//新建oldboy.log,内容如下
		I am oldboy teacher!
		I teach linux.

		I like badminton ball. billard ball and Chinese chess.

		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org

		my qq num is 49000488.

		not 4900000448.
		my god,i am not oldbey,but OLDBOY!
		```

		```
		//	过滤以'I'开头的行
		[root@localhost ~]# grep "^I" oldboy.log
		I am oldboy teacher!
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		//	过滤以m结尾的内容:
		[root@localhost ~]# grep "m$" oldboy.log
		my blog is http://oldboy.51cto.com
		//	过滤空行
		[root@localhost ~]# grep "^$" oldboy.log

		[root@localhost ~]#
		//	利用排除空行来解决问题
		[root@localhost ~]# grep -v "^$" oldboy.log
		I am oldboy teacher!
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org
		my qq num is 49000488.
		not 4900000448.
		my god,i am not oldbey,but OLDBOY!
		```

	4. \. 代表且只能代表任意一个字符.
	5. \  代表转义字符,让有特殊身份意义的字符,脱掉马甲,还原圆形.
	6. \*  代表重复0个或任意多个前面的一个字符.
	7. \.*  代表匹配所有字符(^.*代表任意多个字符开头)

		```
		[root@localhost ~]# grep "." oldboy.log
		I am oldboy teacher!
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org
		my qq num is 49000488.
		not 4900000448.
		my god,i am not oldbey,but OLDBOY!

		[root@localhost ~]# grep "oldb.y" oldboy.log
		I am oldboy teacher!
		my blog is http://oldboy.51cto.com
		my god,i am not oldbey,but OLDBOY!

		[root@localhost ~]# grep "\." oldboy.log 	//之过滤"."
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# grep "\.$" oldboy.log 	//把以"."结尾的行过滤出来
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# grep "0*" oldboy.log 	//0*代表一个0,多个0,没有0
		I am oldboy teacher!
		I teach linux.

		I like badminton ball. billard ball and Chinese chess.

		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org

		my qq num is 49000488.

		not 4900000448.
		my god,i am not oldbey,but OLDBOY!

		[root@localhost ~]# grep -o "0*" oldboy.log 	//只输出匹配0*的内容(不显示行了)
		000
		00000
		```

	8. [abc]  代表匹配字符集合内任意一个字符
	   [a-z]  代表匹配a-z内的任意一个字母
	9. [^a-z]  不包含a或b活c; ^在中括号中表示"非"

		```
		[root@localhost ~]# grep "oldb[oe]y" oldboy.log
		I am oldboy teacher!
		my blog is http://oldboy.51cto.com
		my god,i am not oldbey,but OLDBOY!

		[root@localhost ~]# grep -o "oldb[oe]y" oldboy.log 	//-o 表示只匹配符合条件的字段;而非整行.
		oldboy
		oldboy
		oldbey

		[root@localhost ~]# grep "[0123456789]" oldboy.log
		my blog is http://oldboy.51cto.com
		my qq num is 49000488.
		not 4900000448

		[root@localhost ~]# grep "[0-9]" oldboy.log
		my blog is http://oldboy.51cto.com
		my qq num is 49000488.
		not 4900000448

		[root@localhost ~]# grep "[^0-9]" oldboy.log
		I am oldboy teacher!
		I teach linux.
		I like badminton ball. billard ball and Chinese chess.
		my blog is http://oldboy.51cto.com
		our site is http://www.etiantian.org
		my qq num is 49000488.
		not 4900000448.
		my god,i am not oldbey,but OLDBOY!
		```

	10. {n,m}  代表重复n到m次,前一个字符。
		{n,}   代表至少n次,多了不限。
		{n}	   代表n次。
		{，m}   代表至多m次,少了不限。
		_注意:grep要对{转义} \{\}, egrep 不需要转义.(egrep 相当于grep -E)_

		```
		//匹配包含0且重复出现3次的内容
		[root@localhost ~]# grep "0\{3\}" oldboy.log 	//匹配包含0且重复出现3次的内容
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# egrep "0{3}" oldboy.log 	//匹配包含0且重复出现3次的内容,不用转义
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# egrep --color=auto "0{3}" oldboy.log 	//匹配包含0且重复出现3次的内容,不用转义
		my qq num is 49000488.
		not 4900000448.

		//	匹配包含0且重复出现3-5次的内容
		[root@localhost ~]# grep "0\{3,5\}" oldboy.log
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# grep -E "0{3,5}" oldboy.log
		my qq num is 49000488.
		not 4900000448.

		[root@localhost ~]# grep "0\{3,\}" oldboy.log
		my qq num is 49000488.
		not 4900000448.
		```

###### grep命令的选项:
- \-v 排除匹配的内容
- \-E 支持扩展的正则表达式
- \-i 忽略大小写
- \-o 只输出匹配的字段,而不是整行
- \--color=auto	匹配的内容显示颜色
- \-n 在杭寿显示行号

	```
	// 过滤oldboy字符串且不区分大小写:
	[root@localhost ~]# grep -i "oldboy" oldboy.log
	I am oldboy teacher!
	my blog is http://oldboy.51cto.com
	my god,i am not oldbey,but OLDBOY!

	// 显示oldboy.log 文件内容的行号:
	[root@localhost ~]# cat -n oldboy.log
     1  I am oldboy teacher!
     2  I teach linux.
     3
     4  I like badminton ball. billard ball and Chinese chess.
     5
     6  my blog is http://oldboy.51cto.com
     7  our site is http://www.etiantian.org
     8
     9  my qq num is 49000488.
    10
    11  not 4900000448.
    12  my god,i am not oldbey,but OLDBOY!

    [root@localhost ~]# nl oldboy.log //number line of a file
     1  I am oldboy teacher!
     2  I teach linux.

     3  I like badminton ball. billard ball and Chinese chess.

     4  my blog is http://oldboy.51cto.com
     5  our site is http://www.etiantian.org

     6  my qq num is 49000488.

     7  not 4900000448.
     8  my god,i am not oldbey,but OLDBOY!

	[root@localhost ~]# less -N oldboy.log
      1 I am oldboy teacher!
      2 I teach linux.
      3
      4 I like badminton ball. billard ball and Chinese chess.
      5
      6 my blog is http://oldboy.51cto.com
      7 our site is http://www.etiantian.org
      8
      9 my qq num is 49000488.
     10
     11 not 4900000448.
     12 my god,i am not oldbey,but OLDBOY!

	[root@localhost ~]# grep -n "." oldboy.log
	1:I am oldboy teacher!
	2:I teach linux.
	4:I like badminton ball. billard ball and Chinese chess.
	6:my blog is http://oldboy.51cto.com
	7:our site is http://www.etiantian.org
	9:my qq num is 49000488.
	11:not 4900000448.
	12:my god,i am not oldbey,but OLDBOY!
	```

*'.'在linux中的作用*

![point](http://kfdown.a.aliimg.com/kf/HTB1vRT.NpXXXXXVXpXXq6xXFXXXq/126425022/HTB1vRT.NpXXXXXVXpXXq6xXFXXXq.jpg)

##### sed命令实战

###### 子命令
- s	替换 substitute
- g 全局 global
- \-i 修改文件 \-\-in\-place edit files in place 在文件内修改
- \-n 取消默认输出;只打印匹配的那(些)行
- p 打印内容

	```
	//	查看网卡信息
	[root@localhost ~]# ifconfig eth0
	eth0      Link encap:Ethernet  HWaddr 00:0C:29:70:08:5A
          inet addr:192.168.1.124  Bcast:192.168.1.255  Mask:255.255.255.0
          inet6 addr: fe80::20c:29ff:fe70:85a/64 Scope:Link
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:73440 errors:0 dropped:0 overruns:0 frame:0
          TX packets:1001 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000
          RX bytes:4775422 (4.5 MiB)  TX bytes:209865 (204.9 KiB)
	//分两步取IP地址
	[root@localhost ~]# ifconfig eth0|grep "inet addr"	//提取IP所在行
          inet addr:192.168.1.124  Bcast:192.168.1.255  Mask:255.255.255.0
	[root@localhost ~]# ifconfig eth0|grep "inet addr"|sed 's@^.*addr:@@g'	//把前面的inet addr去掉
	192.168.1.124  Bcast:192.168.1.255  Mask:255.255.255.0
	[root@localhost ~]# ifconfig eth0|grep "inet addr"|sed 's@^.*addr:@@g'|sed 's#Bc.*$##g'	//去除Bc到结尾部分
	192.168.1.124

	//	一步到位,获取eth0的IP地址:
	[root@localhost ~]# ifconfig eth0|sed -n 's#^.*dr:\(.*\) Bc.*$#\1#gp'
	192.168.1.124
	//	上述操作详解 就是保留\(.*\) 括号里的内容;其实()的功能是分组,可以匹配目标里,\1;\2;\3表示的是取第几个括号里的内容

	// 只是扩展方法
	[root@localhost tmp]# ifconfig eth0|grep "inet addr:"
          inet addr:192.168.1.124  Bcast:192.168.1.255  Mask:255.255.255.0
	[root@localhost tmp]# ifconfig eth0|grep "inet addr:"|awk -F '[ :]+' '{print $4}'
	192.168.1.124
	//	上面选项-F '[ :]+'意思是指定 空格和:作为分隔符; +表示遇到持续的分隔符则只当做一个.因为这一行前面有多个空格,一个个数很难

	// NR==n 表示第n行;sed NR==2 等同与sed -n '2p';awk也可以 'NR==2' 来表示取第2行

	// awk 变量


	```
##### sed命令练习

* sed 过滤

```
[aphey@localhost ~]$ sed -n '/aphey/p' /etc/passwd	//在/etc/passwd中过滤出aphey,''可以不要
aphey:x:500:500::/home/aphey:/bin/bash
```
```
//	sed 知识点和小技巧
替换的方法
# sed "s#old#new#g"	//表示把old替换为new,#可以用任意别的符号如@,#,= 等,s: substitute, g:global全局;不用g的话默认替换第一个替换词.
```
```
sed 打印:
[root@localhost ~]# seq 10 > a.txt
[root@localhost ~]# cat a.txt
1
2
3
4
5
6
7
8
9
10
[root@localhost ~]# sed -n '2,5p' a.txt	//	'2,5'表示2到5行
2
3
4
5
[root@localhost ~]# sed -n '1~2p' a.txt	//	~2 表示步长,也就是增幅.
1
3
5
7
9
[root@localhost ~]# seq 1 3 10	// 中间的3表示步长;由上面的例子引申出来.
1
4
7
10
```
```
描述linux系统从开机到登陆界面的启动过程
	1. 开机BIOS自检,加载硬盘
	2. MBR 引导
	3. grub引导菜单
	4. 加载内核kernel
	5. 启动init进程
	6. 读取inittab文件,执行rc.sysinit,rc(/etc/rc3.d/*)等脚本
	7. 启动minggetty,进入系统登陆界面
简易图在下方
```
![](http://kfdown.a.aliimg.com/kf/HTB1MovZNpXXXXceaXXXq6xXFXXXZ/126425022/HTB1MovZNpXXXXceaXXXq6xXFXXXZ.jpg)

```
题目: 查看一个目录的权限,并用数字展示出来
//	awk 多分隔符功能,下面的例子中:-F [(/] 就是两者之一,遇到一个算一个都是分隔符
[root@localhost tmp]# stat /etc|sed -n 4p
Access: (0755/drwxr-xr-x)  Uid: (    0/    root)   Gid: (    0/    root)
[root@localhost tmp]# stat /etc|sed -n 4p|awk -F '[(/]' '{print $2}'
0755

关键点:
1. 当命令结果包含想要的内容的时候,要想到查看命令的帮助是否可以直接过滤出来
2. 取行sed,head配合tail,拓展:awk;grep都可以取行
```

```
题目及答案
1. 请给出默认情况eth0网卡配置文件的路径寄客户端DNS的路径.

	解答
	/etc/sysconfig/network-scripts/ifcfg-eth0	//6.0以后可以在这里配置DNS
	/etc/resolv.conf

2. 请说出下面都是什么文件
	/var/log/message	//系统日志
	/var/log/secure		//系统安全日志
	/var/spool/clientqueue	//邮件临时目录
	/proc/interrupts	//查看中断文件
	/etc/fstrab		//磁盘文件系统开机自动挂载文件
	/etc/profile	//系统全局环境变量配置文件
```

### ip地址分类

- A类
- B类
- C类:一般局域网上网用的都是C类192.168.x.x;10.0.x.x;172.16.x.x
- D类
- E类

	```
	[root@localhost ~]# vi /etc/sysconfig/network-scripts/ifcfg-eth0
	DEVICE=eth0		//设备名
	TYPE=Ethernet	//类型:以太网
	UUID=a503acd3-a79e-4861-ad73-6ce087428d8b	//唯一识别ID
	ONBOOT=yes		//开机启动
	NM_CONTROLLED=yes	//network manager管理
	BOOTPROTO=dhcp		//要不要dhcp
	HWADDR=00:0C:29:70:08:5A	//物理地址,MAC地址
	DEFROUTE=yes
	PEERDNS=yes
	PEERROUTES=yes
	IPV4_FAILURE_FATAL=yes
	IPV6INIT=no
	NAME="System eth0"


	修改好网络配置文件后要重启网络服务 ifup eth0;或则 service network restart
	```

	```
	[root@localhost ~]# route -n	//查看linux路由
	Kernel IP routing table
	Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
	192.168.1.0     0.0.0.0         255.255.255.0   U     0      0        0 eth0
	169.254.0.0     0.0.0.0         255.255.0.0     U     1002   0        0 eth0
	0.0.0.0         192.168.1.1     0.0.0.0         UG    0      0        0 eth0

	[root@localhost ~]# route del default gw 192.168.1.1	//删除默认网关路由
	[root@localhost ~]# route -n	//查看路由
	Kernel IP routing table
	Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
	192.168.1.0     0.0.0.0         255.255.255.0   U     0      0        0 eth0
	169.254.0.0     0.0.0.0         255.255.0.0     U     1002   0        0 eth0
	[root@localhost ~]# ping www.baidu.com -c 4	//查看网络,已经不能上网
	connect: Network is unreachable
	[root@localhost ~]# route add default gw 192.168.1.1 	//添加默认网关
	[root@localhost ~]# route -n 		//查看默认网关路由
	Kernel IP routing table
	Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
	192.168.1.0     0.0.0.0         255.255.255.0   U     0      0        0 eth0
	169.254.0.0     0.0.0.0         255.255.0.0     U     1002   0        0 eth0
	0.0.0.0         192.168.1.1     0.0.0.0         UG    0      0        0 eth0
	[root@localhost ~]# ping www.baidu.com -c 4      //可以上网了
	PING www.a.shifen.com (180.97.33.107) 56(84) bytes of data.
	64 bytes from 180.97.33.107: icmp_seq=1 ttl=55 time=10.6 ms
	64 bytes from 180.97.33.107: icmp_seq=2 ttl=55 time=9.59 ms
	64 bytes from 180.97.33.107: icmp_seq=3 ttl=55 time=11.0 ms
	64 bytes from 180.97.33.107: icmp_seq=4 ttl=55 time=11.9 ms

	--- www.a.shifen.com ping statistics ---
	4 packets transmitted, 4 received, 0% packet loss, time 3018ms
	rtt min/avg/max/mdev = 9.590/10.797/11.913/0.838 ms

	网关一般也是放在 /etc/sysconfig/network 或者/etc/sysconfig/network-scripts/ifcfg-eth0里
	GATEWAY=192.168.1.1
	```

#### 电脑上不了网,排错思路

1. 物理连接是否通常
2. 本机IP,路由,DNS的设置情况是否达标
3. 测试到网关或路由器是否通畅.
4. 测试ping公网ip是否通畅
5. 测试DNS是否通畅,可以ping baidu.com来查看是否出对应IP

生产环境正式案例:
一个lamp服务器,沾点目录下的文件均被植入了
<script language=javascript src="asdadsaassadad/ad=93x28_ad"></script>
包括图片文件也被植入了,网站打开时后援会调用这个地址,造成的影响非常恶劣.

```
解决方案就是:
先备份数据.再进行操作
1. find, sed 把这段js代码替换为空
find / -type f -exec sed -i 's#<script language=javascript src="asdadsaassadad/ad=93x28_ad"></script>##g' {} \;
2. find sed 删除 正则
find / -type f -exec sed -i '/.*93x28_ad\d' {} \;
记得查看目录和文件的权限.
可以mkdir dir;touch file; 查看对应权限是否为755,644
```

lnmp
传照片: 站点目录下

大公司做法:
多台服务器:
页面服务器: 解析php,java
资源服务器: html解析:图片,附件;不装php程序.这样别人上传脚本 病毒,也没法 运行
告诉开发人员,严格审查上传入口

date 命令:显示系统时间
```
1. 用16-12-26的格式显示当前系统时间
	[root@Test ~]# date +%y-%m-%d	//%Y是2016完整年份,%F是完整格式
	16-11-04
2. 显示年月日,时分秒
	[root@Test ~]# date +%Y-%m-%d\ %H:%M:%S 	//等同于date +%F\ %T
	2016-11-04 17:25:18
3. 在备份文件名中显示备份时间,时间可以任意去组合
	[root@Test ~]# cp /etc/hosts /etc/hosts.aphey.$(date +%F)
	[root@Test ~]# ls /etc/hosts.aphey.$(date +%F)     	//$(date +%F) 等同于`date +%F`
	/etc/hosts.aphey.2016-11-04
4. 修改时间
	[root@Test ~]# date -s "Y-m-d H:M:S"	//先修改时间,-s : set
	[root@Test ~]# clock -w		//写入到BIOS中去.
5. 输入3天钱的时间
	[root@Test ~]# date +%F --date "-3day"	//同理,可以+/-其他因素,日月年,时分秒
	2016-11-01
	[root@Test ~]# date +%F --date "-3 day"
	2016-11-01
6. 把当前时间转换成时间戳
	[root@localhost ~]# date +%s
	1478594893
A.将日期转换为Unix时间戳
将当前时间以Unix时间戳表示：
   date +%s
输出如下：
	1361542433
转换指定日期为Unix时间戳：
	date -d '2013-2-22 22:14' +%s
输出如下：
	1361542440
B.将Unix时间戳转换为日期时间
不指定日期时间的格式：
	date -d @1361542596
输出如下：
Fri Feb 22 22:16:36 CST 2013
指定日期格式的转换：
	date -d @1361542596 +"%Y-%m-%d %H:%M:%S"
输出如下：
	2013-02-22 22:16:36
```

echo命令:(backslash escape 反斜线转义)
```
# echo -n 不换行输出

$echo -n "123"
$echo "456"

最终输出
123456

而不是
123
456

# echo -e 处理特殊字符

若字符串中出现以下字符，则特别加以处理，而不会将它当成一般文字输出：
\a 发出警告声；
\b 删除前一个字符；
\c 最后不加上换行符号；
\f 换行但光标仍旧停留在原来的位置；
\n 换行且光标移至行首；
\r 光标移至行首，但不换行；
\t 插入tab；
\v 与\f相同；
\\ 插入\字符；
\nnn 插入nnn（八进制）所代表的ASCII字符；

$echo -e "a\bdddd"
dddd

$echo -e "a\adddd" //输出同时会发出报警声音
adddd


$echo -e "a\ndddd" //自动换行
a
dddd
```
关机重启命令
```
关机:
shutdown -h now	-->立刻关机(生产常用)
shutdown -h +1 -->1分钟以后关机
init 0
halt
halt -p
poweroff --> 立即停止系统,并关闭电源
```

```
重启:
reboot -->(生产常用)
shutdown -r now -->(生产使用)
shutdown -r +1 --> 1分钟后重启
init 6
```

```
注销:
logout
exit -->生产常用
ctrl+d -->快捷键(生产常用)
```

setUID和setGID
setuid位是让普通用户可以以root(或其他)用户的角色运行只有root(或其他)账号才能运行的程序或命令,或程序命令对应本来没有权限操作的文件等.(注意和 su 及sudo的区别).
SBit是粘滞位

### 定时任务Crond
系统优化我们保留了4个服务:

- ssh
- network
- syslog
- sysstat
- crond

crond 服务(最小单位为分钟),如果设计到定时任务为秒级别的时候,我们一般写脚本守护程序执行
守护程序或守护进程
程序文件:是程序代码组成,但是没有在计算机内执行(当前没有执行).
进程:计算机中正在执行的程序.
守护进程:一直运行的程序.
window 定时任务: taskschd.msc

Linux系统下的定时任务软件很多,常用的有:
- at
	适用仅执行一次就结束的调度任务命令,例如,某天晚上需要处理一个任务,仅仅是这一天的晚上属于突发性的工作任务.要执行at命令,还要启动一个名为atd的服务才行,在老男孩的工作中从来不会有需求用这个.因此,我们就不需要深入研究这个了.

- crontab
	这个命令可以周期性的执行任务工作,例如,每5分钟做一次服务器时间同步.要执行crontab这个命令,也需要启动一个服务crond才行,这个crontab命令是老男孩老师在生产工作中最长用到的命令,务必要掌握

	[root@ZhumaTech ~]# chkconfig --list|grep crond
	crond           0:off   1:off   2:on    3:on    4:on    5:on    6:off

- anacron
	这个命令主要用于非7*24小时开机的服务器准备的,anacron并不能指定具体时间执行任务工作,而是以天为周期或者在系统每次开机后执行的任务工作,它会检测服务器停机期间应该执行,但是并没有进行的任务工作,并将该任务执行一遍

___提示:___
1. 我们所说的crond服务是运行的程序,而crontab命令是用户用来设置定时规则的命令

2. crond 服务是企业生产工作中常用的重要服务,at和anacron很少使用,可以忽略

### crontab命令
crontab: usage error: unrecognized option
usage:  crontab [-u user] file	//可以为指定的用户创建定时任务
        crontab [-u user] [ -e | -l | -r ]
                (default operation is replace, per 1003.2)
        -e      (edit user's crontab)
        -l      (list user's crontab)
        -r      (delete user's crontab)
        -i      (prompt before deleting user's crontab)
        -s      (selinux context)
    	常用的是-e 和 -l

crontab 使用者权限和定时任务文件
文件|说明
---|---
/etc/cron.deny|该文件中所列用户不允许使用crontab命令
/etc/cron.allow|该文件中所列用户允许使用crontab命令,优先于/etc/crontab.deny
/var/spool/cron|所有用户crontab配置文件默认都存放在此目录,文件名以用户名命名.其实我们crontab -e修改的就是这个目录下的文件,文件名就是用户名.

##### 注意crontab 和passwd 一样被设置了suid,普通用户可以改定时任务,但是不能查看/var/spool/cron/user.
[root@ZhumaTech ~]# ls -l /usr/bin/crontab
-rwsr-xr-x. 1 root root 51784 Nov 23  2013 /usr/bin/crontab

#### 定时任务依赖的服务

查看crond是否自启动:(可以省略grep)
[root@ZhumaTech cron]# chkconfig --list crond
crond           0:off   1:off   2:on    3:on    4:on    5:on    6:o

echo 追加或者覆盖命令,用在 crontab定时任务的时候后面最好不要接 --->/dev/null 2>&1--- 容易出错;但是可以加2>&1

生产环境定时任务的专业写法要领:

1. 为定时任务规则加必要的注释
	写定时任务时规则时尽可能的加上注释(English Comments),这是良好的__习惯和规范__,这样其他人就能看到和快速理解任务的信息.

2. 执行shell脚本任务前加/bin/sh
	执行定时任务,如果是执行脚本,请尽量在脚本前带上/bin/sh 命令, 否则可能因为忘了赋予脚本 执行权限(+x),而误以为OK,导致脚本不能执行.

3. 在指定用户下指定相关定时任务
	需要root权限执行的任务可以登陆到root用户下然后设置,如果不需要root权限,可以登入到普通用户下设置(当然也可以用root 用户 crontab -u aphey -e的写法直接设置).这里需要特别注意,--不同用户的环境变量问题--,如果调用了系统环境变量/etc/profile(如生产环境中java程序的定时任务),最好在程序脚本中将用到的环境变量重新export下:

4. 平时工作中尽量多用crontab -e和crontab -l去编辑和查看定时任务,因为这两个命令会做语法检查. ~~~用vi /var/spool/cron/user 是不会有提示的~~~
	如果给1000台服务器同时添加系统时间同步就不可能一台台登陆修改.那么此时就会用分发工具或者批量运维脚本(脚本内容就是 echo "定时任务规则" >>/var/spool/cron/root)

5. 定时任务命令结尾加>/dev/null 2>&1
	定时任务(一般是脚本任务)规则的结尾最好加上--- >/dev/null 2>&1 ---等内容,如果需要打印日志,则可以追加到指定的日志文件里(此时不要聚合/dev/null同时存在),尽量不要留空.如果任务是命令的话,结尾使用">/dev/null 2>&1" 时要多测试几次. 其中,">" 表示重定向,/dev/null 为特殊的字符设备文件,表示黑洞设备或者空设备.2>&1 表示让标准错误和标准输出一样,本命令内容即把脚本的正常和错误输出都重定向到/dev/null,即不记录任何输出.
	清空一个文件的方法:
    ```
    	1. # > /var/aphey.txt
    	2. # cat /dev/null > /var/aphey.txt

    ```
  重定向:   这个功能在linux里可能经常用的,实际上就是你看到的下面的大于小于号一样的东西
	意思是将"数据传到其他地方".将某个命令执行后本应该出现在屏幕上的数据,传输到其他地方.执行命令时,这个命令可能会通过文件读取数据,经过处理之后,再将数据输出到屏幕.
	 - > 或 1> 输出重定向: 把前面输出东西输入到后边的文件中,会删除文件原有内容.
    ```
    [root@promote sh]# echo hello1 1>aphey

		[root@promote sh]# cat aphey
		hello1
    ```
	>> 或 1>> 追加重定向:把前面输出的东西追加到后面的文件中,不会删除原有的内容.
		[root@promote sh]# echo hello2>> aphey
		[root@promote sh]# cat aphey
		hello1
		hello2
		[root@promote sh]# echo hello3 1>>aphey
		[root@promote sh]# cat aphey
		hello1
		hello2
		hello3
	< 或 <0 输入重定向: 输入重定向用于改变命令的输入,指定输入内容,后跟文件
	<< 或 <<0 输入重定向: 后跟字符串,用来表示"输入结束",也可以用ctrl+d 来结束输入.
	2>	错误重定向:把错误信息输入到后边的文件中,会删除文件原有内容
	2>> 错误追加重定向:把错误信息追加到后边的文件中,不会删除文件原有内容

	- 标准输入(stdin): 代码为0 ,使用< 或<<.
	- 标准输出(stdout): 代码为1,使用> 或>>.
	- 标准错误输出(stderr): 代码为2,使用2> 或2>>.
	特殊: 2>&1 就是把标准错误重定向到标准输出(等价于 命令&>文件 或者 命令&>>文件)
	>/dev/null 2>&1 写法也可以写成 1>/dev/null 2>/dev/null. 例如,$JAVA -jar $RESIN_HOME/lib/resin.jar $ARGS stop 1>/dev/null 2>/dev/null,此写法来自resin服务于默认启动脚本.
```

   如果定时任务规则结尾不加>/dev/null 2>&1 等命令配置,就可能有大量输出信息,时间长了,可能由于系统未开启邮件服务而导致邮件临时目录/var/spool/clientqueue文件数猛增的隐患发生,大量文件会占用大量磁盘inode节点(每个文件占一个inode),以致磁盘inode满而无法写入正常数据.

6. 生产任务程序不要随意打印输出信息
	在开发定时任务程序或脚本时,在调试好脚本程序后,应尽量把DEBUG及命令输出的内容信息屏蔽掉,如果确实需要输出日志,可定向到指定日志文件里,避免产生系统垃圾.

7. 定时任务命令或程序最好写到脚本里执行
	这么操作最主要的是为了规避错误
	Linux 日志查看

	1. $ dmesg

	2. $ cat /var/log/messages

	定时任务的日志是/var/log/cron
	技巧:
	- 命令程序要用绝对路径
	- 脚本中用到系统的环境变量要重新定义

8. 定时任务执行的脚本要规范路径
   最好把执行脚本放在同一个目录下面.

9. 配置定时任务规范操作过程

	1. 首先要在命令行操作你成功,然后复制成功的命令到脚本里,在各个细小环节减少出错的机会.

	2. 然后测试脚本,测试成功后,复制脚本的规范路径到定时任务配置里,不要再用手敲

	3. 现在测试环境下测试,然后征税环境规范部署.

---注意当定时任务(比如每两小时执行一次的时候),务必在分钟位上给个数字比如00,如果写"*"会变成每分钟也执行定时任务;定时任务里的特殊符号必须要转义!!!---

改变一个目录的所有者和所属组的方法:
冒号(:)可以换成点号(.): \# chown -R oldboy__:__root /server/html	//所有者变成oldboy,所属组变成root组

只改变所属组的方法:
冒号(:)可以换成点号(.): \# chown -R __:__oldboy /server/html	//所有者保持不变,所属组变成oldboy组

同样只改变所有者的方法:
所有者后面就不用加点(.)或者冒号(:)了: \# chown -R oldboy /server/html	//所有者变成oldboy,所属不变

### 服务器权限击中管理之sudo高级应用
#### 修改sudo的方法

1.  \# visudo (推荐:在编辑完保存的时候会检查语法)
2.	\# vi /etc/sudoers (不推荐:当多台) // 改完以后用visudo -c 检查语法.

___在CentOS5.x中,/etc/sudoers文件的权限是440,如果改了读写权限以后sudo命令就不能用了___
___在CentOS6.x中,/etc/sudoers文件的权限是440,如果改了读写权限以后sudo也可以正常使用___

在修改sudoers配置文件方法有以下需要注意的地方:

1. echo命令是追加">>",不是重定向">",出了echo外,还可以用cat,sed等命令实现类似的功能.
2. 修改完成后一定要用visudo -c进行语法检查,这弥补了直接修改没有语法检查的不足
3. 确保/etc/sudoers权限是正确的(440),权限不对会导致sudo功能异常(只针对CentOS5.X)
4. 及时对授权的操作进行测试,验证是否正确(最好不要退出当前授权窗口,以便发现问题及时恢复)
5. 确保知道正确root用户密码,以便出现问题时可以通过普通用户等执行su -命令切换到root进行恢复.

可以对用户组进行授权,用户组授权和普通用户的区别,开头为"%"

#### 定义别名的实践例子
##### 实例1:定义用户别名(这些用户必须在系统中必须是存在的)

```
User_Alias ADMINS = aphey, %sa
// 定义用户别名为ADMINS,包含成员 aphey 和 sa组的成员;ADMINS大写是为了规范
User_Alias NETADMINS = leo, maya
// 定义用户别名为NETADMINS来管理网络,包含成员 leo 和 maya
User_Alias USERADMINS = zuma
// 定义用户别名为USERADMINS来管理用户,包含成员 zuma
// 特别说明:为了方便管理,所有的别名都要尽可能使用有意义名称作为别名.另外,所有包含成员都必须是系统中存在的用户或者组.
```

检查并创建上述用户及用户组
```
[root@Test ~]# grep sa /etc/group
vcsa:x:69:
saslauth:x:76:
sa:x:801:		//组sa 存在
[root@Test ~]# id aphey
uid=501(aphey) gid=501(aphey) groups=501(aphey)		//用户aphey存在
[root@Test ~]# useradd leo	//添加用户 leo
[root@Test ~]# useradd maya	//添加用户 maya
[root@Test ~]# useradd zuma	//添加用户 zuma
```
##### 实例2:定义命令别名

```
Cmnd_Alias USERCMD = /usr/sbin/useradd, /user/sbin/userdel, /usr/bin/passwd [A-Za-z]*, /bin/chown, /binchmod
Cmnd_Alias DISKCMD = /sbin/fdisk, /bin/parted ( parted用来管理大于2T的硬盘)
Cmnd_Alias NETMAG = /sbin/ifconfig, /etc/init.d/network
Cmnd_Alias CTRLCMD = /usr/sbin/reboot, /usr/sbin/halt
/* 特别说明:
	1) 所有的命令别名下的成员必须是文件或目录的绝对路径
	2) 命令超过一行时,可以通过"\"来换行
	3) 在定义时,可以使用正则表达式,如/usr/bin/passwd [A-Za-z]*
*/
```

##### 实例3:定义runas别名
```
Runas_Alias OP= root, aphey
// runas别名的定义不多见,不常用,了解即可
```

#### /etc/sudoers配置文件中的授权分配
/etc/sudoers的授权规则就是分配权限的执行规则,前面我们降到的定义别名主要是为了更方便授权引用别名.如果系统中的普通用户不多,在授权时可以不用定义别名,耳屎针对系统用户直接授权,所以在授权规则中别名并不是必须的.
关于授权规则,通常我们可以man sudoers 来查看/etc/sudoers文件的配置信息,配置文件中的例子其实已经演示的很清楚了.
aphey	ALL=(ALL)	ALL
释义: aphey用户可以在所有的主机上,切换到所有的用户,执行所有的命令.如果想要aphey这个用户切换到oldboy用户下执行命令,可以写成:
aphey	ALL=(oldboy)	ALL
如果忽略上面括号中的oldboy,如写成:
aphey ALL=	ALL
那么实际情况就是,仅能进行root用户的切换操作.

首先我们把不同的用户名和相关的命令别名根据需要做成如下表格:

用户别名|切换的角色|命令
---|---|---
ADMINS|OP|USERCMD,DISKCMD,NETMAGCMD,CTRLCMD
NETADMINS|OP|NETMAGCMD
USERADMINS|OP|USERCMD

接下来,配置/etc/sudoers配置文件

User_Alias ADMINS = aphey, %sa
User_Alias NETADMINS = leo, maya
User_Alias USERADMINS = zuma
Cmnd_Alias USERCMD = /usr/sbin/useradd, /user/sbin/userdel, /usr/bin/passwd [A-Za-z]*, /bin/chown, /binchmod
Cmnd_Alias DISKCMD = /sbin/fdisk, /bin/parted ( parted用来管理大于2T的硬盘)
Cmnd_Alias NETMAG = /sbin/ifconfig, /etc/init.d/network
Cmnd_Alias CTRLCMD = /usr/sbin/reboot, /usr/sbin/halt
Runas_Alias OP= root, aphey
ADMINS    	 ALL=(OP)    USERCMD,DISKCMD,NETMAGCMD,CTRLCMD
NETADMINS    ALL=(OP)    NOPASSWD:NETMAGCMD
USERADMINS   ALL=(OP)    NOPASSWD:USERCMD
上面就是对应的最终的sudoers的配置.
授权用户可以通过sudo -l查看拥有的sudo权限.

##### 禁止某个命令的执行：

aphey	ALL=/usr/sbin/\*, /sbin/\*, ___!/sbin/fdisk___

// ALL=/usr/sbin/\*, /sbin/\*, !/sbin/fdisk 这种省略Runas_Alias的格式也是正确的

// !/sbin/fdisk		正则表达式,表示除了这个以外

// 按道理,/sbin/\* 和 !/sbin/fdisk  是冲突的,这里就涉及到一个优先级,排在后面的优先级比前面的高

___最好的做法是:不要轻易地给人全部权限,他需要啥就给他啥___

##### 远程执行sudo命令

在默认情况下,我们是无法通过ssh远程执行sudo命令的,可是在实际生产场景中，我们经常有这样的需求，那么怎么解决呢？

方法1) 在/etc/sudoers中有这样的配置： ssh ___\-t___ hostname sudo <cmd>

  ```
     Defaults specification

    #
    # Disable "ssh hostname sudo <cmd>", because it will show the password in clear.
    #         You have to run "ssh -t hostname sudo <cmd>".
  ```

方法2) 远程sudo的命令如下
\# ssh 192.168.1.77 sudo ifconfig
默认情况下会提示: `sudo: sorry, you must have a tty to run sudo`

这就需要我们注释或者删除掉配置文件里的第56行左右的,就可以使用远程sudo了;CentOS5.8可以,CentOS6.x不行,6.x推荐使用方法1.
`56 Defaults    requiretty`

有人说,我普通用户本身就拥有 cat,ls等命令的执行权限,为什么还要在visudo里给普通用户 ls和cat权限呢?
答案就是,我们可以赋予的是root的cat 和ls权限,当普通用户使用 sudo ls的时候是可以查看/root目录下文件的权限的;sudo cat也就有往文件理追加内容的权限了

配置visudo的时候要注意以下几点:

1. 别名要全部用大写字母、数字、下划线，且必须全部是大写字母。
2. 命令的路径必须为文件或目录的绝对路径
3. 一个别名下有多个成员，成员与成员之间，通过半角,号分隔;成员必须是有效并事实存在的.用户名当然是在系统中存在的,在/etc/passwd中必须存在;对于定义命令别名,成员也必须是在系统中事实存在的文件名(需要绝对路径).
4. 别名成员受类型Host\_Alias、User\_Alias、Runas\_Alias、Cmnd\_Alias 制约,定义什么类型的别名,就要有什么类型的成员相配.
5. 别名规则是每行算一个规则,如果一个别名规则一行容不下时,可以通过"\"来续行
6. 指定切换的用户要用()括起来.如果省略括号,则默认为root用户;如果括号里是ALL,则代表能切换到所有用户;注意要切换到的目的用户必须用()括起来.
7. 如果不需要密码直接运行命令的,应该加NOPASSWD参数.
8. 取消某类程序的执行,要在命令前加!号,并且放在允许执行命令的后面.
9. 用户组前面必须加%号.

#### 配置sudo命令的日志审计
日志审计的说明: 不记录普通用户的的普通操。而是记录那些执行sudo命令的用户的操作。

项目实战： 服务器日志审计项目提出与实施
1. 权限方案实施后，权限得到了细化控制，接下来进一步实施对所有用户日志记录方案
2. 通过sudo 和 syslog(rsyslog)配合实现对所有用户尽兴日志审计并将记录集中管理（发送到中心日志服务器）
3. 实施后让所有韵味和开发的所有执行的sudo管理命令都有记录可查，杜绝了内部人员的操作安全隐患。

日志审计：
就是记录所有系统及相关用户行为的信息，并且可以自动分析、处理、展示（包括文本或者录像）
- 方法1: 通过环境变量命令及syslog全部日志审计(缺点是信息量太大,不推荐)
- 方法2: sudo配合syslog服务,日志审计(信息少,效果好)
- 方法3: 在bash解释器程序里嵌套一个监视器,让所有被审计的用户使用修改过的bash
- 方法4: 齐治的堡垒机:商业产品(也叫跳板机)

sudo日志审计:专门对使用sudo命令的用户记录其执行的命令相关信息

方法:

1. 安装sudo命令,syslog(rsyslog)服务
   默认情况下,系统中已经安装了sudo和rsyslog,如果系统中没有,则用yum安装一下.

2. 配置系统日志/etc/syslog.conf (经过测试,这一步可不需要,测试中停了rsyslog服务也仅靠下面第三步的配置方法,也能正常生成sudo.log,并记录sudo操作)
   增加配置local2.debug 到/etc/rsyslog.conf中
   [root@Test ~]# echo "local2.debug    /var/log/sudo.log" >>/etc/rsyslog.conf

3. 配置/etc/sudoers (CentOS6.X)
   增加配置"___Defaults	logfile=/var/log/sudo.log___" 到/etc/sudoers中,注意:不包括引号

    ```
    [root@Test ~]# echo "Defaults logfile=/var/log/sudo.log">>/etc/sudoers
    [root@Test ~]# tail -1 /etc/sudoers
    Defaults logfile=/var/log/sudo.log
    [root@Test ~]# visudo -c	//检查sudoers文件语法
    /etc/sudoers: parsed OK
    ```


4. 重启syslog内核日志记录器

    ```
    [root@Test ~]# /etc/init.d/rsyslog restart
    Shutting down system logger:                               [  OK  ]
    Starting system logger:                                    [  OK  ]
    ```

5. 日志集中管理
  1. rsync + inotify或定时任务, 将日志推到日志管理服务器上.
  2. 用syslog服务来处理.

   [root@Test ~]# echo "10.0.2.164 logserver">> /etc/hosts	//将日志服务器解析写道/etc/hosts里
   [root@Test ~]# echo "*.info @logserver">> /etc/syslog.conf	//适合所有日志推走.

### L15 磁盘管理基础
#### 磁盘知识的体系结构
##### RAID介绍
RAID的功能是提升性能,企业里面一般用硬件RAID;RAID可以把多块盘变成一块盘用,同时让多块盘的性能更高(比如一个目录需要3T);另外RAID还可以做备份功能,比如3快盘,其中一块盘坏了,我们可以保证数据不丢,业务也不会有影响.

### L17 Linux下磁盘只是及读写工作原理
#### 磁盘相关名词翻译

英文|汉语|释义
---|---|---
Disk|磁盘|
Head|磁头|　
Track|磁道|每个盘片都有两个面,都可以记录信息,盘片表面以盘片中心为圆心,用于记录数据的不同半径的同心圆磁化轨迹就成为磁道.
Sector|扇区|盘面有圆心向四周画直线不同磁道被直线分成许多扇形(弧形)的区域,每个弧形区域叫作__扇区__,每个扇区大小一般为521字节.
Cylinder|柱面|磁盘中,不同的盘片(或盘面)相同半径的磁道从上倒下所组成的圆柱形区域称为柱面.
Units|单元块|　
Block|数据块|　
Inodes|索引节点|　


磁盘的最外圈是0磁道,向主轴的方向依次为1磁道,2磁道...,不同盘片的同一磁道构成一圆柱面称为柱面,柱面由外往里依次为0柱面,1柱面...; 0磁道非常重要.我们知道系统的引导程序就在0柱面0磁道1扇区的前446Bytes.信息记录可表示为:某磁头,某磁道(柱面),某扇区.

#####磁盘容量的计算方法:
######计算方法1:
存储容量=磁头数×磁道数×(或者柱面数)×每扇区的字节数
######计算方法2:



__举个生产环境MYSQL数据库磁盘大小的计算例子:__

```
[root@ZhumaTech ~]# fdisk -l

Disk /dev/sda: 1000.2 GB, 1000204886016 bytes
255 heads, 63 sectors/track, 121601 cylinders
Units = cylinders of 16065 * 512 = 8225280 bytes
Sector size (logical/physical): 512 bytes / 512 bytes
I/O size (minimum/optimal): 512 bytes / 512 bytes

// 单元Units(柱面单位) = 255 heads * 63 sectors/track=16
```

#### 磁盘的读写原理

1. 磁盘是按照柱面读写数据的,即先读取同一个盘面的磁道,然后不会切换磁道,而是切换磁头读取下一个盘面的相同半径的磁道直到所有盘面的相同半径的磁道读取完成之后,数据还没有读写完成,才会切换磁道.这个切换磁道的过程称为寻道.

2. 磁头的切换是电子切换;而磁道的切换需要磁头做径向运动,这个径向运动为步进电机调节,这个动作是机械切换,相对很慢.

#### 磁盘存储的逻辑见图

##### 在磁盘的0磁头0磁道1扇区中有如下内容:

- 主引导记录:MBR所在地 446Bytes
- 硬盘分区表:16bytes × 4 (64bytes)这也是为什么只能有4个主分区的原因
- 分区结束标识55AA (2bytes)

#####每个主分区也都有引导分区信息和数据两部分组成

#####扩展分区中的逻辑分区由下面几部分组成:

- 扩展的分区表
- 55AA
- 引导分区信息
- 数据

#####主引导分区(MBR)在整个硬盘里是唯一的,也就是一个硬盘只能有一个.

##### 磁盘分区表中每一个分区表项的结构,16字节的表项由低到高,如下表所示(了解即可):

字节数|说明
---|---
1 Bytes| State: 分区状态,0=未激活,0x80= 激活
1 Bytes| StartHead:分区起始磁头号
2 Bytes| StartSC:分区起始扇区和柱面号.低字节的低6位为扇区号,高2位为柱面号的第9,10位,高字节为柱面号的低8位.(了解即可)
1 Bytes| Type:分区类型,如0x0B=FAT32,0x83=linux等,00表示此项未用
1 Bytes| EndHead:分区结束磁头号.
1 Bytes| EndSC:分区结束扇区和柱面号,定义同前.
4 Bytes| Relative:线性寻址方式下分区相对扇区地址(对于基本分区即为绝对地址).
4 Bytes| Sectors:分区大小(总扇区数)

##### 查看0磁头0磁道1扇区内容(也就是分区表和主引导记录的内容)

  ```
  [root@localhost ~]# dd if=/dev/sda of=mbr.bin bs=512 count=1 //dd转换复制一个文件,if源文件,of输出文件,bs字节数,count数量
  1+0 records in
  1+0 records out
  512 bytes (512 B) copied, 0.000271606 s, 1.9 MB/s
  [root@localhost ~]# file mbr.bin //查看mbr.bin文件内容
  mbr.bin: x86 boot sector; GRand Unified Bootloader, stage1 version 0x3, boot drive 0x80, 1st sector stage2 0x8104, GRUB version 0.94; partition 1: ID=0x83, active, starthead 32, startsector 2048, 409600 sectors; partition 2: ID=0x82, starthead 159, startsector 411648, 4096000 sectors; partition 3: ID=0x83, starthead 149, startsector 4507648, 37435392 sectors, code offset 0x48
  ```

##### 对硬盘分区,实际上就是在修改硬盘的分区表,也就是说和分区上的数据没什么关系,因此,理论上,调整分区,不会删除分区数据

##### 为什么一个扇区只有512字节,为何不是1024字节呢?

答: 首先,一个扇区有多少字节是可以自己(硬盘生产厂家)定义的.是可以为1024字节的.所以说一个扇区是512字节并不是理论值,而是习惯值.也就是一个山区的大小为512字节对于硬盘的生产厂家来说都是习惯这样定义了,谁也不想更改这种习惯.

#### 文件系统类型

定义:文件系统是对一个存储设备上的数据和元数据进行组织的一种机制,是组织存储文件或数据的方法,目的是易于查询和存取数据.因此,如果磁盘上没有文件系统也就无法存储数据了,因此,在磁盘分区后能够使用之前必须建立对应的文件系统才行.

##### 文件系统类型简单介绍

_1) SAS/SATA硬盘文件系统_

   - reiserfs 大量小文件业务
   - XFS 数据库业务(淘宝的数据库就用的这个)
   - ext4 视频下载,流媒体,数据库,小文件业务也OK
   - ext2 cache业务(ext3是在ext2的基础上增加了日志功能,用于恢复)
   - 对于CentOS5.X系列,常规应用就选ext3文件系统即可.
   - 对于CentOS6.X系列,常规应用就选ext4文件系统即可.

_2) SSD文件系统选择_

   EXT4/Reiserfs可以作为SSD文件系统,但未对SSD做优化,不能充分发挥SSD性能,并影响SSD使用时间.

   Btrfs对SSD做了优化,mount通过参数启用.但Btrfs仍处于试验阶段,生产环境谨慎使用.

   JFFS2/Nilfs2/YAFFS是常用的flash file system,在嵌入式环境广泛使用,建议使用.性能目前还未评估.

_在Linux中制作文件系统_

   - 用类似如下命令在Linux中制作并优化reiserfs文件系统:
   	```
   	# /sbin/mkreiserfs /dev/sda2
   	```
   - 用类似如下命令在Linux中制作xfs文件系统:
   	```
   	# mkfs -t xfs -f /dev/sda2
   	```

___注意: ext3fs 其实简单的就是ext2fsz增加了日志功能.当创建该文件系统时,对mke2fs使用 -j 选项:___
   	```
   	# /sbin/mke2fs -j /dev/sda2
   	```

#### 网站分析基数指标

 - PV: Page View, 浏览量 页面的浏览次数,衡量网站用户访问网页数量,用户没打开一个页面就记录1次.多次打开同一页面则浏览量累计.

 - UV: Unique Visitor, 独立访客数 1天内访问某站点的人数(以cookie为依据);1天内同一访客多次访问只计为1个访客

 - VV: Visit View, 访客的访问次数 记录所有访客1天内访问了多少次网站;当访客完成浏览并关掉该网站的所有页面时,便完成了一次访问,同一访客1天内可能有多次访问行为.

 - IP: 独立IP数 指1天内使用不同IP地址的用户访问网站的数量;同一IP不管访问了几个页面,独立IP数均为1

### rsync同步工具
