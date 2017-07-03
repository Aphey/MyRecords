### WEB服务和http协议
#### 基本概念
- http: HyperText Transfer Protocol;超文本传输协议;超文本是指带有超级连接的文本
- 超链接:基于某些连接在文档间实现跳转的文本,这些连接就叫超链接;
- 早期的web协议,就是实现在文档见跳转的协议而已.
- http/0.9版本: 仅纯文本(也包括超链接,这种超链接也表现为文本),有纯ASCII码组成的,html: HyperText Mark Language 开发超文本的语言.
- 浏览器:Browser客户端代理的一种
- URI: Uniform Resource Identifier 统一资源标识符,用于标记全局范围内(并不仅限于互联网)唯一资源访问路径的命名方式;统一指的是路径格式上的统一
- URL: Uniform Resource Locator 同意资源定位符,是URI的一个子集,用于描述在互联网上互联网资源的统一表示格式: protocol://HOST:PORT/PATH/TO/FILE
- web资源: 能够让客户端通过统一资源定位符访问的文件;多个资源很可能被整合成一个html文档.web资源有时候也被称为web资源.
- http方法:资源获取的方式
    - get:从服务器获取资源到本地,并用浏览器予以展示;http协议0.9版本只有这一个方法,而http协议升级到1.0之后,就引入了更多的方法:
    - POST,和get是相对应的方法,通过表单提交数据到服务器.
    - PUT, 和DELETE相对的方法,从远程服务器上获取一个文件到本地
    - DELETE , 和put对应的放发,在远程服务器上删除一个文件
- http协议1.0更大的改进是还引入了MIME的机制
    - MIME: Multipurpose Internet Mail Extension, 多用途互联网邮件扩展,能够将非文本数据在传输前重新编码为文本格式,接收方能够用相反的方式将其还原成原来的格式,还能够继续调用相应的程序来打开此文件.
    - 引入: smtp: Simple Mail Transfer Protocl,只能传输纯文本.