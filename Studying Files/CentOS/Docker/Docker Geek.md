### Docker的基本概念和框架
#### Docker简介
- 什么是容器?
> 容器是一种虚拟化的方案,依托于linux内核功能的虚拟化技术,容器虚拟化,也被称为操作系统虚拟化,它只能运行与宿主机操作系统相同或相似内核的操作系统,docker容器技术依赖于linux内核特性Namespace(命名空间)和Cgroup(Control Group),所以docker上只能运行linux类型的系统,这也是容器技术和虚拟机继续相比的劣势,它不能运行windows操作系统,docker的磁盘占用空间比vm技术占用空间小得多,vm部署应用不但包含了应用和其依赖的库,还需要包含完整的操作系统,原本只需要几十兆的应用,却需要动则几个G的磁盘空间,而容器只需要包含应用及其依赖的库即可,资源占用大大减少;另外虚拟机需要模拟硬件行为,对内存和CPU的耗损相当大,所以同样配置服务器使用容器技术比使用虚拟机技术能够提供更多服务能力,服务更多用户.但是容器非常复杂.
- 什么是docker?
> docker是能够把应用程序自动部署到容器的开源引擎,go语言编写
- docker的目标
> docker特别之处:docker在虚拟化容器执行环境中,增加了一个应用程序部署引擎,该引擎的目标就是提供一个轻量、快速的环境,能够运行开发者的程序,并方便高效地将程序从开发者环境部署到测试环境,然后再部署到生产环境;

  1. docker提供简单轻量的建模方式
  >docker非常容易上手,用户只要几分钟就可以把自己的程序docker化,大多数docker容器只要不到1s就可以运行起来;由于去除了管理程序的开销,docker容器具有非常高的性能,同时同一台宿主机中也可以运行更多的容器,使用户可以尽可能多的运用系统资源

  2. 职责的逻辑分离
  >使用docker,开发人员只需要关心容器中运行的应用程序,运维人员只需要关心如何管理容器; docker设计的目的就是要加强开发人员写代码的开发环境与应用程序要部署的生产环境的可移植性

  3. 快速高效的开发生命周期
  >docker的目标之一是缩短代码从开发,测试到部署上线运行的周期,让应用程序具备可移植性, 在容器中开发,以容器的形式分发,这样开发,测试,生产都是使用相同的环境,也就避免了额外的调试和部署上的开销,这样就能有效缩短产品的上线周期

  4. 鼓励使用面向服务的架构
  >docker推荐单个容器只运行一个应用程序或者进程,这样就形成一个分布式的应用程序模型,在这种模型下,应用程序或服务,都可以表现为一系列内部互联的容器,从而使分布式部署应用程序,扩展或调试应用程序都变得非常简单,这就像在开发中,常用的思想:高内聚,低耦合;这样就能够避免在统一服务器上部署不同服务时,可能带来的不同服务间的互相影响;在运行过程中,出现问题也比较容易定位问题所在

- Docker的使用场景:
  1. 使用docker容器开发、测试、部署服务
  >docker本身非常轻量化,本地开发人员可以构建、运行并分享docker容器,容器可以在开发环境中创建,再提交到测试,最终进入生产环境

  2. 创建隔离的运行环境
  >在很多企业应用中,同一服务的不同版本可能服务不同的用户,使用docker,非常容易可以创建不同的生产环境来运行不同的服务

  3. 搭建测试环境
  >由于docker的轻量化,开发者很容易运用docker在本地搭建测试环境,用来测试程序在不同系统下的兼容性,甚至是搭建集群部署的测试,学生也很容易利用docker搭建学习开发的环境
  4. 构建多用户的平台即服务(PaaS)基础设施
  5. 提供软件及服务(Saas)应用程序
  6. 高性能、超大规模的宿主机部署
  >目前,aws等公有云服务都提供了对docker的支持,使开发者可以借助云平台,利用docker搭建Paas、Saas的服务,同时,有很多开发者在使用Openstack和Docker结合,提供Paas和SaaS的服务,使docker在云计算领域有着非常广阔的前景

#### Docker的基本组成
- Docker Client 客户端
- Docker Daemon 守护进程
> Docker客户端/守护进程: docker是c/s架构的程序,docker客户端向docker服务器端,也就是docker的守护进程发起请求,守护进程处理完所有的工作,并返回结果,docker客户端对服务器端的访问,既可以是在本地,也可以通过远程来访问
- Docker Image 镜像
> 镜像是docker容器的基石,容器基于镜像启动和运行,镜像就好比容器的源代码,保存了启动容器的各种条件;docker镜像是一个层叠的只读文件系统,它的最底端是一个引导文件系统(bootfs),docker用户几乎永远不会和引导文件系统有交互,实际上当一个容器启动后,它将会被移动到内存中,而引导文件系统会被卸载.docker镜像的第二层是rootfs(根文件系统),位于引导文件系统之上,可以是一种或多种的操作系统,比如Ubuntu或Centos,在传统的linux引导过程中,rootfs会最先以只读的方式加载,当引导结束冰完成了完整性检查后,才会被切换为读写模式;但是在docker里,rootfs永远只能是只读状态,并且docker运用联合加载技术(uniton mount),又会在rootfs之上加载更多的只读文件系统,其中联合加载指的是一次加载多个文件系统,但是在外面看起来,只能看到一个文件系统,联合加载会将各层文件系统叠加到一起,这样最终的文件系统会包含所有的底层文件和目录,docker将这样的文件系统称为镜像,一个镜像可以放到另一个镜像的顶部,位于下面的镜像称为父镜像,以此类推,直到镜像栈到最顶部,最底部的镜像称为基础镜像.
- Docker Container 容器
>容器通过镜像来启动,docker的容器是docker的执行来源,容器中可以执行客户的一个或多个进程,如果说镜像是docker生命周期中的构建和打包阶段,容器则是启动和执行阶段,那么容器是怎样通过镜像启动的呢? 当一个容器启动的时候,docker会在该镜像的最顶层加载一个读写文件系统(也就是一个可写层),我们在docker中运行的程序就是在这个层中执行的,当docker第一次启动一个容器时,初始的读写层是空的,当文件系统发生变化时,这些变化都会应用到这一层上,比如要修改一个文件,首先会从该读写曾下面的只读层复制到该读写层,该文件的只读版本依然存在,但是已经被读写层中该文件的副本所隐藏,这就是docker中一个重要的技术:写时复制(copy on write),每个镜像曾都是只读的,并且以后永远不会变化,当创建一个新容器时,docker会构建一个镜像栈,在栈的最顶层添加这个读写层,这个读写层加上下面的镜像层,以及一些配置数据,就构成了一个容器;容器的这种特点加上镜像分层的框架,使我们可以快速地构建镜像,并运行包含我们自己的应用程序和服务的容器.
- Docker Registry 仓库
> docker用仓库来保存用户构建的镜像,仓库分为共有和私有两种
  1. 共有: docker公司自己提供了一个共有的仓库,叫做docker hub,我们可以在docker hub上注册账号,分享并保存自己的镜像,docker hub上有非常丰富多彩的镜像
  2. 我们也可以创建我们自己私有的docker仓库

#### Docker容器相关技术
##### docker容器依赖于linux内核的namespace(命名空间)和cotrol group(控制组)
- Namespace 命名空间
> 我们知道,很多编程语言都包含了命名空间的概念,可以认为命名空间是一种封装的概念,封装本事实际上是实现代码的隔离,在操作系统中,命名空间提供的是系统资源的隔离,系统资源就提供了进程、网络、文件系统等;实际上,linux内核实现命名空间的主要目的之一就是为了轻量级虚拟化服务,也就是我们说的容器,在同一个命名空间下的进程,可以感知彼此的变化,而对其他命名空间中的进程一无所知,这样就可以让容器中的进程产生一个错觉:仿佛它自己置身于一个独立的系统环境中,以此达到独立和隔离的目的;从docker公开的官方文档看,它使用了5种命名空间:
  1. PID (Process ID) 进程隔离
  2. NET (Network) 管理网络接口
  3. IPC (InterProcess Communication) 管理跨进程通信的访问
  4. MNT (mount) 管理挂载点
  5. UTS (Unix Timesharing System) 隔离内核和版本标识
- 上述的资源就是通过Control Groups(控制组)创建隔离的
> 控制组是linux内核提供的,可以限制、记录隔离进程组所使用的物理资源的机制,最初由google工程师提出,并且在2007被linux内核整合.没有c groups 就没有docker.cgroups提供了哪些功能呢?
  1. 资源限制: 比如memory子系统可以为进程组设定一个内存使用的上限,一旦进程组使用的内存达到了限额,再申请使用内存,就会发出 out of memory 的消息
  2. 优先级设定: 可以设定那些进程组可以使用更大的CPU或者磁盘I/O的资源
  3. 资源计量: 可以计算进程组使用了多少资源,尤其是在计费系统中,这一点非常重要
  4. 资源控制: 可以将进程组挂起或恢复
- 有了上述两个特性,docker容器拥有哪些能力呢?
  1. 文件系统隔离: 每个容器都有自己的root文件系统
  2. 对进程的隔离: 每个容器都运行在自己的进程环境中
  3. 网络隔离: 容器间的虚拟网络接口和ip地址都是分开的
  4. 资源的隔离和分组: 使用cgroups将CPU和内存之类的资源独立分配给每个Docker容器.

### Docker的安装和部署
#### 在CentOS中安装Docker
1. 首先CentOS要升级内核到3.10(只针对CenOS6.5)
```
➜  ~ cd /etc/yum.repos.d

// 下载带aufs模块的3.10内核
➜  yum.repos.d wget http://www.hop5.in/yum/el6/hop5.repo
--2018-07-03 16:48:51--  http://www.hop5.in/yum/el6/hop5.repo
Resolving www.hop5.in... 37.139.17.90
Connecting to www.hop5.in|37.139.17.90|:80... connected.
HTTP request sent, awaiting response... 200 OK
Length: 138 [text/plain]
Saving to: “hop5.repo”

100%[====================================================================>] 138         --.-K/s   in 0s

2018-07-03 16:48:51 (43.6 MB/s) - “hop5.repo” saved [138/138]

// 安装3.10内核
➜  yum.repos.d yum install kernel-ml-aufs kernel-ml-aufs-devel
Loaded plugins: fastestmirror
Setting up Install Process
```

2. 修改grub的主配置文件/etc/grub.conf,设置default=0,表示第一个title下的内容为默认启动的kernel（一般新安装的内核在第一个位置）

```
➜  ~ cat /etc/grub.conf
# grub.conf generated by anaconda
...
default=0
```

3. 重启系统,内核更新成功
```
➜  ~ uname -a
Linux training 3.10.5-3.el6.x86_64 #1 SMP Tue Aug 20 14:10:49 UTC 2013 x86_64 x86_64 x86_64 GNU/Linux
```

4. docker要求系统支持aufs文件系统
```
➜  ~ grep aufs /proc/filesystems
nodev	aufs  // 查询发现系统支持
➜  ~ ll /sys/class/misc/device-mapper   //也有人说有这个软连接文件存在也可以
lrwxrwxrwx. 1 root root 0 Jul  3 16:51 /sys/class/misc/device-mapper -> ../../devices/virtual/misc/device-mapp
```
5. 安装docker
```
1、首先关闭selinux：
➜  ~ setenforce 0
➜  ~ sed -i '/^SELINUX=/c\SELINUX=disabled' /etc/selinux/config

2、在Fedora EPEL源中已经提供了docker-io包，下载安装epel：
➜  ~ rpm -ivh http://mirrors.sohu.com/fedora-epel/6/x86_64/epel-release-6-8.noarch.rpm
➜  ~ sed -i 's/^mirrorlist=https/mirrorlist=http/' /etc/yum.repos.d/epel.repo

3、yum安装docker-io：
➜  ~ yum -y install docker-io

4、 启动docker
➜  ~ service docker start

5、 查看docker版本
➜  ~ docker version
Client version: 1.7.1
Client API version: 1.19
Go version (client): go1.4.2
Git commit (client): 786b29d/1.7.1
OS/Arch (client): linux/amd64
```

#### CentOS7.0 安装docker
1. 先卸载老版本的docker
```
$ sudo yum remove docker \
                  docker-client \
                  docker-client-latest \
                  docker-common \
                  docker-latest \
                  docker-latest-logrotate \
                  docker-logrotate \
                  docker-selinux \
                  docker-engine-selinux \
                  docker-engine
//  如果yum提示没有任何上述包被安装,则可以进行下面的操作
```
2. 安装Docker CE版本
```
1) 先安装依赖文件
$ sudo yum install -y yum-utils \
  device-mapper-persistent-data \
  lvm2
2) 安装稳定的docker库
$ sudo yum-config-manager \
    --add-repo \
    https://download.docker.com/linux/centos/docker-ce.repo
3) 开启edge和test库(可选)
$ sudo yum-config-manager --enable docker-ce-edge
$ sudo yum-config-manager --enable docker-ce-test
4) 安装docker CE
$ sudo yum install docker-ce
5) 如果要安装特定版本的Docker,可以用下面的命令查看
$ yum list docker-ce --showduplicates | sort -r
docker-ce.x86_64            18.03.0.ce-1.el7.centos             docker-ce-stable
$ sudo yum install docker-ce-<VERSION STRING> //安装特定版本Docker
6) 开启docker
$ sudo systemctl start docker
7) 通过运行 hello-world镜像,验证docker是否正确安装
$ sudo docker run hello-world
```
- 当使用非root用户操作docker时,可以为用户添加附加组docker,就可以在执行docker时免去前面的sudo
```
$ sudo groupadd docker
$ sudo gpasswd -a USER_NAME docker
$ sudo service docker restart
```

### Docker容器
#### docker基本操作
- 启动容器:
```
// 执行单次命令的容器:
$ docker run IMAGE [COMMAND] [ARG...]

➜  ~  docker run ubuntu echo 'hello world'  //当首次运行某个本地没有的镜像时,会从官方经想库搜索下载
Unable to find image 'ubuntu:latest' locally
latest: Pulling from ubuntu
893c22467b8c: Pull complete
956e81104ad3: Pull complete
fc67a0888591: Pull complete
2181b69ee6eb: Pull complete
e05ad70678a5: Pull complete
7feff7652c69: Pull complete
Digest: sha256:778d2aed25eb85ec40548addb582cbffd0ca6fe5d2a382cb7f3a8958c1ed50d6
Status: Downloaded newer image for ubuntu:latest
hello world   // 成功执行,到此,容器已经停止了

// 启动交互式容器
$ docker run -i -t IMAGE /bin/bash
-i --interactive=true| false 默认是false, 始终打开标准输入
-t --tty=true| false, 要为创建的容器分配一个伪tty终端

➜  ~ docker run -i -t ubuntu /bin/bash  //启动交互式容器
root@0a9277cb9f49:/# ls   //启动成功
bin   dev  home  lib64  mnt  proc  run   srv  tmp  var
boot  etc  lib   media  opt  root  sbin  sys  usr
```
- 查看我们运行过的容器
```
$ docker ps [-a] [-l] 默认显示运行中的容器
-a --all 所有容器,默认值显示刚刚运行的
-l --latest 列出最新创建的容器(包括还未运行的)

➜  ~ docker ps  //只用ps是看不到ubuntu容器的,因为ubuntu在运行后已经停止了; ps默认显示的是运行中的容器.
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES

➜  ~ docker ps -al  //查看所有的容器
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS                          PORTS               NAMES
66fa834b93f4        ubuntu              "/bin/bash"         2 minutes ago       Exited (0) About a minute ago                       elated_pike
```
- 查看容器的低级别信息(信息看起来比较复杂)
```
$ docker inspect  [OPTIONS] CONTAINER[ID]| IMAGE[ID]
➜  ~ docker inspect ubuntu     //等同于  docker inspect 66fa834b93f4
[
{
    "Id": "7feff7652c696b7d329efb4fa5b315c6df54fa76e7176c416c6a8b5c49885241",
    "Parent": "e05ad70678a5b57c7d9d0d7e95e16228eecf915c1b81a8b2116eb2f4a61cd951",
    "Comment": "",
......
```
- 自定义容器名:
```
$ docker run --name=CUSTOMIZED_NAME -i -t IMAGE /bin/bash

➜  ~ docker run --name=con1 -i -t ubuntu /bin/bash
root@76afc6cd23e4:/# exit

➜  ~ docker ps -a //可以发现NAMES那一栏变成con1了
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS                      PORTS               NAMES
76afc6cd23e4        ubuntu              "/bin/bash"            24 seconds ago      Exited (0) 20 seconds ago                       con1
66fa834b93f4        ubuntu              "/bin/bash"            15 minutes ago      Exited (0) 14 minutes ago                       elated_pike

➜  ~ docker inspect con1  //也可以用inspect con1 直接查看容器信息了
[
{
    "Id": "76afc6cd23e4c89bec083a9bf399e85ee91ff3836bfbc4e8ca8fb9099379189d",
    "Created": "2018-07-04T06:48:50.454267995Z",
    "Path": "/bin/bash",
    "Args": [],
    "State": {
        "Running": false,
        "Paused": false,
        "Restarting": false,
        "OOMKilled": false,
        "Dead": false,
        "Pid": 0,
......
```
- 重启已经停止的容器
```
$ docker start [-i] CONTAINER
-i 启动容器的标准输入界面

➜  ~ docker start -i con1 //成功重启刚才已经关掉的
root@76afc6cd23e4:/#
```
- 删除已经停止的容器
```
$ docker rm CONTAINER //只能删除已经停止的容器

➜  ~ docker ps -a   //列出所有容器
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS                      PORTS               NAMES
66fa834b93f4        ubuntu              "/bin/bash"            27 minutes ago      Exited (0) 26 minutes ago                       elated_pike
0a9277cb9f49        ubuntu              "/bin/bash"            32 minutes ago      Exited (0) 28 minutes ago                       cranky_jones
f33990f59c71        ubuntu              "echo 'hello world'"   34 minutes ago      Exited (0) 34 minutes ago                       naughty_hodgkin
953635e3c1e3        hello-world         "/hello"               4 hours ago         Exited (0) 4 hours ago                          silly_payne
085e0503ab29        hello-world         "/hello"               4 hours ago         Exited (0) 4 hours ago                          sleepy_babbage
621a7d40182e        hello-world         "/hello"               4 hours ago         Exited (0) 4 hours ago                          angry_brattain
➜  ~ docker rm 621a7d40182e   //删除其中一个
621a7d40182e
➜  ~ docker ps -a       //被删除的已经被从列表中移除了
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS                      PORTS               NAMES
66fa834b93f4        ubuntu              "/bin/bash"            28 minutes ago      Exited (0) 26 minutes ago                       elated_pike
0a9277cb9f49        ubuntu              "/bin/bash"            32 minutes ago      Exited (0) 28 minutes ago                       cranky_jones
f33990f59c71        ubuntu              "echo 'hello world'"   35 minutes ago      Exited (0) 35 minutes ago                       naughty_hodgkin
953635e3c1e3        hello-world         "/hello"               4 hours ago         Exited (0) 4 hours ago                          silly_payne
085e0503ab29        hello-world         "/hello"               4 hours ago         Exited (0) 4 hours ago                          sleepy_babbage
```
#### 守护式容器
- 什么是守护式容器
> 上面,我们知道了交互式容器和执行单次命令的容器,很多时候我们需要能够长期运行的容器来提供服务,这就是docker的守护式容器;守护式容器的特点是: 1) 能够长期运行 2)没有交互式会话 3) 非常适合运行应用程序和服务
- 以守护形式运行容器:
```
$ docker run -i -t IMAGE /bin/bash  //运行交互式容器后
CTRL+P; CTRL+Q  //退出交互式容器,让其在后台运行

➜  ~ docker run -it ubuntu /bin/bash  //运行交互式容器
root@cfe46aafba72:/#    //按CTRL+P;CTRL+Q退出交互式界面 #
➜  ~ docker ps    //再次查看容器,发现该容器还在运行中
CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS              PORTS               NAMES
cfe46aafba72        ubuntu              "/bin/bash"         13 seconds ago      Up 13 seconds                           sick_banach
```
- 附加到运行中的容器
```
// 上面的容器被我们放到后台去运行了,通过下面的操作可以恢复容器
$ docker attach CONTAINER_ID| CONTAINER_NAME

➜  ~ docker attach cfe46aafba72   //或者 ➜  ~ docker attach sick_banach
root@cfe46aafba72:/#
```
- 以run命令形式直接启动守护式容器
```
$ docker run -d IMAGE [COMMAND] [ARG...]
-d --detach=false,在后台运行容器

//我们运行一个守护式容器,在其中执行一个循环命令
➜  ~ docker run --name=con1  -d ubuntu /bin/bash -c "while true;do echo hello world;sleep 1; done"
ea732ffecd93d944fa7c5819857d2263e15e9cab79a7d519683bbdf18c1070b1  //命令回车后,会返回一串字符
➜  ~ docker ps  //通过ps命令可以发现容器一直在运行
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS               NAMES
ea732ffecd93        ubuntu              "/bin/bash -c 'while   8 seconds ago       Up 8 seconds                            con1
```
- 查看容器日志
```
// 上面我们执行了守护式容器,容器在后台运行,我们怎么才能知道容器的运行情况呢?
$ docker logs [-f][-t][--tail] CONTAINER
-f --follows=true| false 默认为false,跟踪日志的变化,并返回结果,也就是动态显示日志
-t --timestamps=true| false 默认为false;在返回的结果上显示时间戳
--tail= "all" 返回最后多少行的日志,如果不指定,则显示全部日志

➜  ~ docker logs -tf --tail 0 con1
2018-07-04T07:31:29.744053862Z hello world
2018-07-04T07:31:30.744653119Z hello world
2018-07-04T07:31:31.745156450Z hello world
```
- 查看容器内进程
```
$ docker top CONTAINER

➜  ~ docker top con1
UID                 PID                 PPID                C                   STIME               TTY                 TIME                CMD
root                6922                3717                0                   15:21               ?                   00:00:00            /bin/bash -c while true;do echo hello world;sleep 1; done
root                7700                6922                0                   15:32               ?                   00:00:00            sleep 1
```
- 在运行的容器中启用新进程
```
// 虽然docker的理念是一个容器运行一种服务,我们仍旧需要在docker中运行多个进程,比如需要对运行中的容器进行维护,监控或者执行一些管理任务,docker的 exec命令就可以在容器中启用新进程
$ docker exec [-d] [-i] [-t] CONTAINER [COMMAND] [ARG...]
-d detach 后台运行
-t tty 要为创建的容器分配一个伪tty终端
-i 启用标准输入

➜  ~ docker exec -it con1 /bin/bash
root@ea732ffecd93:/# #  //运行成功,CTRL+P;CTRL+Q
```
- 停止守护式容器
```
1) $ docker stop CONTAINER  //发送信号给容器,等待容器停止

2) $ docker kill CONTAINER  //直接停止容器,快速停止容器

➜  ~ docker ps  //查看当前运行中的容器
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS               NAMES
b8e184aa7958        ubuntu              "/bin/bash -c 'while   5 seconds ago       Up 5 seconds                            con2
ea732ffecd93        ubuntu              "/bin/bash -c 'while   20 minutes ago      Up 20 minutes                           con1
➜  ~ docker stop con2   //要等一段时间才会结束
con2
➜  ~ docker ps
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS               NAMES
ea732ffecd93        ubuntu              "/bin/bash -c 'while   21 minutes ago      Up 21 minutes                           con1
➜  ~ docker kill con1 //容器停止地非常快速
con1
```
#### 在容器中部署静态网站
>我们要向访问容器的80端口,就要设置容器的端口映射
- 容器的端口映射
```
run [-P][-p]
-P, --publish-all=true| false 默认为false, 为容器的所有端口进行映射
$ docker run -P -i -t ubuntu /bin/bash

-p,--publish=[] //指定映射那些容器的端口,有4种格式
1) CONTAINER_PORT,只指定容器端口,随机映射到宿主机的某个端口
$ docker -p 80 -i -t ubuntu /bin/bash //随机映射到宿主机的端口

2) HOST_PORT:CONTAINER_PORT //指定宿主机端口和容器端口
$ docker run -p 8080:80 -i -t ubuntu /bin/bash

3) ip::CONTAINER_PORT 指定ip和容器的端口
$ docker run -p 0.0.0.0:80 -i -t ubuntu /bin/bash

4) ip:HOST_PORT:CONTAINER_PORT
$ docker run -p 0.0.0.0:8080:80 -i -t ubuntu /bin/bash
```
- 在容器中部署Nginx
```
1) 创建映射80端口的交互式容器
➜  ~ docker run -p 80 --name web -it ubuntu /bin/bash

2) 安装Nginx
root@a9ee5f19c9c5:/# apt-get install nginx -y

3) 安装文本编辑器vim
root@a9ee5f19c9c5:/# apt-get install vim -y

4) 创建静态页面

5) 修改Nginx配置文件
修改网站页面根目录

6) 运行Nginx

7) 验证网站访问

```
- docker端口映射情况查看
```
1) $ docker ps 可以显示端口映射的情况
2) $ docker port CONTAINER 也可以显示端口映射情况
```
- 查看 容器的IP地址
```
$ docker inspect CONTAINER
➜  ~ docker inspect con1|grep IPAdd
```
- 当我们重启一个容器时,它的IP 和映射端口都会发生改变

#### Docker镜像与仓库(一)
- docker镜像的存储位置在`/var/lib/docker/`中
```
//也可以通过$ docker info命令查看docker使用的存储驱动和存储位置
➜  containers/ docker info
Containers: 9
Images: 6
Storage Driver: aufs
 Root Dir: /var/lib/docker/aufs
 Backing Filesystem: extfs
 Dirs: 24
 Dirperm1 Supported: false
Execution Driver: native-0.2
Logging Driver: json-file
Kernel Version: 3.10.5-3.el6.x86_64
Operating System: <unknown>
CPUs: 4
Total Memory: 15.58 GiB
Name: training
ID: 25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX
WARNING: No swap limit support

➜  aufs/ pwd
/var/lib/docker/aufs
➜  aufs/ ls   //它又包含三个文件夹
diff  layers  mnt
➜  aufs/ ls mnt   //再查看mnt目录会发现很多镜像文件在里面
085e0503ab29e452ce91abf599981127c47b2a1ee9af8c3fa5a88b9c9aae1c5f
085e0503ab29e452ce91abf599981127c47b2a1ee9af8c3fa5a88b9c9aae1c5f-init
0a9277cb9f491ae8d94d966e4ac731aa34a33e2579f716163fdd4b223a1fa620
0a9277cb9f491ae8d94d966e4ac731aa34a33e2579f716163fdd4b223a1fa620-init
2181b69ee6eb1f54740cf1c5db1c97ff0b3db3e1afafa37501c06b550004e07b
66fa834b93f49e0ef8dd59145ecd18253a1ff4ace8fa668bab23f40b1b0f3e5a
66fa834b93f49e0ef8dd59145ecd18253a1ff4ace8fa668bab23f40b1b0f3e5a-init
7feff7652c696b7d329efb4fa5b315c6df54fa76e7176c416c6a8b5c49885241
893c22467b8c6b1ee608f0cc435cbb2dba29e0569a399cdaf190cea0bd477c95
953635e3c1e3771fd476b4299a3e8f678cbd11764de8872147a2e078cc0b9c49
953635e3c1e3771fd476b4299a3e8f678cbd11764de8872147a2e078cc0b9c49-init
956e81104ad300f455f178a62fee02712529f7e95d1c2f7bd1388a3c8086563c
a9ee5f19c9c5fd81ff74bca966e97d06d8b347dd7c9ff563f9b8a73876041a0e
a9ee5f19c9c5fd81ff74bca966e97d06d8b347dd7c9ff563f9b8a73876041a0e-init
b8e184aa79585739900e552e32b8aebf81676fb95d52c7f9f087af31ef495970
b8e184aa79585739900e552e32b8aebf81676fb95d52c7f9f087af31ef495970-init
cfe46aafba729f97c9c2cdd77961ec927bcd89f2a55c88be8557fd65a661df98
cfe46aafba729f97c9c2cdd77961ec927bcd89f2a55c88be8557fd65a661df98-init
e05ad70678a5b57c7d9d0d7e95e16228eecf915c1b81a8b2116eb2f4a61cd951
ea732ffecd93d944fa7c5819857d2263e15e9cab79a7d519683bbdf18c1070b1
ea732ffecd93d944fa7c5819857d2263e15e9cab79a7d519683bbdf18c1070b1-init
f33990f59c71d73140f29ee6930896ad137010b74fe5e9d501a77a45b12dda3f
f33990f59c71d73140f29ee6930896ad137010b74fe5e9d501a77a45b12dda3f-init
fc67a088859168c36004581d46ba5f43b1af60891d372e0d832ed9f02b5491c9
```
##### 在docker命令行接口中操作这些镜像
- 查看和删除镜像
```
1) 列出镜像
$ docker images [OPTIONS] [REPOSITORY]
- a, --all=false,显示所有镜像,默认显示中间层镜像
-f, --filter=[],显示时的过滤条件
--no-trunc=false,不使用截断的形式来显示数据,默认是会截断
-q,--quiet=false ,只显示镜像的唯一id

➜  ~ docker images  //返回的是当前在docker中已经安装的镜像
REPOSITORY          TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
ubuntu              latest              7feff7652c69        4 weeks ago         81.15 MB

➜  ~  docker images --no-trunc  //显示长镜像ID,和上面文件夹中的文件名一致
REPOSITORY          TAG                 IMAGE ID                                                           CREATED             VIRTUAL SIZE
ubuntu              latest              7feff7652c696b7d329efb4fa5b315c6df54fa76e7176c416c6a8b5c49885241   4 weeks ago         81.15 MB

➜  ~  docker images -a        //显示所有镜像,没有仓库名和标签名就是所谓的中间层
REPOSITORY          TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
ubuntu              latest              7feff7652c69        4 weeks ago         81.15 MB
<none>              <none>              e05ad70678a5        4 weeks ago         81.15 MB
<none>              <none>              2181b69ee6eb        4 weeks ago         81.15 MB
<none>              <none>              956e81104ad3        4 weeks ago         81.15 MB
<none>              <none>              fc67a0888591        4 weeks ago         81.15 MB
<none>              <none>              893c22467b8c        4 weeks ago         81.15 MB

➜  ~  docker images -q    //只显示IMAGE_ID
7feff7652c69

➜  ~  docker images ubuntu  //ubuntu是 repository仓库名,这个命令会返回对应的repositoy所有镜像
REPOSITORY          TAG                 IMAGE ID            CREATED             VIRTUAL SIZE
ubuntu              latest              7feff7652c69        4 weeks ago         81.15 MB

2) 镜像标签和仓库
标签: TAG
仓库: REPOSITORY: 一系列镜像的集合,一个仓库是一系列关联的镜像,在仓库中,不同的镜像实际
上是以标签的形式来区分的,仓库名加上标签名,就构成了一个完整的镜像名字.这个镜像名字就会对
应一个镜像的ID,docker默认使用latest对应的镜像;我们在列表中还可能发现,在同一个仓库的不
同的标签可能对应的是相同的镜像ID,也就是说我们可以给相同的镜像根据不同的需求打上不同的标签
之前我们也有一个"仓库"叫Registy,这个是提供docker镜像的存储服务,可以理解为远程镜像仓库

3) 查看镜像详细信息
$ docker inspect [OPTIONS] CONTAINER|IMAGE [CONTAIER|IMAGE]
-f,--format= " ",

4) 删除镜像
$ docker rmi [OPTIONS] IMAGE [IMAGE]
-f,--force=false 强制删除镜像
--no-prune=false 保留镜像中未打标签的父镜像

删除时,如果一个镜像ID对应多个REPOSITORY: TAG,当我们用docker rmi REPOSITORY:TAG时,只会删除这个TAG,而不会真正的删除镜像.那我们可以通过$docker rmi IMAGE_ID来删除镜像,然后我们就会发现,这个ID对应的所REPOSITORY: TAG都被删除了

我们还可以一次删除多个镜像 $docker rmi REPOSITOY:TAG REPOSITORY:TAG2
我们还可以通过这条命令来删除全部镜像 $ docker rmi $(docker images ubuntu -q) 或者 docker rmi `docker images ubuntu -q`
```
#### 获取和推送Docker镜像(本地镜像和远程仓库Registry的互动操作)
- 查找镜像
```
1) docker hub: http://registry.hub.docker.com

2) $ docker search [OPTIONS] TERM 最多一次返回25个结果
--automated=false 只显示自动构建的镜像
--no-trunc=ture 不以截断的格式显示,默认为false
-s, --stars=0 设置显示结果的最低星级
```
- 拉取镜像
```
$ docker pull [OPTIONS] NAME [:TAG]
-a --all-tags=true,下载repository所有标签的镜像,默认为false

➜  ~ docker pull ubuntu:16.04
16.04: Pulling from ubuntu
7d614f18edc3: Pull complete
565220263a7c: Pull complete
8475d7efa2f0: Pull complete
f7fdafe228d3: Pull complete
63474e4f2842: Pull complete
6e422b1b463a: Pull complete
Digest: sha256:66597347affd6a3b1791f3fcede503d1ed3861b7f71a1548d2e2fee07b06c1b5
Status: Downloaded newer image for ubuntu:16.04

// 在CentoOS6.5(Docker Version 1.7.1)中我们的网络环境导致我们访问官方的镜像库速度很慢,我们可以用下面这个方法来加速
$ vi /etc/sysconfig/docker

other_args="--registry-mirror=https://z12vx03m.mirror.aliyuncs.com --label name=docker_server1"

// 如果你是docker1.8 或者docker1.10等更高版本，你应该这么配置
$ docker --registry-mirror=https://registry.docker-cn.com daemon

为了永久性保留更改，您可以修改 /etc/docker/daemon.json 文件并添加上 registry-mirrors 键值。
{
  "registry-mirrors": ["https://registry.docker-cn.com"]
}
```

- 推送镜像(本地镜像推送到远程仓库中)
```
$ docker push IMAGE //然后会提示你输入docker hub账号密码
//不会推送整个镜像,是增量提交,只提交修改的部分
```
- 构建docker镜像可以使我们
> 1) 保存对容器的修改,并再次使用
> 2) 自定义镜像的能力
> 3) 以软件的形式打包并分发服务及其运行环境

- docker提供了两种构建镜像的方式
> 1. docker commit  //通过容器构建
```
$ docker commit [OPTIONS] CONTAINER [REPOSITORY[:TAG]]
-a,--author="Aphey y2j@qq.com" 作者信息
-m,--messenge="STRING" 提交信息
-p,--pause=true 在提交过程中容器会自动暂停,我们可以让容器不暂停

➜  ~ docker run -it -p 80 --name commit_test ubuntu /bin/bash   //首先启动一个交互式容器,并命名为commit_test
root@d45052556365:/# apt-get update   //对容器做出修改
...
Fetched 25.5 MB in 13s (1962 kB/s)
Reading package lists... Done
root@d45052556365:/# apt-get install nginx    //安装Nginx

➜  ~ docker commit -a "Aphey y2j@qq.com" -m "nginx installed" commit_test aphey/nginx //提交镜像
2ce9215ca0301e8f4f47f6d1f6ab261a850d654eaa320583953250d018f5acbd  //这个就是新生成的镜像的ID
➜  ~ docker images
REPOSITORY          TAG                 IMAGE ID            CREATED              VIRTUAL SIZE
aphey/nginx         latest              2ce9215ca030        About a minute ago   234.1 MB   //我们自己构建的镜像
ubuntu              16.04               6e422b1b463a        4 weeks ago          113.9 MB

➜  ~ docker run -p 80:80 -d --name nginx_web1 aphey/nginx nginx -g "daemon off;"   //ngingx以前台的模式来运行,否则运行结束后容器会停止
c887196aec396dbcb7d0bbbba90a7a5466cb21479a1eb9959e7537df4e2dd152

➜  ~ curl http://127.0.0.1        //成功访问
<html>
	<head>
		<title>Nginx in Docker</title>
	</head>
	<body>
		<h1>Hello Wolrd</h1>
	</body>
</html>
```

>2. docker build   //通过dockerfile文件构建
```
1) 创建Dockerfile; dockerfile就是包含了一系列命令的文本文件,下面是一个示例:
# First dockerfile
FROM ubuntu:16.04               //镜像的基础
MAINTAINER Aphey "y2j@qq.com"   //维护人
RUN apt-get update              //执行的命令
RUN apt-get -y install nginx    //执行的命令
EXPOSE 80                       //暴露的端口

我的操作:
➜  ~ mkdir -p dockerfile/df_test1
➜  ~ cd dockerfile/df_test1
➜  df_test1 vim dockerfile
➜  df_test1 cat dockerfile
#First dockerfile
FROM ubuntu:16.04
MAINTAINER Aphey "y2j@qq.com
RUN apt-get update
RUN apt-get -y install nginx
EXPOSE 80

2) 使用$ docker build命令
命令格式: docker build [OPTIONS] PATH|URL|
--force-rm=false
--no-cache=false
--pull=false
-q,--quiet=false  //不显示构建过程
--rm=true
-t,--tag=""   //指定构建出镜像的名字

我的操作:
➜  df_test1 docker build -t='aphey/df_test1' /root/dockerfile/df_test1
//等待结束即可,其中执行完一步会返回一个ID,这个ID就是中间层的ID
➜  df_test1 docker images
REPOSITORY          TAG                 IMAGE ID            CREATED              VIRTUAL SIZE
aphey/df_test1      latest              821af07962f4        About a minute ago   211 MB       //构建成功了

➜  df_test1 docker run -d --name web  -it -p 80:80 aphey/df_test1 nginx -g "daemon off;"
9d438c905088d6777a087634a87878fee11104a3ac85e790b3b419e1cf5a6b00
➜  df_test1 docker ps   //运行成功
CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS                NAMES
9d438c905088        aphey/df_test1      "nginx -g 'daemon of   5 seconds ago       Up 4 seconds        0.0.0.0:80->80/tcp   web
➜  df_test1 curl http://127.0.0.1   //获取页面成功
<!DOCTYPE html>
<html>
<head>
<title>Welcome to nginx!</title>
<style>
    body {
        width: 35em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<h1>Welcome to nginx!</h1>
<p>If you see this page, the nginx web server is successfully installed and
working. Further configuration is required.</p>

<p>For online documentation and support please refer to
<a href="http://nginx.org/">nginx.org</a>.<br/>
Commercial support is available at
<a href="http://nginx.com/">nginx.com</a>.</p>

<p><em>Thank you for using nginx.</em></p>
</body>
</html>
```

#### Docker的客户端和守护进程
- Docker的C/S模式
> 常规的是用户通过客户端向Docker服务器的守护进程发出命令,服务器的守护进程执行后把执行结果通过客户端展示给用户
- Docker还提供了其他的与守护进程通信的方式:remote api(RESTful风格的API)
> 也就是说,我们可以通过编写程序调用API来将我们自己的程序与docker进行集成
> docker的remote API在某些复杂的情况下也支持 STDIN、STDOUT、STDERR的方式来进行通信和交互
> 通过remote API的形式来实现docker C/S架构,用户就可以与自定义的程序进行交互,这个程序就通过remote API与docker的守护进程进行通信;docker官网有api文档
- docker的客户端与守护进程的连接方式
  1. unix:///var/run/docker.sock    //unix端口,默认链接方式
  2. tcp://host:port                //tcp协议
  3. fd://socketfd                  //fd的socket
```
➜  ~ nc -U /var/run/docker.sock // 用nc命令查看docker的sock, -U指定使用的socket,按回车就可以连接到socket
GET /info HTTP/1.1      // 发出一个http的指令来查看REMOTE API中的/info接口

HTTP/1.1 200 OK
Content-Type: application/json
Date: Thu, 05 Jul 2018 07:05:56 GMT
Content-Length: 1117

{"ID":"25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX","Containers":1,"Images":17,"Driver":"aufs","DriverStatus":[["Root Dir","/var/lib/docker/aufs"],["Backing Filesystem","extfs"],["Dirs","19"],["Dirperm1 Supported","false"]],"MemoryLimit":true,"SwapLimit":false,"CpuCfsPeriod":true,"CpuCfsQuota":true,"IPv4Forwarding":true,"Debug":false,"NFd":14,"OomKillDisable":true,"NGoroutines":23,"SystemTime":"2018-07-05T15:05:56.876959806+08:00","ExecutionDriver":"native-0.2","LoggingDriver":"json-file","NEventsListener":0,"KernelVersion":"3.10.5-3.el6.x86_64","OperatingSystem":"\u003cunknown\u003e","IndexServerAddress":"https://index.docker.io/v1/","RegistryConfig":{"InsecureRegistryCIDRs":["127.0.0.0/8"],"IndexConfigs":{"docker.io":{"Name":"docker.io","Mirrors":["https://z12vx03m.mirror.aliyuncs.com/"],"Secure":true,"Official":true}}},"InitSha1":"5ebdf15aa01ed2e6fed430918bcec40ed2e72afe","InitPath":"/usr/libexec/docker/dockerinit","NCPU":4,"MemTotal":16726216704,"DockerRootDir":"/var/lib/docker","HttpProxy":"","HttpsProxy":"","NoProxy":"","Name":"training","Labels":null,"ExperimentalBuild":false}
```
#### Docker的远程访问
##### 环境准备
- 第二台安装docker的服务器
- 修改docker守护进程启动选项,区别服务器
  ```
  [root@vm1 ~]# cat /etc/sysconfig/docker
  other_args="--label name=docker_server2"  //修改一下标签
  [root@vm1 ~]# service docker restart
  停止 docker：                                              [确定]
  Starting docker:	                                   [确定]
  [root@vm1 ~]# docker info //查看修改是否成功
  ......
  Labels:                                   //修改成功
   name=docker_server2
  ```
- 务必保证client API 和Server的API 版本一致
- 修改服务器端的配置
  ```
  // 修改Docker守护进程启动选项,配置docker守护进程的服务器使用的socket
  -H tcp://host:port;
     unix:///path/to/socket;
     fd://* or fd://socketfd
  守护进程默认配置:
  -H unix:///var/run/docker.sock

  我的操作(docker服务器):
  ➜  ~ vi /etc/sysconfig/docker //修改配置文件
  other_args="--registry-mirror=https://z12vx03m.mirror.aliyuncs.com --label name=docker_server1 -H tcp://0.0.0.0:2375"
  ➜  ~ service docker restart
  Stopping docker:                                           [  OK  ]
  Starting docker:	                                   [  OK  ]

  //特别注意,当在服务器上为docker设置了远程链接的参数后,服务器本机是无法使用docker info 查看本机信息了.
  ➜  ~ docker info  //报错了
  Get http:///var/run/docker.sock/v1.19/info: dial unix /var/run/docker.sock: no such file or directory. Are you trying to connect to a TLS-enabled daemon without TLS?
  //我们可以在服务器本机设置一个DOCKER_HOST的环境变量,然后就可以使用docker info命令了
  ➜  ~ export DOCKER_HOST="tcp://127.0.0.1:2375"    //设置环境变量
  ➜  ~ docker info                            //成功
  Containers: 1
  Images: 17
  Storage Driver: aufs
   Root Dir: /var/lib/docker/aufs
   Backing Filesystem: extfs
   Dirs: 19
   Dirperm1 Supported: false
  Execution Driver: native-0.2
  Logging Driver: json-file
  Kernel Version: 3.10.5-3.el6.x86_64
  Operating System: <unknown>
  CPUs: 4
  Total Memory: 15.58 GiB
  Name: training
  ID: 25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX
  WARNING: No swap limit support
  Labels:
   name=docker_server1
  //当然我们也可以通过修改配置文件:
  ➜  ~ vi /etc/sysconfig/docker //修改配置文件,-H 可以设置多个参数值
  other_args="--registry-mirror=https://z12vx03m.mirror.aliyuncs.com --label name=docker_server1 -H tcp://0.0.0.0:2375 -H unix:///var/local/docker.sock"

  //在客户端(vm1)的操作:
  [root@vm1 ~]# curl http://192.168.88.123:2375/info  //访问服务器端的info API接口

  {"ID":"25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX","Containers":1,"Images":17,"Driver":"aufs","DriverStatus":[["Root Dir","/var/lib/docker/aufs"],["Backing Filesystem","extfs"],["Dirs","19"],["Dirperm1 Supported","false"]],"MemoryLimit":true,"SwapLimit":false,"CpuCfsPeriod":true,"CpuCfsQuota":true,"IPv4Forwarding":true,"Debug":false,"NFd":10,"OomKillDisable":true,"NGoroutines":14,"SystemTime":"2018-07-06T08:52:51.721012323+08:00","ExecutionDriver":"native-0.2","LoggingDriver":"json-file","NEventsListener":0,"KernelVersion":"3.10.5-3.el6.x86_64","OperatingSystem":"\u003cunknown\u003e","IndexServerAddress":"https://index.docker.io/v1/","RegistryConfig":{"InsecureRegistryCIDRs":["127.0.0.0/8"],"IndexConfigs":{"docker.io":{"Name":"docker.io","Mirrors":["https://z12vx03m.mirror.aliyuncs.com/"],"Secure":true,"Official":true}}},"InitSha1":"5ebdf15aa01ed2e6fed430918bcec40ed2e72afe","InitPath":"/usr/libexec/docker/dockerinit","NCPU":4,"MemTotal":16726216704,"DockerRootDir":"/var/lib/docker","HttpProxy":"","HttpsProxy":"","NoProxy":"","Name":"training","Labels":["name=docker_server1"],"ExperimentalBuild":false}
  ```
- 客户端(vm1)远程访问服务器的方法:
  ```
  // 我在客户端(vm1)的操作(连接一次):
  [root@vm1 ~]#
  [root@vm1 ~]# docker -H tcp://192.168.88.123:2375 info  //返回了docker server的信息
  Containers: 1
  Images: 17
  Storage Driver: aufs
   Root Dir: /var/lib/docker/aufs
   Backing Filesystem: extfs
   Dirs: 19
   Dirperm1 Supported: false
  Execution Driver: native-0.2
  Logging Driver: json-file
  Kernel Version: 3.10.5-3.el6.x86_64
  Operating System: <unknown>
  CPUs: 4
  Total Memory: 15.58 GiB
  Name: training
  ID: 25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX
  WARNING: No swap limit support
  Labels:
   name=docker_server1

  // 如果我们要频繁连接某一台服务器,用上述参数会很麻烦,我们修改客户端(vm1)配置文件(通过环境变量Docker_HOST):
  [root@vm1 ~]# export DOCKER_HOST="tcp://192.168.88.123:2375"

  [root@vm1 ~]# docker info //默认链接的就是DOCKER_HOST服务器
  Containers: 1
  Images: 17
  Storage Driver: aufs
   Root Dir: /var/lib/docker/aufs
   Backing Filesystem: extfs
   Dirs: 19
   Dirperm1 Supported: false
  Execution Driver: native-0.2
  Logging Driver: json-file
  Kernel Version: 3.10.5-3.el6.x86_64
  Operating System: <unknown>
  CPUs: 4
  Total Memory: 15.58 GiB
  Name: training
  ID: 25BV:OSGT:NYIQ:Z7DY:2GCF:4VRL:LJB2:3FPS:DJ24:QUJV:3RHQ:MTRX
  WARNING: No swap limit support
  Labels:
   name=docker_server1

  // 如果我们想链接本机(vm1)的docker守护进程只要清空DOCKER_HOST的值即可
  [root@vm1 ~]# export DOCKER_HOST=""
  [root@vm1 ~]# docker info
  Containers: 0
  Images: 0
  Storage Driver: aufs
   Root Dir: /var/lib/docker/aufs
   Backing Filesystem: extfs
   Dirs: 0
   Dirperm1 Supported: false
  Execution Driver: native-0.2
  Logging Driver: json-file
  Kernel Version: 3.10.5-3.el6.x86_64
  Operating System: <unknown>
  CPUs: 4
  Total Memory: 1.953 GiB
  Name: vm1
  ID: O2TC:E5L4:FG6N:XKJ3:N4D7:TSMO:DIGT:KP6A:F7F6:6KYW:HDXU:PUGR
  WARNING: No swap limit support
  Labels:
   name=docker_server2                  //是vm2的docker服务器信息了
  ```

#### Docker镜像与仓库(二)
##### dockerfile指令格式

  - `# COMMENTS    //注释,以#开头`
  - INSTRUCTION arguments     //指令,指令要以大写开始
  ```
  # First dockerfile              //注释
  FROM ubuntu:16.04               //基础镜像
  MAINTAINER Aphey "y2j@qq.com"   //维护人
  RUN apt-get update              //执行的命令
  RUN apt-get -y install nginx    //执行的命令
  EXPOSE 80                       //暴露的端口
  ```
  - FROM: 包含两种格式的参数,其中image必须是已经存在的镜像,后续指令都会基于这个镜像执行,
  所以这个镜像也叫做基础镜像,而且必须是dockerfile中第一条非注释的指令
  ```
  1) FROM <image>
  2) FROM <image>:<tag>
  ```
  - MAINTAINER <name> //作者信息,相当于docker commit命令的-a选项

  - RUN: 执行指令,指定当前景象中运行的命令,包含两种模式
  ```
  RUN <command>  (shell模式)
  RUN ["excutable" , "parameter 1", "parameter 2"] (exec模式)
    RUN ["/bin/bash","-c","echo hello"]
  ```
  - EXPOSE <port> [<port>....]  //用来指定运行该容器使用的端口,可以指定一个或多个
  ```
  // 虽然我们在dockerfile中指定了暴露的端口号,但是在我们运行容器的时候还是要手动映射端口,比如
  $ docker run -p 80:80-d --name web -it aphey/nginx nginx -g "daemon off;"
  ```

  - CMD指令
  ```
  // 指定容器运行时,运行指定的命令;但是当我在启动docker时,在命令行执行其他命令的话,CMD后面的命令将被覆盖不会执行
  CMD ["excutable","parameter1","parameter2"] (exec模式)
  CMD command parameter1 parameter2 (shell 模式)
  CMD ["parameter1","parameter2"] (作为ENTERYPOINT指令的默认参数)

  我的CMD操作:
  ➜  dockerfile vi df_test1/dockerfile

  #First dockerfile
  FROM ubuntu:16.04
  MAINTAINER Aphey "y2j@qq.com
  RUN apt-get update
  RUN apt-get -y install nginx
  EXPOSE 80
  CMD ["/usr/sbin/nginx","-g","daemon off;"]

  ➜  df_test1 docker build -t "aphey/df_test2" .
  Sending build context to Docker daemon 2.048 kB
  Sending build context to Docker daemon
  Step 0 : FROM ubuntu:16.04
   ---> 6e422b1b463a
  Step 1 : MAINTAINER Aphey "y2j@qq.com
   ---> Using cache
   ---> 535fd0f20153
  Step 2 : RUN apt-get update
   ---> Using cache
   ---> c5eb16d6e82f
  Step 3 : RUN apt-get -y install nginx
   ---> Using cache
   ---> 2c7260599423
  Step 4 : EXPOSE 80
   ---> Using cache
   ---> 821af07962f4
  Step 5 : CMD /usr/sbin/nginx -g daemon off;
   ---> Running in ee9345637015
   ---> 13f3679f7333
  Removing intermediate container ee9345637015
  Successfully built 13f3679f7333

  ➜  df_test1 docker run -p 80:80 --name web1 -d aphey/df_test2
  38561de37c0318ea7bb15251a53eefcc4739d10e408e49645d9728b152db1ee7

  ➜  df_test1 docker ps   //nginx已经运行了
  CONTAINER ID        IMAGE               COMMAND                CREATED             STATUS              PORTS                NAMES
  38561de37c03        aphey/df_test2      "/usr/sbin/nginx -g    29 seconds ago      Up 28 seconds       0.0.0.0:80->80/tcp   web1
  ➜  df_test1 docker top web1   //nginx已经运行了
  UID                 PID                 PPID                C                   STIME               TTY                 TIME                CMD
  root                23758               23436               0                   09:51               ?                   00:00:00            nginx: master process /usr/sbin/nginx -g daemon off;
  33                  23772               23758               0                   09:51               ?                   00:00:00            nginx: worker process
  33                  23773               23758               0                   09:51               ?                   00:00:00            nginx: worker process
  33                  23774               23758               0                   09:51               ?                   00:00:00            nginx: worker process
  33                  23775               23758               0                   09:51               ?                   00:00:00            nginx: worker process
  ```
  - ENTRYPOINT指令:
  ```
  // 与CMD指令非常相似,唯一的区别在于ENTRYPOINT指令不会被docker命令行中的命令覆盖
  ENTRYPOINT ["excutable","parameter1","parameter2"] (exec模式)
  ENTRYPOINT command parameter1 parameter2 (shell 模式)
  // 如果要覆盖ENTERYPOINT指令,可以用$ docker run --entrypoint选项
  ```

  - ADD和COPY指令
  ```
  // 用来设置镜像的目录和文件
  ADD
  ADD ["<src>"..."<dest>"] (适用于文件路径中有空格的情况)

  COPY
  COPY ["<src>"..."<dest>"] (适用于文件路径中有空格的情况)

  //ADD和COPY的区别是,ADD包含类似tar的解压功能,如果单纯复制文件,Docker推荐使用COPY
  ➜  df_test1 vi dockerfile

  #First dockerfile
  FROM ubuntu:16.04
  MAINTAINER Aphey "y2j@qq.com
  RUN apt-get update
  RUN apt-get -y install nginx
  COPY index.html /usr/share/nginx/html/    //会把dockfile同级目录下的index.html替换掉/usr/share/nginx/html/中的index.html
  EXPOSE 80
  ENTRYPOINT ["/usr/sbin/nginx","-g","daemon off;"]
  ```

  - VOLUME
  ```
  // VOLUME指令能够向基于镜像创建的容器添加卷,一个卷是可以存在于一个或多个容器的特定目录,这个目录可以绕过联合文件系统,并提供如共享数据或者对数据持久化的功能
  ```

  - WORKDIR, ENV, USER
  ```
  // 设定镜像在构建及容器运行时的环境设置
  WORKDIR: 用来在从镜像创建一个新容器时在容器内部设置工作目录ENTRYPOINT或者CMD指定的命令就是在这个目录下执行,我们也可以使用这个指令在构建中为后续的指令指定工作目录,workdir通常会使用绝对路径

  ENV指令用来设置环境变量
  ENV <key><value>
  ENV <key>=<value>...

  USER指令,指定镜像会以什么样的用户去运行,比如:
  USER nginx,就意味着基于该镜像启动的容器会议nginx用户来运行,常用格式(可以混搭):
  USER user; USER uid; USER user:group; USER uid:gid; USER user:gid; USER uid:group
  ```
  - ONBUILD
  ```
  // 镜像触发器的指令,当一个镜像被其他镜像作为基础镜像时执行,会在构建过程中插入指令
  ➜  df_test1 vi dockerfile

  #First dockerfile
  FROM ubuntu:16.04
  MAINTAINER Aphey "y2j@qq.com
  RUN apt-get update
  RUN apt-get -y install nginx
  ONBUILD COPY index.html /usr/share/nginx/html/    //当别的镜像以这个镜像为基础镜像时,构建过程中会把dockfile同级目录下的index.html替换掉/usr/share/nginx/html/中的index.html
  EXPOSE 80
  ENTRYPOINT ["/usr/sbin/nginx","-g","daemon off;"]

  //当我们再构建一个新镜像并以上面的镜像为基础镜像时.运行为容器的时候,就会触发上面的COPY命令
  ```
#### dockerfile的构建过程
##### docker是如何通过dockerfile来构建镜像的
1. 从基础镜像运行一个容器,也就是我们dockerfile中的FROM指令指定的镜像名
2. 执行一条指令,对容器做出修改
3. 执行类似docker commit的操作,提交一个新的镜像层
4. 再基于刚提交的镜像运行一个新容器
5. 再执行Dokcerfile中的下一条指令,直到所有指令执行完毕
##### 我们可以
