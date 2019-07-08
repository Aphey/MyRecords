# 学习笔记(2)

## 摘要介绍

在学习`Ant Design Pro`的过程中遇到了很多的新知识。针对一些要点做简单的梳理和摘要介绍。

## 关于异步调用之Promise

以我对前端的粗浅理解，每每提到异步调用我一定会想到ajax，这是我最早接触异步调用/同步调用概念的地方。事实上在js中通常使用的做法是回掉函数（callback），目前在我看来，Promise就像是对callback的一重包装。

用定义来说就是：**Promise 是异步编程的一种解决方案，比传统的解决方案——回调函数和事件——更合理和更强大。它由社区最早提出和实现，ES6 将其写进了语言标准，统一了用法，原生提供了Promise对象。**（引自[ECMAScript6入门](http://es6.ruanyifeng.com/?search=promise&x=0&y=0#docs/promise)）。接下来摘要说下Promise有关的要点：

1. 对象的状态不受外界影响。Promise对象代表一个异步操作，有三种状态：pending（进行中）、fulfilled（已成功）和rejected（已失败）。只有异步操作的结果，可以决定当前是哪一种状态，任何其他操作都无法改变这个状态。这也是Promise这个名字的由来，它的英语意思就是“承诺”，表示其他手段无法改变。
2. 一旦状态改变，就不会再变，任何时候都可以得到这个结果。Promise对象的状态改变，只有两种可能：从pending变为fulfilled和从pending变为rejected。只要这两种情况发生，状态就凝固了，不会再变了，会一直保持这个结果，这时就称为 resolved（已定型）。如果改变已经发生了，你再对Promise对象添加回调函数，也会立即得到这个结果。这与事件（Event）完全不同，事件的特点是，如果你错过了它，再去监听，是得不到结果的。
3. **then**：Promise 实例具有then方法，也就是说，then方法是定义在原型对象Promise.prototype上的。它的作用是为 Promise 实例添加状态改变时的回调函数。前面说过，then方法的第一个参数是resolved状态的回调函数，第二个参数（可选）是rejected状态的回调函数。
4. **catch**：Promise.prototype.catch方法是.then(null, rejection)的别名，用于指定发生错误时的回调函数。
5. **all**：Promise.all方法用于将多个 Promise 实例，包装成一个新的 Promise 实例。
6. **race**：Promise.race方法同样是将多个 Promise 实例，包装成一个新的 Promise 实例。
7. **resolve**：有时需要将现有对象转为 Promise 对象，Promise.resolve方法就起到这个作用。
8. **reject**：Promise.reject(reason)方法也会返回一个新的 Promise 实例，该实例的状态为rejected。
9. **done**：Promise 对象的回调链，不管以then方法或catch方法结尾，要是最后一个方法抛出错误，都有可能无法捕捉到（因为 Promise 内部的错误不会冒泡到全局）。因此，我们可以提供一个done方法，总是处于回调链的尾端，保证抛出任何可能出现的错误。
10. **finally**：finally方法用于指定不管 Promise 对象最后状态如何，都会执行的操作。它与done方法的最大区别，它接受一个普通的回调函数作为参数，该函数不管怎样都必须执行。

再介绍几个Promise有关的QA：
1. resolve后如何返回相关数据？直接resolve(result)就可以将结果返回。
2. Promise是不是只跟前后台交互有关？首先Promise确实跟ajax相关，但Promise本身是一种异步编程的解决方案，可以用在前后台交互上，也可以用在页面交互逻辑上。

## 关于异步调用之加密请求示例

在进行前后台交互时，尤其是提交如：密码数据时，由于网络是不安全的传输，因此需要对密码数据进行加密。在实现中使用的是RSA加密算法，原理见[这里](http://www.ruanyifeng.com/blog/2013/06/rsa_algorithm_part_one.html)和[这里](http://www.ruanyifeng.com/blog/2013/07/rsa_algorithm_part_two.html)。简单来说，客户端（浏览器）在进行需加密数据提交时，需要拿到公钥（publicKey），这需要提前发起一个申请公钥的过程。

浏览器需要提交加密数据：先请求pk、用收到的pk加密数据、再提交数据。再进一步分解：
1. 浏览器：待加密数据、加密方法
2. 请求pk：浏览器-(发起请求pk的请求)->服务器
3. 收到pk：服务器-(pk)->浏览器
4. 浏览器：待加密数据、pk、加密方法
5. 加密数据：待加密数据-加密方法、pk->加密后数据
6. 浏览器：加密后数据
7. 提交数据：浏览器-加密后数据->服务器
8. 确认提交：服务器-响应->浏览器

由此暴露出来的接口就是function encryptPost(url, pkEncrypt, options)。其中url就是真正的提交数据的url、pkEncrypt就是加密方法、options就是要提交的数据们（包括参数等）。

在实现的时候，`requestPK(pkEncrypt,options).then((newOptions)=>request(url,newOptions));`。其中requestPK就是请求pk并将参数进行加密，同时将加密后的数据封装在Promise中传递出来，在then中将新的参数传递给真正的请求。详细的封装过程参见[源码request.js](./src/utils/request.js)，注意options是一个json对象其结构大约是{method:'POST',body:params}，因此真正的参数在body中，因此在构造新的options时使用了`{...options,body:pkEncrypt(pk.result,options.body)}`写法。

再介绍pkEncrypt，这是加密函数，它有两个参数，第一个是pk，第二个是params，因此实现时需要根据需要进行相应的实现。

进一步介绍加密时的封装。先定义公钥对明文加密的原子方法pkEncryptPlain，其入参是pk和明文，返回值是密文
。这并不能直接放入encryptPost中的pkEncrypt位置，毕竟pkEncrypt的入参是pk和options.body，这里进一步对入参进行约束，将入参分成params和encryptFields两部分，其中params是真正的入参而encryptFields是需要加密的入参。这样一来就可以进一步封装出pkEncryptBody函数，配合入参payload就能够正常使用了。

总结来看，任何一个需要进行加密提交的请求都可以通过如下方式进行，定义入参payload，由两部分组成：params、encryptFields，同时指定post的url。以login为例，调用的范例就是：
```
export async function usernameLogin(payload){
  const {params,encryptFields} = payload.payload;
  return encryptPost(`/security/login.go`,
    (pk,body)=>pkEncryptBody(encryptFields,pk,body),
    {method:'POST',body:params,}
  );
}
```

常用的链接：
