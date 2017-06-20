### DHCP服务
#### 基本概念
- DHCP: Dynamic Host Configuration Protocol,动态主机配置协议,它的前身是bootp(boot protocol)
- boot protocol:一般用于无盘工作站,早期的计算机网络当中的主机,有一台服务器,它的硬盘比较大,然后有很多客户机,客户机没有硬盘,客户机的操作系统都是装在服务器的硬盘上的,我们客户机要想加载系统,就必须能和我们的主机通信,并且把自己所需的文件读进来;双方要能够通信,根据tcp/ip协议,意味着双方都得有ip地址,但是ip地址配置在操作系统上,于是我们在客户机上安装特殊的网卡,这网卡上有控制芯片,芯片中有些指令,这些指令就能够完成一些独立的操作;这芯片在启动的时候需要向网络发送广播通告:"我自己有一个mac地址,现在比较穷,也没有操作系统,谁能不能给我一个IP地址先拿来用",于是我们有一个服务器能够接受这个请求,并且他有一堆地址可以用,这一堆地址我们通常称为"地址池";于是我们服务器就从地址池里找一个IP地址给这个客户机了;而且一旦服务器把地址给了某个客户机,关联这个IP和客户机的MAC地址,哪么这个IP就永远属于它了.这种能够实现地址的动态分配,但也仅仅第一次动态分配,用于引导系统启动的,我们称为boot protocol.
- 随着计算机的发展,每一个主机都会有自己的硬盘,都可以安装属于自己的操作系统,而且没有IP地址也可以照样启动操作系统;尽管如此,我们局域网内部客户机非常多,我们又希望客户机彼此之间可以正常通信,因此每个主机还是得有IP地址,然后由于人员的流动等原因,IP地址的管理可能会出现混乱的局面,bootp来管理IP可能会造成IP的浪费,于是就有了bootp的升级加强版,即DHCP
- DHCP引进了bootp所没有的一个概念叫做租约(lease):这个地址给你后,你可以用;但不是永久使用,当你主机一关机,你的IP就会被释放,一旦别人开机,这个地址就可能分配给其他人使用;那么既然是有期限地使用,就设计到一个续租的概念,DHCP的续租方式是,当你使用某IP到了期限的一半的时候,就会续租,然后再到一半的时候,再续租...;如果中间要续租的时候联系不到服务器,最后就会 释放这个IP
- 当我们的客户机向多个DHCP服务器申请IP地址的时候,一般会接受第一个响应的IP地址.
- 我们配置TCP/IP属性的时候,需要注意以下几点:
    - IP Address: __必填项__
    - Netmask: __必填项__,没有掩码,我们无法判断本地主机和远程主机
    - Gateway: __非必选__,没有网关,我们可以本地通信,不跟外网通信而已
    - DNS: __非比选__
- 客户机向服务器申请IP,与服务器交互过程如下:
    ```
    // 这个时候没有IP地址,但报文仍要封装成对应协议报文,一般来讲是UDP报文
    1. Client --> DHCPDISCOVER
    2.            DHCPOFFER <-- Server  
    3. Client --> DHCPREQUEST
    4.           DHCPACK <-- Server   
    // 这4个报文都是广播的,续租则是单播形式
    1. Client --> DHCPREQUEST
    2.            DHCPACK <-- Server     
    ``` 
- DHCP服务器的IP必须和地址池中的IP处于同一网段中,用来表明,就是给本地提供网络服务的
- 同时DHCP服务器还能通过路由给另外一个网段的客户端提供DHCP服务

#### DHCP服务器给本地客户机提供地址,掩码,网关以及DNS服务器
- 保留地址:永远保留给某一个特定主机使用的地址;保留地址不能使用地址池中的地址;保留地址是保留给MAC地址的.
- DHCP软件包的名称就叫DHCP
    ```
    [root@zhumatech ~]# yum -y install dhcp //安装dhcp
    [root@zhumatech ~]# rpm -ql dhcp
    /etc/dhcp
    /etc/dhcp/dhcpd.conf
    /etc/dhcp/dhcpd6.conf
    /etc/openldap/schema/dhcp.schema
    /etc/portreserve/dhcpd
    /etc/rc.d/init.d/dhcpd
    /etc/rc.d/init.d/dhcrelay
    .......
    // 注意dhcrelay 是作为中继器来提供服务的,注意,relay和dhcpd是不能同时使用的
    // /var/lib/dhcpd.leases会记录哪些IP地址被分配给谁使用了;不会记录保留地址
    ``` 
- dhcpd的配置文件/etc/dhcp/dhcpd.conf
    ```
    [root@zhumatech ~]# vi /etc/dhcp/dhcpd.conf //提示我们在/usr/share/doc/dhcp-4.1.1/中有个配置文件样本
    [root@zhumatech ~]# cp -y /usr/share/doc/dhcp-4.1.1/dhcpd.conf.sample /etc/dhcp/dhcpd.conf    //我们复制过来并覆盖
    [root@zhumatech ~]# vi /etc/dhcp/dhcpd.conf //再次编辑 
    ddns-update-style interim;      #表示dhcp服务器和dns服务器的动态信息更新模式 
    ignore client-updates;          #忽略客户端更新 
    subnet 192.168.145.0 netmask 255.255.255.0 {        #意思是我所分配的ip地址所在的网段为192.168.145.0 子网掩码为255.255.255.0
      range 192.168.145.200 192.168.145.210;            #租用IP地址的范围
      option domain-name-servers ns.example.org;
      option domain-name "example.org";
      option routers 192.168.145.101;                    #路由器地址，这里是当前 dhcp 机器的IP地址
      option subnet-mask 255.255.255.0;                  #子网掩码
      default-lease-time 600;                            #默认租约时间
      max-lease-time 7200;                              #最大租约时间
      host myhost {                                      #设置主机声明
        hardware ethernet 08:00:27:2C:30:8C;            #指定dhcp客户的mac地址 
        fixed-address 192.168.145.155;                  #给指定的mac地址分配ip
      }
    }
    ``` 
- 编辑 /etc/rc.d/init.d/dhcpd 文件，将其中的
    ```
    user=dhcpd
    group=dhcpd
    改为
    user=root
    group=root
    // 注: 如果不做此修改，启动DHCP时在 “/var/log/messages” 文件里会有 “Can’t chown new lease file: Operation not permitted” 错误。
    ```
- 然后就可以通过`service dhcpd start`启动dhcp服务器了
- 测试，启动 clienthost 机器，然后使用 ifconfig 来查看网络情况，可以看到申请到的ip地址为 192.168.145.200
    ```
    eth0 Link encap:Ethernet HWaddr 08:00:27:E4:60:1A
    inet addr:192.168.145.200 Bcast:192.168.145.255 Mask:255.255.255.0
    inet6 addr: fe80::a00:27ff:fee4:601a/64 Scope:Link
    UP BROADCAST RUNNING MULTICAST MTU:1500 Metric:1
    RX packets:53 errors:0 dropped:0 overruns:0 frame:0
    TX packets:17 errors:0 dropped:0 overruns:0 carrier:0
    collisions:0 txqueuelen:1000
    RX bytes:7049 (6.8 KiB) TX bytes:2430 (2.3 KiB)
    ```
- 客户机可以使用`dhcpclient`来测试申请IP地址的,但是这个命令只能使用一次,如果想要执行第二次则需要`killall dhcpclient`后再执行;这样太麻烦,我们可以使用`dhcpclient -d`来避免`killall`,`-d`选项表示工作在前台,要结束按"Ctrl+C"即可
- DHCP服务器监听的端口是67/UDP;客户端监听的是68/UDP,客户端也要监听是因为服务器要给客户端发租约响应报文