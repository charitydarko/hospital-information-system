<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notice)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($notice as $item) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo esc($item->title); ?></td>
                                    <td><?php echo strip_tags($item->description); ?></td>
                                    <td><?php echo esc($item->start_date); ?></td>
                                    <td><?php echo esc($item->end_date); ?></td>
                                    <td>
                                        <?= $staff->find($item->created_by)->firstname; ?>
                                        <?= $staff->find($item->created_by)->lastname; ?>
                                    </td>
                                    <td><?= ((esc($item->status)==1)?'Active':'Inactive'); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?= site_url("/accountant/noticeboard/view/".$item->id)?>" class="btn btn-xs btn-success" title="View Notice"><i class="fa fa-eye"></i></a>
                                    </td> 
                                </tr>
                                <?php $sl++; ?>
                            <?php } ?> 
                        <?php } ?> 
                    </tbody>
                </table>  <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>