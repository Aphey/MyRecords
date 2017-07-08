### httpd的配置和应用
#### 开源web server:httpd
- httpd特性:
    - 实现创建进程:就是把进程启动起来,先放在那,作为空闲进程,一旦有请求进来,再分配给它.如果进程不够,就继续创建空闲进程
    - 适应性按需维持适当进程:如果有很多空闲进程的时候,就需要销毁一部分空闲进程
    - 模块化设计:核心比较小,各种功能都通过模块添加,而且这些模块可以在运行时启用(包括php);支持运行时配置,支持单独编译模块
    - 支持多种方式的虚拟主机配置,虚拟主机:就是一台物理服务器,安装了一个web程序,却可以服务多个不同的站点.这些不同站点就是虚拟主机.
        - 虚拟主机的变化方式:
            - 基于IP的虚拟主机:给服务器配置多个IP地址
            - 基于端口的虚拟主机:不同的端口对应不同的虚拟主机
            - 基于域名的虚拟主机: IP一样,端口也一样,但是由于站点访问的时候使用的DNS的主机名不同,也可以打开不同的虚拟主机.___这种最常用___
    - 支持https协议(mod_ssl模块)
    - 支持用户认证
    - 支持基于IP或主机名的ACL
    - 支持每目录的访问控制:用户访问主站点的时候不需要提供帐号密码,但是访问某个特殊路径的时候,就需要帐号密码.
    - 支持url重写
- Nginx: 多进程响应n个用户的请求,但是nginx稳定性不如httpd,一般nginx用来做反向解析
- httpd安装方式一般有两种:
    - rpm包: 这个安装方式有缺陷,有可能很多功能我需要,但是rpm包却没帮我编译进去
    - 源码编译
- httpd是受Selinux控制的,所以我们得先关闭selinux.
    ```
    [root@Aphey ~]# vi /etc/selinux/config 
    #  disabled - No SELinux policy is loaded.
    SELINUX=disabled
    # SELINUXTYPE= can take one of these two values:
    SELINUXTYPE=targeted
    [root@Aphey ~]# getenforce
    Disabled
    ```
- httpd rpm包安装
    - 安装包名字是httpd,安装完成之后,它的执行进程服务在/usr/sbin/httpd,进程也叫httpd,在红帽5.8上httpd的工作模式的多道处理模块(MPM: prefork),事先创建新进程,接受客户的请求.在众多httpd进程中有一个httpd的属主和属组是root,master主导进程,其他的都是work process,属主和属组都是apache,
    - /etc/rc.d/init.d/httpd,也是httpd启动端口(80/tcp),(ssl: 443/tcp)
    - /etc/httpd: 工作的根目录,可以假设为程序的安装目录
    - /etc/httpd/conf: 配置文件目录
        - 主配置文件:httpd.conf
        - 由于主配置文件非常大,红帽将其分段来引用`/etc/httpd/conf.d/*.conf`也都是主配置文件的部分,主配置文件中用include把它们都包含进去了. 
    - /etc/httpd/modules: 是个链接,模块目录
    - /etc/httpd/logs: 链接,指向/var/log/httpd,日志文件分为两类
        - 访问日志,access_log
        - 错误日志,err_log
    - 页面路径/var/www
        - html:静态页面
        - cgi-bin: apache提供动态内容的路径
    - cgi:Common gateway interface就是让web服务器能够跟额外的应用程序通讯的机制,能够让web服务器调用其他应用程序的一种协议.
    - fastcgi: 假如有500个用户发请求,每个用户发10个动态请求,那我们服务器上就需要有500个web服务器进程加上5000个动态进程,就需要非常大的系统开销,为了尽可能降低服务器的负荷,web服务器不管你用不用,我们的动态进程也和web服务器一样事先生成好,有一个专门启动的服务叫动态服务程序进程,他也创建很多子进程,于是web服务器只要把动态请求发给这些子进程即可,于是这些动态进程的创建和回收不再由web服务器来管理,而是由动态进程的master process来管理,这种web服务器和动态进程通信的机制就叫fastcgi;而且他们之间通信是通过套接字来实现的,也就是说我们可以把他们装在不同的服务器上,一个用来接受静态请求,一个用来接受动态请求;接受动态请求的服务器属于应用程序层的服务器.
    - CPU-bound:cpu密集型,动态应用进程和数据库服务器都是这种类型的,因此我们可以把数据库服务器和动态程序层的服务器分开来,独立一台服务器给数据库.于是我们就有了,静态请求服务器,应用程序层服务器,和数据库服务器 
- 安装rpm包的httpd
    ```
    [root@Aphey ~]# yum -y install httpd    //直接通过yum源来安装
    [root@Aphey ~]# service httpd start     //启动httpd    
    Starting httpd: httpd: apr_sockaddr_info_get() failed for Aphey
    httpd: Could not reliably determine the server's fully qualified domain name, using 127.0.0.1 for ServerName             [ OK ]
    [root@Aphey ~]# netstat -tlunp| grep 80 //80端口已经被监听
    tcp        0      0 :::80                       :::*                        LISTEN      11454/httpd         
    [root@Aphey ~]# ps aux |grep :80    //查看httpd进程已经启用
    [root@Aphey ~]# ps aux | grep httpd //系统启用了多个httpd进程,但只有一个用户是root,这个进程就是master process
    root      11454  0.1  0.9 273832  9696 ?        Ss   21:14   0:00 /usr/sbin/httpd
    apache    11456  0.0  0.6 273832  6128 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11457  0.0  0.6 273832  6028 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11458  0.0  0.6 273832  6028 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11459  0.0  0.6 273832  6040 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11460  0.0  0.6 273832  6040 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11461  0.0  0.5 273832  5392 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11462  0.0  0.5 273832  5384 ?        S    21:14   0:00 /usr/sbin/httpd
    apache    11463  0.0  0.5 273832  5384 ?        S    21:14   0:00 /usr/sbin/httpd
    root      11475  0.0  0.0 103264   872 pts/0    S+   21:18   0:00 grep --color httpd
    ``` 
- httpd的配置文件
    ```
    [root@Aphey ~]# cd /etc/httpd/conf  //进入配置文件目录
    [root@Aphey conf]# cp httpd.conf httpd.conf.bak //备份主配置文件
    [root@Aphey conf]# ls
    httpd.conf  httpd.conf.bak  magic
    [root@Aphey conf]# grep "Section" httpd.conf    //主配置文件共有三段
    ### Section 1: Global Environment   //全局环境
    ### Section 2: 'Main' server configuration  //主服务器配置文件,不能和第三段同时生效,默认使用的是主服务器段.
    ### Section 3: Virtual Hosts    //虚拟主机,不能和第二段同时生效,
    // # 后面有空格的为注释项,#后面没空格的表示为可以启动的选项.
    // apache的配置文件是由指令directive和其参数(值)value组成的,指令是不区分大小写的,但是后面的值(比如路径)是要根据需要区分大小写的.
    ```
- httpd.conf指令解读
    - `ServerTokens OS` //当我们打开某个主机下不存在的页面时,会显示系统,OS就表示输出操作系统的版本相关信息,这些指令所能接受的参数值,在官方文档里有指令参考;如果不能上网我们可以`yum install -y httpd-manual`,安装到本地;然后在/etc/httpd/conf.d/中生成一个manual.conf配置文件,查看我们可以发现只要重启服务器后,在访问路径后输入^/manual/即可访问本地的官方文档.
    ![ServerTokens](D:\MyRecords\Studying Files\CentOS\Magedu\attach\ServerTokens.png)
    - `ServerRoot "/etc/httpd"` //服务器的根目录,不到万不得已不要改
    - `PidFile run/httpd.pid`   //每一个进程都有一个pid并保存到一个文件中,run是相对路径,是相对/etc/httpd/的
    - `Timeout 120` //超时时间,用户通过三次握手建立连接发起请求了,TCP的第一次握手发起来了,等他第二次确认就不来了,服务器不能一直处于维持状态,这个就是等待时间
    - `KeepAlive on` //是否使用长连接,一般服务器访问量不是特别大,应该打开.
    - `MaxKeepAliveRequests 100`    //打开长连接以后,每个客户端请求上限,如果为0,则为不限制.
    - `KeepAliveTimeout 15` //长连接的断开时长,值需要通过测试来修改.15秒很长了,因为客户端的请求很可能在1s内就完成了.我们可以用ab或者loadrunner来测试.
    - `mpm`,multi processing modules 多道处理模块,定义多个用户请求时候工作模型的.
        - mpm_winnt: windows NT专用的, windows 是支持线程的.    
        - prefork: 预先生成进程.一个请求用一个进程来响应.
        - worker: 一个请求用一个线程来响应;web服务器会生成多个进程,每个进程会生成多个线程,每个线程响应一个请求.当某个资源被某个请求打开,别的请求还需要打开这个资源的时候,就不用再打开这个资源,而直接共享这个资源,效率会比较高;但是由于多个线程在共享资源的时候,要写入一个资源的时候,会导致资源征用的,所以要给资源枷锁,如果我们不能良好地解决锁竞争的话,事实上,线程是不是比进程更好,还真不好说,所以2.2默认使用prefork而不是worker.
        - event: 基于事件的驱动,一个进程同时处理多个用户请求;2.4版本默认就使用event,Nginx也是默认使用这种机制.2.2 默认使用的是prefork机制
    - `httpd -l`可以列出当前服务器进程编译所支持的模型
        ```
        [root@Aphey conf.d]# httpd -l   //我们会发现里面没有worker模型
        Compiled in modules:
          core.c
          prefork.c
          http_core.c
          mod_so.c
        // 如果我们想使用work模型怎么办呢?
        [root@Aphey conf.d]# rpm -ql httpd|grep bin
        /usr/sbin/apachectl
        /usr/sbin/htcacheclean
        /usr/sbin/httpd
        /usr/sbin/httpd.event
        /usr/sbin/httpd.worker  //可以把这个当服务器断执行即可
        /usr/sbin/httxt2dbm
        /usr/sbin/rotatelogs
        /usr/sbin/suexec
        [root@Aphey conf.d]# httpd.worker -l    //可以使用,没有问题
        Compiled in modules:
          core.c
          worker.c
          http_core.c
          mod_so.c
        //如果我不想使用prefork模型,而要用worker模型,我们可以修改服务器的启动脚本的配置文件/etc/sysconfig/httpd;修改#HTTPD=/usr/sbin/httpd.worker,并取消注释即可.
        ```
    - prefork模型工作属性定义,在httpd.conf中
        ```
        <IfModule prefork.c>
        StartServers       8    //启动的服务器进程数
        MinSpareServers    5    //最少空闲进程
        MaxSpareServers   20    //最大空闲进程
        ServerLimit      256    //服务器启动起来之后,为Maxclients上限,maxclient是可以调整的,但不管怎么调整都不能超过ServerLimit的值
        MaxClients       256    //最多允许多少请求连接进来
        MaxRequestsPerChild  4000   //每一个子进程最多可以响应多少的请求.达到这个之,无论如何都要杀死这个进程.
        </IfModule>
        ```
    - Worker模型:
        ```
        <IfModule worker.c>
        StartServers         4  //启动的进程数
        MaxClients         300  //最多允许多少个用户请求
        MinSpareThreads     25  //最小空闲线程数;总体的所有线程数加起来的和.
        MaxSpareThreads     75  //最大空闲线程数;总体的所有线程数加起来的和.
        ThreadsPerChild     25  //每个进程可以生成多少个线程
        MaxRequestsPerChild  0  ////每一个子进程最多可以响应多少的请求.达到这个之,无论如何都要杀死这个进程;0表示不做限定
        </IfModule> 
        ```
    - `Listen 80` 指定监听的地址和端口,地址可以省略;IP:80;可以同时监听多个端口.
    - `LoadModule MOD_NAME /MOD_PATH`
    - `Include conf.d/*.conf`指明了,conf.d/目录下所有.conf文件都是httpd主配置文件的组成部分.
    - `User apache`,`Group apache`,apache worker进程都要使用普通用户运行,这里就指定用户的.
#### httpd属性配置
