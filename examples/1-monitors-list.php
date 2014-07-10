<?php
// WeCheck API: Example 1 - List current monitors

// Depending on your framework, fit this accordingly
include('wecheck/communicator.php');
include('wecheck/api.php');

// Create a new API instance
$api = new WeCheck\Api;

// Set your API key
$api->setKey('b8d9b67179cb4d25b5654a4cd504c17f1ffdde953a8b52163abea7409d403cb0121d4d6de47ec58e188e4e6e4cb3bf11e67a22417aa9d71163d82da996b885f8');

// Fetch current monitors
$monitors = $api->getMonitors();

// Perform a check to see if everything is allright
if (!empty($monitors['error'])) {
    echo 'Woops, something is wrong: ' . implode(': ', $monitors);
    exit;
}

// Display a table with name, hostname, status and uptime
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Server</th>
            <th>&nbsp;</th>
            <th>Status</th>
            <th>Uptime</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="4" class="text-center"><a href="http://www.wecheck.net/">Uptime monitoring by WeCheck</a></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($monitors['list'] as $item): ?>
        <tr>
            <td><?php echo htmlentities($item['name'])?></td>
            <td><?php echo htmlentities($item['hostname'])?></td>
            <td><?php echo ucfirst($item['status'])?></td>
            <td><?php echo $item['uptime']['percentage']?>%</td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>
