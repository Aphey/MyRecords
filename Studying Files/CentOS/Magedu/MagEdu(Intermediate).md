#### DNS服务相关概念
- DNS:域名解析,DNS核心和标准都是基于一款叫BIND(Berkeley Internet Name Domain)的软件实现的.
- Selinux: Secure Enhanced Linux 安全加强的Linux;我们操作系统的安全是有评级的分为A;B1,B2;C1,C2,C3和D级;我们的Linux和Windows都是C2级;我们Linux加了Selinux机制以后,我们的安全级别可以从C2提升到B1级别.Selinux的配置及其复杂.
- DNS:Domain Name Service 域名服务器
- 域名:www.aphey.com(这其实不是域名,这是主机名;FQDN: Full Qualified Domain Name,完全限定域名或者完全合格域名);aphey.com才是域名,com也是域名.
- DNS的功能:名称解析 Name Resolving;简单来说名称解析就是名称转换,背后有查询过程,数据库中查询;实现FQDN到IP地址之间的转换;这个转换过程是双向的;需要实现名称解析的不仅仅有DNS,我们根据用户名找到ID也是名称解析
- 要完成名称解析机制的有很多:用户-id,服务和套接字,等等,为了有一个统一的框架于是就出现了nsswitch
- nsswitch: 就是实现为多种需要实现名称解析的机制提供名称解析的平台(可以理解为淘宝),解析用户名到uid,解析域名和IP等解析机制可以理解为淘宝上的店铺,nsswitch的框架其实就是一个配置文件/etc/nsswitch.conf.
    - 能够将域名转换成IP地址的解析机制有很多,常用的有下面两个库文件:
        - libnss_files.so
        - libnss_dns.so
    - 早期主机很少,就靠主机上的hosts文件,他的格式是:
    
        ```c
        IPADD           FQDN         ALIASES
        192.168.1.77    www.aphey.com   www
        ```
    
    - 随着网络的发展,加入网络中的主机越来越多,于是就出现了名称地址管理机构IANA(Internet Assigned Numbers Authority),这个机构有政府北京,大家伙不认可或者说是不放心,于是这个机构转交给了另外一个民间机构互联网名称与数字地址分配机构ICANN(Internet Corporation for Assigned Names and Numbers)
    - IANA(ICANN): 首先申请一个IP地址,IP不容易及,我们再申请一个FQDN,IANA维护了一个数据库,里面建立了IP和FQDN的对应关系,哪么我们怎么联系新加进来的主机呢? IANA早期通过ftp服务器维护更新着一个hosts文件,那我们只要同步更新IANA的hosts,就能知道新加进来的主机服务器;现在互联网上的主机数目已经是天文数字了.这种爆炸式的增长,我们再更新hosts已经不科学了.于是IANA建了一个服务器;以后我们再访问新主机的时候,只要提交给IANA,他们帮我们解析;减少了我们客户机操作的复杂度.但是1个server已经不堪重负了;为了实现名称组织成分布式结构,IANA研制了新的结构:分布式数据库
    - 分布式数据库:把DNS从一个集中的数据库转换成分布式数据库.
    - 根域
        - 顶级域(Top Level Domain),也叫一级域名,都是有ICANN管理的或者授权给某个机构进行管理的;常规有三类;然后下面还有二级域名:
            1. 组织域: .com, .org, .net, .cc
            2. 国家域: .cn, .us ...
            3. 反向域: 将ip转换成FQDN,ip-->FQDN使用的是一套数据库(反向),FQDN-->IP是另外一套数据库(正向).
- 递归和迭代的区别,看个例子:
    - 递归: A问B一个问题,B说不知道,C可能知道,于是B带着A的问题去问C,然后C告诉B答案,B再带着答案告诉A,这种A只发起一次请求的就叫递归
    - 迭代: A问B一个问题,B说不知道,给A一个提示(hint)C可能知道,于是A直接去问C,C再告诉A答案.这种A要发起多次请求的就叫迭代
    - 假如我们建了一台域名解析的服务器ns.aphey.com,他工作的方法如下:我们客户机A要访问www.magedu.com: A-->ns.aphey.com-->根域(根域说.com应该会知道)于是ns.aphey.com-->.com;.com说magedu应该知道,于是ns.aphey.com再找到magedu.com,magedu.com说我知道,然后告诉给ns.aphey.com; 所以我们这个请求分成两段,A到ns.aphey.com是递归的,ns.aphey.com到www.magedu.com是迭代.
    - 注意,___为了安全,也为了让根域不会忙死,根是不给任何人递归的___;在上述例子中,magedu.com在返回给ns.aphey.com 答案时,而且magedu.com给ns.aphey.com的答案是权威的,除了magedu.com之外给的答案叫非权威答案(包括缓存的也是非权威);非权威答案会过期,这个过期时间怎么定义的呢,在magedu.com给答案的时候,还会同时返回一个超时时间的,ns.aphey.com会根据这个超时时间来决定缓存多长时间;这个时间我们在域名解析列表里可以看到,叫做生存时间TTL(TIME TO LIVE).
    - 注意,ns.aphey.com 不仅要负责本域内客户机向外面服务器查询的请求,还要负责外面的客户机向本域内机器访问的请求;同时还可以负责,域内机器互相之间的访问的请求.
    - 如果,作为一个公司,我这个域内的主机很少,我们要在互联网上建一个服务器来解析自己的域名就很费劲了,那我们能不能一个服务器管理多个域;答案是肯定的.
    - DNS高级机制,一个域名可以对应多个IP,可以实现负载均衡;但是效果并不是很好.
    