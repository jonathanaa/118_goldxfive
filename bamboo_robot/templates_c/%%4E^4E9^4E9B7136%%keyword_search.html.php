<?php /* Smarty version 2.6.31, created on 2018-05-14 07:56:53
         compiled from keyword_search.html */ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="assets/css/main.css" />
<title></title>
</head>
<body>
<!--<?php $_from = $this->_tpl_vars['keyid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index']):
?>
字:<?php echo $this->_tpl_vars['index']['word']; ?>

詞性: <?php echo $this->_tpl_vars['index']['type']; ?>
<br>
<?php endforeach; endif; unset($_from); ?>-->
<section id="two" class="wrapper style2 alt">
<div class="inner">
<?php $_from = $this->_tpl_vars['output']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index2']):
?>
<div class=goods>
<div class="spotlight">
<div class="content">
<h3>第<?php echo $this->_tpl_vars['index2']['number']; ?>
筆</h3><br>
<div class=goodsid>
<h3><?php echo $this->_tpl_vars['index2']['idname']; ?>
</h3><br></div>
<h3>產品名稱: <?php echo $this->_tpl_vars['index2']['name']; ?>
</h3><br>
<p>產品描述:</p><br> <p><?php echo $this->_tpl_vars['index2']['des']; ?>
</p><br>
<p>符合關鍵字個數: <?php echo $this->_tpl_vars['index2']['keynum']; ?>
</p><br><br>
</div>
</div>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>
</section>
<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

</body>
</html>