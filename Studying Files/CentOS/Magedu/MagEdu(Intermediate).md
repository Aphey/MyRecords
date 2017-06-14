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
    - DNS高级机制,一个域名可以对应多个IP,可以实现负载均衡;但是效果并不是很好;后面会讲.
    - /etc/resolv.conf 中nameserver 后的IP一定要能够递归的
    - 全球的根服务器节点一共有13个,这13台服务器的数据必须是一致的.
- DNS服务器的主从结构
    - 主DNS服务器: 一般数据修改都在主服务器上修改,push机制    
    - 辅助DNS服务器: 请求数据同步,pull机制;一般情况,每隔一段时间就请求主服务器,查看数据是否有改动;万一主DNS挂了,辅助DNS服务器会每隔一段时间来检查一下,如果在有效期内得不到主DNS的回应,它会自杀.
    - 一般我们要定义主从服务器的常用数据:
        - 版本号:主从服务器各有一个serial number: 辅助服务器的一定不能手动改变,当辅助服务器的版本号低于主服务器的版本号时,说明有改动
        - refresh: 定义检查时间的周期,每隔多长时间检查主服务器的版本号.
        - retry: 定义重试时间,当主服务器没有回应的时候,辅助服务器会重新发起请求,这个充实时间一定要小于刷新时间的周期
        - expire: 过期时间,最终确定主服务器挂了的时间,也就是辅助服务器殉岗的时间.
        - nagative answer TTL: 否定回答的缓存时长,当别人查询的域名不存在的时候缓存时长.
- 特殊的DNS服务器
    - 缓存DNS服务器,不提供权威答案,用来负责缓存,比如我们局域网内10000个人同时访问baidu.com,会很占用网络资源,于是我们就搭了一个缓存DNS服务器,用来负责缓存
    - 转发器: 不缓存,只负责转发请求
- DNS数据库中,每一个条目都称作一个资源记录(Resource Record,RR),资源记录的格式:
    `TTL 600;`
    | Name | TTL(可以省略,如果所有条目的TTL都一样,我们可以在上面定义一个全局TTL) | IN(Internet) | RRT(Resource Record type)资源记录类型 | VALUE|
    |---|---|---|---|---|
    | www.magedu.com. | 600 | IN | A | 1.1.1.1|
    | 1.1.1.1 | 600 | IN | PTR | www.magedu.com. |

    - RRT,Resource Record Type资源记录类型:
        - ___SOA(Start of Authority):起始授权记录,用于标明一个区域内部,主从服务器之间如何同步数据,以及起始授权对象是谁;必须放在第一条___,格式独特: `ZONE_NAME TTL  IN  SOA 主DNS地址(FQDN) ADMINISTRATOR_MAILBOX 5个属性(Serial number...)  `;注意这个5个属性可以分行写, 常用时间单位: M;H;D;W;默认是秒;还有邮箱格式: admin@aphey.com 中的'@'是不能用的,所以邮箱格式是admin.aphey.com
            ```c
            // 例子,注意";"后面是注释:
            aphey.com   600 IN  SOA ns1.aphey.com   admin.aphey.com (
                                 20170613 ; 格式随便,你用1也可以
                                 1H ; 刷新时间
                                 5M ; 重试时间
                                 7D ; 辅助服务器过期时间,殉岗时间
                                 1D ; 否定回答时间 )
            // 也可以不换行,不换行时,5个属性的括号都可以省略,我们可以把括号理解为换行符,写成
            aphey.com   600 IN  SOA ns1.aphey.com   admin.aphey.com ( 20170613 1H 5M 7D 1D )
            // 不赞成第二种写法
            ``` 
        - NS(Name Server): 从区域名(Zone Name) --> FQDN
            ```c
            // 一般指定了NS 解析后,还得给他分配一个IP地址,所以一般NS解析和A记录解析都是成对出现;主从需要在区域内部定义.
            aphey.com    600 IN NS ns1.aphey.com.
            aphey.com    600 IN NS ns2.aphey.com.
            ns1.aphey.com 600 IN A 1.1.1.2
            ns2.aphey.com 600 IN A 1.1.1.5
            ```
        - A记录：(address) : FQDN-->IPV4
            将域名指向一个IPv4地址（例如：10.10.10.10），需要增加A记录
        - CNAME记录(Canonical NAME)：FQDN-->FQDN
            如果将域名指向一个域名，实现与被指向域名相同的访问效果，需要增加CNAME记录;别名记录
            `www2.aphey.com.     IN  CNAME   www.aphey.com.`
        - PTR (pointer): IP-->FQDN  `1.1.1.1    600     IN    PTR    www.magedu.com.`
        - MX记录：(Mail Exchanger)： Zone Name -->FQDN;
            建立电子邮箱服务，将指向邮件服务器地址，需要设置MX记录;邮件服务器的解析格式也很独特,需要指定___优先级pri___,优先级是`0-99`的,数字越小级别越高,当我们有多台邮件服务器的时候,他就找优先级高的服务器来负责,玩意这台服务器不在线,它就找下一台机器,同样的,邮件服务器还得再给一个A记录
            | Zone Name | TTL | IN(Internet) | MX | pri| VALUE|
            |---|---|---|---|---|---|
            | magedu.com. | 600 | IN | MX | 10 | mail.magedu.com |
            | mail.magedu.com. | 600 | IN | A | &nbsp; | 1.1.1.3 |
            ```c
            //邮件服务器一般也是设置
            ```
        - TXT记录：
            可任意填写（可为空），通常用做SPF记录（反垃圾邮件）使用
        - AAAA记录： FQDN-->IPv6
            将主机名（或域名）指向一个IPv6地址（例如：ff03:0:0:0:0:0:0:c1），需要添加AAAA记录
        - SRV记录：
            记录了哪台计算机提供了哪个服务。格式为：服务的名字.协议的类型（例如：_example-server._tcp）
        - 显性URL：
            将域名指向一个http（s)协议地址，访问域名时，自动跳转至目标地址（例如：将www.net.cn显性转发到www.hichina.com后，访问www.net.cn时，地址栏显示的地址为：www.hichina.com）。
        - 隐性URL：
            与显性URL类似，但隐性转发会隐藏真实的目标地址（例如：将www.net.cn隐性转发到www.hichina.com后，访问www.net.cn时，地址栏显示的地址仍然为：www.net.cn）。 
- 域和区域的区别:
    - 域:Domain
    - 区域:Zone
    - DNS中,域是逻辑概念,区域是物理概念,比如我注册了域aphey.com,也就意味着有这么一个范围贵我管了,在DNS服务器里有正向解析和反向解析,他们用的不是同一个数据库,走的也不是同一条路,所以我们既要实现正向解析,又要实现反向解析,就得建立两个文件,一个实现正向解析(这一块就叫正向解析区域),另一个实现反向解析(这一块就叫反向解析区域);___区域和域之间没有必然的谁包含谁的关系,因为你的域也是被上一级的区域中包含的___
    - 两个区域的文件是我们按照自己的规划手动写进去的
        - 正向区域文件;_MX记录和A只能定义在正向当中;NS正向反向都可以定义_:
       
        ```c
        // 开头第一行
        aphey.com   IN  SOA
        // 上面一行可以写成
        @   IN  SOA
        // PTR记录
        www.aphey.com.   IN     A   192.168.0.1
        // 上面一行可以简写为:
        www         IN      A       192.168.0.1        
        ```
        
        - 反向区域文件;_PTR记录只能定义在反向当中;NS正向反向都可以定义._
        
        ```c
        0.168.192(网段地址反过来写).in-addr.arpa  IN  SOA
        // 反向解析
        1.0.168.192.in-addr.arpa     IN      PTR     www.aphey.com.(FQDN是坚决不可以简写)
        // 上面一行可以简写为
        1   IN      PTR     www.aphey.com.
        ```
        
    - 所以主从服务器之间同步的就是区域文件,假如我们刷新时间是1H,但是在刚刷新后5M 主服务器的发生改变,那么接下来的55M内,从服务器是无法获得更新的;所以我们主服务器要推送,要通知从服务器;这个数据传送的过程叫做区域传送,区域传送有两种类型:
        1. 完全区域传送,Axfr all transfer,一般是增加新服务器的时候;
        2. 增量区域传送: ixfr incremental zone transfer 只传送改变的内容
    - 从服务器也可从另外一个从服务器哪里传输数据
    - 针对传输数据时的区域类型:
        - 主区域:Master 主DNS服务器
        - 从区域:Slave 从DNS服务器
        - 提示区域:Hint 定义根在什么地方
        - 转发区域:Forward,直接提示域在什么地方
- 以上基本概念解释完了

#### BIND97服务安装
