<?php /* Smarty version 2.6.31, created on 2018-04-22 15:08:52
         compiled from keyword_story.html */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

<?php $_from = $this->_tpl_vars['output']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index2']):
?>
<div class="goods story">
第<?php echo $this->_tpl_vars['index2']['number']; ?>
筆---!!!<br>
產品編號: <?php echo $this->_tpl_vars['index2']['id']; ?>
<br>
<div class="goodsid">
<?php echo $this->_tpl_vars['index2']['idname']; ?>
<br></div>
產品名稱: <?php echo $this->_tpl_vars['index2']['name']; ?>
<br>
產品描述:<br> <?php echo $this->_tpl_vars['index2']['des']; ?>
<br>
符合關鍵字個數: <?php echo $this->_tpl_vars['index2']['keynum']; ?>
<br><br>
</div>
<?php endforeach; endif; unset($_from); ?>

</body>
</html>