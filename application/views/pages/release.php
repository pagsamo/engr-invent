<?php if(isset($info)): ?>
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php echo $info; ?></strong>
    </div>
<?php endif; ?>
<div class="panel panel-default panel-warning">
    <div class="panel-heading">
        <h3>RELEASE HISTORY <a class="pull-right" class="pull-right" href="#" data-toggle="modal" data-target="#release_f_modal" role="button""><span class="glyphicon glyphicon-plus"></span></a></h3>
    </div>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>RM Number</th>
            <th>Item Name</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Purpose</th>
            <th>Requested By</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<!--modal-->
<div id="release_f_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="test">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Stock</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('release/new_release','id="release_f"'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="item_name">Select Item</label>
                            <input type="text" class="item-auto-name form-control" name="item_name">
                            <input type="hidden" name="item_id">
                            <input type="hidden" name="unit">
                        </div>
                        
                        <div class="form-group">
                            <label for="rm_number">RM Number</label>
                            <input type="number" class="form-control" name="rm_number">
                        </div>
                        
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>

                        <div class="form-group">
                            <label for="requested_by">Date</label>
                            <input type="text" class="form-control" name="date">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea name="purpose" id="" cols="30" rows="7" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="requted_by">Requested by</label>
                            <input type="text" class="form-control" name="requested_by">
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