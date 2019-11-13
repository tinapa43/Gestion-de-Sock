<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-info">
            <h1 class="panel-heading text-center"> Lits Depots </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <div class="account-wall">
                <form class="form-signin" method="POST" action="<?php echo base_url() ?>">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Depots</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_depot ?></td>
                                <td> <?= $row->depot ?></td>
                                <td> <?= $row->create_depot ?></td>
                                <td>
                                    <a href="<?= base_url('Depots/detail_depot').'/'.$row->id_depot ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
                                </td>
                            </tr>
                            
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    
                    <span class="clearfix"></span>
                </form>
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>