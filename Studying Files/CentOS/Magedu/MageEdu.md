##MageEdu

### C1S1 & C1S2 基本概念

- POST: power on self testing 上电自检,开机自检这个过程就是把ROM里的指令映射到内存里.
- RAM: Radom Access Memory.
- ROM: Read only Memory.
- 外存设备包括光盘、硬盘、软盘、U盘.
- BIOS: Basic Input/Output System 基础设备.
- 计算机五大元件: 控制器、运算器、存储器、输入设备、输出设备.
- CPU核心: 寄存器、运算器、控制器.
- CPU会每一段时间就查看I/O设备是不是有什么事件,这个行为叫POLL(轮询).
- 当I/O设备有事件时,通知CPU,这个行为叫interrupt(中断).
- 北桥芯片: 连接CPU和内存等等,可以理解为高速总线控制器.
- 南桥芯片: 连接大部分I/O设备的,可以理解为低速总线控制器;南桥连接I/O设备后通过一根线连接到北桥,由北桥转给CPU.
- 前端总线（FSB）就是负责将CPU连接到内存的总线.
- CPU主频: 频率:单位时间内,某个事件发生的周期数.
- API: 应用程序接口（Application Program Interface）,在不同的CPU上使用汇编语言而写出来的具有相同功能的程序.其实就是小虚拟机 比如java
- 总线,是复用的(一根总线,三种功能):
	- 地址总线:内存寻址
	- 数据总线:传输数据
	- 控制总线:控制指令
- 硬件平台架构:
	- ARM 只生产知识产权,不生产设备,只设计芯片.
	- x86 Intel或者AMD的32位的平台,32位是指大马路并行32车道流量走的多
	- x64 真正的64位是AMD的,Intel的其实是模拟出来的(现在已经是真的64位了)
- OS 操作系统:
	- windows
	- Linux
	- Unix
		- HP-UX
		- Solaris(SUN)
		- AIX(IBM)
		- SCO UNIX
		- Unixware
- 32位CPU的总线宽度是32,能引用2的32次方个地址,也就是4G,所以32位系统只能识别4G内存.
- 多进程的运行原理
	- CPU: 分时段,比如给第一个程序运行5ms,给第二个程序也运行5ms...
	- 内存: 分段,比如给第一个程序分一段,给第二个程序分一段,但每个人的电脑内存大小是不定的,软件开发的时候就用虚拟地址空间,默认认为你有4G内存.实际程序占用的可能也就2M.
	- 所有程序不能直接和硬件打交道,程序需要向内核请求系统调用(system call),可以从硬盘取出数据

### C1S3 & C1S4 操作系统基础
- GUI: Graphic User Interface 图形用户界面
- CLI: Command Line Interface 命令行界面
- 内核kernel功能:
	- 进程管理
	- 内存管理
	- 提供文件系统
	- 提供网络功能
	- 提供硬件驱动
	- 提供安全机制
	- etc.
- ABI: Application Binary Interface(应用二进制接口,不同CPU支持的特性也可能不一样)
- 不同Linux软件管理系统
	- Debian: dpt
		- 网上技术员自发维护,入门比红帽难得多.
		- Ubuntu:基于Debian发行,界面很漂亮,适用于个人Desktop.
			- Mint:基于Ubuntu发行,比Ubuntu还漂亮.
	- Redhat: rpm(9.0是个人版,6.0是企业版)
		- CentOS: Community Enterprise OS(红帽社区版).
		- Federa:	Redhat 把个人版捐给了Federa.
		- Mandriva: 界面很漂亮,一般用于个人桌面.
	- SUSE: 德国的,被Novell收购;也分为SUSE和OpenSUSE(大家都懂的)
	- etc.
- Linux内核和发行版本
	- Linux内核版本: 0.1、1.0、2.0、2.2、2.4、2.6、3.0、3.7...
	- RHEL发行版本: 3.0、4.0、5.0、6.0、
- Linux基本原则
	- 由目的单一的小程序组成,组合小程序完成复杂任务.
	- 一切皆文件.
	- 尽量避免捕获用户接口(不跟用户交互).
	- 配置文件保存为纯文本格式.
- Linux图形界面GUI
	- 命令启动方法: # startx &
	- 图形界面的类型:
		- GNOME: C开发的
		- KDE: C++
		- XFce
- Linux命令界面CLI:
	- sh(默认shell)
	- bash
	- zsh
	- ksh
	- tcsh
- Linux切换用户命令:

	```
	su: switch user
	```
	
### Day 2操作系统及常用命令
#### 名词解释
- dll:dynamic link library(windows的动态链接库)
- so:(dso) dynamic shared object(linux 库文件)
- 当一个命令被执行的时候,命令会被提交给内核,内核回去找这个命令的魔数(magic number:比如shell脚本里的 #!/bin/bash)
- 路径:从指定起始点到目的地所经过的位置,层次化文件管理的机制.
- 当前目录(工作目录): working directory(current dierectory)
- pwd: print working directory 打印出当前工作目录
- FHS: Filesystem Hierarchy['haɪərɑːkɪ] Standard  文件系统层次标准
- 命令ls: list
	- 选项
		- -l:长格式
			- 第一项:文件类型:
				- -:普通文件(f)
				- d:目录文件
				- b:块设备文件(block)
				- c:字符设备文件(character)
				- l:链接文件或者软连接文件(symbolic link file)
				- p:命令管道(pipe)
				- s:套接字文件(socket)
				- 后九位:文件权限,每3位一组,每一组:rwx(读,写,执行)	
			- 第二项的数字:硬链接的次数
			- 第三项:所有者(owner)
			- 第四项:所属组(group)
			- 第五项:文件大小(size),默认单位为字节
			- 第六项:时间戳(timestamp),每个文件有三个时间戳: 最近访问 access,最近修改 modified 修改文件的内容,最近改变 change 属性数据,meta data 元数据,比如文件内容没变,改了文件名.
			- 第七项:文件名
		- -h:humanreadable :人类可读的,用来做单位转换.
		- -a:all	显示所有文件,隐藏文件以.开头
			- . 目录,表示当前目录
			- .. 目录,表示当前目录的上一级目录
		- -A	显示所有文件,但是不包括.和..
		- -d	显示目录自身属性.
		- -i	index node,简写inode,-i选项就是显示文件的索引节点号.
		- -r	reverse time逆序显示文件.
		- -R	recursive 递归显示,相当消耗资源
- 命令cd:change directory 切换目录
	- cd不加任何参数,则进入当前用户的家目录
	- cd ~ 可以进入家目录
	- 管理员可以通过cd ~用户名 可以进入对应用户的家目录
	- cd - 在当前目录和前一次所在目录之间来回切换 
- 命令类型:内置命令(shell内置)和外部命令(在文件系统的某一个路径下与命令名称相应的可执行文件,别名除外)
- 命令type:显示命令属于那种类型
- 环境变量:变量是命名的内存空间,往空间中放入数据的过程叫变量赋值. 
- 堆栈:堆heap 栈Stack,用来放不同类型的数据的,栈用来存放本地声明或者静态变量;而其他用来获取申请保存数据的空间叫堆.
- 命令 printenv 可以查看当前的环境变量
- linux中有成千上万个命令,当某个命令第一次执行的时候,系统是实时查找的,然后会放在缓存中,我们可以通过hash命令查看.
- 命令date:时间管理
	- Linux: rtc(real time clock) 硬件时间;linux有两个时间,一个是硬件时间(clock可以查看或者hwclock),和系统始终(软件模拟晶体震荡计时)
	- ntp net time protcol
- 获得命令帮助:
	- 内部命令:
		- help COMMAND 比如 help cd,这是最简洁的方式
		- COMMAND -h 这个不常用
	- 外部命令:
		- COMMAND --help 大多数命令都支持
	- 通用方法:命令手册:manual(/usr/share/doc)
		- man COMMAND 几乎所有命令都通用的
		- info COMMAND 同上,info会介绍命令的历史发展等等,在线手册
		- man是有章节的,常见有8个,man可以指定章节的,如果不指定,则按第一次出现的章节.whatis COMMAND可以查看命令所在的章节
			1. 用户命令,所有用户可以使用的命令(/bin,/usr/bin,/usr/local/bin)
			2. 系统调用
			3. 库用户调用(只有库文件才有)
			4. 特殊文件(设备文件)
			5. 文件格式(配置文件的语法)
			6. 游戏
			7. 杂项:miscellaneous [,mɪsə'leɪnɪəs]
			8. 管理命令(/sbin,/usr/sbin,/usr/local/sbin)
	- 命令选项中括号的意思
		- \[ \]表示可选
		- | 表示多选一或者多选
		- < > 表示必选	
		- ... 可以出现多次
		- { } 表示分组
	- man COMMAND中各段内容:
		- NAME:命令名称及功能简要说明
		- SYNOPSIS:用法说明,包括可用的选项
		- DESCRIPTION:命令功能的详尽说明,可能包括每一个选项的意义
		- OPTIONS:说明每一个选项的意义
		- FILES:此命令相关的配置文件
		- BUGS:bug报告
		- EXAMPLES:使用示例
		- SEE ALSO:另鉴
	- 翻屏:
		- 向后翻屏:SPACE
		- 向前翻屏:b
		- 向后翻一行:Enter
		- 向前翻一行:k
	- 查找:
		- /keyword: 自前向后
			- n:下一个
			- N:前一个
		- ?keyword:自后向前
			- n:下一个
			- N:前一个
	- q:退出手册
- 命令hwclock:显示硬件时间
	- -w:system time to hardware(system time is shown by date cmd)
	- -s:hardware time to system
	- -r:read the hardware time
- 命令cal:calendar	查看日历
- 命令printf:格式化并显示一个文件(可以用转义符,需要手动指定)
- 命令:file(查看文件内容类型)
	- ELF:Executable and Linkable Format，可执行连接格式
- 文件系统
	- rootfs:根文件系统
	- /boot:系统启动的相关文件,如内核,initrd(CentOS6为initramfs)和 vmlinuz-2.6.32-431.el6.x86_64,它们是系统启动时要用到的内核,以及Grub
	- /dev:device 设备文件
		- 块设备:随机设备,随机访问.无所谓顺序的访问读取的,比如硬盘.
		- 字符设备:线性设备,线性访问,有秩序的,按字符位单位,一个字符一个字符输入和读取的,苏表键盘和显示器都是线性的设备.
	- 当我们 ll /dev的时候我们会发现一些文件的名称显示很特别,表现为黑底黄字,他们也不显示文件的大小,而表现为逗号隔开的两个数字(主设备号major和次设备号Minior),只有元数据,作为文件的访问入口.
	- /etc 配置文件存放位置
	- /home:用户的家目录,默认为/home/USERNAME;root用户的家目录为/root,unix上的root是没有家目录的.
	- /lib:library 库文件及内核模块文件(/lib/modules);库文件分为两种
		- 静态库: linux上表现为.a,windows上为.la;静态库是直接链接到程序的地址空间中去,而且是作为程序的一部分而运行,所以静态库便于单个文件的管理
		- 动态库: windows为 dll,linux为so(shared object);任何程序和数据只有载入内存才能被使用,共享库的好处就在于第一个程序启动以后,如果用到某个共享库,它会把这个共享库载入到内存使用,当启动第二个程序,也要用到这个共享库,那么第二个程序就不需要再载入这个共享库了.
	- /media 和 /mnt 挂载点目录;media通常用于挂载移动设备,比如光盘,U盘,而/mnt则是用来挂载额外的临时系统;其实挂载都没有严格规定.
	- /misc: 杂项,很少用
	- /opt: optional 可选目录,早期用于安装第三方软件.比如早期 oracle等等,现在约定俗成放在/usr/local下了
	- /proc:伪文件系统,这个目录其实是空的,系统启动就不是空的,这里显示的其实是内核的映射文件.非常重要的目录.
	- /sys:另外一个伪文件系统,一般跟硬件设备相关的属性映射文件,一般用于硬件管理.关机后也是空的.
	- /tmp:temporary,临时文件.一般而言,里面某个文件一个月内没有被访问过会被自动删除,这个目录所有人都能创建文件,但只能删除自己的文件.
	- /var:variable 可变化的文件,其中的/run子目录,每一个进程的进程号一般都储存在这个目录里.
	- /bin:binary 可执行文件,用户命令.
	- /sbin:管理命令
	- /usr:universal shared readonly, 只读文件(mag's understanding);也有人翻译成 unix system resource
		- /usr/bin
		- /usr/sbin
		- /usr/lib
		- /usr/local
			- /usr/local/bin
			- /usr/local/sbin
			- /usr/local/lib
- linux文件命名规则:
1. 长度不能超过255个字符
2. 不能使用/当文件名
3. 严格区分大小写	

- 文件管理
	- 目录管理
		- ls
		- cd
		- pwd
		- mkdir
			-p: parents 递归创建
			-v: verbose 详细信息
			- mkdir -pv /mnt/test/x/{m,y}:命令行展开(花括号展开),当遇到花括号的时候会自动把命令展开,这条命令就会在/mnt/test/x下创建m和y两个子目录.
			- mkdir -pv /mnt/test2/{a,d}_{b,c} 数学中(a+d)*(b+c)=ab+ac+db+dc,在这里也适用,所以这条命令会在/mnt/test2/下创建a_b,a_c,d_b,d_c这4个目录
		- tree 查看目录的树结构
		- rmdir 删除一个空目录
			- -p:删除___一脉单传___的空目录.
	- 文件创建和删除
		- touch	FILENAME 创建一个空文件;touch本身是为了改变一个文件的时间戳;无法修改改变的时间戳是因为时间戳本身也是文件的属性之一,只要时间戳有一个发生改变那么文件的改变(元数据)时间戳就得改变
			- a: access 只改变访问时间
			- m: modification 只改变修改时间
			- t: stamp 用指定的时间取代系统时间
			- c: no create 不创建文件
		- stat FILENAME 查看一个文件的状态,文件名,大小,时间戳等等
		- 创建文件也可以使用文件编辑器
			- ASCII:美国信息交换标准代码 American Standard Code for Information Interchange
			- nano ^:托字符,表示Ctrl;这个编辑器功能非常小
	- 删除文件:rm(remove);___当我们想使用一个命令自身的意思,而不是别名,可以用COMMAND来实现___
		- i:interactive 交互,在删除前提示
		- f: force 强制删除,不提示.
		- r:recursive 删除目录并递归删除该目录下的子目录或文件.
	- 复制和移动文件
		- cp:copy cp SRCfile DESTfile // 只能复制一个文件到一个文件,或者多个文件到一个目录.
			- -R(r)  递归复制,copy默认情况下只能复制文件,不能复制目录,有了这个选项才可以复制目录
			- -f:force 强制复制
			- -i:interactive 交互
			- -p:preserve [prɪ'zɜːv] 保存,保留权限,属主和时间戳
			- -d:如果源文件是链接文件,那么用了-d选项后目标文件就保留为链接属性,等同与-P
			- -L:dereference 如果源文件是链接文件,那么用了-L选项后目标文件就不在是连接文件
			- -a: 保留文件的所有属性,常用于备份;也叫归档复制.
		- mv:move 移动文件机制基本等同于cp,mv SRC DEST
			- -t target 用了-t选项,命令格式就变成了mv -t DEST SRC
		- install 复制文件并设置属性 install SRC DEST;install只能复制文件.
			- -d: 创建目录 install -d DIRECTORY 
			- -m:mode设置权限,默认情况下install复制的目标文件都具有执行权限.

### Day3 Linux文件管理和Bash相关知识
#### Linux文件管理类命令详解 
- 查看文本:
	- cat(concatenate [kən'kætɪneɪt] 连接并显示) 将命令操作对象一个一个完全显示出来,如果我们只输入cat然后回车,就变成cat读取标准输入并在标准输出显示出来,也就是我们输入什么它会再输出一次到显示器上,ctrl+c退出这个模式.在机器上当打开一个文件很大的时候翻页用shift+pageup来往上翻页.
		- -n:number 显示行号
		- -E:End 显示每行行尾号"$"
		- -v:显示非显示符
	- tac 与cat显示方法相反,cat的最后一行变成第一行
	- more (分屏查看文件),翻到尾部就会直接退出文件,默认支持向后翻.
		- 空格:下一页
		- 回车:下一行
		- B:上一页(要没到尾页,到了尾页就自动退出文件了)
	- less (分屏查看文件),比more强大,man命令就是用的less的操作方法,按q才会退出文件.
		- 空格(pagedown):下一页
		- 回车:下一行
		- B(pageup):上一页
		- K:上一行
	- head (查看文件的前n行,默认10行)
		- -n:指定行数
	- tail (查看文件的后n行,默认10行)
		- -n:指定行数	
		- -f:follow,即时查看文件的更新的最后n行
- 文本处理:
	- cut:文本切段
		- 数据库:database
		- -d:delimiter [dɪ'lɪmɪtə] 分隔符,指定分隔符,默认是空格 #cut -d : -f1 /etc/passwd 
		- -f:指定要显示的字段,后面不用空格直接写数字
			- -f1,3 表示显示第一段和第三段
			- -f1-3 表示显示第一段到第三段
	- join:文本拼接,用的不多
- 文本排序:
	- sort:并不影响源文件,仅仅对输出显示的内容进行排序(默认按照ASCII码升序排列,从 高位往低位逐渐往下比,比如12306 在 1234的上边,并不是比数值的大小)
		- -n:numeric 数值排序,按照数值大小来排序
		- -r:reverse 逆序排列
		- -t:用来指定分隔符字段分隔符 如:sort -t: -k3 /etc/passwd,表示以冒号为分隔符,以第三个字段作为排序的参考值
		- -k: 用来指定第几字段, 如:sort -t : -k 3 -n /etc/passwd ,表示以冒号为分隔符,以第三个字段数值的大小作为排序的参考值
		- -u:unique 去重,重复的行数将只保留一行.
		- -f:fold lower case to upper case characters 忽略大小写
	- uniq:报告或略过重复行(linux里只有相邻且相同的行才叫重复行,两个条件缺一不可)
		- -c:count 在行前面标出每行出现的次数
		- -d:duplicate 只显示重复的行
		- -D:显示所有重复的行(比如1-3行都是123,那么用了-D选项就会显示出3行123)
- 文本统计:wc(word count)
	- wc 可以统计一个文件中有多少个行,多少单词,以及有多少个字节数(空白也是字符)
		- -l:lines 只显示行数
		- -w:words 只显示单词数
		- -c:bytes 只显示字节数
		- -m:characters 只显示字符数
		- -L:最长的一行包含了多少字符
- 字符处理命令
	- tr translate or delete characters.转换或删除字符 tr [option] set1
		- 示例: tr ab AB a和b都换成大写的
		- -d:delete 删除在字符集中出现的相对字符
- bash及其特性:
	- 程序只有一个,进程可以有多个,在没个进程看来,当前主机上只存在内核和当前进程;进程是程序的副本,进程也是程序的实例.
	- linux允许一个账号登陆多次,彼此之间互不相干.
	- 命令行编辑:
		- 光标跳转:
			- CTRL+A: 跳到命令行首
			- CTRL+E: 跳到命令行尾
			- CTRL+D: 删除光标后面的一个字符
			- CTRL+U: 删除光标前面的全部字符
			- CTRL+K: 删除光标后面的全部字符
			- CTRL+左右光标: 可以切换到前(后)一个单词
			- CTRL+L:清屏
	- 命令历史:
		- 上下光标可以查看历史命令
		- history命令可以查看历史命令
			- -c:清楚历史命令
			- -d 数字: 表示删除第该数字个历史命令
			- -d 500 10: 表示删除第499个后面的10个命令
			- -w:将历史命令保存到历史命令的文件中/root/.bash_history
			- $HISTSIZE: 表示默认的保存历史命令的条数,系统默认是1000
			- $HISTFILESIZE:定义了在 .bash_history 中保存命令的记录总数
		- 命令历史的使用技巧:
			- !n:执行历史命令中的第n条
			- !-n:执行历史命令中的倒数第n条
			- !!:执行上一条命令
			- !man:执行历史命令中以man开头的命令
			- !$:引用上一个命令最后一个参数,比如nano !$;此命令可以换成(按紧ESC键再按.)
	- 命令补全:
		- tab键,前提是PATH环境设置正常,这个操作是在环境变量的路径下搜索补全的.
	- 路径补全:
		- tab键:是在你已经输入的字母打头的路径下搜索
	- 命令别名:
		- alias CMDALIAS=COMMAND [options],等号后面有空格的话请把等号后面的全部内容用单引号引起来
		- alias 可以查看当前系统中定义的所有别名.有些别名只是定义了别名加选项,当我们要执行命令本身时,只要用COMMAND即可.
		- unalias CMDALIAS 取消别名
	- 命令替换:要把命令替换成命令的执行结果,把命令中某个子命令替换为其执行结果的过程
		- 例1:echo "the current directory is ___$(pwd)___"
		- 或者:echo "the current directory is ___\`pwd\`___ "
		- 例2: touch ./file-$(date +%F-%H-%M-%S)
	- bash支持的引号:
		- ``:命令替换;
		- "":弱引用,重要表现是可以实现变量替换;
		- '':强引用,不完成变量替换.
- 文件名通配:globbing
	- * 通配符;可以用于匹配任意长度的任意字符;
	- ?	 匹配任意单个字符;
	- [ ] 匹配指定范围内的任意单个字符;
	- [^ ] 匹配指定范围之外的任意单个字符;
	- 特殊用法:可以用 man 7 glob
		- [:space:]表示所有的空白字符(必须有中括号表示字符集合),那么如果我们需要用到空白字符的时候就相当于用了两层中括号\[\[:space:\]\]
		- [:punct:]表示所有的标点符号
		- [:lower:]表示所有的小写字母
		- [:upper:]大写字母
		- [:alpha:]大小写字母
		- [:digit:]数字
		- [:alnum:]数字和大小写字母,相当于[0-9a-zA-Z]
	- 例:	
	
		```
		[root@ZhumaTech test]# touch "a b"
		
		[root@ZhumaTech test]# ls [[:alpha:]]*[[:space:]]*[[:alpha:]]
		a b
		```
		
#### Linux用户及权限详解
- 进程也是属主和属组的
- 权限:r,w,x
	- 文件所对应的权限
		- r:可读,可以使用类似cat等命令查看文件内容;
		- w:可写,可以编辑或删除此文件;
		- x:可执行,executable,可以命令提示符下当作命令提交给内核运行;
	- 目录所对应的权限:
		- r:可以对此目录执行ls以列出内部的所有文件;
		- w:可以在次目录创建文件
		- x:可以使用cd切换进此目录,也可以使用ls -l查看内部文件的详细信息
- 用户和组
	- 用户:UID (对应数据库是 /etc/passwd)
	- 用户组:GID (/etc/group)
	- 用户影子口令 用户密码(/etc/shadow)
	- 组的影子口令 (/etc/gshadow)
	- 解析:名称解析,从数据库里找依据UID查找对应的用户名
- 用户类别:
	- 管理员: UID:0
	- 普通用户: UID: 1-65535
		- 系统用户,伪用户:(UID:1-499) 不能登陆系统.
		- 一般用户:(UID:500-60000) 可以登录系统
- 用户组分类法1:
	- 管理员组:
	- 系统组:
	- 一般组:
- 用户组分类法2:
	- 基本组:用户的默认组,即我们创建用户时为其指定的组.
	- 私有组:当我们创建用户时,没有为其指定所属的组,系统会自动为其创建一个与用户名同名的组.
	- 附加组,额外组,魔忍足以外的其他组.
- 安全上下文
	- 一个可执行的命令本身是一个文件,它有自己的权限,当一个用户来执行的时候,先判断权限;然后这个命令的参数也有权限,这个时候权限和这个命令的执行者也就是J用户进行对比.
	- /etc/shadow:加密其实是有规律可循,$1$八位$密码,1表示加密方法为MD5;中间八位位SALT,杂质,是干扰项;
	- 加密方法:(加密前叫明文,加密后叫密文)
		- 对称加密:加密和揭秘使用同一个密码
		- 公钥加密:每个密码都成对出现,一个公钥,一个私钥,一个加密,另一个就解密
			- 公钥加密长度比对称加密长的多;安全性也长的多,但是速度也慢的多;公钥一般用于做密钥交换.
		- 单向加密:也叫散列加密:能加密,不能解密,一般用来提取文件特征码(每个文件都有一个唯一的特征码,和人的指纹相似);所以单向加密也叫指纹加密.单项加密长用来做数据校验,看数据有没有没人动过手脚;单项加密有以下几个特性:
			1. 雪崩效应(蝴蝶效应):初始条件的微小改变,将会引起结果的巨大改变;
			2. 定长输出:不管数据做多少改变,单向密码的长度不会改变
		- MD5:Message Digest Version5,信息摘要,128位的定长输出
		- SHA1:Secure Hash Algorithm['ælgərɪð(ə)m](算法),160位定长输出
### Day4
#### 用户管理
- 添加用户 useradd(adduser其实是useradd的软链接) # useradd USERNAME
	- 在/etc/default/目录中有个useradd文件	,这个文件会在使用useradd命令时,自动启动一些选项
		
		```
		[root@ZhumaTech test]# cat /etc/default/useradd 
		\# useradd defaults file
		GROUP=100
		HOME=/home
		INACTIVE=-1
		EXPIRE=
		SHELL=/bin/bash
		SKEL=/etc/skel
		CREATE_MAIL_SPOOL=yes
		```
		
- 添加用户命令useradd [options] USERNAME 
	- -u 指定用户的UID,一定要是未使用过的UID,且要大于500
	- -g 指定用户的基本组组id(或者祖名),这个指定的组必须要事先存在的
	- -G 指定用户的额外组(附加组,可以有多个用逗号隔开),这些组,必须事先存在
	- -c "COMMENT" 用户的注释,如果注释信息中有空格,则把注释用双引号引起来
	- -d 指定用户的家目录,如果不指定,则在/home/下创建用户同名目录
	- -s 指定用户的shell,最好使用/etc/shells/中可用的安全shell;可以查看变量SHELL
	- -m -k 一般-k选项和-m是连用的,-m是强制为用户创建家目录,-k选项的意思是把/etc/skel里的文件复制到用户的家目录中;其实 就算我们不用-m -k,在创建用户时,系统也会把/etc/skel里的文件复制到用户家目录的.
	- -M 不给用户创建家目录,即时/etc/login.defs中默认设定创建家目录;这个文件是/etc/shadow的配置文件
	- -r 添加一个系统用户(1-499),该没有家目录
- 删除用户命令userdel [option] USERNAME
	- 我们用userdel USERNAME,不加选项时,用户的家目录是不会被删除的.
	- -r 删除用户的同时,删除用户家目录
	- -f 强制删除用户,用户的家目录,用户的邮件,用户组,就算这些文件或者目录正在被使用也会被强制删除.该选项非常危险
- 查看用户账号属性命令 id
	- -u 查看用户的uid
	- -g 查看用户的gid
	- -G 查看用户所在的的所有组的组id
	- -n 显示对应的组id或者uid对应的名字,比如 id -g -n root
- 检索用户信息的程序 finger USERNAME
- 修改用户账号属性信息 usermod
	- -u UID USERNAME 修改用户的UID
	- -g GID USERNAME 修改用户的基本组
	- -G GID USERNAME 该选项有副作用,如果修改前该用户有附加组,我们用了这个选项以后,该用户以前的附加组就会被覆盖掉;如果要追加附加组,我们可以用 -a -G NEWGID即可.
	- -c 指定注释信息
	- -d 修改用户的家目录,这个不建议,一旦修改了家目录,该用户就不能访问以前的家目录了,所以我们可以把-d 和-m (move)一起使用,意思是修改家目录的同时,把以前家目录里的文件移动到新的家目录中.
	- -s 修改用户的默认shell
	- -l loginname,修改用户的登陆名
	- -L lock,锁定用户
	- -U Unlock,解锁用户
	- 修改用户shell的命令 chsh USERNAME
	- 修改用户的注释信息 chfn USERNAME,fn是finger的缩写
- 密码管理:
	- passwd,普通用户用这个命令可以修改自己的命令,root用户可以用 passwd USERNAME,修改别的用户的密码
		- --stdin 从标准输入读取密码,比如 ehco "reahat" | passwd --stdin user1
		- -l 锁定用户账号
		- -u 解锁用户账号
		- -d 删除用户密码
	- pwch, password check,检查密码文件的完整性,报告密码文件是否有问题或者隐患.
	- 改变用户密码过期信息change age;chage [options] USERNAME
	- -d lastday,最近一次的修改时间
	- -E 过期时间
	- -I 非活动时间
	- -m 最短使用期限
	- -M 最常使用期限
	- -W 警告时间
#### 组管理
- 创建组:groupadd
	- -g 指定gid
	- -r 添加系统用户组
- 修改组:groupmod
	- -g GID 修改用户组的组id
	- -n GRPNAME 修改组的组名
- 删除组:groupdel GRPNAME
- 给组加密码:gpasswd,组密码的作用(看下面的例子,我们给tom组加了密码)
- 临时切换一个用户的基本组: newgrp;要退出这个新的基本组,只要输入exit命令即可
	
	```
	[root@ZhumaTech ~]# su - jerry
	[jerry@ZhumaTech ~]$ newgrp tom
	Password: 
	[jerry@ZhumaTech ~]$ id
	uid=529(jerry) gid=528(tom) groups=529(jerry),528(tom) context=unconfined_u:unconfined_r:unconfined_t:s0-s0:c0.c1023
	[jerry@ZhumaTech ~]$ exit
	exit
	[jerry@ZhumaTech ~]$ id
	uid=529(jerry) gid=529(jerry) groups=529(jerry) context=unconfined_u:unconfined_r:unconfined_t:s0-s0:c0.c102
	```
	
####  权限管理:
- 改变文件属主和属组,此命令只有管理员可以使用,chown USERNAME file1,file2....
	- -R recursive,修改目录及其内部文件的属主和属组.
	- --reference=/abc 参考abc文件,将目标文件的属主和属组改成同/abc文件一样
		
		```
		[tom@ZhumaTech ~]$ cd /tmp
		[tom@ZhumaTech tmp]$ touch abc
		[tom@ZhumaTech tmp]$ ll abc
		-rw-rw-r--. 1 tom tom 0 Feb 20 12:13 abc
		[tom@ZhumaTech tmp]$ su -
		Password: 
		[root@ZhumaTech ~]# touch /tmp/efg
		[root@ZhumaTech ~]# chown --reference=/tmp/abc /tmp/efg
		[root@ZhumaTech tmp]# ll /tmp/efg 
		-rw-r--r--. 1 tom tom 0 Feb 20 12:13 efg
		```
		
	- chown USERNAME:GRPNAME file1,file2... 此格式可以灵活运用;等同于 chown USERNAME.GRPNAME file1,file2...

		- chown :mygroup /tmp/abc 表示改变/tmp/abc的文件属组为mygroup
- 改变文件属组,此命令只有管理员可以使用,chgrp USERNAME file1,file2....	
	- -R recursive,修改目录及其内部文件的属组.
	- --reference=/abc 参考abc文件,将目标文件的属组改成同/abc文件一样
- 修改文件的权限,chmod(如果我们给的权限为不够,前面会补0,比如chmod 5 = chmod 005)
	1. 修改三类用户的权限:
		- chmod MODE file,...
			- -R 递归修改
			- --reference=/abc 参考abc文件,将目标文件的权限改成同/abc文件一样
	2. 修改某类用户或者某些类用户权限
		- chmod 用户类别=MODE file,....
 			- `# chmod u=rwx /tmp/abc` ☑
			- `# chmod go=r /tmp/abc` ☑
			- `# chmod g=rx,o= /tmp/abc` ☑
	3. 修改某类用户的某位或某些位权限
		- chmod 用户类别±MODE file,...
			- `# chmod u-wx /tmp/abc` ☑
			- `# chmod u+x,g-x /tmp/abc` ☑
			- `# chmod a+x /tmp/abc` = `# chmod +x /tmp/abc`  ☑
- 查看权限掩码命令umask: 遮罩码(权限掩码);创建文件就用666-umask;创建目录就用777-umask;___如果算得的文件中有执行权限,则将其权限加1;因为linux中文件默认是不能有执行权限的___.
	- root用户(umask是022)
	- 普通用户(umask是002)
	- umask 001 将遮罩码改为001,这个只是临时生效,要永久生效,需要在~/.bash_profile中最后一行加上 umask 027(参考下面)
- 用户角度来讲SHELL类型:
	- 登陆式shell:
		1. 正常通过某终端登录
		2. su -l USERNAME登陆
	- 非登陆式shell:
		1. su USERNAME
		2. 图形终端下打开命令窗口
		3. 自动执行的shell脚本
	- 区别
		- 登陆式shell如何读取配置文件?
			- /etc/profile --> /etc/profile.d/*.sh --> ~/.bash_profile --> ~/.bashrc --> /etc/bashrc 
		- 非登陆式shell如何读取配置文件?
			- ~/.bashrc --> /etc/bashrc -->/etc/profile.d/*.sh
	- bash的配置文件:
		1. 全局配置:
			- /etc/profile
			- /etc/profile.d/*.sh
			- /etc/bashrc
		2. 个人配置:(优先级高于全局配置)
			- ~/.bash_profile
			- ~/.bashrc
	- profile类的文件:
		1. 设定环境变量
		2. 运行命令或脚本
	- bashrc类的文件:
		1. 设定本地变量
		2. 定义命令别名
#### 输入与输出
- 系统设定:
	- 默认输出设备:标准输出,文件描述符:STDOUT,标准正确输出标识符:1
	- 默认输入设备:标准输入,文件描述符:STDIN,标识符:0
	- 标准错误输出: 默认情况,STDERR,描述符,2
	- 一般标准输入设备是键盘,而标准输出和标准错误输出的设备是显示器.标准输出和标准错误输出是两个不同的数据流.
- I/O重定向:
	- \>:输出重定向,覆盖输出,原有内容会被副高
		- set命令,shell的内置命令,help set可以查看用法
			- -C选项,禁止对文件使用覆盖重定向的覆盖功能,+C是可以覆盖,当我们启用了-C选项,然后我们又想覆盖此文件,可以用 >| FILE 来操作
		- 2>FILE:  重定向错误输出
		- &> FILE:重定向标准输出或错误输出至同一个文件;命令等同于COMMAND 2>&1
	- \>>:追加输出,保留文件中原有内容,在文件尾部追加新内容
	- \2>>:错误追加输出,保留文件中原有内容,在文件尾部追加新内容
 	- <:输入重定向
 	- <<: Here Document,此处生成文档
        
        ```
        [root@ZhumaTech tmp]# cat <<EOF
        > 1st line
        > 2nd line
        > EOF
        1st line
        2nd line
        ```
        
        ```
        [root@ZhumaTech tmp]# cat >> /tmp/myfile.txt <<EOF
        > 1ST LINE
        > 2ND LINE
        > 3RD LINE
        > EOF
        [root@ZhumaTech tmp]# cat /tmp/myfile.txt 
        1ST LINE
        2ND LINE
        3RD LINE
        ```
	
	- 管道:命令;命令1|命令2|命令3 ...,把前一条命令的输出作为后一条命令的输入
	- tee 三通,一个输入,两个输出,read from standard input and write to standard output and files;既可以在文件中保存一份,也可以在屏幕上输出一份.
	
	```
	[root@ZhumaTech tmp]# echo "hello world" | tee /tmp/hello
	hello world
	[root@ZhumaTech tmp]# cat /tmp/hello
	hello world
	```
	
####  文本查找的需要
- grep:根据模式,搜索文本,并将符合模式的文本行显示出来;家族有3个成员: grep,egrep,fgrep
- Pattern:文本字符和正则表达式的元字符组合而成匹配条件
- grep用法: grep [options] PATTERN(模式) [file....]
	- -i ignore case,忽略大小写
	- --color=[=WHEN] 匹配到的内容以高亮显示
	- -v 反向选择,显示没有被模式匹配到的行
	- -o 只显示被模式匹配到的字符串,每个串显示为一行
	- -E 支持扩展的正则表达式,此选项等同于egrep
	- -A after 数字,表示匹配到'某些内容',然后还显示它后面 数字行数(如下面的例子)
		
		```
		[root@ZhumaTech tmp]# grep -A 2 '^core id' /proc/cpuinfo 
		core id         : 0
		cpu cores       : 4
		apicid          : 0
		--
		core id         : 1
		cpu cores       : 4
		apicid          : 2
		--
		core id         : 2
		cpu cores       : 4
		apicid          : 4
		--
		core id         : 3
		cpu cores       : 4
		apicid          : 6
		```  
		
	- -B before数字,表示匹配到'某些内容',然后还显示它前面 数字行数(参考上面的例子)
	- -C 数字 CONTEX 上下文,表示匹配到'某些内容',然后还显示它前后面 数字行数(参考上面的例子)
#### 正则表达式:REGEXP
	- 元字符:
		-  . :匹配任意单个字符
		- 匹配次数:(贪婪模式,尽可能长的去匹配比如 a.*b 可以把ababababababababababbabab 这一段完整匹配出来.)
		- * :前面的字符出现任意次
		- .* :任意长度的任意字符;
		- ? :匹配其前面的字符1次或0次,即前面的字符可有可无
		- \\{m,n\\}: 匹配前面的字符至少m次,至多n次
	- 位置锚定:
		- ^ :锚定行首,此字符后面的任意内容必须出现在行首
		- $ :锚定行尾,次字符串前面的任意内容必须出现在行尾
		- ^$ :空白行
		- [] :匹配指定范围内的任意单个字符
		- [^] :匹配指定范围外的任意子单个字符
	- 单词锚定:___这里的单词理解为字串,即中间没有特殊符号的字串___
		- \<STRING或者\bSTRING:其后面的任意字符必须作为单词首部出现
		- STRING\>或者STRING\b:其前面的任意字符必须作为单词的尾部出现
		- \<STRING\> : 整个字串锚定,注意特殊符号
	- 分组:
		- \\(ab\\)\* : 就是把ab当成一个整体, \*修饰的就是ab这个整体.;其主要作用是为了在命令中再次调用这个整体比如下面的例子
			- \\n: 引用第n个左括号以及与之对应右括号所包含的所有内容
			
			```
			[root@ZhumaTech tmp]# cat test
			He love his lover
			She like her liker
			He like his lover
			She love her liker
			She like him
			[root@ZhumaTech tmp]# grep '\(l..e\).*\1' test
			He love his lover
			She like her liker
			```
			
### Day5
#### egrep及扩展正则表达式
- 正则表达式有两类:
	- 基本正则表达式: Basic REGEXP
	- 扩展正则表达式: Extended REGEXP;包含以下元字符
		- 不分元字符匹配和基本正则表达式相同
		- 特殊元字符:
			- 次数匹配:
				- + : 其前面的字符出现至少1次
				- {m,n}: 至少m次,至多n次;扩展正则表达式里,不需要'\'
				- (): 分组,不需要"\";后向引用也是用'\1','\2','\3'
				- |: 表示OR; c|Cat 选的是'|'整个左边部分或者整个右边部分;(c|C)at 才表示区分 cat或Cat
				
				    ```
				    找出/boot/grub/grub.conf中0-255的整数,提示:用扩展正则表达式中的或者
				    [root@ZhumaTech tmp]# grep -E '\<[1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5]\>' /boot/grub/grub.conf      
				    timeout=5
				    title CentOS (2.6.32-431.el6.x86_64)
		            kernel /vmlinuz-2.6.32-431.el6.x86_64 ro root=UUID=b9b9de07-bcc0-4025-a134-ba4533940298 rd_NO_LUKS rd_NO_LVM LANG=en_US.UTF-8 rd_NO_MD SYSFONT=latarcyrheb-sun16 crashkernel=auto  KEYBOARDTYPE=pc KEYTABLE=us rd_NO_DM rhgb quiet
		            initrd /initramfs-2.6.32-431.el6.x86_64.img
				    ```
				
- grep:使用基本正则表达式定义的模式来过滤文本的命令;但是可以通过-E选项来支持扩展正则表达式.
- IPv4地址分类:5类,有用的是A,B,C类,不管哪一类,第一段不能为0,最后一段也不能为0;D类和E类是拿来研究的,是不能用的
	- A类:第一段是1-127之间的,速记 127为10
	- B类:第一段是128-191之间的,速记128 为11,191为11
	- C类:第一段是192-223之间的,速记192为12
####  fgrep:fast 不支持正则表达式,也就是搜索的文字,不支持元字符
	
#### shell编程
- 编程语言:机器语言（0,1）、汇编语言(人类能够识别的语言)、高级语言(非常接近于人类的思维特性,同时又接近机器的识别特性,需要编译器或者解释器转换成机器语言),高级语言又分为静态语言和动态语言两种:
	- 静态语言:编译型语言,需要事先转换成可执行格式,才能执行(C,C++,JAVA,C#)
		- 有一个程序开发环境,不需要借助额外的二进制程序,我们就可以直接写代码,写完代码需要一个编译器将其直接转换成二进制可以独立运行的,这样的语言就陈伟静态语言;此类语言一般都是__强类型(变量)__语言
	- 动态语言:解释型语言,通常都是弱类型语言;边解释边执行.(asp,php,shell,python,perl)
	- 面向过程:Shell, C
	- 面向对象: JAVA,Python,perl,C
- 关键字:不管哪种语言,通常都会提供一些控制语句或者关键字,这些关键字最后能够被我们的解释器或者编译器转化为机器识别的指令.
- 变量:编址的存储单元,是内存空间,变量类型决定了数据的存储格式
- 在内存中存储数值10和字符10 的区别
	- 字符: 16bit
	- 数值: 1010 是4位,计算机的最小存储单位是bit,所以要占8bit
- 变量类型:用来确定数据的存储格式和长度
	- 字符
	- 数值
		- 整型
		- 浮点型:存储方式是,小数点之前存放一个位置,小数点之后存放一个位置,小数点单独存放一个位置
		- 日期时间型
		- 布尔型,真假型
	- 逻辑运算:与、或、非(门)、异或(操作数相同则为假,否则为真)
		- 短路逻辑运算
			- 与:有一个为假,结果一定为假
			- 或:有一个为真,结果一定为真
	- 强弱类型变成语言:
		- 强类型:变量在使用前必须事先声明变量类型,甚至还需要初始化(给一个原始值,一般数值初始化为0,字符初始化为空NULL)
		- 弱类型:变量随时用,随时声明,甚至不区分类型,一般不区分类型都会默认为字符串.
- bash变量类型:
	- 环境变量:作用域为当前shell进程及其子进程,声明方法:export VARNAME=VALUE
	- 本地变量:比如父shell中定义的变量,在子shell中不能引用,作用域为整个bash进程
	- 局部变量:声明方法 local VARNAME=VALUE,作用域为:当前代码段
	- 位置变量 $1,$2,$3...;特殊命令:shift,和位置变量运用的
	- 特殊变量:用来保存某些特殊数据的变量
		- $?: 上一条命令的退出状态码
		- $#: 查看命令参数的个数
		- $*: 参数列表
		- $@: 参数列表
- 引用变量: ${VARNAME},花括号可以省略. 有些情况是不能省略的,比如:

    ```
    [root@ZhumaTech tmp]# ANIMAL=pig
    [root@ZhumaTech tmp]# echo "There are lots of ${ANIMAL}s"
    There are lots of pigs
    ```

- 任何一个脚本在执行时会启动一个子shell进程;
- 命令行中启动的脚本会继承当前shell环境变量
- 系统自动执行的脚本(非命令行启动)就需要自我定义需要的各环境变量
- 导出环境变量有两种方法
	- export VARNAME=VALUE
	- 1. VARNAME1=VALUE
	  2. export VARNAME1
- 环境变量只对当前shell及其子shell有效,比如我在A Session上声明了某个环境变量,复制A Session为B Session,再查看这个变量,___会发现这个变量为空___
- 特殊变量:
	- $?:上一个命令的执行状态返回值,程序执行以后可能有两类返回值:
		1. 程序执行结果
		2. 程序执行状态返回码(0-255)
			- 0:正确执行
			- 1-255:错误执行,1,2,127系统预留;其他数字可以自定义
			- 输出重定向的特殊用法:
			- /dev/null:软件设备,bit bucket 数据黑洞
			
				```
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
- 脚本:命令堆砌,按实际需要,结合命令流程控制机制实现的源程序
- 对字符串类型的变量来说,我们要改变其值,还可以给字符串后面附加一些内容,常用在$PATH添加上.

    ```
    [root@ZhumaTech ~]# ANIMALS=pig
    [root@ZhumaTech ~]# ANIMALS=$ANIMALS:goat
    [root@ZhumaTech ~]# echo $ANIMALS
    pig:goat
    ```

- 对shell来讲,默认所有变量的值都是字符串,所以默认是不能做算数运算的.

	```
	[root@ZhumaTech ~]# A=2
	[root@ZhumaTech ~]# B=3
	[root@ZhumaTech ~]# C=$A+$B
	[root@ZhumaTech ~]# echo $C
	2+3
	```
	
- 脚本:命令的堆砌,按照实际需要结合命令流程控制机制实现的源程序.
- shebang:魔数,脚本中交shebang __第一行__必须是#!/FULLPATHOFSHELL
- 脚本也可以作为脚本的参数来执行,比如 bash first.sh,此时,就算这个脚本文件没有执行权限也能被运行.
#### 条件判断
- bash中条件判断类型通常有三种:表达式 [ expression ],[[ expression ]],test expression
	- 整数测试: 比较两个数的大小
	- 字符测试:
	- 文件测试: 判断文件是不是存在
- 条件测试的表达式:

	```
	[root@ZhumaTech ~]# A=1
	[root@ZhumaTech ~]# B=2
	```
	
	1. [ expression ] `[ $A -eq $B ]`
	
	    ```
	    [root@ZhumaTech ~]# [ $A -lt $B ]
	    [root@ZhumaTech ~]# echo $?
	    0
	    ```
	
	2. [[ expression ]]
	
	    ```
	    [root@ZhumaTech ~]# [ $A -gt $B ]
	    [root@ZhumaTech ~]# echo $?
	    1
	    ```
	
	3. \# test expression
	
	    ```
	    [root@ZhumaTech ~]# test $A -eq $B 
	    [root@ZhumaTech ~]# echo $?
	    1
	    ```
	
- 整数比较(双目比较:比较两个数大小):
	- -eq (equal):测试两个整数是否相等:相等为真,不等为假
	
		```
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
- 命令间的逻辑关系:
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
	- 如果用户不存在,就添加用户,否则,显示其已存在`! id user1 && useradd1 || echo "user1 exists"`
	- 如果用户不存在,就添加,并且设定密码,否则显示其已经存在`! id user1 && useradd1 && echo "user1"| passwd --stdin user1|| echo "user1 exists"`
- 用户添加,并统计系统有多少个用户

	```
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
	
	    ```
	    #!/bin/bash
	    NAME=user1
	    USERID=`id -u $NAMEUSE`
	    [ $USERID -eq 0 ] && echo "$NAME is a manager." ||"$NAME is a common user"
	    ```
	
- 条件判断,控制结构:
	- 单分支if语句 
	
	    ```
	    if 判断条件;then
	    	语句1
	    	语句2
	    	...
	    fi
	    ```	
	
	- 双分支的if语句
	
	    ```
	    if 判断条件;then
	    	语句1
	    	语句2
	    	...
	    else
	    	语句1
	    	语句2
	    	...
	    if
	    ```
	
- shell中如何进行算术运算:
	- 用let命令
	
	    ```
	    [root@ZhumaTech sh]# A=3
	    [root@ZhumaTech sh]# B=6
	    [root@ZhumaTech sh]# let C=$A+$B
	    [root@ZhumaTech sh]# echo $C
	    9
	    ```
	
	- $[算术运算表达式]
	
	    ```
	    [root@ZhumaTech sh]# C=$[$A+$B]
	    [root@ZhumaTech sh]# echo $C
	    9
	    ```
	
	- $((算术表达式))
	
        ```
        [root@ZhumaTech sh]# D=$(($B-$A))
        [root@ZhumaTech sh]# echo $D
        3
        ```
	
	- expr命令;expr 算术表达式,表达式中各操作数和运算符之间要有空格并且要使用命令引用
	
        ```
        [root@ZhumaTech sh]# F=`expr $A + $B` 
        [root@ZhumaTech sh]# echo $F
        9
        ```
	
- 练习:写一个脚本,判定历史命令的总条数是否大于1000,如果大于,显示"some commands has gone",否则显示"OK"

    ```
    #!/bin/bash
    HISTNUM=`history | tail -1 | cut -d' ' -f2`
    if [ $HISTNUM -gt $HISTSIZE ]; then
            echo "some commands will be gone"
    else
            echo "OK"
    fi
    ```

### Day6 bash脚本编程
#### 整数测试及特殊变量
- exit:直接退出当前脚本;还可以自定义退出状态码,比如1~255.

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
		- -e FILE:单目测试,测试文件是否存在
		
	        ```
	        [root@ZhumaTech ~]# [ -e /etc/inittab ]
	        [root@ZhumaTech ~]# echo $?
	        0
	        ```
	        
		- -f FILEPATH: 测试文件是否为普通文件
		- -d DIRPATH: 测试文件是否为目录
		- -r FILE: 测试当前用户对指定文件是否有对应权限
		- -w FILE: 测试当前用户对指定文件是否有对应权限
		- -x FILE: 测试当前用户对指定文件是否有对应权限
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
- 例题:给定一个文件,如果是一个普通文件,就显示之;如果是一个目录,亦咸施之;否则刺猬无法识别之文件

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
	
- 位置变量,$1 就是引用第一个参数,$2 就是引用第二个参数,以此类推,具体看下面的练习
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

#### sed(流编辑器),awk(报告文本生成器)	
- sed基本用法:stream editor,它是一个行编辑器,逐行编辑;vi是全屏编辑器
- 处理机制:逐行读取,读取到内存中,在内存中处理,处理的结果显示到显示器上,内存中的空间叫模式空间
- 默认情况下,sed不编辑源文件,仅对模式空间中的数据做处理	
- 命令格式:sed [OPTIONS] 'AddressCommand' FILE1 FILE2 ...
	- Address:地址定界
		1. StartingLine,Endline etc:1,100 1到100行,$:最后一行.
		2. /RegExp/ /正则表达式/; /^root/
		3. /pattern1/,/pattern2/,第一次被模式1匹配到的行,到第一次被模式2匹配到的行结束.
		4. LineNumber:指定的行
		5. 指定StartLine,+n,从指定行开始向后的n行.
	- Command:
		- d:删除符合条件的行	
		- p:显示符合条件的行;结果是符合条件的显示两次,不符合的显示一次
		- a \string: 在指定的行后面追加新行,内容为"string";\n 可以换行
		- i \string: 在指定的行后面追加新行,内容为"string";\n 可以换行
		- r FILE:将指定的文件的内容添加至符合条件的行处;一般都是用来合并文件
		
	        ```
	        [root@ZhumaTech sh]# sed '2r /etc/issue' ./bash.sh 
	        #!/bin/bash
	        CentOS release 6.5 (Final)
	        Kernel \r on an \m
	        
	        grep "\<bash$" /etc/passwd &>/dev/passwd
	        RETVAL=$?
	        
	        if [ $RETVAL -eq 0 ]; then
	                USERS=`grep "\<bash$" /etc/passwd | wc -l`
	                echo "$USERS users are using bash as default shell."
	        else
	                echo "No such users"
	        fi
	        ```
	        
		- w FILE:将指定范围的内容另存至指定的文件中
		- s/PATTERN/STRING/修饰符:查找并替换;默认是替换每一行第一个符合条件的字串.
			- 修饰符 g:全局替换
			- 修饰符 i:查找时忽略字母大小写
			- 后向引用在这里也适用
			
			    ```
			    [root@ZhumaTech sh]# nano sed.txt 
			    hello,like
			    hi, my love
			    //-----下面使用后向引用-----
			    [root@ZhumaTech sh]# sed 's/\(l..e\)/\1r/' sed.txt  
			    hello,liker
			    hi, my lover
			    ```
			
			- 上面的例子我们可以使用另外一个特殊字符"&",其意义是引用模式匹配到的整个串.
			
                ```
                //下面的命令同样能完成
                [root@ZhumaTech sh]# sed 's/l..e/&r/' sed.txt          
                hello,liker
                hi, my lover
                ```
	- Options:
		- -n:静默模式:不再默认显示模式空间中的内容
		
		```
		[root@ZhumaTech sh]# sed -n '/^root/ p' /etc/passwd
		root:x:0:0:root:/root:/bin/bash
		```
		
		- -i:直接修改源文件
		- -e SCRIPT1 -e SCRIPT2:可以同时执行多个脚本
		- -f PATHTOSED_SCRIPT:把SCRIPT文件以行保存至文件当中
			- sed -f /pathtoscript file
		- -r:使用扩展正则表达式
		
- 取出一个文件路径父目录名称

    ```
    # 其实就是弄明白如果文件基名(文件或目录的名称)的父目录们是由"/.*/"组成的,而基名是由至少一个(+)非'/'字符[^/]组成,
    # 最后以为如果是目录则有一个'/',文件则有0个'/'(/?)
    [root@ZhumaTech sh]# echo '/etc/rc.d' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/
    [root@ZhumaTech sh]# echo '/etc/rc.d/rc5.d/' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/rc.d/
    [root@ZhumaTech sh]# echo '/etc/rc.d/rc5.d/S26udev-post' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/rc.d/rc5.d/
    ```

#### 字符串比较
- 字符测试: 
	- ==或者=:字符串的等值比较, ___注意等号两段需要空格___
	
	```
	[root@ZhumaTech sh]# A=hello
	[root@ZhumaTech sh]# B=hello
	[root@ZhumaTech sh]# [ $A = $B ]
	[root@ZhumaTech sh]# echo $?
	0
	```
	
	- != :测试是否不相等,不想等为真,相等为假
	-n STRING: 测试指定字符串是否为空,空则真,不空则假
	-z STRING: 测试指定字符串是否不空,不空为真,空为假
- 练习:测试一个组用户名和基本是否一致.

	```
	[root@ZhumaTech sh]# nano yizhi.sh
	#!/bin/bash
	#
	if [ `id -n -u $1` == `id -n -g $1` ]; then 
	        echo "$1's username is same as the group name"
	else
	        echo "$1's username is different form the group name"
	fi
	
	// 查看root用户的用户名和基本祖名是否一致
	[root@ZhumaTech sh]# bash yizhi.sh root
	root's username is same as the group name
	// 查看新用户hello的用户名和基本祖名是否一致
	[root@ZhumaTech sh]# groupadd test
	[root@ZhumaTech sh]# useradd -g test hello
	[root@ZhumaTech sh]# bash yizhi.sh hello
	hello's username is different form the group name
	```
	
- 传递三个参数给脚本,第一个为整数,第二个为算术运算符,第三个为整数,将计算结果显示出来,要求保留两位精度.

	```
	[root@ZhumaTech sh]# nano cal.sh        
	  GNU nano 2.0.9               File: cal.sh                                     
	
	#!/bin/bash
	#
	if [ ! $# -gt 1 ];then
	        echo "Please input at least 2 args"
	fi
	
	echo "scale=2;$1/$2;" | bc	//echo输入多条信息,之间用;隔开
	
	[root@ZhumaTech sh]# ./cal.sh 5 3
	1.66
	```
	
- 扩展bc用法:

	```
	[root@ZhumaTech sh]# bc
	bc 1.06.95
	Copyright 1991-1994, 1997, 1998, 2000, 2004, 2006 Free Software Foundation, Inc.
	This is free software with ABSOLUTELY NO WARRANTY.
	For details type `warranty'. 
	scale=2	
	111/22
	5.04
	// 上面的内容等同于下面:
	[root@ZhumaTech sh]# bc <<< "scale=2;111/22"
	5.04
	```
	
#### for 循环
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

### Day 7  vim编辑器
#### VI编辑器
- vi:Visual Interface 可视化编辑器
- vim: VI iMproved  增强版,功能可以语法着色
- 和nano一样也是全屏编辑器,模式化编辑器.
- 打开一个文件: vim /path/to/somefile
- 技巧:
	- 打开文件后,直接让光标处于第12行: vim +12
	- 打开文件后,直接处在最后一行: vim + FILENAME 即可
	- vi还支持模式匹配,比如我要求打开文件,然后光标处在第一次我指定的字符所在的行上:
		` vi +/PATTERN FILENAME`
- 关闭文件:
	- vim 模式很多,常用的有三种:
		- 编辑模式(命令模式):击键会被理解为编辑文档的,比如删除两行,复制三行,粘贴10行等等;__默认模式__
		- 输入模式(输入内容):击键会被理解为输入到文件中的内容,保存在文档当中
		- 末行模式(最后一行键入一些命令):我们可以输入很多文件编辑外管理的命令.
	- 模式转换:
		- 编辑模式到输入模式:
			- i:在当前光标所在字符的前面转为输入模式
			- a:append;在当前光标所在字符的后面转为输入模式
			- o:当前光标所在行的下方新建一行,并转为输入模式
			- I:在当前光标所在行的行首转为输入模式
			- A:在当前光标所在行的行尾转为输入模式
			- O:当前光标所在行的上方新建一行,并转为输入模式
			- r:替换光标所在处字符
			- R:从光标处开始替换,直到按ESC退出替换模式
			- u:取消上一步操作
		- 回到编辑模式: ESC键
		- 末行模式:必须从编辑模式进;然后输入":"
			- :\# 跳转到第\#行
			- :10d 删除第10行
			- :10,20d 删除第10到第20行
			- :set nu 显示行号
			- :set nonu 不现实行号
			- :!COMMAND 在vi界面中执行系统命令
			- :r FILE 将文件导入到当前光标所在位置
			- :r !COMMAND 将命令执行结果导入到当前光标所在位置
			- :w 保存
			- :q 不保存退出
			- :wq (:x)保存退出
			- :q! 编辑了文件,不保存退出
			- :wq! 编辑了只读文件,强制保存退出
		- 编辑模式下退出
			- ZZ键也可以保存退出
	- 移动光标:
		- 逐字符移动:(键盘上右手控制的几个键;可以指定数字接以下按键,表示移动对应的字符,比如5l表示向右移动5个字符)
			- h:向左
			- l:向右
			- j:向下 Japan 地图位置上在下面
			- k:向上 Korea地图位置上在上面
		- 逐单词移动:按单词为单位移动,也适合数字加按键的操作
			- w:移至下一个单词的词首
			- e:跳到当前单词词尾或下一个单词词尾
			- b:调至当前或前一个单词的词首
		- 行内跳转:
			- 0:跳到行首,绝对行首空白字符也算.
			- ^:跳到行首,第一个非空白字符
			- $:绝对行尾
		- 行间跳转:
			- \#G: 跳转至第\#行
			- G:跳转到最后一行
	- 翻屏操作:
		- CTRL+F 向后翻屏
		- CTRL+B 向前翻屏
		- CTRL+D down 向下翻半屏
		- CTRL+U up 向上翻半屏
	- 删除单个字符:
		- x 删除光标所在处的单个字符
		- \#x 删除光标所在处及向后的共\#个字符
	- 删除命令: d,要和跳转命令组合使用,指定删除多少.
		- d$ 删除光标当前位置到行尾
		- d0 删除光标当前位置到行首
		- dw 删除光标当前位置到下一个单词词首,
		- \#d跳转符 就表示删除跳转范围的\#个
		- dd 删除当前光标所在行
		- \#dd 删除包括当前光标所在行在内的共\#行
		- 末行模式下有以下删除方法:
			- :1,10d 删除第一行到第10行
			- :.,+5d 删除当前行及后面的5行,"."表示当前行
			- $ 表示最后一行,$-1倒数第二行
	- vi最近的删除及操作不会被立即清空,最后一次的删除其实是剪切,可以粘贴到别的位置.
	- 粘贴命令:
		- p:如果删除或复制的内容为整行内容,粘贴在当前光标位置的下一行;如果删除或复制的内容为非整行,则粘贴在光标所在字符的后面
		- P:如果删除或复制的内容为整行内容,粘贴在当前光标位置的上一行;如果删除或复制的内容为非整行,则粘贴在光标所在字符的前面
	- 复制命令: y(yank)用法同d命令
	- 先删除内容,再转换为输入模式:c 同 d命令
	- 替换:r
		- r:替换光标所在处字符
		- R:从光标处开始替换,直到按ESC退出替换模式
	- 撤销编辑:u(undo),连续u可以撤销此前的n次操作.默认vi只缓存50次操错;也可以\#u来撤销最近\#次操作;假如我多撤销了2次,就可以撤销撤销,可以用ctrl+r来取消之前的撤销
	- 重复前一次的编辑操作: "."
	- 可视化模式
		- v:按字符选取,可以选中光标划过的范围
		- V:按矩形选取,一般会直接选取光标所在的行
	- 查找替换
		- /PATTERN: 向文件尾部查找
		- ?PATTERN: 向文件首部查找
		- n 在查找到的结果里,向下一个匹配到的内容跳转
		- N 在查找到的结果里,向上一个匹配到的内容跳转
		- 末行模式下可以用s来查找,和sed中一样,方法为ADDR1,ADDR2s/OLD/NEW/g,意思是在ADDR1到ADDR2的范围里,用NEW来替换OLD;"%"表示全文.
	- 使用vim编辑多个文件: vim FILE1 FILE2 ...
		- 在末行模式下输入:next可以切换到另一个文件
		- 在末行模式下输入:prev可以切换到上一个文件
		- 在末行模式下输入:last可以切换到最后一个文件
		- 在末行模式下输入:first可以切换到最后一个文件
		- :qa 全部退出
	- 分屏显示一个文件(类似于word的窗口-拆分):
		- ctrl+w,s水平拆分窗口
		- ctrl+w,v水平拆分窗口
		- 窗口间切换:ctrl+w.ARROW键
	- 分窗口显示多个文件:
		- 水平分屏显示:vi -o rc.sysinit inittab
		- 垂直分屏显示:vi -O rc.sysinit inittab
	- 将当前文件中部分内容另存为另一个文件
		- :ADDR1,ADDR2w /path/to/newfile 
	- 将另外一个文件的内容导入到当前文件中
		- :r /path/to/file
	- 跟shell交互
		- :! COMMAND 
	- 高级话题,下面设定临时生效
		- 显示行号 :set nu 
	 	- 取消显示行号 :set nonu
	 	- 设定vim编辑器忽略大小写 :set ic(ignorecase) 
	 	- 设定vim编辑器区分大小写 :set noic
	 	- 设定自动缩进 :set ai(autoindent)
	 	- 取消自动缩进 :set noai
	 	- 高亮显示查找文本 :set hlsearch 
	 	- 取消高亮显示查找结果 :set nohlsearch 
	 	- 语法着色 :syntax on 
	 	- 关闭语法着色 :syntax off 
	- vim配置文件:
		- /etc/vimrc 全局配置
		- ~/.vimrc 用户配置,可能不存在,可以自己建
	- vim教程 `vimtutor`
	- 有时候我们打开vim编辑文件的时候,会突然断开网络或者退出文件,然后在打开文件的时候就会报错.这时候会在源文件目录下生成一个同名的.swp文件.我们可以通过 vim -r FILE来恢复这个文件.如果我们不需要这个恢复,我们可以删除这个.swp文件.
	- 脚本练习:
		- 接受一个参数,add:添加用户user1..user10;del:删除用户user1..user10
		
		```
		#!/bin/bash
		if [ $# -lt 1 ]; then
		        echo "Usage: ./adminusers.sh ARG.."
		        exit 7
		fi
		
		if [ $1 == 'add' ]; then
		        for I in {1..10}; do
		            if id user$I &> /dev/null; then
		                echo "user$I exists"
		            else useradd user$I
		            echo "user$I" | passwd --stdin user$I &> /dev/null && echo "user$I h
		as been added successully"
		            fi  
		        done
		
		elif [ $1 == 'del' ]; then
		        for I in {1..10}; do
		           if ! id user$I &> /dev/null; then
		                echo "user$i doesn't exist"
		           else userdel -r user$I && echo "user$I has been deleted successfully"
		           fi
		        done   
		
		else echo "Unkown args"
		exit 8
		```
		
-  组合条件:
	- -a: 与关系 if [ $# -gt 1 -a $# -le 3]
	- -o: 或关系
	- !: 非关系
- 变量计算之步进
	- let I+=1 等同于 let I++; I+=后面的数值是步进
	- let SUM+=$I 就表示 步进为$I,也就是 let $SUM=$[$SUM+$I]
	- 算出1到100内偶数和以及奇数和
	
	```
	#!/bin/bash
	declare -i EVENSUM=0
	declare -i ODDSUM=0
	
	for I in {1..100}; do
	  if [ $[$I%2] -eq 0 ]; then
	        let EVENSUM+=$I
	  else 
	  		let ODDSUM+=$I
	  fi  
	done
	
	echo "Even sum is $EVENSUM"
	echo "Odd sum is $ODDSUM"
	```	
	
#### 文件查找
- grep,egrep,fgrep:文本查找.
##### locate
- locate查找非实时模糊匹配,根据全系统文件数据库进行的查找;一般情况每天晚上会自动将系统所有文件信息保存起来并收集到数据库里.
- 新的linux系统甚至都没有对应数据库,需要用`updatedb`手动生成数据库;生成的过程需要非常长的时间.
- locate的优势是查找起来速度非常快
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
			- *
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
	- -size : 根据文件大小;注意:___当我们
		- [+|-]\#k : [大于|小于]\#k;不带中括号内的±就表示精确的\#k大小
		- [+|-]\#M : [大于|小于]\#M;不带中括号内的±就表示精确的\#M大小
		- [+|-]\#G : [大于|小于]\#G;不带中括号内的±就表示精确的\#G大小
	- 根据文件的时间戳来查找: [+|-]\#; 表示\#天以内,或至少\#天之外
		- -mtime: 修改时间;单位是天
		- -ctime: 改变时间;单位是天
		- -atime: 访问时间;单位是天
		- -mmin : 修改时间,单位为分钟
		- -cmin : 改变时间,单位为分钟
		- -amin : 访问时间,单位为分钟
	- 根据文件的执行权限来查找: 
		- -perm mode : 权限精确查找
		- -perm -mode : 文件的权限必须完全包含-mode中的权限才做匹配;比如文件权限是755;匹配条件为644;那么文件也能被匹配到.
		- -perm /mode : 权限位中有任何一位匹配,就进行匹配
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
	// 根据摩根定律,上面的命令等同于 find /tmp -not \(user user1 -or user user2\)
	```
	
- find运作:
	- -print: 默认是显示
	- -ls: 以类似 ls -l的形式显示文件的详细
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
	
	- | xargs COMMAND: 本身不需要占位符,也不需要斜线分号结尾.
#### 特殊权限SUID:千万不要随便给别人suid
- SUID: 运行某程序时,相应进程的属主会临时变成程序文件自身的属主.`chmod u+s FILE` 如果文件本身就有执行权限,则SUID显示为s;否则显示为S

    ```
    [root@ZhumaTech sh]# ll /bin/cat
    -rwxr-xr-x. 1 root root 45224 Nov 22  2013 /bin/cat
    [root@ZhumaTech sh]# su - jerry
    [jerry@ZhumaTech ~]$ cat /etc/shadow
    cat: /etc/shadow: Permission denied
    [jerry@ZhumaTech ~]$ logout
    [root@ZhumaTech sh]# chmod u+s /bin/cat 
    [root@ZhumaTech sh]# ll /bin/cat
    -rwsr-xr-x. 1 root root 45224 Nov 22  2013 /bin/cat
    [root@ZhumaTech sh]# su - jerry
    [jerry@ZhumaTech ~]$ cat /etc/shadow
    root:$6$Rpvw0dgB$8q2fGWH4GiXdOsdfcA3DuikAwPtjPno2iKlJ0t6Y5LO/FIWfTs/VgI4oC3a5BlVSYtdfcB2X9bATnyaePko7E1:17115:0:99999:7:::
    bin:*:15980:0:99999:7:::
    ```

- SGID: 运行某程序时,相应进程的属组会临时变成程序文件自身的属组.可以让组里的成员创建的文件不再属于用户的基本组,而是以文件自身的属组;却对组员之间互相可以删掉对方的文件
	- 公司有个项目组,项目组里有三个人. 有个项目目录,希望三个人在这里都可以创建修改文件.
	
	```
	[hadoop@ZhumaTech ~]$ cd /tmp/project/
	[hadoop@ZhumaTech project]$ touch a
	[hadoop@ZhumaTech project]$ ll
	-rw-rw-r--. 1 hadoop hadoop 0 Mar 13 13:55 a
	[hadoop@ZhumaTech project]$ cd ..
	[hadoop@ZhumaTech tmp]$ cd project/
	[hadoop@ZhumaTech project]$ touch a.hadoop
	[hadoop@ZhumaTech project]$ ll
	-rw-rw-r--. 1 hadoop hadoop      0 Mar 13 13:55 a
	-rw-rw-r--. 1 hadoop developteam 0 Mar 13 13:57 a.hadoop

	// 同时hive用户也创建了 a.hive,文件属组变成了developteam
	[root@ZhumaTech ~]# su - hive
	[hive@ZhumaTech ~]$ cd /tmp/project/
	[hive@ZhumaTech project]$ touch a.hive
	[hive@ZhumaTech project]$ ll
	-rw-rw-r--. 1 hadoop hadoop      0 Mar 13 13:55 a
	-rw-rw-r--. 1 hadoop developteam 0 Mar 13 13:57 a.hadoop
	-rw-rw-r--. 1 hive   developteam 0 Mar 13 13:58 a.hive
	```
- STICKY 黏着位:在一个公共目录,每个人都可以创建文件,删除自己的文件,但是不能删除别人的文件`chmod o+t DIR`

### Day8
#### facl及用户及linux终端
##### Filesystem Access Control List: 文件系统访问控制列表:利用文件扩展保存额外的访问控制权限.
- setfacl: 设置facl
	- -m:设定facl
		- u:UID:PERM 或者 u:USERNAME:PERM
		
		```
		[root@ZhumaTech bakup]# setfacl -m u:hadoop:rw inittab 
		[root@ZhumaTech bakup]# getfacl inittab
		# file: inittab
		# owner: root
		# group: root
		user::rw-
		user:hadoop:rw-
		group::r--
		mask::rw-
		other::r--
		// 再用hadoop用户就可以修改inittab文件了
		```
		- g:GID:PERM 或者 g:GRPNAME:PERM; 用法和u相似
		- ___d:u:UID:PERM 表示对目录及目录下的子目录和文件设置facl
	- -x:取消定义的facl
	
		```
		[root@ZhumaTech bakup]# setfacl -x g:developteam  inittab     
		[root@ZhumaTech bakup]# getfacl inittab                   
		# file: inittab
		# owner: root
		# group: root
		user::rw-
		user:hadoop:rw-
		group::r--
		mask::rw-
		other::r--
		```
		
	- -b: 删除文件的所有ACL权限, setfacl -b FILENAME
		
		```
		[root@ZhumaTech bakup]# setfacl -b inittab                 
		[root@ZhumaTech bakup]# getfacl inittab 
		# file: inittab
		# owner: root
		# group: root
		user::rw-
		group::r--
		other::r--
		```
		
- getfacl: 查看facl
	- mask:facl的最大权限范围,也就是设置的facl权限不能超过mask的范围.
	- setfacl setfacl -m m:rwx 可以设置facl最大的权限范围.
#### 用户
- 几个命令
	- w: 查看当前谁登陆了系统,并显示他们正在干什么
	- who: 显示到当前登录到系统中的用户都有哪些
		- -r: 显示当前运行级别
		- -h: 会详情显示标题
	- whoami: 当前登录到系统的用户是谁,su切换过去的用户不会被记录
	- last: 系统登陆日志,显示/var/log/wtmp文件
		- -n \#: 显示最近\#次的登陆相关信息
	- lastb: b:bad,用来显示/var/log/btmp文件,记录的是用户错误的登入尝试 
		- -n \#: 显示最近\#次的登陆相关信息
	- lastlog: 查看每一个用户最近一次成功登陆的信息
		- -u USERNAME:显示指定用户最近的登陆信息;注意su切换过去的不会被记录
	- basename: 取得文件基名,常用语脚本, basename $0,$0会显示脚本自身的文件名(不包括前面的路径)
	- mail: 可以查看邮件,看完的邮件放在 ~/mbox里
	- hostname:显示本机主机名;echo $HOSTNAME;hostname HOSTNAME 可以修改主机名,
	
	```
	// 如果主机名不是ZhumaTech,就把主机名改为Zhumatech
	[root@ZhumaTech tom]# [ `hostname` != ZhumaTech ] && hostname ZhumaTech
	[root@ZhumaTech tom]# hostname
	ZhumaTech
	```
	
	```
	//如果当前主机的主机名为空,或者为(none),或者为localhost,就将其改为www.aphey.Command
	[ -z `hostname` ] || [ `hostname` == `(none)` -o `hostname` == 'localhost' ] && hostname www.aphey.com
	```
	
- 终端类型:
	- console:控制台;pty:physical terminal 物理终端.
	- tty: 虚拟终端;一般都是linux本地,通常是附加在物理控制台上,模拟出现的.
	- ttyS:串行终端
	- pts/\#: 伪终端

- bash内置环境变量 RANDOM: 0-32768之间的随机数值.
- bash 随机数生成器:熵池
	- /dev/random: 当熵池中的随机数取空了,会阻塞用户的进程.更安全.
	- /dev/urandom: 当熵池中的随机数取空了,会通过软件模拟生成些随机数,不会阻塞用户的进程;更好用
	
    ```
    //写一个脚本,利用RANDOM 生成10个随机数,并找出其中的最大值.
    #!/bin/bash
    declare -i MAX=0	//初始化最大值为0
    for I in {1..10}; do
      MYRANDOM=$RANDOM	//用变量MYRANDOM来保存随机生成的数
      if [ $I -le 9 ]; then		//和下面两行规定生成数字的排列格式为1,2,3
        echo -n "$MYRANDOM,"
      else echo "$MYRANDOM"
      fi  
    [ $MYRANDOM -gt $MAX ] &&  MAX=$MYRANDOM //用生成的随机数和最大值比较,如果新生成的随机数大于最大值就取大的数值作为新的最大值
    done
    echo "Max number is $MAX"
    ```

    ```
    //写一个脚本,利用RANDOM 生成10个随机数,并找出其中的最小值.
    #!/bin/bash
    declare -i MIN=0	
    for I in {1..10}; do
        MYRAND=$RANDOM
        [ $I -eq 1 ] && MIN=$MYRAND //我们在第一次的时候给变量MIN赋值,不写这一行,每次都会赋值
        if [ $I -le 9 ]; then 
        echo -n "$MYRAND,"
        else
            echo "$MYRAND"
        fi  
        [ $MYRAND -lt $MIN ] && echo MIN=$MYRAND    
    done
      echo "Min number is $MIN"
    ```

- 面向过程
	- 控制结构
		- 顺序结构
		- 选择结构
				- if elif else
				- 多分枝  case语句
		- 循环结构(for)
- case 语句
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

##### 案例,写一个脚本,可以接受选项及参数,而后能获取每一个选项,以及选项的参数,并能根据选项及参数做出特定的操作.比如:adminusers.sh --add tom,jerry --del tom,blair -v|--verbose -h|--help
    
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

##### 案例,写一个脚本,可以接受选项及参数,而后能获取每一个选项,以及选项的参数,并能根据选项及参数做出特定的操作.查看当前系统登陆的用户数 -v|--verbose显示详细信息;-c|--count显示用户数; -h|--help:显示帮助

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

### 磁盘管理
#### 机械式硬盘
- 常见外部存储设备: U盘,光盘,软盘,硬盘,磁带
- 低级格式化: 实现划分磁道,物理属性等
- 高级格式化: 创建文件系统
- 分区:partition 分区用来实现创建独立的文件系统.
- MBR: Master boot Record 或者Main Boot Record;主引导记录.0盘面0磁道0扇区,512字节,不属于任何操作系统;属于全局的,MBR是个扇区
	- 446byte: Bootloader 引导加载器;是一个程序
	- 64byte:每16个字节标识一个分区;也就是分区表
	- 2byte:MagicNumber,标记MBR是否有效
- 硬盘分区是按照柱面分区的
- 文件系统:可以理解为一个管理软件,把存储空间划分成两片,一边存储数据的源数据(文件条目inode),另一边是数据存储区域.元数据里有一块叫块位图(bitmap),每一个block都在块位图里有一个标记;同样,inode也有对应的位图.
- 链接文件
	- 硬链接;创建硬链接的时候,源文件和目标文件最好都使用绝对路径
		- 硬链接只能对文件创建,不能应用于目录
		- 不能跨文件系统
		- 创建硬链接会增加文件被连接的次数
	- 软连接(符号链接)
		- 可应用于目录
		- 可以跨文件系统
		- 不会增加被连接文件的连接次数
		- 大小为指向的路径所包含的字符个数
	- ln [-s -v] SRC DEST
		- 不加选项,创建硬链接
		- -s:创建软链接
		- -v:显示创建过程
	- du:显示文件或者一个目录整体锁占用的磁盘空间大小
		- -s 显示一个目录及其子文件锁占用的磁盘空间大小
		- -h humanreadable 显示单位换算
	- df:查看整个磁盘分区的使用情况
		- -i 查看inode的使用情况
		- -h humanreadable 显示单位换算
		- -P 在同一行中显示,不换行
		- 不加选项,显示block的使用情况
	- du，disk usage,是通过搜索文件来计算每个文件的大小然后累加，du能看到的文件只是一些当前存在的，没有被删除的。他计算的大小就是当前他认为存在的所有文件大小的累加和。df，disk free，通过文件系统来快速获取空间大小的信息，当我们删除一个文件的时候，这个文件不是马上就在文件系统当中消失了，而是暂时消失了，当所有程序都不用时，才会根据OS的规则释放掉已经删除的文件， df记录的是通过文件系统获取到的文件的大小，他比du强的地方就是能够看到已经删除的文件，而且计算大小的时候，把这一部分的空间也加上了，更精确了。当文件系统也确定删除了该文件后，这时候du与df就一致了。
- 设备文件:
	- 块设备:按块为单位,随机访问的设备
		- 硬盘,既是块设备,也是字符设备
	- 字符设备:按字符为单位,线性设备
		- 键盘
		- 硬盘,既是块设备,也是字符设备
	- 当ll /dev的时候,有些文件前面有逗号隔开的两个数字,它们是主设备号和次设备号
		- 主设备号:标识设备类型(Major Number)
		- 次设备号:标识同一种类型中的多个不同的设备(Minor Number).
	- 创建文件设备:mknod [OPTION]... NAME TYPE [MAJOR MINOR]
		- -m MODE 设置权限
		
	```
	[root@ZhumaTech ~]# mknod -m 640 mydev2 c 66 1
	[root@ZhumaTech ~]# ll
	total 56
	-rw-r--r--. 1 root root    53 Mar 21 15:40 1
	-rw-r--r--. 1 root root     0 Mar  7 12:12 a b
	-rw-------. 1 root root  1039 Nov 10 17:35 anaconda-ks.cfg
	-rwxr-xr-x. 1 root root   140 Mar 20 10:43 debug.sh
	-rw-r--r--. 1 root root   874 Mar  9 09:34 inittab
	-rw-r--r--. 1 root root  9113 Nov 10 17:35 install.log
	-rw-r--r--. 1 root root  3161 Nov 10 17:34 install.log.syslog
	crw-r--r--. 1 root root 66, 0 Mar 21 15:41 mydev
	crw-r-----. 1 root root 66, 1 Mar 21 15:41 mydev2
	-rwxr-xr-x. 1 root root 19688 Mar  9 09:40 rc.sysinit
	-rwxr-xr-x. 1 root root    56 Mar 21 09:36 shift.sh
	```
	
	- tty命令可以查看本机使用的tty是什么
	- `echo "hello" >> /dev/pts/1` 可以向/dev/pts/1发送hello.___不要轻易的往设备发送信息,如果这个hello是向硬盘发送,会覆盖MBR___
	- 查看当前系统识别了几块硬盘: fdisk -l
	- Linux的支持的文件系统
		- 创建文件系统;高级格式化 mkfs -t(type) ext3
		- 文件系统:文件系统不同,linux上有个程序(动态库)叫vfs(也是内核功能)把下面的文件系统调用接口封装了,所以我们能够使用统一的命令对他们进行操作,比如高级格式化
			- FAT32: linux上叫 vfat
			- NTFS
			- ISO9660
			- CIFS(通用互联网文件系统,windows网上邻居)
			- ext,~2,~3,~4
			- xfs
			- reiserfs
			- jfs
			- nfs
			- ocfs2
			- gfs2
	- 每一个分区都可以使用不同的文件系统,但最终都要归并到根目录下;这个就叫做挂载
####  管理分区:
- fdisk /dev/sda
	- p:显示当前硬件的分区
	- n:创建新分区
		- e:扩展分区
		- p:主分区
	- d:删除一个分区
	- w:保存退出
	- q:不保存退出
	- t:修改分区类型
	- l:显示锁支持的所有类型
- 创建分区,w保存后,系统内核未必能识别.我们可以 cat /proc/patitions 看一下内核识别了哪些分区;此时我们用partprobe(一般用于红帽5,如果提示COMMAND NOT FOUND,则需要安装parted rpm包;红帽6也可以使用partx)让内核重读分区列表
- CPU自外而内有四个级别:
	- 最里面的ring0,最外面的是ring3;一般来讲,内核运行在ring0上,用户程序是运行在ring3上的;ring1和ring2没有使用
	- block size常见有三种: 1024b;2048b;4096b.
	- super block:超级块;在源数据区用来保存分区中全局信息,包括块组的数量,每个块组中包含多少块,块大小,空闲磁盘块,已用磁盘块,空闲inode,已用inode;如果一个分区的超级块坏了,分区就挂了. 超级块可以有多个备份.
	- 块组描述符表(GDT):当前系统上一共有多少个块组,每个块组从第几个块开始,到第几个块结束.一样,需要备份.
	- 任何分区的第0个块是不能被使用的,名为 boot block引导块,预留出来,用来存放bootloader.多系统互存的时候才会使用到.但系统 的 bootloader存放在MBR中.
	- 每一个块组都分成了:SuperBlock(不是每个块组都有,备份个几份就可以了,一般情况下找的是第0个块组的SuperBlock,如果这个坏了,会自动找下一个,也可以手动修复),GDT(blockGroup Description Table),block Bitmap(块位图),Inode Bitmap(索引节点位图),Inode Table(索引节点表),Data Blocks(数据块)
	- 系统查找/var/a.txt的顺序, /目录是自引用的,先去inode table 找/的inode,根据此inode去找/的块,在这个块里有var这个文件对应的inode号,根据这个inode号,再回到inode table去查找var对应的块,然后在var块里找a.txt的inode号, 再回到inode table查找a.txt的inode,再根据a.txt的inode找到对应的块.
	- 目录其实是一个对应表,是文件的inode,文件名长度,文件类型
	- inode本身也有大小,所以每个分区的inode的个数也是有比例的,根据文件大小来分配.比如每8k留一个inode,然后32K对应一个INODE 等等.
	- inode包含的内容有权限,属主属组,大小,时间戳,直接磁盘块指针,间接磁盘块指针,二级磁盘块指针...
	- ext3 和 ext2的区别: ext 日志文件系统(journal file system);ext3除了数据区,元数据区,外多了一个日志区;存文件顺序由原来的先存inode,再存数据变成了先把inode放到日志区创建,然后开始存数据,存完之后,再把inode转移到元数据区,如果存数据过程中断电,系统检测只要检测日志区就可以了.所以写文件,ext3会比 ext2慢.
	- 当我们临时文件比较多,性能要求比较高,安全性能要求不高时,我们可以使用ext2.
#### 创建文件系统
- 重新创建文件系统会损坏原有文件
	1. 创建好新分区后(cat /proc/partitons;partx /dev/sda)
	2. mkfs:make file System
		- 查看当前系统内核支持哪些文件类型:cat /proc/filesystems
		- -t(type) FSTYPE PARTITION 为指定的分区创建文件系统
		- mkfs -t ext3命令等同于mkfs.ext3
		- mke2fs:专门用来创建管理ext类型的文件
			- -j: journal 直接创建为ext3类型文件
			- -b BLOCKSIZE: block 指定块大小,默认是4096;可用取值为1024,2048或4096
			- -L LABEL:指定分区卷标
			- -m \#: 指定预留给超级管理员用的块数的百分比,默认为5%
			- -i \#: 指定多为少字节的空间创建一个inode,默认为8192,这里给出的数值应该为块大小的2的n次方倍. 
			- -N \#: 指定inode个数.
			- -F: 强制创建文件系统 
			- -E: 用户指定额外文件系统属性
				- ___stride=阵列chunk(默认64KB)/block块大小的商,可以优化软RAID的性能.
		- blkid /dev/sda5 查看|定位/dev/sda5的文件属性包括(UUID,TYPE和LABEL)
		
        ```
		[root@ZhumaTech ~]# blkid /dev/sda5
		/dev/sda5: LABEL="MYDATA" UUID="cc6b145d-79c3-4b8d-b376-8f24d7ff9972" TYPE="ext4" 
		```
		
		- e2label: 用于查看或定义卷标
		
		```
		[root@ZhumaTech ~]# e2label /dev/sda5
		MYDATA	//查看卷标
		[root@ZhumaTech ~]# e2label /dev/sda5 HELLOWORLD	//新定义一个卷标
		[root@ZhumaTech ~]# e2label /dev/sda5
		HELLOWORLD
		```
		
	3. 不损害原有数据,将ext2t升级为ext3调整文件系统的相关属性: 
		- tune2fs:调整文件系统的相关属性
			- -j: ext2调整为ext3,只能升级不能降级
			- -L: 设定或修改卷标`tune2fs -L "MYDATA" /dev/sda5`
			- -m: 调整预留百分比
			
            ```
            [root@ZhumaTech ~]# tune2fs -m 2 /dev/sda5 //调整预留百分比为2       
            tune2fs 1.41.12 (17-May-2010)
            Setting reserved blocks percentage to 2% (10496 blocks)
            [root@ZhumaTech ~]# fdisk -l /dev/sda5
            Disk /dev/sda5: 2149 MB, 2149726208 bytes
            255 heads, 63 sectors/track, 261 cylinders
            Units = cylinders of 16065 * 512 = 8225280 bytes
            Sector size (logical/physical): 512 bytes / 512 bytes
            I/O size (minimum/optimal): 512 bytes / 512 bytes
            Disk identifier: 0x00000000
            ```
			
			- -r \#:指定为管理员预留的块数
			- -o:设定默认挂载选项
				- 我们常用的只有acl选项
			- -c \#:指定挂载次数达到\#,进行自检,0或-1表示关闭此功能
			- -i \#:每挂载使用\#天后进行自检,0或-1表示关闭此功能	
			- -l:显示超级块中的信息
		- dumpe2fs /dev/sda5:显示/dev/sda5文件系统相关信息(超级详细,包括块组的信息)
			- h:head 只显示超级块信息
		- fsck:检查并修复Linux文件系统
			- -t FSTYPE:指定文件系统类型
			- -a(automatically): 自动修复
		- e2fsck:专门用来修复ext2/ext3文件系统
			- -f:强制检查
			- -p:自动修复
			- -a:也是自动修复
- 挂载:将新的文件系统关联至当前跟文件系统;反之则为卸载
	- mount挂载(不带选项或参数则是显示当前系统已经挂载情况)
	- mount 设备 怪哉点
		- 指定设备:
			- 设备文件 /dev/sda5
			- 卷标: LABEL=""
			- UUID: UUID=""
		- 挂载点:"目录"
			- 要求:
				- 此目录没有被其他进程使用
				- 目录必须存在
				- 如果目录中原有文件,原文件将会被暂时隐藏
		- 挂载完成后,要通过挂载点访问
	- mount [options] [-o options] DEVICE MOUNT_POINT
		- -a:all 挂载/etc/fstab文件中指定的所有的文件系统
		- -n:默认情况下,mount每挂载一个设备,都会把挂载的设备信息保存至/etc/mtab文件,使用-n选项,挂载设备时,不把信息写入此文件.
		- -t FSTYPE:指定正在挂载的文件系统的类型,不使用此选项时,mount会调用blkid命令获取对应文件系统类型
		- -r:只读挂载,挂载光盘时常用此选项
		- -w:读写挂载
		- -o:指定额外的挂载选项,也即指定文件系统启用的属性,当有多个选项时,用逗号隔开
			- async:异步写入,异步的例子:我们写word,都是先保存在内存里,然后再保存到硬盘,加入我们没按保存停电,你懂的;默认是异步的
			- atime:文件每访问一次,都会更新一下文件的访问时间
			- auto: 设备是不是能使用-a选项自动挂载
			- _netdev: 若一个网络设备ping不到,就不在挂载这个网络设备
			- remount: 重新挂载当前文件系统
			- ro:挂载为只读
			- rw:读写挂载
			- sync:同步写入
			- suid:千万不要给外来设备挂载这个选项.推荐使用nosuid
			- loop:挂载本地回环设备
	- 挂载ISO镜像:mount -o loop /root/CentOS6.0.iso /mnt/cdrom
	- umount 卸载文件系统
	- umount 设备 或者 umount 挂载点就能完成卸载
	
	- 卸载注意事项:
		- 挂载的设备没有进程使用
		- 当挂载的设备不能卸载的时候,可能是有人在使用,我们可以用 fuser -v /MOUNT_POINT 来查看谁在使用
- swap分区,交换空间:允许我们内存过载使用;当物理内存满了的时候,系统会将某程序不常用的页框(page frame)移动到硬盘的swap分区.然后当进程又要调用这些页框的时候,系统会再找一个不常用的页框和swap分区里需要用的页框交换一下.就是这个意思.交换空间一般用来应急.
	- 将内存中的数据放到交换分区的过程被称为page out;取回来叫page in.
	- 作为存储空间,CPU的寄存器速度是最快的,访问时间大概是1纳秒;然后是一级缓存或者二级缓存,访问时间大概是10纳秒;内存的访问时间大概是10毫秒.而磁盘访问速度大概是秒级别了.
	- 如果非要建立交换分区,尽量放在靠外的磁道上.
	- free 查看当前系统物理内存和交换空间的使用情况
		- -m: 以兆为单位来显示内存空间的大小
	- buffers:缓冲,避免慢的设备遭受冲击
	- cached:缓存,把慢的设备传输的东西先存起来,反复使用的.
	- 新建交换分区和创建新分区的方法一样.只不过用t选项要把其类型指定为82:swap
	- 然后对新创建的swap分区写入文件系统
		- 创建交换分区: mkswap /dev/sda6
			- -L LABEL:可以设立卷标
	- 挂载交换分区的方法比较独特:
		- swapon /dev/sda6 : 启用/dev/sda6作为交换分区
			- -a:启用所有的定义在/etc/fstab文件中的交换设备
		- swapoff /dev/sda6 : 关闭/dev/sda6作为交换分区
- 回环设备:loopback,使用软件来模拟实现硬件(理解)
- 创建一个镜像文件,模拟120G空间,可以当作一个硬盘来用. 
	- dd 转换并复制一个文件;dd if=源文件地址(input file) of=目标文件(output file);可以用bs=\# 指定(blocksize)一次复制的字节大小;count=\# 指定复制的个数.
	- dd和copy复制的区别: copy是以文件为单位进行复制的,先把源文件通过vfs读取到内存中,再重新保存到目标文件处;而dd不是以文件为单位,可以理解为它不通过vfs,而是以0101代码复制到目标位置,所以dd的好处是可以只复制文件的一部分;用bs=\# 指定(blocksize)一次复制的字节大小;count=\# 指定复制的个数;seek=\# 表示从新文件的开始跳过去多少个字节,比如`dd if=/dev/zero of=/mnt/a seek=1023 bs=1M count=1 `表示复制/dev/zero去创建一个新文件,创建新文件时跳过1023个bs,再创建1个bs.这样我们df /mnt/a时显示文件大小为1G,但是du /mnt/a时,它只有1M.
	
	```
	[root@ZhumaTech ~]# dd if=/etc/inittab of=/root/inittab
	1+1 records in
	1+1 records out
	876 bytes (876 B) copied, 0.000205899 s, 4.3 MB/s
	[root@ZhumaTech ~]# cat /root/inittab 
	# inittab is only used by upstart for the default runlevel.
	...省略中间部分...
	#   0 - halt (Do NOT set initdefault to this)
	#   1 - Single user mode
	#   2 - Multiuser, without NFS (The same as 3, if you do not have networking)
	#   3 - Full multiuser mode
	#   4 - unused
	#   5 - X11
	#   6 - reboot (Do NOT set initdefault to this)
	 
	id:3:initdefault:
	```
	
	```
	// dd命令的功能很强大,比如可以备份硬盘的MBR到U盘
	dd if=/dev/sda of=/mnt/usb/mbr.backup bs=521 count=1
	// 反之dd也能恢复MBR
	dd if=/mnt/usb/mbr.backup of=/dev/sda bs=521 count=1
	// 其实cat也行,把cdrom 一个字节一个字节地保存到/root/rhel5.iso
	cat /dev/cdrom > /root/rhel5.iso
	// /dev/zero 泡泡设备,往外吐0;/dev/null 黑洞设备,啥都吞没了.
	```
- 创建一个1G镜像文件,并挂载成交换分区
	```
	[root@ZhumaTech ~]# dd if=/dev/zero of=/var/swapfile bs=1M count=1024	//创建1个1G的镜像文件
	1024+0 records in
	1024+0 records out
	1073741824 bytes (1.1 GB) copied, 6.54707 s, 164 MB/s
	[root@ZhumaTech ~]# ls -lh /var/swapfile 	//查看这个镜像文件的信息
	-rw-r--r--. 1 root root 1.0G Mar 23 11:17 /var/swapfile
	[root@ZhumaTech ~]# mkswap /var/swapfile	//对这个文件创建swap文件系统
	mkswap: /var/swapfile: warning: don't erase bootbits sectors
	        on whole disk. Use -f to force.
	Setting up swapspace version 1, size = 1048572 KiB
	no label, UUID=fb9bf527-f45e-49a6-bc7c-1dcde51ef11b
	[root@ZhumaTech ~]# free -m		//查看现有的内存和交换分区使用情况
	             total       used       free     shared    buffers     cached
	Mem:          1874       1239        634          0         27       1067
	-/+ buffers/cache:        144       1729
	Swap:         1999          0       1999
	[root@ZhumaTech ~]# swapon /var/swapfile 	//挂载镜像交换分区
	[root@ZhumaTech ~]# free -m		//再查看内存和交换分区使用情况
	             total       used       free     shared    buffers     cached
	Mem:          1874       1240        633          0         27       1067
	-/+ buffers/cache:        144       1729
	Swap:         3023          0       3023
	```
	
- mount挂载的文件系统,在系统重启后会全部失效,要想开机自动挂载,我们就要配置文件系统的配置文件/etc/fstab(file system table) 
- OS在初始化时,会自动挂载/etc/fstab中定义的每一个文件系统 
- fstab 是使用空格隔开的6个字段.
	- 第一个字段:要挂载的设备,可以用卷标,也可以用UUID,也可以用设备文件来指定
	- 第二个字段:挂载点.
	- 第三个字段:文件系统类型
	- 第四个字段:挂载选项
	- 第五个字段:转储频率:用于定义多久对此文件做一次完全备份,0不备份,1表示每天都备份,2表示每隔一天备份一次...	
	- 第六个字段:文件系统检测次序(一般只有根为1,只有根需要先检查,2表示根检查完以后就检查,可以多个文件同时为2;0表示不检查)
- 当挂载的设备不能卸载的时候,可能是有人在使用,我们可以用 fuser -v /MOUNT_POINT 来查看进程正在使用的文件或套接字文件
	- -v:verbose 查看详细信息
	- -k:结束访问文件的进程
	- -m:指定挂载点,一般可以和-k通用
	
	```
	//我挂载了/dev/sda5到/sda5,然后用另外一个用户访问/sda5
	[root@ZhumaTech ~]# umount /dev/sda5	//卸载不了
	umount: /sda5: device is busy.
        (In some cases useful info about processes that use
         the device is found by lsof(8) or fuser(1))
	[root@ZhumaTech ~]# fuser -km /sda5	//结束访问/sda5的进程,这时候会把访问/sda5的那个用户给踢掉
	/sda5:                2842c
	//然后就可以正常卸载/sda5
	```
	
#### 压缩,解压缩命令
- 压缩格式:gz;bz2;xz;zip
- 压缩算法不同,压缩比也会不同,压缩比:原来5M压缩后1M,压缩比为(5-4)/5
- 早期压缩命令用的是compress: FILENAME.Z
- compress对应的解压缩命令为uncompress
##### 现在流行的压缩工具有,下面的只能压缩文件,不能压缩目录,如果指定参数为目录的话,会对该目录下每个文件进行单独的压缩操作;而且会删除源文件:
- gz,压缩工具是 gzip,压缩后文件名为 .gz
	- 压缩:gzip /PATH/TO/FILE 	//压缩完成或会删除源文件
		- -d:解压缩
		- -\#: 1-9,指定压缩比,压缩比越小,压缩速度越快;默认为6
	- 解压缩文件:gunzip /PATH/TO/COMPRESSEDFILE	//压缩完成或会删除源文件
	- zcat COMPRESSEDFILE.gz:不解压的情况下,查看文本文件的内容
- bzip2: .bz2:对大文件来说,比gzip有更大压缩比的压缩工具,小文件优势不明显,用法和gz相似
	- 压缩:bzip2 /PATH/TO/FILE 	//压缩完成或会删除源文件
		- -d:解压缩
		- -\#: 1-9,指定压缩比,压缩比越小,压缩速度越快;默认为6
		- -k:keep,压缩时,保留源文件
	- 解压缩文件:bunzip2 /PATH/TO/COMPRESSEDFILE	//压缩完成或会删除源文件
	- bzcat COMPRESSEDFILE.bz2:不解压的情况下,查看文本文件的内容
- xz: .xz:
	- 压缩:xz /PATH/TO/FILE 	//压缩完成或会删除源文件
		- -d:解压缩
		- -\#: 1-9,指定压缩比,压缩比越小,压缩速度越快;默认为6
		- -k:keep,压缩时,保留源文件
	- 解压缩文件:unxz /PATH/TO/COMPRESSEDFILE	//压缩完成或会删除源文件
	- 解压缩文件到屏幕:xzdec /PATH/TO/COMPRESSEDFILE
	- xzcat COMPRESSEDFILE.xz:不解压的情况下,查看文本文件的内容
##### zip:压缩比不大,但是可以对目录进行压缩;多个文件整合成一个文件叫归档,Archive;压缩后默认不删除源文件;zip是个既归档又压缩的工具
- 压缩zip: zip FILENAME.zip /PATHTOFILE or DIRECTORY
- 解压缩unzip: unzip COMPRESSEDFILE.zip
##### tar:归档工具,只归档不压缩
- tar
	- -c:创建归档文件
	- -f FILE.tar:操作的归档文件
	- -x: 展开归档
	- -xattrs:在归档时保留文件的扩展属性信息(比如文件的acl)
	- -tf FILE.tar:不展开归档,查看归档文件的列表
	- -zcf: 归档并调用gzip压缩
	- -zxf: 调用gzip解压缩并展开归档;z可以省略,系统能识别用什么工具压缩的.
	- -jcf: 归档并调用bzip压缩
	- -jxf: 调用bzip解压缩并展开归档;j可以省略,系统能识别用什么工具压缩的.
	- -Jcf: 归档并调用xz压缩
	- -Jxf: 调用xz解压缩并展开归档;J可以省略,系统能识别用什么工具压缩的.
	- -C : 解压到什么路径中去 `tar xf /tmp/users.tar.bz2 -C /root`;不用这个选项,就会解压到当前目录
##### cpio 做成归档或者展开归档;比tar古老
- cpio  /boot/initramfs-xx 就是cpio归档的.
- read [选项] [变量名]
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
    
    ```
    // 指定3个文件进行归档
    #!/bin/bash
	read -p "Three files:" FILE1 FILE2 FILE3
	read -p "Destination:" DEST
	read -p "Compress Method:[gzip|bzip2|xz]:" COMP
	
	case $COMP in
	gzip)
	 tar zcf ${DEST}.tar.gz $FILE1 $FILE2 $FILE3 ;;
	bzip2)
	 tar jcf ${DEST}.tar.bz2 $FILE1 $FILE2 $FILE3 ;;
	xz)
	 tar cf ${DEST}.tar $FILE1 $FILE2 $FILE3
	 xz ${DEST}.tar
	 ;;
	*)
	echo "UNKOWN FORMAT"
	exit 9
	;;
	esac
    ```
    
##### while循环:适合循环次数未知的场景;必须要有退出条件;外面先赋予一个值里面在修正这个值
- 语法格式

	```
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
	
##### echo -e输出个性字体
- echo -e "\033[1mHello\033[0m,World"
	- \033表示ctrl键,我们这里把它当作固定格式记住,\033[1m 表示特殊字体开头,\033[0m 表示特殊字体结尾
	- \033[___1___mHello\033[0m,单个数字表示后面文字的大小,斜体等等,字体闪动等等
	- \033[___31___mHello\033[0m,31-37表示7种常规文字前景色
	- \033[___41___mHello\033[0m,41-47表示7种常规文字背景色

##### 64位系统和32位系统库
- 32位系统库:/lib
- 64位系统库:/lib64

##### 硬盘接口模式
- 驱动程序:将cpu发来的逻辑指令转换成设备对应的自身的控制机制.
- 硬盘的接口:其实还是个控制器(Controller),用来翻译硬盘和cpu的彼此的语言
- 适配器(Adapter):和控制器是一样的东西,只不过控制器一般是继承的,适配器一般是非集成的.
- 协议:两个设备之间互相约定好的,彼此认同的格式;双当都遵循的理解某种信号的法则.
- 并行和串行的区别:
	- IDE(ATA):133Mbps;并行
	- SATA(Serial ATA):300Mbps;SATA2:600Mbps;SATA3:6Gbps;串行
	- USB3.0:480Mbps;串行
	- SCSI:Small Computer System Interface,I/O控制器功能特别强大,可以理解为小CPU,当机器的CPU退出的时候,小cpu可以独立指挥,完成后通知大CPU即可,SCSI的硬盘转速也很厉害 15K转,10K转;并行
	- SAS:串行附加存储,SCSI级别的设备
- 当很多用户同时下载文件,且文件各不相同的时候,硬盘就到达了工作能力的上限,这时候我们就可以想办法,组合多个设备来同时完成一个任务;我们在主板上增加一个控制器,它不是用来连接ide,sata,scsi,而是连接另外一个设备,这个设备有特殊接口,这个接口里面能够将一个接口分为多个接口.而这些多个接口可以分别接IDE,SATA,SCSI盘;这个控制器叫做RAID控制器.
- RAID:Redundant Arrays of Inexpensive Disks:廉价冗余磁盘阵列;但是由于要增加特殊的控制器或者适配器,算下来成本并不比SLED(Single Large Expensive Disk独立大容量昂贵的磁盘,多用于工业生产)便宜多少;Inexpensive就被换成了Independent;于是,名字也就变成了独立冗余磁盘阵列.
- 条带技术: 把一个文件分成比较大的单个文件平均分到每一个RAID盘上,而不是传统的1k datablock的轮流存储.
- 根据磁盘组织方式的不同,RAID 有级别之分;RAID LEVEL,级别并不意味着性能的先进,只是表达了磁盘的组合方式不同.
- RAID组合时,不仅要考虑速度,还要考虑数据的可用性(文件损坏的可能性)
	- 磁盘镜像(mirror) 来保证数据的可用性:在每一个RAID子盘上存储同样的数据
	- 校验码:假如有4块盘;系统会把数据平均分配到3块盘上去,留出一块盘,然后存数据的三块盘的校验码放在第四块盘上;比如,第一块存1,第二块存2,第三块存3,在第四块上存的校验码就是1+2+3=6,当存数据的某一块硬盘丢失的时候我们能够推断出其的数据,也就可以找回数据.坏了两块就GG了.优势是速度和数据可用性得到提升.
- RAID级别,234目前很少用,10和01比较多:
	- 0:条带技术;性能提升,读写速度几乎提升了N倍,但是没有冗余能力(也叫容错,提供多余的来保证可用性);空间利用率n倍;至少需要2块盘
	- 1:镜像,性能表现:读性能提升;写性能下降.冗余能力有提升;空间利用率只有一半,至少需要2块盘
	- 2:
	- 3:
	- 4:校验码
	- 5:轮流做校验码盘;性能表现:读写都提升了;冗余能力:有提升.空间利用率(n-1)/n;至少需要3块盘
	- 1,0:性能表现:读写都提升了,冗余能力:有提升,空间利用率:1/2;至少需要4块盘
	- 0,1:性能表现:读写都提升了,冗余能力:有提升,空间利用率:1/2;至少需要4块盘
	- 5,0:性能表现:读写都提升了,冗余能力:有提升,空间利用率:(n-2)/n;至少需要6块盘
	- jbod:性能表现:无提升,冗余能力:无提升,空间利用率:100%;至少需要2块盘.
- 有钱的企业一般都玩镜像,但是镜像速度太慢,可以镜像条带一起玩;用数字表示:0表示条带,1表示镜像;校验码技术用5来表示;
	- 用三块盘做条带,再用三块盘来做镜像;先做条带,再做镜像,;这个组合就是RAID 0+1
		- 这个当某一个盘坏了的时候影响是全局的,因为做条带的时候元数据盘ABC,和镜像盘A',B',C'中的数据不一定完全一样,假设A盘坏了,我们换了新盘,其修复过程是先从A'B'C'中取出完整的数据,再和BC盘坐比较从而得出A盘的数据是什么.
	- 两两组合做镜像,然后再做条带.修复速度和影响范围较上面的好点.这个就是RAID1+0;这个组合如果同组的盘都坏了就GG了.
	- 校验码格式:坏处,校验码盘访问量比其他盘要大,因为任何一个盘的数据访问都要和校验码盘打交道,而它的速度决定了访问其他数据盘的快慢;也就是说校验码盘很容易成为性能瓶颈;解决方案是,让所有盘轮换作为校验码盘;这种轮流做校验码盘的模式就是RAID5.
	- 5,0技术
	- jbod:Just a bunch of disks;磁盘捆绑,把若干个小盘叠加成一个大盘.比如一个500G硬盘来当数据库,数据库文件不断增长快要突破500G了,这时候还不能换盘,还盘业务就中止了;jbod不能提升性能和可用性
- RAID 早期组合IDE和SCSI,现在主要组合SATA和SAS
- SCSI总线分成两类:
	- 窄带:8个接口,适配器(initiator发起点)占一个,还有7个target;而SCSI硬盘容量不大,7个盘未必够用,后来人们又改进了,每个target还可以再分成N个接口,再接N个硬盘进行扩展;在发送数据包的时候要在数据包前面加一个控制信息,指定存在哪个target,哪个盘上,这个控制信息就叫head,首部报文.而每个盘都有自己的标记LUN,logic unit number逻辑单元号码,
	- 宽带:16个接口,适配器(initiator发起点)占一个,还有15个target

##### RAID的实现

###### 硬件RAID;公司里基本上都是这种
- 在服务器上有一个RAID控制芯片用线缆链接到外部存储系统,外部存储系统上有若干块硬盘
- 服务器上的RAID控制芯片连接到SATA接口,然后我们通过BIOS配置启用这个芯片.
- 很可能有些独特的服务器厂商提供的RAID芯片操作系统不能识别,安装过程中必须要额外提供驱动程序.

###### 软件RAID
- Linux内核中有个多磁盘(multi disks)模块;我们可以用md模拟一个RAID,也叫逻辑RAID.
- 逻辑RAID:在设备中表现为 /dev/md\#,注意这个\＃不代表RAID级别,只是表示不同的设备的.
- RAID模式下,磁盘必须要标记为内核可识别的类型:fd;万一系统崩溃了,就特别麻烦,所以一般不推荐使用软RAID.
- 软件RAID需要有md模块和命令mdadm
- mdadm:将任何块设备做成RAID;是一个模式化的命令:
	- 模式
		- -C,--create 创建模式
			- 专用选项:
				- -l:级别
				- -n \#:设备个数
				- -a {yes|no}:是否自动为其创建设备文件;后面要跟上yes|no
				- -c:CHUNK大小,数据块大小必须是2的n次方,默认是64KB
				- -x \#:指定空闲盘个数 注意,-x后面的个数+-n后面的个数必须和 命令最后接的硬盘数是一致的.
		- 管理模式
			- --add
			- -f,--fail,--set-faulty,模拟磁盘损坏 
				- 使用方法: mdadm /dev/md\# --fail /dev/sd7
			- --remove
		- -F,--follow,--monitor 监控模式
		- -G,--grow 增长模式
		- -A,--assemble 装配模式
		- -D,--detail 可以查看指定RAID设备的详细信息
		- -S,--stop 停用阵列
		- -D --scan
- 创建2G的RAID0:

    ```
    //1. 先创建两个1G的新分区
    fdisk /dev/sda
    n	//创建新分区
    t	//指定新分区的类型,L可以查看,我们选择fd
    //2. 创建RAIDO 
    [root@ZhumaTech ~]# mdadm -C /dev/md0 -a yes -l 0 -n 2 /dev/sda{5,6}
    [root@ZhumaTech ~]# cat /proc/mdstat	//显示当前系统上所有处于启用状态的RAID设备
    //3. 格式化RAID,写入文件系统
    [root@ZhumaTech ~]# mke2fs -j /dev/md0
    //4.查看磁盘分区,就可以看见md0了
    [root@ZhumaTech ~]# fdisk -l 
    Disk /dev/md0: 2165 MB, 2165309440 bytes
    2 heads, 4 sectors/track, 528640 cylinders
    Units = cylinders of 8 * 512 = 4096 bytes
    Sector size (logical/physical): 512 bytes / 512 bytes
    I/O size (minimum/optimal): 524288 bytes / 1048576 bytes
    Disk identifier: 0x00000000
    //5.挂载md0
    [root@ZhumaTech ~]# mount /dev/md0 /mnt
    ```	 
    
- 在管理模式下,可以直接模拟磁盘损坏
	- -f,--fail,--set-faulty,模拟磁盘损坏 
	- 使用方法: mdadm /dev/md\# --fail /dev/sd7

	```
	[root@ZhumaTech cdrom]# mdadm /dev/md1 -f /dev/sda8
		mdadm: set /dev/sda8 faulty in /dev/md1
	[root@ZhumaTech cdrom]# mdadm -D /dev/md1
	/dev/md1:
	        Version : 1.2
	  Creation Time : Wed Mar 29 16:52:32 2017
	     Raid Level : raid1
	     Array Size : 1059200 (1034.55 MiB 1084.62 MB)
	  Used Dev Size : 1059200 (1034.55 MiB 1084.62 MB)
	   Raid Devices : 2
	  Total Devices : 2
	    Persistence : Superblock is persistent
	
	    Update Time : Wed Mar 29 16:55:51 2017
	          State : clean, degraded 
	 Active Devices : 1
	Working Devices : 1
	 Failed Devices : 1
	  Spare Devices : 0

           Name : ZhumaTech:1  (local to host ZhumaTech)
           UUID : 6eb3ec1a:e04b907c:30b82221:225fc5ac
         Events : 21

    Number   Major   Minor   RaidDevice State
       0       8        7        0      active sync   /dev/sda7
       1       0        0        1      removed

       1       8        8        -      faulty   /dev/sda8
	```
	
	- --remove选项可以移除磁盘
	
	```
	[root@ZhumaTech cdrom]# mdadm /dev/md1 --remove /dev/sda8
	mdadm: hot removed /dev/sda8 from /dev/md1
	```
	
	- --add 选项可以添加磁盘到RAID阵列
	
	```
	[root@ZhumaTech cdrom]# mdadm /dev/md1 --add /dev/sda9
	mdadm: added /dev/sda9
	```
	
- 停止阵列: mdadm -S /dev/md1

  ```
	[root@ZhumaTech cdrom]# mdadm -S /dev/md1  
	mdadm: stopped /dev/md1
	```
	
- 装配阵列: mdadm -A /dev/md1 /dev/sda7 /dev/sda8

	```
	[root@ZhumaTech md]# mdadm -A /dev/md1 /dev/sda{7,8}
	mdadm: /dev/md1 has been started with 1 drive (out of 2).
	```
	
- 引入新命令watch:周期性地执行指定的命令,并将结果以全屏的方式显示到窗口比如`watch 'COMMAND'`
	- -n \#,指定周期长度,单位为秒.默认为2
- mdadm -D --scan >>/etc/mdadm.conf,mdadm.conf就是主配置文件了,以后就不用再指设备,会主动装配了.
	
	```
	[root@ZhumaTech md]# mdadm --detail --scan >>/etc/mdadm.conf
	[root@ZhumaTech md]# mdadm -S /dev/md1
	mdadm: stopped /dev/md1
	[root@ZhumaTech md]# mdadm -A /dev/md1	//就不用再指定/dev/sda{7,8}
	mdadm: /dev/md1 has been started with 1 drive (out of 2).
	```
	
- 列出linux内核总模块状态的程序:lsmod(列出模块)
- MD:Multi Devices;将多个底层的物理设备在内核中抽象出来,在/dev/下提供设备文件,然后通过这个设备访问接口来进行访问,在内核中它的所有调配工作由md这个模块来完成,进而能实现将多个物理设备组合一个所谓的逻辑设备,也有人把它叫做元设备(meta device)
- DM:Device Mapper;设备映射,提供逻辑设备的机制,也能实现多个物理设备映射成一个逻辑设备.功能比MD要强大;DM不仅能够提供RAID功能,还能提供LVM2.功能和MD功能部分重叠.
	- DM是LVM2功能实现的核心 
	- snapshot 快照:把数据定格在做快照那一瞬间;快照其实就是访问数据的另外一条路径;快照的主要作用是为了实现数据备份.
	- multipath 多路径
	- DM逻辑设备支持,动态增减
- DM能力,比如我们原有多块物理磁盘,DM可以将它们组织成一个逻辑设备,这个逻辑设备在用户看来就是一个大的设别,当将来这些磁盘都满了,我们可以增加/减少硬盘;注意,DM本身并不能实现文件系统(可以理解为扩展分区),只是一个真正意义上的物理存储融合器,并且能够向上提供一个统一界面,因此我们想要在这里面使用存储数据,我们需要创建类似于逻辑分区.底层的磁盘叫物理卷(phisycal volume);中间的DM 叫VG卷组(Volume Group)相当于扩展分区,上层的逻辑分区部分,叫逻辑卷(Logical Volume);逻辑卷有两种边界:物理边界和逻辑边界(文件系统边界),每一个逻辑卷就是一个独立的文件系统;逻辑卷可以做快照,逻辑卷及其快照卷必须在同一个卷组当中;所以在同一个卷组当中务必要留出空间给其中的某一个逻辑卷创建快照;在PV上,我们把一个物理设备做成PV以后,意味着我们要把它加进一个卷组里去,也就是扩展某一个卷组,只要把PV放进卷组当中,就意味着卷组把这个PV所提供的存储能力划分成一个一个的存储单元(类似RAID的chunk);这些存储单元在这个PV加入到卷组中后,会被事先划分成一个一个块,这个块叫PE(物理盘区,Phisical Extend);只要物理卷加进卷组中以后,一定和卷组锁规定的PE是相同的,也就是说创建卷组的时候会指定多大的PE.因此卷组也就由一大波的PE组成;说白了,逻辑卷的创建也就是;分给一个存储空间一定量的PE;只不过到了逻辑卷的层面上就叫做Logical Extend.扩展逻辑卷的边界,就是添加PE.逻辑卷也支持镜像功能.
- 逻辑卷的实现:
	- 先准备物理卷PV:物理卷可以是磁盘,也可以是分区,还可以是RAID,只要是个块设备就可以.
##### fdisk最多只支持到15个分区;天生的限制.
##### 注意,有的系统是没有安装lvm的,我们要先yum -y install lvm2
- 因此我们要管理的层次就包括管理物理卷,管理卷组,管理逻辑卷;因此管理卷的操作就有;:
	- pv:物理卷:设备类型是8e;RAID是fd
		- pvcreate
		- pvremove:抹掉PV的数据
		
			```
			[root@ZhumaTech ~]# pvremove /dev/sda10 
			 Labels on physical volume "/dev/sda10" successfully wiped
			[root@ZhumaTech ~]# pvs	// /dev/sda10上的数据就全部被抹除了
			  PV         VG   Fmt  Attr PSize PFree
			  /dev/sda9  myvg lvm2 a--  7.01g 7.01g 		
 			```
 			
			//下面vgreduce的例子中,PV /dev/sda10被从myvg中移除了,我们不需要它了.就可以使用pvremove
			
			```
			- pvscan:扫描当前系统上一共有多少个PV;比方说我们把当前主机上的PV拆下来,将来放到其他主机上,能够被其他主机识别,就需要先用pvscan扫描一下PV上的元数据把他识别成pv类型
			- pvdisplay: 查看PV的详细信息,pvdisplay /dev/sda9,是只查看PV /dev/sda9的详细信息
			- pvmove:把存了数据的pe转移到其他物理pv上
			
			```
			//创建10G的pv(我们创建7G+3G;再来5G备用)
			[root@ZhumaTech ~]# fdisk /dev/sda

			WARNING: DOS-compatible mode is deprecated. It's strongly recommended to
			         switch off the mode (command 'c') and change display units to
			         sectors (command 'u').
			
			Command (m for help): n
			First cylinder (64550-121601, default 64550): 
			Using default value 64550
			Last cylinder, +cylinders or +size{K,M,G} (64550-121601, default 121601): +7G
			
			Command (m for help): n
			First cylinder (65465-121601, default 65465): 
			Using default value 65465
			Last cylinder, +cylinders or +size{K,M,G} (65465-121601, default 121601): +3G
			
			Command (m for help): n
			First cylinder (65858-121601, default 65858): 
			Using default value 65858
			Last cylinder, +cylinders or +size{K,M,G} (65858-121601, default 121601): +5G
			// 更改设备类型为8e;RAID底层设备类型为fd; 9,10,11都一样的操作
			Command (m for help): t
			Partition number (1-11): 9(可以用L查看)
			
			Hex code (type L to list codes): 8e
			Changed system type of partition 9 to 8e (Linux LVM)
			// 保存并partprobe /dev/sda;这里就不操作了
			// 查看分区情况
			[root@ZhumaTech ~]# cat /proc/partitions 
			major minor  #blocks  name
			
			   7        0    4363264 loop0
			   8        0  976762584 sda
			   8        1     204800 sda1
			   8        2  512000000 sda2
			   8        3    2048000 sda3
			   8        4          1 sda4
			   8        5    1055117 sda5
			   8        6    1060258 sda6
			   8        7    1060258 sda7
			   8        8    1060258 sda8
			   8        9    7349706 sda9
			   8       10    3156741 sda10
			   8       11    5253223 sda11
			   9        0    2114560 md0
			   9        1    1059200 md1
			// 有了设备,我们就创建PV. 注意,有的系统是没有安装lvm的,我们要先yum -y install lvm2
			[root@ZhumaTech ~]# pvcreate /dev/sda{9,10}
			Physical volume "/dev/sda9" successfully created
			Physical volume "/dev/sda10" successfully created
			[root@ZhumaTech ~]# pvs	//查看当前系统的PV,pvs查看的是简单信息,更详细的信息可以用pvdisplay
			PV         VG   Fmt  Attr PSize PFree
			/dev/sda10      lvm2 a--  3.01g 3.01g
			/dev/sda9       lvm2 a--  7.01g 7.01g
			[root@ZhumaTech ~]# pvdisplay	//注意此时的PE是没有大小的,在创建成VG卷组以后,就有了;pvdisplay /dev/sda9,是只查看PV /dev/sda9的详细信息
			"/dev/sda9" is a new physical volume of "7.01 GiB"
			--- NEW Physical volume ---
			PV Name               /dev/sda9
			VG Name               
			PV Size               7.01 GiB
			Allocatable           NO
			PE Size               0   
			Total PE              0
			Free PE               0
			Allocated PE          0
			PV UUID               6RvCT1-G3Ti-guWn-rphL-If88-sunE-qljbTw
			"/dev/sda10" is a new physical volume of "3.01 GiB"
			--- NEW Physical volume ---
			PV Name               /dev/sda10
			VG Name               
			PV Size               3.01 GiB
			Allocatable           NO
			PE Size               0   
			Total PE              0
			Free PE               0
			Allocated PE          0
			PV UUID               2mf782-WGnO-KcB4-CVDf-6v3t-8DvU-nn5chA
			// 至此,PV创建完成,接下来就是VG相关操作了
			```
			
	- vg:卷组,命令和PV命令相似
		- vgcreate; 用法: vgcreate VGNAME /dev/sda9 /dev/sda10
			- -s: 此选项可以指定物理盘区(PE)的大小;默认是4M
			
			```
			[root@ZhumaTech ~]# vgcreate myvg /dev/sda9 /dev/sda10
	 		Volume group "myvg" successfully created	//此时再用pvdisplay就可以看到PE大小了
			[root@ZhumaTech ~]# vgs
			  VG   #PV #LV #SN Attr   VSize  VFree 
			  myvg   2   0   0 wz--n- 10.02g 10.02g
			
			```
			
		- vgremove: 移除VG 用法为 vgremove VGNAME
		- vgscan
		- vgdisplay
		
			```
			[root@ZhumaTech ~]# vgdisplay myvg
			  --- Volume group ---
			  VG Name               myvg
			  System ID             
			  Format                lvm2
			  Metadata Areas        2
			  Metadata Sequence No  1
			  VG Access             read/write
			  VG Status             resizable
			  MAX LV                0
			  Cur LV                0
			  Open LV               0
			  Max PV                0
			  Cur PV                2
			  Act PV                2
			  VG Size               10.02 GiB
			  PE Size               4.00 MiB
			  Total PE              2564
			  Alloc PE / Size       0 / 0   
			  Free  PE / Size       2564 / 10.02 GiB
			  VG UUID               FTaHdE-Te42-i1YW-5TrR-608l-16lx-zefYjw		
			```
			
		- vgmove
		- vgreduce: 我们通过pvs发现我们的myvg卷组里有两个pv,1个7G 一个3G ,我们发现一个7G 就够了,决定移除3G的;缩减VG的过程就是拿掉PV的过程;所以一定要注意在缩减VG前一定要把被移除的PV上的数据移走(pvmove);用法:vgreduce VGNAME /dev/sda10
		
			```
			[root@ZhumaTech ~]# pvmove /dev/sda10	//我们要移除3G的PV /dev/sda10,所以就要先把它上面的数据移到卷组的其他PV上,这个操作就是.
			No data to move for myvg
			[root@ZhumaTech ~]# vgreduce myvg /dev/sda10	//移除成功
			  Removed "/dev/sda10" from volume group "myvg"  
			[root@ZhumaTech ~]# vgs	//vg容量还剩7G
			  VG   #PV #LV #SN Attr   VSize VFree
			  myvg   1   0   0 wz--n- 7.01g 7.01g
			[root@ZhumaTech ~]# pvs	//myvg中还剩下一个PV,就是7G的/dev/sda9
			  PV         VG   Fmt  Attr PSize PFree
			  /dev/sda10      lvm2 a--  3.01g 3.01g
			  /dev/sda9  myvg lvm2 a--  7.01g 7.01g	
			```
			
		- vgextend
		
			```
			//同样假如我想把那个5G的PV /dev/sda11扩展到我的卷组 myvg
			[root@ZhumaTech ~]# pvcreate /dev/sda11		//先把/dev/sda11 的文件类型设定成pv
	    	Physical volume "/dev/sda11" successfully created
	    	[root@ZhumaTech ~]# vgextend myvg /dev/sda11
			  Volume group "myvg" successfully extended
			[root@ZhumaTech ~]# vgs
			  VG   #PV #LV #SN Attr   VSize  VFree 
			  myvg   2   0   0 wz--n- 12.02g 12.02g
			```
			
	- lv:逻辑卷
		- lvcreate -n LVNAME -L #G VGNAME
			- -n 指定名字
			- -L 指定空间大小(-l 是指定占用 )
		- lvextend
		- lvreduce
		- lvresize
		- lvs
		- lvdisplay
		
			```
			[root@ZhumaTech ~]# lvcreate -L 50M -n testlv myvg
			  Rounding up size to full physical extent 52.00 MiB
			  Logical volume "testlv" created
			[root@ZhumaTech ~]# lvs
			  LV     VG   Attr       LSize  Pool Origin Data%  Move Log Cpy%Sync Convert
			  testlv myvg -wi-a----- 52.00m                                             
			[root@ZhumaTech ~]# lvdisplay
			  --- Logical volume ---
			  LV Path                /dev/myvg/testlv
			  LV Name                testlv
			  VG Name                myvg
			  LV UUID                N6L2fa-lrOi-CRls-HjeD-R9mI-73PZ-IMyl5b
			  LV Write Access        read/write
			  LV Creation host, time ZhumaTech, 2017-04-05 13:55:16 +0800
			  LV Status              available
			  # open                 0
			  LV Size                52.00 MiB
			  Current LE             13
			  Segments               1
			  Allocation             inherit
			  Read ahead sectors     auto
			  - currently set to     256
			  Block device           253:0
			   
			[root@ZhumaTech ~]# lvdisplay /dev/myvg/testlv 
			  --- Logical volume ---
			  LV Path                /dev/myvg/testlv
			  LV Name                testlv
			  VG Name                myvg
			  LV UUID                N6L2fa-lrOi-CRls-HjeD-R9mI-73PZ-IMyl5b
			  LV Write Access        read/write
			  LV Creation host, time ZhumaTech, 2017-04-05 13:55:16 +0800
			  LV Status              available
			  # open                 0
			  LV Size                52.00 MiB
			  Current LE             13
			  Segments               1
			  Allocation             inherit
			  Read ahead sectors     auto
			  - currently set to     256
			  Block device           253:0
			[root@ZhumaTech ~]# mke2fs -j /dev/myvg/testlv //写入文件系统
			mke2fs 1.41.12 (17-May-2010)
			Filesystem label=
			OS type: Linux
			Block size=1024 (log=0)
			Fragment size=1024 (log=0)
			Stride=0 blocks, Stripe width=0 blocks
			13328 inodes, 53248 blocks
			2662 blocks (5.00%) reserved for the super user
			First data block=1
			Maximum filesystem blocks=54525952
			7 block groups
			8192 blocks per group, 8192 fragments per group
			1904 inodes per group
			Superblock backups stored on blocks: 
			        8193, 24577, 40961
			
			Writing inode tables: done                            
			Creating journal (4096 blocks): done
			Writing superblocks and filesystem accounting information: done
			
			This filesystem will be automatically checked every 34 mounts or
			180 days, whichever comes first.  Use tune2fs -c or -i to override.
			[root@ZhumaTech ~]# mount /dev/myvg/testlv /mnt //把testlv挂载到/mnt
			[root@ZhumaTech ~]# ls /mnt		//挂载成功了
			lost+found
			[root@ZhumaTech ~]# mount	//查看挂载情况,可以发现挂载的其实是/dev/mapper/myvg-testlv; /dev/myvg/testlv 是它的连接文件
			/dev/sda2 on / type ext4 (rw)
			proc on /proc type proc (rw)
			sysfs on /sys type sysfs (rw)
			devpts on /dev/pts type devpts (rw,gid=5,mode=620)
			tmpfs on /dev/shm type tmpfs (rw,rootcontext="system_u:object_r:tmpfs_t:s0")
			/dev/sda1 on /boot type ext4 (rw)
			/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso on /mnt/cdrom type iso9660 (rw,loop=/dev/loop0)
			none on /proc/sys/fs/binfmt_misc type binfmt_misc (rw)
			/dev/mapper/myvg-testlv on /mnt type ext3 (rw)  	
			```
			
	- lvremove	//处于挂载中的lv是没法移除的;所以要先取消挂载 再移除
	
		```
		[root@ZhumaTech ~]# umount /dev/myvg/testlv 
		[root@ZhumaTech ~]# lvremove /dev/myvg/testlv 
		Do you really want to remove active logical volume testlv? [y/n]: y
		  Logical volume "testlv" successfully removed
		```
		
#### LV高级进阶
##### 扩展逻辑卷
###### 创建分区的过程就是创建物理边界的过程,然后在物理边界内部创建文件系统;而文件系统是位于文件系统边界内的,而这个文件系统边界也被成为逻辑边界;所以到底能存储多少数据既取决于物理边界有多大,也取决于逻辑边界有多大;实际上逻辑边界是紧靠在物理边界上创建的.我们要去扩展一个分区,应该先扩展物理边界,然后再扩展逻辑边界,如果只扩展物理边界,逻辑边界还停留在之前的大小,那么扩展是无意义的;反之,缩减则应先缩减逻辑边界,再缩减物理边界
- 扩展逻辑卷物理边界的命令是lvextend
	- -L [+]\# :举例吧,假设原来的容量是2G 要扩展到5G:lvextend -L +3G /LVNAME(扩展了3G) 等同于 lvextend -L 5G /LVNAME(扩展到5G)  
	- 在扩展前务必保证vg的容量是够扩展的.
- 扩展文件系统的边界命令是resize2fs(ext2,ext3文件系统),resize2fs /LVNAME 5G
	- -p 不用指定大小,能扩展到多大就扩展到多大.
	
	```
	//创建一个2G的lv,并将之扩展到5G
	[root@ZhumaTech ~]# lvcreate -L 2G -n testlv myvg	//在myvg中创建一个2G的名为testlv的逻辑卷
	  Logical volume "testlv" created
	[root@ZhumaTech ~]# mke2fs -j /dev/myvg/testlv	//写入文件系统,文件系统为ext3
	mke2fs 1.41.12 (17-May-2010)
	Filesystem label=
	OS type: Linux
	Block size=4096 (log=2)
	Fragment size=4096 (log=2)
	Stride=0 blocks, Stripe width=0 blocks
	131072 inodes, 524288 blocks
	26214 blocks (5.00%) reserved for the super user
	First data block=0
	Maximum filesystem blocks=536870912
	16 block groups
	32768 blocks per group, 32768 fragments per group
	8192 inodes per group
	Superblock backups stored on blocks: 
	        32768, 98304, 163840, 229376, 294912
	
	Writing inode tables: done                            
	Creating journal (16384 blocks): done
	Writing superblocks and filesystem accounting information: done
	
	This filesystem will be automatically checked every 38 mounts or
	180 days, whichever comes first.  Use tune2fs -c or -i to override.
	[root@ZhumaTech ~]# mkdir /users	//创建目录/uers
	[root@ZhumaTech ~]# mount /dev/myvg/testlv /users	//把testlv挂载到/users上
	[root@ZhumaTech ~]# mount	//查看挂载的情况
	/dev/sda2 on / type ext4 (rw)
	proc on /proc type proc (rw)
	sysfs on /sys type sysfs (rw)
	devpts on /dev/pts type devpts (rw,gid=5,mode=620)
	tmpfs on /dev/shm type tmpfs (rw,rootcontext="system_u:object_r:tmpfs_t:s0")
	/dev/sda1 on /boot type ext4 (rw)
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso on /mnt/cdrom type iso9660 (rw,loop=/dev/loop0)
	none on /proc/sys/fs/binfmt_misc type binfmt_misc (rw)
	/dev/mapper/myvg-testlv on /users type ext3 (rw)
	[root@ZhumaTech ~]# cd /users
	[root@ZhumaTech users]# ls
	lost+found
	[root@ZhumaTech users]# cp /etc/inittab .
	[root@ZhumaTech users]# ls
	inittab  lost+found
	[root@ZhumaTech users]# df -lh	//查看testlv的容量大小
	Filesystem                                 Size  Used Avail Use% Mounted on
	/dev/sda2                                  481G   12G  445G   3% /
	tmpfs                                      937M     0  937M   0% /dev/shm
	/dev/sda1                                  194M   27M  158M  15% /boot
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso  4.2G  4.2G     0 100% /mnt/cdrom
	/dev/mapper/myvg-testlv                    2.0G   68M  1.9G   4% /users
	[root@ZhumaTech users]# lvextend -L 5G /dev/myvg/testlv 	//将testlv扩展到5G
	  Extending logical volume testlv to 5.00 GiB
	  Logical volume testlv successfully resized
	[root@ZhumaTech users]# df -lh	//这时候查看发现在文件系统中/dev/myvg/testlv还是2G的容量,那是因为我们还没有扩展文件系统边界
	Filesystem                                 Size  Used Avail Use% Mounted on
	/dev/sda2                                  481G   12G  445G   3% /
	tmpfs                                      937M     0  937M   0% /dev/shm
	/dev/sda1                                  194M   27M  158M  15% /boot
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso  4.2G  4.2G     0 100% /mnt/cdrom
	/dev/mapper/myvg-testlv                    2.0G   68M  1.9G   4% /users
	[root@ZhumaTech users]# lvs	//但通过lvs可以发现lv的大小在lv管理中已经显示为5G了.
	  LV     VG   Attr       LSize Pool Origin Data%  Move Log Cpy%Sync Convert
	  testlv myvg -wi-ao---- 5.00g                                             
	[root@ZhumaTech users]# resize2fs -p /dev/myvg/testlv //此时,我们来扩展文件系统的边界,用-p选项来做最大的扩容
	resize2fs 1.41.12 (17-May-2010)
	Filesystem at /dev/myvg/testlv is mounted on /users; on-line resizing required
	old desc_blocks = 1, new_desc_blocks = 1
	Performing an on-line resize of /dev/myvg/testlv to 1310720 (4k) blocks.
	The filesystem on /dev/myvg/testlv is now 1310720 blocks long.
	
	[root@ZhumaTech users]# df -lh	// 此时再查看发现/dev/myvg/testlv 的容量变成了5G
	Filesystem                                 Size  Used Avail Use% Mounted on
	/dev/sda2                                  481G   12G  445G   3% /
	tmpfs                                      937M     0  937M   0% /dev/shm
	/dev/sda1                                  194M   27M  158M  15% /boot
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso  4.2G  4.2G     0 100% /mnt/cdrom
	/dev/mapper/myvg-testlv                    5.0G   69M  4.7G   2% /users
	[root@ZhumaTech users]# ls	//之前复制的inittab还是存在的.
	inittab  lost+found
	```
	
- 扩展一个逻辑卷,并不影响原有文件的使用,并且就算文件系统还在挂载中,也可以直接扩展.非常安全
##### 缩减逻辑卷
- 注意缩减的时候,缩减文件系统边界的时候resize2fs的用法为: resize2fs /PATHTOPV 3G
	1. ___风险非常大,很有可能造成数据丢失,而且,千万不要在线缩减;得先卸载___
	2. ___确保缩减后的空间大小依然能储存原有的所有数据___
	3. ___在缩减之前应强行检查文件,以确保文件系统处于一致性状态:e2fsck -f /dev/myvg/testlv___
- 执行完上面3步以后,再执行resize2fs /PATHTOPV 3G	//将PV缩减到3G
- 然后lvreduce -L [-]\# /PATHTOLV
- 重新挂载

	```
	[root@ZhumaTech users]# cd	
	[root@ZhumaTech ~]# df -lh	//查看一下testvg大小
	Filesystem                                 Size  Used Avail Use% Mounted on
	/dev/sda2                                  481G   12G  445G   3% /
	tmpfs                                      937M     0  937M   0% /dev/shm
	/dev/sda1                                  194M   27M  158M  15% /boot
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso  4.2G  4.2G     0 100% /mnt/cdrom
	/dev/mapper/myvg-testlv                    5.0G   69M  4.7G   2% /users
	[root@ZhumaTech ~]# umount /users	//卸掉/dev/myvg/testlv的挂载
	[root@ZhumaTech ~]# mount
	/dev/sda2 on / type ext4 (rw)
	proc on /proc type proc (rw)
	sysfs on /sys type sysfs (rw)
	devpts on /dev/pts type devpts (rw,gid=5,mode=620)
	tmpfs on /dev/shm type tmpfs (rw,rootcontext="system_u:object_r:tmpfs_t:s0")
	/dev/sda1 on /boot type ext4 (rw)
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso on /mnt/cdrom type iso9660 (rw,loop=/dev/loop0)
	none on /proc/sys/fs/binfmt_misc type binfmt_misc (rw)
	[root@ZhumaTech ~]# e2fsck -f /dev/myvg/testlv	//强行检测文件系统
	e2fsck 1.41.12 (17-May-2010)
	Pass 1: Checking inodes, blocks, and sizes
	Pass 2: Checking directory structure
	Pass 3: Checking directory connectivity
	Pass 4: Checking reference counts
	Pass 5: Checking group summary information
	/dev/myvg/testlv: 12/327680 files (0.0% non-contiguous), 38000/1310720 blocks
	[root@ZhumaTech ~]# resize2fs /dev/myvg/testlv 3G	//将testlv的文件系统边界缩减到3G
	resize2fs 1.41.12 (17-May-2010)
	Resizing the filesystem on /dev/myvg/testlv to 786432 (4k) blocks.
	The filesystem on /dev/myvg/testlv is now 786432 blocks long.
	
	[root@ZhumaTech ~]# lvreduce -L 3G /dev/myvg/testlv 	//缩减testlv的物理边界
	  WARNING: Reducing active logical volume to 3.00 GiB
	  THIS MAY DESTROY YOUR DATA (filesystem etc.)
	Do you really want to reduce testlv? [y/n]: y
	  Reducing logical volume testlv to 3.00 GiB
	  Logical volume testlv successfully resized
	[root@ZhumaTech ~]# mount /dev/myvg/testlv /users	//重新挂载
	[root@ZhumaTech ~]# mount	//查看挂载情况
	/dev/sda2 on / type ext4 (rw)
	proc on /proc type proc (rw)
	sysfs on /sys type sysfs (rw)
	devpts on /dev/pts type devpts (rw,gid=5,mode=620)
	tmpfs on /dev/shm type tmpfs (rw,rootcontext="system_u:object_r:tmpfs_t:s0")
	/dev/sda1 on /boot type ext4 (rw)
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso on /mnt/cdrom type iso9660 (rw,loop=/dev/loop0)
	none on /proc/sys/fs/binfmt_misc type binfmt_misc (rw)
	/dev/mapper/myvg-testlv on /users type ext3 (rw)
	[root@ZhumaTech ~]# df -lh	//查看testlv的大小
	Filesystem                                 Size  Used Avail Use% Mounted on
	/dev/sda2                                  481G   12G  445G   3% /
	tmpfs                                      937M     0  937M   0% /dev/shm
	/dev/sda1                                  194M   27M  158M  15% /boot
	/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso  4.2G  4.2G     0 100% /mnt/cdrom
	/dev/mapper/myvg-testlv                    3.0G   68M  2.8G   3% /users
	[root@ZhumaTech ~]# cd /users
	[root@ZhumaTech users]# cat inittab 	//查看里面的原来的文件是否被损坏
	```
	
##### 快照卷
- 创建快照卷的命令也是lvcreate;lvcreate -L \# -n SLV_NAME -s -p r /PATHTOLV
	- -s snapshot; 表示创建快着卷
	- -p r|w; Permission
- 注意点:
	1. 生命周期为整个数据访问时长(下面的例子中也就是用来备份数据的),在这段时长内,数据的增长量不能超出快照卷大小;就需要自己估计,安全做法:快照卷和原卷一样大
	2. 快照卷应该是只读的;
	3. 跟原卷在同一卷组内.
	4. 可以在线创建
	
	```
	[root@ZhumaTech users]# lvcreate -L 50M -n testlv_snap -s -p r /dev/myvg/testlv 
	  Rounding up size to full physical extent 52.00 MiB
	  Logical volume "testlv_snap" created
	[root@ZhumaTech users]# lvs
	  LV          VG   Attr       LSize  Pool Origin Data%  Move Log Cpy%Sync Convert
	  testlv      myvg owi-aos---  3.00g                                             
	  testlv_snap myvg sri-a-s--- 52.00m      testlv   0.02                          
	[root@ZhumaTech users]# mount /dev/myvg/testlv
	testlv       testlv_snap  
	[root@ZhumaTech users]# mount /dev/myvg/testlv_snap /mnt/cdrom/
	CentOS_BuildTag                RELEASE-NOTES-en-US.html
	.discinfo                      repodata/
	EFI/                           RPM-GPG-KEY-CentOS-6
	EULA                           RPM-GPG-KEY-CentOS-Debug-6
	GPL                            RPM-GPG-KEY-CentOS-Security-6
	images/                        RPM-GPG-KEY-CentOS-Testing-6
	isolinux/                      TRANS.TBL
	Packages/                      .treeinfo
	[root@ZhumaTech users]# mount /dev/myvg/testlv_snap /mnt/
	mount: block device /dev/mapper/myvg-testlv_snap is write-protected, mounting read-only
	[root@ZhumaTech users]# cd /mnt
	[root@ZhumaTech mnt]# ls
	inittab  lost+found
	//然后可以压缩 或者拷贝出来,这样这个快照卷的生命周期就结束了.
	[root@ZhumaTech /]# umount /mnt
	[root@ZhumaTech /]# lvremove /dev/myvg/testlv_snap 
	Do you really want to remove active logical volume testlv_snap? [y/n]: y
	  Logical volume "testlv_snap" successfully removed
	```
	
#### 脚本编程之分区格式化
#####  until循环

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
	
	```
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
	
- 通过ping 命令测试192.168.0.151到192.168.0.254之间的所有主机是否在线,如果在线,就显示"ip is up.", 其中的IP要换成真正的IP,以绿色显示,如果不在线,就显示"ip is down";其中的ip要换成真正的IP地址.切以红色显示.
	- ping;
		- -c \#;指定请求的次数
		- -W \#: 等待请求的时长,单位为秒
	- awk:报告生成工具;也是一个文本处理工具;它的原理是每次读一行,然后切割成多份,每一段都可以分别处理.依次类推
	- awk基本用法: awk 'PATTERN{ACTION}' FILE; 主要ACTIONS如下:
		- print $1: 显示第一段;注意在这命令里$0表示命令的所有字段
		
		```
		[root@ZhumaTech sh]# df -Ph | awk ' {print $1,$3}'
		Filesystem Used
		/dev/sda2 12G
		tmpfs 0
		/dev/sda1 27M
		/mnt/cdrom/CentOS-6.5-x86_64-bin-DVD1.iso 4.2G
		/dev/mapper/myvg-testlv 68M		
		```
		
		- $NF:最后一个字段;注意每行的字段数不一定相同; awk命令中的内置变量;表示NUMBER OF FIELD字段个数
		- 选项:
			- -F: 指定分隔符,默认是空格

			```
			//指定分隔符为:
			[root@ZhumaTech sh]# awk  -F: ' {print $1,$3}' /etc/passwd 
			root 0
			bin 1
			daemon 2
			adm 3
			lp 4
			sync 5
			shutdown 6
			```
			
	- sync 可以手动把内存中的文件同步到硬盘上.
#### 网络知识
##### 以太网 Ethernet,免费的;是总线;同轴线
- MAC:Media Access Control 介质访问控制
- MAC地址:标识,物理地址.也叫平面地址,通信是通过广播(喊一嗓子)
- 首部,报头,header
- CSMA/CD Carrier Sense Multi Access Collision Detection 载波侦听多路访问冲突检测 A 要发送信号前先探测线路是不是忙.边发送边侦听.是以太网核心标记
##### 环形网络,IBM专利,付费的
- 多台主机组织成环形结构,然后在整个线路中,游走着一个令牌环(tokken rim),持有令牌的主机可以发信号.
##### 新型网络
- HUB 集线器,变形的总线;主要是为了接线方便
- 当总线很长或者主机很多的时候,信号就会衰减了,然后我们就可以用设备,这设备通俗来说就是放大器.学术上称为中继器,或者中继设备.
- 总线上当主机过多,那么冲突就多,有效传输信号的时间就不多了.就可以把大网络切割成小网络,这两个小网络之间通信,我们就需要一个智能的隔离设备,用来保证小网络和大网络之间通信的切换.这个设备就叫网桥.注意两个小网络里的机器不能与两外的小网里的机器同名;否则信号不能跨网传输.
- 网桥设备有很多接口,每个接口只接一台主机;某种意义上来说,网桥就是交换机;本地通信依赖于广播
- 半双工模式: 双方都能向对方发送信号,在同一时刻只能单向发送,因为线被信号占用了
- 全双工: 双绞线:8根,只有两根有用,绿橙蓝棕;交换机设备. 交换机不能隔离广播,只能隔离冲突
- 冲突域:彼此能争用信道的范围.
- IP地址:也叫逻辑地址;每个主机都有一个.逻辑地址对本地通信并不会产生影响;小网络上最终还是通过MAC地址来传播通信信号.逻辑地址只是为了让路由器识别的;IP地址用的是点分十进制.
- 路由器: 用来识别多个交换网络的;用来识别逻辑地址.仅用来转发网络和网络之间的数据报文;不转发广播.
- 网关接口:网络关口;网关接口也有MAC地址.
- 地址解析:先在本地通过广播来确认逻辑地址对应的MAC地址.ARP: Address Resolution Protocol 
- 反向地址解析: RARP Reverse Address Resolution Protocol
- 子网掩码:主要目的用来判定整个地址哪一部分是表示网络,那一部分是用来表示主机.根据IP地址来取网络地址;IP地址与掩码相与一下.来判断是否属于本地网络(1与n的结果为n,0与n的结果为0)
- 端口号:第三个地址,用来识别不同的进程;主机上进程与其他主机上的进程通信.
- 规范:web服务必须使用的端口.比如服务器的80端口就是固定的web端口;对于客户端,则是随机的未使用的端口去访问.
- 监听:某个端口随时等待别人访问.监听就需要打开对应的端口;一个端口只能属于一个进程;有人访问就会打开,这也叫被动打开;那么对客户端来说,打开一个端口去访问别的主机的端口,这就叫主动打开.
- 端口和IP地址还是有关联关系的.比如某个机器有两块网卡,然后又两个IP地址,假如这个机器上开了web服务器,对应的端口都是80端口,那么别人通过访问这两个ip:80端口,就都问访问对应的web了.ip和端口绑定起来的就叫套接字socket.
- 协议分层:OSI Open System Interconnect Reference Model（开放式系统互联参考模型）;OSI模型把网络通信的工作分为7层,分别是物理层、数据链路层、网络层、传输层、会话层、表示层和应用层
	- 物理层:封装报文前导码
	- 数据链路层:封装MAC
	- 网络层:封装IP
	- 传输层:封装端口
	- 会话层:双方建立回话
	- 表示层:加密解密,是否压缩
	- 应用层:具体的应用
- TTL:time to live 生存时间,也就是一个报文转了多少圈(过多少个网关)之后就丢弃
- TCP/IP层次:
	- 网络接口层--对应OSI参考模型的物理层和数据链路层
	- 网络层--对应OSI参考模型的网络层
	- 运输层--对应OSI参考模型的运输层
	- 应用层--对应OSI参考模型的5、6、7层
- IPV4 点分十进制IP地址
	- 主机位全0: 网络地址
	- 主机位全1: 广播地址
	- 为了能够标识不同规模的网络,我们的IPV4的地址进行了分类,用来标记网络地址和主机地址的不同长度:
		- A类: 就是点分十进制表示方法当中,只有第一段表示网络地址,后面三段都表示主机地址
			- 子网掩码: 255.0.0.0
			- IP第一段: 0 000 0001 - 0 111 1111;(2^7-1)个;减1是因为8个0不能用
			- IP第一段从1-126开始,127被用于回环
			- A类可以容纳2^24个主机;因此有效地址为: 2^24-2个主机
		- B类: 就是点分十进制表示方法当中,只有前两段表示网络地址,后面两段表示主机地址
			- 子网掩码: 255.255.0.0
			- IP第一段: 10 00 0000 - 10 11 1111; 2^6共64个;加上第2段8bit就是2^14个
			- IP第一段从128 - 191
			- B类可以容纳2^16-2个主机
		- C类: 就是点分十进制表示方法当中,只有前三段表示网络地址,后面一段表示主机地址
			- 子网掩码: 255.255.255.0
			- IP第一段: 110 0 0000 - 110 1 1111; 2^5共32个,加上第2段8bits,第3段8bits 共 2^21个
			- IP第一段为: 192-223
			- C类可以容纳2^8-2个主机
		- D类:IP第一段: 111 0 0000 - 111 0 1111; 2^6共64个;加上第2段8bit就是2^14个
			- IP第一段为: 224 - 239
		- E类: 生下来的就都是E类了
	- ICANN 互联网名称与数字地址分配机构（Internet Corporation for Assigned Names and Numbers）
	- 私有地址:
		- A类:10.0.0.0/8(掩码长度) 不能在互联网上用
		- B类:172.16.0.0-172.31.0.0/16(掩码长度)个B类网
		- C类:192.168.0.0/24-192.168.255.0/24(掩码长度)
	- 路由:简单来说就是选路的;而选路的标准则是根据路由的协议.而具体下一跳(next hop)则写在路由表内;每个路由器只关注它的下一跳.
		- 路由条目:Entry
		- 在路由条目中,目标地址是一个主机的,我们叫其主机路由;目标地址是一个网络的(比如192.168.2.0),就叫做网络路由.一般在选择的时候,是以最佳匹配作为选择标准.如果目标地址是0.0.0.0表示任意主机,这种就成为缺省路由,或者默认路由.
		- 路由汇聚:让小的子网聚合成一个大的子网;也叫超网
		- 子网:就是把主机位拿出来n个当网络位.
			- 比如我在互联网上申请了一个地址201.1.2.0/24,我公司内部有10台主机,我不想让他们彼此之间互相通信,按4,6分组;所以我就得可以从最后的那个数字的8个字节中借出两位;8-2=6.主机位还剩下2^6-2=62个;借出来的两位情况如下:
				- 00 不考虑
				- 01 00 0001 - 01 11 1110;
					- 网络地址(全0):201.1.2.64 广播地址(全1):201.2.127
					- 65 - 126 
					- 子网掩码就变成了/26,因为除了前面的255.255.255.192后面还借了两位
				- 10 00 0001 - 10 11 1110;
					- 网络地址(全0):201.1.2.128 广播地址(全1):201.2.64
					- 129 - 190
				- 11 不考虑
		- 划分子网会浪费地址
	- TCP:传输控制协议 Transmission Contrlo Protocol
	- UDP: 用户数据报协议 User Datagram Protocol
	- TCP和UDP的相同之处都能支持用户标记本地进程,都可以使用端口;但是他们功能不一样:
		- Tom和Jerry要寄信,Tom把信放到当地邮局就可以了,于此同时,Natatha也可以给Jerry发信
		- 反过来,Tom和Jerry打电话,这时候Natatha就不能和Jerry通电话了.
		- TCP 有链接的协议;先确定是否能连接,然后再传输.好处:更可靠!
		- UDP 是无连接协议;只发出去能不能到,管不着.好处是:能提升效率!
		- 一般即时通信用的就是UDP,比如QQ;而传输数据可靠性高的文件则TCP更好.
#### 网络配置 ifconfig及ip命令详解
- 主机介入网络:
	- IP:
	- NETMASK
	- GATEWAY
	- HOSTNAME
	- DNS(至少需要两个,LINUX可以配置3个),第一个解析不到,第二个也肯定解析不到,因为DNS是全球性的,设置第二个DNS的原因是:当第一个不在线的时候,才会用第二个.因此我们应该把最快的DNS放在第一个.
	- 路由信息
- DHCP:Dynamic Host Configuration Protocol 动态主机配置协议,这是一种让一台DHCP主机自动为其他主机分配地址的服务.当DHCP服务器没有启动,而客户机又是通过DHCP获取地址,这时候就无法通信了.为了避免这样的情况发生,ICANN还留了网段地址169.254.X.X会随机帮客户机分配一段地址,该地址只能用于本地通信,没有网关.自动地址,随机配置.

- Linux:网络属于内核功能.加入一台主机有两个网卡,一个分配的地址是192.168.1.77,另一块是172.16.0.5,当别的用户通过192.168.1.77来ping172.16.0.5 也是能ping通的,这是因为地址属于内核,不属于网卡,只要主机发现本机有这样的地址,哪么通过那一块网卡ping都能通.
- Linux识别网络接口,每一个网络接口都有名称:
	- lo:本地回环
	- ethoX:以太网网卡
	- pppX:点对点连接
- 事实上,对系统来讲,它识别每一个硬件,是靠硬件设备的驱动程序(主设备号,次设备号,以及驱动程序);所以我们要去访问一个设备的时候,都应该通过它的设备文件,但是这样引用网卡,就特别麻烦.有很多不便,因此这些设备就有了名称的机制.
	- 在RH5上,是基于别名来定义的,就是给模块取一个名字`cat /etc/modprobe.conf`,可以看到 alias eth0 pcnet32 和 alias eth1 pcnet32两行,是通过alias定义的,机器上有两块网卡,这俩网卡都是pcnet32类型的.
	- 在RH6,则是通过udev定义的,一般是在/etc/udev/rules.d/70-persistent-net.rules中定义的
	
		```
		[root@ZhumaTech rules.d]# cat 70-persistent-net.rules 
		SUBSYSTEM=="net", ACTION=="add", DRIVERS=="?*", ATTR{address}=="20:cf:30:0b:34:9b", ATTR{type}=="1", KERNEL=="eth*", NAME="eth0"
		// 定义了网络设备,当MAC地址是"20:cf:30:0b:34:9b"的时候,在内核中是"eth*"标号的话,起名为eth0
		```
		
- ifconfig:Linux上非常古老的用来实现网络配置的命令.这个命令可以直接显示当前主机上的处于活动状态的网卡的信息
	- -a:显示所有链接,包括sit0,内部实现IPv4到IPv6的转换; 还会显示非活动状态的连接
	- ifconfig eth0:只显示eth0接口的信息
	- ifconfig eth0 IP/MASK:直接为借口配置IP地址/子网掩码,子网掩码支持两种一个是255.255.255.0;还有一种是/24这种类型的
	- ifconfig eth0 [up|down]:开启|禁用网络接口;这种配置是立即生效的
- ___ifconfig配置的地址是立即生效,但重启网络服务或主机,都失效___
- 网络服务: 
	- RHEL5:/etc/init.d/network {start|stop|restart|status}
	- RHEL6:/etc/init.d/NetworkManager {start|stop|restart|status};该脚本在集群的时候不好用,建议禁用,还是用RH5的方法.
		- 禁用的方法:停用networkmanager,并且让网卡不通过它来管理就可以了.
- 网关:route命令
	- 不带任何选项,是查看本地路由表的
	
	```
	[root@ZhumaTech ~]# route
	Kernel IP routing table
	Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
	192.168.88.0    *               255.255.255.0   U     0      0        0 eth0
	link-local      *               255.255.0.0     U     1002   0        0 eth0
	default         192.168.88.1    0.0.0.0         UG    0      0        0 eth0
	Flags: U (启用状态); G(网关路由)
	``` 
	
	- add:添加
		- -host:主机路由
		- -net:网络路由,默认是网络的; -net 0.0.0.0 表示添加默认路由
		
	```
	[root@ZhumaTech ~]# route add -net 10.0.0.0/8 gw 192.168.0.1
	//表示添加一个路由,通过192.168.0.1的网关可以到达10.0.0.0网络
	[root@ZhumaTech ~]# route add -net 10.0.0.0/8 gw 192.168.0.1
	```
	
	- del:删除 
		- -host
		- -net
		
	```
	[root@ZhumaTech ~]# route del -net 10.0.0.0/8 [gw 192.168.0.1]
	//表示删除到达10.0.0.0/8的路由,后面的[gw...]可以省略
	```
	
	- -n:numeric这个选项,以数字方式显示各主机或端口等相关信息.
- ___route配置的路由是立即生效,但重启网络服务或主机,都失效___
##### 网络配置文件
- 网络配置文件: /etc/sysconfig/network
- 网络接口配置文件: /etc/sysconfig/network-scripts/ifcfg-ethX

    ```
    DEVICE=:关联的设备名,要与文件名ifcfg-后面的一致
    BOOTPROTO={static|none|dhcp|bootp}:引导协议,要使用静态地址使用static或none都可以,dhcp表示使用dhcp服务器获取地址.bootp是dhcp前身.
    //下面为手动指定地址
    IPADDR=: IP地址 	//必须项
    NETMASK=: 子网掩码	//必须项
    GATEWAY=: 设定默认网关
    ONBOOT=: 开机时是否自动激活此网络接口
    HWADDR=: 硬件地址,要与硬件中的地址保持一致,可省.
    USERCTL={yes|no}: 是否允许普通用户控制此接口
    PEERDNS={yes|no}:是否在BOOTPROTO为dhcp时接受由dhcp服务器指定的DNS地址
    // 不会立即生效,但重启网络服务或主机都会生效.
    ``` 
 
- 路由配置文件(永久生效):默认没有这个文件,/etc/sysconfig/network-scripts/route-ethX
	- 添加格式1: DESTINATION via NEXTHOP; `192.168.10.0/24 via 10.10.10.254`; 命令中用gw,文件中用via
	- 添加格式2: 
	
	```
	ADDRESS0=目标地址
	NETMASK0=掩码
	GATEWAY0=下一跳
	```
	
- 指定DNS服务器唯一方法:编辑/etc/resolv.conf,最多可有3个DNSIP

	```
	[root@ZhumaTech ~]# vi /etc/resolv.conf
	; generated by /sbin/dhclient-script
	nameserver 8.8.8.8
	nameserver 8.8.4.4
	```
	
- 指定本地解析:
	- 编辑/etc/hosts文件
	
	```
	主机IP			主机名			主机别名
	192.168.1.100	www.baidu.com	www
	```
	
- 解析的顺序是: DNS-->/etc/hosts-->DNS
- 配置网络和主机名,/etc/sysconfig/network:
	- 命令: hostname Aphey
	- 编辑/etc/sysconfig/network; 编辑HOSTNAME=
	- NETWORKING=yes; 表示启用网络
	- 在这里也可以定义网关: GATEWAY=IP;在这里定义网关和在网络地址配置文件里定义网关的区别是,谁定义的范围小,谁的生效.
- RHEL5特有命令:
	- setup:system-config-network-tui 文本图形化界面
	- system-config-network-gui 图形化界面,只在图形化界面中使用
- ifconfig 是一个老旧的命令;现在系统中有一个iproute2的软件包.它带有一个ip命令
-  ip [ OPTIONS ] OBJECT { COMMAND | help }
	- OBJECT := { link | addr | addrlabel | route | rule | neigh | tunnel |
               maddr | mroute | monitor }
    - OPTIONS := { -V[ersion] | -s[tatistics] | -r[esolve] | -f[amily] { inet
                 inet6 | ipx | dnet | link } | -o[neline] }
    - link:配置网络接口属性
    	- show:查看网络接口的地址
    		- -s :statistics 显示统计信息
    		
    	```
		[root@ZhumaTech ~]# ip -s link show
		1: lo: <LOOPBACK,UP,LOWER_UP> mtu 16436 qdisc noqueue state UNKNOWN 
		    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
		    RX: bytes  packets  errors  dropped overrun mcast   
		    0          0        0       0       0       0      
		    TX: bytes  packets  errors  dropped carrier collsns 
		    0          0        0       0       0       0      
		2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP qlen 1000
		    link/ether 20:cf:30:0b:34:9b brd ff:ff:ff:ff:ff:ff
		    RX: bytes  packets  errors  dropped overrun mcast   
		    149235     1406     0       0       0       0      
		    TX: bytes  packets  errors  dropped carrier collsns 
		    39065      192      0       0       0       0      
    	```
    	
    	- set
    	
		```
		ip link set DEVICE { up | down | arp { on | off } |
		             promisc { on | off } |
		             allmulticast { on | off } |
		             dynamic { on | off } |
		             multicast { on | off } |
		             txqueuelen PACKETS |
		             name NEWNAME |
		             address LLADDR | broadcast LLADDR |
		             mtu MTU |
		             netns PID |
		             alias NAME |
		             vf NUM [ mac LLADDR ] [ vlan VLANID [ qos VLAN-QOS ] ] [ rate
		             TXRATE ]  }    	
		```
		
    - addr:协议地址
    	- ___一块网卡可以设置多个地址,___:
    		- eth0:0;eth0:1,...; ifconfig eth0:0 192.168.88.99
    		
    		```
    		[root@ZhumaTech ~]# ifconfig eth0:0 192.168.88.99
			[root@ZhumaTech ~]# ifconfig
			eth0      Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
			          inet addr:192.168.88.88  Bcast:192.168.88.255  Mask:255.255.255.0
			          inet6 addr: fe80::22cf:30ff:fe0b:349b/64 Scope:Link
			          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
			          RX packets:2344 errors:0 dropped:0 overruns:0 frame:0
			          TX packets:291 errors:0 dropped:0 overruns:0 carrier:0
			          collisions:0 txqueuelen:1000 
			          RX bytes:222463 (217.2 KiB)  TX bytes:57869 (56.5 KiB)
			
			eth0:0    Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
			          inet addr:192.168.88.99  Bcast:192.168.88.255  Mask:255.255.255.0
			          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
			
			lo        Link encap:Local Loopback  
			          inet addr:127.0.0.1  Mask:255.0.0.0
			          inet6 addr: ::1/128 Scope:Host
			          UP LOOPBACK RUNNING  MTU:16436  Metric:1
			          RX packets:0 errors:0 dropped:0 overruns:0 frame:0
			          TX packets:0 errors:0 dropped:0 overruns:0 carrier:0
			          collisions:0 txqueuelen:0 
			          RX bytes:0 (0.0 b)  TX bytes:0 (0.0 b)
    		```
    		
    		- 永久生效的方法:vi /etc/sysconfig/network-scripts/ifcfg-eth0:0;注意:___非主要地址不能使用dhcp动态获取___
- ip addr的用法:

    	```
		ip addr { add | del } IFADDR dev STRING
		
		       ip addr { show | flush } [ dev STRING ] [ scope SCOPE-ID ] [ to PREFIX
		               ] [ FLAG-LIST ] [ label PATTERN ]
		
		       IFADDR := PREFIX | ADDR peer PREFIX [ broadcast ADDR ] [ anycast ADDR ]
		               [ label STRING(别名) ] [ scope SCOPE-ID ]
		
		       SCOPE-ID := [ host | link | global | NUMBER ]
		
		       FLAG-LIST := [ FLAG-LIST ] FLAG
		
		       FLAG := [ permanent | dynamic | secondary | primary | tentative | dep-
		               recated ]		
    	```
    	
    - add: `ip addr add 192.168.88.77/24 dev eth0`,当eth0本来就有IP的时候,此命令添加的IP会作为eth0的第二IP,ipconfig无法查看,要通过 ip addr show来查看
    	- `ip addr add 192.168.88.66/24 dev eth0 label eth0:1`	//label 用来设定别名

    	```
		[root@ZhumaTech ~]# ip addr add 192.168.88.66/24 dev eth0 label eth0:1
		[root@ZhumaTech ~]# ip add show
		1: lo: <LOOPBACK,UP,LOWER_UP> mtu 16436 qdisc noqueue state UNKNOWN 
		    link/loopback 00:00:00:00:00:00 brd 00:00:00:00:00:00
		    inet 127.0.0.1/8 scope host lo
		    inet6 ::1/128 scope host 
		       valid_lft forever preferred_lft forever
		2: eth0: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc pfifo_fast state UP qlen 1000
		    link/ether 20:cf:30:0b:34:9b brd ff:ff:ff:ff:ff:ff
		    inet 192.168.88.88/24 brd 192.168.88.255 scope global eth0
		    inet 192.168.88.77/32 scope global eth0
		    inet 192.168.88.99/24 brd 192.168.88.255 scope global secondary eth0:0
		    inet 192.168.88.66/24 scope global secondary eth0:1
		    inet6 fe80::22cf:30ff:fe0b:349b/64 scope link 
		       valid_lft forever preferred_lft forever
		[root@ZhumaTech ~]# ifconfig //当有别名的时候可以用ifconfig 查看
		eth0      Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
		          inet addr:192.168.88.88  Bcast:192.168.88.255  Mask:255.255.255.0
		          inet6 addr: fe80::22cf:30ff:fe0b:349b/64 Scope:Link
		          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
		          RX packets:2834 errors:0 dropped:0 overruns:0 frame:0
		          TX packets:455 errors:0 dropped:0 overruns:0 carrier:0
		          collisions:0 txqueuelen:1000 
		          RX bytes:282950 (276.3 KiB)  TX bytes:85233 (83.2 KiB)
		
		eth0:0    Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
		          inet addr:192.168.88.99  Bcast:192.168.88.255  Mask:255.255.255.0
		          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
		
		eth0:1    Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
		          inet addr:192.168.88.66  Bcast:0.0.0.0  Mask:255.255.255.0
		          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
		
		lo        Link encap:Local Loopback  
		          inet addr:127.0.0.1  Mask:255.0.0.0
		          inet6 addr: ::1/128 Scope:Host
		          UP LOOPBACK RUNNING  MTU:16436  Metric:1
		          RX packets:8 errors:0 dropped:0 overruns:0 frame:0
		          TX packets:8 errors:0 dropped:0 overruns:0 carrier:0
		          collisions:0 txqueuelen:0 
		          RX bytes:672 (672.0 b)  TX bytes:672 (672.0 b)    	
    	```
    	
    - del:`ip addr del 192.168.88.66/24 dev eth0:1`
    - show: 显示 `ip addr show eth1 to 192.168.100(前缀)/24(/24后缀)`
    - flush: 清空 `ip addr flush eth1 to 192.168.100/24`
    
- route (查看man ip)
### Linux软件管理
#### 软件包管理
- 程序的组成部分
	- 二进制程序
	- 库:一个系统的库由 glibc(GNU的C语言库)+新软件自带的库文件(安装软件的时候,会自动释放到/lib或者/usr/lib里,安装的软件越多,库文件就越丰富)
	- 配置文件
	- 帮助文件
	- 额外的一些文件
- 程序的安装目录
	- /etc(配置文件),/bin,/sbin,/lib;系统启动就需要用到的程序,这些目录不能挂载额外分区,必须在跟文件系统的分区上.
	- /usr/bin,/usr/sbin,/usr/lib; 操作系统的核心功能;/usr可以单独挂载分区
	- /usr/local/bin,/usr/local/sbin,/usr/local/lib,/usr/local/etc,/usr/local/man; 通常是我们安装完操作系统后,安装的第三方软件;可以单独分区
	- /opt;早先的第三方软件安装地址 
- 开机顺序POST(通电自检)-->BIOS(找到硬盘)-->(MBR中的分区表)bootloader-->加载内核-->找根目录-->然后再找到下面的各种目录
- 软件包管理器,作用:
	- 打包二进制程序,库文件,配置文件和帮助文件成一个文件
	- 能够生成数据库,跟踪锁安装的每一个文件
- 软件包管理器的核心功能:
	- 制作软件包;
	- 安装,卸载,升级,查询校验软件
- Redhat,SUSE,Debian三个发行版的软件管理器是不同的
	- Redhat和SUSE :RPM(早先:Redhat Package Manager后来改成RPM is Package Manager);SUSE和RHEL的软件不能混用,他们的路径可能不一样
	- Debian:dpt,比RPM先出来,RPM是模仿dpt出现的.
- 依赖关系很复杂,循环依赖,于是产生了软件包管理的前端工具(RPM对应的是YUM:Yellowdog Update Modifier; dpt对应的是apt-get),前端工具依赖于后端工具(RPM,dpt);前端工具能够手动管理rmp包的依赖关系.
#### rpm命令,rpm的工作包含安装、查询、卸载、升级、校验、数据库的重建、验证数据包等工作。
- rpm:rpm会有一个对应的数据库,位置是/var/lib/rpm
- rpm命名:
	- 组成部分:一个软件包可能由1个主包和n个子包组成,如:
		- 主包: bind-9.7.1-1.i386.el5.rpm.rpm
		- 子包: bind-libs-9.7.1-1.i386.rpm.el15.rpm	 
		- 主包包名格式:name-version-release.arch.rpm
		- 子包名格式:band-major.minor.release(源码包作者)-release(二进制包制作者).arch.rpm
		- 主版本号:重大改进;次版本号:某个子功能发生重大变化,发行号:修正了部分bug,调整了一点功能
- rpm包格式:
	- 二进制格式:已经编译好了,看不到源码.
		- 包作者下载源程序,编译配置完成后,制作成rpm包.
	- 源码格式:需要自己编译.
	- rpm包是有平台版本区别的,查看平台信息可以用`uname -r`查看内核版本,可以用`uname -a`查看平台的全部信息
- rpm安装软件`rpm -i /PATH/TO/PACKAGE_FILE`
		- -h:以"\#"显示进度,每个"\#"表示2%
		- -v:显示详细过程
		- -vv:更详细的过程
		- 所以常用的安装命令是`rpm -ivh /PATH/TO/PACKAGE_FULLNAME`
		- --nodeps:忽略依赖关系;虽然可以装,但是导致软件装上也无法运行
		- --force:强制安装,可以实现重装或降级,相当于下面:
			- --replaceokgs:重新安装,替换原有的安装
			- --replacefiles:替换文件
			- --oldpackage:降级,将新版本的软件替换为旧版本的软件
		- --test:不安装软件包,简单检测和报告,是否有潜在的冲突.
- rpm查询:
	- `rpm -q PACKAGE_NAME`,后面接包名,查看指定的包是否已经安装
	- `rpm -qa`,查询已经安装的所有包
	- `rpm -qi PACKAGE_NAME`,后面接包名,查询指定包的详细说明信息
	- `rpm -ql PACKAGE_NAME`,查询指定包安装后生成的文件列表
	- `rpm -qf /path/to/somefile`,查询指定的文件是由那个rpm包安装生成的
	- `rpm -qc PACKAGE_NAME`,查询指定包安装的配置文件
	- `rpm -qd PACKAGE_NAME`,查询指定包安装的帮助文件
	- `rpm -q --scrips PACKAGE_NAME`,查询指定包中包含的脚本:
		- 一般有4类脚本:安装前,安装后,卸载前(preuninstall),卸载后(postuninstall).
	- 如果某rpm包尚未安装,我们需查询其说明信息、安装以后会生成的文件：`rpm -qpi /PATH/TO/PACKAGE_FULLNAME`
	- 如果某rpm包尚未安装,我们需查询其安装以后会生成的文件的位置：`rpm -qpl /PATH/TO/PACKAGE_FULLNAME`
- rpm升级:
	- `rpm -Uvh /PATH/TO/NEW_PACKAGE_FULLNAME`:如果装有老版本的,则升级,否则,则安装
	- `rpm -Fvh /PATH/TO/NEW_PACKAGE_FULLNAME`:如果装有老版本的,则升级,否则,则退出
- rpmbuild:创建软件包
#### yum相关知识
- rpm有个缺陷就是依赖关系.
- yum是一个C/S架构的应用,需要一台服务器来提供yum服务;即yum repository(yum仓库)
- 文件服务提供有多种方式:
	- ftp
	- web
	- FILEPATH
- yum客户端
	- 配置文件;配置文件有ftp的有web的,有本地的路径,但一定要为其指定一个对应的文件路径,这个路径说白了就是yum仓库的位置. 
	- 元素据文件:在仓库中,我们有多少个软件包,每个软件包叫什么名字,它使用什么样的文件. 生成元素据的命令是:`createrepo`
	- yum仓库中的元数据文件://repodata目录
		- primary.xml.gz:
			- 包含了当前仓库内包含的所有的RPM包的列表
			- 依赖关系
			- 每个RPM安装生成的文件列表
		- filelist.xml.gz
			- 包含了当前仓库内所有RPM包的所有文件列表;
		- other.xml.gz
			- 额外信息, RPM包的修改日志
		- repomd.xml 记录了上面三个文件的时间戳和校验和;
		- comps*.xml:RPM包的分组信息
	- 很多时候我们直接把光盘挂载起来,把挂载的目录当作repo来使用.
- yum命令可以查看命令,常用命令:
	- install 安装 `yum install PACKAGE_NAME`
		- -y:自动回答为yes
		- --nogpgcheck 偶尔用到,针对本地RPM包的,如果RPM包是从互联网上下载的,没法进行gpg检测,酒可以用这个选项.
	- remove|erase 卸载
	- clean 清理缓存
	- list {all全部|available仓库中有,尚未安装的|installed已经安装的|updates可用的升级}列出软件包
	- repolist  {all|enabled|disabled}列出可用的仓库; 默认是enabled.
	- update 升级;升级为最新的版本.
	- update-to 升级到指定版本
	- upgrade 已经弃用了;这一点和兄弟连讲法不一样
	- info 查看软件包的信息
	- provides| whatprovides: 查看制定的文件或特性由哪个包安装生成的;
	- makecache 把服务器的包信息下载到本地电脑缓存起来
- 通过配置文件来配置下面4个仓库: ftp://172.16.0.1/pub/{Server|VT|Cluster|ClusterStorage}
- 配置文件的目录:/etc/yum.conf
- yum源的目录:/etc/yum.repos.d/
- yum.repo的定义格式:

	```
	[Repo_ID]
	name=Description
	baseurl={ftp://|http://|file:///}
	enabled=(1启用|0禁用)
	gpgcheck={1|0}	//是否使用gpg机制来验证软件包来源的合法性和完整性
	gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-redhat-release	//当启用gpgcheck的时候,必须指定gpgkey
	```
	
- 自己创建yum repo

	```
	[root@ZhumaTech ~]# yum install -y createrepo	//先安装createrepo
	[root@ZhumaTech server]# mkdir -pv /yum/server	//创建RPM包的存放路径
	[root@ZhumaTech server]# cp zlib* /yum/server/	//把RPM包放到目录下
	[root@ZhumaTech ~]# vi /etc/yum.repos.d/CentOS-Media.repo	//在里面添加Repo信息; 但此时我们执行`yum repolist`的时候会报错,提示没有repomd.xml;此时我们就需要创建yum源.
	[root@ZhumaTech ~]# createrepo /yum/server
	[root@ZhumaTech ~]# yum list all	//再执行命令可以看到
	zlib.i686                                  1.2.3-29.el6                VT       
	zlib-devel.i686                            1.2.3-29.el6                VT  
	```
	
- 提示没有repomd.xml,修复就是把元数据目录下的xml文件复制到,仓库里然后再执行`createrepo /PATH/TO/DIR`即可.
### 源程序管理
- RPM安装:二进制格式; 源程序-->编译-->二进制格式;有些特性是编译时选定的,因此别人做好的二进制格式软件的特性未必是全部特性.如果编译未选定此特性,将无法使用. RPM包的版本会落后于源码包, 甚至会落后很多;这样软件老版本的漏洞就可能被黑客利用.
- 因此就出现了RPM包的定制:手动编译安装
	- 前提:编译环境,开发环境(开发库,开发工具)
	- Linux: C语言和一些汇编语言开发的; GNU:C语言开发的.
	- C: 编辑器为GCC(GNU C Complier);C++编辑器为g++; C,C++的项目管理工具:make,它能够把我们的C程序的多个不同的项目文件做成一个项目,并且把这个项目的编译过程通过一个配置文件来提供,这个配置文件就是makefile(定义了make(gcc,g++)按何种次序去编译这些源程序中的源程序);make编译C项目的时候,必须要有makefile文件,但是makefile文件并不属于程序的自身组成部分. 
	- automake,让源程序的作者对自己的程序做一个简单的定义;automake就可以帮程序生成makefile文件;但是生成的只是半成品makefile.in;也就是说,此时make还不能编译这个项目,makefile还需要进一步完善.这时候makefile.in还可以接受另外一个工具所生成的脚本和配置autoconf,autoconf的作用是为项目生成脚本的,脚本叫做configure;用来配置当前程序如何编译; 当configure指定了源程序的特性后的结果和makefile.in结合最终生成makefile文件.然后在使用make就可以工作了. make install 就是将源码包的二进制文件,配置文件,帮助文件按照configure的定义放到指定的路径去.

#### 编译安装软件包大致三步骤:
	- 前提:准备开发环境(编译环境); RHEL5最简单的就是安装"Development Tools"和"Development Libraries"; RHEL6是"Development Tools"和"Compatibility libraries(兼容库)"
    - 先tar解压缩,然后cd到解压缩后的目录里
    a. 执行./configure;常用选项:
    	- --help 获取帮助
    	- --prefix=/PATH/TO/SOMEWHERE
    	- --sysconfdir=/PATH/TO/CONFIGURE_PATH
    	- 功能:1.让用户选定编译特性; 2.检查编译环境
    b. \#执行make
    c. \#make install
    
#### 安装完成后运行程序的步骤:

a. 修改PATH环境变量,以能够识别此程序的二进制文件路径

 ```
 vi /etc/profile
 在export PATH这一行上面添加上PATH=$PATH:/PATH/TO/THE_DIR_OF_THE_BIN
 或者
 在/etc/profile.d/目录中建立一个以.sh为名称后缀的文件,在里面定义export PATH=$PATH:/PATH/TO/THE_DIR_OF_THE_BIN
 ```

b. 默认情况下,系统搜索库文件的路径/lib; /usr/lib; 要增添额外搜寻路径,需要以下方式:

- 在/etc/ld.so.conf.d/中创建以.conf为后缀名的文件, 而后把要增添的路径直接写至此文件中 ,再执行命令`# ldconfig -v`,通知系统重新搜寻库文件,\-v选项是显示重新搜寻库的过程

c. 任何一个能够向其他人输出库的源程序,都会包含头文件: /include ;头文件中包含了自己所提供的每一个库文件所包含的函数,以及函数的调用参数,参数类型等相关属性,这些属性是被其他人依赖于当前这个程序做二次开发所使用的规范式文件.所以头文件也需要输出给系统,我们自己设定的头文件路径,系统是找不着的;系统默认的是/usr/include;

- 增添头文件搜寻路径,使用链接进行: 加入我们要把/usr/local/tengine/include/ 导出到 /usr/include; 使用命令 `ln -s /usr/local/tengine/include/* /usr/include` 或者 `ln -s /usr/local/tengine/include /usr/include/tengine` 

d. man文件路径:默认安装在--prefix指定定的目录下的man目录

- 我们系统找man文件的路径也是有限的,是在/etc/man.config中添加一个MANPATH; 我们也可以通过`man -M /PATH/TO/MAN_DIR`的命令来添加新的man路径,比如`man -M /usr/local/apache/man htpasswd`

- netstat命令
	- -r: 显示路由表
	- -n: 以数字方式显示
	- -t: 建立的tcp链接
	- -u: 建立的udp链接
	- -l: listen 显示监听状态的链接,所谓监听,就是服务器启动起来等待客户端来连接的这个状态.
	- -p:  --program 显示监听套接字(端口和ip绑定起来就叫套接字)的进程的进程号和进程名
### 脚本学习,while循环
- 在while, until, for循环中一旦出发了某个 break(中断,退出循环)的条件,就会提前退出循环
	
	```
	//算出1-1000的和,且当总和大于5000的时候退出循环
	
	#!/bin/bash
	declare -i SUM=0
	
	for I in {1..1000};do
	        let SUM+=$I
	        if [  $SUM -gt 5000 ]; then
	          break
	        fi
	done
	echo $I
	echo $SUM
	```
	
- 当循环体中,出发了continue的条件时,则执行到continue这里,不管下面还有多少语句,都不再执行,而是___提前结束本轮循环,进入下一轮循环___.
	
	```
	[root@ZhumaTech sh]# vi odd.sh
	#!/bin/bash
	let SUM=0
	let I=0
	
	while [ $I -lt 100 ]; do
	        let I++
	        if [ $[$I%2] -eq 0 ]; then
	        continue
	        fi
	        let SUM+=$I
	done
	
	echo $SUM
	```

- while特殊用法1之死循环:

	```
	while :;do
	
	done
	```

	```
	// 写一个死循环,输入一个文件的路径,当文件存在,则提示文件存在,否则则提示文件不存在,输入"quit"则退出.
	[root@ZhumaTech sh]# vi showfile.sh
	#!/bin/bash
	while :;do
	        read -p "File Path" FILEPATH
	        [ $FILEPATH == 'quit' ] && break
	        if [ -e $FILEPATH]; then
	          echo "$FILEPATH exists."
	        else
	          echo "$FILEPATH doesn't exist."
	        fi      
	done
	
	echo "QUIT!!!"
	```

- while的特殊用法2之:while读取一个文件中的每一行然后分别处理:

	```
	while read LINE; do	//使用read命令去读取文件的每一行;每循环一次,读一行,并把读的那一行放到LINE变量当中

	done < /PATH/TO/SOMEFILE
	```

	```
	//比如说,每次处理/etc/passwd,如果某个用户的shell为/bin/bash,就把这个用户输出到屏幕
	[root@ZhumaTech sh]# vi showuser.sh
	#!/bin/bash
	FILE=/etc/passwd
	while read LINE; do
	        [ `echo $LINE | awk -F : '{print $7}'` == '/bin/bash' ] && echo $LINE |
	awk -F : '{print $1}'
	
	done < $FILE

	// 要求,只要显示6个用户
	[root@ZhumaTech sh]# vi showuser.sh
	#!/bin/bash
	FILE=/etc/passwd
	while read LINE; do
	        [ `echo $LINE | awk -F : '{print $7}'` == '/bin/bash' ] && echo $LINE |
	awk -F : '{print $1}' && let I++
	        [ $I -eq 6 ] && break	// 当I=6的时候,就不再循环,循环了0-5,共6次
	
	done < $FILE

	// 要求:如果用户的ID号小于600,我们就不显示这个用户
	[root@ZhumaTech sh]# vi showuser.sh 
	#!/bin/bash
	FILE=/etc/passwd
	while read LINE; do
	        [ `echo $LINE | awk -F : '{print $3}'` -le 600 ] && continue	//当id小于等于600,就不执行下面的循环体,直接进入下一个循环.
	        [ `echo $LINE | awk -F : '{print $7}'` == '/bin/bash' ] && echo $LINE | 
	awk -F : '{print $1}' && let I++
	        [ $I -eq 6 ] && break
	
	done < $FILE 
	```
- 写一个脚本,判断一个制定的bash脚本是否有语法错误,如果有错误,则提醒用户键入Q or q无视错误并退出,其他任何键可以通过vim打开这个指定的脚本;如果用户通过vim打开编辑后保存退出时仍然有错误,则重复第一步中的内容,否则就正常关闭退出.

	```
	[root@ZhumaTech sh]# vi syntax.sh 
	#!/bin/bash
	until bash -n $1 &> /dev/null; do
	        read -p "Syntax errors in this script, press [Q|q] to quit, others to ed
	it:" CHOICE
	        case $CHOICE in
	        Q|q)
	        	echo "Something is still wrong with this script,quitting" && exit 5
	        ;;
	        *)
	            vim $1
	        ;;
	        esac
	done
	```
	
### 函数(Function);其实叫功能可能更合理一点

- 代码重用

	```
	// 写一个脚本,显示一个菜单,查看磁盘,内存,交换分区的使用状况
	[root@ZhumaTech sh]# vi diskusage.sh
	#!/bin/bash
	cat << EOF
	d|D show disk usage 	//输入d|D查看磁盘使用状况
	m|M show memory usage	//输入m|M查看内存使用状况
	s|S show Swap usage		//输入s|S查看交换分区的使用状况
	EOF
	
	read -p "Your choice: " CHOICE
	
	until [ $CHOICE == 'q' -o $CHOICE == 'Q' ]; do
	
	        case $CHOICE in
	        d|D) df -lh ;;
	        m|M) free | grep "^Mem" ;;
	        s|S) free | grep "^Swap" ;;
	        *) read -p "Please input correct letter: " CHOICE && continue ;;	//让用户输入字母进入下一轮循环,亮点,可以测试
	esac
	read -p "Your choice: " CHOICE
	done
	```

- 现在我们要求,每次重新选择之前要重复显示菜单内容;诚然,我们可以在每个 read前面粘贴上菜单内容,但是这样,代码就重复了很多,这里我们就可以使用函数功能;我们只要把重复的内容定义成一个函数,需要显示这写内容的时候,调用一下这个函数就可以.
- 函数是不能独立运行的,必须被调用才行;不能作为程序的执行入口,必须被调用的时候才能执行.
- 定义函数:把本来应该独立执行的代码,封装成一个独立的功能,并且取个名字,然后要用到这段代码的时候,通过名字来调用它就可以
- 定义函数的方法
	- 第一种定义方法
		
		```
		function FUNCNAME {
			command
		}
		```

	- 第二种定义方法:

		```
		FUNCNAME() {
			command
		}
		```
- 调用函数的方法也非常简单,直接写函数名就可以;

	```
	[root@ZhumaTech sh]# vi diskusage.sh
	#!/bin/bash
	function SHOWMENU {
		cat << EOF
		d|D show disk usage 	//输入d|D查看磁盘使用状况
		m|M show memory usage	//输入m|M查看内存使用状况
		s|S show Swap usage		//输入s|S查看交换分区的使用状况
		EOF
	}
	SHOWMENU	//调用函数,此时再执行这个脚本就可以看到上面的内容了

	[root@ZhumaTech sh]# ./showmenu.sh 	//运行这个脚本,显示内容如下
        d|D show disk usage
        s|S show Swap usage
        m|M show memory usage
	```

- 自定义函数执行状态返回值 `return #(0-255)`; 当函数遇到return,就一定结束了.
- 接受参数的函数,方法和脚本接受参数的方法一样的.

	```
	[root@ZhumaTech sh]# vi twosum.sh    
	#!/bin/bash
	TWOSUM() {
	echo $[$1+$2]
	}
	
	TWOSUM 4 5

	SUM=`TWOSUM 4 5`	//将函数执行结果保存到变量SUM中
	echo $SUM			//输出$SUM
	```

- 案例:1到10内两两相邻的数的和

	```
	[root@ZhumaTech sh]# vi twosum.sh     
	#!/bin/bash
	TWOSUM() {
	echo $[$1+$2]
	}
	
	for I in in {1..10}; do
	    let J=$[$I+1]
	    echo "$I plus $J is `TWOSUM $I $J`"
	done
	```
	
- 练习: 写一个脚本,判定192.168.0.200到192.168.0.253之间的那些主机在线,要求: 使用函数来实现一台主机的判定过程; 在主程序中来调用此函数判定制定范围内的所有主机的在线情况.

	```
	#!/bin/bash
	PING() {
		for I in {1..254}; do
		if ping -c 1 -W 1 192.168.88.$I &>/dev/null; then
			echo "192.168.88.$I is up"
		else echo "192.168.88.$I is down."
		fi
		done
	}
	
	PING
	// 这个脚本的缺陷就是只能在这一个网段中执行,换网段要改动的地方比较多.
	```

    ```
	//改进版,这个可以随意添加或者修改不同网段.
	[root@ZhumaTech sh]# vi 2ping.sh       
	#!/bin/bash
	function PING {
	        if ping -c 1 -W 1 $1 &>/dev/null; then
	        echo "$1 is up."
	        else echo "$1 is down."
	        fi
	}
	
	for I in {200..254}; do
	        PING 192.168.88.$I
	done
    ```

	```
	//在函数中判定某个IP是否在线,但不再函数中显示,而在主程序中显示是否在线
	[root@ZhumaTech sh]# vi 3ping.sh      
	#!/bin/bash
	function PING {
	        if ping -c 1 -W 1 $1 &>/dev/null; then
	        return 0
	        else return 1
	        fi
	}
	
		for I in {200..254}; do
	        PING 192.168.88.$I
	if [ $? -eq 0 ]; then
	        echo "192.168.88.$I is up"
	        else echo "192.168.88.$I is down"
	fi
	done
	```

### 进程管理基础知识
- 内核的数据结构（任务结构：task structure）：用来保存进程的描述信息
- 每一个进程占用的内存大小是不经相同的；然后有的进程会结束，过一段时间我们的内存就会变得“千疮百孔“，有很多空隙；还有的进程会增长，可能会覆盖别人的内存，一般程序员编程的时候，会新申请一段内存，和之间的并起来用；也有的程序员会恶意的覆盖别的进程占用的内存。
- 在80286CPU以后，为了避免程序bug或者恶意去损害别的进程数据，就把内存空间分成了“线性地址空间 ”和“物理地址空间”
    - 线性地址空间：以32bit系统为例：上来每个进程都以为自己有4G内存可用，其中1G给内核，在任何进程看来，当前系统中就俩进程：自己和内核；在真正的物理内存里，有多个进程和一个内核，要实现上述的机制，我们的CPU必须要将内存划分成一个一个页面和页框，每个都是固定大小的存储单元，当进程运行起来的时候，由我们的内核，接受进程的申请，根据进程的大小在内存中找n个页面，这些页面可能是不相连的，但是由于内核数据结构的存在，在进程看来是相连的。
    - 物理地址空间：
- 堆内存 heap: 根据需要，不停地动态地申请的内存空间
- 栈内存 stack：用来存储本地变量
- 由于现在的内存非常大，所以要找到进程和对应的页框非常麻烦，CPU中有个设备叫MMU（Memory Management Unit），专门负责任何进程的页面数据需要找到对应的物理页框并转换的过程；每个页面转换以后，存放在CPU的缓存当中（一级缓存，二级缓存...）；缓存 空间满了的时候，把最少用的东西清出去，把新的填进来，这个过程叫做TLB
- 进程切换： Context Switch 进程上下文切换。 
- 进程查看：进程号，内存空间，用户，父进程，CPU time 
- vsz 虚拟内存集：包含了映射的共享库。
- rss resident size：常驻内存集；位于物理内存中,___不能够被交换出去的___,比如指令和变量。
- 不管CPU是几核的，都不能同时执行两条指令；多核的作用是，排队的时候可以排成多排。
- 多核的CPU还可以通过并行编程模型，把一个进程内部分成n个小的执行实体单位，每个执行实体内部都有指令和数据，根据功能不同，这些实体之间互相不交叉；这些小的单位就叫做线程thread。
- 单进程多线程和多进程相比较：多线程省内存空间，例如：3个用户同时查询数据库服务器上的A表，多进程的方式是，启动三个进程，每个进程都把A表导入内存，内存中就有3张A表；多线程的方式则是，启动一个进程，在这个进程中启动3个线程；整个进程只导入1张A表，内存中也就只用1张A表，比较节省内存空间；多线程的缺点是，假如某个用户在往这个表中写数据。内核就要锁这个文件，并在这些线程之间同步，平均资源；而且要监控每个资源是否被加锁，万一死锁就要不停监控，这也会造成资源浪费。
- 进程状态：
    - 睡眠状态：当一个执行中的进程需要加载额外的I/O资源的时候，由于I/O的速度太慢，所以它一定会转入睡眠状态，此时会交出CPU，由其他进程运行，免得浪费。
    - Uninterruptible sleep: 不可中断睡眠；上述的例子就是不可中断睡眠，意思是，文件没被打开，就算把进程调入到CPU上，它也不能执行。中断也没有意义
    - interruptible sleep： 可中断睡眠，随时有用户来，随时可唤醒的睡眠；不需要任何IO资源，比如数据库查询，当某个查询结束时，别的用户可能还会执行这个操作，但它也不能闲着，那就睡着吧。
    - Zombie 僵尸进程：内核中的 Task Structure表中的条目不能删除，内存中占据的那些空间也找不到了，这些进程在内存里也不能退出；这也是内存泄露的一种表现。
- 进程有父子关系，Linux中 ,所有进程都有个父进程叫init,它负责生成其他具体任务的进程
- 进程的优先级关系：Linux优先级共有0-139共140个；数字越小优先级越高;100-139这些优先级是用户可控制的；0-99：是由内核调整的。
- O(Big O,大欧标准)：
    - O(1) 
    - O(n)
    - O(logn)
    - O(n^2)
    - O(2^n)
- 每个进程都有一个NICE值（-20-->19对应于100-->139）,默认情况下,进程的优先级都是0,普通用户只能调大自己进程的NICE值;管理员则可以随便调.
- PID: Process ID
- 在/proc目录下有很多数字，每一个数字对应一个进程，1就表示PID为1的进程；init的进程号永远为1。
- 进程的分类：
    - 跟终端相关的进程
    - 跟终端无关的进程 
- ps: process state;两种风格System V： 横线- 和BSD风格：不用横线
    -  BSD风格选项:
        - a: 显示所有跟终端有关的进程
        - u: 显示进程由哪个用户启动的
        - x: 显示所有与终端无关的进程
    - SysV风格:
        - 常用选项-elF:查看进程选项
        - -ef: e是所有进程
        - -o: 指定要显示的字段(man ps 可以查看支持的字段)
- 进程状态：
    - D：不可中断的睡眠
    - R：运行或就绪
    - S：可中断的睡眠
    - T：停止
    - Z：僵尸
    - <： 高优先级进程
    - N： 低优先级进程
    - +：前台进程组中的进程
    - 1：多线程进程
    - s：会话进程首进程
- 进程状态,凡是在命令那一行外面加了中括号的就表示这个进程是内核进程
- pstree:显示进程树
- pgrep: 在当前进程中查找符合指定属性的进程,如
    - -u euid 有效ID,就是以谁的权限运行的
    - -U UID 发起人的UID
    ```
    [root@ZhumaTech ~]# pgrep -u root bash
    2143
    30447
    ```
- pidof 根据进程名查找进程号;知道即可
    ```
    [root@ZhumaTech ~]# pidof bash
    30447
    ``` 
- top: 监控系统运行状态的;按1可以展开多核CPU的情况;这个命令还有许多交互式操作:
    - M: 根据驻留内存大小进行排序
    - P: 根据CPU使用百分比进行排序
    - T: 根据累计时间进行排序
    
    - l: 是否显示平均负载和启动时间
    - t: 是否显示进行和CPU相关信息
    - m: 是否显示内存相关信息
    
    - c: 是否显示完整的命令行信息
    - q: 推出top
    - k: 终止某个进程,会让你输入pid
    - 选项-d: 指定延迟时长,后面接秒数;
    - 选项-b: 批模式(就是分屏显示)
    - 选项-n \#: 批处理模式共显示\#屏,一般和-b混合使用
- 进程与进程之间是不知道彼此的存在的(每个进程都以为系统上只有自己和内核)的通信,它们通过IPC(Inter Process Communucation)机制进行通信,常用方法:
    - 共享内存
    - 信号:signal;kill 命令可以向其他进程发信号
    - 旗语:semaphore
- kill命令,终止一个进程,但是通常用来向进程发信号
    - -l:显示所有可用信号;有些信号很重要:
        - 1 SIGHUP: 让一个进程不用重启就可以重读其配置文件,并让新的配置信号生效
        - 2 SIGINT: 等同于Ctrl+C,中断一个进程
        - 9 SIGKILL: 杀死一个进程,强行杀死,不给任何处理资源的时间.不到万不得已不要使用.
        - 15 SIGTERM: 终止一个进程;给进程足够时间释放资源,比较人道的终止,___默认信号___
    - 指定一个信号:
        - 信号号码: kill -1
        - 信号名称: kill -SIGKILL
        - 信号名称简写: kill -KILL  
    - killall COMMAND: 杀死全部叫COMMAND的进程,比如有许多httpd的进程,可以用这个命令直接杀死,指定信号的方法和kill一样.   
- 调整已经启动进程的NICE值:`renice NICE_VALUE pid`
    ```
    [root@ZhumaTech sbin]# ps axo pid,ni,comm
     PID  NI COMMAND
    2899   0 bash
    3351   0 ant
    3356   0 java
    3371   0 java
    9431   0 nginx
    9432   0 nginx
    9585   0 pickup
    9621   0 ps
    [root@ZhumaTech sbin]# renice 3 2899
    2899: old priority 0, new priority 3
    [root@ZhumaTech sbin]# ps axo pid,ni,comm
     PID  NI COMMAND
    2899   3 bash         
    ```
- 在启动时指定nice值:`nice -n NICE_VALUE COMMAND`
- 运行前台和后台:
    - 前台: 占据了命令提示符
    - 后台: 启动之后释放命令提示符,后续的操作在后台完成
    - 把作业从前台送到后台:操作后按Ctrl+Z;命令后面跟"&",即可让命令在后台执行
    - jobs: 查看后台的所有作业;每个作业有作业号,作业号前面是有"%"的,fg 和bg中可以省略,在kill中不能省略;有"+"表示将默认操作的作业,"-"将第二个默认操作的作业.
    - bg: background 让后台的停止作业在后台继续运行`bg [%JOB_ID]`
    - fg: foreground 将后台的作业调回前台`fg [%JOB_ID]`
    - kill %JOB_ID,终止作业
- vmstat virtual memory:系统状态查看命令
    - `vmstat 1`: 每隔1秒钟刷新一次
    - `vmstat 1 5`: 每隔1秒钟刷新一次,但只显示5次
- uptime:运行时长和平均负载,top命令的第一行
    ```
    [root@ZhumaTech sbin]# uptime
    17:26:56 up 12 days,  9:31,  1 user,  load average: 0.00, 0.00, 0.00
    ```
- /proc/meminfo 也可以查看内存信息
- `cat /proc/1/maps` 可以查看PID为1的进程内存占用情况
### Linux系统启动流程之运行级别及grub
- linux启动流程
```
POST通电自检-->BIOS(Boot Sequence启动次序)-->MBR(bootloader)-->kernel装载用户所选操作系统的内核(内核的功能:文件系统,进程管理,内存管理,网络管理,安全功能,驱动程序)-->通过initrd-->/sbin/init启动init(用户空间的主导程序);init配置文件/etc/inittab

注意:kernel和initrd都是有bootloader 装载的,bootloader装载kerner,在内存中解压开来,然后将控制权交给kernel,bootloader能访问kernel的那个分区的驱动程序一定是很常见的.bootloader能访问的分区,kernel一定能访问,然后kernel和initrd一定是位于一个分区上的;kernel和initrd都是由bootloader装载的,只不过initrd在内存中展开以后被kernel所使用,kernel借助于initrd中的驱动或者模块最终能够访问rootfs,然后就可以找到/sbin/init.
```
#### 详解启动过程
- bootloader(MBR):微软的只引导自己的,不引导别人的.更恶心的是win8安装完成以后系统锁定MBR,Linux的则非常开放,Linux常用的bootloader有两种
    - LILO:Linux Loader;不能引导1024柱面以后分区和内核;不支持大硬盘,8G以后磁盘或者分区装内核引导不了,所以相对落后,但是在嵌入系统还是很好用,比如路由器.
    - GRUB:Grand Unified Bootloader; GRUB是多段式的
        - Stage1:MBR 第一阶段是为了引导第二阶段
        - Stage1.5 用来识别常见的不同的文件系统
            ```
            [root@ZhumaTech virroot]# ls /boot/grub
            device.map     grub.conf         minix_stage1_5     stage2
            e2fs_stage1_5  iso9660_stage1_5  reiserfs_stage1_5  ufs2_stage1_5
            fat_stage1_5   jfs_stage1_5      splash.xpm.gz      vstafs_stage1_5
            ffs_stage1_5   menu.lst          stage1             xfs_stage1_5
            ```
        - Stage2:/boot/grub/ 还有个配置文件/boot/grub/grub.conf  
- GRUB的使用
    - 配置文件/boot/grub/grub.conf,软连接是/etc/grub/conf
    ```
	default=0       //设定默认启动的内核或系统编号.
	timeout=5       //等待选择的超时时长,单位是秒
	splashimage=(hd0,0)/grub/splash.xpm.gz      //指定背景图片
	hiddenmenu      //隐藏菜单,以上为全局属性定义
	title CentOS (2.6.32-431.el6.x86_64)    //内核标题或操作系统名称,可自由修改,每个title定义一个操作系统或者一个内核
	        root (hd0,0)        //内核文件所在的设备,GRUB识别硬件和内核识别硬件不同,对GRUB而言,所有类型硬盘都是hd,格式为(hd#,n),# 表示第几块磁盘,n表示对应磁盘的分区,两个数字用
	        kernel /vmlinuz-2.6.32-431.el6.x86_64 ro root=UUID=b9b9de07-bcc0-4025-a134-ba4533940298 rd_NO_LUKS rd_NO_LVM LANG=en_US.UTF-8 rd_NO_MD SYSFONT=latarcyrheb-sun16 crashkernel=auto  KEYBOARDTYPE=pc KEYTABLE=us rd_NO_DM rhgb quiet     //内核文件路径及传递给内核的参数;参数和/proc/cmdline中的内容一样.
	        initrd /initramfs-2.6.32-431.el6.x86_64.img     //initrd|ramdisk文件路径;注意文件是在/boot下,因为GRUB访问/boot的时候,磁盘尚未使用,所以此时,/boot就相当于是根目录;所以实际上这个文件是在/boot下
    ```
####其他知识点
- Linux内核设计风格:
    - 单内核:把所有功能统统做进内核.Linux就是单内核设计;设计风格也在慢慢向微内核模式靠拢
        - REDHAT 的模式就是内部核心:ko(kernel object) + 各种外部魔外组成;内部核心很小,但是核心布满了孔洞,任何模块需要的时候,装载到指定的位置就好,这就实现了动态加载.
        - 内核模块的位置:/lib/modules/"内核版本号命名的目录"/;里面有对应内核需要的各种外围模块,模块之间也是有以来关系,但是内核一般能够自己识别,处理;但是请注意:能够做成模块的不仅仅是驱动程序,还有很多额外的功能,比如文件系统.
        - vmlinz:内核自己的名称
        - 内核想要访问设备,就需要驱动设备,可驱动就在这个设备上,要想拿到启动,需要内核先访问设备.陷入了两难;所以找个中间人.在内核和要访问的设备中间放个层次,就一个功能,向内核提供设备的驱动.注意:这个文件不是事先编译好的.是在安装操作系统的过程中,系统知道内核访问"/"需要那些模块,那些驱动,会通过脚本或命令动态地收集相关程序,并生成这个文件;其实这个文件可以理解为一个连接设备,这个文件会变成一个虚"/",用来临时过渡的;等kernel羽翼丰满了,就可以把这个虚根踢掉.这个过程就是根切换的过程；然后根把虚根目录下的的三个目录/proc,/sys,/dev搬运到真根上来;虚拟根能够把内存中的某一段物理空间模拟成磁盘来用,红帽5上称为ramdisk,对应的文件名叫initrd.红帽6上改名了叫ramfs对应的文件initramfs.
        - 根切换命令`chroot /PATH/TO/TEMPROOT [COMMAND..]`:可以把临时的目录当根来用`chroot /test/virroot /bin/bash`表示把/test/virroot切换为根目录,并在此根目录下可以执行/bin/bash,和上面的根转移还是有区别的
        ```
        [root@ZhumaTech /]# mkdir -p /test/virroot
        [root@ZhumaTech /]# chroot /test/virroot
        chroot: failed to run command `/bin/bash': No such file or directory    //提示目录下没有/bin/bash
		[root@ZhumaTech /]# mkdir /test/virroot/bin
		[root@ZhumaTech /]# cp /bin/bash /test/virroot/bin/
		[root@ZhumaTech /]# chroot /test/virroot    
		chroot: failed to run command `/bin/bash': No such file or directory    //还是不能运行是因为缺少依赖
		[root@ZhumaTech /]# ldd /bin/bash   //ldd查看二进制文件所依赖的共享库
		        linux-vdso.so.1 =>  (0x00007fffde59b000)
		        libtinfo.so.5 => /lib64/libtinfo.so.5 (0x00007f22a8f90000)
		        libdl.so.2 => /lib64/libdl.so.2 (0x00007f22a8d8c000)
		        libc.so.6 => /lib64/libc.so.6 (0x00007f22a89f7000)
		        /lib64/ld-linux-x86-64.so.2 (0x00007f22a91b9000)
		        
		[root@ZhumaTech /]# mkdir /test/virroot/lib
		[root@ZhumaTech /]# cp /lib64/libtinfo.so.5 /test/virroot/lib
		[root@ZhumaTech /]# cp  /lib64/libdl.so.2 /test/virroot/lib   
		[root@ZhumaTech /]# cp  /lib64/libc.so.6 /test/virroot/lib
		[root@ZhumaTech /]# cp  /lib64/ld-linux-x86-64.so.2 /test/virroot/lib
		
		[root@ZhumaTech /]# tree /test/virroot/
		/test/virroot/
		├── bin
		│   └── bash
		└── lib
		    ├── ld-linux-x86-64.so.2
		    ├── libc.so.6
		    ├── libdl.so.2
		    └── libtinfo.so.5
		
		2 directories, 5 files
		
		[root@ZhumaTech /]# chroot /test/virroot
		bash-3.2#           //切换成功了
		bash-3.2#exit       //退出bash
        ```
    - 微内核:内核很小,只是核心,各种外围功能都做成子系统,由内核调动子系统;实现功能非常复杂.Windows,Solaris就是微内核设计,可以真正意义上实现线程.
- 运行级别:启动的服务不同,判定的运行级别不同
    - 0:halt
    - 1:single user mode 单用户模式,直接以管理员的身份切入 在GRUB编辑界面的quiet 后面加上1 or s or S 或者single 都可以表示以1级别启动系统.
    - 2:multi user mode, no NFS,多用户模式,不启用NFS
    - 3:multi user mode, text mode,多用户命令行模式,默认模式
    - 4:reserved 尚未定义,保留级别
    - 5:multi user mode, graphic mode,多用户图形化模式.
    - 6:reboot
### LINUX启动流程之二内核及init
- GRUB在刚刚启动的时候,会显示一个菜单给我们,菜单本身除了让我们选择对应的系统或者内核外,还有提供了编辑界面.按"e"可以进入编辑界面;"a"键修改内核参数;"c"键进入命令行界面.编辑完成后敲回车;一切都搞定以后敲"b"键就可以启动了.
- GRUB也是可以加密码的,如果不想让别人随便使用单用户模式.我们就给GRUB加密,方法是在grub.conf中在第一个title上方加上`passwd PASSWORD`就可以,这个不太安全因为别人也可以看到 /etc/grub.conf文件;也可以用md5加密,对应的命令是`grub-md5-crypt`回车就会生成MD5格式的密码,然后贴到grub.conf中title上方的 `password --md5` 后面. 然后系统重启,再想编辑菜单就得先敲"p"键先输入密码了.___上面的操作是全局的,如果只想针对某个内核或者操作系统,就把`password`这一行粘贴到title内___.
- 查看运行级别
    - runlevel
    ```
    [root@ZhumaTech virroot]# runlevel
    N 3         //前面表示上一个级别,3表示当前级别;N表示没切换过,开机以后直接就是第3级别.
    ```
    - who -r
    ```
    [root@ZhumaTech virroot]# who -r
         run-level 3  2017-05-06 07:55 
    ```
#### 修复GRUB
- 第一种方式:重装GRUB `grub` 然后进入grub命令行`root (hd0,0)`指定root,然后再执行`setup`
```
[root@ZhumaTech ~]# dd if=/dev/zero of=/dev/sda count=1 bs=400  //我们破坏一下现有系统的MBR.只要破坏前446即可,注意不能超过400
1+0 records in
1+0 records out
400 bytes (400 B) copied, 0.000108534 s, 3.7 MB/s
[root@ZhumaTech ~]# sync    //同步一下
[root@ZhumaTech ~]# grub    //进入grub命令行
Probing devices to guess BIOS drives. This may take a long time.
    GNU GRUB  version 0.97  (640K lower / 3072K upper memory)
 [ Minimal BASH-like line editing is supported.  For the first word, TAB
   lists possible command completions.  Anywhere else TAB lists the possible
   completions of a device/filename.]
grub> root (hd0,0)   //指定root;注意这个我们上面讲过,所有类型的硬盘在GRUB里面都被标记为hd#,所以这里的顺序和fdisk显示的可能不一样.
root (hd0,0)
 Filesystem type is ext2fs, partition type 0x83
 grub> setup (hd0)  //重新安装GRUB
setup (hd0) 
 Checking if "/boot/grub/stage1" exists... no
 Checking if "/grub/stage1" exists... yes
 Checking if "/grub/stage2" exists... yes
 Checking if "/grub/e2fs_stage1_5" exists... yes
 Running "embed /grub/e2fs_stage1_5 (hd0)"...  27 sectors are embedded.
succeeded
 Running "install /grub/stage1 (hd0) (hd0)1+27 p (hd0,0)/grub/stage2 /grub/grub.conf"... succeeded
Done.
grub> quit  //退出
```
- 第二种方式:`grub-install --root-directory=/path/to/boot's_parent_dir /dev/DEVICE_NAME`, 一定要把这个路径指向到/boot的父目录.还要确保把内核所在的分区挂在到boot目录下才行.
- 给其他硬盘装上GRUB,我们的GRUB可以装到任何设备,但这个设备必须具备以下几个条件:
    - 这个设备做好分区,有分区表
    - /boot目录挂在到某个位置
- grub.conf损坏或者丢失,怎么修复;当grub.conf损坏或者丢失了,开机会直接进入grub命令界面;此时gurb是支持find命令的,我们可以执行`find (hd0,0)/`按tab可以看到有什么;然后指定root,输入`root (hd0,0)`;接着指定kernel `kernel /vmliuz-`按tab可以补全,然后回车,;再输入`initrd /initrd-`tab补全,然后回车;最后再输入`boot`回车,开始重启系统,进入系统后,修改grub.conf.
- 所以grub命令启动系统:
    - grub> find
    - grub> root (hd#,n)>`
    - grub> kernel /PATH/TO/KERNEL_FILE
    - grub> initrd /PATH/TO/INITRD_FILE
    - grub> boot
#### kernel初始化的过程:
1. 设备探测
2. 驱动初始化(可能会从initrd(红帽6:initramfs)文件中装载驱动模块)
3. 以只读挂在根文件系统;只读是为了安全起见;过一会init会重新把根挂载为可读写
4. 装载第一个进程init(PID:1)
####  /sbin/init (配置文件:/etc/inittab)
- RHEL6.0之前,init可能是一个二进制执行程序,也可能是一个脚本.6.0以后使用的是upstart,是Uuntu组织开发的一个新式的执行程序,比传统的速度要快他的配置文件包括/etc/inittab和/etc/init/下的所有.conf文件.
- 现在又有人开发了更好的systemd:最早的init只能一个程序一个程序串行地启动,upstart和systemd就可以并行地启动多个程序;
- RHEL5.x 版本的 /etc/inittab中每一行的格式都是`id:runlvels:action:process`
    - id: 标识符
    - runlevels: 在哪个级别下运行此行
    - action: 在什么情况下执行动作
        - initdefault: 设定默认运行级别
        - sysinit: 系统初始化
        - wait: 等待级别切换至此级别时执行
        - ctrlaltdel: 重启
        - powerfail: 断电
        - powerokwait: 恢复供电
        - respawn: 一旦程序终止,会重新启动
    - process: 要运行的程序;
- /etc/rc.d/rc.sysinit完成的任务
    1. 激活udev和selinux
    2. 根据/etc/sysctl.conf文件,来设定内核参数
    3. 设定时钟时钟
    4. 装载键盘映射
    5. 启用交换分区
    6. 设置主机名
    7. 根文件系统检测,并以读写方式重新挂载
    8. 激活RAID和LVM设备
    9. 启用磁盘配额
    10. 根据/etc/fstab检查并挂载其他文件系统 
    11. 清理过期的锁和PID文件.
#### SysV服务脚本 
- - /etc/rc.d/init.d是/etc/init.d的软链接
    - 这个目录下的脚本都有个共同的特点,在每个脚本前面几行都有下面两行;这一类脚本就靠这两行能够成为系统服务的;注意着两行前面是有"#"的,表示系统默认的:
        - \# chkconfig RUNLEVELS SS KK:用来定义它能够接受另外一个命令的控制并自动在对应的rc#.d目录下创建一个链接.这个命令就叫做`chkconfig `;前提是脚本必须有着两行,在脚本中chkconfig: 后面的3组数字分别表示 运行级别(在哪些级别下是默认启动的)、SS(启动优先次序)、KK(关闭的有限次序)；当`chkconfig`命令来为此脚本在rc#.d目录创建链接时,runlevel表示默认创建为S*开头的链接,除此之外的级别默认创建为K*的链接.并且S后面的启动优先级为SS表示的数字;K后面关闭优先次序为KK所表示的数字.
        - \# description: 用于说明此脚本的简单功能,如果内容很长,要用"\" 来续行.
        
    ```
    #!/bin/bash
    # chkconfig: 2345 77 22     //SS 和KK 之和接近99即可,先开启的要后关闭,后开启的要先关闭,防止有依赖性的原因
    # description: Test Service
    LOCKFILE=/var/lock/subsys/myservice
	status() {
	  if [ -e $LOCKFILE ]; then
	    echo "Running..."
	  else
	    echo "Stopped."
	  fi
	}
	
	usage() {
	  echo "`basename $0` {start|stop|restart|status}"
	}
	
	case $1 in
	start)
	  echo "Starting..." 
	  touch $LOCKFILE ;;
	stop)
	  echo "Stopping..." 
	  rm -f $LOCKFILE &> /dev/null
	  ;;
	restart)
	  echo "Restarting..." ;;
	status)
	  status ;;
	*)
	  usage ;;
	esac
    ```
- 命令`chkconfig`；只有包含chkconfig和description两行的脚本可以添加。
    - --list: 查看所有独立守护服务的启动设定:独立守护进程。
        - --list SERVICE_NAME 查看单个服务的启动设定
    - --add SERVICE_NAME 把服务的链接文件添加到对应的级别目录中;只会在下一次系统切换到这个运行级别的时候才会运行.
    - --del SERVICE_NAME 把服务的链接文件从对应的级别目录中删掉
    - --level RUNLEVELS SERVICE_NAME {on|off}：把级别2和4的{启动|关掉};如果省略级别指令,默认为2345级别
    - RUNLEVELS: -表示没有级别，默认为S*开头的链接
- 这种在对应级别下可以设定其启动或停止状况的服务都叫守护进程：可以管理自己在哪些级别下是启动的，哪些级别下是关闭的。  
- /etc/rc.local脚本，S99，系统最后启动的一个服务，准确说是一个脚本：不会写脚本，或者不方便写成服务的，可以写在这里面，系统启动的最后肯定会执行一次。
- /etc/inittab的任务(RHEL5.x)：
    1. 设定默认运行级别
    2. 运行系统初始化脚本
    3. 运行指定运行级别对应目录下的脚本
    4. 设定Ctrl+Alt+Del组合键的操作
    5. 定义UPS电源在电源故障/回复时执行的操作
    6. 启动虚拟终端（2345级别）
    7. 启动图形终端（5级别）
- 守护进程类型:
    - 独立守护进程;相当于街边独立的专卖店.
    - xinetd:超级守护进程:负责对瞬时守护进程的管理,是瞬时守护进程的代理人;___需要关联之运行级别___
        - 瞬时守护进程: 不需要关联至运行级别,相当于大商场里的小店铺.由超级守护进程代理的瞬时守护进程有多个
        
    ```
    [root@Aphey ~]# chkconfig --list xinetd
	xinetd          0:off   1:off   2:off   3:on    4:on    5:on    6:off
	[root@Aphey ~]# service xinetd start
	Starting xinetd:                                           [  OK  ]
	[root@Aphey ~]# chkconfig --list
	auditd          0:off   1:off   2:on    3:on    4:on    5:on    6:off
	.
	.
	.
	xinetd          0:off   1:off   2:off   3:on    4:on    5:on    6:off
	
	xinetd based services:  //下面就是瞬时守护进程
	        chargen-dgram:  off
	        chargen-stream: off
	        daytime-dgram:  off
	        daytime-stream: off
	        discard-dgram:  off
	        discard-stream: off
	        echo-dgram:     off
	        echo-stream:    off
	        tcpmux-server:  off
	        time-dgram:     off
	        time-stream:    off
    ```
#### 14-4内核编译
- 内核版本号命名规则:
    2|6|17
    ---|---|---
    主版本号|次版本号|修正号
     
    - 2.6之前:次版本号为奇数的,表示测试版;偶数表示稳定版
    - 2.6以后:同时维护两个分支:
        - 2.6.17.1: 稳定版,后面的1可以理解为次修正号
        - 2.6.18-rc1: rc,release candidate,发行候选的意思,待发布版本;补充新特性,修复bug等.
- 用户空间访问、监控内核的方式：/proc, /sys这俩目录是伪文件系统;/proc目录下大多数文件是只读的,只有/proc/sys/目录下的文件很多是可读写的./sys/目录下某些文件也是可写的.
- 设定内核参数值的方法: 
    - `echo VALUE > /proc/sys/TO/SOMEFILE`;不同的内核参数所接受的值是不一样的.
    - sysctl -w PATHBASENAME.SOMEFILE
        - -p: 修改/etc/sysctl.conf后,可以通过`sysctl -p`让系统重读这个配置文件.
        - -a: 显示所有内核参数及其值
    ```
    //两种方法改主机名
    [root@Aphey ~]# hostname
    aphey
    [root@Aphey sys]# echo aphey.com > /proc/sys/kernel/hostname
    [root@Aphey sys]# hostname
    aphey.com
    // 第二种
    [root@Aphey ~]# sysctl kernel.hostname="aphey"
    kernel.hostname = aphey
    [root@Aphey ~]# hostname
    aphey
    ``` 
- 以上两种方法能立即生效,但无法永久有效;要永久有效,编辑/etc/sysctl.conf,编辑完成后,用`sysctl -p`让这个配置文件生效.
- 内核模块管理
    -  列出模块`lsmod`
    Module|size|used by
    ---|---|---
    模块名称|大小|被谁调用了,调用了几次
    - 手动装载或者卸载模块,不需要指定模块路径,只需要指定模块名 
        - 装载模块`modprobe MOD_NAME`
        - 另一个装载模块的命令`insmod /MOD_PATH`
        - 卸载模块`modprobe -r MOD_NAME` 
        - 另一个卸载模块的命令`rmmod MOD_NAME`   
    ```
    [root@Aphey ~]# lsmod | grep floppy //查看系统是否装载了软驱模块
	[root@Aphey ~]# modprobe floppy //系统没有装载软驱模块,我们装载软驱模块
	[root@Aphey ~]# lsmod | grep floppy //装载成功
	floppy                 61447  0 
	[root@Aphey ~]# modprobe -r floppy  //卸载软驱模块
	[root@Aphey ~]# lsmod | grep floppy     //卸载成功
    ```
    
    ```
    [root@Aphey ~]# lsmod |grep floppy  //系统里未加载floppy模块
    [root@Aphey ~]# modinfo floppy  //查看模块的路径
    filename:       /lib/modules/2.6.32-431.el6.x86_64/kernel/drivers/block/floppy.ko
    alias:          block-major-2-*
    license:        GPL
    author:         Alain L. Knaff
    srcversion:     4FE4A1303A32321170C1A4F
    depends:        
    vermagic:       2.6.32-431.el6.x86_64 SMP mod_unload modversions 
    parm:           floppy:charp
    parm:           FLOPPY_IRQ:int
    parm:           FLOPPY_DMA:int
    [root@Aphey ~]# insmod  /lib/modules/2.6.32-431.el6.x86_64/kernel/drivers/block/floppy.ko  //通过insmod命令装载floppy模块
    [root@Aphey ~]# lsmod|grep floppy   //装载成功
    floppy                 61447  0 
    [root@Aphey ~]# rmmod floppy    //卸载floppy模块 
    [root@Aphey ~]# lsmod|grep floppy   //卸载成功
    ```
    - 查看模块信息`modinfo MOD_NAME`
    ```
    [root@Aphey ~]# modinfo floppy
    filename:       /lib/modules/2.6.32-431.el6.x86_64/kernel/drivers/block/floppy.ko
    alias:          block-major-2-*
    license:        GPL
    author:         Alain L. Knaff
    srcversion:     4FE4A1303A32321170C1A4F
    depends:        
    vermagic:       2.6.32-431.el6.x86_64 SMP mod_unload modversions 
    parm:           floppy:charp
    parm:           FLOPPY_IRQ:int
    parm:           FLOPPY_DMA:int
    ```
- depmod /PATH/TO/MODULES_DIR 生成模块间依赖关系,并保存在目录中;用的不多
- 内核中的功能除了核心功能之外,在编译时,大多数功能都有三种选择:
    1. 不使用此功能
    2. 编译成内核模块
    3. 编译进内核 
- 如何手动编译内核:如果我们当前内核版本比较低,一下子升级到最新版本可能会不兼容;RHEL5不管发行版是5.1还是5.9,它的内核版本永远都是2.6.18的,为了稳定性.同样RHEL6不管版本是6.x,它的内核一直都会是2.6.32.;那如果我想要升级高一点的版本的内核;系统首先得预先安装"Developmen Tools" 和 "Development Libraries" `yum groupinstall -y "Development Tools" "Development Libraries"`;然后下载内核源码包;注意,内核的源码一般是放在/usr/src/目录中的`tar xf linux-2.6.28.10 -C /usr/src`,会得到一个目录/usr/src/linux-2.6.28.10/,一般情况下我们会把在内核目录的父目录/usr/src中创建一个软链接`ln -sv linux-2.6.28.10/ linux`;内核的编译方法和普通软件的编译方法不一样;不能用./configure来配置;而是给我们一个选择界面.
    - 手动编译内核:
        1. make config:只能在Gnome桌面环境中使用;需要安装图形开发库组: Gnome Software Development
        2. make kconfig: KDE桌面环境;需要安装图形开发库组:KDE Software Development
        3. make menuconfig: __必须在内核目录下__使用`make menuconfig`;然后就会打开一个文本图形窗口;___当你的窗口过小,会报错,做好把命令行窗口最大化__;其中"*"表示写入内核,"M"表示作为内核模块,留空表示不使用这个功能,按空格键切换;在/boot/目录中有一个config-2.6.32-431.el6.x86_6的文件,这个是RHEL官方编译内核所使用的配置;我们可以以他的配置为模板.我们可以先把这个文件复制过去`cp config-2.6.32-431.el6.x86_6 /usr/src/linux/.config`;然后再执行 `make menuconfig`;这里面有个processor type and futures;我们可以选择自己的CPU,这样可以节省编译时间.
            - 当上面的选择完成之后,会在linux/目录下生成一个.config文件
            - make 开始编译,半小时到五小时不等.
            - make modules_install  //安装模块
            - make install  //安装内核
- screen 可以模拟多个桌面;就算远程链接终端,程序也不会停止.
    - `screen -ls`: 显示已经建立的屏幕
    - `screen -ls SCREEN_NAME`: 新建一个名为SCREEN_NAME的窗口
    - `screen`: 新建一个无名窗口,多个窗口用窗口ID区分
    -  Ctrl+D 拆除屏幕 
    - `screen -r {SCREEN_NAME|SCREEN_ID}`: 通过SCREEN_NAME 或者SCREEN_ID 恢复SCREEN.
    - `exit`: 在screen窗口中输入exit,可以永久退出screen
- 二次编译时清理,清理前,如果有需要,请备份配置文件.config:
    - make clean: 清理储存编译好的二进制模块
    - make mrprope 清理此前编译所残留的任意操作的,包括.config都会被清理掉;如果.config 选项选了半天,再执行这个命令,那是非常惨痛的;所以要执行这个命令前,最好先备份.config.
- 编译好的内核怎么工作的
    - grub-->kernel-->initrd-->ROOTFS(/sbin/init, /bin/bash) 
- mkinitrd initrd文件路径 内核版本号:建立要载入ramdisk的映像文件 
    ```
    mkinitrd /boot/initrd-`uname -r`.img `uname -r` 
    ```
- bash有个特性,叫截取变量字符串${PARAMETER#KEYWORD},${PARAMETER##KEYWORD},${PARAMETER%KEYWORD},${PARAMETER%%KEYWORD}:看例子
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
    ```
    //复制二进制程序及其依赖的库文件的脚本：
    #!/bin/bash
    DEST=/mnt/sysroot
    libcp() {
      LIBPATH=${1%/*}
      [ ! -d $DEST$LIBPATH ] && mkdir -p $DEST$LIBPATH
      [ ! -e $DEST${1} ] && cp $1 $DEST$LIBPATH && echo "copy lib $1 finished."
    }

    bincp() {
      CMDPATH=${1%/*}
      [ ! -d $DEST$CMDPATH ] && mkdir -p $DEST$CMDPATH
      [ ! -e $DEST${1} ] && cp $1 $DEST$CMDPATH

      for LIB in  `ldd $1 | grep -o "/.*lib\(64\)\{0,1\}/[^[:space:]]\{1,\}"`; do
        libcp $LIB
      done
    }

    read -p "Your command: " CMD
    until [ $CMD == 'q' ]; do
       ! which $CMD &> /dev/null && echo "Wrong command" && read -p "Input again:" CMD && continue
      COMMAND=` which $CMD | grep -v "^alias" | grep -o "[^[:space:]]\{1,\}"`
      bincp $COMMAND
      echo "copy $COMMAND finished."
      read -p "Continue: " CMD
    done
    ```
#### Linux系统函数库
- /etc/rc.d/rc.sysinit作用:
    1. 检测并以读写方式重新挂载根文件系统;
    2. 设定主机名
    3. 检测并挂在/etc/fstab中的其他文件系统
    4. 启动swap分区
    5. 初始化外围硬件设备的驱动
    6. 根据/etc/sysctl.conf设定内核参数
    7. 激活udev和selinux
    8. 激活lvm和RAID设备
    9. 清理过期锁和PID文件
    10. 装载键映射. 
- 精简和定制内核; 有一个项目叫busybox,它是一个二进制程序,有很多链接,它本身不到1M,可以模拟数百个命令.
- RHEL定制安装: 1)自动化安装 2)定制引导盘
- /proc/mounts: 显示当前系统上挂在的所有文件系统,和/etc/mtab功能类似
- exec 表示让启动的子进程直接替换原有进程,而不是作为其子进程来执行的;    Execute COMMAND, replacing this shell with the specified program.用指定的进程取代当前的shell.
- /var/lock/subsys/目录:很多程序需要判断是否当前已经有一个实例在运行，这个目录就是让程序判断是否有实例运行的标志，比如说xinetd，如果存在这个文件，表示已经有xinetd在运行了，否则就是没有，当然程序里面还要有相应的判断措施来真正确定是否有实例在运行。通常与该目录配套的还有/var/run目录，用来存放对应实例的PID
- mingetty: minimal getty for consoles;当我们执行mingetty这个程序的时候,mingetty会启动一个终端,并在终端上启动login程序;`mingetty --loginprog=/bin/bash`.
- 能够实现终端的命令不仅有mingetty,还有其他的,比如agetty 和 mgetty
    - agetty的常用选项:
        - -l: 指定终端的默认shell
        - -n: 不需要用户输入登陆信息常和l选项连用
- `stty`改变并显示终端线的设置
    ```
    [root@Aphey subsys]# stty -F /dev/console size
    25 80   //行数 列数
    [root@Aphey subsys]# stty -F /dev/console speed
    38400   //每秒显示38400个字符
    ```
- 修复文件系统:~~可以通过`e2fsck`修复,但是fstab会丢失,所以不建议~~;最简单的办法是进入/目录,把文件备份,然后再进行修复修复好以后,再导回来.
    ```
    [root@Aphey /]# find . |cpio -H newc --quiet -o|gzip >/root/allfiles.gz
    [root@Aphey /]# cd
    [root@Aphey ~]# umount /dev/sda3    //卸载根分区
    [root@ZhumaTech ~]# fuser -km /sda3	//报错的话就执行这个命令.结束访问/sda3的进程,这时候会把访问/sda3的那个用户给踢掉
	/sda5:                2842c
	[root@Aphey ~]# mke2fs -j /dev/sda3     //重新格式化
	[root@Aphey ~]# mount /dev/sda3 /   //重新挂载根目录
	[root@Aphey ~]# zcat /root/roo.gz | cpio -id    //重新展开之前的备份
    ``` 
- 查看一个字符串有多少个字符的方法:`echo ${#VAR_NAME}`;我们在一个变量引用的时候,在名称前加一个"\#",表示取字符串包含字符的长度.
    ```
    [root@Aphey ~]# A="HelloWorld"  //先把字符串定义成变量
    [root@Aphey ~]# echo ${#A}
    10
    [root@Aphey ~]# A="Hello World"
    [root@Aphey ~]# echo ${#A}
    11
    ``` 
- 函数集调用,我在/etc/functions这个文件里写了若干函数,要在a脚本里调用,只要在a脚本里写上`. /etc/functions`或者`source /etc/functions`即可. 
- /etc/issue: 在用户登陆前显示的提示信息;其中转义符及其后面字符的意义可以`man mingetty`; \r相当于`uname -r`; \m 相当于`uname -m`
- PAM: Pluggable Authentication Module 可插入式认证模块;其许许多多的配置文件是在/etc/pam.d/下的所有文件
- nsswitch: Network Service Switch 网络服务转换也叫名称解析,它是一个框架,可以配置到哪里去找用户的账号密码,系统配置在/etc/passwd找用户的uid,到/etc/shadow中去找用户的密码,到/etc/group中去找用户的gid;login就可以借助nsswitch的功能就能找到这上面三个文件,并完成用户的认证.我们要修改认证文件只要到nsswitch中修改. nsswitch的配置文件是/etc/nsswitch.conf.
- 变量名PS1='[\u@\h \W]\$'
    - u:用户名
    - h:主机名
    - w:当前目录全路径
    - W:当前目录基名
    - $:命令提示符
#### 自定义内核及Busybox
- busybox:一个二进制文件,能够模拟实现了许许多多的命令;安装完成后,在/bin目录下生成一个busybox的二进制文件,其他文件都是他的符号链接,且他都可以实现这些命令的操作;在/sbin目录下,它也能实现众多命令.Ubuntu和Debian 就是通过busybox来引导系统启动过程;RHEL系列是通过nash 引导的ramdisk(initrd)来引导系统启动过程的.
- 我们可以把busybox做成一个Initrd来引导系统.
- 查看本机硬件设备信息:
    - CPU: `cat /proc/cpuinfo`
    - USB: `lsusb` 
        ```
        [root@zhumatech ~]# lsusb
        Bus 001 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub
        Bus 002 Device 001: ID 1d6b:0002 Linux Foundation 2.0 root hub
        Bus 001 Device 002: ID 8087:0020 Intel Corp. Integrated Rate Matching Hub
        Bus 002 Device 002: ID 8087:0020 Intel Corp. Integrated Rate Matching Hub
        ```
    - `lspci`查看PCI设备的信息
    - hal-device :harware abstract layer 硬件抽象层
- 编译内核:
    - 配置: make menuconfig 保存为.config, 然后make; make modules_install 最后安装 make install; 模块安装位置: /lib/modules/KERNEL_VERSION/
- 部分编译内核:
    1. 只编译某子目录下的相关代码: 
        - make dir/
        - make arck/
        - make drivers/net/ 只编译驱动下的网络启动
    2. 只编译部分模块
        - make M=drivers/net/
    3. 只编译某一模块
        - make drivers/net/pcnet32.ko
    4. 将编译完成的结果放置于别的目录中
        - make O=/tmp/kernel
    5. 交叉编译:(只是思路)
        - make ARCH=DESTINATION_ARCH
- 编译Busybox,自己做一个initrd:
    - 编译的方法和内核的编译方法是一样的`make menuconfig`;注意,在第一项"Busybox Settings"中有个Build Options里面的勾上第一条把 Busybox编译为静态二进制; 还有一项Installation Options可以选择安装的路径,然后就可以 make install安装了. 由于旧的内核可能不能满足新的Busybox的功能需要,所以安装过程中可能会出错,解决方法如下:
    -  用更新的内核的头文件替换老的版本的头文件,复制新内核的/KERNEL/include/mtd/ubi-user.h 到/busyboxDIR/include/mtd/里.然后退到busybox的目录重新执行`make install`安装;安装到了 busyboxDIR/_install里了.
    - 把_install/复制到外面任意地方,然后删除掉里面的linuxrc文件(编译时创建的链接文件),手动创建proc/, sys/, etc/, dev/, sysroot, lib/modules/ 等目录
    - 假如红帽提供给我们的内核,不支持ext3,内核不支持ext3,意味着它没法访问真正的文件系统,initrd就需要提供ext3模块.`modinfo ext3`,发现ext3模块依赖jbd模块,然后`modinfo jbd` 发现jdb不再依赖其他模块.然后我们把 ext3和jdb模块复制到上面的lib/modules/目录中. 
    - 在_install/sbin/中有一个文件叫mdev,`mdev -s`的作用是系统开机的时候扫描/sys目录和获取/dev目录中的硬件设备
#### 信号捕捉及系统任务管理之任务计划
- 交叉编译: 在A平台上编译在非A平台上运行的程序.
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
    - ${parameter:offset:length}: 取子串,从offset处的后一个字符开始,取length长的子串;做字符串切片; offset是指 略(偏移)过去几个;后面的长度可以省略,省略的意思是,跳过去后的内容全部显示出来
        ```
        [root@Aphey boot]# A="Hello World"
        [root@Aphey boot]# echo ${A:2:3}    //从第三个字符开始,取出3个字符并显示.
        llo
        [root@Aphey boot]# echo ${A:2}  //跳过两个字符,并显示剩余的所有字符
        llo World
        ```
- 在RHEL系统上,在/etc/rc.d/init.d/下有很多服务脚本,他们也可以支持配置文件的.这些配置文件都放在/etc/sysconfig/服务脚本同名的配置文件.要引用这些配置文件的方法很简单,在脚本里添加`. CONFFILE`或者`source CONFFILE`
- 在函数中如果使用的变量和全局变量同名了怎么办?
    - 变量的作用域,局部变量:看下面的例子,所以在函数中我们最好使用local声明居于变量.
        ```
        [root@Aphey boot]# vi a.sh

        #!/bin/bash
        a=1

        test() {
                local a=$[3+4]  //在变量前面加上关键字local,让a只在test函数中起作用
        }

        test
        for I in `seq $a 10`; do
                echo $I
        done
        
        [root@Aphey boot]# ./a.sh   //变量a的默认值是1,所以结果是1-10
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
        ```
- 命令`mktemp`:创建临时文件或者目录.语法是`maketmp /tmp/file.XXX`,至少3个X,`maketmp -d /tmp/file.XXX`就是创建临时目录的命令.
    ```
    [root@Aphey tmp]# mktemp /tmp/file.XX
    mktemp: too few X's in template `/tmp/file.XX'
    [root@Aphey tmp]# mktemp /tmp/file.XXX
    /tmp/file.jSl
    [root@Aphey tmp]# mktemp /tmp/file.XXXX
    /tmp/file.DxyK
    [root@Aphey tmp]# 
    ``` 
- 信号: kill -SIGNAL PID
    - 1: HUP
    - 2: INT
    - 9: KILL
    - 15: TERM
- 脚本中,能够实现信号捕捉,但9和15无法捕捉.
    - CTRL+C: SIGINT 
- 信号捕捉命令 trap: `trap 'COMMAND' 信号列表`:
- 一行执行多个语句,语句间用;隔开即可
    ```
    \#!/bin/bash
    NET=192.168.88

    trap 'echo "quit" ; exit 1' INT     // 当捕捉到CTRL+C信号的时候,输出QUIT,并退出脚本.

    for I in {1..254}; do
            if ping -c 1 -w 1 $NET.$I &>/dev/null; then
            echo "$NET.$I is up."
            else
            echo "$NET.$I is down"
            fi
    done
    ``` 
##### 任务计划
1. 在未来的某个时间点执行一次某任务:
    - at at 时间--> at> COMMAND(回车可以添加多个命令) -->  CTRL+D 提交.
        - 指定时间的方法:
            - 绝对时间: 10:20
            - 相对时间: +10m 或者 now+\#;单位: minutes,hours,days,weeks
            - 模糊时间: noon,midnight,teatime(下午4点).
            - 命令的执行结果,将以邮件的形式发送给安排任务的用户.
            - `at -l`相当于 atq查看作业列表`[root@Aphey tmp]# at -l
1	2017-05-31 19:21 a root` root前面的a是作业队列,队列默认是a,队列只能用小写字符来表示.
            - `at -d  JOB_ID` 等同于atrm,删除JOB_ID对应的作业.
            - 我们还可以指定,让谁用at,禁止谁用at,在/etc/at.deny或者/etc/at.allow;当两者都存在时,就allow会生效
            
    - batch 和at的区别是不需要指定时间,自动选择系统较空闲的时段执行任务.
2. 周期性地执行,以服务的方式不停地监控某些脚本或者某些任务的执行情况;
    - cron,自身是一个不间断的服务
    - anacron:cron的补充,能够实现让cron因为各种原因在过去的时间该执行而未执行的任务在恢复正常后正常执行一次;服务器上一般不启动anacron.
    - cron任务分为两类,他们的格式是不相同的:
        - 系统cron任务:比如每个月系统会删除/tmp目录中的文件;updatedb等操作;这些操作是系统自身的维护,和用户没有关系.定义在/etc/crontab中,格式前五段指时间,第六段指用户,第七段指任务: `分钟 小时 天 月 周 用户 任务`
        
        - 用户cron任务:定义在/var/spool/cron/USERNAME中;格式:`分钟 小时 天 月 周 用户 任务`
    - cron 通配表示: 
        - *:对应的所有有效取值.
            ```
            3 * * * *   //每小时的第三分钟
            3 * * * 4   //每周四的每小时的第三分钟
            13 12 * * * //每天的12点13分
            13 12 2 * * //每月的2号的12点13分
            ```
        
        - ,: 离散时间点取值
        
            ```
            10,20 02 * * *  // 每天的2点10分和2点20 执行
            ```
        
        - -:连续时间点:
        
            ```
            10 02 * * 1-5 //周一到周五的每天的2点10分执行.
            ```
        
        - /:对应取值范围内,每多久一次
            ```
            */3 * * * * //每3分钟执行一次      
            ```
        - 当设置每\#的时候, 比\#小的单位上必须要标注一个时间点,比如每两小时执行一次必须写成:`00 */2 * * *`,其中00可以用00-60任意数字代替
    - cron的执行结果将以邮件形式发给管理员,每几分钟执行一次的任务就会让人很痛苦了,所以我们可以用重定向来执行,比如我们只查看错误的执行结果:`*/3 * * * * cat /etc/fstab &> /dev/null`
    - cron的环境变量: cron执行的所有命令都去PATH环境变量制定的路径下去找.那如果用户没登陆,有些命令就找不到了;因此,cron中最好使用绝对路径;如果我们用的是脚本,那么我们最好在脚本中定义一下PATH, export PATH= 配置一下.
    - 定义用户cron
        - 编辑/var/spool/cron/USERNAME;不建议这么操作,万一写错了,系统是不会执行的
        - crontab命令:
            - -l: 显示当前用户任务的列表
            - -e: 编辑用户的任务,而且会检查语法错误
            - -r: 移除所有任务,其实是删除了/var/spool/cron/USERNAME这个文件.
            - -u USERNAME: 管理员用来管理其他用户的定时任务的,常和-e选项一起使用
    - anacron是cron的补充,如果cron中某个任务被掠过去了;其文件为/etc/anacrontab,这个文件格式为4段,前两段是指时间的,第三段是注释信息,第四段是要执行的任务.第一段是指过去该执行的任务已经多少天没执行了,第二段是只开机以后第\#分钟执行一次
    - 不管是cron还是anacron都必须保证crond和anacrond服务是运行的,企业服务器一般crond都是开启的,服务器也不会关机
        ```
        [root@Aphey tmp]# service crond status
        crond (pid  1034) is running...
        ```
#### 日志系统:syslog
- Linux上的日志系统: syslog(RHEL5),syslog-ng(ng: next generation,分为开源和商业版;RHEL6用的就是ng)
    - 信息的详细程序,日志级别声明不同的日志信息
    - 子系统:facility,设施设备.
    - 动作
- syslog服务有两个进程:
    - syslogd:负责记录非内核的其他设施所产生的日志
    - klogd:专门负责内核所产生的日志;所记录的日志的详细程度和 syslogd不一样,格式也不一样.
    - 在系统启动init之后,日志就交由syslogd来记录,之前则是有klogd记录
- 查看内核所产生的数值信息可以用`cat /var/log/dmesg`或者直接用命令`dmesg`查看.
- 日志:
    - /var/log/messages: 系统标准错误日志信息,记录的日志是非常详细的,一般非内核产生的引导信息都在这头; 各子系统产生的信息也在这里头.
    - 日志滚动(分割): 我们可以按照日志大小,时间;或者两者一起使用来切割日志,`logrotate`:滚动压缩,或者发送日志;系统上有个专门的计划任务能够完成日志滚动,在/etc/cron.daily(RHEL5)[/etc/cron.daily/logrotate(RHEL6)]
    - /var/log/maillog: 邮件系统产生的日志信息
    - /var/log/secure: 跟安全相关的,权限是600
- syslogdd的配置文件在/etc/syslog.conf
- 配置文件定义格式为: facility.priority        action ;facility,可以理解为日志的来源或设备,目前常用的facility有以下几种： 
    - auth      			\# 认证相关的 
    - authpriv  			\# 权限,授权相关的 
    - cron      			\# 任务计划相关的 
    - daemon    			\# 守护进程相关的 
    - kern      			\# 内核相关的 
    - lpr      			 \# 打印相关的 
    - mail     			 \# 邮件相关的 
    - mark     			 \# 标记相关的 
    - news     			 \# 新闻相关的 
    - security 			\# 安全相关的,与auth 类似  
    - syslog  			 \# syslog自己的 
    - user    			 \# 用户相关的 
    - uucp    			 \# unix to unix cp 相关的 
    - local0 到 local7 	\# 用户自定义使用 
    - \*        			\# \*表示所有的facility 

 
 - priority(log level)日志的级别,一般有以下几种级别(从低到高) 
    - debug           \# 程序或系统的调试信息 
    - info            \# 一般信息
    - notice          \# 不影响正常功能,需要注意的消息 
    - warning/warn    \# 可能影响系统功能,需要提醒用户的重要事件 
    - err/error       \# 错误信息 
    - crit            \# 比较严重的 
    - alert           \# 必须马上处理的 
    - emerg/panic     \# 会导致系统不可用的 
    - \*               \# 表示所有的日志级别 
    - none            \# 跟\* 相反,表示啥也没有 
     
 - action(动作)日志记录的位置 
    - 系统上的绝对路径    \# 普通文件 如： /var/log/xxx 
    - |                   \# 管道  通过管道送给其他的命令处理 
    - 终端              \# 终端   如：/dev/console 
    - @HOST               \# 远程主机 如： @10.0.0.1      
    - 用户              \# 系统用户 如： root 
    - \*                   \# 登录到系统上的所有用户，一般emerg级别的日志是这样定义的;也可以理解为发送给所有用户
    - 在动作前面有\- 的, 表示异步写入; 没有\- 表示同步写入.

- 定义格式例子：
    ``` 
    mail.info   /var/log/mail.log # 表示将mail相关的,级别为info及 
                                  # info以上级别的信息记录到/var/log/mail.log文件中 
    auth.=info  @10.0.0.1         # 表示将auth相关的,基本为info的信息记录到10.0.0.1主机上去 
                                  # 前提是10.0.0.1要能接收其他主机发来的日志信息 
    user.!=error                  # 表示记录user相关的,不包括error级别的信息 
    user.!error                   # 与user.error相反 
    *.info                        # 表示记录所有的日志信息的info级别 
    mail.*                        # 表示记录mail相关的所有级别的信息 
    *.*                           # 你懂的. 
    cron.info;mail.info           # 多个日志来源可以用";" 隔开 
    cron,mail.info                # 与cron.info;mail.info 是一个意思 
    mail.*;mail.!=info            # 表示记录mail相关的所有级别的信息,但是不包括info级别的 
    ```
- 一般syslog不能重启,一般都是用的`service syslog reload`  
#### ssh服务
- telnet远程登陆协议:基于tcp的应用层协议C/S架构远程登录机制,早期远程登录都是通过telnet来实现. 巨大缺陷:无论是命令还是认证过程都是明文发送的,很不安全; 默认23号端口
- ssh: Secure Shell协议22/tcp; 通信过程及认证过程都是加密的,还能实现主机认证:主机和客户端之间会通过密钥认证.用户认证过程是加密的,数据传输也是认证的,所以比telnet安全得多.
    - ssh有两个版本, v1,v2; v1已经不安全了,有一个man-in-middle 中间人攻击,就是第三方对客户冒充端服务器,对服务器冒充客户端,于是双方的数据会被中间人完全掌握,目前sshv1对这个基本说是毫无办法防范，所以建议使用sshv2.
    - ssh认证有两种方式:基于口令认证 和 基于密钥认证
- 协议:只是规范; 实现:服务器端和客户端
- linux: openssh 开源的C/S架构;
    - 服务器端:sshd,配置文件/etc/ssh/sshd_config 
    - 客户端:ssh, 配置文件/etc/ssh/ssh_config;其实openssh还提供了好几个工具:
        - ssh-keygen: 密钥生成器,为某个用户生成密钥
        - ssh-copy-id: 将公钥传输至远程服务器,保存在服务器家目录的某个文件中 
        - scp: 跨主机安全复制工具 
- 客户机的主机认证的密钥保存在/HOMEDIR/.ssh/known_hosts 中        
- ssh客户端登陆远程服务器,登陆方法有两种:
    - ssh USERNAME@HOST
    - ssh -l USERNAME HOST
    ```
    [root@Aphey rsyslog.d]# ssh 192.168.88.88   //下面这段话是做主机密钥认证
    The authenticity of host '192.168.88.88 (192.168.88.88)' can't be established.
    RSA key fingerprint is 08:6b:cd:09:51:03:09:b0:4f:36:4c:d5:34:8a:ad:6c.
    Are you sure you want to continue connecting (yes/no)? yes
    Warning: Permanently added '192.168.88.88' (RSA) to the list of known hosts.
    root@192.168.88.88's password:      //输入yes后会让我们输入root用户密码
    Last login: Mon Jun  5 08:24:30 2017 from 192.168.88.32 //登入成功;注意如果我们没指定用户的话,就以当前主机的用户 登陆服务器.所以我们常用 ssh USERNAME@HOSTNAME 来登入远程
    ```
    - 我们还可以通过 ssh -l USERNAME HOST 'COMMAND' 进行不登录主机,却在主机中操作COMMAND命令,并显示到本地主机.
        ```
        [root@Aphey ~]# ssh -l root 192.168.88.88 'ifconfig'
        root@192.168.88.88's password: 
        eth0      Link encap:Ethernet  HWaddr 20:CF:30:0B:34:9B  
                  inet addr:192.168.88.88  Bcast:192.168.88.255  Mask:255.255.255.0
                  inet6 addr: fe80::22cf:30ff:fe0b:349b/64 Scope:Link
                  UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
                  RX packets:2546570 errors:0 dropped:0 overruns:0 frame:0
                  TX packets:2146814 errors:0 dropped:0 overruns:0 carrier:0
                  collisions:0 txqueuelen:1000 
                  RX bytes:601199555 (573.3 MiB)  TX bytes:692255488 (660.1 MiB)

        lo        Link encap:Local Loopback  
                  inet addr:127.0.0.1  Mask:255.0.0.0
                  inet6 addr: ::1/128 Scope:Host
                  UP LOOPBACK RUNNING  MTU:16436  Metric:1
                  RX packets:684087 errors:0 dropped:0 overruns:0 frame:0
                  TX packets:684087 errors:0 dropped:0 overruns:0 carrier:0
                  collisions:0 txqueuelen:0 
                  RX bytes:231649659 (220.9 MiB)  TX bytes:231649659 (220.9 MiB)
        ```
    - scp: `scp SRC DEST` 
        - -r: 递归复制
        - -a:保留文件的所有属性,常用于备份;也叫归档复制.
        - 以USERNAME的身份从远程主机复制到本地的方法:`scp USERNAME@HOST:/path/to/somefile /path/to/local`;从本地复制到远程的服务器上也是一样的操作:`scp /path/to/local USERNAME@HOST:/path/to/somefile `
    - ssh-keygen: `ssh-keygen -t rsa`生成一对密钥,密钥保存在~/.ssh/id_rsa;公钥保存在~/.ssh/id_rsa.pub; 公钥追加保存到远程主机某用户的家目录的.ssh/authorized_keys目录中或.ssh/authorized_keys2目录中,注意千万不能覆盖,因为不止 你一个人要链接到那个主机上;这个命令的常用选项如下,也可以不加选项:
        - -f FILENAME: 直接指定密钥的文件名
        - -P '密码': 为密钥文件加一个密码;留空这表示不加密,就不用按两次回车了.
        ```
        [root@Aphey ~]# ssh-keygen -t rsa   //在客户机上生成一怼密钥
        Generating public/private rsa key pair.
        Enter file in which to save the key (/root/.ssh/id_rsa): 
        Enter passphrase (empty for no passphrase):     //这个是为密钥文件再加密码,如果加了密码将来还得再输这个密码,所以我们这里不加,直接回车
        Enter same passphrase again:     //这个是为密钥文件再加密码,如果加了密码将来还得再输这个密码,所以我们这里不加,直接回车 
        Your identification has been saved in /root/.ssh/id_rsa.
        Your public key has been saved in /root/.ssh/id_rsa.pub.
        The key fingerprint is:
        69:8f:2d:8f:4d:b8:25:5e:49:21:76:2a:a0:2b:8e:61 root@Aphey
        The key's randomart image is:
        +--[ RSA 2048]----+
        |                 |
        |                 |
        |    .   o o      |
        |   . . . = .     |
        |  .   . S .      |
        |   .   o * .     |
        |oE.     = B      |
        |+o     . @       |
        |..      + o      |
        +-----------------+
        [root@Aphey ~]# ls .ssh/    //密钥已经生成
        id_rsa  id_rsa.pub  known_hosts
        [root@Aphey ~]# scp .ssh/id_rsa.pub root@192.168.88.88:/root    //我们把公钥先传到远程服务器上
        root@192.168.88.88's password: 
        id_rsa.pub                                    100%  392     0.4KB/s   00:00    
        [root@Aphey ~]# ssh root@zhumatech.net  //远程到服务器上
        root@zhumatech.net's password: 
        Last login: Mon Jun  5 08:51:34 2017 from 192.168.88.38
        [root@zhumatech ~]# ls  //文件已经传输过来了
        anaconda-ks.cfg  install.log.syslog       upgrade.log
        id_rsa.pub       postgresql-9.5.1         upgrade.log.syslog
        install.log      postgresql-9.5.1.tar.gz
        [root@zhumatech ~]# ls -a   //我们发现远程服务器root用户家目录没有.ssh目录
        .                .gradle             postgresql-9.5.1.tar.gz
        ..               id_rsa.pub          .swp
        anaconda-ks.cfg  install.log         .tcshrc
        .bash_history    install.log.syslog  .test.swp
        .bash_logout     .lesshst            upgrade.log
        .bash_profile    .oracle_jre_usage   upgrade.log.syslog
        .bashrc          .pki                .viminfo
        .cshrc           postgresql-9.5.1
        [root@zhumatech ~]# mkdir .ssh  //创建.ssh目录
        [root@zhumatech ~]# chmod 700 .ssh  //.ssh目录的权限必须是700,我们改一下
        [root@zhumatech ~]# cat id_rsa.pub >> .ssh/authorized_keys
        [root@zhumatech ~]# exit
        [root@Aphey .ssh]# ssh root@zhumatech.net
        Last login: Mon Jun  5 09:31:37 2017 from 192.168.88.1
        [root@zhumatech ~]# 
        ```
    - 进行上面的操作时,如果远程服务器是RHEL6以上版本,___需要关闭Selinux___
    - ssh-copy-id:专门用来复制公钥到远程服务器用户家目录的.ssh目录的,如果.ssh目录不存在还能自动创建目录,还会自动追加到authorized_keys中去;
        - -i ~/.ssh/id_rsa.pub: 指定公钥文件
        ```
        [root@Aphey .ssh]# ssh-copy-id -i ~/.ssh/id_rsa.pub root@zhumatech.net
        root@zhumatech.net's password: 
        Now try logging into the machine, with "ssh 'root@zhumatech.net'", and check in:

          .ssh/authorized_keys

        to make sure we haven't added extra keys that you weren't expecting.

        [root@Aphey .ssh]# ssh root@zhumatech.net
        Last login: Mon Jun  5 09:31:52 2017 from 192.168.88.1
        [root@zhumatech ~]#     //成功免密码登陆
        ```
- 由于ssh太重量级,有一种嵌入式的小ssh系统;dropbear嵌入式系统专用的ssh服务器端和客户端工具,一般用于系统裁剪.
    - 服务器端:dropbear
        - 密钥生成器: dropbearkey,为服务器端用来生成主机认证的key;生成的主机密钥默认位置:/etc/dropbear/;RSA:dropbear_rsa_host_key,长度可变,只要是8的整数倍,默认是1024; DSS:dropbear_dsa_host_key,长度固定,默认1024
            - -t &lt; rsa|dsa &gt;
            - -f /path/to/KEY_FILE
            - -s SIZE 长度
    - 客户端叫: dbclient.
    - dropbear 默认使用nsswitch实现名称解析
    - dropbear 会在用户登陆时检查其默认shell是否为当前系统的安全shell,即写在/etc/shells中的shell
#### RHEL5.8以及Kickstart
- 系统安装过程:有一个重要的程序给我们提供了安装过程的配置界面,叫anaconda: 主要分成两个配置阶段,在第二个阶段Stage2,这是一个完整的rootfs,在这个rootfs中主要配置anaconda程序及其以来的环境和文件等.在images/目录中有一个statge2.img.anaconda给我们提供的配置界面有两种方式:text和gui界面,不管那种界面,我们都要配置很多信息.为了实现自动安装,anaconda还提供了一个能够自动读取的配置文件叫kickstart
- kickstart中保存了我们在anaconda配置过程当中所有可以实现的配置过程,因此anaconda在启动安装过程中如果能读取kickstart文件就能够实现完全的自动化安装操作系统.
- 当系统文件安装完成后在管理员家目录下有一个anaconda-ks.cfg的文件,正是保存了我们自己在选择安装过程的时候,我们所有自行选择的配置信息,以此可以作为我们以后自定义kickstart文件时候的样板文件
- anaconda-ks.cfg由三部分组成
    - 命令段,分为下面两类
        - 必备命令,一般来讲的有下面几个常用命令:
            - keyboard
            - lang
            - timezone
            - rootpw
            - authconfig --useshadow
            - bootloader --location
            - ___clearpart:如何清除分区;常用的是 --linux 只清除linux分区;如果没有分区表(全新的硬盘)则用--initlabel ___ 
            - driverdisk --source= &lt; 分区|ftp://|http://|nfs:host:/path/to/img &gt; : 指定驱动磁盘的
            - firewall --enabled|--disabled: 是否启用防火墙
            - firstboot --disabled: 建议禁用,否则会让你配置很多的东西
            - halt|reboot: 安装完可以关机|重启
            - text|graphical: 纯文本界面安装|图形安装界面,默认是图形的
            - install|upgrade: 表明是安装还是升级的
        - 可选命令: 有些命令虽然是可选的,但是一旦你没选,系统又不知道怎么办的时候,仍然会中止自动化安装让你自己选.
    - 软件包选择段
    - 脚本段
        - %pre系统安装前执行的脚本;因为写脚本受的限制很多,很多命令不能正常执行
        - %post系统安装后执行的脚本;比较常用.
- 我们也可以把anaconda-ks.cfg放在U盘,网络上,也可以,然后在安装的时候指定ks配置文件的位置`ks=http://`,当在光盘上的时候`ks=cdrom:/path/to/ks.cfg`
- 安装过程中,boot提示符中可以使用的命令,下面的命令是输入在linux之后,即格式为 `boot linux COMMAND`:
    - askmethod
    - dd
    
    - ip=IPADDR 指定IP地址
    - netmask=NETMASK 指定子网掩码
    - gateway=GATEWAY 指定网关    
    - dns=DNS 指定DNS
    
    - ks=KS.CFG 指定KS配置文件 //ks中也可以指定ip地址,在装载ks之前,上面的IP是生效的,一旦ks装载完成了,则以ks中定义的为准. 
    
    - rescue: 进入紧急救援模式
- `locale -a` 查看支持的语言
- `timeconfig`: 查看所有时区
- `ksvalidator KS.CONF` 可以帮我们检查ks.conf中是否有语法错误,需要安装`yum -y install system-kickstart-config`
- `system-config-kickstart &`可以打开一个图形界面来配置KS.CFG 然后可以只接保存
- 如何把KS.CFG放到光盘上
    1. 把手动输入的东西都保存到kickstart里面: 在光盘里有个 images/目录,里面有个小的引导光盘boot.iso.
    2. 针对RHEL5我们把boot.iso复制出来再挂在起来`mount -o loop boot.iso /mnt`,里面只有TRANS.TBL和一个isolinux目录; RHEL6没有boot.iso,只接在images/目录中就有isolinux/目录.
    3. 准备一个kickstart文件KS.CFG
    4. 我们创建一个目录/tmp/iso,然后把boot.iso中的文件复制过来(看第二步),`cp -r /mnt/* /tmp/iso`
    5. 把KS.CFG复制到/tmp/iso中去;然后在isolinux/中有一个isolinux.cfg是定义我们的配置界面所输出的参数的,在defalut linux后面加上 ks=cdrom:/ks.cfg. 
    6. 创建镜像:___退到iso目录外面___`cd /tmp`,输入`mkisofs -R -b isolinux/isolinux.bin -no-emul-boot -boot-load-size 4 -boot-info-table -o boot.iso iso/`
    7. 然后我们可以去用虚拟机装载boot.iso 启动看看;在出现boot界面时,只接按回车.
#### Linux故障排除
- 常见的系统故障排除
    1. 确定问题的故障特征
    2. 重现故障:自己能不能再人为的制造出一模一样的故障
    3. 使用工具收集进一步信息,确定故障的真正根源
    4. 排除不可能的原因
    5. 定位故障:从简单的问题入手,一次尝试一种方式,如果不能解决,还原成原来的样子,再尝试另一种方法.
- 故障排除原则:
    1. 一定要备份原文件
    2. 尽可能借助于工具
- 可能会出现的故障:
    1. 忘记了管理员密码: _进入单用户模式_
    2. 系统无法正常启动
        - grub损坏(MBR损坏,grub配置文件丢失,第二段文件损坏): 
            - 解决方案1: 拆掉硬盘,借助别的主机修复
            - 解决方案2: 使用紧急救援模式
                - 只使用boot.iso,这个文件只能帮我们启动引导界面,如果要基于boot.iso来进行工作的话,还要确保整个网络当中有一台主机提供安装环境的.
                -  最可靠的方式:使用完整的系统安装光盘,在boot: linux rescue;类似WinPE.
                - 然后进入配置界面,首先就是让你选择语言,和键盘类型,然后系统会尝试运行anaconda,而后在anaconda的主使下,会启动一个小的linux,并将其作为我们的工作环境.
                - 接下来系统会问我们是否启动网络接口,我们在接下来的修复过程中可能会用到网络功能,所以我们选择启用网络接口.
                - 然后,系统会问我们是否配置eth0的网卡,我们启动ipv4,然后我们手动指定IP地址;然后配置网关,DNS.
                - 接着,系统会尝试启动eth0,然后就进入resue修复模式,提示我们选择文件系统的挂在方式,我们使用continue.
                - RHEL5搜索完成后提示我们已经挂在到/mnt/sysinmage;
                - 然后就登陆到小linux了;RHEL6则需要我们手动输入`chroot /mnt/sysimage/`;注意,输入这个命令后提示符由`bash-4.1#`变成了`sh-4.1#`
                - 然后就可以安装grub了
                ```
                // RHEL5的安装grub方法
                sh-3.2# grub
                sh-3.2# find (hd0,0)/KEY_TAB   //先查找根(内核所在的分区)的位置
                sh-3.2# root (hd0,0)   //指定根在什么地方
                sh-3.2# setup (hd0)  //安装,只需要指定设备就可以了;等待安装完成即可
                //RHEL6的安装grub的方法
                bash-4.1# chroot /mnt/sysimage/ //切换更目录
                sh-4.1#                         //切换成功后,提示符变了
                sh-4.1# grub-install -root-directory=/ /dev/sda     //然后等待安装完成即可
                ```
            - REHL6的修复方法可参考[这个帖子](http://www.cnblogs.com/swordxia/p/4616054.html)
        - grub没问题,grub配置文件丢失:
            ```
            grub> root(hd0,0)
            grub> kernel /vmlinuz-VERSION ro root=/dev/vol0/root rhgb quiet
            grub> initrd /initrd-VERSION
            grub> boot
            // 下面实验
            [root@Aphey ~]# mv /boot/grub/grub.conf /root/  //把grub.conf移动到/root/目录下
            [root@Aphey ~]# sync
            [root@Aphey ~]# shutdown -r now //重启电脑,开机会只接跳到grub> 提示符界面
            grub> root (hd0,0)  //可以先find (hd0,0)/按tab键
            grub> kernel /vmlinuz-VERSION ro root=/dev/sda3 rhgb quiet
            grub> initrd /initrd-VERSION
            grub> boot
            ```
        - grub正常,系统初始化故障(某文件系统无法正常挂载,驱动不兼容等)
            ```
            在rc.sysinit中把对应的行先注释掉,然后正常启动以后再来配置
            ```
        - 用户无法登陆(mingetty(可以用单用户模式解决),bash程序故障): 
            ```
            比如一不小心把/bin/bash 删除了;1级别也需要用bash,所以这个单用户模式也进不去;这种情况下我们只能通过紧急救援了.
            这个时候我们已经挂在了光盘,然后挂在/dev/hdc(其实就是光盘),注意不可挂载到/mnt了.因为小系统就在/mnt/sysimage/里
            挂在好以后就可以
            ```
        - 把默认级别设定为0或6: 进入单用户模式,编辑inittab文件
        - 一不小心把/etc/rc.d/rc3.d/目录删除了: 同样进入单用户模式,修复目录系统
        - 系统初始化没问题,某一个服务无法正常启动也有可能导致系统无法启动,比如sendmail服务: 有时候时间被改了,配置文件时间戳检查无法通过: 单用户模式,去对应的运行级别里 把sendmail服务关了,或者修复一下时间戳;第三种方法是在开机的时候,出现redhat时,快速地敲击I键,进入交互模式.
        - rc.local脚本语法错误或者出现逻辑错误: 单用户模式可以修改  
    3. 命令无法运行: 一般都是PATH 变量出问题了. export PATH=$PATH:/path/to/some/directory 或者退出当前登陆,另启终端,重新登陆.
    4. 编译过程无法继续(开发环境缺少基本组件)
#### sudo 详解
- 假如你有50台服务器,你管不过来 想找两个人来帮你管理:
    - 一个管理网络: 定义网络属性
    - 另一个管理用户: 用户管理
- sudo COMMAND,一般用户能够以另外一个用户的身份去执行某些命令,而又不用切换到那个用户,只不过在执行这个命令的时候,用的是那个执行文件属主的身份,在某种成都上和suid有点像. 而且这些命令还是管理员定义的命令范围内的.
- 简短截说,sudo就是某个用户能够以另外某一个用户(未必是管理员)的身份通过某主机执行某命令.
- 我们还可以让要执行命令的用户在执行命令时输入密码,避免了别人恶意冒充.
- sudo的配置文件/etc/sudoers,为了避免别人能查看,这个文件的权限是440.不建议用`vim /etc/sudoers`,因为不带语法检查,一旦这个配置文件里有语法错误,别人是无法 用sudo命令,甚至系统会崩溃,建议使用`visudo`
- visudo 语法格式:
    - who   from which hosts to connect the server =(run as whom)  command
    - 我们可以定义多个用户都以root的身份执行用户管理命令;我们可以进行用户组,命令组的别名机制
    - 别名支持四类,别名必须全部而且只能使用大写英文字母的组合;别名还可以用"!"取反:
        - 用户别名,可以定义用户名,%组名,还可以包含其他已经定义好的别名: User_Alias `User_Alias USERADMIN=aphey, tom, jerry, %GROUPNAME`
        - 主机别名,可以定义主机名,IP,网络地址,或者其他主机别名: Host_Alias
        - 身份别名,可以包含用户名,%组名,\#UID,或者其他的Runas组名;如果不写,则默认为管理员: Runas_Alias
        - 命令别名,命令最好使用绝对路径,可以包含命令路径,可以是个目录(此目录内的所有命令),其他已定义的命令别名: Cmnd_Alias
    - 别名必须先定义,然后才能使用;sudo会在用户第一次执行命令的5分钟内保留账号的密码信息;sudo 有一个\-k 选项, 只要用了`sudo -k`,可以使之前输入的认证信息失效;`sudo -l`可以列出当前用户可以使用的全部可以使用的命令;`sudo -c`
- sudo 还可以给命令前面加上标签"NOPASSWD:",哪么用户在使用sudo命令时,就不需要输入密码了;我们可以这么定义
    ```
    User_Alias USERADMIN = hadoop, %hadoop, %useradmin
    Cmnd_Alias USERADMINCMND = /usr/sbin/useradd, /usr/sbin/usermod, /usr/bin/passwd, ! /usr/bin/passwd root
    hadoop  ALL=(root)  NOPASSWD: /usr/sbin/useradd [A-Za-z]*, PASSWD: /usr/sbin/usermod, USERADMINCMND
    USERADMIN   ALL=(root)  NOPASSWD: USERADMINCMND
    ```
- sudo的操作记录会记录在/var/log/secure中
#### 加密类型及其相关算法
- TCP/IP安全
    - 机密性: 明文传输的协议(ftp,http,smtp,telnet)
    - 完整性: 必须要得到保证,任何时候我们得到的数据跟对方发过来的数据有不一致的时候,我们都拒绝使用这个数据,就能保证数据完整性
    - 身份验证
- 如何保证数据的机密性: 明文数据 --> 转换规则 --> 密文
    - 转换算法+密钥来保证机密性
    - 对称加密: 是指加密和解密的密码是一样的;计算速度非常快,但是安全性几乎完全依赖于密钥;在一定程度上解决了数据的机密性问题,但却无法解决用户密钥管理的问题.
- 数据完整性: 
    - 单向加密算法:提取数据特征码;比如下载的软件的MD5码;单向加密特征:
        - 输入一样: 输出必然相同
        - 雪崩效应: 输入的微小改变,将会引起结果的巨大改变
        - 定长输出: 无论原始数据多大,结果大小都是相同的
        - 不可逆性: 不可能通过特征码还原原来的数据
    - 所以游戏,软件官方会放出MD5码;中间人攻击,先截取数据,更改数据重新生成特征码,那么接收方也是会信以为真;为了避免这种情况发生,我们可以对特征码加密; 协商生成密钥:密钥交换(Internet Key Exchange,IKE),不让第三方知道,需要特殊的互联网协议支撑;最早的交换协议就是 Diffie-Hellman协议
- 身份认证:也叫公钥加密算法(非对称加密算法);非堆成加密主要作用也就是身份验证
    - 密钥对: 公钥:P和私钥:S;公钥不是独立的是从私钥中提取出来的;我们用自己的私钥加密,并不能保证数据的机密性,因为对应的公钥所有人都知道,我们可以用接收方的公钥加密,这样只有接收方的私钥可以解密.
    - 发送方用自己的私钥加密,可以实现身份验证
    - 发送方用接收方的公钥机密,可以保证数据的机密性
    - 其实公钥加密算法很少用来加密数据,速度太慢,因为密钥太长,一般来讲,公钥加密算法比对称加密算法要速度慢上3个数量级(1000倍);通常用来做身份验证.
    - 公钥传递:第一次通信请求公钥,并不能确认对方就是我们需要找的人,于是我们只能求助于第三方机构:发证机构(比如公安局),先生成密钥对,把公钥提交到发证机构做公证,发证书(姓名,地址,以及公钥,还有发证机关的戳等等). 
- 两种方法结合起来: 先计算数据特征码,放在数据后面,为了保证别人篡改不了特征码,用自己的私钥先给特征码加密,再放在数据后面,发给接收方;此时就算别人截取了数据,篡改数据,但他却不能用发送发的私钥再加密特征码.
- PKI: Public Key Infrastructure,公钥基础设施;核心就是证书颁发机构及彼此间的信任关系(就是多个机构之间互相信任)
- 私钥一定要加密存放,带来的问题就是用私钥加密的时候会让你输入密码.
- 私钥丢失怎么办? 当私钥丢失势必会造成证书失效,一个完整的CA(Certificate Auhtority 证书权威机构)还要维护一个证书吊销列表(CRL:Certificate Revoke List),其中保存的就是此前发出去的证书,但仍未过期,只不过由于各种原因已经被撤销了;所以正规的做法是去的了某个证书,应该先去看看这个证书是不是自己信任的认证机构颁发的,如果是的话,还得查看证书颁发机构的证书撤销列表中是不是包含当前获得的这个证书.如果是,则应该拒绝使用此证书.
- 数字证书中包含的内容,不同的证书格式是不一样的,最通用的就是x509,主要包含以下内容:
    - 公钥及其有效期限
    - 证书的合法拥有者
    - 证书该如何被使用
    - CA的信息
    - CA签名的校验码(简单理解为CA的签名)
- 互联网上著名的TLS/SSL(PKI实现机制的一种)用的就是x509格式;Linux上还有一种PKI实现机制叫OpenGPG.
    - https(协议用的是443端口)
    - http协议在传输数据时是明文的,为了基于加密的机制能够实现http,Netscape(网景公司)就在TCP层和应用层之间引入了半个层,称为SSL,SSL不是一个软件,可以理解为一个库,让应用层某种协议在传输数据到TCP层之前,调用了SSL的功能,哪么这个协议就能具备加密的功能了;众多的应用层的明文协议都可以通过SSL的功能来实现数据的安全传输的.
    - SSL:Secure Socket Layer,安全的套接字层,SSL发行了SSLV1(已经不在使用),SSLV2,SSLV3三个版本;我们要想实现SSL功能,只要提供SSL相关库文件,就能够将http封装成https协议.
    - SSL说到底是某一家公司的协议,国际标准化组织就不敢了,就准备出来研发一个能够在全球流行的更为开放的所谓另外一层意义上的通用性协议;于是TLS就诞生了,Transport Layer Security传输层安全,目前版本是V1版本;实际上TLSV1相当于SSLV3,他们实现的原理和机制差不多;注意,有些特定的软件只支持两者中的一种,需要我们为其选定加密机制.
    - 两台主机之间,会话是怎么建立的; https(基于tcp);三次握手以后,客户端先发起请求到服务器端,服务器会和客户端协商建立SSL会话;然后服务端会将自己的证书发给客户端;然后客户端会去验证证书;然后客户端会生成一个随机的对称密钥;然后传输加密后的对称密钥给服务器;然后服务器段会通过这个对称密钥加密数据传输给客户端.
- 对称加密算法:
    - DES:Data Encription Standard 56bit密钥 数据加密标准,2000年左右可以用性能不错的电脑暴力破解
    - 3DES: Triple DES 但是人们不是特别信任他,于是AES诞生了.
    - AES Advanced Encription Standard 128bit密钥
        - AES192,AES256,AES512;越长安全性越高,速度也越慢;合式的才是最好的.
    - blowfish
- 单项加密算法:
    - MD4
    - MD5: 128bit
    - SHA1
    - SHA: 160bit
        - SHA192,SHA256,SHA384,SHA512;单项加密是定长输出的,这里的数字指的是输出长度
    - CRC-32 循环冗余校验码;并不是加密算法;不提供任何安全性
- 非对称加密(公钥加密),核心功能是加密和签名:
    - 身份认证(数字签名)
    - 数据加密
    - 还能实现密钥交换     
    - 常见的算法有下面几种
    - rsa既能实现加密,也能实现签名
    - dsa只能实现签名,是公开使用的
    - ElGamal:商业版的
- 加密解密需要算法来实现,因此我们就需要工具在主机上实现算法的实践,在Linux上不同的加密机制,提供的工具是不一样的
    - 对称加密: openssl、gpg也可以
- openSSL:SSL开源实现,功能非常强大,几乎实现了所有主流加密算法,工作性能非常强大;openssl是个软件由三部分组成:
    - libcrypto: 加密库
    - libssl: TLS/SSL的实现;基于会话的,实现了身份认证,数据机密性和会话完整性的库
    - openssl:多用途命令行工具,实现私有证书颁发机构;可以在内网完成认证.
- Openssl详细介绍:
- /etc/pki/tls/openssl.cnf 这个文件主要为了让OPENSSL工作成私有CA用到的,平时用命令行用不到
- openssl有很多的子命令,常用的如下:
    - --help: 显示帮助信息
    - `openssl speed 加密算法`:测试某种加密算法的速度,如果后面不跟加密算法,则会把每种加密算法都测试一遍
    - 我们man某个命令之前最好先执行`whatis COMMAND`查看一下他的信息,比如,openssl有个子命令叫passwd,我们得先查看whatis passwd 会发现他下面会列出一个`passwd [sslpasswd]   (1ssl)  - compute password hashes`,所以对应的我们应该`man sslpasswd`
    - 子命令enc(encryption): 对称加密`openssl enc -算法名字 -in 源文件名 -out 加密后的文件名 [-e或者不写 表示加密|-d 表示解密] [-salt 可以实现更高的安全性] [-a|-base64 基于base64的机制进行数据处理,最好写上这个选项]`
        ```
        [root@Aphey ~]# cp /etc/inittab .
        [root@Aphey ~]# ls
        anaconda-ks.cfg  inittab      install.log.syslog
        functions        install.log  mbr.backup
        [root@Aphey ~]# openssl enc -des3 -in ./inittab -out inittab.des3 -a -salt -e
        enter des-ede3-cbc encryption password:
        Verifying - enter des-ede3-cbc encryption password:
        [root@Aphey ~]# ls
        anaconda-ks.cfg  inittab       install.log         mbr.backup
        functions        inittab.des3  install.log.syslog
        [root@Aphey ~]# cat inittab.des3 
        一堆乱码....
        [root@Aphey ~]# ls
        anaconda-ks.cfg  functions  inittab.des3  install.log.syslog
        aphey            inittab    install.log   mbr.backup
        [root@Aphey ~]# rm inittab
        rm: remove regular empty file `inittab'? y
        [root@Aphey ~]# openssl enc -des3 -d -a -in inittab.des3 -out inittab
        enter des-ede3-cbc decryption password:
        [root@Aphey ~]# ls
        anaconda-ks.cfg  functions  inittab.des3  install.log.syslog
        aphey            inittab    install.log   mbr.backup
        [root@Aphey ~]# cat inittab
        # inittab is only used by upstart for the default runlevel.
        .... //可以查看了
        ```
    - 子命令dgst(digest):可以计算文件的特征码
        ```
        [root@Aphey ~]# md5sum inittab  //这个也能显示文件的特征码
        753a386bcd9ab0ca581056348463891e  inittab
        [root@Aphey ~]# sha1sum inittab //这个也能显示文件的特征码
        7f1a11159e1f44a5b2f2f9de2b99ab3f23e0ef1f  inittab
        [root@Aphey ~]# openssl dgst -sha1 inittab  //显示结果和上面的一样
        SHA1(inittab)= 7f1a11159e1f44a5b2f2f9de2b99ab3f23e0ef1f
        [root@Aphey ~]# openssl dgst -md5 inittab   //显示结果和上面的一样
        MD5(inittab)= 753a386bcd9ab0ca581056348463891e
        ``` 
    - 子命令passwd:计算密码hash,防止密码以明文方式出现:
        - -1: 表示采用的是MD5加密算法。
        - -in：表示从文件中读取密码
        - -stdin：从标准输入读取密码
        - -salt：指定salt值，不实用随机产生的salt。在使用加密算法进行加密时，即使密码一样，salt不一样，所计算出来的hash值也不一样，除非密码一样，salt值也一样，计算出来的hash值才一样。salt为8字节的字符串。
        ```
        [root@Aphey ~]# vi a    //新建一个文件a
        [root@Aphey ~]# cat a   //查看a的内容,a的内容为root
        root
        [root@Aphey ~]# openssl passwd -1 -salt JVyQC3vh    //指定salt 创建密码hash
        Password:   //我输入了root
        $1$JVyQC3vh$gt4tt7uJlMqL3Z6UsNIsR/
        [root@Aphey ~]# openssl passwd -1 -in ./a  -salt JVyQC3vh    //从文件a读取内容作为密码,我指定了salt就为了确认salt一样,密码一样,出来的hash值是不是一样.
        $1$JVyQC3vh$gt4tt7uJlMqL3Z6UsNIsR/  //结果是一样
        ```
    - 子命令rsa: 密钥处理工具
    - 子命令rsautl: rsa加密解密工具;一般用的不多 
    - 子命令rand: 生成伪随机数
        ```
        [root@Aphey ~]# openssl rand -base64 45
        XsFmDh0+OLeecUYWqu4Ijp4viFJa5TfRN64if+d8dxz/Xsv0JJupRwZEBRbs
        ```
#### openssl实现私有CA:只要实现加密解密通信,基本都要用到证书
- 公司模拟实现一个https服务器,就得给web服务器发一个证书,我们就自己给自己做证书,我们就需要实现一个私有CA,步骤需要两步:
    1. 生成一对密钥,命令就是openssl的子命令genrsa[gendsa];这个命令是帮我们生成私钥的,公钥是从私钥中提取的,有了私钥就能够得到公钥;这个文件的权限最起码应该是600;我们可以先生成再改权限,或者生成的时候就让它是600权限`openssl genrsa [-out|或者输出重定向 输出文件名称] [-des|-des3 给私钥加密,不常用] [numbits,数字,指定密钥长度,默认是512]`
    
        ```
        [root@Aphey ~]# openssl genrsa -out server.key
        Generating RSA private key, 1024 bit long modulus
        .......++++++
        ............................................++++++
        e is 65537 (0x10001)
        [root@Aphey ~]# cat server.key 
        -----BEGIN RSA PRIVATE KEY-----
        私钥内容忽略不计...
        -----END RSA PRIVATE KEY----- 
        // 然后更改server.key的权限为600   
        ```
        - 小技巧 (COMMAND) 表示在子shell中运行,运行完成后退出子shell,子shell中的所有设定和我们也没关系了,所以我们可以这么来生成600权限的server.key
            ```
            [root@Aphey ~]# rm -f server.key 
            [root@Aphey ~]# (umask 077;openssl genrsa -out server.key)
            Generating RSA private key, 1024 bit long modulus
            .........++++++
            ..++++++
            e is 65537 (0x10001)
            [root@Aphey ~]# ll server.key 
            -rw-------. 1 root root 891 Jun  9 15:30 server.key
            [root@Aphey ~]# umask   //子shell中的设定不影响我们当前的shell
            0022
            ```
        - 输出公钥:`openssl rsa -in 密钥文件 -pubout`
            ```
            [root@Aphey ~]# openssl rsa -in server.key -pubout
            writing RSA key
            -----BEGIN PUBLIC KEY-----
            MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDfYYuwpAvJ/k2mZT6WVfrGG9r0
            a0t+4kyBJkbEc+q+P4Q+y70HCBjkR2JeYezAUePlyn+eRwZrJNqvDsKa132TSMou
            RI63L0DQrq0OSQ6q6kzDwc9Zrz7V9eDWJp4Pv8Ss4TNRNel0IzMd6eU0yy06Lvca
            ld4MbId1f7f+rLJPSQIDAQAB
            -----END PUBLIC KEY-----
            ```
        - 简单来说生成一对密钥的命令为:1.生成私钥`openssl rsa -out 私钥文件名`;2.提取公钥`openssl rsa -in 私钥文件名 -pubout`
    2. 生成自签署证书
        - 要想生成自签署证书,我们用`openssl`的子命令 `req`,这是一个生成和申请证书的工具,如果我们用了`-x509`我们就生成自签证书.
        - 命令格式`openssl req -new -x509 -key /PATH/TO/PRIVATEKEY -out CERTIFICATE_NAME -days #(有效期限,单位为天)`
        
        ```
        [root@Aphey ~]# openssl req -new -x509 -key server.key -out server.crt -days 365
        You are about to be asked to enter information that will be incorporated
        into your certificate request.
        What you are about to enter is what is called a Distinguished Name or a DN.
        There are quite a few fields but you can leave some blank
        For some fields there will be a default value,
        If you enter '.', the field will be left blank.

        Country Name (2 letter code) [XX]:China
        string is too long, it needs to be less than  2 bytes long
        Country Name (2 letter code) [XX]:CN
        State or Province Name (full name) []:Jiangsu
        Locality Name (eg, city) [Default City]:Wuxi
        Organization Name (eg, company) [Default Company Ltd]:Zhuma Tech
        Organizational Unit Name (eg, section) []:Development
        Common Name (eg, your name or your server's hostname) []:Aphey
        Email Address []:wjl@163.com
        [root@Aphey ~]# ls
        a                functions     install.log         server.crt
        anaconda-ks.cfg  inittab       install.log.syslog  server.key
        aphey            inittab.des3  mbr.backup
        ```
        - 此时我们查看server.crt时发现是一堆乱码,我们可以把证书内容输出出来的,用这个命令:`openssl x509 -text in server.crt`
        ```
        [root@Aphey ~]# openssl x509 -text -in server.crt 
        Certificate:
            Data:
                Version: 3 (0x2)
                Serial Number: 17279645670446881320 (0xefcda22f8f9a5a28)
            Signature Algorithm: sha1WithRSAEncryption
                Issuer: C=CN, ST=Jiangsu, L=Wuxi, O=Zhuma Tech, OU=Develpment, CN=Aphey/emailAddress=wjl@163.com
                Validity
                    Not Before: Jun  9 07:50:58 2017 GMT
                    Not After : Jun  9 07:50:58 2018 GMT
            ...
        ```
- 如果我们的服务器需要想我们的CA申请证书,我们的具体操作
    - 配置我们的CA,它的配置文件在/etc/pki/tls/openssl.cnf
        - 查看这个配置文件,主要是CA默认项[CA_default]这一段.
            ```
            dir		= /etc/pki/CA		//CA总路径
            certs		= $dir/certs		// 证书存放路径,目录需要创建
            crl_dir		= $dir/crl		// 证书吊销列表存放路径,目录需要创建
            database	= $dir/index.txt	// 依法证书索引文件
            new_certs_dir	= $dir/newcerts		//新证书存放位置,目录需要新建
            certificate	= $dir/cacert.pem 	// CA证书,证书颁发机构自己的证书,注意后缀
            serial		= $dir/serial 		// 当前办理证书序列号
            crlnumber	= $dir/crlnumber	// 证书吊销列表中的序列号
            
            crl		= $dir/crl.pem 		// 证书吊销列表的文件
            private_key	= $dir/private/cakey.pem    // CA自己的私钥
            RANDFILE	= $dir/private/.rand	// 随机数文件
            default_days	= 365			// 证书有效期
            default_crl_days= 30			// 证书吊销以后,在证书吊销列表中存放多少天
            default_md	= default		// 公钥的默认信息摘要(特征码)Message Digest
            
            //还有下面国家 地区部门等默认信息,我们可以选择性地改
            ```
    - 准备工作:
        1. 创建CA自己的私钥,私钥应该保存在/etc/pki/CA/private/目录当中.
            ```
            [root@Aphey ~]# cd /etc/pki/CA/private/ //进入CA私钥应该存放的目录
            [root@Aphey private]# pwd   
            /etc/pki/CA/private
            [root@Aphey private]# (umask 077;openssl genrsa -out cakey.pem 2048) //我们直接在这里生成CA私钥
            Generating RSA private key, 2048 bit long modulus
            .....................................+++
            ................................+++
            e is 65537 (0x10001)
            [root@Aphey private]# ll .
            total 4
            -rw-------. 1 root root 1679 Jun  9 17:04 cakey.pem     // 权限为600的CA私钥已经生成
            ```
        2. 生成CA的自签证书
            ```
            [root@Aphey private]# cd ..
            [root@Aphey CA]# openssl req -new -x509 -key private/cdkey.pem -out cacert.pem   //生成CA证书,注意证书后缀和文件名
            You are about to be asked to enter information that will be incorporated
            into your certificate request.
            ...     //内容自行填写完成
            ```
        3. 在CA目录下还得准备几个子目录:certs, newcerts,crl;Centos6是默认存在的;还得创建两个文件 index.txt和serial;serial还应该有个起始号,我们就给01
            ```
            [root@Aphey CA]# mkdir certs newcerts crl
            mkdir: cannot create directory `certs': File exists
            mkdir: cannot create directory `newcerts': File exists
            mkdir: cannot create directory `crl': File exists
            [root@Aphey CA]# ls
            cacert.pem  certs  crl  newcerts  private
            [root@Aphey CA]# touch index.txt serial
            [root@Aphey CA]# ls
            cacert.pem certs crl index.txt newcerts private serial
            [root@Aphey CA]# echo 01 > serial
            [root@Aphey CA]# cat serial
            01
            [root@Aphey CA]# ls
            cacert.pem certs crl index.txt newcerts private serial
            ```
        4. 到此我们CA这边工作就完成了,别人就可以申请证书了,我们CA就可以帮别人签证书了.
- 假设我们本机上有个web服务器,其配置文件在/etc/httpd/中.我们需要为httpd应用申请一个证书;不同的服务最好使用不同的证书
    1. 先在应用的配置文件目录中创建一个ssl/目录,
        ```
        [root@Aphey ~]# cd /etc/httpd/
        [root@Aphey httpd]# mkdir ssl
        [root@Aphey httpd]# cd ssl/
        [root@Aphey ssl]# pwd
        /etc/httpd/ssl
        [root@Aphey ssl]#
        ```
    2. 生成应用httpd的私钥
        ```
        [root@Aphey ssl]# (umask 077;openssl genrsa -out httpd.key 1024) //生成1024位的私钥
        Generating RSA private key, 1024 bit long modulus
        ...........++++++
        ....++++++
        e is 65537 (0x10001)
        ```
    3. 生成证书申请;建议申请的后缀用csr(certificate signature request),简洁明了
        ```
        [root@Aphey ssl]# openssl req -new -key httpd.key -out httpd.csr
        You are about to be asked to enter information that will be incorporated
        into your certificate request.
        What you are about to enter is what is called a Distinguished Name or a DN.
        There are quite a few fields but you can leave some blank
        ......  //填写相关的信息,到这哭请求就写好了
        [root@Aphey ssl]# ls
        httpd.csr  httpd.key
        ```
    4. 我们把httpd.csr发送给CA
- 切换到CA,来签署httpd.csr请求
    1. 使用openssl子命令ca来签署httpd.csr请求
        ```
        [root@Aphey ~]# openssl ca -in /etc/httpd/ssl/httpd.csr -out /etc/httpd/ssl/httpd.crt -days 3657
        Using configuration from /etc/pki/tls/openssl.cnf
            ......    
        Sign the certificate? [y/n]:y
        1 out of 1 certificate requests certified, commit? [y/n]y
        Write out database with 1 new entries
        Data Base Updated
        [root@Aphey ~]# cd /etc/httpd/ssl
        [root@Aphey ssl]# ls    //签名证书生成成功了
        httpd.crt  httpd.csr  httpd.key
        ```
    2. 我们去/etc/pki/CA/目录下查看一下
        ```
        [root@Aphey ssl]# cd /etc/pki/CA
        [root@Aphey CA]# ls
        cacert.pem  crl        index.txt.attr  newcerts  serial
        certs       index.txt  index.txt.old   private   serial.old
        [root@Aphey CA]# cat index.txt  // 查看签署证书的索引
        V	270614094834Z		01	unknown	/C=CN/ST=Jiangsu/O=Zhuma/OU=Tech/CN=www.aphey.com/emailAddress=wjl@163.com
        [root@Aphey CA]# cat serial // 下一个证书的序列号
        02
        ```
- ___红帽系统贴心地为我们在/etc/目录下创建了一个certs/目录,里面有个Makefile文件,也就是说我们在这个目录里执行`make`命令快速生成一个测试用的证书,注意不能在生产环境中使用,只能测试使用___
#### OpenSSH服务及其相关应用
- 客户端
    - Linux: ssh (客户端命令)
    - Windows: 安装远程连接工具,putty(汉化的人在其中植入了木马), SecureCRT(著名的商业版), SSHSecureShellClient(免费和商业版),Xmanager
- 服务器端:通常是只在Linux和Unix系统
    - sshd 
- openssh 一般包含两个组件(服务器端的sshd和客户端的ssh)
- 不管是服务器sshd还是客户端ssh都需要配置文件,他们都位于/etc/ssh/目录中.
    - 客户端的配置文件是/etc/ssh/ssh_config
    - 服务器端的配置文件是/etc/ssh/sshd_config 
- 在/etc/ssh/目录下还有几个文件,是密钥相关的,注意文件的权限,私钥和服务器sshd_config都是600权限
    - moduli   // ssh绘画中密钥交换的相关信息,可以不用管   
    - ssh_host_dsa_key.pub  ssh_host_dsa_key    // dsa加密算法的一对密钥
    - ssh_host_key.pub  ssh_host_key    // 是为了SSHV1提供的密钥
    - ssh_host_rsa_key.pub  ssh_host_rsa_key    // rsa算法的一对密钥
- 服务器配置文件sshd_config;最好吧要修改的哪一行复制出来修改
    - \# 空格 开头的行是注释
    - \#后面没空格的行是可以启用的参数,或者默认的参数
    - 里面有一行`#Protocal 2,1` 表示既支持sshv2,也支持sshv1,优先使用sshv2;一般我们不启用这个,而是只启用`Protocal 2`
    - `AdreessFamily any` 表示假设你的服务器既启用了IPV4,又启用了IPV6,你打算在哪一类地址上提供服务;`any`表示两者都可以
    - `ListenAddress 0.0.0.0` 你的服务器可能启用了多个IP地址,你打算监听在哪个地址上,如果不指定,则表示所有地址都向外提供服务.
    - `KeyRenerationInterval 1h` 密钥重新生成间隔,这里的密钥是指客户端和服务端之间通信,临时生成的对称密钥
    - `ServerKeyBits 768` 服务器端密钥长度
    - `SyslogFacility AUTHUPRIV` 使用哪一个Facility
    - `LogLevel INFO` 日志级别
    - `LoginGraceTime 2m` 登陆的宽限期,最多等你多久,你不登入,就强行退出
    - `PermitRootLogin no` 是否允许管理员___直接登入___,我们可以登入普通用户,再su过去
    - `MaxAuthTries 6` 最多允许登陆尝试次数,防暴力破解的
    - `RSAAuthentication yes` 是否支持RSA认证,基于RSA机制的密钥的认证
    - `PubKeyAuthentication yes` 基于密钥的认证
    - `AuthorizedKeyFile` .ssh/authorized_keys
    - `PasswordAuthentication yes` 是不是允许基于口令的认证,这一项应该启用,否则此前从没有建立过基于密钥认证的用户就连不上去了
    - `ChallengeResponseAuthentication no` 是否启用挑战握手认证协议,不安全,一般不允许使用
    - `PrintMotd yes` 在用户登入时,是否显示/etc/motd内容的,motd:message of the day
    - `PrintLastLog yes` 是否显示上一次登入地点和时间;最好不显示;这些东西都叫信息泄露
    - `Banner /some/path` 欢迎标语,就是当别人登陆时,显示某文件的内容作为欢迎标语
    - `Subsystem sftp /usr/libexec/openssh/sftp-server` ssh有个子程序叫sftp,后面就是其路径.
- ssh客户端应用,登陆远程服务器:
    - ssh -l USERNAME REMOTE_HOST
    - ssh USERNAME@REMOTE_HOST
    - `ssh root@aphey.com 'ifconfig'` 在不登陆的情况下,在远程服务器上执行'ifconfig'命令,并把结果打印到你的屏幕上
    - -X 允许连接到远程主机上,并执行窗口命令.
    - -Y 更安全一点
- 基于密钥的认证
    - 一台主机为客户端(基于某个用户实现):
        1. 生成一对密钥`ssh-keygen`
        2. 将公钥传输至服务器端某用户的家目录下的.ssh/authorized_keys文件中
        3. 测试登陆即可
    - 