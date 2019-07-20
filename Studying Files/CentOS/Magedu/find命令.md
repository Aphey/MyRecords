##### locate
- locate查找非实时模糊匹配,根据全系统文件数据库进行的查找;一般情况每天晚上会自动将系统所有文件信息保存起来并收集到数据库里.
- 新的linux系统甚至都没有对应数据库,需要用`updatedb`手动生成数据库;生成的过程需要非常长的时间.
- locate的优势是查找起来速度非常快
- locate选项:
	- -b 只匹配路径中的基名
	- -c 统计有多少个符合条件的文件
	- -r 基于基本正则表达式来编写模式
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
			- \[\]
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
	- 根据文件的时间戳来查找: [+|-]\#; 表示\#天以内,或至少\#天之外,__比如3表示`[3-4)`天,`-3`表示3天以内,`+3`表示≥4天之外.__
		- -mtime: 修改时间;单位是天
		- -ctime: 改变时间;单位是天
		- -atime: 访问时间;单位是天
		- -mmin : 修改时间,单位为分钟
		- -cmin : 改变时间,单位为分钟
		- -amin : 访问时间,单位为分钟
	- 根据文件的执行权限来查找: 如果查询条件中写的是(003),则表示不去管u,g位权限
		- -perm mode : 权限精确查找
		- ~~_perm +mode: 任何一类(u,g,o)对象权限(r,w,x)中只要有一位和条件匹配即可,也就是9个权限位中,有一位符合即可(CentOS7已经不赞成使用)_~~
		- -perm /mode : 任何一类(u,g,o)对象权限(r,w,x)中只要有一位和条件匹配即可,也就是9个权限位中,有一位符合即可.
			```bash
			# find ./ -perm /111 -ls //表示至少有一类用户有执行权限的文件
			# find ./ -perm +001 -ls //表示其他用户有执行权限的文件
			```
		- -perm -mode : __每一类用户(u,g,o)的权限中的每一位权限(r,w,x)必须同时符合条件权限__文件的权限必须完全包含`-mode`中的权限才做匹配;比如文件权限是755;匹配条件为644;那么文件也能被匹配到.
			```bash
			# find ./ -perm -222 -ls //表示每一类用户都有写权限
			# find ./ -not -perm -222 -ls //表示至少有一类用户都没有写权限
			```
- 组合查找条件:
	- -a 与
	```bash
	[root@ZhumaTech ~]# find /tmp -user root -a -type d -ls
	28311553    4 drwxrwxrwt   5 root     root         4096 Mar 13 03:55 /tmp
	3014727    4 drwxr-xr-x   2 root     root         4096 Mar 13 10:32 /tmp/sh
	28311555    4 drwxrwxrwt   2 root     root         4096 Feb  4 13:13 /tmp/.ICE-unix
	28311556    4 drwxr-x---   2 root     root         4096 Feb 20 13:23 /tmp/hellodir
	```

	- -o 或
	- -not

	```bash
	// 列出/tmp目录下 文件属主既不是用户root也不是用户jerry的文件
	[root@ZhumaTech ~]# find /tmp -not -user root -a -not -user jerry -ls
	28311565    0 srwxrwxrwx   1 postgres postgres        0 Mar 13 11:07 /tmp/.s.PGSQL.5432
	28311564    4 -rw-------   1 postgres postgres       52 Mar 13 11:07 /tmp/.s.PGS
	// 根据摩根定律,上面的命令等同于 find /tmp -not \(user user1 -o user user2\)
	```

- find动作:
	- -print: 默认是显示
	- -ls: 以类似 ls -l的形式显示文件的信息
	- -delete: 删除查找到的文件
	- -fls NEWFILE: 查找到的所有文件的长格式信息保存到NEWFILE中
	- -ok COMMAND {} \; : 对查找的文件做COMMAND操作,花括号表示占位符,代替前面的查找到的文件;每一个操作需要用户确认
	- -exec COMMAND {} \; : 对查找的文件做COMMAND操作,花括号表示占位符,代替前面的查找到的文件;不需要用户确认
	- __find 传递查找到的文件至后面指定的命令时, 查找到所有符合条件的文件一次性传递给后面的命令;有些命令不能接受果朵的参数,此时命令执行可能会失败,另一种方案可规避此问题: find | xargs COMMAND,本身不需要占位符,也不需要斜线分号结尾.__
	```bash
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
