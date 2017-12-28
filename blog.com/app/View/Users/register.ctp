<!-- File: /app/View/User/register.ctp -->

<div class="users form">
<?php echo $this->Form->create(); ?>
    <fieldset>
        <legend><?php echo __('Register'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('level', array(
            'options' => array('admin' => 'Admin', 'user' => 'User', 'writer' => 'Writer')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Register')); ?>
    <?php echo $this->Html->link("Login", array('action' => 'login'));?>
</div>



