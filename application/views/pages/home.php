
<div class="container">
<!--    output session information if exists-->
    <?php if(isset($info)): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo $info; ?></strong>
        </div>
    <?php endif; ?>
<!--    output session information if exists-->
    <h1>Overview - <?php echo months()[$m-1]['name'].", {$y} | {$c}";  ?> </h1>
    <div class="panel panel-default panel-info">
        <div class="panel-heading">
            <h3 class="row">
                <div class="col-xs-2">
                     Statistics 
                </div>
                <div class="col-xs-9">
                    <div class="form form-inline pull-right">
                        <div class="form-group">
                            <select class="form-control" name="month">
                                <?php foreach(months() as $mo): ?>
                                    <option value='<?php echo $mo['val'] ?>'
                                    <?php if((int)$mo['val'] == (int)$m)
                                        {
                                            echo " selected";
                                        } ?>
                                    <?php echo ">{$mo['name']}</option>"; ?>
                                <?php endforeach; ?>
                            </select>
                            <select name="year" class="form-control">
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                            </select>
                            <select class="form-control" name="category">
                            <?php foreach($cats as $cat): ?>
                               <option value="<?php echo $cat['name']; ?>"  <?php echo $cat['name']==$c? ' selected':''; ?>>
                                   <?php echo $cat['name']; ?>
                               </option>
                            <?php endforeach; ?>
                            </select>

                            <div class="form-group">
                                <input type="button" class="btn btn-primary form-control goer" value="Go">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1 filter-div">
                    <a class="pull-right" href="#" data-toggle="modal" data-target="#create_modal" role="button"><span class="glyphicon glyphicon-plus"></span></a>
                </div>
            </h3>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class=text-center>ID</th>
                    <th class=text-center>Name</th>
                    <th class=text-center>Unit</th>
                    <th class=text-center>Current Balance</th>
                    <th class=text-center>Total Released</th>
                    <th class=text-center>Category</th>
                    <th class=text-center>Movement</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($items as $item): ?>
                <tr class="text-center">
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['unit']; ?></td>
                    <td><?php echo $item['balance']; ?></td>
                    <td><?php echo $item['0'][0]; ?></td>
                    <td><?php echo $item['category']; ?></td>
                    <td><?php echo $item['0'][1]; ?></td>
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
                                <select name="category" id="" class="form-control">
                                    <?php $cats2 = $cats; array_shift($cats2); ?>
                                    <?php foreach($cats2 as $c): ?>
                                        <option value="<?php echo $c['name']; ?>"><?php echo $c['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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

