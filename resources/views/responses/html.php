<html>
<body>
<table>
    <?php if ($data): ?>
        <thead>
        <tr>
            <?php foreach (array_keys(head($data)) as $key): ?>
                <th><?php echo e($key); ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <?php foreach ($data as $resources): ?>
            <tr>
                <?php foreach ($resources as $resource): ?>
                    <td><?php echo e($resource ?? '-'); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (! empty($links)): ?>
        <?php // TODO?>
    <?php endif; ?>

    <?php if (! empty($meta)): ?>
        <?php // TODO?>
    <?php endif; ?>
</table>
</body>
</html>
