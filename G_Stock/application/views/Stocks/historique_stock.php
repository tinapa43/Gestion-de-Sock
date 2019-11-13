<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center"> Mouvement Dépots</h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <hr>
            <div class="account-wall">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Dépot out</th>
                            <th>Dépot in</th>
                            <th>Qte effectué</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($depot): foreach($depot as $row):  ?>
                         <tr>
                             <td><?= $row->article_art ?> </td>
                             <td><?= get_depot( $row->id_depot_out ) ?> <i class="fas fa-arrow-alt-circle-right"></i> </td>
                             <td><?= get_depot( $row->id_depot_in ) ?> </td>
                             <td><?= $row->qte_trans.' '.$row->unite_art  ?> </td>
                             <td><?= $row->create_trans ?> </td>
                         </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
                <span class="clearfix"></span>
            </div>
                
        </div>
        
        <div class="col-md-12 panel panel-warning">
            <h1 class="panel-heading text-center"> Mouvement Stocks</h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <hr>
            <div class="account-wall">
                <table id="data" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Désigniation</th>
                            <th>Référence</th>
                            <th>Type</th>
                            <th>Qte effectué</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($mouve): foreach($mouve as $row):  ?>
                         <tr>
                             <td><?= $row->article_art ?> </td>
                             <td><?= $row->desi_art ?> </td>
                             <td><?= $row->ref_art ?> </td>
                             <td><?= $row->type ?> </td>
                             <td><?= $row->qte_mouve ?> </td>
                             <td><?= $row->created_mouve ?> </td>
                         </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
                <span class="clearfix"></span>
            </div>
                
        </div>
    </div>
</div>

