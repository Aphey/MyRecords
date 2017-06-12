<html>
<head>
    <title>Title</title>
</head>
<body>
这是直接输出的<br>
<?php
echo "下面是一句假话<br>";
echo "Aphey is a good soccer player<br>";
$string="Yes he is<br>"
?>
<!--此短标签默认不可用,需要到php.ini 里打开short_tag_open = on 才行,不建议使用,会和xml冲突-->
<?=$string ?>
<!--script 标签方法默认可用,比较长,不推荐记-->
<script language="php">
echo "of course he is.<br>";
</script>
</body>
</html>
<!--如果全篇都是php代码,则最后可以不加闭合标签,而且推荐不加,因为有人习惯在最后按两下回车-->
<?php echo "Hello World";