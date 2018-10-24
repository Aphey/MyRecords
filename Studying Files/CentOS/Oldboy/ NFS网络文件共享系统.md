#### NFS软件
- 要部署NFS服务,必须安装下面两个软件包:
  a. nfs-utils:NFS主程序,包含了两个守护进程：rpc.nfsd（管理客户机是否可以登录服务器）、
  rpc.mountd(给用户令牌)以及相关的文档说明和执行命令文件
  b. portmap： RPC主程序（CentOS6.4以后叫portmapper)
- 服务器和客户机先通过rpc交互,获取服务器和客户端所使用的端口，也就是说服务器和客户端都要安装rpc

1. 检查NFS软件的安装情况
```
//客户机情况
[root@nfs-client ~]# rpm -qa "rpcbind|nfs-utils"
nfs-utils-1.2.3-39.el6.x86_64
rpcbind-0.2.0-11.el6.x86_64

//服务器情况
[root@nfs-server ~]# rpm -qa "nfs-utils|rpcbind"
nfs-utils-1.2.3-39.el6.x86_64
rpcbind-0.2.0-11.el6.x86_64
nfs-utils-lib-1.1.5-6.el6.x86_64

//如果没有安装，可以通过yum -y install nfs-utils protmap来安装
```

2. 查看服务启动状态
```
[root@nfs-server ~]# /etc/init.d/rpcbind status   //5.8的服务名是portmap
rpcbind (pid  1396) 正在运行...
[root@nfs-server ~]# /etc/init.d/nfs status   //查看NFS服务
rpc.svcgssd 已停
rpc.mountd (pid 14538) 正在运行...
nfsd (pid 14553 14552 14551 14550 14549 14548 14547 14546) 正在运行...
rpc.rquotad (pid 14534) 正在运行...

[root@nfs-server ~]# rpcinfo -p localhost   //查看NFS服务向rpc服务注册端口信息
   program vers proto   port  service
    100000    4   tcp    111  portmapper
    100000    3   tcp    111  portmapper
    100000    2   tcp    111  portmapper
    100000    4   udp    111  portmapper
    100000    3   udp    111  portmapper
    100000    2   udp    111  portmapper
    100024    1   udp  53721  status
    100024    1   tcp  56012  status
    100011    1   udp    875  rquotad //rquotad是管理磁盘配额的
    100011    2   udp    875  rquotad
    100011    1   tcp    875  rquotad
    100011    2   tcp    875  rquotad
    100005    1   udp  55583  mountd
    100005    1   tcp  54696  mountd
    100005    2   udp  33969  mountd
    100005    2   tcp  41187  mountd
    100005    3   udp  57063  mountd
    100005    3   tcp  48962  mountd
    100003    2   tcp   2049  nfs
    100003    3   tcp   2049  nfs
    100003    4   tcp   2049  nfs
    100227    2   tcp   2049  nfs_acl
    100227    3   tcp   2049  nfs_acl
    100003    2   udp   2049  nfs
    100003    3   udp   2049  nfs
    100003    4   udp   2049  nfs
    100227    2   udp   2049  nfs_acl
    100227    3   udp   2049  nfs_acl
    100021    1   udp  59158  nlockmgr
    100021    3   udp  59158  nlockmgr
    100021    4   udp  59158  nlockmgr
    100021    1   tcp  36062  nlockmgr
    100021    3   tcp  36062  nlockmgr
    100021    4   tcp  36062  nlockmgr
```

3. NFS服务端配置文件
```
//NFS默认配置文件是/etc/exportfs
[root@nfs-server ~]# ll /etc/exports  //文件存在但是内容是空的
-rw-r--r--. 1 root root 0 Jan 12  2010 /etc/exports

// /etc/exportfs文件配置的格式：
NFS共享目录（要用绝对路径）    NFS客户机地址1（参数1，参数2...）  NFS客户机地址2（参数1，参数2...）

1) NFS共享目录为NFS服务端要共享的实际目录，要用绝对路径
2）NFS客户端地址为服务端授权可以访问共享目录的NFS客户端地址，可以用单独的IP地址或者主机名，域名等等，也可以为整个网段地址，
还可以用“*”来匹配所有客户服务器可以访问

// 创建共享目录和文件hello
[root@nfs-server ~]# mkdir /data/bbs -p
[root@nfs-server ~]# cd /data/bbs
[root@nfs-server bbs]# touch hello

//修改配置文件
[root@nfs-server ~]# vi /etc/exports
/data/bbs 192.168.88.0/24(rw,sync)

//重新加载配置文件
[root@nfs-server ~]# /etc/init.d/nfs reload

```

4. NFS客户机端要启动portmap服务（也就是rpcbind）
```
//启动rpcbind，并查看执行状态
[root@nfs-client ~]# /etc/init.d/rpcbind  start
正在启动 rpcbind：                                         [确定]
[root@nfs-client ~]# service rpcbind status
rpcbind (pid  12850) 正在运行...
```

5. 客户机可以查看服务器的共享文件夹情况
```
// showmount -e SERVER_IP可以查看服务器上有什么共享目录，如果不同则是服务器的防火墙阻止了，关闭防火墙即可
[root@nfs-client ~]# showmount -e 192.168.88.30
Export list for 192.168.88.30:
/data/bbs 192.168.88.0/24
```

6. 客户机挂在服务器共享目录（注意必须要在服务器端用chown -R nfsnobody.nfsnobody 命令给共享目录对应权限）
```
//用mount -t nfs来挂载
[root@nfs-client ~]# mount -t nfs 192.168.88.30:/data/bbs /mnt
[root@nfs-client ~]# cd /mnt
[root@localhost mnt]# ll
总用量 4
-rwxrwxrwx. 1 nfsnobody nfsnobody 0 9月  13 14:24 abc  //客户端创建的文件属主是nfsnobody
-rwxrwxrwx. 1 root      root      6 9月  13 14:21 hello  //服务器端创建的文件属主是root

[root@nfs-client ~]# df -h
Filesystem               Size  Used Avail Use% Mounted on
/dev/sda2                9.9G  3.4G  6.0G  37% /
tmpfs                    935M  224K  935M   1% /dev/shm
/dev/sda1                194M   30M  155M  16% /boot
192.168.88.30:/data/bbs  9.9G  3.7G  5.8G  39% /mnt
```

7. 此时在服务器端可以查看到客户的完整参数
```
[root@nfs-server bbs]#  cat /var/lib/nfs/etab
/data/bbs	192.168.88.0/24(rw,sync,wdelay,hide,nocrossmnt,secure,root_squash,no_all_squash,no_subtree_check,secure_locks,acl,anonuid=65534,anongid=65534)

// 65534就是nfsnobody的uid
[root@nfs-server bbs]# grep 65534 /etc/passwd
nfsnobody:x:65534:65534:Anonymous NFS User:/var/lib/nfs:/sbin/nologin
```

8. 如果觉得nfsnobody用户不安全，我们可以指定一个用户，然后在/et/exports中修改客户端映射的用户
```
//假如我们想把nfs客户端用户映射为服务器上的aphey用户（这个用户服务器和客户端必须同时拥有，id也必须相同），可以进行以下操作
[root@nfs-server ~]# id aphey
uid=500(aphey) gid=500(aphey) groups=500(aphey)

[root@nfs-server ~]# vi /etc/exports //加上all_squash(不管你客户端的用户是什么，都给你压缩成后面这个anonuid的权限),anonuid=500,anongid=500参数即可
/data/bbs 192.168.88.0/24(rw,sync，all_squash,anonuid=500,anongid=500)

[root@nfs-client mnt]# touch bcd  //在客户端的挂在目录下创建bcd文件
[root@nfs-client mnt]# ll  //发现bcd的属主（组）变成aphey了
总用量 4
-rwxrwxrwx. 1 nfsnobody nfsnobody 0 9月  13 14:58 abc
-rw-r--r--. 1 aphey     aphey     0 9月  13 14:58 bcd
-rwxrwxrwx. 1 root      root      6 9月  13 14:21 hello
```

####扩展知识

- /usr/sbin/exportfs 命令，是NFS服务的管理命令，可以加载NFS配置生效，还可以直接配置NFS共享目录，即无需配置/etc/exports实现共享；这个命令只是临时生效；其实 /etc/init.d/nfs reload 就是调用`exportfs -rv`这个命令的
  ```
  //在服务器端共享/data/bbs目录,临时生效
  [root@nfs-server ~]# exportfs -o rw,sync,all_squash,anonuid=555,anongid=555 192.168.1.0/24:/data/bbs

  //

  ```
- /var/lib/nfs/etab 文件,这个文件可以查看共享目录，对客户端的实际参数
  ```
    [root@nfs-server skel]# cat /var/lib/nfs/etab
  /data/bbs	192.168.88.0/24(rw,sync,wdelay,hide,nocrossmnt,secure,
  no_root_squash,no_all_squash,no_subtree_check,secure_locks,acl,
  anonuid=500,anongid=500)
  ```
- /var/lib/nfs/xtab，在CentOS5.8以前是记录客户端挂载的记录的，CentOS6.4以后，这个文件虽然还在，但是不起作用了，内容为空
  ```
  [root@nfs-client ~]# cat /var/lib/nfs/xtab
  ```
- 客户端挂载命令使开机自启动
  1. /etc/rc.local里使用`mount -t nfs SERVER_IP:/SHARED_DIR /MOUNTED_DIR`来挂载，这个方法的缺点是，偶尔开机挂载不上，要对挂载点监控
  2. /etc/fstab配置，最好不要这么操作，原因是 fstab优先于网络自启动，此时还连不上NFS服务器端；即使是本地文件系统，也要注意fstab最后两列要设置为0 0.
- oldboy的经验,通过/etc/rc.local来配置自启动，平时要通过nagios监控。
  ```
  //客户机配置
  # rpcbind autostart config
  /etc/init.d/rpcbind start

  /bin/mount -t nfs NFS_SERVER_IP:/W_SHARED /MOUNTED_W_DIR
  /bin/mount -t nfs NFS_SERVER_IP:/R_SHARED /MOUNTED_R_DIR
  ```
- **最好用rc.local来管理所有开机自启动的配置，形成一整套的启动档案**
- nfs设置客户端选项图解
@import "pics/nfs.png"


#### nfs客户端自动挂载(autofs)部署方法(客户端安装即可)
- autofs可以实现当用户访问的时候再挂载,如果没有用户访问,在指定的时间后自动卸载
> 优点:可以解决NFS服务器和客户端高耦合的问题.
> 缺点:用户请求才挂载,所以开始请求的瞬间效率较差; 一般用于测试环境,生产环境不用的.
- CentOS6 搜索autofs
  ```
  [root@vm2 ~]# yum search autofs
  Loaded plugins: fastestmirror, security
  Determining fastest mirrors
  base                                                                                               | 3.7 kB     00:00
  extras                                                                                             | 3.4 kB     00:00
  updates                                                                                            | 3.4 kB     00:00
  ================================================== N/S Matched: autofs ===================================================
  libsss_autofs.x86_64 : A library to allow communication between Autofs and SSSD
  autofs.x86_64 : A tool for automatically mounting and unmounting filesystems

  Name and summary matches only, use "search all" for everything.
  ```
- CentOS6安装autofs:
 ```
 [root@vm2 ~]# yum -y install autofs
 [root@vm2 ~]# /etc/init.d/autofs start
 Starting automount: automount: program is already running.
                                                            [  OK  ]  //安装完成
 ```
- autofs的配置文件/etc/auto.master和/etc/sysconfig/autofs,其样例格式如下:
  ```
  /misc   /etc/auto.misc  --timeout 60
  //含义为: /挂载点    /etc/auto.misc则定义了挂载的动作,我们的操作应该是,--timeout 定义了无操作退出autofs的时间
  /mnt    /etc/auto.misc
  ```
- 我们去/etc/auto.misc看看
  ```
  // 该配置给了样例:
  #linux          -ro,soft,intr           ftp.example.org:/pub/linux
  #boot           -fstype=ext2            :/dev/hda1
  #floppy         -fstype=auto            :/dev/fd0
  #floppy         -fstype=ext2            :/dev/fd0
  #e2floppy       -fstype=ext2            :/dev/fd0
  #jaz            -fstype=ext2            :/dev/sdc1
  #removable      -fstype=ext2            :/dev/hdd
  // 其每个字段的含义如下:
  挂载点下的入口     挂载文件系统的类型       设备名称
  // 我们加一行:
  nfsdata         -fstype=nfs             192.168.1.31:/data/bbs
  入口表示在挂载点下载生成一个分身,我们必须进入这个目录才能看到数据,比如这里定义的是nfsdata,
  我们的挂载点是/mnt,那么我们就需要进入/mnt/nfsdata才能看到文件
  ```
- 通过上面的配置操作试试
  ```
  [root@vm2 ~]# umount -lf /mnt // 卸载挂载点
  [root@vm2 ~]# service autofs restart  //重启autofs
  Stopping automount:                                        [  OK  ]
  Starting automount:                                        [  OK  ]
  [root@vm2 ~]# cd /mnt/  //进入挂载点
  [root@vm2 mnt]# ls      //没有任何东西
  [root@vm2 mnt]# cd nfsdata  //在进入挂载点的分身
  [root@vm2 nfsdata]# ls  //可以看到文件了
  abc.txt  bcd  def
  [root@vm2 nfsdata]# touch xyz //可以创建文件
  [root@vm2 nfsdata]# ls
  abc.txt  bcd  def  xyz
  ```
