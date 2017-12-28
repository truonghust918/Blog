<!-- File: /app/View/Users/info.ctp -->

<span>Login : <?php  echo $name['User']['username']; ?> |
    <?php echo $this->Html->link(
        'Logout',
        array('controller' => 'users', 'action' => 'login')
    ); ?>


<h1>Chúc mừng bạn đã đăng nhập thành công !</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>User Name</th>
        <th>Level</th>
        <th>Action</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>

        <tr>
            <td><?php echo $user['User']['id']; ?></td>
            <td><?php echo $user['User']['name'];?></td>
            <td><?php echo $user['User']['email'];?></td>
            <td><?php echo $user['User']['username'];?></td>
            <td><?php echo $user['User']['level'];?></td>
            <td>
                <?php
                if($name['User']['level'] == 'admin'):
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit')
                );
                echo ' | ';
                echo $this->Html->link(
                    'Delete',
                    array('action' => 'delete', $user['User']['id'])
                );
                endif;
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
    <?php
                    if($name['User']['level'] == 'admin'):
                    echo $this->Html->link(
                        'Create User',
                        array('action' => 'add'));
                    echo ' | ';
                endif;

                echo $this->Html->link(
                'Manage Post',
                array('controller' => 'posts', 'action' => 'index'));
    ?>

