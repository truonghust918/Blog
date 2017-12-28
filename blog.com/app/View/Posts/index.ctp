<!-- File: /app/View/Posts/index.ctp -->

<span>Login : <?php  echo $name['User']['username']; ?> |
    <?php echo $this->Html->link(
        'Logout',
        array('controller' => 'users', 'action' => 'login')
    ); ?>
<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>

<?php $this->paginator->settings = array(
    'limit' => 10,
    'maxLimit' => 25
); ?>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort('id', 'Id'); ?></th>
        <th><?php echo $this->Paginator->sort('title', 'Title'); ?></th>
        <th>Action</th>
        <th>Created</th>
    </tr>

    <!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($data as $post): ?>
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
    <?php endforeach; ?>

</table>
<?php
echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
echo " | ".$this->Paginator->numbers(array('first' => 2, 'last' => 2))." | "; //Shows the page numbers
echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
?>


<?php //debug($this->request->params['paging']);?>
<?php echo $this->Html->link(
    'Back to info view',
    array('controller' => 'users','action' => 'info')
);
?>



