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
    - moduli   // ssh会话中密钥交换的相关信息,可以不用管
    - ssh_host_dsa_key.pub  ssh_host_dsa_key    // dsa加密算法的一对密钥
    - ssh_host_key.pub  ssh_host_key    // 是为了SSHV1提供的密钥
    - ssh_host_rsa_key.pub  ssh_host_rsa_key    // rsa算法的一对密钥
- 服务器配置文件sshd_config;最好把要修改的哪一行复制出来修改
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
- sftp root@REMOTE_HOST可以不用假设ftp服务器直接登陆进去传输文件,`get FILENAME`即可;`exit`即可退出
- 如果远程服务器改了sshd的默认端口我们只要在Xshell 中用`ssh USERNAME@REMOTE_HOST PORT` 即可以连接;注意防火墙要把对应的端口打开.
### Openssh
### ssh服务
- telnet远程登陆协议:基于tcp的应用层协议C/S架构远程登录机制,早期远程登录都是通过telnet来实现. 巨大缺陷:无论是命令还是认证过程都是明文发送的,很不安全; 默认23号端口
    ```
    telnet服务器端要通过yum install telnet-server来安装,然后启动通过以下步骤:
    1. chkconfig telnet on
    2. service xinetd restart
    3. ss -tnl就可以看到:::23好端口被监听了

    注意: telnet因为所有数据都是明文发送的,所以账号必须是普通用户
    ```
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
    - ssh USERNAME@HOST [COMMA]
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
        - -N '密码': 为密钥文件加一个密码;留空这表示不加密,就不用按两次回车了.
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
- ssh服务的最佳实践:
    1. 不要使用默认端口;
    2. 禁止使用protocal 1
    3. __限制可登陆用户(可以man sshd_config;AllowGroups和AllowGroups来设立白名单)__
    4. 设定空闲会话超时时长
    5. 利用防火墙设置ssh访问策略
    6. 仅监听特定的IP地址
    7. 基于口令认证时,使用强密码策略
    8. 尽可能使用基于密钥认证
    9. 禁止使用空密码
    10. 禁止root用户直接登录
    11. 限制ssh的访问频度和并发在线数
    12. 做好日志/var/log/sercure,还要经常分析
#### ssh另外一种实现: dropbear
#### 注意事项:
- `dropbearkey -t rsa -f /PATH/TO/dropbear_rsa_host_key -s KEY_BITS` 生成dropbear的rss key
- `dropbearkey -t dss -f /PATH/TO/dropbear_dss_host_key` 生成dropbear的dss key,不用指定长度
- 编译安装完dropbear后,使用`dropbear -p [ip:]PORT -F -E`启动服务器,其中ip不写则表示所有的IP可以连接,F:frontend,把所有信息显示到前台,E表示 所有错误日志发送至标准错误输出
- 然后可以用ssh 命令连接进来
