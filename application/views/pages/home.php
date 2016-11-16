<div class="container">
    <h1>Overview</h1>

    <div class="panel panel-default">
        <div class="panel-heading">Statistics</div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Balance</th>
                    <th>Used</th>
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
                    <td><?php echo $item['used']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

