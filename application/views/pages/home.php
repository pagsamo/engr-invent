
<div class="container">
<!--    output session information if exists-->
    <?php if(isset($info)): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo $info; ?></strong>
        </div>
    <?php endif; ?>
<!--    output session information if exists-->
    <div class="panel panel-default panel-info">
        <div class="panel-heading">
                <h3>OVERVIEW <a class="pull-right" href="#" data-toggle="modal" data-target="#create_modal" role="button"><span class="glyphicon glyphicon-plus"></span></a></h3>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Balance</th>
                    <th>Category</th>
                    <th>Movement</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['unit']; ?></td>
                    <td><?php echo $item['balance']; ?></td>
                    <td><?php echo $item['category']; ?></td>
                    <td>Placeholder</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!--Create Item Form Modal-->
<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new item</h4>
            </div>
            <div class="modal-body">

                <?php echo form_open('items/create','id="item_create"'); ?>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input class="form-control" type="text" name="name" />
                            </div>

                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input class="form-control" name="unit" type="text">
                            </div>

                            <div class="form-group">
                                <label for="balance">Initial Balance</label>
                                <input class="form-control" type="number" name="balance">
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="frequency">Frequency</label>
                                <input class="form-control" type="number" name="frequency">
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" class="form-control" name="category">
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
    </div>
</div>
<!--Create Item Form Modal-->

