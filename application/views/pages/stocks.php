<?php if(isset($info)): ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo $info; ?></strong>
    </div>
<?php endif; ?>
<div class="panel panel-default panel-info">
    <div class="panel-heading">
        <h3>STOCKS HISTORY <a class="pull-right" class="pull-right" href="#" data-toggle="modal" data-target="#new_stock_modal" role="button""><span class="glyphicon glyphicon-plus"></span></a></h3>
    </div>
    <div class="panel-heading">
        <div class="form form-inline">
            <div class="form-group">
                <label for="start">From</label>
                <input readonly name="start" type="text" class="form-control date_range" value="<?php echo month_default()[0]; ?>">
            </div>
            <div class="form-group">
                <label for="to">To</label>
                <input readonly name="end" type="text" class="form-control date_range" value="<?php echo month_default()[1]; ?>">
            </div>
            <div class="form-group">
                <select name="category" id="" class="form-control">
                    <?php foreach($cats as $c): ?>
                        <option value="<?php echo $c['name'] ?>"><?php echo $c['name']; ?></option>
                    <?php endforeach; ?>        
                </select>
            </div>
            <div class="form-group">
                <input type="button" class="btn btn-primary" value="Go" id="api_trigger">
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>RP number</th>
                <th>Item Name</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Supplier</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($stocks as $s): ?>
                <tr>
                    <td><?php echo $s['id']; ?></td>
                    <td><?php echo $s['rp_number']; ?></td>
                    <td><?php echo $s['item_name']; ?></td>
                    <td><?php echo $s['unit']; ?></td>
                    <td><?php echo $s['quantity']; ?></td>
                    <td><?php echo $s['amount']; ?></td>
                    <td><?php echo $s['supplier']; ?></td>
                    <td><?php echo $s['date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!--modal-->
<div id="new_stock_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="test">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Stock</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('stocks/news_stocks','id="stock_f"'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="title">Select Item</label>
                            <input class="form-control item-name-auto" type="text" name="item_name" />
<!--                            id and unit hidden-->
                            <input type="hidden" name="item_id">
                            <input type="hidden" name="unit">
<!--                            id and unit hidden-->
                        </div>
                        <div class="form-group">
                            <label for="rp_number">RP number</label>
                            <input type="number" class="form-control" name="rp_number">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <input type="text" class="form-control" name="supplier">
                        </div>

                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea class="form-control" name="purpose" id="" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                    </div>
                </div>
                <div class="message-placeholder"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                <!--close the form-->
                </form>
        </div>
    </div>
</div><!--modal-->