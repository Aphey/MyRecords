#### VI编辑器
- vi:Visual Interface 可视化编辑器
- vim: VI iMproved  增强版,功能可以语法着色
- 和nano一样也是全屏编辑器,模式化编辑器.
- 打开一个文件: vim /path/to/somefile
- 技巧:
	- 打开文件后,直接让光标处于第12行: vim +12
	- 打开文件后,直接处在最后一行: vim + FILENAME 即可,右下角还会显示Bot(Bottom)
	- vi还支持模式匹配,比如我要求打开文件,然后光标处在第一次我指定的字符所在的行上:
		` vi +/PATTERN FILENAME`
- 关闭文件:
	- vim 模式很多,常用的有三种:
		- 编辑模式(命令模式):击键会被理解为编辑文档的,比如删除两行,复制三行,粘贴10行等等;__默认模式__
		- 输入模式(输入内容):击键会被理解为输入到文件中的内容,保存在文档当中
		- 末行模式(最后一行键入一些命令):我们可以输入很多文件编辑外管理的命令.
	- 模式转换:
		- 编辑模式到输入模式:
			- i:在当前光标所在字符的前面转为输入模式  Insert:插入
			- a:append;在当前光标所在字符的后面转为输入模式Append:追加
			- o:当前光标所在行的下方新建一行,并转为输入模式Open:打开一个新行
			- I:在当前光标所在行的行首转为输入模式
			- A:在当前光标所在行的行尾转为输入模式
			- O:当前光标所在行的上方新建一行,并转为输入模式
			- r:替换光标所在处字符
			- R:从光标处开始替换,直到按ESC退出替换模式
			- u:取消上一步操作
		- 回到编辑模式: ESC键(CTRL+[也可以)
		- 末行模式:必须从编辑模式进;然后输入":"
			- :\# 跳转到第\#行
			- :10d 删除第10行
			- :10,20d 删除第10到第20行
			- :set nu 显示行号
			- :set nonu 不现实行号
			- :!COMMAND 在vi界面中执行系统命令
			- :r FILE 将文件导入到当前光标所在位置
			- :r !COMMAND 将命令执行结果导入到当前光标所在位置
			- :w 保存
			- :q 不保存退出
			- :wq (:x)保存退出
			- :q! 编辑了文件,不保存退出
			- :wq! 编辑了只读文件,强制保存退出
		- 末行模式地址定界:
    		- StartingLine,Endline etc:1,100 1到100行,$:最后一行.
    		- /pattern1/,/pattern2/,第一次被模式1匹配到的行,到第一次被模式2匹配到的行结束.
    		- LineNumber:指定的行
    		- 指定StartLine,+n,从指定行开始向后的n行.
		- 编辑模式下退出
			- ZZ键也可以保存退出
	- 移动光标:
		- 逐字符移动:(键盘上右手控制的几个键;可以指定数字接以下按键,表示移动对应的字符,比如5l表示向右移动5个字符)
			- h:向左
			- l:向右
			- j:向下 Japan 地图位置上在下面
			- k:向上 Korea地图位置上在上面
		- 逐单词移动:按单词为单位移动,也适合数字加按键的操作
			- w:移至下一个单词的词首
			- e:跳到当前单词词尾或下一个单词词尾
			- b:跳至当前或前一个单词的词首
		- 行内跳转:
			- 0:跳到行首,绝对行首空白字符也算.
			- ^:跳到行首,第一个非空白字符
			- $:绝对行尾
		- 行间跳转:
			- \#G: 跳转至第\#行
			- G:跳转到最后一行
		- 句间移动:
		    - (: 上一句
		    - ): 下一句
	    - 段落间跳转:
	        - {: 上一段
	        - }: 下一段
	- 翻屏操作:
		- CTRL+F forward向后翻屏
		- CTRL+B backward向前翻屏
		- CTRL+D down 向下翻半屏
		- CTRL+U up 向上翻半屏
	- 删除单个字符:
		- x 删除光标所在处的单个字符
		- \#x 删除光标所在处及向后的共\#个字符
	- 删除命令: d,要和跳转命令组合使用,指定删除多少.
		- d$ 删除光标当前位置到行尾
		- d0 删除光标当前位置到行首
		- dw 删除光标当前位置到下一个单词词首,
		- \#d跳转符 就表示删除跳转范围的\#个
		- dd 删除当前光标所在行
		- \#dd 删除包括当前光标所在行在内的共\#行
		- 末行模式下有以下删除方法:
			- :1,10d 删除第一行到第10行
			- :.,+5d 删除当前行及后面的5行,"."表示当前行
			- `$`表示最后一行,`$-1`倒数第二行
	- vi最近的删除及操作不会被立即清空,最后一次的删除其实是剪切,可以粘贴到别的位置.
	- 粘贴命令:
		- p:如果删除或复制的内容为整行内容,粘贴在当前光标位置的下一行;如果删除或复制的内容为非整行,则粘贴在光标所在字符的后面
		- P:如果删除或复制的内容为整行内容,粘贴在当前光标位置的上一行;如果删除或复制的内容为非整行,则粘贴在光标所在字符的前面
	- 复制命令: y(yank)用法同d命令
	- 先删除内容,再转换为输入模式:c 同 d命令
	- 替换:r
		- r:替换光标所在处字符
		- R:从光标处开始替换,直到按ESC退出替换模式
	- 撤销编辑:u(undo),连续u可以撤销此前的n次操作.默认vi只缓存50次操错;也可以\#u来撤销最近\#次操作;假如我多撤销了2次,就可以撤销撤销,可以用ctrl+r来取消之前的撤销
	- 重复前一次的编辑操作: "."
	- CTRL+G 可以查看当前文件的状态,比如当前位置,文件一共多少行等等
	- 可视化模式
		- v:按字符选取,可以选中光标划过的范围
		- V:按矩形选取,一般会直接选取光标所在的行
	- 查找替换
		- /PATTERN: 向文件尾部查找
		- ?PATTERN: 向文件首部查找
		- n 在查找到的结果里,向下一个匹配到的内容跳转
		- N 在查找到的结果里,向上一个匹配到的内容跳转
		- 末行模式下可以用s来查找,和sed中一样,方法为ADDR1,ADDR2s/OLD/NEW/g,意思是在ADDR1到ADDR2的范围里,用NEW来替换OLD;"%"表示全文.
	- 使用vim编辑多个文件: vim FILE1 FILE2 ...
		- 在末行模式下输入:next可以切换到另一个文件
		- 在末行模式下输入:prev可以切换到上一个文件
		- 在末行模式下输入:last可以切换到最后一个文件
		- 在末行模式下输入:first可以切换到最后一个文件
		- :qa 全部退出
	- 分屏显示一个文件(类似于word的窗口-拆分):
		- ctrl+w,s水平拆分窗口
		- ctrl+w,v水平拆分窗口
		- 窗口间切换:ctrl+w.ARROW键
	- 分窗口显示多个文件:
		- 水平分屏显示:vi -o rc.sysinit inittab
		- 垂直分屏显示:vi -O rc.sysinit inittab
	- 将当前文件中部分内容另存为另一个文件
		- :ADDR1,ADDR2w /path/to/newfile
	- 将另外一个文件的内容导入到当前文件中
		- :r /path/to/file
	- 跟shell交互
		- :! COMMAND
	- 高级话题,下面设定临时生效
		- 显示行号 :set nu
	 	- 取消显示行号 :set nonu
	 	- 设定vim编辑器忽略大小写 :set ic(ignorecase)
	 	- 设定vim编辑器区分大小写 :set noic
	 	- 设定自动缩进 :set ai(autoindent)
	 	- 取消自动缩进 :set noai
	 	- 高亮显示查找文本 :set hlsearch
	 	- 取消高亮显示查找结果 :set nohlsearch
	 	- 语法着色 :syntax on
	 	- 关闭语法着色 :syntax off
	- vim配置文件:
		- /etc/vimrc 全局配置
		- ~/.vimrc 用户配置,可能不存在,需要自己建
		- 也可以在末行模式设置
    - 常规vim配置选项:
	    - 显示行号:set nuumber;末行模式可以简写为 set nu
	        - 关闭行号:set nonumber;末行模式可以简写为 set nonu
	    - 括号匹配(光标在左括号,对应的右括号会亮): set showmatch;末行模式可以简写为 set sm
	        - 关闭: set noshowmatch/set nosm
        - 自动缩进: set autoindent/set ai
            - 关闭: set noautoindent/set noai
        - 搜索高亮: set hlsearch
            - 关闭: set nohlsearch
	    - 语法高亮: syntax on/off
	    - 忽略字符大小写: set ic(ignore case)
	        - 不忽略(默认): set noic
- 设置tab键缩进为4个字符
    ```bash
    为了vim更好的支持Python写代码,修改tab默认4个空格有两种设置方法：

    1) vim /etc/vimrc

    1	set ts=4
    2	set sw=4

		2) vim /etc/vimrc

    1	set ts=4
    2	set expandtab
    3	set autoindent

    //推荐使用第二种，按tab键时产生的是4个空格，这种方式具有最好的兼容性
    ```
	- vim教程 `vimtutor`
	- 有时候我们打开vim编辑文件的时候,会突然断开网络或者退出文件,然后在打开文件的时候就会报错.这时候会在源文件目录下生成一个同名的.swp文件.我们可以通过 vim -r FILE来恢复这个文件.如果我们不需要这个恢复,我们可以删除这个.swp文件.
#### 练习:
- 复制/etc/grub2.cfg到/tmp/目录,用查找替换命令删除/tmp/grub2.cfg文件中行首的空白字符
    ```bash
    :%s/^[[:space:]]\+//g
    ```
- 复制/etc/rc.d/init.d/functions到/tmp/目录,用查找替换命令为/tmp/functions的每行开头为空白字符的行首添加一个"#".
    ```bash
    :%s/^[[:space:]]/#&/
    ```
- 将/etc/yum.repos.d/CentOS-Base.repo文件中的所有enabled=0替换成enabled=1,所有gpgcheck=0替换为gpgcheck=1.
	```bash
	:%s@\(enabled\|gpgcheck\)=0@\1=1@g
	//注意:表示或者的|要转义
	```
#### sed(流编辑器),awk(报告文本生成器)
- sed基本用法:stream editor,它是一个行编辑器,逐行编辑;vi是全屏编辑器
- 处理机制:逐行读取,读取到内存中,在内存中处理,处理的结果显示到显示器上,内存中的空间叫模式空间
- 默认情况下,sed不编辑源文件,仅对模式空间中的数据做处理
- 命令格式:sed [OPTIONS] 'AddressCommand' FILE1 FILE2 ...
	- Address:地址定界
		1. StartingLine,Endline etc:1,100 1到100行,$:最后一行.
		2. /RegExp/ /正则表达式/;被此模式匹配到的每一行 /^root/
		3. /pattern1/,/pattern2/,第一次被模式1匹配到的行,到第一次被模式2匹配到的行结束.
		4. LineNumber:单地址,指定的行
		5. 指定StartLine,+n,从指定行开始向后的n行.
		6. 1~3;3是步进;
		    ```bash
		    [root@mail tmp]# sed -n '1~2p' a    //同样表示奇数行,1表示起始行
            1
            3
            5
            7
            9
		    ```
		7. 不给地址: 对全文进行处理.
	- Options:
		- -n:静默模式:不显示匹配到的行;不再默认显示内存(模式空间)中的内容,可以用p命令测试
		```bash
		[root@ZhumaTech sh]# sed -n '/^root/ p' /etc/passwd //如果不加-n选项,结果会显示两边,一遍符合条件的,一遍模式空间的
		root:x:0:0:root:/root:/bin/bash
		```
		- -i:直接修改源文件,edit in source file
		- -e SCRIPT1 -e SCRIPT2:可以同时执行多个脚本,多点编辑
		- -f /PATH/TO/SED_SCRIPT:把SCRIPT文件以行保存至文件当中
			- sed -f /path/to/scriptfile
		- -r:使用扩展正则表达式
	- Command: 使用方法是'地址命令',地址后面就紧跟着命令,多个处理命令用";"隔开
		- d:删除符合条件的行
		- p:显示模式空间的行
		- a(append) \string: 在指定的行后面追加新行,内容为"string";\n 可以换行
    		```
    		[root@mail ~]# sed  '/^UUID/a \hello sed' /etc/fstab
            UUID=49d9a794-c34a-42b9-9d21-83533dadcee0 /                       ext4    defaults        1 1
            hello
             sed
            UUID=1533c3dc-ccfc-4cdb-a968-a85d817145c7 /boot                   ext4    defaults        1 2
            hello
             sed
            UUID=1e3ec33f-5a90-4a19-8a1b-be805c409d6c swap                    swap    defaults        0 0
            hello
             sed
    		```
		- i(insert) \string: 在指定的行前面追加新行,内容为"string";\n 可以换行;
    		```bash
    		[root@mail ~]# sed  '/^UUID/i \hello \n sed ' /etc/fstab
            hello
             sed
            UUID=49d9a794-c34a-42b9-9d21-83533dadcee0 /                       ext4    defaults        1 1
            hello
             sed
            UUID=1533c3dc-ccfc-4cdb-a968-a85d817145c7 /boot                   ext4    defaults        1 2
            hello
             sed
            UUID=1e3ec33f-5a90-4a19-8a1b-be805c409d6c swap                    swap    defaults        0 0
            tmpfs                   /dev/shm                tmpfs   defaults        0 0
            devpts                  /dev/pts                devpts  gid=5,mode=620  0 0
            sysfs                   /sys                    sysfs   defaults        0 0
            proc                    /proc                   proc    defaults        0 0
            /mnt/CentOS-6.5-x86_64-bin-DVD1.iso	/mnt/cdrom	iso9660	defaults,loop	0 0
    		```
		- c(change) \string: 替换行为单行或多行文本, \n换行
		    ```bash
		    [root@mail ~]# sed  '/^UUID/c \hello \n sed ' /etc/fstab
		    hello
             sed
            hello
             sed
            hello
             sed
		    ```
		- r FILE:将指定的文件的内容添加至符合条件的行处;一般都是用来合并文件 read

	        ```bash
	        [root@ZhumaTech sh]# sed '2r /etc/issue' ./bash.sh
	        #!/bin/bash
	        CentOS release 6.5 (Final)
	        Kernel \r on an \m

	        grep "\bbash$" /etc/passwd &>/dev/passwd
	        RETVAL=$?

	        if [ $RETVAL -eq 0 ]; then
	                USERS=`grep "\bbash$" /etc/passwd | wc -l`
	                echo "$USERS users are using bash as default shell."
	        else
	                echo "No such users"
	        fi
	        ```

		- w FILE:将模式空间中匹配到的行另存至指定的文件中
            ```bash
            [root@mail ~]# sed  '/^UUID/w /tmp/fstab.txt ' /etc/fstab
            #
            # /etc/fstab
            # Created by anaconda on Mon Aug 14 19:26:37 2017
            #
            # Accessible filesystems, by reference, are maintained under '/dev/disk'
            # See man pages fstab(5), findfs(8), mount(8) and/or blkid(8) for more info
            #
            UUID=49d9a794-c34a-42b9-9d21-83533dadcee0 /                       ext4    defaults        1 1
            UUID=1533c3dc-ccfc-4cdb-a968-a85d817145c7 /boot                   ext4    defaults        1 2
            UUID=1e3ec33f-5a90-4a19-8a1b-be805c409d6c swap                    swap    defaults        0 0
            tmpfs                   /dev/shm                tmpfs   defaults        0 0
            devpts                  /dev/pts                devpts  gid=5,mode=620  0 0
            sysfs                   /sys                    sysfs   defaults        0 0
            proc                    /proc                   proc    defaults        0 0
            /mnt/CentOS-6.5-x86_64-bin-DVD1.iso	/mnt/cdrom	iso9660	defaults,loop	0 0
            [root@mail ~]# cat /tmp/fstab.txt\
            UUID=49d9a794-c34a-42b9-9d21-83533dadcee0 /                       ext4    defaults        1 1
            UUID=1533c3dc-ccfc-4cdb-a968-a85d817145c7 /boot                   ext4    defaults        1 2
            UUID=1e3ec33f-5a90-4a19-8a1b-be805c409d6c swap                    swap    defaults        0 0
            ```

        - =: 为模式空间中的行打印行号
        - !: 可以理解为对地址定界取反
            ```bash
            [root@mail ~]# sed '/^UUID/!d' /etc/fstab   //可以理解为删除不是以UUID开头的行
            UUID=49d9a794-c34a-42b9-9d21-83533dadcee0 /                       ext4    defaults        1 1
            UUID=1533c3dc-ccfc-4cdb-a968-a85d817145c7 /boot                   ext4    defaults        1 2
            UUID=1e3ec33f-5a90-4a19-8a1b-be805c409d6c swap                    swap    defaults        0 0
            ```
		- s/PATTERN/STRING/修饰符: s: substitute查找并替换;默认是替换每一行第一个符合条件的字串;要查找的内容：可使用模式;替换为的内容：不能使用模式，但可以使用\1, \2, ...等后向引用符号；还可以使用“&”引用前面查找时查找到的整个内容.
			- 修饰符 g:全局替换
			- 修饰符 i:查找时忽略字母大小写
			- 修饰符 p: 显示替换成功的行
			- 修饰符 w /PATH/TO/FILE: 将替换成功的结果保存到指定文件中
			- 后向引用在这里也适用

			    ```bash
			    [root@ZhumaTech sh]# nano sed.txt
			    hello,like
			    hi, my love
			    //-----下面使用后向引用-----
			    [root@ZhumaTech sh]# sed 's/\(l..e\)/\1r/' sed.txt
			    hello,liker
			    hi, my lover
			    // 等同于
			    [root@ZhumaTech sh]# sed 's@\(l..e\)@&r/' sed.txt
			    ```

			- 上面的例子我们可以使用另外一个特殊字符"&",其意义是引用模式匹配到的整个串.

                ```bash
                //下面的命令同样能完成
                [root@ZhumaTech sh]# sed 's/l..e/&r/' sed.txt
                hello,liker
                hi, my lover
                ```

#### 练习
- 删除/boot/grub/grub.conf中所有以空白开头的行行首的空白字符
    ```bash
    [root@mail ~]# sed 's@^[[:space:]]\+@@' /boot/grub/grub.conf
    ```
- 删除/etc/fstab文件中所有以#开头,后面至少跟一个空白字符行的行首的#和空白字符
    ```bash
    [root@mail ~]# sed 's/^#[[:space:]]\+//' /etc/fstab
    ```
- echo一个绝对路径给sed命令,取出其基名;取出其目录名
   ```bash
    # 其实就是弄明白如果文件基名(文件或目录的名称)的父目录们是由"/.*/"组成的,而基名是由至少一个(+)非'/'字符[^/]组成,
    # 最后以为如果是目录则有一个'/',文件则有0个'/'(/?)
    [root@ZhumaTech sh]# echo '/etc/rc.d' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/
    [root@ZhumaTech sh]# echo '/etc/rc.d/rc5.d/' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/rc.d/
    [root@ZhumaTech sh]# echo '/etc/rc.d/rc5.d/S26udev-post' | sed -r "s@(^/.*/)[^/]+/?@\1@g"
    /etc/rc.d/rc5.d/
    [root@mail ~]# echo '/etc/rc.d/fstab/tec/asc' | sed 's@\(/.*/\)[^/]\+@\1@'
    /etc/rc.d/fstab/tec/
    [root@mail ~]# echo '/etc/rc.d/fstab/tec/asc/' | sed -r 's@/.*/([^/]+)@\1@' //就是找准后向引用的部分即可
    asc/
    ```
- bash有个特性,叫截取变量字符串`${PARAMETER#KEYWORD},${PARAMETER##KEYWORD},${PARAMETER%KEYWORD},${PARAMETER%%KEYWORD}``:看例子
    ```
    [root@Aphey boot]# FILE=/usr/local/src
    [root@Aphey boot]# echo $FILE
    /usr/local/src
    [root@Aphey boot]# echo ${FILE#/}   //从左往右,省略掉第一个关键字"/"及其左边的内容
    usr/local/src
    [root@Aphey boot]# echo ${FILE##*/} //从左往右,省略掉第一个关键字到最右的关键字"/"及他们左边的内容
    src
    [root@Aphey boot]# FILE=a/usr/local/src
    [root@Aphey boot]# echo ${FILE%/*}     //从右往左,省略掉第一个关键字"/"及其右边的内容
    a/usr/local
    [root@Aphey boot]# echo ${FILE%%/*}    //从右往左,省略掉第一个关键字到最左的关键字"/"及他们右边的内容
    a
    ```
#### sed高级命令
- sed的工作模式是在文件中读取一行到模式空间中,如果符合条件,就进行定界和处理;事实上sed内部还有一个内存空间,我们把它称为保持空间(hold space); 我们可以把sed理解为一个加工工具,要实行加工工作,就需要车间,我们可以把模式空间理解为车间,而hold space可以理解为半成品仓库,一般模式空间中的产品没有加工完,但是我们又需要处理下一个内容,可以把此前那个未完成的工作先放入到保持空间中,sed的一些高级命令就要用到sed的保持空间
    - h: 把模式空间中的内容__覆盖__至保持空间中;
    - H: 把模式空间中的内容__追加__至保持空间中;
    - g: get,从保持空间中取回覆盖至模式空间;
    - G: 从保持空间中取回追加至模式空间;
    - x: exchange,把模式空间和保持空间中的内容互换;
    - n: 读取匹配到的行的下一行至模式空间;
    - N: 追加匹配到的行的下一行至模式空间;
    - d: 删除模式空间中的行,只能删一行;
    - D: 删除多行模式空间中的所有行;
- 一些例子
    ```
    [root@mail tmp]# cat a
    1
    2
    3
    4
    5
    6
    7
    8
    9
    10
    [root@mail tmp]# sed -n  "n;p" a    //逐行读取a,匹配第一行,显示第二行,然后匹配第三行,显示第四行,以此类推
    2
    4
    6
    8
    10
   [root@mail tmp]# sed 'n;d' a    //显示奇数行
    [root@mail tmp]# sed '1!G;h;$!d' a  //逆向显示文件内容,效果和tac一样
    10
    9
    8
    7
    6
    5
    4
    3
    2
    1
    // 1!G 模式空间不是第一行的话,把保持空间的不是第一行的数据追加到模式空间;$!d,不是最后一行,就删除.
    [root@mail tmp]# sed '/^$/d;G' a[root@mail tmp]# sed '/^$/d;G' a    //每行之间插入空白行,并且多个空白行合并成一个空白行
    [root@mail tmp]# sed 'G' a  //每行之间插入一个空白行
    ```
