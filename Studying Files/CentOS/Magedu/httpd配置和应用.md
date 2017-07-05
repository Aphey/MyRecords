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