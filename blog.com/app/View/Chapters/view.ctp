<!-- File: /app/View/Posts/view.ctp -->

<h1>The Chapter View</h1>

<!--<p><small>Created: --><?php //echo $post['Post']['created']; ?><!--</small></p>-->

<!--<p><h3>--><?php //echo $post['Post']['title']; ?><!--</h3></p>-->
<?php echo $this->Html->link($this->Html->image('http://2.bp.blogspot.com/_BW4Xi0F0vXI/Tc36FKyKRtI/AAAAAAAADNA/c91pz_es7Tw/s0/Chuong_001-OP01-00.jpg')
);?>
<?php //echo "abcxyz";?>
<?php echo $this->Html->link(
'Manage Chapter',
array('controller' => 'Posts','action' => 'view','1'));
?>