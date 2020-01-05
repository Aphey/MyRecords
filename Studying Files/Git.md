#### 一) 安装完git后先配置User信息

##### 1.配置user.name和 user.email

```bash
[root@vm1 ~]# git config --global user.name 'Aphey'
[root@vm1 ~]# git config --global user.email 'y2j@qq.com'
//--global 表示对当前用户所有仓库生效, 除了--global还有--local和--system两个参数
//--local表示只对某个仓库有效;
//--system则表示对所有登录的用户有效,这个不常用
```

#### 2. 显示config的配置,加--list

```bash
[root@vm1 ~]# git config --list --local
fatal: unable to read config file '.git/config': No such file or directory
[root@vm1 ~]# git config --list --system
fatal: unable to read config file '/etc/gitconfig': No such file or directory
[root@vm1 ~]# git config --list --global
user.name=Aphey
user.email=y2j@qq.com
```

#### 二) 建git仓库

#### 两种场景

##### 1.把已有的项目代码纳入Git管理

```bash
[root@vm1 ~]# mkdir gitdemo	//假设gitdemo是我们当前已有的项目
[root@vm1 ~]# cd gitdemo/
[root@vm1 gitdemo]# git init
Initialized empty Git repository in /root/gitdemo/.git/
[root@vm1 gitdemo]# ls -al
total 4
drwxr-xr-x. 3 root root   18 Dec  5 07:47 .
dr-xr-x---. 3 root root 4096 Dec  5 07:47 ..
drwxr-xr-x. 7 root root  119 Dec  5 07:47 .git
```



##### 2.新建的项目直接用Git管理

```bash
[root@vm1 ~]# mkdir codes
[root@vm1 ~]# cd codes
[root@vm1 codes]# git init git_learning
Initialized empty Git repository in /root/codes/git_learning/.git/
[root@vm1 codes]# cd git_learning/
[root@vm1 git_learning]# ls -al
total 0
drwxr-xr-x. 3 root root  18 Dec  5 07:51 .
drwxr-xr-x. 3 root root  26 Dec  5 07:51 ..
drwxr-xr-x. 7 root root 119 Dec  5 07:51 .git
//查看一下当前项目的global配置情况
[root@vm1 git_learning]# git config --global --list
user.name=Aphey
user.email=y2j@qq.com
//给当前项目设定local配置
[root@vm1 git_learning]# git config --local user.name 'WJL'
[root@vm1 git_learning]# git config --local user.email 'wangjinlong@yeah.net'
[root@vm1 git_learning]# git config --local --list
core.repositoryformatversion=0
core.filemode=true
core.bare=false
core.logallrefupdates=true
user.name=WJL
user.email=wangjinlong@yeah.net
```

##### 3.新增文件到管理库

```bash
[root@vm1 git_learning]# vi readme	//创建一个readme
▽
  1 Hello
  2 It's a readme.
[root@vm1 git_learning]# git add readme //将readme添加到git管理中
[root@vm1 git_learning]# git status	//查看git状态
# On branch master
#
# Initial commit
#
# Changes to be committed:
#   (use "git rm --cached <file>..." to unstage)
#
#       new file:   readme
#
[root@vm1 git_learning]# git commit -m "add readme"	//提交变更
[master (root-commit) 84afc80] add readme
 1 file changed, 2 insertions(+)
 create mode 100644 readme
[root@vm1 git_learning]# git log	//查看日志
commit 84afc80399122cb90b8d78943aa9516eea6ed0e1
Author: WJL <wangjinlong@yeah.net>
Date:   Thu Dec 5 07:57:49 2019 +0800

    add readme
```

> ***上面的例子可以看到local的优先级要比global的优先级高!***

####  三) git的工作区和暂存区

git的工作方式: 在工作目录中添加或者修改文件--> git add files -->添加到暂存区-->git commit-->提交到版本历史里

`git add -u`命令可以将git跟踪了(-u可以理解为update)的文件一块提交到暂存区,就不用`git  add 多个文件名`了;前提是这些文件之前已经被add过且commit过.

#### 四)文件重命名的简便方法

##### 1.原始方法

```bash
1) 在工作目录中先重命名
[root@vm1 git_learning]# mv b b.md 
[root@vm1 git_learning]# git status
# On branch master
# Changes not staged for commit:
#   (use "git add/rm <file>..." to update what will be committed)
#   (use "git checkout -- <file>..." to discard changes in working directory)
#
#       deleted:    b
#
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#       b.md
no changes added to commit (use "git add" and/or "git commit -a")
2) 添加重命名后的文件b.md到git管理中
[root@vm1 git_learning]# git add b.md
[root@vm1 git_learning]# git status	
# On branch master
# Changes to be committed:
#   (use "git reset HEAD <file>..." to unstage)
#
#       renamed:    b -> b.md	//git比较智能,发现是重命名b 到b.md
#
3) 在git管理中删除原始文件b
[root@vm1 git_learning]# git rm b
rm 'b'
[root@vm1 git_learning]# git status
# On branch master
# Changes to be committed:
#   (use "git reset HEAD <file>..." to unstage)
#
#       deleted:    b
#
# Untracked files:
#   (use "git add <file>..." to include in what will be committed)
#
#       b.md

```

##### 2. git的智能方法

```bash
[root@vm1 git_learning]# git reset --hard	//比较危险,暂存区和工作路径上的所有变更都会被清理掉
HEAD is now at 17cf1a5 rename a to a.md
[root@vm1 git_learning]# git status	
# On branch master
nothing to commit, working directory clean
// 智能的重命名方法
[root@vm1 git_learning]# git mv b b.md
[root@vm1 git_learning]# git status
# On branch master
# Changes to be committed:
#   (use "git reset HEAD <file>..." to unstage)
#
#       renamed:    b -> b.md
#
[root@vm1 git_learning]# git commit -m"rename b to b.md"
[master cf0bc02] rename b to b.md
 1 file changed, 0 insertions(+), 0 deletions(-)
 rename b => b.md (100%)
[root@vm1 git_learning]# git log	//查看git日志
commit cf0bc02df73256c924fdf17da482f01c483afe17
Author: WJL <wangjinlong@yeah.net>
Date:   Tue Dec 10 05:53:26 2019 +0800

    rename b to b.md

commit 17cf1a5388c6bfca9729dee4de8134022502f34f
Author: WJL <wangjinlong@yeah.net>
Date:   Tue Dec 10 05:39:21 2019 +0800

    rename a to a.md

commit 937068e5748d3af8a44d7becc4a7315220fc3ebd
Author: WJL <wangjinlong@yeah.net>
Date:   Fri Dec 6 11:21:59 2019 +0800

    add a b

commit 84afc80399122cb90b8d78943aa9516eea6ed0e1
Author: WJL <wangjinlong@yeah.net>
Date:   Thu Dec 5 07:57:49 2019 +0800

    add readme
```

#### git log查看版本历史

##### git log的参数

1. --oneline: 非常简洁的显示commit

   ```bash
   [root@vm1 git_learning]# git log --oneline
   cf0bc02 rename b to b.md
   17cf1a5 rename a to a.md
   937068e add a b
   84afc80 add readme
   ```

2. -n #: 显示最近的几个commit

   ```bash
   [root@vm1 git_learning]# git log -n 2
   commit cf0bc02df73256c924fdf17da482f01c483afe17
   Author: WJL <wangjinlong@yeah.net>
   Date:   Tue Dec 10 05:53:26 2019 +0800
   
       rename b to b.md
   
   commit 17cf1a5388c6bfca9729dee4de8134022502f34f
   Author: WJL <wangjinlong@yeah.net>
   Date:   Tue Dec 10 05:39:21 2019 +0800
   
       rename a to a.md
   //可以和--oneline组合起来用
   [root@vm1 git_learning]# git log -n2 --oneline
   cf0bc02 rename b to b.md
   17cf1a5 rename a to a.md
   ```

3. git checkout -b BRANCH_NAME COMMIT_NUM

   ```bash
   [root@vm1 git_learning]# git checkout -b temp 17cf1a5
   Switched to a new branch 'temp'
   [root@vm1 git_learning]# vi readme 
     1 Hello
     2 It's a readme.
     3 hello world	//添加一行
                                                                                   
   "readme" 3L, 33C written                                           
   [root@vm1 git_learning]# git commit
   # On branch temp
   # Changes not staged for commit:
   #   (use "git add <file>..." to update what will be committed)
   #   (use "git checkout -- <file>..." to discard changes in working directory)
   #
   #       modified:   readme
   #
   no changes added to commit (use "git add" and/or "git commit -a")
   [root@vm1 git_learning]# git commit -am"mod readme"
   [temp 2001f6f] mod readme
    1 file changed, 1 insertion(+)
   ```

   

4.  git branch -v: 可以查看本地的分支

   ```bash
   [root@vm1 git_learning]# git branch -v
     master cf0bc02 rename b to b.md
   * temp   2001f6f mod readme
   ```

5. git log --all:可以查看全部分支的commit信息

   ```bash
   [root@vm1 git_learning]# git log --all
   commit 2001f6fa547b0143294c34e1ffc3701c535fa23d
   Author: WJL <wangjinlong@yeah.net>
   Date:   Tue Dec 10 07:20:47 2019 +0800
   
       mod readme
   
   commit cf0bc02df73256c924fdf17da482f01c483afe17
   Author: WJL <wangjinlong@yeah.net>
   Date:   Tue Dec 10 05:53:26 2019 +0800
   
       rename b to b.md
   
   commit 17cf1a5388c6bfca9729dee4de8134022502f34f
   Author: WJL <wangjinlong@yeah.net>
   Date:   Tue Dec 10 05:39:21 2019 +0800
   
       rename a to a.md
   
   commit 937068e5748d3af8a44d7becc4a7315220fc3ebd
   Author: WJL <wangjinlong@yeah.net>
   Date:   Fri Dec 6 11:21:59 2019 +0800
   
       add a b
   
   commit 84afc80399122cb90b8d78943aa9516eea6ed0e1
   Author: WJL <wangjinlong@yeah.net>
   Date:   Thu Dec 5 07:57:49 2019 +0800
   ```

6. git log --all --graph:图形化显示

   ```bash
   
   [root@vm1 git_learning]# git log --all --graph
   * commit 2001f6fa547b0143294c34e1ffc3701c535fa23d
   | Author: WJL <wangjinlong@yeah.net>
   | Date:   Tue Dec 10 07:20:47 2019 +0800
   | 
   |     mod readme
   |    
   | * commit cf0bc02df73256c924fdf17da482f01c483afe17
   |/  Author: WJL <wangjinlong@yeah.net>
   |   Date:   Tue Dec 10 05:53:26 2019 +0800
   |   
   |       rename b to b.md
   |  
   * commit 17cf1a5388c6bfca9729dee4de8134022502f34f
   | Author: WJL <wangjinlong@yeah.net>
   | Date:   Tue Dec 10 05:39:21 2019 +0800
   | 
   |     rename a to a.md
   |  
   * commit 937068e5748d3af8a44d7becc4a7315220fc3ebd
   | Author: WJL <wangjinlong@yeah.net>
   | Date:   Fri Dec 6 11:21:59 2019 +0800
   | 
   |     add a b
   |  
   * commit 84afc80399122cb90b8d78943aa9516eea6ed0e1
     Author: WJL <wangjinlong@yeah.net>
     Date:   Thu Dec 5 07:57:49 2019 +0800
   ```

#### 五) gitk图形界面工具查看版本历史

##### 在支持git图形化界面的操作系统中直接输入`gitk`命令即可

##### gitk 界面中的view可能点不了.此时只要ALT+TAB切换一下界面,然后再切回来就可以点击了

#### 六) git目录

1. 查看.git目录结构

   ```bash
   [root@vm1 .git]# ls -al
   total 24
   drwxr-xr-x.  8 root root 183 Dec 10 07:20 .
   drwxr-xr-x.  3 root root  53 Dec 10 07:20 ..
   drwxr-xr-x.  2 root root   6 Dec  5 07:51 branches
   -rw-r--r--.  1 root root  11 Dec 10 07:20 COMMIT_EDITMSG
   -rw-r--r--.  1 root root 141 Dec  5 07:54 config
   -rw-r--r--.  1 root root  73 Dec  5 07:51 description
   -rw-r--r--.  1 root root  21 Dec 10 07:19 HEAD
   drwxr-xr-x.  2 root root 242 Dec  5 07:51 hooks
   -rw-r--r--.  1 root root 273 Dec 10 07:20 index
   drwxr-xr-x.  2 root root  21 Dec  5 07:51 info
   drwxr-xr-x.  3 root root  30 Dec  5 07:57 logs
   drwxr-xr-x. 19 root root 180 Dec 10 07:20 objects
   -rw-r--r--.  1 root root  41 Dec 10 05:47 ORIG_HEAD
   drwxr-xr-x.  4 root root  31 Dec  5 07:51 refs
   ```

2. 切换分支`git checkout BRANCH_NAME`

   ```bash
   [root@vm1 git_learning]# git checkout master
   Switched to branch 'master'
   ```

3. .git/HEAD:查看当前使用的分支

   ```BASH
   [root@vm1 git_learning]# cat .git/HEAD 
   ref: refs/heads/master
   ```

4. .git/config文件:git的配置信息,可以vi直接修改

5. .git/refs目录:包含了heads(分支)和tags(标签,或者里程碑)

   ```bash
   [root@vm1 git_learning]# cat .git/refs/
   heads/ tags/  
   [root@vm1 git_learning]# cat .git/refs/heads/master 
   cf0bc02df73256c924fdf17da482f01c483afe17
   [root@vm1 git_learning]# git cat-file -t cf0bc02df	//可以查看文件的类型
   commit
   ```

6. .git/objects目录:

   ```bash
   [root@vm1 objects]# cd 15	//随意进入一个目录
   [root@vm1 15]# ls
   ed564cc2193ee98aacd82b0215d2dea98a103a
   [root@vm1 15]# git cat-file -t 15ed564cc2193ee98aacd82b0215d2dea98a103a	//目录名+文件名是一个tree文件
   tree
   [root@vm1 15]# git cat-file -p 15ed564cc2193ee98aacd82b0215d2dea98a103a
   100644 blob ea1e4de265641a5d0709d1306b85be8f231b429c    a
   100644 blob 73ca374fefc5f767bd2419c07a3106134aad05f8    b
   100644 blob 4f51b6b6666613744d6a5a20913516a1b5006f28    readme
   [root@vm1 15]# git cat-file -p 4f51b6b6666613744d6a5a20913516a1b5006f28
   Hello
   It's a readme.
   ```

#### 七) commit、tree、blob三个对象之间的关系 

##### 一个commit对应一个tree,一个tree里还可以包含一个或多个tree

##### 分离头指针"detached head" state 指的是变更没有基于某个branch去做,所以当check out到某个分支的时候, 分离头指针状态下作的变更就会被git当做垃圾清理掉;如果这些变更很重要一定要通过 git branch <new-branch-name> 分离头指针的key

#### 八) 进一步了解head和branch的
