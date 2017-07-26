# SQL基础教程

## 第一章 数据库和SQL

### 1-1 数据库的定义

**DBMS: Database Management System 数据库管理系统**
**DBMS的种类**

1. 层次行数据库(Hierarchical Database,HDB)
   __最古老的数据库之一,它把数据通过层次结构(木结构)的方式表现出来.层次型数据库曾经是数据库的主流,现在已经很少使用了__
2. 关系型数据库(Relational Database,RDB)
   __也称关系数据库,是现在应用最广泛的数据库.关系型数据库1969年诞生,可谓历史悠久.和Excel工作表一样,也采用行列二维表结构来管理数据.同时还使用专门的SQL(Structured Query Language,结构优化查询语言)语言对数据进行操作__
    
 	案例:
 	   
    品编号|商品名称|商品分类|销售单价|进货单价|登记日期
    ---|---|---|---|---|---
    0001|T恤衫|衣服|1000|500|2009-09-20
    0002|打孔器|办公用品|500|320|2009-09-11
    0003|运动T恤|衣服|4000|2800|&nbsp;
    0004|菜刀|厨房用具|3000|2800|2009-09-20
    0005|高压锅|厨房用具|6800|5000|2009-01-15
    0006|叉子|厨房用具|500|&nbsp;|2009-09-20
    0007|擦菜板|厨房用具|880|790|2009-04-28
    0008|圆珠笔|办公用品|100|&nbsp;|2009-11-11
	
 	这种类型的DBMS称为关系数据库管理系统(Relational Database Management System,RDBMS).比较具有代表性的DBMS有如下几种

  	+ Oracle Database: 甲骨文的RDBMS
  	+ SQL Server: 微软公司
  	+ DB2: IBM公司 
  	+ Postgresql: 开源
  	+ MySQL: 开源
3. 面向对象数据库(Object Oriented Database,OODB)

   __编程语言当中有一种被称为面向对象的语言(主要是Java和C++).该类数据库把数据以及对数据的操作集合起来以对象为单位进行管理,因此得名.面向对象数据库就是用来保存这些对象的数据库__
4. XML数据库(XML Database,XMLDB)

   __最近几年,XML作为网络上进行数据交互传输的形式逐渐普及起来,XML数据库可以对XML形式的大量数据进行告诉处理__
5. 键值存储系统(Key-Value Store,KVS)

   __这是一种单纯用来保存查询所使用的主键(Key)和值(Value)的组合的数据库.具有编程语言经验的读者可以把它想象成关联数组或者是散列(Hash).近年来,随着键值存储系统被应用到Google等需要大量数据进行超高速查询的Web服务当中,它正逐渐为人们关注__

### 1-2 数据库的结构

#### 使用RDBMS时,最常见的系统结构就是 客户端/服务器(C/S类型)

#### 根据SQL语句的内容返回的数据,同样必须是二维表的形式,这也是关系数据库的特征之一.执行结果如果不是二维表的SQL语句则无法执行.
##### 表的列(垂直的方向)称为字段,它代表了保存在表中的数据项目;与之相对表的行(水平方向)称为记录,它相当于一条数据;关系数据库必须以行为单位进行数据读写.

   - 法则1-1: 关系数据表以行为单位读写数据
   - 法则1-2: 一个单元格只能输入一个数据

### 1-3 SQL概要

#### 标准SQL

   __标准SQL就是国际标准化组织(ISO)为SQL制定了相应的标准,以此为基准的SQL称为标准SQL__

   - 法则1-3:学会标准的SQL就可以在各种RDBMS中书写SQL语句了.

#### SQL语句及其种类
   __SQL用关键字、表名、列名等组合而成的一条语句(SQL语句)来描述操作的内容.关键字是指那些含义或使用方法事先已定义好的英语单词,例如"对表进行查询"或者"参考这个表"等包含各种意义的关键字,根据对RDBMS赋予的指令种类不同,SQL语句可以氛围以下三类:__
    
   - DDL(Data Definition Language,数据定义语言)用来穿件或者删除存储数据用的数据库以及数据库中的表等对象.DDL包含以下几种指令.
    * CREATE: 创建数据库和表等对象
    * DROP: 删除数据库和表等对象
    * ALTER: 修改数据库和表等对象的结构
   
   - DML(Data Manipulation Language,数据操作语言)用来查询或者变更表中的记录.DML包含一下几种指令:
    * SELECT: 查询表中的数据
    * INSERT: 向表中插入新数据
    * UPDATE: 变更表中的数据
    * DELETE: 删除表中的数据

   - DCL(Data Control Language,数据控制语言) 用来确认或者取消对数据库中的数据进行变更.除此之外,还可以对RDBMS的用户是否有权限操作数据库中的对象(数据库表等)进行设定.DCL包含以下几种指令:
    + COMMIT: 确认数据库中的数据进行的变更
    + ROLLBACK: 取消对数据库中的数据进行的变更
    + GRANT: 赋予用户操作权限
    + REVOKE: 取消用户权

**_实际使用中90%的SQL语句都属于DML_**

   - 法则1-4: SQL 根据功能不同可以分为三类,其中使用最多的是DML.

#### SQL的基本书写规则
1. **SQL语句要以分号(;) 结尾** 
    - 法则1-5: SQL语句要以分号(;) 结尾
2. **SQL语句不区分大小写**
    - 法则1-6: 关键字不区分大小写
 __建议使用以下规则来书写SQL语句__
     + 关键字大写
     + 表名的首字母大写
     + 其余(列名等)小写
3. __常数的书写格式是固定的__
   SQL语句常常需要直接书写字符串,日期或者数字,这些称为常数在输入字符串和日期的时候需要用单引号括起来,而数字则直接输入
   字串如'abc';日期如'10 Jan 2010';'2010-01-26'等
    - 法则1-7: 字串和日期常数需要用单引号(')括起来,数字常数则无需加注单引号,直接书写数字即可.
4. __单词需要用半角空格或者换行符来分隔__
   - 法则1-8: SQL语句的单词之间需要使用半角空格或者换行符来进行分隔

### 1-4 表的创建

#### 数据库的创建
 ```
	命令格式:
		CREATE DATABASE <DatabaseName>;
	案例:
		CREATE DATABASE shop;
 ```
#### 表的创建

 ```
	命令格式:
		CREATE TABLE <TableName>
		(<列名1> <数据类型> <该列所需约束>,
		<列名2> <数据类型> <该列所需约束>,
		<列名3> <数据类型> <该列所需约束>,
		<列名4> <数据类型> <该列所需约束>,
					.
					.
					.
		<该表的约束1>,<该表的约束2>
		);
	案例:
		CREATE TABLE Shohin			//创建表Shohin
		(shohin_id	CHAR(4)		NOT NULL,	
		shohin_mei	VARCHAR(100)		NOT NULL,
		shohin_bunrui	VARCHAR(100)		NOT NULL,
		hanbai_tanka	INTEGER		,
		shiire_tanka	INTEGER		,
		torokubi		DATE		,
		PRIMARY KEY (shohin_id)
		);
 ```

#### 命名规则
   __我们只能用半角英文字母,数字,下划线作为数据库,表,和列的名称;而且以特殊符号开头的名称并不多见;标准SQL的规则是半角字母开头__
   - 法则1-9: 数据库名称,表名,列名等可以使用三种字符: ①半角英文字母 ②半角数字 ③下划线(_)
   - 法则1-10: 名称必须以半角英文字母作为开头
   - 法则1-11: 在同一个数据库中不能创建两个相同名称的表,在同一张表里,也不能创建两个相同名称的列.

#### 数据类型的指定
   __数据类型表示数据的种类,包括数字型、字符型、和日期型等.每一列都不能存储与该类型不符的数据,我们暂时先使用四种基本的数据类型__
   - INTEGER 整数型: 用来指定存储整数的列的数据类型,不能存储小数
   - CHAR 字符型: 用来指定存储字符串类型的数据类型.可以像CHAR(10)或者CHAR(200)这样在括号中指定该列可以存储的字符串长度(最大长度),字符串以_定长字符串_的形式存储在被指定为CHAR型的列中.当列中存储的字符串长度达不到最打长度时,使用半角空格进行补足. 如我们向CHAR(8)的列中输入'abc'的时候,会以'abc　　　　　'的形式保存
   - VARCHR 可变长字符串型: 同CHAR一样,VARCHAR型也是用来指定存储字符串的列的数据类型(字符串型).也可以通过括号内的数字来指定字符串的长度(最大长度).但是该类型的列是_可变长字符串_的形式来保存字符串的._定长字符串_在字符数未达到最大长度时会用半角空格不足,_可变长字符串_不同,即使字符数未达到最大长度,也不会用半角空格补足.
   - DATE 日期类型:用来存储日期(年-月-日)的列的数据类型

#### 约束的设置
   约束是除了数据类型之外,对列中存储的数据进行限制和追加条件的功能.上例中Shohin表中设置了shohin\_id列、shohin\_mei列还有shohin\_bunrui列的NOT NULL
   数据类型的右侧设定了NOT NULL的约束.NULL代表空白(无记录)的关键字,在NULL 前加了NOT,就是给该列设定了不能输入空白,也就是必须输入的约束(如果什么都不输入就会报错)
   另外,在创建Shohin表的CREATE TABLE 语句后面还有下面这样的记述,其作用是给shohin\_id列设定主键约束的.*
	`PRIMARY KEY(shohin_id)`
   所谓主键,是指定特定数据时使用的列的组合.键值种类多样,主键(PRIMARY KEY)就是可以__特定一行数据__(唯一可以确定一行的数据,比如ID列)的列,也就是说,如果把Shohin_id的列指定为主键,就可以通过该列取出特定的商品数据了.
   反之,如果向shohin_id列中输入了重复数据,就无法取出唯一的特定数据了(因为无法确定唯一的一行数据).

### 1-5 表的删除和更新
#### 表的删除
```
命令格式:
DROP TABLE <表名>;
案例:
DROP TABLE Shohin;
```

- 法则1-12: 删除了的表是无法恢复的;在执行DROP TABLE前请务必仔细确认.

#### 表定义的更新
__有时好不容易把表创建出来之后发现少了几列,其实这时无需把表删了重新创建,只需使用变更表定义的`ALTER TABLE`语句就可以了.__
```
命令格式:
ALTER TABLE <表名> ADD COLUMN <列的定义>;
案例:我们可以在Shohin表中添加这样一列,shohin_mei_kana,该列可存储100位可变长的字符串.
ALTER TABLE shohin ADD COLUMN shohin_mei_kana VARCHAR(100);
```
__反之,我们也可以删除表中的某一列__
```
命令格式:
ALTER TABLE <表名> DROP COLUMN <列名>;
案例: 删除Shohin表中的shohin_mei_kana列
ALTER TABLE Shohin DROP COLUMN shohin_mei_kana;
```
- 法则1-13: 表定义变更之后无法恢复,再执行ALTER TABLE语句前请务必仔细确认.

#### 向Shohin表中插入数据
```
案例:
--DML:插入语句

BEGIN TRANSACTION;
INSERT INTO Shohin VALUES ('0001', 'T恤衫', '衣服', 1000, 500, '2009-09-20');
INSERT INTO Shohin VALUES ('0002', '打孔器', '办公用品', 500, 320, '2009-09-11');
INSERT INTO Shohin VALUES ('0003', '运动T恤', '衣服', 4000, 2800, NULL);
INSERT INTO Shohin VALUES ('0004', '菜刀', '厨房用具', 3000, 2800, '2009-09-20');
INSERT INTO Shohin VALUES ('0005', '高压锅', '厨房用具', 6800, 5000, '2009-01-15');
INSERT INTO Shohin VALUES ('0006', '叉子', '厨房用具', 500, NULL '2009-09-20');
INSERT INTO Shohin VALUES ('0007', '擦菜板', '厨房用具', 880, 790, '2008-04-28');
INSERT INTO Shohin VALUES ('0008', '圆珠笔', '办公用品', 100, NULL, '2009-11-11');

COMMIT
```

__使用插入行的指令语句INSERT,就可以把数据都插入到表中了,开头的BEGIN TRANSCTION语句是开始插入行的指令语句,结尾的COMMIT语句是确定插入行的指令语句,这些语句将在后面详细介绍.__
___注意像上面这样多行语句的要选中他们之后执行才会主句执行!___

#### 表的修改(重命名)

__假如我们在创建表的时候,不小心输错了表名,而后又录入了数据,如果我们删除表再重新建表,重新录数据,太麻烦,这时候我们就可以用RENAME来修改表名__

```
POSTGRESQL 特有的重命名命令
命令格式:
ALTER TABLE <TableName> RENAME TO <NewTableName>;
案例:
ALTER TABLE Shohin RENAME TO Shaolin; //把表Shohin重命名为Shaolin.

MYSQL重命名表的命令:
RENAME TABLE Shohin TO Shaolin;
```

## 第二章 查询基础

### 2-1 SELECT语句基础

#### 列的查询
 从表中选取数据时需要使用SELECT语句,也就是只从表中选出(SELECT)必要数据的意思.通过SELECT语句查询并选取出必要数据的过程称为**匹配查询**或 **查询**;

```
命令格式:
SELECT <列名>,...
FROM <表名>;
案例: 从Shohin表中查询出Shohin\_id列,Shohin\_mei列,和shiire_tanka列
SELECT shohin_id,shohin_mei,shiire_tanka
FROM Shohin;
```
   显示结果如下
  Shohin\_id|Shohin\_mei|shiire_tanka   
  ---|---|---
  0001|	T恤|	500
  0002|	打孔器	|320
  0003|	运动T恤	|2800
  0004|	菜刀	|2800
  0005|	高压锅	|5000
  0006|	叉子	|&nbsp;
  0007|	擦菜板	|790
  0008|	圆珠笔	|&nbsp;
从上面案例可以看出SELECT语句包含了SELECT 和FROM 两个字句.字句是SQL语句的组成要素,是以SELECT或者FROM等作为其实短语.
SELECT字句中列举了希望从表中查询初级的列的名称,而FROM子句则指定了选取出数据的表的名称	
SELECT语句的第一行的SELECT shohin\_id,shohin\_mei,shiire_tanka就是SELECT子句,查询出的顺序可以任意指定,查询多列时,需要用逗号进行分隔排列.**查询结果中列的顺序和SELECT子句中的顺序相同**

#### 查询出表中所有的列
想要查询出全部列时,可以使用代表所有列的__星号(*)__

```
命令格式
SELECT *
FROM <表名>;

案例:
SELECT *
FROM Shohin;

其查询结果等同于
SELECT shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi
FROM Shohin;
```
+ 法则2-1 星号(*)代表全部列的意思

_如果使用星号的话,就无法设定列的显示顺序了.这是就会按照CREATE TABLE语句定义对列进行排序._
___特别注意,如果在连字句中间随意插入空行,会造成执行错误,请特别注意___

#### 为列设定别名
SQL语句可以使用___AS关键字___为列设定别名;作用是在查询结果中用别名来代替原来的列名
```
命令格式:
SELECT <id1> AS <alias1>,
	   <id2> As <alias2>,
	   ...
	   <id3> As <alias3>
FROM Shohin;

案例:
SELECT shohin_id AS id,
	shohin_mei AS namae,
		...
	shiire_tanka AS tanka
FROM Shohin;

```
别名可以使用汉语,使用汉语时,需要用***双引号***括起来,请注意一定要用双引号,不可以用~~单引号~~.
```
SELECT shohin_id AS "商品编号",
shohin_mei AS "商品名称",
shiire_tanka AS "进货单价"
FROM shohin;

```
+ 法则2-2 设定汉语别名时,需要用双引号(" ")括起来

#### 常数的查询
SELECT子句不仅可以书写别名,还可以书写常数.
```
案例代码:
SELECT '商品' AS mojiretsu,
 38 AS kazu,
 '2009-02-24' AS hizuke,
 shohin_id,shohin_mei
FROM shohin;
```
___在SQL语句中使用字符串或者日期常数时,必须使用单引号将其括起来___

#### 从结果中删除重复行
想要删除重复行时,可以通过在SELECT子句中使用___DISTINCT(去重)___来实现
```
代码如下:
SELECT DISTINCT shohin_bunrui
FROM shohin;
```
* 法则2-3: 在SELECT语句中使用DISTINCT可以删除重复行(也就是去重)
在使用DISTINCT时,NULL也被视为一类数据,存在多条NULL数据行时,也会结合为一条NULL数据.
同时 DISTINC也可以用在多列之前使用,多列之间用逗号隔开,而且DISTINCT只能放在第一个列名前面.
多列去重时,只会去除所有列都重复的行.
比如
```
SELECT DISTINCT shohin_bunrui, torokubi
FROM shohin;
```

#### 根据WHERE语句来选择记录
前面的例子都是将表中存储的数据全都取出来,但实际上并不是每次都需要选取出全部数据,大部分情况都是要选取出满足"商品种类为衣服"、"销售单价在1000元以上"等某些条件的数据.
SELECT语句通过WHERE子句来指定查询数据的条件.在___WHERE子句___中可以指定条件.执行含有这些条件的SELECT语句,就可以查询出符合该条件的记录了.
```
语法格式:
SELECT <列名>,...
 FROM <表名>
 WHERE <条件表达式>;

案列:选取商品种类为"衣服"的记录
 SELECT shohin_mei, shohin_bunrui
 FROM Shohin
 WHERE shohin_bunrui = '衣服'
```
WHERE子句中的shohin\_bunrui = '衣服' 就是用来反映查询条件的表达式(条件表达式).等号是比较两边内容是否相等的符号,上述条件就是将shohin\_bunrui列的值和'衣服'进行比较,判断是否相等.shohin表的所有记录都会进行比较;
接下来会从查询的记录中选取出SELECT语句指定的shohin\_mei和shohin\_bunrui列,如执行结果所示.也就是***首先通过WHERE字句查询出符合指定条件的记录,然后再选取出SELECT语句指定的列(也就是先选行,再选列)***.
上述的案例中,为了确认选取出的数据是否正确,通过SELECT子句把作为查询条件的shohin\_bunrui列也选取出来了,其实这并不是必须的.如果只想知道商品名称的话,可以向下面这样写:
```
SELECT shohin_mei
FROM Shohin
WHERE shohin_bunrui = '衣服';

显示结果如下:
  shohin_mei
--------------
	T恤衫
运动T恤
```

***SQL中子句的顺序是固定的,不能随便更改***. WHERE子句必须紧跟在FROM子句之后.书写顺序发生改变的话,会造成执行错误.

- 法则2-4 WHERE子句要紧跟在FROM子句之后.

#### 注释的书写方法

  * 1行注释: 在语句前面输入"--",必须和语句写在同一行
  * 多行注释: 语句书写在"/*" 和"*/" 之间,可以跨多行

- 法则2-5: 注释是SQL语句用来标识说明或者注意是想的部分.分为一行注释和多行注释.

### 2-2 算数运算符和比较运算符

#### 算术运算符
SQL语句中可以使用计算表达式.

```
案例:要求把shohin表中商品的单价(hanbai_tanka)的两倍以hanbai_tanka×2列的形式读取出来

代码:
SELECT shohin_mei,hanbai_tanka,hanbai_tanka * 2 AS "hanbai_tanka×2"
FROM Shohin;
```
__SQL语句中可以使用的四则运算的主要运算符__

含义|运算符
---|---
加法运算|+
减法运算|-
乘法运算|*
除法运算|/

- 法则2-6: SELECT子句中可以使用常数或者表达式

当然,SQL中也可以像平常的运算表达式那样使用括号.括号中运算表达式的优先级会得到提升,优先进行运算.

#### 需要注意NULL
SQL语句中进行运算时,需要特别注意含有NULL的运算.比如下面几个运算表达式:
- 5 + NULL
- 10 - NULL
- 1 * NULL
- 4 / NULL
- NULL / 9
- NULL / 0

正确答案全部都是***NULL***,***实际上所有包含NULL的计算,结果肯定是NULL***.

#### 拓展:FROM子句真的需要吗?
实际上FROM子句在SELECTL语句中并不是必不可少的,只是用SELECT子句进行计算也是可以的.
```
SELECT (100 + 200) *3 AS keisan;

执行结果:
 keisan
--------
    900 
```
实际上,通过执行SELECT语句来代替计算器的情况基本上是不存在的,不过极少数情况下,还是可以通过使用没有FROM子具有的SELECT 来实现某种业务的.例如,希望得到的内容为空,只包含一行临时数据的情况.

#### 比较运算符

在之前我们使用符号 = 从Shohin表中选取出了商品种类"shohin\_bunrui"为字符串'衣服'的记录.下面我们再使用符号 = 选取销售单价(hanbai\_tanka)为500元的记录

```
代码:
SELECT shohin_mei,shohin_bunrui
FROM Shohin
WHERE hanbai_tanka = 500;
```
执行结果:

shohin\_mei|shohin\_bunrui 
---|---
打孔器|办公用品
叉子|厨房用品

接下来,我们使用"不等于"这样的代表否定含义的比较运算符 "<>",选取出hanbai_tanka列的值不为500的记录.
```
代码:
SELECT shohin_mei,shohin_bunrui
FROM Shohin
WHERE hanbai_tanka <> 500;
```
执行结果

shohin\_mei|shohin\_bunrui 
---|---
T恤|	衣服
运动T恤|	衣服
菜刀|	厨房用具
高压锅|	厨房用具
擦菜板|	厨房用具
圆珠笔|	办公用品

SQL中主要的比较运算符如下表所示,除了等于和不等于之外,还有进行大小比较的运算符.

运算符|含义
---|---
=|和~相等
<>|和~不相等
\>=|大于等于~
\>|大于~
<=|小于等于~
<|小于~

这些比较运算符可以对字符、数字、和日期等几乎所有数据类型的列个值进行比较。
例如，从Shohin表中选取出销售单价(hanbai_tanka)大于等于1000元的记录
```
代码:
SELECT shohin_mei,shohin_bunrui,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka >= 1000;
```

执行结果:

shohin\_mei|shohin\_bunrui|hanbai\_tanka
---|---|---
T恤|	衣服|1000
运动T恤|	衣服|4000
菜刀|	厨房用具|3000
高压锅|	厨房用具|6000

再比如,选取除登记日期(torokubi)在2009年9月27日之前的记录.
```
SELECT shohin_mei,shohin_bunrui,torokubi
FROM shohin
WHERE torokubi < '2009-09-27';
```
执行结果:

shohin\_mei|shohin\_bunrui|torokubi
---|---|---
T恤|	衣服|	2009-09-20
打孔器|	办公用品|	2009-09-11
菜刀|	厨房用具|	2009-09-20
高压锅|	厨房用具|	2009-01-15
叉子|	厨房用具|	2009-09-20
擦菜板|	厨房用具|	2008-04-28

- 法则2-7:使用比较运算符时一定要注意不等号和等号的位置,一定要让不等号在左,等号在右.

除此之外,还可以使用比较运算符对计算结果进行比较.
案例,我们现在需要统计出销售利润超过500的记录(也就是 hanbai\_tanka - shiire\_tanka的值)

```
代码:

SELECT Shohin_mei,Shohin_bunrui,hanbai_tanka,shiire_tanka
FROM Shohin
WHERE hanbai_tanka - shiire_tanka >= 500;
```
执行结果如下:

shohin\_mei|hanbai\_tanka|shiire_tanka
---|---|---
T恤|	1000|	500
运动T恤|	4000|	2800
高压锅|	6800|	5000

#### 对字符串使用不等号时的注意事项
对字符串使用大于等于或者小于等于不等号时会得到什么样的结果呢?我们创建一个Chars表来做测试
```
代码:
CREATE TABLE Chars(chr CHAR(3) NOT NULL,
PRIMARY KEY (chr));		//创建chars表

BEGIN TRANSACTION;		//向Chars表里插入数据

INSERT INTO Chars VALUES('1');
INSERT INTO Chars VALUES('2');
INSERT INTO Chars VALUES('3');
INSERT INTO Chars VALUES('10');
INSERT INTO Chars VALUES('11');
INSERT INTO Chars VALUES('22');

COMMIT;
```
执行结果:

|chr(字符串类型)|
|---|
|1|
|2|
|3|
|10|
|11|
|22|

此时如果我们执行Chars表中查询条件是chr列大于'2',会是什么样的结果呢?

```
SELECT chr
FROM Chars
WHERE chr > '2';
```
执行结果:

|chr|
|---|
|3|  
|222| 

这里的原因是WHERE子句里 chr > '2'; 这里比较的是字符串,___必须弄清楚 2和 '2'的区别___
之所以 会出现,'3' 和'222'比2大的原理是字典排序原理.就像书的章节, 1-1 排在1后面.这个必须弄清楚.

- 法则2-8: 字符串类型的数据原则上按照字典顺序进行排序.不能与数字的大小混淆.

#### 不能对 NULL使用比较运算符

对比较运算符来说还有一点十分重要.那就是,作为查询条件的列中含有NULL的情况. 例如,我们把进货单价(Shiire_tanka)作为查询条件.请注意,商品'叉子'和'圆珠笔'的进货单价是NULL.

我们先来选取进货单价为2800元(Shiire_tanka = 2800)的记录.

```
代码:
SELECT shohin_mei,shohin_bunrui,shiire_tanka
FROM shohin
WHERE shiire_tanka = 2800;
```

执行结果如下:

shohin\_mei| shohin\_bunrui| shiire_tanka
---|---|---
运动T恤|	衣服| 2800
菜刀|	厨房用具| 2800

然后我们再选取进货单价不是2800元(shiire_tanka <> 2800)的记录

```
SELECT shohin_mei,shohin_bunrui,shiire_tanka
FROM Shohin
WHERE shiire_tanka <> 2800;
```

执行结果如下

shohin\_mei|shohin\_bunrui|shiire_tanka
---|---|---
T恤|	衣服|	500
打孔器|	办公用品|	320
高压锅|	厨房用具|	5000
擦菜板|	厨房用具|	790


我们发现上两条查询记录的结果中都没有"叉子"和"圆珠笔",这两条记录由于进货单价不明,无法判定为是不是2800元.

于是我们尝试了第三个方法:~~注意这个方法的语句为错误语句~~
```
代码:
SELECT shohin_mei,shohin_bunrui,shiire_tanka
FROM Shohin
WHERE shiire_tanka = NULL;
```

执行结果为一条记录也没有:

shohin\_mei | shohin\_bunrui
---|---

即使使用<>运算符也还是无法选取出NULL的记录.因此SQL提供了专门来判断是否为NULL 的运算符 IS NULL.想要选取NULL的记录时,可以用下面的代码:
```
SELECT shohin_mei,shohin_bunrui,shiire_tanka
FROM Shohin
WHERE shiire_tanka IS NULL;
```
执行结果如下:

shohin\_mei|shohin\_bunrui|shiire_tanka
---|---|---
叉子|	厨房用具| NULL	
圆珠笔|	办公用品| NULL	

反之,希望选取不是NULL记录时,需要使用___IS NOT NULL___运算符:
```
SELECT shohin_mei,shohin_bunrui,shiire_tanka
FROM shohin
WHERE shiire_tanka IS NOT NULL;
```
执行结果如下:

shohin\_mei|shohin\_bunrui|shiire_tanka
---|---|---
T恤|	衣服|	500
打孔器|	办公用品|	320
运动T恤|	衣服|	2800
菜刀|	厨房用具|	2800
高压锅|	厨房用具|	5000
擦菜板|	厨房用具|	790

- 法则2-9: 希望选取NULL记录时,需要在条件表达式中使用IS NULL运算符.希望选取不是NULL的记录时,需要在条件表达式中使用IS NOT NULL运算符.

### 2-3逻辑运算符

#### NOT运算符

在前面我们了解了想要指定"不是~"这样的否定条件时,要用<>运算符.除此之外还存在另一个表示否定,并且使用范围更广的运算符NOT.

NOT不能单独使用必须和其他查询条件组合起来使用.例如选取出销售单价(Hanbai_tanka)大于等于1000元记录的SELECT语句:
```
SELECT shohin_mei,shohin_bunrui,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka >=1000;
```
执行结果如下:

shohin\_mei|shohin\_bunrui|hanbai\_tanka
---|---|---
T恤|	衣服|	1000
运动T恤|	衣服|	4000
菜刀|	厨房用具|	3000
高压锅|	厨房用具|	6800

向上面的SELECT语句的查询条件中添加NOT运算符之后:
```
SELECT shohin_mei,shohin_bunrui,hanbai_tanka
FROM Shohin
WHERE NOT haiban_tanka >=1000
```

执行结果如下:

shohin\_mei|shohin\_bunrui|hanbai\_tanka
---|---|---
打孔器|	办公用品|	500
叉子|	厨房用具|	500
擦菜板|	厨房用具|	880
圆珠笔|	办公用品|	100

我们发现这条语句的结果等同于
```
SELECT shohin_mei,shohin_bunrui,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka < 1000;
```

通过上面的例子,我们发现不使用NOT运算符,我们也可以编写出效果相同的查询条件.不仅如此,不使用NOT运算符的查询条件更容易让人理解.
尽管如此,我们也不能完全否定NOT运算符的作用.在便携复杂的SQL语句时,经常会看到NOT的身影. 但是我们不要滥用NOT运算符

- 法则2-10 NOT运算符用来否定某一条件,但是不能滥用.

#### AND 运算符和 OR运算符
在WHERE子句中使用AND运算符或者OR运算符,可以对多个查询条件进行组合.
AND运算符___在其两侧的查询条件都成立时,整个查询条件才成立___.其意思相当于"并且".
OR运算符___在其两侧的查询条件有一个成立,整个查询条件就成立___.其意思相当于"或者";当然 两个条件都成立时,整个查询条件也成立.

案例1:从Shohin表中选取出"商品分类是厨房用具(shohin\_bunrui = '厨房用具'),并且销售单价大于等于3000元(hanbai\_tanka >= 3000) 的商品"的查询条件
```
代码:
SELECT  shohin_mei,shohin_bunrui,hanbai_tanka
FROM Shohin
WHERE shohin_bunrui = '厨房用具'
AND hanbai_tanka >= 3000;
```

执行结果如下:

shohin\_mei|shohin\_bunrui|hanbai\_tanka
---|---|---
菜刀|	厨房用具|	3000
高压锅|	厨房用具|	6800

案例2:选取出"商品种类为厨房用具(shohin\_bunrui = '厨房用具'),或者销售单价大于等于3000元(hanbai\_tanka >= 3000)的商品":
```
SELECT shohin_mei,shohine_bunrui,hanbai_tanka
FROM shohin
WHERE shohin_bunrui = '厨房用具'
OR hanbai_tanka >= 3000;
```
执行结果如下:

shohin\_mei|shohin\_bunrui|hanbai\_tanka
---|---|---
运动T恤|	衣服|	4000
菜刀|	厨房用具|	3000
高压锅|	厨房用具|	6800
叉子|	厨房用具|	500
擦菜板|	厨房用具|	880

- 法则2-11: 多个查询条件进行组合时,使用AND运算符或者OR运算符

#### 通过括号进行强化

假如我们需要的查询条件是下面这样的:

"商品种类是办公用品"
"登记日期是2009年9月11日或者2009年9月20日"

满足上面条件的商品只有"打孔器",我们把这些条件原封不动的写入表达式
```
SELECT shohin_mei,shohin_bunrui,torokubi
FROM Shohin
WHERE shohin_bunrui = '办公用品'
AND torokubi = '2009-09-11'
OR torokubi = '2009-09-20';
```
执行结果如下:

shohin\_mei|shohin\_bunrui|torokubi
---|---|---
T恤|	衣服|	2009-09-20
打孔器|	办公用品|	2009-09-11
菜刀|	厨房用具|	2009-09-20
叉子|	厨房用具|	2009-09-20

按找我们想要的匹配条件,按道理应该出的结果是打孔器,但实际结果却不一样.
原因是___AND比OR的优先级高___,上面代码的条件表达式实际上会被解释为
```
[ shohin_bunrui = '办公用品' AND torokubi = '2009-09-11']
OR [torokubi = '2009-09-20']

也就是

"商品种类是办公用品,并且登记日期是2009年9月11日" 或者"登记日期是2009年9月20日"
```

那么,想要优先执行OR运算时,我们可以使用半角括号把OR运算符及两侧的查询条件括起来:
```
SELECT shohin_mei,shohin_bunrui,torokubi
FROM Shohin
WHERE shohin_bunrui = '办公用品'
AND (torokubi = '2009-09-11'
OR torokubi = '2009-09-20');
```
执行结果则只显示打孔器了.

- 法则2-12 AND的运算优先级高于OR运算符.想要有限运行OR运算时可以使用括号.

#### 逻辑运算符和真值

AND 逻辑积

P|Q|积|P AND Q
---|---|---|---
1|1|1×1|1
1|0|1×0|0
0|1|0×1|0
0|0|0×0|0

OR 逻辑和

P|Q|和|P OR Q
---|---|---|---
1|1|1+1|1
1|0|1+0|1
0|1|0+1|1
0|0|0+0|0

NOT
P| 翻转| NOT P
---|---|---
1|1→0|0
0|0→1|1

既不是真,也不是假,结果到底是什么呢?其实这是SQL中特有的情况,这时真值是除真假之外的第三种值:___不确定(UNKNOWN)___.一般逻辑运算并不存在这第三种值.SQL之外的语言也基本上只有真假这两种真值,与通常的逻辑运算被称为二值逻辑相对,只有SQL中的逻辑运算被称为___三值逻辑___.
下面是三值逻辑中的AND 和OR的真值表

AND (___其实可以理解为,结果按照坏的那个取___)

P|Q|P AND Q
---|---|---
真|真|真
真|假|假
真|不确定|不确定
假|真|假
假|假|假
假|不确定|假
不确定|真|不确定
不确定|假|假
不确定|不确定|不确定

OR (___其实可以理解为,结果按照好的那个取___)

P|Q|P OR Q
---|---|---
真|真|真
真|假|真
真|不确定|真
假|真|真
假|假|假
假|不确定|不确定
不确定|真|真
不确定|假|不确定
不确定|不确定|不确定

## 第三章 聚合与排序

### 3-1 对表进行聚合查询

#### 聚合函数
通过SQL对数据进行某种操作或计算时需要使用函数.例如,计算表中全部数据行数时可以使用__count函数__.该函数就是使用count(计数)来命名的.除此之外,SQL中还有很多其他用于合计的函数,下面是5个常用的函数

1. COUNT: 计算表中的记录数(行数).
2. SUM: 计算表中数值列的数据的合计值.
3. AVG: 计算表中数值列的数据的平均值.
4. MAX: 求出表中数值列的数据的最大值.
5. MIN: 求出表中数值列的数据的最小值.

如上所示,用于合计的函数称为聚合函数或者集合函数.我们统称为聚合函数.所谓聚合,就是将多行汇总成一行.实际上所有的聚合函数都这样,输入多行输出一行.

#### 计算表中数据的行数
函数的函是盒子的意思.
计算Shohin表里全部数据行的命令:

```
SELECT COUNT(*)
FROM Shohin;
```
返回结果
```
count
-----
  8
```
COUNT() 括号中的输入值称为___参数___或者___parameter___,输出值称为___返回值___

#### 计算NULL以外数据的行数
想要计算表中全部数据行时,可以用SELECT COUNT(*) ~这样使用星号.如果想得到shiire_tanka列(进货单价)中非空行数的话,可以通过将对象列设定为参数来实现:
```
SELECT COUNT(shiire_tanka)
FROM shohin;
```

得到的返回值为

```
count
-----
  6
```

由上面的操作我们得出如下结论:

-  法则3-1 COUNT函数的结果根据参数的不同而不同,COUNT(\*)会得到包含NULL的数据行数,而COUNT(<列名>)会得到NULL之外的数据行数;而且星号(\*)是COUNT函数特有的参数.

#### 计算合计值

我们使用计算合计值的SUM参数,求出销售单价的合计值:

```
SELECT SUM(shiire_tanka)
FROM shohin;
```
得到的返回值为

```
 sum
-------
 12,210
```

注意:由于SUM 的参数是列名(shiire_tanka),在计算之前就把NULL给排除掉了;所以NULL其实并不在计算表达式当中.

- 法则3-2 聚合函数会将NULL排除在外.但是COUNT(*)例外,并不会排除NULL.

#### 计算平均值

计算销售单价和进货单价的平均值
```
SELECT AVG(hanbai_tanka), AVG(shiire_tanka)
FROM shohin;
```
执行结果

```
 avg	  avg
-------+------- 
2097.5	 2035
```
计算平均值的情况与SUM函数相同,会事先删除NULL再进行计算.

#### 计算最大值和最小值

想要计算出多条记录中的最大值和最小值,可以分别使用__MAX__ 和 __MIN__函数,它们的使用方法和SUM一样,需要将列作为参数.
案例:计算销售价格和进货价格的最小值
```
SELECT MAX(hanbai_tanka), MIN(hanbai_tanka)
FROM shohin;
```
得到的结果为
```
 max	  min
-------+------- 
6800	  100
```

但是,MAX/MIN函数和SUM/AVG函数有一点不同,那就是SUM/AVG函数只能对数值类型的列使用,而MAX/MIN函数原则上可以适用于任何数据类型的列.
如:对日期类型的 torokubi
```
SELECT MAX(torokubi), MIN(torokubi)
FROM shohin;
```
得到的结果如下:
```
	 max	   min
-----------+-------------- 
2009-11-11	2008-04-28
```

- 法则3-3: MAX/MIN函数几乎使用所有数据类型的列.SUM/AVG函数只适用于数值类型的列
经过测试,针对字符串类型,MAX/MIN按照字典法排的(Z大A小).

#### 使用聚合函数删除重复值(关键字 DISTINCT)

案例: 假如我们要统计出商品种类的个数[换言之,就是要求每行一个种类(种类去重)];这里我们同样要用到关键字DISTINCT
```
SELECT COUNT(DISTINCT shohin_bunrui)
FROM shohin;
执行结果: 
   count
----------
	3
```

___个人理解:括号的优先级,这里我们是括号里先去重,再统计去重后的行数,也就是种类个数.___

如果我们把DISTINCT放在COUNT 前面会出现什么结果呢?
```
SELECT DISTINCT COUNT(shohin_bunrui)
FROM shohin;

执行结果: 
   count
----------
	8
	
个人理解:括号的优先级,这里我们是先统计shohin_bunrui行数;至于DISTINCT,因为参数不对[变成了COUNT(shohin_bunrui)的结果]应该是没有执行.
```

- 法则3-4: 想要计算值的种类时,可以在COUNT函数的参数中使用DISTINCT

DISTINCT 去重不仅限于COUNT函数,所有的聚合函数都可以使用.
案例:
```
SELECT SUM(hanbai_tanka),SUM(DISTINCT hanbai_tanka)
FROM shohin;

执行结果:
	 sum	   sum
-----------+-------------- 
	16780	  16280

右侧结果比左侧少了500 是因为右侧去重了500(打孔器和叉子的价格都是500,被去重了一个)
```

- 法则3-5: 在聚合函数的参数中使用DISTINCT,可以去重重复数据.

### 3-2对表进行分组

#### GROUP BY子句

如果我们想先把表按照某个列的定义来进行聚合(聚合就是分组,比如按照商品种类来分组,或者登记日期来分组),就可以使用GROUP BY子句

```
命令格式:
SELECT <列名1>,<列名2>,<列名3>,...  //查询的目标列
FROM <表名>							
GROUP BY <列名1>,<列名2>,<列名3>,...	//分组的参考列

案例: 按照商品种类统计数据行数
SELECT shohin_bunrui,COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui;

执行结果:
Shohin_bunrui|count
-------------+-----
衣服	     |	2
办公用品	     |	2
厨房用具	     |	4
```

如上所示,使用GROUP BY 子句,会将表中的数据分为多个组进行处理;在GROUP BY子句中指定的列称为__聚合键__ 或者 __分组列__.
由于能决定表的切分方式,所以是非常重要的列,当然GROUP BY子句也和SELECT子句一样,可以通过都好分割指定多列.

- 法则3-6: GROUP BY就像是切分表的一把刀

此外, GROUP BY 子句的书写位置也有严格要求,一定要卸载FROM语句(如果有WHERE子句,也要写在WHERE语句之后).如果无视子句的书写顺序,会报错

到目前为止我们暂定一个子句的__书写顺序__
_1.SELECT→2.FROM→3.WHERE→4.GROUP BY_

- 法则3-7: SQL子句顺序不能改变,也不能互相替换

#### 聚合键中包含NULL的情况
截下来我们将对进货单价(Shiire_tanka)作为聚合键对表进行切分.
在GROUP BY子句中指定进货单价:
```
SELECT shiire_tanka,COUNT(*)
FROM Shohin
GROUP BY shiire_tanka;

执行结果:
Shohin_bunrui|count
-------------+-----	
	     |	2
320	     |	1
500	     |	1
5000	     |	1
2800	     |	2
790	     |	1
```
从上面的结果我们可以看出,当聚合键(分组列)中包含NULL时,也会将NULL作为一组特定的数据.

- 法则3-8: 聚合键(分组列)中包含NULL时,在结果中会以__"不确定"行(空行)__的形式展示出来

#### 使用WHERE子句时GROUP BY的执行结果
在使用了GROUP BY子句的SELECT语句中,也可以正常使用WHERE子句,子句的书写顺序如前所述,语法结果如下:
```
命令格式:
SELECT <列名1>,<列名2>,<列名3>,...  //查询的目标列
FROM <表名>
WHERE 								//查询条件							
GROUP BY <列名1>,<列名2>,<列名3>,...	//分组的参考列

案例:同时使用WHERE子句和GROUP BY 子句

SELECT shiire_tanka,COUNT(*)
FROM Shohin
WHERE shohin_bunrui = '衣服'
GROUP BY shiire_tanka;
```

上面案例的SELECT语句由于首先使用了WHERE子句对记录进行过滤,所以实际上作为聚合对象的记录如下表所示,只有2行:

shohin\_bunrui(商品分类)|shohin\_mei(商品名称)|shohin\_id(商品编号)|hanbai\_tanka(销售单价)|shiire\_tanka(进货单价)|torokubi(登记日期)
---|---|---|---|---|---
衣服|T恤衫|0001|1000|500|2009-09-20
衣服|运动T恤|0003|4000|2800|&nbsp;

使用进货单价对这两条记录进行分组得到如下的执行结果:
```
shiire_tanka|count
-------------+-----
500	| 1
2800	| 1
```

GROUP BY 和WHERE 并用时,SELECT 语句的___执行顺序___如下所示

FROM→WHERE→GROUP BY→SELECT

#### 与聚合函数和GROUP BY子句有关的常见错误

1. 在SELECT子句中书写了多余的列

	在使用COUNT这样的聚合函数时,SELECT子句中的元素有严格的限制.实际上,使用聚合函数时,SELECT子句中只能存在以下三种元素:

	- 常数
	- 聚合函数
	- GROUP BY子句中指定的列名(也就是组合键or分组列)

	这里经常会出现的错误是**把聚合键之外的列名字写在SELECT子句中**.就会出错

	比如下面这个错误代码:
	```
	SELECT shohin_mei,shiire_tanka,COUNT(*)		//SELECT子句中出现了GROUP BY子句中没有的列名 shohin_mei
	FROM Shohin
	GROUP BY shiire_tanka;

	执行就会报错:

	[42803] ERROR: column "shohin.shohin_mei" must appear in the GROUP BY clause or be used in an aggregate function
		位置：8
	```
	_其实仔细想一想就能明白,通过某个聚合键将表分组之后,结果中一行数据就代表一组.例如,使用进货单价将表进行分组以后,一行就代表了一个进货单价.问题就出在这里,聚合键和商品名_**并不一定是一对一的**也可以想想执行顺序.
	FROM→ WHERE→ GROUP BY→ HAVING→  SELECT→ ORDER BY
	

		
		shohin_mei|shiire_tanka|count
		----------+------------+-----
			         ┊
			        2800       |   2
		     ↑       ┊ 
    	这里应该显示什么呢??
		
	像这样与聚合键相对应的、同时存在多个值的列出现在SELECT子句中的情况,理论上是不存在的.
	
2. 在GROUP BY子句中书写了列的别名

	这也是一个非常常见的错误.在前面我们学过,SELECT 子句中的项目可以通过AS关键字来指定别名.但是在GROUP BY子句中是不能使用别名的.
	如下面就是一段错误的代码(在POSTGRESQL和MYSQL中不会报错,但是不建议使用)

	```
	SELECT shohin_bunrui AS sb,COUNT(*)
	FROM shohin
	GROUP BY sb;
	```

	造成这样的错误其实是因为SQL语句的执行顺序,FROM→WHERE→GROUP BY→SELECT;**这段语句在POSTGRESQL和MYSQL中不会报错,但是不建议使用**

	- 法则3-10: 在GROUP BY子句中不能使用SELECT子句中定义的别名

3. GROUP BY子句的结果能排序吗?

	GROUP BY子句的结果通常都包含多行,有时可能是成千上万行.那么,这些结果究竟是按照什么顺序排列的呢?

	答案是:"**随机的!!!**",这些结果默认显示顺序都是随机的.如果要按照某种特定顺序进行排列的话,需要在SELECT语句中进行指定.我们将在后面学习.

	- 法则3-11: GROUP BY子句结果的显示是无序的.

4. 在WHERE子句中使用聚合函数

	假如我们想要取出恰好包含2行数据的组该怎么办呢?满足要求的是办公用品和衣服
	表面处理方法:

		SELECT shohin_bunrui,COUNT(*)
		FROM shohin
		WHERE COUNT(*) = 2
		GROUP BY Shohin_bunrui;
		
		执行报错:	[42803] ERROR: aggregate functions are not allowed in WHERE
			位置：49	//提示聚合函数不能出现在WHERE子句中
	
	只有SELECT 和 HAVING子句(以及后面要学的ORDER BY子句)中能够使用COUNT等聚合函数.并且,HAVING子句可以非常方便的实现

	- 法则3-12: 只有SELECT子句和HAVING子句(以及ORDER BY子句)中能够使用聚合参数

### 3-3 为聚合结果指定条件

#### HAVING子句

下面我们就来取出"聚合结果正好为2行的组";说到指定条件我们一般首先想到WHERE子句.但是WHERE子句只能指定记录(行)的条件,而不能用来指定组的条件(如,"数据行数为2"或者"平均值为500"等).
因此,对集合指定条件就需要使用其他的子句了.此时就可以用HAVING子句.

```
语法结构:
SELECT <列名1>,<列名2>,<列名3>...
FROM <表名>
GROUP BY <列名1>,<列名2>,<列名3>...
HAVING <分组结果对应的条件>
```
注意: HAVING子句必须写在GROUP BY子句之后.其在DBMS内部的执行顺序也排在GROUP BY子句之后.
顺序为: SELECT→FROM→WHERE→GROUP BY→HAVING

- 法则3-13: HAVING子句要写在GROUP BY之后.

案例1:下面我们就来操作通过商品种类进行聚合分组后的结果,指定"包含数据行数为2行"这一条件的SELECT语句

```
代码:
SELECT shohin_bunrui,COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui
HAVING COUNT(*) = 2;

执行结果如下:
shohin_bunrui|count
-------------+-----
   衣服      |   2
  办公用品    |   2
```

案例2:选取销售单价的平均值大于等于2500元

```
不使用HAVING子句的情况:
SELECT shohin_bunrui,AVG(hanbai_tanka)
FROM Shohin
GROUP BY shohin_bunrui;

执行结果:
shohin_bunrui|avg
-------------+-----
   衣服      |   2500
  办公用品    |   300
  厨房用具    |   2795

使用HAVING子句的情况:
SELECT shohin_bunrui,AVG(hanbai_tanka)
FROM shohin
GROUP BY shohin_bunrui
HAVING AVG(hanbai_tanka) >= 2500;

执行结果为:
shohin_bunrui|avg
-------------+-----
   衣服      |   2500
  厨房用具    |   2795
```

#### HAVING子句的构成要素

HAVING子句和包含GROUP BY子句时的SELECT子句一样,能够使用的要素要有一定的限制.限制内容也是完全相同的,HAVING子句中能使用的三种要素:
	- 常数
	- 聚合函数
	- GROUP BY子句中指定的列名(聚合键或者分组列)
```
代码:
SELECT shohin_bunrui,COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui
HAVING COUNT(*) = 2;
这段代码中, COUNT(*) 是聚合函数,2是常数.完全满足上述要求.

反之,如果写成下面这个样子就会出错
SELECT Shohin_bunrui,COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui
HAVING Shohin_mei = '圆珠笔';

会报这个错误:
ERROR: column "shohin.shohin_mei" must appear in the GROUP BY clause or be used in an aggregate function
		列名"shohin_mei"必须包含在GROUP BY子句里,或者在聚合函数里使用
```

 为了更好理解我们可以把一次的聚合(就是使用GROUP BY子句时,SELECT子句聚合)之后结果类似下表,作为HAVING子句的起始点.

 shohin\_bunrui|COUNT(\*)
 ---|---
 厨房用具|4
 衣服|2
 办公用具|2

聚合之后(如上表)结果中并不存在shohin_mei这个列,SQL当然也就无法为表中不存在的列设定条件啦.

#### 相对于HAVING子句,更适合卸写在WHERE子句中的条件

我们发现有些条件既可以写在HAVING子句当中,也可以写在WHERE子句当中.这些条件就是__聚合键所对应的条件__

比较下面两段代码:
```
1st section:

SELECT shohin_bunrui,COUNT(*)
FROM Shohin
WHERE shohin_bunrui = '衣服'
GROUP BY shohin_bunrui;

执行结果:
shohin_bunrui|count
-------------+-----
   衣服      |   2

2nd section:

SELECT Shohin_bunrui,COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui
HAVING Shohin_bunrui = '衣服';

执行结果也是:
shohin_bunrui|count
-------------+-----
   衣服      |   2
```

虽然条件分别写在WHERE子句和HAVING子句当中,但是条件的内容和返回的结果完全相同.因此,大家可能觉得两种书写方式都没问题
但是作者认为__聚合键所对应的条件还是应该书写在WHERE子句当中__;原因有两个:

1. 根本原因是WHERE子句和HAVING子句的作用不同,HAVING子句是用来指定"组"的条件的.因此,"行"所对应的条件还是应该写在WHERE子句当中.这样一来书写出的SELECT语句不但可以分清两者格子的功能,理解起来也更容易.
	```
	WHERE子句 = 指定行所对应的条件
	HAVING子句 = 指定组所对应的条件
	```

2. 其次就是HAVING子句和WHERE子句的执行速度
	进行聚合操作时,DBMS内部就会进行排序处理.排序处理会大大增加机器的负担,即所谓的高负处理.因此,只有尽可能减少排序的行数,才能增加处理速度;通过WHERE子句指定条件时,由于排序之前就对数据进行了过滤,所以能够减少排序的数据量.
	但是HAVING子句是在排序后才对数据进行分组的,因此与在WHERE子句中指定条件比起来,需要排序的数据量就会多得多.
	另外WHERE子句更具速度优势的另一个理由是,可以对WHERE子句指定条件所对应的列创建索引,这样也可以大幅提高处理速度.创建索引是一种非常普遍的提高DBMS性能的方法,效果也十分明显,对WHERE子句来说也是十分有利

### 3-4对查询结果进行排序
#### ORDER BY子句

```
ORDER BY 语句格式:
SELECT <列名1>,<列名2>,<列名3>...
FROM <表名>
ORDER BY <排序基准列1>,<排序基准列2>,<排序基准列3>...

案例: 按照销售单价由低到高(升序)进行排列
SELECT Shohin_id,shohin_bunrui,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY hanbai_tanka;

执行结果:
Shohin_id,shohin_bunrui,hanbai_tanka,shiire_tanka
0008		办公用品		   100	
0006		厨房用具		   500	
0002		办公用品		   500         320
0007		厨房用具		   880	       790
0001		衣服		   1000	       500
0004		厨房用具		   3000	       2800
0003		衣服		   4000	       2800
0005		厨房用具		   6800	       5000
```

不论何种情况,ORDER BY子句都要写在SELECT语句的末尾.这是因为对数据进行排序的操作必须在结果即将返回时执行.ORDER BY 子句中书写名称为__排序键__;
该子句和其他子句的执行顺序关系如下:
SELECT 子句→ FROM子句→ WHERE子句→ GROUP BY子句→ HAVING子句→ ORDER BY子句

#### 指定升序或降序

升序ASC(Ascendent) 降序DESC(Descendent)

案例: 按照销售单价由高到低(降序)排列
```
SELECT shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi
FROM Shohin
ORDER BY hanbai_tanka DESC;

执行结果:
shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi
0005	高压锅	厨房用具	6800	5000	2009-01-15
0003	运动T恤	衣服	4000	2800	
0004	菜刀	厨房用具	3000	2800	2009-09-20
0001	T恤	衣服	1000	500	2009-09-20
0007	擦菜板	厨房用具	880	790	2008-04-28
0002	打孔器	办公用品	500	320	2009-09-11
0006	叉子	厨房用具	500		2009-09-20
0008	圆珠笔	办公用品	100		2009-11-11
```

- 法则3-16: 升序用ASC(Ascendent) 降序用(Descendent),未指定ORDER BY子句中排列顺序时默认使用升序进行排列;但是先比左边排序键,左边排序键一样的时候再比第二个排序键


#### 指定多个排序键

通过上面我们对销售单价进行升序排列SELECT语句的执行结果,我们发现销售单价为500的商品有两件.相同价格的商品的顺序没有特地指定,或者说是随即排序的.如果想要对该顺序的商品进行更细致的排序的话,就需要再添加一个__排序键__,

在此我们以添加商品序号的升序为例:

```
SELECT shohin_id,shohin_mei,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY hanbai_tanka,shohin_id;

执行的结果:
0008	圆珠笔	100	
0002	打孔器	500	320
0006	叉子	500	
0007	擦菜板	880	790
0001	T恤	1000	500
0004	菜刀	3000	2800
0003	运动T恤	4000	2800
0005	高压锅	6800	5000
```
这样一来,就可以在ORDER BY 子句中同时指定多个排序键了.会优先使用左侧的键,如果该列存在相同值的话,会接着参考右侧的键.当然,也可以使用3个以上的键.

#### NULL的顺序
当我们使用销售单价(shiire_tanka)列作为排序键,圆珠笔和叉子对应的值为NULL.究竟NULL会按什么顺序来排呢?
```
SELECT shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY shiire_tanka;
```

结果发现:__NULL会汇集在开头或者结尾__
- 法则3-17: 排序键中有NULL时,会在开头或末尾进行汇总

#### 在排序键中使用显示用别名
```
案例代码:
SELECT  Shohin_id AS id,shohin_mei,shohin_bunrui,hanbai_tanka AS ht,shiire_tanka
FROM Shohin
ORDER BY ht,id;

执行结果:
0008	圆珠笔	办公用品	100	
0002	打孔器	办公用品	500	320
0006	叉子	厨房用具	500	
0007	擦菜板	厨房用具	880	790
0001	T恤	衣服	1000	500
0004	菜刀	厨房用具	3000	2800
0003	运动T恤	衣服	4000	2800
0005	高压锅	厨房用具	6800	5000
```

不能在GROUP BY中使用的别名,在ORDER BY中却可以使用,这是因为SQL语句在DMBS内部的执行顺序决定的
FROM→ WHERE→ GROUP BY→ HAVING→ SELECT→ ORDER BY
这只是一个粗略的总结.一定要记住SELECT子句是__在GROUP BY子句之后,ORDER BY之前__.因此在执行GROUP BY子句是,SELECT语句定义的别名无法被识别,对于在SELECT子句之后执行的ORDER BY子句却可以识别.
- 法则3-18: 在ORDER BY子句中可以使用SELECT子句中定义的别名.

#### ORDER BY子句中可以使用的列
ORDER BY子句中可以使用存在于表中,但是并不包含在SELECT子句中的列
```
SELECT Shohin_bunrui,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY shohin_id;

执行结果:
衣服	1000	500
办公用品	500	320
衣服	4000	2800
厨房用具	3000	2800
厨房用具	6800	5000
厨房用具	500	
厨房用具	880	790
办公用品	100	
```

除此之外,还可以使用聚合参数
```
代码:
SELECT Shohin_bunrui,COUNT(*)
FROM shohin
GROUP BY shohin_bunrui
ORDER BY COUNT(*) DESC;

执行结果:
厨房用具	4
衣服	2
办公用品	2
```
- 法则:3-19: 在ORDER BY 子句中可以使用SELECT子句中未使用的列和聚合函数.

#### 不要使用列编号
在ORDER BY子句中,还可以使用在SELECT子句中出现的列所对应的编号.列编号是指___SELECT子句中的列按照从左到右的顺序进行排列时所对应的编号___.因此下面两段代码含义是相同的
```
1st Section
SELECT shohin_id,shohin_mei,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY hanbai_tanka DESC,shohin_id;

2nd Section
SELECT shohin_id,shohin_mei,hanbai_tanka,shiire_tanka
FROM Shohin
ORDER BY 3 DESC,1;
```

但是__这种做法是不被推荐的__,原因如下:

1. __代码阅读起来比较难__,使用编号时,如果只看ORDER BY子句是无法知道当前是按照哪一列进行排序的,只能去SELECT子句的列表中按顺序进行确认,当代码量大的时候,就很麻烦了.
2. 根本问题,SQL-92中已经明确了__该排序功能将来会被删除__.

- 法则3-20: 在ORDER BY不要使用列编号.

## 第四章 数据更新
### 4-1 数据的插入(INSERT语句的使用方法)

在前面我们知道了用来创建表的CREATE TABLE语句,通过CREATE TABLE语句创建出来的表,可以将其比作一个空空如也的箱子.只有把数据装到这个箱子后,它才能称为数据库.用来装入数据库的SQL语句就是INSERT(插入)
INSERT(插入)的流程

①CREATE TABLE语句只负责创建表,但是创建出的表中没有数据

②通过INSERT语句插入数据

③向表中插入数据

下面我们创建一个 ShohinIns的表
```
CREATE TABLE ShohinIns1
(shohin_id CHAR(4) NOT NULL,
shohin_mei VARCHAR(100) NOT NULL,
shohin_bunrui VARCHAR(100) NOT NULL,
hanbai_tanka INTEGER 	,
shiire_tanka INTEGER	,
torokubi DATE	,
PRIMARY KEY (shohin_id));
```
这里只是创建了一个表,并没有插入数据,接下来,我们就想ShohinIns表中插入数据.

#### INSERT语句的基本语法

INSERT语句的基本语法
```
INSERT INTO <表名>(列1,列2,列3...) VALUES (值1,值2,值3...);
```

假如我们要向ShohinIns表中插入一行数据,各列值如下:
```
INSERT INTO ShohinIns(shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi)
VALUES ('0001','T恤衫','衣服',1000,500,'2009-09-20');
```
由于Shohin\_id列(商品编号) 和shohin\_mei列(商品名称)是字符型,所以插入的数据需要用单引号括起来.日期型的torokubi(登记日期)也是如此.

列名和值用逗号隔开,分别在( )内,这种形式称为清单.代码清单中的INSERT语句包含下面两个清单:

1. 列清单 → (shohin\_id,shohin\_mei,shohin\_bunrui,hanbai\_tanka,shiire\_tanka,torokubi)
2. 值清单 → ('0001','T恤衫','衣服',1000,500,'2009-09-20')

当然,表名后面的列清单和VALUES子句中列的数量必须保持一致.列数不一致时会出错,无法插入数据.

此外,原则上,执行一次INSERT语句会插入一行数据,因此插入多行时,通常需要循环执行所需行数次的INSERT语句

- 法则4-1: 原则上执行一次INSERT语句会插入一行数据

#### 多行INSERT

通常INSERT 和多行INSERT
```
-- 通常INSERT
INSERT INTO ShohinIns VALUES ('0002','打孔器','办公用品',500,320,'2009-09-20' );
INSERT INTO ShohinIns VALUES ('0003','运动T恤','衣服',4000,2800,NULL );
INSERT INTO ShohinIns VALUES ('0004','菜刀','厨房用具',3000,2800,'2009-09-20' );

-- 多行INSERT
INSERT INTO ShohinIns VALUES ('0002','打孔器','办公用品',500,320,'2009-09-20' );
                             ('0003','运动T恤','衣服',4000,2800,NULL );
                             ('0004','菜刀','厨房用具',3000,2800,'2009-09-20' );
```

该语法很容易理解,并且减少了书写语句的数量,很方便,但是使用该语句时,请注意一下几点:

首先,INSERT语句书写内容及插入的数据是否正确.当然此时都会发生INSERT错误,但是由于是多行插入,和特定的单一行INSERT相比,想要找出哪个地方出错了,就变得十分困难

其次,该多行INSERT的语法并不适合所有的DBMS.该多行语法__不适用于ORACLE__.

#### 列清单的省略.
对表进行全列INSERT的时候,可以省略表名后面的列清单.这时VALUES子句的值会默认按照从左到右的顺序赋予每一列.因此,下面的两个INSERT语句会插入同样的数据:

```
-- 包含列清单:
INSERT INTO ShohinIns(shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi)
VALUES ('0001','T恤衫','衣服',1000,500,'2009-09-20');

-- 不包含列清单:
INSERT INTO ShohinIns VALUES ('0001','T恤衫','衣服',1000,500,'2009-09-20');
```

#### 插入NULL
INSERT 语句中想给某一列赋予NULL值时,可以直接在VALUES子句的值清单中写入NULL,但是想要插入NULL的列一定不能设置NOT NULL约束.想设置了NOT NULL约束的列中插入NULL时,INSERT语句会出错,数据插入失败.
插入失败是指希望通过INSERT语句插入的数据无法正常插入到表中,但之前已经插入的数据并不会被破坏.
不仅INSERT,DELET和UPDATE等更新语句也一样.SQL语句执行失败时都不会对表中数据造成影响.

#### 插入默认值

我们还可以向表中插入默认值(初始值).默认值的设定,通过在创建表的CREATE TABLE语句中设置__DEFAULT 约束__来实现.

```
在创建表时设定默认值
CREATE TABLE ShohinIns
(shohin_id  CHAR(4) NOT NULL,
 hanbai_tanka INTEGER DEFAULT 0,	--销售单价默认值设定为0
)
```
通过显示方法设定默认值
```
INSERT INTO ShohinIns (shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi)
VALUES ('0007','擦菜板','厨房用具',DEFAULT,790,'2009-04-28');
```
这样一来,RDBMS就会在插入记录是,自动把默认值赋给对应的列.
我们可以使用SELECT语句来确认通过INSERT语句插入的数据行
```
SELECT * FROM shohinins WHERE shohin_id = '0007';
```

因为hanbai\_tanka列(销售单价)默认值为0,所以hanbai\_tanka的列被赋予了值0.

通过隐示方法插入默认值
插入默认值时也可以不使用DEFAULT关键字.只要在列清单和VALUES中省略设定了默认值的列就可以了
```
INSERT INTO ShohinIns (shohin_id,shonhin_mei,shohin_bunrui,shiire_tanka,torokubi)	//在列清单中省略了hanbai_tanka.
VALUES('0007','擦菜板','厨房用品',790,'2009-09-20')	//在值清单中也省略了hanbai_tanke列的值.
```

这样也可以给hanbai_tanka赋默认值 0.

在实际情况中.我们最好使用显示方法来设置默认值.因为这样更容易理解.

说到省略名,还有一点要说明一下.如果省略了___没有设定默认值的列___的话,___该列的值___就会被设定为NULL.因此如果省略的是设置了NOT NULL约束的列的话,INSERT语句就会出错.

- 法则4-2: 省略INSERT语句中的列名,就会自动设定为该列的默认值(没有默认值时会设定为NULL).

#### 从其他表中复制数据
我们新建一张ShohinCopy表,要求它的结构和之前的Shohin表完全一样,只是更改一下表名而已.
```
CREATE TABLE ShohinCopy
( shohin_id	CHAR(4)  NOT NULL,
 shohin_mei VARCHAR(100) NOT NULL,
 shohin_bunrui VARCHAR(100) NOT NULL,
 hanbai_tanka INTEGER ,
 shiire_tanka INTEGER	,
 torokubi DATE	,
 PRIMARY KEY (shohin_id));		//完成ShohinCopy表的创建

-- 将Shohin表里的数据复制到ShohinCopy表中:
INSERT INTO ShohinCopy (shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi)
SELECT shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi
FROM shohin;
```
执行该___INSERT...SELECT___语句时,如果原来Shohin表中有8行数据,那么ShohinCopy中也会插入完全相同的8行数据.当然Shohin表中原有数据是不会发生改变的.因此INSERT...SELECT语句可以在需要进行数据备份时使用.

__多重多样的SELECT语句__

在INSERT语句中的SELECT语句,也可以使用WHERE子句或者GROUP BY等子句等.目前为止学到的各种SELECT语句也都可以使用(__但是,即便指定了ORDER BY子句也没有任何意义,因为无法保证表内部记录的排列顺序__).对关联表之间存取数据来说,非常方便.
下面我们试试包含GROUP BY子句的SELECT语句进行INSERT.
```
创建ShohinBunrui表:
CREATE TABLE ShohinBunrui
( shohin_bunrui VARCHAR(32)  NOT NULL,
sum_hanbai_tanka	INTEGER 	,
sum_shiire_tanka	INTEGER 	,
PRIMARY KEY (shohin_mei));
```
该表是用来存储根据商品种类(Shohin\_bunrui)计算出来销售单价合计值以及进货单价合计值的表.我们下面用INSERT...SELECT语句从Shohin表中选取出数据插入到Shohin\_bunri中吧
```
INSERT INTO shohin_bunrui (shohin_bunrui,sum_hanbai_tanka,sum_shiire_tanka)
SELECT shohin_bunrui,sum(hanbai_tanka),sum(shiire_tanka)
FROM Shohin
GROUP BY shohin_bunrui;		从shohin中取到值并插入到shohin\_bunrui中

SELECT * FROM shohin_bunrui	//确认插入的数据行

执行结果:
衣服	5000	3300
办公用品	600	320
厨房用具	11180	8590
```

- 法则4-3: INSERT语句的SELECT语句中,可以使用WHERE子句或者GROUP BY子句等任何SQL语法(但是使用ORDER BY 子句并不会产生任何效果)

### 4-2 数据的删除(DELETE语句的使用方法)

#### DROP TABLE语句和DELETE语句
删除数据的方法,大体可分为以下两种:

1. __DROP TABLE语句__可以将表完全删除;
2. __DELETE语句__会留下表(容器),而删除表中的全部数据.

1中的DROP TABLE语句会完全删除整张表,因此删除之后再向插入数据,就得使用CREATE TABLE重新创建一张表了.
反之,2中的DELETE语句在删除数据(行)的同时会保留数据表,因此只需要通过INSERT语句就可以再次向表中插入数据.
不管使用那种方法删除数据时都要慎重,一旦发生误删,想要恢复数据,都十分困难.

#### DELETE语句的基本语法
```
保留数据表,清空全部数据的基本语法:
DELETE FROM <表名>;

案例:清空ShohinCopy表内数据,保留ShohinCopy表
DELETE FROM ShohinCopy;
```

如果DELETE语句中忘了写FROM,而是写成了DELETE <表名>,或者写了多余的列名,都会出错;其实从英语语法角度来说也是很好理解的.
要加FROM是因为DELETE(INSERT,或者UPDATE)操作的对象都是表内的数据,而不是表本身,所以中间要加__介词__
而写了多余的列名错误是由于DELETE语句的对象是行而不是列,所以DELETE语句无法删除部分列的数据.

- 法则4-4: DELETE语句的删除对象并不是表或者列,而是记录(行).

#### 指定删除对象的DELETE语句(搜索型DELETE)

想要删除部分数据行时,可以像SELECT语句那样使用WHERE子句指定删除条件.这种指定了删除对象的DELETE语句称为'搜索型DELETE',虽然"搜索型DELETE"是正是用语,但实际上这种说法并不常用,而是简单的称作DELETE语句

```
删除部分数据行的搜索型DELETE语法结构:
DELETE FROM <表名>
WHERE;

案例:删除销售单价(hanbai_tanka)大于等于4000的数据
DELETE FROM shohincopy
WHERE hanbai_tanka >=4000
```

WHERE子句的书写方式和前面介绍的SELECT完全一样.我们用SELECT语句确认一下

```
SELECT * FROM Shohincopy;
发现结果只剩下6行,被删除了两行
```

- 法则4-5: 可以通过WHERE子句指定对象条件来删除部分数据.

#### 拓展:删除和时期(DELETE 和 TRUNCATE)

标准SQL中用来从表中删除数据的只有DELETE语句.但是很多数据库产品中还有另外一种被称为TRUNCATE的语句.
TRUNCATE是舍弃的意思,具体用法为: `TRUNCATE <表名> `
与DELETE不同的是,TRUNCATE只能删除表中的全部数据,是清空的意思,它并他不能通过WHERE子句来指定条件删除部分数据.也正式因为它不能具体地控制删除对象,所以其处理速度比DELETE要快很多.实际上DELETE在DML语句中也是属于处理时间比较长的,因此需要删除全部数据行的时候,使用TRUNCATE可以缩短执行时间.

### 4-3 数据的更新(UPDATE语句的使用方法)

使用INSERT语句向表中插入数据之后,有时却想要再更改数据.比如,"将商品的销售单价登记错了"等等.这时并不需要把数据删除之后再重新插入,只要用UPDATE语句就可以改变表中的数据了.
和INSERT语句、DELETE语句一样，UPDATE语句也属于DML语句。通过执行该语句，我们就可以改变表中的数据了。其基本语法如下：
```
UPDATE <表名>
SET <列名> = <表达式>;

案列:将ShohinCopy表中的商品登记日期改成"2009-10-10"
UPDATE ShohinCopy
SET torokubi = '2009-10-10'

执行结果如下:
0001	T恤	衣服	1000	500	2009-10-10
0002	打孔器	办公用品	500	320	2009-10-10
0004	菜刀	厨房用具	3000	2800	2009-10-10
0006	叉子	厨房用具	500		2009-10-10
0007	擦菜板	厨房用具	880	790	2009-10-10
0008	圆珠笔	办公用品	100		2009-10-10
```
此时,连登记日期原本为NULL 的数据行(运动T恤)的值也更新为2009-10-10了.

#### 指定条件的UPDATE(搜索型UPDATE)

更新数据也可以像DELETE语句那样使用WHERE子句.这种指定更新对象的UPDATE语句称为搜索型UPDATE语句.
```
语法格式:
UPDATE <表名>
SET <列名> = <表达式>
WHERE <条件>;

案例:将商品种类(shohin_bunrui)为'厨房用具'的记录的销售单价(hanbai_tanka),更新为原来的10倍:
UPDATE ShohinCopy
SET hanbai_tanka = hanbai_tanka * 10
WHERE shohin_bunrui = '厨房用具';
```

该语句通过WHERE子句shohin\_bunrui='厨房用具'将更新对象限定为3行,然后通过SET子句的表达式hanbai\_tanka * 10将原来的单价扩大了10倍.SET子句中复制表达式的右边不仅可以是单纯的值,也可以是包含列的表达式.

#### 使用NULL进行更新

使用UPDATE也可以将列更新为NULL(该更新俗称__NULL清空__),此时只要将赋值表达式右边的值直接写为NULL即可.
```
如:
UPDATE ShohinCopy
SET torokubi = NULL
WHERE shohin_id = '0008';

--确认更新内容:
SELECT * FROM shohincopy ORDER BY shohin_id;

执行结果为:
0001	T恤	衣服	1000	500	2009-10-10
0002	打孔器	办公用品	500	320	2009-10-10
0004	菜刀	厨房用具	3000	2800	2009-10-10
0006	叉子	厨房用具	500		2009-10-10
0007	擦菜板	厨房用具	880	790	2009-10-10
0008	圆珠笔	办公用品	100		
```
和INSERT语句一样,UPDATE语句也可以将NULL作为一个值来使用,但是只有未设置NOT NULL约束和主键约束的列才可以清空为NULL,如果将设置了上述约束的列更新为NULL,这执行结果会报错.

- 法则4-6: 使用UPDATE语句可以将值清空为NULL(但只限于未设置NOT NULL约束的列).

#### 多列更新

UPDATE语句的SET子句支持同时将多个列作为更新对象.如我们要将厨房用具的销售单价(hanbai\_tanka)更新为原来的10倍,如果同时想将进货单价(shiire\_tanka)更新为原来的一半,该怎么做呢?
```
当然我们可以逐步实现:
-- 先更新销售单价
UPDATE shohincopy,
SET hanbai_tanka =  hanbai_tanka * 10
WHERE shohin_bunrui = '厨房用具';

-- 再更新进货单价:
UPDATE shohincopy
SET shiire_tanka =  shiire_tanka / 2
WHERE shohin_bunrui = '厨房用具';
```

上面的方法虽然也能正确地更新数据,但是执行两次UPDATE语句不但有些浪费,而且增加了SQL语句的及数量.我们可以将其合并为一条UPDATE来处理,合并的方法有两种:
```
方法1:　使用逗号将列分隔开
UPDATE ShohinCopy
SET hanbai_tanka = hanbai_tanka * 10,
	shiire_tanka = shiire_tanka / 2
WHERE shohin_bunrui = '厨房用具';

方法2:将列用()括起来
UPDATE ShohinCopy
SET (hanbai_tanka,shiire_tanka) = (hanbai_tanka * 10, shiire_tanka / 2)
WHERE shohin_bunrui = '厨房用具';
```

方法1和方法2的执行结果是一样的,但是需要注意的是方法1是所有DBMS都可以使用,方法2有些DBMS是无法使用的.因此__建议使用第一种方法__.

### 4-4事务(TRANSACTION)
#### 什么是事务
事务就是__需要在同一个处理单元中执行的一系列更新处理的集合__
比如,将"运动T恤的销售单价降价1000元"、"将T恤的销售价格上调1000元";这时的事务就是有如下两条更新处理所组成
```
⑴ 将运动T恤的价格降价1000元
UPDATE ShohinCopy
SET hanbai_tanka = hanbai_tanka -1000
WHERE shohin_mei = '运动T恤';

⑵ 将T恤的价格上涨1000元
UPDATE shohincopy
SET hanbai_tanka = hanbai_tanka + 1000
WHERE shohin_mei = 'T恤'; 
```

上述⑴和⑵的操作一定要作为同一个处理单元执行.遇到这种需要在同一个处理单元中执行一系列更新操作的情况,一定要使用事务来进行处理.

- 法则4-7: 事务是需要在同一个处理单元中执行的一系列更新处理的集合,一个事务中包含多少歌更新或者包含那些处理,DBMS中并没有固定的标准,而是根据用户的要求决定的.

#### 创建事务
```
事务的语法:

事务开始语句;

	DML语句1;
	DML语句2;
	DML语句3;
	   ┆
事务结束语句(COMMIT或者ROLLBACK);
```

使用事务开始语句和事务结束语句将一系列DML语句(INSERT/UPDATE/DELETE语句)括起来,就实现了一个事务处理.
这个时候需要特别注意的是事务的开始语句,实际上在标准SQL中并没有定义事务的开始语句,而是由哥哥DBMS自己来定义的比较有代表性的如下:

- SQL SERVER、Postgresql

	BEGIN TRANSACTION

- MYSQL

	START TRANSACTION

- Oracle、DB2

	无

在POSTGRESQL中上面那两个UPDATE(⑴和⑵)创建出的事务如下:
```
BEGIN TRANSACTION;

UPDATE ShohinCopy
SET hanbai_tanka = hanbai_tanka -1000
WHERE shohin_mei = '运动T恤';
UPDATE shohincopy
SET hanbai_tanka = hanbai_tanka + 1000
WHERE shohin_mei = 'T恤'; 

COMMIT;
```

反之,事务的结束需要用户明确地给出指示.事务结束的指令有如下两种:

+ COMMIT--提交处理

	COMMIT是提交事务包含的全部更新处理的结束指令.相当于文件处理中的覆盖保存.一旦提交,就无法恢复到事务开始钱的状态了,因此,在提交之前一定要确认是否真的需要进行这些更新
	
	COMMIT 流程: (1) 事务开始语句→ (2) 执行更新DML → (3) 执行COMMIT ((2)中所有的更新全部都被反应到数据库中)
	
	万一由于误操作提交了包含错误更新的事务,就只能重新回到重新建表,重新插入数据这样的繁琐的老路上了.由于可能会造成数据无法恢复的后果,请务必注意.

	- 法则4-8: 虽然我们可以不清楚事务开始的时点,但是在事务结束时一定要仔细进行确认.

+ ROLLBACK--取消处理

	ROLLBACK是取消事务包含的全部更新处理的结束指令.相当于文件处理中的放弃保存.一旦回滚,数据库就会回复到事务开始之前的状态.通常回滚并不会像提交那样造成大规模的数据损失.
	ROOLBACK流程: (1) 事务开始语句 → (2)执行更新语句DML → (3) 执行ROLLBACK (结束后的状态:和(1)执行前相同)

#### 事务处理合适开始
几乎所有的数据库产品的事务都无需开始指令.因为大部分情况下,事务在数据库连接建立时就已经悄悄开始了,并不需要用户再明确发出开始指令.

像这样不使用指令而悄悄开始事务的情况下,应该如何区分各个事务呢?通常会有如下两种情况:

A. 每条SQL语句就是一个事务(自动提交模式: PostgreSQL中所有的指令语句都在事务内执行,即使不执行BEGIN,这些命令语句也会在执行时悄悄被括在BEGIN和COMMIT(如果成功的话)之间)
B. 直到用户执行COMMIT或者ROLLBACK为止算作一个事务.

#### ACID特性

* 原子性(Atomicity)
	是指在事务结束时,其中所包含的更新处理要么全部执行,要么全不执行的特性.上面的例子中,事务结束时,是不可能出现运动T恤的价格下降了,T恤的价格没有上涨的情况.该事务的结束的状态,要么两者都执行了(COMMIT),要么两者都未执行(ROLLBACK).

* 一致性(Consistency)
	是指事务中包含的处理,要满足数据库提前设置的约束,如主键约束或者NOT NULL约束等.例如,设置了NOT NULL约束的列是不能更新为NULL的,试图插入违反主键约束的记录就会出错,无法执行.对事务来说,这些不合法的SQL就会被回滚.
	也就是说这些SQL处理会被取消不会执行;而符合条件的SQL就会被执行.

* 隔离性(Isolation)
	指的是保证不同事务之间互不干扰的特性.该特性保证了事务之间不会互相嵌套.此外,在某个事务中进行的更改,在该事务结束之前,对其他事务而言是不可见的.因此,即使某个事务向表中添加了记录,在没有提交之前,其他事务是看不到新添加的记录的.

* 持久性(Durability)
	持久性也可以称为耐久性,指的是事务(不论是提交还是回滚),一旦结束,DBMS会保证该时点的数据状态得以保存的特性.即使由于系统故障导致数据丢失,数据库也一定能通过某种手段进行恢复,其中最常见的就是将事务的执行记录保存到硬盘等存储介质中(日志),发生故障时,可以通过日志回复到故障发生前的状态

## 第五章 复杂查询
### 5-1 视图
#### 视图和表
视图究竟是什么?用一句话来概述:就是"从SQL的角度来看视图就是一张表". 实际上在SQL语句中并不需要区分那些是表,那些是视图.只需要知道在更新时它们之间存在一些不同就可以了.
它们的区别只有一个,那就是"是否保存了实际的数据";通常我们在创建表时,会通过INSERT语句将数据保存到数据库之中.而数据库中的数据实际上会被保存到计算机的存储设备(通常是硬盘)中.因此,我们通过SELECT语句查询数据时,实际上就是从存储设备(硬盘)中读取数据,进行各种计算后,再将结果返回给用户这样的一个过程;但是使用视图时并不会将数据保存到存储设备之中,而且也__不会将数据保存到其他任何地方__.实际上视图保存的是SELECT语句.我们从视图中读取数据时,视图会在内部执行该SELECT语句并创建出一张临时表.

视图的有点大体有两点:

1. 由于视图无需保存数据.因此可以节省存储设备的容量.例如:我们之前创建了用来汇总商品种类(shohin_bunrui)的表.由于该表中的数据最终都会保存到存储设备之中,因此会占用存储设备的数据领域.但是,如果把同样的数据作为视图保存起来的话,就只需要下面这样的代码语句就可以了,这样就节省了存储设备的数据领域

	```
	SELECTR shohin_bunrui,SUM(hanbai_tanka),SUM(shiire_tanka)
	FROM Shohin
	GROUP BY shohin_bunrui;
	```

	本示例中表的数据量充其量只有几行,所以用视图并不会大幅缩小数据的大小.但是在实际业务中数量往往非常大,这时使用视图所节省的容量就往往非常可观了.

	- 法则5-1: 表中存储的是实际数据,而视图中保存的是从表中去数据所使用的SELECT语句.

2. 就是可以将频繁使用的SELECT语句保存成视图,这样就不用每次都重新书写了.创建好视图之后,只需要在SELECT语句中进行调用,就可以方便地得到想要的结果了.特别是在计算合计,以及由于包含复杂查询条件导致SELECT语句非常庞大时,使用视图可以大大提高效率.而且,视图中的数据会随着原表的变化而自动更新.视图归根到底就是SELECT语句,所谓"参照视图"也就是"执行SELECT语句"的意思.因此可以保证数据的最新状态.这是将数据保存在表中不具备的优势.

	- 法则5-2: 应该经常使用SELECT 语句做成视图

#### 创建视图的方法

```
创建视图的语句:
CREATE VIEW 视图名称(<视图列名1>,<视图列名2>,......)
AS
<SELECT语句>;
```

SELECT语句需要书写在AS关键字之后,SELECT语句中列的排列顺序和视图中列的排列顺序相同,SELECT语句中的第一列就是视图中的第一列,SELECT语句中的第二列就是视图中的第二列,依次类推.视图的列名在视图名称之后的列表中定义.
```
西面我们用Shohin表作为基本表来创建视图:

CREATE VIEW ShohinSum(shohin_bunrui,cnt_shohin)	//视图的列名
AS				
-- 下面就是视图定义中的主体(内容只是一条SELECT语句)
SELECT shohin_bunrui,COUNT(*)	
FROM Shohin
GROUP BY shohin_bunrui;
```
这样我们就在数据库中创建了一副名为ShohinSum的视图.请注意,务必不能省略第二行中的关键字AS.
之后我们就可以使用视图了
```
在视图ShohinSum中查看物品种类及种类的条数
SELECT shohin_bunrui,cnt_shohin
FROM ShohinSum;

其结果如下:
衣服	2
办公用品	2
厨房用具	4
```
通过上述视图ShohinSum定义的主体(SELECT语句)我们可以看出,该视图将根据商品种类(shohin\_bunrui)统计出的商品数量(cut\_shohin)作为结果保存了起来.这样如果大家在工作中需要频繁进行统计时,就不用每次都书写使用GROUP BY和COUNT函数的SELECT语句,从Shohin表中去的数据了.创建视图之后,就可以通过非常简单的SELECT语句,随时得到想要的合计结果了.并且如前所述,__Shohin表中的数据更新之后,视图也会自动更新__,非常灵活方便.

之所以能够实现上述功能,是因为__视图就是保存好的SELECT语句__.定义视图时,可以使用任何SELECT语句.既可以使用WHERE、GROUP BY、HAVING，也可以通过SELECT * 来指定全部列。

##### 使用视图的查询
在FROM子句中使用视图的查询，通常有如下两个步骤：

1. 首先执行定义的SELECT语句
2. 根据得到的结果，再执行在FROM子句中使用视图的SELECT语句

也就是说，使用视图的查询通常需要执行2条以上的SELECT语句。这里没有说“2条”，而是"2条以上"是因为还可能出现以视图为基础创建出类似楼中楼那样的__多重视图__,例如下面的案例
```
以ShohinSum为基础再创建出视图ShohinSumJim
CREATE VIEW ShohinSumJim (shohin_bunrui,cnt_shohin)
AS
SELECT shohin_bunrui,cnt_shohin
FROM ShohinSum 		//以视图ShohinSum为基础
WHERE Shohin_bunrui = '办公用品';

确认是否创建出视图:
SELECT shohin_bunrui,cnt_shohin
FROM shohinSumJim;

执行结果:
shohin_bunrui|count
-------------+-----
	办公用品		2

```

虽然语法上没有错误,但是我们还是应该尽量表面在视图的基础上创建视图.这是因为对多数DMBS来说,__多重视图会降低SQL性能__.因此最好还是使用单一视图.

- 法则5-3: 应该避免在视图的基础上创建视图.

#### 视图的限制1: 定义视图时不能使用ORDER BY子句

虽然之前我们说过在定义视图时可以使用任意SELECT语句,但其实有一种情况例外,那就是不能使用ORDER BY子句.因此下面的视图语句是错误的:
```
-- 不能这样定义视图:
CREATE VIEW ShohinSUM ( shohin_bunrui,cnt_shohin)
AS
SELECT shohin_bunrui, COUNT(*)
FROM Shohin
GROUP BY shohin_bunrui
ORDER BY shohin_bunrui;		//定义视图时不能使用ORDER BY 语句.
```
为什么不能使用ORDER BY 子句呢?因为视图和表一样.__数据行都是没有顺序的.__实际上,有些DBMS在定义视图时是可以使用ORDER BY子句的(POSTGRESQL),但这并不是通用的语法.因此,在定义视图时请不要用ORDER BY 语句.

#### 视图的限制2: 对视图进行更新
之前我们说过,在SELECT语句中视图可以和表一样进行使用.那么对于INSERT,DELETE,UPDATE这类更新语句(更新数据库的SQL) 来说会怎么样呢?

实际上虽然这其中有很严格的限制.但是某些时候也可以对视图进行更新.标准SQL中有这样的规定:如果定义视图的SELECT语句能够满足某些条件,那么这个视图就可以被更新,下面就是比较有代表性的条件:

1. SELECT子句中未使用DISTINCT
2. FROM子句中只有一张表
3. 未使用GROUP BY 子句
4. 未使用HAVING子句

此前我们学过,FROM子句里通常只有一张表,因此,我们可能觉得 2里的条件有点奇怪,但其实 FROM子句中也可以并列使用多张表.我们在学习完"表结合"的操作后就明白了.

其他的条件大多数都与聚合有关.简单来说,像上面例子中使用的ShohinSum那样,使用视图来保存原表聚合结果时,是无法判断如何将视图更改反映到原表中的,比如对ShohinSum执行如下INSERT语句
```
INSERT INTO ShohinSum VALUES('电器制品',5);
```
这样的语句会发生错误.因为视图ShohinSum是通过GROUP BY子句对原表进行聚合得到的.为什么通过聚合得到的视图不能进行更新呢?
视图贵庚到底还是从表派生出来的,因此如果原表可以更新的话,那么视图中的数据也可以更新.反之亦然,如果视图发生了改变,而原表没有进行相应更新的话,就无法保证数据的一致性了.
使用`INSERT INTO ShohinSum VALUES('电器制品',5);`,像视图ShohinSum中添加数据("电器制品",5)时,原表Shohin应该如何更新才好?按理说应该向表中添加商品种类为"电器制品"的5行数据,但是这些商品对应的"商品编号、商品名称和销售单价等”我们都不清楚。数据库在这里就遇到了麻烦。

* 法则5-5： 视图和表需要同时进行更新，因此通过聚合得到的视图无法进行更新.

##### 能够更新视图的情况
像下面这段代码，不是通过聚合得到的视图就可以进行更新。
```
CREATE VIEW ShohinJim ( shohin_id,shohin_mei,shohin_bunrui,hanbai_tanka,shiire_tanka,torokubi)
AS
--下面既没有聚合也没有结合的SELECT语句
SELECT *
FROM Shohin
WHERE shohin_binrui = '办公用品';
```

对于上面只包含办公用品类商品的视图ShohinJim来说,就可以执行下面的INSERT语句
```
INSERT INTO ShohinJim VALUES('0009','印章',95,10,'2009-11-30');
// 向视图中天加一行
```

___注意事项___

由于PostgreSQL中的视图会被初始设定为制度,所以执行上面的INSERT语句时,会才发生下面这样的错误:
```
ERROR: 不能向视图中插入数据
HINT: 需要一个无条件的ON INSERT DO INSTEAD
```

因此,在执行INSERT语句之前,需要使用下面的指令,允许更新操作.在DB2和MySQL等其他DBMS中,并不需要执行这样的指令

__允许PostgreSQL对视图进行更新__

```
CREATE OR REPLACE RULE insert_rule
AS ON INSERT
TO ShohinJim DO INSTEAD
INSERT INTO Shohin VALUES(
	new.shohin_id
	new.shohin_mei
	new.shohin_bunrui
	new.hanbai_tanka
	new.shiire_tanka
	new.torokubi);
```

我们用SELECT语句来确认数据行是否添加成功
```
SELECT * FROM ShohinJim;

执行结果: 数据行已经成功添加到视图中了:

0002	打孔器	办公用品	500	320	2009-09-11
0008	圆珠笔	办公用品	100		2009-11-11
0009	印章	办公用品	95	10	2009-11-20
```

原表
```
SELECT * FROM ShohinJim

执行结果: 数据行已经成功添加到原表中了:
0001	T恤	衣服	1000	500	2009-09-20
0002	打孔器	办公用品	500	320	2009-09-11
0003	运动T恤	衣服	4000	2800	
0004	菜刀	厨房用具	3000	2800	2009-09-20
0005	高压锅	厨房用具	6800	5000	2009-01-15
0006	叉子	厨房用具	500		2009-09-20
0007	擦菜板	厨房用具	880	790	2008-04-28
0008	圆珠笔	办公用品	100		2009-11-11
0009	印章	办公用品	95	10	2009-11-20
```

UPDATE语句和DELETE语句当然也可以想操作表时那样正常执行,但是对于原表来说却需要设置各种各样的约束(主键和NOT NULL等),需要特别注意

#### 删除视图

删除视图需要使用 __DROP VIEW语句__. 
```
语法结构如下:
DROP VIEW 视图名称(<视图列名1>,<视图列名2>,...)

案例:删除ShohinSum视图:
DROP VIEW ShohinSum;

特定的SQL:
在PostgreSQL中,如果想要删除以视图为基础创建出来的多重视图的话,由于存在关联的视图,会发生以下错误.
执行结果(使用PostgreSQL)
ERROT: 由于存在关联视图,所以无法删除视图ShohinSum
DETAIL: 视图shoshinsumjim与视图shohinsum相关联
HINT:  删除关联对象请使用DROP...CASCADE

PostgreSQL 删除相关联视图: DROP VIEW ShohinSum CASCADE
```

___备忘___
下面我们再次将Shohin恢复到初始状态(8行),执行以下DELETE语句,删除之前的1行数据
```
删除商品编号为'0009(印章)'的语句
DELETE FROM shohin WHERE shohin_id = '0009';
```
### 5-2 子查询

简而言之,子查询就是一次性的视图(SELECT语句).与视图不同,子查询在SELECT语句执行完毕之后就会消失

#### 子查询和视图

前面我们学习了视图这个非常方便的工具,本节将学习以视图为基础的子查询.子查询的特点概括起来就是一张一次性视图

我们先来复习视图的概念,视图并不是用来保存数据的,而是通过保存读取数据的SELECT语句的方法来为用户提供便利的工具.反之,子查询就是将__用来定义视图的SELECT语句__直接用于FROM子句当中.
截下来,就让我们拿前一届使用的视图ShohinSum(商品合计)来与子查询进行一番比较吧.

首先我们再来看一下视图ShohinSum和确认用的SELECT语句
```
--根据商品种类统计商品数量的视图
CREATE VIEW ShohinSum(hanbai_tanka,cnt_shohin)
AS
SELECT shohin_bunrui,COUNT(*)
FROM shohin
GROUP BY shohin_bunrui;

-- 确认视图是否已经创建成功
SELECT shohin_bunrui,cnt_shohin;
FROM ShohinSum;

能够实现同样功能的子查询如下:
--直接在FROM子句中使用定义视图的SELECT语句

SELECT shohin_bunrui,count(*)
FROM (SELECT shohin_bunrui COUNT(*) AS cn_shohin
	FROM Shohin
	GROUP BY Shohin_bunrui) AS ShohinSum

特定的SQL
	在Oracle的FROM语句中,不能使用 AS(会发生错误).因此,在Oracle中执行上面的代码时,需要将 ") AS ShohinSum;" 变成 ") ShohinSum;"
```

上面的两种方法得到的结果完全相同
衣服	2
办公用品	2
厨房用具	4

如上所示,子查询就是将用来定义视图的SELECT语句直接用于FROM子句当中.虽然"AS ShohinSum" 就是子查询的名称,但由于该名称是一次性的,因此不会像视图那样保存于存储节制(硬盘)之中,而是在SELECT语句执行后就消失了.子查询(Subquery)就是次级(subordinated) 查询(query).

实际上,该SELECT语句包含嵌套的(括号内的)结构,首先会执行FROM子句中的SELECT语句,然后才会执行外层的SELECT语句.

- 法则5-6: 子查询作为内层查询会首先执行.

#### 增加子查询的层数

由于子查询的层数,原则上没有限制,因此可以像"子查询的FROM子句中还可以继续使用子查询,该子查询的FROM子句中还可以再使用子查询..."这样无限嵌套下去.
```
SELECT shohin_bunrui,cnt_shohin
FROM(SELECT *
	FROM(SELECT shohin_bunrui,COUNT(*) AS cnt_shohin
	 FROM Shohin
	 GROUP BY shohin_bunrui) AS ShohinSum
	 WHERE cnt_shohin = 4) AS ShohinSum2;

执行结果如下:
厨房用具	4
```
最内层的子查询(ShohinSum)与之前一样,根据商品种类(Shohin\_bunrui)对数据进行聚合,其外层的子查将商品数量(cnt\_shohin)限定为4,结果就得到了1行厨房用具的数据.
但是随着子查询嵌套层数的增加,SQL语句会变得越来越难读懂,性能也会越来越差.因此,请避免使用多层嵌套的子查询.

#### 子查询的名称
之前的例子中我们给子查询设定了"ShohinSum"等名称.原则上子查询必须设定名称,因此请大家尽量从处理内容的角度出发为子查询设立恰当的名称.在上述例子中,子查询用来对Shohin表的数据进行汇集,因此我们使用了后缀Sum作为其名称.
为子查询设立名称时需要使用AS关键字,该关键字_有时(在ORACLE中)_也可以省略,为了规范最好还是打上.

#### 标量子查询
接下来我们学习子查询中的标量子查询(Scalar subquery),可以理解为excel表格中的一个单元格里的值

#### 什么是标量
标量就是单一的意思,在数据库之外的领域也经常用到.
上面我们学习的子查询基本上都会返回多行结果(虽然偶尔也会只返回一行数据).由于结构和表相同,所以也会有查询不到结果的情况.
而标量子查询则有一个特殊的限制,那就是__必须且只能返回1行1列的结果.__也就是返回表中某一行的某一列的值,如"10"或者"北京"这样的值.

- 法则5-7: 标量子查询就是返回单一值的查询

细心的读者可能会发现,由于返回的是单一的值,因此标量子查询的返回值可以用在 = 或者<> 这样需要单一值的比较运算符之中.这也正是标量子查询的优势所在.下面我们就来试试

#####在WHERE子句中使用标量子查询
在前面章节中,我们练习了通过各种各样的条件从Shohin(商品)表中读取数据.大家有没有想过通过下面这样的条件查询数据呢?

_"查询出销售单价高于平均单价的商品"_

或者说想知道价格处于上游的商品时,也可以通过上述条件进行查询.
然而这并不是用普通方法就能解决的.如果我们用像下面这样的函数就会出错
```
//错误代码;失败的查询
SELECT shohin_id,shohin_mei,hanbai_tanka,
 FROM Shohin
WHERE hanbai_tanka > AVG(hanbai_tanka);
```
虽然这样的SELECT语句看上去能满足我们的要求,但是由于在WHERE子句中不能使用聚合函数,因此这样的SELECT语句是错误的.
这时候标量子查询就可以发挥它的功效了.首先,如果想要求出Shohin表中商品的平均销售单价(hanbai_tanka),可以使用下面的SELECT语句
```
SQL语句:
SELECT AVG(hanbai_tanka)
FROM Shohin
执行结果
2097.5
```
不难发现,上面的SELECT语句的查询结果是单一的值(2907.5).因此,我们可以直接将这个结果用到之前失败的查询中;正确的代码如下:
```
//正确语句:
SELECT shohin_id,shohin_mei,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka > (SELECT AVG(hanbai_tanka) 
					FROM shohin);
执行结果:
0003	运动T恤	4000
0004	菜刀	3000
0005	高压锅	6800
```
使用子查询的SQL会从子查询开始执行(可以理解为括号优先权)

#### 标量子查询的书写位置
标量子查询的书写位置并不仅仅局限于WHERE子句中,通常任何可以使用单一值的位置都可以使用.也就是说__能够使用常数或者列名的地方,无论是SELECT子句、GROUP BY 子句、HAVING子句、还是ORDER BY子句,几乎所有地方都可以使用
例如,在SELECT子句当中使用之前计算平均值的标量子查询的SQL语句,如下所示:
```
// 在SELECT子句中使用标量子查询
SELECT shohin_id,shohin_mei,hanbai_tanka,(SELECT  AVG(hanbai_tanka) FROM shohin) AS avg_tanka
FROM shohin;
执行结果
shohin_id,shohin_mei,hanbai_tanka,avg_tanka
0001	T恤	1000	2097.5
0002	打孔器	500	2097.5
0003	运动T恤	4000	2097.5
0004	菜刀	3000	2097.5
0005	高压锅	6800	2097.5
0006	叉子	500	2097.5
0007	擦菜板	880	2097.5
0008	圆珠笔	100	2097.5
```
我们还可以在HAVING子句中使用标量子查询
```
//在HAVING子句中使用标量子查询
SELECT Shohin_bunrui,AVG(hanbai_tanka)
FROM Shohin
GROUP BY shohin_bunrui
HAVING AVG(hanbai_tanka) > (SELECT AVG(hanbai_tanka) 
							FROM shohin);
//执行结果
Shohin_bunrui,avg
衣服	2500
厨房用具	2795
```
该查询的含义是想要选取出按照商品种类计算出销售单价高于全部商品的平均销售单价的种类.如果在SELECT语句中不使用HAVING子句的话,那么平均销售单价为300元的办公用品也会被选取出来.但是,由于全部商品的平均销售单价是2097.5元.因此低于该平均值的办公用品会被HAVING子句中的条件排除在外.

### 使用标量子查询的注意事项
__标量子查询绝对不能返回多行结果.__也就是说如果子查询返回了多行结果,那么它就不再是标量子查询,而仅仅是一个普通的子查询了.因此不能被用在=或者<>等需要一个输入值的运算符当中,也不能用在SELECT等子句当中.
```
//例如,下面的SELECT子查询会出错
//由于不是标量子查询,因此不能在SELECT子句中使用
SELECT Shohin_id,shohin_mei,hanbai_tanka.(SELECT AVG(hanbai_tanka)
											FROM Shohin
											GROUP BY shohin_bunrui) AS avg_tanka
FROM Shohin;		
/*执行结果:
报错提示: ERROR: more than one row returned by a subquery used as an expression
		标量子查询中使用了返回的多行结果的表达式*/
```
发生错误的原因很简单,就是因为子查询返回如下的结果:
衣服	2500
办公用品	300
厨房用具	2795

在一行子句之中当然不能使用3行数据.因此,上述SELECT语句会返回"因子查询反悔多行数据所以不能执行"这样的错误信息.

### 5-3 关联子查询

#### 普通子查询和关联子查询的区别
按此前所学,使用子查询就能取出销售单价(hanbai_tanka)高于全部商品平均销售单价的商品.这次我们稍微改变一下条件,选取出各商品分类中高于该分类的平均单价的商品

##### 按照商品分类与平均销售单价进行比较
只通过语言描述可能难以理解,还是让我们看看具体示例,我们以厨房用具中的商品为例,该分组中包含了4中商品:
商品名称	单价
菜刀	3000
高压锅	6800
叉子	500
擦菜板	880

因此上述4种商品的平均价格为 (3000+6800+500+880)÷4=2795(元)

这样,我们就得治该分组内高于平均价格的商品就是菜刀和高压锅了,这两种商品就是我们要选取的对象

同样我们可以得出衣服分组平均价格为2500元,要选取的对象为运动T恤;办公用品的平均销售单价为300元,打孔器就是我们要选取的对象.

这样大家就知道我们应该进行什么样的操作了,__我们并不是要以全部商品为基础,而是要以细分的组为基础,对组内商品的平均价格和各商品的销售单价进行比较.

按照商品种类计算平均价不是什么难事,计算份额方法我们学过,使用GROUP BY方法即可
```
SELECT AVG(hanbai_tanka)
FROM Shohin
GROUP BY shohin_bunrui;
```
但是,如果我们使用前一节(标量子查询的)方法,直接把上述SELECT语句使用到WHERE子句当中的话,就会发生错误.
```
//错误的代码:
SELECT Shohin_id,shohin_mei,hanbai_tanka
FORM Shohin
WHERE hanbai_tanka > (SELECT hanbai_tanka
						FROM Shohin
						GROUP BY Shohin_bunrui);
// 执行结果:报错[21000] ERROR: more than one row returned by a subquery used as an expression
标量子查询中使用了返回的多行结果的表达式
```
这里我们就需要使用关联子查询了.

##### 使用关联子查询的解决方案
只需要在上面的SELECT语句中追加一行,就能得到我们想要的结果了.
```
//正确代码:
SELECT Shohin_mei,hanbai_tanka
FROM Shohin AS S1	-- 为表Shohin创建一个别名S1
WHERE  hanbai_tanka > (SELECT AVG(hanbai_tanka)
						FROM Shohin AS S2  --为子查询中的表Shohin创建一个别名S2
//该条件就是成功的关键 →	WHERE S1.shohin_bunrui = S2.shohin_bunrui	
						GROUP BY shohin_bunrui);
//执行结果:
打孔器	500
运动T恤	4000
菜刀	3000
高压锅	6800
```
这样我们就能选取出办公用具、衣服和厨房用具三类商品中高于该类商品平均单价的商品了.

这里起到关键作用的就是__在子查询中添加的WHERE子句的条件.__该条件的意思就是___在同一(=的作用)商品种类中对各商品的销售单价和平均单价进行比较.___

- 法则5-8 在细分的组内进行比较时,需要使用关联子查询 

#### 关联子查询也是用来对集合进行切分的
换个角度来看,其实关联子查询也和GROUP BY子句一样,可以对集合进行切分,下图显示了最为记录集合的表是如何按照商品种类被切分的.

![](http://kfdown.a.aliimg.com/kf/HTB1QK3FNVXXXXcuXXXXq6xXFXXXr/126425022/HTB1QK3FNVXXXXcuXXXXq6xXFXXXr.jpg)

我们需要计算各个商品分类中商品的平均销售单价,由于该单价会用来和商品表中的个条记录进行比较,因此关联子查询实际只能返回一行结果.这也是关联子查询不出错的关键.关联子查询执行时,DBMS内部的执行结果如下图:

![](http://kfdown.a.aliimg.com/kf/HTB1f03rNVXXXXcxXFXXq6xXFXXXT/126425022/HTB1f03rNVXXXXcxXFXXq6xXFXXXT.jpg)

如果商品种类发生了变化,那么用来进行比较的平均单价也会发生变化,这样就可以将各种商品的销售单价和平均单价进行比较了.关联子查询的内部执行结果对于初学者来说是比较难以理解的,但是像上图这样将其内部执行结果可视化,理解起来就非常容易了.

#### 结合条件一定要写在子查询中
SQL初学者在使用关联子查询时经常犯一个错误,那就是将关联条件写在子查询之外的外层查询之中.比如下面的SELECT语句:
```
//错误的语句
SELECT shohin_bunrui,shohin_mei,hanbai_tanka
FROM shohin AS S1
//错误的地方	WHERE S1.shohin_bunrui = S2.shohin_bunrui
AND hanbai_tanka > (SELECT AVG(hanbai_tanka)
					FROM shohin AS S2
					GROUP BY shohin_bunrui);
// 报错: [42P01] ERROR: missing FROM-clause entry for table "s2" 位置：89
```
上述SELECT 语句只是将子查询中的关联条件已到了外层查询之中,并未添加任何更改.但是该SELECT语句会发生错误,不能正确执行.允许存在这样的书写方法可能并不奇怪,但是SQL的规则禁止这样书写方法.
## 第六章 函数、谓词、CASE表达式
### 6-1 各种各样的函数
#### 函数的种类
前几章 我们学习了SQL的语法结构等必须要遵守的规则.本章将会进行一点改变,来学习一些SQL自带的便利工具→函数.
所谓函数,就是输入某一值得到相应输出结果的功能.输入值称为___参数(Parameter)___,输出值称为___返回值___.
函数大概分为一下几种.

- 算数函数(用来进行数值计算的函数)
- 字符串函数(用来进行字符串操作的函数)
- 日期函数(用来进行日期操作的函数)
- 转换函数(用来进行转换数据类型和值的函数)
- 聚合函数(用来进行行数聚合的函数)

我们前面已经学习了聚合函数的相关内容,应该对函数有初步的了解.聚合函数基本上只包含了COUNT、SUM、AVG、MAX、MIN这5种,而其他种类的函数总数可以轻松超过200种,虽然数量众多,但常用函数只有30-50种,不熟系的我们可以通过参考文档进行查询.
本节我们会学习一些具有代表性的函数.并不需要一次全部记住,只要知道有这样的函数就可以了.实际应用时可以通过参考文档进行查询.接下来,将会按照英文字母的顺序,分类介绍这些函数.

#### 算数函数
算数函数是最基本的函数,我们之前已经学习过了,就是前面的加减乘除四则运算

- + (加法)
- - (减法)
- × (乘法)
- ÷ (除法)

由于这些算数运算符具有"根据输入值返回相应输出结果"的功能,所以它们是出色的算数函数.在此我们将会给大家介绍除此之外的具有代表性的函数.
为了学习算数函数,我们先根据下面的代码创建一张示例表(SampleMath),在创建示例之前,我们先介绍一下 Numeric数据类型,NUMERIC数据类型是大多数DBMS都支持的一种数据类型,通过NUMERIC(全体位数,小数位数)的形式来指定数值大小.截下来,将会给大家介绍常用的算数函数→ROUND函数,由于PostgreSQL中的ROUND函数只能使用NUMERIC类型的数据,因此我们在示例中也使用了该数据类型.
```
-- DDL:创建表:
CREATE TABLE SampleMath(
m NUMERIC (10,3),
n INTEGER,
p INTEGER);

-- DML:插入数据:
BEGIN TRANSACTION;

INSERT INTO SampleMath(m,n,p) VALUES(500,0,Null);
INSERT INTO SampleMath(m,n,p) VALUES(-180,0,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(NULL,NULL,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(NULL,7,3);
INSERT INTO SampleMath(m,n,p) VALUES(NULL,5,2);
INSERT INTO SampleMath(m,n,p) VALUES(NULL,4,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(8,NULL,3);
INSERT INTO SampleMath(m,n,p) VALUES(2.27,1,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(5.555,2,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(NULL,1,NULL);
INSERT INTO SampleMath(m,n,p) VALUES(8.76,NULL,NULL);
COMMIT;
```
下面让我们确认一下创建好的表中的内容.其中应该包含了m,n,p三列
```
SELECT * FROM SampleMath

执行结果:
500.000	0	
-180.000	0	
		
	7	3
	5	2
	4	
8.000		3
2.270	1	
5.555	2	
	1	
8.760		
```
##### 绝对值
```
代码格式:
ABS(数值)
```

ABS是计算绝对值的函数.绝对值(ABSOLUTE VALUE) 就是不考虑数值的符号,表示一个数到远点距离的数值.简单来说绝对值的计算方法就是:0和证书的绝对值是其本身,负数的绝对值就是去掉负号后的结果.
```
示例:

SELECT m,
	ABS(m) AS abs_col
	FROM SampleMath;

执行结果:
m		abs_col
500.000	500
-180.000	180
	
	
	
	
8.000	8
2.270	2.27
5.555	5.555
	
8.760	8.76
```
上述执行结果中右侧的abs_col列就是通过ABS函数计算出的m列的绝对值.请注意-180的绝对值就是去掉负号后的结果180.
通过上述结果我们可以发现,ABS函数的参数为NULL是,结果也是NULL.并非只有ABS函数如此,绝大多数函数对于NULL的结果都是NULL(___转换函数COALESCE___).

##### MOD函数
```
函数格式:
MOD(被除数,除数)
```

MOD是计算除法余数(剩余)的函数,是modulo的简称.例如,7/3的余数是1,因此MOD(7,3)的结果也是1,由于小数计算中并没有余数的概念,所以只能对整数类型的列使用MOD函数.
```
计算除法(n÷p)的余数
SELECT n,p,
	MOD(n,p) AS mod_col
	FROM SampleMath;
执行结果:
n	p	mod_col
0		
0		
		
7	3	1
5	2	1
4		
	3	
1		
2		
1		
范例:mod_col: MOD(n,p) 的返回值(n÷p的余数)
```
___特殊的SQL___
SQL SERVER使用特殊的运算符"%" 来计算余数.使用下面的语句可以得到与上面语句同样的结果:
```
-- SQL SERVER语句:
SELECT n,p,
	n % p AS mod_col
	FROM SampleMath;
```
##### ROUND 四舍五入
```
ROUND 函数的语法:
ROUND(对象数值,保留小数的位数)
```
ROUND函数用来进行四舍五入操作,四舍五入在英语中称为ROUND.
如果指定四舍五入的位数为1,那么对小数点第二位进行四舍五入
案例:对m列的数值进行n列位数的四舍五入处理
```
SELECT m,n,		//m是对象数值,n是四舍五入位数
	ROUND(m,n) AS round_col
	FROM SampleMath;
执行结果:
m		n	round_col
500.000	0	500
-180.000	0	-180
		
	7	
	5	
	4	
8.000		
2.270	1	2.3
5.555	2	5.56
	1	
8.760		
```
#### 字符串函数
到目前为止,我们学习的都是针对数值的算数函数,但其实算数函数只是SQL(其他编程语言通常也是如此)自带函数中的一部分.虽然算数函数是我们经常使用的函数,但是字符串函数也是同样经常被使用
在日常生活中,我们经常会像使用数字那样对字符串进行替换,截取,简化等操作.因此SQL也为我们提供了很多操作字符串的功能.
为了学习字符串函数,我们再来创建一张表(SampleStr)
```
-- DDL:创建表
CREATE TABLE SampleStr(
str1 VARCHAR(40),
str2 VARCHAR(40),
str3 VARCHAR(40));

--DML:插入数据:
BEGIN TRANSACTION;

INSERT INTO SampleStr (str1,str2,str3) VALUES ('opx','rt',NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('abc','def',NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('山田','太浪','傻货');
INSERT INTO SampleStr (str1,str2,str3) VALUES ('aaa',NULL,NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES (NULL,'xyz',NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('@!#$%',NULL,NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('ABC',NULL,NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('aBC',NULL,NULL);
INSERT INTO SampleStr (str1,str2,str3) VALUES ('abc太郎','abc','ABC');
INSERT INTO SampleStr (str1,str2,str3) VALUES ('abcdefabc','abc','ABC');
INSERT INTO SampleStr (str1,str2,str3) VALUES ('micmic','i','I');

COMMIT;

查看创建好的表中的内容: SELECT * FROM SampleStr

执行结果:
str1	str2	str3
opx	rt	
abc	def	
山田	太浪	傻货
aaa		
	xyz	
@!#$%		
ABC		
aBC		
abc太郎	abc	ABC
abcdefabc	abc	ABC
micmic	i	I
```
##### 拼接
```
拼接函数语法格式:
字符串1||字符串2
```

在实际业务中,我们经常会碰到abc+de=abcde 这样希望将字符串进行拼接的情况.在SQL中,可以通过两条并列的竖线变换成的"||"函数来实现
案例:拼接两个字符串
```
-- Oracle,DB2,Postgresql
SELECT str1,str2
	str1||str2 AS str_concat
FROM SampleStr;

执行结果:
str1  str2   str_concat 
opx	rt	opxrt
abc	def	abcdef
山田	太浪	山田太浪
aaa		
	xyz	
@!#$%		
ABC		
aBC		
abc太郎	abc	abc太郎abc
abcdefabc	abc	abcdefabcabc
micmic	i	micmici
```
进行特殊字串拼接时,如果其中包含NULL,那么得到的结果也是NULL这是因为"||"也是变了形的函数.当然,三个以上的字符串也可以进行拼接
```
三个字符串拼接:
SELECT str1,str2,str3,
str1||str2||str3 AS str_concat
FROM SampleStr
WHERE str1='山田';

执行结果:
str1	str2	str3	str_concat
山田	太浪	傻货	山田太浪傻货
```
___请注意,||拼接函数在SQL SERVER和MySQL中无法使用___
```
特定的SQL:
SQL Server:使用"+"运算符(函数)来链接字符串.
SELECT str1,str2,str3.
str1+str2+str3 AS str_concat
FROM SampleStr;

MySQL使用Concat函数来完成字符串的拼接.
SELECT str1,str2,str3
CONCAT(str1,str2,str3) AS str_concat
FROM SampleStr;
```

##### LENGTH 字符串长度

想知道字符串中包含多少歌字符时,可以使用LENGTH(长度)函数
```
Length 函数格式:
LENGTH 格式:
Oracle,DB2,PostgreSQL,MySQL:
SELECT str1,
LEGTH(str1) AS len_str
FROM SampleStr;

执行结果:
str1 len_str
opx	3
abc	3
山田	2
aaa	3
	
@!#$%	5
ABC	3
aBC	3
abc太郎	5
abcdefabc	9
micmic	6
```
___需要注意的是,该函数也无法在SQL Server中使用___
```
特定的SQL
	SQL Server使用LEN函数来计算字符串的长度,具体如下:
	SELECT str1,
	LEN(str1) AS len_str
	FROM SampleStr;
```
##### LOWER 小写转换
```
函数格式: LOWER(字符串)
```
LOWER函数只能针对英文字母使用,它会将参数中的字符串全部转换为小写.因此该函数不适合英文字母意外的场合.此外,该函数并不影响原本就是小写的字符
```
案列:
SELECT str1,
LOWER(str1) AS low_str
FROM SampleStr
WHERE str1 IN ('ABC','aBc','abc','山田');	//IN 是指前面的对象是后面参数中的一种即符合条件
```
既然存在小写转换函数,那么肯定也有大写转换函数,UPPER就是大写转换函数.

##### REPLACE 字符串的替换
```
REPLACE函数的语法格式:
REPLACE (对象字符串,替换前的字符串,替换后的字符串)
```
使用REPLACE函数,可以将字符串的一部分替换为其他的字符串
```
案例:替换字符串的一部分
SELECT str1,str2,str3,
REPLACE(str1,str2,str3) AS rep_str
FROM SampleStr;

执行结果:
str1 str2 str3 rep_str
opx	rt		
abc	def		
山田	太浪	傻货	山田
aaa			
	xyz		
@!#$%			
ABC			
aBC			
abc太郎	abc	ABC	ABC太郎
abcdefabc	abc	ABC	ABCdefABC
micmic	i	I	mIcmIc
```
##### SUBSTRING字符串的截取
```
函数语法:
SUBSTRING (对象字符串 FROM 截取的起始位置 FOR 截取的字符数)
```
使用SUBSTRING函数可以截取出字符串中的一部分字符串.截取的起始位置从字符串最左侧开始计算.
```
案例:截取字符串中第三位和第四位字符:
PostgreSQL和MySQL:
SELECT str1,
SUBSTRING (str1,FROM 3 FOR 2) AS sub_str
FROM SampleStr;

执行结果:
str1 sub_str
opx	x
abc	c
山田	
aaa	a
	
@!#$%	#$
ABC	C
aBC	C
abc太郎	c太
abcdefabc	cd
micmic	cm
```
虽然上述SUBSTRING函数的语法是标准SQL承认的正式语法,但是现在只有PostgreSQL和MySQL支持该语法.
```
特定的SQL
SQL Server专用语法:	SUBSTRING(对象字符串,截取的起始位置,截取的字符数)
Oracle/DB2专用语法: SUBSTR(对象字符串,截取的起始位置,截取的字符数)
```
##### UPPER函数:大写切换
```
语法结构:UPPER(字符串)
```
UPPER函数只能针对英文字母使用,它会将参数中的字符串全都转换成大写.因此该函数并不适用于英文字母以外的情况.此外,该函数并不影响原本就是大写的字符.
```
SELECT str1,
	UPPER(str1) AS up_str
	FROM SampleStr
	WHERE str1 IN ('ABC','aBC','abc','山田' );
执行结果:
abc	ABC
山田	山田
ABC	ABC
aBC	ABC
```
#### 日期函数
虽然SQL中有很多日期函数,但是其中大部分都依存于格子的DBMS,因此无法进行统一的说明.本届我们将学习那些被标准SQL承认,可以应用于大多数DBMS的函数.
##### CURRENT_DATE函数
CURRENT_DATE函数能够返回SQL执行的日期,也就是改函数执行时的日期.由于没有参数,所以无需使用括号.
执行日期不同,CURRENT_DATE函数的返回值也不同,如果在2009年12月13日执行该函数,会得到返回值"2009-12-13".如果在2010年1月1日执行,就会得到返回值"2010-01-01"

```
-- PostgreSQL MySQL
SELECT CURRENT_DATE

2016年11月11日执行该函数的结果:
date
----------
2016-11-11
```
##### CURRENT_TIME
CURRENT_TIME函数能够取的SQL执行的时间,也就是该函数执行时的时间,由于该函数也没有参数,所以同样无需使用括号.
```
--postgresql mysql

SELECT CURRENT_TIME

执行结果:
22:23:22 
```
该函数同样___无法在SQL Server中执行,在Oracle和DB2中的语法同样略有不同___.
#####  CURRENT_TIMESTAMP函数
CURRENT\_TIMESTAMP函数同时具有CURRENT\_DATE+CURRENT\_TIME的功能.使用该函数可以同时得到当前的日期和时间,当然也可以从结果中截取日期或者时间.
```
取得当前日期和时间
SELECT CURRENT_TIMESTAMP
执行结果:
	now
-------------
2016-11-11 22:49:50.970661
```

#####  EXTRACT截取日期元素
```
语法结构:
EXTRACT(日期元素 FROM 日期)
```
使用EXTRACT函数可以截取出日期数据中的一部分,例如"年"、"月"、"日"或者"小时"、"秒"等等,改函数的返回值并不是日期类型而是数值类型
案例:截取日期元素
```
SELECT  CURRENT_TIMESTAMP
		EXTRACT(YEAR FROM CURRENT_TIMESTAMP) AS year,
		EXTRACT(MONTH FROM CURRENT_TIMESTAMP) AS month,
		EXTRACT(DAY FROM CURRENT_TIMESTAMP) AS day,
		EXTRACT(HOUR FROM CURRENT_TIMESTAMP) AS hour,
		EXTRACT(MINUTE FROM CURRENT_TIMESTAMP) AS minute,
		EXTRACT(SECOND FROM CURRENT_TIMESTAMP) AS second;
执行结果:
			now				year  month day hour min second		
2016-11-13 12:20:11.801396	2016	11	13	12	20	11.801396
```
#### 转换函数
最后我们要学习一类比较特殊的函数--> 转换函数.虽说有些特殊,但是由于这些函数的语法和之前介绍的语法类似,数量也比较少,因此很容易记忆.
"转换"这个词的含义非常广泛,在SQL中主要有两层意思.一是___数据类型的转换___,简称"___类型转换___",在英语中称为cast.另一层意思是___值的转换___.
##### CAST--> 类型转换
```
CAST语法结构:
CAST(转换前的值 AS 想要转换的数据类型)
```
进行类型转换需要使用CAST函数
之所以需要进行数据类型转换,是因为可能会插入与表中数据类型不匹配的数据,或者在进行运算时,由于数据类型不一致发生了错误,又或者是进行自动类型转换造成了处理速度的低下.这些时候都需要事前进行数据类型转换.

```
案例:将字符串类型转换为数据类型
SELECT CAST('0001' AS INTEGER) AS int_col;
执行结果:
int_col
-------
	1
```

将字符串类型转换为日期类型
```
语句: SELECT CAST('2009-12-14' AS DATE) AS date_col;
执行结果:
date_col
 ------
2009-12-14
```
从上述结果可以看到,将字符串类型转换为证书类型时,去掉前面的"000"之后就可以转换为证书了.但是将字符串转换为日期类型时,从结果并不能看出数据发生了什么变化,理解起来也比较困难.从中我们也可以看出,类型转换其实并不是为了方便用户使用而开发的功能,而是为了方便DBMS内部处理而开发的功能.
##### COALESCE-->将NULL转换为其他值
```
语法结构:
COALESCE(数据1,数据2,数据3...)
```

COALESCE 函数是SQL特有的函数.该函数会返回可变参数(参数的个数并不固定,可以自由设定个数的参数)中左侧开始第一个不是NULL的值.参数个数是可变的,因此可以根据需要无限增加.
其实转换函数的使用还是非常频繁的.在SQL语句中将NULL转换为其他值时就会用到转换函数.就像之前我们学习的那样,运算或者函数中含有NULL时,结果全都会变成NULL.能够避免这种结果的函数就是COALESCE
```
案列: 将NULL转换为其他值
SELECT COALESCE(NULL, 1)	AS col_1,
 COALESCE(NULL,'test',NULL) AS col_2,
 COALESCE(NULL,NULL,'2009-11-01') AS col_3;
执行结果:
col_1	col_2	 col_3
  1		test	2009-11-01
```
我们再使用SampleStr中的列举例
```
SELECT COALESCE(str2,'Null')
FROM SampleStr;
执行结果:	//其实就是用'NULL' 来替换掉NULL
COALESCE
-------
rt
def
太浪
'Null'
xyz
'NULL'
'NULL'
'NULL'
abc
abc
i
```
这样,即使包含NULL的列,也可以通过COALESCE 函数转换为其他值之后再应用到函数或者运算当中,这样就不会再是 NULL了.
### 6-2谓词
#### 什么是谓词
本节我们将学习SQL的抽出条件中不可或缺的工具-->谓词(predicate).虽然之前我们没有提及谓词这个概念,但其实我们已经使用过了.如,=、<、>、<>等比较运算符,其正式名称就是比较谓词.
谓词,通俗来讲就是6-1节中介绍的函数中的一种,是需要满足特定条件的函数.该条件就是"___返回值是真值___".对通常的函数来说,返回值有可能是数字、字符串或者日期等等,但是谓词的返回值全都是真值(TRUE/FALSE/UNKNOWN),这也是谓词和函数的最大区别.
本节将会介绍一下谓词

- LIKE
- BETWEEN
- IS NULL,IS NOT NULL
- IN
- EXISTS

#### LIKE谓词-->字符串的部分一致查询
截止目前,我们使用字符串作为查询条件的例子中,使用的都是=.这里的 = 只有在字符串完全一致时才为真.与之襄樊,___LIKE谓词___更加模糊一些,当需要进行字符串的___部分一致查询___时需要使用该谓词.
部分一致大体可以分为前方一致、中间一致和后方一致三种类型.截下来我们一起看看具体示例.

首先创建一张SampleLike表
```
CREATE TABLE SampleLike
( strcol VARCHAR(6) NOT NULL,
 PRIMARY KEY (strcol));
BEGIN TRANSACTION;

INSERT INTO SampleLike (strcol) VALUES ('abcddd');
INSERT INTO SampleLike (strcol) VALUES ('dddabc');
INSERT INTO SampleLike (strcol) VALUES ('abcdd');
INSERT INTO SampleLike (strcol) VALUES ('ddabc');
INSERT INTO SampleLike (strcol) VALUES ('abddc');

COMMIT;
```
创建完成的表如下:
```
strcol
------
abcddd
dddabc
abcdd
ddabc
abddc
```
想要从表中读取出包含字母"ddd"的记录时,可能会得到前方一致、中间一致、和后方一致等不同的结果.

* __前方一致:选取出"dddabc"__
  所谓前方一致,就是选出作为查询条件的字符串(这里是"ddd")与查询对象字符串起始部分相同的记录的查询方法.
* __中间一致:选取出"abcddd"、"dddabc"、"abdddc"__
  所谓中间一致,就是选取出查询对象字符串中含有作为查询条件的字符串(这里是"ddd")的记录的查询方法.无论该字符串出现在对象字符串的最后还是中间都没关系.
* __后方一致:选取出"abcddd"__
  后方一致与前方一致相反,也就是选取出作为查询条件的字符串(这里是"ddd")

##### 进行前方一致查询
```
使用LIKE进行前方一致查询:
SELECT *
 FROM SampleLike
WHERE strcol LIKE 'ddd%';
执行结果:
strcol
 ---
dddabc
```
___其中的"%" 是代表"0字符以上的任意字符串"的特殊符号.本例中代表"以ddd开头的所有字符"___
这样我们就可以用LIKE和模式匹配来进行查询了.
##### 中间一致查询
接下来我们看一个中间一致的例子,查询出包含字符串"ddd"的记录
```
SELECT *
 FROM SampleLike
WHERE strcol LIKE '%ddd%';
执行结果:
strcol
------
abcddd
dddabc
abdddc
```
在字符串的起始和结束位置加上%,就能取出"包含ddd的字符串"了.
##### 最后一致查询
最后我们来看一下后方一致查询,选取出以字符串"ddd"结尾的记录
```
SELECT *
FROM SampleLike
WHERE strcol LIKE '%ddd';
执行结果:
strcol
------
abcddd
```
通过上述结果我们可以发现前方一致和后方一致正好相反.
此外,我们还可以使用\_(下划线)来代替%,与%不同的是其代表了"任意1个字符",比如下面的案例
```
选取出strcol列的值为"abc+任意两个字符"的记录
SELECT *
 FROM SampleLike
WHERE strcol LIKE 'abc__';
执行结果为:
strcol
------
abcdd
```
"abcddd"也是以"abc"开头的字符串,但其中的"ddd"是3个字符,所以不满足__所指的2个字符的条件.因此该字符串并不在查询结果之中.
#### BETWEEN谓词-->范围查找
使用BETWEEN可以进行范围查询.该谓词与其他谓词或者函数的不同之处在于它使用了3个参数.例如从shohin表中读取出销售单价(hanbai_tanka)为100日元到1000日元之间的商品时,可以使用下面的代码
```
SELECT Shoin_mei,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka BETWEEN 100 AND 1000;
执行结果:
shohin_mei	hanbai_tanka
------------------------
T恤	1000
打孔器	500
叉子	500
擦菜板	880
圆珠笔	100
```
BETWEEN的特点是结果中会包含100和1000这两个临界值.如果不想让结果中包含临界值,那就必须使用<和>,如下面的代码
```
选取出销售单价为101-999日元的商品
SELECT shohin_mei,hanbai_tanka
FROM Shohin
WHERE hanbai_tanka >100 
AND hanbai_tanka <1000;
执行结果:
shohin_mei	hanbai_tanka
------------------------
打孔器	500
叉子	500
擦菜板	880
```
执行结果中不再包含100和1000
#### IS NULL、IS NOT NULL --> 判断是否为NULL
为了选取出某些值为NULL的列的数据,不能使用=,而只能使用特定的谓词IS NULL,如下:
```
选取出进货单价为NULL的商品
SELECT shohin_mei,shiire_tanka
FROM Shohin
WHERE shiire_tanka IS NULL;
执行结果:
shohin_mei	shiire_tanka
----------+-------------
叉子	  |	
圆珠笔	  |
```
与此相反,想要选取NULL以外的数据时,需要使用IS NOT NULL,代码如下:
```
选取进货单价(shiire_tanka)不为NULL的商品
SELECT shohin_mei,shiire_tanka
FROM Shohin
WHERE shiire_tanka IS NOT NULL;
执行结果:
shohin_mei	shiire_tanka
----------+-------------
T恤		  |		500
打孔器	  |		320
运动T恤	  |		2800
菜刀	  |		2800
高压锅	  |		5000
擦菜板	  |		790
```
#### IN谓词-->OR的简便用法
截下来我们思考一下如何选取出进货单价(shiire_tanka)为320元、500元、5000元的商品时.我们可以之前学过OR的用法,代码如下
```
通过OR指定多个进货单价进行查询:
SELECT shohin_mei,shiire_tanka
FROM Shohin
WHERE shiire_tanka = 320
OR shiire_tanka = 500
OR shiire_tanka = 5000;
执行结果:
shohin_mei	shiire_tanka
----------+-------------
T恤		  | 	500
打孔器	  | 	320
高压锅	  | 	5000
```
虽然上述方法没有问题,但是存在一点不足支出,那就是随着希望选取的对象越来越多,SQL语句也会越来越长,阅读起来也会越来越困难.这是我们就可以使用__IN谓词__"IN (值1,值2...)"来替换上述的语句
```
通过IN 来指定多个进货单价进行查询:
SELECT shohin_mei,shiire_tanka
FROM Shohin
WHERE shiire_tanka IN ( 320, 500, 5000);
执行结果:
shohin_mei	shiire_tanka
----------+-------------
T恤		  | 	500
打孔器	  | 	320
高压锅	  | 	5000
```
反之,希望选取出"进货单价不是320元、500元、5000元"的商品时,可以通过__NOT IN__来实现
```
使用NOT IN进行查询时指定多个除外的进货单价进行查询:
SELECT Shohin_mei,shiire_tanka
FROM Shohin
WHERE shiire_tanka NOT IN ( 320, 500, 5000);
执行结果为:
shohin_mei	shiire_tanka
----------+-------------
运动T恤	  |		2800
菜刀	  |		2800
擦菜板	  |		790
```
但需要注意的是,在使用IN和NOT IN时是__无法选取出 NULL数据的__.实际结果也是如此,上述两组结果中都不包含进货单价为NULL的叉子和圆珠笔.NULL终究还是需要使用IS NULL 和IS NOT NULL来进行判断.
#### 使用子查询作为IN谓词的参数
##### IN 和子查询
IN谓词(NOT IN谓词) 具有其他谓词所没有的使用方法.那就是可以使用子查询作为其参数来使用.我们在之前章节中学习了子查询就是SQL内部生成的表.因此也可以说"能够将表作为IN的参数".同理,我们还可以说"能够将视图作为IN的参数".
为了掌握详细的使用方法,让我们再添加一张新表吧.之前我们使用的全部都是显示商品在库一览信息的Shohin(商品)表,但现实中这些商品可能会在个别的商店中进行销售.下面我们创建一个新表显示出哪些商店销售哪些商品的TenpoShohin(商店商品).
表的内容如下:
tenpo\_id(商店)| tenpo\_mei(商店名称)|shohin\_id(商品编号)|suryo(数量)
---|---|---|---|---
000A|东京|0001|30
000A|东京|0002|50
000A|东京|0003|15
000B|名古屋|0002|30
000B|名古屋|0003|120
000B|名古屋|0004|20
000B|名古屋|0006|10
000B|名古屋|0007|40
000C|大阪|0003|20
000C|大阪|0004|50
000C|大阪|0006|90
000C|大阪|0007|70
000D|福冈|0001|100
商店和商品组合成一条记录.例如,该表显示出东京店销售的商品有001(T恤)、002(打孔器)、003(打孔器)三种.
创建该表的代码如下:
```
创建tenpoShohin表的语句:
CREATE TABLE tenpoShohin
(tenpo_id  CHAR(4) NOT NULL,
tenpo_mei  VARCHAR(200) NOT NULL,
shohin_id  CHAR(4) NOT NULL,
suryo INTEGER NOT NULL,
PRIMARY KEY (tenpo_id,shohin_id));
```
上面语句中指定了2列作为主键(primary key).这样做的目的当然还是为了区分表中每一行数据,由于单独使用商店编号(tempo\_mei)或者商品编号(shohin\_mei)不能满足要求,所以需要对商店和商品进行组合.
实际上如果只使用商店编号进行区分,那么指定"000A"作为条件能查出3行数据.而单独使用商品编号进行区分的话,"0001"也会查出两行数据.都无法恰当区分每行数据.
下面我们将向tenpoShohin表中插入数据:
```
BEGIN TRANSACTION;

INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000A','东京','0001',30 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000A','东京','0002',50 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000A','东京','0003',15 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000B','名古屋','0002',30 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000B','名古屋','0003',120 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000B','名古屋','0004',20 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000B','名古屋','0006',10 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000B','名古屋','0007',40 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000C','大阪','0003',20 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000C','大阪','0004',520 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000C','大阪','0006',90 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000C','大阪','0007',70 );
INSERT INTO tenpoShohin (tenpo_id,tenpo_mei,shohin_id,suryO) VALUES ('000D','福冈','0001',100 );

COMMIT;
```
这样我们就完成了全部准备工作,下面我们一起看看IN谓词中使用子查询的SQL写法
首先读取出"大阪店(000C)在售商品(shohin\_id)的销售单价(hanbai\_tanka)"
TenpoShohin(商店商品)表中大阪店的在售商品很容易就能找出,有如下4种:
 * 运动T恤(商品编号:0003)
 * 菜刀(商品编号:0004)
 * 叉子(商品编号:0006)
 * 擦菜板(商品编号:0007)

结果自然也应该是这样:
```
shohin_mei | hanbaitanka
-----------+------------
运动T恤     |        4000
菜刀        |        3000
叉子        |         500
擦菜板      |         880
```
得到上述结果时,我们应该已经完成了如下两个步骤:
1. 从TenpoShohin表中选取出在大阪店(tenpo\_id = '000C')中销售的商品(shohin\_id).
2. 从Shohin表中选取出通过1得到的商品(shohin\_id)的销售单价(hanbai\_tanka).
SQL也是如此,同样要分两步来完成.首先,第一步如下:
```
SELECT shohin_id
FROM TenpoShohin
WHERE tenpo_id = '000C';
```
因为大阪店的商店编号(tenpo_id)是"000C",所以我们可以将其作为条件写在WHERE子句中.截下来,我们就可以把上述的SELECT语句作为第二部中的条件来使用了.
最终得到的SELECT语句如下:
```
读取出"大阪店(000C)在售商品(shohin_id)的销售单价(hanbai_tanka)"
SELECT shohin_mei,hanbai_tanka
FROM Shohin
where Shohin_id IN (SELECT shohin_id 
					FROM TenpoShohin
					WHERE tenpo_id = '000C');
执行结果:
shohin_mei|hanbai_tanka
----------+------------
运动T恤		4000
菜刀		3000
叉子		500
擦菜板		880
```
如第5章所述,子查询是从内层开始执行的.因此该SELECT语句也是从内层和的子查询开始执行,然户像下面这样展开
```
--子查询展开后的结果
SELECT shohin_mei,hanbai_tanka
FROM shohin
WHERE shohin_id IN ('0003','0004','0006','0007');
```
这样就转换成我们之前学习过的IN的用法了,但是很多人可能会产生这样的疑问,既然我们可以用IN谓词可以查到我们为什么还要用子查询呢?
这是因为TenpoShohin(商店商品)表不是不是一成不变的.实际上由于各个商店销售的商品都在不断发生变化,所以TenpoShohin表内大阪店销售的商品也会发生变化.如果SELECT语句中没有使用子查询的话,一旦商品发生了改变,那么SELECT语句也不得不进行修改.而且这样的修改工作会变得没完没了.
反之,如果在SELECT语句中使用了子查询,那么即使数据发生了变更,还可以继续使用同样的SELECT语句,这样也减少了我们的常规作业(单纯的重复操作).
像这样可以完美对数据变更的程序称为"易维护程序",或者"免维护程序".
##### NOT IN和子查询
IN 的否定形式NOT IN同样可以使用子查询作为参数,其语法也和IN完全一样.
```
使用子查询作为NOT IN 的参数
SELECT shohin_mei,hanbai_tanka 
FROM shohin 
WHERE shohin_id NOT IN (select shohin_id 
						FROM TenpoShohin
						WHERE tenpo_id = '000A');
```
上面的代码是要选取的"在东京店(000A)以外销售的商品(shohin\_id)的销售单价(hanbai\_tanka)"."NOT IN"代表了"以外"这样的否定含义.
我们也可看一下该SQL语句的执行步骤.因为还是首先执行子查询,所以会得到一下结果.
```
--执行子查询
SELECT shohin_mei,hanbai_tanka
FROM Shohin
WHERE shohin_id NOT IN ('0001','0002','0003');
```
之后就简单了,上述语句应该会返回0001-0003以外的结果.
```
shohin_mei|hanbai_tanka
----------+------------
菜刀	  |		3000
高压锅	  |		6800
叉子	  |		500
擦菜板	  |		880
圆珠笔	  |		100
```
#### EXIST谓词
本节最后我们圩西一下EXIST谓词.将它放到最后进行学习的原因有3点:

1. EXIST的使用方法与之前的都不同
2. 语法理解起来比较困难
3. 实际上即使不使用EXIST,基本也可以用IN(或者NOT IN)来代替.

理由1和2都说明EXIST是使用方法特殊而难以理解的谓词.特别是使用否定形式NOT EXIST的SELECT语句,即使是DB工程师也常常无法迅速理解.此外,如理由3所述,由于使用IN作为替代的情况非常多(尽管不能完全替代让人有些伤脑筋),很多人虽然记住了使用方法但还是不能实际运用.
但是,如果大家能够熟练使用EXIST谓词的话,就能体会到它极大的便利性.

##### EXIST谓词的使用方法
一言以蔽之,谓词的作用就是"判断是否存在满足某种条件的记录".如果存在这样的记录就返回真(TRUE),如果不存在就返回假(FALSE).EXIST(存在)谓词的主语是记录.
我们继续使用前一节的"IN和子查询"中的示例,使用EXIST选取出"大阪店(000C)在售商品(shohin\_id)的销售单价(hanbai\_tanka)".
```
使用EXIST选取出"大阪店(000C)在售商品(shohin_id)的销售单价(hanbai_tanka)"
SELECT shohin_mei,hanbai_tanka
FROM shohin AS S
WHERE EXISTS (SELECT *
            FROM tenposhohin AS TS
            WHERE TS.tenpo_id = '000C'
            AND S.shohin_id = TS.shohin_id);
执行结果:
shohin_mei|hanbai_tanka
----------+------------
运动T恤	  |    4000
菜刀	  |    3000
叉子	  |    500
擦菜板	  |    880
```
###### EXIST的参数
之前我们学过的谓词,基本都是"列LIKE 字符串" 或者"列BETWEEN值1 AND 值2"这样需要指定2个以上的参数.而EXIST的左侧并没有任何参数.很奇妙吧!这是因为EXIST是只有1个参数的谓词.EXIST只需要在右侧书写一个参数.该参数通常都会是一个子查询.
在这个情况下,
```
(SELECT * 
FROM TenpoShohin AS TS
WHERE TS.tenpo_id = '000C'
AND TS.shohin_id = S.shohin_id)
```
这样的子查询就是唯一的参数.确切地说,由于通过条件"TS.shohin\_id = S.shohin\_id"将Shohin表和TenpoShohin表进行了联接,所以作为参数的是关联子查询.EXIST通常都会使用关联子查询作为参数.

- 法则6-1 通常指定关联子查询作为EXIST的参数.

###### 子查询中的SELECT *
可能我们会觉得子查询中的SELECT * 稍微有些不同,就像我们之前学到的那样,由于EXIST只关心记录是否存在,所以返回哪些列都没有关系.EXIST是用来判断是否存在满足子查询中WHERE子句指定条件"商店编号(tenpo\_id)为'000C',商品(Shohin)表和商店商品(TenpoShohin)表中商品编号(Shohin\_id)相同"的记录,只有存在这样的记录时才返回真(TRUE)的谓词.
因此即使写成下面这样,结果也不会变化
```
写成下面这样,结果也不会变化:
SELECT shohin_mei,hanbai_tanka
FROM shohin AS S
WHERE EXISTS (SELECT 1	//此处可以书写适当的常数
            FROM tenposhohin AS TS
            WHERE TS.tenpo_id = '000C'
            AND S.shohin_id = TS.shohin_id);
```
我们可以把在EXIST的子查询中书写SELECT * 当做SQL的一种习惯.
- 法则6-2 作为EXIST参数的子查询中常会使用SELECT *

###### 使用NOT EXIST替换NOT IN
就像EXIST 可以用来替换IN一样,NOT IN也可以用NOT EXIST来替换.下面就让我们使用NOT EXIST来编写一条SELECT 语句,读取出"东京店(000A)在售之外的商品(Shohin\_id)的销售单价(hanbai\_tanka)"
```
东京店(000A)在售之外的商品(Shohin_id)的销售单价(hanbai_tanka)
SELECT shohin_mei,hanbai_tanka
FROM Shohin AS S
WHERE NOT EXISTS (SELECT *
				 FROM TenpoShohin AS TS
				 WHERE tenpo_id = '000A'
				 AND TS.shohin_id = S.shohin_id);
执行结果:
shohin_mei|hanbai_tanka
----------+------------
菜刀	  |    3000
高压锅	  |    6800
叉子	  |    500
擦菜板	  |    880
圆珠笔	  |    100
```
NOT EXIST与EXIST 相反,当"不存在"满足子查询中指定条件的记录时返回值真(TRUE).
将IN和EXIST的SELECT语句进行比较,会得到怎样的结果呢.可能大家都觉得IN理解起来要容易一些.笔者也认为没有必要勉强使用EXIST.因为EXIST拥有IN所不具有的便利性,严格来说两者并不相同,还是希望我们能掌握这两种谓词的使用方法.
### 6.3 CASE表达式
#### 什么是CASE表达式
本节将要学习的CASE表达式,和"1+1" 或者"120/4" 这样的表达式一样,是一种运行运算的功能.这就以为这CASE表达式也是函数的一种.它是SQL中数一数二的重要功能,希望我们能在这里好好学习和掌握.
CASE表达式,正如CASE(情况)这个次的含义所示,是在区分情况是使用的.这种情况的区分在程序中通常称为"___(条件)分歧___".
#### CASE表达式语法
CASE表达式的语法分为___简单表达式___和___搜索CASE表达式___两种.
但是,由于搜索CASE表达式包含了简单CASE表达式的全部功能,因此本节只会介绍搜索CASE表达式.想要了解简单CASE表达式的话,可以参考本节末尾的"简单表达式"
下面我们就来学习搜索CASE表达式
```
搜索CASE表达式
CASE WHEN <判断表达式> THEN <表达式>
	 WHEN <判断表达式> THEN <表达式>
	 WHEN <判断表达式> THEN <表达式>
	 WHEN <判断表达式> THEN <表达式>
		...
	ELSE <表达式>
END	
```
WHEN 子句中华的<判断表达式>就是类似"列 = 值"这样,返回值为真值(TRUE/FALSE/UNKNOWN)的表达式.我们也可以将其看做使用=、!=、或者LIKE、BETWEEN等谓词编写出来的表达式.
CASE表达式会从对最初的WHEN子句中的<判断表达式>进行判断开始执行.所谓"判断",就是要调查该表达式的真值是什么.如果结果为真"TRUE",那么就返回___THEN子句___中的表达式,CASE表达式的执行到此为止.如果结果不为真,那么就跳转到下一条WHEN子句的判断中.如果直到最后的WHEN子句为止返回结果都不为真,那么就返回___ELSE___中的表达式,执行终止.
从CASE表达式名称中的"表达式"我们也能看出来,上述这些整体构成一个表达式.并且由于表达式最终会返回一个值,因此CASE表达式在SQL语句执行时,也会转化为一个值.虽然会使用分支众多的CASE便携数十行代码的情况也并不少见,但是无论多么庞大的CASE表达式,最后也只会返回类似"1"或者"Mr.Aphey"这样简单的值.
#### CASE表达式的使用方法
那么,我们现在来学习CASE表达式的具体使用方法.例如我们来考虑这样一种情况,现在Shohin(商品)表中包含衣服、办公用品和厨房用具3种商品类型.请大家考虑一下怎么样才能得到如下结果呢?
```
A:衣服
B:办公用品
C:厨房用具
```
因为表中的记录并不包含"A:"或者"B:"这样的字符串,所以需要在SQL中进行添加.我们可以使用前面学过的字符串连接函数"||"来完成这项工作.
剩下的问题就是怎样正确地将"A:""B:""C:"与记录结合起来.这是我们就可以使用CASE表达式来实现这样的要求了
```
通过CASE表达式将A-C的字符串假如到商品分类中
SELECT shohin_mei,
		CASE WHEN shohin_bunrui = '衣服'
		THEN 'A:' || shohin_bunrui
		WHEN shohin_bunrui = '办公用品'
		THEN 'B:' || shohin_bunrui
		WHEN shohin_bunrui = '厨房用具'
		THEN 'C:' || shohin_bunrui
		ELSE NULL
	END AS abc_shohin_bunrui
FROM shohin;
执行结果:
shohin_mei|shohin_bunrui
----------+-------------
T恤	      |  A:衣服
打孔器	  |  B:办公用品
运动T恤	  |  A:衣服
菜刀	  |  C:厨房用具
高压锅	  |  C:厨房用具
叉子	  |  C:厨房用具
擦菜板	  |  C:厨房用具
圆珠笔	  |  B:办公用品
```

6行CASE表达式写代码最后相当于一列(abc\_shohin\_bunrui)而已,也许会让人感到吃惊,与商品种类(shohin_bunrui)的名称相对应,CASE表达式中包含了三条WHEN子句分支.最后的"ELSE NULL"代表了"上述情况之外时返回NULL"的意思.ELSE子句指定了不满足WHEN子句中条件的记录应该执行何种操作.NULL之外的其他值或者表达式也可以写在ELSE子句之中.但由于现在表中包含的商品种类只有3种,因此实际上有没有ELSE子句都是一样的.
ELSE子句也可以省略不写,这时会自动默认为"__ELSE NULL__".但为了防止有人漏读,所以还是希望大家能够写明ELSE子句.
- 法则6-3 虽然CASE表达式中的ELSE子句可以省略,但还是希望大家不要省略.
此外,CASE表达式最后的"END"是不能省略的,请大家特别注意不要遗漏.忘记书写END会发生语法错误,这也是初学者最容易犯的错误.
- 法则6-4 CASE表达式中的END不能省略
##### CASE表达式的书写位置
CASE表达式的便利之处就在于它是一个表达式.之所以这么说,是因为表达式可以书写在任意位置.也就像"1+1" 这样写在什么位置都可以的意思.例如,我们可以利用CASE表达式将下面的SELECT语句结果中的行和列进行互换.
```
sum_tanka_ihuku| sum_tanka_kitchen| sum_tanka_jimu
---------------+------------------+---------------
		5000   |			11180 |			600
```
上述结果是根据商品种类计算出的销售单价的合计值,通常我们将商品种类列作为GROUP BY子句的聚合键来使用,但是这样得到的结果会以"行"的形式输出,而无法以列的形式进行排列
```
通常使用GROUP BY也无法实现行列转换
SELECT shohin_bunrui
	SUM(hanbai_tanka) AS sum_tanka_ihuku
FROM Shohin
GROUP BY shohin_bunrui;
执行结果:
shohin_bunrui|sum_tanka
-------------+---------
衣服	     |  5000
办公用品	     |  600
厨房用具	     |  11180
```
我们可以使用CASE表达式进行行列转换
```
--对按照商品种类计算出的销售单价合计值进行行列转换
SELECT SUM(CASE WHEN shohin_bunrui = '衣服'
			THEN hanbai_tanka ELSE 0 END) AS sum_tanka_ihuku,
		SUM(CASE WHEN shohin_bunrui = '厨房用具'
			THEN hanbai_tanka ELSE 0 END) AS sum_tanka_kitchen,
		SUM(CASE WHEN shohin_bunrui = '办公用品'
			THEN hanbai_tanka ELSE 0 END) AS sum_tanka_jimu
FROM shohin;
执行结果:
sum_tanka_ihuku| sum_tanka_kitchen| sum_tanka_jimu
---------------+------------------+---------------
		5000   |	11180         |  	600
```
上述CASE表达式,在满足商品种类(Shohin\_bunrui)为"衣服"或者"办公用品"等定值时,输出该商品的销售单价(hanbai\_tanka),不满足时输出0.对该结果进行合计处理,就能得到特定商品种类的销售单价合计值了.
CASE 表达式在对SELECT语句的结果进行编辑时,能够发挥较大作用.
#### 专栏
##### 简单CASE表达式
CASE表达式分为两种,一种是本节学习的"搜索CASE表达式",另一种就是其简化形式----"简单CASE表达式".
简单CASE表达式比搜索CASE表达式简单,但是会收到条件的约束.因此,通常情况下都会使用搜索CASE表达式.再次我们简单了解一下简单CASE表达式的语法结构.
简单CASE表达式的语法如下所示.
语法6-A 简单CASE表达式
```
CASE <表达式>
 WHEN <表达式> THEN<表达式>
 WHEN <表达式> THEN<表达式>
 WHEN <表达式> THEN<表达式>
  ...
 ELSE <表达式>	
END 
```
与搜索CASE表达式一样,简单CASE表达式也是从最初的WHEN子句开始进行,逐一判断每个WHEN子句知道返回真值为止.此外,没有能够返回真值的WHEN子句时,也会返回ELSE子句指定的表达式.两者的不同之处在于,简单CASE表达式最初的"CASE<表达式>" 也会作为判断的对象.
下面我们看一个例子,分别使用搜索CASE表达式和简单CASE表达式
```
--使用搜索CASE表达式,将字符串A~C添加到商品种类中
SELECT shohin_mei,
	CASE WHEN shohin_bunrui = '衣服'
		THEN 'A:' ||shohin_bunrui
		WHEN shohin_bunrui = '办公用品'
		THEN 'B:' ||shohin_bunrui		
		WHEN shohin_bunrui = '厨房用具'
		THEN 'C:' ||shohin_bunrui		
		ELSE NULL
	END AS abc_shohin_bunrui
FROM shohin;

--使用简单CASE表达式
SELECT shohin_mei,
	CASE shohin_bunrui
		WHEN '衣服'	THEN 'A:'||shohin_bunrui
		WHEN '办公用品'	THEN 'B:'||shohin_bunrui
		WHEN '厨房用具'	THEN 'C:'||shohin_bunrui
		ELSE NULL
	END AS abc_shohin_bunrui
FROM shohin;
像"CASE shohin_mei" 这样,简单CASE表达式在将想要判断的表达式(这里是列)书写过一次之后,
就无需在之后的WHEN子句中重复书写"shohin_bunrui"了.虽然看上去简化了书写,但是想要在WHEN
子句中指定不同列时,简单CASE表达式就无能为力了.
```
## 第七章 集合运算
### 7-1 表的加减法
#### 什么是集合运算
本章我们要学习"集合运算"操作.在数学领域,"集合"表示"(各种各样)事物的总和";在数据库领域,表示"___记录的集合___".具体来说,表、视图和查询的执行结果都是"记录的集合".
截止目前,我们已经学习了从表中读取数据以及插入数据的方法.所谓集合运算,就是对满足同一规则的记录进行的加减等"四则运算".通过集合运算,可以得到两张表中记录的集合,或者是公共记录的集合,又或者是其中某张表记录的集合.像这样用来进行集合运算的运算符称为"集合运算符".
#### 表的加法
首先介绍的是集合运算符是进行记录加法运算的UNION(并集).
在学习具体的使用方法之前,我们首先添加一张表.该表的结构与之前我们使用的Shohin(商品)表相同,只是表名变为Shohin2(商品2)
```
CREATE TABLE Shohin2
(shohin_id	char(4)	NOT NULL,
shohin_mei	varchar(100)	NOT NULL,
shohin_bunrui	varchar(32)	NOT NULL,
hanbai_tanka	INTEGER		,
shiire_tanka	INTEGER		,
torokubi		DATE		,
PRIMARY KEY	(shohin_id));
```
截下来,我们将下面的5跳记录插入到Shohin2表中.商品编号(shohin_id) 为"0001"~"0003"的商品之前Shohin表中的商品相同,而编号为"0009"的"手套"和"0010"的"水壶"是Shohin表中没有的商品
```
BEGIN TRANSACTION;
INSERT INTO Shohin2 VALUES ('0001','T恤衫','衣服',1000,500,'2009-09-20');
INSERT INTO Shohin2 VALUES ('0002','打孔器','办公用品',500,320,'2009-09-11');
INSERT INTO Shohin2 VALUES ('0003','运动T恤','衣服',4000,2800,NULL);
INSERT INTO Shohin2 VALUES ('0009','手套','衣服',800,500,NULL);
INSERT INTO Shohin2 VALUES ('0010','水壶','厨房用具',2000,1700,'2009-09-20');
COMMIT;
```
这样,我们的准备工作就完成了.截下来,就让我们对上述两张表进行"shohin表 + shohin2 表"这样的加法计算吧.
```
使用UNION 对表进行加法运算
SELECT shohin_id, shohin_mei
FROM Shohin
UNION
SELECT shohin_id,shohin_mei
FROM shohin2;
执行结果:
shohin_id| shohin_mei
---------+-----------
0001	 |    T恤衫
0002	 |    打孔器
0003	 |    运动T恤
0004	 |    菜刀
0005	 |    高压锅
0006	 |    叉子
0007	 |    擦菜板
0008	 |    圆珠笔
0009	 |    手套
0010	 |    水壶
```
上述结果包含了两张表中的全部商品(去除了重复的项目).
- 法则7-1 集合运算符会除去重复的记录
#### 集合运算的注意事项
其实结果中也可以包含重复的记录,在介绍这个方法之前,我们还是来学习一下使用集合运算符时的注意事项吧.不仅限于UNION,之后将要学习的所有运算符都要遵守这些注意是想.
##### 注意事项1-->作为运算对象的记录的列数必须相同
例如,像下面这样,一部分记录包含2列,另一部分包含3列时会发生错误,无法进行加法运算.
```
--列数不一致时会发生错误,下面为错误代码
SELECT shohin_id,shohin_mei
FROM Shohin
UNION
SELECT shohin_id,shohin_mei,hanbai_tanka
FROM Shohin2
执行结果:报错
[2016-11-23 13:23:28] [42601] ERROR: each UNION query must have the same number of columns
  位置：54
```
##### 注意事项2-->作为运算对象的记录中列的类型必须一致
从左侧开始,相同位置上的列必须是同一数据类型.例如,下面的SQL语句,虽然列数相同,但是第2列的数据类型并不一致(一个是数值类型,一个是日期类型),因此会发生错误
```
--数据类型不一致时会发生错误
SELECT shohin_id,hanbai_tanka
FROM Shohin
UNION
SELECT shohin_id,torokubi
FROM Shohin2;
执行结果:报错
[2016-11-23 13:27:26] [42804] ERROR: UNION types integer and date cannot be matched
  位置：66
```
一定要使用不同数据类型的列时,可以试用前面学过的类型转换函数CAST.
##### 注意事项3-->可以使用任何SELECT语句,但是ORDER BY子句只能在最后使用1次
通过UNION进行并集运算时可以使用任何形式的SELECT语句.之前学过的WHERE、GROUP BY、HAVING等子句都可以使用.但是ORDER BY只能在最后使用一次
```
-- ORDER BY子句只在最后使用一次
SELECT shohin_id,shohin_mei
FROM Shohin
WHERE shohin_bunrui='厨房用具'
UNION
SELECT shohin_id,shohin_mei
FROM Shohin2
WHERE shohin_bunrui='厨房用具'
ORDER BY shohin_id
执行结果:
shohin_id| shohin_mei
---------+----------
0004	 |	菜刀
0005	 |	高压锅
0006	 |	叉子
0007	 |	擦菜板
0010	 |	水壶
```
#### 包含重复行的集合运算-->ALL 选项
接下来我们学习在UNION的结果中保留重复行的语法.其实非常简单,只要在UNION后面添加ALL关键字就可以了.这里ALL选项,在UNION之外的集合运算符中同样可以使用
```
--保留重复行
SELECT shohin_id,shohin_mei
FROM Shohin
UNION ALL
SELECT shohin_id,shohin_mei
FROM shohin2;
执行结果:
shohin_id| shohin_mei
---------+-----------
0001	 |	T恤衫
0002	 |	打孔器
0003	 |	运动T恤
0004	 |	菜刀
0005	 |	高压锅
0006	 |	叉子
0007	 |	擦菜板
0008	 |	圆珠笔
0001	 |	T恤衫
0002	 |	打孔器
0003	 |	运动T恤
0009	 |	手套
0010	 |	水壶
```
- 法则7-2 在集合运算符中使用ALL选项,可以保留重复行.

#### 选取表中的公共部分(交集)-->INTERSECT
下面学习的集合运算符在数学的四则运算中并不存在,其实也不是很难理解,那就是选取2个记录集合中的公共部分的INTERSECT(交集)
其语法和UNION完全一样
```
--INTERSECT语法,选取表中的公共部分
SELECT shohin_id,shohin_mei
FROM Shohin
INTERSECT
SELECT shohin_id,shohin_mei
FROM Shohin2
ORDER BY shohin_id;
执行结果:
shohin_id| shohin_mei
---------+-----------
0002	 |	打孔器
0003	 |	运动T恤
```
我们可以发现,结果中只包含两张表中公共部分.
与使用AND可以选取出一张表中满足多个条件的公共部分不同,___INTERSECT应用于两张表,选取出它们当中的公共记录___.
其注意事项与UNION相同,我们在"集合运算的注意是想"和"保留重复行的集合运算中"希望保留重复行时同样需要INTERSECT ALL.
#### 记录的减法(差集)-->EXCEPT
本节最后我们学习一下集合运算符就是进行减法运算的EXCEPT(差集).其语法也与UNION相同.
其意思是减去两张表的交集部分,被减数(EXCEPT上面的那张表)剩下来的部分.
```
--使用EXCEPT对记录进行减法运算
SELECT shohin_id,shohin_mei
FROM Shohin
EXCEPT
SELECT shohin_id,shohin_mei
FROM Shohin2
ORDER BY shohin_id;
执行结果:
shohin_id| shohin_mei
---------+-----------
0004	 |	菜刀
0005	 |	高压锅
0006	 |	叉子
0007	 |	擦菜板
0008	 |	圆珠笔
```
我们可以发现,结果中只包含了Shohin表的记录中除去___Shohin2表中记录___(Aphey备注:这里应该是两张表的共有部分.)的剩余部分.
EXCEPT有一点与UNION和INTERSECT不同,需要注意一下.那就是在减法运算中减数和被减数的位置不同,所得到的结果也不相同,4-2和2-4的结果也不一样.因此我们将之前SQL中的Shohin和Shohin2互换,就能得到下面的结果
```
--被减数和减数的位置不同,得到的结果也不同
SELECT shohin_id,shohin_mei
FROM shohin 2
EXCEPT
SELECT shohin_id,shohin_mei
FROM Shohin
ORDER BY shohin_id;
执行结果:
shohin_id| shohin_mei
---------+-----------
0009	 |	手套
0010	 |	水壶
```
到此,对SQL提供的集合运算符的学习就结束了,大家可能会有"怎么没有乘法和除法"这样的疑问.关于乘法的相关内容,我们在下一节进行详细介绍.此外SQL中虽然也存在除法,但由于除法是比较难理解的运算,属于中级内容,在本章末尾的专栏会有一些介绍.
### 7-2联结(以列为单位对表进行联结)
#### 什么是联结
前面我们学习了UNION和INTERSECT等集合运算.这些集合运算的特征就是以___行方向___为单位进行操作.通俗来说就是进行这些集合运算时,会导致记录行数的增减.使用UNION会增加记录行数,而使用INTERSECT或者EXCEPT会减少记录行数.
但这些运算不会导致列数的改变.作为集合运算对象表的前提就是列数要一致.因此,运算结果不会导致列的增减.
本节将要学习的链接(JOIN)运算,简单来说就是将其他表中的列添加过来,进行"添加列"的运算.该操作通常用于无法从一张表中获取期望数据(列)的情况.截止目前,本书中出现的示例基本都是从一张表中选取数据,但实际上,期望得到的数据往往分散在不同的表之中.使用链接就可以从多张表(3张以上的表也没关系)中选取数据了.
SQL的联结根据其用途可以分为很多种类.这里需要掌握两种:内联结和外联结
#### 内联结-->INNER JOIN
首先,我们来学习内联结,它是应用最广泛的联结运算.大家现在可以暂时忽略"内"这个字,之后会进行详细说明
本例中我们会继续使用Shohin表和第六章创建的TenpoShohin表.下面我们先看下这两张表的内容
___Shohin表:___

shohin\_id|shohin\_mei|shohin\_bunrui|hanbai\_tanka|shiire_tanka|torokubi
---|---|---|---|---|---
0001|	T恤	   | 衣服|		1000|	500	|	2009-09-20
0002|	打孔器|	办公用品|	500	|	320	|	2009-09-11
0003|	运动T恤|	衣服|		4000|	2800|	NULL
0004|	菜刀|	厨房用具|	3000|	2800|	2009-09-20
0005|	高压锅|	厨房用具|	6800|	5000|	2009-01-15
0006|	叉子|	厨房用具|	500	|	NULL	|	2009-09-20
0007|	擦菜板|	厨房用具|	880	|	790	|	2008-04-28
0008|	圆珠笔|	办公用品|	100	|	NULL	|	2009-11-11

___TenpoShohin表:___

tenpo\_id(商店编号)|tenpo\_mei(商店名称)|shohin\_id(商品编号)|shohin\_mei(商品名称)
---|---|---|---
000A|	东京|	0001|	30
000A|	东京|	0002|	50
000A|	东京|	0003|	15
000B|	名古屋|	0002|	30
000B|	名古屋|	0003|	120
000B|	名古屋|	0004|	20
000B|	名古屋|	0006|	10
000B|	名古屋|	0007|	40
000C|	大阪|	0003|	20
000C|	大阪|	0004|	520
000C|	大阪|	0006|	90
000C|	大阪|	0007|	70
000D|	福冈|	0001|	100

对这两张表包含的列进行整理后结果如下所示

项目名称|Shohin|TenpoShohin
---|---|---
商品编号|○|○
商品名称|○|---
商品分类|○|---
销售单价|○|---
进货单价|○|---
登记日期|○|---
商店编号|---|○
商店名称|---|○
数量|---|○

如上表所示,两张表中的列可以分为如下两类:
A. 两张表中都包含的列 --> 商品编号
B. 只存在与一张表内的列 --> 商品编号以外的列

所谓链接运算,一言以蔽之,就是"以A中的列作为桥梁,将B中的满足同样条件的列汇集到同一结果之中".具体过程如下所述.
从tenpoShohin表中的数据我们能够知道,东京店(000A)销售商品的编号为0001、0002和0003.但这些商品具体的名称(shohin\_mei)和销售单价(hanbai\_tanka)在TenpoShohin表中并不存在.这些信息都保存在Shohin表中.大阪店和名古屋店情况也是如此.
下面我们就试着从Shohin表中去除商品名称(shohin\_mei)和销售单价(hanbai\_tanka),与TenpoShohin表中的内容进行结合.
```
--将两张表进行内联结
SELECT TS.tenpo_id,TS.tenpo_mei,TS.shohin_id,S.shohin_mei,S.hanbai_tanka
FROM TenpoShohin AS TS INNER JOIN Shohin AS S
	ON TS.shohin_id = S.shohin_id;
```	

执行结果如下:

tenpo\_id|tenpo\_mei|shohin\_id|shohin\_mei|hanbai\_tanka
---|---|---|---|---
000D|	福冈|	0001|	T恤	|	1000
000A|	东京|	0001|	T恤	|	1000
000B|	名古屋|	0002|	打孔器|	500
000A|	东京|	0002|	打孔器|	500
000C|	大阪|	0003|	运动T恤|	4000
000B|	名古屋|	0003|	运动T恤|	4000
000A|	东京|	0003|	运动T恤|	4000
000C|	大阪|	0004|	菜刀|	3000
000B|	名古屋|	0004|	菜刀|	3000
000C|	大阪|	0006|	叉子|	500
000B|	名古屋|	0006|	叉子|	500
000C|	大阪|	0007|	擦菜板|	880
000B|	名古屋|	0007|	擦菜板|	880

关于内联结,请注意以下三点:
##### 内联要点1-->FROM子句
第1点要注意的是,之前的FROM子句中只有一张表,而这次我们同时使用了TenpoShohin和Shohin两张表
```
FROM TenpoShohin AS TS INNER JOIN Shohin AS S
```

使用关键字INNER JOIN就可以将两张表联结在一起了.TS和S分别是这两张表的别名,但别名并不是必须的.在SELECT子句中直接使用TenpoShohin和Shohin这样的表的原名也没有关系.但由于表名太长会影响SQL语句的可读性,所以还是希望我们能够习惯使用别名.
- 法则7-3 进行联结时需要在FROM子句中使用多张表.

##### 内联要点2-->ON子句
第2点要注意的是ON后面所记载的联络条件
```
ON TS.Shohin_id = S.Shohin_id
```
我们可以在ON之后指定两张表联结所使用的列(___联结键___).本例中使用的是商品编号(Shohin_id).也就是说ON是专门用来指定联结条件的,它能起到与WHERE相同的作用.需要指定多个键时,同样可以使用AND、OR. ON子句在进行内联时是必不可少的(如果没有ON会发生错误).并且ON必须书写在FROM与WHERE之间
- 法则7-4 进行内联结时必须使用ON子句,并且要书写在FROM和WHERE之间.

举个直观的例子,ON就像链接河流两岸城镇的桥梁一样.
联结条件也可以使用"="来记述,在语法上,还可以使用<=和BETWEEN等谓词.但是由于实际应用中九成以上都可以用"="进行联结,所以开始时大家只要记住使用"="就可以了.使用"="将联结键进行关联,就能够将两张表中满足相同条件的记录进行"联结"了.
##### 内联结要点3-->SELECT子句
第3点要注意的是,在SELECT子句中指定的列
```
SELECT TS.tenpo_id,tenpo_mei,TS.shohin_id,S.shohin_mei,S.hanbai_banka
``` 
在SELECT子句中,使用像TS.tenpo\_id和S.hanbai\_tanka这样<表的别名>.<列名>的形式来指定列.这和使用一张表时的情况不同,由于多表联结时,某个列到底属于哪张表比较混乱,所以采用了这样的防范措施.语法上必须使用这样书写方式的只是那些同时存在于两张表中的列(这里是shohin\_id),其他的列可以像tenpo\_id这样直接书写列名,而不会发生错误.但是就像前面说的那样,为了避免混乱,还是希望我们能够在使用联结时按照<表的别名>.<列名>的格式来书写SELECT子句中全部的列.
- 法则7-5 使用联结时,SELECT子句中的列需要按照<表的别名>.<列名>的格式来书写.

##### 内联结和WHERE子句结合使用
如果并不想了解所有商店的情况,例如只想知道东京店(000A)的信息时,可以像之前学习那样在WHERE子句中添加条件.这样我们就可以根据下面的代码中得到的全部商店信息中选取出东京店的记录了.
```
--内联结和WHERE子句结合使用,查询东京店的记录
SELECT TS.tenpo_id,TS.Tenpo_mei,TS.shohin_id,S.shohin_mei,S.hanbai_tanka
FROM TenpoShohin AS TS INNER JOIN Shohin AS S
ON TS.shohin_id = S.shohin_id
WHERE TS.tenpo_id = '000A';
```

执行结果:
tenpo\_id|tenpo\_mei|shohin\_id|shohin\_mei|hanbai_tanka
---|---|---|---|---
000A|	东京|	0001|	T恤	|	1000
000A|	东京|	0002|	打孔器|	500
000A|	东京|	0003|	运动T恤|	4000

像这样使用联结运算将满足相同规定的表联结起来时,WHERE、GROUP BY、HAVING、ORDER BY等工具都可以正常使用.我们可以将联结之后的结果想象为新创建出来的一张表(如下表),对这张表使用WHERE子句等工具,这样理解起来就容易多了

tenpo\_id|tenpo\_mei|shohin\_id|shohin\_mei|hanbai\_tanka
---|---|---|---|---
000A|	东京|	0001|	T恤	|	1000
000A|	东京|	0002|	打孔器|	500
000A|	东京|	0003|	运动T恤|	4000
000B|	名古屋|	0002|	打孔器|	500
000B|	名古屋|	0003|	运动T恤|	4000
000B|	名古屋|	0004|	菜刀|	3000
000B|	名古屋|	0006|	叉子|	500
000B|	名古屋|	0007|	擦菜板|	880
000C|	大阪|	0003|	运动T恤|	4000
000C|	大阪|	0004|	菜刀|	3000
000C|	大阪|	0006|	叉子|	500
000C|	大阪|	0007|	擦菜板|	880
000D|	福冈|	0001|	T恤	|	1000

当然,这张"表"只在SELECT语句执行期间存在,SELECT语句执行之后就会消失,如果希望继续使用这张"表",还是将它创建成试图吧.

### 外联结-->OUTER JOIN
内联结之外比较重要的就是外联结了.我们再来回顾一下前面的例子.
在前例中,我们将TenpoShohin表和Shohin表进行内联结,从两张表中取出各个商店销售的商品信息.其中,实现"读取两张表信息"的就是联结功能.
外联结也是通过ON子句使用联结键将两张表进行联结,同时从两张表中选区相应的列.基本的使用方法并没有发生改变,只是结果有所不同.
我们把之前的内联结语句转换为外联结试试看,结果有何不同
```
--将两张表进行外联结
SELECT TS.tenpo_id, TS.tenpo_mei, TS.shohin_id, S.shohin_mei,S.hanbai_tanka
FROM tenpoShohin AS TS RIGHT OUTERR JOIN Shohin AS S
ON TS.shohin_id = S.shohin_id;
```

执行结果:

tenpo\_id|tenpo\_mei|shohin\_id|shohin\_mei|hanbai\_tanka
---|---|---|---|---
000A|	东京|	0002|	打孔器|	500
000A|	东京|	0003|	运动T恤|	4000
000A|	东京|	0001|	T恤	|	1000
000B|	名古屋|	0006|	叉子|	500
000B|	名古屋|	0002|	打孔器|	500
000B|	名古屋|	0003|	运动T恤|	4000
000B|	名古屋|	0004|	菜刀|	3000
000B|	名古屋|	0007|	擦菜板|	880
000C|	大阪|	0006|	叉子|	500
000C|	大阪|	0007|	擦菜板|	880
000C|	大阪|	0003|	运动T恤|	4000
000C|	大阪|	0004|	菜刀|	3000
000D|	福冈|	0001|	T恤	|	1000
\---	|	\---	|	\---	|	高压锅|	6800
\---	|	\---	|	\---	|	圆珠笔|	100

_最后两行内联结时,并不存在_

##### 外联结要点1-->选取出单张表中全部的信息
与内联结的结果相比,不同点显而易见,那就是结果的行数不一样.内联结的结果中有13条记录,而外联结的结果中有15条记录.增加的两条记录到底是什么呢?
这正是外联结的关键点.多出的两条记录是高压锅和圆珠笔.这两条记录在TenpoShohin表中并不存在.也就是说这两种商品在任何商店中都没有销售.由于内联结只能选取出同时存在于两张表中的数据,所以只在Shohin表中存在的2种商品并没有出现在结果之中.
相反,对于外联结来说,只要数据存在于某一张表当中,就能够读取出来.在实际的业务当中,例如想要生成固定行数的定型单据时,就需要使用外联结.如果使用内联结的话,根据SELECT语句执行时商店库存状况的不同,结果行数也会发生改变生成单据的外观也会受到影响而使用外联结能够得到固定行数的结果.
话虽如此,那些表中不存在的数据我们还是无法得到结果中高压锅和圆珠笔的商店编号和商店名称都是NULL(具体信息大家都不知道,真是无可奈何).外联结名称的由来也跟NULL有关.所谓"外部",也就是"包含元表中不存在(在元表之外)的信息"的意思,相反,只包含表内信息的联结也就被称为"内"联结了.

##### 外联结要点2-->每张表都是主表吗?
外联结还有一点非常重要,那就是要把那张表作为主表.最终的结果中会包含主表内所有的数据.指定主表的关键字是___LEFT___和___RIGHT___.如其名称所示,使用LEFT时FROM子句中写在左侧的表是主表,使用RIGHT时,右侧的表也就是Shohin表是主表.
我们还可以像下面这样进行调换,意思完全相同.
```
SELECT TS.tenpo_id, TS.tenpo_mei, TS.shohin_id, S.shohin_mei,S.hanbai_tanka
FROM Shohin AS S LEFT OUTER JOIN tenpoShohin AS TS
ON TS.shohin_id = S.shohin_id
ORDER BY tenpo_id;
```

执行结果与上面一段代码的执行结果完全一样:

执行结果:

tenpo\_id|tenpo\_mei|shohin\_id|shohin\_mei|hanbai\_tanka
---|---|---|---|---
000A|	东京|	0002|	打孔器|	500
000A|	东京|	0003|	运动T恤|	4000
000A|	东京|	0001|	T恤	|	1000
000B|	名古屋|	0006|	叉子|	500
000B|	名古屋|	0002|	打孔器|	500
000B|	名古屋|	0003|	运动T恤|	4000
000B|	名古屋|	0004|	菜刀|	3000
000B|	名古屋|	0007|	擦菜板|	880
000C|	大阪|	0006|	叉子|	500
000C|	大阪|	0007|	擦菜板|	880
000C|	大阪|	0003|	运动T恤|	4000
000C|	大阪|	0004|	菜刀|	3000
000D|	福冈|	0001|	T恤	|	1000
\---	|	\---	|	\---	|	高压锅|	6800
\---	|	\---	|	\---	|	圆珠笔|	100

其实LEFT 和RIGHT的功能没有任何区别,使用哪一个都可以.通常,使用LEFT的情况会多一点,但并没有非使用这个不可的理由,使用RIGHT也没有任何问题.
- 法则7-6 外联结中,使用LEFT、RIGHT来指定主表.使用二者所得到的结果完全一致

#### 3张以上表的联结
通常联结只设计两张表,但有事也会出现必须同时联结3张以上表的情况.原则上联结表的数量并没有限制.下面我们就来看下3张表的联结吧.
首先我们创建一张用来管理库存的表ZaikoShohin.假设商品都保存在SOO1,S002这两个仓库中.
```
-- 代码清单7-13,创建ZaikoShohin,并,向表中插入数据:
-- DDL:创建表
CREATE TABLE ZaikoShohin(
souko_id	CHAR(4)		NOT NULL,
shohin_id 	CHAR(4)		NOT NULL,
zaiko_suryo INTEGER		NOT NULL,
PRIMARY KEY (souko_id, shohin_id));
-- DML:插入数据:
BEGIN TRANSACTION;

INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0001',0);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0002',120);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0003',200);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0004',3);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0005',0);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0006',99);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0007',999);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S001' ,'0008',200);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0001',10);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0002',25);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0003',34);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0004',19);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0005',99);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0006',0);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0007',0);
INSERT INTO ZaikoShohin (souko_id,shohin_id,zaiko_suryo) VALUES ('S002' ,'0008',18);

COMMIT;

执行结果:
souku_id |	shohin_id |	 suryo
---------+------------+--------
  S001	 |	  0001	  |	  0
  S001	 |	  0002	  |	  120
  S001	 |	  0003	  |	  200
  S001	 |	  0004	  |	  3
  S001	 |	  0005	  |	  0
  S001	 |	  0006	  |	  99
  S001	 |	  0007	  |	  999
  S001	 |	  0008	  |	  200
  S002	 |	  0001	  |	  10
  S002	 |	  0002	  |	  25
  S002	 |	  0003	  |	  34
  S002	 |	  0004	  |	  19
  S002	 |	  0005	  |	  99
  S002	 |	  0006	  |	  0
  S002	 |	  0007	  |	  0
  S002	 |	  0008	  |	  18
```

下面我们从上表中取出保存在S001仓库中的商品数量,并将该列添加到带啊清单7-11所得到的的结果中.联结方式为内联结(外联结的使用方法完全相同),联结键为商品编号(shohin_id)
```
代码7-14对3张表进行联结:
SELECT TS.tenpo_id,TS.tenpo_mei,TS.shohin_id,S.shohin_mei,S.hanbai_tanka,ZS.zaiko_suryo
FROM TenpoShohin AS TS INNER JOIN Shohin AS S
ON TS.Shohin_id = S.shohin_id
INNER JOIN ZaikoShohin AS ZS
ON TS.shohin_id = ZS.shohin_id
WHERE ZS.souko_id = "S001";
执行结果:
tenpo_id  |	tenpo_mei	|  shohin_id |  shohin_mei  | hanbai_tanka | suryo	
----------+-------------+------------+--------------+--------------+-------
000A		  东京		    0001			T恤			1000		  0
000A		  东京		    0002			打孔器		500			  120
000A		  东京		    0003			运动T恤		4000		  200
000B		  名古屋		    0002			打孔器		500			  120
000B		  名古屋		    0003			运动T恤		4000		  200
000B		  名古屋		    0004			菜刀		3000		  3
000B		  名古屋		    0006			叉子		500			  99
000B		  名古屋		    0007			擦菜板		880			  999
000C		  大阪		    0003			运动T恤		4000		  200
000C		  大阪		    0004			菜刀		3000		  3
000C		  大阪		    0006			叉子		500			  99
000C		  大阪		    0007			擦菜板		880			  999
000D		  福冈		    0001			T恤			1000		  0
```

ZaikoShohin表也添加进来:
```
FROM TenpoShohin AS TS INNER JOIN Shohin AS S
ON TS.shohin_id = S.shohin_id
INNER JOIN ZaikoShohin AS ZS
ON TS.shohin_id = ZS.Shohin_id
```
通过ON子句指定联结条件的方式也没有发生改变.使用等号将作为联结条件的Shohin表和TenpoShohin表中的商品编号(Shohin_id)联结起来.由于Shohin表和TenpoShohin表已经进行了联结,所以这里无需再对Shohin表和ZaikoShohin表进行联结了(虽然也可以进行联结,但结果不会发生改变).
即使想要把联结的表增加到4张,5张……,使用INNER JOIN进行添加的方式也是完全相同的
#### 交叉联结-->CROSS JOIN
接下来,我们要学习第三种联结方式-->交叉联结.其实这种联结在实际业务中并没有使用过(作者也很少使用这种联结).但是价差联结是所有联结运算的基础.
交叉联结本身非常简单,但是其结果有点麻烦.下面我们试着将Shohin表和TenpoShohin表进行交叉联结
```
--代码7-15 将两张表进行交叉联结:
SELECT TS.tenpo_id,TS.tenpo_mei,TS.shohin_id,S.shohin_mei,S.hanbai_tanka
FROM tenpoShohin AS TS CROSS JOIN Shohin AS S;
执行结果:
tenpo_id| tenpo_mei| shohin_id| shohin_mei| hanbao_tanka
000A		  东京	   0001	      T恤			1000
000A		  东京	   0002	      T恤			1000
000A		  东京	   0003	      T恤			1000
000B		  名古屋	   0002	      T恤			1000
000B		  名古屋	   0003	      T恤			1000
000B		  名古屋	   0004	      T恤			1000
000B		  名古屋	   0006	      T恤			1000
000B		  名古屋	   0007	      T恤			1000
000C		  大阪	   0003	      T恤			1000
000C		  大阪	   0004	      T恤			1000
000C		  大阪	   0006	      T恤			1000
000C		  大阪	   0007	      T恤			1000
000D		  福冈	   0001	      T恤			1000
000A		  东京	   0001	      打孔器			500
000A		  东京	   0002	      打孔器			500
000A		  东京	   0003	      打孔器			500
000B		  名古屋	   0002	      打孔器			500
000B		  名古屋	   0003	      打孔器			500
000B		  名古屋	   0004	      打孔器			500
000B		  名古屋	   0006	      打孔器			500
000B		  名古屋	   0007	      打孔器			500
000C		  大阪	   0003	      打孔器			500
000C		  大阪	   0004	      打孔器			500
000C		  大阪	   0006	      打孔器			500
000C		  大阪	   0007	      打孔器			500
000D		  福冈	   0001	      打孔器			500
000A		  东京	   0001	      运动T恤		4000
000A		  东京	   0002	      运动T恤		4000
000A		  东京	   0003	      运动T恤		4000
000B		  名古屋	   0002	      运动T恤		4000
000B		  名古屋	   0003	      运动T恤		4000
000B		  名古屋	   0004	      运动T恤		4000
000B		  名古屋	   0006	      运动T恤		4000
000B		  名古屋	   0007	      运动T恤		4000
000C		  大阪	   0003	      运动T恤		4000
000C		  大阪	   0004	      运动T恤		4000
000C		  大阪	   0006	      运动T恤		4000
000C		  大阪	   0007	      运动T恤		4000
000D		  福冈	   0001	      运动T恤		4000
000A		  东京	   0001	      菜刀			3000
000A		  东京	   0002	      菜刀			3000
000A		  东京	   0003	      菜刀			3000
000B		  名古屋	   0002	      菜刀			3000
000B		  名古屋	   0003	      菜刀			3000
000B		  名古屋	   0004	      菜刀			3000
000B		  名古屋	   0006	      菜刀			3000
000B		  名古屋	   0007	      菜刀			3000
000C		  大阪	   0003	      菜刀			3000
000C		  大阪	   0004	      菜刀			3000
000C		  大阪	   0006	      菜刀			3000
000C		  大阪	   0007	      菜刀			3000
000D		  福冈	   0001	      菜刀			3000
000A		  东京	   0001	      高压锅			6800
000A		  东京	   0002	      高压锅			6800
000A		  东京	   0003	      高压锅			6800
000B		  名古屋	   0002	      高压锅			6800
000B		  名古屋	   0003	      高压锅			6800
000B		  名古屋	   0004	      高压锅			6800
000B		  名古屋	   0006	      高压锅			6800
000B		  名古屋	   0007	      高压锅			6800
000C		  大阪	   0003	      高压锅			6800
000C		  大阪	   0004	      高压锅			6800
000C		  大阪	   0006	      高压锅			6800
000C		  大阪	   0007	      高压锅			6800
000D		  福冈	   0001	      高压锅			6800
000A		  东京	   0001	      叉子			500
000A		  东京	   0002	      叉子			500
000A		  东京	   0003	      叉子			500
000B		  名古屋	   0002	      叉子			500
000B		  名古屋	   0003	      叉子			500
000B		  名古屋	   0004	      叉子			500
000B		  名古屋	   0006	      叉子			500
000B		  名古屋	   0007	      叉子			500
000C		  大阪	   0003	      叉子			500
000C		  大阪	   0004	      叉子			500
000C		  大阪	   0006	      叉子			500
000C		  大阪	   0007	      叉子			500
000D		  福冈	   0001	      叉子			500
000A		  东京	   0001	      擦菜板			880
000A		  东京	   0002	      擦菜板			880
000A		  东京	   0003	      擦菜板			880
000B		  名古屋	   0002	      擦菜板			880
000B		  名古屋	   0003	      擦菜板			880
000B		  名古屋	   0004	      擦菜板			880
000B		  名古屋	   0006	      擦菜板			880
000B		  名古屋	   0007	      擦菜板			880
000C		  大阪	   0003	      擦菜板			880
000C		  大阪	   0004	      擦菜板			880
000C		  大阪	   0006	      擦菜板			880
000C		  大阪	   0007	      擦菜板			880
000D		  福冈	   0001	      擦菜板			880
000A		  东京	   0001	      圆珠笔			100
000A		  东京	   0002	      圆珠笔			100
000A		  东京	   0003	      圆珠笔			100
000B		  名古屋	   0002	      圆珠笔			100
000B		  名古屋	   0003	      圆珠笔			100
000B		  名古屋	   0004	      圆珠笔			100
000B		  名古屋	   0006	      圆珠笔			100
000B		  名古屋	   0007	      圆珠笔			100
000C		  大阪	   0003	      圆珠笔			100
000C		  大阪	   0004	      圆珠笔			100
000C		  大阪	   0006	      圆珠笔			100
000C		  大阪	   0007	      圆珠笔			100
000D		  福冈	   0001	      圆珠笔			100
```

我们可能被结果的行数惊到了,但是我们还是先来介绍一下语法结构,对满足相同规定的表进行交叉联结的集合运算符是CROSS JOIN(笛卡尔积).进行交叉联结时无法使用内联结和外联结所使用的ON子句,这是因为交叉联结是对两张表中的全部记录进行交叉组合,因此结果中的记录数通常是两张表中行数的乘积.前例中,由于TenpoShohin表存在13条记录,Shohin表存在8条记录,所以结果中就有13*8=104条记录.
可能这时会有人想起在前一节最后,我们提到了集合运算中的乘法会在本届中进行详细学习,这就是上面介绍的交叉联结.
内联结是交叉联结的一部分."内部"也可以理解为"包含在交叉联结结果中的部分".相反,外联结可以理解为"交叉联结结果之外的部分".
交叉联结没有应用到实际业务之中的原因有两个.一个是其结果没有实用价值,二是由于其结果行数太多,需要花费大量的运算时间和高性能设备的支持.

#### 特定的联结语句和过时的语法
之前我们学习的内联结和外联结语法都符合标准SQL的规定,可以在所有的DBMS中执行.因此,我们可以放心使用,但是如果我们之后从事系统开发工作的话,一定会碰到需要阅读他人写的代码并进行维护的情况.而那些使用特定和过时语法的程序就会成为我们的麻烦.
SQL是一门特定及过时语法非常多的语言,虽然之前书中也多次提及,但联结是其中特定语法的部分,现在还有不少年长的程序员和系统工程师仍在使用这些特定的语法.
例如,我们学习的内联结的SELECT语句替换为过时语法的结果如下所示:
```
--代码7-16使用过时语法的内联结
SELECT TS.tenpo_id, TS.tenpo_mei, TS.shohin_id,S.shohin_mei,S.hanba_tanka
FROM tenpoShohin TS,Shohin S
WHERE TS.shohin_id = S.shohin_id
AND TS.tenpo_id = '000A';
```
这样的书写方式得到的结果与标准语法完全相同.并且,这样的语法可以在所有的DMBS中执行,并不能算是特定的语法,只是过时了而已.
但是,由于这样的语法不仅过时,而且还存在很多其他的问题,所以不推荐使用.理由主要有以下三点:

1. 使用这样的语法无法马上判断出到底是内联结还是外联结(又或者是其他种类的联结)

2. 由于链接条件都写在WHERE子句之中,所以无法在短时间内分辨出那部分是联结条件,那部分是用来选区记录的限制条件.

3. 就是我们不知道这样的语法到底还能用多久,每个DMBS的开发这都会考虑放弃过时的语法,转而支持新的语法,虽然并不是马上就不能使用了,但那一天总会到来

虽然这么说,但是现在使用这些过时语法编写的程序还有很多,到目前为止还都能正常执行.我们很可能会碰到这样的代码,因此最好还是能了解.
- 法则7-7 那些过时和特定的联结书写方式,虽然我们自己不使用,但必须要能读懂

#### 关系除法
本章中我们学习了以下4个集合运算符:

- Union(并集)
- Except(差集) 
- Intersect(交集)
- CROSS JOIN(笛卡尔积)

虽然交集是独立的一种集合运算,但实际上它是"只包含公共部分的特殊Union".剩下的3个在四则运算中也有对应的运算.但是,除法运算还没有介绍.
难道集合运算中没有除法吗?当然不是,除法运算是存在的.集合运算中的除法通常称为"关系除法",关系是除法领域中对表或者视图的称谓.但是并没有定义像UNION或者EXCEPT这样专用的运算符号.如果要定义,估计应该DIVIDE(除)吧.但截止目前并没有DBMS使用这样的运算符.
为什么只有除法运算不使用运算符(只有除法)对被除数进行与水暖呢?其中的理由有点复杂,还是让我们先来介绍一下"表的除法"具体是一种什么样的运算吧.
我们创建两张表作为示例用表:
```
--创建SkillS表/EmpSkills表
--DDL:创建表:
CREATE TABLE Skills
(skill VARCHAR(32),
PRIMARY KEY (skill));

CREATE TABLE EmpSkills
(emp VARCHAR(32),
skill VARCHAR(32)
PRIMARY KEY(emp,skill));

--DML:插入数据:
INSERT INTO Skills VALUES ('Oracle');
INSERT INTO Skills VALUES ('UNIX');
INSERT INTO Skills VALUES ('JAVA');

INSERT INTO EmpSkills VALUES('相田','Oracle');
INSERT INTO EmpSkills VALUES('相田','UNIX');
INSERT INTO EmpSkills VALUES('相田','JAVA');
INSERT INTO EmpSkills VALUES('相田','C#');
INSERT INTO EmpSkills VALUES('神崎','Oracle');
INSERT INTO EmpSkills VALUES('神崎','UNIX');
INSERT INTO EmpSkills VALUES('神崎','JAVA');
INSERT INTO EmpSkills VALUES('平井','UNIX');
INSERT INTO EmpSkills VALUES('平井','Oracle');
INSERT INTO EmpSkills VALUES('平井','PHP');
INSERT INTO EmpSkills VALUES('平井','Perl');
INSERT INTO EmpSkills VALUES('平井','C++');
INSERT INTO EmpSkills VALUES('若田部','Perl');
INSERT INTO EmpSkills VALUES('渡来','Oracle');

COMMIT;
```

得到下面两张表:
Skills(技术)表
Skill|---
---|---
Oracle|---
UNIX|---
Java|---

EmpSkills(员工技术)表:
emp|Skills
---|---
相田|Oracle
相田|UNIX
相田|JAVA
相田|C#
神崎|Oracle
神崎|UNIX
神崎|JAVA
平井|UNIX
平井|Oracle
平井|PHP
平井|Perl
平井|C++
若田部|Perl
渡来|Oracle

EmpSkills表中保存了某个系统公司员工所掌握的技术信息.例如,从该表中我们可以了解到相田掌握了Oracle、UNIX、JAVA、C#这四种技术.
下面我们来思考一下如何从该表中选取出掌握了Skills表中所有3个领域技术的员工吧.
```
SELECT DISTINCT emp
FROM EmpSkills ES1
WHERE NOT EXISTS
(SELECT SkillS
	FROM SkillS
EXCEPT
SELECT skill
FROM EmpSkills ES2
WHERE ES1.emp = ES2.emp);
执行结果:
emp
----
相田
神崎
```
这样我们就得到了"相田"和"神崎"两个人.虽然平井也掌握了Oracle和UNIX,但是他不会JAVA,所以没选出来.
这样的运算结果满足了除法运算的基本规则.肯定有人会问,到底上述运算中什么地方是除法运算呢?实际上这和数值的除法既相似又有所不同.
除法和乘法是相辅相成的关系,除法运算的结果(商)乘以除数就能得到运算前的被除数了.
关系除法中,这样的规则也是成立的.商和除数相乘,也就是交叉联结,就能够得到作为被除数的集合了.(虽然不能恢复成完整的被除数,但这里我们也不追究了.)
综上所述,除法运算是集合运算中最复杂的运算,但是其在实际业务中的应用十分广泛,因此最好还是能够了解掌握.
## 第八章 SQL高级处理
### 8-1 窗口函数
#### 什么是窗口函数
窗口函数也称OLAP函数.为了快速形成直观印象,才起了这样一个容易理解的名称("窗口"的含义我们将在随后进行说明).
OLAP是Online Analytical Processing的简称,意为对数据库数据进行实时分析处理.例如,市场分析、创建财务报表、创建计划等日常性商务工作.
窗口函数就是为了实现OLAP而添加的标准SQL功能.(__目前MySQL数据还不支持窗口函数__)
##### 窗口函数的支持情况
很多数据库相关工作者过去都会有这样的想法:"好不容易将业务数据插入到了数据库中,如果能够使用SQL对齐进行实时分析的话,一定会很方便吧."但是关系数据库提供好OLAP用途的功能仅仅只有10年左右的时间
其中的理由有很多,这里我们不一一介绍了.值得注意的是,还有一部分DBMS并不支持这样的新功能.
我们现在学习的窗口函数也是其中之一,截止20105月,Oracle 11g、SQL SERVER2008、DB2 9.7、PostgreSQL都已经支持了该功能.但是MySQL 5.5还是不支持此功能.
#### 窗口函数的语法
接下来,就让我们通过示例来学习窗口函数.窗口函数的语法有些复杂.
```
--语法8.1 窗口函数
<窗口函数> OVER ([PARTITION BY <列清单>]
				ORDER BY <拍序用列清单>)
注:[]中的内容可以省略
```

其中重要的关键字是PARTITION BY 和 ORDER BY.首先,理解这两个关键字的作用是帮我们理解窗口函数的关键.
##### 能够作为窗口函数使用的函数
在学习PARTITION BY 和 ORDER BY之前,我们先来列举一下能够作为窗口函数使用的函数.窗口函数大体可以分为以下两种.
1. 能够作为窗口函数的聚合函数(SUM、AVG、COUNT、MAX、MIN)
2. RANK、DENSE\_RANK、ROW\_NUMBER等__专用窗口函数__

其中第二条中的函数是标准SQL定义的OLAP专用函数.我们将它们统称为"专用窗口函数"从这些函数的名称很容易就可以看出其OLAP的作用.
上面的第一条使我们在第三章学习的聚合函数.通过将聚合函数书写在"语法8-1"的<窗口函数>中,就能够作为窗口函数来使用了.总之,集约函数根据使用语法的不同,可以在集约函数和窗口函数之间进行转换.
#### 语法的基本使用方法-->使用RANK函数
首先让我们通过专用窗口函数RANK来理解一下窗口函数的语法吧.正如其名称所示,RANK是用来计算记录排序的函数.
例如,我们将从各种类的商品(shohin\_bunrui),按照销售单价(hanbai\_tanka)从低到高的顺序,制作出之前曾使用过的shohin表中8件商品的排序表
```
--代码8-1 将各种商品,按照销售单价从低到高的顺序创建排序表
SELECT shohin_mei,shohin_bunrui, hanbai_tanka,
	RANK() OVER (PARTITION BY shohin_bunrui
				ORDER BY hanbai_tanka) AS ranking
FROM shohin;
```
执行结果:

shohin\_mei|shohin\_bunrui|hanbai\_tanka|rank
---|---|---|---
圆珠笔|	办公用品|100|1
打孔器|	办公用品|500|2
叉子|	厨房用具|500|1
擦菜板|	厨房用具|880|2
菜刀|	厨房用具|3000|3
高压锅|	厨房用具|6800|4
T恤	|	衣服|1000|1
运动T恤|	衣服|4000|2

在上表中,以厨房用具为例,销售单价最便宜的"叉子"排在第一位,最贵的"高压锅"排在第四位,确实按照我们的要求进行了排序.
在代码中,__PARTITION BY__能够设定排序的对象范围.本例中为了按照商品种类进行排序,我们指定了shohin\_bunrui.
__ORDER BY__能够指定按照那一列、何种顺序进行排序.为了按照销售单价的升序进行排列,我们指定了hanbai\_tanka.此外,窗口函数中的ORDER BY与SELECT语句末尾的ORDER BY一样,可以通过关键字ASC/DESC来指定升序或者降序.省略该关键字时会默认按照ASC,也就是升序进行排序.
窗口函数兼具之前我们学过的GROUP BY 子句的分组功能,以及ORDER BY子句的排序功能.但是PARTTION BY子句并不具备GROUP BY子句的聚合功能.因此使用RANK函数并不会减少元素中记录的行数,结果依然是8行数据.

- 法则8-1 窗口函数具有分组和排序两种功能.

通过PARTITION BY分组后的记录集合称为"窗口".此处的窗口并非"窗户"的意思,而是代表了"__范围__".这也就是"窗口函数"名称的由来.

- 法则8-2 通过PARTITION BY分组后的记录集合称为"窗口".

此外,各个窗口在定义上绝对不会包含共通的部分.就像刀切蛋糕一样,干净利落.这与通过GROUP BY子句分割后的集合具有相同的特征.

#### 无需指定PARTITION BY

使用窗口函数时祈祷关键作用的是PARTITION BY和GROUP BY.其中PARTITION BY 并不是必须的.即使不指定也可以正常使用窗口函数.
那么就让我们来确认一下不指定PARTITION BY会得到什么样的结果吧.这和使用没有GROUP BY的聚合参数时的效果是一样的.也就是将整个表作为一个大的窗口来使用,我们一起来试试吧.
```
--代码8-2 不指定PARTITION BY
SELECT shohin_mei,shohin_bunrui,hanbai_tanka,
	RANK() OVER (ORDER BY hanbai_tanka) AS ranking
FROM Shohin;
```

执行结果:

shohin\_mei|shohin\_bunrui|hanbai\_tanka|ranking
---|---|---|---
圆珠笔|	办公用品|100	|1
叉子|	厨房用具|500	|2
打孔器|	办公用品|500	|2
擦菜板|	厨房用具|880	|4
T恤	|	衣服|1000	|5
菜刀|	厨房用具|3000|6
运动T恤|	衣服|4000	|7
高压锅|	厨房用具|6800|8

之前,我们得到的是按照商品种类分组后的排序,而这次变成了全部商品的排序.PARTITION BY 可以将表中的数据分为多个部分(窗口),是希望使用窗口函数时的一个选项.
#### 专用窗口函数的种类
从上述结果中我们可以看到,"打孔器"和"叉子"都排在第2位,而之后的"擦菜板"跳过了第3位,直接拍到了第4位.这也是通常的排序方法.但某些情况下可能并不希望跳过某个位次来进行排序.
这时可以使用RANK函数之外的函数来实现.下面我们就来总结一下有代表性的专用窗口函数.

- RANK函数
	计算排序时,如果存在相同位次的记录,则会跳过之后的位次
	例) 有三条记录排在第一位时: 1位,1位,1位,4位

- DENSE_RANK函数
	同样是计算排序,即使存在相同位次的记录,也不会跳过之后的位次.
	例) 有三条记录排在第一位时: 1位,1位,1位,2位

- ROw_NUMBER函数
	赋予唯一的连续位次.
	例) 有三条记录排在第一位时: 1位,2位,3位,4位

除此之外,各DBMS还提供了各自特有的窗口函数.上述3个函数(对于支持窗口函数的DBMS来说)在所有的DBMS中都能使用,下面就让我们比较一下使用这三个函数的结果吧
```
--代码8-3 比较RANK,DENSE_RANK 和 ROW_NUMBER的区别:
SELECT shohin_mei,shohin_bunrui,hanbai_tanka,
	RANK () OVER (ORDER BY hanbai_tanka) AS ranking,
	DENSE_RANK () OVER (ORDER BY hanbai_tanka) AS dense_ranking,
	ROW_NUMBER ()　OVER (ORDER BY hanbai_tank) AS row_num
FROOM shohin;
```

执行结果:

shohin\_mei|shohin\_bunrui|hanbai\_tanka|ranking|dense\_ranking|row\_num
---|---|---|---|---|---
圆珠笔|	办公用品|100	|	1|	1|	1
叉子|	厨房用具|500	|	2|	2|	2
打孔器|	办公用品|500	|	2|	2|	3
擦菜板|	厨房用具|880	|	4|	3|	4
T恤	|	衣服|1000	|	5|	4|	5
菜刀|	厨房用具|3000|	6|	5|	6
运动T恤|	衣服|4000	|	7|	6|	7
高压锅|	厨房用具|6800|	8|	7|	8

将结果中的ranking列和dense\_ranking列进行比较可以发现,dense\_ranking列中有连续2个第2位,这和ranking列的情况相同.但是接下来的"擦菜板"的位次并不是第4位,而是第3.这就是使用DENSE_RANK函数的效果了.
此外,我们可以看到,在row\_num列中,不管销售单价(hanbai\_tanka)是否相同,每件商品都会按照销售单价从低到高的顺序得到一个连续的位次.销售单价相同时,DBMS会根据适当的顺序进行排列.想为记录赋予唯一的连续位次时,就可以像这样使用ROW_NUMBER来实现.
使用RANK或者ROW\_NUMBER时无需任何参数,只需要像RANK()或者ROW\_NUMBER()这样保持括号中为空就可以了,这也是专用窗口函数通常的使用方式,请务必牢记.
- 法则8-3 由于专用窗口函数无需参数,所以通常括号中都是空的.

#### 窗口函数的适用范围
目前为止我们学过的函数大部分都没有使用位置的限制.最多也就是在WHERE子句中使用聚合参数时会有些注意事项.但是,适用窗口函数的位置却有非常大的限制.更确切些说,窗口函数只能书写在一个特定的位置.
这个位置就是在SELECT子句中,反过来说,就是这类函数不能在WHERE子句或者GROUP BY子句中使用.

- 法则8-4 原则上窗口 函数只能在SELECT子句中使用.

虽然,我们可以把它当做一种规则司机硬背下来,但是为什么窗口函数只能在SELECT子句中使用呢?(也就是不能在WHERE子句或者GROUP BY子句中使用.) 下面我们就来简单说明一下其中的理由.
其理由就是,在DBMS内部,窗口函数是对WHERE子句或者GROUP BY子句处理后的"结果"进行操作.我们可以仔细想一想,在得到用户想要的结果之前,即使进行了排序处理,结果也是错误的.在得到排序结果之后,如果通过WHERE子句中的条件出去了某些记录,或者使用GROUP BY子句进行了聚合处理,那好不容易得到的排序结果也就无法使用了(___反之,之所以在ORDER BY子句中能够使用窗口函数,是因为ORDER BY子句会在SELECT子句之后执行,并且记录保证不会减少___).
正是由于这样的原因,__在SELECT子句之外"使用窗口函数是没有意义的"__,所以在语法上才会有这样的限制.
___备注:其实,语法上,除了SELECT子句,ORDER BY子句或者UPDATE语句的SET子句也是可以使用窗口函数的,但是由于几乎没有实际业务会这么操作,所以我们就记得"只能在SELECT子句中使用"就可以了___

#### 作为窗口函数使用的聚合参数
 前面我们学习了使用专用窗口函数的示例.下面我们看看如何把之前学过的SUM或者AVG等聚合函数作为窗口函数的使用方法.
 所有的聚合函数都能用作窗口函数,其语法和专用窗口函数完全相同,但是我们对于所能得到的结果没有一个直观的印象,所以我们还是通过具体的示例来进行学习:
```
--代码8-4 将SUM函数作为窗口函数使用
SELECT shohin_id,shohin_mei,hanbai_tanka,
 	SUM(hanbai_tanka) OVER (ORDER BY Shohin_id) AS current_sum
FROM shohin;
```

执行结果:

shohin\_id|shohin\_mei|hanbai\_tanka|current\_sum
---|---|---|---
0001|	T恤	|	1000|1000
0002|	打孔器|	500	|1500 <--1000+500
0003|	运动T恤|	4000|5500 <--1000+500+4000
0004|	菜刀|	3000|8500 <--1000+500+4000+3000
0005|	高压锅|	6800|15300		....
0006|	叉子|	500	|15800
0007|	擦菜板|	880	|16680
0008|	圆珠笔|	100	|16780

使用SUM函数时,并不像RANK或者ROW\_NUMBER那样括号中的内容为空.而是和之前我们学过的一样,需要在括号内指定作为聚合对象的列.本例中我们计算出了销售单价(hanbai\_tanka)的合计值(current\_sum).
但是我们得到的并不仅仅是合计值.而是按照ORDER BY子句指定的Shohin\_id的升序进行排列,计算出商品编号"小于自己"的商品的销售单价的合计值.因此计算该合计值的逻辑就像金字塔堆积那样,一行一行的逐渐添加计算对象.在计算随时增加的销售总额,特别是需要按照时间顺序计算时,通常都会使用这种称为"__累计__"的统计方法.
使用其他聚合函数时的操作逻辑也和本例相同.例如,使用AVG来代替SELECT语句中的SUM
```
--代码8-5 将AVG函数作为窗口函数使用
SELECT shohin_id,shohin_mei,hanbai_tanka,
AVG(hanbai_tanka) OVER (ORDER BY shohin_id) AS current_avg
FROM shohin;
```

执行结果:

shohin\_id|shohin\_mei|hanba\_tanka|current\_avg
---|---|---|---
0001|	T恤	|	1000|	1000 <--1000/1
0002|	打孔器|	500	|	750  <--(1000+500)/2 下面依次类推
0003|	运动T恤|	4000|	1833.3333333333333333
0004|	菜刀|	3000|	2125
0005|	高压锅|	6800|	3060
0006|	叉子|	500	|	2633.3333333333333333
0007|	擦菜板|	880	|	2382.8571428571428571
0008|	圆珠笔|	100	|	2097.5

从结果中我们可以看到,current\_avg的计算方法,确实是计算平均值的方法.但作为统计对象的却只是"排在自己之上"的记录.像这样以"自身记录(当前记录)"作为基准进行统计,就是将聚合函数用作窗口函数使用时的最大特征.

#### 计算移动平均
窗口函数就是将表以窗口为单位进行分割,并在其中进行排序的函数.其实其中还包含在窗口中指定更加详细的统计范围的备选功能.该备选功能中的统计范围称为"框架".
其语法如下面代码所示,需要在ORDER BY子句之后使用范围的关键字
```
--代码 8-6 指定"最靠近3行"作为统计对象
SELECT shohin_id,shohin_mei,hanbai_tanka
AVG(hanbai_tanka) OVER (ORDER BY shohin_id ROWS 2 PRECEDING) AS moving_avg
FROM shohin;
```
执行结果:

shohin\_id|shohin\_mei|hanbai\_tanka|moving\_avg
---|---|---|---
0001|	T恤		|1000	|1000 <--(1000)/1
0002|	打孔器	|500	|750  <-- (1000+500)/2
0003|	运动T恤	|4000	|1833.33... <--(1000+500+4000)/3
0004|	菜刀	|3000	|2500 <--(500+4000+3000)/3
0005|	高压锅	|6800	|4600 <--(4000+3000+6800)/3
0006|	叉子	|500	|3433.33.. 依次类推
0007|	擦菜板	|880	|2726.66..  依次类推
0008|	圆珠笔	|100	|493.33..  依次类推

##### 指定框架(统计范围)
我们将上述结果与之前的结果进行比较,可以发现商品编号为"0004"的"菜刀"以下的记录和窗口函数的计算结果并不相同,这是因为我们指定了框架,将统计对象限定为"最靠近的3行"的缘故.
这里我们使用了__ROWS__(行) 和 __PRECEDING__(之前)两个关键字,将框架指定为"截止到之前~行". 因此"ROWS 2 PRECEDING"也就是将框架指定为"截止到之前2行",作为统计对象的记录就限定为如下的"最靠近的3行".也就是说,由于框架是根据当前记录来决定的,所以和固定窗口不同,其范围会随着当前记录的变化而变化.
如果将条件中数字变成"ROWS 5 PRECEDING",就是"截止到之前5行"(最靠近的6行)的意思.
这样的统计方法称为移动平均(moving average).由于这种方法在希望实时把握"最近状态"时非常方便,所以常常会应用在对股市趋势的实时跟踪当中.
使用关键字__FOLLOWING(之后)__替换__PRECEDING__,就可以指定"截止到之后~行".

#####将当钱记录的前后行作为统计对象
如果希望将当前记录的前后行作为统计对象时,可以同时使用 ___PRECEDING___ 和 ___FOLLOWING___ 关键字来实现
```
-- 代码8-7 将当前记录的前后航作为统计对象
SELECT shohin_id,shohin_mei,hanbai_tanka,
	AVG(hanbai_tanka) OVER (ORDER BY shohin_id
						ROWS BETWEEN 1 PRECEDING AND 1 FOLLOWING) AS moving_avg
FROM shohin;
```

执行结果:

shohin\_id|shohin\_mei|hanbai\_tanka|moving\_avg
---|---|---|---
0001|	T恤	|	1000| 750 <-- (1000+500)/2
0002|	打孔器|	500	| 1833.33.. <-- (1000+500+4000)/3
0003|	运动T恤|	4000| 2500 <-- (500+4000+3000)/3
0004|	菜刀|	3000| 4600 <-- (4000+3000+6800)/3
0005|	高压锅|	6800| 3433.33..	依次类推
0006|	叉子|	500	| 2726.66.. 依次类推
0007|	擦菜板|	880	| 493.33.. 依次类推
0008|	圆珠笔|	100	| 490  <-- (880+100)/2

在上述代码中,我们通过指定框架,将"1 PRECEDING(之前一行)"和"1 FOLLOWING(之后一行)"的取件作为统计对象.具体来说就是将__"上一行,自身行,下一行"__3行作为统计对象来进行计算.
如果能熟练掌握框架功能的话,就能称为窗口函数的高手.

#### 两个ORDER BY
最后我们来介绍一下使用窗口函数时,关于结果形式的注意点,那就是记录的排列顺序.由于使用窗口函数时必须要在OVER子句中使用ORDER BY,所以乍一看,可能大家会觉得结果中的记录不会按照ORDER BY所指定的顺序进行排序.
但其实这只是一种错觉.OVER 子句中的ORDER BY只是用来决定窗口函数按照什么样的顺序进行计算的,对结果的排序顺序并没有影响.因此也有可能像下面代码那样得到一个记录的排列顺序比较混乱的结果.有些DBMS也可以按照窗口函数的ORDER BY子句所指定的顺序对结果进行排序,但那也仅仅是个例而已.
```
--代码8-8 无法保证SELECT 语句结果的排列顺序
SELECT shohin_mei,shohin_bunrui,hanbai_tanka,
RANK() OVER (ORDER BY hanbai_tanka) AS ranking
FROM shohin;
```

执行结果:
shohin\_me|shohin\_bunrui|hanbai\_tanka|ranking
---|---|---|---
圆珠笔|	办公用品|	100	|	1
叉子|	厨房用具|	500	|	2
打孔器|	办公用品|	500	|	2
擦菜板|	厨房用具|	880	|	4
T恤	|	衣服|		1000|	5
菜刀|	厨房用具|	3000|	6
运动T恤|	衣服|		4000|	7
高压锅|	厨房用具|	6800|	8

那么如何才能让记录切实按照ranking列的顺序排列呢?
答案其实很简单,那就是在SELECT语句的最后,使用ORDER BY子句进行指定(代码清单8-9).这样就能保证SELECT语句结果中记录的排列顺序了,除此之外没有其他办法了.
```
--代码8-9 在语句末位使用ORDER BY子句对结果进行排序
SELECT shohin_mei,shohin_bunrui,hanbai_tanka,
	RANK() OVER (ORDER BY hanbai_tanka) AS ranking
FROM Shohin
ORDER BY ranking;
```

执行结果:

shohin\_mei|shohin\_bunrui|hanbai\_tanka|ranking
---|---|---|---
圆珠笔|	办公用品|	100	|	1
叉子|	厨房用具|	500	|	2
打孔器|	办公用品|	500	|	2
擦菜板|	厨房用具|	880	|	4
T恤	|	衣服|		1000|	5
菜刀|	厨房用具|	3000|	6
运动T恤|	衣服|	4000	|	7
高压锅|	厨房用具|	6800|	8

我们也许会觉得在一条SELECT语句中使用两次ORDER BY会有些别扭,但是尽管这两个ORDER BY看上去是相同的,但其实它们的功能却完全不同.
- 法则8-5 将聚合函数作为窗口函数使用时,会以当前记录为基准来决定统计对象的记录.

### 8-2 GROUPING运算符
#### 学习重点

- 只使用GROUP BY 子句和聚合函数是无法同时计算出小计,合计值的.如果想要一次得到这两个值可以使用GROUPING运算符.
- 理解GROUPING 运算符中CUBE的关键在与形成"积木搭建出的立方体"的印象.
- 虽然GROUPING 运算符是标准SQL的功能,但是还有些DBMS尚未支持这一功能. 

#### 同时计算出合计值
我们在3-2节中学习过GROUP BY子句和聚合函数的使用方法,当时有人可能会想,是否能够通过GROUP BY子句得到表8-1那样的结果呢?
表8-1

合计|16780 <-- 合计行
---|---
厨房用具| 11180
衣服| 5000
办公用品| 600

虽然这是按照商品种类计算销售单价总额时得到的结果,但问题在于最上面多出一行合计行.使用代码清单8-10中GROUP BY子句的语法无法得到这一行.
```
--代码8-10 使用GROUP BY无法得到合计行
SELECT shohin_bunrui,SUM(hanbai_tanka)
FROM Shohin
GROUP BY shohin_bunrui;
```

执行结果:
shohin\_mei|sum
---|---
衣服|5000
办公用品|600
厨房用具|11180

由于GROUP BY子句是用来指定聚合键的场所,所以这里指定的键只能用来进行分割数据,而合计行是不指定聚合键时得到的聚合结果,因此与之下3行通过聚合键得到的结果并不相同.按通常的思路想一次得到这两种结果是不可能的.
如果想要获得那样的结果,过去通常会分别计算出合计行和按照商品种类进行聚合的结果,然后通过__UNION ALL__(虽然也可以用UNION来代替UNION ALL,但由于两条SELECT语句的聚合键不同,一定不会出现重复行,所以可以使用UNION ALL.UNION ALL和UNION不同之处在于它不会对结果进行排序,因此比UNION的性能更好)
```
--代码 8-11 分别计算出合计行和聚合结果再通过UNION ALL进行连接 
SELECT '合计' AS shohin_bunrui,SUM(hanbai_tanka)
FROM Shohin
UNION ALL
SELECT shohin_bunrui,SUM(hanbai_tanka)
FROM shohin
GROUP BY shohin_bunrui; 
```

执行结果:
shohin\_bunrui|sum
---|---
衣服|5000
办公用品|600
厨房用具|11180

这样一来为了得到想要的结果,需要执行两次几乎相同的SELECT语句,再将其结果进行连接.不但看上去十分繁琐,DBMS内部处理成本也非常高.难道没有更合适的实现方法了吗?

#### ROLLUP-->同时计算出合计值和小计值
为了满足用户的需求,标准SQL引入了GROUPING运算符.我们将在本节中着重介绍.使用该运算符就能通过非常简单的SQL,得到之前那样聚合单位不同的聚合结果了.
GROUPING 运算符包含一下3种:

- ROLLUP
- CUBE
- GROUPING SETS

##### ROLLUP
我们先从ROLLUP 开始学习,使用ROLLUP就可以通过非常简单的SELECT 语句同时计算出合计行了(代码清单8-12)
```
--代码清单8-12 使用ROLLUP同时计算出合计行和小计
SELECT shohin_bunrui,SUM(hanbai_tanka) AS sum_tanka
FROM Shohin
GROUP BY ROLLUP(shohin_bunrui);
```

执行结果:

shohin\_bunrui|sum\_tanka
---|---
null|16780
厨房用具|11180
衣服|5000
办公用品|600

在语法上,就是将GROUP BY 子句中的聚合键清单像__ROLLUP(<列1>,<列2>,...)__这样进行使用.该运算符的作用,一言以蔽之,就是"一次计算出不同聚合键的组合结果".例如,在本例中就是一次计算出了如下2组组合的聚合结果.

1. GROUP BY ()
2. GROUP BY (shohin_bunrui)

1中的GROUP BY ()并没有聚合键,也就相当于没有GROUP BY 子句(这时候会得到全部数据的合计行的记录).该合计行记录称为__超级分组记录(super group row)__.虽然名字听上去很炫,但我们还是需要把它当做未使用GROUP BY的合计行来使用理解.
超级分组记录的shohin_bunrui列的键值(对DBMS来说)并不明确,因此会默认使用NULL,之后我们会学习在此处插入恰当字符串的方法.
- 法则8-6 超级分组记录默认使用NULL 作为聚合键.

##### 将"登记日期"添加到聚合键当中
仅仅通过刚才一个例子,我们的印象可能不够深刻,下面我们再添加一个聚合键"登记日期(torokubi)"试试看吧.首先从不使用ROLLUP开始(代码清单8-13)
```
--代码清单8-13 在GROUP BY 中添加登记日期(不使用ROLLUP)
SELECT shohin_bunrui,torokubi,SUM(hanbai_tanka) AS sum_tanka
FROM shohin
GROUP BY shohin_bunrui,torokubi;
```

执行结果如下:

shohin\_bunrui|torokubi|sum\_tanka
---|---|---
厨房用具|	2009-01-15|	6800
办公用品|	2009-11-11|	100
衣服|	NULL		|	4000
办公用品|	2009-09-11|	500
厨房用具|	2008-04-28|	880
厨房用具|	2009-09-20|	3500
衣服|	2009-09-20	|	1000

在上述GROUP BY子句中使用ROLLUP之后,结果会发生什么变化吗?
```
--代码8-14: 在代码8-13 GROUP BY 中添加"登记日期(使用ROLLUP) 
SELECT shohin_bunrui,torokubi,SUM(hanbai_tanka) AS sum_tanka 
FROM Shohin
GROUP BY ROLLUP (shohin_bunrui,torokubi);
```

执行结果:

shohin\_bunrui|torokubi|sum_tanka
---|---|---
办公用品|	2009-09-11|	500
办公用品|	2009-11-11|	100
办公用品|null		|	600
厨房用具|	2008-04-28|	880
厨房用具|	2009-01-15|	6800
厨房用具|	2009-09-20|	3500
厨房用具|	null	|	11180
衣服|	2009-09-20	|	1000
衣服|	null		|	4000
衣服|		null	|	5000
null|null|			|	16780

将上述两个结果进行比较后我们发现,使用ROLLUP时多出了最下面的合计行,以及3条不同商品种类的小计行(也就是未使用登记日期作为聚合键的记录).这4行就是我们所说的超级分组记录.也就是说该SELECT语句的结果相当于使用UNION对如下3种模式聚合级的不同结果进行链接.
1. GROUP BY ()
2. GROUP BY (Shohin_bunrui)
3. GROUP BY (shohin_bunrui, torokubi)

ROLLUP是"卷起的意思",比如卷起百叶窗、窗帘等等,其名称也形象地说明了该操作能够得到像从小计到合计这样,从最小的聚合级开始,聚合单位逐渐扩大的结果.
- 法则8-7 ROLLUP可以同时计算出合计和小计,是非常方便的工具

#### GROUPING函数-->让NULL更加容易分辨
可能有人会注意到,之前使用ROLLUP所得到的结果(代码8-14的执行结果)有些蹊跷.问题就出在"衣服"的分组之中.有两条记录的torokubi列为NULL,但其原因却并不相同.
sum_tanka为4000元的记录,由于商品表中运动T恤的注册日期为NULL,所以就把NULL作为聚合键了,在这之前的实例中我们也曾见到过.
相反,sum_tanka为5000元的记录,毫无疑问就是超级分组记录NULL了(细目为1000元+4000元=5000元).但由于两者看上去都是"NULL",实在是难以分辨.
```
shohin_bunrui	torokubi	sum_tanka
-------------	--------	---------
衣服						   5000 <--由于是超级分组记录的缘故,登记日期为NULL
衣服			2009-09-20     1000
衣服					       1000 <--仅仅因为登记日期为NULL
```

为了避免混淆,SQL提供了一个用来判断超级分组记录的NULL的特定函数-->GROUPING函数.该函数在其参数列的值为超级分组记录所产生的NULL时返回1,其它情况返回0(代码清单8-15).
```
--代码8-15 使用GROUPING函数来判断NULL
SELECT GROUPING(shohin_bunrui) AS shohin_bunrui,
	GROUPING(torokubi) AS torokubi,SUM(hanbai_tanka) AS sum_tanka_ihuku
FROM Shohin
GROUP BY ROLLUP(shohin_bunrui,torokubi);
执行结果:
shohin_bunrui	torokubi	sum_tanka
	0			0		      500
	0			0		      100
	0			1		      600
	0			0		      880
	0			0		      6800
	0			0		      3500
	0			1		      11180
	0			0		      1000 <-- 原始数据为NULL时返回0
	0			0		      4000
	0			1		      5000 <-- 碰到超级分组记录中的NULL时会返回1
	1			1		      16780 
```

这样就能判断出是超级分组记录中的NULL还是原始数据本身为NULL了.使用GROUPING函数还能在超级分组记录的键值中插入字符串.也就是说,当GROUPING函数返回值为1时,指定"合计"或者"小计"等字符串,其他情况返回通常的列的值(代码清单8-16).
```
--代码清单8-16 在超级分组记录的键值中插入恰当的字符串
SELECT CASE WHEN GROUPING(Shohin_bunrui) = 1
			THEN '商品总类 合计'
			ELSE shohin_bunrui END AS shohin_bunrui,
		CASE WHEN GROUPING(torokubi) = 1
		THEN '登记日期 合计'
		ELSE CAST(torokubi AS VARCHAR(16)) END AS torokubi,
		SUM(hanbai_tanka) AS sum_tanka_ihuku
	FROM Shohin
GROUP BY ROLLUP(shohin_bunrui,torokubi);
执行结果:
shohin_bunrui	 torokubi	sum_tanka
-------------   ----------  ----------
办公用品			2009-09-11		500
办公用品			2009-11-11		100
办公用品			登记日期 合计		600
厨房用具			2008-04-28		880
厨房用具			2009-01-15		6800
厨房用具			2009-09-20		3500
厨房用具			登记日期 合计		11180
衣服			2009-09-20		1000
衣服							4000 <-- 原始数据中的NULL保持不变 
衣服			登记日期 合计		5000 <-- 将超级分组记录中的NULL替换为"登记日期 合计" 
商品总类 合计		登记日期 合计		16780 
```

在实际业务中,需要获取包含合计或者小计的统计结果(这种情况是最多的)时,就可以使用ROLLUP和GROUPING函数来实现了.
```
CAST(torokubi AS VARCHAR(16))
```

那为什么还要将SELECT子句中的torokubi列转换为CAST(torokubi AS VARCHAR(16))形式的字符串呢?这是为了满足CASE表达式所有分支的返回值必须一致的规定.如果不这样的话,那么各个分支会分别返回日期类型和字符串类型的值,执行时就会发生语法错误.
- 法则8-8 使用GROUPING 函数能够简单地分析出原始数据中的NULL和超级分组记录中的NULL.

#### CUBE-->用数据来搭积木
ROLLUP之后我们来学习另一个常用的GROUPING运算符-->CUBE.CUBE是"立方体"的意思,这个奇怪的名字和ROLLUP一样,都能形象地说明该函数的动作.究竟是什么样的动作呢,还是让我们通过一个例子来看一看吧.
CUBE 的语法和ROLLUP相同,只要将ROLLUP替换为CUBE就可以了.下面我们就把代码清单8-16中的SELECT语句替换为CUBE试试看吧(代码清单8-17).
```
--代码清单8-17 使用CUBE取得全部组合的结果
SELECT CASE WHEN GROUPING(Shohin_bunrui) = 1
			THEN '商品总类 合计'
			ELSE shohin_bunrui END AS shohin_bunrui,
		CASE WHEN GROUPING(torokubi) = 1
		THEN '登记日期 合计'
		ELSE CAST(torokubi AS VARCHAR(16)) END AS torokubi,
		SUM(hanbai_tanka) AS sum_tanka_ihuku
	FROM Shohin
GROUP BY CUBE(shohin_bunrui,torokubi);
执行结果:
shohin_bunrui	 torokubi	sum_tanka
-------------	----------	---------
办公用品			2009-09-11	  500
办公用品			2009-11-11	  100
办公用品			登记日期 合计	  600
厨房用具			2008-04-28	  880
厨房用具			2009-01-15	  6800
厨房用具			2009-09-20	  3500
厨房用具			登记日期 合计	  11180
衣服			2009-09-20	  1000
衣服						  4000
衣服			登记日期 合计	  5000
商品种类 合计		登记日期 合计	  16780
商品种类 合计		2008-04-28	  880  <--追加
商品种类 合计		2009-01-15	  6800 <--追加
商品种类 合计		2009-09-11	  500  <--追加
商品种类 合计		2009-09-20	  4500 <--追加 
商品种类 合计		2009-11-11	  100  <--追加
商品种类 合计					  4000 <--追加 
```

与ROLLUP的结果相比,CUBE的结果中多出了几行记录.我们看一下就明白了多出来的记录就是只把torokubi作为聚合键所得到的聚合结果:
1. GROUP BY
2. GROUP BY(shohin_bunrui)
3. GROUP BY(torokubi) <--新添加的组合
4. GROUP BY(shohin_bunrui,torokubi)

所谓CUBE,就是将GROUP BY子句中的聚合键的"所有可能组合"的聚合击中到一个结果中的功能.因此,组合的个数就是2的n次方(n是聚合键的个数),本例中聚合键有2个,所以2的2次方是4,如果再添加1个变成3个聚合键的话,就是2的3次方为8.__注:使用ROLLUP时组合的个数是n+1.随着组合个数的增加,结果的行数也会增加,因此如果使用CUBE时,不加以注意的话,往往会得到意想不到的巨大结果.顺带说一下,ROLLUP的结果一定是包含在CUBE结果之中.__
到这里,我们就会感到很奇怪,究竟CUBE运算符和立方体有什么关系呢/.
众所周知,立方体由长、宽、高三个轴组成.对于CUBE来说,一个聚合键就相当于其中一个轴而结果就是将数据想积木那样堆积起来,如下图
![](https://img.alicdn.com/imgextra/i2/3044451280/TB2oqiReceK.eBjSszgXXczFpXa_!!3044451280.jpg)
由于本例中只有商品种类(shohin_bunrui)和登记日期(torokubi)两个轴,所以我们看到的其实是个正方形,请大家把他看做缺了一个轴的立方体.通过CUBE当然也可以指定4个以上的轴,但由于那已经属于4维空间的范畴了,无法用图形来表示.
- 法则 8-9 可以把CUBE理解为将使用聚合键进行切割的模块堆积成一个立方体.

#### GROUPING SETS--> 去的期望的积木
最后要学习的GROUPING运算符是GROUPING SETS.该运算符可以用从ROLLUP或者CUBE的结果中取出部分记录.
例如,之前的CUBE的结果就是根据聚合键的所有可能组合计算而来的.如果希望从中选取出"商品种类"和"登记日期"各自作为聚合键的结果,反之,不想得到"合计记录和使用2个聚合键的记录"时,可以使用GROUPING SETS(代码清单8-18)
```
--代码8-18 使用GROUPING SETS取得部分组合结果
SELECT CASE WHEN GROUPING(shohin_bunrui) = 1 
            THEN '商品种类 合计'
            ELSE shohin_bunrui END AS shohin_bunrui,
       CASE WHEN GROUPING(torokubi) = 1 
            THEN '登记日期 合计'
            ELSE CAST(torokubi AS VARCHAR(16)) END AS torokubi,
       SUM(hanbai_tanka) AS sum_tanka
  FROM Shohin
 GROUP BY GROUPING SETS (shohin_bunrui, torokubi);
执行结果:
shohin_bunrui	 torokubi	sum_tanka
-------------	---------- 	---------
办公用品		    登记日期 合计	  600
厨房用具		    登记日期 合计	  11180
衣服		    登记日期 合计	  5000
商品种类 合计	    2008-04-28	  880
商品种类 合计	    2009-01-15	  6800
商品种类 合计	    2009-09-11	  500
商品种类 合计	    2009-09-20	  4500
商品种类 合计	    2009-11-11	  100
商品种类 合计	    			  4000
```
上述结果中也没有全体的合计行(16780元).与ROLLUP或者CUBE能够得到规定的(业务上称为"固定的")结果相对,GROUPING SETS用于从中取出个别条件对应的不固定的结果.然而,由于期望获得不固定结果的情况少之又少,所以与ROLLUP或者CUBE比起来,使用GROUPING SETS的机会也就很少了.