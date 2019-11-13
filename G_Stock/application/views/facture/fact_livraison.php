


<div class="container printer">
    <div class="row printer" style="margin-top: 70px;">
        <div class="well printer col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row printer">
                <div class="col-xs-6 col-sm-6 col-md-6 printer">
                    <address>
                        <strong>Elf Cafe</strong>
                        <br>
                        2135 Sunset Blvd
                        <br>
                        Los Angeles, CA 90026
                        <br>
                        <abbr title="Phone">P:</abbr> (213) 484-6829
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: 1st November, 2013</em>
                    </p>
                    <p>
                        <em>Receipt #: 34522677W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Facture</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Articles</th>
                            <th>#</th>
                            <th class="text-center">Qté</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i = 1; foreach ($this->cart->contents() as $items): ?>

                                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                                <tr>
                                        <td>
                                                <?php echo $items['name']; ?>
                        
                                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                        
                                                        <p>
                                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                        
                                                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                        
                                                                <?php endforeach; ?>
                                                        </p>
                        
                                                <?php endif; ?>
                        
                                        </td>
                                        
                                        <td style="text-align:right"><?= $items['id'] ?></td>
                                        <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                                        
                                        <td style="text-align:right">$<?= 0 // $this->cart->format_number($items['subtotal']); ?></td>
                                </tr>
                        
                        <?php $i++; endforeach; ?>

                      
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td class="text-right">
                            <p>
                                <strong>Subtotal:</strong>
                            </p>
                            <p>
                                <strong>Tax:</strong>
                            </p></td>
                            <td class="text-center">
                            <p>
                                <strong>6.94</strong>
                            </p>
                            <p>
                                <strong>6.94</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>  </td>
                            <td>  </td>
                            <td class="text-right"><h4><strong>Total:</strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>31.53</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="window.print()" class="btn btn-primary btn-md btn-block">
                    Imprimer <span class="glyphicon glyphicon-chevron-right"></span>
                </button></td>
            </div>
        </div>
    </div>
</div>