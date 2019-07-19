##### locate
- locate查找非实时模糊匹配,根据全系统文件数据库进行的查找;一般情况每天晚上会自动将系统所有文件信息保存起来并收集到数据库里.
- 新的linux系统甚至都没有对应数据库,需要用`updatedb`手动生成数据库;生成的过程需要非常长的时间.
- locate的优势是查找起来速度非常快
- locate选项:
	- -b 只匹配路径中的基名
	- -c 统计有多少个符合条件的文件
##### find
- 特点
	- 实时查找
	- 精确
	- 通过遍历,指定目录中的所有文件查找,速度可能非常慢.
	- 支持众多查找标准
- 格式: find 查找路径 查找标准 查找到以后的处理运作
	- 查找路径:默认为当前目录
	- 查找标准:指定目录下的所有文件
	- 处理动作:默认为显示到屏幕上
- 查找标准:
	- -name 'FILENAME' : 对文件名做精确匹配
		- 用-name选项时还支持文件名通配
			- \*
			- ?
			- \[ \]
	- -iname 'FILENAME' : 不区分文件名的大小写
	- -regex PATTEN : 基于正则表达式进行查找
	- -user USERNAME : 根据文件袋额属主来查找
	- -group GRPNAME : 根据属组查找
	- -uid UID : 根据UID来查找;当某个用户被删除了,对应文件的属主就会变成其对应的UID
	- -gid GID : 根据GID查找
	- -nouser : 查找没有属主用户的文件,比如某个用户被删除了;我们应该把这些文件全部授权给管理员用户
	- -nogroup : 查找没有属组的文件,比如某个用户组被删除了;我们应该把这些文件全部授权给管理员用户
	- -type : 根据文件类型来查找
		- f:普通文件
		- d:目录
		- c:字符设备
		- b:块设备
		- l:链接文件
		- p:管道设备
		- s:套接字设备
	- -size : 根据文件大小;注意:
		- [+|-]\#k : [大于|小于]\#k;不带中括号内的±就表示大于(#-1),小于等于#k的文件;`-#k`表示`0-(#-1)k`;`+#k表示比#k大的文件`
		- [+|-]\#M : [大于|小于]\#M;不带中括号内的±就表示大于(#-1),小于等于#M的文件;`-#k`表示`0-(#-1)m`;`+#m表示比#m大的文件`
		- [+|-]\#G : [大于|小于]\#G;不带中括号内的±就表示大于(#-1),小于等于#G的文件;`-#k`表示`0-(#-1)g`;`+#k表示比#g大的文件`
	- 根据文件的时间戳来查找: [+|-]\#; 表示\#天以内,或至少\#天之外,__比如3表示`3-4`天,`-3`表示3天以内,`+3`表示≥4天之外.__
		- -mtime: 修改时间;单位是天
		- -ctime: 改变时间;单位是天
		- -atime: 访问时间;单位是天
		- -mmin : 修改时间,单位为分钟
		- -cmin : 改变时间,单位为分钟
		- -amin : 访问时间,单位为分钟
	- 根据文件的执行权限来查找:如果查询条件中写的是(003),则表示不去管u,g位权限 
		- -perm mode : 权限精确查找
		- -perm +mode: 任何一类(u,g,o)对象权限中只要能有中只要有一位和条件匹配即;
		- -perm -mode : __每一类对象必须同时拥有条件权限__文件的权限必须完全包含-mode中的权限才做匹配;比如文件权限是755;匹配条件为644;那么文件也能被匹配到.
		- -perm /mode : 权限位中有任何一位匹配,就进行匹配
		- -perm /mode : 权限位中有任何一位匹配,就进行匹配;等同于"+mode"
- 组合查找条件:
	- -a 与
	
	```
	[root@ZhumaTech ~]# find /tmp -user root -a -type d -ls
	28311553    4 drwxrwxrwt   5 root     root         4096 Mar 13 03:55 /tmp
	3014727    4 drwxr-xr-x   2 root     root         4096 Mar 13 10:32 /tmp/sh
	28311555    4 drwxrwxrwt   2 root     root         4096 Feb  4 13:13 /tmp/.ICE-unix
	28311556    4 drwxr-x---   2 root     root         4096 Feb 20 13:23 /tmp/hellodir
	```
	
	- -o 或
	- -not 非
	
	```
	// 列出/tmp目录下 文件属主既不是用户root也不是用户jerry的文件
	[root@ZhumaTech ~]# find /tmp -not -user root -a -not -user jerry -ls 
	28311565    0 srwxrwxrwx   1 postgres postgres        0 Mar 13 11:07 /tmp/.s.PGSQL.5432
	28311564    4 -rw-------   1 postgres postgres       52 Mar 13 11:07 /tmp/.s.PGS
	// 根据摩根定律,上面的命令等同于 find /tmp -not \( -user user1 -or -user user2\)
	[root@localhost tmp]# find /tmp -not \( -user root -o -user aphey \) -ls
     22721    4 drwx------   2 gdm      gdm          4096 8月 21 00:09 /tmp/orbit-gdm
     22785    0 srwxr-xr-x   1 gdm      gdm             0 8月 21 00:08 /tmp/orbit-gdm/linc-740-0-40b9a00020c27
     22777    0 srwxr-xr-x   1 gdm      gdm             0 8月 21 00:08 /tmp/orbit-gdm/linc-744-0-413b8287e504
     22753    0 srwxr-xr-x   1 gdm      gdm             0 8月 21 00:08 /tmp/orbit-gdm/linc-733-0-6ce3d82b9966d
    556204    0 -rw-rw-r--   1 bash     bash            0 8月 23 22:18 /tmp/bash
    556206    0 -rw-rw-r--   1 testbash testbash        0 8月 23 22:18 /tmp/testbash
     22725    4 drwx------   2 gdm      gdm          4096 8月 21 00:09 /tmp/pulse-Hy0tmaC31xIS
	```
	
- find运作:
	- -print: 默认是显示
	- -ls: 以类似 ls -l的形式显示文件的详细
	- -delete: 删除查找到的文件
	- -fls NEWFILE: 查找到的所有文件的长格式信息保存到NEWFILE中
	- -ok COMMAND {} \; : 对查找的文件做COMMAND操作,花括号表示占位符,代替前面的查找到的文件;每一个操作需要用户确认
	- -exec COMMAND {} \; : 对查找的文件做COMMAND操作,花括号表示占位符,代替前面的查找到的文件;不需要用户确认

	
	```
	[root@ZhumaTech test]# ll
	-rw-rw-rw-. 1 root root 0 Mar 13 11:58 a
	-rw-rw-r--. 1 root root 0 Mar 13 11:58 b
	-rw-r--r--. 1 root root 0 Mar 13 11:58 c
	-rw-r--r--. 1 root root 0 Mar 13 11:58 d
	[root@ZhumaTech test]# find -perm -020 -exec mv {} ./{}.new \;
	[root@ZhumaTech test]# ll
	-rw-rw-rw-. 1 root root 0 Mar 13 11:58 a.new
	-rw-rw-r--. 1 root root 0 Mar 13 11:58 b.new
	-rw-r--r--. 1 root root 0 Mar 13 11:58 c
	-rw-r--r--. 1 root root 0 Mar 13 11:58 d
	```
#### 练习
- 查找/var目录下属主为root,数组为mail的所有文件或目录
    ```
    [root@localhost tmp]# find /var -user root -group mail -ls
    132245    4 drwxrwxr-x   2 root     mail         4096 8月 21 22:54 /var/spool/mail
    ```
-  查找/usr目录下不属于root、bin或aphey的所有文件或目录 
    ```
    [root@localhost tmp]# find /usr -not \( -user root -o -user bin -o -user aphey \)
    /usr/libexec/abrt-action-install-debuginfo-to-abrt-cache
    ```
- 查找/etc目录下最近一周内其内容修改过，且属主不为root或aphey的所有文件；
    ```
    [root@localhost tmp]# find /etc -mtime -7 -a -not \( -user root -o -user aphey \)
    // 没有符合条件的文件
    或者:
    [root@localhost tmp]# find /etc -mtime -7 -a -not  -user root -a -not -user aphey \)
    ```
- 查找当前系统上没有属主或属组，且最近一周内曾被访问过的所有文件；
    ```
    find /  -nouser -a -nogroup -a -atime -7
    ```
- 查找/etc/目录所有用户都没有写权限的文件 
    ```
    # find /etc/ -not -perm +222
    // +222 可以简单理解为(u有w OR g有w OR o有w),摩根定律,取反就是u没有w 且 g没有w 且 o没有w
    ```
- 查找/etc/目录下至少有一类用户没有写权限
    ```
    find /etc/ -not -perm -222
    // -222 可以简单理解为(u有w 且 g且有w 且 o有w),摩根定律,取反就是u没有w 或者 g没有w 或者 o没有w;有一个符合条件就可以
    ```
- 查找/etc/init.d/目录下，所有用户都有执行权限且其它用户有写权限的文件
    ```
    [root@localhost tmp]# find /etc/init.d -perm -113 -ls
    393329    0 lrwxrwxrwx   1 root     root           11 8月 20 23:35 /etc/init.d -> rc.d/init.d
    ```
- 查找系统上的其他用户有执行权限,且文件类型是普通文件的:
    ```
    [root@localhost tmp]# find / -perm +001 -type f
    // 当权限匹配条件有0时, 查找时不会去管对应的权限位的.
    ```