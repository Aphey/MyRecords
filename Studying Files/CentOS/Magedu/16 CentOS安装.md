#### CentOS 系统安装
- 系统引导过程:`bootloader-->kernel(initramfs)-->rootfs-->/sbin/init` 
- anaconda: 安装程序
    - tui:基于curses的文本窗口
    - gui:图形窗口
- CentOS的安装程序启动过程:(可以参考光盘目录下的isolinux)
    - MBR: boot.cat 
    - stage2: isolinux/isolinux.bin; 配置文件:isolinux/islinux.cfg; 
    - 每个对应的菜单选项,注意这个vmlinuz和initrd.img是特制的:
        - 加载内核: isolinuz/vmlinuz
        - 向内核传递参数: append initrd=initrd.img ...
    - 装载根文件系统,并启动anaconda;
- 当资源足够时,默认启动gui接口,当然我们也可以手动启动anaconda的tui界面,方法就是在选择"Install or upgrade an existing system" label 那个界面时按TAB键,并在initrd=initrd.img 后面输入text即可
- 注意:上述内容一般应位于引导设备,而后续的anaconda及其安装用到的程序包等几种方式可用:
    - 本地光盘
    - 本地硬盘
    - ftp服务器: yum repository
    - http server: yum repository
    - nfs server
- 如果想手动指定安装源: boot: linux method 或者在菜单项后面按TAB补上 method
- anaconda应用的工作过程:
    1. 安装前配置阶段
        - 安装过程使用的语言
        - 键盘类型
        - 安装目标存储设备
            1. 基本存储设备
            2. 特钟设备:比如iSCSI
        - 语言
        - 时区
        - 管理员密码
        - 创建一个普通用户
        - 设定分区方式和MBR的安装位置
        - 选定要安装的程序包
    2. 安装阶段
        - 在目标磁盘创建分区,执行格式化操作等
        - 将选定的程序包安装到目标位置
        - 安装bootloader
    3. 第一次启动阶段,有些功能还要做一些配置叫首次启动配置,由系统上一个叫firsttime的程序定义的
        - iptables
        - selinux
        - core dump
- anaconda的配置:
    1. 交互式配置过程:用户手动参与,就是通常我们安装CentOS一开始的操作
    2. 通过读取事先给定的配置文件自动完成配置,这个配置文件叫做kickstart
- 安装引导选项:`boot:`
    - linux: 表示安装linux
    - text: 文本安装方式
    - method: 手动指定的安装方式
    - 设置网络相关的引导选项:
    ```
    ip=IPADDR
    netmask=MASK
    gateway=GW
    dns=DNS_SERVER_IP
    ifname=NAME:MAC_ADDR
    ```
    - 与远程访问功能相关的引导选项:
    ```
    vnc //很少用到
    vncpassword="PASSWORD"    
    ``` 
    - 指明kickstart文件的位置:
    ```
    ks= 
        DVD Driver: ks=cdrom:/PATH/TO/KICKSTART_FILE 比较常用
        Hard Driver: ks=hd:/device/directory/KICKSTART_FILE
        HTTP Server: ks=http://host:port/path/to/KICKSTART_FILE
        FTP Server: ks=ftp://host:port/path/to/KICKSTART_FILE
    ```
    - 启动紧急救援模式:
        - rescue
- 示例:`boot: linux ip=192.168.88.123(安装后本机的IP) netmask=255.255.255.0 ks=http://192.168.88.88/centos6.x86_64.cfg`
- kickstart配置文件格式:在root用户家目录下的anaconda-ks.cfg
    1. 命令段: 指明各种安装前配置,如键盘类型等
        ```
        1. 必备命令:
            auth: 为系统指明认证方式;authconfig --enableshadow --passalgo=sha512
            bootloader: bootloader的安装位置及相关配置
            bootloader --location=mbr --driveorder=sdb,sda --append="crashkernel=auto rhgb quiet"
            keyboard: 设定键盘类型
            lang: 语言类型
            rootpw: 指明管理员的密码
            timezone: 指明时区
        2. 可选命令:
            network
            firewall
            selinux
            user: 安装完以后创建新用户
        ```
    2. 程序包段: 指明要安装的程序包租或程序包,不安装的程序包等
        ```
        %packages
        @group_name
        package
        -packge(not to install)
        %end
        ```
    3. 脚本段: 
        ```
        %pre: 安装前脚本,运行于安装介质上的微型linux环境
        %post: 安装后脚本,运行在重启之前,安装完成后要运行的脚本.
        ```
- 创建kickstart的方式:
    1. 直接手动编辑,依据某模板修改
    2. 使用创建工具,在centos 6上叫system-config-kickstart,必须在图形界面运行;也可以依据某模板;这个软件包需要先安装 
- 检查kickstart配置文件语法: `ksvalidator /root/ks.cfg`;如果有错,则会报错
- 创建仅具有引导光盘:只要把光盘ISO镜像中的isolinux/ 复制到某个文件夹中(比如/tmp/myiso);同时再把自己编写的ks.cfg也复制到/tmp/myiso/中,然后用下面的命令
    ```
    // 创建迷你引导光盘,注意必须在muiso/目录之外
    [root@mail tmp]# mkisofs -R -J -T -v --no-emul-boot --boot-load-size 4 --boot-info-table -V "CentOS 6.6 x86_64 boot" -b isolinux/isolinux.bin -c isolinux/boot.cat -o /root/boot.iso myiso/
    ```
- 然后在重启,引导光盘就用上面命令生成的 boot.iso镜像.来做引导光盘,然后在Install 标签那按ESC 进入`boot:`然后手动指定ks=cdrom:/ks.cfg即可;__其实这一步我们可以把ks=cdrom:/ks.cfg在做镜像前,先写入到 isolinux.cfg中的 linux标签中append那一行的行尾__,这样我们就可以直接在INSTALL行回车自动安装了
    ```
    我们也可以干脆在isolinux.cfg中新建一个标签:
    label ks
      menu label ^Install linux by ks
      menu default
      kernel vmlinuz
      append initrd=initrd.img ks=cdrom:/ks.cfg //这样也可以
    // 然后重新开机的时候就会多一项标签: Install linux by ks
    ``` 
#### SElinux(生产环境中很少使用,了解即可)
- selinux: secure enhanced linux
- DAC: 自主访问控制; MAC:强制访问控制
- SElinux的状态哦
    - enforcing: 强制,每个受限的进程都必然受限,不受限的进程则未必受限
    - permissive: 启用,但是每个受限的进程违规操作时,不会被禁止,但是会被记录到审计日志中
    - disabled: 关闭的;
    - __如果当前系统的SElinux处于disabled状态,想要启用为enforcing或者permissive状态,则必须要重启系统,为文件和进程打标;但如果是从enforcing切换到permissive,则可以使用`setenforce 0`即可,`getenforce`可以查看当前SElinux的状态__
- SElinux有两种工作别,也就是在/etc/sysconfig/selinux 中的SELINUXTYPE项的参数
    - strict: 严格级别,每个进程都受到selinux的控制,这样,每个文件都需要尽心设计,非常困难
    - targeted: 仅有限个进程收到selinux控制,只监控容易受到入侵的进程
- selinux是如何工作的
    ```
    SElinux为每个文件提供了安全标签,也为进程提供了安全标签, # ps auxZ 命令就可以查看每个进程的安全标签,安全标签由5段组成(主要是前三段,后两段没啥用)
    [root@mail ~]# ps auxZ  //标签是横线,就表示selinux被关闭了
    LABEL                           USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
    -                               root         1  0.0  0.0  19364  1536 ?        Ss   Sep26   0:00 /sbin/init
    -                               root         2  0.0  0.0      0     0 ?        S    Sep26   0:00 [kthreadd]
    -                               root         3  0.0  0.0      0     0 ?        S    Sep26   0:00 [migration/0]
    [root@mail ~]# ps auxZ  //打开selinux后,再执行ps auxZ
    LABEL                           USER       PID %CPU %MEM    VSZ   RSS TTY      STAT START   TIME COMMAND
    system_u:system_r:init_t:s0     root         1  0.1  0.0  19356  1536 ?        Ss   10:37   0:00 /sbin/init
    system_u:system_r:kernel_t:s0   root         2  0.0  0.0      0     0 ?        S    10:37   0:00 [kthreadd]
    [root@mail ~]# ls -Z //当selinux打开后,每个文件也都有了自己的标签
    -rw-r--r--. root root system_u:object_r:admin_home_t:s0 @
    -rw-------. root root system_u:object_r:admin_home_t:s0 anaconda-ks.cfg
    drwxrwxr-x. 1000 1000 system_u:object_r:admin_home_t:s0 courier-authlib-0.65.0
    user:role:type:X:X
    user: SElinux的user
    role: 角色,相当于selinux的组
    type: 类型,
    ``` 
- selinux规则库:
    - 规则: 哪种域能访问哪种货哪些种类类型内的文件.
    - selinux还有很多内设的布尔型设置,可以通过`getsebool -a`查看
    ```
    [root@mail ~]# getsebool -a
    abrt_anon_write --> off
    abrt_handle_event --> off
    allow_console_login --> on
    allow_cvs_read_shadow --> off
    allow_daemons_dump_core --> on
    allow_daemons_use_tcp_wrapper --> off
    allow_daemons_use_tty --> on
    allow_domain_fd_use --> on
    allow_execheap --> off
    allow_execmem --> on
    allow_execmod --> on
    allow_execstack --> on
    allow_ftpd_anon_write --> off
    ```
- 配置SElinux:
    1. SElinux是否启用
        - getenforce: 获取selinux状态
        - setenforce 0|1; 0:设置为permissive,1:设置为enforcing,注意这个命令只有在selinux出于开启状态,此设定临时有效,永久生效需要修改配置文件            
    2. 给文件重新打标:`chcon`: change file SElinux security context,有三种使用方法;修改文件的类型可以决定文件是否可以被进程访问
        - chcon [OPTION]... CONTEXT FILE...       
        - chcon [OPTION]...  [-u  USER]  [-r  ROLE] [-t TYPE] FILE...
        - chcon [OPTION]... --reference=RFILE FILE...
        - 命令选项:
            - -R: 递归打标
        - 还原文件的默认标签:`restorecon [-R|-r] FILE`,`-r和-R都表示递归还原`
    3. 设定某些布尔特性
        - 获取sebool的命令: `getsebool [-a] [boolean]`,
        ```
        [root@mail tmp]# getsebool ftp_home_dir //查看单项
        ftp_home_dir --> off
        ```
        - 设置sebool:`setsebool [ -P] boolean value | bool1=val1 bool2=val2 ...`;-P表示保存到策略库中,已达到永久有效的目的
        ```
        [root@mail tmp]# setsebool ftp_home_dir 1|on    //临时生效,-P可以永久生效
        [root@mail tmp]# getsebool ftp_home_dir
        ftp_home_dir --> on
        ```
- 当selinux状态为permissive的时候,所有的操作都会被记录到/var/log/audit/audit.log中
