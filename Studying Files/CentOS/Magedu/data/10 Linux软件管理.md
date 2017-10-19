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
	- `rpm -qd PACKAGE_NAME`,查询指定包安装的帮助文件.d:docfile
	- `rpm -q --scrips PACKAGE_NAME`,查询指定包中包含的脚本:
		- 一般有4类脚本:安装前,安装后,卸载前(preuninstall),卸载后(postuninstall).
	- 如果某rpm包尚未安装,我们需查询其说明信息、安装以后会生成的文件：`rpm -qpi /PATH/TO/PACKAGE_FULLNAME`
	- 如果某rpm包尚未安装,我们需查询其安装以后会生成的文件的位置：`rpm -qpl /PATH/TO/PACKAGE_FULLNAME`
- rpm升级:
	- `rpm -Uvh /PATH/TO/NEW_PACKAGE_FULLNAME`:如果装有老版本的,则升级,否则,则安装
	- `rpm -Fvh /PATH/TO/NEW_PACKAGE_FULLNAME`:如果装有老版本的,则升级,否则,则退出
- rpmbuild:创建软件包
- rpm 卸载: `rpm -e PKGNAME`
    - -e: erase 卸载软件包
- rpm 校验:`rpm -V /PKG_NAME`比较新的软件包和留存在rpm数据库中的信息进行比较,其实就是拿已经安装的的软件包生成的文件和软件安装包中的文件对比,查看那些文件发生过变化,验证玩会给出一个9个字段的对比位,那一条发生变化就会显示出来;也可以用`rpm -K RPM_PKG_NAME.rpm`-K来验证所给的包是否为红帽官方提供，当是官评剧提供时，会有“OK”字样。
    - S file Size differs,文件大小发生改变
    - M Mode differs (includes permissions and file type),文件模式发生改变,权限和文件类型
    - 5 digest (formerly MD5 sum) differs,MD5校验码发生改变
    - D Device major/minor number mismatch,设备文件主设备号/次设备号不匹配
    - L readLink(2) path mismatch,链接文件路径不匹配
    - U User ownership differs,属主发生变化
    - G Group ownership differs,属组发生变化
    - T mTime differs,时间戳发生变化
    - P caPabilities differ,一致性发生变化
- 包来源合法性验证和完整性验证:
    - 完整性: 只要特征码不一致,就可以推断完整性
    ```
    //先导入公钥
    [root@localhost cdrom]# rpm --import RPM-GPG-KEY-CentOS-6   
    ```
- rpm包数据库:/var/lib/rpm/中;数据包重建就是通过读取每一个软件包自身的元数据,把它重新构建回来,数据库重建的命令有两种:
    - `rpm --initdb`: 初始化数据库;如果事先不存在数据的话就新建之,有数据就不做
    - `rpm --rebuilddb`: 重建数据库,无论当前存在与否,直接重新创建数据库
#### yum相关知识
- rpm有个缺陷就是依赖关系.
- yum是一个C/S架构的应用,需要一台服务器来提供yum服务;即yum repository(yum仓库)
- 文件服务提供有多种方式:
	- ftp
	- web
	- FILEPATH
- yum客户端
	- 配置文件;配置文件有ftp的有web的,有本地的路径,但一定要为其指定一个对应的文件路径,这个路径说白了就是yum仓库的位置. 
	- 元素据文件:在仓库中,我们有多少个软件包,每个软件包叫什么名字,它使用什么样的文件. 生成元数据的命令是:`createrepo`
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
		- --nogpgcheck 偶尔用到,针对本地RPM包的,如果RPM包是从互联网上下载的,没法进行gpg检测,就可以用这个选项.__命令行的选项优先级是高于配置文件的__
	- remove|erase 卸载
	- clean 清理缓存
	- list {all全部|available仓库中有,尚未安装的|installed已经安装的|updates可用的升级}列出软件包
	- repolist  {all|enabled|disabled}列出可用的仓库; 默认是enabled.
	- update 升级;升级为最新的版本.
	- update-to 升级到指定版本
	- upgrade 已经弃用了;这一点和兄弟连讲法不一样
	- info 查看软件包的信息
	- provides| whatprovides: 查看指定的文件或特性由哪个包安装生成的;
	- makecache 把服务器的包信息下载到本地电脑缓存起来
- yum的repo配置文件中可用的变量
    - $releasever: 当前OS的发行版的主板本号`rpm -qi centos-release`可以查看
    - $arch: 平台类型,可以通过命令`arch`查看
    - $basearch: 基础平台,比如说i386,i486,i586的基础平台就是i386
    - $YUM0-$YUM9: 用户自定义变量,极少用到
- 补充命令,假如我们通过lftp连接到了某个ftp服务器上:
    - !COMMAND 表示运行一个shell命令;而不是连接到ftp中的命令
    - lcd: local cd,在本机上执行cd命令,而不是远程服务器上的cd
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
	
- 提示没有repomd.xml,md就是元数据meta data的缩写,修复就是把元数据目录下的xml文件复制到仓库里然后再执行`createrepo /PATH/TO/DIR`即可.
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
    b. #执行make
    c. #make install
    
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

- 增添头文件搜寻路径,使用链接进行: 假如我们要把/usr/local/tengine/include/ 导出到 /usr/include; 使用命令 `ln -s /usr/local/tengine/include/* /usr/include` 或者 `ln -s /usr/local/tengine/include /usr/include/tengine` 

- 查看二进制程序所依赖的库文件:`ldd /PATH/TO/BINARY_FILE`
- 命令ldconfig
    - -p: 显示当前系统内存中缓存的共享库以及其对应的路径
    - 缓存文件 /etc/ld.so.cache
d. man文件路径:默认安装在--prefix指定定的目录下的man目录

- 我们系统找man文件的路径也是有限的,是在/etc/man.config中添加一个MANPATH; 我们也可以通过`man -M /PATH/TO/MAN_DIR`的命令来添加新的man路径,比如`man -M /usr/local/apache/man htpasswd`

- netstat命令
	- -r: 显示路由表
	- -n: 以数字方式显示
	- -t: 建立的tcp链接
	- -u: 建立的udp链接
	- -l: listen 显示监听状态的链接,所谓监听,就是服务器启动起来等待客户端来连接的这个状态.
	- -p:  --program 显示监听套接字(端口和ip绑定起来就叫套接字)的进程的进程号和进程名