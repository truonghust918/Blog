<!-- File: /app/View/Posts/view.ctp -->

<h1>The Post View</h1>

<p><small>Created: <?php echo $posts['Post']['created']; ?></small></p>

<p><h3><?php echo $posts['Post']['title']; ?></h3></p>
<table>
    <tr>
        <th>Chap</th>
        <th>Title</th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->
<?php foreach ($chapters as $chapter):  ?>
        <tr>
            <td><?php echo $chapter['chapters']['id']; ?></td>
            <td>
                <?php
                echo $this->Html->link(
                    $chapter['chapters']['chap_name'],
                    array('action' => 'view', $chapter['chapters']['id'])
                );
                ?>
            </td>
            <td>
                <?php
                if($name['User']['level'] != 'user'):
                    echo $this->Html->link(
                        'Edit',
                        array('action' => 'edit', $chapter['chapters']['id'])
                    );
                    echo ' | ';
                    echo $this->Html->link(
                        'Delete',
                        array('action' => 'delete', $chapter['chapters']['id'])
                    );
                endif;
                ?>
            </td>
            <td>
                <?php echo $chapter['chapters']['create_at']; ?>

            </td>
        </tr>
<?php endforeach;?>
</table>
<?php echo $this->Html->link(
'Manage Post',
array('action' => 'index'));
?>