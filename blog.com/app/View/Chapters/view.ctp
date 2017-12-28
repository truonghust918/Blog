<!-- File: /app/View/Posts/view.ctp -->

<h1>The Post View</h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><h3><?php echo $post['Post']['title']; ?></h3></p>
<table>
    <tr>
        <th>Chap</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->


        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td>
                <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
                ?>
            </td>
            <td>
                <?php
                if($name['User']['level'] != 'user'):
                    echo $this->Html->link(
                        'Edit',
                        array('action' => 'edit', $post['Post']['id'])
                    );
                    echo ' | ';
                    echo $this->Html->link(
                        'Delete',
                        array('action' => 'delete', $post['Post']['id'])
                    );
                endif;
                ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>

            </td>
        </tr>

</table>
<?php echo $this->Html->link(
'Manage Post',
array('action' => 'index'));
?>