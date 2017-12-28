<!-- //app/View/Users/login.ctp -->

<form method="post" action="">
   <fieldset>
     <legend>Đăng nhập</legend>
     <label>Tên đăng nhập</label><input type="text" name="username" /><br/>
     <label>Mật khẩu</label><input type="password" name="password" /><br/>
     <input type="submit" name="ok" value="Login" />
       <?php echo $this->Html->link("Register", array('action' => 'register'));?>
     <span class="error"><?php echo $error; ?></span>
   </fieldset>
</form>

