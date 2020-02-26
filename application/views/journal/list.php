<table class="table table-bordered table-hover ">
    <thead class="thead-dark">
        <tr>
            <th>Text</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $d) { ?>      
        <tr>
            <td><?php echo $d->tText; ?></td>
            <td><?php echo date("d-m-Y H:i:s", strtotime($d->tModified)); ?></td>          
            <td>
                <a class="btn btn-info btn-xs" href="<?php echo base_url('index.php/journal/edit/'.$d->iID) ?>">Edit</a>
                <a class="btn btn-info btn-xs" href="<?php echo base_url('index.php/journal/delete/'.$d->iID) ?>">Delete</a>
            </td>     
        </tr>
        <?php } ?>
    </tbody>
</table>
